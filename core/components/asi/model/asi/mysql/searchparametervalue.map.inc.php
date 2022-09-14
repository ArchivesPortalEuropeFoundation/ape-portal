<?php
$xpdo_meta_map['SearchParameterValue']= array (
  'package' => 'asi',
  'version' => '1.1',
  'table' => 'asi_search_parameter_value',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'p_setting' => '',
    'parameter_value_id' => 0,
    'search_id' => 0,
  ),
  'fieldMeta' => 
  array (
    'p_setting' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'parameter_value_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '7',
      'phptype' => 'int',
      'null' => false,
      'default' => 0,
    ),
    'search_id' => 
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
    'ParameterCalue' => 
    array (
      'class' => 'ParameterValue',
      'local' => 'parameter_value_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Search' => 
    array (
      'class' => 'Search',
      'local' => 'search_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
