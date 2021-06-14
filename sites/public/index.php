<?php
require __DIR__ . '/../init.php';

$pathInfo = $_SERVER['PATH_INFO'];


$routes = [
    '/' => [
        'controller' => 'indexController',
        'method' => 'index'
    ],
    '/routes' => [
        'controller' => 'routeController',
        'method' => 'routes'
    ],
    '/populate' => [
        'controller' => 'routeController',
        'method' => 'setupDatabase'
    ],
    '/setup' => [
        'controller' => 'setupController',
        'method' => 'setupDatabase'
    ]
];

if (isset($routes[$pathInfo])) {
    $route = $routes[$pathInfo];
    $controller = $container->make($route['controller']);
    $method = $route['method'];
    $controller->$method();
}