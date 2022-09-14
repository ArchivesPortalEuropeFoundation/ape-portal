<?php
$xpdo_meta_map['ParameterValue']= array (
  'package' => 'asi',
  'version' => '1.1',
  'table' => 'asi_parameter_value',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'site_value' => '',
    'ape_value' => '',
    'site_name' => '',
    'ape_name' => '',
    'p_type' => 0,
    'priority' => 0,
    'parameter_id' => 0,
  ),
  'fieldMeta' => 
  array (
    'site_value' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'ape_value' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
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
    'parameter_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '7',
      'phptype' => 'int',
      'null' => false,
      'default' => 0,
    ),
  ),
  'aggregates' => 
  array (
    'Parameter' => 
    array (
      'class' => 'Parameter',
      'local' => 'parameter_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
