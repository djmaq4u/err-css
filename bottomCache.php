<?php
$cached = fopen($cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
// Väljundi saatmine brauserisse
ob_end_flush();
?>