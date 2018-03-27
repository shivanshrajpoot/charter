<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['migrate'] = 'migrate';

/**
 * Common Routes
 */
$route['logout'] 						= 'user/logout';
$route['my-profile']					= 'user/profile';
/**
 * Common Routes
 */

/**
 * Frontend Routes
 */
$route['register'] 						= 'home/register';
$route['privacy-policy'] 				= 'home/privacy_policy';
$route['terms-and-conditions'] 			= 'home/terms_and_conditions';
$route['about-us'] 						= 'home/about_us';
$route['login'] 						= 'user/login';
$route['login-via-facebook'] 			= 'user/facebook_login';
$route['search'] 						= 'home/search';
$route['all-quotes'] 					= 'home/all_quotes';
$route['view-quote/(:any)'] 			= 'home/view_quote/$1';
$route['user/dashboard'] 				= 'user/dashboard';
/**
 * Frontend Routes
 */

/**
 * Admin Routes
 */
$route['admin'] 						= 'user/login';
$route['dashboard'] 					= 'admin/dashboard';
$route['admin/users'] 					= 'admin/list_users';
$route['admin/charters'] 				= 'admin/charters';
$route['admin/configure'] 				= 'admin/configure';
$route['admin/requests'] 				= 'admin/requests';
$route['admin/create-charter'] 			= 'admin/create_charter';
$route['admin/delete-charter'] 			= 'admin/delete_charter';
$route['admin/create-user'] 			= 'admin/create_user';
$route['admin/delete-user'] 			= 'admin/delete_user';
$route['admin/email-templates'] 		= 'admin/email_templates';
$route['admin/static-content'] 			= 'admin/static_content';
$route['admin/aircrafts'] 				= 'admin/aircrafts';
$route['admin/assign-user'] 			= 'admin/assign_user';
/**
 * Admin Routes
 */

/**
 * Charter Routes
 */
$route['charter/dashboard'] 			= 'charter/dashboard';
$route['charter/requests'] 				= 'charter/requests';
$route['charter/submit-price'] 			= 'charter/submit_price';
$route['charter/quotes'] 				= 'charter/quotes';
$route['charter/aircrafts'] 			= 'charter/aircrafts';
$route['charter/create-aircraft'] 		= 'charter/create_aircraft';
$route['charter/delete-aircraft'] 		= 'charter/delete_aircraft';
$route['charter/delete-quote'] 			= 'charter/delete_quote';
/**
 * Charter Routes
 */