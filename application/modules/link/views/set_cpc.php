<script>
	function getCategoryCPC(cid){
			if(cid){
				 $.ajax({
				url:base_url+"link/link/getCategoryCPC/"+cid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					$("#cpc").val(result);
					
				}});
			 	
			}
			else
			{
				$("#cpc").val("");
			}
	}
</script>
<div class="widget">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3>Set CPC for category</h3>
	</div>
	<?php if(isset($msg)){?>
	<div id="errorMessage" class="alert alert-danger">
	<?php echo $msg;?>
	</div>
	<?php } else { ?>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<?php } ?>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
					<form action ="<?php echo base_url();?>link/setCPCValue" class="form-horizontal" 
						id="frm_setCPC" method="POST">
						<fieldset>
							<!-- /control-group -->
							<div class="control-group">											
								<label for="cat_name" class="control-label">Select Category</label>
								<div class="controls">
									<select name="category" class="validate[required]" onchange="getCategoryCPC(this.value);">
                                    	<option value="">Please select</option>
									<?php for($i=0;$i<count($categories);$i++) { ?>
										<option value="<?php echo $categories[$i]['id'];?>">
											<?php echo $categories[$i]['category_name'];?>
										</option>
									<?php } ?>
									</select>	
								</div> <!-- /controls -->	
								
							</div> <!-- /control-group -->
							<div class="control-group">	
								<label for="cpc_value"  class="control-label">Enter CPC</label>
								<div class="controls">
									<input id="cpc" name="cpc" type="text" placeholder="cpc" class="form-control validate[required]" value="">
								</div>
							</div> 
							<div class="control-group">	
								<div class="controls">
									<input id="add_category_link" class="btn btn-primary" type="submit" value="Save">
									<a href="<?php echo base_url();?>link/viewCategories" class="btn">Cancel</a>
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
	jQuery(document).ready(function() {
		// binds form submission and fields to the validation engine
		jQuery("#frm_setCPC").validationEngine();
	});
</script>