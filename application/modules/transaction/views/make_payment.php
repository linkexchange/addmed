<?php if($this->session->userData('userTypeID')==1) : ?>
<div class="widget">
	<div class="widget-header"> 
		<i class="icon-list-alt"></i>
		<h3>Make Payment</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
					<form class="form-horizontal" id="frm_addPayment" action="" method="POST">
						<fieldset>
							<div class="control-group">												<label for="publisher" class="control-label">Publisher</label>
								<div class="controls">
									<select id="publisherID" name="publisherID" class="validate[required]" onchange="getDetails(this.value); ">
										<option value="">Please Select</option>
										<?php foreach($publishers as $item) : ?>
										<option value="<?php echo $item['id']; ?>"><?php echo $item['userName']; ?></option>
										<?php endforeach; ?>
									</select>
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="setData">
							
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	<div>
</div>
<?php endif; ?>
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
	function getDetails(lid){
			//alert(lid);
			if(lid){
			 $.ajax({
				url:base_url+"transaction/payment/getPublisherPaymentDetails/"+lid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					//alert(result);
					$(".setData").html(result);
			}});
			}
			else
			{
				$(".setData").html("");
			}
			//pageactive(pid);
		}
</script>