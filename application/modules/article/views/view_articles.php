<?php if($this->session->flashdata('message')) : ?>
<script>
$(document).ready(function(){
	$("#successMessage").show();
});
</script>
<?php endif; ?>

<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
				<?php if($this->session->userdata("userTypeID")){ ?>
                	<div class="span12" style="margin:0px 0px 15px 0px; text-align:right; "> 
                    	<button onclick="javascript:goto('article/dashboard/add')" class="btn btn-primary btn-large  icon-anchor"> Add Article</button>
                    </div>
				<?php } ?>	
                	<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>View Articles</h3>
						</div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<?php if($this->session->flashdata('edit')) {?>
						<div id="successMessage" class="alert alert-success">	
							<?php echo $this->session->flashdata('edit');?>
						</div>
						<?php } ?>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
                            <span style="float:right;width:26%">Search: 
							<input type="text" id="search" placeholder="enter topic"></span>
							
								<div class="widget-content inner">
                             		<div class="widget-content inner">
                                    	
                                        <div class="setArticles" id="setArticles">
                                        	<table class="table table-striped table-bordered">
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
                                                            <img src="<?php echo base_url().'stc_forum/uploads/forum_article_images/'.$article['image']; ?>" width="100px" height="auto" />
															<?php endif; ?>
														</td>
														<td>
														<a target="_blank" href="<?php echo base_url();?>article/listing/view/<?php echo $article['id'];?>">View</a>
														</td>
														<td><?php echo $article['created_date']; ?></td>
                                                        <td>
                                                            <?php if($article['updated_date']!="0000-00-00") : ?>
                                                                <?php echo $article['updated_date']; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="td-actions">
                                                            <a class="btn btn-small btn-success" href="<?php echo base_url()."article/dashboard/edit/".$article['id']; ?>" title="Edit : <?php echo $article['topic']; ?>">
                                                                <i class="btn-icon-only icon-edit"> </i>
                                                            </a>
                                                            <a class="btn btn-danger btn-small" href="<?php echo base_url()."article/dashboard/delete/".$article['id']; ?>" title="Delete : <?php echo $article['topic']; ?>">
                                                                <i class="btn-icon-only icon-remove"></i>
                                                            </a>
                                                        </td>
													</tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                    		</table><!-- table -->
											<?php if($count>10) : ?>
                                            <div class="widget-header navigation" style="text-align:right;">
                                                <?php 
                                                    $mod=10; $inc=1;
                                                    if($count>$mod) :
                                                        echo "Pages:";
                                                        for($i=0;$i<=$count;$i++) :
                                                            if(($i%$mod)==0) :
                                                                //echo $inc; ?>
                                                           
                                                            	 <a class="btn btn-small btn-success page-<?php echo $inc;?> <?php if($inc==$this->uri->segment(6))  echo "page-active"; else if(!($this->uri->segment(6)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."article/dashboard/index/".$inc; ?>" ><?php echo $inc; ?></a>
																
                                                           
                                                                <?php
                                                                $inc++;
                                                            endif;
                                                        endfor;
                                                    endif;
                                                ?> &nbsp;
                                            </div><!-- widget-header pagination -->
                                            <?php endif; ?>
                                    	</div><!-- setArticles  -->
                                    </div><!-- widget-content  -->
                                    					
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div><!-- widget -->
                </div><!-- span12 -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- main-inner -->
</div> <!-- main -->
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
            url : base_url+'article/dashboard/getArticles/'+value,
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