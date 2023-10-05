<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

    // Rute untuk halaman beranda dan unggahan PDF
    $routes->get('/', 'Home::index');
    // $routes->post('/', 'Home::index');
    

    
    // Rute untuk halaman admin (contoh)
    $routes->get('/admin', 'Admin\AdminController::index');
    //pdf
    $routes->get('/admin/pdf', 'Admin\PdfController::index');

    //dinas
    $routes->get('/admin/dinas', 'Admin\DinasController::index');

    //bidang
    $routes->get('/admin/bidang/(:segment)', 'Admin\BidangController::index/$1');
    $routes->get('/admin/bidang/create/(:segment)', 'Admin\BidangController::create/$1');
    $routes->post('/admin/bidang/save', 'Admin\BidangController::save');

    //user
    $routes->get('/admin/user', 'Admin\UserController::index');
    $routes->get('/admin/user/register', 'Admin\UserController::create');

    //kategory
    $routes->get('/admin/kategory', 'Admin\KategoryController::index');
    $routes->get('/admin/kategory/create', 'Admin\KategoryController::create');
    $routes->post('/admin/kategory/save', 'Admin\KategoryController::save');

    
    //Perihal
    $routes->get('/admin/perihal/(:segment)', 'Admin\PerihalController::index/$1');
    $routes->get('/admin/perihal/create/(:segment)', 'Admin\PerihalController::create/$1');
    $routes->post('/admin/perihal/save/(:segment)', 'Admin\PerihalController::save/$1');
    $routes->get('/admin/perihal/get_perihal_by_category/(:segment)', 'Admin\PerihalController::getPerihalByCategory/$1');


    //sub perihal
    $routes->get('/admin/subperihal/(:segment)', 'Admin\SubPerihalController::index/$1');
    $routes->get('/admin/subperihal/create/(:segment)', 'Admin\SubPerihalController::create/$1');
    $routes->post('/admin/subperihal/save/(:segment)', 'Admin\SubPerihalController::save/$1');
    $routes->get('/admin/subperihal/get_subperihal_by_perihal/(:segment)', 'Admin\SubPerihalController::getSubPerihalByPerihal/$1');

    //detail sub perihal
    $routes->get('/admin/detailsubperihal/(:segment)', 'Admin\DetailSubPerihalController::index/$1');
    $routes->get('/admin/detailsubperihal/create/(:segment)', 'Admin\DetailSubPerihalController::create/$1');
    $routes->post('/admin/detailsubperihal/save/(:segment)', 'Admin\DetailSubPerihalController::save/$1');
    $routes->get('/admin/subperihal/get_detail_subperihal_by_sub_perihal/(:segment)', 'Admin\DetailSubPerihalController::getDetailSubPerihalBySubPerihal/$1');




    //auth
    $routes->get('/login', 'Auth\LoginController::index');