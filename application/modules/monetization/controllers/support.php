<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Support extends MX_Controller{
	
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
		$data["support"] = $this->monetization->getsupportData($page);
		$data["count"] = $this->monetization->getsupportDataCount();
		$this->layout->view("view_support",$data);	
	}
	public function add()
	{
		if($this->input->post())
		{
			$data = array('articleid'=>$this->input->post('articleid'),
						  'support_ratings'=>$this->input->post('support_ratings'),
						  'responsive_email'=>$this->input->post('responsive_email'),
						  'responsive_skype'=>$this->input->post('responsive_Skype'),
						  'website_reliability'=>$this->input->post('website_reliability'),
						  'created_date'=>date('Y-m-d'),
						  'created_by'=>$this->session->userdata("userID"));
			//echo "<pre>"; print_R($data); exit;			  
			$insert_id = $this->monetization->addSupportDetails($data);
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
			$data["articles"] = $this->article->getNotSupportForumArticles();
			$this->layout->view('add_support',$data);
		}
	}
	public function delete($id){
		if($id){
			$this->monetization->deleteSupport($id);
			$this->session->set_flashdata('monet', 'Record deleted successfully!');
			redirect(base_url()."monetization/support");
		}
		else
		{
			redirect(base_url()."monetization/support");
		}
	}
	
	public function edit($id){
        if($this->input->post())
		{
			$data = array('articleid'=>$this->input->post('articleid'),
						  'support_ratings'=>$this->input->post('support_ratings'),
						  'responsive_email'=>$this->input->post('responsive_email'),
						  'responsive_skype'=>$this->input->post('responsive_Skype'),
						  'website_reliability'=>$this->input->post('website_reliability'),
						  'created_date'=>date('Y-m-d'),
						  'created_by'=>$this->session->userdata("userID"));
			//echo "<pre>"; print_R($data); exit;			  
			$update = $this->monetization->updateSupportDetails($id,$data);
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
			$data["support"] = $this->monetization->getSupportDataByID($id);
			$data["articles"] = $this->article->getNotSupportForumArticles();
			$this->layout->view('edit_support',$data);
		}
	}
}	
?>