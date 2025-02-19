<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthenticationCTL::index');
$routes->get('/login', 'AuthenticationCTL::index');
$routes->post('/login', 'AuthenticationCTL::login');
$routes->post('/logout', 'AuthenticationCTL::logout');


$routes->group('admin', ['filter' => ['auth', 'role:Admin']], function ($routes) {
    $routes->get('dashboard', 'AdminDashboardCTL::index');
    $routes->get('account', 'AdminDashboardCTL::account');
    $routes->post('account', 'AdminDashboardCTL::createAccount');
    $routes->post('account/get', 'AdminDashboardCTL::getAccount');
    $routes->post('accountUpdate', 'AdminDashboardCTL::updateAccount');
    $routes->delete('account/(:num)', 'AdminDashboardCTL::deleteAccount/$1');
    $routes->get('menu', 'AdminDashboardCTL::menu');
    $routes->get('payment', 'AdminDashboardCTL::payment');
    $routes->post('payment', 'AdminDashboardCTL::getDetailPayment');
    $routes->get('history', 'AdminDashboardCTL::history');
    $routes->post('history', 'AdminDashboardCTL::getDetailHistory');
});

$routes->group('kasir', ['filter' => ['auth', 'role:Kasir']], function ($routes) {
    $routes->get('/', 'CashierCTL::index');
    $routes->get('menu-list', 'CashierCTL::menuList', ['as' => 'menuList']);
    $routes->get('menu/category/(:num)', 'CashierCTL::menuByCategory/$1');
    $routes->post('addMenu', 'ProdukCTL::addMenu');
    $routes->post('getDetails', 'ProdukCTL::getDetails');
    $routes->post('updateProduk', 'ProdukCTL::updateProduk');
    $routes->delete('deleteProduk/(:num)', 'ProdukCTL::deleteProduk/$1');
    $routes->get('receipt', 'CashierCTL::receipt');
    $routes->get('printReceipt', 'CashierCTL::printReceipt');
    // $routes->get('printReceipt/(:num)', 'CashierCTL::printReceipt/$1');
    $routes->get('check_code', 'OrderCTL::checkOrderCode');
    $routes->post('take_order', 'OrderCTL::getOrder');
    // $routes->post('create_order', 'OrderCTL::createOrders');
    $routes->get('kategori', 'CashierCTL::kategoriList');
    $routes->post('kategori/add', 'CashierCTL::kategoriAdd');
    $routes->post('kategori/update', 'CashierCTL::kategoriUpdate');
    $routes->delete('kategori/delete/(:num)', 'CashierCTL::kategoriDelete/$1');
    $routes->get('kategori/get/(:num)', 'CashierCTL::getKategori/$1');
    $routes->get('history', 'CashierCTL::history');
});

$routes->group('midtrans', function($routes){
    $routes->post('getToken', 'MidtransCTL::index');
    $routes->post('finishTransaction', 'MidtransCTL::finisTransaction');
});

$routes->post('kasir/create_order', 'OrderCTL::createOrders');

$routes->group('guest', function($routes) {
    $routes->get('/', 'GuestController::index');
    $routes->get('menu/category/(:num)', 'GuestController::menuByCategory/$1');
    $routes->get('detail', 'GuestController::detailProduct');
    $routes->get('cart', 'GuestController::cartList');
    $routes->get('receipt', 'GuestController::receipt');
    $routes->get('printReceipt', 'GuestController::printReceipt');
    $routes->get('status', 'GuestController::status');
    $routes->get('history', 'GuestController::history');
});

// $routes->get('manager/reports', 'ReportController::index', ['filter' => 'role:admin,kasir']); //example mutiple roles
