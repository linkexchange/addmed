<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php if(isset($topic[0]['name'])){?>
	<title><?php echo $topic[0]['name'];?>||Social Traffic Center</title>
	<?php } else if(isset($article[0]['topic'])){ ?>
	<title><?php echo $article[0]['topic'];?>||Social Traffic Center</title>
	<?php } else {?>
	<title>Social Traffic Center</title>
	<?php } ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Font Awesome-->
	<link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet">

	<!-- Pace -->
	<link href="<?php echo base_url();?>css/pace.css" rel="stylesheet">
	
	<!-- Datatable -->
	<link href="<?php echo base_url();?>css/jquery.dataTables_themeroller.css" rel="stylesheet">
	
	<!-- Endless -->
	<link href="<?php echo base_url();?>css/endless.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/endless-skin.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/font-awesome.min_1.css" rel="stylesheet" type="text/css">
	<!--<link href="<?php echo base_url(); ?>css/froala_editor.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/validation/validationEngine.jquery.css" rel="stylesheet">-->
	<script>
		var base_url = "<?php echo base_url(); ?>";
	</script>
	<script src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
	<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine-en.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
	<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>-->
  </head>

  <body class="overflow-hidden">
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>

	
	
	<div id="wrapper" class="preload">
		<?php $this->load->view("common/forum_nav");?>
		<?php echo $content_for_layout;?>
		<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	
	<!-- Logout confirmation -->
	<div class="custom-popup width-100" id="logoutConfirm">
		<div class="padding-md">
			<h4 class="m-top-none"> Do you want to logout?</h4>
		</div>

		<div class="text-center">
			<a class="btn btn-success m-right-sm" href="<?php echo base_url();?>user/forumlogout">Logout</a>
			<a class="btn btn-danger logoutConfirm_close">Cancel</a>
		</div>
	</div>
	</div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	<!-- Jquery -->

	
	<!-- Bootstrap -->
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
 
	<!-- Datatable -->
	<script src='<?php echo base_url();?>js/jquery.dataTables.min.js'></script>	
	
	<!-- Modernizr -->
	<script src='<?php echo base_url();?>js/modernizr.min.js'></script>
	
	<!-- Pace -->
	<script src='<?php echo base_url();?>js/pace.min.js'></script>
	
	<!-- Popup Overlay -->
	<script src='<?php echo base_url();?>js/jquery.popupoverlay.min.js'></script>
	
	<!-- Slimscroll -->
	<script src='<?php echo base_url();?>js/jquery.slimscroll.min.js'></script>
	
	<!-- Cookie -->
	<script src='<?php echo base_url();?>js/jquery.cookie.min.js'></script>

	<!-- Endless -->
	<script src="<?php echo base_url();?>js/endless/endless.js"></script>
	
	<script>
		$(function	()	{
			$('#dataTable').dataTable( {
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
			});
			
			$('#chk-all').click(function()	{
				if($(this).is(':checked'))	{
					$('#responsiveTable').find('.chk-row').each(function()	{
						$(this).prop('checked', true);
						$(this).parent().parent().parent().addClass('selected');
					});
				}
				else	{
					$('#responsiveTable').find('.chk-row').each(function()	{
						$(this).prop('checked' , false);
						$(this).parent().parent().parent().removeClass('selected');
					});
				}
			});
		});
	</script>
	
	<!--<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 
	<script>
		  jQuery(function($){
			  $('#communityDescription').editable({inlineMode: false, height: 500})
		  });
	</script>-->
  </body>
</html>