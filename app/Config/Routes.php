<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//----------------ADMIN--------------------------------------------------------------------------
$routes->get('/admin', 'Admin\AdminController::index');
// $routes->get('/admin/pdf', 'Admin\PdfController::index');

//riwayatsurat
$routes->get('/admin/riwayatsurat', 'Admin\RiwayatSuratController::index');
$routes->get('/admin/pdf', 'Admin\PdfController::index');

//dinas
$routes->get('/admin/dinas', 'Admin\DinasController::index');
$routes->get('/admin/dinas/create', 'Admin\DinasController::create');
$routes->get('/admin/dinas/edit/(:segment)', 'Admin\DinasController::edit/$1');
$routes->post('/admin/dinas/save', 'Admin\DinasController::save');
$routes->post('/admin/dinas/update', 'Admin\DinasController::update');
$routes->post('/admin/dinas/delete/(:segment)', 'Admin\DinasController::delete/$1');

//bidang
$routes->get('/admin/bidang', 'Admin\BidangController::view1');
$routes->get('/admin/dinas/bidang/(:segment)', 'Admin\BidangController::index/$1');
$routes->get('/admin/dinas/bidang/create/(:segment)', 'Admin\BidangController::create/$1');
$routes->get('/admin/dinas/bidang/edit/(:segment)', 'Admin\BidangController::edit/$1');
$routes->post('/admin/bidang/save', 'Admin\BidangController::save');
$routes->post('/admin/bidang/update/(:segment)', 'Admin\BidangController::update/$1');
$routes->post('/admin/bidang/delete/(:segment)', 'Admin\BidangController::delete/$1');

//user

$routes->get('/admin/users', 'Admin\UserController::index');
$routes->get('/admin/users/create', 'Admin\UserController::create');
$routes->get('/admin/user/profile', 'Admin\UserController::profile');
$routes->post('/admin/profile/update', 'Admin\UserController::updateGambar');
$routes->post('/admin/profile/updatedata', 'Admin\UserController::updateData');
$routes->get('/admin/users/edit/(:segment)', 'Admin\UserController::edit/$1');
$routes->post('/admin/users/save', 'Admin\UserController::save');
$routes->post('/admin/profile/delete', 'Admin\UserController::deleteGambar');
$routes->post('/admin/users/update/(:segment)', 'Admin\UserController::update/$1');
$routes->post('/admin/users/delete/(:segment)', 'Admin\UserController::delete/$1');

//urutan
$routes->get('/admin/dinas/urutansurat/(:segment)', 'Admin\UrutanSuratController::index/$1');
$routes->get('/admin/dinas/urutansurat/create/(:segment)', 'Admin\UrutanSuratController::create/$1');
$routes->get('/admin/dinas/urutansurat/edit/(:segment)', 'Admin\UrutanSuratController::edit/$1');
$routes->post('/admin/urutansurat/save', 'Admin\UrutanSuratController::save');
$routes->post('/admin/urutansurat/update/(:segment)', 'Admin\UrutanSuratController::update/$1');
$routes->post('/admin/urutansurat/delete/(:segment)', 'Admin\UrutanSuratController::delete/$1');

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
$routes->get('/admin/detailsubperihal/listdetailsubperihal', 'Admin\DetailSubPerihalController::view');
$routes->get('/admin/detailsubperihal/(:segment)', 'Admin\DetailSubPerihalController::index/$1');
$routes->get('/admin/detailsubperihal/create/(:segment)', 'Admin\DetailSubPerihalController::create/$1');
$routes->post('admin/detailsubperihal/save', 'Admin\DetailSubPerihalController::save');
$routes->post('admin/detailsubperihal/update', 'Admin\DetailSubPerihalController::save');
$routes->post('admin/detailsubperihal/delete', 'Admin\DetailSubPerihalController::save');

//kategori
$routes->get('/admin/kategori/perihal/subperihal/detailsubperihal/(:segment)', 'Admin\DetailSubPerihalController::index/$1');
$routes->get('/admin/kategori/perihal/subperihal/detailsubperihal/create/(:segment)', 'Admin\DetailSubPerihalController::create/$1');
$routes->get('/admin/kategori/perihal/subperihal/detailsubperihal/edit/(:segment)', 'Admin\DetailSubPerihalController::edit/$1');
$routes->post('/admin/detailsubperihal/save', 'Admin\DetailSubPerihalController::save');
$routes->post('/admin/detailsubperihal/update/(:segment)', 'Admin\DetailSubPerihalController::update/$1');
$routes->post('/admin/detailsubperihal/delete/(:segment)', 'Admin\DetailSubPerihalController::delete/$1');

//----------------PUBLIC--------------------------------------------------------------------------

//public
$routes->get('/', 'User\HomeController::index');

//user dashboard
$routes->get('/public/user/profile', 'User\UserController::index');
// $routes->post('/user/profile/update', 'User\UserController::update');
$routes->post('/user/profile/update', 'User\UserController::update');
$routes->post('/user/profile/updategambar', 'User\UserController::updateGambar');
$routes->post('/user/profile/delete', 'User\UserController::deleteGambar');

//generate
// $routes->get('/', 'GenerateController::index');
$routes->post('/generate/save', 'GenerateController::save');
$routes->get('get_perihal_by_category/(:segment)', 'GenerateController::getPerihalByCategory/$1');
$routes->get('get_subperihal_by_perihal/(:segment)', 'GenerateController::getSubPerihalByPerihal/$1');
$routes->get('get_detailsubperihal_by_subperihal/(:segment)', 'GenerateController::getdetailSubPerihalByPerihal/$1');

//----------User--------------------------------------------

//dashboard
$routes->get('/dashboard', 'DashboardController::index');

//riwayat
$routes->get('/public/riwayat', 'User\RiwayatController::index');
$routes->get('/public/riwayat/detail/(:segment)', 'User\RiwayatController::detail/$1');

//terlewat
$routes->post('/generate/terlewat/save', 'TerlewatController::save');
$routes->get('/generate/terlewat/', 'TerlewatController::index');

$routes->get('/generate/terlewat/get_perihal_by_category/(:segment)', 'GenerateController::getPerihalByCategory/$1');
$routes->get('/generate/terlewat/get_subperihal_by_perihal/(:segment)', 'GenerateController::getSubPerihalByPerihal/$1');
$routes->get('/generate/terlewat/get_detailsubperihal_by_subperihal/(:segment)', 'GenerateController::getdetailSubPerihalByPerihal/$1');

//tentang
// $routes->post('/pdf/generatePdf', 'TerlewatController::generatePdf');
$routes->get('/tentang', 'TentangController::user');
$routes->get('/admin/tentang', 'TentangController::admin');

//----------------LOGIN--------------------------------------------------------------------------

//auth
$routes->get('/login', 'LoginController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/login', 'LoginController::login');
$routes->get('/lupa', 'LupaPasswordController::index');
$routes->post('/resetpassword', 'LupaPasswordController::lupaPassword');

//TODO

$routes->get('/rinciansurat', 'TerlewatController::rinciansurat');

//-----coba2------
$routes->post('server', 'TerlewatController::generatePdf');
