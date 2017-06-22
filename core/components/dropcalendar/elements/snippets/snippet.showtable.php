<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var DropCalendar $DropCalendar */
if (!$DropCalendar = $modx->getService('dropcalendar', 'DropCalendar', $modx->getOption('dropcalendar_core_path', null,
        $modx->getOption('core_path') . 'components/dropcalendar/') . 'model/dropcalendar/', $scriptProperties)
) {
    return 'Could not load DropCalendar class!';
}


$assetsUrl = $modx->config['assets_url'];
$scriptProperties['useBootstrap'] ? $modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/bootstrap.min.css") : '';
$scriptProperties['useBootstrap'] ? $modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/bootstrap-theme.css") : '';

$scriptProperties['useJquery'] ? $modx->regClientStartupScript($assetsUrl."components/dropcalendar/js/web/jquery.min.js") : '';     // <!-- jQuery v3.2.1         -->
$scriptProperties['useBootstrap'] ? $modx->regClientScript($assetsUrl."components/dropcalendar/js/web/bootstrap.min.js") : '';      // <!-- Bootstrap v3.3.7      -->


// Build query
$c = $modx->newQuery('DropCalendarItem');
$items = $modx->getIterator('DropCalendarItem', $c);



// Iterate through items
$list = array();
/** @var DropCalendarItem $item */
foreach ($items as $item) {
    $list[] = $modx->getChunk($scriptProperties['tpl'], $item->toArray());
}

// Output
$output = $modx->getChunk($scriptProperties['tplHead']);

$output .= implode($outputSeparator, $list);
if (!empty($toPlaceholder)) {
    // If using a placeholder, output nothing and set output to specified placeholder
    $modx->setPlaceholder($toPlaceholder, $output);

    return '';
}

$output .= '</tbody></table>';



// By default just return output
return $output;