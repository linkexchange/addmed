<?php //echo "<pre>"; print_r($blogs); echo "</pre>"; ?>
<table class="table table-bordered table-striped dataTable">
	<thead>
		<tr>
			<th>Sr.<?php //echo $count;?></th>
			<th>Post Title</th>
			<th>Post Image</th>
			<!--<th>Blog Description</th>-->
			<th>Website Name</th>
			<th>Gallery Item Count</th>
			<th>Created Date</th>
			<th class="td-actions">Actions</th>
		</tr>
	</thead>
	<?php //echo $count;?>
	<tbody>
	<?php 
		//echo $this->uri->segment(4);
		$sr=1;
		if($this->uri->segment(5)>1 ){
			$sr=(int)$this->config->item('record_limit')*$this->uri->segment(5)-((int)$this->config->item('record_limit')-1);
		}
		$this->load->model('article');
	?>
	<?php  foreach($blogs as $item) : ?>
		<tr>
			<td><?php echo $sr; $sr++; ?></td>
			<td><?php echo $item['title']; ?></td>
			<td>
				<?php if($item['image']) : ?>
					<img src="<?php echo base_url().BLOG_IMAGE_PATH.$item['image']; ?>" width="100px" height="auto" />
				<?php endif; ?>
			</td>
		  <!--  <td><?php echo $item['description']; ?></td>-->
			<td><?php echo $item['name']; ?></td>
			<td>
				<?php 
						$art_count=0;
						$art_count=$this->article->getArticleCountByBlog($item['id']);
						//print_r($art_count);
						echo $art_count;
				?>
			</td>
			<td><?php echo $item['createdDate']; ?></td>
			<td>
				<a class="btn btn-small btn-success" href="<?php echo base_url()."blogs/dashboard/edit/".$item['id']; ?>" title="Edit Post : <?php echo $item['title']; ?>">
					<i class="btn-icon-only icon-edit"> </i>
				</a>
				<a class="btn btn-danger btn-small" href="<?php echo base_url()."blogs/dashboard/delete/".$item['id']; ?>">
					<i class="btn-icon-only icon-remove"></i>
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>&nbsp;&nbsp;
	
<?php 
    
    $url=base_url()."blogs/dashboard/index/";
    if($this->uri->segment(5))
        $currentPage=$this->uri->segment(5);
    else
        $currentPage=1;
    if($tempID)
        $parameters[0]=(int)$tempID;
    else
        $parameters[0]=0;
    pagination($url,$parameters,$count,$currentPage);
?>