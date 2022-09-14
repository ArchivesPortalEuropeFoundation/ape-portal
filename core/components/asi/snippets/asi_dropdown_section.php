<?php
// checks if content present and returns chunk (eq filter not working properly)

echo "<h1>strlen is ".strlen($content)." </h1>";
echo "<h1>len is : (".$len.")</h1>";


if($len !== 0){
    return $modx->getChunk("asi_dropdown_section", array(
        "title" => $title,
        "content" => $content,
    ));
}
return null;