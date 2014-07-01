<?php 
class Websitedetails extends MX_Controller{
	// return website and its posts details from secrete key.
	public function website(){
		$this->load->model('api');
		$json_array=array();
		if(isset($_GET['key']) && $_GET['key']!=NULL){
			$key=$_GET['key'];
			$json_array=$this->getWebiteAndPostsDetails($key);
		}
		else{
			$json_array['error']="Unauthorised Key";
		}
		$output = json_encode($json_array);
		echo $output;
	}

	public function getWebiteAndPostsDetails($key){
		$this->load->model('api');
		$json_array=array();
		if($this->api->isValidKey($key)){
				$templateID=$this->api->getTemplateIDByKey($key);
				foreach($templateID as $temp){
					$json_array['website']['id']=$temp['id'];
					$json_array['website']['name']=$temp['name'];
					$json_array['website']['lastUpdated']=$temp['updatedDate'];
				}
				$tempID=$json_array['website']['id'];
				$hasPosts=$this->api->hasPosts($tempID);
				if($hasPosts){
					$json_array['havePosts']="True";
					$blogs=$this->api->getTemplateBlogs($tempID);
					$posts=array();
					$index=0;
					$blogsCount=sizeof($blogs);
					if($blogsCount){
						foreach($blogs as $item){
							$posts[$index]['postID']=$item['id'];
							$posts[$index]['postTitle']=$item['title'];
							$posts[$index]['postImage']=BLOG_IMAGE_PATH."".$item['image'];
							$posts[$index]['postDescription']=$item['description'];
							$posts[$index]['postSlug']=$item['blogSlug'];

							$index++;
						}
						$json_array['posts']=$posts;
					}
				}
				else
				{
					$json_array['havePosts']="False";
				}
				$hasPages=$this->api->hasPages($tempID);
				if($hasPages){
					$json_array['havePages']="True";
					$pages_result=$this->api->getTemplatePages($tempID);
					$pages=array();
					$index=0;
					$pagesCount=sizeof($pages_result);
					if($pagesCount){
						foreach($pages_result as $item){
							$pages[$index]['pageID']=$item['id'];
							$pages[$index]['pageTitle']=$item['title'];
							
							$pages[$index]['pageDescription']=$item['description'];
							$pages[$index]['pageSlug']=$item['page_slug'];

							$index++;
						}
						$json_array['pages']=$pages;
					}
				}
				else
				{
					$json_array['havePages']="False";
				}

				if($this->api->haveAds($tempID))
				{
					$json_array['haveAds']="True";
					$ads=$this->api->getWebsiteAds($tempID);
					$json_array['ads']=$ads[0];
				}
				else
				{
					$json_array['haveAds']="False";
				}
				//echo "<pre>"; print_r($json_array); echo "</pre>"; exit;
			}
			else
			{
				$json_array['error']="Unauthorised API Key";
				
			}
			return $json_array;
	}

	//
	public function galleryItem(){
		$this->load->model('api');
		$ads=array();
		$json_array=array();
		if(isset($_GET['key']) && $_GET['key']!=NULL){
			$key=$_GET['key'];
			if(isset($_GET['templateID']) && $_GET['templateID']!=NULL){
				$templateID=$_GET['templateID'];
				if($this->api->isValidWebsite($key,$templateID)){
					if(isset($_GET['postID']) && $_GET['postID']!=NULL){
						$postID=$_GET['postID'];
						//check having valid post Id and gallery items		
						if($this->api->isValidPost($templateID,$postID)){
							$json_array=$this->getWebiteAndPostsDetails($key);
							
							
							if($this->api->haveGalleryItems($postID))
							{
								$json_array['haveGalleryItems']="True";
								$gallryitems=$this->api->getGalleryItemsByPost($postID);
							}
							else
							{
								$json_array['haveGalleryItems']="False";
							}
							
							if(isset($_GET['galleryItemId']) && $_GET['galleryItemId']!=NULL)
							{
									$gid=$_GET['galleryItemId'];
									if($this->api->isValidGalleryItem($gid,$postID)){
										$curent_gallery_item=$_GET['galleryItemId'];
										$galleryItem=$this->getFormatedGalleryItem($gallryitems,$curent_gallery_item);
										$json_array['galleryItem']=$galleryItem;
										$json_array['galleryItem']['postID']=$postID;
										//$json_array['galleryItem']['postSlug']=$this->api->getPostSlugById($postID);
										//echo $postID; die;									

									}
									else
									{
										$json_array['error']="Unauthorised Gallery Item";
									}
							}
							else
							{
								if($json_array['haveGalleryItems']=="True"){
									$galleryItem=$this->getFormatedGalleryItem($gallryitems);
									//echo "<pre>"; print_r($galleryItem); echo "</pre>";
									$galleryItem['templateID']=$templateID;
									$galleryItem['postID']=$postID;
									$json_array['galleryItem']=$galleryItem;
								}
							}
							//echo "<pre>"; print_r($json_array); echo "</pre>";
							//exit;
					}
					else
					{
						$json_array['error']="Unauthorised Website Post";
					}
				}
				else
				{
					$json_array['error']="Unauthorised Website Post";
				}
			}
			else
			{
				$json_array['error']="Unauthorised Website.";
			}
		}
		else
		{
			$json_array['error']="Unauthorised API Key";
		}
	}
	else
	{
		$json_array['error']="Unauthorised API Key";
	}
	
		

		//echo "<pre>"; print_r($json_array); echo "</pre>";
		$output = json_encode($json_array);
		echo $output;
}

	public function getFormatedGalleryItem($gallery,$curItem=0){
		$galleryItemDetails=array();
		$index=0; $pre=""; $next="";
		$arrayCount=sizeof($gallery);
		if($curItem){
			foreach (array_values($gallery) as $item => $value) {
				//echo "$i: \n";
				
				foreach($value as $key=>$val) {
					if($curItem==$val && $key=="id")
					{
						//$curent_array=$gallery[$item];
						$galleryItemDetails['galleryItemID']=$gallery[$item]['id'];
						$galleryItemDetails['galleryItemTitle']=$gallery[$item]['articleTitle'];
						$galleryItemDetails['galleryItemSlug']=$gallery[$item]['slug'];
						$galleryItemDetails['galleryItemDescription']=$gallery[$item]['articleDescription'];
						$galleryItemDetails['galleryItemImage']=ARTICLE_IMAGE_PATH."".$gallery[$item]['articleImage'];
						$pre=$item-1;
						if($pre<0)
							$pre=$arrayCount-1;
						
						$next=$item+1;
						if($arrayCount==$next)
							$next=0;
						//$curent_array['next']=$gallery[$next];
						//$curent_array['pre']=$gallery[$pre];
						$galleryItemDetails['pre']['id']=$gallery[$pre]['id'];
						$galleryItemDetails['pre']['slug']=$gallery[$pre]['slug'];
						$galleryItemDetails['nxt']['id']=$gallery[$next]['id'];
						$galleryItemDetails['nxt']['slug']=$gallery[$next]['slug'];
					}
				}
			}	
		}
		else
		{
			$i=0;
			
			if($arrayCount>2){
				$preindex=$arrayCount-1;
				$pre=$gallery[$preindex]['id'];
				$preSlug=$gallery[$preindex]['slug'];
			}else if($arrayCount==2){
				$preindex=1;
				$pre=$gallery[$preindex]['id'];
				$preSlug=$gallery[$preindex]['slug'];
			}
			else
			{
				$preindex=0;
				$pre=$gallery[$preindex]['id'];
				$preSlug=$gallery[$preindex]['slug'];
			}
			$galleryItemDetails['pre']['id']=$pre;
			$galleryItemDetails['pre']['slug']=$preSlug;
			if($arrayCount>=1){
				$galleryItemDetails['galleryItemID']=$gallery[0]['id'];
				$galleryItemDetails['galleryItemTitle']=$gallery[0]['articleTitle'];
				$galleryItemDetails['galleryItemSlug']=$gallery[0]['slug'];
				$galleryItemDetails['galleryItemDescription']=$gallery[0]['articleDescription'];
				$galleryItemDetails['galleryItemImage']=ARTICLE_IMAGE_PATH."".$gallery[0]['articleImage'];
			}

			if($arrayCount==1){
				$galleryItemDetails['nxt']['id']=$gallery[0]['id'];
				$galleryItemDetails['nxt']['slug']=$gallery[0]['slug'];
			}
			elseif($arrayCount>1)
			{
				$galleryItemDetails['nxt']['id']=$gallery[1]['id'];
				$galleryItemDetails['nxt']['slug']=$gallery[1]['slug'];
			}
		}
		return $galleryItemDetails;
	}
	
}