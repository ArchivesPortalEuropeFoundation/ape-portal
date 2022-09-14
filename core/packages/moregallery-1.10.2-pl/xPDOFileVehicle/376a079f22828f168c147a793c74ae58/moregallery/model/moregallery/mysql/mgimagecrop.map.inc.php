<?php
$xpdo_meta_map['mgImageCrop']= array (
  'package' => 'moregallery',
  'version' => '1.1',
  'table' => 'moregallery_image_crop',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'image' => 0,
    'crop' => NULL,
    'thumbnail' => '',
    'thumbnail_hash' => '',
    'x' => 0,
    'y' => 0,
    'x2' => 0,
    'y2' => 0,
    'width' => 0,
    'height' => 0,
  ),
  'fieldMeta' => 
  array (
    'image' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'crop' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
    ),
    'thumbnail' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
      'null' => false,
    ),
    'thumbnail_hash' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
      'null' => false,
    ),
    'x' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'default' => 0,
      'null' => false,
    ),
    'y' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'default' => 0,
      'null' => false,
    ),
    'x2' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'default' => 0,
      'null' => false,
    ),
    'y2' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'default' => 0,
      'null' => false,
    ),
    'width' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'default' => 0,
      'null' => false,
    ),
    'height' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'default' => 0,
      'null' => false,
    ),
  ),
  'indexes' => 
  array (
    'image' => 
    array (
      'alias' => 'image',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'image' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'crop' => 
    array (
      'alias' => 'crop',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'crop' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Image' => 
    array (
      'class' => 'mgImage',
      'local' => 'image',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
