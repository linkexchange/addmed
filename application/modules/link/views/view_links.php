		<?php if($this->session->userdata("userTypeID")==2) : ?>
		<div class="widget"> 
			<div class="span12 offset10"> 
				<button class="btn btn-primary btn-large  icon-anchor" onclick="javascript:goto('link/add')"> Add Link</button>
			</div>
		</div>
		<?php endif; ?>
		<div class="widget widget-table action-table">
			<div class="widget-header"> <i class="icon-th-list"></i>
				<h3>Links</h3>
			</div>
				<?php //echo "<pre>"; print_r($urls); echo "</pre>"; ?>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Link </th>
							<?php
							if($this->session->userdata("userTypeID")==3 || $this->session->userdata("userTypeID")==1)
							{
							?>
							<th>Billy Url</th>
							<?php
							}
							?>
							<th>Pay Per link</th>
							<?php
							if($this->session->userdata("userTypeID")==3) : ?>
							<th>Advertiser</th>
							<?php elseif($this->session->userdata("userTypeID")==2) : ?>
							<th>Publisher</th>
							<?php elseif($this->session->userdata("userTypeID")==1) : ?>
							<th>Advertiser</th>
							<th>Publisher</th>
							<?php endif;?>
							<th>Hits</th>
							<th>Total Costing</th>
							<th class="td-actions"> </th>
						</tr>
					</thead>
					<?php $this->load->model("clicksdetail"); ?>
					<?php $this->load->model("user"); ?>
					<tbody>
					<?php
						foreach($urls as $url)
						{
						?>
						<tr>
							<td><?php echo $url['url']; ?></td>
							<?php
							if($this->session->userdata("userTypeID")==3 || $this->session->userdata("userTypeID")==1)
							{
							?>
							<td><?php echo $url['billyUrl']; ?></td>
							<?php
							}
							?>
							<td><?php echo $url['payPerLink']; ?></td>
							<td><?php if(isset($url['userName'])) echo $url['userName']; ?></td>
							<?php if($this->session->userData('userTypeID')==1) : ?>
								<td>
									<?php if($url['publisherID']!=0) : ?>
										<?php $user=$this->user->getUserByID($url['publisherID']); ?>
										<?php echo $user[0]['userName']; ?>
									<?php endif; ?>
								</td>
							<?php endif; ?>
							<td>
								<?php if($this->session->userData('userTypeID')==3) : ?>
									<?php if($url['userName']) : ?>
										<?php $clicks=$this->clicksdetail->getTotalHitsByLinkId($url['id']); ?>
										<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; else echo "0"; ?>
									<?php endif; ?>
								<?php elseif($this->session->userData('userTypeID')==2) : ?>
									<?php if($url['userName']) : ?>
										<?php $clicks=$this->clicksdetail->getTotalHitsByLinkId($url['id']); ?>
										<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; elseif($url['userName']) echo "0"; ?>
									<?php endif; ?>
								<?php elseif($this->session->userData('userTypeID')==1) : ?>
									<?php if($url['publisherID']!=0) : ?>
										<?php $clicks=$this->clicksdetail->getTotalHitsByLinkId($url['id']); ?>
										<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; else echo "0"; ?>
									<?php endif; ?>
								<?php endif; ?>
								
							</td>
							<td>
								<?php if($this->session->userData('userTypeID')==3) : ?>
									<?php $payment=$this->clicksdetail->getTotalPublisherPaymentForLinkId($url['id']);?>
									<?php if(isset($payment[0]['publisherPayment']))  echo round($payment[0]['publisherPayment'], 2); else echo "0"; ?>
								<?php elseif($this->session->userData('userTypeID')==2) : ?>
									<?php if($url['userName']) : ?>
										<?php $payment=$this->clicksdetail->getTotalAdvertiserPaymentForLinkId($url['id']);?>
										<?php if(isset($payment[0]['advertiserPaynment']))  echo round($payment[0]['advertiserPaynment'], 2); elseif($url['userName']) echo "0"; ?>
									<?php endif; ?>
								<?php elseif($this->session->userData('userTypeID')==1) : ?>
									<?php if($url['publisherID']!=0) : ?>
										<?php $payment=$this->clicksdetail->getTotalAdvertiserPaymentForLinkId($url['id']);?>
										<?php if(isset($payment[0]['advertiserPaynment']))  echo round($payment[0]['advertiserPaynment'], 2); elseif($url['userName']) echo "0"; ?>
									<?php endif; ?>
								<?php endif; ?>
							</td>
							<td class="td-actions">
							<?php
							if($this->session->userdata("userTypeID")==2)
							{
							?>
									<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
									<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/delete/".$url['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
							<?php
							}
							?>
							<!-- <?php
							if($this->session->userdata("userTypeID")==3)
							{
							?>
									<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit_pub/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
									<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/delete/".$url['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
							<?php
							}
							?> -->
							</td>
						</tr>
						<?
						}
						?>
						
					</tbody>
				</table>
				<div class="widget-header" style="text-align:right;">
					 
					<?php 
						$mod=10; $inc=1;
						if($url_count>$mod) :
							echo "Pages:";
							for($i=0;$i<=$url_count;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
									
									?>
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(3))  echo "page-active"; else if(!($this->uri->segment(3)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."link/index/".$inc; ?>" ><?php echo $inc; ?></a>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
				</div>
			</div>
			<!-- /widget-content --> 
		</div>
