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
					<tbody>
					<?php
						foreach($publishedUrls as $url)
						{
						?>
						<tr>
							<td><?php $str=$url['url']; echo wordwrap($str,35,"<br>\n",TRUE); ?></td>
							<!-- <?php 
								if($this->session->userdata("userTypeID")==3) 
								{
							?>
							<td><?php echo $url['billyUrl']; ?></td>
							<?php 
								}
							?> -->
							<td><?php echo $url['payPerLink']; ?></td>
							<td><?php echo $url['title'];?></td>
							<td><?php echo $url['userName']; ?></td>
							<td><?php	$this->load->model("clicksdetail");						$clicks=$this->clicksdetail->getTotalHitsByLinkId($url['id']); ?>
								<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; else echo "0"; ?></td>
							<td><?php if($this->session->userData('userTypeID')==3) : ?>
									<?php $payment=$this->clicksdetail->getTotalPublisherPaymentForLinkId($url['id']);?>
									<?php if(isset($payment[0]['publisherPayment']))  echo round($payment[0]['publisherPayment'], 2); else echo "0"; ?>
								<?php elseif($this->session->userData('userTypeID')==2) : ?>
									<?php $payment=$this->clicksdetail->getTotalAdvertiserPaymentForLinkId($url['id']);?>
									<?php if(isset($payment[0]['advertiserPaynment']))  echo round($payment[0]['advertiserPaynment'], 2); else echo "0"; ?>
								<?php endif; ?></td>
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