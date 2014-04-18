		<div id="loading" class="alert alert-success" style="display:none">Wait Data is loading</div>
		<div class="widget widget-table action-table">
			<div class="widget-header"> <i class="icon-th-list"></i>
				<h3>
					<?php
						if($this->session->userdata("userTypeID")==3)
							{
								echo "Accepted Links";
							}
							else if($this->session->userdata("userTypeID")==2)
							{
								echo "Published Links";
							}
					?>
				</h3>
			</div>
			<!-- /widget-header -->
			<?php //echo "<pre>"; print_r($publishedUrls); echo "</pre>"; ?>
			<div class="widget-content accepted">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Link </th>
							<!-- <?php 
								if($this->session->userdata("userTypeID")==3) 
								{
							?>
							<th>Bitly URL</th>
							<?php 
								}
							?> -->
							<th>Pay Per link</th>
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
							<td><?php echo $url['url']; ?></td>
							<!-- <?php 
								if($this->session->userdata("userTypeID")==3) 
								{
							?>
							<td><?php echo $url['billyUrl']; ?></td>
							<?php 
								}
							?> -->
							<td><?php echo $url['payPerLink']; ?></td>
							<td><?php echo $url['userName']; ?></td>
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
								if(!($url['billyUrl'])){
							?>
								<a class="btn btn-success btn-small" href="<?php echo base_url()."link/edit_pub/".$url['id']; ?>"><i class="icon-anchor btn-icon-only" title="Add Bitly URL"> </i></a>
								<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/pubremove/".$url['id']; ?>"><i class="btn-icon-only icon-remove" title="Remove"> </i></a>
								<?php 
								}
								else
								{
								?>
								<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit_pub/".$url['id']; ?>" ><i class="btn-icon-only icon-edit" title="Edit Bitly Link"> </i></a>
								<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/pubremove/".$url['id']; ?>"><i class="btn-icon-only icon-remove" title="Remove"> </i></a>
								<?php 
									}
								?>
							<?php
							}
							?>
							</td>
						</tr>
						<?
						}
						?>
					</tbody>
				</table>
				<?php if($this->session->userdata("userTypeID")==3) : ?>
				<div class="widget-header navigation" style="text-align:right;">
					<?php 
						$mod=10; $inc=1;
						if($url_count>$mod) :
							echo "Pages:";
							for($i=0;$i<=$url_count;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
									
									?>
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==1) echo "page-active"; ?>" href="javascript:void(0)" onclick="ajaxPageNav(<?php echo $inc; ?>)" ><?php echo $inc; ?></a>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp; 
				</div>
				<?php elseif($this->session->userdata("userTypeID")==2) : ?>
				<div class="widget-header navigation" style="text-align:right;">
					<?php 
						$mod=10; $inc=1;
						if($pubUrlCount>$mod) :
							echo "Pages:";
							for($i=0;$i<=$pubUrlCount;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
									
									?>
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==1) echo "page-active"; ?>" href="javascript:void(0)" onclick="ajaxPageNav(<?php echo $inc; ?>)" ><?php echo $inc; ?></a>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
				</div>
				<?php endif; ?>
			</div>
			<!-- /widget-content --> 
		</div>
		<?php if($this->session->userdata("userTypeID")==3) : ?>
		<script>
		function ajaxPageNav(pid){
			
			//alert(pid);
			
			 $.ajax({
				url:base_url+"publisher/dashboard/getpublisherurls/"+pid,
				beforeSend: loadStartPub,
				complete: loadStopPub,
				success:function(result){
					//alert(result);
					$(".accepted table").html(result);
			}});
			pageactive(pid);
		}
		</script>
		<?php elseif($this->session->userdata("userTypeID")==2) : ?>
		<script>
		function ajaxPageNav(pid){
			//alert(pid);
			 $.ajax({
				url:base_url+"advertiser/dashboard/getpublishedurls/"+pid,
				beforeSend: loadStartPub,
				complete: loadStopPub,
				success:function(result){
					//alert(result);
					$(".accepted table").html(result);
			}});
			pageactive(pid);
		}
		</script>
		<?php endif; ?>
		<script>
		function pageactive(pid){
			//alert(pid);
			$('.navigation a').removeClass('page-active');
			$('.navigation .page-'+pid).addClass('page-active');
		}
		function loadStartPub(){
			$("#loading1").show();
		}
		function loadStopPub(){
			$("#loading1").hide();
		}
		</script>

