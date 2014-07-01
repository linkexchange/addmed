
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                	<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>Edit Bookmark</h3>
						</div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"></div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                                	<!-- article foreach #start -->
                                	<?php foreach($bookmark as $bkmark) : ?>
                                    
                     				<?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
                                    <form class="form-horizontal" id="frm_editBookmark" action="" method="POST" enctype="multipart/form-data" >
                            			<fieldset>
                             				
                                            <div class="setArticleData">
                                            	<div class="control-group">											
                                                    <label for="articleTitle" class="control-label">Name</label>
                                                    <div class="controls">
                                                        <input type="text" class="validate[required]" 
														value="<?php echo $bkmark['name']; ?>" name="bookmark" id="bookmark">
                                                    </div> <!-- /controls -->				
												</div> <!-- /control-group -->
												
												<div class="control-group">	   
													<label for="articleDescription" class="control-label">Url</label>
                                                    <div class="controls">
                                                      <input type="text" class="validate[required]"  value="<?php echo $bkmark['url']; ?>" name="url" id="url" readonly>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                            </div>
                                             <div class="control-group">	
                                                <div class="controls">
                                                    <button id="edit_bkmark" class="btn btn-primary" type="submit">Save</button> 
                                                    <a href="<?php echo base_url();?>forum_articles/listing/show_bookmarks" class="btn">Cancel</a>						
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
		$('#frm_editBookmark').ajaxForm({
			beforeSubmit : function(){
				$("#edit_bkmark").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editBookmark").validationEngine('validate'))
				{
					$("#edit_bkmark").button('loading');
					return true;
				}
				else
				{
					$("#edit_bkmark").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#edit_bkmark").button("reset");
				if(responseText==100)
				{
					$("#successMessage").html("Bookmark updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"forum_articles/listing/show_bookmarks";
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
