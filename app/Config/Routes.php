<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    //generate
    $routes->get('/', 'GenerateController::index');
    $routes->get('get_perihal_by_category/(:segment)', 'GenerateController::getPerihalByCategory/$1');
    $routes->get('get_subperihal_by_perihal/(:segment)', 'GenerateController::getSubPerihalByPerihal/$1');
    $routes->get('get_detailsubperihal_by_subperihal/(:segment)', 'GenerateController::getdetailSubPerihalByPerihal/$1');
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
    $routes->get('/admin/users', 'Admin\UserController::index');
    $routes->get('/admin/users/create', 'Admin\UserController::create');
    $routes->get('/admin/users/update/(:segment)', 'Admin\UserController::update/$1');
    $routes->post('/admin/users/save', 'RegisterController::save');

    //kategory
    $routes->get('/admin/kategori/listkategori', 'Admin\KategoryController::view');
    $routes->get('/admin/kategori/addkategori', 'Admin\KategoryController::add');
    

    $routes->get('/admin/kategory/', 'Admin\KategoryController::index');
    $routes->get('/admin/kategory/create/', 'Admin\KategoryController::create');
    $routes->post('/admin/kategory/save', 'Admin\KategoryController::save');

    
    //Perihal
    $routes->get('/admin/perihal/(:segment)', 'Admin\PerihalController::index/$1');
    $routes->get('/admin/perihal/create/(:segment)', 'Admin\PerihalController::create/$1');
    $routes->post('admin/perihal/save', 'Admin\PerihalController::save');

     //Sub Perihal
    $routes->get('/admin/subperihal/(:segment)', 'Admin\SubPerihalController::index/$1');
    $routes->get('/admin/subperihal/create/(:segment)', 'Admin\SubPerihalController::create/$1');
    $routes->post('admin/subperihal/save', 'Admin\SubPerihalController::save');
    
    //Detail Sub Perihal
    $routes->get('/admin/detailsubperihal/(:segment)', 'Admin\DetailSubPerihalController::index/$1');
    $routes->get('/admin/detailsubperihal/create/(:segment)', 'Admin\DetailSubPerihalController::create/$1');
    $routes->post('admin/detailsubperihal/save', 'Admin\DetailSubPerihalController::save');
    
    //auth
    $routes->get('/login', 'LoginController::index');
    $routes->post('/login', 'LoginController::login');
    $routes->get('/logout', 'LoginController::logout');
});