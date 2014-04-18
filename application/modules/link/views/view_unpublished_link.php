		<div id="loading" class="alert alert-success" style="display:none">Wait Data is loading</div>
		
		<div class="widget widget-table action-table">
			<div class="widget-header"> <i class="icon-th-list"></i>
				<h3>
					<?php
						if($this->session->userdata("userTypeID")==3)
							{
								echo "Un-Accepted Links";
							}
							else if($this->session->userdata("userTypeID")==2)
							{
								echo "Un-Published Links";
							}
					?>
				</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content unaccepted">
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
									<a class="btn btn-success btn-small" href="<?php echo base_url()."link/acceptLink/".$url['id']; ?>"><i class="btn-icon-only icon-check-empty" title="Accept"> </i></a>
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
				<?php if($this->session->userdata("userTypeID")==3) : ?>
				<div class="widget-header navigation-un" style="text-align:right;">
					<?php 
						$mod=10; $inc=1;
						if($unpublished_url_count>$mod) :
							echo "Pages:";
							for($i=0;$i<=$unpublished_url_count;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
									
									?>
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==1) echo "page-active"; ?>" href="javascript:void(0)" onclick="ajaxPageNavUn(<?php echo $inc; ?>)" ><?php echo $inc; ?></a>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
				</div>
				<?php elseif($this->session->userdata("userTypeID")==2) : ?>
				<div class="widget-header navigation-un" style="text-align:right;">
					<?php 
						$mod=10; $inc=1;
						if($unPubUrlCount>$mod) :
							echo "Pages:";
							for($i=0;$i<=$unPubUrlCount;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
									
									?>
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==1) echo "page-active"; ?>" href="javascript:void(0)" onclick="ajaxPageNavUn(<?php echo $inc; ?>)" ><?php echo $inc; ?></a>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
				</div>
				<?php endif; ?>
			</div>
			<!-- /widget-content --> 
		</div>
		<?php if($this->session->userdata("userTypeID")==3) : ?>
		<script>
		function ajaxPageNavUn(pid){
			//alert(pid);
			 $.ajax({
				url:base_url+"publisher/dashboard/getunpublishedurls/"+pid,
				beforeSend: loadStartUn,
				complete: loadStopUn,
				success:function(result){
					//alert(result);
					$(".unaccepted table").html(result);
			}});
			pageactiveun(pid);
		}
		</script>
		<?php elseif($this->session->userdata("userTypeID")==2) : ?>
		<script>
		function ajaxPageNavUn(pid){
			//alert(pid);
			 $.ajax({
				url:base_url+"advertiser/dashboard/getunpublishedurls/"+pid,
				beforeSend: loadStartUn,
				complete: loadStopUn,
				success:function(result){
					//alert(result);
					$(".unaccepted table").html(result);
			}});
			pageactiveun(pid);
		}
		</script>
		<?php endif; ?>
		<script>
		function pageactiveun(pid){
			$('.navigation-un a').removeClass('page-active');
			$('.navigation-un .page-'+pid).addClass('page-active');
		}
		function loadStartUn(){
			$("#loading2").show();
		}
		function loadStopUn(){
			$("#loading2").hide();
		}
		
		</script>
