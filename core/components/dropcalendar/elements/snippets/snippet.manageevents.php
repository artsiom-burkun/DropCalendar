<?php
$modx->regClientCSS($modx->config['assets_url']."components/dropcalendar/css/web/fullcalendar.min.css");
$modx->regClientCSS($modx->config['assets_url']."components/dropcalendar/css/web/bootstrap.min.css");
$modx->regClientCSS($modx->config['assets_url']."components/dropcalendar/css/web/bootstrap-theme.css");
$modx->regClientCSS($modx->config['assets_url']."components/dropcalendar/css/web/main0000.css");


$modx->regClientStartupScript($modx->config['assets_url']."components/dropcalendar/js/web/moment.min.js");         // <!-- Moment 2.18.1         -->
$modx->regClientStartupScript($modx->config['assets_url']."components/dropcalendar/js/web/jquery.min.js");         // <!-- jQuery v3.2.1         -->

$modx->regClientScript($modx->config['assets_url']."components/dropcalendar/js/web/jquery-ui.min.js");      // <!-- jQuery UI 1.12.1      -->
$modx->regClientScript($modx->config['assets_url']."components/dropcalendar/js/web/fullcalendar.min.js");   // <!-- Fullcalendar v3.4.0   -->
$modx->regClientScript($modx->config['assets_url']."components/dropcalendar/js/web/bootstrap.min.js");      // <!-- Bootstrap v3.3.7      -->
$modx->regClientScript($modx->config['assets_url']."components/dropcalendar/js/web/locale/ru.js");          //


$output = $modx->getChunk($scriptProperties['eventsManagementTpl']);
$output .= $modx->getChunk($scriptProperties['eventsWindowPopup']);
return $output;