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
$route['default_controller'] = 'admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['tr/admin'] = 'admin';
$route['admin'] = 'admin';
$route['tr/admin/(:any)'] = 'admin/$1';
$route['tr/admin/(:any)/(:any)'] = 'admin/$1/$2';
$route['tr/admin/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3';
$route['tr/admin/(:any)/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3/$4';

$route['tr'] = 'home';
$route['tr/home/(:any)'] = 'home/$1';
$route['tr/home/(:any)/(:any)'] = 'home/$1/$2';
$route['tr/home/(:any)/(:any)/(:any)'] = 'home/$1/$2/$3';
$route['tr/home/(:any)/(:any)/(:any)/(:any)'] = 'home/$1/$2/$3/$4';
$route['tr/home/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'home/$1/$2/$3/$4/$5';

$route['tr/AdminAjax'] = 'AdminAjax';
$route['tr/AdminAjax/(:any)'] = 'AdminAjax/$1';
$route['tr/AdminAjax/(:any)/(:any)'] = 'AdminAjax/$1/$2';
$route['tr/AdminAjax/(:any)/(:any)/(:any)'] = 'AdminAjax/$1/$2/$3';
$route['tr/AdminAjax/(:any)/(:any)/(:any)/(:any)'] = 'AdminAjax/$1/$2/$3/$4';

$route['movie-poster/(:any)'] = 'home/ProductDetails/$1';
$route['tr/movie-poster/(:any)'] = 'home/ProductDetails/$1';
$route['about'] = 'home/about';
$route['tr/about'] = 'home/about';
$route['contact/(:any)'] = 'home/contact/$1';
$route['contact'] = 'home/contact';
$route['tr/contact/(:any)'] = 'home/contact/$1';
$route['tr/contact'] = 'home/contact';
$route['front/contact/(:any)'] = 'home/contact/$1';
$route['front/contact'] = 'home/contact';
$route['tr/front/contact'] = 'home/contact';
$route['category/(:any)'] = 'home/CategoryList/$1';
$route['tr/category/(:any)'] = 'home/CategoryList/$1';
$route['category/(:any)/(:any)'] = 'home/CategoryList/$1/$2';
$route['tr/category/(:any)/(:any)'] = 'home/CategoryList/$1/$2';
$route['search/(:any)'] = 'home/Search/$1';
$route['tr/search/(:any)'] = 'home/Search/$1';
$route['search/(:any)/(:any)'] = 'home/Search/$1/$2';
$route['tr/search/(:any)/(:any)'] = 'home/Search/$1/$2';
$route['(:any)'] = 'home/index/$1';
