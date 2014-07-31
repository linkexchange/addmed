<div class="login-wrapper">
		<div class="text-center">
			<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
				<span class="text-success">Forgot</span> <span style="color:#ccc; text-shadow:0 1px #fff">Password</span>
			</h2>
		</div>
		<div class="login-widget animation-delay1">	
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						<i class="fa fa-lock fa-lg"></i> Login
					</div>

					<div class="pull-right">
						<span style="font-size:11px;"><p>Please provide your details</p></span>
					</div>
				</div>
				<div class="panel-body">
					<form method="post" action="#" id="frm_forgotpassword">
						<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"></div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control input-sm bounceIn animation-delay2 username-field validate[required,custom[email]]" placeholder="Email ID" value="<?php if($this->input->post()) echo ""; ?>" name="email" id="email">
						</div>
						
						
		
						<div class="seperator"></div>
						<div class="form-group">
							<a class="" href="<?php echo base_url(); ?>user/login">Back To Login</a>
						</div>

						<hr/>
						<button class="button btn btn-success btn-large" id="btn_submit">Request Password</button>	
						<!--<button type="submit" id="btn_submit" class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right"><i class="fa fa-sign-in"></i> Sign in</button>-->
					</form>
				</div>
			</div><!-- /panel -->
		</div><!-- /login-widget -->
	</div><!-- /login-wrapper -->
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