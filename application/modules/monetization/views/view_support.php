<style>
.danger {font-size: 15px; color: red;}
.success {font-size: 15px; color: green;}
</style>
<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-columns"></i> Support</b>
				<span class="pull-right">
					<a class="btn btn-success icon-columns" href="<?php echo base_url();?>monetization/support/add"> Add Support</a>
				</span>
				</h3>
			</div>
		</div> <br/>
		<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
		<!--<div class="panel-heading">
			<!--Data Table
			<span class="label label-info pull-right"><?php echo $count?> Items</span>
		</div>-->
		<?php if($this->session->flashdata("monet")) { ?>
		<div id="successMessage" class="alert alert-success">
		<?php echo $this->session->flashdata("monet"); ?>
		</div>
		<?php } ?>
		<?php if($this->session->flashdata("monet_error")) { ?>
		<div id="errorMessage" class="alert alert-danger">
		<?php echo $this->session->flashdata("monet_error"); ?>
		</div>
		<?php } ?>
		<div class="padding-md clearfix">
			<table class="table table-striped table-bordered" id="dataTable">
				<thead>
					<tr>
						<th>Sr.No.</th>
						<th>Article</th>
						<th>Support Ratings<br/>(in %)</th>
						<th>Responsive Email</th>
						<th>Responsive Skype</th>
						<th>Website Reliablity<br/>(in %)</th>
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
					<?php  foreach($support as $spt) : ?>
					<tr>
						<td><?php echo $sr; $sr++; ?></td>
						<td><a href="<?php echo base_url();?>article/view/<?php echo $spt['articleid'];?>"><?php echo $spt["topic"]; ?></a></td>
						<td><?php echo $spt["support_ratings"]; ?></td>
						<td><?php echo $spt["responsive_email"]; ?></td>
						<td><?php echo $spt["responsive_skype"]; ?></td>
						<td><?php echo $spt["website_reliability"]; ?></td>
						<td class="td-actions">
							<a class="btn btn-small btn-success" href="<?php echo base_url().'monetization/support/edit/'.$spt['id'];?>" title="Edit" style="margin:2px;">
							<i class="btn-icon-only icon-edit"> </i>
							</a>
							<a class="btn btn-danger btn-small" href="<?php echo base_url()."monetization/support/delete/".$spt['id']; ?>" title="Delete" style="margin:2px;padding:6px 13px;">
							<i class="btn-icon-only icon-remove"></i>
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php 
				$url=base_url()."monetization/support/index/";
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
