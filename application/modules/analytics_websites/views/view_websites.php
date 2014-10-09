
<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-file"></i> Websites Detail</b>
				<span class="pull-right">
					<a href="<?php echo base_url();?>analytics_websites/dashboard/add" class="btn btn-success icon-globe"> Add New Website</a>
				</span>
				</h3>
			</div>
		</div> <br/>
		<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
		
		<?php if($this->session->flashdata("monet")) { ?>
		<div id="successMessage" class="alert alert-success">
		<?php echo $this->session->flashdata("monet"); ?>
		</div>
		<?php } ?>
		<div class="padding-md clearfix">
			<table class="table table-striped table-bordered" id="dataTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Website</th>
						<th>Website Logo</th>
						<th>Website Screenshot</th>
						<th>Created Date</th>
						<th>Last Updated On</th>
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
						<?php  foreach($website as $monet) : ?>
						<tr>
							<td><?php echo $sr; $sr++; ?></td>
							<td><?php echo $monet["website_name"] ?></td>
							<td>
									<?php if($monet['logo']) : ?>
									<img src="<?php echo base_url().'uploads/website_logo/'.$monet['logo']; ?>" width="100px" height="auto" />
									<?php endif; ?>
						        </td>
							<td>
									<?php if($monet['screen_shot']) : ?>
									<img src="<?php echo base_url().'uploads/website_screenshots/'.$monet['screen_shot']; ?>" width="100px" height="auto" />
									<?php endif; ?>
							</td>
							<td><?php echo $monet['created_date'];?></td>
							<td>
								<?php if($monet['updated_date']!="0000-00-00") : ?>
									<?php echo $monet['updated_date']; ?>
								<?php endif; ?>
							</td>
							<td class="td-actions">
								<a class="btn btn-small btn-success" href="<?php echo base_url();?>analytics_websites/dashboard/edit/<?php echo $monet['id'];?>" title="Edit" style="margin:2px;">
								<i class="btn-icon-only icon-edit"> </i>
								</a>
								<a class="btn btn-danger btn-small" href="<?php //echo base_url()."analytics_websites/dashboard/delete/".$monet['id']; ?>" title="Delete" style="margin:2px;padding:6px 13px;">
								<i class="btn-icon-only icon-remove"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
			<?php 
				$url=base_url()."analytics_websites/dashboard/index/";
				if($this->uri->segment(4))
				$currentPage=(int)$this->uri->segment(4);
				else
				$currentPage=1;
				$parameters=array();
				pagination($url,$parameters,$count,$currentPage);
			?>
		</div>
		</div>		
	</div>
</div>	
