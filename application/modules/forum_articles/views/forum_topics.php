<div id="main-container" style="background:#E0F2F7;">
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin"><b>Welcome to Social traffic center</b></h3>
		</div><!-- /page-title -->
	</div>	
<div class="panel panel-default table-responsive">
		<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
			<div id="dataTable_length" class="dataTables_length">
				<h4>&nbsp;<i class="fa fa-list-alt fa-lg"></i> Forum topics</h4>
			</div>
			<div class="dataTables_filter" id="dataTable_filter">
			<?php if($this->session->userdata("ForumUserID")){?>
			<label> 
				<div class="input-group pull-right" style="width:200px;">
					<button onclick="javascript:goto('forum_articles/forum/add')" class="btn btn-primary btn-large  icon-anchor"> Add Topic</button>
				</div>
			</label>
			<?php } ?>
			</div>
		</div>
			<table class="table table-bordered table-condensed table-hover table-striped" >
						<thead>
							<tr>
								<th>Sr.No.</th>
								<th>Topic</th>
								<th>Author</th>
								<th>Replies</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>	
							<?php 
							if($topics){  
								  if($this->session->userdata('ForumUserID'))
								  {
									$count = count($topics);
								  }
								  else 
								  { 
									$count = 5;
								  }
								 
								$sr=1;
								if($this->uri->segment(2)>1 ){
									$sr=10*$this->uri->segment(2)-9;
								}
							for($i=0;$i<$count;$i++) {?>
							<tr>	
								<td><?php echo $sr; $sr++; ?></td>
								<td>
									<?php echo $topics[$i]['name'];?>
								</td>
								<td>
									<?php echo $topics[$i]['author'];?>
								</td>
								<td>
									<?php echo $topics[$i]['no_of_posts'];?>
								</td>
								<td>
									<?php $title = url_title($topics[$i]['name'],'dash',TRUE);?>
									<a href="<?php echo base_url();?>forum/<?php echo $title."/".$topics[$i]['id'];?>">
									View</a>
								</td>	
							</tr>
							<?php } }?>
						</tbody>
					</table>
					<?php 
					if($this->session->userdata("ForumUserID")){
						if($tcount>10) : ?>
					<div class="widget-header navigation" style="text-align:right;">
						<ul class="pagination pagination-split m-bottom-md">
						<?php 
							$mod=10; $inc=1;
							if($tcount>$mod) :
								echo " <li><a>Pages:</a></li>";
								for($i=0;$i<=$tcount;$i++) :
									if(($i%$mod)==0) :
										//echo $inc; ?>
										<li class="<?php if($inc==$this->uri->segment(2))  echo "active"; else if(!($this->uri->segment(2)) && $inc==1)  echo "active"; ?>">
										<a href="<?php echo base_url()."topics/".$inc; ?>">
										<?php echo $inc;?></a></li>
										<?php
										$inc++;
									endif;
								endfor;
							endif;
						?> &nbsp;
						</ul>
					</div><!-- widget-header pagination -->
					<?php endif; } ?>
					<?php if(!$this->session->userdata('ForumUserID')){?>
					<h4>&nbsp;To access the full forum please 
					<a href="#">Log in </a>or 
					<a href="#">Sign up</a></h4> 
					<?php } ?>