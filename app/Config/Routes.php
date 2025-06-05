<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');
$routes->get('index', 'Main::index');
$routes->get('rocnik/(:num)', 'Main::rocnik/$1');
$routes->get('rocnik/edit/(:num)', 'Main::editRocnik/$1');
$routes->post('rocnik/update/(:num)', 'Main::updateRocnik/$1');
