//Are we paging?
if ($_GET['page'] != '') {
    $modx->setPlaceholder('page',  $_GET['page']);
}