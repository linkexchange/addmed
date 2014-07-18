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
					<div class="panel-heading"><h3> <i class="icon-list-alt"></i> Edit Website </h3></div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:50%;">
					<div class="panel-body">
						<?php foreach($blog as $item) : ?>
						<form class="form-horizontal" id="frm_editBlog" action="" method="POST" enctype="multipart/form-data" >
							<div class="form-group">
								<label for="Title" class="col-lg-2 control-label">Website Name</label>
								<div class="col-lg-10">
									<input type="hidden" value="<?php echo $item['id']; ?>" name="id">
									<select id="templateID" name="templateID" class="form-control validate[required]" >
										<option value="">Please Select</option>
										<?php foreach($templates as $template) : ?>
											<?php if($template['name']==$item['name']) : ?>
                                                <option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
                                            <?php else : ?>
                                                <option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Title" class="col-lg-2 control-label">Post Title</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="Post Title" value="<?php echo $item['title']; ?>" name="title" id="title">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Title" class="col-lg-2 control-label">Post Image</label>
								<div class="col-lg-10">
									<?php if($item['image']) : ?>
										<img src="<?php echo base_url().BLOG_IMAGE_PATH.$item['image']; ?>" width="100px" height="auto" />
										<input type="file" class="form-control" name="image" id="image" size="20" >
									<?php else : ?>
										 <input type="file" class="form-control validate[required]" name="image" id="image" size="20" >
									<?php endif; ?>
									<p class="help-block">Maximum allwoed image size is 10MB.</p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Title" class="col-lg-2 control-label">Post Description</label>
								<div class="col-lg-10">
									<textarea name="description" id="description" class="form-control"><?php echo $item['description'];?></textarea>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url(); ?>blogs/dashboard" class="btn btn-primary">Cancel</a>
								</div><!-- /.col -->
							</div><!-- /form-group -->
						</form>
						<?php endforeach; ?>
					</div>
					</div>	
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div>
<script>
	$(document).ready(function(){
		//$(".setData").hide();
		$('#frm_editBlog').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editBlog").validationEngine('validate'))
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
				if(responseText==101)
				{
					$("#errorMessage").html("Please upload Post image.");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else if(responseText==100)
				{
					$("#successMessage").html("Post updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"blogs/dashboard";
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
<script>
	function getDetails(lid){
			//alert(lid);
			if(lid){
				$(".setData").show();
			}
			else
			{
				$(".setData").hide();
			}
			//pageactive(pid);
		}
</script>