<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller {

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
	public function edit()
	{
		$this->load->model("user");
			
		if($this->input->post())
		{
			$userData=array("email"=>$this->input->post("email"),
							"phoneNumber"=>$this->input->post("phoneNumber"),
							"companyName"=>$this->input->post("companyName"),
							"address"=>$this->input->post("address"),
							"city"=>$this->input->post("city"),
							"state"=>$this->input->post("state"),
							"country"=>$this->input->post("country"),
							"zipCode"=>$this->input->post("zipCode")
							);
			$this->user->updateUser($userData,$this->uri->segment(4));
			redirect(base_url()."dashboard/admin");		
		}
		else
		{
			$result=$this->user->getUser($this->uri->segment(4));
			$data['user']=$result[0];
			$this->layout->setLayout("layout/main");
			$this->layout->view('edit_profile',$data);
		}	
	}
	public function delete($id)
	{
		$this->load->model("user");
		$this->user->deleteUser($id);
		redirect(base_url()."dashboard/admin");
	}
}