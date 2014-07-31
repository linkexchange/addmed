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
                            <?php 
				//echo $this->uri->segment(4);
				$sr=1;
				if($this->uri->segment(3)>1 ){
                                    $sr=(int)$this->config->item('record_limit')*$this->uri->segment(3)-((int)$this->config->item('record_limit')-1);
				}
                            ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
                                                    <th>Sr.</th>
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
                                                    <td><?php echo $sr; ?>.</td>
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
                                                    $sr++;
						}
						?>
					</tbody>
				</table>
				<div class="panel-footer clearfix">
                                        <?php 
                                            $count=$cats_count;
                                            $url=base_url()."link/viewCategories/";
                                            if($this->uri->segment(3))
                                                $currentPage=$this->uri->segment(3);
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
