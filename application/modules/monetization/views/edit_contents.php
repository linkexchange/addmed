<style>
.col-lg-1 { width : 4.333333%; margin : 2px;}
</style>
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
				<h3><b><i class="icon-foursquare"></i>  Edit Contents</b> </h3>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="border:1px solid #D6E9F3;">
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:75%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_edit_contents" action="" method="POST">
							
							<div class="form-group">
								<label for="Article" class="col-lg-2 control-label">Article</label>
								<div class="col-lg-10">
									<select name="articleid" class="form-control validate[required]">
										<option value>Please Select</option>
										<option value="<?php echo $contents[0]["articleid"];?>" selected="selected"><?php echo $contents[0]["topic"];?></option>
										<?php foreach($articles as $article){ ?>
										<option value="<?php echo $article["id"];?>"><?php echo $article["topic"];?></option>
										<?php } ?>
									</select>	
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">Ratings</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required,custom[number,max[100]]]" placeholder="ratings in %"  name="ratings" id="ratings" value="<?php echo $contents[0]["ratings"];?>">
									<p><b>Please enter only integer or decimal value. Do not add % sign.</b></p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">No of articles</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required,custom[integer]" placeholder="No of articles"  name="no_of_articles" id="no_of_articles" value="<?php echo $contents[0]["no_of_articles"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="shortner" class="col-lg-2 control-label">Content Requests</label>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="requests" id="requests" value="yes" placeholder="Content Requests" <?php 
									if($contents[0]["content_requests"]=="yes") 
									{
										echo 'checked="checked"';				
									}
									?>>
								</div>
								<div class="col-lg-1">
									Yes
								</div>
								<div class="col-lg-1">
									<input type="radio" class="form-control validate[required]" name="requests" id="requests" value="no"
									<?php 
									if($contents[0]["content_requests"]=="no") 
									{
										echo 'checked="checked"';				
									}
									?>
									> 
								</div><!-- /.col -->
								<div class="col-lg-1">
									No
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">Article Quality</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required,custom[number,max[100]]]" placeholder="quality in %"  
									name="quality" id="quality" value="<?php echo $contents[0]["article_quality"];?>">
									<p><b>Please enter only integer or decimal value. Do not add % sign.</b></p>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">New Contents</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="new contents"  name="new_contents" id="new_contents"
									value="<?php echo $contents[0]["new_contents"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label for="dashboard" class="col-lg-2 control-label">Target Audience</label>
								<div class="col-lg-10">
									<input type="text" class="form-control validate[required]" placeholder="Target Audience"  name="target_audience" id="target_audience" value="<?php echo $contents[0]["target_audience"];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url();?>monetization/dashboard/contents" class="btn btn-primary">Cancel</a>
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
		$('#frm_edit_contents').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_edit_contents").validationEngine('validate'))
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
					$("#successMessage").html("Content Details has been updated successfully.");
					$("#successMessage").show();
					window.location=base_url+"monetization/dashboard/contents";
				}
				else if(responseText==301)
				{
					$("#errorMessage").html("Your session is expired.");
					$("#errorMessage").show();
					window.location=base_url+"user/login";
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