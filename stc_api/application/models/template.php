<?php 
class Template extends CI_Model{
    //returns all templates and its details details by user ID
    public function getTemplates($uid=1,$limit=0)
    {
        $numberofrecords=(int)$this->config->item('record_limit');
	if($limit>0)
            $limit=$limit-1;	
	$startRecord=$limit*$numberofrecords;
	$this->db->select("*");
	$this->db->from($this->config->item('table_templates'));
	if($this->session->userdata('userType')!="admin")
            $this->db->where('userID',$uid);
	$this->db->limit($numberofrecords,$startRecord);
        $result = $this->db->get();
	//echo $this->db->last_query();
	return $result->result_array();
    }
    public function getAllTemplates($uid=0)
    {
        $this->db->select("*");
        $this->db->from($this->config->item('table_templates'));
	if($this->session->userdata('userType')!="admin")
            $this->db->where('userID',$uid);
	//$this->db->limit($numberofrecords,$startRecord);
        $result = $this->db->get();
	//echo $this->db->last_query();
	return $result->result_array();
    }
    //Add a template
    public function add($templateData)
    {
	$this->db->insert($this->config->item('table_templates'), $templateData);
	return $this->db->insert_id();
    }
    //Delete a template
    function delete($id)
    {
	$this->db->where("id",$id);
	$this->db->delete($this->config->item('table_templates'));
	$this->load->model('blog');
	$this->blog->deleteByTemplateID($id);
	$this->load->model('advertise');
	$this->advertise->deleteAdvertiseByTemplateID($id);
    }

	//Returns all template details by template ID
	public function getTemplate($id){
		$this->db->select("*");
		$this->db->from($this->config->item('table_templates'));
		$this->db->where('id',$id);
		$result = $this->db->get();
		return $result->result_array();
	}

	//Update template
	function update($templateDate,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_templates'), $templateDate);
		return $this->db->affected_rows();	
		
	}

	//Returns templates count by user Id
	public function getTemplatesCount($uid){
		$this->db->select("*");
		$this->db->from($this->config->item('table_templates'));

		if($this->session->userdata('userType')!="admin")
			$this->db->where('userID',$uid);
		
		$result = $this->db->get();
		return $result->num_rows();
	}

	public function IsUniqueApiKey($key){
		$this->db->select("*");
		$this->db->from($this->config->item('table_templates'));
		$this->db->where('apiKey',$key);
		$result = $this->db->get();
		return $result->num_rows();
	}

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
		$this->db->select("id,name,updatedDate");
		$this->db->from($this->config->item('table_templates'));
		$this->db->where('apiKey',$key);	
		$result = $this->db->get();
		$res=$result->result_array();
		foreach($res as $template){
			$tid=$template['id'];
		}
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

	// return ads by template ID
	public function getWebsiteAds($templateID){
		$this->db->select($this->config->item('table_advertises').".*,");
		$this->db->from($this->config->item('table_advertises'));
		$this->db->where('templateID',$templateID);
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

	// return count of gallery items by post ID
	public function haveGalleryItems($postID){
		$this->db->select("id");
		$this->db->from($this->config->item('table_articles'));
		$this->db->where('blogID',$postID);
		$result = $this->db->get();
		return $result->num_rows();
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

	public function getAdvertiseTemplates($uid=0,$limit=0){
		if($limit!="All"){
			$numberofrecords=(int)$this->config->item('record_limit');
			if($limit>0)
				$limit=$limit-1;	
			$startRecord=$limit*$numberofrecords;
		}
		$this->db->select($this->config->item('table_templates').".*");
		$this->db->from($this->config->item('table_templates'));
		$this->db->join($this->config->item('table_advertises'),$this->config->item('table_advertises').".templateID = ".$this->config->item('table_templates').".id",'left');

		if($this->session->userData('userTypeID')==3)
			$this->db->where($this->config->item('table_templates').'.userID',$uid);

		$this->db->where($this->config->item('table_advertises').'.templateID IS NULL');
		if($limit!="All"){
			$this->db->limit($numberofrecords,$startRecord);
		}
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}	
	// return user Id from template ID
	public function getUserID($tid){
		$this->db->select("userID,name");
		$this->db->from($this->config->item('table_templates'));
		$this->db->where('id',$tid);
		$result = $this->db->get();
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
	//return post slug from post Id.
	public function getPostSlugBy($id){
		$this->db->select("blogSlug");
		$this->db->from($this->config->item('table_blogs'));
		$this->db->where('id',$id);
		$result = $this->db->get();
		return $result->result_array();
	}
}

?>