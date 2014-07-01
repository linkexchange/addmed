<?php //echo "<pre>"; print_r($ad); echo "</pre>"; ?>
<?php foreach($ad as $item) : ?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                	
                    <div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>Edit Ad</h3>
						</div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"></div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                                	<form class="form-horizontal" id="frm_editAdvertise" action="" method="POST" enctype="multipart/form-data" >
										<fieldset>
                                        	<div class="control-group">
                                                <label for="template" class="control-label">Website Title</label>
                                                <div class="controls">
                                                	<input name="adID" id="adID" type="hidden" value="<?php echo $item['id']; ?>" />
                                                    <input name="templateID" id="templateID" type="hidden" value="<?php echo $item['templateID']; ?>" />
                                                	<input type="text" id="template" name="template" value="<?php echo $item['name'];?>" placeholder="" class="validate[required]" disabled="disabled">
                                               	</div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                        	
                                            <div class="control-group">											
                                                <label for="adUnit1" class="control-label">Ad Unit 1 <br/>(728x100 px)</label>
                                                <div class="controls">
                                                    <textarea name="adUnit1" id="adUnit1" class="validate[required]" cols="100" rows="3" placeholder="Ad Size XXX x XXX" style="width:auto;"><?php echo $item['adUnit1'];?></textarea>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">											
                                                <label for="adUnit2" class="control-label">Ad Unit 2<br/>(728x100 px)</label>
                                                <div class="controls">
                                                    <textarea name="adUnit2" id="adUnit2" class="validate[required]" cols="100" rows="3" placeholder="Ad Size XXX x XXX" style="width:auto;"><?php echo $item['adUnit2'];?></textarea>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">											
                                                <label for="adUnit3" class="control-label">Ad Unit 3<br/>(728x300 px)</label>
                                                <div class="controls">
                                                    <textarea name="adUnit3" id="adUnit3" class="validate[required]" cols="100" rows="10" placeholder="Ad Size XXX x XXX" style="width:auto;"><?php echo $item['adUnit3'];?></textarea>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">											
                                                <label for="adUnit4" class="control-label">Ad Unit 4<br/>(728x400 px)</label>
                                                <div class="controls">
                                                    <textarea name="adUnit4" id="adUnit4" class="validate[required]" cols="100" rows="10" placeholder="Ad Size XXX x XXX" style="width:auto;"><?php echo $item['adUnit4'];?></textarea>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">											
                                                <label for="adUnit5" class="control-label">Ad Unit 5<br/>(300x300 px)</label>
                                                <div class="controls">
                                                    <textarea name="adUnit5" id="adUnit5" class="validate[required]" cols="50" rows="10" placeholder="Ad Size XXX x XXX" style="width:auto;"><?php echo $item['adUnit5'];?></textarea>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">											
                                                <label for="adUnit6" class="control-label">Ad Unit 6<br/>(300x300 px)</label>
                                                <div class="controls">
                                                    <textarea name="adUnit6" id="adUnit6" class="validate[required]" cols="50" rows="10" placeholder="Ad Size XXX x XXX" style="width:auto;"><?php echo $item['adUnit6'];?></textarea>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">											
                                                <label for="adMobile1" class="control-label">Ad Mobile 1<br/>(300x100 px)</label>
                                                <div class="controls">
                                                    <textarea name="adMobile1" id="adMobile1" class="validate[required]" cols="50" rows="3" placeholder="Ad Size XXX x XXX" style="width:auto;"><?php echo $item['adMobile1'];?></textarea>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">											
                                                <label for="adMobile2" class="control-label">Ad Mobile 2<br/>(300x100 px)</label>
                                                <div class="controls">
                                                    <textarea name="adMobile2" id="adMobile2" class="validate[required]" cols="50" rows="3" placeholder="Ad Size XXX x XXX" style="width:auto;"><?php echo $item['adMobile2'];?></textarea>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">											
                                                <label for="adMobile3" class="control-label">Ad Mobile 3<br/>(300x100 px)</label>
                                                <div class="controls">
                                                    <textarea name="adMobile3" id="adMobile3" class="validate[required]" cols="50" rows="3" placeholder="Ad Size XXX x XXX" style="width:auto;"><?php echo $item['adMobile3'];?></textarea>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">	
                                                <div class="controls">
                                                    <button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
                                                    <a href="<?php echo base_url()?>admin/advertisement" class="btn">Cancel</a>								 												</div>
                                            </div> <!-- /control-group -->
                                        </fieldset>
                                    </form>
                                </div><!--widget-content inner-->
                           	</div><!--big-stats-container-->
                       	</div><!--widget-content-->
                   	</div><!--widget-->
                </div><!--span12-->
            </div><!--row-->
       	</div><!--container-->
   	</div><!--main-inner-->
</div><!--main-->
<script>
	$(document).ready(function(){
		$(".setData").hide();
		$('#frm_editAdvertise').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editAdvertise").validationEngine('validate'))
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
					$("#successMessage").html("Ad edited successfully.");
					$("#successMessage").show();
					window.location=base_url+"admin/advertisement/index/0/1";
				}
				/*else if(responseText>0)
				{
					$("#errorMessage").html(responseText);
					$("#errorMessage").show();
				}*/
			}
		});
		//$("#frm_signup").validationEngine();
	});

</script>
<?php endforeach; ?>