<?php

require __DIR__ . "/vendor/autoload.php";

use App\http\Router;

define("URL","https://http://127.0.0.1:8000");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$router = new Router(URL);

include __DIR__ .'/routes/web.php';

$router->run()->sendResponse();

?>