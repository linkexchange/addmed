<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-globe"></i> Websites</b>
				<span class="pull-right">
					<?php if($this->session->userdata("userTypeID")==3) : ?>
						<a class="btn btn-success icon-anchor" href="<?php echo base_url();?>website/dashboard/add"> Add Website</a>
					<?php endif; ?>
				</span></h3>
			</div>
		</div> <br/>
		<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
			<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<?php if($this->session->flashdata('message')) { ?>
			<div id="successMessage" class="alert alert-success">
				<?php echo $this->session->flashdata('message');?>
			</div>
			<?php } ?>
					
			<div class="padding-md clearfix">
				<table class="table table-bordered table-striped dataTable">
						<thead>
							<tr>
								<th>Sr. </th>
								<th>Website Name</th>
								<th>API Key</th>
								<!-- <th>View</th> -->
								<th>Website Created Date</th>
								<th>Last Updated On</th>
								<th>HTML Created Date</th>
								<th class="td-actions">Actions</th>
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
							<?php  foreach($templates as $item) : ?>
								<tr>
									<td><?php echo $sr; $sr++; ?></td>
									<td><?php echo $item['name']; ?></td>
									<!--<td><?php if($item['htmlCreated']=="Update" && $item['htmlCreatedDate']=="0000-00-00") : echo "Create"; else : echo $item['htmlCreated']; endif; ?></td>-->
									<td><?php echo $item['apiKey']; ?></td>
									<!-- <td>
										<?php echo $item['path']; ?>
										 <a class="" href="<?php echo $url."?tid=".$item['id']; ?>" title="" target="_blank">
											View
										</a>
									</td> -->
									<td><?php echo $item['createdDate']; ?></td>
									<td><?php if(isset($item['updatedDate']) && $item['updatedDate']!="0000-00-00") : echo $item['updatedDate']; endif; ?></td>
									<td><?php if(isset($item['htmlCreatedDate']) && $item['htmlCreatedDate']!="0000-00-00") : echo $item['htmlCreatedDate']; endif; ?></td>
									<td>
										<a class="btn btn-small btn-success" href="<?php echo base_url()."website/dashboard/edit/".$item['id']; ?>" title="Edit Website : <?php echo $item['name']; ?>">
											<i class="btn-icon-only icon-edit"> </i>
										</a>
										<a class="btn btn-danger btn-small" href="<?php echo base_url()."website/dashboard/delete/".$item['id']; ?>">
											<i class="btn-icon-only icon-remove"></i>
										</a>
										<?php if($item['htmlCreated']!="Done") : ?>
										<!--<a class="btn btn-small btn-primary" href="javascript:void(0)" title="Create/Update HTML : <?php echo $item['name']; ?>" onclick="createHtml(<?php echo $item['id']; ?>)">
											<i class="btn-icon-only icon-anchor"> </i>
										</a>-->
										<?php endif; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php $mod=$mod=(int)$this->config->item('record_limit'); $inc=1; $next=$inc+1;?>
				<?php if($count>$mod) : ?>
					<ul class="pagination pagination-split m-bottom-md">
					<?php if($this->uri->segment(4)>1) : ?>
					<?php $prev = $this->uri->segment(4)-1; ?>	
						<li><a href="<?php echo base_url().'website/dashboard/index/'.$prev;?>">Previous</a></li>
					<?php endif; ?>	
						<?php for($i=0;$i<$count;$i++) : ?>
							<?php if(($i%$mod)==0) : ?>
								<?php if($this->uri->segment(4)==$inc) : ?>
									<li class="active" id="page-nav-<?php echo $inc; ?>"><a href="<?php echo base_url().'website/dashboard/index/'.$inc;?>"><?php echo $inc; ?></a></li>
									<?php $next=$inc+1; ?>
								<?php else : ?>
									<li id="page-nav-<?php echo $inc; ?>"><a href="<?php echo base_url().'website/dashboard/index/'.$inc;?>"><?php echo $inc; ?></a></li>
								<?php endif; ?>
								<?php $inc++; ?>
							<?php endif; ?>
						<?php endfor; ?>
						<?php if($next!=$inc) : ?>
						<li id="page-nav-next"><a href="<?php echo base_url().'website/dashboard/index/'.$next;?>">Next</a></li>     
						<?php endif; ?>	
					</ul>     
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