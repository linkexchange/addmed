<table class="table table-bordered table-striped dataTable">
	<thead>
		<tr>
			<th><br/>Sr. </th>
			<th><br/>Gallery Item Title</th>
			<!-- <th>Gallery Item Image</th>
			<th>Gallery Item Video</th> -->
			<th><br/>Post Name</th>
			<th><br/>Website Name</th>
			<th><br/>Created Date</th>
			<th><br/>Last Updated On</th>
			<?php if($this->uri->segment(4) && $this->uri->segment(5)) : ?>
			<th><br/>Sort Order</th>
			<?php endif; ?>
			<th class="td-actions"><br/>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		//echo $this->uri->segment(4);
			$sr=1;
			if($this->uri->segment(6)>1 ){
				$sr=10*$this->uri->segment(6)-9;
			}
		?>
		<?php  foreach($articles as $article) : ?>
		<tr>
			<td><?php echo $sr; $sr++; ?></td>
			<td><?php echo $article['articleTitle']; ?></td>
			<!-- <td>
				<?php if($article['articleImage']) : ?>
					<img src="<?php echo base_url().ARTICLE_IMAGE_PATH.$article['articleImage']; ?>" width="100px" height="auto" />
				<?php endif; ?>
			</td>
			<td><div class="article_videos"><?php echo $article['articleVideo']; ?></div></td> -->
			<td><?php echo $article['title']; ?></td>
			<td><?php echo $article['name']; ?></td>
			<td><?php echo $article['createdDate']; ?></td>
			<td>
				<?php if($article['updatedDate']!="0000-00-00") : ?>
					<?php echo $article['updatedDate']; ?>
				<?php endif; ?>
			</td>
			<?php if($this->uri->segment(4) && $this->uri->segment(5)) : ?>
			 <td>
				<select id="sortOrder" name="sortOrder" onchange="sort_order_change(<?php echo $article['id']; ?>, this.value);">
					<?php for($i=1;$i<=$count;$i++): ?>
						<?php if($i==$article['sortOrder']) : ?>
							<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
						<?php else : ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php endif; ?>
					<?php endfor; ?>
				</select>                                                     
			</td>
			<?php endif; ?>
			<td class="td-actions">
				<a class="btn btn-small btn-success" href="<?php echo base_url()."articles/dashboard/edit/".$article['id']; ?>" title="Edit : <?php echo $article['articleTitle']; ?>" style="margin-bottom:5px;">
					<i class="btn-icon-only icon-edit"> </i>
				</a>
				<a class="btn btn-danger btn-small" href="<?php echo base_url()."articles/dashboard/delete/".$article['id']; ?>" title="Delete : <?php echo $article['articleTitle']; ?>">
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
		<?php if($this->uri->segment(4) && $this->uri->segment(5)) : ?>
		<li class="<?php if($inc==$this->uri->segment(6))  echo "active"; else if(!($this->uri->segment(6)) && $inc==1)  echo "active";  ?>">
			<a href="<?php echo base_url()."articles/dashboard/index/".$inc; ?>"><?php echo $inc;?></a>
		</li>
		<?php else : ?>
		<li class="<?php if($inc==$this->uri->segment(6))  echo "active"; else if(!($this->uri->segment(6)) && $inc==1)  echo "active";  ?>">
			<a href="<?php echo base_url()."articles/dashboard/index/0/0/".$inc; ?>"><?php echo $inc;?></a>
		</li>
		<?php endif; ?>
		<?php
						$inc++;
					endif;
				endfor;
			endif;
			?>
	</ul>
</div>
<?php endif; ?>	