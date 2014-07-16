<div id="main-container">
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin"><b>Welcome to Social traffic center</b></h3>
		</div><!-- /page-title -->
	</div>	
	
	<div class="padding-md">
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading" style="border:1px solid #D6E9F3;">
						<h4><b><i class="fa fa-file-text fa-lg"></i> Forum</b>
						<span class="badge badge-info"><?php echo count($topics);?> topics</span>
						<?php if($this->session->userdata('ForumUserID')){?>
						<span class="pull-right">
							<a class="btn btn-sm btn-success" href="<?php echo base_url();?>forum/add">
							<i class="fa fa-anchor"></i> Add topic</a>
						</span>
						<?php } ?>
						</h4>
					</div>
					<?php if($this->session->flashdata('topicmsg')){ ?>
					<div class="alert alert-success">
					<?php echo $this->session->flashdata('topicmsg');?>	
					</div>		
					<?php } ?>
					<table class="table table-hover table-striped">
						<?php 
							if($topics){  
								  if($this->session->userdata('ForumUserID'))
								  {
									$count = count($topics);
								  }
								  else 
								  { 
									$count = count($topics);
								  }
						   for($i=0;$i<5;$i++) { ?>	
						<tr style="border:1px solid LightGray;">
							<?php $title = url_title($topics[$i]['name'],'dash',TRUE);?>
							<td>
								<span class="badge" style="min-width:50px;height:50px;border:1px solid LightGray;background-color:#EFF5FB;">
									<h4><b><?php echo $topics[$i]['no_of_posts'];?></b></h4>
								</span>
								<h5><b>replies</b></h5>
							</td>
							<td>
								<!--<img src="<?php echo base_url();?>img/bulb.jpg" height="21" width="21">-->
								<a href="<?php echo base_url();?>forum/<?php echo $title."/".$topics[$i]['id'];?>">
								<b><font size="4" color="#0869BD"><u>
								<?php echo $topics[$i]['name'];?></u></font></b></a><br/>
								<p class="m-top-sm" style="font-family:Georgia,serif;text-align:justify;font-size:12px;">
									<?php 
										$str = strip_tags($topics[$i]['description']);
										echo "&nbsp;&nbsp;".substr($str,0,200)."...";
									?>
								<a href="<?php echo base_url();?>forum/<?php echo $title."/".$topics[$i]['id'];?>"><i class="fa fa-star"></i>[Read more]</a>
								</p>
								<span style="float:right;">
									<strong>
										created by&nbsp;&nbsp;<span class="badge"><b><i class="icon-user"></i> 
										<?php echo $topics[$i]['author'];?></b></span>  |
										on&nbsp;&nbsp;<span class="badge"><b><i class="icon-time"></i> 
										<?php echo date('dS F,Y',strtotime($topics[$i]['created_date']));?></b></span>
									</strong>
								</span>
							</td>
						</tr>
						<?php } }?>
						
						<tr style="border:1px solid #D6E9F3;">
							<?php if(!$this->session->userdata('ForumUserID')){?>
							<td><br/><span class="badge badge-danger">Access</span></td>
							<td>
								<h4 style="font-family:verdana;"><strong>&nbsp;To access the full forum please 
								<a class="btn btn-sm btn-success" href="<?php echo base_url();?>user/login"><i class="fa fa-star"></i> Log in</a> or  
								<a class="btn btn-sm btn-success" href="<?php echo base_url();?>user/login"><i class="fa fa-star"></i> Sign up</a></strong></h4> 
							</td>
							<?php } ?>	
							
						</tr>	
						
					</table>
				</div><!-- /panel -->
			</div>
			<div class="col-lg-3">
				<div class="panel panel-default" >
					<div class="panel-heading" style="border:1px solid #D6E9F3;">
						<h4><b><i class="fa fa-trophy fa-lg"></i> Leaderboard</b></h4>
					</div>
					<!--
					<div class="panel-body">
						<span>Total User</span><span class="badge m-left-xs">365</span>
						<span>Approved</span><span class="badge badge-success m-left-xs">321</span>
						<span>Pending</span><span class="badge badge-warning m-left-xs">37</span>
						<span>Banned</span><span class="badge badge-danger m-left-xs">7</span>
					</div>-->
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
									<tr style="border:1px solid #D6E9F3;">
										<th>Rank</th>
										<th>User</th>
										<th>Hits</th>
										<!-- <th>Earning.</th> -->
									</tr>
								</thead>
								<tbody>
									<?php $sr=1; foreach($users as $user) : ?>
										<tr style="border:1px solid #D6E9F3;">
											<td><?php echo $sr; ?></td>
											<td><?php echo $user['userName']; ?></td>
											<td><?php echo $user['totalHits']; ?></td>
										</tr>
										<?php $sr++; ?>
									<?php endforeach; ?>
								</tbody>
					</table>
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;">
				<h4><b><i class="fa fa-file-text fa-lg"></i> Articles</b> <span class="badge badge-danger"><?php echo count($articles);?> articles</span>
				<input type="text" class="form-control input-sm pull-right" id="search2" placeholder="search here..." style="width:200px;"></span>
				</h4>
			</div>
		</div><br/>
		<div id="articleTable">
			<?php 
			if($articles){
				for($i=0;$i<5;$i++){?>
				<div class="panel panel-default" style="border:2px solid #D6E9F3">
					<div class="panel-body">
						<div class="search-header">
							<?php $art = url_title($articles[$i]['topic'],'underscore',TRUE);?>
							<a href="<?php echo base_url();?>article/<?php echo $art;?>/<?php echo $articles[$i]['id'];?>" class="h3 inline-block" style="color:#0869BD;">
							<?php echo $articles[$i]['topic'];?>
							</a>
							<div class="text-muted">
								<strong>
									<span class="pull-left">
										<i class="icon-user"></i> Created By: 
										<?php echo $articles[$i]['userName'];?> 
										&nbsp;&nbsp;&nbsp;
										<i class="icon-time"></i> Created On: 
										<?php echo date('dS F,Y',strtotime($articles[$i]['created_date']));?>
									</span>	
								</strong>
							</div>
						</div><hr>
						<img src="<?php echo base_url().'uploads/forum_article_images/'.$articles[$i]['image'];?>" width="100px" height="100px" style="float:left;margin-right:12px;">
						<p class="m-top-sm" style="font-family:Georgia,serif;text-align:justify;font-size:15px;">
							<strong>
							<?php 
								$str = substr(strip_tags($articles[$i]['description']),0,500);
								echo "&nbsp;&nbsp;".substr($str,0,strrpos($str,'.'))."...";
							?>
							</strong>
						</p>
						
						<div class="text-right">
							<a class="btn btn-sm btn-success" href="<?php echo base_url();?>article/<?php echo $art;?>/<?php echo $articles[$i]['id'];?>"><i class="fa fa-star"></i>Continue reading</a>
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	<!--<div class="panel-footer clearfix">
		<ul class="pagination pagination-xs m-top-none pull-right">
			<li class="disabled"><a href="#">Previous</a></li>
			<li class="active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">Next</a></li>
		</ul>
	</div>-->
	
	</div><!-- /.padding-md -->
</div>
<script>
	var contents = $("#articleTable").html();
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