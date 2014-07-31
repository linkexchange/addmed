<div id="main-container">
	<!--<div id="breadcrumb">
		<ul class="breadcrumb">
			 <li><i class="fa fa-home"></i><a href="index.html"> Home</a></li>
			 <li>Form</li>	 
			 <li class="active">Form Element</li>	 
		</ul>
	</div><!--breadcrumb-->
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h4><b><i class="fa fa-star fa-lg"></i> Bookmarks</b>
				<span class="badge badge-info"><?php echo count($bookmarks);?> bookmarks</span> </h4>
			</div>
		</div> <br/>
		<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;background:#fff;">
					<?php if($this->session->flashdata("del")) { ?>
					<div id="successMessage" class="alert alert-success">	
						<?php echo $this->session->flashdata("del");?>
					</div>
					<?php } ?>
					
					<div class="padding-md clearfix">
						<div class="setData">
						<table class="table table-bordered table-striped dataTable">
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
						</table>
						<?php 
							$url=base_url()."bookmarks/index/";
							if($this->uri->segment(3))
							$currentPage=(int)$this->uri->segment(3);
							else
							$currentPage=1;
							$parameters=array();
							pagination($url,$parameters,$count,$currentPage);
						?>
				</div>
			</div><!-- /.padding-md -->
		</div>
	</div><!-- /.padding-md -->
</div>	