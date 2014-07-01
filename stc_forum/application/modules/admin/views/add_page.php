 <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
 <script type="text/javascript">

 /* bkLib.onDomLoaded(function() {
        new nicEditor({fullPanel : true}).panelInstance('description');
  });
  */
</script>

<div class="widget">
	<div class="widget-header"> <i class="icon-list-alt"></i>
		<h3>Add Page</h3>
	</div>
	<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
	<div id="successMessage" class="alert alert-success" style="display:none"></div>
	<!-- /widget-header -->
	<div class="widget-content">
		<div class="big-stats-container">
			<div class="widget-content">
				<div id="formcontrols" class="tab-pane active">
                	 <?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
					<form class="form-horizontal" id="frm_addPage" action="" method="POST" enctype="multipart/form-data" >
						<fieldset>
							<div class="control-group">
                            	<label for="template" class="control-label">Select Website</label>
								<div class="controls">
									<select id="templateID" name="templateID" class="validate[required]" onchange="getDetails(this.value); ">
										<option value="">Please Select</option>
										<?php foreach($templates as $item) : ?>
										<option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
							<div class="setData" style="border:0px solid red;">
								<div class="control-group">	   										
                                    <label for="title" class="control-label">Page Title</label>
                                    <div class="controls">
                                        <input type="text" class="validate[required]" placeholder="Page Title" name="title" id="title">
                                    </div> <!-- /controls -->				
								</div> <!-- /control-group -->
                                
                                <div class="control-group">	   
									<label for="description" class="control-label">Page Description</label>
                                    <div class="controls">
                                        <!--<input type="file" class="validate[required]" placeholder="Blog Image" value="" name="image" id="image">-->							
										<textarea style="height:300px; width:500px;" cols="200" 
										name="description" id="description"></textarea>
										
									</div> <!-- /controls -->				
								</div> <!-- /control-group -->
							</div>
							
							<div class="control-group">	
								<div class="controls">
									<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> 
									<a href="<?php echo base_url()?>admin/pages" class="btn">Cancel</a>								
								</div>
							</div> <!-- /control-group -->
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
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
					window.location=base_url+"admin/pages";
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
