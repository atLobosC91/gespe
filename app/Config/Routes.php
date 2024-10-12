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

// Rutas para el panel de inicio
$routes->get('/gespe/panelInicio', 'Gespe::panelInicio');


//Rutas de Solicitudes
$routes->get('gespe/solicitud/misSolicitudes', 'SolicitudController::misPermisos');

$routes->get('gespe/solicitud/detalles/(:num)', 'SolicitudController::obtenerDetallesPermiso/$1');

$routes->get('gespe/solicitud/nuevaSolicitud', 'SolicitudController::nuevaSolicitud');
$routes->post('gespe/solicitud/crearSolicitud', 'SolicitudController::crearSolicitud');
