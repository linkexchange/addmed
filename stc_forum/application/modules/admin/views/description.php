<script>
	$(document).ready(function(){
		$("#comment_desc").hide();
		$("#reply_desc").hide();
		$("#errorMessage").hide();
		$("#successMessage").hide();
	});
</script>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Article Description</title>
</head>
<?php $id = $this->uri->segment(4);?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3><?php echo $article[0]['topic'];?></h3>
						</div>
                        <div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                             		<div class="widget-content inner">
                                    	<table class="table table-striped table-bordered">
                                                <tbody>	
													<tr>	
														<td>
															<img src="<?php echo base_url().'uploads/forum_article_images/'.$article[0]['image'];?>">
															<?php echo $article[0]['description'];?>  
														</td>
													</tr>
												</tbody>
                                    	</table><!-- table -->
										<a href="#" id="comment">Comment</a> 
										
										<div id="comment_desc">
												<form class="form-horizontal" id="frm_Comment" action="" method="POST" enctype="multipart/form-data" >
												<fieldset>
												<div class="control-group">
													<label for="template" class="control-label">
														Comment:
													</label>
													<div class="controls">
														<textarea name="comment_description" class="validate[required]"></textarea>
													</div>
												</div>
												<div class="control-group">
													<label for="template" class="control-label">
													Your Name:
													</label>
													<div class="controls">
													<input type="text" name="name" class="validate[required]">	
													</div>
												</div>
												<div class="control-group">
													<label for="template" class="control-label">
													Your Email:
													</label>
													<div class="controls">
													<input type="text" name="email" class="validate[required,custom[email]]">	
													</div>
												</div>	
												<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(4);?>">
												<div class="control-group">	
													<div class="controls">
                                                    <button id="btn_submit" class="btn btn-primary" type="submit">Save</button>
													<a href="#" id="cancel" class="btn">Cancel</a>	
													</div>
												</div> <!-- /control-group -->
												</fieldset>
												</form>	
										</div>
										
										<div id="user_comments">
												<div id="new_comment" style="display:none;">
												</div>
												<?php for($i=0;$i<count($comments);$i++){ ?>
												<h4>Comment</h4>
												<div style="width:100%;border: 1px solid #dddddd; border-radius:5px; background-color:#f5f5f5;"><hr>&nbsp; &nbsp; 
												<b><?php echo $comments[$i]['name'];?></b>&nbsp; &nbsp; 
												<?php echo $comments[$i]['created_date'];?>
												<br/> &nbsp; &nbsp;
												<?php echo $comments[$i]['description'];?><br/>&nbsp; &nbsp;
												
												<a href="#" onclick="display(<?php echo $i;?>);return false;">Reply</a>
												<form class="form-horizontal" id="frm_Reply" action="" method="POST" enctype="multipart/form-data">
												<div id="number_<?php echo $i;?>">	
												<div id="reply_desc_<?php echo $i;?>" style="display:none;">
												<fieldset>
												<div class="control-group">
													<label for="template" class="control-label">
														Reply:
													</label>
													<div class="controls">
														<textarea name="reply_description" class="validate[required]"></textarea>
													</div>
												</div>
												<div class="control-group">
													<label for="template" class="control-label">
													Your Name:
													</label>
													<div class="controls">
													<input type="text" name="name2" class="validate[required]">	
													</div>
												</div>
												<div class="control-group">
													<label for="template" class="control-label">
													Your Email:
													</label>
													<div class="controls">
													<input type="text" name="email2" class="validate[required,custom[email]]">	
													</div>
												</div>	
												<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(4);?>">
												<input type="hidden" name="commentid" value="<?php echo $comments[$i]['id'];?>">

												<div class="control-group">	
													<div class="controls">
                                                    <button id="btn_submit_<?php echo $i;?>" class="btn btn-primary" type="submit" onclick="submitData(<?php echo $i;?>);">Save</button>
													<a href="#" onclick="hide(<?php echo $i;?>);return false;" class="btn">Cancel</a>	
													</div>
												</div> <!-- /control-group -->
												</fieldset>
											
												</div>
												</form>
												<div id="replies_<?php echo $i;?>" style="margin-left: 30px;">
												<div id="new_reply_<?php echo $i;?>"></div>
												<?php  
													for($j=0;$j<count($replies);$j++) {
														if($replies[$j]['parent_id']==$comments[$i]['id']){?>&nbsp; &nbsp; &nbsp; &nbsp;
														<b><?php echo $replies[$j]['name'];?></b>&nbsp; &nbsp; 
														<?php echo $replies[$j]['created_date'];?>
														<br/> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 
														<?php echo $replies[$j]['description'];?>
														&nbsp; <a href="#" onclick="display2(<?php echo $j;?>);return false;">Reply</a>
														<div id="reply_<?php echo $j;?>"  style="display:none;">
															<form class='form-horizontal' id='frm_Reply2' action=''  method='POST' enctype='multipart/form-data'><fieldset><div class='control-group'><label for='template' class='control-label'>Reply:</label><div class='controls'><textarea name='reply_description2' class='validate[required]'></textarea></div></div><div class='control-group'><label for='template' class='control-label'>Your Name:</label><div class='controls'><input type='text' name='name3' class='validate[required]'></div></div><div class='control-group'><label for='template' class='control-label'>Your Email:</label><div class='controls'><input type='text' name='email3' class='validate[required,custom[email]]'></div></div><input type='hidden' name='articleid' value='<?php echo $this->uri->segment(4);?>'><input type='hidden' name='replyid' value='<?php echo $replies[$j]['id']?>'><div class='control-group'><div class='controls'><button id='btn_submit3' onclick='submitData2(<?php echo $j;?>);' class='btn btn-primary' type='submit'>Save</button>&nbsp;<a href='#' onclick='hide2(<?php echo $j;?>);return false;' class='btn'>Cancel</a></div></div></fieldset></form>
														</div>
														
														<script>
														$(document).ready(function(){
																$.ajax({
																	url:base_url+'forum_articles/listing/load/'+<?php echo $replies[$j]['id'];?>,
																	type:'POST',
																	data:{submit:true},
																success: function (result) {
																	$('#setReplies_'+<?php echo $j;?>).html(result);
																}
															});	
														});
														</script>
														<div id="setReplies_<?php echo $j;?>"> 
														</div>
														<hr>
												<?php		
														}
													}	
												?>
												</div>
												</div>
												</div>
											<hr>	
											<?php } ?>
										</div>	
                                    	<!-- setArticles  -->
                                    <!-- widget-content  -->
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div>
                </div><!-- .span12-->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .main-inner -->
</div><!-- .main -->
<script>
	$("#comment").click(function(){
		$("#comment_desc").show();
		return false;
	});
	$("#cancel").click(function(){
		$("#comment_desc").hide();
		return false;
	});
	$("#cancel2").click(function(){
		$("#reply_desc").hide();
		return false;
	});
</script>
<script>
	function display(no)
	{
		$("#reply_desc_"+no).show();
	}
	function display2(no,id)
	{
		$("#reply_"+no).show();
	}
	function hide(no)
	{
		$("#reply_desc_"+no).hide();
	}
	function hide2(no)
	{
		$("#reply_"+no+"").hide();
	}
</script>
<script>
	$(document).ready(function(){
		$('#frm_Comment').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_Comment").validationEngine('validate'))
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
				if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else
				{
					//alert(responseText);
					$("#comment_desc").hide();
					$("#new_comment").show();
					$("#new_comment").html(responseText);
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});
</script>
<script>
	function submitData(no){
		$('#frm_Reply').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit_"+no).button('loading');
				if($("#frm_Reply").validationEngine('validate'))
				{
					$("#btn_submit_"+no).button('loading');
					return true;
				}
				else
				{
					$("#btn_submit_"+no).button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#btn_submit_"+no).button("reset");
				if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else if(responseText==100)
				{
					//alert(responseText);
					//$("#reply_desc_"+no).hide();
					//$("#new_reply_"+no).html(responseText);
					//$("#new_reply_"+no).show();
					window.location=base_url+"admin/forum_article/view/"+<?php echo $id;?>;				
				}
			}
		});
		//$("#frm_signup").validationEngine();
	}
</script>
<script>
	function submitData2(no){
		$('#frm_Reply2').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit3").button('loading');
				if($("#frm_Reply2").validationEngine('validate'))
				{
					$("#btn_submit3").button('loading');
					return true;
				}
				else
				{
					$("#btn_submit3").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#btn_submit3").button("reset");
				if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else if(responseText==100)
				{
					//alert(responseText);
					//$("#reply_"+no).hide();
					//$("#setReplies_"+no).prepend(responseText);
					window.location=base_url+"admin/forum_article/view/"+<?php echo $id;?>;				
				}

				}
			}
		});
	}	
</script>