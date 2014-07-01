<?php if($this->session->flashdata('message')) : ?>
<script>
$(document).ready(function(){
	$("#successMessage").show();
});
</script>
<?php endif; ?>

		<?php if($this->session->userdata("userTypeID")==1) : ?>
		<div class="widget"> 
			<div class="span12 offset10"> 
				<button class="btn btn-primary btn-large  icon-anchor" onclick="javascript:goto('link/adLinkCategory')">Add Category</button>
			</div>
		</div>
		<?php endif; ?>
		<div class="widget widget-table action-table">
			<div class="widget-header"> <i class="icon-th-list"></i>
				<h3>Categories</h3>
			</div>
            <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
            <?php if(isset($msg)){?>
			<div id="successMessage" class="alert alert-success">
				<?php echo $msg;?>
			</div><?php } else {?>	
			<div id="successMessage" class="alert alert-success" style="display:none">
			<?php } ?>
			<?php echo $this->session->flashdata('message');?></div>
				<?php //echo "<pre>"; print_r($urls); echo "</pre>"; ?>
			<!-- /widget-header -->
			<div class="widget-content">
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
			</div>
			<!-- /widget-content --> 
		</div>
