<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->post('api','ApiController::index');
$routes->post('changePassword','HomeController::changePassword');
$routes->get('login', 'LoginController::index');
$routes->post('login', 'LoginController::login');
$routes->get('logout','LoginController::logout');
$routes->group('admin',  ['filter' => 'adminFilter'],function($routes){
    //Home Page
    $routes->get('/', 'HomeController::index');
    //Manage User Account
    $routes->get('user', 'UserController::index');
    $routes->get('user/add', 'UserController::addPage');
    $routes->post('user/create', 'UserController::create');
    $routes->post('user/update', 'UserController::update');
    $routes->post('user/delete', 'UserController::delete');
    //Contact page
    $routes->get('contact', 'ContactController::index');
    // Manage Program
    $routes->get('program', 'ProgramController::index');
    $routes->get('program/add', 'ProgramController::addPage');
    $routes->post('program/create', 'ProgramController::create');
    $routes->post('program/delete', 'ProgramController::delete');
    $routes->post('program/update', 'ProgramController::update');
    //Manage Schedule
    $routes->get('schedule', 'ScheduleController::index');
    $routes->get('schedule/add', 'ScheduleController::addPage');
    $routes->post('schedule/create', 'ScheduleController::create');
    $routes->post('schedule/update', 'ScheduleController::update');
    $routes->post('schedule/delete', 'ScheduleController::delete');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
