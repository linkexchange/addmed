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
	public function index()
	{
		if($this->session->userdata("ForumUserID"))
		{
			redirect(base_url());
		}
		else
		{
			$data=array();
			if(isset($_GET['link'])){
				$url=urldecode($_GET['link']);
				$data['backUrl']=$url;
			}
			$this->layout->setLayout("layout/main_login");
			$this->layout->view('login',$data);
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
				
				$updated = $this->user->updateUser($this->session->userData('ForumUserID'),$userData);
				
				echo 1;
			}
			else
			{
				//echo $isUserExists;
				$userData=array();
				if($type=="Google"){
					$userData['googleID']=$email;
				} else if($type=="Facebook"){
					$userData['facebookID']=$email;
				}else if($type=="Twitter"){
					$userData['twitterID']=$twitterId;
					$userData['twitterEmail']=$email;
				}
				$userData['userName']=$email;
				$userData['password']=$this->getPassword();				
				$userData['createdDate']=date("Y-m-d");
				$userData['lastLoggedInOn']=date("Y-m-d");
				$userData['firstName']=$firstName;
				$userData['lastName']=$lastName;
				$userData['lastLoggedInFrom']=$type;
				
				
				$userID = $this->user->createUser($userData);
				if($userID)
				{
					$userData=$this->user->getUserDataByID($userID);
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
		foreach($userData as $user){
			$this->session->set_userdata('ForumUserID', $user['id']);
			$this->session->set_userdata('ForumUserName', $user['userName']);
			$this->session->set_userdata('ForumUserFullName',$user['firstName']." ".$user['lastName']);
			//$this->session->set_userdata('userTypeID',$user['userTypeID']);
			$this->session->set_userdata('ForumUserType',$type);
			$this->session->set_userdata('ForumLoggedIn',TRUE);
		}
					
	}

	public function checkUserByID(){
		if(isset($_POST['email']) && isset($_POST['type'])){
			$this->load->model("user");
			$userExists=$this->user->userExixts($_POST['email'],$_POST['type']); 
			if($userExists){
				$userSpam=$this->user->isUserSpam($userExists); 				if(!$userSpam){
					$userData=$this->user->getUserDataByID($userExists);
					$this->setUserSession($userData,$_POST['type']);
					$userData=array(
						"lastLoggedInOn"=>date("Y-m-d"),
						"lastLoggedInFrom"=>$_POST['type'],
					);
					$updated = $this->user->updateUser($this->session->userData('ForumUserID'),$userData);
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
			$userID=$this->user->IsValidUser($userName,$password);
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
		$user=$this->user->getUserDetails($this->session->userdata('userName'));

		$this->email->clear();
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
			
		$this->email->from('admin@socialtrafficcenter.com', 'Admin');
		$this->email->to($this->session->userdata('ForumUserName'));
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
			
		$this->email->subject('STC Registration Details. ');
		$msg="";
		$msg.="<br/>Hello ".$this->session->userdata('ForumUserFuLLName').",";
		$msg.="<br/><br/>Bellow are your profile details.Please check.<br/>";
		$msg.="<br/>UserName: ".$user[0]['userName'];
		$msg.="<br/>Password : ".$user[0]['password'];
		$msg.="<br/><br/> Thanks,<br/>Regards,<br/>Admin Team.";
		$this->email->message($msg);

		$this->email->send();
	}
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */