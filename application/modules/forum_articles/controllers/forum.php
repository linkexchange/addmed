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
		if($this->session->userdata('userID'))
		{
			$this->layout->setLayout('layout/login');
		}
		else
		{
			$this->layout->setLayout('layout/normal');
		}
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
	public function homepage()
	{
		$data['articles'] = $this->article->getAllForumArticles2();
		$data['topics'] = $this->forums->getAllApprovedTopics2(1);
		$this->load->view('layout/final',$data);
	}
	public function add()
	{
		if(!$this->session->userdata("userID"))
		{
			redirect(base_url().'user/login');
		}
		if($this->input->post('author'))
		{
			$data = array('name'=>$this->input->post('topic'),
						  'author'=>$this->input->post('author'),
						  'email'=>$this->input->post('email'),
						  'description'=>$this->input->post('topicDescription'),
						  'approved'=>'0',
						  'created_by'=>$this->session->userdata("userID"),
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
			$data['post_description'] = $this->input->post('post_description');
			if($this->session->userdata('ForumUserFullName'))
			{
				$data['name'] = $this->session->userdata('ForumUserFullName');
			}
			else
			{
				$data['name'] = $this->session->userdata('userName');
			}
			$data['email']= $this->session->userdata('userName');
			$data['topic_id'] = $this->input->post('topicid');
			$data['created_by'] = $this->session->userdata('userID');
			$data['created_date'] = date('Y-m-d');
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
			$Followers=$this->leaderboard->getFollowersByUser($user['id']);
                        $Posts=$this->leaderboard->getPostsByUser($user['id']);
                        $Likes=$this->leaderboard->getLikesByUser($user['id']);
			//echo "<pre>"; print_r($totalFollowers); echo "</pre>"; 
			$totalFollowers=0;
			$totalPosts=0;
                        $totalLikes=0;
                        
                        $totalFollowers=$Followers[0]['smaAccountFollowers'];
			$totalPosts=$Posts[0]['smaAccountPosts'];
                        $totalLikes=$Likes[0]['smaAccountLikes'];
			
			/*foreach($publishedLinks as $item){
				$totalHits=$totalHits+$item['numberOfClicks'];
				$totalEarning=$totalEarning+$item['publisherPayment'];
			}*/
			
			$allUsers[$i]['id']=$user['id'];
			$allUsers[$i]['userName']=$user['userName'];
			$allUsers[$i]['totalFollowers']=$totalFollowers;
			$allUsers[$i]['totalPosts']=$totalPosts;
            $allUsers[$i]['totalLikes']=$totalLikes;
			$i++;
		}
		
		
		//$this->layout->view('view_topic',$data);
		$sort = array();
		foreach($allUsers as $k=>$v) {
			$sort['totalFollowers'][$k] = $v['totalFollowers'];
		}
		array_multisort($sort['totalFollowers'], SORT_DESC, $allUsers);
                //echo "<pre>"; print_r($allUsers); echo "</pre>"; exit;
		return $allUsers;
	}
}	
?>