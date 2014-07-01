<?php if(isset($hint)) : ?>
	<?php 
		$startIndex=$hint*10+1;
		$endIndex=$startIndex+9;
	?>
	<?php for($i=$startIndex;$i<=$endIndex;$i++) : ?>
		<div id="gallery_item_<?php echo $i; ?>" class="gallery_items" >
			<div class="control-group">		
				<label for="select_<?php echo $i; ?>" class="control-label">Enable Section</label>
				<div class="controls">
					<input type="checkbox" class="checkbox_enable" placeholder="" value="" name="gallery_item_chk_<?php echo $i; ?>" id="gallery_item_chk_<?php echo $i; ?>"   onclick="activateGalleryItem(<?php echo $i; ?>);" /> Gallery Item <?php echo $i; ?>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			<div class="control-group">
				<label for="articleTitle_<?php echo $i; ?>" class="control-label">Gallery Item Title</label>
				<div class="controls">
					<input type="text" class="" placeholder="Gallery Item Title" value="" name="articleTitle_<?php echo $i; ?>" id="articleTitle_<?php echo $i; ?>" onclick="checkGalleryItem(<?php echo $i; ?>)" disabled="true">
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			<div class="control-group">										<label for="articleImage_<?php echo $i; ?>" class="control-label">Gallery Item Image</label>
				<div class="controls">
					<input type="file" class="" name="articleImage_<?php echo $i; ?>" id="articleImage_<?php echo $i; ?>" size="20" disabled="true">
					<p class="help-block">Maximum allwoed image size is 10MB.</p>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			<div class="control-group">		
				<label for="articleDescription_<?php echo $i; ?>" class="control-label">Gallery Item Description</label>
				<div class="controls">
					<textarea name="articleDescription_<?php echo $i; ?>" id="articleDescription_<?php echo $i; ?>" disabled="true"></textarea>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
		</div>
	<?php endfor; ?>
<?php endif; ?>