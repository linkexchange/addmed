<?php //echo "<pre>"; print_r($blogs); echo "</pre>"; ?>
<div class="control-group">
	<label for="blog" class="control-label">Select Post</label>
    <div class="controls">
       	<select id="blogID" name="blogID" class="validate[required]" onchange="getDetails(this.value);">
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
  	</div> <!-- /controls -->				
</div> <!-- /control-group -->