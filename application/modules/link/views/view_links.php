
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
			if(cid){
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
			}
	}
</script>

		<?php if($this->session->userdata("userTypeID")==2) : ?>
		<div class="widget"> 
			<div class="span12 offset10"> 
				<button class="btn btn-primary btn-large  icon-anchor" onclick="javascript:goto('link/add')"> Add Link</button>
			</div>
		</div>
		<?php endif; ?>
		<div class="widget widget-table action-table" >
        	
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>Links</h3>
                </div>
                <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
                <div id="successMessage" class="alert alert-success" style="display:none"><?php echo $this->session->flashdata('message');?></div>
				<?php //echo "<pre>"; print_r($urls); echo "</pre>"; ?>
			<!-- /widget-header -->
			<div class="widget-content" style="padding:25px;">
            	<div class="big-stats-container">
                <div class="widget-content" style="padding-bottom:25px;">
                	<div id="formcontrols" class="tab-pane active" style="border: 1px solid #D6D6D6; padding-top:20px;">
					<form class="form-horizontal" id="frm_getRecords" action="" method="POST">
						<fieldset>
                        	<!-- /control-group -->
							<div class="control-group">											
								<label for="cat_name" class="control-label">Select Category</label>
								<div class="controls">
									<select name="category" id="category" onchange="getCategoryLinks(this.value);">
                                     <option value="">Please Select</option>
									<?php foreach($categories as $cat){ ?>
                                    	<?php if($cat['id']==$cur_cat_ID) : ?>
                                        	<option value="<?php echo $cat['id']; ?>" selected="selected"><?php echo $cat['category_name']; ?></option>
                                            <?php else : ?>
                                            	<option value="<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?></option>
                                           	<?php endif; ?>
										
									<?php } ?>
									</select>	
								</div> <!-- /controls -->	
								
							</div> <!-- /control-group -->
                        </fieldset>
                    </form>
                 </div>
                </div>
                
                <div class="widget-content setData" style="border: 1px solid #D5D5D5;">
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
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."link/index/".$cur_cat_ID."/".$inc; ?>" ><?php echo $inc; ?></a>
                                    <?php else : ?>
                                    	<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."link/index/0/".$inc; ?>" ><?php echo $inc; ?></a>
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
	<!-- /widget-content --> 
</div>
        
 
