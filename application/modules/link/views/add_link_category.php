<div id="main-container">
	<!--<div id="breadcrumb">
		<ul class="breadcrumb">
			 <li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
			 <li>Form</li>	 
			 <li class="active">Form Element</li>	 
		</ul>
	</div><!--breadcrumb-->
	<div class="padding-md">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><h3> <i class="fa fa-anchor fa-lg"></i> Add Link Category </h3></div>
					<?php if(isset($msg)){?>
					<div id="errorMessage" class="alert alert-danger">
					<?php echo $msg;?>
					</div>
					<?php } else { ?>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<?php } ?>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:50%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_addLinkCat" action="<?php echo base_url();?>link/addCategory" method="POST" enctype="multipart/form-data">
							
							<div class="form-group">
								<label for="Name" class="col-lg-2 control-label">Category Name</label>
								<div class="col-lg-10">
									<input type="text" name="category" id="category_name" class="form-control validate[required]">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>link/viewCategories" class="btn btn-primary">Cancel</a>
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
	jQuery(document).ready(function() {
		// binds form submission and fields to the validation engine
		jQuery("#frm_addLinkCat").validationEngine();
	});
</script>
