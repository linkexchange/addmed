                        <div class="panel panel-default" style="margin-right:-16px;">
                            <div class="panel-heading" style="border:1px solid lightgray;">
				<h4> <b> <i class="icon-th-list"></i> Accepted Links</b> </h4>
                            </div>
                            <table class="table table-hover table-striped table-bordered">
				<thead>
                                    <tr>
                                        <th>Sr.</th>                                        
					<th class="link">Link </th>
					<th>Pay Per link</th>
					<th>Title</th>
					<th>
                                            <?php
						if($this->session->userdata("userTypeID")==2)
                                            	{
                                                    echo "Publisher";
						}
						else if($this->session->userdata("userTypeID")==3)
						{
                                                    echo "Advertiser";
						}
						?>
                                        </th>
					<th>Hits</th>
					<th>Total Costing</th>
					<th class="td-actions"> </th>
                                    </tr>
				</thead>
                                <?php 
                                    $sr=1;
                                    if($currentPage){
                                        $sr=(int)$this->config->item('record_limit')*$currentPage-((int)$this->config->item('record_limit')-1);
                                    }
                                ?>
				<?php $this->load->model("clicksdetail"); ?>
				<tbody>
                                    <?php
					foreach($publishedUrls as $url)
					{
					?>
					<tr>
                                            <td><?php echo $sr; ?></td>
                                            <td>
                                                <?php $str=$url['url']; echo wordwrap($str,30,"<br>\n",TRUE); ?>
                                            </td>
                                            <td><?php echo $url['payPerLink']; ?></td>
                                            <td><?php echo $url['title']; ?></td>
                                            <td><?php $this->load->model("user");
                                                if($this->session->userdata("userTypeID")==2)
						{
                                                    $users=$this->user->getPublishersByLinkID($url['id']);
                                                    $userName=""; 
                                                    $i=0;
                                                    foreach($users as $user)
                                                    {
							if($i>0)
                                                            $userName .= ',<br/>'.$user['userName'];
							else
                                                            $userName .= $user['userName'];
                                                            $i++;
							}
							echo $userName; 
                                                    }
						else if($this->session->userdata("userTypeID")==3)
						{
                                                    $users=$this->user->getUserByID($url['advertiserID']);
                                                    echo $users[0]['userName'];
						}
                                                ?>
                                            </td>			
                                            <td>
                                                <?php $clicks=$this->clicksdetail->getTotalHitsByLinkId($url['id']); ?>
						<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; else echo "0"; ?>
                                            </td>
                                            <td>
						<?php if($this->session->userData('userTypeID')==3) : ?>
                                                    <?php $payment=$this->clicksdetail->getTotalPublisherPaymentForLinkId($url['id']);?>
                                                    <?php if(isset($payment[0]['publisherPayment']))  echo round($payment[0]['publisherPayment'], 2); else echo "0"; ?>
						<?php elseif($this->session->userData('userTypeID')==2) : ?>
                                                    <?php $payment=$this->clicksdetail->getTotalAdvertiserPaymentForLinkId($url['id']);?>
                                                    <?php if(isset($payment[0]['advertiserPaynment']))  echo round($payment[0]['advertiserPaynment'], 2); else echo "0"; ?>
						<?php endif; ?>
                                            </td>
                                            <td class="td-actions">
                                                <?php
                                                    if($this->session->userdata("userTypeID")==2)
                                                    {
                                                    ?>
                                                    	<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
                                                    <?php
                                                    }
                                                    elseif($this->session->userdata("userTypeID")==3 ){
							if(!($url['bitlyURL'])){
							?>
                                                            <a class="btn btn-success btn-small" href="<?php echo base_url()."link/edit_pub/".$url['publishedID']; ?>"><i class="icon-anchor btn-icon-only" title="Add Bitly URL"> </i></a>
                                                            <a class="btn btn-danger btn-small" href="<?php echo base_url()."link/pubremove/".$url['publishedID']; ?>"><i class="btn-icon-only icon-remove" title="Remove"> </i></a>
							<?php 
							}
							else
							{
							?>
                                                            <a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit_pub/".$url['publishedID']; ?>" ><i class="btn-icon-only icon-edit" title="Edit Bitly Link"> </i></a>
                                                            <a class="btn btn-danger btn-small" href="<?php echo base_url()."link/pubremove/".$url['publishedID']; ?>"><i class="btn-icon-only icon-remove" title="Remove"> </i></a>
							<?php 
							}
                                                    }
						?>
                                            </td>
					</tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /panel -->
                    <div class="panel-footer clearfix">
                        <?php 
                            $count=$pubUrlCount;
                            $currentPage;
                            $parameters=array();
                            ajaxPagination('getPublihsedLinks',$parameters,$count,$currentPage); 
                        ?>
                    </div>