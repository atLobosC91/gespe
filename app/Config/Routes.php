<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Página Principal
$routes->get('/', 'Home::index');
$routes->get('/about_us', 'Home::about_us');
$routes->get('Home/service_project/(:num)', 'Home::service_project/$1');
$routes->get('project_detail/(:num)', 'Home::project_detail/$1');



//Entrar a la app
$routes->get('/login', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Rutas para cada dashboard
$routes->get('/gespe/gerente', 'Gespe::gerente');
$routes->get('/gespe/administrador', 'Gespe::administrador');
$routes->get('/gespe/supervisor', 'Gespe::supervisor');
$routes->get('/gespe/operativo/panelInicio', 'Gespe::panelInicio');
