<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article');
		if($this->session->userdata("userType")=="publisher")
		{
			$this->layout->setLayout("layout/publisher");
		}
		else if($this->session->userdata("userType")=="admin")
		{
			$this->layout->setLayout("layout/admin");
		}
		if(!$this->session->userdata("userID"))
		{
			redirect(base_url().'user/login');
		}
	}
	public function index($page=1){
		$data['articles'] = $this->article->getAllForumArticles($page);
		$data['count'] = $this->article->getAllForumArticlesCount();
		$this->layout->view('view_forum_articles',$data);
	}
	public function view($id){
		if($this->input->post('comment_description'))
		{
			$data['description'] = $this->input->post('comment_description');
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');	
			$data['articleid'] = $this->input->post('articleid');	
			$data['status'] = '1';
			$data['created_date'] = date('Y-m-d');
			$insert_id=$this->article->add_Comment($data);
			if($insert_id){
				//echo 100;
				$data['comments'] = $this->article->getCommentsByID($insert_id);
				$data['replies']  = $this->article->getRepliesByID($insert_id);
				echo $this->load->view('ajax_description',$data);
			}
			else {
				echo 102;
			}
		}
		else if($this->input->post('reply_description'))
		{
			//echo "hi"; exit;
			$data['parent_id'] = $this->input->post('commentid');
			$data['description'] = $this->input->post('reply_description');
			$data['name'] = $this->input->post('name2');
			$data['email'] = $this->input->post('email2');	
			$data['articleid'] = $this->input->post('articleid');	
			$data['status'] = '1';
			$data['created_date'] = date('Y-m-d');
			$commentData['replied'] = '1';
			$this->article->update_Comment($this->input->post('commentid'),$commentData);
			$insert_id=$this->article->add_Comment($data);
			if($insert_id){
				//$data['replies']  = $this->article->getRepliesByID($insert_id);
				//echo $this->load->view('ajax_reply',$data);
				//echo 100;
				redirect(base_url('article/listing/view/'.$this->input->post('articleid')),'refresh');
			} else{
				echo 102;
			}
		}
		else if($this->input->post('reply_description2'))
		{
			//echo "hi"; exit;
			$data['parent_id'] = $this->input->post('replyid');
			$data['description'] = $this->input->post('reply_description2');
			$data['name'] = $this->input->post('name3');
			$data['email'] = $this->input->post('email3');	
			$data['articleid'] = $this->input->post('articleid');	
			$data['status'] = '1';
			$data['created_date'] = date('Y-m-d');
			$insert_id=$this->article->add_Comment($data);
			if($insert_id){
				//$data['replies']  = $this->article->getRepliesByID($insert_id);
				//echo $this->load->view('ajax_replies',$data);
				//echo 100;
				redirect(base_url('article/listing/view/'.$this->input->post('articleid')),'refresh');			
			}
			else {
				echo 102;
			}
		}
		else
		{
			$data['article']  =	$this->article->getForumArticleByID($id);
			$data['comments'] = $this->article->getAllComments($id);
			$data['replies']  = $this->article->getAllReplies($id);
			$data["popular_articles"] = $this->article->getPopularArticles();
			$this->layout->view('description',$data);	
		}
	}
	public function load($id)
	{
		$data['replies']  = $this->article->getRepliesofReplies($id);
		echo $this->load->view('ajax_replies',$data);	
	}	
	
}
?>