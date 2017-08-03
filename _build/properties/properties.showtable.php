<?php

$properties = array();

$tmp = array(
    'tpl' => array(
        'type' => 'textfield',
        'value' => 'DcTableRow',
    ),
    'tplHead' => array(
        'type' => 'textfield',
        'value' => 'DcTableOuter',
    ),
    'calendarNumber' => array(
        'type' => 'numberfield',
        'value' => 0,
    ),
    'useJquery' => array(
        'type' => 'combo-boolean',
        'value' => true,
    ),
    'useBootstrap' => array(
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