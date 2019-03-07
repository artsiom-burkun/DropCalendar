<?php
define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';

if(
    isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
)
{
    $DropCalendar = $modx->getService('dropcalendar', 'DropCalendar', $modx->getOption('dropcalendar_core_path', null,
            $modx->getOption('core_path') . 'components/dropcalendar/') . 'model/dropcalendar/'
    );
    $modx->lexicon->load('dropcalendar:default');

    $event = new stdClass();
    $event->calendar     = makeSecure($_POST['calendar']);

    $event->id     = makeSecure($_POST['id']);
    $event->title  = makeSecure($_POST['title']);
    $event->start  = makeSecure($_POST['start']);
    $event->end    = makeSecure($_POST['end']);

    $_POST['allDay'] == 'true' ? $event->allDay = 1 : $event->allDay = 0;

    $event->backgroundColor  = makeSecure($_POST['backgroundColor']);
    $event->borderColor      = makeSecure($_POST['borderColor']);
    $event->textColor        = makeSecure($_POST['textColor']);

    $event->info             = makeSecure($_POST['info']);


    switch ($_POST['action']) {
        case 'get':
            $response = $DropCalendar->getEvents($event->calendar);
            break;


        case 'add':
            if ( empty($_POST['title']) || !preg_match("/^[a-zA-Z0-9-_!?—:,.;'\"\p{Cyrillic}0-9\s\-]+$/u", $_POST['title']) ) {
                exit(json_encode(array('status'=>'failure','message'=>$modx->lexicon('correct_title'))));
            }
            if (empty($_POST['start']) || $_POST['start'] == "Invalid date" ) {
                exit(json_encode(array('status'=>'failure','message'=>$modx->lexicon('correct_start'))));
            }

            $response = $DropCalendar->addEvent($event);
            break;


        case 'update':
            if ( empty($_POST['title']) || !preg_match("/^[a-zA-Z0-9-_!?—:,.;'\"\p{Cyrillic}0-9\s\-]+$/u", $_POST['title']) ) {
                exit(json_encode(['status'=>'failure','message'=>$modx->lexicon('correct_title')]));
            }
            if (empty($_POST['start']) || $_POST['start'] == "Invalid date" ) {
                exit(json_encode(['status'=>'failure','message'=>$modx->lexicon('correct_start')]));
            }

            $response = $DropCalendar->updateEvent($event);
            break;


        case 'updatefull':
            if ( empty($_POST['title']) || !preg_match("/^[a-zA-Z0-9-_!?—:,.;'\"\p{Cyrillic}0-9\s\-]+$/u", $_POST['title']) ) {
                exit(json_encode(['status'=>'failure','message'=>$modx->lexicon('correct_title')]));
            }
            if (empty($_POST['start']) || $_POST['start'] == "Invalid date" ) {
                exit(json_encode(['status'=>'failure','message'=>$modx->lexicon('correct_start')]));
            }

            $response = $DropCalendar->updateEventFull($event);
            break;


        case 'delete':
            $response = $DropCalendar->deleteEvent($event->id);
            break;


        default:



    }

    if (is_array($response)) {
        $response = $modx->toJSON($response);
    }


}
else {
    $modx->sendRedirect($modx->makeUrl($modx->getOption('site_start'), '', '', 'full'));
}

function makeSecure($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

@session_write_close();
exit($response);