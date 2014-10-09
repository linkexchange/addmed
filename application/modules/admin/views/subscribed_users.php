<div id="main-container">
    <div class="padding-md">
	<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
            <div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
            	<h3>
                    <b><i class="icon-user"></i>View Subscribed Users</b>
                    <span class="pull-right">
                        <a class="btn btn-success icon-anchor" href="<?php echo base_url();?>admin/dashboard/export_subscribed_userlist">  Export User List</a>
                    </span>
                </h3>
            </div>
        </div> <br/>
	<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
            <?php if($this->session->flashdata('sub')) { ?>
                <div id="successMessage" class="alert alert-success">
                    <?php echo $this->session->flashdata('sub');?>
				</div>
            <?php } ?>
            <div class="padding-md clearfix">
                <?php 
                        //echo $this->uri->segment(4);
			$sr=1;
			if($this->uri->segment(4)>1)
                        {
                            $sr=(int)$this->config->item('record_limit')*$this->uri->segment(4)-((int)$this->config->item('record_limit')-1);
			}
                    ?>
		<table class="table table-bordered table-condensed table-hover table-striped">
                    <thead style="border:1px solid graylight;">
			<tr>
                            <th width="10%">Sr.</th>
                           <!-- <th>User Name</th>-->
                            <th>Email</th>
                            <th class="td-actions"> </th>
			</tr>
                    </thead>
                    <tbody style="border:1px solid graylight;">
                        <?php 
                            foreach($users as $user)
                            {
                            ?>
                                <tr>
                                    <td width="10%"><?php echo $sr; ?>.</td>                                    
                                   
                                    <td width="60%"><?php echo $user['email']; ?></td>                                    
                                    <td class="td-actions">
					<a class="btn btn-danger btn-small" href="<?php echo base_url()."user/profile/delete_sub/".$user['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
                                    </td>
				</tr>
                                <?php $sr++; ?>
                            <?php
                            }
			?>
                    </tbody>
                </table>
                <?php 
                    $count;
                    $url=base_url()."admin/dashboard/subscribed_users/";
                    if($this->uri->segment(4))
                        $currentPage=$this->uri->segment(4);
                    else
                        $currentPage=1;
                    $parameters=array();
                    pagination($url,$parameters,$count,$currentPage);
                ?>
            </div><!-- /.padding-md -->
        </div>	
    </div><!-- /.padding-md -->
</div>	