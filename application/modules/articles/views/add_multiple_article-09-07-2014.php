<link href="<?php echo base_url(); ?>css/font-awesome.min_1.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/froala_editor.min.css" rel="stylesheet" type="text/css"> 
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
<div class="main">
    <div class="main-inner">
	<div class="container">
            <div class="row">
                <div class="span12">
                    <div class="widget">
                        <div class="widget-header"> 
                            <i class="icon-list-alt"></i>
                            <h3>Add Gallery Items</h3>
			</div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<div id="successMessage" class="alert alert-success" style="display:none"></div>
                    	<div class="widget-content">
                            <div class="big-stats-container">
                                <div class="widget-content inner">
                                    <?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
                                    <form class="form-horizontal" id="frm_addArticle" action="<?php echo base_url(); ?>articles/dashboard/addMultipleItems" method="POST" enctype="multipart/form-data" >
                                        <fieldset>
                                            <div class="control-group">
                                                <label for="template" class="control-label">Select Website</label>
                                                <div class="controls">
                                                    <select id="templateID" name="templateID" class="validate[required]" onchange="getBlogs(this.value);">
                                                        <option value="">Please Select</option>
                                                        <?php foreach($templates as $template) : ?>
                                                            <?php if($template['id']==$tempID || $template['id']==$this->uri->segment(4)) : ?>
                                                                <option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="setBlogData">
                                                <?php if($this->uri->segment(4) && $this->uri->segment(5)) : ?>
                                                    <?php //echo "<pre>"; print_r($blogs); echo "</pre>"; ?>
                                                    <div class="control-group">
                                                        <label for="blog" class="control-label">Select Post</label>
                                                        <div class="controls">
                                                            <select id="blogID" name="blogID" class="validate[required]" onchange="getDetails(this.value);">
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
							</div> <!-- /controls -->				
                                                    </div> <!-- /control-group -->
						<?php endif; ?>
                                            </div><!-- // .setBlogData -->
                                            <div class="actions">
                                                <div class="control-group">	
                                                    <div class="controls" style="text-align:right;">
                                                        <button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
							<a href="<?php echo base_url()?>articles/dashboard" class="btn">Cancel</a>	
                                                    </div>
						</div> <!-- /control-group -->
                                            </div>
                                            <div class="setArticleData">
                                                <?php for($i=1;$i<=10;$i++) : ?>
                                                    <div id="gallery_item_<?php echo $i; ?>" class="gallery_items" >
                                                        <div class="control-group">		
                                                            <label for="select_<?php echo $i; ?>" class="control-label">Enable Section</label>
                                                            <div class="controls">
                                                                <input type="checkbox" class="checkbox_enable" placeholder="" value="" name="gallery_item_chk_<?php echo $i; ?>" id="gallery_item_chk_<?php echo $i; ?>"   onclick="activateGalleryItem(<?php echo $i; ?>);" /> Gallery Item <?php echo $i; ?>
                                                            </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                                                        <div class="control-group">
                                                            <label for="articleTitle_<?php echo $i; ?>" class="control-label">Gallery Item Title</label>
                                                            <div class="controls">
                                                                <input type="text" class="" placeholder="Gallery Item Title" value="" name="articleTitle_<?php echo $i; ?>" id="articleTitle_<?php echo $i; ?>" onclick="checkGalleryItem(<?php echo $i; ?>)" disabled="true">
                                                            </div> <!-- /controls -->				
							</div> <!-- /control-group -->
                                                        <div class="control-group">											
                                                            <label for="articleImage_<?php echo $i; ?>" class="control-label">Gallery Item Image</label>
                                                            <div class="controls">
                                                                <input type="file" class="" name="articleImage_<?php echo $i; ?>" id="articleImage_<?php echo $i; ?>" size="20" disabled="true">
                                                                <p class="help-block">Maximum allwoed image size is 10MB.</p>
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->
                                                        <div class="control-group or-class">											
                                                            <p>OR</p>			
                                                        </div> <!-- /control-group -->
                                                        <div class="control-group">
                                                            <label for="articleVideo_<?php echo $i; ?>" class="control-label">Gallery Item Video</label>
                                                            <div class="controls">
                                                               <textarea name="articleVideo_<?php echo $i; ?>" id="articleVideo_<?php echo $i; ?>" disabled="true"></textarea>
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->
						        <div class="control-group">
                                                            <label for="articleDescription_<?php echo $i; ?>" class="control-label">Gallery Item Description</label>
                                                            <div class="controls">
                                                                <textarea name="articleDescription_<?php echo $i; ?>" id="articleDescription_<?php echo $i; ?>" disabled="true" class="articleDescription"></textarea>
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->
                                                    </div>
						<?php endfor; ?>
                                            </div>
                                            <div class="actions">
                                                <div class="control-group">	
                                                    <div class="controls" style="text-align:right;">
							<button id="btn_add_more" class="btn btn-primary" type="button">Add More Gallery Items</button> 
                                                    </div>
						</div> <!-- /control-group -->
                                            </div>
                                            <input type="hidden" id="add_more_count" name="add_more_count" value="0" />
                                            <input type="hidden" id="galleryItems" name="galleryItems" value="1" />
                                        </fieldset>
                                    </form>
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div><!-- widget -->
                </div><!-- span12 -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- main-inner -->
</div> <!-- main -->
<script>
	function getBlogs(bid){
			if(bid){
			 $.ajax({
				url:base_url+"articles/dashboard/getTemplateBlogs/"+bid,
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
		//alert($('#gallery_item_chk_'+galleryItemID).attr('checked'));
		if($('#gallery_item_chk_'+galleryItemID).attr('checked')=='checked'){
			$("#gallery_item_"+galleryItemID).css('opacity','1');
			$('#articleTitle_'+galleryItemID).addClass('validate[required]');
			
			//$('#articleImage_'+galleryItemID).addClass('validate[required]');
			$('#articleTitle_'+galleryItemID).prop("disabled", false );
			$('#articleImage_'+galleryItemID).prop( "disabled", false );
                        $('#articleVideo_'+galleryItemID).prop( "disabled", false );
			$('#articleDescription_'+galleryItemID).prop( "disabled", false );
			addGalleryItem(galleryItemID);
		}
		else
		{
			//$("#gallery_item_"+galleryItemID).css('opacity','0.4');
			$('#articleTitle_'+galleryItemID).removeClass('validate[required]');
			//$('#articleImage_'+galleryItemID).removeClass('validate[required]');
			$('#articleTitle_'+galleryItemID).prop( "disabled", true );
			$('#articleImage_'+galleryItemID).prop( "disabled", true );
                        $('#articleVideo_'+galleryItemID).prop( "disabled", true );
			$('#articleDescription_'+galleryItemID).prop( "disabled", true );
			removeGalleryItem(galleryItemID);
		}
	}

	function checkGalleryItem(chkId){
		if($('#gallery_item_chk_'+chkId).attr('checked')!='checked'){
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
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
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
		//$("#frm_signup").validationEngine();


	});

</script>
<script>
      jQuery(function($){
          $('.articleDescription').editable({inlineMode: false, height: 500})
      });
</script>
<!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script> -->
<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 