<table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. </th>
                                                        <th>Gallery Item Title</th>
                                                        <th>Gallery Item Image</th>
                                                        <th>Gallery Item Video</th>
                                                        <th>Post Name</th>
                                                        <th>Website Name</th>
                                                        <th>Created Date</th>
                                                        <th>Last Updated On</th>
                                                        <th>Sort Order</th>
                                                        <th class="td-actions">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    //echo $this->uri->segment(4);
                                                        $sr=1;
                                                        if($this->uri->segment(6)>1 ){
                                                            $sr=10*$this->uri->segment(4)-9;
                                                        }
                                                    ?>
                                                    <?php  foreach($articles as $article) : ?>
                                                    <tr>
                                                        <td><?php echo $sr; $sr++; ?></td>
                                                        <td><?php echo $article['articleTitle']; ?></td>
                                                        <td>
                                                            <?php if($article['articleImage']) : ?>
                                                                <img src="<?php echo base_url().ARTICLE_IMAGE_PATH.$article['articleImage']; ?>" width="100px" height="auto" />
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><div class="article_videos"><?php echo $article['articleVideo']; ?></div></td>
                                                        <td><?php echo $article['title']; ?></td>
                                                        <td><?php echo $article['name']; ?></td>
                                                        <td><?php echo $article['createdDate']; ?></td>
                                                        <td>
                                                            <?php if($article['updatedDate']!="0000-00-00") : ?>
                                                                <?php echo $article['updatedDate']; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <select id="sortOrder" name="sortOrder" onchange="sort_order_change(<?php echo $article['id']; ?>, this.value);">
                                                                <?php for($i=1;$i<=$count;$i++): ?>
                                                                    <?php if($i==$article['sortOrder']) : ?>
                                                                        <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                                                                    <?php else : ?>
                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                    <?php endif; ?>
                                                                <?php endfor; ?>
                                                            </select>                                                     
                                                        </td>
                                                        <td class="td-actions">
                                                            <a class="btn btn-small btn-success" href="<?php echo base_url()."articles/dashboard/edit/".$article['id']; ?>" title="Edit : <?php echo $article['articleTitle']; ?>" style="margin-bottom:5px;">
                                                                <i class="btn-icon-only icon-edit"> </i>
                                                            </a>
                                                            <a class="btn btn-danger btn-small" href="<?php echo base_url()."articles/dashboard/delete/".$article['id']; ?>" title="Delete : <?php echo $article['articleTitle']; ?>">
                                                                <i class="btn-icon-only icon-remove"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                    		</table><!-- table -->
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
                                                           <a class="btn btn-small btn-success page-<?php echo $inc; ?> <?php if($inc==$this->uri->segment(4))  echo "page-active"; else if(!($this->uri->segment(4)) && $inc==1)  echo "page-active";  ?>" href="<?php echo base_url()."articles/dashboard/index/".$templateID."/".$blogID."/".$inc; ?>" ><?php echo $inc; ?></a>
                                                                <?php
                                                                $inc++;
                                                            endif;
                                                        endfor;
                                                    endif;
                                                ?> &nbsp;
                                            </div><!-- widget-header pagination -->
                                            <?php endif; ?>