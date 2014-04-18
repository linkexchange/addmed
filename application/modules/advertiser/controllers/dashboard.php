<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function index($page=1)
	{
		$this->load->model("url");

		$data['url_count']=$this->url->getUrlCount($this->session->userData('userID'));
		
		$data['publishedUrls']=$this->url->getPublishedUrls($this->session->userData('userID'),$page=1);
		$data['unPublishedUrls']=$this->url->getUnPublishedUrls($this->session->userData('userID'),$page=1);
		
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
		
		

		$this->layout->setLayout("layout/main");
		$this->layout->view('dashboard',$data);
	}
	public function getpublishedurls($page=1){
		$this->load->model("url");
		$data['publishedUrls']=$this->url->getPublishedUrls($this->session->userData('userID'),$page);
		//$this->layout->setLayout("layout/main");
		$this->load->view('dashboard_published',$data);
	}
}