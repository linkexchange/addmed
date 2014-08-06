<?php if($this->session->flashdata('message')) : ?>
<script>
$(document).ready(function(){
	$("#successMessage").show();
});
</script>
<?php endif; ?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                	<div class="widget"> 
					<div class="span12 offset10"> 
						<button onclick="javascript:goto('blogs/dashboard/add')" class="btn btn-primary btn-large  icon-anchor"> Add Blog</button>
					</div>
				</div>
                <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
				<div id="successMessage" class="alert alert-success" style="display:none"><?php echo $this->session->flashdata('message');?></div>
				
					<table class="table table-striped table-bordered">
                    	<thead>
							<tr>
								<th>Sr. </th>
								<th>Blog Title</th>
                                <th>Blog Image</th>
                                <!--<th>Blog Description</th>-->
								<th>Template Name</th>
								<th>Article Acount</th>
                                <th>Created Date</th>
								<th class="td-actions">Actions</th>
							</tr>
						</thead>
                        <tbody>
                        <?php 
							//echo $this->uri->segment(4);
							$sr=1;
							if($this->uri->segment(4)>1 ){
								$sr=10*$this->uri->segment(4)-9;
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
											$art_count=$this->article->getArticleCountByBlog($item['id']);
											print_r($art_count);
										?>
                                    </td>
                                    <td><?php echo $item['createdDate']; ?></td>
                                    <td>
                                    	<a class="btn btn-small btn-success" href="<?php echo base_url()."blogs/dashboard/edit/".$item['id']; ?>" title="Edit Template : <?php echo $item['name']; ?>" style="margin-bottom:5px;">
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
                    <div class="widget-header" style="text-align:right;">
					 
					<?php 
						$mod=10; $inc=1;
						if($count>$mod) :
							echo "Pages:";
							for($i=0;$i<=$count;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
								?>
								<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."blogs/dashboard/index/".$inc; ?>" ><?php echo $inc; ?></a>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
					</div>
                </div>
            </div>
        </div>
    </div>
</div>