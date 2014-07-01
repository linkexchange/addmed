<div class="account-container">
	
	<div class="content clearfix">
		
		<form method="post" action="#" id="frm_login">
		
			<h1>Member Login</h1>		
			<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<div id="successMessage" class="alert alert-success" style="display:none"></div>
			<div class="login-fields">
				
				<p>Please provide your details</p>
				
				<div class="field">
					<label for="username">Username</label>
					<input type="text" class="login username-field validate[required]" placeholder="Username" value="" name="userName" id="userName">
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" class="login password-field validate[required]" placeholder="Password" value="" name="password" id="password">
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			<div class="login-actions">
				<!--	
				<span class="login-checkbox">
					<input type="checkbox" tabindex="4" value="First Choice" class="field login-checkbox" name="Field" id="Field">
					<label for="Field" class="choice">Keep me signed in</label>
				</span>
				-->					
				<button class="button btn btn-success btn-large" id="btn_submit">Sign In</button>
				
			</div> <!-- .actions -->
			<div class="login-extra">
				<!--<a href="<?php echo base_url(); ?>user/login/forgotpassword">Forgot Password</a>-->
			</div>
			
			
		</form>
		
	</div> <!-- /content -->
	
</div>

<script>
	$(document).ready(function(){
		$('#frm_login').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				
				if($("#frm_login").validationEngine('validate'))
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
				if(responseText==201)
				{
					$("#errorMessage").html("Invalid details...!");
					$("#errorMessage").show();
				}
				else if(responseText>0)
				{
					$("#successMessage").html("You are logged in successfully...!");
					$("#successMessage").show();
					window.location=base_url+"admin/dashboard";
				}
			}
		});
		$("#frm_login").validationEngine();
	});
</script>