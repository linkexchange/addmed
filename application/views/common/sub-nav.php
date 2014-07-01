<!-- /navbar -->
<?php if($this->uri->segment('2')=="adLinkCategory" || $this->uri->segment('2')=="viewCategories" || $this->uri->segment('2')=="setCPC") : ?>
<script>
$(document).ready(function(){
	$(".mainnav li").removeClass('active');
	$("#category").addClass('active');
});
</script>
<?php endif; ?>
<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
				<li class="<?php if($this->uri->segment('2')=="dashboard" && ($this->uri->segment('1')=="publisher" || $this->uri->segment('1')=="advertiser" || $this->uri->segment('1')=="admin")){ echo "active"; } ?>" id="dashboard"><a href="<?php echo base_url().$this->session->userdata('userType')."/dashboard"; ?>"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
				<li class="<?php if($this->uri->segment('1')=="link"){ echo "active"; } ?> dropdown subnavbar-open-right">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-anchor"></i>
						<span>Links</span>
						<b class="caret"></b>
					</a>	
					<ul class="dropdown-menu">
					<?php
						if($this->session->userData('userTypeID')==2)
						{
                    ?>
						<li><a href="<?php echo base_url().'link/add'; ?>">Add Links</a></li>
                    	<?php
						}
						?>
						<li><a href="<?php echo base_url().'link/';?>">View Links</a></li>
						
						
						
					</ul>    				
				</li>
			
				<li id="reports" class="<?php if($this->uri->segment('1')=="reports"){ echo "active"; } ?> dropdown subnavbar-open-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-list-alt"></i>
						<span>Reports</span> 
					</a>
					<ul class="dropdown-menu">
						<?php if($this->session->userData('userTypeID')==3 ||$this->session->userData('userTypeID')==2 ) : ?>
							<li><a href="<?php echo base_url().'reports/dashboard'; ?>">View Reports</a></li>
						<?php elseif($this->session->userData('userTypeID')==1) : ?>
							<li><a href="<?php echo base_url().'reports/dashboard'; ?>">Reports of Links</a></li>
							<li><a href="<?php echo base_url().'reports/dashboard/publisher'; ?>">Reports of Publishers</a></li>
							<li><a href="<?php echo base_url().'reports/dashboard/advertiser'; ?>">Reports of Advertisers</a></li>
						<?php endif; ?>
						
                    </ul> 
				</li>
				<?php if($this->session->userData('userTypeID')==1) { ?>
				<li id="category" class="<?php if($this->uri->segment('2')=="adLinkCategory" || $this->uri->segment('2')=="viewCategories"){ echo "active"; } ?> dropdown subnavbar-open-right"> 
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-anchor"></i>
						<span>Categories</span>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'link/adLinkCategory';?>">Add Link category</a></li>
						<li><a href="<?php echo base_url().'link/viewCategories';?>">View Link category</a></li>
						<li><a href="<?php echo base_url().'link/setCPC';?>">Set CPC for category</a></li>
					</ul>		
				</li>
				<?php } ?>
				<?php if($this->session->userData('userTypeID')==1 || $this->session->userData('userTypeID')==3) : ?>
				<li class="<?php if(($this->uri->segment('1')=="publisher") && $this->uri->segment('2')=="website" ) : echo "active"; endif; ?> dropdown subnavbar-open-right" id="dashboard" >
                	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-dashboard"></i>
                        <span>Websites</span> 
                    </a>
                    <ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'template/dashboard/add'; ?>">Create Website</a></li>
                    	<li><a href="<?php echo base_url().'template/dashboard'; ?>">View Website</a></li>
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
						<li><a href="<?php echo base_url().'articles/dashboard/addmultiple'; ?>">Add Gallery Item</a></li>
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
				<?php endif; ?>
			</ul>
		</div>
	<!-- /container --> 
	</div>
<!-- /subnavbar-inner --> 
</div>
