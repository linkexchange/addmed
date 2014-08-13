<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-list-alt"></i> Today's Stats</b></h3>
			</div>
		</div> <br/>
		<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
			<div class="panel-body">
				<div class="row">
					<?php //echo "<pre>"; print_r($unPublishedUrls); exit;?>
					<div class="col-sm-6 col-md-3">
						<div class="panel-stat3 bg-danger">
							<h2 class="m-top-none" id="userCount"> <?php if(isset($totalLinks)) echo $totalLinks; else echo "0"; ?></h2>
							<h5>Links</h5>
							<!--<i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">5% Higher than last week</span>-->
							<div class="stat-icon">
								<i class="fa fa-anchor fa-3x"></i>
							</div>
							<div class="refresh-button">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="loading-overlay">
								<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
							</div>
						</div>
					</div><!-- /.col -->
					<div class="col-sm-6 col-md-3">
						<div class="panel-stat3 bg-primary">
							<h2 class="m-top-none"><?php if(isset($publishedLinks)) echo $publishedLinks; else echo "0"; ?></h2>
							<h5>Published Links</h5>
							
							<div class="stat-icon">
								<i class="fa fa-thumbs-up fa-3x"></i>
							</div>
							<div class="refresh-button">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="loading-overlay">
								<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
							</div>
						</div>
					</div><!-- /.col -->
					<div class="col-sm-6 col-md-3">
						<div class="panel-stat3 bg-success">
							<h2 class="m-top-none" id="orderCount"><?php if(isset($totalPaidPayment)) echo $totalPaidPayment[0]['paidAmount']; else echo "0"; ?></h2>
							<h5>Paid Amount</h5>
							
							<div class="stat-icon">
								<i class="fa fa-shopping-cart fa-3x"></i>
							</div>
							<div class="refresh-button">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="loading-overlay">
								<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
							</div>
						</div>
					</div><!-- /.col -->
					<div class="col-sm-6 col-md-3">
						<div class="panel-stat3 bg-warning">
							<h2 class="m-top-none" id="visitorCount"><?php if(isset($totalPayingPayment)) echo $totalPayingPayment[0]['balanceAmount']; else echo "0"; ?></h2>
							<h5>Remaining Amount</h5>
							
							<div class="stat-icon">
								<i class="fa fa-bar-chart-o fa-3x"></i>
							</div>
							<div class="refresh-button">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="loading-overlay">
								<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
							</div>
						</div>
						<a class="btn btn-success btn-large  icon-anchor pull-right" href="<?php echo base_url();?>user/profile/add"> Add User</a>
					</div><!-- /.col -->
				</div>	
			</div>
					
			<div class="padding-md clearfix">
				<?php if($this->session->userdata('message')) { ?>
				<div id="successMessage" class="alert alert-success">
				<?php echo $this->session->userdata('message');?>
				</div>
				<?php } ?>
				<table class="table table-bordered table-condensed table-hover table-striped">
					<thead style="border:1px solid graylight;">
						<tr>
							<th>Company Name </th>
							<th>User Name</th>
							<th>Email</th>
							<th>Type</th>
							<th class="td-actions"> </th>
						</tr>
					</thead>
					<tbody style="border:1px solid graylight;">
						<?php 
						foreach($users as $user)
						{
						?>
						<tr>
							<td><?php echo $user['companyName']; ?></td>
							<td><?php echo $user['userName']; ?></td>
							<td><?php echo $user['email']; ?></td>
							<td><?php echo $user['type']; ?></td>
							<td class="td-actions">
								<a class="btn btn-small btn-success" href="<?php echo base_url()."user/profile/edit/".$user['id']; ?>"><i class="btn-icon-only icon-edit"> </i></a>
								<a class="btn btn-danger btn-small" href="<?php echo base_url()."user/profile/delete/".$user['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
				<?php if($count>(int)$this->config->item('record_limit')) { ?>
					<a class="btn btn-success btn-large  icon-anchor pull-right" href="<?php echo base_url();?>admin/dashboard/user"> More users...</a>
				<?php } ?>	
			</div><!-- /.padding-md -->
		</div>		
	</div>
</div>	