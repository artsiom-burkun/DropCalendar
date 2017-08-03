<?php
/** @var modX $modx */
/** @var array $sources */

$chunks = array();

$tmp = array(
    'DcEvManage' => array(
        'file' => 'eventsmanagement',
        'description' => '',
    ),
    'DcEvShow' => array(
        'file' => 'eventsshow',
        'description' => '',
    ),
    'DcwOuter' => array(
        'file' => 'windowouter',
        'description' => '',
    ),
    'DcwCreate' => array(
        'file' => 'windowcreate',
        'description' => '',
    ),
    'DcwShow' => array(
        'file' => 'windowshow',
        'description' => '',
    ),
    'DcwUpdate' => array(
        'file' => 'windowupdate',
        'description' => '',
    ),
    'DcTableOuter' => array(
        'file' => 'tableouter',
        'description' => '',
    ),
    'DcTableRow' => array(
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