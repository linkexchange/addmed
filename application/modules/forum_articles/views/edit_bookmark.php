<div id="main-container">
<br/>
<div class="col-md-6">
		<div class="panel panel-default"  style="border:1px solid LightGray;">
			<div class="panel-heading"><h4><i class="icon-star fa-lg"></i> Edit Bookmark</h4></div>
			<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<div id="successMessage" class="alert alert-success" style="display:none"></div>
			<div class="panel-body">
				 <form class="form-horizontal" id="frm_editBookmark" action="" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control input-sm validate[required]" value="<?php echo $bookmark[0]['name']; ?>" placeholder="Enter name" name="bookmark" id="bookmark">
					</div><!-- /form-group -->
					<div class="form-group">
						<label for="url">Url</label>
						<input type="text" class="form-control input-sm validate[required]"  value="<?php echo $bookmark[0]['url']; ?>" name="url" id="url" readonly>
					</div><!-- /form-group -->
					<button id="edit_bkmark" type="submit" class="btn btn-success btn-sm">Submit</button>
					<a href="<?php echo base_url();?>bookmarks" class="btn">Cancel</a>
				</form>
			</div>
		</div><!-- /panel -->
	</div>
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
