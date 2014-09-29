<style>
.overview { border:1px solid #D6E9F3; padding : 21px; text-align: center;}
.main-tab { font-size : 17pt;}
/*.pricing-head {min-height:45px;}*/
.success {color:#88ca4c;}
.danger {color:red;}
.col-sm-6{text-align: center;}
.pricing-head{padding:15px;text-align: center;}
.col-sm-7{text-align: center;}
.zero-twenty{color:red;}
.twenty-forty{color:#FA8258;}
.forty-sixty{color:#D7DF01;}
.sixty-seventy{color:#D7DF09;}
/*.sixty-eighty{color:#F2F5A9;}*/
.seventy-ninety-nine{color:#90C844;}
.hundred{color:green;}
</style>
<?php //echo "<pre>"; print_R($monetization); exit; ?>
<script>
	$(document).ready(function(){
		$("#comment_desc").hide();
		$("#reply_desc").hide();
	});
</script>
<?php $actual_link = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "d78c9ed2-be1a-4a83-857c-fa492054996a", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine-en.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="<?php echo base_url();?>js/jquery.circliful.min.js"></script>
<link href="<?php echo base_url();?>css/jquery.circliful.css" rel="stylesheet" type="text/css" />
<style>
#circle {
  margin: 10px;
}
</style>
<?php $id = $this->uri->segment(4);?>
<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><?php echo $article[0]['topic'];?></h3>
				<small class="text-muted">By <a href="#"><strong> <?php echo $article[0]['userName'];?></strong></a> |  Post on <?php echo $article[0]['created_date'];?>  | <?php echo $article[0]['no_of_replies'];?> comments</small>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">	
				<div class="row">	
					<div class="col-md-12">
						<div class="panel blog-container" style="border:1px solid #D6E9F3;">
							<div class="panel-body">
								
								<div class="row">
								<?php if($article[0]['monitor_image']!="") { ?>
								<div class="col-md-3" style="border: 1px solid #D6E9F3;margin: 0px 17px;/* width: 259px; */padding: 19px;border-radius:9px;">
								<div class="col-md-4" style="background-image: url(<?php echo base_url();?>img/monitor.jpg); width:240px;height:196px;padding:8px;">	
								<img src="<?php echo base_url();?>uploads/monitor_images/<?php echo $article[0]['monitor_image'];?>" alt="Monitor image" style="height: 140px; width:inherit;">
								</div> 
								</div>
								<?php }
								if($article[0]['ratings']) { ?>
								<?php
									if(($article[0]['ratings']<20)&&($article[0]['ratings']>=0))  
									{
										$fgcolor = "red";
										$bgcolor = "#eee";
										$class = "zero-twenty";
									}
									else if(($article[0]['ratings']>=20)&&($article[0]['ratings']<40))  
									{
										$fgcolor = "#FA8258";
										$bgcolor = "#eee";
										$class = "twenty-forty";
									}
									else if($article[0]['ratings']<60 && $article[0]['ratings']>=40)  
									{
										$fgcolor = "#D7DF01";
										$bgcolor = "#eee";
										$class = "forty-sixty";
									}
									else if($article[0]['ratings']>=60 && $article[0]['ratings']<70)  {
										$fgcolor = "#D7DF09";
										$bgcolor = "#eee";
										$class = "sixty-seventy";
									}
									else if($article[0]['ratings']>=70 && $article[0]['ratings']<=99)  {
										$fgcolor = "#90C844";
										$bgcolor = "#eee";
										$class = "seventy-ninety-nine";
									}
									else if($article[0]['ratings']==100)  {
										$fgcolor = "green";
										$bgcolor = "#eee";
										$class = "hundred";
									}									
								?>
								<div class="col-md-4" style="border:1px solid #D6E9F3;/* width:221px; */border-radius:9px;padding: 13px 0px 0px 91px;">
									<b style="margin-left:18px; font-size:15pt;">Overall Ratings </b>
									<div id="myStat2" data-dimension="190" data-text="<?php echo $article[0]['ratings'];?>%" data-info="New Clients" data-width="8" data-fontsize="30" data-percent="<?php echo $article[0]['ratings'];?>" data-fgcolor="<?php echo $fgcolor;?>" data-bgcolor="<?php echo $bgcolor;?>" class="<?php echo $class;?>"></div>
								</div>
								<?php } 
								if($monetization[0]['sign_up_link'] || $monetization[0]['contact_email']) { ?>
								<div class="col-md-4" style="border: 1px solid #D6E9F3;/* width: 36.33%; */margin-left: 12px; padding: 9px 0px 0 21px;height: 239px;
								border-radius: 9px;">
								<?php if($monetization[0]["sign_up_link"]) { ?>
									<a class="btn btn-success" href="<?php echo $monetization[0]["sign_up_link"]; ?>">Sign Up Now</a>
								<?php } ?>
								<?php if($monetization[0]["contact_email"]) { ?>	
									<h4><b>Contact Email:</b> </h4>
									<h5><?php echo $monetization[0]["contact_email"]; ?></h5>
								<?php }?>
								<?php if($monetization[0]["facebook_url"] || $monetization[0]["google_url"] || $monetization[0]["twitter_url"] || $monetization[0]["instagram_url"] || $monetization[0]["pinterest_url"]) { ?>		
									<h4><b>Social Profiles:</b> </h4>
								<?php }
								if($monetization[0]["facebook_url"]) { ?>	
									<a href="<?php echo $monetization[0]["facebook_url"];?>" target="_blank" class="social-connect tooltip-test facebook-hover pull-left m-right-xs " data-toggle="tooltip" data-original-title="Facebook" style="width:36px;"><i class="fa fa-facebook"></i></a>
								<?php } if($monetization[0]["google_url"]) { ?>	
									<a href="<?php echo $monetization[0]["google_url"];?>" target="_blank" class="social-connect tooltip-test google-plus-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Google" style="width:36px;"><i class="fa fa-google-plus"></i></a>
								<?php } if($monetization[0]["instagram_url"]) { ?>	
									<a href="<?php echo $monetization[0]["instagram_url"];?>" target="_blank" class="social-connect tooltip-test instagram-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Instagram" style="width:36px;"><i class="fa fa-instagram"></i></a>
								<?php } if($monetization[0]["pinterest_url"]) { ?>	
									<a href="<?php echo $monetization[0]["pinterest_url"];?>" target="_blank" class="social-connect tooltip-test pinterest-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Pinterest" style="width:36px;"><i class="fa fa-pinterest"></i></a>
								<?php } if($monetization[0]["twitter_url"]) {?>	
									<a href="<?php echo $monetization[0]["twitter_url"];?>" target="_blank" class="social-connect tooltip-test twitter-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Twitter" style="width:36px;"><i class="fa fa-twitter"></i></a>
								<?php }
									if($monetization[0]["content_request_email_checked"]=="yes") {
								?> <br/> <br/>
								<h4><b>Content Request Email : </b></h4>
								<h5><?php echo $monetization[0]["content_request_email"];?></h5>
								<?php } ?>	
								</div>
								<?php } ?>
								</div>
								<hr style="border: 1px solid #D6E9F3;margin-left:-15px;margin-right: -15px;">
								<div class="row" style="width: 100%; margin-left: initial;">
									<div class="col-md-3 overview">
										<b class="main-tab">Ease of Use</b> 
										<hr style="margin-left: -22px; margin-right: -22px; border-top-color: #D6E9F3; border-bottom-color: #D6E9F3;">
										<p style="padding:3px;color:red;">
										<b>
										<?php if($monetization[0]["dashboard"]){ ?>
										<?php
										if($monetization[0]["dashboard"]<=19){ ?>	
											<h1 class="zero-twenty"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="zero-twenty"> Very Poor</h6> 
										<?php } else if($monetization[0]["dashboard"]>=20 && $monetization[0]["dashboard"]<=39){?>	
											<h1 class="twenty-forty"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="twenty-forty"> Very Poor</h6> 
										<?php } else if($monetization[0]["dashboard"]>=40 && $monetization[0]["dashboard"]<=59){?>
											<h1 class="forty-sixty">
												<?php echo $monetization[0]["dashboard"];?>%
											</h1>
											<h6 class="forty-sixty">Needs Improvement</h6> 
										<?php } else if($monetization[0]["dashboard"]>=60 && $monetization[0]["dashboard"]<=69){?>	
											<h1 class="sixty-seventy"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="sixty-seventy"> Getting There</h6> 
										<?php } else if($monetization[0]["dashboard"]>=70 && $monetization[0]["dashboard"]<=80){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
										<?php } else if($monetization[0]["dashboard"]>=80 && $monetization[0]["dashboard"]<=99){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Looking Good</h6> 
										<?php }
											else if($monetization[0]["dashboard"]==100){?>	
											<h1 class="hundred"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="hundred"> Top Of The Class</h6> 
										<?php }?>
										<?php } else { ?>
											<h3 style="color:red; padding:5px;">Not<br/> mentioned</h3>
										<?php } ?>
										</b>	
										</p>
									</div>

									<div class="col-md-3 overview">
										<b class="main-tab">Content</b>
										<hr style="margin-left: -22px; margin-right: -22px; border-top-color: #D6E9F3; border-bottom-color: #D6E9F3;"/>
										<p style="padding:3px;color:red;">
										<?php if($monetization[0]["ratings"]){ ?>
										<?php
										if($monetization[0]["ratings"]<=19){ ?>	
											<h1 class="zero-twenty"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="zero-twenty"> Very Poor</h6> 
										<?php } else if($monetization[0]["ratings"]>=20 && $monetization[0]["ratings"]<=39){?>	
											<h1 class="twenty-forty"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="twenty-forty"> Very Poor</h6> 
										<?php } else if($monetization[0]["ratings"]>=40 && $monetization[0]["ratings"]<=59){?>
											<h1 class="forty-sixty"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="forty-sixty">Needs Improvement</h6> 
										<?php } else if($monetization[0]["ratings"]>=60 && $monetization[0]["ratings"]<=69){?>	
											<h1 class="sixty-seventy"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="sixty-seventy"> Getting There</h6> 
										<?php } else if($monetization[0]["ratings"]>=70 && $monetization[0]["ratings"]<=80){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
										<?php } else if($monetization[0]["ratings"]>=80 && $monetization[0]["ratings"]<=99){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Looking Good</h6> 
										<?php }
											else if($monetization[0]["ratings"]==100){?>	
											<h1 class="hundred"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="hundred"> Top Of The Class</h6> 
										<?php }?>
										<?php } else { ?>
											<h3 style="color:red; padding:5px;">Not<br/> mentioned</h3>
										<?php } ?>
										</p>
									</div>
									<div class="col-md-3 overview">
										<b class="main-tab">Payouts</b>
										<hr style="margin-left: -22px; margin-right: -22px; border-top-color: #D6E9F3; border-bottom-color: #D6E9F3;">
										<p style="padding:3px;color:red;">
										<?php if($monetization[0]["payout_ratings"]){ ?>
										<?php
										if($monetization[0]["payout_ratings"]<=19){ ?>	
											<h1 class="zero-twenty"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="zero-twenty"> Very Poor</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=20 && $monetization[0]["payout_ratings"]<=39){?>	
											<h1 class="twenty-forty"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="twenty-forty"> Very Poor</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=40 && $monetization[0]["payout_ratings"]<=59){?>
											<h1 class="forty-sixty">
												<?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="forty-sixty">Needs Improvement</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=60 && $monetization[0]["payout_ratings"]<=69){?>	
											<h1 class="sixty-seventy"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="sixty-seventy"> Getting There</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=70 && $monetization[0]["payout_ratings"]<=80){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=80 && $monetization[0]["payout_ratings"]<=99){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Looking Good</h6> 
										<?php }
											else if($monetization[0]["payout_ratings"]==100){?>	
											<h1 class="hundred"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="hundred"> Top Of The Class</h6> 
										<?php }?>
										<?php } else { ?>
											<h3 style="color:red; padding:5px;">Not<br/> mentioned</h3>
										<?php } ?>
										</p>
									</div>
									<div class="col-md-3 overview">
										<b class="main-tab">Support</b>
										<hr style="margin-left: -22px; margin-right: -22px; border-top-color: #D6E9F3; border-bottom-color: #D6E9F3;">
										<p style="padding:3px;color:red;">
										<?php if($monetization[0]["support_ratings"]){ ?>
										<?php
										if($monetization[0]["support_ratings"]<=19){ ?>	
											<h1 class="zero-twenty"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="zero-twenty"> Very Poor</h6> 
										<?php } else if($monetization[0]["support_ratings"]>=20 && $monetization[0]["support_ratings"]<=39){?>	
											<h1 class="twenty-forty"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="twenty-forty"> Very Poor</h6> 
										<?php } else if($monetization[0]["support_ratings"]>=40 && $monetization[0]["support_ratings"]<=59){?>
											<h1 class="forty-sixty"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="forty-sixty">Needs Improvement</h6>
										<?php } else if($monetization[0]["support_ratings"]>=60 && $monetization[0]["support_ratings"]<=69){?>	
											<h1 class="sixty-seventy"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="sixty-seventy"> Getting There</h6> 
										<?php } else if($monetization[0]["support_ratings"]>=70 && $monetization[0]["support_ratings"]<=80){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
										<?php } else if($monetization[0]["support_ratings"]>=80 && $monetization[0]["support_ratings"]<=99){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Looking Good</h6> 
										<?php }
											else if($monetization[0]["support_ratings"]==100){?>	
											<h1 class="hundred"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="hundred"> Top Of The Class</h6> 
										<?php }?>
										<?php } else { ?>
											<h3 style="color:red; padding:5px;">Not<br/> mentioned</h3>
										<?php } ?> 
										</p>
									</div>	
								</div>
								<?php if($monetization[0]["dashboard"] || $monetization[0]["ratings"] || $monetization[0]["payout_ratings"] || $monetization[0]["support_ratings"]) {?>
								<div id="look" style="text-align: center;">	
									<h3> <a href="javascript:void(0);" onclick="display();">
									<img src="<?php echo base_url();?>img/closer_look.png">
									<img src="<?php echo base_url();?>img/plus.jpg" height="30" width="30">
									</a></h3>
								</div>
								<?php } ?>
							<div id="monetization_data" style="display:none;">	
							<hr style="border: 1px solid #D6E9F3;margin-left:-15px;margin-right: -15px;">
							<?php if($monetization[0]["dashboard"]){ ?>
								<div class="row" style="width: 100%; margin-left: initial;">
									<div class="col-md-3 overview" style="height:308px;">
										<b class="main-tab">Ease of Use</b> 
										<hr style="margin-left: -22px; margin-right: -22px; border-top-color: #D6E9F3; border-bottom-color: #D6E9F3;">
										<p style="padding:9px;"> <br/>
										<b>
										<?php if($monetization[0]["dashboard"]){ ?>
										<?php
										if($monetization[0]["dashboard"]<=19){ ?>	
											<h1 class="zero-twenty"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="zero-twenty"> Very Poor</h6> 
										<?php } else if($monetization[0]["dashboard"]>=20 && $monetization[0]["dashboard"]<=39){?>	
											<h1 class="twenty-forty"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="twenty-forty"> Very Poor</h6> 
										<?php } else if($monetization[0]["dashboard"]>=40 && $monetization[0]["dashboard"]<=59){?>
											<h1 class="forty-sixty">
												<?php echo $monetization[0]["dashboard"];?>%
											</h1>
											<h6 class="forty-sixty">Needs Improvement</h6> 
										<?php } else if($monetization[0]["dashboard"]>=60 && $monetization[0]["dashboard"]<=69){?>	
											<h1 class="sixty-seventy"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="sixty-seventy"> Getting There</h6> 
										<?php } else if($monetization[0]["dashboard"]>=70 && $monetization[0]["dashboard"]<=80){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
										<?php } else if($monetization[0]["dashboard"]>=80 && $monetization[0]["dashboard"]<=99){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Looking Good</h6> 
										<?php }
											else if($monetization[0]["dashboard"]==100){?>	
											<h1 class="hundred"><?php echo $monetization[0]["dashboard"];?>%</h1>
											<h6 class="hundred"> Top Of The Class</h6> 
										<?php }?>
										<?php } else { ?>
											<h3 style="color:red; padding:5px;">Not<br/> mentioned</h3>
										<?php } ?>
										</b>
										</p>
									</div>
									<div class="col-md-9" style="margin-top:-21px;">
										<div class="row row-merge">
											<div class="col-md-3 col-sm-6" style="">
												<div class="pricing-widget">
													<div class="pricing-head" style="padding:15px;min-height:49px;">
														<b>Dashboard</b>
													</div>
													<div class="pricing-body">
														<div class="pricing-cost">
														<?php
														if($monetization[0]["dashboard"]<=19){ ?>	
															<h1 class="zero-twenty"><?php echo $monetization[0]["dashboard"];?>%</h1>
															<h6 class="zero-twenty"> Very Poor</h6> 
														<?php } else if($monetization[0]["dashboard"]>=20 && $monetization[0]["dashboard"]<=39){?>	
															<h1 class="twenty-forty"><?php echo $monetization[0]["dashboard"];?>%</h1>
															<h6 class="twenty-forty"> Very Poor</h6> 
														<?php } else if($monetization[0]["dashboard"]>=40 && $monetization[0]["dashboard"]<=59){?>
															<h1 class="forty-sixty">
																<?php echo $monetization[0]["dashboard"];?>%
															</h1>
															<h6 class="forty-sixty">Needs Improvement</h6> 
														<?php } else if($monetization[0]["dashboard"]>=60 && $monetization[0]["dashboard"]<=69){?>	
															<h1 class="sixty-seventy"><?php echo $monetization[0]["dashboard"];?>%</h1>
															<h6 class="sixty-seventy"> Getting There</h6> 
														<?php } else if($monetization[0]["dashboard"]>=70 && $monetization[0]["dashboard"]<=80){?>	
															<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["dashboard"];?>%</h1>
															<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
														<?php } else if($monetization[0]["dashboard"]>=80 && $monetization[0]["dashboard"]<=99){?>	
															<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["dashboard"];?>%</h1>
															<h6 class="seventy-ninety-nine"> Looking Good</h6> 
														<?php }
															else if($monetization[0]["dashboard"]==100){?>	
															<h1 class="hundred"><?php echo $monetization[0]["dashboard"];?>%</h1>
															<h6 class="hundred"> Top Of The Class</h6> 
														<?php }?>	
														</div>
													</div>
												</div><!-- /pricing-widget -->
											</div><!-- /.col -->
											
										<div class="col-md-3 col-sm-6">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;padding:15px;">
													<b>Custom shortner</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost" style="padding:28px;">
														<?php if($monetization[0]["custom_shortner"]=="yes") { ?>	
														<i class="fa fa-check-square-o fa-3x"></i>
														<?php } else { ?>
															<i class="fa fa-times fa-3x"></i>
														<?php } ?>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-3 col-sm-6">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;padding:15px;">
													<b>Analytics</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost" style="padding:28px;">
														<?php if($monetization[0]["analytics"]=="yes") { ?>	
														<i class="fa fa-check-square-o fa-3x"></i>
														<?php } else { ?>
															<i class="fa fa-times fa-3x"></i>
														<?php } ?>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-3 col-sm-6">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;padding:15px;">
													<b>Platforms</b>
												</div>
												<div class="pricing-body" style="padding:13px;">
													<div class="pricing-cost">
														<?php if($monetization[0]["facebook_url"]) { ?>	
														<a href="<?php echo $monetization[0]["facebook_url"];?>" target="_blank" class="social-connect tooltip-test facebook-hover pull-left m-right-xs " data-toggle="tooltip" data-original-title="Facebook" style="width:36px;"><i class="fa fa-facebook"></i></a>
													<?php } if($monetization[0]["google_url"]) { ?>	
														<a href="<?php echo $monetization[0]["google_url"];?>" target="_blank" class="social-connect tooltip-test google-plus-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Google" style="width:36px;"><i class="fa fa-google-plus"></i></a>
													<?php } if($monetization[0]["instagram_url"]) { ?>	
														<a href="<?php echo $monetization[0]["instagram_url"];?>" target="_blank" class="social-connect tooltip-test instagram-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Instagram" style="width:36px;"><i class="fa fa-instagram"></i></a>
													
													<?php } if($monetization[0]["twitter_url"]) {?>	
														<a href="<?php echo $monetization[0]["twitter_url"];?>" target="_blank" class="social-connect tooltip-test pinterest-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Pinterest" style="width:36px;"><i class="fa fa-pinterest"></i></a>
													<?php } ?>
													
													<?php if($monetization[0]["pinterest_url"]) {?>	
														<a href="<?php echo $monetization[0]["pinterest_url"];?>" target="_blank" class="social-connect tooltip-test twitter-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Twitter" style="width:36px;"><i class="fa fa-twitter"></i></a>
													<?php } ?>
													</div>
												</div>
												</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										</div>
										<div class="row row-merge">
											<div class="col-md-3 col-sm-6" style="margin-top:-30px;">
												<div class="pricing-widget">
													<div class="pricing-head" style="min-height:45px;padding:15px;">
														<b>Page Load Time</b>
													</div>
													<div class="pricing-body">
														<div class="pricing-cost">
															<?php if($monetization[0]["page_load_time"]<1.6 && $monetization[0]["page_load_time"]>=0)
															{ ?>
															<strong class="block" style="color:green;">
															<?php echo $monetization[0]["page_load_time"];?>
															</strong>
															<small style="color:green;">seconds</small>
															<?php } elseif($monetization[0]["page_load_time"]>=1.6 && $monetization[0]["page_load_time"]<=3) {?>
															<strong class="block" style="color:#D7DF01;">
															<?php echo $monetization[0]["page_load_time"];?>
															</strong>
															<small style="color:#D7DF01;">seconds</small>
															<?php } elseif($monetization[0]["page_load_time"]>=3) {?>
															<strong class="block" style="color:red;">
															<?php echo $monetization[0]["page_load_time"];?>
															</strong>
															<small style="color:red;">seconds</small>
															<?php } ?>
														</div>
													</div>
												</div><!-- /pricing-widget -->
											</div><!-- /.col -->
											
										<div class="col-md-3 col-sm-6" style="margin-top:-30px;">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:45px;padding:15px;">
													<b>Page Views Per Visit</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost">
														<?php 
														if($monetization[0]["page_views_per_visit"]<=3.9)
														{ ?>
															<strong class="block" style="color:red;">
															<?php echo $monetization[0]["page_views_per_visit"];?>
															</strong>
															<?php 
														} 
														elseif($monetization[0]["page_views_per_visit"]>=4.0 && $monetization[0]["page_views_per_visit"]<=5.9) 
														{?>
															<strong class="block" style="color:#D7DF01;">
															<?php echo $monetization[0]["page_views_per_visit"];?>
															</strong>
														<?php } elseif($monetization[0]["page_views_per_visit"]>=6) {?>
														<strong class="block" style="color:green;">
														<?php echo $monetization[0]["page_views_per_visit"];?>
														</strong>
														<?php } ?>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-3 col-sm-6" style="margin-top:-30px;">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:45px;padding:15px;">
													<b>Daily time on site</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost">
													<?php 
														$time = str_split($monetization[0]["daily_time_on_site"]);
														//echo "<pre>"; print_r($time); //exit;
														$n = count($time);
														?>
														<?php 
														if($time[0]<2)
														{ ?>
														<strong class="block" style="color:red;">
															<?php echo $monetization[0]["daily_time_on_site"];?>
														</strong>
														<?php
														}
														if($time[0]>=2 &&$time[0]<4) 
														{	
															if($time[2] || $time[3])
															{
																if($time[2]>0 || $time[3]>0)
																{
														?>			
																<strong class="block" style="color:green;">
																	<?php echo $monetization[0]["daily_time_on_site"];?>
																</strong>
														<?php 	}
															}
															else
															{  ?>			
																<strong class="block" style="color:#D7DF01;">
																<?php echo $monetization[0]["daily_time_on_site"];?>
																</strong>
														<?php 
															}
														}
														?>	
														<?php 
														if($time[0]>=4) 
														{   ?>
															<strong class="block" style="color:green;">
															<?php echo $monetization[0]["daily_time_on_site"];?>
															</strong>
														<?php 
														} ?>
														<!--<small>per month</small>-->
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-3 col-sm-6" style="margin-top:-30px;">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:45px;padding:15px;">
													<b>Bounce Rate</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost">
														<?php
														if($monetization[0]["bounce_rate"]<=19){ ?>	
															<strong class="block zero-twenty"><?php echo $monetization[0]["bounce_rate"];?>%</strong>
															<small class="zero-twenty"> Very Poor</small> 
														<?php } else if($monetization[0]["bounce_rate"]>=20 && $monetization[0]["bounce_rate"]<=39){?>	
															<strong class="block twenty-forty">
															<?php echo $monetization[0]["bounce_rate"];?>%</strong>
															<small class="twenty-forty"> Very Poor</small> 
														<?php } else if($monetization[0]["bounce_rate"]>=40 && $monetization[0]["bounce_rate"]<=59){?>
															<strong class="block forty-sixty"><?php echo $monetization[0]["bounce_rate"];?>%</strong>
															<small class="forty-sixty">Needs Improvement</small>
														<?php } else if($monetization[0]["bounce_rate"]>=60 && $monetization[0]["bounce_rate"]<=69){?>	
															<strong class="block sixty-seventy" style="color:#D7DF01;"><?php echo $monetization[0]["bounce_rate"];?>%</strong>
															<small class="sixty-seventy"> Getting There</small> 
														<?php } else if($monetization[0]["bounce_rate"]>=70 && $monetization[0]["bounce_rate"]<=80){?>	
															<strong class="block seventy-ninety-nine"><?php echo $monetization[0]["bounce_rate"];?>%</strong>
															<small class="seventy-ninety-nine"> Not Bad!</small> 
														<?php } else if($monetization[0]["bounce_rate"]>=80 && $monetization[0]["bounce_rate"]<=99){?>	
															<strong class="block seventy-ninety-nine"><?php echo $monetization[0]["bounce_rate"];?>%</strong>
															<small class="seventy-ninety-nine"> Looking Good</small> 
														<?php }
															else if($monetization[0]["bounce_rate"]==100){?>	
															<strong class="block hundred"><?php echo $monetization[0]["bounce_rate"];?>%</strong>
															<small class="hundred"> Top Of The Class</small> 
														<?php }?>
													</div>
												</div>
												</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										</div>
									</div>
								</div>	
								<hr style="border: 1px solid #D6E9F3;margin-left:-15px;margin-right: -15px;">
								<?php } ?>
								<?php if($monetization[0]["ratings"]){ ?>
								<div class="row" style="width: 100%; margin-left: initial;">
									<div class="col-md-3 overview" style="height:285px;">
										<b class="main-tab">Contents</b> 
										<hr style="margin-left: -22px; margin-right: -22px; border-top-color: #D6E9F3; border-bottom-color: #D6E9F3;">
										<p style="padding:15px;">
										<?php
										if($monetization[0]["ratings"]<=19){ ?>	
											<h1 class="zero-twenty"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="zero-twenty"> Very Poor</h6> 
										<?php } else if($monetization[0]["ratings"]>=20 && $monetization[0]["ratings"]<=39){?>	
											<h1 class="twenty-forty"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="twenty-forty"> Very Poor</h6> 
										<?php } else if($monetization[0]["ratings"]>=40 && $monetization[0]["ratings"]<=59){?>
											<b><h1 class="forty-sixty"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="forty-sixty">Needs Improvement</h6></b> 
										<?php } else if($monetization[0]["ratings"]>=60 && $monetization[0]["ratings"]<=69){?>	
											<h1 class="sixty-seventy"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="sixty-seventy"> Getting There</h6> 
										<?php } else if($monetization[0]["ratings"]>=70 && $monetization[0]["ratings"]<=80){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
										<?php } else if($monetization[0]["ratings"]>=80 && $monetization[0]["ratings"]<=99){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Looking Good</h6> 
										<?php }
											else if($monetization[0]["ratings"]==100){?>	
											<h1 class="hundred"><?php echo $monetization[0]["ratings"];?>%</h1>
											<h6 class="hundred"> Top Of The Class</h6> 
										<?php }?>
										</p>
									</div>
									<div class="col-md-9" style="margin-top:-21px;">
										<div class="row row-merge">
											<div class="col-md-4 col-sm-7">
												<div class="pricing-widget">
													<div class="pricing-head" style="min-height:49px;padding:15px;">
														<b>Articles</b>
													</div>
													<div class="pricing-body">
														<div class="pricing-cost">
														<?php
														if($monetization[0]["no_of_articles"]<=100){ ?>	
															<h1 style="color:red;"><?php echo $monetization[0]["no_of_articles"];?></h1>
														<?php } else if($monetization[0]["no_of_articles"]>100 && $monetization[0]["no_of_articles"]<=250){?>	
															<h1 style="color:#D7DF01;"><?php echo $monetization[0]["no_of_articles"];?></h1>
														<?php } else if($monetization[0]["no_of_articles"]>250){ ?>
															<h1 style="color:green;"><?php echo $monetization[0]["no_of_articles"];?></h1>
														<?php } ?>
														</div>
													</div>
												</div><!-- /pricing-widget -->
											</div><!-- /.col -->
											
										<div class="col-md-4 col-sm-7">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;padding:15px;">
													<b>Content Requests</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost" style="padding:15px;">
													<?php 
													if($monetization[0]["content_requests"]=="yes"){ ?>
														<i class="fa fa-check-square-o fa-3x"></i>
													<?php } else { ?>
														<i class="fa fa-times fa-3x"></i>
													<?php } ?>	
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-4 col-sm-7">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;padding:15px;">
													<b>Target Audiences</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost">
														<h4><?php echo $monetization[0]["target_audience"]; ?></h4>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										
										</div>
										<div class="row row-merge">
										<div class="col-md-4 col-sm-7" style="margin-top:-30px;">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:45px;padding:15px;">
													<b>Article Quality</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost">
													<?php
														if($monetization[0]["article_quality"]<=19){ ?>	
															<strong class="block zero-twenty"><?php echo $monetization[0]["article_quality"];?>%</strong>
															<small class="zero-twenty"> Very Poor</small> 
														<?php } else if($monetization[0]["article_quality"]>=20 && $monetization[0]["article_quality"]<=39){?>	
															<strong class="block twenty-forty">
															<?php echo $monetization[0]["article_quality"];?>%</strong>
															<small class="twenty-forty"> Very Poor</small> 
														<?php } else if($monetization[0]["article_quality"]>=40 && $monetization[0]["article_quality"]<=59){?>
															<strong class="block forty-sixty"><?php echo $monetization[0]["article_quality"];?>%</strong>
															<small class="forty-sixty">Needs Improvement</small>
														<?php } else if($monetization[0]["article_quality"]>=60 && $monetization[0]["article_quality"]<=69){?>	
															<strong class="block sixty-seventy" style="color:#D7DF01;"><?php echo $monetization[0]["article_quality"];?>%</strong>
															<small class="sixty-seventy"> Getting There</small> 
														<?php } else if($monetization[0]["article_quality"]>=70 && $monetization[0]["article_quality"]<=80){?>	
															<strong class="block seventy-ninety-nine"><?php echo $monetization[0]["article_quality"];?>%</strong>
															<small class="seventy-ninety-nine"> Not Bad!</small> 
														<?php } else if($monetization[0]["article_quality"]>=80 && $monetization[0]["article_quality"]<=99){?>	
															<strong class="block seventy-ninety-nine"><?php echo $monetization[0]["article_quality"];?>%</strong>
															<small class="seventy-ninety-nine"> Looking Good</small> 
														<?php }
															else if($monetization[0]["article_quality"]==100){?>	
															<strong class="block hundred"><?php echo $monetization[0]["article_quality"];?>%</strong>
															<small class="hundred"> Top Of The Class</small> 
														<?php }?>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-4 col-sm-7" style="margin-top:-30px;">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height: 49px;">
													<b>New Content</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost">
														<?php
														if($monetization[0]["new_contents"]=="Daily" || $monetization[0]["new_contents"]=="daily"){ ?>	
															<strong class="block" style="color:green;"><?php echo $monetization[0]["new_contents"];?></strong>
														<?php } else if($monetization[0]["new_contents"]=="Weekly" || $monetization[0]["new_contents"]=="weekly"){?>	
															<strong class="block" style="color:#D7DF01;"><?php echo $monetization[0]["new_contents"];?></strong>
														<?php } else if($monetization[0]["new_contents"]=="monthly" || $monetization[0]["new_contents"]=="Monthly"){ ?>
															<strong class="block" style="color:red;"><?php echo $monetization[0]["new_contents"];?></strong>
														<?php } else { ?>
														<strong class="block" style="color:green;"><?php echo $monetization[0]["new_contents"];?></strong>
														<?php } ?>
														<!--<strong class="block"><?php echo $monetization[0]["new_contents"]; ?></strong>
														<!--<small>per month</small>-->
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										</div>
									</div>
								</div>
								<hr style="border: 1px solid #D6E9F3;margin-left:-15px;margin-right: -15px;">
								<?php } 
								if($monetization[0]["payout_ratings"]){ ?>
								<div class="row" style="width: 100%; margin-left: initial;">
									<div class="col-md-3 overview" style="height:333px;">
										<b class="main-tab">Payouts</b> 
										<hr style="margin-left: -22px; margin-right: -22px; border-top-color: #D6E9F3; border-bottom-color: #D6E9F3;">
										<p style="padding:27px;">
										<b>
										<?php
										if($monetization[0]["payout_ratings"]<=19){ ?>	
											<h1 class="zero-twenty"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="zero-twenty"> Very Poor</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=20 && $monetization[0]["payout_ratings"]<=39){?>	
											<h1 class="twenty-forty"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="twenty-forty"> Very Poor</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=40 && $monetization[0]["payout_ratings"]<=59){?>
											<h1 class="forty-sixty">
												<?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="forty-sixty">Needs Improvement</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=60 && $monetization[0]["payout_ratings"]<=69){?>	
											<h1 class="sixty-seventy"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="sixty-seventy"> Getting There</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=70 && $monetization[0]["payout_ratings"]<=80){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
										<?php } else if($monetization[0]["payout_ratings"]>=80 && $monetization[0]["payout_ratings"]<=99){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Looking Good</h6> 
										<?php }
											else if($monetization[0]["payout_ratings"]==100){?>	
											<h1 class="hundred"><?php echo $monetization[0]["payout_ratings"];?>%</h1>
											<h6 class="hundred"> Top Of The Class</h6> 
										<?php }?>
										</b>
										</p>
									</div>
									<div class="col-md-9" style="margin-top:-21px;">
										<div class="row row-merge">
											<div class="col-md-4 col-sm-7">
												<div class="pricing-widget">
													<div class="pricing-head" style="min-height:49px;padding:15px;">
														<b>Publishers</b>
													</div>
													<div class="pricing-body">
														<div class="pricing-cost" style="color:green;">
														<?php if($monetization[0]["no_of_publishers"]>400) { ?>
															<strong class="block">400+</strong>
														<?php } else { ?>	
															<strong class="block">
																<?php echo $monetization[0]["no_of_publishers"];?>
															</strong>
														<?php } ?>	
															<!--<small> Not good</small>-->
														</div>
													</div>
												</div><!-- /pricing-widget -->
											</div><!-- /.col -->
											
										<div class="col-md-4 col-sm-7">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;">
													<b>Diversified Earnings?</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost" style="padding:15px;">
													<?php if($monetization[0]["diversified_earnings"]=="yes") { ?>	
														<i class="fa fa-check-square-o fa-3x"></i>
													<?php } else { ?>
														<i class="fa fa-times fa-3x"></i>
													<?php } ?>	
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-4 col-sm-7">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;">
													<b>Premium Campaigns?</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost" style="padding:15px;">
													<?php if($monetization[0]["diversified_earnings"]=="yes") { ?>	
														<i class="fa fa-check-square-o fa-3x"></i>
													<?php } else { ?>
														<i class="fa fa-times fa-3x"></i>
													<?php } ?>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										
										</div>
										<div class="row row-merge">
										<div class="col-md-4 col-sm-6" style="margin-top:-30px;">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;padding:15px;">
													<b>Payment Methods</b>
												</div>
												<?php if($monetization[0]["payment_methods"]) {
													$payments = explode(',',$monetization[0]["payment_methods"]);
												?>
												<div class="pricing-body">
													<div class="pricing-cost" style="padding:18px;">
												<?php
														if(in_array("paypal",$payments))
														{			
															echo '<i class="fa fa-check-square-o"></i>';	
															echo '&nbsp;<b class="success">Paypal</b> <br/>';
														}
														else
														{	
															echo '<i class="fa fa-times"></i>';
															echo '&nbsp;<b class="danger">Paypal</b> <br/>';
														}
														
														
														if(in_array("wire transfer",$payments))
														{			
															echo '<i class="fa fa-check-square-o"></i>';	
															echo '&nbsp;<b class="success">Wire transfer</b> <br/>';
														}
														else
														{	
															echo '<i class="fa fa-times"></i>';
															echo '&nbsp;<b class="danger">Wire transfer</b> <br/>';
														}
														
													
														if(in_array("google wallet",$payments))
														{			
															echo '<i class="fa fa-check-square-o"></i>';	
															echo '&nbsp;<b class="success">Google Wallet</b> <br/>';
														}
														else
														{	
															echo '<i class="fa fa-times"></i>';
															echo '&nbsp;<b class="danger">Google Wallet</b> <br/>';
														}
														
														
														if(in_array("payoneer",$payments))
														{			
															echo '<i class="fa fa-check-square-o"></i>';	
															echo '&nbsp;<b class="success">Payoneer</b>';
														}
														else
														{	
															echo '<i class="fa fa-times"></i>';
															echo '&nbsp;<b class="danger">Payoneer</b>';
														}
													}	
													?>
														<br/>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-4 col-sm-6" style="margin-top:-30px;">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;padding:15px;">
													<b>Sign-ups</b>
												</div>
												<div class="pricing-body" style="padding:27px;">
													<div class="pricing-cost">
														<?php if($monetization[0]["sign_ups"]=="Open" || $monetization[0]["sign_ups"]=="open") { ?>
														<strong class="block" style="color:green;">	<?php echo $monetization[0]["sign_ups"];?></strong>
														<?php } else if($monetization[0]["sign_ups"]=="Closed" || $monetization[0]["sign_ups"]=="closed") { ?>
														<strong class="block" style="color:red;">	<?php echo $monetization[0]["sign_ups"];?></strong>
														<?php } ?>
														<!--<small>per month</small>-->
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-4 col-sm-6" style="margin-top:-30px;">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:49px;">
													<b>Referral Programs?</b>
												</div>
												<div class="pricing-body" style="padding:27px;">
													<div class="pricing-cost">
														<?php if($monetization[0]["referral_programs"]=="yes") { ?>	
														<i class="fa fa-check-square-o fa-3x"></i>
														<?php } else { ?>
														<i class="fa fa-times fa-3x"></i>
														<?php } ?>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										</div>
									</div>
								</div>
								<hr style="border: 1px solid #D6E9F3;margin-left:-15px;margin-right: -15px;">
								<?php } 
								if($monetization[0]["support_ratings"]){ ?>
								<div class="row" style="width: 100%; margin-left: initial;">
									<div class="col-md-3 overview" style="height:180px;">
										<b class="main-tab">Support</b> 
										<hr style="margin-left: -22px; margin-right: -22px; border-top-color: #D6E9F3; border-bottom-color: #D6E9F3;">
										<p> 
										<b>
										<?php
										if($monetization[0]["support_ratings"]<=19){ ?>	
											<h1 class="zero-twenty"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="zero-twenty"> Very Poor</h6> 
										<?php } else if($monetization[0]["support_ratings"]>=20 && $monetization[0]["support_ratings"]<=39){?>	
											<h1 class="twenty-forty"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="twenty-forty"> Very Poor</h6> 
										<?php } else if($monetization[0]["support_ratings"]>=40 && $monetization[0]["support_ratings"]<=59){?>
											<h1 class="forty-sixty"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="forty-sixty">Needs Improvement</h6>
										<?php } else if($monetization[0]["support_ratings"]>=60 && $monetization[0]["support_ratings"]<=69){?>	
											<h1 class="sixty-seventy"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="sixty-seventy"> Getting There</h6> 
										<?php } else if($monetization[0]["support_ratings"]>=70 && $monetization[0]["support_ratings"]<=80){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
										<?php } else if($monetization[0]["support_ratings"]>=80 && $monetization[0]["support_ratings"]<=99){?>	
											<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="seventy-ninety-nine"> Looking Good</h6> 
										<?php }
											else if($monetization[0]["support_ratings"]==100){?>	
											<h1 class="hundred"><?php echo $monetization[0]["support_ratings"];?>%</h1>
											<h6 class="hundred"> Top Of The Class</h6> 
										<?php }?>
										</b>
										</p>
									</div>
									<div class="col-md-9" style="margin-top:-21px;">
										<div class="row row-merge">
											<div class="col-md-4">
												<div class="pricing-widget">
													<div class="pricing-head" style="min-height:38px;text-align:center;">
														<b>Responsive Email</b>
													</div>
													<div class="pricing-body">
														<div class="pricing-cost" style="padding:44px;">
															<?php if($monetization[0]["responsive_email"]=="yes") { ?>	
															<i class="fa fa-check-square-o fa-3x"></i>
															<?php } else { ?>
															<i class="fa fa-times fa-3x"></i>
															<?php } ?>
														</div>
													</div>
												</div><!-- /pricing-widget -->
											</div><!-- /.col -->
											
										<div class="col-md-4">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:38px;text-align:center;">
													<b>Responsive Skype</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost" style="padding:44px;">
														<?php if($monetization[0]["responsive_skype"]=="yes") { ?>	
														<i class="fa fa-check-square-o fa-3x"></i>
														<?php } else { ?>
														<i class="fa fa-times fa-3x"></i>
														<?php } ?>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										<div class="col-md-4">
											<div class="pricing-widget">
												<div class="pricing-head" style="min-height:38px;text-align: center;">
													<b>Website Reliability</b>
												</div>
												<div class="pricing-body">
													<div class="pricing-cost" style="padding:24.5px;">
														<b>
														<?php
														if($monetization[0]["website_reliability"]<=19){ ?>	
															<h1 class="zero-twenty"><?php echo $monetization[0]["website_reliability"];?>%</h1>
															<h6 class="zero-twenty"> Very Poor</h6> 
														<?php } else if($monetization[0]["website_reliability"]>=20 && $monetization[0]["website_reliability"]<=39){?>	
															<h1 class="twenty-forty"><?php echo $monetization[0]["website_reliability"];?>%</h1>
															<h6 class="twenty-forty"> Very Poor</h6> 
														<?php } else if($monetization[0]["website_reliability"]>=40 && $monetization[0]["website_reliability"]<=59){?>
															<h1 class="forty-sixty"><?php echo $monetization[0]["website_reliability"];?>%</h1>
															<h6 class="forty-sixty">Needs Improvement</h6>
														<?php } else if($monetization[0]["website_reliability"]>=60 && $monetization[0]["website_reliability"]<=69){?>	
															<h1 class="sixty-seventy"><?php echo $monetization[0]["website_reliability"];?>%</h1>
															<h6 class="sixty-seventy"> Getting There</h6> 
														<?php } else if($monetization[0]["website_reliability"]>=70 && $monetization[0]["website_reliability"]<=80){?>	
															<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["website_reliability"];?>%</h1>
															<h6 class="seventy-ninety-nine"> Not Bad!</h6> 
														<?php } else if($monetization[0]["website_reliability"]>=80 && $monetization[0]["website_reliability"]<=99){?>	
															<h1 class="seventy-ninety-nine"><?php echo $monetization[0]["website_reliability"];?>%</h1>
															<h6 class="seventy-ninety-nine"> Looking Good</h6> 
														<?php }
															else if($monetization[0]["website_reliability"]==100){?>	
															<h1 class="hundred"><?php echo $monetization[0]["website_reliability"];?>%</h1>
															<h6 class="hundred"> Top Of The Class</h6> 
														<?php }?>
														</b>
													</div>
												</div>
											</div><!-- /pricing-widget -->
										</div><!-- /.col -->
										</div>
									</div>
								</div>
							<?php } ?>	
							</div>	
							<hr style="border: 1px solid #D6E9F3;margin-left:-15px;margin-right: -15px;">
								<div class="image-wrapper">
									<a href="<?php echo $article[0]["website_url"];?>">
										<img src="<?php echo base_url();?>uploads/forum_article_images/<?php echo $article[0]['image'];?>" alt="Photo of article">
									</a>
								</div><!-- /image-wrapper -->
																
								<p class="m-top-sm m-bottom-sm" style="text-align:justify;">
									<?php echo $article[0]['description'];?>
								</p>
							</div>
						</div><!-- /panel -->
						<div class="panel">
							<div class="panel-body">
								<div class="share-blog clearfix">
									<script>
										$(document).ready(function(){
											$.ajax({
												url:base_url+'forum_articles/listing/check/'+<?php echo $article[0]['id'];?>,
												type:'POST',
												data:{submit:true},
											success: function (result) {
												if(result=='not')
												{
													$("#bkmark").attr('src','<?php echo base_url();?>img/blank_star.png');
													$("#bkmark").attr('title','Bookmark this article');
													$("#bookmark").attr('data-toggle','modal');
													$("#bookmark").attr('data-target','#basicModal');
												}
												else
												{
													var bid = result;
													$("#bkmark").attr('src','<?php echo base_url();?>img/Star.png');
													$("#bkmark").attr('title','Remove Bookmark');		
												} }
											});	
										});
									</script>
											<div id="successMessage2" class="alert alert-success" style="display:none"></div>
											<?php if($this->session->userdata("userID")){?>
											<a href='#' id="bookmark">
												<img id='bkmark' style='width:5%;margin-bottom:26px;'>
											</a>
											<?php } ?>
											<span class='st_facebook_large' displayText='Facebook' title="share"></span>
											<span class='st_twitter_large' displayText='Tweet' title="share"></span>
											<span class='st_linkedin_large' displayText='LinkedIn' title="share"></span>
											<span class='st_pinterest_large' displayText='Pinterest' title="share"></span>
											<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" 
											aria-labelledby="basicModal" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												
												<h4 class="modal-title" id="myModalLabel"><img src='<?php echo base_url();?>img/Star.png' style='width:3%;'>Add new bookmark
												</h4>
											  </div>
											  <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
											  <div id="successMessage" class="alert alert-success" style="display:none"></div>
											  <div class="modal-body">
													<form class="form-horizontal" id="frm_bookmark" action="" method="POST">
													<fieldset>
														<div class="control-group">
															<label for="template" class="control-label">
																Name:
															</label>
															<div class="controls">	
																<input type="text" name="bookmark" class="form-control validate[required]">
															</div>
														</div>		
														<div class="control-group">
															<label for="template" class="control-label">	
																Url:
															</label>
															<div class="controls">	
																<input type="text" class="form-control" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" name="bookmarkUrl" readonly>
															</div>
														</div>
														<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(3);?>">	
													</fieldset>		
												
											  </div>
											  <div class="modal-footer">
												<button type="button" id="bkmrk_button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" id="save_bookmark" class="btn btn-primary">Save</button>
											  </div>
											  </form>
											</div>
										  </div>
										</div> 
								</div>
							</div>
						</div>
						<?php if($this->session->userdata('userID')) { ?>
						<a href="#" id="comment" class="btn btn-primary">Post a Comment</a>	
						<?php } else {?>
						<a href="<?php echo base_url();?>user/forum_login/index?link=<?php echo $actual_link;?>" class="btn btn-primary">Login to Post Comment</a>	
						<?php } ?>
						<div id="comment_desc">
							<h4 class="headline">
								Add Comment
								<span class="line"></span>
							</h4>
							<form action="" method="post" id="post_comment" class="form-horizontal">
								<textarea class="form-control validate[required]" rows="10" name="comment_description"></textarea>
								<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(3);?>">
								<div class="seperator"></div>
								<div class="text-right m-bottom-md">
									<button type="submit" id="btn_comment" class="btn btn-success">Post Comment</button>
									<a href="#" id="cancel" class="btn">Cancel</a>
								</div>
							</form>
						</div>
						<?php if($comments){?>
						<h4 class="headline">
							Comments 
							<span class="line"></span>
						</h4>
						
						<ul class="media-list comment-list">
							<?php for($i=0;$i<count($comments);$i++) {?>
							<div class="panel blog-container" style="border:1px solid lightgray;">
							<div class="panel-body">
							<li class="media">
								<span class="pull-left">
									<img class="media-object img-circle" src="<?php echo base_url();?>img/user.jpg" alt="User Avatar" style="width: 40px; height: 40px;">
								</span>
								<div class="media-body">
									<div class="media-heading">
										<?php echo $comments[$i]["name"];?>
										<small class="text-muted">
											<?php echo $comments[$i]["created_date"];?> 
										</small>
									</div>
									<p><?php echo $comments[$i]["description"];?></p>
									<?php if($this->session->userdata('userID')) { ?>
									<a href="#" onclick="display(<?php echo $i;?>);return false;" class="btn btn-primary">Post a Reply</a>	
									<?php } else {?>
									<a href="<?php echo base_url();?>user/forum_login/index?link=<?php echo $actual_link;?>" class="btn btn-primary">Login to Post Reply</a>	
									<?php } ?>
									<div id="reply_<?php echo $i;?>" style="display:none;">
										<h4 class="headline">
											Add Reply
											<span class="line"></span>
										</h4>
										<form action="" method="post" id="frm_Reply_<?php echo $i?>" 
										class="form-horizontal">
											<textarea class="form-control validate[required]" rows="10" name="reply_description"></textarea>
											<input type="hidden" name="commentid" value="<?php echo $comments[$i]["id"];?>">
											<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(3);?>">
											<input type="hidden" name="articlename" value="<?php echo $this->uri->segment(2);?>">
											<div class="seperator"></div>
											<div class="text-right m-bottom-md">
												<button type="submit" class="btn btn-success">Post Reply</button>
												<a class="btn" onclick="hide('<?php echo $i;?>');return false;">Cancel</a>
											</div>
										</form>
										<script>
											jQuery(document).ready(function($){
												$("#frm_Reply_<?php echo $i;?>").validationEngine();
											});
										</script>
									</div>
									<?php if($replies){ ?>
									<!-- Nested media object -->
									<h4 class="headline">Replies
									<span class="line"></span></h4>
									<div class="media">
										<?php for($j=0;$j<count($replies);$j++) {
												if($replies[$j]['parent_id']==$comments[$i]['id']){ ?>
										<span class="pull-left" href="#">
											<img class="media-object img-circle" src="<?php echo base_url();?>img/user.jpg" alt="User Avatar" style="width: 40px; height: 40px;">
										</span>
										<div class="media-body">
											<div class="media-heading">
												<?php echo $replies[$j]['name'];?>
												<small class="text-muted">
													<?php echo $replies[$j]['created_date'];?>
												</small>
											</div>
											<?php echo $replies[$j]['description'];?>
										</div> <hr>
										<?php } }?>
									</div> 
									<?php }?>
								</div>
							</li>
							</div>
							</div>
						<?php } ?>	
						</ul><!-- /media-list -->					
						<?php } ?>
							
					</div><!-- /.col -->
					
				</div><!-- /.row -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div><!-- /main-container -->
<script>
	$("#comment").click(function(){
		$("#comment_desc").show();
		return false;
	});
	$("#cancel").click(function(){
		$("#comment_desc").hide();
		return false;
	});
	$("#cancel2").click(function(){
		$("#reply_desc").hide();
		return false;
	});
</script>
<script>
	function display(no)
	{
		$("#reply_"+no).show();
	}
	function display2(no)
	{
		$("#reply_"+no).show();
	}
	function hide(no)
	{
		$("#reply_"+no).hide();
	}
	function hide2(no)
	{
		$("#reply_"+no+"").hide();
	}
</script>
<script>
	$(document).ready(function(){
		$('#post_comment').ajaxForm({
			beforeSubmit : function(){
				$("#btn_comment").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#post_comment").validationEngine('validate'))
				{
					$("#btn_comment").button('loading');
					return true;
				}
				else
				{
					$("#btn_comment").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#save_bookmark").button("reset");
				if(responseText==100)
				{
					window.location.reload();
				}
				else if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else
				{
					$("#errorMessage").html(responseText);
					$("#errorMessage").show();
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});
</script>
<script>
	$(document).ready(function(){
		$('#frm_bookmark').ajaxForm({
			beforeSubmit : function(){
				$("#save_bookmark").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_bookmark").validationEngine('validate'))
				{
					$("#save_bookmark").button('loading');
					return true;
				}
				else
				{
					$("#save_bookmark").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#save_bookmark").button("reset");
				if(responseText==100)
				{
					$("#successMessage").html("Bookmark added successfully.");
					$("#successMessage").show();
					window.location.reload();
				}
				else if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else
				{
					$("#errorMessage").html(responseText);
					$("#errorMessage").show();
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});	
</script>
<script>
$( document ).ready(function() {
        $('#myStathalf').circliful();
		$('#myStat').circliful();
		$('#myStathalf2').circliful();
		$('#myStat2').circliful();
    });
</script>
<script type="text/javascript">
$('a#bookmark').click(function(e){
e.preventDefault();
	$.ajax({
		url:base_url+'forum_articles/listing/check/<?php echo $article[0]['id'];?>',
		type:'POST',
		data:{submit:true},
	success: function (result) {
		if(result!='not')
		{
			$.ajax({
				url:base_url+'forum_articles/listing/remove/'+result,
				type:'POST',
				data:{submit:true},
			success: function (result) {
			$("#bkmark").attr('src','<?php echo base_url();?>img/blank_star.png');		
			$("#bkmark").attr('title','Bookmark this article');	
			$("#bookmark").attr('data-toggle','modal');
			$("#bookmark").attr('data-target','#basicModal');
			$("#successMessage2").html("Bookmark removed successfully");
			$("#successMessage2").show();
			}})
		}
		}
	});
});
function display()
{
	$('#monetization_data').show();
	$('#look').empty();
	$('#look').html('<h3><a href="javascript:void(0);" onclick="hide();"><img src="<?php echo base_url();?>img/hide.png"><img src="<?php echo base_url();?>img/minus.jpg" height="30" width="30"></a></h3>');
}function hide()
{
	$('#monetization_data').hide();
	$('#look').empty();
	$('#look').html('<h3><a href="javascript:void(0);" onclick="display();"><img src="<?php echo base_url();?>img/closer_look.png"><img src="<?php echo base_url();?>img/plus.jpg" height="30" width="30"></a></h3>');
}

</script>

		