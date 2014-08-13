<div id="top-nav" class="skin-6 fixed">
			<div class="brand">
				<span>Link Exchange</span>
				<?php if($this->session->userdata("userID")){?>
				<span class="text-toggle"><?php echo $this->session->userdata("userType");?></span>
				<?php }?>
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
			<?php if($this->session->userdata("userID")) {?>
			<ul class="nav-notification clearfix">
				<li class="profile dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<strong><?php if($this->session->userdata("ForumUserFullName")){
										echo $this->session->userdata("ForumUserFullName");
									} else {
										echo $this->session->userdata("userName");
									}
								?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="#">
								<img src="<?php echo base_url();?>img/user.jpg" alt="User Avatar">
								<div class="detail">
									<strong>
										<?php if($this->session->userdata("ForumUserFullName")){
												echo $this->session->userdata("ForumUserFullName");
											} else {
												echo $this->session->userdata("userName");
											}
										?>
									</strong>
									<!--<p class="grey"><?php echo $this->session->userdata("email");?></p>--> 
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
					</ul>
				</li>
			</ul>
			<?php } else {?>
			<ul class="nav-notification clearfix">
				<li class="profile dropdown">
					<a href="<?php echo base_url();?>user/login">
						<strong>Login</strong>
						<span><i class="fa fa-user"></i></span>
					</a>
				</li>
			</ul>
			<?php } ?>
		</div><!-- /top-nav-->
		
		<aside class="fixed skin-6">			
			<div class="sidebar-inner scrollable-sidebar">
				
				<div class="size-toggle">
					<a class="btn btn-sm" id="sizeToggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<?php if($this->session->userdata("loggedIn")) {?>
					<a class="btn btn-sm pull-right logoutConfirm_open"  href="#logoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
					<?php }?>
				</div><!-- /size-toggle -->	
				<?php if($this->session->userdata("loggedIn")) {?>
				<div class="user-block clearfix">
					<img src="<?php echo base_url();?>img/user.jpg" alt="User Avatar">
					<div class="detail">
						<strong><?php if($this->session->userdata("ForumUserFullName")){
										echo $this->session->userdata("ForumUserFullName");
									} else {
										echo $this->session->userdata("userName");
									}
								?>
						</strong><br/>
						
						<!--<span class="badge badge-danger bounceIn animation-delay4 m-left-xs">4</span>
						<!--<ul class="list-inline">
							<li><a href="profile.html">Profile</a></li>
							<li><a href="inbox.html" class="no-margin">Inbox</a></li>
						</ul>-->
					</div>
				</div>
				<?php } ?>
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
						<li <?php if($this->uri->segment(1)=="forum"){ echo "class='active'";}?>>
							<a href="<?php echo base_url();?>forum">
								<span class="menu-icon">
									<i class="fa fa-home fa-lg"></i> 
								</span>
								<span class="text">
									Home
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li <?php if($this->uri->segment(1)=="topics"){ echo "class='active'";}?>>
							<a href="<?php echo base_url();?>topics">
								<span class="menu-icon">
									<i class="fa fa-list-alt fa-lg"></i> 
								</span>
								<span class="text">
									Forum
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<li <?php if($this->uri->segment(1)=="articles"){ echo "class='active'";}?>>
							<a href="<?php echo base_url();?>articles">
								<span class="menu-icon">
									<i class="fa fa-list fa-lg"></i> 
								</span>
								<span class="text">
									Articles
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<?php if($this->session->userdata('loggedIn')){?>
						<li <?php if($this->uri->segment(1)=="bookmarks"){ echo "class='active'";}?>>
							<a href="<?php echo base_url().'bookmarks'; ?>">
								<span class="menu-icon">
									<i class="icon-star fa-lg"></i>
								</span>
								<span class="text">
									Bookmarks
								</span>
								<span class="menu-hover"></span>
							</a>
						</li>
						<?php } ?>
						<li <?php if($this->uri->segment(1)=="monetization_networks"){ echo "class='active'";}?>>
							<a href="<?php echo base_url();?>monetization_networks">
								<span class="menu-icon">
									<i class="fa fa-globe fa-lg"></i> 
								</span>
								<span class="text">
									Monetization
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