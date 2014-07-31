

<div id="main-container">
	
	<div class="padding-md">
		<div class="row">
			<div class="col-lg-5">
				
					<div class="panel-heading">
						<div class="text-center">
							<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
								<span class="text-success">Linkexchange</span> <span style="color:#ccc; text-shadow:0 1px #fff">Sign-Up</span>
							</h2>
						</div>
					</div>
					<div class="login-widget animation-delay1">	
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<div class="pull-left">
							<i class="fa fa-lock fa-lg"></i> Sign-Up
						</div>

						<div class="pull-right">
							<span style="font-size:11px;">Back to login</span>
							<a class="btn btn-default btn-xs login-link" href="<?php echo base_url();?>user/login" style="margin-top:-2px;"><i class="fa fa-plus-circle"></i> Login</a>
						</div>
					</div>
					<div class="panel-body">
						<form method="post" action="#" id="frm_signup">
							<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
							<div id="successMessage" class="alert alert-success" style="display:none"></div>
							
							<div class="form-group">
								<label>Company Name</label>
								<input type="text" placeholder="Company Name" class="form-control input-sm bounceIn animation-delay2 validate[required]" name="companyName" id="companyName">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" placeholder="Username" class="form-control input-sm bounceIn animation-delay2 validate[required]" value="" name="userName" id="userName">
							</div>
							<div class="form-group">
								<label>Email Address</label>
								<input type="text" class="form-control input-sm bounceIn animation-delay2 validate[required,custom[email]]" data-errormessage-value-missing="Email is required!" data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
								data-errormessage="This is the fall-back error message." 
								placeholder="Email" value="" name="email" id="email">
							</div>
							<div class="form-group">
								<label>Phone Number</label>
								<input type="text"  class="form-control input-sm bounceIn animation-delay2 validate[required,custom[integer]]" placeholder="Phone Number" value="" 
								name="phoneNumber" id="phoneNumber">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" placeholder="Password" class="form-control input-sm bounceIn animation-delay4 validate[required]" placeholder="Password" value="" name="password" id="password">
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="password" placeholder="Confirm Password" class="form-control input-sm bounceIn animation-delay4 validate[required]" value="" name="confirm_password" id="confirm_password">
							</div>
							<div class="form-group">
								<label>User Type</label>
								<select class="userType form-control input-sm bounceIn animation-delay4 validate[required]"  name="userType" id="userType">
								<option value="">select user type</option>
								<?php 
								print_r($userType);
									foreach($userType as $type)
									{
									?>
										<option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?> </option>	
									<?php
									}
								?>
								</select>
							</div>
							<div class="seperator"></div>
							<hr/>
							<button class="button btn btn-success btn-large" id="btn_submit"><i class="fa fa-sign-in"></i> Sign Up</button>	
							<!--<button type="submit" id="btn_submit" class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right"><i class="fa fa-sign-in"></i> Sign in</button>-->
						</form>
					</div>
						
				</div><!-- /panel -->
			</div><!-- /.col -->
			</div>
			
		</div><!-- /.row -->
	
	
</div>
	
<script>
	$(function	()	{
		$('#frm_signup').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				
				if($("#frm_signup").validationEngine('validate'))
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
					$("#errorMessage").html("Database Server is not working, please try after some time...!");
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
					$("#successMessage").html("You are registered successfully...!");
					$("#successMessage").show();
					window.location=base_url+'admin/dashboard';
				}
				else if(responseText==2)
				{
					$("#successMessage").html("You are registered successfully...!");
					$("#successMessage").show();
					window.location=base_url+'advertiser/dashboard';
				}
				else if(responseText==3)
				{
					$("#successMessage").html("You are registered successfully...!");
					$("#successMessage").show();
					window.location=base_url+'publisher/dashboard';
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});
</script>