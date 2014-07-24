<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-shield"></i> Forum</b></h3>
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
									<th><h4>Sr.No</h4></th>
									<th><h4>Topic</h4></th>
									<th><h4>Author</h4></th>
									<th><h4>Replies</h4></th>
									<th><h4>Actions</h4></th>
								</tr>
							</thead>
							<tbody>	
								
							<?php			
								$sr=1;
								if($this->uri->segment(4)>1 ){
									$sr=10*$this->uri->segment(4)-9;
								}
								foreach($topics as $topic) { ?>
								<tr>	
									<td><?php echo $sr; $sr++; ?></td>
									<td>
										<a target="_blank" href="<?php echo base_url();?>forum/dashboard/view/<?php echo $topic['id']?>">
										<?php echo $topic['name'];?>
										</a>
									</td>
									<td>
										<?php echo $topic['author'];?>
									</td>
									<td>
										<?php echo $topic['no_of_posts'];?>
									</td>
									<td>
										<!--<a target="_blank" href="<?php echo base_url();?>forum/dashboard/view/<?php echo $topic['id']?>" class="btn btn-small" style="background-color:white;border:1px solid black;">
										<i class="icon-eye-open" title="View"></i>
										</a> &nbsp; &nbsp;-->
										<span id="approval_<?php echo $topic['id'];?>">
										<?php if($topic['approved']==1){?>
										<a href="#" onclick="disapprove(<?php echo $topic['id'];?>);return false;" class="btn btn-small btn-success">
										<i class="icon-unlock" title="Disapprove"></i>
										</a>
										<?php } else {?>
										<a href="#" onclick="approve(<?php echo $topic['id'];?>);return false;" class="btn btn-small btn-success">
										<i class="icon-lock" title="Approve"></i>
										</a>
										<?php } ?>
										</span>
										<a class="btn btn-danger btn-small" href="<?php echo base_url()."forum/dashboard/delete/".$topic['id']; ?>">
												<i class="btn-icon-only icon-remove"></i>
										</a>
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
								<a href="<?php echo base_url()."forum/dashboard/index/".$inc; ?>"><?php echo $inc;?></a>
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
function approve(id)
{
	$.ajax({
		url:base_url+'forum/dashboard/approve/'+id,
		type:'POST',
		data:{submit:true},
		success:function(result){
			if(result==100){
			$("#approval_"+id).empty();
			$("#approval_"+id).html('<a href="#" onclick="disapprove('+id+');return false;" class="btn btn-small btn-success"><i class="icon-unlock" title="Disapprove"></i></a>');	
			}
		}
	})
}	
function disapprove(id)
{
	$.ajax({
		url:base_url+'forum/dashboard/disapprove/'+id,
		type:'POST',
		data:{submit:true},
		success:function(result){
			if(result==100){
			$("#approval_"+id).empty();
			$("#approval_"+id).html('<a href="#" onclick="approve('+id+');return false;" class="btn btn-small btn-success"><i class="icon-lock" title="Approve"></i></a>');	
			}
		}
	})
}
</script>