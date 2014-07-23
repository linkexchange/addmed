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
					<div class="panel-heading"><h3> <i class="icon-anchor"></i> Edit Category </h3></div>
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
						<form action ="<?php echo base_url();?>link/editCategory" class="form-horizontal" 
						id="frm_addLinkCat" method="POST">
							<div class="form-group">
								<label for="Category Name" class="col-lg-2 control-label">Category Name</label>
								<div class="col-lg-10">
									<input type="hidden" name="id" value="<?php echo $cats['id'];?>">
									<input type="text" name="category" id="category_name" value="<?php echo $cats['category_name'];?>" class="form-control validate[required]">	
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url(); ?>link/viewCategories" class="btn btn-primary">Cancel</a>
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
