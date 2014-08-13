<?php if($articles) { ?>
<table class="table table-bordered table-striped dataTable">
	<thead>
		<tr>
			<th><br/>Sr. </th>
			<th><br/>Article Topic</th>
			<th><br/>Article Image</th>
			<th><br/>View</th>
			<th><br/>Created Date</th>
			<th><br/>Last Updated On</th>
			<th class="td-actions"><br/>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		//echo $this->uri->segment(4);
			$sr=1;
			if($this->uri->segment(4)>1 ){
			$sr=(int)$this->config->item('record_limit')*$this->uri->segment(4)-((int)$this->config->item('record_limit')-1);
			}
		?>
		<?php  foreach($articles as $article) : ?>
		<tr>
			<td><?php echo $sr; $sr++; ?></td>
			<td><?php echo $article['topic']; ?></td>
			<td><?php if($article['image']) : ?>
				<img src="<?php echo base_url().'uploads/forum_article_images/'.$article['image']; ?>" width="100px" height="auto" />
				<?php endif; ?>
			</td>
			<td>
			<a target="_blank" href="<?php echo base_url();?>article/listing/view/<?php echo $article['id'];?>">View</a>
			</td>
			<td><?php echo $article['created_date']; ?></td>
			<td>
				<?php if($article['updated_date']!="0000-00-00") : ?>
					<?php echo $article['updated_date']; ?>
				<?php endif; ?>
			</td>
			<td class="td-actions">
				<a class="btn btn-small btn-success" href="<?php echo base_url();?>article/edit/<?php echo $article['id'];?>" title="Edit : <?php echo $article['topic']; ?>">
					<i class="btn-icon-only icon-edit"> </i>
				</a>
				<a class="btn btn-danger btn-small" href="<?php echo base_url()."article/delete/".$article['id']; ?>" title="Delete : <?php echo $article['topic']; ?>">
					<i class="btn-icon-only icon-remove"></i>
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php if($count>10) : ?>
<div class="panel-footer clearfix">
	<ul class="pagination pagination-split m-bottom-md">
		<li><a href="#">Pages</a></li>
		<?php 
			$mod=10; $inc=1;
			if($count>$mod) :
				for($i=0;$i<=$count;$i++) :
					if(($i%$mod)==0) :
		?>
		
		<li class="<?php if($inc==$this->uri->segment(6))  echo "active"; else if(!($this->uri->segment(6)) && $inc==1)  echo "active";  ?>">
			<a href="<?php echo base_url()."article/dashboard/index/".$inc; ?>"><?php echo $inc;?></a>
		</li>
		
		<?php
						$inc++;
					endif;
				endfor;
			endif;
			?>
	</ul>
</div>
<?php endif; ?>
<?php } else { ?>
<div id="errorMessage" class="alert alert-danger">
	No such articles exist
</div>
<?php } ?>