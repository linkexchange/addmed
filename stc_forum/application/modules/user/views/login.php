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
		url: base_url+"user/login/checkUserByID",
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
			$("#errorMessage").html("This user is marked as spam. Please contact to website admin!.");
			$("#errorMessage").show();
		}
		else if(responseText>0){
			$("#successMessage").html("You are logged in successfully...!");
			$("#successMessage").show();
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
		url: base_url+"user/login/setUserData",
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
    appId      : '680602588661749',
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
<div class="account-container">
	<div class="content clearfix">
		<form method="post" action="#" id="">
			<h1>Member Login</h1>		
			<div id="errorMessage" class="alert alert-danger" style="display:none"><?php if($this->session->flashdata('flashError')) echo $this->session->flashdata('flashError'); ?></div>
			<div id="successMessage" class="alert alert-success" style="display:none"></div>
			<div class="login-actions" style="text-align:center; margin-top:10px;">
				<div id="signin-button" style="float:none;">
                     <div class="g-signin"
                      data-callback="loginFinishedCallback"
                      data-approvalprompt="force"
                      data-clientid="851356399609-1v49v5ggmkiijt1101ri2tbqrodaple2.apps.googleusercontent.com"
                      data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read"
                      data-height="standard"
                      data-cookiepolicy="single_host_origin"
					  data-width="wide"
                      >
                    </div>
    				<!-- In most cases, you don't want to use approvalprompt=force. Specified   						here to facilitate the demo.-->

					
  				</div>
				<div id="signin-button-facebook" style="float:none;">
					<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" data-size="large"> Sign In with Facebook
					</fb:login-button>
				</div>
				<div id="sign-in-twitter" style="float:none; margin:10px auto;">
					<?php if(isset($backUrl)) : ?>
						<a href="<?php echo $this->config->item('base_url'); ?>twitter/twitter/auth?link=<?php echo $backUrl ?>"><img alt="Sign in with Twitter" src="<?php echo $this->config->item('base_url'); ?>img/darker.png" width="177px" height="25px"></a>
					<?php else : ?>
						<a href="<?php echo $this->config->item('base_url'); ?>twitter/twitter/auth"><img alt="Sign in with Twitter" src="<?php echo $this->config->item('base_url'); ?>img/darker.png" width="177px" height="25px"></a>
					<?php endif; ?>
					
				</div>
				<input type="hidden" id="email" name="email" value=""/>
				<input type="hidden" id="firstName" name="firstName" value=""/>
				<input type="hidden" id="lastName" name="lastName" value=""/>
				<input type="hidden" id="type" name="type" value=""/>
				<!-- Button trigger modal -->


			</div> <!-- .actions -->
		</form>
		
	</div> <!-- /content -->
	
</div>

<!-- <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button> -->

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
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Login.</h4>
			</div>
			<form method="post" action="login/checkLogin" id="frm_login1" style="margin:0px;">
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

<script>
	function createUser(){
	//alert("createUser");
	//alert(email);
	var profileType=$('#type').val();
	var firstName=$("#firstName").val();
	var lastName=$("#lastName").val();
	var email=$("#email").val();
	addRecord(firstName,lastName,email,profileType);
  }

  function connectUser(){
	$('#myModal').modal('hide');
	$('#LoginModal').modal('show');
  }

  function submitLogin(){
		$("#frm_login1").validationEngine();
		//document.getElementById("frm_login1").submit();
	
	  
	
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

	$.ajax({
		type: "POST",
		url: base_url+"user/login/connectUserData",
		data: {userID : id, firstName: firstName, lastName: lastName, email: email, type:profileType}
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