<?php
$assetsUrl = $modx->config['assets_url'];
$scriptProperties['useFullcalendar'] ? $modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/fullcalendar.min.css") : '';
$scriptProperties['useBootstrap'] ? $modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/bootstrap.min.css") : '';
$scriptProperties['useBootstrap'] ? $modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/bootstrap-theme.css") : '';
$modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/main0000.css");


$scriptProperties['useFullcalendar'] ? $modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/moment.min.js") : '';         // <!-- Moment 2.18.1         -->
$scriptProperties['useJquery'] ? $modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/jquery.min.js") : '';         // <!-- jQuery v3.2.1         -->

$scriptProperties['useJqueryUi'] ? $modx->regClientScript($assetsUrl."components/dropcalendar/js/web/jquery-ui.min.js") : '';      // <!-- jQuery UI 1.12.1      -->
$scriptProperties['useFullcalendar'] ? $modx->regClientScript($assetsUrl."components/dropcalendar/js/web/fullcalendar.min.js") : '';   // <!-- Fullcalendar v3.4.0   -->
$scriptProperties['useBootstrap'] ? $modx->regClientScript($assetsUrl."components/dropcalendar/js/web/bootstrap.min.js") : '';      // <!-- Bootstrap v3.3.7      -->
$modx->regClientScript($assetsUrl."components/dropcalendar/js/web/locale/".$scriptProperties['locale'].".js");          // <!-- Русский язык      -->
$modx->regClientScript($assetsUrl."components/dropcalendar/js/web/jquery.ui.touch-punch.min.js");

$createForm = $modx->getChunk('DcwCreate');
$createForm = trim(preg_replace('/\s\s+/', ' ', $createForm));
$modx->setPlaceholder('windowCreate', $createForm);

$updateForm = $modx->getChunk('DcwUpdate');
$updateForm = trim(preg_replace('/\s\s+/', ' ', $updateForm));
$modx->setPlaceholder('windowUpdate', $updateForm);


$modx->setPlaceholder('calendarNumber', $scriptProperties['calendarNumber']);

$output .= $modx->getChunk($scriptProperties['tpl']);
$output .= $modx->getChunk($scriptProperties['popupWindow']);
return $output;