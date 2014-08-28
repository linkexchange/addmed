<?php
	include('config.php');
	if(isset($_POST["pagenum"]))
	{
		$i=0; $index = $_POST["pagenum"]-1; 
		$pageno = $_POST["pagenum"];
		$posts  = $_POST["posts"];
		$number = $_POST["nb"];
		$posts  = $posts[$index];
		$website = $_POST["website"];
		//echo "<pre>"; print_R($posts); exit;
		//echo "<br/><pre>"; print_R($website); 
		//echo $posts[0]["postImage"]."<br/>";
		//echo $website["name"]."<br/>";
		
	}	
?>

<section>
	<figure>
	  <!-- <h2>Gallery Title Goes Here</h2> -->
	  
		  <div class="latest-post" style="background-color:#58ACFA;color:#fff;
			  height:50px;padding-left: 21px; font-family: cursive; font-size: x-large;"><br/>
			Latest Posts 
		  </div>	
		  <div class="ad-unit-1"></div>
		  <?php //echo "<pre>"; print_R($api_response); exit;
			$i=0;
		  ?>
		  <?php foreach($posts as $post) : ?>
			<div class="list-blog" style="width:100%;display:inline-block;
				background-color:#eee;margin-bottom:12px;">
				<div class="blog-image" style="width:25%;float:left;">
					<a href="<?php echo $siteUrl; ?>/<?php echo $post["postSlug"]; ?>/<?php echo $website["id"]; ?>/<?php echo $post["postID"]; ?>">
						<!-- <img src="<?php echo $post->postImage; ?>" alt=""> -->
						<img class="lazy" data-original="<?php echo $post["postImage"]; ?>" /> 
					</a>
				</div>
				<div class="blog-desc" style="width:70%;float:left;padding:2%">	
					<?php $title_len=strlen($post["postTitle"]); ?>
					<div class="<?php if($title_len>45) : ?>high-bx-caption <?php else : ?>bx-caption<?php endif; ?> "> 
						<div class="blog-title-header" style="background-color: #58ACFA; color: #fff; font-size: 21px; padding: 11px; font-family: cursive;">
						<a href="<?php echo $siteUrl; ?>/<?php echo $post["postSlug"]; ?>/<?php echo $website["id"]; ?>/<?php echo $post["postID"]; ?>" style="color:#fff;">
							<?php echo $post["postTitle"]; ?>
						</a>	
						</div>
						<div class="blog-title-date" style="background-color: #2E2E2E; color: #fff; font-size: 12px; padding: 6px;">
							Created On : <?php echo date('dS F,Y',strtotime($post["createdDate"]));?> &nbsp;&nbsp;&nbsp;
							By : ADMIN
						</div>
						<div class="blog-contents" style="margin-top: 9px; font-family: serif; font-size: 18px;"><?php echo $post["postDescription"]; ?></div>
						<div class="page-nav page-nav-post" style="margin-bottom:0px;">
							<div class="next">
								<a href="<?php echo $siteUrl; ?>/<?php echo $post["postSlug"]; ?>/<?php echo $website["id"]; ?>/<?php echo $post["postID"]; ?>">
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
	</figure>
	<?php $s = $pageno - 1; ?>
	<ul class="pagination pagination-split m-bottom-md">
	<?php	if($pageno!=1) { ?>		
				<li><a href="#" onclick="display(<?php echo $s;?>)">Previous</a></li>
	<?php 	}
		if($number<5) {
				for($s=1;$s<=$number;$s++) {
					if($s==$pageno){ ?>
					<li><a class="active" href="#" onclick="display(<?php echo $s;?>)" style="background-color:#58ACFA;color:#fff;"><?php echo $s;?></a></li>
	<?php 			}
				else{ ?>
				<li><a href="#" onclick="display(<?php echo $s;?>)"><?php echo $s;?></a></li>
	<?php 		}
			}
			if($number!=$pageno) {		
	?>			<li><a href="#" onclick="display(<?php echo $pageno+1;?>)">Next</a></li>
	<?php 	} 
		} ?>
	</ul>	
</section> 
 