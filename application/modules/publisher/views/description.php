	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "d78c9ed2-be1a-4a83-857c-fa492054996a", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/validation/validationEngine.jquery.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine-en.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
	<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>js/common.js" type="text/javascript" charset="utf-8"></script>
		<div id="main-container">
			<div class="padding-md">
				<div class="row">
					<div class="col-md-11">	
						<h3 class="headline m-top-md">
							<?php echo $community[0]['community_title'];?>
							<span class="line"></span>
						</h3>
						<div class="row">	
							<div class="col-md-8">
								<div class="panel blog-container">
									<div class="panel-body">
										<h4><?php echo $community[0]['community_title'];?></h4>
										<small class="text-muted">By <a href="#"><strong> <?php echo $community[0]['userName'];?></strong></a> |  Post on <?php echo $community[0]['created_date'];?>  | <?php echo $community[0]['no_of_posts'];?> comments</small>
										<div class="seperator"></div>
										<div class="seperator"></div>
										
										<div class="image-wrapper">
											<img src="<?php echo base_url();?>uploads/community_images/<?php echo $community[0]['image'];?>" alt="Photo of community">
										</div><!-- /image-wrapper -->
																		
										<p class="m-top-sm m-bottom-sm" style="text-align:justify;">
											<?php echo $community[0]['community_description'];?>
										</p>
									</div>
								</div><!-- /panel -->
								<!--<div class="panel">
									<div class="panel-body">
										<div class="share-blog clearfix">
											<span class="pull-left" style="line-height: 25px;">Share this story</span>
											<div class="pull-right">
												<span class='st_facebook_large' displayText='Facebook' title="share"></span>
												<span class='st_twitter_large' displayText='Tweet' title="share"></span>
												<span class='st_linkedin_large' displayText='LinkedIn' title="share"></span>
												<span class='st_pinterest_large' displayText='Pinterest' title="share"></span>
											</div>
										</div>
									</div>
								</div><!-- /panel -->
								
								<?php if($comments){?>
								<h4 class="headline">
									Comments 
									<span class="line"></span>
								</h4>
								
								<ul class="media-list comment-list">
									<?php for($i=0;$i<count($comments);$i++) {?>
									<li class="media">
										<span class="pull-left">
											<img class="media-object img-circle" src="<?php echo base_url();?>img/user.jpg" alt="User Avatar" style="width: 40px; height: 40px;">
										</span>
										<div class="media-body">
											<div class="media-heading">
												<?php echo $comments[$i]["userName"];?>
												<small class="text-muted">
													<?php echo $comments[$i]["created_date"];?> / <a onclick="display('<?php echo $i;?>');return false;">Reply</a>
												</small>
											</div>
											<p><?php echo $comments[$i]["comment_description"];?></p>
											<div id="reply_<?php echo $i;?>" style="display:none;">
												<h4 class="headline">
													Add Reply
													<span class="line"></span>
												</h4>
												<form action="" method="post" id="frm_Reply_<?php echo $i?>" 
												class="form-horizontal">
													<textarea class="form-control validate[required]" rows="10" name="reply"></textarea>
													<input type="hidden" name="commentid" value="<?php echo $comments[$i]["id"];?>">
													<div class="seperator"></div>
													<div class="text-right m-bottom-md">
														<button type="submit" class="btn btn-success">Post Reply</button>
														<a class="btn" onclick="close_reply('<?php echo $i;?>');return false;">Cancel</a>
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
											<div class="media">
												<?php for($j=0;$j<count($replies);$j++) {
														if($replies[$j]['parent_id']==$comments[$i]['id']){ ?>
												<span class="pull-left" href="#">
													<img class="media-object img-circle" src="<?php echo base_url();?>img/user.jpg" alt="User Avatar" style="width: 40px; height: 40px;">
												</span>
												<div class="media-body">
													<div class="media-heading">
														<?php echo $replies[$j]['userName'];?>
														<small class="text-muted">
															<?php echo $replies[$j]['created_date'];?>
														</small>
													</div>
													<?php echo $replies[$j]['comment_description'];?>
												</div> <hr>
												<?php } }?>
											</div> 
											<?php }?>
										</div>
									</li>
								<?php } ?>	
								</ul><!-- /media-list -->					
								<?php } ?>
								<h4 class="headline">
									Add Comment
									<span class="line"></span>
								</h4>
								<form action="" method="post" id="post_comment" class="form-horizontal">
									<textarea class="form-control validate[required]" rows="10" name="comment"></textarea>
									<div class="seperator"></div>
									<div class="text-right m-bottom-md">
										<button type="submit" class="btn btn-success">Post Comment</button>
									</div>
								</form>
							</div><!-- /.col -->
							<div class="col-md-4">
								<h4 class="headline">
									Popular Communities
									<span class="line"></span>
								</h4>
								<?php 
								if(count($popular_communities)<3){
									$cnt = count($popular_communities);
								}
								else {
									$cnt = 3;
								}	
								for($k=0;$k<$cnt;$k++){?>
								<div class="media popular-post">
									<img src="<?php echo base_url();?>uploads/community_images/<?php echo $popular_communities[$k]["image"];?>" alt="Popular Post" class="pull-left">
									<div class="media-body">
										<a href="<?php echo base_url();?>publisher/frontend/description/<?php echo $popular_communities[$k]["id"];?>">
										<?php echo $popular_communities[$k]["community_title"];?> 
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
									<?php for($l=0;$l<count($popular_communities);$l++){?>
									<li>
										<a href="#">
											<img src="<?php echo base_url();?>uploads/community_images/<?php echo $popular_communities[$l]["image"];?>" alt="Photo Stream">
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
	</div><!-- /wrapper -->

<script>
    jQuery(document).ready(function($){
        $('#post_comment').ajaxForm({
	beforeSubmit : function(){
            if($("#post_comment").validationEngine('validate'))
            {
				return true;
            }
            else
            {
				return false;
            }
	},
	success :  function(responseText, statusText, xhr, $form){
			if(responseText==100)
            {
				location.reload();
			}
            else 
            {
				$("#errorMessage").html(responseText);
				$("#errorMessage").show();
			}
		}
    });
    $("#post_comment").validationEngine();
});
</script>
<script>
function display(id)
{
	$("#reply_"+id).show();
}
function close_reply(val)
{
	$("#reply_"+val).attr("style","display:none;");
}
</script>	

