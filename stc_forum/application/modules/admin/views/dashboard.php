<?php if($this->session->flashdata('message')) : ?>
<script>
$(document).ready(function(){
	$("#successMessage").show();
});
</script>
<?php endif; ?>
<?php 
	if($_SERVER['SERVER_NAME']=="localhost"){
		$url="http://localhost/linkexchange_phase_II/html/index.php";
	}
	else
	{
		$url="http://www.socialtrafficcenter.com/phaseII/html/index.php";
	}
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                <div class="widget"> 
					<div class="span12 offset10"> 
						<button onclick="javascript:goto('admin/template/add')" class="btn btn-primary btn-large  icon-anchor"> Add Website</button>
					</div>
				</div>
                <div class="widget websites">
                    <div class="widget-header"> 
                       	<i class="icon-list-alt"></i>
                        	<h3>View Websites</h3>
                    </div><!-- widget-header -->
                    <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
                    <div id="successMessage" class="alert alert-success" style="display:none"><?php echo $this->session->flashdata('message');?></div>
                    <div class="widget-content top-template-selector">
                        <?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. </th>
                                        <th>Website Name</th>
                                        <th>API Key</th>
                                        <th>View</th>
                                        <th>Website Created Date</th>
                                        <th>Last Updated On</th>
                                        <th>HTML Created Date</th>
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
                                    <?php  foreach($templates as $item) : ?>
                                        <tr>
                                            <td><?php echo $sr; $sr++; ?></td>
                                            <td><?php echo $item['name']; ?></td>
                                            <!--<td><?php if($item['htmlCreated']=="Update" && $item['htmlCreatedDate']=="0000-00-00") : echo "Create"; else : echo $item['htmlCreated']; endif; ?></td>-->
                                            <td><?php echo $item['apiKey']; ?></td>
                                            <td>
                                                <?php echo $item['path']; ?>
                                                 <a class="" href="<?php echo $url."?tid=".$item['id']; ?>" title="" target="_blank">
                                                    View
                                                </a>
                                            </td>
                                            <td><?php echo $item['createdDate']; ?></td>
                                            <td><?php if(isset($item['updatedDate']) && $item['updatedDate']!="0000-00-00") : echo $item['updatedDate']; endif; ?></td>
                                            <td><?php if(isset($item['htmlCreatedDate']) && $item['htmlCreatedDate']!="0000-00-00") : echo $item['htmlCreatedDate']; endif; ?></td>
                                            <td>
                                                <a class="btn btn-small btn-success" href="<?php echo base_url()."admin/templates/edit/".$item['id']; ?>" title="Edit Website : <?php echo $item['name']; ?>">
                                                    <i class="btn-icon-only icon-edit"> </i>
                                                </a>
                                                <a class="btn btn-danger btn-small" href="<?php echo base_url()."admin/templates/delete/".$item['id']; ?>">
                                                    <i class="btn-icon-only icon-remove"></i>
                                                </a>
                                                <?php if($item['htmlCreated']!="Done") : ?>
                                                <!--<a class="btn btn-small btn-primary" href="javascript:void(0)" title="Create/Update HTML : <?php echo $item['name']; ?>" onclick="createHtml(<?php echo $item['id']; ?>)">
                                                    <i class="btn-icon-only icon-anchor"> </i>
                                                </a>-->
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <!--<tfoot>
                                    <tr>
                                        <th>Sr. </th>
                                        <th>Website Name</th>
                                        <th>HTML Created</th>
                                        <th>View</th>
                                        <th>Created Date</th>
                                        <th class="td-actions"> </th>
                                    </tr>
                                </tfoot>-->
                            </table>
                            <?php if($count>10) : ?>
                            <div class="widget-header" style="text-align:right;">
                            <?php 
                                $mod=10; $inc=1;
                                if($count>$mod) :
                                    echo "Pages:";
                                    for($i=0;$i<=$count;$i++) :
                                        if(($i%$mod)==0) :
                                            //echo $inc;
                                        ?>
                                        <a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."publisher/dashboard/index/".$inc; ?>" ><?php echo $inc; ?></a>
                                            <?php
                                            $inc++;
                                        endif;
                                    endfor;
                                endif;
                            ?> &nbsp;
                            </div>
                            <?php endif; ?>
                        </div><!--widget-content top-template-selector-->
                    </div><!--widget websites-->
                </div><!-- span12 -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- main-inner -->
</div><!-- main -->
<script>
$(document).ready(function(){
	
});
function createHtml(tid){
	alert(tid);
	if(tid){
		$.ajax({
			url:base_url+"template/dashboard/createHtml/"+tid,
			//beforeSend: loadStartPub,
			//complete: loadStopPub,
			success:function(result){
				//$("#setBlogsData").html(result);
			}});
		}
		else
		{
			//$("#setBlogsData").html("");
		}
}
</script>