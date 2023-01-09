<?php
//$modx->log(xPDO::LOG_LEVEL_ERROR,'Testing my custom hook.'.$this->config['submitVar']);
//error_log("hehehe".$_POST[$this->config['submitVar']], 0);

unset($_POST['sendRating']);

return true;  //<-- if you omit this or return false, your form won't validate