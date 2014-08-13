		<div id="main-container">
			<div class="padding-md">
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<div class="panel-stat3 bg-danger">
							<h2 class="m-top-none" id="userCount"><?php echo $url_count; ?></h2>
							<h5>Accepted Links</h5>
							<!--<i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">5% Higher than last week</span>-->
							<div class="stat-icon">
								<i class="fa fa-user fa-3x"></i>
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
							<h2 class="m-top-none"><?php if(isset($totalHits[0]['numberOfClicks']) ) echo $totalHits[0]['numberOfClicks']; else echo "0"; ?></h2>
							<h5>Total Hits</h5>
							
							<div class="stat-icon">
								<i class="fa fa-hdd-o fa-3x"></i>
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
							<h2 class="m-top-none" id="orderCount"><?php if(isset($totalPaidPayment[0]['paidAmount'])) echo $totalPaidPayment[0]['paidAmount']; else echo "0"; ?></h2>
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
						<div class="panel-stat3 bg-success">
							<h2 class="m-top-none" id="visitorCount"><?php if(isset($TotalRamainingPayment)) echo $TotalRamainingPayment; else echo "0"; ?></h2>
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
					</div><!-- /.col -->
				</div>
			</div>
			<div class="panel-group">
				<div class="panel panel-default">
					<?php if($this->session->flashdata("community")) {?>
					<div id="successMessage" class="alert alert-success">
					<?php echo $this->session->flashdata("community");?>
					</div>
					<?php } ?>
					<div class="panel-body">
						<h3>Communities</h3>
						<table>
							<?php for($i=0;$i<count($communities);$i++){?>
							<tr> <td>
							<a href="<?php echo base_url();?>publisher/frontend/description/<?php echo $communities[$i]['id'];?>">
							<h3><?php echo $communities[$i]['community_title'];?></h3>
							</a>
							<img src="<?php echo base_url();?>uploads/community_images/<?php echo $communities[$i]['image'];?>" width="60px" 
							height="60px" style="float:left;margin-right:3px;">	
							<p style="text-align:justify">
							<?php 	$str = substr(strip_tags($communities[$i]['community_description']),0,800);
									echo "&nbsp;&nbsp;".substr($str,0,strrpos($str,'.'))."..."; ?>
							<a class="btn" href="<?php echo base_url();?>publisher/frontend/description/<?php echo $communities[$i]['id'];?>">[Read more]</a>
							</p>	
							</td>
							</tr>
							<tr>
								<td>
								<span style="float:left;"><i class="icon-user"></i> Created By: 
								<?php echo $communities[$i]['userName'];?></span> 
								<span style="float:right;"><i class="icon-time"></i>Created Date: 
								<?php echo $communities[$i]['created_date'];?></span></td>
							</tr>
							<tr><td><hr></td></tr>
							<?php } ?>
						</table>
					</div>
				</div><!-- /panel -->
			</div>
		</div>
	</div>
		
	
