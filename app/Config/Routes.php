<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    // Rute untuk halaman beranda dan unggahan PDF
    $routes->get('/', 'PdfController::index');
    $routes->post('/', 'PdfController::upload');
    
    // Rute untuk melihat PDF yang telah diperbarui
    $routes->get('/pdf/view/(:segment)', 'PdfController::view/$1');
    
    // Rute untuk halaman admin (contoh)
    $routes->get('/admin', 'Admin\AdminController::index');
    //pdf
    $routes->get('/admin/pdf', 'Admin\PdfController::index');

    //dinas
    $routes->get('/admin/dinas', 'Admin\DinasController::index');
    $routes->get('/admin/dinas/create', 'Admin\DinasController::create');
    $routes->post('/admin/dinas/save', 'Admin\DinasController::save');


    //bidang
    $routes->get('/admin/bidang', 'Admin\BidangController::index');
    $routes->get('/admin/bidang/create', 'Admin\BidangController::create');
    $routes->post('/admin/bidang/save', 'Admin\BidangController::save');

    //user
    $routes->get('/admin/user', 'Admin\UserController::index');
    $routes->get('/admin/user/register', 'Admin\UserController::create');

    //kategory
    $routes->get('/admin/kategory/(:segment)', 'Admin\KategoryController::index/$1');
    $routes->get('/admin/kategory/create', 'Admin\KategoryController::create');
    $routes->get('/admin/kategory/created/', 'Admin\KategoryController::created/$1');
    $routes->get('/admin/kategory/(:segment)', 'Admin\KategoryController::index/$1');
    $routes->post('/admin/kategory/save', 'Admin\KategoryController::save');

    
    //Perihal
    $routes->get('/admin/perihal', 'Admin\PerihalController::index');
    $routes->get('/admin/perihal/create', 'Admin\PerihalController::create');
    
    //auth
    $routes->get('/login', 'Auth\LoginController::index');
});