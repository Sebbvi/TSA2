<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// Public pages
$routes->get('/', 'TaskController::index');
$routes->get('tasks', 'TaskController::allTasks');
$routes->get('profile', 'TaskController::profile');
$routes->get('about', 'TaskController::about');

// Auth routes
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');

// Protected CRUD routes
$routes->get('tasks/new', 'TaskController::newTask');
$routes->post('tasks/create', 'TaskController::createTask');
$routes->get('tasks/edit/(:num)', 'TaskController::editTask/$1');
$routes->post('tasks/update/(:num)', 'TaskController::updateTask/$1');
$routes->post('tasks/delete/(:num)', 'TaskController::deleteTask/$1');
