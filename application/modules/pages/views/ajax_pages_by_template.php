<?php //echo "<pre>"; print_r($blogs); echo "</pre>"; ?>
<table class="table table-bordered table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th>Sr. </th>
			<th>Page Title</th>
			<th>Website Name</th>
			<th>Created Date</th>
			<th class="td-actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			//echo $this->uri->segment(4);
			$sr=1;
			if($this->uri->segment(5)>1 ){
				$sr=10*$this->uri->segment(5)-9;
			}
			$this->load->model('article');
		?>
		<?php  foreach($pages as $item) : ?>
			<tr>
				<td><?php echo $sr; $sr++; ?></td>
				<td><?php echo $item['title']; ?></td>
			   
				<td><?php echo $item['name']; ?></td>
				<td><?php echo $item['createdDate']; ?></td>
				<td>
					<a class="btn btn-small btn-success" href="<?php echo base_url()."pages/dashboard/edit/".$item['id']; ?>" title="Edit Post : <?php echo $item['title']; ?>">
						<i class="btn-icon-only icon-edit"> </i>
					</a>
					<a class="btn btn-danger btn-small" href="<?php echo base_url()."pages/dashboard/delete/".$item['id']; ?>">
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
		
		<li class="<?php if($inc==$this->uri->segment(5))  echo "active"; else if(!($this->uri->segment(5)) && $inc==1)  echo "active";  ?>">
			<a href="<?php echo base_url()."pages/dashboard/index/0/".$inc; ?>"><?php echo $inc;?></a>
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