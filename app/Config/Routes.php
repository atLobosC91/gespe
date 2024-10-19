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

// Entrar a la app
$routes->get('/login', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Rutas para el panel de inicio
$routes->get('/gespe/panelInicio', 'Gespe::panelInicio');

// Perfil de usuario
$routes->get('gespe/perfil/mi_perfil', 'PerfilController::mi_perfil');
$routes->post('gespe/perfil/actualizarPerfil', 'PerfilController::actualizarPerfil');

// Rutas de Usuarios
$routes->get('gespe/usuarios/nomina', 'UsuarioController::nomina');
$routes->get('gespe/usuarios/nuevoUsuario', 'UsuarioController::nuevoUsuario');
$routes->post('gespe/usuarios/crearUsuario', 'UsuarioController::crearUsuario');
$routes->get('gespe/usuarios/detalleUsuario/(:num)', 'UsuarioController::detalleUsuario/$1');
$routes->get('gespe/usuarios/modificarUsuario/(:num)', 'UsuarioController::modificarUsuario/$1');
$routes->post('gespe/usuarios/actualizarUsuario/(:num)', 'UsuarioController::actualizar/$1');  // Para actualizar el usuario modificado
$routes->get('gespe/usuarios/eliminarUsuario/(:num)', 'UsuarioController::eliminarUsuario/$1');

//Rutas Área
$routes->get('gespe/area/listaArea', 'AreaController::listaArea');
$routes->get('gespe/area/nuevaArea', 'AreaController::nuevaArea');
$routes->post('gespe/area/crearArea', 'AreaController::crearArea');
$routes->get('gespe/area/modificar/(:num)', 'AreaController::modificar/$1');
$routes->post('gespe/area/actualizar/(:num)', 'AreaController::actualizar/$1');
$routes->get('gespe/area/eliminar/(:num)', 'AreaController::eliminar/$1');


// Rutas de Solicitudes
$routes->get('gespe/solicitud/misSolicitudes', 'PermisoController::misSolicitudes');
$routes->get('gespe/solicitud/nuevaSolicitud', 'PermisoController::nuevaSolicitud');
$routes->post('gespe/solicitud/crearSolicitud', 'PermisoController::crearSolicitud');
$routes->get('gespe/solicitud/detalles/(:num)', 'PermisoController::obtenerDetallesPermiso/$1');

$routes->get('gespe/solicitud/descargarPDF/(:num)', 'PermisoController::descargarPDF/$1');



// Rutas de KPIs
$routes->get('gespe/kpi/kpi', 'KPIController::index');
