<?php
$assetsUrl = $modx->config['assets_url'];

// bulma css and other css
$scriptProperties['useBulma'] ? $modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/bulma.css") : '';
$modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/main.css");

// jquery scripts
$scriptProperties['useFullcalendar'] ? $modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/moment.min.js") : '';
$scriptProperties['useJquery'] ? $modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/jquery.min.js") : '';
$scriptProperties['useJquery'] ? $modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/jquery-ui.min.js") : '';

// timepicker helper and scripts for mobile device
$modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/jquery.timepicker.min.js");
$modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/jquery.ui.touch-punch.min.js");

// fullcalendar scripts and css
$scriptProperties['useFullcalendar'] ? $modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/fullcalendar.css") : '';
//$scriptProperties['useFullcalendar'] ? $modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/fullcalendar.print.min.css") : '';
$scriptProperties['useFullcalendar'] ? $modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/fullcalendar.min.js") : '';

// language file
$modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/locale/".$scriptProperties['locale'].".js");

$modx->setPlaceholder('calendar', $scriptProperties['calendar']);

$output .= $modx->getChunk($scriptProperties['tpl']);
$output .= $modx->getChunk($scriptProperties['modal']);
return $output;