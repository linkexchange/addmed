<div id="main-container">
	<div class="padding-md">
		<h3>Advertiser's Stats</h3>
		<div class="row">
			<?php //echo "<pre>"; print_r($unPublishedUrls); exit;?>
			<div class="col-sm-6 col-md-3">
				<div class="panel-stat3 bg-danger">
					<h2 class="m-top-none" id="userCount"><?php echo $url_count; ?></h2>
					<h5>Published Links</h5>
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
		<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="border:1px solid lightgray;">
								<h4><b> <i class="icon-th-list"></i> Published Links</b> </h4>
							</div>
							
							<table class="table table-hover table-bordered table-striped">
								<thead>
									<tr>
										<th class="link">Link </th>
										<!-- <?php 
											if($this->session->userdata("userTypeID")==3) 
											{
										?>
										<th>Bitly URL</th>
										<?php 
											}
										?> -->
										<th>Pay Per link</th>
										<th>Title</th>
										<th>
										<?php
										if($this->session->userdata("userTypeID")==2)
										{
											echo "Publisher";
										}
										else if($this->session->userdata("userTypeID")==3)
										{
											echo "Advertiser";
										}
										?></th>
										<th>Hits</th>
										<th>Total Costing</th>
										<th class="td-actions"> </th>
									</tr>
								</thead>
								<?php $this->load->model("clicksdetail"); ?>
								<tbody>
								<?php
									foreach($publishedUrls as $url)
									{
									?>
									<tr>
										<td>
											<?php $str=$url['url']; echo wordwrap($str,30,"<br>\n",TRUE); ?>
											<?php //echo $url['url']; ?>
										</td>
										<!-- <?php 
											if($this->session->userdata("userTypeID")==3) 
											{
										?>
										<td><?php echo $url['billyUrl']; ?></td>
										<?php 
											}
										?> -->
										<td><?php echo $url['payPerLink']; ?></td>
										<td><?php echo $url['title']; ?></td>
										
										<td><?php $this->load->model("user");
												if($this->session->userdata("userTypeID")==2)
												{
													$users=$this->user->getPublishersByLinkID($url['id']);
													$userName=""; 
													$i=0;
													foreach($users as $user)
													{
														if($i>0)
															$userName .= ',<br/>'.$user['userName'];
														else
															$userName .= $user['userName'];
														$i++;
													}
													echo $userName; 
												}
												else if($this->session->userdata("userTypeID")==3)
												{
													$users=$this->user->getUserByID($url['advertiserID']);
													echo $users[0]['userName'];
												}
												?>
										</td>			
										<td>
											<?php $clicks=$this->clicksdetail->getTotalHitsByLinkId($url['id']); ?>
											<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; else echo "0"; ?>
										</td>
										<td>
											<?php if($this->session->userData('userTypeID')==3) : ?>
												<?php $payment=$this->clicksdetail->getTotalPublisherPaymentForLinkId($url['id']);?>
												<?php if(isset($payment[0]['publisherPayment']))  echo round($payment[0]['publisherPayment'], 2); else echo "0"; ?>
											<?php elseif($this->session->userData('userTypeID')==2) : ?>
												<?php $payment=$this->clicksdetail->getTotalAdvertiserPaymentForLinkId($url['id']);?>
												<?php if(isset($payment[0]['advertiserPaynment']))  echo round($payment[0]['advertiserPaynment'], 2); else echo "0"; ?>
											<?php endif; ?>
										</td>
										<td class="td-actions">
										<?php
										if($this->session->userdata("userTypeID")==2)
										{
										?>
											<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
										<?php
										}
										elseif($this->session->userdata("userTypeID")==3 ){
											if(!($url['bitlyURL'])){
										?>
											<a class="btn btn-success btn-small" href="<?php echo base_url()."link/edit_pub/".$url['publishedID']; ?>"><i class="icon-anchor btn-icon-only" title="Add Bitly URL"> </i></a>
											<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/pubremove/".$url['publishedID']; ?>"><i class="btn-icon-only icon-remove" title="Remove"> </i></a>
											<?php 
											}
											else
											{
											?>
											<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit_pub/".$url['publishedID']; ?>" ><i class="btn-icon-only icon-edit" title="Edit Bitly Link"> </i></a>
											<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/pubremove/".$url['publishedID']; ?>"><i class="btn-icon-only icon-remove" title="Remove"> </i></a>
											<?php 
												}
											?>
										<?php
										}
										?>
										</td>
									</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div><!-- /panel -->
					</div>
				<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="border:1px solid lightgray;">
								<h4> <b> <i class="icon-th-list"></i> Un-Published Links</b> </h4>
							</div>
							<!--<div class="panel-body" style="border:1px solid lightgray;">
								Some default panel content here.
							</div>-->
							<table class="table table-hover table-striped table-bordered">
								<thead>
									<tr>
										<th class="tr_link" width="150px">Link</th>
										<th>Pay Per link</th>
										<th>Title</th>
										<!--<th>Admin Commision <br/>(In %)</th>-->
										<th class="td-actions"> </th>
									</tr>
								</thead>
								<tbody>
								<?php
									foreach($unPublishedUrls as $url)
									{
									?>
									<tr>
										<td class="tr_link">
											<?php $str=$url['url']; echo wordwrap($str,35,"<br>\n",TRUE); ?>
											<?php //echo $url['url']; ?>
										</td>
										<td><?php echo $url['payPerLink']; ?></td>
										<td><?php echo $url['title'];?></td>
										<!--<td><?php echo $url['percentage']; ?></td>-->
									 
										<td class="td-actions">
											<?php 
											if($this->session->userdata("userTypeID")==2)
											{
											?>
												<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
												<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/delete/".$url['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
											<?php
											}
											else
											{
											?>
												<a class="btn btn-success btn-small" href="<?php echo base_url()."link/acceptLink/".$url['id']; ?>"><i class="btn-icon-only icon-check-empty" title="Accept"> </i></a>
											<?php
											}
											?>
										</td>
									</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div><!-- /panel -->
					</div>
				
			
		</div>
	</div>
</div>
		
		
	
