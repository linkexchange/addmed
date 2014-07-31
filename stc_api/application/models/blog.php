<?php 
class Blog extends CI_Model{
	public function getBlogs($uid=0,$limit=0,$tid=0){
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_blogs').".*,".$this->config->item('table_templates').".name");
		$this->db->from($this->config->item('table_blogs'));
		$this->db->join($this->config->item('table_templates'),$this->config->item('table_blogs').".templateID = ".$this->config->item('table_templates').".id",'left');

		if($this->session->userdata('userType')!="admin")
			$this->db->where($this->config->item('table_templates').".userID",$uid);

		
		if($tid){
			$this->db->where($this->config->item('table_blogs').".templateID",$tid);
		}

		$this->db->limit($numberofrecords,$startRecord);
		
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	public function getBlogsCount($uid=0,$tid=0){
		$this->db->select($this->config->item('table_blogs').".*,".$this->config->item('table_templates').".name");
		$this->db->from($this->config->item('table_blogs'));
		$this->db->join($this->config->item('table_templates'),$this->config->item('table_blogs').".templateID = ".$this->config->item('table_templates').".id",'left');

		if($this->session->userdata('userType')!="admin"){
			$this->db->where($this->config->item('table_templates').".userID",$uid);
		}
		if($tid){
			$this->db->where($this->config->item('table_blogs').".templateID",$tid);
		}
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		return $result->num_rows();
	}

	public function add($blogData)
	{
		$this->db->insert($this->config->item('table_blogs'), $blogData);
		return $this->db->insert_id();
	}

	function delete($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_blogs'));
		$this->load->model('article');
		$this->article->deleteArticleByBlog($id);
	
	}

	public function deleteByTemplateID($tid){
		$blogs=$this->getAllBlogsByTemplate($this->session->userData('userID'),$tempID=$tid);
		
		//$this->load->model('article');
		foreach($blogs as $blog){
			$this->delete($blog['id']);
			//$this->article->deleteArticleByBlog($blog['id']);
		}

	}

	public function getBlog($id){
		$this->db->select($this->config->item('table_blogs').".*,".$this->config->item('table_templates').".name");
		$this->db->from($this->config->item('table_blogs'));
		$this->db->join($this->config->item('table_templates'),$this->config->item('table_blogs').".templateID = ".$this->config->item('table_templates').".id",'left');
		$this->db->where($this->config->item('table_blogs').".id",$id);
		$result = $this->db->get();
		return $result->result_array();
	}

	//Update blog
	function update($blogDate,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_blogs'), $blogDate);
		return $this->db->affected_rows();	
		
	}

	public function getBlogsByTemplate($uid=0,$tempID=0,$limit=0){
		
			$numberofrecords=(int)$this->config->item('record_limit');
			if($limit>0)
                            $limit=$limit-1;	
			$startRecord=$limit*$numberofrecords;
		
		$this->db->select($this->config->item('table_blogs').".*,".$this->config->item('table_templates').".name");
		$this->db->from($this->config->item('table_blogs'));
		$this->db->join($this->config->item('table_templates'),$this->config->item('table_blogs').".templateID = ".$this->config->item('table_templates').".id",'left');

		if($this->session->userdata('userType')!="admin")
			$this->db->where($this->config->item('table_templates').".userID",$uid);

		$this->db->where($this->config->item('table_blogs').".templateID",$tempID);
		
                $this->db->limit($numberofrecords,$startRecord);
                $result = $this->db->get();
                //echo $limit;
		//echo $this->db->last_query(); 
		return $result->result_array();
	}
        
        public function getAllBlogsByTemplate($uid=0,$tempID=0){
		
		$this->db->select($this->config->item('table_blogs').".*,".$this->config->item('table_templates').".name");
		$this->db->from($this->config->item('table_blogs'));
		$this->db->join($this->config->item('table_templates'),$this->config->item('table_blogs').".templateID = ".$this->config->item('table_templates').".id",'left');

		if($this->session->userdata('userType')!="admin")
			$this->db->where($this->config->item('table_templates').".userID",$uid);

		$this->db->where($this->config->item('table_blogs').".templateID",$tempID);
		               
                $result = $this->db->get();
                //echo $limit;
		//echo $this->db->last_query(); 
		return $result->result_array();
	}
        
	public function getBlogsCountByTemplate($uid=0,$tempID=0){
		$this->db->select($this->config->item('table_blogs').".*,".$this->config->item('table_templates').".name");
		$this->db->from($this->config->item('table_blogs'));
		$this->db->join($this->config->item('table_templates'),$this->config->item('table_blogs').".templateID = ".$this->config->item('table_templates').".id",'left');

		if($this->session->userdata('userType')!="admin")
			$this->db->where($this->config->item('table_templates').".userID",$uid);

		$this->db->where($this->config->item('table_blogs').".templateID",$tempID);
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}

	public function getTemplateBlogs($templateID){
		$this->db->select(
				$this->config->item('table_blogs').".id,".
				$this->config->item('table_blogs').".title,".
				$this->config->item('table_blogs').".image,".
				$this->config->item('table_blogs').".description,".
				$this->config->item('table_blogs').".blogSlug"
			);
		$this->db->from($this->config->item('table_blogs'));
		$this->db->where("templateID",$templateID);
		$result = $this->db->get();
		return $result->result_array();
	}

} 
?>