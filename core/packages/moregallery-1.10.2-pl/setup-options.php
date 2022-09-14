<?php

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:

        $output = [];

        $output[] = '<b>Data Sharing Preference</b>';
        $output[] = 'To help understand how MoreGallery is used, information about your configuration is shared with modmore. <a href="https://docs.modmore.com/en/MoreGallery/v1.x/Data_Sharing.html" target="_blank" rel="noopener noreferer">You can learn more about how this data is used and what values are supported here.</a> Please choose your preference; you can change this at any time via the <code>moregallery.data_consent</code> system setting';

        $selectOptions = [
            '0' => 'Version number and consent level',
            '5' => 'Count of resources and basic configuration',
            '7' => 'Count of images by type (image/Vimeo/YouTube)',
            '10' => 'Per-resource overrides for crops and custom fields',
            '12' => 'source_relative_url setting',
            '15' => 'Per-resource overrides for source_relative_url'
        ];
        $current = (string)$modx->getOption('moregallery.data_consent', null, '10', true);
        $selectMarkup = '<select name="data_consent">';
        foreach ($selectOptions as $level => $desc) {
            $active = $current === (string)$level ? 'selected="selected"' : '';
            $selectMarkup .= '<option value="' . $level . '" ' . $active . '>[' . $level . '] ' . $desc . '</option>';
        }
        $output[] = $selectMarkup;

        $output = implode('<br>', $output);
    break;
    default:
    case xPDOTransport::ACTION_UNINSTALL:
        $output = '';
    break;
}

return $output;
