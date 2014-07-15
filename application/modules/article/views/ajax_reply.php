
&nbsp; &nbsp; &nbsp; &nbsp;
<b><?php echo $replies[0]['name'];?></b>&nbsp; &nbsp; 
<?php echo $replies[0]['created_date'];?>
<br/> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 
<?php echo $replies[0]['description'];?>
&nbsp; <a href="#" onclick="displays();return false;">Reply</a>
<div id="reply_desc" style="display:none">
<form class='form-horizontal' id='form_Reply' action=''  method='POST' enctype='multipart/form-data'><fieldset>
<div class='control-group'><label for='template' class='control-label'>Reply:</label>
<div class='controls'><textarea name='reply_description2' class='validate[required]'></textarea></div></div>
<div class='control-group'><label for='template' class='control-label'>Your Name:</label>
<div class='controls'>
<input type='text' name='name3' class='validate[required]'></div></div>
<div class='control-group'><label for='template' class='control-label'>Your Email:</label>
<div class='controls'><input type='text' name='email3' class='validate[required,custom[email]]'></div></div>
<input type='hidden' name='articleid' value='<?php echo $this->uri->segment(4);?>'>
<input type='hidden' name='replyid' value='<?php echo $replies[0]['id']?>'>
<div class='control-group'>
<div class='controls'>
<button id='button_submit' onclick='submitDatas();' class='btn btn-primary' type='submit'>Save</button>&nbsp;
<a href='#' onclick='hidethis();return false;' class='btn'>Cancel</a>
</div></div>
</fieldset></form>
</div>
<div id="replies"> </div>
<script>
	function displays()
	{
		$("#reply_desc").show();
	}
	function hidethis()
	{		
		$("#reply_desc").hide();
	}
	function submitDatas()
	{
		$('#form_Reply').ajaxForm({
			beforeSubmit : function(){
				$("#button_submit").button('loading');
				if($("#form_Reply").validationEngine('validate'))
				{
					$("#button_submit").button('loading');
					return true;
				}
				else
				{
					$("#button_submit").button('reset');
					return false;
				}
			},
			success :  function(responseText, statusText, xhr, $form){
				$("#button_submit").button("reset");
				if(responseText==102)
				{
					$("#errorMessage").html("Please try again..");
					$("#errorMessage").show();
					//window.location=base_url+"publisher/dashboard";
				}
				else
				{
					//alert(responseText);
					$("#reply_desc").hide();
					$("#replies").prepend(responseText);
				}
			}
		});
	}
</script>
<hr>
