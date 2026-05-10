<?php

if (!session_id()) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
// error_reporting(0);
// ini_set('display_errors', '0');
// ini_set('display_startup_errors', '0');

date_default_timezone_set("Asia/Makassar");

$baseDir = __DIR__ . '/../';
require_once $baseDir . 'app/Foundation/Application.php';
require_once $baseDir . 'app/app.php';
