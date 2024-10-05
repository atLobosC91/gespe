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


$routes->get('/gespe/administrador/gestionarUsuarios', 'Gespe::gestionarUsuarios');


// Rutas para la gestión de permisos
$routes->get('/permisos_adm', 'PermisoController::index');
$routes->get('/permiso_nuevo', 'PermisoController::nuevo');
$routes->post('/permisos/crear', 'PermisoController::crear');
$routes->get('/permisos/aceptar/(:num)', 'PermisoController::aceptar/$1');
$routes->get('/permisos/rechazar/(:num)', 'PermisoController::rechazar/$1');

// Rutas para la gestión de usuarios
$routes->get('/nomina', 'UsuariosController::nomina');
$routes->get('/usuarios/editar/(:num)', 'UsuariosController::editar/$1');
$routes->post('/usuarios/actualizar/(:num)', 'UsuariosController::actualizar/$1');
$routes->get('/usuarios/eliminar/(:num)', 'UsuariosController::eliminar/$1');
$routes->get('/usuarios/nuevo', 'UsuariosController::nuevo');
$routes->post('/usuarios/crear', 'UsuariosController::crear');

// Rutas para la gestión de servicios
$routes->get('/servicios', 'ServicioController::index');
$routes->get('/servicios/nuevo', 'ServicioController::nuevo');
$routes->post('/servicios/crear', 'ServicioController::crear');
$routes->get('/servicios/editar/(:num)', 'ServicioController::editar/$1');
$routes->post('/servicios/actualizar/(:num)', 'ServicioController::actualizar/$1');
$routes->get('/servicios/eliminar/(:num)', 'ServicioController::eliminar/$1');

// Rutas para la gestión de proyectos
$routes->get('/proyectos', 'ProyectoController::index');
$routes->get('/proyectos/nuevo', 'ProyectoController::nuevo');
$routes->post('/proyectos/crear', 'ProyectoController::crear');
$routes->get('/proyectos/editar/(:num)', 'ProyectoController::editar/$1');
$routes->post('/proyectos/actualizar/(:num)', 'ProyectoController::actualizar/$1');
$routes->get('/proyectos/eliminar/(:num)', 'ProyectoController::eliminar/$1');

// Rutas para la gestión de clientes
$routes->get('/clientes', 'ClienteController::index');
$routes->get('/clientes', 'ClienteController::nuevo');
$routes->post('/clientes', 'ClienteController::crear');
$routes->get('/clientes/(:num)', 'ClienteController::editar/$1');
$routes->post('/clientes/(:num)', 'ClienteController::actualizar/$1');
$routes->get('/clientes/(:num)', 'ClienteController::eliminar/$1');

// Rutas para el dashboard de KPIs
$routes->get('/kpi', 'KPIController::index');
