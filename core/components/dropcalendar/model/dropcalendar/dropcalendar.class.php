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

    public function getEvents($calendar_id) {
        $q = $this->modx->newQuery('DropCalendarItem');
        $q->select('id,title,start,end,mesto,prim,className,site');
        $q->where(array(
            'calendar_id' => $calendar_id
        ));
        $q->prepare();
        $q->stmt->execute();
        $result = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = json_encode($result);

        return $result;
    }

    public function addEvent($title, $start, $end, $mesto, $prim, $className, $site, $calendar_id) {
        $fields = array(
            'title' => $title,
            'start' => $start,
            'end' => $end,
            'mesto' => $mesto,
            'prim' => $prim,
            'className' => $className,
            'site' => $site,
            'calendar_id' => $calendar_id
        );
        $quote = $this->modx->newObject('DropCalendarItem', $fields);
        $quote->save();
        $id = $this->modx->lastInsertId();

        return json_encode(array('status'=>'success','eventid'=>$id,'calendar_id'=>$calendar_id));
    }

    public function deleteEvent($id) {
        $where = array(
            'id' => $id
        );
        $this->modx->removeObject('DropCalendarItem', $where);
        return json_encode(array('status'=>'success','eventid'=>$id));
    }

    public function updateEventFull($id, $title, $start, $end, $mesto, $prim, $className) {
        $u = $this->modx->getObject('DropCalendarItem', array('id'=>$id));
        $u->set('title', $title);
        $u->set('start', $start);
        $u->set('end', $end);
        $u->set('mesto', $mesto);
        $u->set('prim', $prim);
        $u->set('className', $className);
        $u->set('site', $site);
        if ( $u->save()) {
            return json_encode(array('status'=>'success','eventid'=>$id));
        } else {
            return json_encode(array('status'=>'failure','error'=>'cant save event'));
        }
    }

    public function updateEvent($id, $title, $start, $end) {
        $u = $this->modx->getObject('DropCalendarItem', array('id'=>$id));
        $u->set('title', $title);
        $u->set('start', $start);
        $u->set('end', $end);

        if ( $u->save()) {
            return json_encode(array('status'=>'success','eventid'=>$id));
        } else {
            return json_encode(array('status'=>'failure','error'=>'cant save event'));
        }
    }

}