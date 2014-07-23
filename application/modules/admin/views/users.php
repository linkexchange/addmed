<div id="main-container">
	<div class="padding-md">
		<div class="panel panel-default table-responsive">
					<div class="panel-heading">
						<h3><b><i class="icon-user"></i> View Users</b>
						<span class="pull-right">
							<a class="btn btn-success icon-anchor" href="<?php echo base_url();?>user/profile/add"> Add User</a>
						</span></h3>
					</div>
					<?php if($this->session->userdata('message')) { ?>
					<div id="successMessage" class="alert alert-success">
					<?php echo $this->session->userdata('message');?>
					</div>
					<?php } ?>
					<div class="panel-body">
						
					</div>
					<div class="padding-md clearfix">
					
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead style="border:1px solid graylight;">
								<tr>
									<th>Company Name </th>
									<th>User Name</th>
									<th>Email</th>
									<th>Type</th>
									<th class="td-actions"> </th>
								</tr>
							</thead>
							<tbody style="border:1px solid graylight;">
								<?php 
								foreach($users as $user)
								{
								?>
								<tr>
									<td><?php echo $user['companyName']; ?></td>
									<td><?php echo $user['userName']; ?></td>
									<td><?php echo $user['email']; ?></td>
									<td><?php echo $user['type']; ?></td>
									<td class="td-actions">
										<a class="btn btn-small btn-success" href="<?php echo base_url()."user/profile/edit/".$user['id']; ?>"><i class="btn-icon-only icon-edit"> </i></a>
										<a class="btn btn-danger btn-small" href="<?php echo base_url()."user/profile/delete/".$user['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
									</td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
						
			</div><!-- /.padding-md -->
		</div>	
	</div><!-- /.padding-md -->
</div>	