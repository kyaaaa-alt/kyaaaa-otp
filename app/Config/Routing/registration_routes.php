<?php use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'RegistrationController::index');
$routes->post('submit', 'RegistrationController::submit');