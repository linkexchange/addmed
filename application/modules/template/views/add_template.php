
<div class="widget">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3>Add Website</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
					<form class="form-horizontal" id="frm_addTemplate" action="<?php echo base_url(); ?>template/dashboard/addTemplate" method="POST">
						<fieldset>
							<div class="control-group">											
								<label for="name" class="control-label">Name</label>
								<div class="controls">
							    	<input type="text" class="validate[required]" placeholder="Website Name" value="" name="name" id="name">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<a href="<?php echo base_url()?>template/dashboard" class="btn">Cancel</a>								</div>
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
		$('#frm_addTemplate').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addTemplate").validationEngine('validate'))
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
					$("#successMessage").html("Website created successfully.");
					$("#successMessage").show();
					window.location=base_url+"template/dashboard";
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