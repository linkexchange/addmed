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
		if($this->session->userdata("userID"))
		{
			redirect(base_url()."forum/dashboard");
		}
		else
		{
			$this->layout->setLayout("layout/main_login");
			$this->layout->view('login');
		}
	}

	public function setUserData(){
		if($this->input->post()){
			$this->load->model("user");
			$firstName=$this->input->post('firstName');
			$lastName=$this->input->post('lastName');
			$email=$this->input->post('email');
			$type=$this->input->post('type');
			$isUserExists=$this->user->isUserExixts($email,$type);
			
			if($isUserExists){
				$userData=$this->user->getUserDataByEmail($email,$type);
				$this->setUserSession($userData);
				$userData=array(
					"lastLoggedInOn"=>date("Y-m-d"),
				);
				$updated = $this->user->updateUser($this->session->userData('userID'),$userData);
				echo 1;
			}
			else
			{
				//echo $isUserExists;
				$userData=array(
					"email"=>$email,
					"userTypeID"=>$type,
					"createdDate"=>date("Y-m-d"),
					"lastLoggedInOn"=>date("Y-m-d"),
					"firstName"=>$firstName,
					"lastName"=>$lastName,
				);
				$userID = $this->user->createUser($userData);
				if($userID)
				{
					$userData=$this->user->getUserDataByID($userID);
					$this->setUserSession($userData);
					echo 1;
				}
			}
			
		}
		else
		{
			echo 0;
		}
	}

	public function setUserSession($userData){
		foreach($userData as $user){
			$this->session->set_userdata('userID', $user['id']);
			$this->session->set_userdata('Name',$user['firstName']." ".$user['lastName']);
			$this->session->set_userdata('userTypeID',$user['userTypeID']);
			$this->session->set_userdata('userType',$user['type']);
			$this->session->set_userdata('loggedIn',TRUE);
		}
					
	}
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */