<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Link </th>
							<!-- <?php 
								if($this->session->userdata("userTypeID")==3) 
								{
							?>
							<th>Bitly URL</th>
							<?php 
								}
							?> -->
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
							<!-- <?php 
								if($this->session->userdata("userTypeID")==3) 
								{
							?>
							<td><?php echo $url['billyUrl']; ?></td>
							<?php 
								}
							?> -->
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
							elseif($this->session->userdata("userTypeID")==3 ){
								if(!($url['billyUrl'])){
							?>
								<a class="btn btn-success btn-small" href="<?php echo base_url()."link/edit_pub/".$url['id']; ?>"><i class="icon-anchor btn-icon-only" title="Add Bitly URL"> </i></a>
								<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/pubremove/".$url['id']; ?>"><i class="btn-icon-only icon-remove" title="Remove"> </i></a>
								<?php 
								}
								else
								{
								?>
								<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit_pub/".$url['id']; ?>" ><i class="btn-icon-only icon-edit" title="Edit Bitly Link"> </i></a>
								<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/pubremove/".$url['id']; ?>"><i class="btn-icon-only icon-remove" title="Remove"> </i></a>
								<?php 
									}
								?>
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