<?php use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'OTPController::index');
$routes->get('/verify', 'OTPController::verify');
$routes->post('/submit', 'OTPController::submit');
$routes->post('/verify-otp', 'OTPController::verify_otp');