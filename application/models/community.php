<?php 
class Community extends CI_Model{

	public function addCommunity($communityData)
	{
		$this->db->insert($this->config->item('table_communities'),$communityData);
		return $this->db->insert_id();
	}
	public function addComment($commentData)
	{
		$this->db->insert($this->config->item('table_communities_comments'),$commentData);
		return $this->db->insert_id();
	}
	public function addNoOfPosts($id)
	{
		$this->db->set('no_of_posts', 'no_of_posts + ' . 1, FALSE);
		$this->db->where('id',$id);
		$this->db->update($this->config->item('table_communities'));
	}
	public function getAllCommunities()
	{
		$this->db->select($this->config->item('table_communities').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_communities'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_communities').".created_by =".$this->config->item('table_user').".id");
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getCommunityByID($id)
	{
		$this->db->select($this->config->item('table_communities').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_communities'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_communities').".created_by =".$this->config->item('table_user').".id");
		$this->db->where($this->config->item('table_communities').".id",$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllComments($id)
	{
		$this->db->select($this->config->item('table_communities_comments').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_communities_comments'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_communities_comments').".created_by =".$this->config->item('table_user').".id");
		$this->db->where("community_id",$id);
		$this->db->where("parent_id",0);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllReplies()
	{
		$this->db->select($this->config->item('table_communities_comments').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_communities_comments'));
		$this->db->where("parent_id > ",0);
		$this->db->join($this->config->item('table_user'),$this->config->item('table_communities_comments').".created_by =".$this->config->item('table_user').".id");
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getPopularPosts()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_communities'));
		$this->db->order_by("no_of_posts","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>