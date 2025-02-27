<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// rutas para las categorias
$routes->get('consultarCategorias', 'CategoriasController::consultarCategorias');
$routes->get('registrarCategorias', 'CategoriasController::registrarCategorias');
$routes->post('guardarCategorias', 'CategoriasController::guardarCategorias');
$routes->get('eliminarCategorias/(:num)', 'CategoriasController::eliminarCategorias/$1');
$routes->get('editarCategorias/(:num)', 'CategoriasController::editarCategorias/$1');
$routes->post('actualizarCategoria', 'CategoriasController::actualizarCategoria');

// rutas para los items
$routes->get('/', 'Home::index');
$routes->get('registrarItems', 'ItemController::registrarItem');
$routes->post('guardarItem', 'ItemController::guardarItem');
$routes->get('eliminarItem/(:num)', 'ItemController::eliminarItem/$1');
$routes->get('editarItem/(:num)', 'ItemController::editarItem/$1');
$routes->post('actualizarItem', 'ItemController::actualizarItem');
