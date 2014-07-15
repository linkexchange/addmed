<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Publisher || Social traffic Center</title>
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
	<link href="<?php echo base_url(); ?>css/froala_editor.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/custom_sunil.css" rel="stylesheet" type="text/css">
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
				<span class="text-toggle">Publisher</span>
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
				<!--<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-envelope fa-lg"></i>
						<span class="notification-label bounceIn animation-delay4">7</span>
					</a>
					<ul class="dropdown-menu message dropdown-1">
						<li><a>You have 4 new unread messages</a></li>					  
						<li>
							<a class="clearfix" href="#">
								<img src="img/user.jpg" alt="User Avatar">
								<div class="detail">
									<strong><?php echo $this->session->userdata("userName");?></strong>
									<p class="no-margin">
										Lorem ipsum dolor sit amet...
									</p>
									<small class="text-muted"><i class="fa fa-check text-success"></i> 27m ago</small>
								</div>
							</a>	
						</li>
						<li>
							<a class="clearfix" href="#">
								<img src="img/user2.jpg" alt="User Avatar">
								<div class="detail">
									<strong>Jane Doe</strong>
									<p class="no-margin">
										Lorem ipsum dolor sit amet...
									</p>
									<small class="text-muted"><i class="fa fa-check text-success"></i> 5hr ago</small>
								</div>
							</a>	
						</li>
						<li>
							<a class="clearfix" href="#">
								<img src="img/user.jpg" alt="User Avatar">
								<div class="detail">
									<strong>Bill Doe</strong>
									<p class="no-margin">
										Lorem ipsum dolor sit amet...
									</p>
									<small class="text-muted"><i class="fa fa-reply"></i> Yesterday</small>
								</div>
							</a>	
						</li>
						<li>
							<a class="clearfix" href="#">
								<img src="img/user2.jpg" alt="User Avatar">
								<div class="detail">
									<strong>Baby Doe</strong>
									<p class="no-margin">
										Lorem ipsum dolor sit amet...
									</p>
									<small class="text-muted"><i class="fa fa-reply"></i> 9 Feb 2013</small>
								</div>
							</a>	
						</li>
						<li><a href="#">View all messages</a></li>					  
					</ul>
				</li>
				<li class="dropdown hidden-xs">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-tasks fa-lg"></i>
						<span class="notification-label bounceIn animation-delay5">4</span>
					</a>
					<ul class="dropdown-menu task dropdown-2">
						<li><a href="#">You have 4 tasks to complete</a></li>					  
						<li>
							<a href="#">
								<div class="clearfix">
									<span class="pull-left">Bug Fixes</span>
									<small class="pull-right text-muted">78%</small>
								</div>
								<div class="progress">
									<div class="progress-bar" style="width:78%"></div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="clearfix">
									<span class="pull-left">Software Updating</span>
									<small class="pull-right text-muted">54%</small>
								</div>
								<div class="progress progress-striped">
									<div class="progress-bar progress-bar-success" style="width:54%"></div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="clearfix">
									<span class="pull-left">Database Migration</span>
									<small class="pull-right text-muted">23%</small>
								</div>
								<div class="progress">
									<div class="progress-bar progress-bar-warning" style="width:23%"></div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="clearfix">
									<span class="pull-left">Unit Testing</span>
									<small class="pull-right text-muted">92%</small>
								</div>
								<div class="progress progress-striped active">
									<div class="progress-bar progress-bar-danger " style="width:92%"></div>
								</div>
							</a>
						</li>
						<li><a href="#">View all tasks</a></li>					  
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-bell fa-lg"></i>
						<span class="notification-label bounceIn animation-delay6">5</span>
					</a>
					<ul class="dropdown-menu notification dropdown-3">
						<li><a href="#">You have 5 new notifications</a></li>					  
						<li>
							<a href="#">
								<span class="notification-icon bg-warning">
									<i class="fa fa-warning"></i>
								</span>
								<span class="m-left-xs">Server #2 not responding.</span>
								<span class="time text-muted">Just now</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="notification-icon bg-success">
									<i class="fa fa-plus"></i>
								</span>
								<span class="m-left-xs">New user registration.</span>
								<span class="time text-muted">2m ago</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="notification-icon bg-danger">
									<i class="fa fa-bolt"></i>
								</span>
								<span class="m-left-xs">Application error.</span>
								<span class="time text-muted">5m ago</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="notification-icon bg-success">
									<i class="fa fa-usd"></i>
								</span>
								<span class="m-left-xs">2 items sold.</span>
								<span class="time text-muted">1hr ago</span>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="notification-icon bg-success">
									<i class="fa fa-plus"></i>
								</span>
								<span class="m-left-xs">New user registration.</span>
								<span class="time text-muted">1hr ago</span>
							</a>
						</li>
						<li><a href="#">View all notifications</a></li>					  
					</ul>
				</li>-->
				<li class="profile dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<strong><?php echo $this->session->userdata("userName");?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="#">
								<img src="<?php echo base_url();?>img/user.jpg" alt="User Avatar">
								<div class="detail">
									<strong><?php echo $this->session->userdata("userName");?></strong>
									<!--<p class="grey"><?php echo $this->session->userdata("email");?></p>--> 
								</div>
							</a>
						</li>
						<!--<li><a tabindex="-1" href="#" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>-->
						<!--<li><a tabindex="-1" href="gallery.html" class="main-link"><i class="fa fa-picture-o fa-lg"></i> Photo Gallery</a></li>-->
						<li class="divider"></li>
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
					<img src="<?php echo base_url();?>img/user.jpg" alt="User Avatar">
					<div class="detail">
						<strong><?php echo $this->session->userdata("userName");?></strong><br/>
						Publisher
						<!--<span class="badge badge-danger bounceIn animation-delay4 m-left-xs">4</span>
						<!--<ul class="list-inline">
							<li><a href="profile.html">Profile</a></li>
							<li><a href="inbox.html" class="no-margin">Inbox</a></li>
						</ul>-->
					</div>
				</div><!-- /user-block -->
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
						<li>
							<a href="<?php echo base_url();?>publisher/dashboard">
								<span class="menu-icon">
									<i class="fa fa-dashboard fa-lg"></i> 
								</span>
								<span class="text">
									Dashboard
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						
						<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-file-text fa-lg"></i> 
								</span>
								<span class="text">
									Communities
								</span>
								<span class="badge badge-info bounceIn animation-delay5">2</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li><a href="<?php echo base_url();?>publisher/frontend/add"><span class="submenu-label">Add community</span></a></li>
								<li><a href="<?php echo base_url();?>publisher/frontend"><span class="submenu-label">View Communities</span></a></li>
							</ul>
						</li>
						
						<li>
							<a href="<?php echo base_url();?>publisher/frontend/accounts">
								<span>
									<i class="fa fa-cog fa-lg"></i> 
								</span>
								<span class="text">
									Accounts
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li <?php if($this->uri->segment(1)=="link"){ echo "class='active'";}?>>
							<a href="<?php echo base_url().'link';?>">
								<span class="menu-icon">
									<i class="fa fa-anchor fa-lg"></i> 
								</span>
								<span class="text">
									Links
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>	
						<li <?php if($this->uri->segment(1)=="reports"){ echo "class='active'";}?>>
							<a href="<?php //echo base_url().'reports/dashboard';?>">
								<span class="menu-icon">
									<i class="fa fa-list-alt fa-lg"></i> 
								</span>
								<span class="text">
									Reports
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-globe fa-lg"></i> 
								</span>
								<span class="text">
									Websites
								</span>
								<span class="badge badge-success bounceIn animation-delay5">2</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li <?php if($this->uri->segment(3)=="add"){ echo "class='active'";}?>><a href="<?php //echo base_url().'template/dashboard/add'; ?>"><span class="submenu-label">Create Website</span></a></li>
								<li <?php if($this->uri->segment(3)==""){ echo "class='active'";}?>><a href="<?php //echo base_url().'template/dashboard';?>"><span class="submenu-label">View websites</span></a></li>
							</ul>
						</li>
						<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-file-text fa-lg"></i> 
								</span>
								<span class="text">
									Posts
								</span>
								<span class="badge badge-danger bounceIn animation-delay5">2</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li <?php if($this->uri->segment(3)=="add"){ echo "class='active'";}?>><a href="<?php //echo base_url().'blogs/dashboard/add'; ?>"><span class="submenu-label">Add Post</span></a></li>
								<li <?php if($this->uri->segment(3)==""){ echo "class='active'";}?>><a href="<?php //echo base_url().'blogs/dashboard';?>"><span class="submenu-label">View posts</span></a></li>
							</ul>
						</li>
						<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-sitemap fa-lg"></i> 
								</span>
								<span class="text">
									Gallery Item
								</span>								
								<span class="badge badge-info bounceIn animation-delay5">2</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li <?php if($this->uri->segment(3)=="add"){ echo "class='active'";}?>><a href="<?php //echo base_url().'articles/dashboard/addmultiple'; ?>"><span class="submenu-label">Add Gallery Item(s)</span></a></li>
								<li <?php if($this->uri->segment(3)==""){ echo "class='active'";}?>><a href="<?php //echo base_url().'articles/dashboard';?>"><span class="submenu-label">View Gallery Item(s)</span></a></li>
							</ul>
						</li>
						<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-paperclip fa-lg"></i> 
								</span>
								<span class="text">
									Pages
								</span>
								<span class="badge badge-warning bounceIn animation-delay5">2</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li <?php if($this->uri->segment(3)=="add"){ echo "class='active'";}?>><a href="<?php //echo base_url().'pages/dashboard/add'; ?>"><span class="submenu-label">Add Page</span></a></li>
								<li <?php if($this->uri->segment(3)==""){ echo "class='active'";}?>><a href="<?php //echo base_url().'pages/dashboard';?>"><span class="submenu-label">View Pages</span></a></li>
							</ul>
						</li>
						<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-tasks fa-lg"></i> 
								</span>
								<span class="text">
									Articles
								</span>
								<span class="badge badge-success bounceIn animation-delay5">2</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li <?php if($this->uri->segment(3)=="add"){ echo "class='active'";}?>><a href="<?php //echo base_url().'article/dashboard/add'; ?>"><span class="submenu-label">Add Article</span></a></li>
								<li <?php if($this->uri->segment(3)==""){ echo "class='active'";}?>><a href="<?php //echo base_url().'article/dashboard';?>"><span class="submenu-label">View articles</span></a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<span>
									<i class="fa fa-tasks fa-lg"></i>
								</span>
								<span class="text">
									Earnings
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<!--<li>
							<a href="inbox.html">
								<span class="menu-icon">
									<i class="fa fa-envelope fa-lg"></i> 
								</span>
								<span class="text">
									Inbox
								</span>
								<span class="badge badge-danger bounceIn animation-delay6">4</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li>
							<a href="email_selection.html">
								<span class="menu-icon">
									<i class="fa fa-tasks fa-lg"></i> 
								</span>
								<span class="text">
									Email Template
								</span>
								<small class="badge badge-warning bounceIn animation-delay7">New</small>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-magic fa-lg"></i> 
								</span>
								<span class="text">
									Multi-Level menu
								</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li class="openable">
									<a href="#">
										<span class="submenu-label">menu 2.1</span>
										<span class="badge badge-danger bounceIn animation-delay1 pull-right">3</span>
									</a>
									<ul class="submenu third-level">
										<li><a href="#"><span class="submenu-label">menu 3.1</span></a></li>
										<li><a href="#"><span class="submenu-label">menu 3.2</span></a></li>
										<li class="openable">
											<a href="#">
												<span class="submenu-label">menu 3.3</span>
												<span class="badge badge-danger bounceIn animation-delay1 pull-right">2</span>
											</a>
											<ul class="submenu fourth-level">
												<li><a href="#"><span class="submenu-label">menu 4.1</span></a></li>
												<li><a href="#"><span class="submenu-label">menu 4.2</span></a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="openable">
									<a href="#">
										<span class="submenu-label">menu 2.2</span>
										<span class="badge badge-success bounceIn animation-delay2 pull-right">3</span>
									</a>
									<ul class="submenu third-level">
										<li class="openable">
											<a href="#">
												<span class="submenu-label">menu 3.1</span>
												<span class="badge badge-success bounceIn animation-delay1 pull-right">2</span>
											</a>
											<ul class="submenu fourth-level">
												<li><a href="#"><span class="submenu-label">menu 4.1</span></a></li>
												<li><a href="#"><span class="submenu-label">menu 4.2</span></a></li>
											</ul>
										</li>
										<li><a href="#"><span class="submenu-label">menu 3.2</span></a></li>
										<li><a href="#"><span class="submenu-label">menu 3.3</span></a></li>
									</ul>
								</li>
							</ul>
						</li>-->
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
	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	<!-- Jquery -->
	<script src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
	
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