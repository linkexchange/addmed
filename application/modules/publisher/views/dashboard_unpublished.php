<div class="panel panel-default" style="margin-left:-16px;">
			<div class="panel-heading" style="border:1px solid lightgray;">
                            <h4><b> <i class="icon-th-list"></i> Un-accepted Links</b> </h4>
			</div>
			<table class="table table-hover table-striped table-bordered">
                            <thead>
				<tr>
                                    <th>Sr.</th>
                                    <th class="tr_link" width="150px">Link</th>
                                    <th>Pay Per link</th>
                                    <th>Title</th>
                                    <th class="td-actions"> </th>
				</tr>
                            </thead>
                            <?php 
                                $sr=1; 
                                 if($currentPage){
                                    $sr=(int)$this->config->item('record_limit')*$currentPage-((int)$this->config->item('record_limit')-1);
				}
                            ?>
                            <tbody>
                                <?php
                                    foreach($unPublishedUrls as $url)
                                    {
                                    ?>
                                        <tr>
                                            <td><?php echo $sr; ?></td>
                                            <td class="tr_link">
                                                <?php $str=$url['url']; echo wordwrap($str,35,"<br>\n",TRUE); ?>
                                            </td>
                                            <td><?php echo $url['payPerLink']; ?></td>
                                            <td><?php echo $url['title'];?></td>
                                            <td class="td-actions">
                                                <?php 
                                                    if($this->session->userdata("userTypeID")==2)
                                                    {
                                                    ?>
                                                        <a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
							<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/delete/".$url['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <a class="btn btn-success btn-small" href="<?php echo base_url()."link/acceptLink/".$url['id']; ?>"><i class="btn-icon-only icon-check-empty" title="Accept"> </i></a>
                                                    <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
					<?php
                                            $sr++;
					}
                                    ?>
				</tbody>
                            </table>
			</div><!-- /panel -->
                        <div class="panel-footer clearfix">
                            <?php 
                                $count=$unPubUrlCount;
                                $currentPage;
                                $parameters=array();
                                //$parameters[0]="Twitter";
                                ajaxPagination('getUnPublihsedLinks',$parameters,$count,$currentPage); 
                            ?>
                        </div>