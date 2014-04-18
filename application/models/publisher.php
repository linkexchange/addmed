<?php 
class Publisher extends CI_Model{
	public function isExists($uid){
		$this->db->select("*");
		$this->db->from($this->config->item('table_publisher'));
		$this->db->where("userID",$uid); 
		$result = $this->db->get();
		return $result->num_rows();
		//return "test";
	}
	public function getDetails($uid){
		$this->db->select("*");
		$this->db->from($this->config->item('table_publisher'));
		$this->db->where("userID",$uid); 
		$result = $this->db->get();
		return $result->result_array();
	}
	public function updatePublisher($uid,$pubData){
		$this->db->where("userID",$uid);
		$this->db->update($this->config->item('table_publisher'), $pubData);
		return $this->db->affected_rows();
		//return "update";
	}
	public function addPublisher($pubData){
		$this->db->insert($this->config->item('table_publisher'), $pubData);
		return $this->db->insert_id();
		//return "insert";
	}
}
?>