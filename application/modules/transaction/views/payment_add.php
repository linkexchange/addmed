<div class="widget">
	<div class="widget-header"> 
		<i class="icon-list-alt"></i>
		<?php if($this->session->userData('userTypeID')==1) : ?>
		<h3>Make Payment</h3>
		<?php elseif($this->session->userData('userTypeID')==2) : ?>
		<h3>Add Payment</h3>
		<?php endif; ?>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
					<form class="form-horizontal" id="frm_addPayment" action="" method="POST">
						<fieldset>
						<?php if($this->session->userData('userTypeID')==2) : ?>
							<?php if(isset($paymentDetails[0]['billableAmount'])) : ?>
									<div class="control-group">									<label for="Billable Amount" class="control-label">Billable Amount</label>
										<div class="controls">
											<?php //print_r($linkUrls); ?>
											<input type="text" class="validate[required]" placeholder="Billable Amount" value="<?php echo $paymentDetails[0]['billableAmount'] ; ?>" name="billableAmount" id="billableAmount" readonly="readonly">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->
									<div class="control-group">									<label for="Balance Amount" class="control-label">Balance Amount</label>
										<div class="controls">
											<?php //print_r($linkUrls); ?>
											<input type="text" class="validate[required]" placeholder="Balance Amount" value="<?php echo $paymentDetails[0]['balanceAmount'] ; ?>" name="balanceAmount" id="balanceAmount" readonly="readonly">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->
									<div class="control-group">									<label for="Billable Amount" class="control-label">Paying Amount</label>
										<div class="controls">
											<?php //print_r($linkUrls); ?>
											<input type="text" class="validate[required]" placeholder="Paying Amount" value="" name="paidAmount" id="paidAmount">
										</div> <!-- /controls -->				
									</div> <!-- /control-group -->
							<?php else : ?>
								<div class="control-group">										<label for="Enter Amount" class="control-label">Enter Amount</label>
									<div class="controls">
										<?php //print_r($linkUrls); ?>
										<input type="text" class="validate[required]" placeholder="Enter Amount" value="" name="amount" id="amount" >
									</div> <!-- /controls -->
								</div>
							<?php endif; ?>
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<a href="<?php echo base_url().$this->session->userdata('userType'); ?>/dashboard" class="btn">Cancel</a>
								</div>
							</div> <!-- /control-group -->
						<?php else : ?>
							<div class="control-group">											<label for="link" class="control-label">Billable Amount</label>
								<div class="controls">
									<?php //print_r($linkUrls); ?>
							    	<!-- <input type="text" class="validate[required,custom[url]]" placeholder="URL" value="http://" name="url" id="url"> -->
									<select id="linkID" name="linkID" class="validate[required]" onchange="getAmount(this.value); ">
										<option value="">Please Select</option>
										<?php foreach($linkUrls as $item) : ?>
										<option value="<?php echo $item['id']; ?>"><?php echo $item['url']; ?></option>
										<?php endforeach; ?>
									</select>
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							
							<div class="control-group">										<label for="amount" class="control-label">Link Amount</label>
								<div class="controls">
									<input type="text" value="" id="amount" name="amount" placeholder="Amount" class="span4 link-fields amount validate[required]" readonly="readonly">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<a href="<?php echo base_url().$this->session->userdata('userType'); ?>/dashboard" class="btn">Cancel</a>
								</div>
							</div> <!-- /control-group -->
						<?php endif; ?>
		
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /widget-header -->
</div>
<script>
	$(document).ready(function(){
		$('#frm_addPayment').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addPayment").validationEngine('validate'))
				{
					$("#btn_submit").button('loading');
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
				if(responseText>0)
				{
					$("#successMessage").html("Payment done successfully"+responseText);
					$("#successMessage").show();
					window.location=base_url+"transaction/payment";
				}
				else
				{
					$("#errorMessage").html("Payment Error.");
					$("#errorMessage").show();
				}
			}
		});
		$("#frm_signup").validationEngine();
	});
</script>
<script>
	function getAmount(lid){
			//alert(lid);
			if(lid){
			 $.ajax({
				url:base_url+"clicksdetail/details/getLinkAmount/"+lid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					//alert(result);
					$("#amount").val(result);
			}});
			}
			else
			{
				$("#amount").val("");
			}
			//pageactive(pid);
		}
</script>