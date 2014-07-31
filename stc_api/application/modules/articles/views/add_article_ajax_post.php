
<div class="form-group">
	<label for="Select Post" class="col-lg-2 control-label">Select Post</label>
	<div class="col-lg-10">
		<select id="blogID" name="blogID" class="form-control validate[required]" onchange="getDetails(this.value);">
		<option value="">Please Select</option>
		<?php foreach($blogs as $blog) : ?>
			<?php if(isset($cur_blog_id)) : ?>
				<?php if($blog['id']==$cur_blog_id) : ?>
					<option value="<?php echo $blog['id']; ?>" selected="selectted"><?php echo $blog['title']; ?></option>
				<?php else : ?>
					<option value="<?php echo $blog['id']; ?>"><?php echo $blog['title']; ?></option>
				<?php endif; ?>
			<?php else : ?>
				<option value="<?php echo $blog['id']; ?>"><?php echo $blog['title']; ?></option>
			<?php endif; ?>
			
		<?php endforeach; ?>
	</select>
	</div><!-- /.col -->
</div><!-- /form-group -->