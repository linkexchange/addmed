<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-user"></i> Forum Users</b></h3>
			</div>
		</div> <br/>
		<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
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
									<th>Last Logged In from</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>	
							<?php 
								//echo $this->uri->segment(4);
									$sr=1;
									if($this->uri->segment(4)>1 ){
										$sr=(int)$this->config->item('record_limit')*$this->uri->segment(4)-((int)$this->config->item('record_limit')-1);
									}
								?>	
							<?php			
							   for($i=0;$i<count($users);$i++) { ?>
								<tr>	
									<td><?php echo $sr; $sr++; ?></td>
									<td><?php echo $users[$i]['firstName'];?></td>
									<td><?php echo $users[$i]['lastName'];?></td>
									<td><?php echo $users[$i]['email'];?></td>
									<td><?php echo $users[$i]['lastLoggedInFrom'];?></td>
									
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
						<?php 
							$url=base_url()."forum/dashboard/users/";
							if($this->uri->segment(4))
							$currentPage=(int)$this->uri->segment(4);
							else
							$currentPage=1;
							$parameters=array();
							pagination($url,$parameters,$count,$currentPage);
						?>	
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