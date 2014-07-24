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
			<h3><b><i class="icon-paperclip"></i> Edit Page</b></h3>
		</div>
	</div> <br/>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default" style="border:1px solid #D6E9F3;background:#fff;">
				<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
				<div id="successMessage" class="alert alert-success" style="display:none"></div>
				<?php foreach($page as $item) : ?>
				<form class="form-horizontal" id="frm_editPage" action="" method="POST" enctype="multipart/form-data" >
				<div class="panel-body">
					<div class="form-group">
						<label for="Select Website" class="col-lg-2 control-label">Select Website</label>
						<div class="col-lg-10">
								<input type="hidden" value="<?php echo $item['id']; ?>" name="id">
								<select id="templateID" name="templateID" class="form-control validate[required]" style="width:50%;">
									<option value="">Please Select</option>
									<?php foreach($templates as $template) : ?>
										<?php if($template['name']==$item['name']) : ?>
											<option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
										<?php else : ?>
											<option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
						</div><!-- /.col -->
					</div><!-- /form-group -->
				
					<div class="setData">
						<div class="form-group">
							<label for="title" class="col-lg-2 control-label">Page Title</label>
							<div class="col-lg-10">
								<input type="text" class="form-control validate[required]" placeholder="Post Title" value="<?php echo $item['title']; ?>" name="title" id="title" style="width:50%;">
							</div><!-- /.col -->
						</div><!-- /form-group -->
					</div><!-- // .setBlogData -->	
					<div class="form-group">
						<label for="Page Description" class="col-lg-2 control-label">Page Description</label>
						<div class="col-lg-10">
							<textarea name="description" id="description"><?php echo $item['description']; ?></textarea>
						</div><!-- /.col -->
					</div><!-- /form-group --><br/><br/>
					
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
							<a href="<?php echo base_url()?>pages/dashboard" class="btn btn-primary">Cancel</a>	
						</div>
					</div><!-- /form-group -->
				</div>
				</form>	
			<?php endforeach; ?>
			</div><!-- /panel -->
		</div><!-- /.col -->
	</div>
</div><!-- /.padding-md -->
</div>
<script>
	jQuery(document).ready(function($){
		//$(".setData").hide();
		$('#frm_editPage').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editPage").validationEngine('validate'))
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
					$("#successMessage").html("Page updated successfully.");
					$("#successMessage").show();
					//window.location=base_url+"pages/dashboard";
				}
				else if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else
				{
					$("#errorMessage").html(responseText);
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
<!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script> -->
<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 

