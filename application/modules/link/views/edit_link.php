<script>
	function getCategoryCPC(cid){
			if(cid){
				 $.ajax({
				url:base_url+"link/link/getCategoryCPC/"+cid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					$("#pricePerLink").val(result);
					
				}});
			 	
			}
			else
			{
				$("#pricePerLink").val();
			}
	}
</script>
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
					<div class="panel-heading"><h3> <i class="icon-anchor"></i> Edit Link </h3></div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:50%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_addLink" action="" method="POST">
							<div class="form-group">
								<label for="link" class="col-lg-2 control-label">URl to Publish</label>
								<div class="col-lg-10">
									<input type="hidden" value="<?php echo $url['id']; ?>" name="id">
									<input type="text" class="form-control input-sm validate[required,custom[url]]" placeholder="URL" value="<?php echo $url['url']; ?>" name="url" id="url">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="Title" class="col-lg-2 control-label">Title</label>
								<div class="col-lg-10">
									<input type="text" class="form-control input-sm validate[required]" placeholder="Title"  name="title" id="title" value="<?php echo $url['title'];?>">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="category" class="col-lg-2 control-label">Select Category</label>
								<div class="col-lg-10">
									<select name="category" class="form-control validate[required]" onchange="getCategoryCPC(this.value);">
										<?php
										if($url['categoryID']==0)
										{ ?>
										<option value="0">No category assigned</option>
										<?php } 
										for($i=0;$i<count($categories);$i++){
										if($categories[$i]['id']==$url['categoryID'])
										{ ?>
										<option value="<?php echo $categories[$i]['id']?>" selected="selected">
										<?php echo $categories[$i]['category_name'];?>
										</option>
										<?php } else {?>
										<option value="<?php echo $categories[$i]['id']?>">
										<?php echo $categories[$i]['category_name'];?>
										</option>	
										<?php } }?>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="pricePerLink" class="col-lg-2 control-label">Pay Per Click</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $url['payPerLink']; ?>" id="pricePerLink" name="payPerLink" placeholder="Pay Per Click" class="form-control link-fields price-field validate[required,custom[number]]" data-type="decimal">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<?php if($this->session->userdata("userTypeID")==1) : ?>
                            <div class="form-group">											
								<label for="percentage" class="col-lg-2 control-label">Admin Commision % </label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $url['percentage']; ?>" id="percentage" name="percentage" placeholder="Pay Per Click" class="form-control validate[required,custom[number]]" data-type="decimal">
								</div> <!-- /controls -->				
							</div> <!-- /control-group -->
                            <?php endif; ?>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<a href="<?php echo base_url(); ?>/link" class="btn btn-primary">Cancel</a>
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
		$('#frm_addLink').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit").button('loading');
				$("#successMessage").hide();
				$("#errorMessage").hide();
				if($("#frm_addLink").validationEngine('validate'))
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
				$("#successMessage").html("You link edited successfully...!");
				$("#successMessage").show();
				window.location=base_url+"link";
			}
		});
		});
</script>