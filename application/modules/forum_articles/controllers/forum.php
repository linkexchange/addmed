<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forum extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('forums');
		$this->load->model('article');
		$this->load->model("user");
		$this->load->model("leaderboard");
		$this->load->helper('url');
		$this->load->library('session');
		$this->layout->setLayout('layout/normal');
	}
	public function index($page=1)
	{
		if($this->input->post('userName'))
		{
			$result = $this->user->isValidForumUSer($this->input->post("userName"),$this->input->post("password"));
			if(!count($result))
			{
				echo 201;
			}
			else
			{
				$this->session->set_userdata('ForumUserID', $result[0]['id']);
				$this->session->set_userdata('ForumUserName ', $result[0]['username']);
				$this->session->set_userdata('ForumLoggedIn',TRUE);
				echo 100;
			}
		}
		else if($this->input->post('firstname'))
		{
			$userData=array("firstname"=>$this->input->post("firstname"),
							"lastname"=>$this->input->post("lastname"),
							"username"=>$this->input->post("userName2"),
							"password"=>$this->input->post("password2"),
							"email"=>$this->input->post("email"),
							"created_date"=>date("Y-m-d"));
			$userID = $this->user->createForumUser($userData);
			if($userID)
			{
				$this->session->set_userdata('ForumUserID', $userID);
				$this->session->set_userdata('ForumUserName ', $this->input->post("userName2"));
				$this->session->set_userdata('ForumLoggedIn',TRUE);
				echo 100;	
			}
			else
			{
				echo 0; // database error
			}
		}
		else
		{
			$data['users']=$this->getTopLeadUsers();
			$data['topics'] = $this->forums->getAllApprovedTopics($page);
			$data['tcount'] = $this->forums->getAllApprovedTopicsCount();
			$data['articles'] = $this->article->getAllForumArticles($page);
			$data['count'] = $this->article->getAllForumArticlesCount();
			$this->layout->view('view_forum',$data);
		}	
	}
	public function add()
	{
		if($this->input->post('author'))
		{
			$data = array('name'=>$this->input->post('topic'),
						  'author'=>$this->input->post('author'),
						  'email'=>$this->input->post('email'),
						  'description'=>$this->input->post('topicDescription'),
						  'approved'=>'0',
						  'created_by'=>$this->session->userdata("ForumUserID"),
						  'created_date'=>date('Y-m-d'));
			$insert_id = $this->forums->addTopic($data);
			if($insert_id)
			{
				$this->session->set_flashdata('topicmsg','Your topic is under approval process.You can see it after approval');
				echo 100;
			}
			else
			{
				echo 102;
			}
		}
		else
		{
			$this->layout->view('add_topic');
		}
	}
	public function view()
	{
		if($this->input->post('post_description'))
		{
			$data = array('post_description'=>$this->input->post('post_description'),
						  'name'=>$this->session->userdata('ForumUserFullName'),
						  'email'=>$this->session->userdata('ForumUserName'),
						  'topic_id'=>$this->input->post('topicid'),
						  'created_date'=>date('Y-m-d'));
			$this->forums->addPostCount($this->input->post('topicid'));	
			$insert_id = $this->forums->addPost($data);
			if($insert_id)
			{
				echo 100;
			}
			else
			{
				echo 102;
			}
		}
		else
		{
			$id = $this->uri->segment(3);
			$data['topic'] = $this->forums->getTopicById($id);
			$data['post']  = $this->forums->getAllPostsById($id);
			$this->layout->view('view_topic',$data);
		}	
	}
	public function view_forum($page=1)
	{
		$data['topics'] = $this->forums->getAllApprovedTopics($page);
		$data['tcount'] = $this->forums->getAllApprovedTopicsCount();
		$this->layout->view('forum_topics',$data);
	}
	public function getTopLeadUsers($limit=10){
		$users=$this->leaderboard->getTopUsers($limit);
		$allUsers=array();
		//echo "<pre>"; print_r($users); echo "</pre>";
		$i=0;
		foreach($users as $user){
			$publishedLinks=$this->leaderboard->getPublishedLinks($user['id']);
			//echo "<pre>"; print_r($publishedLinks); echo "</pre>";
			$totalHits=0;
			$totalEarning=0;
			
			foreach($publishedLinks as $item){
				$totalHits=$totalHits+$item['numberOfClicks'];
				$totalEarning=$totalEarning+$item['publisherPayment'];
			}
			
			$allUsers[$i]['id']=$user['id'];
			$allUsers[$i]['userName']=$user['userName'];
			$allUsers[$i]['totalHits']=$totalHits;
			$allUsers[$i]['totalEarning']=$totalEarning;
			$i++;
		}
		//echo "<pre>"; print_r($allUsers); echo "</pre>";
		
		//$this->layout->view('view_topic',$data);
		$sort = array();
		foreach($allUsers as $k=>$v) {
			$sort['totalHits'][$k] = $v['totalHits'];
		}
		array_multisort($sort['totalHits'], SORT_DESC, $allUsers);
		return $allUsers;
	}
}	
?>