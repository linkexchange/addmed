<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                	<div class="span12" style="margin:0px 0px 15px 0px; text-align:right; "> 
                    	<button onclick="javascript:goto('articles/dashboard/addmultiple')" class="btn btn-primary btn-large  icon-anchor"> Add Article</button>
                    </div>
                	<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>View Articles</h3>
						</div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                                	
									<?php //echo "<pre>"; print_r($articles); echo "</pre>"; ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sr. </th>
                                                <th>Article Title</th>
                                                <th>Article Image</th>
                                                <th>Artcile Description</th>
                                                <th>Blog Name</th>
                                                <th>Template Name</th>
                                                <th>Created Date</th>
                                                <th>Last Updated On</th>
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
											?>
                                            <?php  foreach($articles as $article) : ?>
                                            <tr>
                                                <td><?php echo $sr; $sr++; ?></td>
                                                <td><?php echo $article['articleTitle']; ?></td>
                                                <td>
                                                	<?php if($article['articleImage']) : ?>
                                        				<img src="<?php echo base_url().ARTICLE_IMAGE_PATH.$article['articleImage']; ?>" width="100px" height="auto" />
                                       				<?php endif; ?>
                                                </td>
                                                <td><?php echo $article['articleDescription']; ?></td>
                                                <td><?php echo $article['title']; ?></td>
                                                <td><?php echo $article['name']; ?></td>
                                                <td><?php echo $article['createdDate']; ?></td>
                                                <td>
                                                	<?php if($article['updatedDate']!="0000-00-00") : ?>
														<?php echo $article['updatedDate']; ?>
                                                    <?php endif; ?>
                                                </td>
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
                                    </table><!-- table -->
                                    <?php if($count>10) : ?>
                                    <div class="widget-header navigation" style="text-align:right;">
					 					<?php 
                                            $mod=10; $inc=1;
                                            if($count>$mod) :
                                                echo "Pages:";
                                                for($i=0;$i<=$count;$i++) :
                                                    if(($i%$mod)==0) :
                                                        //echo $inc;
                                                    ?>
                                                    <a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."articles/dashboard/index/".$inc; ?>" ><?php echo $inc; ?></a>
                                                        <?php
                                                        $inc++;
                                                    endif;
                                                endfor;
                                            endif;
                                        ?> &nbsp;
									</div><!-- widget-header pagination -->
                                    <?php endif; ?>
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div><!-- widget -->
                </div><!-- span12 -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- main-inner -->
</div> <!-- main -->