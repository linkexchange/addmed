<?php
class User extends CI_Model {

	function createUser($userData)
	{
		$this->db->insert($this->config->item('table_user'), $userData);
		return $this->db->insert_id();
	}
	function isValidUSer($userName,$password)
	{
		$this->db->select('*');
		$this->db->from($this->config->item('table_user'));
		$this->db->where('userName',$userName);	
		$this->db->where('password',$password);	
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows())
			return $result->result_array();
		else
			return array();
	}
	function isExistUser($userName)
	{
		$this->db->select('*');
		$this->db->from($this->config->item('table_user'));
		$this->db->where('userName',$userName);	
		$this->db->limit(1);
		if($this->db->get()->num_rows())
			return true;
		else
			return false;
	}
	function isExistEmail($email)
	{
		$this->db->select('*');
		$this->db->from($this->config->item('table_user'));
		$this->db->where('email',$email);	
		$this->db->limit(1);
		if($this->db->get()->num_rows())
			return true;
		else
			return false;
	}
	function getUserType()
	{
		$this->db->select("*");
		$this->db->from("userType");
		$this->db->where("id !=",1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	function getAllUser()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_user'));
		$this->db->where("userTypeID !=",1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	function getUser($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_user'));
		$this->db->where("id",$id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
		
	}
	function updateUser($userData,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_user'), $userData);
	}
	function deleteUser($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_user'));
	}
}
?>