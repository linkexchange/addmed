<div id="main-container" style="background:#E0F2F7;">
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin"><b>Welcome to Social traffic center</b></h3>
		</div><!-- /page-title -->
	</div>	
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
							 <?php echo $articles[$i]['created_date'];?></span>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
			<?php 
			if($this->session->userdata("ForumUserID")){	
				if($count>10) : ?>
				<div class="widget-header navigation" style="text-align:left;">
					<ul class="pagination pagination-split m-bottom-md">
					<?php 
						$mod=10; $inc=1;
						if($count>$mod) :
							echo " <li><a>Pages:</a></li>";
							for($i=0;$i<=$count;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
								?>
									<li class="<?php if($inc==$this->uri->segment(2))  echo "active"; else if(!($this->uri->segment(2)) && $inc==1)  echo "active"; ?>">
									<a href="<?php echo base_url()."articles/".$inc; ?>">
									<?php echo $inc;?></a></li>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
					</ul>	
				</div><!-- widget-header pagination -->
			<?php endif; } ?>	
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
</div>        <!-- /bottom of the page -->
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

 
	