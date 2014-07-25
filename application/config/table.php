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
$config['table_f_articles'] = "forum_article";
$config['table_comments'] = "comments";
$config['table_bookmarks'] = "bookmarks";
$config['table_topic'] = "topic";
$config['table_forum_post'] = "forum_post";
$config['table_forum_user'] = "forumuser";
$config['table_communities'] = "communities";
$config['table_communities_comments'] = "community_comments";
$config['table_sma_user_type'] = "sma_user_type";
$config['table_sma_account_details'] = "sma_account_details";
$config['table_sma_account_posts'] = "sma_account_posts";
$config['record_limit'] =5;
$config['pages_limit'] = 10;
?>