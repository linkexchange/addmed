
<div class="widget">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3>Edit Link</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
					<form class="form-horizontal" id="frm_addLink" action="" method="POST">
						<fieldset>
							<div class="control-group">											
								<label for="link" class="control-label">URl to Publish</label>
								<div class="controls">
									<input type="hidden" value="<?php echo $url['id']; ?>" name="id">
							    	<input type="text" class="validate[required,custom[url]]" placeholder="URL" value="<?php echo $url['url']; ?>" name="url" id="url">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="control-group">											
								<label for="category" class="control-label">Category Name</label>
								<div class="controls">
									<select name="category">
										<?php
										if($url['categoryID']==0)
										{ ?>
										<option value="0">No category assigned</option>
										<?php } 
										for($i=0;$i<count($categories);$i++){
										if($categories[$i]['id']==$url['categoryID'])
										{ ?>
										<option value="<?php echo $categories[$i]['id']?>" selected="selected">
										<?php echo $categories[$i]['category_name'];?>
										</option>
										<?php } else {?>
										<option value="<?php echo $categories[$i]['id']?>">
										<?php echo $categories[$i]['category_name'];?>
										</option>	
										<?php } }?>
									</select>	
								</div> <!-- /controls -->				
							</div>
							<div class="control-group">											
								<label for="title" class="control-label">Title</label>
								<div class="controls">
									<input type="text" 
									placeholder="title" name="title" id="title" value="<?php echo $url['title'];?>">
								</div> <!-- /controls -->				
							</div>
							<div class="control-group">											
								<label for="pricePerLink" class="control-label">Pay Per Click </label>
								<div class="controls">
									<input type="text" value="<?php echo $url['payPerLink']; ?>" data-type="decimal" id="pricePerLink" name="payPerLink" placeholder="Pay Per Click" class="span4 link-fields price-field validate[required,custom[number]]">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <?php if($this->session->userdata("userTypeID")==1) : ?>
                            <div class="control-group">											
								<label for="percentage" class="control-label">Admin Commision % </label>
								<div class="controls">
									<input type="text" value="<?php echo $url['percentage']; ?>" id="percentage" name="percentage" placeholder="Pay Per Click" class="span4 link-fields price-field validate[required,custom[number]]" data-type="decimal">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <?php endif; ?>
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<a href="<?php echo base_url(); ?>/link" class="btn">Cancel</a>
								</div>
							</div> <!-- /control-group -->
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#frm_addLink').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addLink").validationEngine('validate'))
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
				$("#successMessage").html("You link edited successfully...!");
				$("#successMessage").show();
				window.location=base_url+"link";
			}
		});
		$("#frm_signup").validationEngine();
	});
</script>