
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Link Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta content="authenticity_token" name="csrf-param" />
	<meta content="Eujr3W/LkGI57lNhHD87m1DfRi/LALppjkKH9dzm5Q8=" name="csrf-token" />
	<link href="<?php echo base_url();?>assets/application-c60b38c2cdf3c1c69a4ef520088fbaa3.css" media="all" rel="stylesheet" />
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="<?php echo base_url();?>assets/application-5b59edaaf6bf2f3d37aa643b6358eef9.js"></script>
	<!-- Font Awesome-->
	<link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet">

	<!-- Pace -->
	<link href="<?php echo base_url();?>css/pace.css" rel="stylesheet">
	
	<!-- Datatable -->
	<link href="<?php echo base_url();?>css/jquery.dataTables_themeroller.css" rel="stylesheet">
	
	<!-- Endless -->
	<link href="<?php echo base_url();?>css/endless.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/endless-skin.css" rel="stylesheet">
	<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-46750688-1', 'exposely.com');
      ga('send', 'pageview');
	</script>
  </head>

  <body class="dashboard users-accounts ">
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
								</div>
							</a>
						</li>
						
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
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li><a href="<?php echo base_url();?>publisher/frontend/add"><span class="submenu-label">Add community</span></a></li>
								<li><a href="<?php echo base_url();?>publisher/frontend"><span class="submenu-label">View Communities</span></a></li>
							</ul>
						</li>
						<!--<li class="openable">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-file-text fa-lg"></i> 
								</span>
								<span class="text">
									Accounts
								</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li><a href="login.html"><span class="submenu-label">Sign in</span></a></li>
								<li><a href="register.html"><span class="submenu-label">Sign up</span></a></li>
								<li><a href="lock_screen.html"><span class="submenu-label">Lock Screen</span></a></li>
								<li><a href="profile.html"><span class="submenu-label">Profile</span></a></li>
								<li><a href="blog.html"><span class="submenu-label">Blog</span></a></li>
								<li><a href="single_post.html"><span class="submenu-label">Single Post</span></a></li>
								<li><a href="landing.html"><span class="submenu-label">Landing</span></a></li>
								<li><a href="search_result.html"><span class="submenu-label">Search Result</span></a></li>
								<li><a href="chat.html"><span class="submenu-label">Chat Room</span></a></li>
								<li><a href="movie.html"><span class="submenu-label">Movie Gallery</span></a></li>
								<li><a href="pricing.html"><span class="submenu-label">Pricing</span></a></li>
								<li><a href="invoice.html"><span class="submenu-label">Invoice</span></a></li>
								<li><a href="faq.html"><span class="submenu-label">FAQ</span></a></li>
								<li><a href="contact.html"><span class="submenu-label">Contact</span></a></li>
								<li><a href="error404.html"><span class="submenu-label">Error404</span></a></li>
								<li><a href="error500.html"><span class="submenu-label">Error500</span></a></li>
								<li><a href="blank.html"><span class="submenu-label">Blank</span></a></li>
							</ul>
						</li>
						<li class="active openable open">
							<a href="#">
								<span class="menu-icon">
									<i class="fa fa-tag fa-lg"></i> 
								</span>
								<span class="text">
									Component
								</span>
								<span class="badge badge-success bounceIn animation-delay5">9</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<li><a href="ui_element.html"><span class="submenu-label">UI Features</span></a></li>
								<li><a href="button.html"><span class="submenu-label">Button & Icons</span></a></li>
								<li><a href="tab.html"><span class="submenu-label">Tab</span></a></li>
								<li><a href="nestable_list.html"><span class="submenu-label">Nestable List</span></a></li>
								<li><a href="calendar.html"><span class="submenu-label">Calendar</span></a></li>
								<li class="active"><a href="table.html"><span class="submenu-label">Table</span></a></li>
								<li><a href="widget.html"><span class="submenu-label">Widget</span></a></li>
								<li><a href="form_element.html"><span class="submenu-label">Form Element</span></a></li>
								<li><a href="form_wizard.html"><span class="submenu-label">Form Wizard</span></a></li>
							</ul>
						</li>-->
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
						<li>
							<a href="gallery.html">
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
		
		<div id="main-container">
			<div class="container accounts">
			<h3>Social Accounts</h3>
			<div class="connect">
			<span>Connect:</span>
			<ul>
				<li class="twitter"><a href="/auth/twitter?connect=1"><i class="fa fa-twitter"></i></a></li>
				<li class="tumblr"><a href="/auth/tumblr?connect=1"><i class="fa fa-tumblr"></i></a></li>
				<li class="instagram"><a href="/connect/instagram"><i class="fa fa-instagram"></i></a></li>
				<li class="facebook"><a href="/auth/facebook?connect=1"><i class="fa fa-facebook"></i></a></li>
				<!-- <li class="gplus"><a href="/auth/google_oauth2?connect=1"><i class="fa fa-google-plus"></i></a></li> -->
			</ul>
		  </div>

		  <div style="clear:both;"></div>

  <div class="graphs">

	<div class="graph quarter">
		<div class="pie" data-twitter="4644833" data-facebook="0" data-pinterest="0" data-instagram="0" data-tumblr="0"><svg width="300" height="300"><g transform="translate(150,150)"><path d="M0,65A65,65 0 1,1 0,-65A65,65 0 1,1 0,65M0,80A80,80 0 1,0 0,-80A80,80 0 1,0 0,80Z" style="fill: rgb(62, 177, 220);"></path><path style="fill: rgb(163, 136, 115);" d="M4.579129100547015e-14,-65A65,65 0 0,1 4.579129100547015e-14,-65L5.6358512006732494e-14,-80A80,80 0 0,0 5.6358512006732494e-14,-80Z"></path><path style="fill: rgb(62, 90, 112);" d="M4.579129100547015e-14,-65A65,65 0 0,1 4.579129100547015e-14,-65L5.6358512006732494e-14,-80A80,80 0 0,0 5.6358512006732494e-14,-80Z"></path></g></svg></div>
		<div class="amount">4.64 M</div>
		<label>Total Reach</label>
	</div>



		<div class="graph twitter">
			<div class="amount">4.64 M</div>
			<label>Twitter</label>
			<div class="bar" style="height:50.0%"></div>
		</div>



		<div class="graph tumblr">
			<div class="amount">0</div>
			<label>Tumblr</label>
			<div class="bar" style="height:0%"></div>
		</div>

		<div class="graph instagram">
			<div class="amount">0</div>
			<label>Instagram</label>
			<div class="bar" style="height:0%"></div>
		</div>

	 	<div class="graph facebook">
			<div class="amount">-</div>
			<label>Facebook</label>
			<div class="bar" style="height:2%"></div>
		</div>

		<div class="graph pinterest">
			<div class="amount">-</div>
			<label>Pinterest</label>
			<div class="bar" style="height:2%"></div>
		</div>

  </div>


	  <table class="accounts-table">
		<tbody><tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/378800000122507552/526954133c948eeb9804945916228f4b_bigger.png">

			</td>
			<td class="name twitter">Manstagram</td>
			<td class="followers">213 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">6210</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/164" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/378800000022335397/737d7eb9ef6845f2b331d2cea3b34d96_bigger.png">

			</td>
			<td class="name twitter">Guy Codes</td>
			<td class="followers">187 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">9835</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/568" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/344513261582476136/418ff2eb78872ac3e92d2b74a4463c39_bigger.png">

			</td>
			<td class="name twitter">The Mancave</td>
			<td class="followers">64.3 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">2493</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/590" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/378800000150680565/3088b261106f2634fc3f0c11f70a0f06_bigger.jpeg">

			</td>
			<td class="name twitter">Guys Tech</td>
			<td class="followers">107 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">1217</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/582" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/378800000513188968/d67be845a0a858b0ccd85e19b5896e0e_bigger.jpeg">

			</td>
			<td class="name twitter">CWBabes</td>
			<td class="followers">81.2 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">2046</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/580" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/378800000603530808/4f11282699737da71f81c93525dc53d3_bigger.png">

			</td>
			<td class="name twitter">eCards For Guys</td>
			<td class="followers">105 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">1626</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/587" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/414137650778357760/0lPn9Fe3_bigger.jpeg">

			</td>
			<td class="name twitter">The Perfect Vacation</td>
			<td class="followers">26 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">401</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/589" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/415449671645941760/SZRZhiUM_bigger.jpeg">

			</td>
			<td class="name twitter">The Mancave Rides</td>
			<td class="followers">56.8 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">787</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/584" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/419388840629919745/RUM_xBvH_bigger.png">

			</td>
			<td class="name twitter">Male Advice</td>
			<td class="followers">60.5 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">117</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/585" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/432026909694631936/icRwWHCx_bigger.jpeg">

			</td>
			<td class="name twitter">3 Words For Guys</td>
			<td class="followers">61.6 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">242</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/588" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/1812520862/guyCodesSmall_bigger.gif">

			</td>
			<td class="name twitter">GuyCodes</td>
			<td class="followers">729 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">13938</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/569" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/1688009585/Men_bigger.gif">

			</td>
			<td class="name twitter">Because I'm a Guy</td>
			<td class="followers">1.63 M</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">29237</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/576" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/2319433479/gle20kh19lebjgcnhtpw_bigger.png">

			</td>
			<td class="name twitter">Because I'm a Guy</td>
			<td class="followers">159 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">9260</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/583" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/3764457446/40901a085a9808d2f9227176c0cc414e_bigger.jpeg">

			</td>
			<td class="name twitter">Hot Girls Daily</td>
			<td class="followers">399 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">4237</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/574" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/378800000676697539/201bdaa93d7c91b4db5b230eacfdea74_bigger.jpeg">

			</td>
			<td class="name twitter">Proud Male</td>
			<td class="followers">332 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">8551</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/570" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/3637266674/b5f1da47fc1285116fb68fb4a8b7e937_bigger.png">

			</td>
			<td class="name twitter">Cause We're Sexual</td>
			<td class="followers">258 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">11187</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/573" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






		<tr class="twitter">
			<td class="icon"><i class="fa fa-twitter"></i></td>
			<td class="avatar">

				  <img src="http://pbs.twimg.com/profile_images/378800000354569384/234c19531f582f4fb43acc256d0f3ba2_bigger.png">

			</td>
			<td class="name twitter">Tweet Like A Guy</td>
			<td class="followers">180 K</td>
			<!-- <td class="monthly">5k</td>
			<td class="daily">201</td> -->
			<td class="posts">5692</td>
			<td class="actions">
				<!-- <a href="#" class="edit"><i class="fa fa-pencil"></i></a> -->
				<a href="https://exposely.com/auth/disconnect/747" class="remove danger"><i class="fa fa-ban"></i></a>

			</td>
		</tr>






	  </tbody></table>

</div>
		</div>
	</div>
		
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
		
  </body>
</html>
