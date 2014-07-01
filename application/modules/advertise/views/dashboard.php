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
                	<div class="span12" style="margin:0px 0px 15px 0px; text-align:right; "> 
                    	<button onclick="javascript:goto('advertise/dashboard/add')" class="btn btn-primary btn-large  icon-anchor"> Add Ad</button>
                    </div><!--span12 offset10-->
                   
                    <div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>View Ads</h3>
						</div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"><?php echo $this->session->flashdata('message');?></div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                                	<?php //echo "<pre>"; print_r($ads); echo "</pre>"; ?>
                                   	<table class="table table-striped table-bordered">
                                    	<thead>
                                        	<tr>
                                                <th>Sr. </th>
                                                <th>Webiste Title</th>
                                                <th>Created Date</th>
                                                <th>Updated Date</th>
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
                                        	<?php foreach ($ads as $ad) : ?>
                                            	<tr>
                                                	<td><?php echo $sr; $sr++; ?></td>
                                                    <td><?php echo $ad['name']; ?></td>
                                                	<td><?php echo $ad['createdDate']; ?></td>
                                                    <td><?php if($ad['updatedDate'] != "0000-00-00") : echo $ad['updatedDate'];  endif; ?></td>
                                                    <td class="td-actions">
                                                    	<!--<a class="btn btn-small btn-success" href="<?php echo base_url()."advertise/dashboard/view/".$ad['id']; ?>" title="View">
                                                            <i class="btn-icon-only icon-edit"> </i>
                                                        </a>-->
                                                        <a class="btn btn-small btn-success" href="<?php echo base_url()."advertise/dashboard/edit/".$ad['id']; ?>" title="Edit">
                                                            <i class="btn-icon-only icon-edit"> </i>
                                                        </a>
                                                        <a class="btn btn-danger btn-small" href="<?php echo base_url()."advertise/dashboard/delete/".$ad['id']; ?>" title="Delete">
                                                            <i class="btn-icon-only icon-remove"></i>
                                                        </a>
                                                	</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                  	</table>
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
                                                    <a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."articles/dashboard/index/".$inc; ?>" ><?php echo $inc; ?></a>
                                                        <?php
                                                        $inc++;
                                                    endif;
                                                endfor;
                                            endif;
                                        ?> &nbsp;
									</div><!-- widget-header pagination -->
                                    <?php endif; ?>
                                </div><!--widget-content inner-->
                           	</div><!--big-stats-container-->
                       	</div><!--widget-content-->
                   	</div><!--widget-->
                </div><!--span12-->
            </div><!--row-->
       	</div><!--container-->
   	</div><!--main-inner-->
</div><!--main-->