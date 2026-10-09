<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Pages::index');
$routes->get('about', 'Pages::about');

// Protected customer routes
$routes->get('customers', 'Customers::index', ['filter' => 'auth']);
$routes->get('customers/new', 'Customers::new', ['filter' => 'auth']);
$routes->post('customers', 'Customers::create', ['filter' => 'auth']);
$routes->get('customers/edit/(:num)', 'Customers::edit/$1', ['filter' => 'auth']);
$routes->post('customers/update/(:num)', 'Customers::update/$1', ['filter' => 'auth']);

// Protected user routes
$routes->get('users', 'Users::index', ['filter' => 'auth']);
$routes->get('users/new', 'Users::new', ['filter' => 'auth']);
$routes->post('users', 'Users::create', ['filter' => 'auth']);
$routes->get('users/edit/(:num)', 'Users::edit/$1', ['filter' => 'auth']);
$routes->post('users/update/(:num)', 'Users::update/$1', ['filter' => 'auth']);

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');

// Protected product routes
$routes->get(
    'products',
    'Products::index',
    ['filter' => 'auth']
);

$routes->get(
    'products/new',
    'Products::new',
    ['filter' => 'auth']
);

$routes->post(
    'products',
    'Products::create',
    ['filter' => 'auth']
);

$routes->get(
    'products/edit/(:num)',
    'Products::edit/$1',
    ['filter' => 'auth']
);

$routes->post(
    'products/update/(:num)',
    'Products::update/$1',
    ['filter' => 'auth']
);

$routes->post(
    'products/delete/(:num)',
    'Products::delete/$1',
    ['filter' => 'auth']
);

// Protected sales routes
$routes->get(
    'sales',
    'Sales::index',
    ['filter' => 'auth']
);

$routes->get(
    'sales/new',
    'Sales::new',
    ['filter' => 'auth']
);

$routes->post(
    'sales',
    'Sales::create',
    ['filter' => 'auth']
);