<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<div class="widget-header"> <i class="icon-list-alt"></i>
							<h3> Today's Stats</h3>
						</div>
						<!-- /widget-header -->
						<div class="widget-content">
							<div class="widget big-stats-container">
								<div class="widget-content">
									<div class="cf" id="big_stats">
										<div class="stat"> <i class="icon-anchor"></i> <span class="value">851</span> </div>
										<!-- .stat -->
										
										<div class="stat"> <i class="icon-thumbs-up-alt"></i> <span class="value">423</span> </div>
										<!-- .stat -->
										
										<div class="stat"> <i class="icon-twitter-sign"></i> <span class="value">922</span> </div>
										<!-- .stat -->
										
										<div class="stat"> <i class="icon-bullhorn"></i> <span class="value">25%</span> </div>
										<!-- .stat --> 
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- table start -->

					<div class="widget widget-table action-table">
						<div class="widget-header"> <i class="icon-th-list"></i>
							<h3>Users</h3>
						</div>
						<!-- /widget-header -->
						<div class="widget-content">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Company Name </th>
										<th>User Name</th>
										<th>Email</th>
										<th class="td-actions"> </th>
									</tr>
								</thead>
								<tbody>
									<?php 
									foreach($users as $user)
									{
									?>
									<tr>
										<td><?php echo $user['companyName']; ?></td>
										<td><?php echo $user['userName']; ?></td>
										<td><?php echo $user['email']; ?></td>
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
						</div>
						<!-- /widget-content --> 
					</div>
					<!-- table End -->
				</div>
			</div>
		</div>
	</div>
</div>