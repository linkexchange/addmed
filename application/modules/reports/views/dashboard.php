<div class="widget">
	<div class="widget-header"> 
		<i class="icon-list-alt"></i>
		<h3>View Reports</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
			<?php //echo "<pre>"; print_r($Urls); echo "</pre>";?>
				<div id="formcontrols" class="tab-pane active" style="border: 1px solid #D6D6D6; padding-top:20px;">
					<form class="form-horizontal" id="frm_getRecords" action="" method="POST">
						<fieldset>
							<div class="" style="float:left;">
								<label for="startDate" class="control-label">Start Date</label>
								<div class="controls">
									<input type="text" class="validate[custom[date]]" placeholder="Start Date" name="startDate" id="startDate" value="<?php if($startDate!=0) echo $startDate; ?>">
								</div> <!-- /controls -->	
							</div>
							<div class="" style="float:left;">
								<label for="endDate" class="control-label">End Date</label>
								<div class="controls">
									<input type="text" class="validate[custom[date]]" placeholder="End Date" name="endDate" id="endDate" value="<?php if($endDate!=0) echo $endDate; ?>">
								</div> <!-- /controls -->	
							</div>
							<div class="" style="float:left;">
								<label for="endDate" class="control-label"></label>
								<button id="btn_submit" class="btn btn-primary" type="submit">Show Records </button> 
								<!-- <a href="<?php echo base_url(); ?>transaction/payment" class="btn">Cancel</a> -->
							</div>
						</fieldset>
					</form>
				</div>
				<script>
					$(document).ready(function(){
						$('#frm_getRecords').ajaxForm({
							beforeSubmit : function(){
								$("#btn_submit").button('loading');
								$("#successMessage").hide();
								$("#errorMessage").hide();
								if($("#frm_getRecords").validationEngine('validate'))
								{
									$("#btn_submit").button('loading');
									var startDate=0;
									var endDate=0;
									if($("#startDate").val())
										startDate=$("#startDate").val();
									if($("#endDate").val())
										endDate=$("#endDate").val();
									window.location=base_url+"reports/dashboard/index/1/"+startDate+"/"+endDate;
									return true;
								}
								else
								{
									$("#btn_submit").button('reset');
									return false;
								}
							},
							success :  function(responseText, statusText, xhr, $form){
								$("#btn_submit").button("reset");
								//alert(responseText);
								if(responseText==4)
								{
									$("#errorMessage").html("End Date is not less than Start Date");
									//$("#errorMessage").show();
									$("#ajax-reports").html("");
								}
								else
								{
									$("#ajax-reports").html(responseText);
									//$("#successMessage").show();
									//window.location=base_url+"transaction/payment";
								}
							}
						});
						$("#frm_signup").validationEngine();
					});
				</script>
				<br/>
				<div id="ajax-reports">
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
								<th>Advertiser</th>
								<th>Publisher</th>
								<?php endif; ?>
								<th>Pay Per Link</th>
								<th>Bitly URL</th>
								<th>Hits</th>
								
								<?php if($this->session->userData('userTypeID')==1) : ?>
								<th>Advertiser Amount</th>
								<th>Publisher Amount</th>
								<?php else : ?>
								<th>Hit Amount</th>
								<?php endif; ?>
								<?php if($this->session->userData('userTypeID')==3 || $this->session->userData('userTypeID')==1) : ?>
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
							<?php $this->load->model("user"); ?>
							
							<?php foreach($Urls as $item) : ?>
								<tr>
									<td><?php echo $sr; ?></td>							
									<td><?php echo $item['url']; ?></td>
									<td><?php echo $item['userName']; ?></td>
									<?php if($this->session->userData('userTypeID')==1) : ?>
										<td>
											<?php $user=$this->user->getUserByID($item['publisherID']); ?>
											<?php echo $user[0]['userName']; ?>
										</td>
									<?php endif; ?>
									<td><?php echo $item['payPerLink']; ?></td>
									<td><?php echo $item['billyUrl']; ?></td>
									<td><?php echo $item['numberOfClicks']; ?></td>
									<?php if($this->session->userData('userTypeID')==3) : ?> 
									<td><?php echo $item['publisherPayment']; ?></td>
									<?php elseif($this->session->userData('userTypeID')==2) : ?>
									<td><?php echo $item['advertiserPaynment']; ?></td>
									<?php elseif($this->session->userData('userTypeID')==1) : ?>
									<td><?php echo $item['advertiserPaynment']; ?></td>
									<td><?php echo $item['publisherPayment']; ?></td>
									<td><?php echo $item['commission']; ?></td>
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
											<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."reports/dashboard/index/".$inc."/".$startDate."/".$endDate; ?>" ><?php echo $inc; ?></a>
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
				</div>
			</div>
		</div>
	<div>
</div>