<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<div class="widget-header"> <i class="icon-list-alt"></i>
							<h3> Publisher Stats</h3>
						</div>
						<!-- /widget-header -->
						<div class="widget-content">
							<div class="widget big-stats-container">
								<div class="widget-content">
									<div class="cf" id="big_stats">
										<div class="stat"> <i class="icon-anchor"></i> <span class="value"><?php echo $url_count; ?></span><br/> Accepted Links</div>
										<!-- .stat -->
										
										<div class="stat"> <i class="icon-thumbs-up-alt"></i> <span class="value"><?php if(isset($totalHits[0]['numberOfClicks']) ) echo $totalHits[0]['numberOfClicks']; else echo "0"; ?></span><br/>Total Hits  </div>
										<!-- .stat -->
										
										<div class="stat"> <i class="icon-twitter-sign"></i> <span class="value"><?php if(isset($totalPaidPayment[0]['paidAmount'])) echo $totalPaidPayment[0]['paidAmount']; else echo "0"; ?></SPAN><br/>Paid Amount </div>
										<!-- .stat -->
										
										<div class="stat"> <i class="icon-bullhorn"></i> <span class="value"><?php if(isset($TotalRamainingPayment)) echo $TotalRamainingPayment; else echo "0"; ?></span> <br/> Remaining Amount  </div>
										<!-- .stat --> 
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- table start -->
<div class="row"> 
	<div class="span6"> 
		<?php 
			$this->load->view('link/view_published_links');
		?>
	</div>
	<div class="span6">
		<?php
			$this->load->view("link/view_unpublished_link")
		?>
	</div>
</div>
<!-- table End -->