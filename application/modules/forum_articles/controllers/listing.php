<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article');
		$this->load->helper('url');
		if($this->session->userdata('ForumUserName'))
		{
			$this->layout->setLayout('layout/login');
		}
		else
		{
			$this->layout->setLayout('layout/normal');
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
			$data['name']  = $this->session->userdata('ForumUserFullName');
			$data['email'] = $this->session->userdata('ForumUserName');	
			$data['articleid'] = $this->input->post('articleid');	
			$data['status'] = '1';
			$data['created_date'] = date('Y-m-d');
			$insert_id=$this->article->add_Comment($data);
			if($insert_id){
				echo 100;
				//$data['comments'] = $this->article->getCommentsByID($insert_id);
				//$data['replies']  = $this->article->getRepliesByID($insert_id);
				//echo $this->load->view('ajax_description',$data);
				//redirect(base_url('forum_articles/listing/view/'.$this->input->post('articleid')),'refresh');			
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
			$data['name']  = $this->session->userdata('ForumUserFullName');
			$data['email'] = $this->session->userdata('ForumUserName');	
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
				redirect(base_url('article/'.$this->input->post('articlename').'/'.$this->input->post('articleid')),'refresh');
			} else{
				echo 102;
			}
		}
		else if($this->input->post('reply_description2'))
		{
			//echo "hi"; exit;
			$data['parent_id'] = $this->input->post('replyid');
			$data['description'] = $this->input->post('reply_description2');
			$data['name']  = $this->session->userdata('ForumUserFullName');
			$data['email'] = $this->session->userdata('ForumUserName');	
			$data['articleid'] = $this->input->post('articleid');	
			$data['status'] = '1';
			$data['created_date'] = date('Y-m-d');
			$insert_id=$this->article->add_Comment($data);
			if($insert_id){
				//$data['replies']  = $this->article->getRepliesByID($insert_id);
				//echo $this->load->view('ajax_replies',$data);
				echo 100;
				//redirect(base_url('forum_articles/listing/view/'.$this->input->post('articleid')),'refresh');			
			}
			else {
				echo 102;
			}
		}
		elseif($this->input->post('bookmark'))
		{
			$bookmarkData = array('name'=>$this->input->post('bookmark'),
								  'url'=>$this->input->post('bookmarkUrl'),
								  'articleid'=>$this->input->post('articleid'),
								  'created_by'=>$this->session->userdata("ForumUserID"),
								  'created_date'=>date('Y-m-d'));
			$insert_id=$this->article->add_Bookmark($bookmarkData);
			if($insert_id){
				$this->session->set_flashdata('msg','Bookmark has been added successfully!');
				echo 100;
			}
		}
		else
		{
			$id = $this->uri->segment(3);
			$data['article']  =	$this->article->getForumArticleByID($id);
			$data['comments'] = $this->article->getAllComments($id);
			$data['replies']  = $this->article->getAllReplies($id);
			$data["popular_articles"] = $this->article->getPopularArticles();
			$this->layout->view('description',$data);	
		}
	}
	public function getArticles($val)
	{
		$data['articles'] = $this->article->getForumArticlesByName($val);
		$data['count']=$this->article->getAllForumArticlesCountByName($val);
		echo $this->load->view("view_ajax_forum_articles",$data);
	}
	public function load($id)
	{
		$data['replies']  = $this->article->getRepliesofReplies($id);
		echo $this->load->view('ajax_replies',$data);	
	}
	public function check($id)
	{
		$num = $this->article->getBookmarksByID($id);
		if($num)
		{
			echo $num[0]['id'];
		}
		else
		{
			echo "not";
		}
	}	
	public function remove($id)
	{
		$this->article->removeBookmark($id);
		echo 100;
	}
	public function show_bookmarks()
	{
		if(!$this->session->userdata('ForumUserID'))
		{
			redirect(base_url().'user/login');
		}
		else
		{	
			$data['bookmarks'] = $this->article->getAllBookmarks();
			$data['count'] = $this->article->getAllBookmarksCount();
			$this->layout->view('view_bookmarks',$data);
		}
	}
	public function edit($id)
	{
		if(!$this->session->userdata('ForumUserID'))
		{
			redirect(base_url().'user/login');
		}
		if($this->input->post('bookmark'))
		{
			$bookmarkdata = array('name'=>$this->input->post('bookmark'),
								  'updated_date'=>date('Y-m-d'));
			$update = $this->article->updateBookmark($id,$bookmarkdata);
			if($update)
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
			$data['bookmark'] = $this->article->getBookmarkByID($id);
			$this->layout->view('edit_bookmark',$data);
		}	
	}
	public function delete($id)
	{
		$this->article->removeBookmark($id);
		$this->session->set_flashdata("del","Bookmark removed successfully");
		redirect(base_url().'bookmarks');
	}
}
?>