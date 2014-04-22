<div class="account-container">
	<div class="content clearfix">
		<form method="post" action="" id="frm_forgotpassword">
			<h1>Forgot Password</h1>		
			<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<div id="successMessage" class="alert alert-success" style="display:none"></div>
			<div class="login-fields">
				
				<p>Please provide your details</p>
				
				<div class="field">
					<label for="email">Email ID</label>
					<input type="text" class="login username-field validate[required,custom[email]]" placeholder="Email ID" value="<?php if($this->input->post()) echo ""; ?>" name="email" id="email">
				</div> <!-- /field -->
				<div class="login-actions">
					<button class="button btn btn-success btn-large" id="btn_submit">Request Password</button>
					
				</div> <!-- .actions -->
				<div class="login-extra">
					<a class="" href="<?php echo base_url(); ?>user/login">
						Back To Login
					</a>
				</div>
								
			</div> <!-- /login-fields -->
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#frm_forgotpassword').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				
				if($("#frm_forgotpassword").validationEngine('validate'))
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
					$("#errorMessage").html("User with this email id is not present! Please check the email id.");
					$("#errorMessage").show();
				}
				else if(responseText>0)
				{
					$("#successMessage").html("Password request successfully done...! Please check your email.");
					$("#successMessage").show();
					/*if(responseText==1)	
					{
						window.location=base_url+"admin/dashboard";
					}
					else if(responseText==2)	
					{
						window.location=base_url+"advertiser/dashboard";
					}
					else if(responseText==3)	
					{
						window.location=base_url+"publisher/dashboard";
					}*/

				}
				else
				{
					$("#errorMessage").html("Database error! Please try again after some some time.");
					$("#errorMessage").show();
				}
			}
		});
		$("#frm_forgotpassword").validationEngine();
	});
</script>