<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MX_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		$this->load->model("user");
		$this->layout->setLayout("layout/login");
	}	
	public function index()
	{
		if($this->session->userdata("userID"))
		{
			redirect(base_url().$this->session->userdata('userType')."/dashboard");
		}
		else if($this->session->userdata("ForumUserID"))
		{
			redirect(base_url().'topics');
		}
		else
		{
			if($this->input->post())
			{
				$this->load->model("user");
				$result = $this->user->isValidUSer($this->input->post("userName"),$this->input->post("password"));
				//print_r($result);
				if(!count($result))
				{
					echo 201;
				}
				else
				{
					$this->session->set_userdata('userID', $result[0]['id']);
					$this->session->set_userdata('userName', $result[0]['userName']);
					$this->session->set_userdata('userTypeID',$result[0]['userTypeID']);
					$this->session->set_userdata('email',$result[0]['email']);
					$this->session->set_userdata('loggedIn',TRUE);

					if($result[0]['userTypeID']==1)
						$this->session->set_userdata('userType','admin');
					else if($result[0]['userTypeID']==2)
						$this->session->set_userdata('userType','advertiser');
					else if($result[0]['userTypeID']==3)
						$this->session->set_userdata('userType','publisher');
					echo $result[0]['userTypeID'];
				}
			}
			else
			{
				$this->layout->view('login');
			}
		}
	}
	public function getPassword(){
		$this->load->helper('string');
		$password=random_string('alnum', 8);
		return $password;
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
	public function forgotpassword(){
		$this->load->model('user');
		if($this->input->post()){
			if($this->user->isExistEmail($this->input->post("email"))){
				$user=$this->user->getUserByEmailId($this->input->post("email"));
				//print_r($user);
				$this->load->library('email');
				$this->email->clear();
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				
				$this->email->from('your@example.com', 'Your Name');
				$this->email->to($user[0]['email']);
				//$this->email->cc('another@another-example.com');
				//$this->email->bcc('them@their-example.com');
				
				$this->email->subject('Forgot password request');
				$msg="";
				$msg.="<br/>Hello ".$user[0]['userName'].",";
				$msg.="<br/><br/>Bellow are your profile details.Please check.<br/>";
				$msg.="<br/>UserName: ".$user[0]['userName'];
				$msg.="<br/>Password : ".$user[0]['password'];
				$msg.="<br/><br/> Thanks,<br/>Regards,<br/>Admin Team.";
				$this->email->message($msg);

				echo $this->email->send();

			}
			else
			{
				echo 201;
			}
		}
		else
		{
			//$this->layout->setLayout("layout/main_login");
			$this->layout->view('forgotpassword');
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
					$updated = $this->user->updateForumUser($this->session->userData('ForumUserID'),$userData);
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
				$this->layout->view('twitter_data',$data);
			}
			
		}
		else
		{
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
				$userdata=$this->user->getUserDataByID($userId);
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
					$userData=$this->user->getUserDataByID2($forumID);
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
	public function connectUser()
	{
		$id    = $this->input->post("userid");
		$email = $this->input->post("email");
		$type = $this->input->post("type");
		if($type=="Facebook")
		{
			$userdata["facebookID"] = $email;
		}
		else if($type=="Google")
		{
			$userdata["googleID"] = $email;
		}
		else if($type=="Twitter")
		{
			$userdata["twitterEmail"] = $email;
		}
		$userdata["lastLoggedInFrom"] = $type;
		$res = $this->user->connectExistingUser($id,$userdata);
		if($res)
		{
			$userdata=$this->user->getUserDataByID($id);
			$this->setUserSession($userdata,$type);
			echo 100;
		}
		else
		{
			echo 102;
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

			$updated = $this->user->updateForumUser($userID,$userData);
			if($updated)
			{
				$userData=$this->user->getUserDataByID2($userID);
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
	
	public function sendRegistrationEmail(){
		$this->load->library('email');
		$this->load->model('user');
		$user=$this->user->getUserDetails2($this->session->userdata('email'));
		$this->email->clear();
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
			
		$this->email->from('admin@socialtrafficcenter.com', 'Admin');
		$this->email->to($this->session->userdata('email'));
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
	public function setUserSession($userData,$type){
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
			$this->session->set_userdata('email',$user['userName']);
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
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */