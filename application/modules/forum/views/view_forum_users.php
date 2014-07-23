<div id="main-container">
	<div class="padding-md">
		<div class="panel panel-default table-responsive">
					<div class="panel-heading">
						<h3><b><i class="icon-list-alt"></i> Forum</b></h3>
						<!--<span class="pull-right">
							<?php if($this->session->userdata("userTypeID")==3) : ?>
								<a class="btn btn-success icon-anchor" href="<?php echo base_url();?>pages/dashboard/add"> Add Page</a>
							<?php endif; ?>
						</span>-->
					</div>
					<?php if($this->session->flashdata('msg')) { ?>
					<div id="successMessage" class="alert alert-success">
						<?php echo $this->session->flashdata('msg');?>	
					</div>
					<?php } ?>
					<div class="padding-md clearfix"> <b>
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>Sr.No</th>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Username/Email</th>
									<th>Actions</th>
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
							<?php			
							   for($i=0;$i<count($users);$i++) { ?>
								<tr>	
									<td><?php echo $sr; $sr++; ?></td>
									<td><?php echo $users[$i]['firstName'];?></td>
									<td><?php echo $users[$i]['lastName'];?></td>
									<td><?php echo $users[$i]['userName'];?></td>
									
									<td>
										<span id="spam_<?php echo $users[$i]['id'];?>">
										<?php if($users[$i]['spam']=='No'){?>
										<a href="#" onclick="spamuser(<?php echo $users[$i]['id'];?>);return false;" class="btn btn-success" title="Spam">
										<i class="icon-unlock" title="Spam"></i>
										</a>
										<?php } else {?>
										<a href="#" onclick="unspamuser(<?php echo $users[$i]['id'];?>);return false;" class="btn btn-success" title="Unspam">
										<i class="icon-lock" title="Unspam"></i>
										</a>
										<?php } ?>
										</span>
									</td>	
								</tr>
								<?php } ?>
							</tbody>
                        </table></b>
					<?php if($count>10) : ?>
					<div class="panel-footer clearfix">
						<ul class="pagination pagination-split m-bottom-md">
							<li><a href="#">Pages</a></li>
							<?php 
								$mod=10; $inc=1;
								if($count>$mod) :
									for($i=0;$i<=$count;$i++) :
										if(($i%$mod)==0) :
							?>
							
							<li class="<?php if($inc==$this->uri->segment(4))  echo "active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "active";  ?>">
								<a href="<?php echo base_url()."forum/dashboard/users/".$inc; ?>"><?php echo $inc;?></a>
							</li>
							<?php
											$inc++;
										endif;
									endfor;
								endif;
								?>
						</ul>
					</div>
					<?php endif; ?>	
			</div><!-- /.padding-md -->
		</div>	
	</div><!-- /.padding-md -->
</div>
<script>
function spamuser(id)
{
	$.ajax({
		url:base_url+'forum/dashboard/spam/'+id,
		type:'POST',
		data:{submit:true},
		success:function(result){
			if(result==100){
			$("#spam_"+id).empty();
			$("#spam_"+id).html('<a href="#" onclick="unspamuser('+id+');return false;" class="btn btn-success"><i class="icon-lock" title="Unspam"></i></a>');	
			}
		}
	})
}	
function unspamuser(id)
{
	$.ajax({
		url:base_url+'forum/dashboard/unspam/'+id,
		type:'POST',
		data:{submit:true},
		success:function(result){
			if(result==100){
			$("#spam_"+id).empty();
			$("#spam_"+id).html('<a href="#" onclick="spamuser('+id+');return false;" class="btn btn-success"><i class="icon-unlock" title="Spam"></i></a>');	
			}
		}
	})
}
</script>