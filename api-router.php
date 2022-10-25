<?php
require_once './libs/Router.php';
require_once "./apps/controllers/ApiController.php";

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('movies', 'GET', 'ApiController', 'obtenerMovies');
$router->addRoute('movies', 'POST', 'ApiController', 'crearTarea');
$router->addRoute('movies/:ID', 'GET', 'ApiController', 'obtenerMovie');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
