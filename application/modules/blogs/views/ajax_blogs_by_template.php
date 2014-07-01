<?php //echo "<pre>"; print_r($blogs); echo "</pre>"; ?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Sr. </th>
			<th>Post Title</th>
            <th>Post Image</th>
            <!--<th>Blog Description</th>-->
			<th>Website Name</th>
			<th>Gallery Item Count</th>
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
											echo $art_count;
										?>
                                    </td>
                                    <td><?php echo $item['createdDate']; ?></td>
                                    <td>
                                    	<a class="btn btn-small btn-success" href="<?php echo base_url()."blogs/dashboard/edit/".$item['id']; ?>" title="Edit Template : <?php echo $item['name']; ?>">
                                        	<i class="btn-icon-only icon-edit"> </i>
                                        </a>
                                        <a class="btn btn-danger btn-small" href="<?php echo base_url()."blogs/dashboard/delete/".$item['id']; ?>">
                                        	<i class="btn-icon-only icon-remove"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                  
                    </table>
                    <?php if($count>10) : ?>
                    <div class="widget-header" style="text-align:right;">
					 
					<?php 
						$mod=10; $inc=1;
						if($count>$mod) :
							echo "Pages:";
							for($i=0;$i<=$count;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
								?>
								<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(5))  echo "page-active"; else if(!($this->uri->segment(5)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."blogs/dashboard/index/".$tempID."/".$inc; ?>" ><?php echo $inc; ?></a>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
					</div>
                    <?php endif; ?>