<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php if(isset($topic[0]['name'])){?>
	<title><?php echo $topic[0]['name'];?>||Social Traffic Center</title>
	<?php } else if(isset($article[0]['topic'])){ ?>
	<title><?php echo $article[0]['topic'];?>||Social Traffic Center</title>
	<?php } else {?>
	<title>Advertiser || Social Traffic Center</title>
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
	<link href="<?php echo base_url();?>css/custom_sunil.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/endless-skin.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/font-awesome.min_1.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/froala_editor.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/validation/validationEngine.jquery.css" rel="stylesheet">
	<script>
		var base_url = "<?php echo base_url(); ?>";
	</script>
	<script src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/validation/jquery.validationEngine-en.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
	<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  </head>

  <body class="overflow-hidden">
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>

	
	
	<div id="wrapper" class="preload">
		<div id="top-nav" class="skin-6 fixed">
			<div class="brand">
				<span>Link Exchange</span>
				<span class="text-toggle">Advertiser</span>
			</div><!-- /brand -->
			<button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<ul class="nav-notification clearfix">
				<li class="profile dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<strong><?php echo $this->session->userdata("userName");?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url();?>user/profile">
								<?php if($this->session->userdata("userPic")) { ?>
								<img src="<?php echo base_url();?>uploads/user_profile_images/<?php echo $this->session->userdata("userPic");?>" alt="User Avatar">
								<?php } else { ?>
								<img src="<?php echo base_url();?>img/user.jpg" alt="User Avatar">
								<?php } ?>
								<div class="detail">
									<strong><?php echo $this->session->userdata("userName");?></strong>
									<br/>
								</a>	
								</div>
						</li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url();?>user/profile/edit/<?php echo $this->session->userdata("userID");?>"><i class="fa fa-user fa-lg"></i> Edit Profile</a></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /top-nav-->
		
		<aside class="fixed skin-6">			
			<div class="sidebar-inner scrollable-sidebar">
				
				<div class="size-toggle">
					<a class="btn btn-sm" id="sizeToggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="btn btn-sm pull-right logoutConfirm_open"  href="#logoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
				</div><!-- /size-toggle -->	
				<div class="user-block clearfix">
					<a href="<?php echo base_url();?>user/profile" style="color:#fff;">
					<?php if($this->session->userdata("userPic")) { ?>
					<img src="<?php echo base_url();?>uploads/user_profile_images/<?php echo $this->session->userdata("userPic");?>" alt="User Avatar">
					<?php } else { ?>
					<img src="<?php echo base_url();?>img/user.jpg" alt="User Avatar">
					<?php } ?>
					<div class="detail">
					<?php echo $this->session->userdata("userName");?><br/>
						
						<!--<span class="badge badge-danger bounceIn animation-delay4 m-left-xs">4</span>
						<!--<ul class="list-inline">
							<li><a href="profile.html">Profile</a></li>
							<li><a href="inbox.html" class="no-margin">Inbox</a></li>
						</ul>-->
					</div>
					</a>
				</div>
				<!-- /user-block -->
				<!--<div class="search-block">
					<div class="input-group">
						<input type="text" class="form-control input-sm" placeholder="search here...">
						<span class="input-group-btn">
							<button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div><!-- /input-group -->
				<!--</div><!-- /search-block -->
				<div class="main-menu">
					<ul>
						<li <?php if($this->uri->segment(1)=="advertiser"){ echo "class='active'";}?>>
							<a href="<?php echo base_url()."advertiser/dashboard"; ?>">
								<span class="menu-icon">
									<i class="fa fa-dashboard fa-lg"></i> 
								</span>
								<span class="text">
									Dashboard
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li <?php if(($this->uri->segment(2)=="profile")){ echo "class='active'";}?>>
							<a href="<?php echo base_url();?>user/profile/edit/<?php echo $this->session->userdata("userID");?>">
								<span class="menu-icon">
									<i class="fa fa-user fa-lg"></i> 
								</span>
								<span class="text">
									Profile
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li class="openable <?php if($this->uri->segment(1)=="link"){ echo "active open";}?>">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-anchor fa-lg"></i> 
								</span>
								<span class="text">
									Links
								</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li <?php if($this->uri->segment(2)=="add"){ echo "class='active open'";}?>><a href="<?php echo base_url().'link/add'; ?>"><span class="submenu-label">Add link</span></a></li>
								<li <?php if($this->uri->segment(2)==""){ echo "class='active open'";}?>><a href="<?php echo base_url().'link/';?>"><span class="submenu-label">View Links</span></a></li>
							</ul>
						</li>	
						
						<li <?php if($this->uri->segment(1)=="reports"){ echo "class='active'";}?>>
							<a href="<?php echo base_url().'reports/dashboard';?>">
								<span class="menu-icon">
									<i class="fa fa-file-text fa-lg"></i> 
								</span>
								<span class="text">
									Reports
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
					</ul>
					
					<!--<div class="alert alert-info">
						Welcome to Endless Admin. Do not forget to check all my pages. 
					</div>-->
				</div><!-- /main-menu -->
			</div><!-- /sidebar-inner scrollable-sidebar -->
		</aside>
		<?php echo $content_for_layout;?>
		<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	
	<!-- Logout confirmation -->
	<div class="custom-popup width-100" id="logoutConfirm">
		<div class="padding-md">
			<h4 class="m-top-none"> Do you want to logout?</h4>
		</div>

		<div class="text-center">
			<a class="btn btn-success m-right-sm" href="<?php echo base_url();?>user/logout">Logout</a>
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
	
	<script src="<?php echo base_url(); ?>js/froala_editor.min.js"></script> 
	<script>
		  jQuery(function($){
			  $('#communityDescription').editable({inlineMode: false, height: 500})
		  });
	</script>
  </body>
</html>