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
<?php $record_limit=(int)$this->config->item('record_limit'); $inc=1; $next=1; $count=$profileCount; ?>
<?php $pages_limit=(int)$this->config->item('pages_limit'); ?>
<?php 
    $totalPages=0;
    if($count%$record_limit==0){
        $totalPages=$count/$record_limit;
    }
    else {
         $totalPages=($count/$record_limit)+1;
    }
?>
<?php if($count>$record_limit) : ?>
    <ul class="pagination pagination-split m-bottom-md">
        <?php if($currentPage!=1) : ?>
            <?php $prev=$currentPage-1; ?>
            <li id="page-nav-prev"><a href="javascript:void(0);" onclick="getRecords(<?php echo $prev; ?>,'<?php echo $type; ?>');">Previous</a></li>
        <?php endif; ?>
        <?php for($i=1;$i<=$count;$i++) : ?>
            <?php if(($i%$record_limit)==0) : ?>
                <?php if($inc==$currentPage) : ?>
                    <li class="active" id="page-nav-<?php echo $inc; ?>"><a href="javascript:void(0);" onclick="getRecords(<?php echo $inc; ?>,'<?php echo $type; ?>');"><?php echo $inc; ?></a></li>
                    <?php $next=$inc+1; ?>
                <?php else : ?>
                    <li id="page-nav-<?php echo $inc; ?>"><a href="javascript:void(0);" onclick="getRecords(<?php echo $inc; ?>,'<?php echo $type; ?>');"><?php echo $inc; ?></a></li>
                <?php endif; ?>
                <?php $inc++; ?>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if($next!=$inc) : ?>
            <li id="page-nav-next"><a href="javascript:void(0);" onclick="getRecords(<?php echo $next; ?>,'<?php echo $type; ?>');">Next</a></li>          
        <?php endif; ?>
    </ul>     
<?php endif; ?>	
<!-- <br/>
<?php if($totalPages) : ?>
    <ul class="pagination pagination-split m-bottom-md">
        <?php if($currentPage!=1) : ?>
        <li id="page-nav-first"><a href="javascript:void(0);" onclick="getRecords('1','<?php echo $type; ?>');">First</a></li>
        <?php endif; ?>
        <?php 
            $end_limit=0; $start_limit=0;
            $start_limit=$currentPage;
            
            if($totalPages>$pages_limit)
                $end_limit=$currentPage+$pages_limit;
            else
                $end_limit=$pages_limit;
            
            if($totalPages>$end_limit){
                $start_limit=$currentPage;
                $end_limit=$currentPage+$pages_limit;
            }
            else
            {
                $start_limit=$totalPages-$pages_limit;
                $end_limit=$totalPages;
            }
        ?>
        <?php for($i=$start_limit;$i<=$end_limit;$i++) : ?>
                    <?php if(($i%$record_limit)==0) : ?>
                                            <?php if($inc==1) : ?>
                                                <li class="active" id="page-nav-<?php echo $inc; ?>"><a href="javascript:void(0);" onclick="getRecords(<?php echo $inc; ?>,'<?php echo 'Twitter'; ?>');"><?php echo $inc; ?></a></li>
                                                <?php $next=$inc+1; ?>
                                            <?php else : ?>
                                                <li id="page-nav-<?php echo $inc; ?>"><a href="javascript:void(0);" onclick="getRecords(<?php echo $inc; ?>,'<?php echo 'Twitter'; ?>');"><?php echo $inc; ?></a></li>
                                            <?php endif; ?>
                                            <?php $inc++; ?>
                                        <?php endif; ?>
                                    <?php endfor; ?>  
        <?php if($currentPage!=$totalPages) : ?>
        <li id="page-nav-last"><a href="javascript:void(0);" onclick="getRecords('<?php echo $totalPages; ?>','<?php echo $type; ?>');">Last</a></li>
        <?php endif; ?>
    </ul>
<?php endif; ?> -->
