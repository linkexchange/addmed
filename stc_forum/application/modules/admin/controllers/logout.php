<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends MX_Controller {
	public function index()
	{
		$this->session->unset_userdata('userName');
		$this->session->unset_userdata('userID');
		$this->session->unset_userdata('userType');
		$this->session->unset_userdata('loggedIn');
		redirect(base_url().'admin/login');
	}
}