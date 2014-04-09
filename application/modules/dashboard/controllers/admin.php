<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends MX_Controller {

	public function index()
	{
		$this->load->model("user");
		$data['users']=$this->user->getAllUser();
		$this->layout->setLayout("layout/main");
		$this->layout->view('admin_dashboard',$data);
	}
}