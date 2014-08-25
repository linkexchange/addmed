<script src="<?php echo base_url();?>js/jquery.circliful.min.js"></script>
<script src="<?php echo base_url();?>js/jscharts.js"></script>
<link href="<?php echo base_url();?>css/jquery.circliful.css" rel="stylesheet" type="text/css" />
<?php //echo "<pre>"; print_R($user); exit; ?>
<div id="main-container">
	<div class="padding-md">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default fadeInDown animation-delay2">
							<div class="panel-heading">
								<b>User Profile</b>
							</div>
							<div class="panel-body">
								<div class="col-sm-3">
									<a href="#">
										<?php if($user[0]["profile_image"]){ ?>
										<img src="<?php echo  base_url();?>uploads/user_profile_images/<?php echo $user[0]["profile_image"];?>" alt="User Avatar" class="img-thumbnail">
										<?php } 
										else { ?>
										<img src="<?php echo  base_url();?>img/user.jpg" alt="User Avatar" class="img-thumbnail">
										<?php 
										}
										?>	
									</a>
								</div><!-- /.col -->
								<div class="col-sm-6">
									<h3><strong><?php echo $user[0]["userName"];?></strong></h3> 
									<?php 
									if($privacy_profile) {
									if($privacy_profile[0]["email"]=="1") { ?>
									<h5>
										<?php echo $user[0]["email"];?>
									</h5> 
									<?php } 
									else { ?>
									<h5>
										<?php echo $user[0]["email"];?>
									</h5> 
									<?php } } ?>
									<h5>User type: <?php echo $user[0]["type"];?></h5>
									<h5>Status Update : Yes</h5>
									<div class="seperator"></div>
									<div class="seperator"></div>
								</div><!-- /.col -->
							</div>
						<?php if(($url)&&($privacy)) { ?>
				
							
							<div class="panel-heading" style="height:50px;">
								<div class="col-sm-2">
									<h4><strong>Social Profiles </strong></h4> 
								</div>
								<div class="col-sm-6">
									<?php if(($url[0]["facebook_url"]!="")&&($privacy[0]["facebook_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["facebook_url"];?>" target="_blank" class="social-connect tooltip-test facebook-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
									<?php } 
									if(($url[0]["twitter_url"]!="")&&($privacy[0]["twitter_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["twitter_url"];?>" 
									target="_blank" class="social-connect tooltip-test twitter-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
									<?php }
									if(($url[0]["tubmlr_url"]!="")&&($privacy[0]["tumblr_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["tubmlr_url"];?>" target="_blank" 
									class="social-connect tooltip-test tumblr-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="tumblr"><i class="fa fa-tumblr"></i></a>
									<?php }
									if(($url[0]["pinterest_url"]!="")&&($privacy[0]["pinterest_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["pinterest_url"];?>" target="_blank" class="social-connect tooltip-test pinterest-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Pinterest"><i class="fa fa-pinterest"></i></a>
									<?php } 
									if(($url[0]["instagram_url"]!="")&&($privacy[0]["instagram_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["instagram_url"];?>" target="_blank"class="social-connect tooltip-test instagram-hover pull-left" data-toggle="tooltip" data-original-title="instagram"><i class="fa fa-instagram"></i></a>
									<?php } ?>
								</div>
							</div>
				<?php } ?>
						</div><!-- /panel -->
					</div><!-- /.col -->
				</div><!-- /.row -->
				<?php
					if($privacy_account) {
						if($privacy_account[0]['twitter_account']==1)
						{
							$total = $totalTwitterFollowers[0]['smaAccountFollowers'];
						}
						else
						{
							$total = 0;
						}
						if($privacy_account[0]['facebook_account']==1)
						{	
							$total = $total + $totalFacebookFollowers[0]['smaAccountFollowers'];
						}
						if($privacy_account[0]['tumblr_account']==1)
						{
							$total = $total + $totalTumblrFollowers[0]['smaAccountFollowers'];
						}
						if($privacy_account[0]['instagram_account']==1)
						{	
							$total = $total + $totalInstagramFollowers[0]['smaAccountFollowers'];
						}
					}
					if($totalTwitterFollowers[0]['smaAccountFollowers']>500)
					{
						$twitterheight = "127";
					}
					else 
					{
						$twitterheight = $totalTwitterFollowers[0]['smaAccountFollowers']/10;
					}
					$upperheight = 127 - $twitterheight;
					if($totalFacebookFollowers[0]['smaAccountFollowers']>500)
					{
						$facebookheight = "127";
					}
					else 
					{
						$facebookheight = $totalFacebookFollowers[0]['smaAccountFollowers']/10;
					}
					$upperheight2 = 127 - $facebookheight;
					if($totalTumblrFollowers[0]['smaAccountFollowers']>500)
					{
						$tumblrheight = "127";
					}
					else 
					{
						$tumblrheight = $totalTumblrFollowers[0]['smaAccountFollowers']/10;
					}
					$upperheight3 = 127 - $tumblrheight;
					if($totalInstagramFollowers[0]['smaAccountFollowers']>500)
					{
						$instagramheight = "127";
					}
					else 
					{
						$instagramheight = $totalInstagramFollowers[0]['smaAccountFollowers']/10;
					}
					$upperheight4 = 127 - $instagramheight;
				if($user[0]["userTypeID"]=="3" && $total!="0") {	
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default fadeInDown animation-delay2">
							<div class="panel-heading">
								<strong>Social Reach</strong>
							</div>
							<div class="panel-body">
								<div class="col-sm-3" style="background-color:#eee;">
									
									<div id="myStat2" data-dimension="190" data-text="<?php 
									if(isset($total)) { echo $total; } else { echo '0'; }?>" 
									data-info="New Clients" data-width="8" data-fontsize="30" data-percent="0" data-fgcolor="#2EFE64" data-bgcolor="#00aced"></div>
								</div><!-- /.col -->
								<?php if(($totalTwitterFollowers[0]['smaAccountFollowers']!="")&&($privacy_account[0]['twitter_account']==1)) { ?>
								<div class="col-sm-1">
									<b><h4 style="color:#00aced;">
									<?php echo $totalTwitterFollowers[0]['smaAccountFollowers'];?>  </h4>
									<h4 style="color:#00aced;">Twitter</h4></b>
									<div id="upper" style="background-color:#fff;height:<?php echo $upperheight;?>px;">
									</div>
									<div id="lower" style="background-color:#00aced;height:<?php echo $twitterheight;?>px;">
									</div>
								</div>
								<?php } ?>
								<?php if(($totalFacebookFollowers[0]['smaAccountFollowers']!="")&&($privacy_account[0]['facebook_account']==1)) { ?>
								<div class="col-sm-1">
									<b><h4 style="color:#3b5998;"><?php echo $totalFacebookFollowers[0]['smaAccountFollowers']; ?></h4>
									<h4 style="color:#3b5998;">Facebook</h4></b>
									<div id="upper" style="background-color:#fff;height:<?php echo $upperheight2;?>px;">
									</div>
									<div id="lower" style="background-color:#3b5998;height:<?php echo $facebookheight;?>px;">
									</div>
								</div>
								<?php  } ?>
								<?php if(($totalTumblrFollowers[0]['smaAccountFollowers']!="")&&($privacy_account[0]['tumblr_account']==1)) { ?>
								<div class="col-sm-1">
									<b>
									<h4 style="color:#2c4762;"><?php echo $totalTumblrFollowers[0]['smaAccountFollowers']; ?> </h4>
									<h4 style="color:#2c4762;">tumblr</h4>
									</b>
									<div id="upper" style="background-color:#fff;height:<?php echo $upperheight3;?>px;">
									</div>
									<div id="lower" style="background-color:#2c4762;height:<?php echo $tumblrheight;?>px;">
									</div>
								</div>
								<?php } ?>
								<?php if(($totalInstagramFollowers[0]['smaAccountFollowers']!="")&&($privacy_account[0]['instagram_account']==1)) { ?>
								<div class="col-sm-1">
									<b>
									<h4 style="color:#1c5380;"><?php echo $totalInstagramFollowers[0]['smaAccountFollowers']; ?> </h4>
									<h4 style="color:#1c5380;">instagram</h4>
									</b>
									<div id="upper" style="background-color:#fff;height:<?php echo $upperheight4;?>px;">
									</div>
									<div id="lower" style="background-color:#1c5380;height:<?php echo $instagramheight;?>px;">
									</div>
								</div>
								<?php } ?>
							</div>
						</div><!-- /panel -->
					</div><!-- /.col -->
				</div><!-- /.row -->
				<?php if(($privacy_account[0]['twitter_account']==1)&&($totalTwitterFollowers[0]['smaAccountFollowers']!="")) { ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default fadeInDown animation-delay2">
							<div class="panel-heading">
								<strong style="font-size:21px;"><img src="<?php echo base_url();?>img/tweet.jpg" style="width:124px;">  followers</strong>
							</div>
							<div class="panel-body">
								<div class="col-sm-3" style="background-color:#eee;">
									<div style="width:56%;">
										<h4><b><?php echo $totalTwitterFollowers[0]['smaAccountFollowers'];?> Followers</b></h4>
										<div id="upper" style="background-color:#eee;height:<?php echo $upperheight;?>px;">
										</div>
										<div id="lower" style="background-color:#00aced;height:<?php echo $twitterheight;?>px;">
										</div>
									</div>
								</div><!-- /.col -->
								
								<div class="col-sm-9" style="overflow:scroll; height:166px;" id="twitter">
								<table class="table table-hover table-striped">
                                <tbody>
                                    <?php foreach($twitterProfiles as $twitterAcc) : ?>
                                    <tr id="sma-acc-<?php echo $twitterAcc['id']; ?>">
                                            <td class="acc_image">
                                                <span class="img-demo">
                                                    <img src="<?php echo $twitterAcc['smaAccountProfileImageUrl']; ?>" />
                                                </span>
                                            </td>  
                                            <td class="acc_name">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <a href="https://twitter.com/<?php echo $twitterAcc['smaAccountName'];?>"><h4><strong><?php echo $twitterAcc['smaAccountName']; ?></strong></h4>
													</a>
                                                    <!-- <span class="badge badge-success">5 items</span>
                                                    <span class="text-muted block">$360</span> -->
                                                </div>
                                            </td>
                                            <td class="acc_followers">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong><?php echo $twitterAcc['smaAccountFollowers']; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Followers</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm">
                                                    <h4><strong><?php echo $twitterAcc['smaAccountPosts']; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Posts</span> 
                                                </div>
                                            </td>
										</tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                         
                            <?php 
                                $count=$twitterProfileCount;
                                $parameters=array();
                                $parameters[0]="Twitter";
                                ajaxPagination('getRecords2',$parameters,$count); 
                            ?>
								</div>
							</div>
						</div><!-- /panel -->
					</div><!-- /.col -->
				</div><!-- /.row -->
				<?php } ?>
				<?php if(($privacy_account[0]['facebook_account']==1)&&($totalFacebookFollowers[0]['smaAccountFollowers']!="")) { ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default fadeInDown animation-delay2">
							<div class="panel-heading">
								<strong style="font-size:21px;"><img src="<?php echo base_url();?>img/fb1.png" style="width:124px;"> likes</strong>
							</div>
							<div class="panel-body">
								<div class="col-sm-3" style="background-color:#eee;">
									<div style="width:56%;">
										<h4><b><?php echo $totalFacebookFollowers[0]['smaAccountFollowers'];?> Likes</b></h4>
										<div id="upper" style="background-color:#eee;height:<?php echo $upperheight2;?>px;">
										</div>
										<div id="lower" style="background-color:#3b5998;height:<?php echo $facebookheight;?>px;">
										</div>
									</div>
								</div><!-- /.col -->
								
								<div class="col-sm-9" style="overflow:scroll; height:166px;" id="facebook">
									<table class="table table-hover table-striped">
										<tbody>
									<?php foreach($facebookProfiles as $accRecord) : 
											if($accRecord["public"]=="1") { ?>
											<tr id="sma-acc-<?php echo $accRecord['id']; ?>">
												   <td class="acc_image">
														<span class="img-demo">
															<img src="<?php echo $accRecord['smaAccountProfileImageUrl']; ?>" />
														</span>
													</td>   
													<td class="acc_name">
														<div class="pull-left m-left-sm m-top-sm ">
															<h4><strong><?php echo $accRecord['smaAccountName']; ?></strong></h4>
														</div>
													</td>
													<!-- <td class="acc_blogs">
														<div class="pull-left m-left-sm m-top-sm ">
															<h4><strong><?php echo $accRecord['smaAccountBlogs']; ?></strong></h4>
															<span class="text-muted block">Blogs</span> 
														</div>
													</td> 
													<td class="acc_followers">
														<div class="pull-left m-left-sm m-top-sm ">
															<h4><strong><?php echo $accRecord['smaAccountFollowers']; ?></strong></h4>
															<span class="text-muted block">Followers</span> 
														</div>
													</td> -->
													<td class="acc_posts">
														<div class="pull-left m-left-sm m-top-sm">
															<h4><strong><?php echo $accRecord['smaAccountPosts']; ?></strong></h4>
															<span class="text-muted block">Pages</span> 
														</div>
													</td>
													<td class="acc_likes">
														<div class="pull-left m-left-sm m-top-sm">
															<h4><strong><?php echo $accRecord['smaAccountLikes']; ?></strong></h4>
															<span class="text-muted block">Likes</span> 
														</div>
													</td>
												</tr>
											<?php } endforeach; ?>
										</tbody>
									</table>
									<?php 
										$count=$facebookProfileCount;
										$parameters=array();
										$parameters[0]="Facebook";
										ajaxPagination('getRecords2',$parameters,$count); 
									?>
								</div>
							</div>
						</div><!-- /panel -->
					</div><!-- /.col -->
				</div><!-- /.row -->
				<?php } ?>
				<?php if(($privacy_account[0]['instagram_account']==1)&&($totalInstagramFollowers[0]['smaAccountFollowers']!="")) { ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default fadeInDown animation-delay2">
							<div class="panel-heading">
								<strong style="font-size:21px;"><img src="<?php echo base_url();?>img/instagram.jpg" style="width:124px;"> followers</strong>
							</div>
							<div class="panel-body">
								<div class="col-sm-3" style="background-color:#eee;">
									<div style="width:56%;">
										<h4><b><?php echo $totalInstagramFollowers[0]['smaAccountFollowers'];?> Followers</b></h4>
										<div id="upper" style="background-color:#eee;height:<?php echo $upperheight3;?>px;">
										</div>
										<div id="lower" style="background-color:#3b5998;height:<?php echo $instagramheight;?>px;">
										</div>
									</div>
								</div><!-- /.col -->
								
								<div class="col-sm-9" style="overflow:scroll; height:166px;" id="instagram">
									<table class="table table-hover table-striped">
										<tbody>
										<?php foreach($instagramProfiles as $accRecord) : 
												if($accRecord["public"]=="1") { ?>
											<tr id="sma-acc-<?php echo $accRecord['id']; ?>">
													<td class="acc_image">
														<span class="img-demo">
															<img src="<?php echo $accRecord['smaAccountProfileImageUrl']; ?>" />
														</span>
													</td>   
													<td class="acc_name">
														<div class="pull-left m-left-sm m-top-sm ">
															<h4><strong><?php echo $accRecord['smaAccountName']; ?></strong></h4>
														</div>
													</td>
													
													<td class="acc_followers">
														<div class="pull-left m-left-sm m-top-sm ">
															<h4><strong><?php echo $accRecord['smaAccountFollowers']; ?></strong></h4>
															<span class="text-muted block">Followers</span> 
														</div>
													</td>
													<td class="acc_posts">
														<div class="pull-left m-left-sm m-top-sm">
															<h4><strong><?php echo $accRecord['smaAccountPosts']; ?></strong></h4>
															<span class="text-muted block">Posts</span> 
														</div>
													</td>
												</tr>
											<?php } endforeach; ?>
										</tbody>
									</table>
									<?php 
										$count=$instagramProfileCount;
										$parameters=array();
										$parameters[0]="Instagram";
										ajaxPagination('getRecords2',$parameters,$count); 
									?>
								</div>
							</div>
						</div><!-- /panel -->
					</div><!-- /.col -->
				</div><!-- /.row -->
				<?php } ?>
				<?php if(($privacy_account[0]['tumblr_account']==1)&&($totalTumblrFollowers[0]['smaAccountFollowers']!="")) { ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default fadeInDown animation-delay2">
							<div class="panel-heading">
								<strong style="font-size:21px;"><img src="<?php echo base_url();?>img/tumblr.jpg" style="width:124px;"> followers</strong>
							</div>
							<div class="panel-body">
								<div class="col-sm-3" style="background-color:#eee;">
									<div style="width:56%;">
										<h4><b><?php echo $totalTumblrFollowers[0]['smaAccountFollowers'];?> Followers</b></h4>
										<div id="upper" style="background-color:#eee;height:<?php echo $upperheight4;?>px;">
										</div>
										<div id="lower" style="background-color:#3b5998;height:<?php echo $tumblrheight;?>px;">
										</div>
									</div>
								</div><!-- /.col -->
								
								<div class="col-sm-9" style="overflow:scroll; height:166px;" id="tumblr">
									<table class="table table-hover table-striped">
										<tbody>
										<?php foreach($tumblrProfiles as $accRecord) : 
												if($accRecord["public"]=="1") { ?>
											<tr id="sma-acc-<?php echo $accRecord['id']; ?>">
													<!-- <td class="acc_image">
														<span class="img-demo">
															<img src="<?php echo $accRecord['smaAccountProfileImageUrl']; ?>" />
														</span>
													</td> -->  
													<td class="acc_name">
														<div class="pull-left m-left-sm m-top-sm ">
															<h4><strong><?php echo $accRecord['smaAccountName']; ?></strong></h4>
														</div>
													</td>
													<td class="acc_blogs">
														<div class="pull-left m-left-sm m-top-sm ">
															<h4><strong><?php echo $accRecord['smaAccountBlogs']; ?></strong></h4>
															<span class="text-muted block">Blogs</span> 
														</div>
													</td>
													<td class="acc_followers">
														<div class="pull-left m-left-sm m-top-sm ">
															<h4><strong><?php echo $accRecord['smaAccountFollowers']; ?></strong></h4>
															<span class="text-muted block">Followers</span> 
														</div>
													</td>
													<td class="acc_posts">
														<div class="pull-left m-left-sm m-top-sm">
															<h4><strong><?php echo $accRecord['smaAccountPosts']; ?></strong></h4>
															<span class="text-muted block">Posts</span> 
														</div>
													</td>
													<td class="acc_likes">
														<div class="pull-left m-left-sm m-top-sm">
															<h4><strong><?php echo $accRecord['smaAccountLikes']; ?></strong></h4>
															<span class="text-muted block">Likes</span> 
														</div>
													</td>
												</tr>
											<?php } endforeach; ?>
										</tbody>
									</table>
									<?php 
										$count=$tumblrProfileCount;
										$parameters=array();
										$parameters[0]="Tumblr";
										ajaxPagination('getRecords2',$parameters,$count); 
									?>
								</div>
							</div>
						</div><!-- /panel -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			<?php } }?>			
			</div><!-- /.col -->
		</div><!-- /.row -->			
	</div><!-- /.padding-md -->
</div>
<script>
$( document ).ready(function() {
        $('#myStathalf').circliful();
		$('#myStat').circliful();
		$('#myStathalf2').circliful();
		$('#myStat2').circliful();
});
function getRecords2(pageNum,type){
	$.ajax({
		url:"<?php echo base_url(); ?>publisher/ajaxfunctions/getAccountRecords2/"+pageNum+"/"+type,
			//beforeSend: loadStartPub,
	//complete: loadStopPub,
		success:function(result){
			//alert(result);
			if(type=='Twitter'){
				$('#twitter').html(result);
			}
			if(type=='Facebook'){
				$('#facebook').html(result);
			}
			if(type=='Tumblr'){
				$('#tumblr').html(result);
			}
			if(type=='Instagram'){
				$('#instagram').html(result);
			}
			
			//$(".accepted table").html(result);
	 }});
		//pageactive(pid);
}
</script>

