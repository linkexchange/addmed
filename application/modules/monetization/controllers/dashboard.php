<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller{
	
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
			redirect(base_url().'user/login');
		}
	}
	public function index($page=1)
	{
		$data["monetization"] = $this->monetization->getMonetizedData($page);
		$data["count"] = $this->monetization->getMonetizedDataCount();
		$this->layout->view("view_monetization",$data);	
	}
	public function add()
	{
		if($this->input->post())
		{
			$data = array('network'=>$this->input->post('Network'),
						  'type_of_network'=>$this->input->post('type'),
						  'estimated_rate_of_payment'=>$this->input->post('estimate'),
						  'payments'=>$this->input->post('Payments'),
						  'sign_up_link'=>$this->input->post('Sign_Up_Link'),
						  'articleid'=>$this->input->post('articleid'),
						  'created_date'=>date('Y-m-d'));
			$insert_id = $this->monetization->addDetails($data);
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
			$data["articles"] = $this->article->getAllForumArticles2();
			$this->layout->view('add_monetization',$data);
		}
	}
	public function delete($id){
		if($id){
			$this->monetization->delete($id);
			$this->session->set_flashdata('monet', 'Record deleted successfully!');
			redirect(base_url()."monetization/dashboard");
		}
		else
		{
			redirect(base_url()."monetization/dashboard");
		}
	}
	public function edit($id){
        if($this->input->post())
		{
			$id = $this->input->post("monetid");
			$data = array('network'=>$this->input->post('Network'),
						  'type_of_network'=>$this->input->post('type'),
						  'estimated_rate_of_payment'=>$this->input->post('estimate'),
						  'payments'=>$this->input->post('Payments'),
						  'sign_up_link'=>$this->input->post('Sign_Up_Link'),
						  'articleid'=>$this->input->post('articleid'),
						  'created_date'=>date('Y-m-d'));
			$update = $this->monetization->updateDetails($id,$data);
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
			$data["monetization"] = $this->monetization->getMonetizedDataByID($id);
			$data["articles"] = $this->article->getAllForumArticles2();
			$this->layout->view('edit_monetization',$data);
		}
	}
}	
?>