<?php return array (
  '4ff639138e900dbde1da0c1bfc553d1b' => 
  array (
    'criteria' => 
    array (
      'name' => 'clientconfig',
    ),
    'object' => 
    array (
      'name' => 'clientconfig',
      'path' => '{core_path}components/clientconfig/',
      'assets_path' => '{assets_path}components/clientconfig/',
    ),
  ),
  'e78f2f5c379be041ec3894fd8ad9b9a5' => 
  array (
    'criteria' => 
    array (
      'key' => 'clientconfig.admin_groups',
    ),
    'object' => 
    array (
      'key' => 'clientconfig.admin_groups',
      'value' => 'Administrator',
      'xtype' => 'textfield',
      'namespace' => 'clientconfig',
      'area' => 'Default',
      'editedon' => NULL,
    ),
  ),
  'a4bbe60eb82fadefd211f719554ab81d' => 
  array (
    'criteria' => 
    array (
      'key' => 'clientconfig.clear_cache',
    ),
    'object' => 
    array (
      'key' => 'clientconfig.clear_cache',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'clientconfig',
      'area' => 'Default',
      'editedon' => NULL,
    ),
  ),
  '7d6cf9fe0fb982bb291ddf8990b71882' => 
  array (
    'criteria' => 
    array (
      'key' => 'clientconfig.vertical_tabs',
    ),
    'object' => 
    array (
      'key' => 'clientconfig.vertical_tabs',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'clientconfig',
      'area' => 'Default',
      'editedon' => NULL,
    ),
  ),
  '7554630b3b6787ba6842d56bf12a045f' => 
  array (
    'criteria' => 
    array (
      'key' => 'clientconfig.context_aware',
    ),
    'object' => 
    array (
      'key' => 'clientconfig.context_aware',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'clientconfig',
      'area' => 'Default',
      'editedon' => NULL,
    ),
  ),
  'd67ea80331e34c2d73cd7647f5ea6a41' => 
  array (
    'criteria' => 
    array (
      'key' => 'clientconfig.google_fonts_api_key',
    ),
    'object' => 
    array (
      'key' => 'clientconfig.google_fonts_api_key',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'clientconfig',
      'area' => 'Default',
      'editedon' => NULL,
    ),
  ),
  '20f54e75f0d9d17be1c00f6a84d29eba' => 
  array (
    'criteria' => 
    array (
      'name' => 'ClientConfig_ConfigChange',
    ),
    'object' => 
    array (
      'name' => 'ClientConfig_ConfigChange',
      'service' => 6,
      'groupname' => 'clientconfig',
    ),
  ),
  '052c5d908b6224426443c4b7d5296ed7' => 
  array (
    'criteria' => 
    array (
      'name' => 'ClientConfig',
    ),
    'object' => 
    array (
      'id' => 20,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ClientConfig',
      'description' => 'Sets system settings from the Client Config CMP.',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/**
 * ClientConfig
 *
 * Copyright 2011-2014 by Mark Hamstra <hello@markhamstra.com>
 *
 * ClientConfig is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * ClientConfig is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * ClientConfig; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package clientconfig
 *
 * @var modX $modx
 * @var int $id
 * @var string $mode
 * @var modResource $resource
 * @var modTemplate $template
 * @var modTemplateVar $tv
 * @var modChunk $chunk
 * @var modSnippet $snippet
 * @var modPlugin $plugin
*/

$eventName = $modx->event->name;

switch($eventName) {
    case \'OnMODXInit\':
    case \'OnHandleRequest\':
        /* Grab the class */
        $path = $modx->getOption(\'clientconfig.core_path\', null, $modx->getOption(\'core_path\') . \'components/clientconfig/\');
        $path .= \'model/clientconfig/\';
        $clientConfig = $modx->getService(\'clientconfig\',\'ClientConfig\', $path);

        /* If we got the class (gotta be careful of failed migrations), grab settings and go! */
        if ($clientConfig instanceof ClientConfig) {
            $contextKey = $modx->context instanceof modContext ? $modx->context->get(\'key\') : \'web\';
            $settings = $clientConfig->getSettings($contextKey);

            /* Make settings available as [[++tags]] */
            $modx->setPlaceholders($settings, \'+\');

            /* Make settings available for $modx->getOption() */
            foreach ($settings as $key => $value) {
                $modx->setOption($key, $value);
            }
        }
        break;
}

return;',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * ClientConfig
 *
 * Copyright 2011-2014 by Mark Hamstra <hello@markhamstra.com>
 *
 * ClientConfig is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * ClientConfig is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * ClientConfig; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package clientconfig
 *
 * @var modX $modx
 * @var int $id
 * @var string $mode
 * @var modResource $resource
 * @var modTemplate $template
 * @var modTemplateVar $tv
 * @var modChunk $chunk
 * @var modSnippet $snippet
 * @var modPlugin $plugin
*/

$eventName = $modx->event->name;

switch($eventName) {
    case \'OnMODXInit\':
    case \'OnHandleRequest\':
        /* Grab the class */
        $path = $modx->getOption(\'clientconfig.core_path\', null, $modx->getOption(\'core_path\') . \'components/clientconfig/\');
        $path .= \'model/clientconfig/\';
        $clientConfig = $modx->getService(\'clientconfig\',\'ClientConfig\', $path);

        /* If we got the class (gotta be careful of failed migrations), grab settings and go! */
        if ($clientConfig instanceof ClientConfig) {
            $contextKey = $modx->context instanceof modContext ? $modx->context->get(\'key\') : \'web\';
            $settings = $clientConfig->getSettings($contextKey);

            /* Make settings available as [[++tags]] */
            $modx->setPlaceholders($settings, \'+\');

            /* Make settings available for $modx->getOption() */
            foreach ($settings as $key => $value) {
                $modx->setOption($key, $value);
            }
        }
        break;
}

return;',
    ),
  ),
  '29d540db6e01dd061573c35490d7588a' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 20,
      'event' => 'OnMODXInit',
    ),
    'object' => 
    array (
      'pluginid' => 20,
      'event' => 'OnMODXInit',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '837d186e659339f7961748aeb469ca6c' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 20,
      'event' => 'OnHandleRequest',
    ),
    'object' => 
    array (
      'pluginid' => 20,
      'event' => 'OnHandleRequest',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'ec5baf589a6fc6e1799249d13d59eacb' => 
  array (
    'criteria' => 
    array (
      'text' => 'clientconfig',
    ),
    'object' => 
    array (
      'text' => 'clientconfig',
      'parent' => 'components',
      'action' => 'home',
      'description' => 'clientconfig.desc',
      'icon' => '',
      'menuindex' => 0,
      'params' => '',
      'handler' => '',
      'permissions' => '',
      'namespace' => 'clientconfig',
    ),
  ),
  '6fff374db415c58737e37170e35587a1' => 
  array (
    'criteria' => 
    array (
      'category' => 'ClientConfig',
    ),
    'object' => 
    array (
      'id' => 22,
      'parent' => 0,
      'category' => 'ClientConfig',
      'rank' => 0,
    ),
  ),
);