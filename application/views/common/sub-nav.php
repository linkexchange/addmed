<!-- /navbar -->
<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
				<li class="<?php if($this->uri->segment('2')=="dashboard"){ echo "active"; } ?>" id="dashboard"><a href="<?php echo base_url().$this->session->userdata('userType')."/dashboard"; ?>"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
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
						<li><a href="<?php echo base_url().'link/'; ?>">View Links</a></li>
                    </ul>    				
				</li>
				<li id="reports" ><a href="#"><i class="icon-list-alt"></i><span>Reports</span> </a> </li>
			</ul>
		</div>
	<!-- /container --> 
	</div>
<!-- /subnavbar-inner --> 
</div>
