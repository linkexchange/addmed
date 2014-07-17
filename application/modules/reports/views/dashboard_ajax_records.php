<table class="table table-bordered table-striped dataTable">
	<thead>
		<tr>
			<th>Sr.</th>							
			<th>Link</th>
			<?php if($this->session->userData('userTypeID')==3) : ?> 
			<th>Advertiser</th>
			<?php elseif($this->session->userData('userTypeID')==2) : ?>
			<th>Publisher</th>
			<?php elseif($this->session->userData('userTypeID')==1) : ?>
			<th>Advertiser</th>
			<th>Publisher</th>
			<?php endif; ?>
			<th>Pay Per Link</th>
			<th>Bitly URL</th>
			<th>Admin Commision <br/>(In %)</th>
			<th>Hits</th>
			<?php if($this->session->userData('userTypeID')==1) : ?>
			<th>Advertiser Amount</th>
			<th>Publisher Amount</th>
			<?php else : ?>
			<th>Hit Amount</th>
			<?php endif; ?>
			<?php if($this->session->userData('userTypeID')==1) : ?>
			<th>Admin Commision</th>
			<?php endif; ?>
			<th>Date</th>
		</tr>
	</thead>	
		<?php 
			//echo $this->uri->segment(4);
			$sr=1;
			if($this->uri->segment(4)>1 ){
				$sr=10*$this->uri->segment(4)-9;
			}
		?>
		<?php $this->load->model("user"); ?>
	
		<?php foreach($Urls as $item) : ?>
	<tbody>	
		<tr>
			<td><?php echo $sr; ?></td>							
			<td><?php echo $item['url']; ?></td>
			<td><?php echo $item['userName']; ?></td>
			<?php if($this->session->userData('userTypeID')==1) : ?>
				<td>
					<?php $user=$this->user->getUserByID($item['publisherID']); ?>
					<?php if(isset($user[0]['userName'])) echo $user[0]['userName']; ?>
				</td>
			<?php endif; ?>
			<td><?php echo $item['payPerLink']; ?></td>
			<td><?php echo $item['bitlyURL']; ?></td>
			<td><?php echo $item['percentage']; ?></td>
			
			<td><?php echo $item['numberOfClicks']; ?></td>
			<?php if($this->session->userData('userTypeID')==3) : ?> 
			<td><?php echo $item['publisherPayment']; ?></td>
			<?php elseif($this->session->userData('userTypeID')==2) : ?>
			<td><?php echo $item['advertiserPaynment']; ?></td>
			<?php elseif($this->session->userData('userTypeID')==1) : ?>
			<td><?php echo $item['advertiserPaynment']; ?></td>
			<td><?php echo $item['publisherPayment']; ?></td>
			<td><?php echo $item['commission']; ?></td>
			<?php endif; ?>
			
			<td><?php echo $item['createdDate']; ?></td>
		</tr>
		<?php $sr++; ?>
	<?php endforeach; ?>
	</tbody>
</table>