<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget">
						<div class="widget-header"> <i class="icon-list-alt"></i>
							<h3>Profile</h3>
						</div>
						<!-- /widget-header -->
						<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"></div>
						<div class="widget-content">
							<div class="big-stats-container">
								<div class="widget-content">
									<div id="formcontrols" class="tab-pane active">
										<form class="form-horizontal" id="frm_editprofile" action="" method="POST">
											<fieldset>
												<div class="control-group">											
													<label for="username" class="control-label">Username</label>
													<div class="controls">
														<input type="hidden"  value="<?php echo $user['id']; ?>" id="id" name="id" class="span6" >
														<input type="text"  disabled="" value="<?php echo $user['userName']; ?>" id="username" class="span6 disabled" name="userName">
														<p class="help-block">Your username is for logging in and cannot be changed.</p>
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="companyName" class="control-label">Company Name</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['companyName']; ?>" id="companyName" name="companyName" class="span6 validate[required]">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="email" class="control-label">Email </label>
													<div class="controls">
														<input type="text" value="<?php echo $user['email']; ?>" id="email" name="email" class="span4 validate[required]">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">	
													<label for="password" class="control-label">Password:</label>
													<div class="controls">
														<input type="password" class="login" placeholder="Password" value="" name="password" id="password">
													</div> <!-- /controls -->
												</div> <!-- /control-group -->
												<div class="control-group">	
													<label for="confirm_password" class="control-label">Confirm Password:</label>
													<div class="controls">
														<input type="password" class="login validate[equals[password]]" placeholder="Confirm Password" value="" name="confirm_password" id="confirm_password">
													</div> <!-- /controls -->
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="phoneNumber" class="control-label">Phone Number</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['phoneNumber']; ?>" id="phoneNumber"  name="phoneNumber" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="companyAddress" class="control-label">Company Address</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['address']; ?>" id="address" name="address" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="city" class="control-label">City</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['city']; ?>" id="city" name="city" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="state" class="control-label">State</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['state']; ?>" id="state" name="state" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="country" class="control-label">Country</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['country']; ?>" id="country" name="country" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="zip" class="control-label">Zip</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['zipCode']; ?>" id="zipCode" name="zipCode" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">	
													<div class="controls">
														<button class="btn btn-primary" type="submit">Save</button> 
														<a href="<?php echo base_url().'admin/dashboard' ?>" class="btn">Cancel</a>
													</div>
												</div> <!-- /control-group -->
											</fieldset>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
					window.location=base_url+'admin/dashboard';
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