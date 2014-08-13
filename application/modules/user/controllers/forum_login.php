<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forum_Login extends MX_Controller {
	public function index()
	{
		if($this->session->userdata("ForumUserID"))
		{
			redirect(base_url().'topics');
		}
		else
		{
			$data=array();
			if(isset($_GET['link'])){
				$url=urldecode($_GET['link']);
				$data['backUrl']=$url;
			}
			$this->layout->setLayout("layout/login");
			$this->layout->view('login',$data);
		}
	}
	public function twitteremail(){

		if($this->session->userdata('twitter_user_id'))
		{
			
			$this->load->model('user');
			//redirect(base_url()."forum/dashboard");
			$twitter_id=$this->session->userdata('twitter_user_id');
			$twitter_screen_name=$this->session->userdata('twitter_screen_name');
			$twitter_name=$this->session->userdata('twitter_name');
			$userExits=$this->user->UserExistsByTwitterID($twitter_id);
			$type="Twitter";
			if($userExits){
				$userSpam=$this->user->isUserSpam($userExits);
				if(!$userSpam){
					$userData=$this->user->getUserDataByID($userExits);
					$this->setUserSession($userData,$type);
					$userData=array(
						"lastLoggedInOn"=>date("Y-m-d"),
						"lastLoggedInFrom"=>$type,
					);
					$updated = $this->user->updateUser($this->session->userData('ForumUserID'),$userData);
					if($this->session->userData('backurl')){
						$backurl=$this->session->userData('backurl');
						$this->session->unset_userdata('backurl');
						redirect($backurl);
					}
					else{
						redirect($this->config->item('base_url'), 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('flashError', 'This user is marked as spam. Please contact to website admin!.');
					redirect($this->config->item('base_url')."user/login");
				}
				
			}
			else
			{
				$data=array();
				$data['twitter']['id']=$twitter_id;
				$data['twitter']['screen_name']=$twitter_screen_name;
				$names=explode(' ',$twitter_name);
				$data['twitter']['first_name']=$names[0];
				$data['twitter']['last_name']=$names[1];
				$data['twitter']['type']="Twitter";
				$data['account']=0;
				//echo "twitter";
				$this->layout->setLayout("layout/main_login");
				$this->layout->view('twitter_data',$data);
			}
			
		}
		else
		{
			$this->layout->setLayout("layout/main_login");
			$this->layout->view('twitter_data');
		}
	}
	public function setUserData(){
		if($this->input->post()){
			$this->load->model("user");
			$firstName=$this->input->post('firstName');
			$lastName=$this->input->post('lastName');
			$email=$this->input->post('email');
			$type=$this->input->post('type');
			if($type=="Twitter"){
				$twitterId=$this->input->post('twitterId');
				$userId=$this->user->isUserExixts($email,$type,$twitterId);
			}
			else
			{
				$userId=$this->user->isUserExixts($email,$type);
			}
			
			if($userId){
				$userData=array();
				$userdata=$this->user->getUserDataByID2($userId);
				if($type=="Twitter" && $userdata[0]['twitterID']==""){
					$userData['twitterID']=$twitterId;
					$userData['twitterEmail']=$email;
				}
				$this->setUserSession($userdata,$type);
				$userData['lastLoggedInOn']=date("Y-m-d");
				$userData['lastLoggedInFrom']=$type;
				
				$updated = $this->user->updateForumUser($this->session->userData('ForumUserID'),$userData);
				
				echo 1;
			}
			else
			{
				//echo $isUserExists;
				$userData=array();
				$ForumUserData=array();
				if($type=="Google"){
					$ForumUserData['googleID']=$email;
				} else if($type=="Facebook"){
					$ForumUserData['facebookID']=$email;
				}else if($type=="Twitter"){
					$ForumUserData['twitterID']=$twitterId;
					$ForumUserData['twitterEmail']=$email;
				}
				//data for user table
				$userData['userTypeID']=4;
				$userData['userName']=$firstName.$lastName;
				$userData['email']=$email;
				$userData['password']=$this->getPassword();				
				$userData['createdDate']=date("Y-m-d");
				//data for forum user table
				//$ForumUserData['userName']=$email;
				//$ForumUserData['password']=$this->getPassword();				
				$ForumUserData['createdDate']=date("Y-m-d");
				$ForumUserData['lastLoggedInOn']=date("Y-m-d");
				$ForumUserData['firstName']=$firstName;
				$ForumUserData['lastName']=$lastName;
				$ForumUserData['lastLoggedInFrom']=$type;
				$userID  = $this->user->createUser($userData);
				$ForumUserData['forumUserID']=$userID;
				$forumID = $this->user->insertForumUser($ForumUserData);
				if($userID && $forumID)
				{
					$userData=$this->user->getUserDataByID2($userID);
					$this->setUserSession($userData,$type);
					$this->sendRegistrationEmail();
					echo 1;
				}
			}
		}
		else
		{
			echo 0;
		}
	}

	public function setUserSession($userData,$type){
		//echo "<pre>"; print_R($userData); exit;
		foreach($userData as $user){
			$this->session->set_userdata('userID', $user['id']);
			$this->session->set_userdata('userName', $user['userName']);
			if(array_key_exists('forumUserID',$user)) 
			{
				$this->session->set_userdata('userTypeID',$user['forumUserID']);
				$this->session->set_userdata('ForumUserFullName',$user['firstName']." ".$user['lastName']);
			}
			else
			{
				$this->session->set_userdata('userTypeID',$user['userTypeID']);
			}
			$this->session->set_userdata('email',$user['email']);
			$this->session->set_userdata('loggedIn',TRUE);
                        
			if($this->session->userdata('userTypeID')==1)
				$this->session->set_userdata('userType','admin');
			else if($this->session->userdata('userTypeID')==2)
				$this->session->set_userdata('userType','advertiser');
			else if($this->session->userdata('userTypeID')==3)
				$this->session->set_userdata('userType','publisher');
			elseif($this->session->userdata('userTypeID')==4)
				$this->session->set_userdata('userType','forumUser');
		}
					
	}

	public function checkUserByID(){
		if(isset($_POST['email']) && isset($_POST['type'])){
			$this->load->model("user");
			$userExists=$this->user->userExixts2($_POST['email'],$_POST['type']); 
			if($userExists){
				$userSpam=$this->user->isUserSpam($userExists); 				
				if(!$userSpam){
					$userData=$this->user->getUserDataByID2($userExists);
					//echo "<pre>"; print_R($userData); exit;
					$this->setUserSession($userData,$_POST['type']);
					$userData=array(
						"lastLoggedInOn"=>date("Y-m-d"),
						"lastLoggedInFrom"=>$_POST['type'],
					);
					$updated = $this->user->updateForumUser($this->session->userData('ForumUserID'),$userData);
					echo $userExists;
				}
				else
				{
					echo "-1";
				}
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo 0;
		}
		
	}

	public function getPassword(){
		$this->load->helper('string');
		$password=random_string('alnum', 8);
		return $password;
	}

	public function checkLogin(){
		$this->load->model('user');
		if($this->input->post()){
			$userName=$_POST['userName'];
			$password=$_POST['password'];
			$userID=$this->user->IsValidForumUser($userName,$password);
			if($userID){
				echo $userID;
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo 0;
		}
	}

	public function connectUserData(){
		if($this->input->post()){
			$this->load->model("user");
			$firstName=$this->input->post('firstName');
			$lastName=$this->input->post('lastName');
			$email=$this->input->post('email');
			$type=$this->input->post('type');
			if($type="Twitter"){
				$twitterId=$this->input->post('twitterId');
			}
			$userID=$this->input->post('userID');
			
			$userData=array();
			
			if($type=="Google"){
				$userData['googleID']=$email;
			} else if($type=="Facebook"){
				$userData['facebookID']=$email;
			}else if($type=="Twitter"){
				$userData['twitterEmail']=$email;
				$userData['twitterID']=$twitterId;
			}
			
			$userData['lastLoggedInOn']=date("Y-m-d");
			$userData['lastLoggedInFrom']=$type;

			$updated = $this->user->updateUser($userID,$userData);
			if($updated)
			{
				$userData=$this->user->getUserDataByID($userID);
				$this->setUserSession($userData,$type);
				echo 1;
			}
			else
			{
				echo 0;
			}
			
			
		}
		else
		{
			echo 0;
		}
	
	}

	

	public function setEmail(){
		if($this->input->post()){
			$userName=$this->input->post('userName');
			echo $userName;
		}
		else
		{
			echo 0;
		}
	}

	public function sendRegistrationEmail(){
		$this->load->library('email');
		$this->load->model('user');
		$user=$this->user->getUserDetails2($this->session->userdata('email'));
		$this->email->clear();
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from('admin@socialtrafficcenter.com', 'Admin');
		$this->email->to($user[0]['email']);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
			
		$this->email->subject('STC Registration Details. ');
		$msg="";
		$msg.="<br/>Hello ".$this->session->userdata('ForumUserFuLLName').",";
		$msg.="<br/><br/>Bellow are your profile details.Please check.<br/>";
		$msg.="<br/>UserName: ".$user[0]['email'];
		$msg.="<br/>Password : ".$user[0]['password'];
		$msg.="<br/><br/> Thanks,<br/>Regards,<br/>Admin Team.";
		$this->email->message($msg);
		$this->email->send();
	}
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */