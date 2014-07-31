<div id="main-container">
<!--<div id="breadcrumb">
	<ul class="breadcrumb">
		 <li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
		 <li>Form</li>	 
		 <li class="active">Form Element</li>	 
	</ul>
</div><!--breadcrumb-->
<div class="padding-md">
	<div class="row" style="margin-left:0px;margin-right:0px;">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3><i class="icon-list-alt"></i> Edit Gallery Item</h3></div>
				<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
				<div id="successMessage" class="alert alert-success" style="display:none"></div>
				 <?php foreach($articles as $article) : ?>
					<script>
						$(document).ready(function(){
							var tid=<?php echo $article['templateID']; ?>;
							var bid=<?php echo $article['blogID']; ?>;
							$.ajax({
								url:base_url+"articles/dashboard/getTemplateBlogs2/"+tid+"/"+bid,
								//beforeSend: loadStartPub,
								//complete: loadStopPub,
								success:function(result){
									$(".setBlogData").html(result);
							}});
						});
					</script>
				<form class="form-horizontal" id="frm_editArticle" action="" method="POST" enctype="multipart/form-data" >	
				<div class="panel-body">
					<div style="width:50%">	
						<div class="form-group">
							<label for="Select Website" class="col-lg-2 control-label">Select Website</label>
							<div class="col-lg-10">
									<select id="templateID" name="templateID" class="form-control validate[required]" onchange="getBlogs(this.value);">
										<option value="">Please Select</option>
										<?php foreach($templates as $template) : ?>
											<?php if($template['id']==$article['templateID']) : ?>
												<option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
											<?php else : ?>
												<option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
							</div><!-- /.col -->
						</div><!-- /form-group -->
					
						<div class="setBlogData"> </div><!-- // .setBlogData -->	
						<div class="form-group">
							<label for="articleTitle" class="col-lg-2 control-label">Gallery Item Title</label>
							<div class="col-lg-10">
								<input type="hidden" id="id" name="id" value="<?php echo $article['id']; ?>" />
								<input type="text" class="form-control validate[required]" placeholder="Gallery Item Title" value="<?php echo $article['articleTitle']; ?>" name="articleTitle" id="articleTitle">
							</div><!-- /.col -->
						</div><!-- /form-group --><br/><br/>
						<div class="form-group">
							<label for="articleDescription" class="col-lg-2 control-label">Gallery Item Description</label>
							<div class="col-lg-10">
								<textarea name="articleDescription" id="articleDescription"><?php echo $article['articleDescription']; ?></textarea>
							</div><!-- /.col -->
						</div><!-- /form-group -->
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
								<a href="<?php echo base_url()?>articles/dashboard" class="btn btn-primary">Cancel</a>	
                            </div>
						</div><!-- /form-group -->
					</div>	
				</div>
				</form>	
			<?php endforeach; ?>
			</div><!-- /panel -->
		</div><!-- /.col -->
	</div>
</div><!-- /.padding-md -->
</div>
<script>
	function getBlogs(bid){
			if(bid){
			 $.ajax({
				url:base_url+"articles/dashboard/getTemplateBlogs2/"+bid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					$(".setBlogData").html(result);
			}});
			}
			else
			{
				$(".setBlogData").html("");
			}
	}
</script>
<script>
	function getDetails(aid){
			
	}
</script>
<script>
	$(document).ready(function(){
		$(".setData").hide();
		$('#frm_editArticle').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editArticle").validationEngine('validate'))
				{
					var msg="";
                                        if(($('#articleImage').val()=="") && ($('#articleVideo').val()=="")){
                                            msg+="Gallery item image or video is required for gallery item.";
                                        }
                                        if(msg==""){
                                            $("#btn_submit").button('loading');
                                            return true;
                                        }
                                        else
                                        {
                                            $("#errorMessage").html(msg);
                                            $("#errorMessage").show();
                                            $("#btn_submit").button('reset');
                                            return false; 
                                        }
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
					$("#errorMessage").html("Please upload gallery item image.");
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
					$("#successMessage").html("Gallery item updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"articles/dashboard";
				}
				else if(responseText==103)
				{
					$("#errorMessage").html("Please select post.");
					$("#errorMessage").show();
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
      jQuery(function($){
          $('#articleDescription').editable({inlineMode: false, height: 500,
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
<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 