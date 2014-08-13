<?php if($this->session->flashdata('message')) : ?>
<script>
$(document).ready(function(){
	$("#successMessage").show();
});
</script>
<?php endif; ?>
<div id="main-container">
    <div class="padding-md">
        <div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
            <div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
                <h3>
                    <b><i class="icon-building"></i> View Ads</b>
                    <span class="pull-right">
                        <a class="btn btn-success icon-anchor" href="<?php echo base_url();?>advertise/dashboard/add"> Add Ad</a>
                    </span>
		</h3>
            </div>
	</div> <br/>
	<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
            <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
            <div id="successMessage" class="alert alert-success" style="display:none"><?php echo $this->session->flashdata('message');?></div>
            <div class="padding-md clearfix">
                <table class="table table-bordered table-striped dataTable">
                    <thead>
                        <tr>
                            <th>Sr. </th>
                            <th>Website Title</th>
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
                        $sr=(int)$this->config->item('record_limit')*$this->uri->segment(4)-((int)$this->config->item('record_limit')-1);
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
        <div class="panel-footer clearfix">
           <?php 
                $count;
                $url=base_url()."advertise/dashboard/index/";
                if($this->uri->segment(4))
                    $currentPage=(int)$this->uri->segment(4);
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
<script>
function createHtml(tid){
	alert(tid);
	if(tid){
		$.ajax({
			url:base_url+"website/dashboard/createHtml/"+tid,
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