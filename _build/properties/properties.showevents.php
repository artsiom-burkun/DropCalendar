<?php

$properties = array();

$tmp = array(
    'tpl' => array(
        'type' => 'textfield',
        'value' => 'eventsShowTpl',
    ),
    'popupWindow' => array(
        'type' => 'textfield',
        'value' => 'windowOuterTemplate',
    ),
    'locale' => array(
        'type' => 'textfield',
        'value' => 'ru',
    ),
    'calendarNumber' => array(
        'type' => 'numberfield',
        'value' => 1,
    ),
    'useJquery' => array(
        'type' => 'combo-boolean',
        'value' => true,
    ),
    'useJqueryUi' => array(
        'type' => 'combo-boolean',
        'value' => true,
    ),
    'useFullcalendar' => array(
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