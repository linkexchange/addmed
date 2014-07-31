<div class="form-group">
	&nbsp; &nbsp;&nbsp; &nbsp;
	<label><h4>Select Post : </h4></label>
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
</div><!-- /form-group -->
