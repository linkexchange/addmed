<style>
.col-lg-1 { width : 4.333333%; margin : 2px;}
</style>
<div id="main-container">
	<!--<div id="breadcrumb">
		<ul class="breadcrumb">
			 <li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
			 <li>Form</li>	 
			 <li class="active">Form Element</li>	 
		</ul>
	</div><!--breadcrumb-->
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-money"></i>  Edit Payouts</b> </h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:75%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_edit_payouts" action="" method="POST">
							
							<div class="form-group">
								<label for="Article" class="col-lg-2 control-label">Article</label>
								<div class="col-lg-10">
									<select name="articleid" class="form-control validate[required]">
										<option value>Please Select</option>
										<option value="<?php echo $payouts[0]["articleid"];?>" selected="selected"><?php echo $payouts[0]["topic"];?></option>
										<?php foreach($articles as $article){ ?>
										<option value="<?php echo $article["id"];?>"><?php echo $article["topic"];?></option>
										<?php } ?>
									</select>	
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">Ratings</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required,custom[number,max[100]]]" value="<?php echo $payouts[0]["payout_ratings"];?>"  name="ratings" id="ratings">
									<p><b>Please enter only integer or decimal value. Do not add % sign.</b></p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">No of publishers</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required,custom[integer]]" value="<?php echo $payouts[0]["no_of_publishers"];?>" id="no_of_publishers" name="no_of_publishers">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="shortner" class="col-lg-2 control-label">Diversified Earnings</label>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="earnings" id="earnings" value="yes"
									<?php if($payouts[0]["diversified_earnings"]=="yes") { 
										echo 'checked="checked"';
									} ?>>
								</div>
								<div class="col-lg-1">
									Yes
								</div>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="earnings" id="earnings" value="no" 
									<?php if($payouts[0]["diversified_earnings"]=="no") { 
										echo 'checked="checked"';
									} ?>> 
								</div><!-- /.col -->
								<div class="col-lg-1">
									No
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="shortner" class="col-lg-2 control-label">Premium Campaigns</label>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="campaigns" id="campaigns" value="yes"
									<?php if($payouts[0]["premium_campaigns"]=="yes") { 
										echo 'checked="checked"';
									} ?>>
								</div>
								<div class="col-lg-1">
									Yes
								</div>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="campaigns" id="campaigns" value="no"
									<?php if($payouts[0]["premium_campaigns"]=="no") { 
										echo 'checked="checked"';
									} ?>> 
								</div><!-- /.col -->
								<div class="col-lg-1">
									No
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Article" class="col-lg-2 control-label">Payment Methods</label>
								<div class="col-lg-10">
								<?php 
								if(strpos($payouts[0]["payment_methods"],',')) 
								{
									$payments = explode(',',$payouts[0]["payment_methods"]);
									//echo "<pre>"; print_R ($payment); exit;
								}
								else
								{
									$payments[0] =  $payouts[0]["payment_methods"];
								}	
								?>	
									<select name="payment_methods[]" class="form-control validate[required]" multiple>
										<option value>Please Select</option>
										<option value="paypal"
										<?php 
										foreach($payments as $payment) { 
										if($payment=="paypal")
										{
											echo 'selected="selected"';
										} }?>>
										Paypal</option>
										<option value="wire transfer"
										<?php 
										foreach($payments as $payment) { 
										if($payment=="wire transfer")
										{
											echo 'selected="selected"';
										} }?>>Wire transfer</option>
										<option value="google wallet"
										<?php 
										foreach($payments as $payment) { 
										if($payment=="google wallet")
										{
											echo 'selected="selected"';
										} }?>>Google Wallet</option>
										<option value="payoneer"
										<?php 
										foreach($payments as $payment) { 
										if($payment=="payoneer")
										{
											echo 'selected="selected"';
										} }?>>Payoneer</option>
									</select>
									<p><b>Press and Hold the Ctrl button to select multiple options</b></p> 	
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">Sign-Ups</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" value="<?php echo $payouts[0]["sign_ups"];?>"  name="sign_ups" id="sign_ups">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="shortner" class="col-lg-2 control-label">Referral Programs</label>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="referrals" id="referrals" value="yes"
									<?php if($payouts[0]["referral_programs"]=="yes") { 
										echo 'checked="checked"';
									} ?>>
								</div>
								<div class="col-lg-1">
									Yes
								</div>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="referrals" id="referrals" value="no"
									<?php if($payouts[0]["referral_programs"]=="no") { 
										echo 'checked="checked"';
									} ?>> 
								</div><!-- /.col -->
								<div class="col-lg-1">
									No
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>monetization/payouts" class="btn btn-primary">Cancel</a>
								</div><!-- /.col -->
							</div><!-- /form-group -->
						</form>
					</div>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div>
<script>
	$(document).ready(function(){
		$('#frm_edit_payouts').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_edit_payouts").validationEngine('validate'))
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
				if(responseText==100)
				{
					$("#successMessage").html("Payout Details has been updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"monetization/payouts/";
				}
				else if(responseText==301)
				{
					$("#errorMessage").html("Your session is expired.");
					$("#errorMessage").show();
					window.location=base_url+"user/login";
				}
				else
				{
					$("#errorMessage").html(responseText);
					$("#errorMessage").show();
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});

</script>