<style>
.danger {font-size: 15px; color: red;}
.success {font-size: 15px; color: green;}
</style>
<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-money"></i> Payouts</b>
				<span class="pull-right">
					<a class="btn btn-success icon-money" href="<?php echo base_url();?>monetization/payouts/add"> Add Payouts</a>
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
						<th>No of Publishers</th>
						<th>Diversified Earnings</th>
						<th>Premium Campaigns</th>
						<th>Payment Methods</th>
						<th>Sign-Ups</th>
						<th>Referral Programs</th>
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
					<?php  foreach($payouts as $payout) : ?>
					<tr>
						<td><?php echo $sr; $sr++; ?></td>
						<td><a href="<?php echo base_url();?>article/view/<?php echo $payout['articleid'];?>"><?php echo $payout["topic"]; ?></a></td>
						<td><?php echo $payout["payout_ratings"]; ?></td>
						<td><?php echo $payout["no_of_publishers"]; ?></td>
						<td><?php echo $payout["diversified_earnings"]; ?></td>
						<td><?php echo $payout["premium_campaigns"]; ?></td>
						<td width="15%">
						<?php 
							if(strpos($payout['payment_methods'],',')>0) 
							{ 
								$payments = explode(',',$payout['payment_methods']);
								$methods = array("paypal","wire transfer","google wallet","payoneer");
							}
							else 
							{
								$payments = array($payout['payment_methods']);
							}	
							if(in_array("paypal",$payments))
							{			
								echo '<i class="fa fa-check-square-o"></i>';	
								echo '&nbsp;<b class="success">Paypal</b> <br/>';
							}
							else
							{	
								echo '<i class="fa fa-times"></i>';
								echo '&nbsp;<b class="danger">Paypal</b> <br/>';
							}
							
							
							if(in_array("wire transfer",$payments))
							{			
								echo '<i class="fa fa-check-square-o"></i>';	
								echo '&nbsp;<b class="success">Wire transfer</b> <br/>';
							}
							else
							{	
								echo '<i class="fa fa-times"></i>';
								echo '&nbsp;<b class="danger">Wire transfer</b> <br/>';
							}
							
						
							if(in_array("google wallet",$payments))
							{			
								echo '<i class="fa fa-check-square-o"></i>';	
								echo '&nbsp;<b class="success">Google Wallet</b> <br/>';
							}
							else
							{	
								echo '<i class="fa fa-times"></i>';
								echo '&nbsp;<b class="danger">Google Wallet</b> <br/>';
							}
							
							
							if(in_array("payoneer",$payments))
							{			
								echo '<i class="fa fa-check-square-o"></i>';	
								echo '&nbsp;<b class="success">Payoneer</b>';
							}
							else
							{	
								echo '<i class="fa fa-times"></i>';
								echo '&nbsp;<b class="danger">Payoneer</b>';
							}
						?>
						</td>
						<td><?php echo $payout['sign_ups'];?> </td>
						<td><?php echo $payout['referral_programs'];?> </td>
						
						<td class="td-actions">
							<a class="btn btn-small btn-success" href="<?php echo base_url().'monetization/payouts/edit/'.$payout['id'];?>" title="Edit" style="margin:2px;">
							<i class="btn-icon-only icon-edit"> </i>
							</a>
							<a class="btn btn-danger btn-small" href="<?php echo base_url()."monetization/payouts/delete/".$payout['id']; ?>" title="Delete" style="margin:2px;padding:6px 13px;">
							<i class="btn-icon-only icon-remove"></i>
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php 
				$url=base_url()."monetization/payouts/index/";
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
