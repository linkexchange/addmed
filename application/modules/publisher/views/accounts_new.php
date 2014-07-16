<?php
ob_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<link href="<?php echo base_url(); ?>/css/custom_sunil.css" rel="stylesheet" />

<div id="main-container">
    <div id="breadcrumb">
        <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
            <li class="active">Blank page</li>	 
	</ul>
    </div>
    <?php //echo "<pre>"; print_r($twitterProfileCount); echo "</pre>"; ?>     
    <div class="padding-md">
        <div class="row">
            <!-- <?php if(($this->session->flashdata('error'))): ?><div id="errorMessage" class="alert alert-danger"><?php  echo $this->session->flashdata('error'); ?></div><?php endif; ?>
            <?php if(($this->session->flashdata('succ'))): ?><div id="successMessage" class="alert alert-success"><?php echo $this->session->flashdata('succ'); ?></div><?php endif; ?> -->
            <div id="successMessage" class="alert alert-success" style="display:none;"></div>
            <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:right;">
                    Connect Your Social Media Accounts : 
                    <a class="btn btn-twitter btn-social-media" href="<?php echo base_url(); ?>twitter/twitter/connectTwitter"><i class="fa fa-twitter fa-lg"></i></a>
                    <a class="btn btn-facebook btn-social-media"><i class="fa fa-facebook fa-lg"></i></a>
                    <a class="btn btn-tumblr btn-social-media" href="<?php echo base_url(); ?>tumblr/dashboard/connect"><i class="fa fa-tumblr fa-lg"></i></a>
                    <a class="btn btn-instagram btn-social-media"><i class="fa fa-instagram fa-lg"></i></a>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="social-box twitter">
                    <i class="fa fa-twitter"></i>
                    <ul>
                        <li>
                            <strong id="twitter-followers"><?php echo $totalTwitterFollowers[0]['smaAccountFollowers']; ?></strong>
                            <span>followers</span>
			</li>
			<li>
                            <strong id="twitter-posts"><?php echo $totalTwitterPosts[0]['smaAccountPosts']; ?></strong>
                            <span>Posts</span>
			</li>
                    </ul>
		</div><!--/social-box-->			
            </div><!--/col-->
            <div class="col-md-3">
                <div class="social-box facebook">
                    <i class="fa fa-facebook"></i>
                    <ul>
                        <li>
                            <strong>89k</strong>
                            <span>Likes</span>
                        </li>
			<li>
                            <strong>459</strong>
                            <span>Pages</span>
			</li>
                    </ul>
                </div><!--/social-box-->			
            </div><!--/col-->
            <div class="col-md-3">
                <div class="social-box tumblr">
                    <i class="fa fa-tumblr"></i>
                    <ul>
                        <li>
                            <strong>500+</strong>
                            <span>Followers</span>
			</li>
			<li>
                            <strong>292</strong>
                            <span>Posts</span>
			</li>
                    </ul>
		</div><!--/social-box-->			
            </div><!--/col-->
            <div class="col-md-3">
                <div class="social-box instagram">
                    <i class="fa fa-instagram"></i>
                    <ul>
                        <li>
                            <strong>894</strong>
                            <span>followers</span>
			</li>
			<li>
                            <strong>92</strong>
                            <span>Posts</span>
			</li>
                    </ul>
		</div><!--/social-box-->			
            </div><!--/col-->	
        </div>
        <div class="row">
            <div class="panel panel-default">
		<ul class="tab-bar grey-tab">
                    <li class="active">
                        <a data-toggle="tab" href="#twitter" id="twitter-tab">
                            <span class="block text-center">
                                <i class="fa fa-twitter fa-2x"></i> 
                            </span>
                            Twitter
			</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#facebook" id="facebook-tab">
                            <span class="block text-center">
                                <i class="fa fa-facebook fa-2x"></i> 
                            </span>
                            Facebook
			</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tumblr" id="tumblr-tab">
                            <span class="block text-center">
                                <i class="fa fa-tumblr fa-2x"></i> 
                            </span>	
                            Tumblr
			</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#instagram" id="instagram-tab">
                            <span class="block text-center">
                        	<i class="fa fa-instagram fa-2x"></i> 
                            </span>	
                            Instagram
                        </a>
                    </li>
		</ul>
                <div class="padding-md">
                    <div class="tab-content">
                        <div id="twitter" class="tab-pane fade active in">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php foreach($twitterProfiles as $twitterAcc) : ?>
                                    <tr id="sma-acc-<?php echo $twitterAcc['id']; ?>">
                                            <td class="acc_image">
                                                <span class="img-demo">
                                                    <img src="<?php echo $twitterAcc['smaAccountProfileImageUrl']; ?>" />
                                                </span>
                                            </td>  
                                            <td class="acc_name">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong><?php echo $twitterAcc['smaAccountName']; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span>
                                                    <span class="text-muted block">$360</span> -->
                                                </div>
                                            </td>
                                            <td class="acc_followers">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong><?php echo $twitterAcc['smaAccountFollowers']; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Followers</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm">
                                                    <h4><strong><?php echo $twitterAcc['smaAccountPosts']; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Posts</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <a href="javascript:void(0);" title="Disconnect" alt="Disconnect" onclick="removeRecord(<?php echo $twitterAcc['id']; ?>,1,'<?php echo 'Twitter'; ?>');">
                                                    <h4><strong> <i class="fa fa-ban"></i></strong></h4> 
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php $mod=(int)$this->config->item('record_limit'); $inc=1; $next=1;?>
                            <?php if($twitterProfileCount>$mod) : ?>
                                <ul class="pagination pagination-split m-bottom-md">
                                    <!-- <li><a href="#">Previous</a></li> -->
                                    <?php for($i=1;$i<=$twitterProfileCount;$i++) : ?>
                                        <?php if(($i%$mod)==0) : ?>
                                            <?php if($inc==1) : ?>
                                    <li class="active" id="page-nav-<?php echo $inc; ?>"><a href="javascript:void(0);" onclick="getRecords(<?php echo $inc; ?>,'<?php echo 'Twitter'; ?>');"><?php echo $inc; ?></a></li>
                                                <?php $next=$inc+1; ?>
                                            <?php else : ?>
                                                <li id="page-nav-<?php echo $inc; ?>"><a href="javascript:void(0);" onclick="getRecords(<?php echo $inc; ?>,'<?php echo 'Twitter'; ?>');"><?php echo $inc; ?></a></li>
                                            <?php endif; ?>
                                            <?php $inc++; ?>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <li id="page-nav-next"><a href="javascript:void(0);" onclick="getRecords(<?php echo $next; ?>,'<?php echo 'Twitter'; ?>');">Next</a></li>          
                                </ul>     
                            <?php endif; ?>
                            
			</div><!-- /tab-pane -->
			<div id="facebook" class="tab-pane fade">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php for($i=1;$i<=10;$i++) : ?>
                                        <tr>
                                        
                                            <td class="acc_image">
                                                <span class="img-demo">
                                                    IMAGE <?php echo $i; ?>
                                                </span>
                                            </td>  
                                            <td class="acc_name">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong>Facebook <?php echo $i; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span>
                                                    <span class="text-muted block">$360</span> -->
                                                </div>
                                            </td>
                                            <td class="acc_followers">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong><?php echo $i*1000; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Likes</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm">
                                                    <h4><strong><?php echo $i*100; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Posts</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <a href="#">
                                                    <h4><strong>Disconnect</strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            <ul class="pagination pagination-split m-bottom-md">
				<li><a href="#">Previous</a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">8</a></li>
				<li><a href="#">9</a></li>
				<li><a href="#">Next</a></li>
                            </ul>
                        </div><!-- /tab-pane -->
                        <div id="tumblr" class="tab-pane fade">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php for($i=1;$i<=10;$i++) : ?>
                                        <tr>
                                        
                                            <td class="acc_image">
                                                <span class="img-demo">
                                                    IMAGE <?php echo $i; ?>
                                                </span>
                                            </td>  
                                            <td class="acc_name">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong>Tumblr <?php echo $i; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span>
                                                    <span class="text-muted block">$360</span> -->
                                                </div>
                                            </td>
                                            <td class="acc_followers">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong><?php echo $i*1000; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Followers</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm">
                                                    <h4><strong><?php echo $i*100; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Posts</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <a href="#">
                                                    <h4><strong>Disconnect</strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            <ul class="pagination pagination-split m-bottom-md">
				<li><a href="#">Previous</a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">8</a></li>
				<li><a href="#">9</a></li>
				<li><a href="#">Next</a></li>
                            </ul>
			</div><!-- /tab-pane -->
			<div id="instagram" class="tab-pane fade">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php for($i=1;$i<=10;$i++) : ?>
                                    <tr id="">
                                        
                                            <td class="acc_image">
                                                <span class="img-demo">
                                                    IMAGE <?php echo $i; ?>
                                                </span>
                                            </td>  
                                            <td class="acc_name">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong>Instagram <?php echo $i; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span>
                                                    <span class="text-muted block">$360</span> -->
                                                </div>
                                            </td>
                                            <td class="acc_followers">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong><?php echo $i*1000; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Followers</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm">
                                                    <h4><strong><?php echo $i*100; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Posts</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <a href="">
                                                    <h4><strong>Disconnect</strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            <ul class="pagination pagination-split m-bottom-md">
				<li><a href="#">Previous</a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">8</a></li>
				<li><a href="#">9</a></li>
				<li><a href="#">Next</a></li>
                            </ul>
			</div><!-- /tab-pane -->
			</div><!-- /tab-content -->
                        </div>
                    </div>
                </div>
            </div>
        </diV>
<?php 
    if(($this->session->flashdata('succ'))): ?>
        <script> 
            $(document).ready(function(){
                 $("#successMessage").html('<?php echo $this->session->flashdata('succ'); ?>');
                $("#successMessage").show();
                runEffect();
            });
        </script>
<?php
    endif;
?>
<?php 
    if(($this->session->flashdata('error'))): ?>
        <script> 
            $(document).ready(function(){
                $("#errorMessage").html('<?php echo $this->session->flashdata('error'); ?>');
                $("#errorMessage").show();
            });
        </script>
<?php
    endif;
?>
<script>
    function getRecords(pageNum,type){
        $.ajax({
            url:"<?php echo base_url(); ?>publisher/ajaxfunctions/getAccountRecords/"+pageNum+"/"+type,
                //beforeSend: loadStartPub,
		//complete: loadStopPub,
            success:function(result){
            	//alert(result);
                if(type=='Twitter'){
                    $('#twitter').html(result);
                }
            	//$(".accepted table").html(result);
         }});
            //pageactive(pid);
    }
    function removeRecord(id,pageNum,type){
        $.ajax({
            url:"<?php echo base_url(); ?>publisher/ajaxfunctions/removeAccountRecords/"+id,
                //beforeSend: loadStartPub,
		//complete: loadStopPub,
            success:function(result){
            	//alert(result);
                if(result>0){
                  $("#successMessage").html("Account disconnected successfully.");
                  $("#successMessage").show();
                  $("#sma-acc-"+id).fadeIn('slow');
                  $("#sma-acc-"+id).hide();
                  updateFollowers(type);
                  updatePosts(type);
                }
                else
                {
                    $("#errorMessage").html("Account disconnection failed.");
                    $("#errorMessage").show();
                }
                //getRecords(pageNum,type);
            	//$(".accepted table").html(result);
            }});
            //pageactive(pid);
    }
    function updateFollowers(type){
        $.ajax({
            url:"<?php echo base_url(); ?>publisher/ajaxfunctions/getUpdatedFollowers/"+type,
                //beforeSend: loadStartPub,
		//complete: loadStopPub,
            success:function(result){
            	//alert(result);
                if(type=='Twitter'){
                    $('#twitter-followers').html(result);
                }
            	//$(".accepted table").html(result);
         }});
    }
    function updatePosts(type){
        $.ajax({
            url:"<?php echo base_url(); ?>publisher/ajaxfunctions/getUpdatedPosts/"+type,
                //beforeSend: loadStartPub,
		//complete: loadStopPub,
            success:function(result){
            	//alert(result);
                if(type=='Twitter'){
                    $('#twitter-posts').html(result);
                }
            	//$(".accepted table").html(result);
         }});
    }
    function runEffect() {
       var selectedEffect = 'blind';
       var options = {};
       $("#successMessage").hide(selectedEffect, options, 500);
    };
</script>