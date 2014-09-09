<div id="main-container">
	<?php //echo "<pre>"; print_r($easeofuse); exit; ?>
	<!--<div id="breadcrumb">
		<ul class="breadcrumb">
			 <li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
			 <li>Form</li>	 
			 <li class="active">Form Element</li>	 
		</ul>
	</div><!--breadcrumb-->
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-globe"></i>  Edit Ease of use Details</b> </h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:75%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_add_ease" action="" method="POST">
							
							<div class="form-group">
								<label for="Article" class="col-lg-2 control-label">Article</label>
								<div class="col-lg-10">
									<select name="articleid" class="form-control validate[required]">
										<option value>Please Select</option>
										<option value="<?php echo $easeofuse[0]["articleid"];?>" selected="selected"><?php echo $easeofuse[0]["topic"];?></option>
										<?php foreach($articles as $article){ ?>
										<option value="<?php echo $article["id"];?>"><?php echo $article["topic"];?></option>
										<?php } ?>
									</select>	
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">Dashboard Ratings</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required,max[100]]" placeholder="dashboard ratings in %"  name="dashboard" id="dashboard" value="<?php echo $easeofuse[0]["dashboard"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="shortner" class="col-lg-2 control-label">Custom shortner</label>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="shortner" id="shortner" value="yes" 
									<?php if($easeofuse[0]["custom_shortner"]=="yes")
											{
												echo 'checked="checked"';
											}	
									?>>
								</div>
								<div class="col-lg-1">
									Yes
								</div>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="shortner" id="shortner" value="no" 
									<?php if($easeofuse[0]["custom_shortner"]=="no")
											{
												echo 'checked="checked"';
											}	
									?>> 
								</div><!-- /.col -->
								<div class="col-lg-1">
									No
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Analytics" class="col-lg-2 control-label">Analytics</label>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="analytics" id="analytics" value="yes" 
									<?php if($easeofuse[0]["analytics"]=="yes")
											{
												echo 'checked="checked"';
											}	
									?>>   
								</div>
								<div class="col-lg-1">
									Yes
								</div>
								<div class="col-lg-1">		
									<input type="radio" class="form-control validate[required]" name="analytics" id="analytics" value="no"
									<?php if($easeofuse[0]["analytics"]=="no")
											{
												echo 'checked="checked"';
											}	
									?>> 
								</div><!-- /.col -->
								<div class="col-lg-1">
									No
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="pageLoadTime" class="col-lg-2 control-label"> Page Load Time</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="Page Load Time in seconds"  name="page_load_time" id="page_load_time" value="<?php echo $easeofuse[0]["page_load_time"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="pageLoadTime" class="col-lg-2 control-label"> Page View Per Visit</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="Page views"  name="page_view_per_visit" id="page_view_per_visit" value="<?php echo $easeofuse[0]["page_views_per_visit"];?>"> 
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							
							<div class="form-group">
								<label for="pageLoadTime" class="col-lg-2 control-label"> Daily Time on site</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="Daily Time on site"  name="daily_time_on_site" id="daily_time_on_site" value="<?php echo $easeofuse[0]["daily_time_on_site"];?>"> 
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="bounce_rate" class="col-lg-2 control-label">Bounce Rate</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="Bounce Rate in %"  name="bounce_rate" id="bounce_rate" value="<?php echo $easeofuse[0]["bounce_rate"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="facebook" class="col-lg-2 control-label"> Facebook Url</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[custom[url]]" placeholder="Facebook Url"  name="facebook" id="facebook" value="<?php echo $easeofuse[0]["facebook_url"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="twitter" class="col-lg-2 control-label"> Twitter Url</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[custom[url]]" placeholder="Twitter Url"  name="twitter" id="twitter" value="<?php echo $easeofuse[0]["twitter_url"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="google" class="col-lg-2 control-label"> Google+ Url</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[custom[url]]" placeholder="Google+ Url"  name="google" id="google" value="<?php echo $easeofuse[0]["google_url"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Pinterest" class="col-lg-2 control-label"> Pinterest Url</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[custom[url]]" placeholder="Pinterest Url"  name="pinterest" id="pinterest" value="<?php echo $easeofuse[0]["pinterest_url"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="instagram" class="col-lg-2 control-label"> Instagram Url</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[custom[url]]" placeholder="Instagram Url"  name="instagram" id="instagram" value="<?php echo $easeofuse[0]["instagram_url"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>monetization/dashboard/easeOfUse" class="btn btn-primary">Cancel</a>
								</div><!-- /.col -->
							</div><!-- /form-group -->
						</form>
					</div>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div>
<script>
	$(document).ready(function(){
		$('#frm_add_ease').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_add_ease").validationEngine('validate'))
				{
					$("#btn_submit").button('loading');
					return true;
				}
				else
				{
					$("#btn_submit").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#btn_submit").button("reset");
				if(responseText==100)
				{
					$("#successMessage").html("Ease of Use Details are updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"monetization/dashboard/easeOfUse";
				}
				else if(responseText==301)
				{
					$("#errorMessage").html("Your session is expired.");
					$("#errorMessage").show();
					window.location=base_url+"user/login";
				}
				else
				{
					$("#errorMessage").html("Operation failed! Please try again...");
					$("#errorMessage").show();
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});

</script>