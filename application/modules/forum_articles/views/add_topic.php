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
								<h3>Add topic</h3>
						</div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"></div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                     				<?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
                                    <form class="form-horizontal" id="frm_topic" action="" method="POST" enctype="multipart/form-data" >
                            			<fieldset>
                                        	<div class="control-group">		
													<label for="topic" class="control-label">Topic name</label>
                                                    <div class="controls">
                                                        <input type="text" class="validate[required]" placeholder="topic name" value="" name="topic">
                                                    </div> <!-- /controls -->				
											</div> <!-- /control-group -->
											<div class="control-group">		
													<label for="author" class="control-label">Your name</label>
                                                    <div class="controls">
                                                        <input type="text" class="validate[required]" placeholder="author name" value="" name="author">
                                                    </div> <!-- /controls -->				
											</div> <!-- /control-group -->
											<div class="control-group">		
													<label for="email" class="control-label">Email</label>
                                                    <div class="controls">
                                                        <input type="text" class="validate[required]" placeholder="email" value="" name="email">
                                                    </div> <!-- /controls -->				
											</div> <!-- /control-group -->
											<div class="control-group">		   
													<label for="topicDescription" class="control-label">Topic Description</label>
                                                    <div class="controls">
                                                       <textarea name="topicDescription" id="topicDescription" class="validate[required]"></textarea>
                                                    </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">	
                                                <div class="controls">
                                                    <button id="btn_topic" class="btn btn-primary" type="submit">Save</button> 
                                                    <a href="<?php echo base_url()?>forum_articles/forum" class="btn">Cancel</a>						
												</div>
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
	$(document).ready(function(){
		$('#frm_topic').ajaxForm({
			beforeSubmit : function(){
				$("#btn_topic").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_topic").validationEngine('validate'))
				{
					$("#btn_topic").button('loading');
					return true;
				}
				else
				{
					$("#btn_topic").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#btn_topic").button("reset");
				if(responseText==100)
				{
					$("#successMessage").html("Your topic is under approval process.You can see it after approval.");
					$("#successMessage").show();
					//alert("Data inserted successfully");
					window.location=base_url+"forum_articles/forum";
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
		
	});
</script>
<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 
<script>
      jQuery(function($){
          $('#topicDescription').editable({inlineMode: false, height: 500})
      });
</script>
