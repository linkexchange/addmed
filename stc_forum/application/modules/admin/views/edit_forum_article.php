<?php //echo "<pre>"; print_r($articles); echo "</pre>"; ?>
<link href="<?php echo base_url(); ?>css/font-awesome.min_1.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/froala_editor.min.css" rel="stylesheet" type="text/css"> 
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                	<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>Edit Article</h3>
						</div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"></div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                                	<!-- article foreach #start -->
                                	<?php foreach($articles as $article) : ?>
                                    
                     				<?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
                                    <form class="form-horizontal" id="frm_editArticle" action="" method="POST" enctype="multipart/form-data" >
                            			<fieldset>
                             				
                                            <div class="setArticleData">
                                            	<div class="control-group">											
                                                    <label for="articleTitle" class="control-label">Article Topic</label>
                                                    <div class="controls">
                                                        <input type="text" class="validate[required]" placeholder="Article topic" value="<?php echo $article['topic']; ?>" name="articleTopic" id="articleTopic">
                                                    </div> <!-- /controls -->				
												</div> <!-- /control-group -->
                                                <div class="control-group">											
													<label for="image" class="control-label">Article Image</label>
													<div class="controls">
														<?php if($article['image']) : ?>
															<img src="<?php echo base_url().'uploads/forum_article_images/'.$article['image']; ?>" width="100px" height="auto" />
															<input type="file" class="" name="image" id="image" size="20" >
														<?php else : ?>
															 <input type="file" class="validate[required]" name="image" id="image" size="20" >
														<?php endif; ?>
														<p class="help-block">Maximum allwoed image size is 10MB.</p>
													</div> <!-- /controls -->				
												</div>
												<div class="control-group">	   
													<label for="articleDescription" class="control-label">Article Description</label>
                                                    <div class="controls">
                                                       <textarea name="articleDescription" id="articleDescription"><?php echo $article['description']; ?></textarea>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                            </div>
                                             <div class="control-group">	
                                                <div class="controls">
                                                    <button id="btn_submit" class="btn btn-primary" type="submit" >Save</button> 
                                                    <a href="<?php echo base_url()?>admin/forum_article" class="btn">Cancel</a>						
												</div>
                                            </div> <!-- /control-group -->
                                        </fieldset>
                                    </form>
                                    <?php endforeach; ?>
                                    <!-- article foreach #end -->
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div><!-- widget -->
                </div><!-- span12 -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- main-inner -->
</div> <!-- main -->

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
					window.location=base_url+"admin/forum_article";
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