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
		//echo "<pre>".count($posts); echo "</pre>"; exit;
		//echo "<pre>"; print_r($posts); echo "</pre>"; exit;
		require_once('getpostsandpages.php');
		
	else :
	$error=1;
	endif;
	//echo $webtitle;
	$post_count = count($posts);
	if($post_count>10)
	{
		$start = substr($post_count,0,1); 
		$nb = $start + 1;
		$j  = 0;
		for($i=0;$i<$nb;$i++)
		{
			$post_data[$i] = array_slice($posts,$j,10);
			$j = $j + 10; 
		}	
		//echo "<pre>"; print_R($post_data);  exit;
		//echo "<br/><pre>"; print_R($posts); exit;
	}	
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title><?php if(!$error) : echo $webtitle;  endif;?> </title>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
			  <div class="latest-post" style="background-color:#58ACFA;color:#fff;
			  height:50px;padding-left: 21px; font-family: cursive; font-size: x-large;"><br/>
				Latest Posts 
			  </div>	
			  <div class="ad-unit-1"></div>
			  <?php //echo "<pre>"; print_R($api_response); exit;
				$i=0; $posts = $post_data[0];
			  ?>
			  <?php foreach($posts as $post) : ?>
				<div class="list-blog" style="width:100%;display:inline-block;
				background-color:#eee;margin-bottom:12px;">
					<div class="blog-image" style="width:25%;float:left;">
						<a href="<?php echo $siteUrl; ?>/<?php echo $post->postSlug; ?>/<?php echo $website->id; ?>/<?php echo $post->postID; ?>">
							<!-- <img src="<?php echo $post->postImage; ?>" alt=""> -->
							<img class="lazy" data-original="<?php echo $post->postImage; ?>" /> 
						</a>
					</div>
					<div class="blog-desc" style="width:70%;float:left;padding:2%">	
						<?php $title_len=strlen($post->postTitle); ?>
						<div class="<?php if($title_len>45) : ?>high-bx-caption <?php else : ?>bx-caption<?php endif; ?> "> 
							<div class="blog-title-header" style="background-color: #58ACFA; color: #fff; font-size: 21px; padding: 11px; font-family: cursive;">
							<a href="<?php echo $siteUrl; ?>/<?php echo $post->postSlug; ?>/<?php echo $website->id; ?>/<?php echo $post->postID; ?>" style="color:#fff;">
								<?php echo $post->postTitle; ?>
							</a>	
							</div>
							<div class="blog-title-date" style="background-color: #2E2E2E; color: #fff; font-size: 12px; padding: 6px;">
								Created On : <?php echo date('dS F,Y',strtotime($post->createdDate));?> &nbsp;&nbsp;&nbsp;
								By : ADMIN
							</div>
							<div class="blog-contents" style="margin-top: 9px; font-family: serif; font-size: 18px;"><?php echo $post->postDescription; ?></div>
							<div class="page-nav page-nav-post" style="margin-bottom:0px;">
								<div class="next">
									<a href="<?php echo $siteUrl; ?>/<?php echo $post->postSlug; ?>/<?php echo $website->id; ?>/<?php echo $post->postID; ?>">
									<span>Read More...</span>
									</a>
								</div>
							</div>
						</div>
					</div>	
				</div>
			    <?php $i++;  if($i==3) { ?>
				<div class="ad-unit-2"></div>
				<?php } if($i==6) { ?>
				<div class="ad-unit-3"></div>	
				<?php } if($i==9) { ?>
				<div class="ad-unit-4"></div>
				<?php } ?>
			  <?php endforeach;  ?>
			<?php else: ?>
				<?php echo "Website does not contains any post."; ?>
			<?php endif; ?>
		<?php else : ?>
			<?php echo $api_response->error; ?>
        <?php endif; ?>  
        </figure>
		<?php if($nb>1) { ?>
		<ul class="pagination pagination-split m-bottom-md">
		<?php 	for($s=1;$s<=$nb;$s++) {
					if($s==1){ ?>
					<li><a class="active" href="javascript:void(0);" onclick="display(<?php echo $s;?>)" style="background-color:#58ACFA;color:#fff;"><?php echo $s;?></a></li>
		<?php 		}
					else{ ?>
					<li><a href="javascript:void(0);" onclick="display(<?php echo $s;?>)"><?php echo $s;?></a></li>
		<?php 		}
				}
		?>			<li><a href="javascript:void(0);" onclick="display(2)">Next</a></li>
		</ul>	
		<?php } ?>
      </section>
      <!-- ####################################################################################################### -->
    </div>
	
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<input type="hidden" id="ad-unit-1" name="ads"/>
<input type="hidden" id="ad-unit-2" name="ads2"/>
<input type="hidden" id="ad-unit-3" name="ads3"/>
<input type="hidden" id="ad-unit-4" name="ads4"/>
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
<!-- Scripts -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="scripts/jquery-latest.min.js"><\/script>\
<script src="scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="scripts/jquery-mobilemenu.min.js"></script>
<script src="scripts/custom.js"></script>
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
                //console.log(data);
                if(data['haveAds']=="True"){
                    $('.ad-unit-1').html(data['ads']['adUnit1']);
                    $('#ad-unit-1').val(data['ads']['adUnit1']);
                    $('.ad-unit-2').html(data['ads']['adUnit2']);
                    $('#ad-unit-2').val(data['ads']['adUnit2']);
                    $('.ad-unit-3').html(data['ads']['adUnit3']);
                    $('#ad-unit-3').val(data['ads']['adUnit3']);
                    $('.ad-unit-4').html(data['ads']['adUnit4']);
                    $('#ad-unit-4').val(data['ads']['adUnit4']);
                    //$('#ads').val(data);
                    //alert(data['ads']['adUnit5']);
                    /*$('.ad-unit-5').html(data['ads']['adUnit5']);
                    $('.ad-unit-6').html(data['ads']['adUnit6']);
                    $('.ad-mobile-1').html(data['ads']['adMobile1']);
                    $('.ad-mobile-2').html(data['ads']['adMobile2']);
                    $('.ad-mobile-3').html(data['ads']['adMobile3']);*/
                }
              },
            error: function (request, status, error) {
                log("Error: getLatLong Status - " + status + " ErrorText - " + error);
            }
        });
	});	
	function display(val)
	{
		event.preventDefault();
		//alert(val);
		var data = <?php echo json_encode($post_data); ?>;
		$.ajax({
			type: "POST",
			url: 'pagination.php',
			data: {pagenum: val, posts:data, website:<?php echo json_encode($website);?>,nb:<?php echo $nb;?> },
			
			success: function(result)
			{
			   //alert(result);
				$("#gallery").html(result);
				$("img.lazy").lazyload();	
				var ads = $('#ads').val();
				$('.ad-unit-1').html($('#ad-unit-1').val());
				$('.ad-unit-2').html($('#ad-unit-2').val());
				$('.ad-unit-3').html($('#ad-unit-3').val());
				$('.ad-unit-4').html($('#ad-unit-4').val());
			}
		});
	}
</script>
</body>
</html>