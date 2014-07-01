<?php
class User extends CI_Model {
	public function isUserExixts($email="",$type="",$twitterId=""){
		$id=0;
		$this->db->select('id');
		$this->db->from($this->config->item('table_forum_user'));
		if($type=="Google")
			$this->db->where('googleID',$email);
		else if($type=="Facebook")
			$this->db->where('facebookID',$email);
		else if($type=="Twitter"){
			$this->db->where('twitterID',$twitterId);
		}else
			return 0;
		$this->db->or_where('userName',$email);
		//$this->db->where('OR userName',$email);
		$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		foreach($result->result_array() as $user){
			$id=$user['id'];
		}
		return $id;
	}

	public function userExixts($email="",$type=""){
		$id=0;
		$this->db->select('*');
		$this->db->from($this->config->item('table_forum_user'));

		if($type=="Google")
			$this->db->where('googleID',$email);
		else if($type=="Facebook")
			$this->db->where('facebookID',$email);
		else if($type=="Twitter")
			$this->db->where('twitterID',$email);
		else
			return 0;
		$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		foreach($result->result_array() as $user){
			$id=$user['id'];
		}
		return $id;
	}

	public function userExixtsByEmail($email=""){
		$this->db->select('*');
		$this->db->from($this->config->item('table_forum_user'));

		$this->db->where('googleID',$email);
		//$this->db->where('userTypeID',$type);
		$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		foreach($result->result_array() as $user){
			$id=$user['id'];
		}
		return $id;
	}

	function createUser($userData)
	{
		$this->db->insert($this->config->item('table_forum_user'), $userData);
		return $this->db->insert_id();
	}

	public function getUserDataByID($uid){
		$this->db->select('*');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->where('id',$uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	public function getUserDataByEmail($email,$type){
		$this->db->select($this->config->item('table_forum_user').".*,".$this->config->item('table_forum_user_type').".type");
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->join($this->config->item('table_forum_user_type'),$this->config->item('table_forum_user').".userTypeID = ".$this->config->item('table_forum_user_type').".id",'left');
		$this->db->where($this->config->item('table_forum_user').".userName",$email);
		$this->db->where($this->config->item('table_forum_user').".userTypeID",$type);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	function updateUser($id,$userData)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_forum_user'), $userData);
		return $this->db->affected_rows();	
	}

	public function IsValidUser($emailId,$password){
		$id=0;
		$this->db->select('*');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->where('userName',$emailId);
		$this->db->where('password',$password);
		$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		foreach($result->result_array() as $user){
			$id=$user['id'];
		}
		return $id;
	}

	public function UserExistsByTwitterID($twiterID){
		$id=0;
		$this->db->select('id');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->where('twitterID',$twiterID);
		//$this->db->or_where('userName',$email);
		//$this->db->where('password',$password);
		$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		foreach($result->result_array() as $user){
			$id=$user['id'];
		}
		return $id;
	}
	
	public function getUserDetails($email){
		$id=0;
		$this->db->select('*');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->where('userName',$email);
		//$this->db->where('password',$password);
		$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	public function isUserSpam($uid){
		$id=0;
		$this->db->select('id');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->where('id',$uid);
		$this->db->where('spam','Yes');
		//$this->db->or_where('spam',"yes");
		//$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		foreach($result->result_array() as $user){
			$id=$user['id'];
		}
		return $id;
	}
}
?>