<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("userType")=="publisher")
		{
			$this->layout->setLayout("layout/publisher");
		}
		else if($this->session->userdata("userType")=="admin")
		{
			$this->layout->setLayout("layout/admin");
		}
		if(!$this->session->userdata("userType"))
		{
			redirect(base_url().'user/login');
		}
		$this->load->model("user");
		$this->load->model("url");
		$this->load->model("payments");
		$this->load->model('clicksdetail');
	}
	public function index()
	{
		$data['users']=$this->user->getAllUser();
		$data['count']=$this->user->getAllUsersCount();
		
		$data['totalLinks']=$this->url->getTotalLinks();
		$data['publishedLinks']=$this->url->getTotalPublishedLinks();
		
		$data['totalPaidPayment']=$this->payments->getTotalPaidPayment();
		$data['totalPayingPayment']=$this->payments->getTotalPayingPayment();
		
		$this->layout->setLayout("layout/admin");
		$this->layout->view('dashboard',$data);
	}
	public function user($page=1)
	{
		$data['users']=$this->user->getUsers($page);
		$data['count']=$this->user->getAllusersCount();
		$this->layout->view('users',$data);
	}
	public function cronrun(){
			$data="";
		
		$links=$this->url->getAllBitlyUrllinks();
		//echo "<pre>"; print_r($links); echo "</pre>";
		$adminPer=10;
		$pubPer=100-$adminPer;
		$createdBy="3";
		
		foreach($links as $link) :
			if($link['billyUrl'] && $link['accessToken']) :
				$bitly_url=urlencode($link['billyUrl']);
				$bitly_accessToken=$link['accessToken'];
				$bitly_response = json_decode(file_get_contents("https://api-ssl.bitly.com/v3/link/clicks?access_token={$bitly_accessToken}&link={$bitly_url}"));
				$link_clicks=$bitly_response->data->link_clicks;
				$pastClicks=$this->clicksdetail->getTotalHitsByLinkIdNew($link['id']);
				$curClicks=0;
				$totalClicks=0;
				$advertiserPaymen=0;
				$publisherPayment=0;
				$adminPayment=0;
				if($pastClicks==0 && $link_clicks>0)
				{	
					$curClicks=$link_clicks;
					$totalClicks=$link_clicks;
				}
				else
				{
					if($link_clicks==$pastClicks)
					{
						$curClicks=0;
						$totalClicks=$link_clicks;
					}
					else
					{
						$curClicks=$link_clicks-$pastClicks;
						$totalClicks=$link_clicks;
					}
						
				}
				
				$advertiserPayment=$curClicks*$link['payPerLink'];
				$publisherPayment=($advertiserPayment*$pubPer)/100;
				$adminPayment=($advertiserPayment*$adminPer)/100;
				$createdDate=date("Y-m-d");
				
				if(!$this->clicksdetail->isExists($link['id'],$createdDate) && $curClicks)
				{
					$clickDetails=array(
						'linkID'=>$link['id'],
						'numberOfClicks'=>$curClicks,
						'advertiserPaynment'=>$advertiserPayment,
						'publisherPayment'=>$publisherPayment,
						'commission'=>$adminPayment,
						'createdBy'=>$createdBy,
						'createdDate'=>$createdDate
					);
					echo $result=$this->clicksdetail->add($clickDetails);
				}
			endif;
		endforeach;
		
		$publishers=$this->user->getAllPublishersID();
		//echo "<pre>"; print_r($publishers); echo "</pre>";
		foreach($publishers as $user) : 
			$totalpayments=$this->clicksdetail->getClickedLinksByUserID($user['id']);
			$payPayments=$this->payments->getPaymentDetails($user['id']);
			//echo "<pre>"; print_r($totalpayments); echo "</pre>";
			//echo "<pre>"; print_r($payPayments); echo "</pre>";
			$billableAmt=$totalpayments[0]['publisherPayment'];
			$balanceAmt=$billableAmt-$payPayments[0]['paidAmount'];
			$paidAmt=$payPayments[0]['paidAmount'];
			$paymentsData=array(
				'paidAmount'=>$paidAmt,
				'billableAmount'=>$billableAmt,
				'balanceAmount'=>$balanceAmt,
				'updatedBy'=>'3',
				'updatedDate'=>date("Y-m-d"),
			);
			echo $this->payments->updateBalance($paymentsData,$payPayments[0]['userID']);
		endforeach;
		
		$totalpayments="";
		$billableAmt=0;$balanceAmt=0;
		$advertisers=$this->user->getAllAdvertisersID();
		//echo "<pre>"; print_r($advertisers); echo "</pre>";
		foreach($advertisers as $user) :
			$totalpayments=$this->clicksdetail->getClickedLinksByUserID($user['id'],$adv=1);
			$payPayments=$this->payments->getPaymentDetails($user['id']);
			//echo "<pre>"; print_r($totalpayments); echo "</pre>";
			//echo "<pre>"; print_r($payPayments); echo "</pre>";
			if($totalpayments[0]['advertiserPaynment']) : 
				//update payments for the user.
				$billableAmt=$totalpayments[0]['advertiserPaynment'];
				$balanceAmt=$payPayments[0]['paidAmount']-$billableAmt;
				if($balanceAmt<0)
					$balanceAmt=0;
				$paymentsData=array(
					'billableAmount'=>$billableAmt,
					'balanceAmount'=>$balanceAmt,
					'updatedBy'=>'3',
					'updatedDate'=>date("Y-m-d"),
				);
				echo $this->payments->updateBalance($paymentsData,$payPayments[0]['userID']);
			else :
				//Don't have clicked links for user(i.e.advertiserPaynment=NULL) then proced to next record
				continue;
			endif;
		endforeach;

		$this->layout->setLayout("layout/main");
		$this->layout->view('dashboard_cronrun',$data);
		
	}
	public function settings(){
		if($this->input->post())
		{
			$this->load->model('publisher');
			//echo $this->publisher->isExists($this->session->userData('userID'));
			//exit;
			$createdDate=date("Y-m-d");
			$updatedDate=date("Y-m-d");
			$createdBy=$this->session->userData('userID');
			$updatedBy=$this->session->userData('userID');
			if($this->publisher->isExists($this->session->userData('userID'))){
				$user=$this->publisher->getDetails($this->session->userData('userID'));
				$pubData=array(
					'clientID'=>$this->input->post('clientID'),
					'clientSecret'=>$this->input->post('clientSecret'),
					'accessToken'=>$this->input->post('accessToken'),
					'updatedBy'=>$updatedBy,
					'updatedDate'=>$updatedDate
				);
				echo $this->publisher->updatePublisher($this->session->userData('userID'),$pubData);
			}
			else
			{
				
				$pubData=array(
					'clientID'=>$this->input->post('clientID'),
					'clientSecret'=>$this->input->post('clientSecret'),
					'accessToken'=>$this->input->post('accessToken'),
					'userID'=>$this->session->userData('userID'),
					'createdBy'=>$createdBy,
					'createdDate'=>$createdDate
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
			$this->layout->view('dashboard_settings',$data);
		}
		

	}
}