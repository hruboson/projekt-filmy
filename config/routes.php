<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder; // needed for scopes

$routes->setRouteClass(DashedRoute::class);

$routes->connect('/', ['controller' => 'Main', 'action' => 'index'],);

$routes->scope('/filmy', function (RouteBuilder $routes){

   $routes->connect('/', ['controller' => 'Filmy', 'action' => 'index']);
   $routes->connect('/{id}', ['controller' => 'Filmy', 'action' => 'film'], ['pass' => ['id']]);
   $routes->connect('/edit/{id}', ['controller' => 'Filmy', 'action' => 'edit'], ['pass' => ['id']]);
   $routes->connect('/delete/{id}', ['controller' => 'Filmy', 'action' => 'delete'], ['pass' => ['id']]);
   $routes->connect('/update_jazyky/{id}', ['controller' => 'Filmy', 'action' => 'updateJazyky'], ['pass' => ['id']]);

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
   $routes->connect('/user/{id}', ['controller' => 'Users', 'action' => 'edit'], ['pass' => ['id']]);
   $routes->connect('/delete/{id}', ['controller' => 'Users', 'action' => 'delete'], ['pass' => ['id']]);

});

?>