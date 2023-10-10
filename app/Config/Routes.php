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

    
    $routes->get('/admin/dinas/listdinas', 'Admin\DinasController::view');

    $routes->get('/admin/dinas', 'Admin\DinasController::index');
    $routes->get('/admin/dinas/create', 'Admin\DinasController::create');
    $routes->post('/admin/dinas/save', 'Admin\DinasController::save');


    //bidang

    $routes->get('/admin/dinas/listbidang', 'Admin\BidangController::view');

    $routes->get('/admin/bidang/(:segment)', 'Admin\BidangController::index/$1');
    // $routes->get('/admin/bidang', 'Admin\BidangController::index');
    $routes->get('/admin/bidang/create', 'Admin\BidangController::create');
    $routes->post('/admin/bidang/save', 'Admin\BidangController::save');

    //user
    $routes->get('/admin/users', 'Admin\UserController::index');
    $routes->get('/admin/users/create', 'Admin\UserController::create');
    $routes->get('/admin/users/edit/(:segment)', 'Admin\UserController::edit/$1');
    $routes->post('/admin/users/save', 'Admin\UserController::save');
    $routes->post('/admin/users/update/(:segment)', 'Admin\UserController::update/$1');
    $routes->post('/admin/users/delete/(:segment)', 'Admin\UserController::delete/$1');


    //kategory
    $routes->get('/admin/kategori/', 'Admin\KategoryController::index');
    $routes->get('/admin/kategori/create/', 'Admin\KategoryController::create');
    $routes->get('/admin/kategori/edit/(:segment)', 'Admin\KategoryController::edit/$1');
    $routes->post('/admin/kategori/save', 'Admin\KategoryController::save');
    $routes->post('/admin/kategori/update/(:segment)', 'Admin\KategoryController::update/$1');
    $routes->post('/admin/kategori/delete/(:segment)', 'Admin\KategoryController::delete/$1');

    
    //Perihal
    
    $routes->get('/admin/perihal/(:segment)', 'Admin\PerihalController::index/$1');
    $routes->get('/admin/perihal/create/(:segment)', 'Admin\PerihalController::create/$1');
    $routes->get('/admin/perihal/edit/(:segment)', 'Admin\PerihalController::edit/$1');
    $routes->post('admin/perihal/save', 'Admin\PerihalController::save');
    $routes->post('admin/perihal/update/(:segment)', 'Admin\PerihalController::update/$1');

    //Perihal UI-----------------------------------------------------------------------------------
    $routes->get('admin/tambahperihal','Admin\PerihalController::tambahperihal');
    $routes->get('admin/editperihal','Admin\PerihalController::editperihal');
    
    
     //Sub Perihal

     
     $routes->get('/admin/subperihal/listsubperihal', 'Admin\SubPerihalController::view');

    $routes->get('/admin/subperihal/(:segment)', 'Admin\SubPerihalController::index/$1');
    $routes->get('/admin/subperihal/create/(:segment)', 'Admin\SubPerihalController::create/$1');
    $routes->post('admin/subperihal/save', 'Admin\SubPerihalController::save');

    //Perihal UI-----------------------------------------------------------------------------------
    $routes->get('admin/tambahsubperihal','Admin\SubPerihalController::tambahsubperihal');
    $routes->get('admin/editsubperihal','Admin\SubPerihalController::editsubperihal'); 
    
    
    //Detail Sub Perihal

   
    $routes->get('/admin/detailsubperihal/listdetailsubperihal', 'Admin\DetailSubPerihalController::view');

    $routes->get('/admin/detailsubperihal/(:segment)', 'Admin\DetailSubPerihalController::index/$1');
    $routes->get('/admin/detailsubperihal/create/(:segment)', 'Admin\DetailSubPerihalController::create/$1');
    $routes->post('admin/detailsubperihal/save', 'Admin\DetailSubPerihalController::save');
    
    //Datail Sub Perihal UI-----------------------------------------------------------------------------------
    $routes->get('admin/tambahdetailsubperihal','Admin\DetailSubPerihalController::tambahdetailsubperihal');
    $routes->get('admin/editdetailsubperihal','Admin\DetailSubPerihalController::editdetailsubperihal'); 


    //auth
    $routes->get('/login', 'LoginController::index');
    $routes->post('/login', 'LoginController::login');

    //dashboard
    $routes->get('/dashboard', 'DashboardController::index');
});