$data = array(
    'limit'     => $wordCount,
    'words'     => str_word_count($content),
    'content'   => $content,
    'preview'   => ''
);

if (str_word_count($data['content'], 0) > $data['limit']) {
    $words = str_word_count($data['content'], 2);
    $pos = array_keys($words);
    
    $data['preview'] = substr($data['content'], 0, $pos[$data['limit']]) . '...';
}

$modx->setPlaceholders($data, 'rm_' . $unique_id . '.');