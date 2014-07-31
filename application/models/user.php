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
	function getUserByEmailId($email)
	{
		$this->db->select('*');
		$this->db->from($this->config->item('table_user'));
		$this->db->where('email',$email);	
		$this->db->limit(1);
		$result = $this->db->get();
		return $result->result_array();
		
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
        function getUsers($limit=0)
	{
            $numberofrecords=(int)$this->config->item('record_limit');
            if($limit>0)
               $limit=$limit-1;	
            $startRecord=$limit*$numberofrecords;
            $this->db->select($this->config->item('table_user').".*,usertype.type");
            $this->db->from($this->config->item('table_user'));
            $this->db->join('usertype',$this->config->item('table_user').".userTypeID = ".'usertype'.".id",'left');
            $this->db->where("userTypeID !=",1);
            $this->db->limit($numberofrecords,$startRecord);
            $result = $this->db->get();
            //echo $this->db->last_query();
            return $result->result_array();
	}
	function getAllUsersCount()
	{
		$this->db->select($this->config->item('table_user').".*,usertype.type");
		$this->db->from($this->config->item('table_user'));
		$this->db->join('usertype',$this->config->item('table_user').".userTypeID = ".'usertype'.".id",'left');
		$this->db->where("userTypeID !=",1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
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
	function getPublishersByLinkID($id)
	{
		$this->db->select("userName");
		$this->db->from($this->config->item('table_user'));
		$this->db->join($this->config->item("table_published_url"),$this->config->item("table_published_url").".publisherID=".$this->config->item('table_user').".id");
		$this->db->where($this->config->item("table_published_url").".linkID",$id);
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

	function createForumUser($userData)
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

	function updateForumUser($id,$userData)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_forum_user'), $userData);
		return $this->db->affected_rows();	
	}

	public function IsValidForumUser($emailId,$password){
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