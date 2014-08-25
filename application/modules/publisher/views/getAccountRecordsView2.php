<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 //echo "<pre>"; print_R($profiles); exit;l
?>
<table class="table table-hover table-striped">
    <tbody>
        <?php foreach($profiles as $accRecord) :  ?>
            <tr id="sma-acc-<?php echo $accRecord['id']; ?>">
				<td class="acc_image">
					<span class="img-demo">
						<img src="<?php echo $accRecord['smaAccountProfileImageUrl']; ?>" />
					</span>
				</td>  
                <td class="acc_name">
                    <div class="pull-left m-left-sm m-top-sm ">
					<?php if($accRecord['smaAccountTypeID']=='1') { ?>
						 <a href="https://twitter.com/<?php echo $accRecord['smaAccountName'];?>">
					<?php } ?>	 
                        <h4><strong><?php echo $accRecord['smaAccountName']; ?></strong></h4>
					<?php if($accRecord['smaAccountTypeID']=='1') { ?>
						</a>
					<?php } ?>	
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
				<?php if($accRecord['smaAccountTypeID']!='2') { ?>
                <td class="acc_followers">
                    <div class="pull-left m-left-sm m-top-sm ">
                        <h4><strong><?php echo $accRecord['smaAccountFollowers']; ?></strong></h4>
                        <span class="text-muted block">Followers</span> 
                    </div>
                </td>
				<?php } ?>
                <td class="acc_posts">
                    <div class="pull-left m-left-sm m-top-sm">
                        <h4><strong><?php echo $accRecord['smaAccountPosts']; ?></strong></h4>
                        <span class="text-muted block">Posts</span> 
                    </div>
                </td>
                <?php if($accRecord['smaAccountTypeID']=='2') : ?>
                <td class="acc_likes">
                    <div class="pull-left m-left-sm m-top-sm">
                        <h4><strong><?php echo $accRecord['smaAccountLikes']; ?></strong></h4>
                            <span class="text-muted block">Likes</span> 
                        </div>
                    </td>
                <?php endif; ?>
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
    ajaxPagination('getRecords2',$parameters,$count,$currentPage); 
?>