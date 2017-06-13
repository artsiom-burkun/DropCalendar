<?php
$xpdo_meta_map['dropCalendarItem']= array (
  'package' => 'dropcalendar',
  'version' => '1.1',
  'table' => 'dropcalendar_items',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'title' => '',
    'start' => NULL,
    'end' => NULL,
    'mesto' => '',
    'prim' => '',
    'className' => '',
    'active' => 1,
  ),
  'fieldMeta' => 
  array (
    'title' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'text',
      'null' => false,
      'default' => '',
    ),
    'start' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
    ),
    'end' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
    ),
    'mesto' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => true,
      'default' => '',
    ),
    'prim' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => true,
      'default' => '',
    ),
    'className' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => true,
      'default' => '',
    ),
    'active' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'attributes' => 'unsigned',
      'null' => true,
      'default' => 1,
    ),
  ),
);
