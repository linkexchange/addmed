<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget">
						<div class="widget-header"> <i class="icon-list-alt"></i>
							<h3>Add Profile</h3>
						</div>
						<!-- /widget-header -->
						<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"></div>
						<div class="widget-content">
							<div class="big-stats-container">
								<div class="widget-content">
									<form class="form-horizontal" id="frm_addprofile" action="" method="POST">
											<fieldset>
												<div class="control-group">											
													<label for="username" class="control-label">Username</label>
													<div class="controls">
														<input type="text" value="" id="username" class="span6 validate[required]" name="userName">
														<p class="help-block">Your username is for logging in and cannot be changed.</p>
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">								<label for="companyName" class="control-label">Company Name</label>
													<div class="controls">
														<input type="text" value="" id="companyName" name="companyName" class="span6 validate[required]">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="email" class="control-label">Email </label>
													<div class="controls">
														<input type="text" value="" id="email" name="email" class="span4 validate[required,custom[email]]" data-errormessage-value-missing="Email is required!" 
														data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
														data-errormessage="This is the fall-back error message." >
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<br><br>
												<div class="control-group">											
													<label for="phoneNumber" class="control-label">Phone Number</label>
													<div class="controls">
														<input type="text" value="" id="phoneNumber"  name="phoneNumber" class="span6 validate[required,custom[integer]]">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="password" class="control-label">Password</label>
													<div class="controls">
														<input type="password" value="" id="password"  name="password" placeholder="Password"  class="span6 validate[required]">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="companyAddress" class="control-label">Company Address</label>
													<div class="controls">
														<input type="text" value="" id="address" name="address" class="span6 ">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="city" class="control-label">City</label>
													<div class="controls">
														<input type="text" value="" id="city" name="city" class="span6 ">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="state" class="control-label">State</label>
													<div class="controls">
														<input type="text" value="" id="state" name="state" class="span6 ">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">									<label for="country" class="control-label">Country</label>
													<div class="controls">
														<input type="text" value="" id="country" name="country" class="span6 ">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">						<label for="zip" class="control-label">Zip</label>
													<div class="controls">
														<input type="text" value="" id="zipCode" name="zipCode" class="span6 ">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">
													<label for="userType" class="control-label">User Type:</label>
													<div class="controls">
														<select class="userType form-control validate[required]"  name="userType" id="userType">
															<option value="">select user type</option>
															<?php 
															//print_r($userType);
																foreach($userType as $type)
																{
																?>
																	<option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?> </option>	
																<?
																}
															?>
														</select>
													</div>
												</div> <!-- /field -->
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
						<!-- /widget-header -->
					</div>
				</div>
			</div>
		</div>
	<div>
</div>
<script>
	$(document).ready(function(){
		$('#frm_addprofile').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				
				if($("#frm_addprofile").validationEngine('validate'))
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
					$("#successMessage").html("User registered successfully...!");
					$("#successMessage").show();
					window.location=base_url+'admin/dashboard';
				}
				else if(responseText==2)
				{
					$("#successMessage").html("You are registered successfully...!");
					$("#successMessage").show();
					window.location=base_url+'admin/dashboard';
				}
				else if(responseText==3)
				{
					$("#successMessage").html("You are registered successfully...!");
					$("#successMessage").show();
					window.location=base_url+'admin/dashboard';
				}
			}
		});
		$("#frm_signup").validationEngine();
	});
</script>