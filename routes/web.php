<?php 

use App\http\Response;
use App\controller\HomeController;

// Rota inicial
$router->get('/', [function(){
    return new Response(200, HomeController::index());
}]);

$router->get('/about', [function(){
    return new Response(200, HomeController::about());
}]);
