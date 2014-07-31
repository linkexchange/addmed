<table class="table table-bordered table-striped dataTable">
	<thead>
		<tr>
			<th>Link </th>
			<th>Category Name</th>
			<th>Title</th>
			<?php
			if($this->session->userdata("userTypeID")==3)
			{
			?>
			<th>Bitly Url</th>
			<?php
			}
			?>
			<th>Pay Per link</th>
			<?php
			if($this->session->userdata("userTypeID")==3) : ?>
			<th>Advertiser</th>
			<?php elseif($this->session->userdata("userTypeID")==2) : ?>
			<th>Publisher</th>
			<?php elseif($this->session->userdata("userTypeID")==1) : ?>
			<th>Publisher</th>
			<th>Advertiser</th>
			<?php endif;?>
			<th>Hits</th>
			<th>Total Costing</th>
			<th>Admin Commision <br/>(In %)</th>
			<th class="td-actions"> </th>
		</tr>
	</thead>
	<?php 
		$this->load->model("clicksdetail");
		$this->load->model("user");
		$this->load->model("url");
	?>
	<tbody>
		<?php
		//echo "<pre>"; //print_R($urls); exit;
		foreach($urls as $url)
		{
		?>
		<tr>
			<td><?php echo $url['url'];?></td>
			<td><?php 
					if($url['categoryID']==0)
					{
						echo "No category assigned";
					}
					else
					{
					$cat = $this->url->getcategoryNameById($url['categoryID']);
					echo $cat[0]['category_name'];
					}
				?> 
			</td>
			<td> <?php echo $url['title'];?> </td>
			<?php
			if($this->session->userdata("userTypeID")==3)
			{
			?>
			<td><?php echo $url['bitlyURL']; ?></td>
			<?php
			}
			?>
			<td><?php echo $url['payPerLink']; ?></td>
			<?php if($this->session->userData('userTypeID')==1 || $this->session->userData('userTypeID')==2)  : ?>
				<td>
					<?php $users=$this->user->getPublishersByLinkID($url['id']);
						$userName=""; 
						$i=0;
						foreach($users as $user)
						{
							if($i>0)
								$userName .= ",".$user['userName'];
							else
								$userName .= $user['userName'];
							$i++;
						}
						 echo $userName;
					?>
				</td>
			<?php endif;
			if($this->session->userData('userTypeID')==3):
			?>
				<td>
					<?php if(isset($url['userName'])) echo $url['userName']; ?>
				</td>
			<?
			endif;
			if($this->session->userData('userTypeID')==1) :
				?>
				<td>
					<?php if(isset($url['userName'])) echo $url['userName']; ?>
				</td>
			<?php endif; ?>
			
			<td>
				<?php if($this->session->userData('userTypeID')==3) : ?>
					<?php if($url['userName']) : ?>
						<?php $clicks=$this->clicksdetail->getTotalHitsByLinkId($url['id']); ?>
						<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; else echo "0"; ?>
					<?php endif; ?>
				<?php elseif($this->session->userData('userTypeID')==2) : ?>
					<?php if($url['userName']) : ?>
						<?php $clicks=$this->clicksdetail->getTotalHitsByLinkId($url['id']); ?>
						<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; elseif($url['userName']) echo "0"; ?>
					<?php endif; ?>
				<?php elseif($this->session->userData('userTypeID')==1) : ?>
					<?php if($url['publisherID']!=0) : ?>
						<?php $clicks=$this->clicksdetail->getTotalHitsByLinkId($url['id']); ?>
						<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; else echo "0"; ?>
					<?php endif; ?>
				<?php endif; ?>
			</td>
			<td>
				<?php if($this->session->userData('userTypeID')==3) : ?>
					<?php $payment=$this->clicksdetail->getTotalPublisherPaymentForLinkId($url['id']);?>
					<?php if(isset($payment[0]['publisherPayment']))  echo round($payment[0]['publisherPayment'], 2); else echo "0"; ?>
				<?php elseif($this->session->userData('userTypeID')==2) : ?>
					<?php if($url['userName']) : ?>
						<?php $payment=$this->clicksdetail->getTotalAdvertiserPaymentForLinkId($url['id']);?>
						<?php if(isset($payment[0]['advertiserPaynment']))  echo round($payment[0]['advertiserPaynment'], 2); elseif($url['userName']) echo "0"; ?>
					<?php endif; ?>
				<?php elseif($this->session->userData('userTypeID')==1) : ?>
					<?php if($url['publisherID']!=0) : ?>
						<?php $payment=$this->clicksdetail->getTotalAdvertiserPaymentForLinkId($url['id']);?>
						<?php if(isset($payment[0]['advertiserPaynment']))  echo round($payment[0]['advertiserPaynment'], 2); elseif($url['userName']) echo "0"; ?>
					<?php endif; ?>
				<?php endif; ?>
			</td>
			<td><?php echo $url['percentage']; ?></td>
			<td class="td-actions">
			<?php
			if($this->session->userdata("userTypeID")==2 || $this->session->userdata("userTypeID")==1)
			{
			?>
					<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
					<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/delete/".$url['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
			<?php
			}
			?>
			<!-- <?php
			if($this->session->userdata("userTypeID")==3)
			{
			?>
					<a class="btn btn-small btn-success" href="<?php echo base_url()."link/edit_pub/".$url['id']; ?>" ><i class="btn-icon-only icon-edit"> </i></a>
					<a class="btn btn-danger btn-small" href="<?php echo base_url()."link/delete/".$url['id']; ?>"><i class="btn-icon-only icon-remove"> </i></a>
			<?php
			}
			?> -->
			</td>
		</tr>
		<?php
		}
		?>
		
	</tbody>
</table>
<div class="panel-footer clearfix">
    <?php 
        $count=$url_count;
        $url=base_url()."link/index/";
        if($this->uri->segment(4))
            $currentPage=(int)$this->uri->segment(4);
        else
            $currentPage=1;
        if($cur_cat_ID) :
            $parameters[0]=(int)$cur_cat_ID;
        else :
            $parameters[0]=0;
        endif;
        pagination($url,$parameters,$count,$currentPage);
    ?>  
</div>