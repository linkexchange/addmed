<?php 
if(isset($pos[$tidIndex]) && isset($pos[$bidIndex])){
	$templateID=$pos[$tidIndex];
	$postID=$pos[$bidIndex];
	if(isset($pos[$aidIndex])){
		$galleryItemId = $pos[$aidIndex];
	}
}
else
{
	header('Location: '.$siteUrl);
}

//echo "API Response :";
if(isset($galleryItemId) && isset($templateID) && isset($postID))
{
	$api_response = json_decode(file_get_contents($url."/api/websitedetails/galleryItem?key={$apikey}&templateID={$templateID}&postID={$postID}&galleryItemId={$galleryItemId}"));
}
else if(isset($templateID) && isset($postID))
{
	$api_response = json_decode(file_get_contents($url."/api/websitedetails/galleryItem?key={$apikey}&templateID={$templateID}&postID={$postID}"));
}
else
{
	header('Location: '.$siteUrl);
}

//echo "<pre>"; print_r($api_response); echo "</pre>"; exit;

$error=0;
if(!isset($api_response->error)){
	$website=$api_response->website;
	$webtitle=$website->name;
	//Check website has posts.
	if($api_response->havePosts!="False") :
		$posts=$api_response->posts;
		if($api_response->haveGalleryItems!="False") : 
			$article=$api_response->galleryItem;
			foreach($posts as $post){
				if($article->postID==$post->postID){
					$blogTitle=$post->postTitle;
					$postSlug=$post->postSlug;
				}
			}
			
		endif;
	endif;
	require_once('getpostsandpages.php');
}
else{
	$error=1;
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title><?php if($api_response->haveGalleryItems!="False") : echo $article->galleryItemTitle; else :  echo "Gallery Items"; endif; ?> | <?php if(!$error) : echo $webtitle;  endif;?></title>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link href="<?php echo $siteUrl; ?>/css/main.css" rel="stylesheet" type="text/css" media="all"> -->
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
			<?php if($api_response->haveGalleryItems!="False") : ?>
				<div id="homepage" class="clear">
					<div class="two_third first">
						<h1><?php if($api_response->havePosts!="False") : echo $blogTitle; endif; ?></h1>
						<div class="ad-unit-1 ads" style="text-align:left;">
						</div>
						
						<div class="category-article">
						<ul class="bxslider">
							<li>
								<div class="page-nav page-nav-post">
									<div class="prev">
										<a href="<?php echo $siteUrl; ?>/<?php if(isset($article->pre->slug)) echo $article->pre->slug; ?>/<?php if(isset($website->id)) echo $website->id; ?>/<?php if(isset($article->postID)) echo $article->postID; ?>/<?php if(isset($article->pre->id)) echo $article->pre->id; ?>" target="_top">
											<span>Previous Page</span>
										</a>
									</div>
									<div class="next">
										<a href="<?php echo $siteUrl; ?>/<?php if(isset($article->nxt->slug)) echo $article->nxt->slug; ?>/<?php if(isset($website->id)) echo $website->id; ?>/<?php if(isset($article->postID)) echo $article->postID; ?>/<?php if(isset($article->nxt->id)) echo $article->nxt->id; ?>">
											<span>Next Page</span>
										</a>
									</div>
								</div>
								<div id="li_title">
									<h4><?php if(isset($article->galleryItemTitle)) echo $article->galleryItemTitle; ?></h4>
								</div>
								<div class="article-description">
									<!-- <img src="<?php if(isset($article->galleryItemImage)) echo $article->galleryItemImage; ?>" />
									<p class="video_para"><?php if(isset($article->galleryItemVideo)) echo $article->galleryItemVideo; ?></p> -->
									<p><?php if(isset($article->galleryItemDescription)) echo $article->galleryItemDescription; ?></p>
								</div>
								<div class="page-nav page-nav-post">
									<div class="prev">
										<a href="<?php echo $siteUrl; ?>/<?php if(isset($article->pre->slug)) echo $article->pre->slug; ?>/<?php if(isset($website->id)) echo $website->id; ?>/<?php if(isset($article->postID)) echo $article->postID; ?>/<?php if(isset($article->pre->id)) echo $article->pre->id; ?>" target="_top">
											<span>Previous Page</span>
										</a>
									</div>
									<div class="next">
										<a href="<?php echo $siteUrl; ?>/<?php if(isset($article->nxt->slug)) echo $article->nxt->slug; ?>/<?php if(isset($website->id)) echo $website->id; ?>/<?php if(isset($article->postID)) echo $article->postID; ?>/<?php if(isset($article->nxt->id)) echo $article->nxt->id; ?>">
											<span>Next Page</span>
										</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="ad-unit-2 ads">
					</div>
					<div class="ad-unit-3 ads">
					</div>
					<div class="ad-unit-4 ads">
					</div>
					<div class="ad-mobile-1 ads">
					</div>
					<div class="ad-mobile-2 ads">
					</div>
					<div class="ad-mobile-3 ads">
					</div>
				</div>
				  <!-- #### -->
				  <div class="one_third">
					<div class="clear">
						<?php require_once('randomposts.php'); ?>
					</div>
					<div class="ad-unit-5 ads">
					</div>
					<div class="ad-unit-6 ads">
					</div>
					
				  </div>
				</div>
			<!-- ################################################################################################ -->
			<div class="clear"></div>
		<?php else : ?>
			<?php //header('Location: index.php'); ?>
			<?php echo "Post does not contain any article."; ?>
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
<link href="<?php echo $siteUrl; ?>/css/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $siteUrl; ?>/css/pages.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $siteUrl; ?>/css/elements.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $siteUrl; ?>/css/framework.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $siteUrl; ?>/css/fonts/caviardreams/stylesheet.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $siteUrl; ?>/css/fonts/caviardreams/stylesheet.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $siteUrl; ?>/css/fonts/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $siteUrl; ?>/css/custom.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $siteUrl; ?>/css/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
<!--[if lt IE 9]>
<link href="css/ie/ie8.css" rel="stylesheet" type="text/css" media="all">
<script src="css/ie/css3-mediaqueries.min.js"></script>
<script src="css/ie/html5shiv.min.js"></script>
<![endif]-->

<!-- Scripts -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo $siteUrl; ?>/scripts/jquery-latest.min.js"><\/script>\
<script src="<?php echo $siteUrl; ?>/scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="<?php echo $siteUrl; ?>/scripts/jquery-mobilemenu.min.js"></script>
<script src="<?php echo $siteUrl; ?>/scripts/custom.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo $siteUrl; ?>/scripts/jquery.lazyload.js?v=1.9.1"></script>
<!-- <script src="http://www.appelsiini.net/js/all.js"></script> -->
<script type="text/javascript" charset="utf-8">
 $(window).bind("load", function() {
   // code here
    $("img.lazy").lazyload();
    var input = "key=<?php echo $apikey; ?>";
        $.ajax( {
            type : "GET",
            url : "<?php echo $url.'api/websitedetails/getWebsiteAds'; ?>",
            data : input ,
            dataType : "JSON",
            success : function(data) {
                //console.log(data)
                if(data['haveAds']=="True"){
                    $('.ad-unit-1').html(data['ads']['adUnit1']);
                    $('.ad-unit-2').html(data['ads']['adUnit2']);
                    $('.ad-unit-3').html(data['ads']['adUnit3']);
                    $('.ad-unit-4').html(data['ads']['adUnit4']);
                    $('.ad-unit-5').html(data['ads']['adUnit5']);
                    $('.ad-unit-6').html(data['ads']['adUnit6']);
                    $('.ad-mobile-1').html(data['ads']['adMobile1']);
                    $('.ad-mobile-2').html(data['ads']['adMobile2']);
                    $('.ad-mobile-3').html(data['ads']['adMobile3']);
                }
              },
            error: function (request, status, error) {
                log("Error: getLatLong Status - " + status + " ErrorText - " + error);
            }
        });
 });
</script>

</body>
</html>