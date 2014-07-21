<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('template');
		$this->load->model('page');
		$this->load->model('blog');
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
	}
	public function index($templateID=0,$page=1)
	{
		$data[]="";
		if($templateID!=0){
			$data['tempID']=$templateID;
			$data['pages']=$this->page->getPages($this->session->userData('userID'),$page,$templateID);
			
			$data['count']=$this->page->getpagesCount($this->session->userData('userID'),$templateID);
			
			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$this->layout->view('view_by_templates',$data);
		}
		else
		{

			$data['pages']=$this->page->getpages($this->session->userData('userID'),$page);
			
			$data['count']=$this->page->getpagesCount($this->session->userData('userID'));

			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$this->layout->view('view_by_templates',$data);
		}
    }
	public function add() {
			
		$data[]="";
		if($this->input->post())
		{
			//echo $this->input->post('description'); exit;
			$slug = url_title($this->input->post('title'), 'dash', TRUE);
			$pageData=array(
					"title"=>$this->input->post('title'),
					"page_slug"=>$slug,
					"description"=>$this->input->post('description'),
					"templateID"=>$this->input->post('templateID'),
					"createdBy"=>$this->session->userData('userID'),
					"createdDate"=>date('Y-m-d'));
				//echo "<pre>"; print_r($pageData); echo "</pre>";
				
				$insert_id=$this->page->add($pageData);
				if($insert_id)
				{
					$tid=$this->input->post('templateID');
					$templateData=array(
						"htmlCreated"=>"Update",
						"updatedBy"=>$this->session->userData('userID'),
						"updatedDate"=>date('Y-m-d'),
					);	
					$this->template->update($templateData,$tid);
					echo 100;
				}
				else
				{
					echo 102;
				}
		}
		else
		{
			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$this->layout->view('add_page',$data);
		}	
	}
	public function edit($id){
		if($this->input->post()){
			$pageData=array();
			$err=1;
			if($err==1){
				$slug = url_title($this->input->post('title'), 'dash', TRUE);
				$pageData["title"]=$this->input->post('title');
				$pageData["page_slug"]=$slug;
				$pageData["description"]=$this->input->post('description');
				$pageData["templateID"]=$this->input->post('templateID');
				$pageData["updatedBy"]=$this->session->userData('userID');
				$pageData["updatedDate"]=date('Y-m-d');
				//echo "<pre>"; print_r($pageData); echo "</pre>";
				$updated_id=$this->page->update($pageData,$id);
				if($updated_id){
					$tid=$this->input->post('templateID');
					$templateData=array(
						"htmlCreated"=>"Update",
						"updatedBy"=>$this->session->userData('userID'),
						"updatedDate"=>date('Y-m-d'));	
					$this->template->update($templateData,$tid);
					echo 100;
				}
				else
				{
					echo 100;
				}
			}
			else
			{
				echo $err;
			}
		}
		else
		{	
			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$data['page']=$this->page->getPage($id);
			$this->layout->view('edit_page',$data);
		}
	}
	public function getTemplatePages($tempID,$page=1){
		$data[]="";
		$data['pages']=$this->page->getpagesByTemplate($this->session->userData('userID'),$tempID,$page);
		$data['count']=$this->page->getpagesCountByTemplate($this->session->userData('userID'),$tempID);
		//echo "<pre>"; print_r($data['pages']); echo "<pre/>"; exit;
		$data['tempID']=$tempID;
		$this->load->view('ajax_pages_by_template',$data);
	}
	public function delete($id){
		if($id){
			$this->page->delete($id);
			$this->session->set_flashdata('message', 'Page deleted successfully!');
			redirect(base_url()."pages/dashboard");
		}
		else
		{
			redirect(base_url()."pages/dashboard");
		}
	}
}