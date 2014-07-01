<!-- /navbar -->
<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
				<li class="<?php if(($this->uri->segment('1')=="publisher") || $this->uri->segment('1')=="" ) : echo "active"; endif; ?> dropdown subnavbar-open-right" id="dashboard" >
                	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-dashboard"></i>
                        <span>Websites</span> 
                    </a>
                    <ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'template/dashboard/add'; ?>">Create Website</a></li>
                    	<li><a href="<?php echo base_url().'publisher/dashboard'; ?>">View Website</a></li>
                    </ul>  
                </li>
                <li class="<?php if($this->uri->segment('1')=="blogs") : echo "active"; endif; ?> dropdown subnavbar-open-right" id="blocks" >
                	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-sitemap"></i>
                        <span>Posts</span> 
                    </a>
                    <ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'blogs/dashboard/add'; ?>">Add Post</a></li>
                    	<li><a href="<?php echo base_url().'blogs/dashboard/'; ?>">View Posts</a></li>
                       <!-- <li><a href="<?php echo base_url().'blogs/dashboard/viewbytemplates'; ?>">View Blogs By Templates</a></li>-->
                    </ul>  
                </li>
                <li class="<?php if($this->uri->segment('1')=="articles") : echo "active"; endif; ?> dropdown subnavbar-open-right" id="artciles" >
                	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-file-text-alt"></i>
                        <span>Gallery Item</span> 
                    </a>
                    <ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'articles/dashboard/add'; ?>">Add Gallery Item</a></li>
                    	<li><a href="<?php echo base_url().'articles/dashboard/'; ?>">View Gallery Items</a></li>
                        <!--<li><a href="<?php echo base_url().'articles/dashboard/viewbyblogs'; ?>">View Articles By Templates & Blogs</a></li>-->
                    </ul>  
                </li>
                <li class="<?php if($this->uri->segment('1')=="advertise") : echo "active"; endif; ?> dropdown subnavbar-open-right" id="adss" >
                	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-building"></i>
                        <span>Ads</span> 
                    </a>
                    <ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'advertise/dashboard/add'; ?>">Add Ads</a></li>
                    	<li><a href="<?php echo base_url().'advertise/dashboard/'; ?>">View Ads</a></li>
                        <!--<li><a href="<?php echo base_url().'advertise/dashboard/blocks'; ?>">View Advertise By Templates</a></li>-->
                    </ul>  
                </li>
				<li class="<?php if($this->uri->segment('1')=="pages") : echo "active"; endif; ?> dropdown subnavbar-open-right" id="pages" >
                	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-paperclip"></i>
                        <span>Pages</span> 
                    </a>
                    <ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'pages/dashboard/add'; ?>">Add Page</a></li>
                    	<li><a href="<?php echo base_url().'pages/dashboard/'; ?>">View Pages</a></li>
                    </ul>  
                </li>
                 <li class="<?php if($this->uri->segment('1')=="user") : echo "active"; endif; ?> dropdown subnavbar-open-right" id="adss" >
                	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-cog"></i>
                        <span>Settings</span> 
                    </a>
                    <ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'user/logout'; ?>">Logout</a></li>
                    	
                    </ul>  
                </li>
			</ul>
		</div>
	<!-- /container --> 
	</div>
<!-- /subnavbar-inner --> 
</div>
