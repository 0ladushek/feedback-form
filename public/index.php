<?php
error_reporting(E_ALL);
require_once __DIR__ . '/../protected/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', $uri);

$controllerName = ucfirst($parts[1]) ?: 'Form';

$controllerName = '\\App\\Controllers\\' . $controllerName;
$actionName = @$parts[2] ?: 'index';


$controller = new $controllerName;

try {
    $controller->action($actionName);
}

catch (Throwable $e) {
    echo $e->getMessage();
}