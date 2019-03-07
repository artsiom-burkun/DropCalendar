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

// bulma css and other css
$scriptProperties['useBulma'] ? $modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/bulma.css") : '';
$modx->regClientCSS($assetsUrl."components/dropcalendar/css/web/main.css");

// Build query
$c = $modx->newQuery('DropCalendarItem');
if ($scriptProperties['calendar'] !== '') {
    $c->where(array('calendar' => $scriptProperties['calendar']));
}
$items = $modx->getIterator('DropCalendarItem', $c);

// Iterate through items
$list = array();
/** @var DropCalendarItem $item */
foreach ($items as $item) {
    $list[] = $modx->getChunk($scriptProperties['row'], $item->toArray());
}

// Output
$output = implode($outputSeparator, $list);
if (!empty($toPlaceholder)) {
    // If using a placeholder, output nothing and set output to specified placeholder
    $modx->setPlaceholder($toPlaceholder, $output);
    return '';
}
$modx->setPlaceholder('tableRow', $output);
$output = $modx->getChunk($scriptProperties['outer']);

// By default just return output
return $output;