<h2 class="nospace font-medium push20">Random Posts</h2>
<ul class="categories">
	<?php $m=1; ?>
	<?php if($api_response->havePosts!="False") : ?>
		<?php $postCount=count($posts);	?>
		<?php if($postCount>3) : ?>
			<?php $rand_keys = array_rand($posts, 4); ?>
			<?php for($i=0; $i<4; $i++) : ?>
				<li class="<?php if($m%2) echo "first"; ?>">
						<a href="<?php echo $siteUrl; ?>/<?php if(isset($posts[$rand_keys[$i]]->postID)) echo $posts[$rand_keys[$i]]->postSlug; ?>/<?php if(isset($website->id)) echo $website->id; ?>/<?php if(isset($posts[$rand_keys[$i]]->postID)) echo $posts[$rand_keys[$i]]->postID; ?>">
							<img src="<?php echo $posts[$rand_keys[$i]]->postImage;?>"/>
							<div class = "bx-caption"> 
								<span><?php echo $posts[$rand_keys[$i]]->postTitle;?></span>
							</div>
						</a>
				</li>
				<?php $m++; ?>
			<?php endfor; ?>
		<?php else : ?>
			<?php foreach($posts as $post) : ?>
				<li class="<?php if($m%2) echo "first"; ?>">
						<a href="<?php echo $siteUrl; ?>/<?php if(isset($post->postID)) echo $post->postSlug; ?>/<?php if(isset($website->id)) echo $website->id; ?>/<?php if(isset($post->postID)) echo $post->postID; ?>">
							<img src="<?php echo $post->postImage;?>"/>
							<div class = "bx-caption"> 
								<span><?php echo $post->postTitle;?></span>
							</div>
						</a>
				</li>
				<?php $m++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>
</ul>
