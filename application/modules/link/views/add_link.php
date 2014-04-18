
<div class="widget">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3>Add Links</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
					<form class="form-horizontal" id="frm_addLink" action="" method="POST">
						<fieldset>
							<div class="control-group">											
								<label for="link" class="control-label">URl to Publish</label>
								<div class="controls">
							    	<input type="text" class="validate[required,custom[url]]" placeholder="URL" value="http://" name="url" id="url">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">											
								<label for="pricePerLink" class="control-label">Pay Per Click </label>
								<div class="controls">
									<input type="text" value="" id="pricePerLink" name="payPerLink" placeholder="Pay Per Click" class="span4 link-fields price-field validate[required]">
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
		$('#frm_addLink').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addLink").validationEngine('validate'))
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
				if(responseText>0)
				{
					$("#successMessage").html(responseText);
					$("#successMessage").show();
					window.location=base_url+"link";
				}
				else
				{
					$("#errorMessage").html("Link already exist...!");
					$("#errorMessage").show();
				}
			}
		});
		$("#frm_signup").validationEngine();
	});

</script>