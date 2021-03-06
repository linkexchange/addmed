<div id="main-container">
	<div class="padding-md">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
				<h4><b><i class="fa fa-file-text fa-lg"></i> Forum</b>
				<span class="badge badge-info"><?php echo count($topics);?> topics</span>
				<?php if($this->session->userdata('userID')){?>
				<span class="pull-right">
					<a class="btn btn-sm btn-success" href="<?php echo base_url();?>forum/add">
					<i class="fa fa-anchor"></i> Add topic</a>
				</span>
				<?php } ?>
				</h4>
			</div>
		</div> <br/>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<table class="table table-hover table-striped">
						<?php 
							if($topics){  
								if($this->session->userdata('userID'))
								{
								$count = count($topics);
								}
								else 
								{ 
									if(count($topics)<5)
									{
										$count = count($topics);
									}
									else
									{
										$count = 5;
									}		
								}
							for($i=0;$i<$count;$i++) { ?>	
						<tr style="border:1px solid LightGray;">
							<?php $title = url_title($topics[$i]['name'],'dash',TRUE);?>
							<td>
								<span class="badge" style="min-width:50px;height:50px;border:1px solid LightGray;background-color:#EFF5FB;">
									<h4 style="color:green;"><b><?php echo $topics[$i]['no_of_posts'];?></b></h4>
								</span>
								<h5 style="color:green;"><b>replies</b></h5>
							</td>
							<td>
								<!--<img src="<?php echo base_url();?>img/bulb.jpg" height="21" width="21">-->
								<a href="<?php echo base_url();?>forum/<?php echo $title."/".$topics[$i]['id'];?>">
								<b><font size="4" color="#0869BD"><u>
								<?php echo $topics[$i]['name'];?></u></font></b></a><br/>
								<p class="m-top-sm" style="text-align:justify;font-size:12px;">
									<strong>
									<?php 
										$str = strip_tags($topics[$i]['description']);
										echo "&nbsp;&nbsp;".substr($str,0,300)."...";
									?>
									</strong>
								<a href="<?php echo base_url();?>forum/<?php echo $title."/".$topics[$i]['id'];?>"><i class="fa fa-star"></i>[Read more]</a>
								</p>
								<span style="float:right;">
									<strong>
										created by&nbsp;&nbsp;<span class="badge"><b><i class="icon-user"></i> 
										<?php echo $topics[$i]['author'];?></b></span>  |
										on&nbsp;&nbsp;<span class="badge"><b><i class="icon-time"></i> 
										<?php echo date('dS F,Y',strtotime($topics[$i]['created_date']));?></b></span>
									</strong>
								</span>
							</td>
						</tr>
						<?php } }?>
						<tr style="border:1px solid #D6E9F3;">
							<?php if(!$this->session->userdata('userID')){?>
							<td><br/><span class="badge badge-danger">Access</span></td>
							<td>
								<h4 style="font-family:verdana;"><strong>&nbsp;To access the full forum please 
								<a class="btn btn-sm btn-success" href="<?php echo base_url();?>user/login"><i class="fa fa-star"></i> Log in</a> or  
								<a class="btn btn-sm btn-success" href="<?php echo base_url();?>user/login"><i class="fa fa-star"></i> Sign up</a></strong></h4> 
							</td>
							<?php } else { ?>	
							<td colspan="4">
								<?php 
									$url=base_url()."topics/index/";
									if($this->uri->segment(3))
									$currentPage=(int)$this->uri->segment(3);
									else
									$currentPage=1;
									$parameters=array();
									pagination($url,$parameters,$tcount,$currentPage);
								?>     
							</td>
						<?php } ?>	
						</tr>	
					</table>
				</div><!-- /panel -->
			</div><!-- /.col -->
		
		</div><!-- /.row -->
	</div>
</div>	