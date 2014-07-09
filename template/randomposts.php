<h2 class="nospace font-medium push20">Random Posts</h2>
<ul class="categories">
	<?php $m=1; ?>
	<?php if($api_response->havePosts!="False") : ?>
		<?php $postCount=count($posts);	?>
		<?php if($postCount>3) : ?>
			<?php $rand_keys = array_rand($posts, 4); ?>
			<?php for($i=0; $i<4; $i++) : ?>
				<li class="<?php if($m%2) echo "first"; ?>">
						<?php $strTitle=array(); ?>
						<a href="<?php echo $siteUrl; ?>/<?php if(isset($posts[$rand_keys[$i]]->postID)) echo $posts[$rand_keys[$i]]->postSlug; ?>/<?php if(isset($website->id)) echo $website->id; ?>/<?php if(isset($posts[$rand_keys[$i]]->postID)) echo $posts[$rand_keys[$i]]->postID; ?>">
							<img src="<?php echo $posts[$rand_keys[$i]]->postImage;?>"/>
							<?php 
								$strLength=strlen($posts[$rand_keys[$i]]->postTitle);
								$strTitle = str_split($posts[$rand_keys[$i]]->postTitle, 46);

							?>
							<div class = "<?php if($strLength<37) echo "bx-caption"; else  echo "bx-caption-large"; ?>"> 
								<span><?php echo $strTitle[0]; ?><?php if($strLength>46) : echo "..."; endif; ?></span>
							</div>
						</a>
				</li>
				<?php $m++; ?>
			<?php endfor; ?>
		<?php else : ?>
			<?php foreach($posts as $post) : ?>
				<li class="<?php if($m%2) echo "first"; ?>">
						<?php $strTitle=array(); ?>
						<a href="<?php echo $siteUrl; ?>/<?php if(isset($post->postID)) echo $post->postSlug; ?>/<?php if(isset($website->id)) echo $website->id; ?>/<?php if(isset($post->postID)) echo $post->postID; ?>">
							<img src="<?php echo $post->postImage;?>"/>
							<?php 
								$strLength=strlen($post->postTitle);
								$strTitle = str_split($post->postTitle, 46);
							?>
							<div class = "<?php if($strLength<37) echo "bx-caption"; else  echo "bx-caption-large"; ?>"> 
								<span><?php echo $strTitle[0]; ?><?php if($strLength>46) : echo "..."; endif; ?></span>
							</div>
						</a>
				</li>
				<?php $m++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>
</ul>
