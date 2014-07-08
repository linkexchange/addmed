<?php 
	$api_response = json_decode(file_get_contents($url."/api/websitedetails/website?key={$apikey}"));
	$error=0;
	//echo "<pre>"; print_r($api_response); echo "</pre>"; exit;
	//Check unauthorised Key
	if(!isset($api_response->error)) :
		$website=$api_response->website;
		$webtitle=$website->name;
		//Check website has posts.
		if($api_response->havePosts!="False") :
			$posts=$api_response->posts;
		endif;
		require_once('getpostsandpages.php');
		
	else :
	$error=1;
	endif;
	//echo $webtitle;
	
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title><?php if(!$error) : echo $webtitle;  endif;?> </title>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo $siteUrl; ?>/css/main.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $siteUrl; ?>/css/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
<!--[if lt IE 9]>
<link href="css/ie/ie8.css" rel="stylesheet" type="text/css" media="all">
<script src="css/ie/css3-mediaqueries.min.js"></script>
<script src="css/ie/html5shiv.min.js"></script>
<![endif]-->
</head>
<body class="">

<!-- ################################################################################################ -->
<div class="wrapper row2">
  <nav id="topnav">
    <ul class="clear">
		<?php require_once('nav.php'); ?>
    </ul>
	
  </nav>
</div>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
	
    <div id="gallery">
      <section>
        <figure>
          <!-- <h2>Gallery Title Goes Here</h2> -->
		  <?php if(!$error) : ?>
			<?php if($api_response->havePosts=="True") : ?>
			  <ul class="clear">
			  <?php foreach($posts as $post) : ?>
				<li class="one_fifth">
					
					<a href="<?php echo $siteUrl; ?>/<?php echo $post->postSlug; ?>/<?php echo $website->id; ?>/<?php echo $post->postID; ?>">
						<img src="<?php echo $post->postImage; ?>" alt="">
						<div class="bx-caption"> 
							<span><?php echo $post->postTitle; ?></span>
						</div>
					</a>
				</li>
			  <?php endforeach;  ?>
			</ul>
			<?php else: ?>
				<?php echo "Website does not contains any post."; ?>
			<?php endif; ?>
		<?php else : ?>
			<?php echo $api_response->error; ?>
        <?php endif; ?>  
        </figure>
      </section>
      <!-- ####################################################################################################### -->
      
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->

<div class="wrapper row4">
  <div id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2014 - All Rights Reserved - <a href="#">Link Exchange Phase II</a></p>
    <!-- <p class="fl_right">Template by <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p> -->
  </div>
</div>
<!-- Scripts -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="scripts/jquery-latest.min.js"><\/script>\
<script src="scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="scripts/jquery-mobilemenu.min.js"></script>
<script src="scripts/custom.js"></script>
</body>
</html>