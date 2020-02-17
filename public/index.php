<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define ('ROOT', dirname(__FILE__ , 2));

require_once(ROOT.'/app/components/Router.php');

require_once(ROOT.'/app/components/autoload.php');

//require_once 'vendor/autoload.php';

$router = new Router();
$router->run();
