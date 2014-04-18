<?php //print_r($transactions); ?>
<?php //if($this->session->userdata("userTypeID")==2) : ?>
<div class="widget">
	<div class="widget-header"> 
		<i class="icon-list-alt"></i>
		<h3>View Transactions</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<table class="table table-striped table-bordered user-transactions">
					<thead>
						<tr>
							<th>Sr. </th>
							<th>Date </th>
							<?php if($this->uri->segment('3')=='advertiser' || $this->session->userData('userTypeID')==3) : ?>
							<th>Paiyed By</th>
							<?php else : ?>
							<th>Paiyed To</th>
							<?php endif;?>
							<!-- <th>Billy Url</th> -->
							<th>Amount</th>
							<th>Status</th>
							<!-- <th>Hits</th>
							<th>Total Costing</th>
							<th>Payment Status</th> -->
							<th class="td-actions">Actions </th>
						</tr>
						<?php 
							//echo $this->uri->segment(4);
							$sr=1;
							if($this->uri->segment(4)>1 ){
								$sr=10*$this->uri->segment(4)-9;
							}
						?>
						<?php  foreach($transactions as $item) : ?>
							<tr>
								<td><?php echo $sr; ?></td>
								<td><?php echo $item['createdDate'];?></td>
								<?php if($this->uri->segment('3')=='advertiser') : ?>
								<td><?php echo $item['userName'];?></td>
								<?php else : ?>
								<td><?php echo $item['userName'];?></td>
								<?php endif;?>
								<td><?php echo $item['amount'];?></td>
								<td><?php echo $item['status'];?></td>
								<!-- <td><?php echo $item['numberOfClicks'];?></td>
								<td><?php echo $item['amount'];?></td>
								<td><?php echo $item['status'];?></td> -->
								<td></td>
								<?php $sr++; ?>
							</tr>
						<?php endforeach; ?>
					</thead>
				</table>
				<div class="widget-header" style="text-align:right;">
					<?php 
						$mod=10; $inc=1;
						//echo "$total_records";
						if($total_records>$mod) :
							echo "Pages:";
							for($i=0;$i<$total_records;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
									
									?>
									<?php if($this->uri->segment('3')=='advertiser') : ?>
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."transaction/payment/advertiser/".$inc; ?>" ><?php echo $inc; ?></a>
									<?php else : ?>
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."transaction/payment/index/".$inc; ?>" ><?php echo $inc; ?></a>
									<?php endif; ?>
										
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
				</div><br/>
				<table class="table table-striped table-bordered">
					<tr>
						<th>Paid Amount</th>
						<th>Billable Amount</th>
						<th>Balance Amount</th>
					</tr>
					<?php foreach($paymentDetails as $item) : ?>
						<td><?php echo $item['paidAmount']; ?></td>
						<td><?php echo $item['billableAmount']; ?></td>
						<td><?php echo $item['balanceAmount']; ?></td>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
	<!-- /widget-header -->
</div>
<?php //endif; ?>