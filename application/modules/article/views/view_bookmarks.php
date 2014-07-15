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
								<i class="icon-list-alt"></i>
								<h3>View Bookmarks</h3>
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
															<?php echo $bookmarks[$i]['url'];?>
														</td>
														<td>Edit Remove</td>	
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