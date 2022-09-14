<?php
$xpdo_meta_map['CollectionBookmark']= array (
  'package' => 'asi',
  'version' => '1.1',
  'table' => 'asi_collection_bookmark',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'collection_id' => 0,
    'bookmark_id' => 0,
    'created_at' => NULL,
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
    'bookmark_id' => 
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
    'Bookmark' => 
    array (
      'class' => 'Bookmark',
      'local' => 'bookmark_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
