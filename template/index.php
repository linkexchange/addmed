<?php 
require_once('config.php');
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
$pos = explode('/',$actual_link);

$tidIndex=$titleIndex+1;
$bidIndex=$titleIndex+2;
$aidIndex=$titleIndex+3;
$pidIndex=$titleIndex+1;

	if(!$pos[$titleIndex]){
		require_once('post.php');
	}
	else if($pos[$titleIndex] && isset($pos[$tidIndex]) && isset($pos[$bidIndex])){
		require_once('article.php');
	}
	else if($pos[$titleIndex] && isset($pos[$pidIndex]) && !isset($pos[$bidIndex]) ){
		require_once('page.php');
	}


?>
