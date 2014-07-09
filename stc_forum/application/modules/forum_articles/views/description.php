<script>
	$(document).ready(function(){
		$("#comment_desc").hide();
		$("#reply_desc").hide();
	});
</script>
<!DOCTYPE html>
<?php $actual_link = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>
<html lang="en">
<head>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "d78c9ed2-be1a-4a83-857c-fa492054996a", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

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
						<?php if($this->session->flashdata('msg')) { ?>
						<div id="successMessage" class="alert alert-success">
							<?php echo $this->session->flashdata('msg'); ?>
						</div>
						<?php } ?>
                        <div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                             		<div class="widget-content inner">
											<span style="float:left;"><i class="icon-user"></i> Created By: 
											 <?php echo $article[0]['userName'];?></span> 
											<span style="float:right;"><i class="icon-time"></i>Created Date: 
											 <?php echo $article[0]['created_date'];?></span>
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
										<div id="icons">
											<script>
											$(document).ready(function(){
													$.ajax({
														url:base_url+'forum_articles/listing/check/'+<?php echo $article[0]['id'];?>,
														type:'POST',
														data:{submit:true},
													success: function (result) {
														if(result=='not')
														{
															$("#bkmark").attr('src','<?php echo base_url();?>img/blank_star.png');
															$("#bkmark").attr('title','Bookmark this article');
															$("#bookmark").attr('data-toggle','modal');
															$("#bookmark").attr('data-target','#basicModal');
														}
														else
														{
															var bid = result;
															$("#bkmark").attr('src','<?php echo base_url();?>img/Star.png');
															$("#bkmark").attr('title','Remove Bookmark');		
														} }
													});	
											});
											</script>
											<?php if($this->session->userdata('ForumUserID')) { ?>
											<a href='#' id="bookmark">
												<img id='bkmark' style='width:3%;margin-bottom:26px;'>
											</a>
											<?php } ?>
											<span class='st_facebook_large' displayText='Facebook' title="share"></span>
											<span class='st_twitter_large' displayText='Tweet' title="tweet"></span>
											<span class='st_linkedin_large' displayText='LinkedIn' title="share"></span>
											<span class='st_pinterest_large' displayText='Pinterest' title="pin it"></span>
											<!--<span class='st_email_large' displayText='Email'></span>-->
										</div>
										<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" 
											aria-labelledby="basicModal" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												
												<h4 class="modal-title" id="myModalLabel"><img src='<?php echo base_url();?>img/Star.png' style='width:3%;'>Add new bookmark
												</h4>
											  </div>
											  <div class="modal-body">
													<form class="form-horizontal" id="frm_bookmark" action="" method="POST" enctype="multipart/form-data" >
													<fieldset>
														<div class="control-group">
															<label for="template" class="control-label">
																Name:
															</label>
															<div class="controls">	
																<input type="text" name="bookmark" class="validate[required]">
															</div>
														</div>		
														<div class="control-group">
															<label for="template" class="control-label">	
																Url:
															</label>
															<div class="controls">	
																<input type="text" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" name="bookmarkUrl" readonly>
															</div>
														</div>
														<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(4);?>">	
													</fieldset>		
												
											  </div>
											  <div class="modal-footer">
												<button type="button" id="bkmrk_button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" id="save_bookmark" class="btn btn-primary">Save</button>
											  </div>
											  </form>
											</div>
										  </div>
										</div> 
										<?php if($this->session->userdata('ForumUserID')){ ?>
										<a href="#" id="comment" class="btn btn-primary">Post a Comment</a>	
                                    	<?php } else { ?>
										<a href="<?php echo base_url();?>user/login/index?link=<?php echo $actual_link;?>" class="btn btn-primary">Login to Post a Comment</a>
										<?php } ?> <br/>
										<br/>
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
												<?php 
												if($comments){
												if($this->session->userdata('ForumUserID')){
													$cnt = count($comments);
												}
												else{ 
														if(count($comments)<3)
														{	
															$cnt = count($comments);
														}
														else
														{	
															$cnt = 3;
														}
													}	
												for($i=0;$i<$cnt;$i++){ ?>
												<h4>Comment</h4>
												<div style="width:100%;border: 1px solid #dddddd; border-radius:5px; background-color:#f5f5f5;"><hr>&nbsp; &nbsp; 
												<b><?php echo $comments[$i]['name'];?></b>&nbsp; &nbsp; 
												<?php echo $comments[$i]['created_date'];?>
												<br/> &nbsp; &nbsp;
												<?php echo $comments[$i]['description'];?><br/>&nbsp; &nbsp;
												<?php 
												if($this->session->userdata('ForumUserID')){?>
												<a href="#" onclick="display(<?php echo $i;?>);return false;">Reply</a>
												<?php } else { ?>
												<a href="<?php echo base_url();?>user/login/index?link=<?php echo $actual_link;?>">Login to Reply</a>
												<?php } ?>
												<div id="number_<?php echo $i;?>">	
												<div id="reply_desc_<?php echo $i;?>" style="display:none;">
												<form class="form-horizontal" id="frm_Reply_<?php echo $i?>" action="" method="POST" enctype="multipart/form-data">
												<fieldset>
												<div class="control-group">
													<label for="template" class="control-label">
														Reply:
													</label>
													<div class="controls">
														<textarea name="reply_description" class="validate[required]"></textarea>
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
														&nbsp; 
														<?php if($this->session->userdata('ForumUserID')){?>
														<a href="#" onclick="display2(<?php echo $j;?>);return false;">Reply</a>
														<?php } else { ?>
														<a href="<?php echo base_url();?>user/login/index?link=<?php echo $actual_link;?>">Login to Reply</a>
														<?php } ?>
														<div id="reply_<?php echo $j;?>"  style="display:none;">
															<form class='form-horizontal' id='frm_Reply2_<?php echo $j;?>' action=''  method='POST' enctype='multipart/form-data'><fieldset><div class='control-group'><label for='template' class='control-label'>Reply:</label><div class='controls'><textarea name='reply_description2' class='validate[required]'></textarea></div></div><input type='hidden' name='articleid' value='<?php echo $this->uri->segment(4);?>'><input type='hidden' name='replyid' value='<?php echo $replies[$j]['id']?>'><div class='control-group'><div class='controls'><button id='btn_submit3' onclick='submitData2(<?php echo $j;?>);' class='btn btn-primary' type='submit'>Save</button>&nbsp;<a href='#' onclick='hide2(<?php echo $j;?>);return false;' class='btn'>Cancel</a></div></div></fieldset></form>
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
											<?php } }?>
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
	function display2(no)
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
	$('#frm_bookmark').ajaxForm({
			beforeSubmit : function(){
				$("#save_bookmark").button('loading');
				if($("#frm_bookmark").validationEngine('validate'))
				{
					$("#save_bookmark").button('loading');
					return true;
				}
				else
				{
					$("#save_bookmark").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#save_bookmark").button("reset");
				if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else if(responseText==100)
				{
					$("#successMessage").html("Bookmark has been added successfully");
					$("#successMessage").attr('style','display:block;');
					window.location.reload();				
				}
			}
		});
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
				//$("#new_comment").html(responseText);
				window.location=base_url+"forum_articles/listing/view/<?php echo $id;?>";
			}
		}
	});
});
</script>
<script>
	function submitData(no){
		$('#frm_Reply_'+no).ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit_"+no).button('loading');
				if($("#frm_Reply_"+no).validationEngine('validate'))
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
					window.location=base_url+"forum_articles/listing/view/<?php echo $id;?>";				
				}
			}
		});
	}
</script>
<script>
	function submitData2(no){
		$('#frm_Reply2_'+no).ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit3").button('loading');
				if($('#frm_Reply2_'+no).validationEngine('validate'))
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
					window.location=base_url+"forum_articles/listing/view/<?php echo $id;?>";				
				}

				}
			});
		}
</script>
<script type="text/javascript">
$('a#bookmark').click(function(e){
e.preventDefault();
	$.ajax({
		url:base_url+'forum_articles/listing/check/<?php echo $article[0]['id'];?>',
		type:'POST',
		data:{submit:true},
	success: function (result) {
		if(result!='not')
		{
			$.ajax({
				url:base_url+'forum_articles/listing/remove/'+result,
				type:'POST',
				data:{submit:true},
			success: function (result) {
			$("#bkmark").attr('src','<?php echo base_url();?>img/blank_star.png');		
			$("#bkmark").attr('title','Bookmark this article');	
			$("#bookmark").attr('data-toggle','modal');
			$("#bookmark").attr('data-target','#basicModal');
			}})
		}
		}
	})
});
</script>

		