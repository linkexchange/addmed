
<?php if($this->session->flashdata('flashError')) : ?>
	<script>
		$(document).ready(function(){
			$("#errorMessage").show();
		});
	</script>
<?php endif; ?>
<?php if(isset($backUrl)) : ?>
	<script>
		var backUrl='<?php echo $backUrl; ?>';
	</script>
<?php else : ?>
	<script>
		var backUrl='';
	</script>
<?php endif; ?>


<style type="text/css">
  html, body { margin: 0; padding: 0; }
  .hide { display: none;}
  .show { display: block;}
  </style>
 <script type="text/javascript">
  /**
   * Global variables to hold the profile and email data.
   */
   var profile, email;

  /*
   * Triggered when the user accepts the sign in, cancels, or closes the
   * authorization dialog.
   */
  function loginFinishedCallback(authResult) {
    if (authResult) {
      if (authResult['error'] == undefined){
        //toggleElement('signin-button'); // Hide the sign-in button after successfully signing in the user.
        gapi.client.load('plus','v1', loadProfile);  // Trigger request to get the email address.
      } else {
        console.log('An error occurred');
      }
    } else {
      console.log('Empty authResult');  // Something went wrong
    }
  }
  
  /**
   * Uses the JavaScript API to request the user's profile, which includes
   * their basic information. When the plus.profile.emails.read scope is
   * requested, the response will also include the user's primary email address
   * and any other email addresses that the user made public.
   */
  function loadProfile(){
    var request = gapi.client.plus.people.get( {'userId' : 'me'} );
    request.execute(loadProfileCallback);
  }

  /**
   * Callback for the asynchronous request to the people.get method. The profile
   * and email are set to global variables. Triggers the user's basic profile
   * to display when called.
   */
  function loadProfileCallback(obj) {
    profile = obj;

    // Filter the emails object to find the user's primary account, which might
    // not always be the first in the array. The filter() method supports IE9+.
    email = obj['emails'].filter(function(v) {
        return v.type === 'account'; // Filter out the primary email
    })[0].value; // get the email from the filtered results, should always be defined.
    displayProfile(profile,email);
  }
  
  /**
   * Display the user's basic profile information from the profile object.
   */
  function displayProfile(profile,email){
	var firstName=profile['name']['givenName'];
	var lastName=profile['name']['familyName'];
	var profileType="Google";
	checkUserByID(email,profileType,firstName,lastName);
  }
  
  function checkUserByID(email,profileType,firstName,lastName){
	 $.ajax({
		type: "POST",
		url: base_url+"user/forum_login/checkUserByID",
		data: { email: email, type: profileType }
	})
	.done(function( responseText ) {
		//alert( "Data Saved: " + responseText );
		if(responseText==0){
			$("#email").val(email);
			$("#firstName").val(firstName);
			$("#lastName").val(lastName);
			$("#type").val(profileType);
			$('#myModal').modal('show');
		}
		else if(responseText=="-1"){
			$("#errorMessage2").html("This user is marked as spam. Please contact to website admin!.");
			$("#errorMessage2").show();
		}
		else if(responseText>0){
			$("#successMessage2").html("You are logged in successfully...!");
			$("#successMessage2").show();
			if(backUrl!=''){
				window.location=backUrl;
			}
			else
			{
				window.location=base_url;
			}
		}
		
	});	
  }
  
  function addRecord(firstName,lastName,email,profileType){
	$.ajax({
		type: "POST",
		url: base_url+"user/forum_login/setUserData",
		data: { firstName: firstName, lastName: lastName, email: email, type:profileType}
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

  </script>	
  <script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>
  <script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
     
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1448115485456019',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.0' // use version 2.0
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    //statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
		console.log('Successful login for: ' + response.name);
		var firstName=response.first_name;
		var lastName=response.last_name;
		var email=response.email;
		var profileType="Facebook";
		checkUserByID(email,profileType,firstName,lastName);
	 
    });
  }
</script>
<div id="main-container">
	<div class="padding-md">
		<div class="row">
			<div class="col-lg-5">
				
					<div class="panel-heading">
						<div class="text-center">
							<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
								<span class="text-success">Site User</span> <span style="color:#ccc; text-shadow:0 1px #fff">Login</span>
							</h2>
						</div>
					</div>
					<div class="login-widget animation-delay1">	
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<div class="pull-left">
							<i class="fa fa-lock fa-lg"></i> Login
						</div>

						<div class="pull-right">
							<span style="font-size:11px;">Don't have any account?</span>
							<a class="btn btn-default btn-xs login-link" href="<?php echo base_url();?>user/sign_up" style="margin-top:-2px;"><i class="fa fa-plus-circle"></i> Sign up</a>
						</div>
					</div>
					<div class="panel-body">
						<form method="post" action="#" id="frm_login">
							<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
							<div id="successMessage" class="alert alert-success" style="display:none"></div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" placeholder="Username" class="form-control input-sm bounceIn animation-delay2 validate[required]" name="userName" id="userName">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" placeholder="Password" class="form-control input-sm bounceIn animation-delay4 validate[required]" name="password" id="password">
							</div>
							
			
							<div class="seperator"></div>
							<div class="form-group">
								Forgot your password?<br/>
								Click <a href="<?php echo base_url(); ?>user/login/forgotpassword">here</a> to reset your password
							</div>

							<hr/>
							<button class="button btn btn-success btn-large" id="btn_submit"><i class="fa fa-sign-in"></i> Sign In</button>	
							<!--<button type="submit" id="btn_submit" class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right"><i class="fa fa-sign-in"></i> Sign in</button>-->
						</form>
					</div>
						
				</div><!-- /panel -->
			</div><!-- /.col -->
			</div>

		</div><!-- /.row -->
	
	
	</div><!-- /panel -->
	</div><!-- /.padding-md -->
</div>
		

<script>
	$(function	()	{
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
					
					if(responseText==1)	
					{
                                            $("#successMessage").html("You are logged in successfully...!");
                                            $("#successMessage").show();
                                            window.location=base_url+"website/dashboard";
					}
					else if(responseText==2)	
					{
						$("#errorMessage").html("Not authorized to login...!");
                                                $("#errorMessage").show();
					}
					else if(responseText==3)	
					{
						$("#errorMessage").html("Not authorized to login...!");
                                                $("#errorMessage").show();
					}

				}
			}
		});
		$("#frm_login").validationEngine();
	});
</script>

