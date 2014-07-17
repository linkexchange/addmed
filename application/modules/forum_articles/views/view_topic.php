<?php $actual_link = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");?>
<div id="main-container">
			<div class="padding-md">
				<div class="row">
					<div class="col-md-11">	
						<h3 class="headline m-top-md">
							<?php echo $topic[0]['name'];?>
							<span class="line"></span>
						</h3>
						<div class="row">	
							<div class="col-md-11">
								<div class="panel blog-container" style="border:1px solid lightgray;">
									<div class="panel-body">
										<h4><?php echo $topic[0]['name'];?></h4>
										<small class="text-muted">By <a href="#"><strong> <?php echo $topic[0]['author'];?></strong></a> | <?php echo $topic[0]['created_date'];?> | <?php echo $topic[0]['no_of_posts'];?> comments</small>
										<div class="seperator"></div>
										<div class="seperator"></div>
										<p class="m-top-sm m-bottom-sm" style="text-align:justify;">
											<?php echo $topic[0]['description'];?>
										</p>
									</div>
								</div><!-- /panel -->
								<?php if($this->session->userdata("ForumUserID")){?>
									<a href="#" id="post" class="btn btn-primary">Post a Comment</a>
									<?php } else {?>
									<a href="<?php echo base_url();?>user/forum_login/index?link=<?php echo $actual_link;?>" 
									class="btn btn-primary">Login to Post a Comment</a>
								<?php } ?>
								<div id="post_desc" style="display:none;">
									<form class="form-horizontal" id="frm_Post" action="" method="POST" enctype="multipart/form-data">
									<h4 class="headline">Add Comment
									<span class="line"></span></h4>
									<textarea class="form-control validate[required]" rows="10" name="post_description"></textarea>
									<input type="hidden" name="topicid" value="<?php echo $topic[0]["id"];?>">
									<div class="seperator"></div>
									<div class="text-right m-bottom-md">
										<button class="btn btn-success" id="post_button">Post Comment</button>
										<a href="#" id="cancel" class="btn">Cancel</a>
									</div>
									</form>
								</div>
								<?php if($post){
										if($this->session->userdata('userID')){
											$cnt = count($post);
										}
										else
										{ 
											if(count($post)<3)
											{	
												$cnt = count($post);
											}
											else
											{	
												$cnt = 3;
											}
										}	?>
								<br/><br/>		
								<ul class="media-list comment-list">
									<?php for($i=0;$i<$cnt;$i++){?>
									<div class="panel blog-container" style="border:1px solid lightgray;">
									<div class="panel-body">
									<li class="media">
										<a class="pull-left" href="#">
											<img class="media-object img-circle" src="<?php echo base_url();?>img/user.jpg" alt="User Avatar" style="width: 40px; height: 40px;">
										</a>
										<div class="media-body">
											<div class="media-heading">
												<a href="#"><?php echo $post[$i]['name'];?></a>
												<small class="text-muted">
													<?php echo $post[$i]['created_date'];?> <!--/ <a href="#">Reply</a>-->
												</small>
											</div>
											<p><?php echo $post[$i]['post_description'];?></p>
										</div>
									</li>
									</div>
									</div>	
									<?php } ?>
								</ul><!-- /media-list -->	
								<?php } ?>		
								
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.padding-md -->
		</div><!-- /main-container -->
<script>
$("#post").click(function(e){
	e.preventDefault();
	$("#post_desc").attr('style','display:block;');
});
$("#cancel").click(function(e){
	e.preventDefault();
	$("#post_desc").attr('style','display:none;');
});
</script>
<script>
	$(document).ready(function(){
		$('#frm_Post').ajaxForm({
			beforeSubmit : function(){
				$("#post_button").button('loading');
				if($("#frm_Post").validationEngine('validate'))
				{
					$("#post_button").button('loading');
					return true;
				}
				else
				{
					$("#post_button").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#post_button").button("reset");
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
		$("#frm_Post").validationEngine();
	});
</script>		