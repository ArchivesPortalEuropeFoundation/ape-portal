<?php
if($modx->getPlaceholder("userExtFields.old_user") == 1) {
    return $modx->getOption("welcome_text_prior");
}

return $modx->getOption("welcome_text_new");