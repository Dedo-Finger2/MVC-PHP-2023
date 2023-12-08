<?php

require __DIR__ . "/vendor/autoload.php";

use App\utils\View;
use App\http\Router;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# Capturando o arquivo ENV do projeto
$env = require('app/config/env.php');

# Define valor padrão das variáveis
View::init([
    "URL" => $env['URL'],
]);


$router = new Router($env['URL']);

include __DIR__ .'/routes/web.php';

if ($router->run() != null) $router->run()->sendResponse();

?>