<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget">
						<div class="widget-header"> <i class="icon-list-alt"></i>
							<h3>Profile</h3>
						</div>
						<!-- /widget-header -->
						<div class="widget-content">
							<div class="big-stats-container">
								<div class="widget-content">
									<div id="formcontrols" class="tab-pane active">
										<form class="form-horizontal" id="frm_editprofile" action="" method="POST">
											<fieldset>
												<div class="control-group">											
													<label for="username" class="control-label">Username</label>
													<div class="controls">
														<input type="hidden" disabled="" value="<?php echo $user['id']; ?>" id="id" name="id" class="span6" >
														<input type="text" disabled="" value="<?php echo $user['userName']; ?>" id="username" class="span6 disabled" name="userName">
														<p class="help-block">Your username is for logging in and cannot be changed.</p>
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="companyName" class="control-label">Company Name</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['companyName']; ?>" id="companyName" name="companyName" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="email" class="control-label">Email </label>
													<div class="controls">
														<input type="text" value="<?php echo $user['email']; ?>" id="email" name="email" class="span4">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<br><br>
												<div class="control-group">											
													<label for="phoneNumber" class="control-label">Phone Number</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['phoneNumber']; ?>" id="phoneNumber"  name="phoneNumber" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="companyAddress" class="control-label">Company Address</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['address']; ?>" id="address" name="address" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="city" class="control-label">City</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['city']; ?>" id="city" name="city" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="state" class="control-label">State</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['state']; ?>" id="state" name="state" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="country" class="control-label">Country</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['country']; ?>" id="country" name="country" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">											
													<label for="zip" class="control-label">Zip</label>
													<div class="controls">
														<input type="text" value="<?php echo $user['zipCode']; ?>" id="zipCode" name="zipCode" class="span6">
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
												<div class="control-group">	
													<div class="controls">
														<button class="btn btn-primary" type="submit">Save</button> 
														<a href="<?php echo base_url().'dashboard/admin' ?>" class="btn">Cancel</a>
													</div>
												</div> <!-- /control-group -->
											</fieldset>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>