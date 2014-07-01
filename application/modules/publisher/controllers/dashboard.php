<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function index()
	{
		
		$this->load->model("url");
		$data['url_count']=$this->url->getUrlCount($this->session->userData('userID'));
		
		$data['publishedUrls']=$this->url->getPublisherUrls($this->session->userData('userID'));
		$data['unPublishedUrls']=$this->url->getUnPublishedUrls();
		$data['unpublished_url_count']=$this->url->getUnPublishedUrlsCount($this->session->userData('userID'));

		//$data['published_url_count']=count($data['publishedUrls']);
		//$data['unpublished_url_count']=count($data['unPublishedUrls']);
		
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
		$this->load->model("clicksdetail");
		$data['totalHits']=$this->clicksdetail->getTotalHits($this->session->userData('userID'));

		$this->layout->setLayout("layout/main");
		$this->layout->view('dashboard',$data);
	}
	public function getpublisherurls($page=1){
		$this->load->model("url");
		$data['publishedUrls']=$this->url->getPublisherUrls($this->session->userData('userID'),$page);
		//$this->layout->setLayout("layout/main");
		$this->load->view('dashboard_publisher',$data);
	}
	public function getunpublishedurls($page=1){
		$this->load->model("url");
		$data['unPublishedUrls']=$this->url->getUnPublishedUrls($page);
		//$this->layout->setLayout("layout/main");
		$this->load->view('dashboard_unpublished',$data);
	}
	public function settings(){
		if($this->input->post())
		{
			$this->load->model('publisher');
			//echo $this->publisher->isExists($this->session->userData('userID'));
			//exit;
			if($this->publisher->isExists($this->session->userData('userID'))){
				$user=$this->publisher->getDetails($this->session->userData('userID'));
				$pubData=array(
					'clientID'=>$this->input->post('clientID'),
					'clientSecret'=>$this->input->post('clientSecret'),
					'accessToken'=>$this->input->post('accessToken'),
					'updatedBy'=>$this->session->userData('userID')
				);
				echo $this->publisher->updatePublisher($this->session->userData('userID'),$pubData);
			}
			else
			{
				$pubData=array(
					'clientID'=>$this->input->post('clientID'),
					'clientSecret'=>$this->input->post('clientSecret'),
					'accessToken'=>$this->input->post('accessToken'),
					'updatedBy'=>$this->session->userData('userID'),
					'userID'=>$this->session->userData('userID')
				);
				echo $this->publisher->addPublisher($pubData);
			}
		}
		else
		{
			$this->load->model('publisher');
			if($this->publisher->isExists($this->session->userData('userID'))){
				$data['user']=$this->publisher->getDetails($this->session->userData('userID'));
			}
			else
			{
				$data[]="";
			}
			$this->layout->setLayout("layout/main");
			$this->layout->view('dashboard_settings',$data);
		}
		

	}
}