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
			redirect(base_url().$this->session->userdata('userType')."/dashboard");
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
				$this->layout->setLayout("layout/main_login");
				$this->layout->view('login');
			}
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
			$this->layout->setLayout("layout/main_login");
			$this->layout->view('forgotpassword');
		}
		
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */