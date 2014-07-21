<?php if($this->uri->segment(4) && isset($tempID)) : ?>
<script>
	$(document).ready(function(){
		var tid=<?php echo $tempID; ?>;
		var page=<?php echo $this->uri->segment(5); ?>;
		if(tid){
			 $.ajax({
				url:base_url+"pages/dashboard/getTemplatePages/"+tid+"/"+page,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					//alert(result);
					$(".setData").html(result);
			}});
			}
			else
			{
				$(".setData").html("");
			}
	});
</script>
<?php endif; ?>
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
						<h3><b><i class="icon-paperclip"></i> View Pages</b>
						<span class="pull-right">
							<?php if($this->session->userdata("userTypeID")==3) : ?>
								<a class="btn btn-success icon-anchor" href="<?php echo base_url();?>pages/dashboard/add"> Add Page</a>
							<?php endif; ?>
						</span></h3>
					</div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"><?php echo $this->session->flashdata('message');?></div>
					<div class="panel-body">
						<form class="form-inline no-margin" id="frm_viewByBlog" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<table>
								<tr>
								<td>
								<label><h4>Select Website : </h4></label>
								<select id="templateID" name="templateID" class="form-control validate[required]" onchange="getDetails(this.value);">
									<option value="">Please Select</option>
									<?php foreach($templates as $template) : ?>
										<?php if((isset($tempID) && $template['id']==$tempID) || $template['id']==$this->uri->segment(4)) : ?>
											<option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
										<?php else : ?>
											<option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
								</td>
								</tr>
								</table>	
							</div><!-- /form-group -->
						</form>
					</div>
					<div class="padding-md clearfix">
					<div class="setData">
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>Sr. </th>
									<th>Page Title</th>
									<th>Website Name</th>
									<th>Created Date</th>
									<th class="td-actions">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									//echo $this->uri->segment(4);
									$sr=1;
									if($this->uri->segment(5)>1 ){
										$sr=10*$this->uri->segment(5)-9;
									}
									$this->load->model('article');
								?>
								<?php  foreach($pages as $item) : ?>
									<tr>
										<td><?php echo $sr; $sr++; ?></td>
										<td><?php echo $item['title']; ?></td>
									   
										<td><?php echo $item['name']; ?></td>
										<td><?php echo $item['createdDate']; ?></td>
										<td>
											<a class="btn btn-small btn-success" href="<?php echo base_url()."pages/dashboard/edit/".$item['id']; ?>" title="Edit Post : <?php echo $item['title']; ?>">
												<i class="btn-icon-only icon-edit"> </i>
											</a>
											<a class="btn btn-danger btn-small" href="<?php echo base_url()."pages/dashboard/delete/".$item['id']; ?>">
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
							
							<li class="<?php if($inc==$this->uri->segment(5))  echo "active"; else if(!($this->uri->segment(5)) && $inc==1)  echo "active";  ?>">
								<a href="<?php echo base_url()."pages/dashboard/index/0/".$inc; ?>"><?php echo $inc;?></a>
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
					</div>	
			</div><!-- /.padding-md -->
		</div>	
	</div><!-- /.padding-md -->
</div>
<script>
	function getDetails(lid){
			//alert(lid);
			if(lid){
			 $.ajax({
				url:base_url+"pages/dashboard/getTemplatePages/"+lid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					//alert(result);
					$(".setData").html(result);
			}});
			}
			else
			{
				window.location=base_url+"pages/dashboard";
			}
			//pageactive(pid);
		}
</script>