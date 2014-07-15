<?php for($l=0;$l<count($comments);$l++){ ?>
	<h4>Comment</h4>
	<div style="width:100%;border: 1px solid #dddddd; border-radius:5px; background-color:#f5f5f5;"><hr>&nbsp; &nbsp; 
	<b><?php echo $comments[$l]['name'];?></b>&nbsp; &nbsp; 
	<?php echo $comments[$l]['created_date'];?>
	<br/> &nbsp; &nbsp;
	<?php echo $comments[$l]['description'];?><br/>&nbsp; &nbsp;
	
	<a href="#" onclick="display(<?php echo $l;?>);return false;">Reply</a>
	<form class="form-horizontal" id="frm_Reply2" action="" method="POST" enctype="multipart/form-data">
	<div id="number_<?php echo $l;?>">	
	<div id="reply_desc_<?php echo $l;?>" style="display:none;">
	<fieldset>
	<div class="control-group">
		<label for="template" class="control-label">
			Reply:
		</label>
		<div class="controls">
			<textarea name="reply_description" class="validate[required]"></textarea>
		</div>
	</div>
	<div class="control-group">
		<label for="template" class="control-label">
		Your Name:
		</label>
		<div class="controls">
		<input type="text" name="name2" class="validate[required]">	
		</div>
	</div>
	<div class="control-group">
		<label for="template" class="control-label">
		Your Email:
		</label>
		<div class="controls">
		<input type="text" name="email2" class="validate[required,custom[email]]">	
		</div>
	</div>	
	<input type="hidden" name="articleid" value="<?php echo $this->uri->segment(4);?>">
	<input type="hidden" name="commentid" value="<?php echo $comments[$l]['id'];?>">

	<div class="control-group">	
		<div class="controls">
		<button id="btn_submit2" class="btn btn-primary" type="submit" onclick='submitDatain(<?php echo $l;?>);'>Save</button>
		<a href="#" onclick="hide(<?php echo $l;?>);return false;" class="btn">Cancel</a>	
		</div>
	</div> <!-- /control-group -->
	</fieldset>

	</div>
	</form>
	<div id="replies_<?php echo $l;?>" style="margin-left: 30px;">
	<?php  
		for($m=0;$m<count($replies);$m++) {
			if($replies[$m]['parent_id']==$comments[$l]['id']) {?>&nbsp; &nbsp; &nbsp; &nbsp;
			<b><?php echo $replies[$m]['name'];?></b>&nbsp; &nbsp; 
			<?php echo $replies[$m]['created_date'];?>
			<br/> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 
			<?php echo $replies[$m]['description'];?>
			&nbsp; <a href="#" onclick="display2(<?php echo $m;?>,<?php echo $replies[$m]['id']?>);return false;">Reply</a>
			<div id="reply_<?php echo $m;?>" 
			style="display:none;">
			</div>
			<div id="setReplies"> 
			</div>
			<hr>
	<?php		
			}
		}	
	?>
	</div>
	</div>
	</div>
<hr>	
<?php } ?>
<script>
function submitDatain(no)
	{
		$('#frm_Reply2').ajaxForm({
			beforeSubmit : function(){
				$("#btn_submit2").button('loading');
				if($("#frm_Reply2").validationEngine('validate'))
				{
					$("#btn_submit2").button('loading');
					return true;
				}
				else
				{
					$("#btn_submit2").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#btn_submit2").button("reset");
				if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else if(responseText==100) 
				{
					//alert(responseText);
					//$("#reply_desc_"+no).hide();
					//$("#replies_"+no).prepend(responseText);
					location.reload =base_url+"forum_articles/listing/view/"+<?php echo $id;?>;				
				}
			}
		});
	}
</script>