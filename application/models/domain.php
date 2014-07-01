<?php 
class Domain extends CI_Model{

	// Check valid key or not
	public function isValidKey($key=""){
		if($key){
			$this->db->select("id");
			$this->db->from($this->config->item('table_domains'));
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
		$this->db->select($this->config->item('table_domains').".templateID,".$this->config->item('table_templates').".name");
		$this->db->from($this->config->item('table_domains'));
		$this->db->join($this->config->item('table_templates'),$this->config->item('table_templates').".id = ".$this->config->item('table_domains').".templateID");
		$this->db->where('apiKey',$key);
		$result = $this->db->get();
		return $result->result_array();
	}

	// check valid website
	public function isValidWebsite($key="",$tempID=""){
		if($key && $tempID){
			$this->db->select("id");
			$this->db->from($this->config->item('table_domains'));
			$this->db->where('apiKey',$key);
			$this->db->where('templateID',$tempID);
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

	// return array of gallery items by post ID
	public function getGalleryItemsByPost($postID){
		$this->db->select($this->config->item('table_articles').".*,");
		$this->db->from($this->config->item('table_articles'));
		$this->db->where('blogID',$postID);
		$result = $this->db->get();
		return $result->result_array();
	}

	// return ads by template ID
	public function getWebsiteAds($templateID){
		$this->db->select($this->config->item('table_advertises').".*,");
		$this->db->from($this->config->item('table_advertises'));
		$this->db->where('templateID',$templateID);
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>