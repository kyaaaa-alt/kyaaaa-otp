<?php use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('verification', 'VerifyController::index');
$routes->post('verify', 'VerifyController::verify');