<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/student',                   'Student::index');       // List + Search + Pagination
$routes->get('/student/create',            'Student::create');      // Show Add form
$routes->post('/student/store',            'Student::store');       // Insert student
$routes->get('/student/edit/(:num)',       'Student::edit/$1');     // Show Edit form
$routes->post('/student/update/(:num)',    'Student::update/$1');   // Update student
$routes->get('/student/delete/(:num)',     'Student::delete/$1');   // Soft-delete student

// ---------------------------------------------------------------
// REST API Routes
// ---------------------------------------------------------------
$routes->get('/api/students',              'Api\StudentApi::index');      // GET all students (JSON)
$routes->get('/api/students/(:num)',       'Api\StudentApi::show/$1');    // GET single student (JSON)
