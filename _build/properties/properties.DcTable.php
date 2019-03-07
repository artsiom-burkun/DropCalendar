<?php

$properties = array();

$tmp = array(
    'row' => array(
        'type' => 'textfield',
        'value' => 'DcTableRow',
    ),
    'outer' => array(
        'type' => 'textfield',
        'value' => 'DcTableOuter',
    ),
    'calendar' => array(
        'type' => 'textfield',
        'value' => '',
    ),
    'useBulma' => array(
        'type' => 'combo-boolean',
        'value' => true,
    ),
);

foreach ($tmp as $k => $v) {
    $properties[] = array_merge(
        array(
            'name' => $k,
            'desc' => PKG_NAME_LOWER . '_prop_' . $k,
            'lexicon' => PKG_NAME_LOWER . ':properties',
        ), $v
    );
}

return $properties;