<table>
	<?php for($i=0;$i<count($articles);$i++){?>
	<tr> 
		<td>
		<a target="_blank" href="<?php echo base_url();?>forum_articles/listing/view/<?php echo $articles[$i]['id'];?>">
		<h3><?php echo $articles[$i]['topic'];?></h3>
		</a>
		<img src="<?php echo base_url().'uploads/forum_article_images/'.$articles[$i]['image'];?>" width="70px" height="70px" style="float:left;margin-right:3px;">	
		<p style="text-align:justify">
		<?php 
			$str = substr(strip_tags($articles[$i]['description']),0,500);
			echo "&nbsp;&nbsp;".substr($str,0,strrpos($str,'.'))."...";
		?>
		<a target="_blank" href="<?php echo base_url();?>forum_articles/listing/view/<?php echo $articles[$i]['id'];?>">[Read more]</a>
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
		$mod=10; $inc=1;
		if($count>$mod) :
			echo "Pages:";
			for($i=0;$i<=$count;$i++) :
				if(($i%$mod)==0) :
					//echo $inc;?>
					<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(6))  echo "page-active"; else if(!($this->uri->segment(6)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."forum_articles/listing/index/".$inc; ?>" ><?php echo $inc; ?></a>
					<?php
					$inc++;
				endif;
			endfor;
		endif;
	?> &nbsp;
</div><!-- widget-header pagination -->
<?php endif; ?>	