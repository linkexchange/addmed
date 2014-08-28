<?php 
class Api extends CI_Model{
	public function isValidKey($key=""){
		if($key){
			$this->db->select("id");
			$this->db->from($this->config->item('table_templates'));
			$this->db->where('apiKey',$key);
			$result = $this->db->get();
			return $result->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function getTemplateIDByKey($key){
		$tid=0;
		$this->db->select("id,name,createdDate,updatedDate");
		$this->db->from($this->config->item('table_templates'));
		$this->db->where('apiKey',$key);	
		$result = $this->db->get();
		$res=$result->result_array();
		foreach($res as $template){
			$tid=$template['id'];
		}
		return $result->result_array();
	}

	//Check templaet has posts.
	public function hasPosts($tid){
		$this->db->select('id');
		$this->db->from($this->config->item('table_blogs'));
		$this->db->where("templateID",$tid);
		$result = $this->db->get();
		return $result->num_rows();;
	}

	public function getTemplateBlogs($templateID){
		$this->db->select(
				$this->config->item('table_blogs').".id,".
				$this->config->item('table_blogs').".title,".
				$this->config->item('table_blogs').".image,".
				$this->config->item('table_blogs').".description,".
				$this->config->item('table_blogs').".blogSlug,".
				$this->config->item('table_blogs').".createdDate"
			);
		$this->db->from($this->config->item('table_blogs'));
		$this->db->where("templateID",$templateID);
		$result = $this->db->get();
		return $result->result_array();
	}

	//Check templaet has pages.
	public function hasPages($tid){
		$this->db->select('id');
		$this->db->from($this->config->item('table_pages'));
		$this->db->where("templateID",$tid);
		$result = $this->db->get();
		return $result->num_rows();;
	}

	// return pages from the template Id.
	public function getTemplatePages($templateID){
		$this->db->select(
				$this->config->item('table_pages').".id,".
				$this->config->item('table_pages').".title,".
				$this->config->item('table_pages').".description,".
				$this->config->item('table_pages').".page_slug"
			);
		$this->db->from($this->config->item('table_pages'));
		$this->db->where("templateID",$templateID);
		$this->db->order_by('id','ASC');
		$result = $this->db->get();
		return $result->result_array();
	}

	// return ads by template ID
	public function haveAds($templateID){
		$this->db->select("id");
		$this->db->from($this->config->item('table_advertises'));
		$this->db->where('templateID',$templateID);
		$result = $this->db->get();
		return $result->num_rows();
	}

	// return ads by template ID
	public function getWebsiteAds($templateID){
		$this->db->select($this->config->item('table_advertises').".*,");
		$this->db->from($this->config->item('table_advertises'));
		$this->db->where('templateID',$templateID);
		$result = $this->db->get();
		return $result->result_array();
	}

	// check valid website
	public function isValidWebsite($key="",$tempID=""){
		if($key && $tempID){
			$this->db->select("id");
			$this->db->from($this->config->item('table_templates'));
			$this->db->where('apiKey',$key);
			$this->db->where('id',$tempID);
			$result = $this->db->get();
			return $result->num_rows();
		}
		else
		{
			return 0;
		}
	}

	// check valid post
	public function isValidPost($tempID="",$postID=""){
		if($tempID && $postID){
			$this->db->select("id");
			$this->db->from($this->config->item('table_blogs'));
			$this->db->where('id',$postID);
			$this->db->where('templateID',$tempID);
			$result = $this->db->get();
			return $result->num_rows();
		}
		else
		{
			return 0;
		}
	}

	// return count of gallery items by post ID
	public function haveGalleryItems($postID){
		$this->db->select("id");
		$this->db->from($this->config->item('table_articles'));
		$this->db->where('blogID',$postID);
		$result = $this->db->get();
		return $result->num_rows();
	}

	// return array of gallery items by post ID
	public function getGalleryItemsByPost($postID){
		$this->db->select($this->config->item('table_articles').".*,");
		$this->db->from($this->config->item('table_articles'));
		$this->db->where('blogID',$postID);
                $this->db->order_by('sortOrder asc'); 
		$result = $this->db->get();
		return $result->result_array();
	}

	// return count of gallery items by post ID
	public function isValidGalleryItem($gid,$postID){
		$this->db->select("id");
		$this->db->from($this->config->item('table_articles'));
		$this->db->where('id',$gid);
		$this->db->where('blogID',$postID);
		$result = $this->db->get();
		return $result->num_rows();
	}
}

?>