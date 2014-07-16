<div id="main-container">
	<!--<div id="breadcrumb">
		<ul class="breadcrumb">
			 <li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
			 <li>Form</li>	 
			 <li class="active">Form Element</li>	 
		</ul>
	</div><!--breadcrumb-->
	<div class="padding-md">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"><h3> <i class="icon-list-alt"></i> Add Website </h3></div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div class="panel-body">
						<form class="form-horizontal" id="frm_addTemplate" action="" method="POST">
							
							<div class="form-group">
								<label for="Name" class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10">
									<input type="text" class="form-control input-sm validate[required]" placeholder="Name"  name="name" id="name">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url().$this->session->userdata('userType'); ?>/dashboard" class="btn btn-primary">Cancel</a>
								</div><!-- /.col -->
							</div><!-- /form-group -->
						</form>
					</div>
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div>
<script>
	$(document).ready(function(){
		$('#frm_addTemplate').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addTemplate").validationEngine('validate'))
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
					$("#successMessage").html("Website created successfully.");
					$("#successMessage").show();
					window.location=base_url+"template/dashboard";
				}
				else
				{
					$("#errorMessage").html("Website creation failed! Please try again...");
					$("#errorMessage").show();
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});

</script>