<div id="main-container">
<div class="padding-md">
<div class="row">
<div class="col-md-12">

<div class="panel panel-default">
<div class="panel-heading">
	<h3><b><i class="icon-th-list"></i> View Report of publishers</b></h3>
</div>
<div id="errorMessage" class="alert alert-danger" style="display:none"></div>
<div id="successMessage" class="alert alert-success" style="display:none"></div>
<table class="table table-striped table-bordered user-transactions">
<thead>
	<tr>
		<th>Sr.</th>							
		<th>Publisher Name</th>
		<th>Published Links</th>
		<th>Total Hits</th>
		<th>Paid Amount</th>
		<th>Remaining Amount</th>
		<th>Total Amount</th>
	</tr>
	<?php 
		//echo $this->uri->segment(4);
		$sr=1;
		if($this->uri->segment(4)>1 ){
			$sr=10*$this->uri->segment(4)-9;
		}
	?>
	<?php $this->load->model("clicksdetail"); ?>
	<?php $this->load->model("url"); ?>
	<?php foreach($Users as $item) : ?>
	<tr>
		<td><?php echo $sr; ?></td>
		<td><?php echo $item['userName']?></td>
		<td>
			
			<?php $urls=$this->url->getAllPublisherUrlCount($item['userID']); ?>
			<?php if($urls) echo $urls; else echo "0"; ?>
		</td>
		<td>
			<?php $clicks=$this->clicksdetail->getTotalHits($item['userID']); ?>
			<?php if(isset($clicks[0]['numberOfClicks'])) echo $clicks[0]['numberOfClicks']; else echo "0"; ?>
		</td>
		<td><?php echo $item['paidAmount']?></td>
		<td><?php echo $item['balanceAmount']?></td>
		<td><?php echo $item['billableAmount']?></td>
	</tr>
	<?php $sr++; ?>
	<?php endforeach; ?>
</thead>
</table>
</div><!-- /panel -->
</div><!-- /.col -->
</div><!-- /.row -->


</div><!-- /.padding-md -->
</div>	