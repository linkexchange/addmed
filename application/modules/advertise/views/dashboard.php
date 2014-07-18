<?php if($this->session->flashdata('message')) : ?>
<script>
$(document).ready(function(){
	$("#successMessage").show();
});
</script>
<?php endif; ?>
<div id="main-container">
	<div class="padding-md">
		<div class="panel panel-default table-responsive">
					<div class="panel-heading">
						<h3><b><i class="icon-building"></i> View Ads</b>
							<span class="pull-right">
								<a class="btn btn-success icon-anchor" href="<?php echo base_url();?>advertise/dashboard/add"> Add Ad</a>
							</span>
						</h3>
					</div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"><?php echo $this->session->flashdata('message');?></div>
					
					<div class="padding-md clearfix">
						<table class="table table-bordered table-striped dataTable">
							<thead>
								<tr>
									<th><br/>Sr. </th>
									<th><br/>Website Title</th>
									<th><br/>Created Date</th>
									<th><br/>Updated Date</th>
									<th class="td-actions"><br/>Actions</th>
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
									<?php foreach ($ads as $ad) : ?>
									<tr>
										<td><?php echo $sr; $sr++; ?></td>
										<td><?php echo $ad['name']; ?></td>
										<td><?php echo $ad['createdDate']; ?></td>
										<td><?php if($ad['updatedDate'] != "0000-00-00") : echo $ad['updatedDate'];  endif; ?></td>
										<td class="td-actions">
											<!--<a class="btn btn-small btn-success" href="<?php echo base_url()."advertise/dashboard/view/".$ad['id']; ?>" title="View">
												<i class="btn-icon-only icon-edit"> </i>
											</a>-->
											<a class="btn btn-small btn-success" href="<?php echo base_url()."advertise/dashboard/edit/".$ad['id']; ?>" title="Edit">
												<i class="btn-icon-only icon-edit"> </i>
											</a>
											<a class="btn btn-danger btn-small" href="<?php echo base_url()."advertise/dashboard/delete/".$ad['id']; ?>" title="Delete">
												<i class="btn-icon-only icon-remove"></i>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
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
							<li class="<?php if($inc==$this->uri->segment(4))  echo "active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "active"; ?>">
								<a href="<?php echo base_url()."advertise/dashboard/index/".$inc; ?>"><?php echo $inc;?></a>
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
function createHtml(tid){
	alert(tid);
	if(tid){
		$.ajax({
			url:base_url+"website/dashboard/createHtml/"+tid,
			//beforeSend: loadStartPub,
			//complete: loadStopPub,
			success:function(result){
				//$("#setBlogsData").html(result);
			}});
		}
		else
		{
			//$("#setBlogsData").html("");
		}
}
</script>