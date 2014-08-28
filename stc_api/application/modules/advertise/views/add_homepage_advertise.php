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
                <h3> <i class="icon-building"></i> Add Homepage Ad </h3>
            </div>
	</div> <br/>
	<div class="row">
        <div class="col-md-12">
		<div class="panel panel-default" style="border:1px solid #D6E9F3;">
			<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<div id="successMessage" class="alert alert-success" style="display:none"></div>
                <div class="panel-body">
                    <form class="form-horizontal" id="frm_addHomeAdvertise" action="" method="POST" enctype="multipart/form-data" >
                        <div class="form-group">
							<label for="template" class="col-lg-2 control-label">Select Website</label>
							<div class="col-lg-10">
								<select id="templateID" name="templateID" class="form-control validate[required]" style="width:60%;">
									<option value="">Please Select</option>
									<?php foreach($templates as $item) : ?>
									<option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
								<?php endforeach; ?>
								</select>
							</div><!-- /.col -->
                        </div><!-- /form-group -->
						<div class="form-group">
							<label for="adUnit1" class="col-lg-2 control-label">Ad Unit 1 <br/>(728x100 px)</label>
							<div class="col-lg-10">
								<textarea name="adUnit1" id="adUnit1" class="form-control validate[required]" cols="100" rows="3" placeholder="Ad Size 728px x 100px" style="width:auto;"></textarea>
							</div><!-- /.col -->
						</div><!-- /form-group -->
						<div class="form-group">
							<label for="adUnit2" class="col-lg-2 control-label">Ad Unit 2 <br/>(728x100 px)</label>
							<div class="col-lg-10">
								<textarea name="adUnit2" id="adUnit2" class="form-control validate[required]" cols="100" rows="3" placeholder="Ad Size 728px x 100px" style="width:auto;"></textarea>
							</div><!-- /.col -->
						</div><!-- /form-group -->
                        <div class="form-group">
							<label for="adUnit3" class="col-lg-2 control-label">Ad Unit 3 <br/>(728x300 px)</label>
							<div class="col-lg-10">
								<textarea name="adUnit3" id="adUnit3" class="form-control validate[required]" cols="100" rows="10" placeholder="Ad Size 728px x 300px" style="width:auto;"></textarea>
							</div><!-- /.col -->
						</div><!-- /form-group -->
						<div class="form-group">											
							<label for="adUnit4" class="col-lg-2 control-label">Ad Unit 4<br/>(728x400 px)</label>
							<div class="col-lg-10">
								<textarea name="adUnit4" id="adUnit4" class="form-control validate[required]" cols="100" rows="10" placeholder="Ad Size 728px x 400px" style="width:auto;"></textarea>
							</div> <!-- /controls -->				
						</div> <!-- /control-group -->
                        <div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
								<a href="<?php echo base_url();?>advertise/dashboard" class="btn btn-primary">Cancel</a>
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
		$('#frm_addHomeAdvertise').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addHomeAdvertise").validationEngine('validate'))
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
					//window.location=base_url+"advertise/dashboard";
				}
			}
		});
	});

</script>