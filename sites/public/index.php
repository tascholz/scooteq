<?php
require __DIR__ . '/../init.php';

$pathInfo = $_SERVER['PATH_INFO'];


$routes = [
    '/' => [
        'controller' => 'routeController',
        'method' => 'index'
    ],
    '/routes' => [
        'controller' => 'routeController',
        'method' => 'routes'
    ]
];

if (isset($routes[$pathInfo])) {
    $route = $routes[$pathInfo];
    $controller = $container->make($route['controller']);
    $method = $route['method'];
    $controller->$method();
}