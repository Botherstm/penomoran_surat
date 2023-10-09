<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    // Rute untuk halaman beranda dan unggahan PDF

    //generate
    $routes->get('/', 'GenerateController::index');
$routes->get('get_perihal_by_category/(:segment)', 'GenerateController::getPerihalByCategory/$1');
$routes->get('admin/subperihal/get_subperihal_by_perihal/(:segment)', 'SubPerihalController::getSubPerihalByPerihal/$1');
    
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
    $routes->get('/admin/bidang/(:segment)', 'Admin\BidangController::index/$1');
    // $routes->get('/admin/bidang', 'Admin\BidangController::index');
    $routes->get('/admin/bidang/create', 'Admin\BidangController::create');
    $routes->post('/admin/bidang/save', 'Admin\BidangController::save');

    //user
    $routes->get('/admin/user', 'Admin\UserController::index');
    $routes->get('/admin/user/register', 'Admin\UserController::create');

    //kategory
    $routes->get('/admin/kategory/', 'Admin\KategoryController::index');
    $routes->get('/admin/kategory/create/(:segment)', 'Admin\KategoryController::create/$1');
    $routes->get('/admin/kategory/created/', 'Admin\KategoryController::created/$1');
    $routes->get('/admin/kategory/(:segment)', 'Admin\KategoryController::index/$1');
    $routes->post('/admin/kategory/save', 'Admin\KategoryController::save');

    
    //Perihal
    $routes->get('/admin/perihal/(:segment)', 'Admin\PerihalController::index/$1');
    $routes->get('/admin/perihal/create/(:segment)', 'Admin\PerihalController::create/$1');
    $routes->post('admin/perihal/save', 'Admin\PerihalController::save');
    
    //auth
    $routes->get('/login', 'Auth\LoginController::index');
});