<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MX_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('template');
		$this->load->model('page');
		$this->load->model('blog');
		$this->layout->setLayout("layout/main");
	}
	public function index($templateID=0,$page=1)
	{
		$data[]="";
		if($templateID!=0){
			$data['tempID']=$templateID;
			$data['pages']=$this->page->getPages($this->session->userData('userID'),$page,$templateID);
			
			$data['count']=$this->page->getpagesCount($this->session->userData('userID'),$templateID);

			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$this->layout->view('view_pages_by_templates',$data);
		}
		else
		{
			$data['pages']=$this->page->getpages($this->session->userData('userID'),$page);

			$data['count']=$this->page->getpagesCount($this->session->userData('userID'));

			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$this->layout->setLayout("layout/main");
			$this->layout->view('view_pages_by_templates',$data);
		}
    }
	public function add() {
		
		$data[]="";
		if($this->input->post())
		{
			$slug = url_title($this->input->post('title'), 'dash', TRUE);
			$pageData=array(
					"title"=>$this->input->post('title'),
					"page_slug"=>$slug,
					"description"=>$this->input->post('description'),
					"templateID"=>$this->input->post('templateID'),
					"createdBy"=>$this->session->userData('userID'),
					"createdDate"=>date('Y-m-d'));
				//echo "<pre>"; print_r($pageData); echo "</pre>"; exit;
				
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
		$data['tempID']=$tempID;
		$this->load->view('ajax_pages_by_template',$data);
	}
	public function delete($id){
		if($id){
			$this->page->delete($id);
			$this->session->set_flashdata('message', 'Page deleted successfully!');
			redirect(base_url()."admin/pages");
		}
		else
		{
			redirect(base_url()."admin/pages");
		}
	}
}