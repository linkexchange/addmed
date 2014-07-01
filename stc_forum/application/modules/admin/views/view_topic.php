
<div class="main">
			<div class="main-inner">
				<div class="container">
					<div class="row">
						<div class="span12">
						<?php $id = $topic[0]['id'];?>
						<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3><?php echo $topic[0]['name'];?></h3>
						</div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
								
                            	<div class="widget-content inner">
                             		<div class="widget-content inner">
									<div id="articleTable">	
                                        	<table class="table table-striped table-bordered">
                                                <tbody>	
												<tr>
												<td>
												<?php echo $topic[0]['description'];?>	
												</td>
												</tr>
												</tbody>
                                    		</table><!-- table -->
										<?php  if($post) { ?>	
										<div style="width:100%;border: 1px solid #dddddd; border-radius:5px; background-color:#f5f5f5;"><br/>
										<?php	
											for($i=0;$i<count($post);$i++){?>&nbsp; &nbsp;
												<b> <?php echo $post[$i]['name'];?></b>&nbsp; &nbsp; 
													<?php echo $post[$i]['created_date'];?><br/> &nbsp; &nbsp;
													<?php echo $post[$i]['post_description'];?><hr>
										<?php } }?>
										</div>
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
        </div>
