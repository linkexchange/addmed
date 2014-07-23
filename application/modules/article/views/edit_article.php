<div id="main-container">
<!--<div id="breadcrumb">
	<ul class="breadcrumb">
		 <li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
		 <li>Form</li>	 
		 <li class="active">Form Element</li>	 
	</ul>
</div><!--breadcrumb-->
<div class="padding-md">
	<div class="row" style="margin-left:0px;margin-right:0px;">
		<div class="col-md-12">
			<?php foreach($articles as $article) : ?>
			<div class="panel panel-default">
				<div class="panel-heading"><h3><i class="icon-tasks"></i> Edit Article</h3></div>
				<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
				<div id="successMessage" class="alert alert-success" style="display:none"></div>
				<form class="form-horizontal" id="frm_editArticle" action="" method="POST" enctype="multipart/form-data" >
				<div class="panel-body">
					<div class="form-group">
						<label for="Article Topic" class="col-lg-2 control-label">Article Topic</label>
						<div class="col-lg-5">
								 <input type="text" class="form-control validate[required]" placeholder="Article topic" value="<?php echo $article['topic']; ?>" name="articleTopic" id="articleTopic">
						</div><!-- /.col -->
					</div><!-- /form-group -->
				
					<div class="setData">
						<div class="form-group">
							<label for="Article Image" class="col-lg-2 control-label">Article Image</label>
							<div class="col-lg-5">
									<img src="<?php echo base_url().'uploads/forum_article_images/'.$article['image']; ?>" width="100px" height="auto" />
									<input type="file" class="form-control" name="image" id="image" size="20">
								<p class="help-block">Maximum allwoed image size is 10MB.</p>
							</div><!-- /.col -->
						</div><!-- /form-group -->
					</div><!-- // .setBlogData -->	
					<div class="form-group">
						<label for="Article Description" class="col-lg-2 control-label">Article Description</label>
						<div class="col-lg-10">
							<textarea name="articleDescription" id="articleDescription"><?php echo $article['description']; ?></textarea>
						</div><!-- /.col -->
					</div><!-- /form-group -->
					
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
							<a href="<?php echo base_url()?>article/dashboard" class="btn btn-primary">Cancel</a>	
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
					$("#successMessage").html("Article updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"article/dashboard";
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