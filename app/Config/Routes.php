<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'TaskController::index');
$routes->get('tasks', 'TaskController::allTasks');
$routes->get('profile', 'TaskController::profile');
$routes->get('about', 'TaskController::about');