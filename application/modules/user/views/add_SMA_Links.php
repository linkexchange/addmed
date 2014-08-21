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
				<h3> <i class="fa fa-user fa-lg"></i> Add Social Media Accounts Links </h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<?php if($this->session->flashdata("update")) { ?>
					<div id="successMessage" class="alert alert-success">
					<?php echo $this->session->flashdata("update"); ?>
					</div>
					<?php } ?>
					<div style="width:80%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_addSMA" action="" method="POST">
							<div class="form-group">
								<label for="facebook" class="col-lg-2 control-label">facebook profile url</label>
								<div class="col-lg-6">
									<input type="text"  id="facebook" class="form-control validate[url]" name="facebook_url" <?php if(isset($url[0]['facebook_url']))
									 echo 'value = '.$url[0]['facebook_url']; ?>>
								</div><!-- /.col -->
								<div class="col-lg-4">
									<input type="radio" value="1" id="fb" name="fb" 
									<?php 
									if($privacy)
									{	
										if($privacy[0]["facebook_url"]=="1")
											{ echo 'checked="checked"';}
									}
									else
									{
										echo 'checked="checked"';
									}
									?>/> Public &nbsp; &nbsp;&nbsp; 
									<input type="radio" value="0" id="privacy_username" name="fb" <?php 
									if($privacy)
									{
										if($privacy[0]["facebook_url"]=="0") 
										{echo 'checked="checked"';}
									}?>/> Private
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="facebook" class="col-lg-2 control-label">twitter profile url</label>
								<div class="col-lg-6">
									<input type="text"  id="twitter_url" class="form-control validate[url]" name="twitter_url" <?php if(isset($url[0]['twitter_url'])) echo 'value = '.$url[0]['twitter_url']; ?>>
								</div><!-- /.col -->
								<div class="col-lg-4">
									<input type="radio" value="1" id="tw" name="tw" 
									<?php 
									if($privacy)
									{	
										if($privacy[0]["twitter_url"]=="1")
											{ echo 'checked="checked"';}
									}
									else
									{
										echo 'checked="checked"';
									}
									?>/> Public &nbsp; &nbsp;&nbsp; 
									<input type="radio" value="0" id="tw" name="tw" <?php 
									if($privacy)
									{
										if($privacy[0]["twitter_url"]=="0") 
										{echo 'checked="checked"';}
									}?>/> Private
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="facebook" class="col-lg-2 control-label">instagram profile url</label>
								<div class="col-lg-6">
									<input type="text"  id="instagram_url" class="form-control validate[url]" name="instagram_url" <?php if(isset($url[0]['instagram_url']))  echo 'value = '.$url[0]['instagram_url']; ?>>
								</div><!-- /.col -->
								<div class="col-lg-4">
									<input type="radio" value="1" id="in" name="in" 
									<?php 
									if($privacy)
									{	
										if($privacy[0]["instagram_url"]=="1")
											{ echo 'checked="checked"';}
									}
									else
									{
										echo 'checked="checked"';
									}
									?>/> Public &nbsp; &nbsp;&nbsp; 
									<input type="radio" value="0" id="in" name="in" <?php 
									if($privacy)
									{
										if($privacy[0]["instagram_url"]=="0") 
										{echo 'checked="checked"';}
									}?>/> Private
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="facebook" class="col-lg-2 control-label">pinterest profile url</label>
								<div class="col-lg-6">
									<input type="text"  id="pinterest_url" class="form-control validate[url]" name="pinterest_url" <?php if(isset($url[0]['pinterest_url']))  echo 'value = '.$url[0]['pinterest_url']; ?>>
								</div><!-- /.col -->
								<div class="col-lg-4">
									<input type="radio" value="1" id="pin" name="pin" 
									<?php 
									if($privacy)
									{	
										if($privacy[0]["pinterest_url"]=="1")
											{ echo 'checked="checked"';}
									}
									else
									{
										echo 'checked="checked"';
									}
									?>/> Public &nbsp; &nbsp;&nbsp; 
									<input type="radio" value="0" id="pin" name="pin" <?php 
									if($privacy)
									{
										if($privacy[0]["pinterest_url"]=="0") 
										{echo 'checked="checked"';}
									}?>/> Private
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="facebook" class="col-lg-2 control-label">tumblr profile url</label>
								<div class="col-lg-6">
									<input type="text"  id="tubmlr_url" class="form-control validate[url]" name="tubmlr_url" <?php if(isset($url[0]['tubmlr_url']))  echo 'value = '.$url[0]['tubmlr_url']; ?>>
								</div><!-- /.col -->
								<div class="col-lg-4">
									<input type="radio" value="1" id="tum" name="tum" 
									<?php 
									if($privacy)
									{	
										if($privacy[0]["tumblr_url"]=="1")
											{ echo 'checked="checked"';}
									}
									else
									{
										echo 'checked="checked"';
									}
									?>/> Public &nbsp; &nbsp;&nbsp; 
									<input type="radio" value="0" id="tum" name="tum" 
									<?php 
									if($privacy)
									{
										if($privacy[0]["tumblr_url"]=="0") 
										{echo 'checked="checked"';}
									}?>/> Private
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url().$this->session->userdata('userType').'/dashboard' ?>" class="btn btn-primary">Cancel</a>
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
		$('#frm_addSMA').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#btn_submit").button("reset");
				if(responseText==0)
				{
					$("#errorMessage").html("Database Server is not working, please try after some time...!"+responseText);
					$("#errorMessage").show();
				}
				else if(responseText==1)
				{
					$("#successMessage").html("User Data updated successfully...!");
					$("#successMessage").show();
					//window.location.reload();
				}
				else if(responseText==2)
				{
					$("#successMessage").html("User Data updated successfully...!");
					$("#successMessage").show();
					//window.location.reload();
				}
				else if(responseText==3)
				{
					$("#successMessage").html("User Data updated successfully...!");
					$("#successMessage").show();
					//window.location.reload();
				}
				else if(responseText==301)
				{
					$("#errorMessage").html("You must enter atleast one link.");
					$("#errorMessage").show();
				}
			}
		});
		$("#frm_signup").validationEngine();
	});
</script>