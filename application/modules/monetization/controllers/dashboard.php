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
			$data["articles"] = $this->article->getNotMonetizedForumArticles();
			$this->layout->view('add_monetization',$data);
		}
	}
	public function addContents()
	{
		if($this->input->post())
		{
			$data = array("articleid"=>$this->input->post("articleid"),
						  "ratings"=>$this->input->post("ratings"),
						  "no_of_articles"=>$this->input->post("no_of_articles"),
						  "content_requests"=>$this->input->post("requests"),
						  "article_quality"=>$this->input->post("quality"),
						  "new_contents"=>$this->input->post("new_contents"),
						  "target_audience"=>$this->input->post("target_audience"),
						  "contact_email"=>$this->input->post("contact_email"),
						  "created_by"=>$this->session->userdata("userID"),
						  "created_date"=>date('Y-m-d'));
			//echo "<pre>"; print_R($data); exit;			  
			$insert_id = $this->monetization->addContents($data);
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
			$data["articles"] = $this->article->getNotContentsArticles();
			$this->layout->view('add_contents',$data);
		}
	}
	public function addEaseOfUse()
	{
		if($this->input->post())
		{
			$data = array("articleid"=>$this->input->post("articleid"),
						  "dashboard"=>$this->input->post("dashboard"),
						  "custom_shortner"=>$this->input->post("shortner"),
						  "analytics"=>$this->input->post("analytics"),
						  "page_load_time"=>$this->input->post("page_load_time"),
						  "page_views_per_visit"=>$this->input->post("page_view_per_visit"),
						  "daily_time_on_site"=>$this->input->post("daily_time_on_site"),
						  "bounce_rate"=>$this->input->post("bounce_rate"),
						  "facebook_url"=>$this->input->post("facebook"),
						  "twitter_url"=>$this->input->post("twitter"),
						  "google_url"=>$this->input->post("google"),
						  "pinterest_url"=>$this->input->post("pinterest"),
						  "instagram_url"=>$this->input->post("instagram"),
						  "created_by"=>$this->session->userdata("userID"),
						  "created_date"=>date('Y-m-d'));
			//echo "<pre>"; print_R($data); exit;			  
			$insert_id = $this->monetization->addEaseOfUseDetails($data);
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
			$data["articles"] = $this->article->getNotEaseOfUseArticles();
			$this->layout->view('add_ease_of_use',$data);
		}
	}
	public function contents($page=1)
	{
		$data["contents"] = $this->monetization->getContentsData($page);
		$data["count"] = $this->monetization->getContentsDataCount();
		$this->layout->view("view_contents",$data);	
	}
	public function EaseOfUse($page=1)
	{
		$data["EaseOfUse"] = $this->monetization->getEaseOfUseData($page);
		$data["count"] = $this->monetization->getEaseOfUseDataCount();
		$this->layout->view("view_ease_of_use",$data);	
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
	public function deleteContents($id){
		if($id){
			$this->monetization->deleteContents($id);
			$this->session->set_flashdata('monet', 'Record deleted successfully!');
			redirect(base_url()."monetization/dashboard/contents");
		}
		else
		{
			redirect(base_url()."monetization/dashboard/contents");
		}
	}
	public function deleteEaseOfUse($id){
		if($id){
			$del = $this->monetization->deleteEaseOfUse($id);
			if($del)
			{
				$this->session->set_flashdata('monet', 'Record deleted successfully!');
			}
			else
			{
				$this->session->set_flashdata('monet_error', 'Database server is not working!');
			}
			redirect(base_url()."monetization/dashboard/easeOfUse");
		}
		else
		{
			redirect(base_url()."monetization/dashboard/easeOfUse");
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
	public function editContents($id){
        if($this->input->post())
		{
			$data = array("articleid"=>$this->input->post("articleid"),
						  "ratings"=>$this->input->post("ratings"),
						  "no_of_articles"=>$this->input->post("no_of_articles"),
						  "content_requests"=>$this->input->post("requests"),
						  "article_quality"=>$this->input->post("quality"),
						  "new_contents"=>$this->input->post("new_contents"),
						  "target_audience"=>$this->input->post("target_audience"),
						  "contact_email"=>$this->input->post("contact_email"),
						  "updated_by"=>$this->session->userdata("userID"),
						  "updated_date"=>date('Y-m-d'));
			$update = $this->monetization->updateContents($id,$data);
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
			$data["contents"] = $this->monetization->getContentsByID($id);
			$data["articles"] = $this->article->getNotContentsArticles();
			$this->layout->view('edit_contents',$data);
		}
	}
	public function editEaseOfUse($id){
        if($this->input->post())
		{
			$data = array("articleid"=>$this->input->post("articleid"),
						  "dashboard"=>$this->input->post("dashboard"),
						  "custom_shortner"=>$this->input->post("shortner"),
						  "analytics"=>$this->input->post("analytics"),
						  "page_load_time"=>$this->input->post("page_load_time"),
						  "page_views_per_visit"=>$this->input->post("page_view_per_visit"),
						  "daily_time_on_site"=>$this->input->post("daily_time_on_site"),
						  "bounce_rate"=>$this->input->post("bounce_rate"),
						  "facebook_url"=>$this->input->post("facebook"),
						  "twitter_url"=>$this->input->post("twitter"),
						  "google_url"=>$this->input->post("google"),
						  "pinterest_url"=>$this->input->post("pinterest"),
						  "instagram_url"=>$this->input->post("instagram"),
						  "updated_by"=>$this->session->userdata("userID"),
						  "updated_date"=>date('Y-m-d'));
			$update = $this->monetization->updateEaseofUseDetails($id,$data);
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
			$data["easeofuse"] = $this->monetization->getEaseOfUseDataByID($id);
			$data["articles"] = $this->article->getNotEaseOfUseArticles();
			$this->layout->view('edit_ease_of_use',$data);
		}
	}
}	
?>