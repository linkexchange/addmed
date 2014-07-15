<table class="table table-striped" id="responsiveTable">
	<tbody>
		<?php 
		if($articles){
			for($i=0;$i<count($articles);$i++){?>
			<tr> 
				<td>
				<a href="<?php echo base_url();?>forum_articles/listing/view/<?php echo $articles[$i]['id'];?>">
				<h3><?php echo $articles[$i]['topic'];?></h3>
				</a>
				<img src="<?php echo base_url().'uploads/forum_article_images/'.$articles[$i]['image'];?>" width="70px" height="70px" style="float:left;margin-right:3px;">	
				<p style="text-align:justify">
				<?php 
					$str = substr(strip_tags($articles[$i]['description']),0,500);
					echo "&nbsp;&nbsp;".substr($str,0,strrpos($str,'.'))."...";
				?>
				<a href="<?php echo base_url();?>forum_articles/listing/view/<?php echo $articles[$i]['id'];?>">[Read more]</a>
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
		<?php } } else {?>
			<tr> <td> <font color="red" size="3"> No such articles exist </font> </td> </tr>
		<?php } ?>		
	</tbody>
</table>