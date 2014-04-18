<!-- /navbar -->
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
						<li><a href="<?php echo base_url().'link/'; ?>">View Links</a></li>
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
							<li><a href="<?php echo base_url().'reports/dashboard'; ?>">Reports By Links</a></li>
							<li><a href="<?php echo base_url().'reports/dashboard/publisher'; ?>">Reports By Publishers</a></li>
							<li><a href="<?php echo base_url().'reports/dashboard/advertiser'; ?>">Reports By Advertisers</a></li>
						<?php endif; ?>
						
                    </ul> 
				</li>
				<?php if($this->session->userData('userTypeID')!=3) : ?>
				<li id="payments" class="<?php if($this->uri->segment('1')=="transaction"){ echo "active"; } ?> dropdown subnavbar-open-right">
					<a href="<?php //echo base_url().$this->session->userdata('userType')."/payment"; ?>" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-dollar"></i>
						<span>Payments</span> 
					</a>
					<ul class="dropdown-menu">
						<?php if($this->session->userData('userTypeID')==1) : ?>
							<li><a href="<?php echo base_url().'transaction/payment/add'; ?>">Make Payemt</a></li>
							<li><a href="<?php echo base_url().'transaction/payment'; ?>">View Admin Payments</a></li>
							<li><a href="<?php echo base_url().'transaction/payment/advertiser'; ?>">View Advertiser Payments</a></li>
						<?php elseif($this->session->userData('userTypeID')==2) : ?>
							<li><a href="<?php echo base_url().'transaction/payment/add'; ?>">Add Payemt</a></li>
							<li><a href="<?php echo base_url().'transaction/payment'; ?>">View Payment</a></li>
						<?php endif; ?>
						
                    </ul> 
				</li>
				<?php else : ?>
					<li id="payments" class="<?php if($this->uri->segment('1')=="transaction"){ echo "active"; } ?> dropdown subnavbar-open-right">
					<a href="<?php //echo base_url().$this->session->userdata('userType')."/payment"; ?>" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-dollar"></i>
						<span>Payments</span> 
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'transaction/payment'; ?>">View Payments</a></li>
						
                    </ul> 
				</li>
				<?php endif; ?>
			</ul>
		</div>
	<!-- /container --> 
	</div>
<!-- /subnavbar-inner --> 
</div>
