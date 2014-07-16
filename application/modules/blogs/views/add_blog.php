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
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"><h3> <i class="fa fa-file-text fa-lg"></i> Add Post </h3></div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div class="panel-body">
						<form class="form-horizontal" id="frm_addBlog" action="<?php echo base_url();?>blogs/dashboard/addPost" method="POST" enctype="multipart/form-data">
							
							<div class="form-group">
								<label for="Name" class="col-lg-2 control-label">Select Website</label>
								<div class="col-lg-10">
									<select id="templateID" name="templateID" class="form-control validate[required]" onchange="getDetails(this.value); ">
										<option value="">Please Select</option>
										<?php foreach($templates as $item) : ?>
										<option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Name" class="col-lg-2 control-label">Post Title</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="Post Title" value="" name="title" id="title">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Name" class="col-lg-2 control-label">Post Image</label>
								<div class="col-lg-10">
									 <input type="file" class="form-contrl validate[required]" name="image" id="image" size="20" >
                                        <p class="help-block">Maximum allwoed image size is 10MB.</p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Name" class="col-lg-2 control-label">Post Description</label>
								<div class="col-lg-10">
									<textarea name="description" id="description" class="form-control validate[required]"></textarea>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>blogs/dashboard" class="btn btn-primary">Cancel</a>
								</div><!-- /.col -->
							</div><!-- /form-group -->
						</form>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div>
<script>
	$(document).ready(function(){
		$(".setData").hide();
		$('#frm_addBlog').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addBlog").validationEngine('validate'))
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
					$("#errorMessage").html("Please upload post image.");
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
					$("#successMessage").html("Post created successfully.");
					$("#successMessage").show();
					window.location=base_url+"blogs/dashboard";
				}
				else
				{
                                    alert(responseText);
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
