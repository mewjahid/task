<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require (ROOT. '/components/Router.php');
require (ROOT. '/components/Db.php');

session_start();

$router = new Router();
$router->run();