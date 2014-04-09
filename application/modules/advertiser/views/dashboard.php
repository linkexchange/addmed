
<div class="widget widget-nopad">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3> Advertiser Stats</h3>
	</div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="widget big-stats-container">
			<div class="widget-content">
				<div class="cf" id="big_stats">
					<div class="stat"> <i class="icon-anchor"></i> <span class="value"><?php echo $url_count; ?> </span> </div>
					<!-- .stat -->
					
					<div class="stat"> <i class="icon-thumbs-up-alt"></i> <span class="value">423</span> </div>
					<!-- .stat -->
					
					<div class="stat"> <i class="icon-twitter-sign"></i> <span class="value">922</span> </div>
					<!-- .stat -->
					
					<div class="stat"> <i class="icon-bullhorn"></i> <span class="value">25%</span> </div>
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
