<?php
$xpdo_meta_map['mgResource']= array (
  'package' => 'moregallery',
  'version' => '1.1',
  'extends' => 'modResource',
  'fields' => 
  array (
  ),
  'fieldMeta' => 
  array (
  ),
  'composites' => 
  array (
    'Images' => 
    array (
      'class' => 'mgImage',
      'local' => 'id',
      'foreign' => 'resource',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
