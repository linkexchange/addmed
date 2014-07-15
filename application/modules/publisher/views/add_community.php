	<div id="main-container">
			
			<div class="col-md-6" style="width:100%;">
						<div class="panel panel-default">
							<?php if(isset($error)) { ?>
							<div id="errorMessage" class="alert alert-danger"><?php echo $error;?></div>
							<?php } ?>
							<form class="form-horizontal form-border no-margin" id="add_community" method="post" enctype="multipart/form-data">
								<div class="panel-heading">
									<h4><b>Add community</b></h4>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-lg-3">Community Title</label>
										<div class="col-lg-9">
											<input type="text" class="form-control input-sm parsley-validated" name="title" placeholder="Community Title" value="<?php echo set_value('title');?>">
											<font color="red"><?php echo form_error('title');?></font>
										</div><!-- /.col -->
									</div><!-- /form-group -->
									<div class="form-group">
										<label class="control-label col-lg-3">Community Image</label>
										<div class="col-lg-9">
											<input type="file" name="image">
											<font color="red">
												<?php if(isset($uploadmsg)){ echo $uploadmsg;}?>
												<?php echo form_error('image'); ?>
											</font>
										</div><!-- /.col -->
									</div><!-- /form-group -->
									<div class="form-group">
										<label class="control-label col-lg-3">Community Description</label>
										<div class="col-lg-9">
											<font color="red"><?php echo form_error('description'); ?></font>
											<textarea name="description" id="communityDescription"><?php echo set_value('description');?></textarea>
										</div><!-- /.col -->
									</div><!-- /form-group -->
								</div>
								<div class="panel-footer text-right">
									<button type="submit" class="btn btn-success">Submit</button>
									<a href="<?php echo base_url();?>" class="btn">Cancel</a>
								</div>
							</form>
						</div><!-- /panel -->
					</div>
		</div>
	</div>
	
