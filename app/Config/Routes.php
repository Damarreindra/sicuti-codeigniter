<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'EmployeeController::index');
$routes->get('/employee/create', 'EmployeeController::create');
$routes->post('/employee/store', 'EmployeeController::store');


$routes->get('/leave', 'LeaveController::index');
$routes->get('/leave/create', 'LeaveController::create');
$routes->post('/leave/store', 'LeaveController::store');
