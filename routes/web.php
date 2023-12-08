<?php 

use App\controller\ProductController;
use App\http\Response;
use App\controller\HomeController;

// Rota inicial
$router->get('/', [function(){
    return new Response(200, HomeController::index());
}]);

$router->get('/about', [function(){
    return new Response(200, HomeController::about());
}]);

$router->get('/product/{id}', [function(int $id){
    return new Response(200, ProductController::products($id));
}]);
