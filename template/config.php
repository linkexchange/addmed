<?php 
# Website api key from api.socialtrafiifccenter.com website dashboard.
$apikey = 'gn7o88mMcobzHcGNhsiiJ39RjiLaI8B1GVDkqE0l';

# Live server api url
$serverUrl="http://www.api.socialtrafficcenter.com/";

# Domain Name:
# Please do not include last "/" in $siteUrl.
# Correct   : http://www.example.com
# Incorrect : http://www.example.com/

$siteUrl="http://example.com";

# Final API Url.  Ex. $localUrl/$serverUrl.
$url=$serverUrl;

# Page Title index
# Ex.
#	$siteUrl=http://www.example.com                                 $titleIndex=3;
#	$siteUrl=http://www.example.com/SF1								$titleIndex=4;
#	$siteUrl=http://www.example.com/SF1/SF2							$titleIndex=5;

$titleIndex=3;

/*
# .htaccess file Changes. (IMPORTANT)

Ex. 
1.
	$siteUrl=http://www.example.com

	.htaccess File contents

	RewriteEngine On
	RewriteBase /
	RewriteRule ^index\.php$ - [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . /index.php [L]


2. 
	$siteUrl=http://www.example.com/SF1

	.htaccess File contents

	RewriteEngine On
	RewriteBase /SF1/
	RewriteRule ^index\.php$ - [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . /SF1/index.php [L]


3. 
	$siteUrl=http://www.example.com/SF1/SF2

	.htaccess File contents

	RewriteEngine On
	RewriteBase /SF1/SF2/
	RewriteRule ^index\.php$ - [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . /SF1/SF2/index.php [L]


*/
?>