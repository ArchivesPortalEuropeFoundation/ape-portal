if(isset($_GET['id'])) {
    return "/download-pdf?resource=" . htmlspecialchars($_GET['id']);
}
return null;