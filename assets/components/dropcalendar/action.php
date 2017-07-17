<?php
define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    $modx->sendRedirect($modx->makeUrl($modx->getOption('site_start'), '', '', 'full'));
}
else {


    /** @var DropCalendar $DropCalendar */
    $DropCalendar = $modx->getService('dropcalendar', 'DropCalendar', $modx->getOption('dropcalendar_core_path', null,
            $modx->getOption('core_path') . 'components/dropcalendar/') . 'model/dropcalendar/'
    );
    $modx->lexicon->load('dropcalendar:default');


    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        isset($_GET['calendarNumber']) ? $calendar_id = $_GET['calendarNumber'] : $calendar_id = '0';
    } else {

        $action=$_POST['action'];

        $id=$_POST['id'];
        $title=$_POST['title'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        $mesto=$_POST['mesto'];
        $prim=$_POST['prim'];
        $className=$_POST['className'];

        $site=$_POST['site'];
        isset($_POST['calendarNumber']) ? $calendarNumber = $_POST['calendarNumber'] : $calendarNumber = '0';


        if ($action == 'deleteEvent' ) {
            if (empty($id)) {
                exit(json_encode(array('status'=>'failure','error'=>$modx->lexicon('dropcalendar_item_noid'))));
            }
        }
        else {
            if (empty($title)) {
                exit(json_encode(array('status'=>'failure','error'=>$modx->lexicon('dropcalendar_item_notitle'))));
            }

            if (!preg_match("/^[a-zA-Z0-9-_!?—:,.;'\"\p{Cyrillic}0-9\s\-]+$/u",$title)) {
                exit(json_encode(array('status'=>'failure','error'=>$modx->lexicon('correct_title'))));
            }

            if (!is_numeric(strtotime($start))) {
                exit(json_encode(array('status'=>'failure','error'=>$modx->lexicon('correct_start'))));
            }

            if (!is_numeric(strtotime($end))) {
                exit(json_encode(array('status'=>'failure','error'=>$modx->lexicon('correct_end'))));
            }

            if ($start >= $end) {
                exit(json_encode(array('status'=>'failure','error'=>$modx->lexicon('correct_time'))));
            }

            if (!preg_match("/^[a-zA-Z0-9-_!?—:,.;'\"\p{Cyrillic}0-9\s\-]+$/u",$mesto) && !empty($mesto)) {
                exit(json_encode(array('status'=>'failure','error'=>$modx->lexicon('correct_mesto'))));
            }

            if (!preg_match("/^[a-zA-Z0-9-_!?—:,.;'\"\p{Cyrillic}0-9\s\-]+$/u",$prim) && !empty($prim)) {
                exit(json_encode(array('status'=>'failure','error'=>$modx->lexicon('correct_prim'))));
            }

        }

    }






    switch ($action) {
        case 'addEvent':
            $response = $DropCalendar->addEvent($title, $start, $end, $mesto, $prim, $className, $site, $calendarNumber);
            break;
        case 'updateEventFull':
            $response = $DropCalendar->updateEventFull($id, $title, $start, $end, $mesto, $prim, $className, $site);
            break;
        case 'updateEvent':
            $response = $DropCalendar->updateEvent($id, $title, $start, $end);
            break;
        case 'deleteEvent':
            $response = $DropCalendar->deleteEvent($id);
            break;
        default:
            $response = $DropCalendar->getEvents($calendar_id);
    }

    if (is_array($response)) {
        $response = $modx->toJSON($response);
    }

}

@session_write_close();
exit($response);