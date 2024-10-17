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


$routes->get('gespe/perfil/mi_perfil', 'SolicitudController::mi_perfil');
$routes->post('gespe/perfil/actualizarPerfil', 'SolicitudController::actualizarPerfil');


$routes->get('gespe/solicitud/solicitudesDerivadas', 'SolicitudController::solicitudesDerivadas');
$routes->get('solicitud/aprobar/(:num)', 'SolicitudController::aprobarSolicitud/$1');
$routes->get('solicitud/rechazar/(:num)', 'SolicitudController::rechazarSolicitud/$1');


$routes->get('gespe/solicitud/detalles/(:num)', 'SolicitudController::obtenerDetallesPermiso/$1');
$routes->get('gespe/solicitud/detalleSolicitudesDerivada/(:num)', 'SolicitudController::obtenerDetalleSolicitudDerivada/$1');


$routes->get('gespe/usuarios/nomina', 'UsuarioController::nomina');
$routes->get('gespe/usuarios/nuevoUsuario', 'UsuarioController::nuevoUsuario');
$routes->post('gespe/usuarios/crearUsuario', 'UsuarioController::crearUsuario');
$routes->get('gespe/usuarios/detalleUsuario/(:num)', 'UsuarioController::detalleUsuario/$1');
$routes->post('gespe/usuarios/actualizarUsuario/(:num)', 'UsuarioController::actualizar/$1');

$routes->get('gespe/kpi/kpi', 'KPIController::index');

$routes->get('gespe/solicitud/derivarSolicitud/(:num)', 'SolicitudController::derivarSolicitud/$1');
$routes->post('gespe/solicitud/procesarDerivacion', 'SolicitudController::procesarDerivacion');
