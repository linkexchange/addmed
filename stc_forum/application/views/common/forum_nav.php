
<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
				<li class="<?php if(($this->uri->segment('2')=="forum")) : echo "active"; endif; ?> dropdown subnavbar-open-right" id="dashboard" >
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-shield"></i>
                        <span>Forum</span> 
                    </a>
					<ul class="dropdown-menu">
						<?php if($this->session->userdata("ForumUserID")){ ?>
						<li><a href="<?php echo base_url().'forum_articles/forum/add'; ?>">Add topic</a></li>
                    	<?php }?>
						<li><a href="<?php echo base_url().'forum_articles/forum'; ?>">View topics</a></li>
                    </ul>
                	<!--<a href="<?php //echo base_url().'forum_articles/forum'; ?>"></a>-->
                </li>
				<li class="<?php if(($this->uri->segment('2')=="listing")&&($this->uri->segment('3')!="show_bookmarks")) : echo "active"; endif; ?> dropdown subnavbar-open-right" id="dashboard" >
                	<a href="<?php echo base_url().'forum_articles/listing'; ?>">
                    	<i class="icon-tasks"></i>
                        <span>Articles</span> 
                    </a>
                </li>
				<?php if($this->session->userdata('ForumUserID')){?>
				<li class="<?php if($this->uri->segment('3')=="show_bookmarks") : echo "active"; endif; ?> dropdown subnavbar-open-right" id="blocks" >
                	<a href="<?php echo base_url().'forum_articles/listing/show_bookmarks'; ?>">
                    	<i class="icon-star"></i>
                        <span>Show Bookmarks</span> 
                    </a>
                </li>
				<?php } ?>
            </ul>
		</div>
	<!-- /container --> 
	</div>
<!-- /subnavbar-inner --> 
</div>