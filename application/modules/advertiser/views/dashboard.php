
<div class="widget widget-nopad">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3> Advertiser Stats</h3>
	</div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="widget big-stats-container">
			<div class="widget-content">
				<div class="cf" id="big_stats">
					<div class="stat"> <i class="icon-anchor"></i> <span class="value"><?php echo $url_count; ?> </span><br/>Links </div>
					<!-- .stat -->
					
					<div class="stat"> <i class="icon-thumbs-up-alt"></i> <span class="value"><?php echo $pubUrlCount; ?></span> <br/>Published Links </div>
					<!-- .stat -->
					
					<div class="stat"> <i class="icon-twitter-sign"></i> <span class="value"><?php if(isset($totalPaidPayment)) echo $totalPaidPayment[0]['paidAmount']; else echo "0"; ?></span><br/>Paid Amount  </div>
					<!-- .stat -->
					
					<div class="stat"> <i class="icon-bullhorn"></i> <span class="value"><?php echo $TotalRamainingPayment; ?></span> <br/> Remaining Amount  </div>
					<!-- .stat --> 
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
