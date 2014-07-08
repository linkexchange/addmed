<li class="<?php if(!$pos[$titleIndex]) : ?>active <?php endif; ?>"><a href="<?php echo $siteUrl; ?>" title="Homepage" >Homepage</a></li>
<?php if(!$error) : ?>
	<?php if($api_response->havePages=="True" && isset($pages)) : ?>
		<?php foreach($pages as $page) : ?>
			<li class="<?php if(isset($pos[$pidIndex]) && $page->pageID==$pos[$pidIndex]) : ?>active<?php endif; ?>"><a href="<?php echo $siteUrl; ?>/<?php echo $page->pageSlug; ?>/<?php echo $page->pageID; ?>" title="Homepage" ><?php echo $page->pageTitle; ?></a></li>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>