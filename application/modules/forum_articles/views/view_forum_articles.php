<div id="main-container">
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin"><b>Welcome to Social traffic center</b></h3>
		</div><!-- /page-title -->
	</div>	
	
	<div class="padding-md">
		
	
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
				for($i=0;$i<count($articles);$i++){?>
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