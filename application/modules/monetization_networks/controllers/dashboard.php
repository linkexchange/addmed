<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article');
		$this->load->model('monetization');
		$this->layout->setLayout('layout/normal');
	}
	public function index($page=1)
	{
		//$data["monetization"] = $this->monetization->getMonetizedData($page);
		$data["monetization"] = $this->monetization->getAllMonetizedDataonPages($page);
		$data["count"] = $this->monetization->getMonetizedDataCount();
		$this->layout->view("view_monetization",$data);	
	}
}	
?>