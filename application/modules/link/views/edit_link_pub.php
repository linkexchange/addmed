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
					<div class="panel-heading"><h3> <i class="icon-globe"></i> Add bitly link</h3></div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"></div>
					<div style="width:50%;">
					<div class="panel-body">
						<form class="form-horizontal" id="frm_addLink" action="" method="POST">
							<div class="form-group">
								<label for="link" class="col-lg-2 control-label">URl to Publish</label>
								<div class="col-lg-10">
									<input type="hidden" value="<?php echo $url['id']; ?>" name="id">
							    	<input type="text" class="form-control validate[required,custom[url]]" placeholder="URL" value="<?php echo $url['url']; ?>" name="url" id="url" readonly="">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<label for="bitlyUrl" class="col-lg-2 control-label">Bitly URL</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $url['bitlyURL']; ?>" id="billyUrl" name="billyUrl" placeholder="Billy URL" class="form-control validate[required,custom[url]]">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button id="btn_submit" class="btn btn-success" type="submit">Save</button> 
									<?php if($this->session->userdata("userTypeID")==3) : ?>
										<a href="<?php echo base_url(); ?>publisher/dashboard" class="btn btn-primary">Cancel</a>
									<?php else : ?>
										<a href="<?php echo base_url(); ?>/link" class="btn btn-primary">Cancel</a>
									<?php endif; ?>
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
				$("#successMessage").html("You link Edited successfully...!");
				$("#successMessage").show();
				<?php if($this->session->userdata("userTypeID")==3) : ?>
					window.location=base_url+"publisher/dashboard";
				<?php else : ?>
					window.location=base_url+"link";
				<?php endif; ?>
			}
		});
	});
</script>