
<div class="widget">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3>Add Link Category</h3>
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
					<form action ="<?php echo base_url();?>link/addCategory" class="form-horizontal" 
						id="frm_addLinkCat" method="POST">
						<fieldset>
							<!-- /control-group -->
							<div class="control-group">											
								<label for="cat_name" class="control-label">Category Name</label>
								<div class="controls">
									<input type="text" name="category" id="category_name" class="form-control validate[required]">	
								</div> <!-- /controls -->	
								
							</div> <!-- /control-group -->
							<div class="control-group">	
								<div class="controls">
									<input id="add_category_link" class="btn btn-primary" type="submit" value="Save">
									<a href="<?php echo base_url();?>/link/viewCategories" class="btn">Cancel</a>
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
		jQuery("#frm_addLinkCat").validationEngine();
	});
</script>