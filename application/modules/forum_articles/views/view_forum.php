<div id="main-container">
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin"><b>Welcome to Social traffic center</b></h3>
		</div><!-- /page-title -->
	</div>	
	
	<div class="padding-md">
		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-heading" style="border:1px solid #D6E9F3;">
						<h4><b><i class="fa fa-file-text fa-lg"></i> Forum</b>
						<span class="badge badge-info pull-right"><?php echo count($topics);?> topics</span></h4>
					</div>
					
					<table class="table table-bordered table-condensed table-hover table-striped">
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
						   for($i=0;$i<5;$i++) { ?>
							<tr style="border:1px solid #D6E9F3;">	
								<?php $title = url_title($topics[$i]['name'],'dash',TRUE);?>
								<td><?php //$c=$i+1; echo $c;?>
									<span class="badge" style="min-width:60px;border:1px solid LightGray;float:left;background-color:green;color:white;">
									<h5><?php echo $topics[$i]['no_of_posts'];?></h5><h6>replies</h6></span>&nbsp;
									<span style="float:center;"><br/>&nbsp;
									<a href="<?php echo base_url();?>forum/<?php echo $title."/".$topics[$i]['id'];?>">
									<b><font size="4" color="#0869BD"><?php echo $topics[$i]['name'];?></font></b></a>
									</span><br/><br/>
									<span style="float:right;">
										&nbsp;&nbsp;created by&nbsp;&nbsp;<span class="badge"><b><u><?php echo $topics[$i]['author'];?></u></b> </span> |
										created date&nbsp;&nbsp;<span class="badge"><b><u><?php echo date('dS F,Y',strtotime($topics[$i]['created_date']));?></u></b></span>
									</span>
								</td>
							</tr>
							<?php } }?>
							<?php if(!$this->session->userdata('ForumUserID')){?>
							<tr style="border:1px solid #D6E9F3;">
								<td>
									<h4 style="font-family:verdana;"><strong>&nbsp;To access the full forum please 
									<a class="btn btn-sm btn-success" href="<?php echo base_url();?>user/login"><i class="fa fa-star"></i> Log in</a> or  
									<a class="btn btn-sm btn-success" href="<?php echo base_url();?>user/login"><i class="fa fa-star"></i> Sign up</a></strong></h4> 
								</td>
							</tr>
							<?php } ?>		
						</tbody>
					</table>
					
					
					
				</div><!-- /panel -->
			</div><!-- /.col -->
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