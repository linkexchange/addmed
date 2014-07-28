<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing extends MX_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article');
		$this->load->helper('url');
		$this->load->library('pagination');
		if($this->session->userdata('ForumUserName'))
		{
			$this->layout->setLayout('layout/login');
		}
		else
		{
			$this->layout->setLayout('layout/normal');
		}
	}
	public function index(){
		$config['base_url'] = base_url().'articles/';
		$config['per_page'] = 10;
		if($this->uri->segment(2) =='1')
			$config['start'] = 0;
                else if($this->uri->segment(2) !='' && $this->uri->segment(2)>='2')
			$config['start'] = $config['per_page']*($this->uri->segment(2)-1);
		else
			$config['start'] = 0;
		//mandatory to set uri_segment number which show current page number.
		$config['uri_segment'] = 2;
		$config['total_rows']= $this->article->getAllForumArticlesCount();
		$config['full_tag_open'] = "<ul class='pagination pagination-split m-bottom-md'>";
		$config['full_tag_close'] = "</ul>"; 
		
		$config['first_tag_open']='<li>';
		$config['first_tag_close']='</li>';
		
		$config['prev_tag_open']='<li>';
		$config['prev_tag_close']='</li>';
		$config['next_tag_open']='<li>';
		$config['next_tag_close']='</li>';
		$config['num_tag_open']='<li>';
		$config['num_tag_close']='</li>';
		$config['last_tag_open']='<li>';
		$config['last_tag_close']='</li>';
		$config['last_link_open']='</li>';
		$config['last_link_close']='</li>';
		$config['cur_tag_open']='<li class="active disabled"><a href="javascript:void(0)" >';
		$config['cur_tag_close']='</a></li>';
		// Initialize
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['articles'] = $this->article->getAllForumArticles($config['per_page'], $config['start']);
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
	public function show_bookmarks($page=1)
	{
		if(!$this->session->userdata('ForumUserID'))
		{
			redirect(base_url().'user/login');
		}
		else
		{	
			$data['bookmarks'] = $this->article->getAllBookmarks($page);
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