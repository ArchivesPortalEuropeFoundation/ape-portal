<?php
$xpdo_meta_map['Parameter']= array (
  'package' => 'asi',
  'version' => '1.1',
  'table' => 'asi_parameter',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'site_name' => '',
    'ape_name' => '',
    'p_type' => 0,
    'priority' => 0,
  ),
  'fieldMeta' => 
  array (
    'site_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'ape_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'datetime',
      'null' => true,
      'default' => '',
    ),
    'p_type' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'phptype' => 'int',
      'null' => true,
      'default' => 0,
    ),
    'priority' => 
    array (
      'dbtype' => 'int',
      'precision' => '255',
      'phptype' => 'int',
      'null' => true,
      'default' => 0,
    ),
  ),
);
