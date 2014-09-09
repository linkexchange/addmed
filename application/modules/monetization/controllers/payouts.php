<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payouts extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article');
		$this->load->model('monetization');
		if($this->session->userdata('userTypeID')==1)
		{
			$this->layout->setLayout('layout/admin');
		}
		else
		{
			if($this->input->is_ajax_request()) 
			{
				echo 301; exit;
			}
			else
			{
				redirect(base_url().'user/login');
			}
		}
	}
	public function index($page=1)
	{
		$data["payouts"] = $this->monetization->getpayoutsData($page);
		$data["count"] = $this->monetization->getpayoutsDataCount();
		$this->layout->view("view_payouts",$data);	
	}
	public function add()
	{
		if($this->input->post())
		{
			//echo "<pre>"; print_R($this->input->post()); exit;
			if(is_array($this->input->post('payment_methods')))
			{
				$i = 1;
				foreach($this->input->post('payment_methods') as $value)
				{
					if($i != count($this->input->post('payment_methods')))
					{
						if(isset($payments))
						{
							$payments .= ','.$value;
						}
						else
						{
							$payments = $value; 
						}
					}
					else
					{
						if(isset($payments))
						{
							$payments .= ','.$value;
						}
						else
						{
							$payments = $value; 
						}
					}
				$i++;	
				}
			}
			else
			{
				$payments = $this->input->post('payment_methods');	
			}
			$data = array('articleid'=>$this->input->post('articleid'),
						  'ratings'=>$this->input->post('ratings'),
						  'no_of_publishers'=>$this->input->post('no_of_publishers'),
						  'diversified_earnings'=>$this->input->post('earnings'),
						  'premium_campaigns'=>$this->input->post('campaigns'),
						  'payment_methods'=>$payments,
						  'sign_ups'=>$this->input->post('sign_ups'),
						  'referral_programs'=>$this->input->post('referrals'),
						  'created_date'=>date('Y-m-d'),
						  'created_by'=>$this->session->userdata("userID"));
			//echo "<pre>"; print_R($data); exit;			  
			$insert_id = $this->monetization->addPayoutDetails($data);
			if($insert_id)
			{
				//$this->session->set_flashdata('monet','Your topic is under approval process.You can see it after approval');
				echo 100;
			}
			else
			{
				echo 102;
			}
		}
		else
		{
			$data["articles"] = $this->article->getNotPayoutsForumArticles();
			$this->layout->view('add_payouts',$data);
		}
	}
	public function delete($id){
		if($id){
			$this->monetization->deletePayouts($id);
			$this->session->set_flashdata('monet', 'Record deleted successfully!');
			redirect(base_url()."monetization/payouts");
		}
		else
		{
			redirect(base_url()."monetization/payouts");
		}
	}
	
	public function edit($id){
        if($this->input->post())
		{
			if(is_array($this->input->post('payment_methods')))
			{
				$i = 1;
				foreach($this->input->post('payment_methods') as $value)
				{
					if($i != count($this->input->post('payment_methods')))
					{
						if(isset($payments))
						{
							$payments .= ','.$value;
						}
						else
						{
							$payments = $value; 
						}
					}
					else
					{
						if(isset($payments))
						{
							$payments .= ','.$value;
						}
						else
						{
							$payments = $value; 
						}
					}
				$i++;	
				}
			}
			else
			{
				$payments = $this->input->post('payment_methods');	
			}
			$data = array('articleid'=>$this->input->post('articleid'),
						  'ratings'=>$this->input->post('ratings'),
						  'no_of_publishers'=>$this->input->post('no_of_publishers'),
						  'diversified_earnings'=>$this->input->post('earnings'),
						  'premium_campaigns'=>$this->input->post('campaigns'),
						  'payment_methods'=>$payments,
						  'sign_ups'=>$this->input->post('sign_ups'),
						  'created_date'=>date('Y-m-d'),
						  'created_by'=>$this->session->userdata("userID"));
			//echo "<pre>"; print_R($data); exit;			  
			$update = $this->monetization->updatePayoutDetails($id,$data);
			if($update)
			{
				//$this->session->set_flashdata('monet','Your topic is under approval process.You can see it after approval');
				echo 100;
			}
			else
			{
				echo 102;
			}
		}
		else
		{
			$data["payouts"] = $this->monetization->getPayoutsDataByID($id);
			$data["articles"] = $this->article->getNotPayoutsForumArticles();
			$this->layout->view('edit_payouts',$data);
		}
	}
}	
?>