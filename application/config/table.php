<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site TABLE
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	www.SocialTrafficCenter.com
|
| If this is not set then CodeIgniter will guess the protocol, domain and
| path to your installation.
|
*/

$config['table_user'] = "user";
$config['table_user_type'] = "usertype";
$config['table_url'] = 'links';
$config['table_clicksdetail'] = 'clicksdetail';
$config['table_transaction'] = 'transaction';
$config['table_payments'] = 'payments';
$config['table_publisher'] = 'publisher';
$config['table_published_url'] = 'publishedlinks';
$config['table_categories'] = 'categories';
$config['table_templates'] = "template";
$config['table_blogs'] = "blog";
$config['table_articles'] = "article";
$config['table_advertises'] = "advertise";
$config['table_pages'] = "pages";
?>