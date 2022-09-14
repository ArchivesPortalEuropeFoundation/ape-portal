<?php
$xpdo_meta_map['mgTag']= array (
  'package' => 'moregallery',
  'version' => '1.1',
  'table' => 'moregallery_tag',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'display' => '',
    'createdon' => 0,
    'createdby' => 0,
  ),
  'fieldMeta' => 
  array (
    'display' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'createdon' => 
    array (
      'dbtype' => 'int',
      'precision' => '20',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'createdby' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'indexes' => 
  array (
    'display' => 
    array (
      'alias' => 'display',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'display' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'composites' => 
  array (
    'Images' => 
    array (
      'class' => 'mgImageTag',
      'local' => 'id',
      'foreign' => 'tag',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
