<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'user/index';
$route['404_override'] = '';

/*admin*/

$route['admin'] = 'user/index';
$route['user'] = 'user/index';
$route['signup'] = 'user/signup';
$route['create_member'] = 'user/create_member';
$route['login'] = 'user/index';
$route['logout'] = 'user/logout';
$route['login/validate_credentials'] = 'user/validate_credentials';

$route['admin/places'] = 'admin_places/index';
$route['admin/places/show/(:any)'] = 'admin_places/showData/$1';
$route['admin/places/add'] = 'admin_places/add';
$route['admin/places/update'] = 'admin_places/update';
$route['admin/places/update/(:any)'] = 'admin_places/update/$1';
$route['admin/places/delete/(:any)'] = 'admin_places/delete/$1';
$route['admin/places/(:any)'] = 'admin_places/index/$1';

$route['user/places'] = 'user_places/index';
$route['user/places/add'] = 'user_places/add';

/* End of file routes.php */
/* Location: ./application/config/routes.php */