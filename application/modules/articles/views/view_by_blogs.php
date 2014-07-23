<?php if($this->uri->segment(4)) : ?>
<script>
	$(document).ready(function(){
		var tid=<?php echo $this->uri->segment(4); ?>;
		var bid=<?php echo $this->uri->segment(5); ?>;
		var page=<?php echo $this->uri->segment(6); ?>;
		 $.ajax({
				url:base_url+"articles/dashboard/getTemplateBlogs/"+tid+"/"+bid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					$("#setBlogsData").html(result);
			}});
	});
</script>
<?php endif; ?>
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
						<h3><b><i class="icon-list-alt"></i> View Gallery Items</b>
						<span class="pull-right">
							<?php if($this->session->userdata("userTypeID")==3) : ?>
								<a class="btn btn-success icon-anchor" href="<?php echo base_url();?>articles/dashboard/addmultiple"> Add Gallery Item</a>
							<?php endif; ?>
						</span></h3>
					</div>
					<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
					<div id="successMessage" class="alert alert-success" style="display:none"><?php echo $this->session->flashdata('message');?></div>
					<div class="panel-body">
						<form class="form-inline no-margin" id="frm_viewByBlog" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<table>
								<tr>
								<td>
								<label><h4>Select Website : </h4></label>
								<select id="templateID" name="templateID" class="form-control validate[required]" onchange="getBlogs(this.value);">
									<option value="">Please Select</option>
									<?php foreach($templates as $template) : ?>
										<?php if((isset($tempID) && $template['id']==$tempID) || $template['id']==$this->uri->segment(4)) : ?>
											<option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
										<?php else : ?>
											<option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
								</td>
								<td id="setBlogsData" class="select-content">
									
								</td>
								</tr>
								</table>	
							</div><!-- /form-group -->
						</form>
					</div>
					<div class="padding-md clearfix">
					<div class="setArticles">
						<table class="table table-bordered table-striped dataTable">
							<thead>
								<tr>
									<th>Sr. </th>
									<th>Gallery Item Title</th>
									<!-- <th>Gallery Item Image</th>
									<th>Gallery Item Video</th> -->
									<th>Post Name</th>
									<th>Website Name</th>
									<th>Created Date</th>
									<th>Last Updated On</th>
									<?php if($this->uri->segment(4) && $this->uri->segment(5)) : ?>
									<th>Sort Order</th>
									<?php endif; ?>
									<th class="td-actions">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								//echo $this->uri->segment(4);
									$sr=1;
									if($this->uri->segment(6)>1 ){
										$sr=10*$this->uri->segment(6)-9;
									}
								?>
								<?php  foreach($articles as $article) : ?>
								<tr>
									<td><?php echo $sr; $sr++; ?></td>
									<td><?php echo $article['articleTitle']; ?></td>
									<!-- <td>
										<?php if($article['articleImage']) : ?>
											<img src="<?php echo base_url().ARTICLE_IMAGE_PATH.$article['articleImage']; ?>" width="100px" height="auto" />
										<?php endif; ?>
									</td>
									<td><div class="article_videos"><?php echo $article['articleVideo']; ?></div></td> -->
									<td><?php echo $article['title']; ?></td>
									<td><?php echo $article['name']; ?></td>
									<td><?php echo $article['createdDate']; ?></td>
									<td>
										<?php if($article['updatedDate']!="0000-00-00") : ?>
											<?php echo $article['updatedDate']; ?>
										<?php endif; ?>
									</td>
									<?php if($this->uri->segment(4) && $this->uri->segment(5)) : ?>
									 <td>
										<select id="sortOrder" name="sortOrder" onchange="sort_order_change(<?php echo $article['id']; ?>, this.value);">
											<?php for($i=1;$i<=$count;$i++): ?>
												<?php if($i==$article['sortOrder']) : ?>
													<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
												<?php else : ?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php endif; ?>
											<?php endfor; ?>
										</select>                                                     
									</td>
									<?php endif; ?>
									<td class="td-actions">
										<a class="btn btn-small btn-success" href="<?php echo base_url()."articles/dashboard/edit/".$article['id']; ?>" title="Edit : <?php echo $article['articleTitle']; ?>" style="margin-bottom:5px;">
											<i class="btn-icon-only icon-edit"> </i>
										</a>
										<a class="btn btn-danger btn-small" href="<?php echo base_url()."articles/dashboard/delete/".$article['id']; ?>" title="Delete : <?php echo $article['articleTitle']; ?>">
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
							<?php if($this->uri->segment(4) && $this->uri->segment(5)) : ?>
							<li class="<?php if($inc==$this->uri->segment(6))  echo "active"; else if(!($this->uri->segment(6)) && $inc==1)  echo "active";  ?>">
								<a href="<?php echo base_url()."articles/dashboard/index/".$inc; ?>"><?php echo $inc;?></a>
							</li>
							<?php else : ?>
							<li class="<?php if($inc==$this->uri->segment(6))  echo "active"; else if(!($this->uri->segment(6)) && $inc==1)  echo "active";  ?>">
								<a href="<?php echo base_url()."articles/dashboard/index/0/0/".$inc; ?>"><?php echo $inc;?></a>
							</li>
							<?php endif; ?>
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
			</div><!-- /.padding-md -->
		</div>	
	</div><!-- /.padding-md -->
</div>
<script>
	function getBlogs(tid){
		if(tid){
			 $.ajax({
				url:base_url+"articles/dashboard/getTemplateBlogs/"+tid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					$("#setBlogsData").html(result);
			}});
		}
		else
		{
			$("#setBlogsData").html("");
		}
	}
	function getDetails(bid){
		if(bid){
			var tid=$("#templateID").val();
			//alert(tid);
			$.ajax({
				url:base_url+"articles/dashboard/getArticlesByTemplatesAndBlog/"+tid+"/"+bid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					$(".setArticles").html(result);
			}});
		}
		else
		{
			$(".setArticles").html("");
		}
		
	}
        function sort_order_change(aid, sort_order){
            $.ajax({
		url:base_url+"articles/dashboard/setSortOreder/"+aid+"/"+sort_order,
		//beforeSend: loadStartPub,
		//complete: loadStopPub,
		success:function(result){
                    if(result==1){
                        $("#successMessage").html("Sort Order updated successfully for article ID "+aid+".");
			$("#successMessage").show();
                    }
                    else if(result==0){
                         $("#errorMessage").html("Sort Order updation failed for article ID "+aid+".");
			$("#errorMessage").show();
                    }
            }});
        }
</script>