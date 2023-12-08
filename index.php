<?php

require __DIR__ . "/vendor/autoload.php";

use App\http\Request;
use App\http\Response;
use App\http\Router;
use App\utils\Log;
use App\controller\HomeController;

define("URL","https://http://127.0.0.1:8000");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$router = new Router(URL);

// Rota inicial
$router->get('/', [function(){
    return new Response(200, HomeController::index());
}]);

$router->run()->sendResponse();

?>