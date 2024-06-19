<?php
// config.php

define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/Web-Project/');
define('UPLOAD_DIR', ROOT_DIR . 'Admin/uploads/');

// Ensure the directory exists
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0777, true);
}
?>
