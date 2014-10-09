<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {

	
	function index()
	{

	}
	/*
	function userd to add new user
	*/
	function add_user()
	{
		
	}
	public function addemail()
	{
        $this->load->model("user");
		$data_temp = array('email'=>$this->input->post('emailid'));
        $data = array('email'=>$this->input->post('emailid'),
					  'created_date' =>date('Y-m-d'),
					  'created_by'   =>$this->session->userData('userID'));
        if($this->user->isExistemailid($data_temp))
		{
			echo 200;
		}
		else
		{
			$inserted_id = $this->user->add_Email($data);
			if($inserted_id)
			{
				echo 100;
			}
			else
			{
				echo 102;
			}	
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */