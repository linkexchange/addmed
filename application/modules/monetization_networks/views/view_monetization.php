
<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-globe"></i> Monetization</b></h3>
			</div>
		</div> <br/>
		
		<div class="padding-md clearfix">
			<div class="panel panel-default table-responsive">
				<div class="panel-heading">
					Data Table
					<span class="label label-info pull-right"><?php echo $count;?> records</span>
				</div>
				<div class="padding-md clearfix">
					<table class="table table-striped table-bordered" id="dataTable">
				<thead>
					<tr>
						<th>No</th>
						<th>Network</th>
						<th>Type of Network</th>
						<th>Estimated Rate of Payment</th>
						<th>payments</th>
						<th>Article</th>
						<th>sign-Up Link</th>
						<th>Ratings</th>
						<th>Created Date</th>
					</tr>
				</thead>
				<tbody>
						<?php 
						//echo $this->uri->segment(4);
							$sr=1;
							if($this->uri->segment(3)>1 ){
								$sr=(int)$this->config->item('record_limit')*$this->uri->segment(3)-((int)$this->config->item('record_limit')-1);
							}
						?>
						<?php  foreach($monetization as $monet) : ?>
						<tr>
							<td><?php echo $sr; $sr++; ?></td>
							<td><?php echo $monet["network"] ?></td>
							<td><?php echo $monet["type_of_network"] ?></td>
							<td><?php echo $monet["estimated_rate_of_payment"] ?></td>
							<td><?php echo $monet["payments"] ?></td>
							<td><a href="<?php echo base_url();?>article/view/<?php echo $monet['articleid'];?>"><?php echo $monet["topic"] ?></a></td>
							
							<td><?php echo $monet['sign_up_link']; ?></td>
							<td><?php echo $monet['ratings'];?> %</td>
							<td><?php echo $monet['created_date'];?></td>
						</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
			<?php 
				$url=base_url()."monetization_networks/index/";
				if($this->uri->segment(3))
				$currentPage=(int)$this->uri->segment(3);
				else
				$currentPage=1;
				$parameters=array();
				pagination($url,$parameters,$count,$currentPage);
			?>	
			</div><!-- /.padding-md -->
			</div><!-- /panel -->
			
		</div>
		</div>		
	</div>
	
