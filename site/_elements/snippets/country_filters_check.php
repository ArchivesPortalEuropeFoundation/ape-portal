<?php
/**
 * Checks request for country filters and returns a placeholder with ones checked 
 */

 $c = [];

 if(!empty($_GET['countries'])) {
    foreach($_GET['countries'] as $country) {
        $c = explode(":", $country);
        $modx->setPlaceholder('c_'. $c[0], 'checked');
    }
 }