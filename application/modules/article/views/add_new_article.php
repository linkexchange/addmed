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
				<h3><b><i class="icon-tasks"></i>  Add Article </b> </h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div class="panel-body">
						<form class="form-horizontal" id="frm_addNewArticle" action="" method="POST" enctype="multipart/form-data" >
							<div class="form-group">
								<label for="Article Topic" class="col-lg-2 control-label">Article Topic</label>
								<div class="col-lg-5">
									<input type="text" class="form-control validate[required]" placeholder="Article Title" value="" name="articleTopic" id="articleTopic">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Article Image" class="col-lg-2 control-label">Article Image</label>
								<div class="col-lg-5">
									<input type="file" class="form-control validate[required]" name="image" id="image" size="20" >
									<p class="help-block">Maximum allwoed image size is 10MB.</p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Description" class="col-lg-2 control-label">Article Description</label>
								<div class="col-lg-10">
									<textarea name="articleDescription" id="articleDescription" class="validate[required]"></textarea>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>article/dashboard" class="btn btn-primary">Cancel</a>
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
		$('#frm_addNewArticle').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addNewArticle").validationEngine('validate'))
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
				if(responseText==100)
				{
					$("#successMessage").html("Article created successfully.");
					$("#successMessage").show();
					//alert("Data inserted successfully");
					window.location=base_url+"article/dashboard/";
				}
				else if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else if(responseText==101)
				{
					$("#errorMessage").html("Please upload article image.");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
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
<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 
<script>
      jQuery(function($){
          $('#articleDescription').editable({inlineMode: false, height: 500})
      });
</script>
