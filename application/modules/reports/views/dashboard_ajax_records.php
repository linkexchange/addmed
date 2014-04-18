<table class="table table-striped table-bordered user-transactions">
						<thead>
							<tr>
								<th>Sr.</th>							
								<th>Link</th>
								<?php if($this->session->userData('userTypeID')==3) : ?> 
								<th>Advertiser</th>
								<?php elseif($this->session->userData('userTypeID')==2) : ?>
								<th>Publisher</th>
								<?php elseif($this->session->userData('userTypeID')==1) : ?>
								<?php endif; ?>
								<th>Pay Per Link</th>
								<th>Bitly URL</th>
								<th>Hits</th>
								<th>Hit Amount</th>
								<?php if($this->session->userData('userTypeID')==3) : ?>
								<th>Admin Commision</th>
								<?php endif; ?>
								<th>Date</th>
							</tr>
							<?php 
								//echo $this->uri->segment(4);
								$sr=1;
								if($this->uri->segment(4)>1 ){
									$sr=10*$this->uri->segment(4)-9;
								}
							?>
							<?php foreach($Urls as $item) : ?>
								<tr>
									<td><?php echo $sr; ?></td>							
									<td><?php echo $item['url']; ?></td>
									<td><?php echo $item['userName']; ?></td>
									<td><?php echo $item['payPerLink']; ?></td>
									<td><?php echo $item['billyUrl']; ?></td>
									<td><?php echo $item['numberOfClicks']; ?></td>
									<?php if($this->session->userData('userTypeID')==3) : ?> 
									<td><?php echo $item['publisherPayment']; ?></td>
									<?php elseif($this->session->userData('userTypeID')==2) : ?>
									<td><?php echo $item['advertiserPaynment']; ?></td>
									<?php elseif($this->session->userData('userTypeID')==1) : ?>
									<?php endif; ?>
									<?php if($this->session->userData('userTypeID')==3) : ?>
									<td><?php echo $item['commission']; ?></td>
									<?php endif; ?>
									<td><?php echo $item['createdDate']; ?></td>
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
											<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."reports/dashboard/index/".$inc; ?>" ><?php echo $inc; ?></a>
										<?php else : ?>
											<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."reports/dashboard/index/".$inc."/".$startDate."/".$endDate; ?>" ><?php echo $inc; ?></a>
										<?php endif; ?>
											
										<?php
										$inc++;
									endif;
								endfor;
							endif;
						?> &nbsp;
					</div>