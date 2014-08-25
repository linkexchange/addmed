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

$route['default_controller'] = "forum_articles/forum";
$route['forum'] = "forum_articles/forum";
$route['forum/index/(:num)'] = "forum_articles/forum/index/$1";
$route['forum/dashboard/index/(:num)'] = "forum/dashboard/index/$1";
$route['forum/dashboard/view/(:num)'] = "forum/dashboard/view/$1";
$route['forum/dashboard/delete/(:num)'] = "forum/dashboard/delete/$1";
$route['forum/dashboard/approve/(:num)'] = "forum/dashboard/approve/$1";
$route['forum/dashboard/disapprove/(:num)'] = "forum/dashboard/disapprove/$1";
$route['forum/dashboard/spam/(:num)'] = "forum/dashboard/spam/$1";
$route['forum/dashboard/unspam/(:num)'] = "forum/dashboard/unspam/$1";
$route['forum/dashboard/users/(:num)'] = "forum/dashboard/users/index/$1";
$route['forum/add'] = "forum_articles/forum/add";
$route['articles'] = "forum_articles/listing";
$route['articles/index/(:num)'] = "forum_articles/listing/index/$1";
$route['article/edit/(:num)'] = "article/dashboard/edit/$1";
$route['article/getArticles/(:any)'] = "article/dashboard/getArticles/$1";
$route['article/dashboard/index/(:num)'] = "article/dashboard/index/$1";
$route['article/view/(:num)'] = "article/listing/view/$1";
$route['article/delete/(:num)'] = "article/dashboard/delete/$1";
$route['forum/(:any)/(:num)'] = "forum_articles/forum/view/$1/$2";
$route['topics'] = "forum_articles/forum/view_forum";
$route['topics/index/(:num)'] = "forum_articles/forum/view_forum/$1";
$route['topics/(:num)'] = "forum_articles/forum/view_forum/$1";
$route['bookmarks'] = "forum_articles/listing/show_bookmarks";
$route['bookmarks/index/(:num)'] = "forum_articles/listing/show_bookmarks/$1";
$route['article/(:any)/(:num)'] = "forum_articles/listing/view/$1/$2";
$route['monetization_networks'] = "monetization_networks/dashboard";
$route['monetization_networks/index/(:num)'] = "monetization_networks/dashboard/index/$1";
$route['user/info/(:num)'] = "user/info/index/$1";
$route['404_override'] = '';



/* End of file routes.php */
/* Location: ./application/config/routes.php */