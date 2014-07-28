<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table class="table table-hover table-striped">
    <tbody>
        <?php foreach($profiles as $accRecord) : ?>
            <tr id="sma-acc-<?php echo $accRecord['id']; ?>">
                <?php if($accRecord['smaAccountTypeID']=='1' || $accRecord['smaAccountTypeID']=='4') : ?>
                    <td class="acc_image">
                        <span class="img-demo">
                            <img src="<?php echo $accRecord['smaAccountProfileImageUrl']; ?>" />
                        </span>
                    </td>  
                <?php endif; ?>
                <td class="acc_name">
                    <div class="pull-left m-left-sm m-top-sm ">
                        <h4><strong><?php echo $accRecord['smaAccountName']; ?></strong></h4>
                    </div>
                </td>
                <?php if($accRecord['smaAccountTypeID']=='3') : ?>
                    <td class="acc_blogs">
                        <div class="pull-left m-left-sm m-top-sm ">
                            <h4><strong><?php echo $accRecord['smaAccountBlogs']; ?></strong></h4>
                            <span class="text-muted block">Blogs</span> 
                        </div>
                    </td>
                <?php endif; ?>
                <td class="acc_followers">
                    <div class="pull-left m-left-sm m-top-sm ">
                        <h4><strong><?php echo $accRecord['smaAccountFollowers']; ?></strong></h4>
                        <span class="text-muted block">Followers</span> 
                    </div>
                </td>
                <td class="acc_posts">
                    <div class="pull-left m-left-sm m-top-sm">
                        <h4><strong><?php echo $accRecord['smaAccountPosts']; ?></strong></h4>
                        <span class="text-muted block">Posts</span> 
                    </div>
                </td>
                <?php if($accRecord['smaAccountTypeID']=='3') : ?>
                <td class="acc_likes">
                    <div class="pull-left m-left-sm m-top-sm">
                        <h4><strong><?php echo $accRecord['smaAccountLikes']; ?></strong></h4>
                            <span class="text-muted block">Likes</span> 
                        </div>
                    </td>
                <?php endif; ?>
                <td class="acc_posts">
                    <div class="pull-left m-left-sm m-top-sm ">
                        <a href="javascript:void(0);" onclick="removeRecord(<?php echo $accRecord['id']; ?>,1,'<?php echo $type; ?>');">
                             <h4><strong> <i class="fa fa-ban"></i></strong></h4> 
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
    //$this->load->helper('pagination');
    $parameters=array();
    //$parameters['page_no']=1;
    $parameters[0]=$type;
    $count=$profileCount;
    ajaxPagination('getRecords',$parameters,$count,$currentPage); 
?>