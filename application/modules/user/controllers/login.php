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
		if($this->input->post())
		{
			$this->load->model("user");
			$result = $this->user->isValidUSer($this->input->post("userName"),$this->input->post("password"));
			//print_r($result);
			if(!count($result))
			{
				echo 2;
			}
			else
			{
				$this->session->set_userdata('userID', $result[0]['id']);
				$this->session->set_userdata('userName', $result[0]['userName']);
				echo 1;
			}
		}
		else
		{
			$this->layout->setLayout("layout/main");
			$this->layout->view('login');
		}
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */