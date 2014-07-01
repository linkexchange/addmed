
		<div class="widget"> 
			<div class="span12 offset10"> 
				<button class="btn btn-primary btn-large pull-right icon-anchor" onclick="javascript:goto('link/add')"> Add Link</button>
			</div>
		</div>
		<div class="widget widget-table action-table">
			<div class="widget-header"> <i class="icon-th-list"></i>
				<h3>Links</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Link </th>
							<th>Pay Per link</th>
							<th>publisher</th>
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
							<td><?php $str=$url['url']; echo wordwrap($str,35,"<br>\n",TRUE); ?></td>
							<td><?php echo $url['payPerLink']; ?></td>
							<td>
								<?php 
									//$users=expload(",",$url['userName']);  echo $url['userName']; 
									/*foreach($users as $user){
										echo $user; echo "<br/>";
									}*/
								?>
							</td>
							<td></td>
							<td></td>
							<td class="td-actions">
								<a class="btn btn-small btn-success" href="<?php echo base_url(); ?>" ><i class="btn-icon-only icon-edit"> </i></a>
								<a class="btn btn-danger btn-small" href="<?php echo base_url(); ?>"><i class="btn-icon-only icon-remove"> </i></a>
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
