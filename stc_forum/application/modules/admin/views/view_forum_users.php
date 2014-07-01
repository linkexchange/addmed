<h1>Forum</h1>
								
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
								<h3>View users</h3>
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
                                                        <th><h4>Sr.No</h4></th>
														<th><h4>Username</h4></th>
														<th><h4>Email</h4></th>
														<th><h4>Actions</h4></th>
													</tr>
												</thead>
												<tbody>	
												<?php 
                                                    //echo $this->uri->segment(4);
                                                        $sr=1;
                                                        if($this->uri->segment(3)>1 ){
                                                            $sr=10*$this->uri->segment(3)-9;
                                                        }
                                                    ?>	
												<?php			
												   for($i=0;$i<count($users);$i++) { ?>
													<tr>	
														<td><?php echo $sr; $sr++; ?></td>
														<td>
															<?php echo $users[$i]['username'];?>
														</td>
														<td>
															<?php echo $users[$i]['email'];?>
														</td>
														<td>
															<a target="_blank" href="<?php echo base_url();?>admin/forum/view/<?php echo $users[$i]['id']?>">
															<i class="icon-eye-open" title="View"></i>
															</a> &nbsp; &nbsp;
															<span id="spam_<?php echo $users[$i]['id'];?>">
															<?php if($users[$i]['spam']=='no'){?>
															<a href="#" onclick="spamuser(<?php echo $users[$i]['id'];?>);return false;">
															<i class="icon-unlock" title="Spam"></i>
															</a>
															<?php } else {?>
															<a href="#" onclick="unspamuser(<?php echo $users[$i]['id'];?>);return false;">
															<i class="icon-lock" title="Unspam"></i>
															</a>
															<?php } ?>
															</span>
														</td>	
													</tr>
													<?php } ?>
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
                                                                //echo $inc; ?>
                                                           
                                                            	 <a class="btn btn-small btn-success page-<?php echo $inc;?> <?php if($inc==$this->uri->segment(6))  echo "page-active"; else if(!($this->uri->segment(6)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."admin/forum/users/".$inc; ?>" ><?php echo $inc; ?></a>
																
                                                           
                                                                <?php
                                                                $inc++;
                                                            endif;
                                                        endfor;
                                                    endif;
                                                ?> &nbsp;
                                            </div><!-- widget-header pagination -->
                                            <?php endif; ?>
											
										
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
function spamuser(id)
{
	$.ajax({
		url:base_url+'admin/forum/spam/'+id,
		type:'POST',
		data:{submit:true},
		success:function(result){
			if(result==100){
			$("#spam_"+id).empty();
			$("#spam_"+id).html('<a href="#" onclick="unspamuser('+id+');return false;"><i class="icon-lock" title="Unspam"></i></a>');	
			}
		}
	})
}	
function unspamuser(id)
{
	$.ajax({
		url:base_url+'admin/forum/unspam/'+id,
		type:'POST',
		data:{submit:true},
		success:function(result){
			if(result==100){
			$("#spam_"+id).empty();
			$("#spam_"+id).html('<a href="#" onclick="spamuser('+id+');return false;"><i class="icon-unlock" title="Spam"></i></a>');	
			}
		}
	})
}
</script>		