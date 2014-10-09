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
			<h3><b><i class="icon-file"></i>  Edit Website </b> </h3>
		</div>
	</div> <br/>
	<div class="row">
		<div class="col-md-12">
			<?php foreach($articles as $article) : ?>
			<div class="panel panel-default" style="border:1px solid #D6E9F3;">
				<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
				<div id="successMessage" class="alert alert-success" style="display:none"></div>
				<form class="form-horizontal" id="frm_editArticle" action="" method="POST" enctype="multipart/form-data" >
				<div class="panel-body">
					<div class="form-group">
						<label for="Article Topic" class="col-lg-2 control-label">Name of Website</label>
						<div class="col-lg-5">
								 <input type="text" class="form-control validate[required]" placeholder="Website Name" value="<?php echo $article['website_name']; ?>" name="website_name" id="articleTopic">
						</div><!-- /.col -->
					</div><!-- /form-group -->
				
					<div class="form-group">
							<label for="Article Image" class="col-lg-2 control-label">Website Logo</label>
							<div class="col-lg-5">
									<img src="<?php echo base_url().'uploads/website_logo/'.$article['logo']; ?>" width="100px" height="auto" />
									<input type="file" class="form-control" name="web_logo" size="20">
								<p class="help-block">Maximum allowed image size is 10MB.</p>
							</div><!-- /.col -->
					</div><!-- /form-group -->
					
					<?php if($this->session->userdata("userTypeID")==1) {?>
					<div class="form-group">
						<label for="Website Screenshot" class="col-lg-2 control-label">Website Screenshot</label>
						<div class="col-lg-5">
						<?php if($article['screen_shot']!=""){ ?>
							<img src="<?php echo base_url().'uploads/website_screenshots/'.$article['screen_shot']; ?>" width="100px" height="auto"/>
						<?php } ?>	
							<input type="file" class="form-control" name="web_screenshot" size="20">
							<p class="help-block">Maximum allowed image size is 10MB.</p>
						</div><!-- /.col -->
					</div><!-- /form-group -->
					
					<?php } ?>
					
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
							<a href="<?php echo base_url()?>analytics_websites/dashboard" class="btn btn-primary">Cancel</a>	
						</div>
					</div><!-- /form-group -->
				</div>
				</form>	
			</div><!-- /panel -->
			<?php endforeach; ?>
		</div><!-- /.col -->
	</div>
</div><!-- /.padding-md -->
</div>
<script>
	$(document).ready(function(){
		$('#frm_editArticle').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editArticle").validationEngine('validate'))
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
					$("#successMessage").html("Website updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"analytics_websites/dashboard";
				}
				else if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
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