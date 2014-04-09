<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function index()
	{
		$this->load->model("url");

		$data['url_count']=$this->url->getUrlCount($this->session->userData('userID'));
		
		$data['publishedUrls']=$this->url->getPublishedUrls($this->session->userData('userID'));
		$data['unPublishedUrls']=$this->url->getUnPublishedUrls($this->session->userData('userID'));
		
		$this->layout->setLayout("layout/main");
		$this->layout->view('dashboard',$data);
	}
}