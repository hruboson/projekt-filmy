<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder; // needed for scopes

$routes->setRouteClass(DashedRoute::class);

$routes->connect('/', ['controller' => 'Main', 'action' => 'index'],);

$routes->scope('/filmy', function (RouteBuilder $routes){

   $routes->connect('/', ['controller' => 'Filmy', 'action' => 'index']);
   $routes->connect('/{id}', ['controller' => 'Filmy', 'action' => 'film'], ['pass' => ['id']]);
   $routes->connect('/add', ['controller' => 'Filmy', 'action' => 'add']);
   $routes->connect('/edit/{id}', ['controller' => 'Filmy', 'action' => 'edit'], ['pass' => ['id']]);
   $routes->connect('/delete/{id}', ['controller' => 'Filmy', 'action' => 'delete'], ['pass' => ['id']]);

   // jazyky
   $routes->connect('/update_jazyky/{id}', ['controller' => 'Filmy', 'action' => 'updateJazyky'], ['pass' => ['id']]);
   $routes->connect('/add_jazyky/{id}', ['controller' => 'Filmy', 'action' => 'addJazyk'], ['pass' => ['id']]);
   $routes->connect('/remove_jazyk/{id}', ['controller' => 'Filmy', 'action' => 'removeJazyk'], ['pass' => ['id']]);

   // herci
   $routes->connect('/update_herci/{id}', ['controller' => 'Filmy', 'action' => 'updateHerci'], ['pass' => ['id']]);
   $routes->connect('/add_herec/{id}', ['controller' => 'Filmy', 'action' => 'addHerec'], ['pass' => ['id']]);
   $routes->connect('/remove_herec/{id}', ['controller' => 'Filmy', 'action' => 'removeHerec'], ['pass' => ['id']]);
   
   // zeme
   $routes->connect('/add_zeme/{id}', ['controller' => 'Filmy', 'action' => 'addZeme'], ['pass' => ['id']]);
   $routes->connect('/remove_zeme/{id}', ['controller' => 'Filmy', 'action' => 'removeZeme'], ['pass' => ['id']]);

});

$routes->scope('/promitani', function (RouteBuilder $routes){

   $routes->connect('/', ['controller' => 'Promitani', 'action' => 'index']);
   $routes->connect('/{id}', ['controller' => 'Promitani', 'action' => 'promitani'], ['pass' => ['id']]);
   $routes->connect('/add', ['controller' => 'Promitani', 'action' => 'add']);
   $routes->connect('/edit/{id}', ['controller' => 'Promitani', 'action' => 'edit'], ['pass' => ['id']]);
   $routes->connect('/delete/{id}', ['controller' => 'Promitani', 'action' => 'delete'], ['pass' => ['id']]);
   $routes->connect('/buy/{id}', ['controller' => 'Promitani', 'action' => 'buy'], ['pass' => ['id']]);

});

$routes->scope('/herci', function (RouteBuilder $routes){

   $routes->connect('/', ['controller' => 'Herci', 'action' => 'index']);
   $routes->connect('/edit/{id}', ['controller' => 'Herci', 'action' => 'edit'], ['pass' => ['id']]);
   $routes->connect('/delete/{id}', ['controller' => 'Herci', 'action' => 'delete'], ['pass' => ['id']]);
   $routes->connect('/add', ['controller' => 'Herci', 'action' => 'add']);

});

$routes->scope('/saly', function (RouteBuilder $routes){

   $routes->connect('/', ['controller' => 'Saly', 'action' => 'index']);
   $routes->connect('/add', ['controller' => 'Saly', 'action' => 'add']);
   $routes->connect('/edit/{id}', ['controller' => 'Saly', 'action' => 'edit'], ['pass' => ['id']]);
   $routes->connect('/delete/{id}', ['controller' => 'Saly', 'action' => 'delete'], ['pass' => ['id']]);

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