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
			<img src="<?php echo base_url().'uploads/forum_article_images/'.$articles[$i]['image'];?>" width="100px" style="float:left;margin-right:12px;">
			<p class="m-top-sm" style="text-align:justify;font-size:13px;">
				<strong>
				<?php 
					$str = substr(strip_tags($articles[$i]['description']),0,600);
					echo "&nbsp;&nbsp;".substr($str,0,strrpos($str,'.'))."...";
				?>
				</strong>
			</p>
			
			<div class="text-right">
				<a class="btn btn-sm btn-success" href="<?php echo base_url();?>article/<?php echo $art;?>/<?php echo $articles[$i]['id'];?>"><i class="fa fa-star"></i>Continue reading</a>
			</div>
		</div>
	</div>
<?php } } else {?>
	<div class="alert alert-danger"> No such articles exist </div> 
<?php } ?>		
	