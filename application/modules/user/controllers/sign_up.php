<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sign_up extends MX_Controller {

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
		$this->load->model("user");
			
		if($this->input->post())
		{
			if(!$this->user->isExistUser($this->input->post("userName")))
			{
				if(!$this->user->isExistEmail($this->input->post("email")))
				{

					$userData=array("userName"=>$this->input->post("userName"),
									"email"=>$this->input->post("email"),
									"phoneNumber"=>$this->input->post("phoneNumber"),
									"companyName"=>$this->input->post("companyName"),
									"password"=>$this->input->post("password"),
									"userTypeID"=>$this->input->post("userType"),
									'createdDate'=>date("Y-m-d"),
								);
					$userID = $this->user->createUser($userData);
					if($userID)
					{
						$this->session->set_userdata('userID', $userID);
						$this->session->set_userdata('userName', $this->input->post("userName"));
						$this->session->set_userdata('userTypeID',$this->input->post("userType"));
						if($this->input->post("userType")==1)
							$this->session->set_userdata('userType','admin');
						else if($this->input->post("userType")==2)
							$this->session->set_userdata('userType','advertiser');
						else if($this->input->post("userType")==3)
							$this->session->set_userdata('userType','publisher');
						echo $this->input->post("userType");  // isert successfully

						$paymentData=array(
							'userID'=>$userID,
							'createdDate'=>date("Y-m-d"),
							'createdBy'=>$userID,
						);
						$this->load->model('payments');
						$payId=$this->payments->add($paymentData);
					}
					else
					{
						echo 0; // database error
					}
				}
				else
				{
					echo 103;  //email iss already exist
				}
			}
			else
			{
				echo 102;  // username is already exist
			}
		}
		else
		{
			$data['userType']=$this->user->getUserType();
			$this->layout->setLayout("layout/main");
			$this->layout->view('sign_up',$data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */