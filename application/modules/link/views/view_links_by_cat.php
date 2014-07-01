<?php //echo $cur_cat_ID; ?>
<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Link </th>
							<th>Category Name</th>
							<th>Title</th>
							<?php
							if($this->session->userdata("userTypeID")==3)
							{
							?>
							<th>Bitly Url</th>
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
							<th>Publisher</th>
							<th>Advertiser</th>
							<?php endif;?>
							<th>Hits</th>
							<th>Total Costing</th>
                            <th>Admin Commision <br/>(In %)</th>
                            <th class="td-actions"> </th>
						</tr>
					</thead>
					<?php $this->load->model("clicksdetail");
						  $this->load->model("user");
						  $this->load->model("url");?>
					<tbody>
					<?php
						//echo "<pre>"; //print_R($urls); exit;
						foreach($urls as $url)
						{
						?>
						<tr>
							<td><?php echo $url['url'];?></td>
							<td><?php 
									if($url['categoryID']==0)
									{
										echo "No category assigned";
									}
									else
									{
									$cat = $this->url->getcategoryNameById($url['categoryID']);
									echo $cat[0]['category_name'];
									}
								?> 
							</td>
							<td> <?php echo $url['title'];?> </td>
							<?php
							if($this->session->userdata("userTypeID")==3)
							{
							?>
							<td><?php echo $url['bitlyURL']; ?></td>
							<?php
							}
							?>
							<td><?php echo $url['payPerLink']; ?></td>
							<?php if($this->session->userData('userTypeID')==1 || $this->session->userData('userTypeID')==2)  : ?>
								<td>
									<?php $users=$this->user->getPublishersByLinkID($url['id']);
                                        $userName=""; 
										$i=0;
										foreach($users as $user)
										{
											if($i>0)
												$userName .= ",".$user['userName'];
											else
												$userName .= $user['userName'];
											$i++;
										}
										 echo $userName;
									?>
								</td>
							<?php endif;
							if($this->session->userData('userTypeID')==3):
							?>
								<td>
									<?php if(isset($url['userName'])) echo $url['userName']; ?>
								</td>
							<?
							endif;
							if($this->session->userData('userTypeID')==1) :
								?>
								<td>
									<?php if(isset($url['userName'])) echo $url['userName']; ?>
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
                            <td><?php echo $url['percentage']; ?></td>
                          	<td class="td-actions">
							<?php
							if($this->session->userdata("userTypeID")==2 || $this->session->userdata("userTypeID")==1)
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
						<?php
						}
						?>
						
					</tbody>
				</table>
				<div class="widget-header" style="text-align:right;">
					 
					<?php 
						$mod=50; $inc=1;
						if($url_count>$mod) :
							echo "Pages:";
							for($i=0;$i<=$url_count;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
									
									?>
                                    <?php if($cur_cat_ID) : ?>
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(3))  echo "page-active"; else if(!($this->uri->segment(3)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."link/index/".$cur_cat_ID."/".$inc; ?>" ><?php echo $inc; ?></a>
                                    <?php else : ?>
                                    	<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(3))  echo "page-active"; else if(!($this->uri->segment(3)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."link/index/0/".$inc; ?>" ><?php echo $inc; ?></a>
                                    <?php endif; ?>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
				</div>