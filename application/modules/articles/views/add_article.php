<script>
	$(document).ready(function(){
		$(".setArticleData").hide();
	});
</script>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                	<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>Add Gallery Item</h3>
						</div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"></div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                     				<?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
                                    <form class="form-horizontal" id="frm_addArticle" action="" method="POST" enctype="multipart/form-data" >
                            			<fieldset>
                                        	<div class="control-group">
                                                <label for="template" class="control-label">Select Website</label>
                                                <div class="controls">
                                                	
                                                    <select id="templateID" name="templateID" class="validate[required]" onchange="getBlogs(this.value);">
                                                        <option value="">Please Select</option>
                                                        <?php foreach($templates as $template) : ?>
                                                            <?php if($template['id']==$tempID || $template['id']==$this->uri->segment(4)) : ?>
                                                                <option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div> <!-- /controls -->				
                                			</div> <!-- /control-group -->
                                            <div class="setBlogData"></div>
                                            <div class="setArticleData">
                                            	<div class="control-group">											
                                                    <label for="articleTitle" class="control-label">Gallery Item Title</label>
                                                    <div class="controls">
                                                        <input type="text" class="validate[required]" placeholder="Gallery Item Title" value="" name="articleTitle" id="articleTitle">
                                                    </div> <!-- /controls -->				
												</div> <!-- /control-group -->
                                                <div class="control-group">											
                                                    <label for="articleImage" class="control-label">Gallery Item Image</label>
                                                    <div class="controls">
                                                        <input type="file" class="validate[required]" name="articleImage" id="articleImage" size="20" >
                                                        <p class="help-block">Maximum allwoed image size is 10MB.</p>
                                                    </div> <!-- /controls -->				
                                               	</div> <!-- /control-group -->
                                                <div class="control-group">											
                                                    <label for="articleDescription" class="control-label">Gallery Item Description</label>
                                                    <div class="controls">
                                                       <textarea name="articleDescription" id="articleDescription"></textarea>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                            </div>
                                            <div class="control-group">	
                                                <div class="controls">
                                                    <button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
                                                    <a href="<?php echo base_url()?>articles/dashboard" class="btn">Cancel</a>								</div>
                                            </div> <!-- /control-group -->
                                        </fieldset>
                                    </form>
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
	function getBlogs(bid){
			if(bid){
			 $.ajax({
				url:base_url+"articles/dashboard/getTemplateBlogs/"+bid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					$(".setBlogData").html(result);
			}});
			}
			else
			{
				$(".setBlogData").html("");
			}
	}
</script>
<script>
	function getDetails(aid){
			if(aid){
			 	$(".setArticleData").show();
			}
			else
			{
				$(".setArticleData").hide();
			}
	}
</script>
<script>
	$(document).ready(function(){
		$(".setData").hide();
		$('#frm_addArticle').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addArticle").validationEngine('validate'))
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
					$("#errorMessage").html("Please upload gallery item image.");
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
					$("#successMessage").html("Gallery item created successfully.");
					$("#successMessage").show();
					window.location=base_url+"articles/dashboard";
				}
				else if(responseText==103)
				{
					$("#errorMessage").html("Please select Post.");
					$("#errorMessage").show();
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