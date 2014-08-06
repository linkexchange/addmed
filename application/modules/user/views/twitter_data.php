<div class="login-wrapper">
	<div class="text-center">
		<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
			<span class="text-success">Login with</span> <span style="color:#ccc; text-shadow:0 1px #fff">twitter</span>
		</h2>
	</div>
	<div class="login-widget animation-delay1">	
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<div class="pull-left">
					<i class="fa fa-lock fa-lg"></i> Twiiter e-mail
				</div>

				
			</div>
			<div class="panel-body">
				<?php if($account==0) : ?>
					<form method="post" action="<?php echo $this->config->item('base_url'); ?>user/login/setEmail" id="twitter_email">
						<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"></div>
						<div class="form-group">
							<label>Enter your twitter email</label>
							<input type="text" class="form-control validate[required,custom[email]]" placeholder="Username" value="" name="userName" id="userName">
						</div>
						<div class="seperator"></div>
						<button class="button btn btn-success btn-large" id="btn_submit" type="submit">Submit</button>	
						<!--<button type="submit" id="btn_submit" class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right"><i class="fa fa-sign-in"></i> Sign in</button>-->
					</form>
				<?php endif; ?>
				<form>
					<input type="hidden" id="twitterId" name="twitterId" value="<?php echo $twitter['id'];?>" />
					<input type="hidden" id="twitter_screen" name="twitter_screen" value="<?php echo $twitter['screen_name'];?>" />
					<input type="hidden" id="firstName" name="firstName" value="<?php echo $twitter['first_name'];?>" />
					<input type="hidden" id="lastName" name="lastName" value="<?php echo $twitter['last_name'];?>" />
					<input type="hidden" id="type" name="type" value="<?php echo $twitter['type'];?>" />
					<input type="hidden" id="email" name="email" value="" />
				</form>	
			</div>
		</div><!-- /panel -->
	</div><!-- /login-widget -->
</div><!-- /login-wrapper -->
	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="createUser();" >&times;</button>
        <h4 class="modal-title" id="myModalLabel">Do you aleady have account with us.</h4>
      </div>
      <!-- <div class="modal-body">
        ...
      </div>-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="connectUser();" >Yes</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="createUser();">No</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Login.</h4>
			</div>
			<div class="panel-body">
				<form method="post" action="checklogin" id="frm_login1">
					<div id="errorMessage1" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage1" class="alert alert-success" style="display:none"></div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" placeholder="Username" class="form-control input-sm bounceIn animation-delay2 validate[required]" name="userName">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" placeholder="Password" class="form-control input-sm bounceIn animation-delay4 validate[required]" name="password">
					</div>
					<input type="hidden" id="email2" name="email1" value=""/>
					<input type="hidden" id="type2" name="type1" value=""/>
					<div class="modal-footer">
						<button type="submit" id="btn_submit" class="btn btn-success">Login</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" onclick="createUser();">Continue</button>
					</div>
					<!--<button type="submit" id="btn_submit" class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right"><i class="fa fa-sign-in"></i> Sign in</button>-->
				</form>
			</div>
			
		</div>
	</div>
</div>
<!-- Model: Login -->
<script>
	$(document).ready(function(){
		$('#twitter_email').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				
				if($("#twitter_email").validationEngine('validate'))
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
					$("#errorMessage").html("Invalid email Id...!");
					$("#errorMessage").show();
				}
				else 
				{
					$("#successMessage").html("Email ID added successfully...!");
					$("#successMessage").show();
					$("#email").val(responseText);
					//alert(responseText);
					$(".account-container").hide();
					checkProfile();
					
				}
			}
		});
		$("#twitter_email").validationEngine();
	});

	function checkProfile(){
		$('#myModal').modal('show');
	}
	function createUser(){
		var profileType=$('#type').val();
		var firstName=$("#firstName").val();
		var lastName=$("#lastName").val();
		var email=$("#email").val();
		var twitterId=$("#twitterId").val();
		addRecord(twitterId,firstName,lastName,email,profileType);
	}
	function addRecord(twitterId,firstName,lastName,email,profileType){
		$.ajax({
			type: "POST",
			url: base_url+"user/login/setUserData",
			data: {twitterId : twitterId, firstName: firstName, lastName: lastName, email: email, type:profileType}
		})
		.done(function( responseText ) {
			//alert( "Data Saved: " + responseText );
			if(responseText==1)	
			{
				$("#successMessage").html("You are logged in successfully...!");
				$("#successMessage").show();
				window.location=base_url;
			}
			else
			{
				$("#errorMessage").html("Invalid Login Details!.");
				$("#errorMessage").show();
			}
		});	
  }

  function connectUser(){
	$('#myModal').modal('hide');
	$('#LoginModal').modal('show');
  }

	$(document).ready(function(){
		$('#frm_login1').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				
				if($("#frm_login1").validationEngine('validate'))
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
					$("#errorMessage1").html("Invalid details...!");
					$("#errorMessage1").show();
				}
				else if(responseText>0)
				{
					$("#successMessage1").html("You are logged in successfully...!");
					$("#successMessage1").show();
					connectProfile(responseText);
				}
			}
		});
		$("#frm_login1").validationEngine();
	});

	function connectProfile(id){
	var profileType=$('#type').val();
	var firstName=$("#firstName").val();
	var lastName=$("#lastName").val();
	var email=$("#email").val();
	var twitterId=$("#twitterId").val();
	$.ajax({
		type: "POST",
		url: base_url+"user/login/connectUserData",
		data: {userID : id,twitterId : twitterId, firstName: firstName, lastName: lastName, email: email, type:profileType}
	})
	.done(function( responseText ) {
		
		if(responseText==1)	
		{
			$("#successMessage1").html("You are account is connected successfully...!");
			$("#successMessage1").show();
			window.location=base_url;
		}
		else
		{
			$("#errorMessage1").html("Error connecting your account!.");
			$("#errorMessage1").show();
		}
	});	
  
  }
</script>