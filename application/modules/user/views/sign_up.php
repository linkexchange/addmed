<div class="account-container register">
	
	<div class="content clearfix">
		
		<form method="post" action="" id="frm_signup">
		
			<h1>Signup for Free Account</h1>			
			<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<div id="successMessage" class="alert alert-success" style="display:none"></div>
			<div class="login-fields">
				
				<p>Create your free account:</p>
				<div class="field">
					<label for="company name">Company Name:</label>	
					<input type="text" class="login validate[required]" placeholder="Company Name" value="" name="companyName" id="companyName">
				</div> <!-- /field -->
				<div class="field">
					<label for="username">User Name:</label>	
					<input type="text" class="login validate[required]" placeholder="User Name" value="" name="userName" id="userName">
				</div> <!-- /field -->
				
				
				<div class="field">
					<label for="email">Email Address:</label>
					<input type="text" class="login validate[required,custom[email]]"  
						data-errormessage-value-missing="Email is required!" 
						data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
						data-errormessage="This is the fall-back error message." 
						placeholder="Email" value="" name="email" id="email">
				</div> <!-- /field -->
				
				<div class="field">
					<label for="phoneNumber">Phone Number:</label>	
					<input type="text" class="login validate[required,custom[integer]]" placeholder="Phone Number" value="" name="phoneNumber" id="phoneNumber">
				</div> <!-- /field -->
				

				<div class="field">
					<label for="password">Password:</label>
					<input type="password" class="login validate[required]" placeholder="Password" value="" name="password" id="password">
				</div> <!-- /field -->
				
				<div class="field">
					<label for="confirm_password">Confirm Password:</label>
					<input type="password" class="login validate[required,equals[password]]" placeholder="Confirm Password" value="" name="confirm_password" id="confirm_password">
				
				</div> <!-- /field -->
				<div class="field">
					<label for="userType">User Type:</label>
					<select class="userType form-control validate[required]"  name="userType" id="userType">
						<option value="">select user type</option>
						<?php 
						print_r($userType);
							foreach($userType as $type)
							{
							?>
								<option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?> </option>	
							<?
							}
						?>
					</select>
				</div> <!-- /field -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				<span class="login-checkbox">
					<input type="checkbox" tabindex="4" value="First Choice" class="field login-checkbox validate[required]" name="Field" id="Field">
					<label for="Field" class="choice">Agree with the Terms &amp; Conditions.</label>
				</span>
				<input type="hidden" name="submit" value="submit" >			
				<button id="btn_submit" class="button btn btn-primary btn-large" data-loading-text="Loading..." data-toggle="buttons"> Register</button>
			</div> <!-- .actions -->
		</form>
	</div> <!-- /content -->
</div>
<script>
	$(document).ready(function(){
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
		$("#frm_signup").validationEngine();
	});
</script>