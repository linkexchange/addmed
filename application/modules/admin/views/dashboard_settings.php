<?php if($this->session->userdata("userTypeID")==1) : ?>
<div class="widget">
	<div class="widget-header"> 
		<i class="icon-list-alt"></i>
		<h3>Bitly API Settings</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
					<form class="form-horizontal" id="frm_settings" action="" method="POST">
						<fieldset>
							<div class="control-group">												<label for="clientID" class="control-label">Client ID</label>
								<div class="controls">
									<input type="text" id="clientID" name="clientID" placeholder="Client ID" class="span4 link-fields amount validate[required]" value="<?php if(isset($user[0]['clientID'])) echo $user[0]['clientID']; ?>">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">												<label for="clientSecret" class="control-label">Client Secret Key </label>
								<div class="controls">
									<input type="text" value="<?php if(isset($user[0]['clientSecret'])) echo $user[0]['clientSecret']; ?>" id="clientSecret" name="clientSecret" placeholder="Client Secret Key" class="span4 link-fields amount validate[required]">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">												<label for="accessToken" class="control-label">Access Token</label>
								<div class="controls">
									<input type="text" value="<?php if(isset($user[0]['accessToken'])) echo $user[0]['accessToken']; ?>" id="accessToken" name="accessToken" placeholder="Access Token" class="span4 link-fields amount validate[required]">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<a href="<?php echo base_url().$this->session->userdata('userType'); ?>/dashboard" class="btn">Cancel</a>
								</div>
							</div> <!-- /control-group -->
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#frm_settings').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addPayment").validationEngine('validate'))
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
				//alert(responseText);
				if(responseText>0)
				{
					$("#successMessage").html("Publisher details updated successfully");
					$("#successMessage").show();
					window.location=base_url+"<?php echo $this->session->userdata('userType'); ?>/dashboard";
				}
				else
				{
					$("#errorMessage").html("Error updating seetings."+responseText);
					$("#errorMessage").show();
				}
			}
		});
		
	});
</script>
<?php endif; ?>