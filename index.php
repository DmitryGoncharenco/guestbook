<?php
require 'app/libs/Dev.php';
require 'app/libs/autoload.php';

use app\core\Router;

session_start();

$start = new Router;
$start->run();
?>
