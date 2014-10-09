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
				<h3><b><i class="icon-file-alt"></i>  Add Website Details</b> 
				
				</h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:62%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_monetization" action="" method="POST">
						
							<div class="form-group">
								<label for="website_name" class="col-lg-2 control-label">Name of Website</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="Website Name"  name="website_name" id="WebsiteName">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Website_Logo" class="col-lg-2 control-label">Website Logo</label>
								<div class="col-lg-5">
									<input type="file" class="form-control validate[required]" name="logo" id="image" size="20" >
									<p class="help-block">Maximum allwoed image size is 10MB.</p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
                                                        <div class="form-group">
								<label for="Website_screenshot" class="col-lg-2 control-label">Website Screenshot</label>
								<div class="col-lg-5">
									<input type="file" class="form-control validate[required]" name="screenshot" id="image" size="20" >
									<p class="help-block">Maximum allwoed image size is 10MB.</p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
                                                        
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>analytics_websites/dashboard" class="btn btn-primary">Cancel</a>
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
		$('#frm_monetization').ajaxForm({
			beforeSubmit : function()
                        {
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_monetization").validationEngine('validate'))
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
			success :  function(responseText, statusText, xhr, $form)
                        {
				$("#btn_submit").button("reset");
				if(responseText==100)
				{
					$("#successMessage").html("Websites Details added successfully.");
					$("#successMessage").show();
					window.location=base_url+"analytics_websites/dashboard";
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