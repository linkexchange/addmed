

<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                	<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>View Comments</h3>
						</div>
                        <div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                             		<div class="widget-content inner">
                                    	
                                        <div class="setArticles">
                                        	<table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><h3><?php echo $name[0]['topic'];?></h3></th>
													</tr>
												</thead>
                                                <tbody>
                                                <?php for($i=0;$i<count($comments);$i++){ ?>
													<tr>
													<td><h4>Comment</h4>
													<?php echo $comments[$i]['description'];?>
													<h4>Replies</h4>
													<?php  
														for($j=0;$j<count($replies);$j++) {
															if($replies[$j]['parent_id']==$comments[$i]['id']) {
																echo $replies[$j]['description']."<br/>";
															}
														}?>
													</td>	
													</tr>
												<?php } ?>		
                                                </tbody>
                                    		</table><!-- table -->
											
                                    	</div><!-- setArticles  -->
                                    </div><!-- widget-content  -->
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div><!-- widget -->
                </div><!-- span12 -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- main-inner -->
</div> <!-- main -->
