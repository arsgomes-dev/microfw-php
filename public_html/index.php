<?php require $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

use Microfw\Src\Routing\Router\Request;

$request = new Request;
$router->resolve($request);


