
<div class="widget">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3>Edit Post</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
                	<?php //echo "<pre>"; print_r($blog); echo "</pre>"; ?>
                    <?php foreach($blog as $item) : ?>
					<form class="form-horizontal" id="frm_editBlog" action="" method="POST" enctype="multipart/form-data" >
						<fieldset>
							<div class="control-group">
                            	<label for="template" class="control-label">Select Website</label>
								<div class="controls">
                                	<input type="hidden" value="<?php echo $item['id']; ?>" name="id">
									<select id="templateID" name="templateID" class="validate[required]" >
										<option value="">Please Select</option>
										<?php foreach($templates as $template) : ?>
											<?php if($template['name']==$item['name']) : ?>
                                                <option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
                                            <?php else : ?>
                                                <option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
									</select>
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="setData" style="border:0px solid red;">
								<div class="control-group">											
                                    <label for="title" class="control-label">Post Title</label>
                                    <div class="controls">
                                        <input type="text" class="validate[required]" placeholder="Post Title" value="<?php echo $item['title']; ?>" name="title" id="title">
                                    </div> <!-- /controls -->				
								</div> <!-- /control-group -->
                                <div class="control-group">											
                                    <label for="image" class="control-label">Post Image</label>
                                    <div class="controls">
                                    	<?php if($item['image']) : ?>
                                        	<img src="<?php echo base_url().BLOG_IMAGE_PATH.$item['image']; ?>" width="100px" height="auto" />
                                            <input type="file" class="" name="image" id="image" size="20" >
                                        <?php else : ?>
                                        	 <input type="file" class="validate[required]" name="image" id="image" size="20" >
                                        <?php endif; ?>
                                        <p class="help-block">Maximum allwoed image size is 10MB.</p>
                                    </div> <!-- /controls -->				
								</div> <!-- /control-group -->
                                 <div class="control-group">											
                                    <label for="description" class="control-label">Post Description</label>
                                    <div class="controls">
                                       	<textarea name="description" id="description"><?php echo $item['description']; ?></textarea>
                                    </div> <!-- /controls -->				
								</div> <!-- /control-group -->
							</div>
							
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<a href="<?php echo base_url()?>admin/blogs" class="btn">Cancel</a>								</div>
							</div> <!-- /control-group -->
						</fieldset>
					</form>
                    <?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		//$(".setData").hide();
		$('#frm_editBlog').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editBlog").validationEngine('validate'))
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
					$("#errorMessage").html("Please upload Post image.");
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
					$("#successMessage").html("Post updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"admin/blogs";
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