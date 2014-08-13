<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("userID"))
		{
			redirect(base_url().'user/login');
		}
		$this->load->model("url");
		$this->load->model("payments");
		$this->load->model("clicksdetail");
		$this->load->model('publisher');
		$this->layout->setLayout("layout/publisher");
	}
	public function index()
	{
		$data['url_count']=$this->url->getUrlCount($this->session->userData('userID'));
		
		$data['publishedUrls']=$this->url->getPublisherUrls($this->session->userData('userID'));
		$data['unPublishedUrls']=$this->url->getUnPublishedUrls();
		$data['unpublished_url_count']=$this->url->getUnPublishedUrlsCount($this->session->userData('userID'));

		//$data['published_url_count']=count($data['publishedUrls']);
		//$data['unpublished_url_count']=count($data['unPublishedUrls']);
		
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
		$data['totalHits']=$this->clicksdetail->getTotalHits($this->session->userData('userID'));

		$this->layout->view('dashboard',$data);
	}
	public function getpublisherurls($page=1){
		
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
			if($this->publisher->isExists($this->session->userData('userID'))){
				$data['user']=$this->publisher->getDetails($this->session->userData('userID'));
			}
			else
			{
				$data[]="";
			}
			$this->layout->view('dashboard_settings',$data);
		}
		

	}
}