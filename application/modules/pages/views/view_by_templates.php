<?php if($this->uri->segment(4) && isset($tempID)) : ?>
<script>
	$(document).ready(function(){
		var tid=<?php echo $tempID; ?>;
		var page=<?php echo $this->uri->segment(5); ?>;
		if(tid){
			 $.ajax({
				url:base_url+"pages/dashboard/getTemplatePages/"+tid+"/"+page,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					//alert(result);
					$(".setData").html(result);
			}});
			}
			else
			{
				$(".setData").html("");
			}
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
	

<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                	<div class="widget add-blog"> 
                        <div class="span12 offset10"> 
                            <button onclick="javascript:goto('pages/dashboard/add')" class="btn btn-primary btn-large  icon-anchor">Add Page</button>
                        </div><!-- span12 offset10 -->
					</div><!-- widget add-blog -->
                    <div class="widget blogs">
                        <div class="widget-header"> 
                            <i class="icon-list-alt"></i>
                                <h3>View Pages</h3>
                        </div><!-- widget-header -->
                        <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
						<div id="successMessage" class="alert alert-success" style="display:none"><?php echo $this->session->flashdata('message');?></div>
                        <div class="widget-content top-template-selector">
                            <?php //echo "<pre>"; print_r($templates); echo "</pre>"; ?>
                            <form class="form-horizontal" id="frm_editBlog" action="" method="POST" enctype="multipart/form-data" >
                                    <fieldset>
                                        <div class="control-group">
                                            <label for="template" class="control-label">Select Website</label>
                                            <div class="controls">
                                            	<?php //print_r($templates); ?>
                                                <select id="templateID" name="templateID" class="validate[required]" onchange="getDetails(this.value);">
                                                    <option value="">Please Select</option>
                                                    <?php foreach($templates as $template) : ?>
                                                        <?php if((isset($tempID) && $template['id']==$tempID) || $template['id']==$this->uri->segment(4)) : ?>
                                                            <option value="<?php echo $template['id']; ?>" selected="selected"><?php echo $template['name']; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?php echo $template['id']; ?>"><?php echo $template['name']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                    </fieldset>
                            </form>
                            <div class="table-content-div" style="margin-top:15px;">
                                <div class="setData">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sr. </th>
                                                <th>Page Title</th>
                                                <th>Website Name</th>
                                                <th>Created Date</th>
                                                <th class="td-actions">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                //echo $this->uri->segment(4);
                                                $sr=1;
                                                if($this->uri->segment(5)>1 ){
                                                    $sr=10*$this->uri->segment(5)-9;
                                                }
												$this->load->model('article');
                                            ?>
                                            <?php  foreach($pages as $item) : ?>
                                                <tr>
                                                    <td><?php echo $sr; $sr++; ?></td>
                                                    <td><?php echo $item['title']; ?></td>
                                                   
													<td><?php echo $item['name']; ?></td>
													<td><?php echo $item['createdDate']; ?></td>
                                                    <td>
                                                        <a class="btn btn-small btn-success" href="<?php echo base_url()."pages/dashboard/edit/".$item['id']; ?>" title="Edit Post : <?php echo $item['title']; ?>">
                                                            <i class="btn-icon-only icon-edit"> </i>
                                                        </a>
                                                        <a class="btn btn-danger btn-small" href="<?php echo base_url()."pages/dashboard/delete/".$item['id']; ?>">
                                                            <i class="btn-icon-only icon-remove"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php if($count>10): ?>
                                    <div class="widget-header" style="text-align:right;">
                                     
                                    <?php 
                                        $mod=10; $inc=1;
                                        if($count>$mod) :
                                            echo "Pages:";
                                            for($i=0;$i<=$count;$i++) :
                                                if(($i%$mod)==0) :
                                                    //echo $inc;
                                                ?>
                                                <a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(5))  echo "page-active"; else if(!($this->uri->segment(5)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."pages/dashboard/index/0/".$inc; ?>" ><?php echo $inc; ?></a>
                                                    <?php
                                                    $inc++;
                                                endif;
                                            endfor;
                                        endif;
                                    ?> &nbsp;
                                    </div>
                                    <?php endif; ?>	
                                </div><!-- .setData -->
                            </div><!--table-content-div-->
                        </div><!-- widget-content top-template-selector -->
                    </div><!-- widget blogs  -->
                </div><!--span12-->
            </div><!--row-->
        </div><!--container-->
    </div><!--main-inner-->
</div><!--main-->
<script>
	function getDetails(lid){
			//alert(lid);
			if(lid){
			 $.ajax({
				url:base_url+"pages/dashboard/getTemplatePages/"+lid,
				//beforeSend: loadStartPub,
				//complete: loadStopPub,
				success:function(result){
					//alert(result);
					$(".setData").html(result);
			}});
			}
			else
			{
				window.location=base_url+"pages/dashboard";
			}
			//pageactive(pid);
		}
</script>