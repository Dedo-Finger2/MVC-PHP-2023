<?php

require __DIR__ . "/vendor/autoload.php";

use App\http\Request;
use App\http\Response;
use App\utils\Log;
use App\controller\HomeController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$teste = new Response(200, "Ola");

$teste->sendResponse();

exit;

echo HomeController::index();

?>