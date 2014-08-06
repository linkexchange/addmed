<?php if($this->uri->segment(4) && $this->uri->segment(5)) : ?>
<script>
	$(document).ready(function(){
		$(".setArticleData").show();
	});
</script>
<?php else : ?>
<script>
	$(document).ready(function(){
		$(".setArticleData").hide();
		$(".actions").hide();
		
	});
</script>
<?php endif; ?>
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
				<h3><b><i class="icon-list-alt"></i> Add Gallery Items</b> </h3>
			</div>
		</div> <br/>
	<form class="form-horizontal" id="frm_addArticle" action="<?php echo base_url();?>articles/dashboard/addMultipleItems" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default" style="border:1px solid #D6E9F3;">
				<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
				<div id="successMessage" class="alert alert-success" style="display:none"></div>
				<div class="panel-body">
					<div style="width:50%">	
						<div class="form-group">
							<label for="Select Website" class="col-lg-2 control-label">Select Website</label>
							<div class="col-lg-10">
									<select id="templateID" name="templateID" class="form-control validate[required]" onchange="getBlogs(this.value);">
										<option value="">Please Select</option>
										<?php foreach($templates as $template) : ?>
											<?php if($template['id']==$tempID || $template['id']==$this->uri->segment(4)) : ?>
												<option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
											<?php else : ?>
												<option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
							</div><!-- /.col -->
						</div><!-- /form-group -->
					
						<div class="setBlogData">
							<div class="form-group">
								<?php if($this->uri->segment(4) && $this->uri->segment(5)) : ?>
								<label for="Select Post" class="col-lg-2 control-label">Select Post</label>
								<div class="col-lg-10">
									<select id="blogID" name="blogID" class="form-control validate[required]" onchange="getDetails(this.value);">
										<option value="">Please Select</option>
										<?php foreach($blogs as $blog) : ?>
											<?php if(isset($currentBlogID)) : ?>
												<?php if($blog['id']==$currentBlogID) : ?>
														<option value="<?php echo $blog['id']; ?>" selected="selectted"><?php echo $blog['title']; ?></option>
												<?php else : ?>
                                                        <option value="<?php echo $blog['id']; ?>"><?php echo $blog['title']; ?></option>
												<?php endif; ?>
                                            <?php else : ?>
                                                        <option value="<?php echo $blog['id']; ?>"><?php echo $blog['title']; ?></option>
                                            <?php endif; ?>
										<?php endforeach; ?>
                                    </select>
								</div><!-- /.col -->
								<?php endif; ?>
							</div><!-- /form-group -->
						</div><!-- // .setBlogData -->	
						
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
								<a href="<?php echo base_url()?>articles/dashboard" class="btn btn-primary">Cancel</a>	
                            </div>
						</div><!-- /form-group -->
					</div>	
				</div>
			</div><!-- /panel -->
		</div><!-- /.col -->
	<div class="setArticleData">
	<?php for($i=1;$i<=10;$i++) : ?>
		<div id="gallery_item_<?php echo $i; ?>" class="gallery_items">
			<div class="col-md-6">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div class="panel-body">
							<div class="form-group">
								<label for="select_<?php echo $i; ?>" class="col-lg-3 control-label">Enable section</label>
								<div class="col-lg-9">
									<input type="checkbox" class="checkbox_enable" placeholder="" value="" name="gallery_item_chk_<?php echo $i; ?>" id="gallery_item_chk_<?php echo $i; ?>"   onclick="activateGalleryItem(<?php echo $i; ?>);" />
									<span class="custom-checkbox">
									   <b> Gallery Item <?php echo $i; ?></b>
									</span>
								</div><!-- /.col -->
							</div><!-- /form-group --><br/> <br/>
							<div class="form-group">
								<label for="articleTitle_<?php echo $i; ?>" class="col-lg-3 control-label">Gallery Item Title</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" placeholder="Gallery Item Title" value="" name="articleTitle_<?php echo $i; ?>" id="articleTitle_<?php echo $i; ?>" onclick="checkGalleryItem(<?php echo $i; ?>)" disabled="true">
								</div><!-- /.col -->
							</div><!-- /form-group --><br/><br/>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-3 control-label">Gallery Item Description</label>
								<div class="col-lg-9">
									<textarea name="articleDescription_<?php echo $i;?>" id="articleDescription_<?php echo $i; ?>" disabled="true" class="articleDescription"></textarea>
								</div><!-- /.col -->
							</div><!-- /form-group -->
					</div>
				</div><!-- /panel -->
			</div>
		</div>	
	<?php endfor; ?>
	</div>
	</div>
	<div class="actions" style="text-align:right;">
		<button id="btn_add_more" class="btn btn-success" type="button">Add More Gallery Items</button> 
	</div>	
	<input type="hidden" id="add_more_count" name="add_more_count" value="0"/>
    <input type="hidden" id="galleryItems" name="galleryItems" value="1"/>	
	</form>
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
			if(aid){
			 	$(".setArticleData").show();
				$(".actions").show();
			}
			else
			{
				$(".setArticleData").hide();
				$(".actions").hide();
			}
	}

	function activateGalleryItem(galleryItemID){
		//alert($('#gallery_item_chk_'+galleryItemID).prop('checked'));
		if($('#gallery_item_chk_'+galleryItemID).prop('checked')==true){
			$("#gallery_item_"+galleryItemID).css('opacity','1');
			$('#articleTitle_'+galleryItemID).addClass('validate[required]');
			$('#articleTitle_'+galleryItemID).prop("disabled", false );
			$('#articleImage_'+galleryItemID).prop( "disabled", false );
            $('#articleVideo_'+galleryItemID).prop( "disabled", false );
			$('#articleDescription_'+galleryItemID).prop( "disabled", false );
			addGalleryItem(galleryItemID);
		}
		else
		{
			//$("#gallery_item_"+galleryItemID).css('opacity','0.4');
			//$('#articleTitle_'+galleryItemID).removeClass('validate[required]');
			//$('#articleImage_'+galleryItemID).removeClass('validate[required]');
			$('#articleTitle_'+galleryItemID).prop( "disabled", true );
			$('#articleImage_'+galleryItemID).prop( "disabled", true );
                        $('#articleVideo_'+galleryItemID).prop( "disabled", true );
			$('#articleDescription_'+galleryItemID).prop( "disabled", true );
			removeGalleryItem(galleryItemID);
		}
	}

	function checkGalleryItem(chkId){
		if($('#gallery_item_chk_'+chkId).prop('checked')!=true){
			alert("Please select Gallery Item "+chkId);
		}
	}

	function addGalleryItem(galleryItemID){
		var items=$('#galleryItems').val();
		if(items!=""){
			$('#galleryItems').val(items+","+galleryItemID);
		}
		else
		{
			$('#galleryItems').val(galleryItemID);
		}
	}

	function removeGalleryItem(galleryItemID){
		var items=$('#galleryItems').val();
		var array_items = items.split(',');
		var idx;
		var array_items_count=array_items.length;
		for(var i=0;i<array_items_count;i++){
			if(array_items[i]==galleryItemID){
				idx=i;
			}
		}
		array_items.splice(idx, 1);
		var finalItems=array_items.toString();
		$('#galleryItems').val(finalItems);
	}

	
</script>
<script>
	$(document).ready(function(){
		//$("#gallery_item_1").css('opacity','1');
		$('#gallery_item_chk_1').prop('checked', true);
		$('#articleTitle_1').addClass('validate[required]');
		//$('#articleImage_1').addClass('validate[required]');
		$('#articleTitle_1').prop("disabled", false );
		$('#articleImage_1').prop( "disabled", false );
                $('#articleVideo_1').prop( "disabled", false );
		$('#articleDescription_1').prop( "disabled", false );

		$("#btn_add_more").click(function(){
			var hint=$("#add_more_count").val();
			hint++;
			$("#add_more_count").val(hint);
			$.ajax({
				url:base_url+"articles/dashboard/getGalleryItemBlocks/"+hint,
				//beforeSend: $("#btn_add_more").button('loading');
				//complete:   $("#btn_add_more").button('reset');
				success:function(result){
					$(".setArticleData").append(result);
			}});
		});

		$(".setData").hide();
		$('#frm_addArticle').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
                $("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addArticle").validationEngine('validate'))
				{
                    var items=$('#galleryItems').val();
					var array_items = items.split(',');
					var msg="";
					var array_items_count=array_items.length;
					for(var i=0;i<array_items_count;i++){
						//alert($('#articleVideo_'+array_items[i]).val());
							if(($('#articleImage_'+array_items[i]).val()=="") && ($('#articleVideo_'+array_items[i]).val()=="")){
									msg+="Gallery item image or video is required for gallery item "+array_items[i]+"<br/>";
							}
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
					$("#successMessage").html("Gallery item created successfully.");
					$("#successMessage").show();
					//window.location=base_url+"articles/dashboard";
				}
				else if(responseText==103)
				{
					$("#errorMessage").html("Please select Post.");
					$("#errorMessage").show();
				}
				else
				{
					$("#successMessage").html(responseText);
					$("#successMessage").show();
					window.location=base_url+"articles/dashboard";
					
				}
			}
		});
		$("#frm_addArticle").validationEngine();


	});

</script>
<script>
      jQuery(function($){
          $('.articleDescription').editable({inlineMode: false, height: 300,
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