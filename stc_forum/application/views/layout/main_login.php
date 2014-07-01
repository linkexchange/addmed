<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Link Exchange Phase II</title>
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
		<script>
			var base_url = "<?php echo base_url(); ?>";
		</script>
		<script src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script> 
		<script charset="utf-8" type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine-en.js"></script>
		<script charset="utf-8" type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script>  
		<script charset="utf-8" type="text/javascript" src="<?php echo base_url(); ?>js/common.js"></script>
		<!--<script src="https://code.jquery.com/jquery.js"></script>
		<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>-->
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
	</head>
	<body>
		
		<div class="navbar navbar-fixed-top">
		  <div class="navbar-inner">
			<div class="container"> 
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</a>
                <a class="brand" href="<?php echo base_url();?>">
					Link Exchange Dashboard
				</a>	
                <div class="nav-collapse">
					<?php
			if( $this->session->userdata('ForumUserID'))
			{
			?>
			
				<ul class="nav pull-right">
				  <!--<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-cog"></i> Account <b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="<?php if($this->session->userdata('userTypeID')==1) : echo base_url().$this->session->userdata('userType'); ?>/dashboard/settings <?php endif; ?>">Settings</a></li>
					  <li><a href="javascript:;">Help</a></li>
					</ul>
				  </li>-->
				  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
									class="icon-user"></i> <?php echo $this->session->userdata('ForumUserName'); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><!--<a href="<?php echo base_url(); ?>user/profile/edit/<?php echo $this->session->userdata('ForumUserID');?>">Profile</a>--></li>
					  <li><a href="<?php echo base_url(); ?>user/logout/">Logout</a></li>
					</ul>
				  </li>
				</ul>
				<!--<form class="navbar-search pull-right">
					<input type="text" class="search-query" placeholder="Search">
				</form>-->
			 
			  <?php
			}
			else
			{
			?>
					<ul class="nav pull-right">
						<li class="">						
								<a class="" href="<?php echo base_url();?>user/login">
									Login now
								</a>
								
						</li>
					</ul>
			<?php
			}
			?>
				</div>
                <!-- .nav-collapse -->
			</div>
			<!-- /container --> 
		  </div>
		  <!-- /navbar-inner --> 
		</div>
		<!-- /navbar --> 
        <?php $this->load->view("common/forum_nav");?>
        <div class="main">
			<div class="main-inner">
				<div class="container">
					<div class="row">
						<div class="span12">
       	 					<?php echo $content_for_layout ?>
                        </div><!-- .span12-->
                    </div><!-- .row -->
                </div><!-- .container -->
           	</div><!-- .main-inner -->
        </div><!-- .main -->
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
									></ul>
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
		<script src="<?php echo base_url(); ?>js/chart.min.js" type="text/javascript"></script> 
		<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
	</body>
</html>
