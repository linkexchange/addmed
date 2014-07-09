<style>
.forum_left{
	width:66%;
	float:left;
	display:block;
	
}
.leaderboard-right{
	width:30%;
	float:left;
	display:block;
	margin-left:3%;
}
.forum_left .container{
	width:100% !important;
}
</style>
<div class="container">
<div class="forum_left">
<h1>Forum </h1>
						
<div class="main">
			<div class="main-inner">
				
					
						
						<?php if($this->session->userdata("ForumUserID")){?>
						<div class="" style="margin:0px 0px 15px 0px; text-align:right;"> 
						<button onclick="javascript:goto('forum/add')" class="btn btn-primary btn-large  icon-anchor"> Add Topic</button>
						</div>
						<?php } ?>
						<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>View Topics</h3>
						</div>
						<?php if($this->session->flashdata('topicmsg')) { ?>
						<div id="successMessage" class="alert alert-success">
						<?php echo $this->session->flashdata('topicmsg');?>	
						</div>
                    	<?php } ?>
						<div class="widget-content">
                        	<div class="big-stats-container">
								<!--span style="float:right;width:26%">Search: 
									<input type="text" id="search2" placeholder="enter topic">
								</span>-->
                            	<div class="widget-content inner">
                             		<div class="widget-content inner">
									<div id="topicTable">	
                                        	<table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><h4>Topic</h4></th>
														<th><h4>Author</h4></th>
														<th><h4>Replies</h4></th>
														<th><h4>View</h4></th>
													</tr>
												</thead>
												<tbody>	
													<?php 
													if($topics){  
														  if($this->session->userdata('ForumUserID'))
														  {
															$count = count($topics);
														  }
														  else 
														  { 
														    $count = 5;
														  }
												   for($i=0;$i<$count;$i++) { ?>
													<tr>	
														<td>
															<?php echo $topics[$i]['name'];?>
														</td>
														<td>
															<?php echo $topics[$i]['author'];?>
														</td>
														<td>
															<?php echo $topics[$i]['no_of_posts'];?>
														</td>
														<td>
															<a href="<?php echo base_url();?>forum/view/<?php echo $topics[$i]['id']?>">
															View</a>
														</td>	
													</tr>
													<?php } }?>
												</tbody>
                                    		</table><!-- table -->
											<?php if($tcount>10) : ?>
                                            <div class="widget-header navigation" style="text-align:right;">
                                                <?php 
                                                    $mod=10; $inc=1;
                                                    if($tcount>$mod) :
                                                        echo "Pages:";
                                                        for($i=0;$i<=$tcount;$i++) :
                                                            if(($i%$mod)==0) :
                                                                //echo $inc; ?>
                                                           
                                                            	 <a class="btn btn-small btn-success page-<?php echo $inc;?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."forum_articles/forum/index/".$inc; ?>" ><?php echo $inc; ?></a>
																
                                                           
                                                                <?php
                                                                $inc++;
                                                            endif;
                                                        endfor;
                                                    endif;
                                                ?> &nbsp;
                                            </div><!-- widget-header pagination -->
                                            <?php endif; ?>
											<?php if(!$this->session->userdata('ForumUserID')){?>
											<h3>To access the full forum please 
											<a href="<?php echo base_url();?>user/login">Log in </a>or 
											<a href="<?php echo base_url();?>user/login">Sign up</a></h3> 
											<?php } ?>
										<!-- setArticles  -->
                                    <!-- widget-content  -->
										
									</div>				
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div>
                        
                    </div><!-- .row -->
               
           	<!-- .main-inner -->
        </div><!-- .main -->
	</div>
</div>
<div class="leaderboard-right">
	<div class="main">
		<div class="main-inner">
			<div class="widget">
				<h2>Leader Board</h2>
				<div class="widget-header">
					<i class="icon-list-alt"></i>
					<h3>View Leades</h3>
				</div>
				<div class="widget-content">
					
								<div class="leadsTable">
									<?php //print_r($users); ?>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Rank</th>
												<th>User</th>
												<th>Hits</th>
												<!-- <th>Earning.</th> -->
											</tr>
										</thead>
										<tbody>
											<?php $sr=1; foreach($users as $user) : ?>
												<tr>
													<td><?php echo $sr; ?></td>
													<td><?php echo $user['userName']; ?></td>
													<td><?php echo $user['totalHits']; ?></td>
												</tr>
												<?php $sr++; ?>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div><!-- articleTable -->
						
				</div><!-- widget-content -->
			</div>
		</div>
	</div>
</div>
<div class="row">
<div class="span12">
<div class="widget">
<div class="widget-header"> 
		<i class="icon-list-alt"></i>
		<h3>View Articles</h3>
</div>
<?php //echo "<pre>"; print_r($articles); exit;?>
<div class="widget-content">
	<div class="big-stats-container">
		<span style="float:right;width:26%">Search: 
			<input type="text" id="search2" placeholder="enter topic">
		</span>
		<div class="widget-content inner">
			<div class="widget-content inner">
			<div id="articleTable">
				<table>
				<?php for($i=0;$i<count($articles);$i++){?>
				<tr> 
				<td>
				<a href="<?php echo base_url();?>articles/view/<?php echo $articles[$i]['id'];?>">
				<h3><?php echo $articles[$i]['topic'];?></h3>
				</a>
				<img src="<?php echo base_url().'uploads/forum_article_images/'.$articles[$i]['image'];?>" width="70px" height="70px" style="float:left;margin-right:3px;">	
				<p style="text-align:justify">
				<?php 
					$str = substr(strip_tags($articles[$i]['description']),0,500);
					echo "&nbsp;&nbsp;".substr($str,0,strrpos($str,'.'))."...";
				?>
				<a href="<?php echo base_url();?>articles/view/<?php echo $articles[$i]['id'];?>">[Read more]</a>
				</p>	
				</td>
				</tr>
				<tr>
					<td>
					<span style="float:left;"><i class="icon-user"></i> Created By: 
					 <?php echo $articles[$i]['userName'];?></span> 
					<span style="float:right;"><i class="icon-time"></i>Created Date: 
					 <?php echo $articles[$i]['created_date'];?></span></td>
				</tr>
				<tr><td><hr></td></tr>
				<?php } ?>	
				</table>
				<!-- setArticles  -->
			<!-- widget-content  -->
			<?php if($count>10) : ?>
					<div class="widget-header navigation" style="text-align:right;">
						<?php 
							$mod2=10; $inc2=1;
							if($count>$mod2) :
								echo "Pages:";
								for($j=0;$j<=$count;$i++) :
									if(($j%$mod)==0) :
										//echo $inc;
									?>
								   
										 <a class="btn btn-small btn-success page-<?php echo $inc2; ?> <?php if($inc2==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc2==1)  echo "page-active";  ?>" href="<?php echo base_url()."forum_articles/forum/index/".$inc2; ?>" ><?php echo $inc2; ?></a>
									
								   
										<?php
										$inc2++;
									endif;
								endfor;
							endif;
						?> &nbsp;
					</div><!-- widget-header pagination -->
					<?php endif; ?>	
			</div>	
			</div>				
		</div><!-- widget-content inner-->
	</div><!-- big-stats-container -->
</div><!-- widget-content -->
</div>
</div><!-- .span12-->
</div>
</div>
<script>
$(document).ready(function(){
	$('#frm_login').ajaxForm({
		beforeSubmit : function(){
			$("#btn_submit").button('loading');
			$("#successMessage").hide();
			$("#errorMessage").hide();
			
			if($("#frm_login").validationEngine('validate'))
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
			if(responseText==201)
			{
				$("#errorMessage").html("Invalid details...!");
				$("#errorMessage").show();
			}
			else if(responseText>0)
			{
				$("#successMessage").html("You are logged in successfully...!");
				$("#successMessage").show();
				window.location.reload();
			}
		}
	});
});
</script>
<script>
$(document).ready(function(){
	$('#frm_signup').ajaxForm({
		beforeSubmit : function(){
			$("#signup").button('loading');
			if($("#frm_signup").validationEngine('validate'))
			{
				$("#signup").button('loading');
				return true;
			}
			else
			{
				$("#signup").button('reset');
				return false;
			}
		},
		success :  function(responseText, statusText, xhr, $form){
			$("#signup").button("reset");
			if(responseText==0)
			{
				$("#errorMessage2").html("Database error");
				$("#errorMessage2").show();
			}
			else if(responseText==100)
			{
				$("#successMessage2").html("You are registered in successfully...!");
				$("#successMessage2").show();
				window.location.reload();
			}
		}
	});
});
</script>
<script>
	var contents = $('#articleTable').html();
	jQuery('#search2').on('input', function() {
    var value = $("#search2").val();
	
	if(value=='')
	{
		//alert(contents);
		$('#articleTable').html(contents);
	}
	else
	{  
		$('#articleTable').empty();
		$('#articleTable').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" align="center"><br/><h3>Loading</h3>');
		$.ajax({
            url : base_url+'forum_articles/listing/getArticles/'+value,
            type: 'POST',
            data: {submit:true},
			 // An object with the key 'submit' and value 'true;
            success: function (result) {
            //alert(result);
			//document.location = base_url+'article/dashboard/getArticles/'+value;
			$('#articleTable').empty();
			$('#articleTable').html(result);
            }
        });
	}});
</script>	