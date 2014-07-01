<h1>Forum </h1>
								
<div class="main">
			<div class="main-inner">
				<div class="container">
					<div class="row">
						<div class="span12">
						<!--<div class="span12" style="margin:0px 0px 15px 0px; text-align:right;"> 
						<button onclick="javascript:goto('forum_articles/forum/add')" class="btn btn-primary btn-large  icon-anchor"> Add Topic</button>
						</div>-->
						<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>View Topics</h3>
						</div>
						<?php if($this->session->flashdata('msg')) { ?>
						<div id="successMessage" class="alert alert-success">
						<?php echo $this->session->flashdata('msg');?>	
						</div>
                    	<?php } ?>
						<div class="widget-content">
                        	<div class="big-stats-container">
								<!--span style="float:right;width:26%">Search: 
									<input type="text" id="search2" placeholder="enter topic">
								</span>-->
                            	<div class="widget-content inner">
                             		<div class="widget-content inner">
									<div id="articleTable">	
                                        	<table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th><h4>Topic</h4></th>
														<th><h4>Author</h4></th>
														<th><h4>Replies</h4></th>
														<th><h4>Actions</h4></th>
													</tr>
												</thead>
												<tbody>	
													
												<?php			
												   for($i=0;$i<count($topics);$i++) { ?>
													<tr>	
														<td>
															<?php echo $topics[$i]['name'];?>
														</td>
														<td>
															<?php echo $topics[$i]['author'];?>
														</td>
														<td>
															<?php echo $topics[$i]['no_of_posts'];?>
														</td>
														<td>
															<a target="_blank" href="<?php echo base_url();?>admin/forum/view/<?php echo $topics[$i]['id']?>">
															<i class="icon-eye-open" title="View"></i>
															</a> &nbsp; &nbsp;
															<span id="approval_<?php echo $topics[$i]['id'];?>">
															<?php if($topics[$i]['approved']==1){?>
															<a href="#" onclick="disapprove(<?php echo $topics[$i]['id'];?>);return false;">
															<i class="icon-unlock" title="Disapprove"></i>
															</a>
															<?php } else {?>
															<a href="#" onclick="approve(<?php echo $topics[$i]['id'];?>);return false;">
															<i class="icon-lock" title="Approve"></i>
															</a>
															<?php } ?>
															</span>
														</td>	
													</tr>
													<?php } ?>
												</tbody>
                                    		</table><!-- table -->
											
											
										
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
<script>
function approve(id)
{
	$.ajax({
		url:base_url+'admin/forum/approve/'+id,
		type:'POST',
		data:{submit:true},
		success:function(result){
			if(result==100){
			$("#approval_"+id).empty();
			$("#approval_"+id).html('<a href="#" onclick="disapprove('+id+');return false;"><i class="icon-unlock" title="Disapprove"></i></a>');	
			}
		}
	})
}	
function disapprove(id)
{
	$.ajax({
		url:base_url+'admin/forum/disapprove/'+id,
		type:'POST',
		data:{submit:true},
		success:function(result){
			if(result==100){
			$("#approval_"+id).empty();
			$("#approval_"+id).html('<a href="#" onclick="approve('+id+');return false;"><i class="icon-lock" title="Approve"></i></a>');	
			}
		}
	})
}
</script>		