<?php

$properties = array();

$tmp = array(
    'tpl' => array(
        'type' => 'textfield',
        'value' => 'DcAdmin',
    ),
    'modal' => array(
        'type' => 'textfield',
        'value' => 'DcAdminModal',
    ),
    'locale' => array(
        'type' => 'textfield',
        'value' => 'ru',
    ),
    'calendar' => array(
        'type' => 'textfield',
        'value' => '',
    ),
    'useJquery' => array(
        'type' => 'combo-boolean',
        'value' => true,
    ),
    'useFullcalendar' => array(
        'type' => 'combo-boolean',
        'value' => true,
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