<?php

class DropCalendar
{
    /** @var modX $modx */
    public $modx;

    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('dropcalendar_core_path', $config,
            $this->modx->getOption('core_path') . 'components/dropcalendar/'
        );
        $assetsUrl = $this->modx->getOption('dropcalendar_assets_url', $config,
            $this->modx->getOption('assets_url') . 'components/dropcalendar/'
        );
        $connectorUrl = $assetsUrl . 'connector.php';

        $this->config = array_merge(array(
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'imagesUrl' => $assetsUrl . 'images/',
            'connectorUrl' => $connectorUrl,

            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'templatesPath' => $corePath . 'elements/templates/',
            'chunkSuffix' => '.chunk.tpl',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'processorsPath' => $corePath . 'processors/',
        ), $config);

        $this->modx->addPackage('dropcalendar', $this->config['modelPath']);
        $this->modx->lexicon->load('dropcalendar:default');
    }

    public function getEvents($calendar) {
        $q = $this->modx->newQuery('DropCalendarItem');
        $q->select('id,title,calendar,allDay,start,end,info,backgroundColor,borderColor,textColor');
        !empty($calendar) ? $q->where(array('calendar' => $calendar)) : '';

        $q->prepare();
        $q->stmt->execute();

        $events = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
        $events = json_encode($events);
        $events = str_replace('"allDay":1', '"allDay": true', $events);
        $events = str_replace('"allDay":"1"', '"allDay": true', $events);
        $events = str_replace('"allDay":0', '"allDay": false', $events);
        $events = str_replace('"allDay":"0"', '"allDay": false', $events);

        return $events;
    }

    public function addEvent($event) {
        $fields = array(
            'title' => $event->title,
            'calendar' => $event->calendar,

            'allDay' => $event->allDay,
            'start' => $event->start,
            'end' => $event->end,

            'info' => $event->info,

            'backgroundColor' => $event->backgroundColor,
            'borderColor' => $event->borderColor,
            'textColor' => $event->textColor,
        );
        $q = $this->modx->newObject('DropCalendarItem', $fields);
        $q->save();

        $id = $this->modx->lastInsertId();
        return json_encode(['status' => 'success', 'eventid'=>$id, 'message'=>$this->modx->lexicon('success_add')]);
    }

    public function deleteEvent($id) {
        $where = array(
            'id' => $id
        );
        $this->modx->removeObject('DropCalendarItem', $where);
        return json_encode(['status' => 'success', 'message'=>$this->modx->lexicon('success_delete')]);
    }

    public function updateEventFull($event) {
        $q = $this->modx->getObject('DropCalendarItem', ['id'=>$event->id]);
        $q->set('title', $event->title);

        $q->set('allDay', $event->allDay);
        $q->set('start', $event->start);
        $q->set('end', $event->end);

        $q->set('info', $event->info);

        $q->set('backgroundColor', $event->backgroundColor);
        $q->set('borderColor', $event->borderColor);
        $q->set('textColor', $event->textColor);

        if ( $q->save()) {
            return json_encode(array('status'=>'success','eventid'=>$event->id));
        } else {
            return json_encode(array('status'=>'failure','message'=>$this->modx->lexicon('error_save')));
        }
    }

    public function updateEvent($event) {
        $q = $this->modx->getObject('DropCalendarItem', ['id'=>$event->id]);
        $q->set('title', $event->title);
        $q->set('start', $event->start);
        $q->set('end', $event->end);

        if ( $q->save()) {
            return json_encode(array('status'=>'success','eventid'=>$event->id));
        } else {
            return json_encode(array('status'=>'failure','message'=>$this->modx->lexicon('error_save')));
        }
    }

}