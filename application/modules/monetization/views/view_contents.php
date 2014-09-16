
<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-foursquare"></i> Contents</b>
				<span class="pull-right">
					<a class="btn btn-success icon-foursquare" href="<?php echo base_url();?>monetization/dashboard/addContents"> Add Contents</a>
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
						<th>Ratings<br/>(in %)</th>
						<th>No of Articles</th>
						<th>Content Requests</th>
						<th>Article Quality<br/>(in %)</th>
						<th>New Contents</th>
						<th>Target Audiences</th>
						<th>Contact Email</th>
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
						<?php  foreach($contents as $monet) : ?>
						<tr>
							<td><?php echo $sr; $sr++; ?></td>
							<td><a href="<?php echo base_url();?>article/view/<?php echo $monet['articleid'];?>"><?php echo $monet["topic"] ?></a></td>
							<td><?php echo $monet["ratings"] ?></td>
							<td><?php echo $monet["no_of_articles"] ?></td>
							<td><?php echo $monet["content_requests"] ?></td>
							<td><?php echo $monet["article_quality"] ?></td>
							
							<td><?php echo $monet['new_contents']; ?></td>
							<td><?php echo $monet['target_audience'];?> </td>
							<td><?php echo $monet['contact_email'];?> </td>
							
							<td class="td-actions">
								<a class="btn btn-small btn-success" href="<?php echo base_url().'monetization/dashboard/editContents/'.$monet['id'];?>" title="Edit" style="margin:2px;">
								<i class="btn-icon-only icon-edit"> </i>
								</a>
								<a class="btn btn-danger btn-small" href="<?php echo base_url()."monetization/dashboard/deleteContents/".$monet['id']; ?>" title="Delete" style="margin:2px;padding:6px 13px;">
								<i class="btn-icon-only icon-remove"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
			<?php 
				$url=base_url()."monetization/dashboard/contents/";
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
