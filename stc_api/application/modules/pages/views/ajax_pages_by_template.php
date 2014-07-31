<?php //echo "<pre>"; print_r($blogs); echo "</pre>"; ?>
<table class="table table-bordered table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th>Sr. </th>
            <th>Page Title</th>
            <th>Website Name</th>
            <th>Created Date</th>
            <th class="td-actions">Actions</th>
	</tr>
    </thead>
    <tbody>
        <?php 
            //echo $this->uri->segment(4);
            $sr=1;
            if($this->uri->segment(5)>1 ){
                $sr=(int)$this->config->item('record_limit')*$this->uri->segment(5)-((int)$this->config->item('record_limit')-1);
            }
            $this->load->model('article');
        ?>
        <?php  foreach($pages as $item) : ?>
            <tr>
                <td><?php echo $sr; $sr++; ?></td>
                <td><?php echo $item['title']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['createdDate']; ?></td>
                <td>
                    <a class="btn btn-small btn-success" href="<?php echo base_url()."pages/dashboard/edit/".$item['id']; ?>" title="Edit Post : <?php echo $item['title']; ?>">
                        <i class="btn-icon-only icon-edit"> </i>
                    </a>
                    <a class="btn btn-danger btn-small" href="<?php echo base_url()."pages/dashboard/delete/".$item['id']; ?>">
                        <i class="btn-icon-only icon-remove"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="panel-footer clearfix">
    <?php 
        $count;
        $url=base_url()."pages/dashboard/index/";
        if($this->uri->segment(5))
            $currentPage=(int)$this->uri->segment(5);
        else
            $currentPage=1;
        if($tempID)
            $parameters[0]=(int)$tempID;
        else
            $parameters[0]=0;
        pagination($url,$parameters,$count,$currentPage);
    ?>
</div>