<?php
$xpdo_meta_map['DropCalendarItem']= array (
  'package' => 'dropcalendar',
  'version' => '1.1',
  'table' => 'dropcalendar_items',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'title' => '',
    'calendar' => '',
    'allDay' => 0,
    'start' => NULL,
    'end' => NULL,
    'info' => '',
    'backgroundColor' => '',
    'borderColor' => '',
    'textColor' => '',
  ),
  'fieldMeta' => 
  array (
    'title' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'calendar' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'allDay' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => true,
      'default' => 0,
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
    'info' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'backgroundColor' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'borderColor' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'textColor' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
  ),
);
