<?php //echo "<pre>"; print_r($ad); echo "</pre>"; ?>
<?php foreach($ad as $item) : ?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
                	<div class="span12 offset10" style="margin-bottom:15px;"> 
                    	<button onclick="javascript:goto('advertise/dashboard/edit/<?php echo $item['id']; ?>')" class="btn btn-primary btn-large  icon-edit"> Edit Advertise</button>
                    </div><!--span12 offset10-->
                    <div class="widget">
                    	<div class="widget-header"> 
								<i class="icon-list-alt"></i>
								<h3>View Advertises</h3>
						</div>
                    	<div class="widget-content">
                        	<div class="big-stats-container">
                            	<div class="widget-content inner">
                                	<form class="form-horizontal" id="frm_addBlog" action="" method="POST" enctype="multipart/form-data" >
										<fieldset>
                                        	<div class="control-group">
                            					<label for="adUnit1" class="control-label">Ad Unit 1 : </label>
                                                <div class="controls">
                                                    <?php echo $item['adUnit1']; ?>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">
                            					<label for="adUnit2" class="control-label">Ad Unit 2 : </label>
                                                <div class="controls">
                                                    <?php echo $item['adUnit2']; ?>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">
                            					<label for="adUnit3" class="control-label">Ad Unit 3 : </label>
                                                <div class="controls">
                                                    <?php echo $item['adUnit3']; ?>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">
                            					<label for="adUnit4" class="control-label">Ad Unit 4 : </label>
                                                <div class="controls">
                                                    <?php echo $item['adUnit4']; ?>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">
                            					<label for="adUnit5" class="control-label">Ad Unit 5 : </label>
                                                <div class="controls">
                                                    <?php echo $item['adUnit5']; ?>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">
                            					<label for="adUnit6" class="control-label">Ad Unit 16 : </label>
                                                <div class="controls">
                                                    <?php echo $item['adUnit6']; ?>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">
                            					<label for="adMobile1" class="control-label">Ad Mobile 1 : </label>
                                                <div class="controls">
                                                    <?php echo $item['adMobile1']; ?>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                             <div class="control-group">
                            					<label for="adMobile2" class="control-label">Ad Mobile 2 : </label>
                                                <div class="controls">
                                                    <?php echo $item['adMobile2']; ?>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                             <div class="control-group">
                            					<label for="adMobile3" class="control-label">Ad Mobile 3 : </label>
                                                <div class="controls">
                                                    <?php echo $item['adMobile3']; ?>
                                                </div> <!-- /controls -->				
                                            </div> <!-- /control-group -->
                                            <div class="control-group">	
                                                <div class="controls">
                                                    <!--<button id="btn_submit" class="btn btn-primary" type="submit">Save</button> -->
                                                    <a href="<?php echo base_url()?>advertise/dashboard" class="btn">Back to Dashboard</a>												 												</div>
                                            </div> <!-- /control-group -->
                                        </fieldset>
                                    </form>
                                </div><!--widget-content inner-->
                           	</div><!--big-stats-container-->
                       	</div><!--widget-content-->
                   	</div><!--widget-->
                </div><!--span12-->
            </div><!--row-->
       	</div><!--container-->
   	</div><!--main-inner-->
</div><!--main-->
<?php endforeach; ?>