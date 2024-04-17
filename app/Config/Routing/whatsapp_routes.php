<?php use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('whatsapp', 'WhatsappController::index');
$routes->get('qr', 'WhatsappController::qr');