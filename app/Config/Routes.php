<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');

//FOR STUDEV
$routes->setDefaultController('BoroumeController');

//FOR LOCALHOST
//$routes->setDefaultController('Home');

$routes->setDefaultMethod('home');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//FOR STUDEV
//$routes->get('/', 'AuthController::login');
//
//FOR LOCALHOST
$routes->get('/', 'BoroumeController::index');

$routes->get('AuthController/login/lang/(:any)', 'LanguageController::switchLanguage/$1');
$routes->get('BoroumeController/home/lang/(:any)', 'LanguageController::switchLanguage/$1');
$routes->get('BoroumeController/volunteers/lang/(:any)', 'LanguageController::switchLanguage/$1');
$routes->get('AuthController/SignUp/ageCheck', 'AuthController::ageCheck');



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

#$routes->get('SignIn', 'TypwindController::SignIn', ['as' => 'SignIn']);
#$routes->get('SignUp', 'TypwindController::SignUp', ['as' => 'SignUp']);
#$routes->post('create', 'TypwindController::create', ['as' => 'create']);
#$routes->post('check', 'TypwindController::check', ['as' => 'check']);
#$routes->get('logout', 'TypwindController::logout', ['as' => 'logout']);

#$routes->get('home', 'BoroumeController::home');
#$routes->get('announcements', 'BoroumeController::announcements');
#$routes->get('savingfood', 'BoroumeController::savingfood');
#$routes->get('calendar', 'BoroumeController::calendar');

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
