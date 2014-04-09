<?php
if($this->session->userdata('userID') && ($this->uri->segment(2)=="login" || $this->uri->segment(2)=="sign_up"))
{
	redirect(base_url()."dashboard/admin");
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Link Exchange</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
				rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/pages/dashboard.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/pages/signin.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/validation/validationEngine.jquery.css" rel="stylesheet">

		<script src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script> 
		<script charset="utf-8" type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine-en.js"></script>
		<script charset="utf-8" type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<script>
			var base_url = "<?php echo base_url(); ?>";
		</script>
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
		  <div class="navbar-inner">
			<div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
							class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="<?php if($this->session->userData("userTypeID") == "2") { echo base_url()."advertiser/dashboard"; } else if($this->session->userData("userTypeID") == "3") { echo base_url()."publisher/dashboard"; } else if($this->session->userData("userTypeID") == "1") { echo base_url()."admin/dashboard"; }?>">Link Exchange Admin</a>
			<div class="nav-collapse">
			<?php
			if( $this->session->userdata('userID'))
			{
			?>
			
				<ul class="nav pull-right">
				  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
									class="icon-cog"></i> Account <b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="javascript:;">Settings</a></li>
					  <li><a href="javascript:;">Help</a></li>
					</ul>
				  </li>
				  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
									class="icon-user"></i> <?php echo $this->session->userdata('userName'); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="javascript:;">Profile</a></li>
					  <li><a href="<?php echo base_url(); ?>user/logout/">Logout</a></li>
					</ul>
				  </li>
				</ul>
				<form class="navbar-search pull-right">
				  <input type="text" class="search-query" placeholder="Search">
				</form>
			 
			  <?php
			}
			else
			{
			?>
					<ul class="nav pull-right">
					<?php
					if($this->uri->segment(2)=="login" || $this->uri->segment(2)=="")
					{
					?>
						<li class="">						
							<a class="" href="<?php echo base_url(); ?>user/sign_up">
								Don't have an account? create one.
							</a>
							
						</li>
					<?php
					}
					else if($this->uri->segment(2)=="sign_up" || $this->uri->segment(2)=="")
					{
					?>
						<li class="">						
								<a class="" href="<?php echo base_url(); ?>user/login">
									Already have an account? Login now
								</a>
								
							</li>
					<?php
					}
					?>
					</ul>
			<?php
			}
			?>
				 </div>
			  <!--/.nav-collapse --> 
			</div>
			<!-- /container --> 
		  </div>
		  <!-- /navbar-inner --> 
		</div>
		<?php
			if( $this->session->userdata('userID'))
			{
				$this->load->view("common/sub-nav");
			}
		?>
		<?php echo $content_for_layout ?>
		<?php
			if( $this->session->userdata('userID'))
			{
			?>
			<!-- /bottom of the page -->
			<div class="extra">
			  <div class="extra-inner">
				<div class="container">
				  <div class="row">
								<div class="span3">
									<h4>
										About Admin </h4>
									<ul>
										<li><a href="javascript:;">extra links</a></li>
									</ul>
								</div>
								<!-- /span3 -->
								<div class="span3">
									<h4>
										Support
									</h4>							
									<ul>
										<li><a href="javascript:;">extra links</a></li
									</ul>
								</div>
								<!-- /span3 -->
								<div class="span3">
									<h4>
										Something Legal</h4>
									<ul>
										<li><a href="javascript:;">extra links</a></li>
									</ul>
								</div>
								<!-- /span3 -->
							</div>
				  <!-- /row --> 
				</div>
				<!-- /container --> 
			  </div>
			  <!-- /extra-inner --> 
			</div>
			<!-- /extra -->
		<?php
			}
			else
			{
				?>
				<div class="login-extra">
				<?
				if($this->uri->segment(2)=="login")
				{
				?>	
					<a href="#">Reset Password</a>
				<?php
				}
				?>
				</div>
		<?php
			}
		?>

		<div class="footer">
		  <div class="footer-inner">
			<div class="container">
			  <div class="row">
				<div class="span12"> &copy; 2013 <a href="http://www.egrappler.com/">Bootstrap Responsive Admin Template</a>. </div>
				<!-- /span12 --> 
			  </div>
			  <!-- /row --> 
			</div>
			<!-- /container --> 
		  </div>
		  <!-- /footer-inner --> 
		</div>
		<!-- /footer --> 
		<!-- Le javascript
		================================================== --> 
		<!-- Placed at the end of the document so the pages load faster --> 
		<script src="<?php echo base_url(); ?>s/excanvas.min.js"></script> 
		<script src="<?php echo base_url(); ?>js/chart.min.js" type="text/javascript"></script> 
		<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
	</body>
</html>
