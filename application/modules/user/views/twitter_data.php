<script>

</script>
<div class="account-container">
	<div class="content clearfix">
		
		<?php if($account==0) : ?>
			<form method="post" action="<?php echo $this->config->item('base_url'); ?>user/login/setEmail" id="twitter_email">
				<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
				<div id="successMessage" class="alert alert-success" style="display:none"></div>
				
					<fieldset>
							<div class="control-group">											
								<label for="userName" class="control-label">Enter your twitter email</label>
								<div class="controls">
							    	<input type="text" class="validate[required,custom[email]]" placeholder="Username" value="" name="userName" id="userName">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Submit</button> 
								</div>
							</div> <!-- /control-group -->
						</fieldset>
					
				
			</form>
		<?php endif; ?>
		
		</div>
		
	</div>
</div>
<form>
	<input type="hidden" id="twitterId" name="twitterId" value="<?php echo $twitter['id'];?>" />
	<input type="hidden" id="twitter_screen" name="twitter_screen" value="<?php echo $twitter['screen_name'];?>" />
	<input type="hidden" id="firstName" name="firstName" value="<?php echo $twitter['first_name'];?>" />
	<input type="hidden" id="lastName" name="lastName" value="<?php echo $twitter['last_name'];?>" />
	<input type="hidden" id="type" name="type" value="<?php echo $twitter['type'];?>" />
	<input type="hidden" id="email" name="email" value="" />
</form>
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
			<form method="post" action="checkLogin" id="frm_login1" style="margin:0px;">
				<div id="errorMessage1" class="alert alert-danger" style="display:none"></div>
				<div id="successMessage1" class="alert alert-success" style="display:none"></div>
				<div class="login-actions" style="text-align:center; margin-top:10px;">
					<p>Please provide your details</p>
				
					<div class="field">
						<input type="text" class="validate[required,custom[email]]" placeholder="Username" value="" name="userName" id="userName">
					</div> <!-- /field -->
				
					<div class="field">
						<input type="password" class="validate[required]" placeholder="Password" value="" name="password" id="password">
					</div> <!-- /password -->	
				

				</div> <!-- .actions -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" >Login</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="createUser();">Continue</button>
				</div>
			</form>
			
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
