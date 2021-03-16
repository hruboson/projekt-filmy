<?php

use Cake\Core\Plugin;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder; // needed for scopes

$routes->setRouteClass(DashedRoute::class);

$routes->connect('/', ['controller' => 'Main', 'action' => 'index'],);

$routes->scope('/filmy', function (RouteBuilder $routes){

   $routes->connect('/', ['controller' => 'Filmy', 'action' => 'index']);
   $routes->connect('/{id}', ['controller' => 'Filmy', 'action' => 'film'], ['pass' => ['id']]);

});

$routes->scope('/promitani', function (RouteBuilder $routes){

   $routes->connect('/', ['controller' => 'Promitani', 'action' => 'index']);
   $routes->connect('/{id}', ['controller' => 'Promitani', 'action' => 'promitani'], ['pass' => ['id']]);

});

$routes->scope('/users', function (RouteBuilder $routes){

   $routes->connect('/', ['controller' => 'Users', 'action' => 'index']);
   $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
   $routes->connect('/add', ['controller' => 'Users', 'action' => 'add']);
   $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);

});

?>