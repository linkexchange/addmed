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
		$this->db->from("usertype");
		$this->db->where("id !=",1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	function getAllUser()
	{
		$this->db->select($this->config->item('table_user').".*,usertype.type");
		$this->db->from($this->config->item('table_user'));
		$this->db->join('usertype',$this->config->item('table_user').".userTypeID = ".'usertype'.".id",'left');
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
		return $this->db->affected_rows();	
	}
	function deleteUser($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_user'));
	}
	function getAllPublishers()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_user'));
		$this->db->where("userTypeID","3");
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
		
	}
	function getUserByID($id)
	{
		$this->db->select("userName");
		$this->db->from($this->config->item('table_user'));
		$this->db->where("id",$id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
		
	}
	function getAllPublishersID()
	{
		$this->db->select("id");
		$this->db->from($this->config->item('table_user'));
		$this->db->where("userTypeID","3");
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
		
	}
	function getAllAdvertisersID()
	{
		$this->db->select("id");
		$this->db->from($this->config->item('table_user'));
		$this->db->where("userTypeID","2");
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
}
?>