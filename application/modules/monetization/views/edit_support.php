<style>
.col-lg-1 { width : 4.333333%; margin : 2px;}
</style>
<div id="main-container">
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
				<h3><b><i class="icon-columns"></i>  Edit Support</b> </h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:75%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_edit_support" action="" method="POST">
							
							<div class="form-group">
								<label for="Article" class="col-lg-2 control-label">Article</label>
								<div class="col-lg-10">
									<select name="articleid" class="form-control validate[required]">
										<option value>Please Select</option>
										<option value="<?php echo $support[0]["articleid"];?>" selected="selected"><?php echo $support[0]["topic"];?></option>
										<?php foreach($articles as $article){ ?>
										<option value="<?php echo $article["id"];?>"><?php echo $article["topic"];?></option>
										<?php } ?>
									</select>	
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">Support Ratings</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required,custom[number,max[100]]]" value="<?php echo $support[0]["support_ratings"];?>"  name="support_ratings" id="support_ratings">
									<p><b>Please enter only integer or decimal value. Do not enter % sign.</b></p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="shortner" class="col-lg-2 control-label">Responsive Email</label>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="responsive_email" id="responsive_email" value="yes"
									<?php if($support[0]["responsive_email"]=="yes") 
											{
												echo 'checked="checked"';
											}	
									?>>
								</div>
								<div class="col-lg-1">
									Yes
								</div>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="responsive_email" id="responsive_email" value="no"
									<?php if($support[0]["responsive_email"]=="no") 
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
								<label for="shortner" class="col-lg-2 control-label">Responsive Skype</label>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="responsive_Skype" id="responsive_Skype" value="yes"
									<?php if($support[0]["responsive_skype"]=="yes") 
											{
												echo 'checked="checked"';
											}	
									?>>
								</div>
								<div class="col-lg-1">
									Yes
								</div>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="responsive_Skype" id="responsive_Skype" value="no"
									<?php if($support[0]["responsive_skype"]=="no") 
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
								<label for="dashboard" class="col-lg-2 control-label">Website Reliability</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required,custom[number,max[100]]]" value="<?php echo $support[0]["website_reliability"];?>"  name="website_reliability" id="website_reliability">
									<p><b>Please enter only integer or decimal value. Do not enter % sign.</b></p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>monetization/support" class="btn btn-primary">Cancel</a>
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
		$('#frm_edit_support').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_edit_support").validationEngine('validate'))
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
					$("#successMessage").html("Support Details has been updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"monetization/support/";
				}
				else if(responseText==301)
				{
					$("#errorMessage").html("Your session is expired.");
					$("#errorMessage").show();
					window.location=base_url+"user/login";
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