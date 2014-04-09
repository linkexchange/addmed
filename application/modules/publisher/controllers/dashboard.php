<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function index()
	{
		$this->load->model("url");
		$data['url_count']=$this->url->getUrlCount($this->session->userData('userID'));
		
		$data['publishedUrls']=$this->url->getPublisherUrls($this->session->userData('userID'));
		$data['unPublishedUrls']=$this->url->getUnPublishedUrls();

		$this->layout->setLayout("layout/main");
		$this->layout->view('dashboard',$data);
	}
}