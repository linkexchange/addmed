
		<div class="widget widget-table action-table">
			<div class="widget-header"> <i class="icon-th-list"></i>
				<h3>Published Links</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Link </th>
							<th>Pay Per link</th>
							<th>
							<?php
							if($this->session->userdata("userTypeID")==2)
							{
								echo "Publisher";
							}
							else if($this->session->userdata("userTypeID")==3)
							{
								echo "Advertiser";
							}
							?></th>
							<th>Hits</th>
							<th>Total Costing</th>
							<th class="td-actions"> </th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($publishedUrls as $url)
						{
						?>
						<tr>
							<td><?php echo $url['url']; ?></td>
							<td><?php echo $url['payPerLink']; ?></td>
							<td><?php echo $url['userName']; ?></td>
							<td></td>
							<td></td>
							<td class="td-actions">
							<?php
							if($this->session->userdata("userTypeID")==2)
							{
							?>
								<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
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
