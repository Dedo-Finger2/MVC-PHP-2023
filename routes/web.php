<?php 

use App\http\Request;
use App\http\Response;
use App\controller\HomeController;
use App\controller\ProductController;
use App\controller\CommentsController;

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

// Insert
$router->post('/comments', [function(Request $request){
    var_dump($request);
    exit;
    return new Response(200, CommentsController::comments());
}]);

// https://youtu.be/t6wrq3EopWI?t=1073