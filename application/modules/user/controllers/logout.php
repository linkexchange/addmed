<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends MX_Controller {
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
		$this->session->unset_userdata('userName');
		$this->session->unset_userdata('userID');
		$this->session->set_userdata('userType');
		$this->session->set_userdata('email');
		if($this->session->userdata("ForumUserFullName")){
		$this->session->unset_userdata('ForumUserFullName');
		}
		if($this->session->userdata("userPic")){
		$this->session->unset_userdata('userPic');
		}
		$this->session->set_userdata('loggedIn',FALSE);
		redirect(base_url()."user/login");
	}
}