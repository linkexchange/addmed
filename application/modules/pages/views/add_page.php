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
					<div class="panel-heading"><h3> <i class="icon-paperclip"></i> Add Page </h3></div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div class="panel-body">
						<form class="form-horizontal" id="frm_addPage" action="" method="POST" enctype="multipart/form-data" >
							<div class="form-group">
								<label for="template" class="col-lg-2 control-label">Select Website</label>
								<div class="col-lg-10">
									<select id="templateID" name="templateID" class="form-control validate[required]" onchange="getDetails(this.value);" style="width:50%;">
										<option value="">Please Select</option>
										<?php foreach($templates as $item) : ?>
										<option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Title" class="col-lg-2 control-label">Page Title</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="Page Title" name="title" id="title" style="width:50%;">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Description" class="col-lg-2 control-label">Page Description</label>
								<div class="col-lg-10">
									<textarea class="form-control validate[required]" name="description" id="description"></textarea>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>pages/dashboard" class="btn btn-primary">Cancel</a>
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
	jQuery(document).ready(function($){
		$(".setData").hide();
		$('#frm_addPage').ajaxForm({
			beforeSubmit : function(){
				
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addPage").validationEngine('validate'))
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
				if(responseText==100)
				{
					$("#successMessage").html("Page created successfully.");
					$("#successMessage").show();
					window.location=base_url+"pages/dashboard";
				}
				else if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
				}
			}
		});
		//$("#frm_signup").validationEngine();
	});

</script>
<script>
	function getDetails(lid){
			//alert(lid);
			if(lid){
				$(".setData").show();
			}
			else
			{
				$(".setData").hide();
			}
			//pageactive(pid);
		}

</script>
<!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script> -->
<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 
<script>
      jQuery(function($){
          $('#description').editable({inlineMode: false, height: 500,
              imageUploadParam: "userfile",
              imageUploadURL: "<?php echo base_url() ?>image/upload/index",
                // Set the image error callback.
              imageErrorCallback: function (data) {
                    // Bad link.
                    if (data.errorCode == 1) {
                      console.log(data);
                    }

                    // No link in upload response.
                    else if (data.errorCode == 2) {
                      console.log(data);
                    }

                    // Error during file upload.
                    else if (data.errorCode == 3) {
                      console.log(data);
                    }
              }
        })
      });
</script>
