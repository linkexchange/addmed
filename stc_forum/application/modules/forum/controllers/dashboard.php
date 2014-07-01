<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function index()
	{
		$data="";
		//print_r($this->session->userData('userID'));
		$this->layout->setLayout("layout/main");
		$this->layout->view('dashboard',$data);
	}
	
}