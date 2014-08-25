<?php
class User extends CI_Model {

	function createUser($userData)
	{
		$this->db->insert($this->config->item('table_user'), $userData);
		return $this->db->insert_id();
	}
	function insertForumUser($userData)
	{
		$this->db->insert($this->config->item('table_forum_user'), $userData);
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
	function connectExistingUser($id,$userdata)
	{
		$this->db->where("forumUserID",$id);
		return $this->db->update($this->config->item('table_forum_user'),$userdata);
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
		$numberofrecords=(int)$this->config->item('record_limit');
		$startRecord = 1;
		$this->db->select($this->config->item('table_user').".*,usertype.type");
		$this->db->from($this->config->item('table_user'));
		$this->db->join('usertype',$this->config->item('table_user').".userTypeID = ".'usertype'.".id",'left');
		//$this->db->where("userTypeID !=",'1');
		$this->db->where("userTypeID !=",'4');
		$this->db->limit($numberofrecords,$startRecord);
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
            $this->db->where("userTypeID !=","1");
            $this->db->where("userTypeID !=","4");
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
		$this->db->where("userTypeID !=","1");
		$this->db->where("userTypeID !=","4");
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	function getUser($id)
	{
		$this->db->select($this->config->item('table_user').".*,".$this->config->item('table_user_type').".type");
		$this->db->join($this->config->item('table_user_type'),$this->config->item('table_user').".userTypeID = ".$this->config->item('table_user_type').".id");
		$this->db->from($this->config->item('table_user'));
		$this->db->where($this->config->item('table_user').".id",$id);
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
		$this->db->from($this->config->item('table_user'));
		$this->db->where('email',$email);
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
		$this->db->from($this->config->item('table_user'));
		$this->db->where('email',$email);
		$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		foreach($result->result_array() as $user){
			$id=$user['id'];
		}
		return $id;
	}
	public function userExixts2($email="",$type=""){
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
			$id=$user['forumUserID'];
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
		$this->db->where('forumUserID',$uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getUserDataByID2($uid){
		$this->db->select($this->config->item('table_forum_user').'.*,'.$this->config->item('table_user').'.email');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_forum_user').".forumUserID =".$this->config->item('table_user').".id");
		$this->db->where($this->config->item('table_forum_user').'.forumUserID',$uid);
		$result = $this->db->get();
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
		$this->db->where("forumUserID",$id);
		$this->db->update($this->config->item('table_forum_user'), $userData);
		return $this->db->affected_rows();	
	}

	public function IsValidForumUser($emailId,$password){
		$id=0;
		$this->db->select('*');
		$this->db->from($this->config->item('table_user'));
		$this->db->where('email',$emailId);
		$this->db->where('password',$password);
		$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		foreach($result->result_array() as $user){
			$id=$user['id'];
		}
		return $id;
	}

	public function addSMALinks($data)
	{
		$this->db->insert($this->config->item('table_sma_links'),$data);
		return $this->db->insert_id();
	}
	
	public function UserExistsByTwitterID($twiterID){
		$id=0;
		$this->db->select('forumUserID');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->where('twitterID',$twiterID);
		//$this->db->or_where('userName',$email);
		//$this->db->where('password',$password);
		$this->db->limit(1);
		$result = $this->db->get();
		//echo $this->db->last_query();
		foreach($result->result_array() as $user){
			$id=$user['forumUserID'];
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
	public function getUserDetails2($email){
		$this->db->select('*');
		$this->db->from($this->config->item('table_user'));
		$this->db->where('email',$email);
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
		$this->db->where('forumUserID',$uid);
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
	public function isUserSpam2($uid){
		$id=0;
		$this->db->select('id');
		$this->db->from($this->config->item('table_forum_user'));
		$this->db->where('forumUserID',$uid);
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
	public function existPrivacyofUser($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_privacy'));
		$this->db->where("userid",$id);
		$result = $this->db->get();
		return $result->num_rows();
	}
	public function existPrivacyofUserUrl($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_url_privacy'));
		$this->db->where("userid",$id);
		$result = $this->db->get();
		return $result->num_rows();
	}
	public function updatePrivacyofUser($id,$data)
	{
		$this->db->where("userid",$id);
		$this->db->update($this->config->item('table_privacy'),$data);
	}
	public function updatePrivacyofUserUrl($id,$data)
	{
		$this->db->where("userid",$id);
		$this->db->update($this->config->item('table_url_privacy'),$data);
	}
	public function insertPrivacyofUser($data)
	{
		$this->db->insert($this->config->item('table_privacy'),$data);
	}
	public function insertPrivacyofUserUrl($data)
	{
		$this->db->insert($this->config->item('table_url_privacy'),$data);
	}
	public function getUsersPrivacy($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_privacy'));
		$this->db->where("userid",$id);
		$result = $this->db->get();
		return $result->result_array();	
	}
	public function getUsersUrlPrivacy($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_url_privacy'));
		$this->db->where("userid",$id);
		$result = $this->db->get();
		return $result->result_array();	
	}
	public function getUserSMAUrls($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_sma_links'));
		$this->db->where("userid",$id);
		$result = $this->db->get();
		return $result->result_array();	
	}
	public function getUserSMAUrlsCount($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_sma_links'));
		$this->db->where("userid",$id);
		$result = $this->db->get();
		return $result->num_rows();	
	}
	public function updateSMALinks($id,$data)
	{
		$this->db->where("userid",$id);
		return $this->db->update($this->config->item('table_sma_links'),$data);
	}
}
?>