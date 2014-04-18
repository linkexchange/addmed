
<div class="widget">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3>Add Billy Links</h3>
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
									<input type="hidden" value="<?php echo $url['id']; ?>" name="id">
							    	<input type="text" class="validate[required,custom[url]]" placeholder="URL" value="<?php echo $url['url']; ?>" name="url" id="url" readonly="">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">											
								<label for="billyUrl" class="control-label">Billy URL</label>
								<div class="controls">
									<input type="text" value="<?php echo $url['billyUrl']; ?>" id="billyUrl" name="billyUrl" placeholder="Billy URL" class="span4 link-fields price-field validate[required,custom[url]]">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<?php if($this->session->userdata("userTypeID")==3) : ?>
										<a href="<?php echo base_url(); ?>publisher/dashboard" class="btn">Cancel</a>
									<?php else : ?>
										<a href="<?php echo base_url(); ?>/link" class="btn">Cancel</a>
									<?php endif; ?>
									
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
				$("#successMessage").html("You link Edited successfully...!");
				$("#successMessage").show();
				<?php if($this->session->userdata("userTypeID")==3) : ?>
					window.location=base_url+"publisher/dashboard";
				<?php else : ?>
					window.location=base_url+"link";
				<?php endif; ?>
			}
		});
		$("#frm_signup").validationEngine();
	});
</script>