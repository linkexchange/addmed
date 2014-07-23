<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("userType"))
		{
			redirect(base_url().'user/login');
		}
		$this->load->model('forums');
		$this->load->model("user");
		$this->load->helper('url');
		$this->layout->setLayout('layout/admin');
	}
	public function index($page=1)
	{
		$data['topics'] = $this->forums->getAllTopics($page);
		$data['count']  = $this->forums->getAllTopicsCount();
		$this->layout->view('view_forum',$data);
	}
	public function delete($id)
	{
		$this->forums->deleteTopic($id);
		$this->session->set_flashdata("msg","Topic deleted successfully");
		redirect(base_url().'forum/dashboard');
	}
	public function view($id)
	{
		$data['topic'] = $this->forums->getTopicById($id);
		$data['post']  = $this->forums->getAllPostsById($id);
		$this->layout->view('view_topic',$data);
	}
	public function users($page=1)
	{
		$data['users'] = $this->forums->getAllForumUsers($page);
		$data['count'] = $this->forums->getAllForumUsersCount();
		$this->layout->view('view_forum_users',$data);
	}
	public function spam($id)
	{
		$data = array("spam"=>"Yes");
		$result = $this->forums->spamUser($id,$data);
		if($result>0)
		{
			echo 100;
		}
		else
		{
			echo 102;
		}
	}
	public function unspam($id)
	{
		$data = array("spam"=>"No");
		$result = $this->forums->spamUser($id,$data);
		if($result>0)
		{
			echo 100;
		}
		else
		{
			echo 102;
		}
	}
	public function approve($id)
	{
		$data = array("approved"=>"1");
		$result = $this->forums->approvalTopic($id,$data);
		if($result>0)
		{
			echo 100;
		}
		else
		{
			echo 102;
		}
	}
	public function disapprove($id)
	{
		$data = array("approved"=>"0");
		$result = $this->forums->approvalTopic($id,$data);
		if($result>0)
		{
			echo 100;
		}
		else
		{
			echo 102;
		}
	}
}	
?>