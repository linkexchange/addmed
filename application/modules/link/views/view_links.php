
<?php if($this->session->flashdata('message')) : ?>
<script>
$(document).ready(function(){
	$("#successMessage").show();
});
</script>

<?php endif; ?>
<script>
	function getCategoryLinks(cid){
		//alert(cid);
                window.location=base_url+"link/index/"+cid;
                /*    if(cid){
				 $.ajax({
				url:base_url+"link/link/index/"+cid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					$(".setData").html(result);
					$(".setData").show();
				}});
			 	
			}
			else
			{
				$(".setData").hide();
			}*/
	}
</script>
<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-anchor"></i> Links</b>
				<span class="pull-right">
					<?php if($this->session->userdata("userTypeID")==2) : ?>
						<a class="btn btn-success icon-anchor" href="<?php echo base_url();?>link/add"> Add Link</a>
					<?php endif; ?>
				</span></h3>
			</div>
		</div> <br/>
		<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none">
					<?php echo $this->session->flashdata('message');?></div>
					<div class="panel-body">
						<form class="form-horizontal" id="frm_getRecords" action="" method="POST">
							<b>Select Category :</b>  
							<select class="form-control input-sm inline" style="width:130px;" name="category" id="category" onchange="getCategoryLinks(this.value);"> 
								<option value="">Please Select</option>
								<?php foreach($categories as $cat){ ?>
									<?php if($cat['id']==$cur_cat_ID) : ?>
										<option value="<?php echo $cat['id']; ?>" selected="selected"><?php echo $cat['category_name']; ?></option>
										<?php else : ?>
											<option value="<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?></option>
										<?php endif; ?>
									
								<?php } ?> 
							</select>
						</form>	
					</div>
					<div class="padding-md clearfix">
						<div class="setData">
						<table class="table table-bordered table-striped dataTable">
							<thead>
								<tr>
                                                                        <th>Sr.</th>
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
							<?php 
								$this->load->model("clicksdetail");
								$this->load->model("user");
								$this->load->model("url");
                                                                $sr=1;
                                                                if($this->uri->segment(4)>1 ){
                                                                    $sr=(int)$this->config->item('record_limit')*$this->uri->segment(4)-((int)$this->config->item('record_limit')-1);
                                                                }
							?>
							<tbody>
								<?php
								//echo "<pre>"; //print_R($urls); exit;
								foreach($urls as $url)
								{
								?>
								<tr>
                                                                        <td><?php echo $sr; ?></td>
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
								<?php $sr++;
								}
								?>
							</tbody>
						</table>
                                                <div class="panel-footer clearfix">
                                                     <?php 
                                                        $count=$url_count;
                                                        $url=base_url()."link/index/";
                                                        if($this->uri->segment(4))
                                                            $currentPage=(int)$this->uri->segment(4);
                                                        else
                                                            $currentPage=1;
                                                        if($cur_cat_ID) :
                                                            $parameters[0]=(int)$cur_cat_ID;
                                                        else :
                                                            $parameters[0]=0;
                                                        endif;
                                                        pagination($url,$parameters,$count,$currentPage);
                                                    ?>  
                                                </div>
				</div>
			</div><!-- /.padding-md -->
		</div>	
	</div><!-- /.padding-md -->
</div>
