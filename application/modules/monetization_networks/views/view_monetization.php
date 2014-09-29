<script src="<?php echo base_url();?>js/jquery.circliful.min.js"></script>
<link href="<?php echo base_url();?>css/jquery.circliful.css" rel="stylesheet" type="text/css" />
<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h4><b><i class="icon-globe"></i> Monetization Networks</b></h4>
			</div>
		</div> <br/>
		
		<div class="padding-md clearfix">
			<div class="panel panel-default table-responsive">
				<div class="panel-heading">
					Data Table
					<span class="label label-info pull-right"><?php echo $count;?> records</span>
				</div>
				<div class="padding-md clearfix">
					<table class="table table-striped table-bordered" id="dataTable">
				<thead>
					<tr>
						<th>Website</th>
						<th>Overall Ratings</th>
						<th>Ease of Use</th>
						<th>Contents</th>
						<th>Payouts</th>
						<th>Support</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
						<?php 
						//echo "<pre>"; print_r($monetization); exit; 
						//echo $this->uri->segment(4);
							$sr=1; $j=1;
							if($this->uri->segment(3)>1 ){
								$sr=(int)$this->config->item('record_limit')*$this->uri->segment(3)-((int)$this->config->item('record_limit')-1);
							}
						?>
						<?php  foreach($monetization as $monet) : ?>
						<tr>
							<td><?php if($monet['website_logo']) { ?>
								<a href="<?php echo $monet['website_url'];?>">
								<img src="<?php echo base_url();?>uploads/website_logo/<?php echo $monet['website_logo'];?>" style="width: 229px;height: 192px;">
								</a>
								<?php } else {?>
								<h4 style="color:red;">Not mentioned</h4>
								<?php } ?>
							</td>
							<td>
							<?php   
							if($monet['article_ratings'])
							{
							if($monet['article_ratings']==0) 
							{
								$fgcolor = "#FE2E2E";
								$bgcolor = "#FE2E2E";
							}
							else if(($monet['article_ratings']<=30)&&($monet['article_ratings']>0))  {
								$fgcolor = "#FE2E2E";
								$bgcolor = "#eee";
							}
							else if($monet['article_ratings']<=60)  {
								$fgcolor = "#FFFF00";
								$bgcolor = "#eee";
							}
							else if($monet['article_ratings']<=80)  {
								$fgcolor = "#90C844";
								$bgcolor = "#eee";
							}
							else if($monet['article_ratings']>80)  {
								$fgcolor = "#2EFE64";
								$bgcolor = "#eee";
							}		
							?>
							<div id="myStat_<?php echo $j;?>" data-dimension="190" data-text="<?php echo $monet['article_ratings'];?>%" data-info="New Clients" data-width="8" data-fontsize="30" data-percent="<?php echo $monet['article_ratings'];?>" data-fgcolor="<?php echo $fgcolor;?>" data-bgcolor="<?php echo $bgcolor;?>"></div>
							<?php } else { ?>
							<h4 style="color:red;">
								Not Mentioned
							</h4>
							<?php } ?>
							</td>	
							<td>
							<?php if($monet["dashboard"]){ 
									if($monet["dashboard"]<30){ ?>	
										<h3 style="color:red;"><?php echo $monet["dashboard"];?>%</h3>
										<h6 style="color:red;"> Very Poor</h6> 
									<?php } else if($monet["dashboard"]<50){?>	
										<h3 style="color:red;"><?php echo $monet["dashboard"];?>%</h3>
										<h6 style="color:red;"> Not good</h6> 
									<?php } else if($monet["dashboard"]<=70){?>
										<h3 style="color:green;"><?php echo $monet["dashboard"];?>%</h3>
										<h6 style="color:green;"> Average</h6> 
									<?php } else if($monet["dashboard"]<100){?>	
										<h3 style="color:green;"><?php echo $monet["dashboard"];?>%</h3>
										<h6 style="color:green;"> Good</h6> 
									<?php } else if($monet["dashboard"]==100){?>	
										<h3 style="color:green;"><?php echo $monet["dashboard"];?>%</h3>
										<h6 style="color:green;"> Top of the class</h6> 
									<?php } ?>
							<?php } else { ?>
									<h4 style="color:red; padding:5px;">Not mentioned</h4>
							<?php } ?>
							</td>
							<td>
								<?php if($monet["ratings"]){ 
								if($monet["ratings"]<30){ ?>
									<h3 style="color:red;"><?php echo $monet["ratings"]; ?>%</h3>
									<h6 style=";color:red;"> Very Poor</h6> 
								<?php } else if($monet["ratings"]<=50){?>	
									<h3 style="color:red;"><?php echo $monet["ratings"]; ?>%</h3>
									<h6 style=";color:red;"> Not good</h6> 
								<?php } else if($monet["ratings"]<=70){?>
									<h3 style="color:green;"><?php echo $monet["ratings"]; ?>%</h3>
									<h6 style=";color:green;"> Average</h6> 
								<?php } else if($monet["ratings"]<100){?>	
									<h3 style="color:green;"><?php echo $monet["ratings"]; ?>%</h3>
									<h6 style=";color:green;"> Good</h6> 
								<?php } else if($monet["ratings"]==100){?>
									<h3 style="color:green;"><?php echo $monet["ratings"]; ?>%</h3>
									<h6 style=";color:green;"> Top of the class</h6> 
								<?php } ?>
								<?php } else { ?>
									<h4 style="color:red; padding:5px;">Not mentioned</h4>
								<?php } ?> 
							</td>
							<td>
								<?php if($monet["payout_ratings"]){ 
									if($monet["payout_ratings"]<30){ ?>
										<h3 style="color:red;"><?php echo $monet["payout_ratings"]; ?>%</h3>
										<h6 style=";color:red;"> Very Poor</h6> 
									<?php } else if($monet["payout_ratings"]<=50){?>	
										<h3 style="color:red;"><?php echo $monet["payout_ratings"]; ?>%</h3>
										<h6 style=";color:red;"> Not good</h6> 
									<?php } else if($monet["payout_ratings"]<=70){?>
										<h3 style="color:green;"><?php echo $monet["payout_ratings"]; ?>%</h3>
										<h6 style=";color:green;"> Average</h6> 
									<?php } else if($monet["payout_ratings"]<100){?>	
										<h3 style="color:green;"><?php echo $monet["payout_ratings"]; ?>%</h3>
										<h6 style=";color:green;"> Good</h6> 
									<?php } else if($monet["payout_ratings"]==100){?>
										<h3 style="color:green;"><?php echo $monet["payout_ratings"]; ?>%</h3>
										<h6 style=";color:green;"> Top of the class</h6> 
									<?php } ?>
									<?php } else { ?>
										<h4 style="color:red; padding:5px;">Not mentioned</h4>
									<?php } ?>
							</td>
							<td>
								<?php if($monet["support_ratings"]){ 
									if($monet["support_ratings"]<30){ ?>
										<h3 style="color:red;"><?php echo $monet["support_ratings"]; ?>%</h3>
										<h6 style=";color:red;"> Very Poor</h6> 
									<?php } else if($monet["support_ratings"]<=50){?>	
										<h3 style="color:red;"><?php echo $monet["support_ratings"]; ?>%</h3>
										<h6 style=";color:red;"> Not good</h6> 
									<?php } else if($monet["support_ratings"]<=70){?>
										<h3 style="color:green;"><?php echo $monet["support_ratings"]; ?>%</h3>
										<h6 style=";color:green;"> Average</h6> 
									<?php } else if($monet["support_ratings"]<100){?>	
										<h3 style="color:green;"><?php echo $monet["support_ratings"]; ?>%</h3>
										<h6 style=";color:green;"> Good</h6> 
									<?php } else if($monet["support_ratings"]==100){?>
										<h3 style="color:green;"><?php echo $monet["support_ratings"]; ?>%</h3>
										<h6 style=";color:green;"> Top of the class</h6> 
									<?php } ?>
									<?php } else { ?>
										<h4 style="color:red; padding:5px;">Not mentioned</h4>
									<?php } ?>
							</td>
							<td style="text-align:center;">
								 <?php 
								 $art = url_title($monet['topic'],'underscore',TRUE);?>
								 <a href="<?php echo base_url().'article/'.$art.'/'.$monet['id']?>">
									<b style="font-family:verdana; font-size:12pt;">Take a closer look</b>
									<img src="<?php echo base_url();?>img/plus.jpg" height="30" width="30">
								</a>
							</td>
						</tr>
						<?php $j++; $sr++; endforeach; ?>
				</tbody>
			</table>
			<?php 
				$url=base_url()."monetization_networks/index/";
				if($this->uri->segment(3))
				$currentPage=(int)$this->uri->segment(3);
				else
				$currentPage=1;
				$parameters=array();
				pagination($url,$parameters,$count,$currentPage);
			?>	
			</div><!-- /.padding-md -->
			</div><!-- /panel -->
			
		</div>
		</div>		
	</div>
<script>
$( document ).ready(function() {
<?php 	
	for($i=1;$i<=count($monetization);$i++)
	{
?>	
	$('#myStathalf2').circliful();
	//alert("Hi");
	$('#myStat_<?php echo $i;?>').circliful();
<?php	
	}
?>	
});
</script>	
