<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	public function index($page=1,$startDate=0,$endDate=0){
		if($this->input->post())
		{
			$this->load->model("clicksdetail");
			//echo $this->input->post('endDate');
			//exit;
			if($this->input->post('startDate')=="" || $this->input->post('startDate')){
				if($this->input->post('endDate')<$this->input->post('startDate'))
				{
					echo "4";
					exit;
				}
			}

			if($this->input->post('startDate') && !($this->input->post('endDate'))){
				$startDate=$this->input->post('startDate');
				$endDate=0;
				$data['startDate']=$startDate;
				$data['endDate']=$endDate;
				$data['Urls']=$this->clicksdetail->getClickRecords($this->session->userdata('userID'),$startDate,$endDate,$page);
				$data['UrlCount']=$this->clicksdetail->getClickRecordsCount($this->session->userdata('userID'),$startDate,$endDate);
			}
			elseif(!($this->input->post('startDate')) && $this->input->post('endDate')){
				$startDate=0;
				$endDate=$this->input->post('endDate');
				$data['startDate']=$startDate;
				$data['endDate']=$endDate;
				$data['Urls']=$this->clicksdetail->getClickRecords($this->session->userdata('userID'),$startDate,$endDate,$page);
				$data['UrlCount']=$this->clicksdetail->getClickRecordsCount($this->session->userdata('userID'),$startDate,$endDate);
			}
			elseif($this->input->post('startDate') && $this->input->post('endDate')){
				$startDate=$this->input->post('startDate');
				$endDate=$this->input->post('endDate');
				$data['startDate']=$startDate;
				$data['endDate']=$endDate;	
				$data['Urls']=$this->clicksdetail->getClickRecords($this->session->userdata('userID'),$startDate,$endDate,$page);
				$data['UrlCount']=$this->clicksdetail->getClickRecordsCount($this->session->userdata('userID'),$startDate,$endDate);
			}
			else
			{
				$startDate=0;
				$endDate=0;
				$data['startDate']=$startDate;
				$data['endDate']=$endDate;
				$data['Urls']=$this->clicksdetail->getClickRecords($this->session->userdata('userID'),$startDate,$endDate,$page);
				$data['UrlCount']=$this->clicksdetail->getClickRecordsCount($this->session->userdata('userID'),$startDate,$endDate);
			}
			
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
			
			$this->layout->setLayout("layout/main");
			$this->layout->view('dashboard',$data);
		}
	}
	public function publisher($page=1){
		$data="";
		$this->load->model("payments");
		$data['Users']=$this->payments->getPublishers($page);
		$data['UrlCount']=$this->payments->getPublishersCount();
		$this->layout->setLayout("layout/main");
		$this->layout->view('dashboard_publisher',$data);
	}
	public function advertiser($page=1){
		$data="";
		$this->load->model("payments");
		$data['Users']=$this->payments->getAdvertiser($page);
		$data['UrlCount']=$this->payments->getAdvertiserCount();
		$this->layout->setLayout("layout/main");
		$this->layout->view('dashboard_adverstiser',$data);
	}
}
?>