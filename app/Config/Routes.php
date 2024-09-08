<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Dashboard::buatPemesanan');

$routes->get('/', 'Layout::index');

$routes->get('dashboard', 'DashboardController::index');

// Pemesanan Routes
$routes->get('pemesanan', 'PemesananController::create');
$routes->get('pemesanan/create', 'PemesananController::create');
$routes->post('pemesanan/store', 'PemesananController::store');


// Approver Routes
$routes->get('persetujuan', 'PersetujuanController::index');
$routes->get('admin/approver_view', 'ApproverController::index');
$routes->post('approver/setujuipemesanan/(:segment)', 'ApproverController::setujuiPemesanan/$1');

// Report Routes
$routes->get('report/generate', 'ReportController::generate');

// login
$routes->get('admin/login', 'AdminController::index');
$routes->post('admin/login', 'AdminController::login');

// Rutehalaman admin dan approver
$routes->get('admin/admin_view', 'AdminController::admin_view');
$routes->get('admin/approver_view', 'AdminController::approver_view');

// logout
$routes->get('admin/logout', 'AdminController::logout');


// Admin Routes
$routes->post('admin/createUser', 'AdminController::createUser');
$routes->post('admin/tambahkendaraan', 'AdminController::tambahKendaraan');
$routes->post('admin/setujuipemesanan/(:num)', 'AdminController::setujuiPemesanan/$1');
$routes->get('admin/delete_vehicle/(:segment)', 'AdminController::delete_vehicle/$1');

// form buat pemesanan
$routes->get('admin/buatPemesanan', 'AdminController::create');
$routes->post('admin/buatPemesanan', 'AdminController::buatPemesanan');