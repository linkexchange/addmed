<?php 
class Forums extends CI_Model{
	public function addTopic($data)
	{
		$this->db->insert($this->config->item('table_topic'),$data);
		return $this->db->insert_id();
	}
	public function addPost($data)
	{
		$this->db->insert($this->config->item('table_forum_post'),$data);
		return $this->db->insert_id();
	}
	public function getAllPostsById($id)
	{
		$this->db->select('*');
		$this->db->from($this->config->item('table_forum_post'));
		$this->db->where('topic_id',$id);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function deleteTopic($id)
	{
		$this->db->where('id',$id);
		$this->db->delete($this->config->item('table_topic'));
	}
	public function addPostCount($id)
	{
		$this->db->set('no_of_posts', 'no_of_posts + ' . 1, FALSE);
		$this->db->where('id',$id);
		$this->db->update($this->config->item('table_topic'));
	}
	public function getAllTopics($limit=0)
	{
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select('*');
		$this->db->from($this->config->item('table_topic'));
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllTopicsCount(){
		$this->db->select("*");
		$this->db->from($this->config->item('table_topic'));
		return $this->db->count_all_results();
	}
	public function getAllApprovedTopics($limit=0)
	{
		if($this->session->userdata("userID"))
		{
			$numberofrecords=(int)$this->config->item('record_limit');
		}
		else
		{
			$numberofrecords=10;
		}
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select('*');
		$this->db->from($this->config->item('table_topic'));
		$this->db->where('approved',1);
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllApprovedTopics2($limit=0) {
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select('*');
		$this->db->from($this->config->item('table_topic'));
		$this->db->where('approved',1);
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllApprovedTopicsCount()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_topic'));
		$this->db->where('approved',1);
		return $this->db->count_all_results();
	}
	public function getTopicById($id)
	{
		$this->db->select('*');
		$this->db->from($this->config->item('table_topic'));
		$this->db->where('id',$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllForumUsers($limit=0)
	{
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select('*');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllForumUsersCount($limit=0)
	{
		$numberofrecords=10;
			if($limit>0)
				$limit=$limit-1;	
			$startRecord=$limit*$numberofrecords;
		$this->db->select('*');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->limit($numberofrecords,$startRecord);
		return $this->db->count_all_results();
	}
	public function spamUser($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update($this->config->item('table_forum_user'),$data);
		return $this->db->affected_rows();
	}
	public function approvalTopic($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update($this->config->item('table_topic'),$data);
		return $this->db->affected_rows();
	}
}