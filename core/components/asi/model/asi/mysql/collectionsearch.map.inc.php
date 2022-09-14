<?php
$xpdo_meta_map['CollectionSearch']= array (
  'package' => 'asi',
  'version' => '1.1',
  'table' => 'asi_collection_search',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'collection_id' => 0,
    'search_id' => 0,
    'created_at' => '0000-00-00 00:00:00',
    'priority' => 0,
  ),
  'fieldMeta' => 
  array (
    'collection_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => 0,
    ),
    'search_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => 0,
    ),
    'created_at' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'default' => '0000-00-00 00:00:00',
      'null' => true,
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
  'aggregates' => 
  array (
    'Collection' => 
    array (
      'class' => 'Collection',
      'local' => 'collection_id',
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
