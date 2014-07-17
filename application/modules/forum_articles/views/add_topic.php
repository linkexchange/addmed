<link href="<?php echo base_url(); ?>css/font-awesome.min_1.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/froala_editor.min.css" rel="stylesheet" type="text/css">
<div id="main-container">

<div class="padding-md">
	<div class="row">
			<div class="col-md-6" style="width:80%;">
						<div class="panel panel-default" style="border:1px solid lightgray;">
							<form class="form-horizontal form-border" id="frm_topic" method="post" enctype="multipart/form-data">
								<div class="panel-heading">
									<h4><b>Add topic</b></h4>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-lg-3">Topic name</label>
										<div class="col-lg-9">
											<input type="text" class="form-control validate[required]" placeholder="topic name" value="" name="topic">
										</div><!-- /.col -->
									</div><!-- /form-group -->
									<div class="form-group">
										<label class="control-label col-lg-3">Your Name</label>
										<div class="col-lg-9">
											<input type="text" class="form-control validate[required]" placeholder="author name" value="" name="author">
										</div><!-- /.col -->
									</div><!-- /form-group -->
									<div class="form-group">
										<label class="control-label col-lg-3">Email</label>
										<div class="col-lg-9">
											<input type="text" class="form-control validate[required,custom[email]]" placeholder="email" value="" name="email">
										</div><!-- /.col -->
									</div><!-- /form-group -->
									<div class="form-group">
										<label class="control-label col-lg-3">Topic Description</label>
										<div class="col-lg-9">
											<textarea name="topicDescription" id="topicDescription" class="validate[required]"></textarea>
										</div><!-- /.col -->
									</div><!-- /form-group -->
								</div>
								<div class="panel-footer text-right">
									<button type="submit" id="btn_topic" class="btn btn-success">Submit</button>
									<a href="<?php echo base_url();?>" class="btn">Cancel</a>
								</div>
							</form>
						</div><!-- /panel -->
					</div>
	</div><!-- /.row -->
</div>
</div>
<script>
	$(document).ready(function(){
		$('#frm_topic').ajaxForm({
			beforeSubmit : function(){
				$("#btn_topic").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_topic").validationEngine('validate'))
				{
					$("#btn_topic").button('loading');
					return true;
				}
				else
				{
					$("#btn_topic").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#btn_topic").button("reset");
				if(responseText==100)
				{
					$("#successMessage").html("Your topic is under approval process.You can see it after approval.");
					$("#successMessage").show();
					//alert("Data inserted successfully");
					window.location = base_url+'forum';
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
		
	});
</script>
<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 
<script>
      jQuery(function($){
          $('#topicDescription').editable({inlineMode: false, height: 500})
      });
</script>


