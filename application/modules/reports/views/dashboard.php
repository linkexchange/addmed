<link rel="stylesheet" href="<?php echo base_url(); ?>css/datepicker.css">	
<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function(){
		$('#startDate').datepicker({
			format: 'yyyy-mm-dd'
			
		}).on('changeDate', function(ev) {
			 $('.datepicker ').hide();
		});
		$('#endDate').datepicker({
			format: 'yyyy-mm-dd'
		}).on('changeDate', function(ev) {
			 $('.datepicker ').hide();
		});;
	});
</script>
<style>

.input-group-addon {
    background-color: #EEEEEE;
    border: 1px solid #CCCCCC;
    border-radius: 4px;
    color: #555555;
    font-size: 14px;
    font-weight: normal;
    line-height: 1;
    padding: 6px 12px;
    text-align: center;
}
.input-group-addon, .input-group-btn {
    vertical-align: middle;
    white-space: nowrap;
    width: 1%;
}
.glyphicon-calendar:before {
    
}
.input-group.date .input-group-addon span {
    cursor: pointer;
    display: block;
    height: 16px;
    width: 16px;
}
.input-group.date .input-group-addon span {
    cursor: pointer;
    display: block;
    height: 16px;
    width: 16px;
}
.glyphicon {
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    position: relative;
    top: 1px;
}
</style>
<div id="main-container">
    <div class="padding-md">
	<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
            <div class="panel-heading" style="border:1px solid #D6E9F3;background:#fff;">
                <h3>
                    <b><i class="icon-list-alt"></i> View Report</b>
                </h3>
            </div>
	</div> <br/>
	<div class="panel panel-default table-responsive" style="border:1px solid #D6E9F3;">
            <div id="errorMessage" class="alert alert-danger" style="display:none"></div>
            <div id="successMessage" class="alert alert-success" style="display:none">
                <?php echo $this->session->flashdata('message');?></div>
            <div class="panel-body">
                <form class="form-inline no-margin" id="frm_getRecords" action="" method="POST">
                    <div class="form-group">
                        <label>Start Date : </label>
                        <input type="text" class="form-control validate[custom[date]]" placeholder="Start Date" name="startDate" id="startDate" value="<?php if($startDate!=0) echo $startDate; ?>">
                    </div><!-- /form-group -->&nbsp; &nbsp;
                    <div class="form-group">
                    	<label>End Date : </label>
                        <input type="text" class="form-control validate[custom[date]]" placeholder="End Date" name="endDate" id="endDate" value="<?php if($endDate!=0) echo $endDate; ?>">
                    </div><!-- /form-group -->
                    <button id="btn_submit" class="btn btn-sm btn-success" type="submit">Show Records </button> 
		</form>	
            </div>
            <script>
                $(document).ready(function(){
                    $('#frm_getRecords').ajaxForm({
                        beforeSubmit : function(){
                            $("#btn_submit").button('loading');
                            $("#successMessage").hide();
                            $("#errorMessage").hide();
                            if($("#frm_getRecords").validationEngine('validate'))
                            {
                                $("#btn_submit").button('loading');
				var startDate=0;
				var endDate=0;
				if($("#startDate").val())
                                    startDate=$("#startDate").val();
                                if($("#endDate").val())
                                    endDate=$("#endDate").val();
                                window.location=base_url+"reports/dashboard/index/"+startDate+"/"+endDate+"/1";
                                return true;
                            }
                            else
                            {
				$("#btn_submit").button('reset');
				return false;
                            }
			},
                        success :  function(responseText, statusText, xhr, $form){
                            $("#btn_submit").button("reset");
                            //alert(responseText);
                            if(responseText==4)
                            {
				$("#errorMessage").html("End Date is not less than Start Date");
                                //$("#errorMessage").show();
				$("#ajax-reports").html("");
                            }
                            else
                            {
                                $("#ajax-reports").html(responseText);
                                //$("#successMessage").show();
				//window.location=base_url+"transaction/payment";
                            }
			}
                    });
                    $("#frm_signup").validationEngine();
		});
            </script>
            <div class="padding-md clearfix">
                <div id="ajax-reports">
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
				if($this->uri->segment(6)>1 ){
                                    $sr=(int)$this->config->item('record_limit')*$this->uri->segment(6)-((int)$this->config->item('record_limit')-1);
				}
                            ?>
                            <?php $this->load->model("user"); ?>
                            <tbody>	
                                <?php foreach($Urls as $item) : ?>
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
                        <div class="panel-footer clearfix">
                            <?php 
                                $count=$UrlCount;
                                $url=base_url()."reports/dashboard/index/";
                                if($this->uri->segment(6))
                                    $currentPage=$this->uri->segment(6);
                                else
                                    $currentPage=1;
                                if($startDate && $endDate) :
                                    $parameters[0]=$startDate;
                                    $parameters[1]=$endDate; 
                                else :
                                    $parameters[0]=0;
                                    $parameters[1]=0;
                                endif;
                                pagination($url,$parameters,$count,$currentPage);
                            ?>
                        </div>
                    </div>
		</div><!-- /.padding-md -->
            </div>		
	</div>
    </div>	