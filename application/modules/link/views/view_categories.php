<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h3><b><i class="icon-anchor"></i> View Link Categories</b>
				<span class="pull-right">
					<a class="btn btn-success icon-anchor" href="<?php echo base_url();?>link/adLinkCategory"> Add Link Category</a>
				</span></h3>
			</div>
		</div> <br/>
		<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
			<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
			<?php if(isset($msg)){?>
			<div id="successMessage" class="alert alert-success">
				<?php echo $msg;?>
			</div>
			<?php } else if($this->session->flashdata('message')){?>	
			<div id="successMessage" class="alert alert-success">
			<?php echo $this->session->flashdata('message');?></div>
			<?php } ?>
			
			<div class="padding-md clearfix">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Category Name</th>
                           	<th>Cost Per Click</th>
							<th>Created at</th>
							<th>Updated at</th>
							<th class="td-actions"> </th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($cats as $cat)
						{
						?>
						<tr>
							<td><?php echo $cat['category_name']; ?></td>
							<td><?php echo $cat['cost_per_click'];?></td>
							<td><?php echo $cat['created_date']; ?></td>
							<td><?php echo $cat['updated_date'];?></td>
							<td class="td-actions">
							<?php
							if($this->session->userdata("userTypeID")==2 || $this->session->userdata("userTypeID")==1)
							{
							?>
									<a class="btn btn-small btn-success" href="<?php echo base_url()."link/editCategory/".$cat['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
									<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/deleteCategory/".$cat['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
							<?php
							}
							?>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
				<div class="widget-header" style="text-align:right;">
					<?php 
						$mod=10; $inc=1;
						if($cats_count>$mod) :
							echo "Pages:";
							for($i=0;$i<=$url_count;$i++) :
								if(($i%$mod)==0) :
									//echo $inc;
									?>
										<a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(3))  echo "page-active"; else if(!($this->uri->segment(3)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."link/index/".$inc; ?>" ><?php echo $inc; ?></a>
									<?php
									$inc++;
								endif;
							endfor;
						endif;
					?> &nbsp;
				</div>		
			</div><!-- /.padding-md -->
		</div>	
	</div><!-- /.padding-md -->
</div>
