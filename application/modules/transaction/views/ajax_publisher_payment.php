<div class="control-group">									
								<label for="publisherAmount" class="control-label">Publisher Amount</label>
								<div class="controls">
									<?php //print_r($linkUrls); ?>
									<input type="text" class="validate[required]" placeholder="Publisher Amount" name="publisherAmount" id="publisherAmount" readonly="readonly" value="<?php if(isset($pubAmount[0]['publisherPayment'])) : echo $pubAmount[0]['publisherPayment']; else : echo "0"; endif; ?>">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">									
								<label for="paidAmount" class="control-label">Already Paid Amount</label>
								<div class="controls">
									<?php //print_r($linkUrls); ?>
									<input type="text" class="validate[required]" placeholder="Already Paid Amount" name="paidAmount" id="paidAmount" readonly="readonly" value="<?php if(isset($paidAmount[0]['paidAmount'])) : echo $paidAmount[0]['paidAmount']; else : echo "0"; endif; ?>">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">									
								<label for="dueAmount" class="control-label">Due Amount</label>
								<div class="controls">
									<?php //print_r($linkUrls); ?>
									<input type="text" class="validate[required]" placeholder="Due Amount" name="dueAmount" id="dueAmount" readonly="readonly" value="<?php if(isset($due)) : echo $due; else : echo "0"; endif; ?>">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">									
								<label for="payingAamount" class="control-label">Paying Amount</label>
								<div class="controls">
									<?php //print_r($linkUrls); ?>
									<input type="text" class="validate[required]" placeholder="Paying Amount" value="" name="payingAamount" id="payingAamount">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<a href="<?php echo base_url(); ?>transaction/payment" class="btn">Cancel</a>
								</div>
							</div> <!-- /control-group -->