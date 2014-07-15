<div id="main-container" style="background:#E0F2F7;">
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin"><b>Welcome to Social traffic center</b></h3>
		</div><!-- /page-title -->
	</div>	
	
	<div class="padding-md">
		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default" >
					<div class="panel-heading">
						<h4><i class="fa fa-list-alt fa-lg"></i> Forum Topics</h4>
					</div>
					
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th>Sr.No.</th>
								<th>Topic</th>
								<th>Author</th>
								<th>Replies</th>
								<th>Created Date</th>
								<th>View</th>
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
						   for($i=0;$i<5;$i++) { ?>
							<tr>	
								<td><?php $c=$i+1; echo $c;?></td>
								<td>
									<?php echo $topics[$i]['name'];?>
								</td>
								<td>
									<?php echo $topics[$i]['author'];?>
								</td>
								<td>
									<?php echo $topics[$i]['no_of_posts'];?>
								</td>
								<td><?php echo $topics[$i]['created_date'];?></td>
								<td>
									<?php $title = url_title($topics[$i]['name'],'dash',TRUE);?>
									<a href="<?php echo base_url();?>forum/<?php echo $title."/".$topics[$i]['id'];?>">
									View</a>
								</td>	
							</tr>
							<?php } }?>
						</tbody>
					</table>
					<?php if(!$this->session->userdata('ForumUserID')){?>
					<h4>&nbsp;To access the full forum please 
					<a href="#">Log in </a>or 
					<a href="#">Sign up</a></h4> 
					<?php } ?>
				</div><!-- /panel -->
			</div><!-- /.col -->
			<div class="col-lg-3">
				<div class="panel panel-default" >
					<div class="panel-heading">
						<h4><i class="fa fa-trophy fa-lg"></i> Leaderboard</h4>
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
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	<div class="panel panel-default table-responsive">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div id="dataTable_length" class="dataTables_length">
				<h4>&nbsp;<i class="fa fa-list-alt fa-lg"></i> Articles</h4>
			</div>
			<div class="dataTables_filter" id="dataTable_filter">
			<label> 
				<div class="input-group pull-right" style="width:200px;">
					<input type="text" class="form-control input-sm" id="search2" placeholder="search here..."><span class="input-group-btn"><button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button></span>
				</div>
			</label>
			</div>
		</div>
		<div id="articleTable">
			<table class="table table-striped" id="responsiveTable">
				<tbody>
					<?php for($i=0;$i<count($articles);$i++){?>
					<tr> 
						<?php $art = url_title($articles[$i]['topic'],'underscore',TRUE);?>
						<td>
						<a href="<?php echo base_url();?>article/<?php echo $art."/".$articles[$i]['id'];?>">
						<h3><?php echo $articles[$i]['topic'];?></h3>
						</a>
						<img src="<?php echo base_url().'uploads/forum_article_images/'.$articles[$i]['image'];?>" width="70px" height="70px" style="float:left;margin-right:3px;">	
						<p style="text-align:justify">
						<?php 
							$str = substr(strip_tags($articles[$i]['description']),0,500);
							echo "&nbsp;&nbsp;".substr($str,0,strrpos($str,'.'))."...";
						?>
						<a href="<?php echo base_url();?>article/<?php echo $art."/".$articles[$i]['id'];?>">[Read more]</a>
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
					
					<?php } ?>
				</tbody>
			</table>
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
	</div><!-- /panel -->
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