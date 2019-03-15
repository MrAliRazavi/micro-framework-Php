<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once "bootstrap\Constans.php";
require_once __DIR__.DIRECTORY_SEPARATOR."autloder.php";

\App\Services\Router\Router::start();