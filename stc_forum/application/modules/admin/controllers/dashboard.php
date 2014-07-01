<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	public function index($page=1)
	{
		$this->load->model('template');
		$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page);
		$data['count']=$this->template->getTemplatesCount($this->session->userData('userID'));
    	$this->layout->setLayout("layout/main");
		$this->layout->view('dashboard',$data);
    }
	
}
?>