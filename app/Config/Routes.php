<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LoginController::index');
$routes->post('validarIngreso','LoginController::validarIngreso');
$routes->get('CerrarSesion','LoginController::CerrarSesion');
 
$routes->get('home','HomeController::index');

$routes->get('usuario','UserController::index');
$routes->post('guardarUsuario','UserController::insertUsuario');
$routes->get('delete/(:num)','UserController::deleteUsuario/$1');


$routes->get('aceites','AceiteController::index');
$routes->post('guardarAceite','AceiteController::guardarAceite');
$routes->post('editarAceite','AceiteController::editarAceite');
$routes->get('eliminarAceite/(:num)','AceiteController::eliminarAceite/$1');


$routes->get('ComprasAceite','AceiteController::ComprasAceite');
$routes->post('guardarComprasAceite','AceiteController::guardarComprasAceite');
$routes->get('ventaAceites','AceiteController::ventaAceites');
$routes->post('guardarVentaAceite','AceiteController::guardarVentaAceite');



$routes->get('equipos','EquiposController::index');
$routes->post('guardarEquipo','EquiposController::guardarEquipo');
$routes->post('editarEquipo','EquiposController::editarEquipo');
$routes->get('eliminarEquipo/(:num)','EquiposController::eliminarEquipo/$1');


$routes->get('mobiliario','MobiliarioController::index');
$routes->post('guardarMobiliario','MobiliarioController::guardarMobiliario');
$routes->post('editarMobiliario','MobiliarioController::editarMobiliario');
$routes->get('eliminarMobiliario/(:num)','MobiliarioController::eliminarMobiliario/$1');


$routes->get('herramienta','HerramientaController::index');
$routes->post('guardarHerramienta','HerramientaController::guardarHerramienta');
$routes->post('editarHerramienta','HerramientaController::editarHerramienta');
$routes->get('eliminarHerramienta/(:num)','HerramientaController::eliminarHerramienta/$1');



$routes->get('mantenimiento','MantenimientoController::index');
$routes->post('guardarMantenimiento','MantenimientoController::guardarMantenimiento');
$routes->post('editarMantenimiento','MantenimientoController::editarMantenimiento');
$routes->get('eliminarMantenimiento/(:num)','MantenimientoController::eliminarMantenimiento/$1');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
