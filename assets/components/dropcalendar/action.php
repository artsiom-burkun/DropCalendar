<?php
define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    $modx->sendRedirect($modx->makeUrl($modx->getOption('site_start'), '', '', 'full'));
}
else {

    $action=$_POST['action'];

    $id=$_POST['id'];
    $title=$_POST['title'];
    $start=$_POST['start'];
    $end=$_POST['end'];
    $mesto=$_POST['mesto'];
    $prim=$_POST['prim'];
    $className=$_POST['className'];

    $site=$_POST['site'];
    isset($_POST['calendar_id']) ? $calendar_id = $_POST['calendar_id'] : $calendar_id = '0';


/** @var DropCalendar $DropCalendar */
$DropCalendar = $modx->getService('dropcalendar', 'DropCalendar', $modx->getOption('dropcalendar_core_path', null,
        $modx->getOption('core_path') . 'components/dropcalendar/') . 'model/dropcalendar/'
);
$modx->lexicon->load('dropcalendar:default');

switch ($action) {
    case 'addEvent':
        $response = $DropCalendar->addEvent($title, $start, $end, $mesto, $prim, $className, $site, $calendar_id);
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