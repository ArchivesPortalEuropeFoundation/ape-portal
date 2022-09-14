function createElement($element, $directory, $extension, $content, $name) {
    global $modx;
    $url = 'site/_elements/';

    if ($element->get('category') != 0) {
        $category = $modx->getObject('modCategory', $element->get('category'));
        $cat_name = $category->get('category');
        $fileName = $url . $directory . '/' . $cat_name . '/' . $element->get($name) . $extension;

        if (!file_exists(MODX_BASE_PATH . $url . $directory . '/' . $cat_name)) {
            mkdir(MODX_BASE_PATH . $url . $directory . '/' . $cat_name, 0777, true);
        }
    } else {
        $fileName = $url . $directory . '/' . $element->get($name) . $extension;
    }

    if (file_put_contents(MODX_BASE_PATH . $fileName, $element->get($content)) !== false) {
        $element->set('static_file', $fileName);
        $element->set('static', 1);
        $element->set('source', 1);
        $element->save();
        echo "<p>File created (" . basename($fileName) . ")</p>";
    } else {
        echo "<p>Cannot create file (" . basename($fileName) . ")</p>";
    }
}

echo "<h4>Chunks</h4>";
foreach ($modx->getCollection('modChunk', array('static' => 0)) as $x) {
    createElement($x, 'chunks', '.tpl', 'snippet', 'name');
}

echo "<h4>Templates</h4>";
foreach ($modx->getCollection('modTemplate', array('static' => 0)) as $x) {
    createElement($x, 'templates', '.tpl', 'content', 'templatename');
}

echo "<h4>Snippets</h4>";
foreach ($modx->getCollection('modSnippet', array('static' => 0)) as $x) {
    createElement($x, 'snippets', '.php', 'snippet', 'name');
}