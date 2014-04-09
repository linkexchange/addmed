
		
		<div class="widget widget-table action-table">
			<div class="widget-header"> <i class="icon-th-list"></i>
				<h3>Un-Published Links</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Link </th>
							<th>Pay Per link</th>
							<th class="td-actions"> </th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($unPublishedUrls as $url)
						{
						?>
						<tr>
							<td><?php echo $url['url']; ?></td>
							<td><?php echo $url['payPerLink']; ?></td>
							<td class="td-actions">
								<?php 
								if($this->session->userdata("userTypeID")==2)
								{
								?>
									<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
									<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/delete/".$url['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
								<?php
								}
								else
								{
								?>
									<a class="btn btn-success btn-small" href="<?php echo base_url()."link/acceptLink/".$url['id']; ?>"><i class="btn-icon-only icon-check-empty"> </i></a>
				 				<?php
								}
								?>
							</td>
						</tr>
						<?
						}
						?>
					</tbody>
				</table>
			</div>
			<!-- /widget-content --> 
		</div>
