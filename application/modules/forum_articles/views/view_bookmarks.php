<div id="main-container">
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin"><b>Bookmarks</b></h3>
		</div><!-- /page-title -->
	</div>
	<div class="padding-md">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading" style="border:1px solid #D6E9F3;">
						<h4><b><i class="fa fa-star fa-lg"></i> Bookmarks</b>
						<span class="badge badge-info"><?php echo count($bookmarks);?> bookmarks</span> </h4>
					</div>
					<?php if($this->session->flashdata("del")) { ?>
					<div id="successMessage" class="alert alert-success">	
						<?php echo $this->session->flashdata("del");?>
					</div>
					<?php } ?>
					<table class="table table-bordered table-striped">
						<thead>
							<tr style="border:1px solid LightGray;">
								<th><h4>Name</h4></th>
								<th><h4>Url</h4></th>
								<th><h4>Actions</h4></th>
							</tr>
						</thead>
						<tbody>	
							<?php for($i=0;$i<count($bookmarks);$i++){?>
							<tr style="border:1px solid LightGray;">	
								<td>
									 <?php echo $bookmarks[$i]['name'];?>  
								</td>
								<td>
									<a href="<?php echo $bookmarks[$i]['url'];?>">
									<?php echo $bookmarks[$i]['url'];?></a>
								</td>
								<td>
									<a class="btn btn-small btn-success" href="<?php echo base_url()."forum_articles/listing/edit/".$bookmarks[$i]['id']; ?>" title="Edit : <?php echo $bookmarks[$i]['name']; ?>">
									<i class="btn-icon-only icon-edit"> </i>
									</a>
									<a class="btn btn-danger btn-small" href="<?php echo base_url()."forum_articles/listing/delete/".$bookmarks[$i]['id']; ?>" title="Delete : <?php echo $bookmarks[$i]['name']; ?>">
									<i class="btn-icon-only icon-remove"></i>
									</a>
								</td>	
							</tr>
							<?php } ?>
						</tbody>
						<?php if($count>10) : ?>
						<tfoot>
							<tr>
								<td colspan="4">
									<ul class="pagination pagination-split m-bottom-md">
										<li><a href="#">Pages</a></li>
										<?php 
											$mod=10; $inc=1;
											if($tcount>$mod) :
												for($i=0;$i<=$tcount;$i++) :
													if(($i%$mod)==0) :
										?>
										<li class="<?php if($inc==$this->uri->segment(3))  echo "active"; else if(!($this->uri->segment(3)) && $inc==1)  echo "active"; ?>">
											<a href="<?php echo base_url()."topics/index/".$inc; ?>"><?php echo $inc;?></a>
										</li>
										<?php
														$inc++;
													endif;
												endfor;
											endif;
											?>
									</ul>
								</td>
							</tr>
						</tfoot>
						<?php endif; ?>		
					</table>
				</div><!-- /panel -->
			</div><!-- /.col -->
		
		</div><!-- /.row -->
	</div>
</div>	