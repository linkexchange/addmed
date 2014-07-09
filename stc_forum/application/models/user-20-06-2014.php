<?php
class User extends CI_Model {
	public function isUserExixts($email="",$type=""){
		$this->db->select('*');
		$this->db->from($this->config->item('table_user'));
		$this->db->where('email',$email);
		$this->db->where('userTypeID',$type);
		$this->db->limit(1);
		return $this->db->get()->num_rows();
	}

	function createUser($userData)
	{
		$this->db->insert($this->config->item('table_user'), $userData);
		return $this->db->insert_id();
	}

	public function getUserDataByID($uid){
		$this->db->select($this->config->item('table_user').".*,".$this->config->item('table_user_type').".type");
		$this->db->from($this->config->item('table_user'));
		$this->db->join($this->config->item('table_user_type'),$this->config->item('table_user').".userTypeID = ".$this->config->item('table_user_type').".id",'left');
		$this->db->where($this->config->item('table_user').".id",$uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	public function getUserDataByEmail($email,$type){
		$this->db->select($this->config->item('table_user').".*,".$this->config->item('table_user_type').".type");
		$this->db->from($this->config->item('table_user'));
		$this->db->join($this->config->item('table_user_type'),$this->config->item('table_user').".userTypeID = ".$this->config->item('table_user_type').".id",'left');
		$this->db->where($this->config->item('table_user').".email",$email);
		$this->db->where($this->config->item('table_user').".userTypeID",$type);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	function updateUser($id,$userData)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_user'), $userData);
		return $this->db->affected_rows();	
	}
	
}
?>