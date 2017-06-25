<?php
/** @var modX $modx */
/** @var array $sources */

$chunks = array();

$tmp = array(
    'eventsManagementTpl' => array(
        'file' => 'eventsmanagement',
        'description' => '',
    ),
    'eventsShowTpl' => array(
        'file' => 'eventsshow',
        'description' => '',
    ),
    'windowOuterTemplate' => array(
        'file' => 'windowouter',
        'description' => '',
    ),
    'windowCreate' => array(
        'file' => 'windowcreate',
        'description' => '',
    ),
    'windowShow' => array(
        'file' => 'windowshow',
        'description' => '',
    ),
    'windowUpdate' => array(
        'file' => 'windowupdate',
        'description' => '',
    ),
    'tableOuter' => array(
        'file' => 'tableouter',
        'description' => '',
    ),
    'tableRow' => array(
        'file' => 'tablerow',
        'description' => '',
    ),
);

// Save chunks for setup options
$BUILD_CHUNKS = array();

foreach ($tmp as $k => $v) {
    /** @var modChunk $chunk */
    $chunk = $modx->newObject('modChunk');
    $chunk->fromArray(array(
        'id' => 0,
        'name' => $k,
        'description' => @$v['description'],
        'snippet' => file_get_contents($sources['source_core'] . '/elements/chunks/chunk.' . $v['file'] . '.tpl'),
        'static' => BUILD_CHUNK_STATIC,
        'source' => 1,
        'static_file' => 'core/components/' . PKG_NAME_LOWER . '/elements/chunks/chunk.' . $v['file'] . '.tpl',
    ), '', true, true);

    $chunks[] = $chunk;

    $BUILD_CHUNKS[$k] = file_get_contents($sources['source_core'] . '/elements/chunks/chunk.' . $v['file'] . '.tpl');
}
unset($tmp);

return $chunks;