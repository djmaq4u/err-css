<?php
$url = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $url);
$file = $break[count($break) - 1];
$cachefile = 'cached-'.substr_replace($file ,"",-4).'.html';
// Cache eluiga sekundites
$cachetime = 30;

if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
    echo "<!-- Cache-itud koopia loodud ".date('H:i', filemtime($cachefile))." -->\n";
    include($cachefile);
    exit;
}
// Väljundpuhvri käivitamine
ob_start();
?>