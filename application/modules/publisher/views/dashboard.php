<div id="main-container">
    <div class="padding-md">
        <div class="panel panel-default table-responsive">
            <div class="panel-heading">
		<h3><b><i class="icon-list-alt"></i> Publisher Stats</b></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
			<div class="panel-stat3 bg-danger">
                            <h2 class="m-top-none" id="userCount"><?php echo $url_count; ?></h2>
                            <h5>Accepted Links</h5>
                            <div class="stat-icon">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <div class="refresh-button">
				<i class="fa fa-refresh"></i>
                            </div>
                            <div class="loading-overlay">
				<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
                            </div>
			</div>
                    </div><!-- /.col -->
                    <div class="col-sm-6 col-md-3">
			<div class="panel-stat3 bg-primary">
                            <h2 class="m-top-none"><?php if(isset($totalHits[0]['numberOfClicks']) ) echo $totalHits[0]['numberOfClicks']; else echo "0"; ?></h2>
                            <h5>Total Hits</h5>
                            <div class="stat-icon">
				<i class="fa fa-hdd-o fa-3x"></i>
                            </div>
                            <div class="refresh-button">
                            	<i class="fa fa-refresh"></i>
                            </div>
                            <div class="loading-overlay">
				<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
                            </div>
			</div>
                    </div><!-- /.col -->
                    <div class="col-sm-6 col-md-3">
			<div class="panel-stat3 bg-warning">
                            <h2 class="m-top-none" id="orderCount"><?php if(isset($totalPaidPayment[0]['paidAmount'])) echo $totalPaidPayment[0]['paidAmount']; else echo "0"; ?></h2>
                            <h5>Paid Amount</h5>
                            <div class="stat-icon">
                                <i class="fa fa-shopping-cart fa-3x"></i>
                            </div>
                            <div class="refresh-button">
				<i class="fa fa-refresh"></i>
                            </div>
                            <div class="loading-overlay">
				<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
                            </div>
			</div>
                    </div><!-- /.col -->
                    <div class="col-sm-6 col-md-3">
                        <div class="panel-stat3 bg-success">
                            <h2 class="m-top-none" id="visitorCount"><?php if(isset($TotalRamainingPayment)) echo $TotalRamainingPayment; else echo "0"; ?></h2>
                            <h5>Remaining Amount</h5>
                            <div class="stat-icon">
				<i class="fa fa-bar-chart-o fa-3x"></i>
                            </div>
                            <div class="refresh-button">
				<i class="fa fa-refresh"></i>
                            </div>
                            <div class="loading-overlay">
				<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
                            </div>
			</div>
                    </div><!-- /.col -->
		</div>	
                <div class="col-md-5" id="un-publihsed-links">
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
                            <?php $sr=1; ?>
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
                                $currentPage=1;
                                $parameters=array();
                                //$parameters[0]="Twitter";
                                ajaxPagination('getUnPublihsedLinks',$parameters,$count,$currentPage); 
                            ?>
                        </div>
                    </div>
                <div class="col-md-7" id="publihsed-links">
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
                                <?php $sr=1; ?>
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
                                    <?php $sr++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /panel -->
                    <div class="panel-footer clearfix">
                        <?php 
                            $count=$pubUrlCount;
                            $currentPage=1;
                            $parameters=array();
                            ajaxPagination('getPublihsedLinks',$parameters,$count,$currentPage); 
                        ?>
                    </div>
		</div>
            </div>
	</div>		
    </div>
</div>	
<script>
    function getUnPublihsedLinks(page){
        $.ajax({
            url:"<?php echo base_url(); ?>publisher/dashboard/getUnpublishedurls/"+page,
                //beforeSend: loadStartPub,
		//complete: loadStopPub,
            success:function(result){
            	//alert(result);
                $('#un-publihsed-links').html(result);
              
         }});
            //pageactive(pid);
    }
    function getPublihsedLinks(page){
        $.ajax({
            url:"<?php echo base_url(); ?>publisher/dashboard/getPublisherUrls/"+page,
                //beforeSend: loadStartPub,
		//complete: loadStopPub,
            success:function(result){
            	//alert(result);
                $('#publihsed-links').html(result);
              
         }});
            //pageactive(pid);
    }
</script>