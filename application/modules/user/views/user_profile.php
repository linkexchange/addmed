<script src="<?php echo base_url();?>js/jquery.circliful.min.js"></script>
<script src="<?php echo base_url();?>js/jscharts.js"></script>
<link href="<?php echo base_url();?>css/jquery.circliful.css" rel="stylesheet" type="text/css" />
<?php //echo "<pre>"; print_R($privacy_account); exit; ?>
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
										<img src="<?php echo  base_url();?>uploads/user_profile_images/<?php echo $this->session->userdata("userPic");?>" alt="User Avatar" class="img-thumbnail">
									</a>
								</div><!-- /.col -->
								<div class="col-sm-6">
									<h3><strong><?php echo $this->session->userdata("userName");?></strong></h3> 
									<?php if($privacy_profile[0]["email"]=="1") { ?>
									<h5>
										<?php echo $this->session->userdata("email");?>
									</h5> 
									<?php } ?>
									<h5>User type: <?php echo $this->session->userdata("userType");?></h5>
									<h5>Status Update : Yes</h5>
									<h5>Social Profiles :</h5>
									<?php if(($url[0]["facebook_url"]!="")&&($privacy[0]["facebook_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["facebook_url"];?>" class="social-connect tooltip-test facebook-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
									<?php } 
									if(($url[0]["twitter_url"]!="")&&($privacy[0]["twitter_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["twitter_url"];?>" class="social-connect tooltip-test twitter-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
									<?php }
									if(($url[0]["tubmlr_url"]!="")&&($privacy[0]["tumblr_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["tubmlr_url"];?>" class="social-connect tooltip-test tumblr-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="tumblr"><i class="fa fa-tumblr"></i></a>
									<?php }
									if(($url[0]["pinterest_url"]!="")&&($privacy[0]["pinterest_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["pinterest_url"];?>" class="social-connect tooltip-test pinterest-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Pinterest"><i class="fa fa-pinterest"></i></a>
									<?php } 
									if(($url[0]["instagram_url"]!="")&&($privacy[0]["instagram_url"]=="1")) { ?>
									<a href="<?php echo $url[0]["instagram_url"];?>" class="social-connect tooltip-test instagram-hover pull-left" data-toggle="tooltip" data-original-title="instagram"><i class="fa fa-instagram"></i></a>
									<?php } ?>
									<div class="seperator"></div>
									<div class="seperator"></div>
								</div><!-- /.col -->
							</div>
						</div><!-- /panel -->
						
					</div><!-- /.col -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default fadeInDown animation-delay2">
							<div class="panel-heading">
								<strong>Social Reach</strong>
							</div>
							<div class="panel-body">
								<div class="col-sm-3" style="background-color:#eee;">
									<?php 
										$total = $totalTwitterFollowers[0]['smaAccountFollowers']+$totalFacebookFollowers[0]['smaAccountFollowers']+$totalTumblrFollowers[0]['smaAccountFollowers']+$totalInstagramFollowers[0]['smaAccountFollowers'];
									?>
									<div id="myStat2" data-dimension="190" data-text="<?php echo $total;?>" data-info="New Clients" data-width="8" data-fontsize="30" data-percent="0" data-fgcolor="#2EFE64" data-bgcolor="#00aced"></div>
								</div><!-- /.col -->
								<?php if(($totalTwitterFollowers[0]['smaAccountFollowers']!="")&&($privacy_account[0]['twitter_account']==1)) { ?>
								<div class="col-sm-1">
									<b><h4>Twitter</h4>
									<h4><?php echo $totalTwitterFollowers[0]['smaAccountFollowers'];?>  followers</h4></b>
									<div id="upper" style="background-color:#eee;height:114px;">
									</div>
									<div id="lower" style="background-color:#00aced;height:13px;">
									</div>
								</div>
								<?php } ?>
								<?php if(($totalFacebookFollowers[0]['smaAccountFollowers']!="")&&($privacy_account[0]['facebook_account']==1)) { ?>
								<div class="col-sm-1">
									<b><h4>Facebook</h4>
									<h4><?php echo $totalFacebookFollowers[0]['smaAccountFollowers']; ?> likes</h4></b>
									<div id="upper" style="background-color:#eee;height:114px;">
									</div>
									<div id="lower" style="background-color:#3b5998;height:13px;">
									</div>
								</div>
								<?php  } ?>
								<?php if(($totalTumblrFollowers[0]['smaAccountFollowers']!="")&&($privacy_account[0]['tumblr_account']==1)) { ?>
								<div class="col-sm-1">
									<b><h4>tumblr</h4>
									<h4><?php echo $totalTumblrFollowers[0]['smaAccountFollowers']; ?> followers</h4></b>
									<div id="upper" style="background-color:#eee;height:126px;">
									</div>
									<div id="lower" style="background-color:#2c4762 ;height:1px;">
									</div>
								</div>
								<?php } ?>
								<?php if(($totalInstagramFollowers[0]['smaAccountFollowers']!="")&&($privacy_account[0]['instagram_account']==1)) { ?>
								<div class="col-sm-1">
									<b><h4>instagram</h4>
									<h4><?php echo $totalInstagramFollowers[0]['smaAccountFollowers']; ?> followers</h4></b>
									<div id="upper" style="background-color:#eee;height:114px;">
									</div>
									<div id="lower" style="background-color:#1c5380;height:13px;">
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
										<div id="upper" style="background-color:#fff;height:114px;">
										</div>
										<div id="lower" style="background-color:#00aced;height:13px;">
										</div>
									</div>
								</div><!-- /.col -->
								
								<div class="col-sm-9" style="overflow:scroll; height:166px;">
									<table class="table table-hover table-striped">
										<tbody>
									<?php foreach($twitterProfiles as $twitterAcc) : 
											if($twitterAcc['public']=="1") { ?>
											<tr id="sma-acc-<?php echo $twitterAcc['id']; ?>">
												<td class="acc_image">
													<span class="img-demo">
														<img src="<?php echo $twitterAcc['smaAccountProfileImageUrl']; ?>" />
													</span>
												</td>  
												<td class="acc_name">
													<div class="pull-left m-left-sm m-top-sm ">
														<h4><strong><?php echo $twitterAcc['smaAccountName']; ?></strong></h4>
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
										<?php } endforeach; ?>
										</tbody>
									</table>
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
										<h4><b><?php echo $totalFacebookFollowers[0]['smaAccountFollowers'];?> Followers</b></h4>
										<div id="upper" style="background-color:#fff;height:114px;">
										</div>
										<div id="lower" style="background-color:#3b5998;height:13px;">
										</div>
									</div>
								</div><!-- /.col -->
								
								<div class="col-sm-9" style="overflow:scroll; height:166px;">
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
													<td class="acc_posts">
														<div class="pull-left m-left-sm m-top-sm">
															<select name="privacy" class="form-control" id="facebook_p_<?php echo $accRecord["id"];?>" onchange="setFacebookPrivacy(<?php echo $accRecord["id"];?>);">
																<option value="1" 
																	<?php 
																		if($accRecord["public"]=="1")
																		{
																			echo 'selected="selected"';
																		}
																	?>>Public
																</option>
																<option value="0"
																	<?php 
																		if($accRecord["public"]=="0")
																		{
																			echo 'selected="selected"';
																		}
																	?>>Private
																</option>
															</select>
														</div>
													</td>
													<td class="acc_actions">
														<div class="pull-left m-left-sm m-top-sm ">
															<a href="javascript:void(0);" title="Disconnect" alt="Disconnect" onclick="removeRecord(<?php echo $accRecord['id']; ?>,1,'<?php echo 'Tumblr'; ?>');">
																<h4><strong> <i class="fa fa-ban"></i></strong></h4> 
															</a>
														</div>
													</td>
												</tr>
											<?php } endforeach; ?>
										</tbody>
									</table>
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
										<div id="upper" style="background-color:#fff;height:114px;">
										</div>
										<div id="lower" style="background-color:#3b5998;height:13px;">
										</div>
									</div>
								</div><!-- /.col -->
								
								<div class="col-sm-9" style="overflow:scroll; height:166px;">
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
													<td class="acc_posts">
														<div class="pull-left m-left-sm m-top-sm">
															<select name="privacy" class="form-control" id="instagram_p_<?php echo $accRecord["id"];?>" onchange="setInstagramPrivacy(<?php echo $accRecord["id"];?>);">
																<option value="1" 
																	<?php 
																		if($accRecord["public"]=="1")
																		{
																			echo 'selected="selected"';
																		}
																	?>>Public
																</option>
																<option value="0"
																	<?php 
																		if($accRecord["public"]=="0")
																		{
																			echo 'selected="selected"';
																		}
																	?>>Private
																</option>
															</select>	
														</div>
													</td>
													<!-- <td class="acc_likes">
														<div class="pull-left m-left-sm m-top-sm">
															<h4><strong><?php echo $accRecord['smaAccountLikes']; ?></strong></h4>
															<span class="text-muted block">Likes</span> 
														</div>
													</td> -->
													<td class="acc_actions">
														<div class="pull-left m-left-sm m-top-sm ">
															<a href="javascript:void(0);" title="Disconnect" alt="Disconnect" onclick="removeRecord(<?php echo $accRecord['id']; ?>,1,'<?php echo 'Instagram'; ?>');">
																<h4><strong> <i class="fa fa-ban"></i></strong></h4> 
															</a>
														</div>
													</td>
												</tr>
											<?php } endforeach; ?>
										</tbody>
									</table>
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
										<div id="upper" style="background-color:#fff;height:126px;">
										</div>
										<div id="lower" style="background-color:#3b5998;height:1px;">
										</div>
									</div>
								</div><!-- /.col -->
								
								<div class="col-sm-9" style="overflow:scroll; height:166px;">
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
								</div>
							</div>
						</div><!-- /panel -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			<?php } ?>			
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
</script>

