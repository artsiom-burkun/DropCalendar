<?php
$xpdo_meta_map['DropCalendarItem']= array (
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
    'site' => '',
    'calendar_id' => 0,
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
    'site' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => true,
      'default' => '',
    ),
    'calendar_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => true,
      'default' => 0,
    ),
  ),
);
