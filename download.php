<?php
$filename = 'webhook.log';

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');

readfile($filename);
?>
