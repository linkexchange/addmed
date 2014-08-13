<div id="main-container">
	<!--<div id="breadcrumb">
		<ul class="breadcrumb">
			 <li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
			 <li>Form</li>	 
			 <li class="active">Form Element</li>	 
		</ul>
	</div><!--breadcrumb-->
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-globe"></i>  Edit Monetization Details</b> </h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:62%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_editMonetization" action="" method="POST">
							
							<div class="form-group">
								<label for="Network" class="col-lg-2 control-label">Network</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" value="<?php echo $monetization[0]["network"];?>" name="Network" id="Network">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Network" class="col-lg-2 control-label">Type of Network</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]"  value="<?php echo $monetization[0]["type_of_network"];?>"  name="type" id="type">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Estimated Rate of Payment" class="col-lg-2 control-label">Estimated Rate of Payment</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" value="<?php echo $monetization[0]["estimated_rate_of_payment"];?>" name="estimate" id="estimate">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Payments" class="col-lg-2 control-label">Payments</label>
								<div class="col-lg-10">
									<select name="Payments" class="form-control validate[required]">
										<option value>Please Select</option>
										<option value="Weekly" <?php if($monetization[0]['payments']=='Weekly') echo 'selected="selected"';?>>Weekly</option>
										<option value="Quarterly" <?php if($monetization[0]['payments']=='Quarterly') echo 'selected="selected"';?>>Quarterly</option>
										<option value="Monthly" <?php if($monetization[0]['payments']=='Monthly') echo 'selected="selected"';?>>Monthly</option>
										<option value="Yearly" <?php if($monetization[0]['payments']=='Yearly') echo 'selected="selected"';?>>Yearly</option>
										<option value="Net 30" <?php if($monetization[0]['payments']=='Net 30') echo 'selected="selected"';?>>Net 30</option>
									</select>	
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Sign-Up Link" class="col-lg-2 control-label">Sign-Up Link</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" value="<?php echo $monetization[0]["sign_up_link"];?>" name="Sign_Up_Link" id="Sign_Up_Link"/>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="Article" class="col-lg-2 control-label">Article</label>
								<div class="col-lg-10">
									<select name="articleid" class="form-control validate[required]">
										<option value>Please Select</option>
										<?php foreach($articles as $article){
												if($monetization[0]["articleid"]==$article["id"]) {  
										?>
										<option value="<?php echo $article["id"];?>" selected="selected"><?php echo $article["topic"];?></option>
										<?php } else { ?>
										<option value="<?php echo $article["id"];?>"><?php echo $article["topic"];?></option>
										<?php } }?>
									</select>	
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<input type="hidden" name="monetid" value="<?php echo $monetization[0]["id"]?>"/>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>monetization/dashboard" class="btn btn-primary">Cancel</a>
								</div><!-- /.col -->
							</div><!-- /form-group -->
						</form>
					</div>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div>
<script>
	$(document).ready(function(){
		$('#frm_editMonetization').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editMonetization").validationEngine('validate'))
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
				if(responseText>0)
				{
					$("#successMessage").html("Monetization Details updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"monetization/dashboard";
				}
				else
				{
					$("#errorMessage").html("Operation failed! Please try again...");
					$("#errorMessage").show();
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});

</script>