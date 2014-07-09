<link href="<?php echo base_url(); ?>css/font-awesome.min_1.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/froala_editor.min.css" rel="stylesheet" type="text/css"> 
<?php //echo "<pre>"; print_r($articles); echo "</pre>"; ?>
<div class="main">
    <div class="main-inner">
	<div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget">
                    	<div class="widget-header"> 
                            <i class="icon-list-alt"></i>
                            <h3>Edit Gallery Item</h3>
			</div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<div id="successMessage" class="alert alert-success" style="display:none"></div>
                    	<div class="widget-content">
                            <div class="big-stats-container">
                            	<div class="widget-content inner">
                                    <!-- article foreach #start -->
                                    <?php foreach($articles as $article) : ?>
                                    <script>
                                        $(document).ready(function(){
                                            var tid=<?php echo $article['templateID']; ?>;
                                            var bid=<?php echo $article['blogID']; ?>;
                                            $.ajax({
                                                url:base_url+"articles/dashboard/getTemplateBlogs/"+tid+"/"+bid,
						//beforeSend: loadStartPub,
						//complete: loadStopPub,
						success:function(result){
                                                    $(".setBlogData").html(result);
                                            }});
                                        });
                                    </script>
                                    <?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
                                    <form class="form-horizontal" id="frm_editArticle" action="" method="POST" enctype="multipart/form-data" >
                            		<fieldset>
                             				<div class="control-group">
                                                <label for="template" class="control-label">Select Website</label>
                                                <div class="controls">
                                                	
                                                    <select id="templateID" name="templateID" class="validate[required]" onchange="getBlogs(this.value);">
                                                        <option value="">Please Select</option>
                                                        <?php foreach($templates as $template) : ?>
                                                            <?php if($template['id']==$article['templateID']) : ?>
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
                                                        <input type="hidden" id="id" name="id" value="<?php echo $article['id']; ?>" />
                                                        <input type="text" class="validate[required]" placeholder="Gallery Item Title" value="<?php echo $article['articleTitle']; ?>" name="articleTitle" id="articleTitle">
                                                    </div> <!-- /controls -->				
												</div> <!-- /control-group -->
                                                <div class="control-group">	
                                                	 <label for="articleImage" class="control-label">Article Image</label>	
                                                     <div class="controls">									
														<?php if($article['articleImage']) : ?>
                                                            <img src="<?php echo base_url().ARTICLE_IMAGE_PATH.$article['articleImage']; ?>" width="100px" height="auto" />
                                                            <input type="file" class="" name="articleImage" id="articleImage" size="20" >
                                                        <?php else : ?>
                                                            <input type="file" class="" name="articleImage" id="articleImage" size="20" >
                                                        <?php endif; ?>	
                                                        <p class="help-block">Maximum allwoed image size is 10MB.</p>	
                                                    </div>	
                                               	</div> <!-- /control-group -->
                                                <div class="control-group">
                                                    <label class="control-label"></label>
                                                    <div class="controls">
                                                        <p>OR</p>
                                                    </div>
                                                </div> <!-- /control-group -->
                                                <div class="control-group">
                                                    <label for="articleVideo" class="control-label">Gallery Item Video</label>
                                                    <div class="controls">
                                                        <textarea name="articleVideo"><?php echo $article['articleVideo']; ?></textarea>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                                <div class="control-group">											
                                                    <label for="articleDescription" class="control-label">Gallery Item Description</label>
                                                    <div class="controls">
                                                       <textarea name="articleDescription" id="articleDescription"><?php echo $article['articleDescription']; ?></textarea>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                            </div>
                                             <div class="control-group">	
                                                <div class="controls">
                                                    <button id="btn_submit" class="btn btn-primary" type="submit" >Save</button> 
                                                    <a href="<?php echo base_url()?>articles/dashboard" class="btn">Cancel</a>								</div>
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
			
	}
</script>
<script>
	$(document).ready(function(){
		$(".setData").hide();
		$('#frm_editArticle').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editArticle").validationEngine('validate'))
				{
					var msg="";
                                        if(($('#articleImage').val()=="") && ($('#articleVideo').val()=="")){
                                            msg+="Gallery item image or video is required for gallery item.";
                                        }
                                        if(msg==""){
                                            $("#btn_submit").button('loading');
                                            return true;
                                        }
                                        else
                                        {
                                            $("#errorMessage").html(msg);
                                            $("#errorMessage").show();
                                            $("#btn_submit").button('reset');
                                            return false; 
                                        }
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
					$("#successMessage").html("Gallery item updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"articles/dashboard";
				}
				else if(responseText==103)
				{
					$("#errorMessage").html("Please select post.");
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
<script>
      jQuery(function($){
          $('#articleDescription').editable({inlineMode: false, height: 500})
      });
</script>
<!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script> -->
<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 