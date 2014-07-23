<?php if($this->session->flashdata('message')) : ?>
<script>
$(document).ready(function(){
	$("#successMessage").show();
});
</script>
<?php endif; ?>
<div id="main-container">
	<div class="padding-md">
		<div class="panel panel-default table-responsive">
					<div class="panel-heading">
						<h3><b><i class="icon-tasks"></i> View Articles</b>
						<span class="pull-right">
							<?php if($this->session->userdata("userTypeID")==3) : ?>
								<a class="btn btn-success icon-anchor" href="<?php echo base_url();?>article/dashboard/add"> Add Article</a>
							<?php endif; ?>
						</span></h3>
					</div>
					
					<div class="panel-body">
						<form class="form-inline no-margin" action="" method="POST">
							<div class="form-group">
								<label class="col-lg-4 control-label"><h4>Search: </h4></label>
								
									<input type="text" id="search" placeholder="Enter article" class="form-control">
								
							</div><!-- /form-group -->
						</form>
					</div>	
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<?php if($this->session->flashdata('edit')) {?>
					<div id="successMessage" class="alert alert-success">	
						<?php echo $this->session->flashdata('edit');?>
					</div>
					<?php } ?>
					<div class="padding-md clearfix">
					<div class="setArticles" id="setArticles">
						<table class="table table-bordered table-striped dataTable">
							<thead>
								<tr>
									<th>Sr. </th>
									<th>Article Topic</th>
									<th>Article Image</th>
									<th>View</th>
									<th>Created Date</th>
									<th>Last Updated On</th>
									<th class="td-actions">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								//echo $this->uri->segment(4);
									$sr=1;
									if($this->uri->segment(4)>1 ){
										$sr=10*$this->uri->segment(4)-9;
									}
								?>
								<?php  foreach($articles as $article) : ?>
								<tr>
									<td><?php echo $sr; $sr++; ?></td>
									<td><?php echo $article['topic']; ?></td>
									<td><?php if($article['image']) : ?>
										<img src="<?php echo base_url().'uploads/forum_article_images/'.$article['image']; ?>" width="100px" height="auto" />
										<?php endif; ?>
									</td>
									<td>
									<a href="<?php echo base_url();?>article/view/<?php echo $article['id'];?>">View</a>
									</td>
									<td><?php echo $article['created_date']; ?></td>
									<td>
										<?php if($article['updated_date']!="0000-00-00") : ?>
											<?php echo $article['updated_date']; ?>
										<?php endif; ?>
									</td>
									<td class="td-actions">
										<a class="btn btn-small btn-success" href="<?php echo base_url();?>article/edit/<?php echo $article['id'];?>" title="Edit : <?php echo $article['topic']; ?>">
											<i class="btn-icon-only icon-edit"> </i>
										</a>
										<a class="btn btn-danger btn-small" href="<?php echo base_url()."article/delete/".$article['id']; ?>" title="Delete : <?php echo $article['topic']; ?>">
											<i class="btn-icon-only icon-remove"></i>
										</a>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php if($count>10) : ?>
					<div class="panel-footer clearfix">
						<ul class="pagination pagination-split m-bottom-md">
							<li><a href="#">Pages</a></li>
							<?php 
								$mod=10; $inc=1;
								if($count>$mod) :
									for($i=0;$i<=$count;$i++) :
										if(($i%$mod)==0) :
							?>
							
							<li class="<?php if($inc==$this->uri->segment(4))  echo "active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "active";  ?>">
								<a href="<?php echo base_url()."article/dashboard/index/".$inc; ?>"><?php echo $inc;?></a>
							</li>
							
							<?php
											$inc++;
										endif;
									endfor;
								endif;
								?>
						</ul>
					</div>
					<?php endif; ?>	
					</div>
					</div>	
			</div><!-- /.padding-md -->
		</div>	
	</div><!-- /.padding-md -->
</div>
<script>
	var contents = $('#setArticles').html();
	jQuery('#search').on('input', function() {
    var value = $("#search").val();
	
	if(value=='')
	{
		//alert(contents);
		$('#setArticles').html(contents);
	}
	else
	{  
		$('#setArticles').empty();
		$('#setArticles').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" align="center"><br/><h3>Loading</h3>');
		$.ajax({
            url : base_url+'article/getArticles/'+value,
            type: 'POST',
            data: {submit:true},
			 // An object with the key 'submit' and value 'true;
            success: function (result) {
            //alert(result);
			//document.location = base_url+'article/dashboard/getArticles/'+value;
			$('#setArticles').empty();
			$('#setArticles').html(result);
            }
        });
	}});

</script>