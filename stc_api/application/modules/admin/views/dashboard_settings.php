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
            <div class="col-md-12">
		<div class="panel panel-default">
                    <div class="panel-heading"><h3> <i class="fa fa-cog fa-lg"></i> Bitly API Settings </h3></div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<div id="successMessage" class="alert alert-success" style="display:none"></div>
			<div style="width:70%;">
                            <div class="panel-body">
				<form class="form-horizontal" id="frm_settings" action="" method="POST">
                                    <div class="form-group">
					<label for="Client ID" class="col-lg-2 control-label">Client ID</label>
					<div class="col-lg-10">
                                            <input type="text" id="clientID" name="clientID" placeholder="Client ID" class="form-control link-fields amount validate[required]" value="<?php if(isset($user[0]['clientID'])) echo $user[0]['clientID']; ?>">
					</div><!-- /.col -->
                                    </div><!-- /form-group -->
                                    <div class="form-group">
					<label for="Client Secret Key" class="col-lg-2 control-label">Client Secret Key</label>
					<div class="col-lg-10">
                                            <input type="text" value="<?php if(isset($user[0]['clientSecret'])) echo $user[0]['clientSecret']; ?>" id="clientSecret" name="clientSecret" placeholder="Client Secret Key" class="form-control link-fields amount validate[required]">
					</div><!-- /.col -->
                                    </div><!-- /form-group -->
                                    <div class="form-group">
                                        <label for="Access Token" class="col-lg-2 control-label"> Access Token</label>
					<div class="col-lg-10">
                                            <input type="text" value="<?php if(isset($user[0]['accessToken'])) echo $user[0]['accessToken']; ?>" id="accessToken" name="accessToken" placeholder="Access Token" class="form-control link-fields amount validate[required]">
					</div><!-- /.col -->
                                    </div><!-- /form-group -->
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
                                            <a href="<?php echo base_url().$this->session->userdata('userType').'/dashboard' ?>" class="btn btn-primary">Cancel</a>
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
		$('#frm_settings').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_settings").validationEngine('validate'))
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
					$("#successMessage").html("Publisher details updated successfully");
					$("#successMessage").show();
					window.location=base_url+"<?php echo $this->session->userdata('userType'); ?>/dashboard";
				}
				else
				{
					$("#errorMessage").html("Error updating seetings."+responseText);
					$("#errorMessage").show();
				}
			}
		});
		
	});
</script>
