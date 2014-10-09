<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('userID'))
		{
			$this->layout->setLayout('layout/login');
		}
		else
		{
			$this->layout->setLayout('layout/normal');
		}
	}
	public function index()
	{
		$this->layout->view("view_analytics");	
	}
}	
?>