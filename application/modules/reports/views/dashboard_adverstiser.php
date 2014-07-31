<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-list-alt"></i> View Report of Advertisers</b></h3>
			</div>
		</div> <br/>
		<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
			<div class="padding-md clearfix">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>Sr.</th>							
							<th>Advertiser Name</th>
							<th>Published Links</th>
							<th>Total Hits</th>
							<th>Paid Amount</th>
							<th>Remaining Amount</th>
							<th>Total Amount</th>
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
					</tbody>	
				</table>
                                <div class="panel-footer clearfix">
                                        <?php 
                                            $count=$UrlCount;
                                            $url=base_url()."reports/dashboard/advertiser/";
                                            if($this->uri->segment(4))
                                                $currentPage=$this->uri->segment(4);
                                            else
                                                $currentPage=1;
                                            $parameters=array();
                                            pagination($url,$parameters,$count,$currentPage);
                                        ?>
                                </div>
			</div><!-- /.padding-md -->
		</div>		
	</div>
</div>	