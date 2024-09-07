<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Página Principal
$routes->get('/', 'Home::index');
$routes->get('/about_us', 'Home::about_us');
$routes->get('/services', 'Home::services');
$routes->get('/project', 'Home::project');
$routes->get('/proyecto/detalle_proyecto', 'Home::project');
/* $routes->get('services/(:num)', 'Servicio::/$1'); */
/* $routes->get('/services', 'ServicioController::index'); */



//Entrar a la app
$routes->get('gespe', 'LoginController::index');
$routes->get('usuarios', 'UsuarioController::index');
$routes->get('usuarios/crear', 'UsuarioController::crear');
$routes->post('usuarios/guardar', 'UsuarioController::guardar');
$routes->get('login', 'LoginController::index');
$routes->post('login/login', 'LoginController::login');


//Dashboard respecto a rol
/* $routes->get('/gespe/administrador', 'DashboardController::administrador');
$routes->get('/gespe/supervisor', 'DashboardController::supervisor');
$routes->get('/gespe/operativo', 'DashboardController::operativo');
$routes->get('/gespe/gerente', 'DashboardController::gerente'); */
