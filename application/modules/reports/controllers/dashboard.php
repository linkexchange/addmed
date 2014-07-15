<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("userType")=="advertiser")
		{
			$this->layout->setLayout("layout/advertiser");
		}
		else if($this->session->userdata("userType")=="publisher")
		{
			$this->layout->setLayout("layout/publisher");
		}
		else if($this->session->userdata("userType")=="admin")
		{
			$this->layout->setLayout("layout/admin");
		}
	}
	public function index($page=1,$startDate=0,$endDate=0){
		//$startDate=0;
		//$endDate=0;

		if($this->input->post())
		{
			$startDate=$this->input->post('startDate');
			$endDate=$this->input->post('endDate');
			
			$this->load->model("clicksdetail");
			if($startDate=="" || $startDate)
			{
				if($endDate<$startDate)
				{
					echo "4";
					exit;
				}
			}

			if($startDate && !($endDate))
			{
				$endDate=0;
			}
			elseif(!($startDate) && $endDate)
			{
				$startDate=0;
			}
			elseif(!$startDate && !$endDate)
			{
				$startDate=0;
				$endDate=0;
				
			}

			$data['startDate']=$startDate;
			$data['endDate']=$endDate;
			$data['Urls']=$this->clicksdetail->getClickRecords($this->session->userdata('userID'),$startDate,$endDate,$page);
			$data['UrlCount']=$this->clicksdetail->getClickRecordsCount($this->session->userdata('userID'),$startDate,$endDate);

			$this->layout->setLayout("layout/main");
			$this->load->view('dashboard_ajax_records',$data);
		}
		else
		{
			$data['startDate']=$startDate;
			$data['endDate']=$endDate;
			$this->load->model("clicksdetail");
			$data['Urls']=$this->clicksdetail->getClickRecords($this->session->userdata('userID'),$startDate,$endDate,$page);
			$data['UrlCount']=$this->clicksdetail->getClickRecordsCount($this->session->userdata('userID'),$startDate,$endDate);
			
			$this->layout->view('dashboard',$data);
		}
	}
	public function publisher($page=1){
		$data="";
		$this->load->model("payments");
		$data['Users']=$this->payments->getPublishers($page);
		$data['UrlCount']=$this->payments->getPublishersCount();
		$this->layout->view('dashboard_publisher',$data);
	}
	public function advertiser($page=1){
		$data="";
		$this->load->model("payments");
		$data['Users']=$this->payments->getAdvertiser($page);
		$data['UrlCount']=$this->payments->getAdvertiserCount();
		$this->layout->view('dashboard_adverstiser',$data);
	}
}
?>