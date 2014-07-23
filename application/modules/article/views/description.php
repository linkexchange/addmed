<script>
	$(document).ready(function(){
		$("#comment_desc").hide();
		$("#reply_desc").hide();
	});
</script>
<!DOCTYPE html>
<?php $actual_link = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>
<head>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "d78c9ed2-be1a-4a83-857c-fa492054996a", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine-en.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<title>Article Description</title>
</head>
<?php $id = $this->uri->segment(4);?>
<div id="main-container">
	<div class="padding-md">
		<div class="row">
			<div class="col-md-11">	
				<h3 class="headline m-top-md">
					<?php echo $article[0]['topic'];?>
					<span class="line"></span>
				</h3>
				<div class="row">	
					<div class="col-md-8">
						<div class="panel blog-container">
							<div class="panel-body">
								<h4><?php echo $article[0]['topic'];?></h4>
								<small class="text-muted">By <a href="#"><strong> <?php echo $article[0]['userName'];?></strong></a> |  Post on <?php echo $article[0]['created_date'];?>  | <?php echo $article[0]['no_of_replies'];?> comments</small>
								<div class="seperator"></div>
								<div class="seperator"></div>
								<div class="image-wrapper">
									<img src="<?php echo base_url();?>uploads/forum_article_images/<?php echo $article[0]['image'];?>" alt="Photo of article">
								</div><!-- /image-wrapper -->
																
								<p class="m-top-sm m-bottom-sm" style="text-align:justify;">
									<?php echo $article[0]['description'];?>
								</p>
							</div>
						</div><!-- /panel -->
						<div class="panel">
							<div class="panel-body">
								<div class="share-blog clearfix">
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
											<div id="successMessage2" class="alert alert-success" style="display:none"></div>
											<?php if($this->session->userdata("ForumUserID")){?>
											<a href='#' id="bookmark">
												<img id='bkmark' style='width:5%;margin-bottom:26px;'>
											</a>
											<?php } ?>
											<span class='st_facebook_large' displayText='Facebook' title="share"></span>
											<span class='st_twitter_large' displayText='Tweet' title="share"></span>
											<span class='st_linkedin_large' displayText='LinkedIn' title="share"></span>
											<span class='st_pinterest_large' displayText='Pinterest' title="share"></span>
											<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" 
											aria-labelledby="basicModal" aria-hidden="true">
										  <div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												
												<h4 class="modal-title" id="myModalLabel"><img src='<?php echo base_url();?>img/Star.png' style='width:3%;'>Add new bookmark
												</h4>
											  </div>
											  <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
											  <div id="successMessage" class="alert alert-success" style="display:none"></div>
											  <div class="modal-body">
													<form class="form-horizontal" id="frm_bookmark" action="" method="POST">
													<fieldset>
														<div class="control-group">
															<label for="template" class="control-label">
																Name:
															</label>
															<div class="controls">	
																<input type="text" name="bookmark" class="form-control validate[required]">
															</div>
														</div>		
														<div class="control-group">
															<label for="template" class="control-label">	
																Url:
															</label>
															<div class="controls">	
																<input type="text" class="form-control" value="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" name="bookmarkUrl" readonly>
															</div>
														</div>
														<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(3);?>">	
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
								</div>
							</div>
						</div>
						<?php if($this->session->userdata('ForumUserID')) { ?>
						<a href="#" id="comment" class="btn btn-primary">Post a Comment</a>	
						<?php } else {?>
						<a href="<?php echo base_url();?>user/forum_login/index?link=<?php echo $actual_link;?>" class="btn btn-primary">Login to Post Comment</a>	
						<?php } ?>
						<div id="comment_desc">
							<h4 class="headline">
								Add Comment
								<span class="line"></span>
							</h4>
							<form action="" method="post" id="post_comment" class="form-horizontal">
								<textarea class="form-control validate[required]" rows="10" name="comment_description"></textarea>
								<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(3);?>">
								<div class="seperator"></div>
								<div class="text-right m-bottom-md">
									<button type="submit" id="btn_comment" class="btn btn-success">Post Comment</button>
									<a href="#" id="cancel" class="btn">Cancel</a>
								</div>
							</form>
						</div>
						<?php if($comments){?>
						<h4 class="headline">
							Comments 
							<span class="line"></span>
						</h4>
						
						<ul class="media-list comment-list">
							<?php for($i=0;$i<count($comments);$i++) {?>
							<div class="panel blog-container" style="border:1px solid lightgray;">
							<div class="panel-body">
							<li class="media">
								<span class="pull-left">
									<img class="media-object img-circle" src="<?php echo base_url();?>img/user.jpg" alt="User Avatar" style="width: 40px; height: 40px;">
								</span>
								<div class="media-body">
									<div class="media-heading">
										<?php echo $comments[$i]["name"];?>
										<small class="text-muted">
											<?php echo $comments[$i]["created_date"];?> 
										</small>
									</div>
									<p><?php echo $comments[$i]["description"];?></p>
									<?php if($this->session->userdata('ForumUserID')) { ?>
									<a href="#" onclick="display(<?php echo $i;?>);return false;" class="btn btn-primary">Post a Reply</a>	
									<?php } else {?>
									<a href="<?php echo base_url();?>user/forum_login/index?link=<?php echo $actual_link;?>" class="btn btn-primary">Login to Post Reply</a>	
									<?php } ?>
									<div id="reply_<?php echo $i;?>" style="display:none;">
										<h4 class="headline">
											Add Reply
											<span class="line"></span>
										</h4>
										<form action="" method="post" id="frm_Reply_<?php echo $i?>" 
										class="form-horizontal">
											<textarea class="form-control validate[required]" rows="10" name="reply_description"></textarea>
											<input type="hidden" name="commentid" value="<?php echo $comments[$i]["id"];?>">
											<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(3);?>">
											<input type="hidden" name="articlename" value="<?php echo $this->uri->segment(2);?>">
											<div class="seperator"></div>
											<div class="text-right m-bottom-md">
												<button type="submit" class="btn btn-success">Post Reply</button>
												<a class="btn" onclick="hide('<?php echo $i;?>');return false;">Cancel</a>
											</div>
										</form>
										<script>
											jQuery(document).ready(function($){
												$("#frm_Reply_<?php echo $i;?>").validationEngine();
											});
										</script>
									</div>
									<?php if($replies){ ?>
									<!-- Nested media object -->
									<h4 class="headline">Replies
									<span class="line"></span></h4>
									<div class="media">
										<?php for($j=0;$j<count($replies);$j++) {
												if($replies[$j]['parent_id']==$comments[$i]['id']){ ?>
										<span class="pull-left" href="#">
											<img class="media-object img-circle" src="<?php echo base_url();?>img/user.jpg" alt="User Avatar" style="width: 40px; height: 40px;">
										</span>
										<div class="media-body">
											<div class="media-heading">
												<?php echo $replies[$j]['name'];?>
												<small class="text-muted">
													<?php echo $replies[$j]['created_date'];?>
												</small>
											</div>
											<?php echo $replies[$j]['description'];?>
										</div> <hr>
										<?php } }?>
									</div> 
									<?php }?>
								</div>
							</li>
							</div>
							</div>
						<?php } ?>	
						</ul><!-- /media-list -->					
						<?php } ?>
							
					</div><!-- /.col -->
					<div class="col-md-4">
						<h4 class="headline">
							Popular Articles
							<span class="line"></span>
						</h4>
						<?php 
						if(count($popular_articles)<3){
							$cnt = count($popular_articles);
						}
						else {
							$cnt = 3;
						}	
						for($k=0;$k<$cnt;$k++){?>
						<div class="media popular-post">
							<img src="<?php echo base_url();?>uploads/forum_article_images/<?php echo $popular_articles[$k]["image"];?>" alt="Popular Post" class="pull-left">
							<div class="media-body">
								<?php $pop_art = url_title($popular_articles[$k]["topic"],'underscore',TRUE);?>
								<a href="<?php echo base_url();?>article/<?php echo $pop_art."/".$popular_articles[$k]["id"];?>">
								<?php echo $popular_articles[$k]["topic"];?> 
								</a>
							</div>
						</div>
						<?php } ?>
						
						<h4 class="headline">
							ABOUT THIS
							<span class="line"></span>
						</h4>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros nibh, viverra a dui a, gravida varius velit. Nunc vel tempor nisi. Aenean id pellentesque mi, non placerat mi. Integer luctus accumsan tellus. Vivamus quis elit sit amet nibh lacinia suscipit eu quis purus. Vivamus tristique est non ipsum dapibus lacinia sed nec metus.
						</p>
						<h4 class="headline">
							PHOTO STREAM
							<span class="line"></span>
						</h4>
						<ul class="photo-stream">
							<?php for($l=0;$l<count($popular_articles);$l++){?>
							<li>
								<a href="#">
									<img src="<?php echo base_url();?>uploads/forum_article_images/<?php echo $popular_articles[$l]["image"];?>" alt="Photo Stream">
								</a>
							</li>
							<?php } ?>
						</ul>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div><!-- /main-container -->
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
		$("#reply_"+no).show();
	}
	function display2(no)
	{
		$("#reply_"+no).show();
	}
	function hide(no)
	{
		$("#reply_"+no).hide();
	}
	function hide2(no)
	{
		$("#reply_"+no+"").hide();
	}
</script>
<script>
	$(document).ready(function(){
		$('#post_comment').ajaxForm({
			beforeSubmit : function(){
				$("#btn_comment").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#post_comment").validationEngine('validate'))
				{
					$("#btn_comment").button('loading');
					return true;
				}
				else
				{
					$("#btn_comment").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#save_bookmark").button("reset");
				if(responseText==100)
				{
					window.location.reload();
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
<script>
	$(document).ready(function(){
		$('#frm_bookmark').ajaxForm({
			beforeSubmit : function(){
				$("#save_bookmark").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
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
				if(responseText==100)
				{
					$("#successMessage").html("Bookmark added successfully.");
					$("#successMessage").show();
					window.location.reload();
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
			$("#successMessage2").html("Bookmark removed successfully");
			$("#successMessage2").show();
			}})
		}
		}
	})
});
</script>

		