<?php $n = count($categories);?>
<script>
	function getCategoryCPC(cid){
			if(cid){
				 $.ajax({
				url:base_url+"link/link/getCategoryCPC/"+cid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					$("#pricePerLink").val(result);
					
				}});
			 	
			}
			else
			{
				$("#pricePerLink").val();
			}
	}
</script>
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
					<div class="panel-heading"><h3><b><i class="icon-th-list"></i>  Add Link </b> </h3></div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div class="panel-body">
						<form class="form-horizontal" id="frm_addLink" action="" method="POST">
							<div class="form-group">
								<label for="link" class="col-lg-2 control-label">URl to Publish</label>
								<div class="col-lg-10">
									<input type="text" class="form-control input-sm validate[required,custom[url]]" placeholder="URL" value="http://" name="url" id="url">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Title" class="col-lg-2 control-label">Title</label>
								<div class="col-lg-10">
									<input type="text" class="form-control input-sm validate[required]" placeholder="Title"  name="title" id="title">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="category" class="col-lg-2 control-label">Select Category</label>
								<div class="col-lg-10">
									<select name="category" class="form-control validate[required]" onchange="getCategoryCPC(this.value);">
										<option value="">Please Select</option>
										<?php for($i=0;$i<$n;$i++) { ?>
										<option value="<?php echo $categories[$i]['id'];?>">
											<?php echo $categories[$i]['category_name'];?>
										</option>
										<?php } ?>	
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="pricePerLink" class="col-lg-2 control-label">Pay Per Click</label>
								<div class="col-lg-10">
									<input type="text" value="" id="pricePerLink" name="payPerLink" placeholder="Pay Per Click" class="form-control link-fields price-field validate[required,custom[number]]" data-type="decimal">
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
				if(responseText>0)
				{
					$("#successMessage").html("Link added successfully");
					$("#successMessage").show();
					window.location=base_url+"link";
				}
				else
				{
					//alert(responseText);
					$("#errorMessage").html("Link already exist...!");
					$("#errorMessage").show();
				}
			}
		});
		$("#frm_signup").validationEngine();
	});

</script>