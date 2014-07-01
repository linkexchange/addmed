<?php //echo "<pre>"; print_r($blogs); echo "</pre>"; ?>
<table class="table table-striped table-bordered">
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
                    <div class="widget-header" style="text-align:right;">
					 
					<?php 
						$mod=10; $inc=1;
						if($count>$mod) :
							echo "Pages:";
							for($i=0;$i<=$count;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
								?>
								<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(5))  echo "page-active"; else if(!($this->uri->segment(5)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."pages/dashboard/index/".$tempID."/".$inc; ?>" ><?php echo $inc; ?></a>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
					</div>
                    <?php endif; ?>