<!DOCTYPE html>
<html lang="en">
<head>
<title>Bookmarks</title>
</head>


<div class="main">
			<div class="main-inner">
				<div class="container">
					<div class="row">
						<div class="span12">
						<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-star"></i>
								<h3>Bookmarks</h3>
						</div>
                        <?php //echo "<pre>"; print_r($articles); exit;?>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
								
                            	<div class="widget-content inner">
                             		<div class="widget-content inner">
									<div id="articleTable">	
                                        	<table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><h4>Name</h4></th>
														<th><h4>Url</h4></th>
														<th><h4>Actions</h4></th>
													</tr>
												</thead>
												<tbody>	
													<?php for($i=0;$i<count($bookmarks);$i++){?>
													<tr>	
														<td>
															 <?php echo $bookmarks[$i]['name'];?>  
														</td>
														<td>
															<a target="_blank" href="<?php echo $bookmarks[$i]['url'];?>">
															<?php echo $bookmarks[$i]['url'];?></a>
														</td>
														<td>
															<a class="btn btn-small btn-success" href="<?php echo base_url()."forum_articles/listing/edit/".$bookmarks[$i]['id']; ?>" title="Edit : <?php echo $bookmarks[$i]['name']; ?>">
															<i class="btn-icon-only icon-edit"> </i>
															</a>
															<a class="btn btn-danger btn-small" href="<?php echo base_url()."forum_articles/listing/delete/".$bookmarks[$i]['id']; ?>" title="Delete : <?php echo $bookmarks[$i]['name']; ?>">
															<i class="btn-icon-only icon-remove"></i>
															</a>
														</td>	
													</tr>
													<?php } ?>
												</tbody>
                                    		</table><!-- table -->
											
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
                                                                //echo $inc;
                                                            ?>
                                                           
                                                            	 <a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(6))  echo "page-active"; else if(!($this->uri->segment(6)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."forum_articles/listing/index/".$inc; ?>" ><?php echo $inc; ?></a>
                                                            
                                                           
                                                                <?php
                                                                $inc++;
                                                            endif;
                                                        endfor;
                                                    endif;
                                                ?> &nbsp;
                                            </div><!-- widget-header pagination -->
                                            <?php endif; ?>	
									</div>	
									</div>				
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div>
                        </div><!-- .span12-->
                    </div><!-- .row -->
                </div><!-- .container -->
           	</div><!-- .main-inner -->
        </div><!-- .main -->