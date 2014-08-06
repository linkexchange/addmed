<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("userType")=="publisher")
		{
			$this->layout->setLayout("layout/publisher");
		}
		else if($this->session->userdata("userType")=="admin")
		{
			$this->layout->setLayout("layout/admin");
		}
		if(!$this->session->userdata("userType"))
		{
			redirect(base_url().'user/login');
		}
	}
	public function index($page=1)
	{
		$this->load->model("user");
		$data['users']=$this->user->getAllUser($page);
		$data['count']=$this->user->getAllusersCount();
		$this->layout->view('users',$data);
	}
}
?>