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
				<h3> <i class="fa fa-user fa-lg"></i> Edit Profile </h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:70%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_editprofile" action="" method="POST">
							<div class="form-group">
								<label for="username" class="col-lg-2 control-label">Username</label>
								<div class="col-lg-10">
									<input type="hidden"  value="<?php echo $user['id']; ?>" id="id" name="id" class="span6" >
									<input type="text"  disabled="" value="<?php echo $user['userName']; ?>" id="username" class="form-control disabled" name="userName">
									<p class="help-block">Your username is for logging in and cannot be changed.</p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="companyName" class="col-lg-2 control-label">Company Name</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $user['companyName']; ?>" id="companyName" name="companyName" class="form-control validate[required]">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="email" class="col-lg-2 control-label"> Email</label>
								<div class="col-lg-10">
									 <input type="text" value="<?php echo $user['email']; ?>" id="email" name="email" class="form-control validate[required]" disabled="">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Password" class="col-lg-2 control-label">Password</label>
								<div class="col-lg-10">
									<input type="password" class="form-control login" placeholder="Password" value="" name="password" id="password">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Confirm Password" class="col-lg-2 control-label">Confirm Password</label>
								<div class="col-lg-10">
									<input type="password" class="form-control login validate[equals[password]]" placeholder="Confirm Password" value="" name="confirm_password" id="confirm_password">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Phone Number" class="col-lg-2 control-label">Phone Number</label>
								<div class="col-lg-10">
									<input type="text" value="<?php if($user['phoneNumber']!=0) echo $user['phoneNumber']; ?>" id="phoneNumber" placeholder="Phone Number" name="phoneNumber" class="form-control">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Company Address" class="col-lg-2 control-label">Company Address</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $user['address']; ?>" id="address" name="address"  placeholder="Company Address" class="form-control">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="City" class="col-lg-2 control-label">City</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $user['city']; ?>" id="city" name="city" placeholder="City" class="form-control">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="State" class="col-lg-2 control-label">State</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $user['state']; ?>" id="state" name="state" placeholder="State" class="form-control">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Country" class="col-lg-2 control-label">Country</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $user['country']; ?>" id="country" name="country" placeholder="Country" class="form-control">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Zip" class="col-lg-2 control-label">Zip</label>
								<div class="col-lg-10">
									<input type="text" value="<?php if($user['zipCode']!=0) echo $user['zipCode']; ?>" id="zipCode" name="zipCode" placeholder="Zip Code" class="form-control">
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
		$('#frm_editprofile').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				
				if($("#frm_editprofile").validationEngine('validate'))
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
				if(responseText==0)
				{
					$("#errorMessage").html("Database Server is not working, please try after some time...!"+responseText);
					$("#errorMessage").show();
				}
				if(responseText==102)
				{
					$("#errorMessage").html("username is already exist...!");
					$("#errorMessage").show();
				}
				else if(responseText==103)
				{
					$("#errorMessage").html("email is already exist...!");
					$("#errorMessage").show();
				}
				else if(responseText==1)
				{
					$("#successMessage").html("User Data updated successfully...!");
					$("#successMessage").show();
					window.location=base_url+'admin/dashboard/user';
				}
				else if(responseText==2)
				{
					$("#successMessage").html("User Data updated successfully...!");
					$("#successMessage").show();
					window.location=base_url+'advertiser/dashboard';
				}
				else if(responseText==3)
				{
					$("#successMessage").html("User Data updated successfully...!");
					$("#successMessage").show();
					window.location=base_url+'publisher/dashboard';
				}
			}
		});
		$("#frm_signup").validationEngine();
	});
</script>