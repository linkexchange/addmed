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
<title>
	<?php if($api_response->havePages!="False") : ?>
		<?php foreach($pages as $page) : ?>
			<?php if($page->pageSlug==$pos[$titleIndex] && $page->pageID==$pos[$pidIndex]) : ?>
				<?php echo $page->pageTitle; ?> | <?php if(!$error) : echo $webtitle;  endif;?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</title>
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
		<?php if(!$error) : ?>
			<?php if($api_response->havePages!="False") : ?>
				<div id="homepage" class="clear">
					<div class="two_third first">
						<h1>
							<?php if($api_response->havePages!="False") : ?>
								<?php foreach($pages as $page) : ?>
									<?php if($page->pageSlug==$pos[$titleIndex] && $page->pageID==$pos[$pidIndex]) : ?>
										<div><?php echo $page->pageTitle; ?></div>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</h1>
						<?php if(isset($ads->adUnit1)) : ?>
							<div class="ad-unit-1 ads" style="text-align:left;">
								<?php echo $ads->adUnit1; ?>
							</div>
						<?php endif; ?>
						<div class="page-content">
							<?php foreach($api_response->pages as $page) : ?>
								<?php if($page->pageID==$pos[$pidIndex]) : ?>
									<div style="wisth:100%;"><?php echo $page->pageDescription; ?></div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<?php if(isset($ads->adUnit2)) : ?>
							<div class="ad-unit-2 ads">
								<?php echo $ads->adUnit2; ?>
							</div>
						<?php endif; ?>
						<?php if(isset($ads->adUnit3)) : ?>
						<div class="ad-unit-3 ads">
							<span><?php echo $ads->adUnit3; ?></span>
						</div>
						<?php endif; ?>
						<?php if(isset($ads->adUnit4)) : ?>
						<div class="ad-unit-4 ads">
							<span><?php  echo $ads->adUnit4; ?></span>
						</div>
						<?php endif; ?>
						<?php if(isset($ads->adMobile1)) : ?>
						<div class="ad-mobile-1 ads">
							<span><?php echo $ads->adMobile1; ?></span>
						</div>
						<?php endif; ?>
						<?php if(isset($ads->adMobile2))  : ?>
						<div class="ad-mobile-2 ads">
							<span><?php echo $ads->adMobile2; ?></span>
						</div>
						<?php endif; ?>
						<?php if(isset($ads->adMobile3)) : ?>
						<div class="ad-mobile-3 ads">
							<span><?php echo $ads->adMobile3; ?></span>
						</div>
						<?php endif; ?>
					</div>
				  <!-- #### -->
				  <div class="one_third">
					<div class="clear">
						<?php require_once('randomposts.php'); ?>
					</div>
					<?php if(isset($ads->adUnit5)) : ?>
					<div class="ad-unit-5 ads">
						<span><?php echo $ads->adUnit5; ?></span>
					</div>
					<?php endif; ?>
					<?php if(isset($ads->adUnit6)) : ?>
					<div class="ad-unit-6 ads">
						<span><?php echo $ads->adUnit6; ?></span>
					</div>
					<?php endif; ?>
					
				  </div>
				</div>
			<!-- ################################################################################################ -->
			<div class="clear"></div>
		<?php else : ?>
			<?php //header('Location: index.php'); ?>
			<?php echo "Page does not contain any content."; ?>
		<?php endif; ?>
	<?php else : ?>
		<?php //header('Location: index.php'); ?>
		<?php header('Location: '.$siteUrl); //echo $api_response->error; ?>
    <?php endif; ?>  
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
<script>window.jQuery || document.write('<script src="<?php echo $siteUrl; ?>/scripts/jquery-latest.min.js"><\/script>\
<script src="<?php echo $siteUrl; ?>/scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="<?php echo $siteUrl; ?>/scripts/jquery-mobilemenu.min.js"></script>
<script src="<?php echo $siteUrl; ?>/scripts/custom.js"></script>


</body>
</html>