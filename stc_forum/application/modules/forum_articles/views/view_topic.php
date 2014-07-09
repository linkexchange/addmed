
<div class="main">
			<div class="main-inner">
				<div class="container">
					<div class="row">
						<div class="span12">
						<?php $id = $topic[0]['id'];?>
						<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3><?php echo $topic[0]['name'];?></h3>
						</div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
								
                            	<div class="widget-content inner">
                             		<div class="widget-content inner">
									<div id="articleTable">	
                                        	<table class="table table-striped table-bordered">
                                                <tbody>	
												<tr>
												<td>
												<?php echo $topic[0]['description'];?>	
												</td>
												</tr>
												</tbody>
                                    		</table><!-- table -->
										<?php if($this->session->userdata('ForumUserID')){ ?>
										<a href="#" id="post" class="btn btn-primary">Post a Comment</a>	
                                    	<?php } else { 
										$actual_link = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>
										<a href="<?php echo base_url();?>user/login/index?link=<?php echo $actual_link;?>" class="btn btn-primary">Login to Post a Comment</a>
										<?php } ?> <br/>
										<div id="post_desc" style="display:none;">
												<form class="form-horizontal" id="frm_Post" action="" method="POST" enctype="multipart/form-data" >
												<fieldset>
												<div class="control-group">
													<label for="Comment" class="control-label">
														Post:
													</label>
													<div class="controls">
														<textarea name="post_description" class="validate[required]"></textarea>
													</div>
												</div>
												<input type="hidden" name="topicid" value="<?php echo $id;?>">
												<div class="control-group">	
													<div class="controls">
                                                    <button id="btn_post" class="btn btn-primary" type="submit">Save</button>
													<a href="#" id="cancel" class="btn">Cancel</a>	
													</div>
												</div> <!-- /control-group -->
												</fieldset>
												</form>	
										</div> <br/>
										<?php if($post){
												if($this->session->userdata('ForumUserID')){
													$cnt = count($post);
												}
												else{ 
														if(count($post)<3)
														{	
															$cnt = count($post);
														}
														else
														{	
															$cnt = 3;
														}
													}	?>
										<div style="width:100%;border: 1px solid #dddddd; border-radius:5px; background-color:#f5f5f5;"><br/>
										<?php for($i=0;$i<$cnt;$i++){?>
										&nbsp; &nbsp;<b><?php echo $post[$i]['name'];?></b>&nbsp; &nbsp; 
												<?php echo $post[$i]['created_date'];?>
												<br/> &nbsp; &nbsp;
												<?php echo $post[$i]['post_description'];?><hr>
										<?php } ?>
										</div>
										<?php }?>
									</div>	
									</div>				
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div>
                        </div><!-- .span12-->
                    </div><!-- .row -->
                </div><!-- .container -->
           	</div><!-- .main-inner -->
        </div>
<script>
$("#post").click(function(e){
	e.preventDefault();
	$("#post_desc").attr('style','display:block;');
});
$("#cancel").click(function(e){
	e.preventDefault();
	$("#post_desc").attr('style','display:none;');
});
$(document).ready(function(){
	$('#frm_Post').ajaxForm({
 		beforeSubmit : function(){
			$("#btn_post").button('loading');
			$("#successMessage").hide();
			$("#errorMessage").hide();
			if($("#frm_Post").validationEngine('validate'))
			{
				$("#btn_post").button('loading');
				return true;
			}
			else
			{
				$("#btn_post").button('reset');
				return false;
			}
		},
		success :  function(responseText, statusText, xhr, $form){
			$("#btn_post").button("reset");
			if(responseText==102)
			{
				$("#errorMessage").html("Please try again..");
				$("#errorMessage").show();
				//window.location=base_url+"publisher/dashboard";
			}
			else
			{
				//alert(responseText);
				window.location=base_url+"forum_articles/forum/view/<?php echo $id;?>";
			}
		}
	});
});	
</script>		