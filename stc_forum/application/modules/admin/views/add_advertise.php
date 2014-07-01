<div class="widget">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3>Add Ad</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
                	 <?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
                     <form class="form-horizontal" id="frm_addAdvertise" action="" method="POST" enctype="multipart/form-data" >
						<fieldset>
                        	<div class="control-group">
                            	<label for="template" class="control-label">Select Website</label>
								<div class="controls">
									<select id="templateID" name="templateID" class="validate[required]" onchange="">
										<option value="">Please Select</option>
										<?php foreach($templates as $item) : ?>
										<option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">											
                            	<label for="adUnit1" class="control-label">Ad Unit 1 <br/>(728x100 px)</label>
                               	<div class="controls">
                                	<textarea name="adUnit1" id="adUnit1" class="validate[required]" cols="100" rows="3" placeholder="Ad Size 728px x 100px" style="width:auto;"></textarea>
                                </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">											
                            	<label for="adUnit2" class="control-label">Ad Unit 2<br/>(728x100 px)</label>
                               	<div class="controls">
                                	<textarea name="adUnit2" id="adUnit2" class="validate[required]" cols="100" rows="3" placeholder="Ad Size 728px x 100px" style="width:auto;"></textarea>
                                </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">											
                            	<label for="adUnit3" class="control-label">Ad Unit 3<br/>(728x300 px)</label>
                               	<div class="controls">
                                	<textarea name="adUnit3" id="adUnit3" class="validate[required]" cols="100" rows="10" placeholder="Ad Size 728px x 300px" style="width:auto;"></textarea>
                                </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">											
                            	<label for="adUnit4" class="control-label">Ad Unit 4<br/>(728x400 px)</label>
                               	<div class="controls">
                                	<textarea name="adUnit4" id="adUnit4" class="validate[required]" cols="100" rows="10" placeholder="Ad Size 728px x 300px" style="width:auto;"></textarea>
                                </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">											
                            	<label for="adUnit5" class="control-label">Ad Unit 5<br/>(300x300 px)</label>
                               	<div class="controls">
                                	<textarea name="adUnit5" id="adUnit5" class="validate[required]" cols="50" rows="10" placeholder="Ad Size 300px x 300px" style="width:auto;"></textarea>
                                </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">											
                            	<label for="adUnit6" class="control-label">Ad Unit 6<br/>(300x300 px)</label>
                               	<div class="controls">
                                	<textarea name="adUnit6" id="adUnit6" class="validate[required]" cols="50" rows="10" placeholder="Ad Size 300px x 300px" style="width:auto;"></textarea>
                                </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">											
                            	<label for="adMobile1" class="control-label">Ad Mobile 1<br/>(300x100 px)</label>
                               	<div class="controls">
                                	<textarea name="adMobile1" id="adMobile1" class="validate[required]" cols="50" rows="3" placeholder="Ad Size 300px x 100px" style="width:auto;"></textarea>
                                </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">											
                            	<label for="adMobile2" class="control-label">Ad Mobile 2<br/>(300x100 px)</label>
                               	<div class="controls">
                                	<textarea name="adMobile2" id="adMobile2" class="validate[required]" cols="50" rows="3" placeholder="Ad Size 300px x 100px" style="width:auto;"></textarea>
                                </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">											
                            	<label for="adMobile3" class="control-label">Ad Mobile 3<br/>(300x100 px)</label>
                               	<div class="controls">
                                	<textarea name="adMobile3" id="adMobile3" class="validate[required]" cols="50" rows="3" placeholder="Ad Size 300px x 100px" style="width:auto;"></textarea>
                                </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<a href="<?php echo base_url()?>admin/advertisement" class="btn">Cancel</a>	
                                </div>
							</div> <!-- /control-group -->
                        </fieldset>
                     </form>
				</div><!--formcontrols-->
            </div><!--widget-content-->
        </div><!--big-stats-container-->
   	</div><!--widget-content-->
</div><!--widget-->
<script>
	$(document).ready(function(){
		$(".setData").hide();
		$('#frm_addAdvertise').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addAdvertise").validationEngine('validate'))
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
				if(responseText==101)
				{
					$("#errorMessage").html("Website not fount. Please select website.");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else if(responseText==100)
				{
					$("#successMessage").html("Ad created successfully.");
					$("#successMessage").show();
					window.location=base_url+"admin/advertisement";
				}
				/*else if(responseText>0)
				{
					$("#errorMessage").html(responseText);
					$("#errorMessage").show();
				}*/
			}
		});
		//$("#frm_signup").validationEngine();
	});

</script>