
<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-globe"></i> Ease of Use Details</b>
				<span class="pull-right">
					<a class="btn btn-success icon-globe" href="<?php echo base_url();?>monetization/dashboard/addEaseOfUse"> Add Ease of use details</a>
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
						<th>Dashboard<br/>(in %)</th>
						<th>Custom shortner</th>
						<th>Analytics</th>
						<th>Page Load Time<br/>(in seconds)</th>
						<th>Page View Per Visit</th>
						<th>Daily Time on site</th>
						<th>Bounce Rate<br/>(in %)</th>
						<th>Social Profiles</th>
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
						<?php  foreach($EaseOfUse as $monet) : ?>
						<tr>
							<td><?php echo $sr; $sr++; ?></td>
							<td><a href="<?php echo base_url();?>article/view/<?php echo $monet['articleid'];?>"><?php echo $monet["topic"] ?></a></td>
							<td><?php echo $monet["dashboard"] ?></td>
							<td><?php echo $monet["custom_shortner"] ?></td>
							<td><?php echo $monet["analytics"] ?></td>
							<td><?php echo $monet["page_load_time"] ?></td>
							
							<td><?php echo $monet['page_views_per_visit']; ?></td>
							<td><?php echo $monet['daily_time_on_site'];?> </td>
							<td><?php echo $monet['bounce_rate'];?></td>
							<td>
								<?php if($monet['facebook_url']) { ?>
								<a href="<?php echo $monet['facebook_url'];?>" target="_blank" class="social-connect tooltip-test facebook-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
								<?php } ?>
								<?php if($monet['twitter_url']) { ?>
								<a href="<?php echo $monet['twitter_url'];?>" target="_blank" class="social-connect tooltip-test twitter-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
								<?php } ?>	
								<?php if($monet['google_url']) { ?>
								<a href="<?php echo $monet['google_url'];?>" target="_blank" class="social-connect tooltip-test google-plus-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Google"><i class="fa fa-google-plus"></i></a>
								<?php } ?>	
								<?php if($monet['pinterest_url']) { ?>
								<a href="<?php echo $monet['pinterest_url'];?>" target="_blank" class="social-connect tooltip-test pinterest-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Pinterest"><i class="fa fa-pinterest"></i></a>
								<?php } ?>
								<?php if($monet['instagram_url']) { ?>
								<a href="<?php echo $monet['instagram_url'];?>" target="_blank" class="social-connect tooltip-test instagram-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Instagram"><i class="fa fa-instagram"></i></a>
								<?php } ?>
							</td>
							<td class="td-actions">
								<a class="btn btn-small btn-success" href="<?php echo base_url();?>monetization/dashboard/editEaseOfUse/<?php echo $monet['id'];?>" title="Edit" style="margin:2px;">
								<i class="btn-icon-only icon-edit"> </i>
								</a> 
								<a class="btn btn-danger btn-small" href="<?php echo base_url()."monetization/dashboard/deleteEaseOfUse/".$monet['id']; ?>" title="Delete" style="margin:2px;padding:6px 13px;">
								<i class="btn-icon-only icon-remove"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
			<?php 
				$url=base_url()."monetization/dashboard/EaseOfUse/";
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
