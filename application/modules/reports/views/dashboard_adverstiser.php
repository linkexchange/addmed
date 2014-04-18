<div class="widget">
	<div class="widget-header"> 
		<i class="icon-list-alt"></i>
		<h3>View Report By Publisher</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<?php //echo "<pre>"; print_r($Users); echo "</pre>";?>
				<div id="ajax-reports">
					<table class="table table-striped table-bordered user-transactions">
						<thead>
							<tr>
								<th>Sr.</th>							
								<th>Publisher Name</th>
								<th>Published Links</th>
								<th>Total Hits</th>
								<th>Paid Amount</th>
								<th>Remaining Amount</th>
								<th>Total Amount</th>
							</tr>
							<?php 
								//echo $this->uri->segment(4);
								$sr=1;
								if($this->uri->segment(4)>1 ){
									$sr=10*$this->uri->segment(4)-9;
								}
							?>
							<?php $this->load->model("clicksdetail"); ?>
							<?php $this->load->model("url"); ?>
							<?php foreach($Users as $item) : ?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td><?php echo $item['userName']?></td>
								<td>
									<?php $urls=$this->url->getTotalPublishedAdvertiserLinks($item['userID']); ?>
									<?php if($urls) echo $urls; else echo "0"; ?>
								</td>
								<td>
									<?php $clecks=$this->clicksdetail->getTotalHitsOfAdvertiserLinks($item['userID']); ?>
									<?php if(isset($clecks[0]['numberOfClicks'])) echo $clecks[0]['numberOfClicks']; else echo "0"; ?>
								</td>
								<td><?php echo $item['paidAmount']; ?></td>
								<td>
									<?php //echo $item['balanceAmount']?>
									<?php if($item['billableAmount']>$item['paidAmount']) : ?>
									<?php echo ($item['billableAmount']-$item['paidAmount']); ?>
									<?php else : ?>
									<?php echo "0"; ?>
									<?php endif; ?>
								</td>
								<td><?php echo $item['billableAmount']; ?></td>
							</tr>
							<?php $sr++; ?>
							<?php endforeach; ?>
						</thead>
					</table>
					<div class="widget-header" style="text-align:right;">
						<?php 
							$mod=10; $inc=1;
							//echo "$total_records";
							if($UrlCount>$mod) :
								echo "Pages:";
								for($i=0;$i<$UrlCount;$i++) :
									if(($i%$mod)==0) :
										//echo $inc;
									?>
										<?php if($this->uri->segment('3')=='advertiser') : ?>
											<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."reports/dashboard/advertiser/".$inc."/".$startDate."/".$endDate; ?>" ><?php echo $inc; ?></a>
										<?php else : ?>
											<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."reports/dashboard/advertiser/".$inc."/".$startDate."/".$endDate; ?>" ><?php echo $inc; ?></a>
										<?php endif; ?>
											
										<?php
										$inc++;
									endif;
								endfor;
							endif;
						?> &nbsp;
					</div>
				</div>
			</div>
		</div>
	</div>
</div>