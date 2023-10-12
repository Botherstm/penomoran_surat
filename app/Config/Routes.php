<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
        // USER ROUTES----------------------------------------------
    //public
     $routes->get('/', 'User\HomeController::index');
    //user dashboard
    $routes->get('/user', '\UserController::index');
    $routes->get('/user/profile', 'Admin\UserController::profile');

    
    //generate
    // $routes->get('/', 'GenerateController::index');
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
    // $routes->get('/admin/dinas/create', 'Admin\DinasController::create');
    // $routes->post('/admin/dinas/save', 'Admin\DinasController::save');


    //bidang

    $routes->get('/admin/dinas/bidang/(:segment)', 'Admin\BidangController::index/$1');
    $routes->get('/admin/dinas/bidang/create/(:segment)', 'Admin\BidangController::create/$1');
    $routes->get('/admin/dinas/bidang/edit/(:segment)', 'Admin\BidangController::edit/$1');
    $routes->post('/admin/bidang/save', 'Admin\BidangController::save');
    $routes->post('/admin/bidang/update/(:segment)', 'Admin\BidangController::update/$1');
    $routes->post('/admin/bidang/delete/(:segment)', 'Admin\BidangController::delete/$1');


    //user
    $routes->get('/admin/users', 'Admin\UserController::index');
    $routes->get('/admin/users/create', 'Admin\UserController::create');
    $routes->get('/admin/users/edit/(:segment)', 'Admin\UserController::edit/$1');
    $routes->post('/admin/users/save', 'Admin\UserController::save');
    $routes->post('/admin/users/update/(:segment)', 'Admin\UserController::update/$1');
    $routes->post('/admin/users/delete/(:segment)', 'Admin\UserController::delete/$1');



    //riwayat
    $routes->get('/admin/urutansurat/index', 'Admin\KategoryController::view');
    $routes->get('/admin/riwayatsurat/index', 'Admin\KategoryController::view2');
    
   
    // --------------------------------------------------------------------
    $routes->get('/admin/urutansurat/create', 'Admin\KategoryController::createurutansurat');
    $routes->get('/admin/urutansurat/edit', 'Admin\KategoryController::editurutansurat');

    //kategori
    $routes->get('/admin/kategori/', 'Admin\KategoryController::index');
    $routes->get('/admin/kategori/create/', 'Admin\KategoryController::create');
    $routes->get('/admin/kategori/edit/(:segment)', 'Admin\KategoryController::edit/$1');
    $routes->post('/admin/kategori/save', 'Admin\KategoryController::save');
    $routes->post('/admin/kategori/update/(:segment)', 'Admin\KategoryController::update/$1');
    $routes->post('/admin/kategori/delete/(:segment)', 'Admin\KategoryController::delete/$1');


    //Perihal
    $routes->get('/admin/kategori/perihal/(:segment)', 'Admin\PerihalController::index/$1');
    $routes->get('/admin/kategori/perihal/create/(:segment)', 'Admin\PerihalController::create/$1');
    $routes->get('/admin/kategori/perihal/edit/(:segment)', 'Admin\PerihalController::edit/$1');
    $routes->post('admin/perihal/save', 'Admin\PerihalController::save');
    $routes->post('admin/perihal/update/(:segment)', 'Admin\PerihalController::update/$1');
    $routes->post('/admin/perihal/delete/(:segment)', 'Admin\PerihalController::delete/$1');


    //Sub Perihal
    $routes->get('/admin/kategori/perihal/subperihal/(:segment)', 'Admin\SubPerihalController::index/$1');
    $routes->get('/admin/kategori/perihal/subperihal/create/(:segment)', 'Admin\SubPerihalController::create/$1');
    $routes->get('/admin/kategori/perihal/subperihal/edit/(:segment)', 'Admin\SubPerihalController::edit/$1');
    $routes->post('/admin/subperihal/save', 'Admin\SubPerihalController::save');
    $routes->post('/admin/subperihal/update/(:segment)', 'Admin\SubPerihalController::update/$1');
    $routes->post('/admin/subperihal/delete/(:segment)', 'Admin\SubPerihalController::delete/$1');


    //Detail Sub Perihal
    $routes->get('/admin/kategori/perihal/subperihal/detailsubperihal/(:segment)', 'Admin\DetailSubPerihalController::index/$1');
    $routes->get('/admin/kategori/perihal/subperihal/detailsubperihal/create/(:segment)', 'Admin\DetailSubPerihalController::create/$1');
    $routes->get('/admin/kategori/perihal/subperihal/detailsubperihal/edit/(:segment)', 'Admin\DetailSubPerihalController::edit/$1');
    $routes->post('/admin/detailsubperihal/save', 'Admin\DetailSubPerihalController::save');
    $routes->post('/admin/detailsubperihal/update/(:segment)', 'Admin\DetailSubPerihalController::update/$1');
    $routes->post('/admin/detailsubperihal/delete/(:segment)', 'Admin\DetailSubPerihalController::delete/$1');

    //auth
    $routes->get('/login', 'LoginController::index');
    $routes->get('/logout', 'LoginController::logout');
    $routes->post('/login', 'LoginController::login');
    

    //dashboard
    $routes->get('/dashboard', 'DashboardController::index');


    //TODO



});