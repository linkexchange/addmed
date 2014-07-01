                                       	<table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. </th>
                                                        <th>Article Topic</th>
														<th>View</th>
														<th>Comments</th>
                                                        <th>Created Date</th>
                                                        <th>Last Updated On</th>
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
                                                    <?php  foreach($articles as $article) : ?>
                                                    <tr>
                                                        <td><?php echo $sr; $sr++; ?></td>
                                                        <td><?php echo $article['topic']; ?></td>
														<td>
														<a target="_blank" href="<?php echo base_url();?>admin/forum_article/view/<?php echo $article['id'];?>">View</a>	
														</td>
                                                        <td><a target="_blank" href="<?php echo base_url();?>admin/forum_article/comments/<?php echo $article['id'];?>">
														View </a>
														</td>
                                                        <td><?php echo $article['created_date']; ?></td>
                                                        <td>
                                                            <?php if($article['updated_date']!="0000-00-00") : ?>
                                                                <?php echo $article['updated_date']; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="td-actions">
                                                            <a class="btn btn-small btn-success" href="<?php echo base_url()."admin/forum_article/edit/".$article['id']; ?>" title="Edit : <?php echo $article['topic']; ?>">
                                                                <i class="btn-icon-only icon-edit"> </i>
                                                            </a>
                                                            <a class="btn btn-danger btn-small" href="<?php echo base_url()."admin/forum_article/delete/".$article['id']; ?>" title="Delete : <?php echo $article['topic']; ?>">
                                                                <i class="btn-icon-only icon-remove"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                    		</table><!-- table -->
											