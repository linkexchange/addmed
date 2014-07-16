<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Details extends MX_Controller {
	public function index(){
	}
	public function getLinkAmount($id)
	{
		$this->load->model("clicksdetail");
		$data['amount']=$this->clicksdetail->getClicksdetailsById($id);
				//$this->layout->setLayout("layout/main");
		$this->load->view('payment_link_amount',$data);
	}
	
}
?>