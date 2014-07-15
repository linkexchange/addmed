<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table class="table table-hover table-striped">
                                <tbody>
                                    <?php foreach($profiles as $accRecord) : ?>
                                        <tr>
                                        
                                            <td class="acc_image">
                                                <span class="img-demo">
                                                    <img src="<?php echo $accRecord['smaAccountProfileImageUrl']; ?>" />
                                                </span>
                                            </td>  
                                            <td class="acc_name">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong><?php echo $accRecord['smaAccountName']; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span>
                                                    <span class="text-muted block">$360</span> -->
                                                </div>
                                            </td>
                                            <td class="acc_followers">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <h4><strong><?php echo $accRecord['smaAccountFollowers']; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Followers</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm">
                                                    <h4><strong><?php echo $accRecord['smaAccountPosts']; ?></strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    <span class="text-muted block">Posts</span> 
                                                </div>
                                            </td>
                                            <td class="acc_posts">
                                                <div class="pull-left m-left-sm m-top-sm ">
                                                    <a href="javascript:void(0);" onclick="removeRecord(<?php echo $accRecord['id']; ?>,1,'<?php echo $type; ?>');">
                                                    <h4><strong>Disconnect</strong></h4>
                                                    <!-- <span class="badge badge-success">5 items</span> -->
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php $mod=(int)$this->config->item('record_limit'); $inc=1; $next=1; $count=$profileCount?>
                            <?php if($count>$mod) : ?>
                                <ul class="pagination pagination-split m-bottom-md">
                                    <?php if($currentPage!=1) : ?>
                                        <?php $prev=$currentPage-1; ?>
                                        <li id="page-nav-prev"><a href="javascript:void(0);" onclick="getRecords(<?php echo $prev; ?>,'<?php echo $type; ?>');">Previous</a></li>
                                    <?php endif; ?>
                                    
                                    <?php for($i=1;$i<=$count;$i++) : ?>
                                        <?php if(($i%$mod)==0) : ?>
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
                                    
                                    <!-- <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">6</a></li>
                                    <li><a href="#">7</a></li>
                                    <li><a href="#">8</a></li>
                                    <li><a href="#">9</a></li>
                                    <li><a href="#">Next</a></li> -->
                                </ul>     
                            <?php endif; ?>	