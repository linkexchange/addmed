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
				<h3> <i class="icon-anchor"></i> Set CPC for category</h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
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
						<form action ="<?php echo base_url();?>link/setCPCValue" class="form-horizontal" 
						id="frm_setCPC" method="POST">
							<div class="form-group">
								<label for="Select Category" class="col-lg-2 control-label">Select Category</label>
								<div class="col-lg-10">
									<select name="category" class="form-control validate[required]" onchange="getCategoryCPC(this.value);">
                                    	<option value="">Please select</option>
									<?php for($i=0;$i<count($categories);$i++) { ?>
										<option value="<?php echo $categories[$i]['id'];?>">
											<?php echo $categories[$i]['category_name'];?>
										</option>
									<?php } ?>
									</select>	
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="cpc_value" class="col-lg-2 control-label">Enter CPC</label>
								<div class="col-lg-10">
									<input id="cpc" name="cpc" type="text" placeholder="cpc" class="form-control validate[required]" value="">	
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
<script>
	jQuery(document).ready(function() {
		// binds form submission and fields to the validation engine
		jQuery("#frm_setCPC").validationEngine();
	});
</script>