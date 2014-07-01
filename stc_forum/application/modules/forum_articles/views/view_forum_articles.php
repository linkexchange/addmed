
<!DOCTYPE html>
<html lang="en">
<head>
<title>Articles</title>
</head>


<div class="main">
			<div class="main-inner">
				<div class="container">
					<div class="row">
						<div class="span12">
						<div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>View Articles</h3>
						</div>
                        <?php //echo "<pre>"; print_r($articles); exit;?>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
								<span style="float:right;width:26%">Search: 
									<input type="text" id="search2" placeholder="enter topic">
								</span>
                            	<div class="widget-content inner">
                             		<div class="widget-content inner">
									<div id="articleTable">
										<table>
										<?php for($i=0;$i<count($articles);$i++){?>
										<tr> <td>
										<a target="_blank" href="<?php echo base_url();?>forum_articles/listing/view/<?php echo $articles[$i]['id'];?>">
                                        <h3><?php echo $articles[$i]['topic'];?></h3>
										</a>
										<img src="<?php echo base_url().'uploads/forum_article_images/'.$articles[$i]['image'];?>" width="200px" height="200px" style="float:left;margin-right:3px;">	
										<p style="text-align:justify">
										<?php 
											$str = substr(strip_tags($articles[$i]['description']),0,1200);
											echo "&nbsp;&nbsp;".substr($str,0,strrpos($str,'.'))."...";
										?>
										<a target="_blank" href="<?php echo base_url();?>forum_articles/listing/view/<?php echo $articles[$i]['id'];?>">[Read more]</a>
										</p>	
										</td>
										<tr>
											<td>
											<span style="float:left;"><i class="icon-user"></i> Created By: 
											 <?php echo $articles[$i]['userName'];?></span> 
											<span style="float:right;"><i class="icon-time"></i>Created Date: 
											 <?php echo $articles[$i]['created_date'];?></span></td>
										</tr>
										<tr><td><hr></td></tr>
										<?php } ?>	
                                    	</table>
										<!-- setArticles  -->
                                    <!-- widget-content  -->
                                    <?php if($count>10) : ?>
                                            <div class="widget-header navigation" style="text-align:right;">
                                                <?php 
                                                    $mod=10; $inc=1;
                                                    if($count>$mod) :
                                                        echo "Pages:";
                                                        for($i=0;$i<=$count;$i++) :
                                                            if(($i%$mod)==0) :
                                                                //echo $inc;
                                                            ?>
                                                           
                                                            	 <a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."forum_articles/listing/index/".$inc; ?>" ><?php echo $inc; ?></a>
                                                            
                                                           
                                                                <?php
                                                                $inc++;
                                                            endif;
                                                        endfor;
                                                    endif;
                                                ?> &nbsp;
                                            </div><!-- widget-header pagination -->
                                            <?php endif; ?>	
									</div>	
									</div>				
                                </div><!-- widget-content inner-->
                            </div><!-- big-stats-container -->
                    	</div><!-- widget-content -->
                    </div>
                        </div><!-- .span12-->
                    </div><!-- .row -->
                </div><!-- .container -->
           	</div><!-- .main-inner -->
        </div><!-- .main -->
        <!-- /bottom of the page -->
<script>
	var contents = $('#articleTable').html();
	jQuery('#search2').on('input', function() {
    var value = $("#search2").val();
	
	if(value=='')
	{
		//alert(contents);
		$('#articleTable').html(contents);
	}
	else
	{  
		$('#articleTable').empty();
		$('#articleTable').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" align="center"><br/><h3>Loading</h3>');
		$.ajax({
            url : base_url+'forum_articles/listing/getArticles/'+value,
            type: 'POST',
            data: {submit:true},
			 // An object with the key 'submit' and value 'true;
            success: function (result) {
            //alert(result);
			//document.location = base_url+'article/dashboard/getArticles/'+value;
			$('#articleTable').empty();
			$('#articleTable').html(result);
            }
        });
	}});
</script>

 
	