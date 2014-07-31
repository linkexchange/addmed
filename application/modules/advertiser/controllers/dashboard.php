<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function __construct()
	{
		if(!$this->session->userdata("userID"))
		{
			redirect(base_url().'user/login');
		}
	}
	public function index($page=1)
	{
		$this->load->model("url");

		$data['url_count']=$this->url->getUrlCount($this->session->userData('userID'));
		
		$data['publishedUrls']=$this->url->getPublishedUrls($this->session->userData('userID'),$page);
		$data['unPublishedUrls']=$this->url->getUnPublishedUrls($page=1,$this->session->userData('userID'));
		
		$data['pubUrlCount']=$this->url->getPublishedUrlsCount($this->session->userData('userID'));
		$data['unPubUrlCount']=$this->url->getUnPublishedUrlsCount($this->session->userData('userID'));
		$this->load->model("payments");
		$data['totalPaidPayment']=$this->payments->getTotalPaidByAdvertiser($this->session->userData('userID'));
		$paymentDetails=$this->payments->getTotalPaymentRemainingByAdvertiser($this->session->userData('userID'));
		foreach($paymentDetails as $item)
		{
			if($item['billableAmount']>=$item['paidAmount']){
				$data['TotalRamainingPayment']=$item['billableAmount']-$item['paidAmount'];
			}
			else
			{
				$data['TotalRamainingPayment']=0;
			}
		}
		
		

		$this->layout->setLayout("layout/advertiser");
		$this->layout->view('dashboard',$data);
	}
	public function getPublishedurls($page=1){
		$this->load->model("url");
                $data['currentPage']=$page;
		$data['publishedUrls']=$this->url->getPublishedUrls($this->session->userData('userID'),$page);
                $data['pubUrlCount']=$this->url->getPublishedUrlsCount($this->session->userData('userID'));
		//$this->layout->setLayout("layout/main");
		$this->load->view('view_published_link',$data);
	}
        public function getUnpublishedurls($page=1){
		$this->load->model("url");
                $data['currentPage']=$page;
		$data['unPublishedUrls']=$this->url->getUnPublishedUrls($page,$this->session->userData('userID'));
                $data['unPubUrlCount']=$this->url->getUnPublishedUrlsCount($this->session->userData('userID'));
		//$this->layout->setLayout("layout/main");
		$this->load->view('view_unpublished_link',$data);
	}
}