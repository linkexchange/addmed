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
				<div style="width:50%">
					<div class="panel-heading"><h3> <i class="icon-globe"></i> Edit Bookmark</h3></div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div class="panel-body">
						<form class="form-horizontal" id="frm_editBookmark" action="" method="POST" enctype="multipart/form-data" >
							<div class="form-group">
								<label for="Name" class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10">
									<input type="text" class="form-control input-sm validate[required]" value="<?php echo $bookmark[0]['name']; ?>" placeholder="Enter name" name="bookmark" id="bookmark">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Url" class="col-lg-2 control-label">Url</label>
								<div class="col-lg-10">
									<input type="text" class="form-control input-sm validate[required]"  value="<?php echo $bookmark[0]['url']; ?>" name="url" id="url" readonly>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="edit_bkmark" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url(); ?>bookmarks" class="btn btn-primary">Cancel</a>
								</div><!-- /.col -->
							</div><!-- /form-group -->
						</form>
					</div>
				</div>	
				</div><!-- /panel -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div>
<script>
	$(document).ready(function(){
		$('#frm_editBookmark').ajaxForm({
			beforeSubmit : function(){
				$("#edit_bkmark").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_editBookmark").validationEngine('validate'))
				{
					$("#edit_bkmark").button('loading');
					return true;
				}
				else
				{
					$("#edit_bkmark").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#edit_bkmark").button("reset");
				if(responseText==100)
				{
					$("#successMessage").html("Bookmark updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"forum_articles/listing/show_bookmarks";
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