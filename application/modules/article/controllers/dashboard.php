<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller{

	// view article dashboard.
	public function __construct()
	{
		parent::__construct();
		
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
		$this->load->model('article');
		$this->load->model('blog');
		$this->load->model('page');
		$this->load->model('template');
	}
	public function index($page=1){
		//echo $this->session->userData('userTypeID'); exit;
		$data['articles']=$this->article->getForumArticles($this->session->userData('userID'),$page);
		$data['count']=$this->article->getForumArticlesCount($this->session->userData('userID'));
		$this->layout->view('view_articles',$data);
	}
	
	// add article.
	public function add() {
		
		$data[]="";
		if($this->input->post())
		{
			if($_FILES["image"]) : 
				$config['upload_path'] = './uploads/forum_article_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '20000';
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload("image"))
				{
					echo $this->upload->display_errors();
				}
				else
				{
					$data['image_data'] = array('upload_data' => $this->upload->data());
					$uploaded_file=$data['image_data']['upload_data']['file_name'];
					$slug = url_title($this->input->post('articleTopic'), 'dash', TRUE);
					$articleData=array(
							"topic"=>$this->input->post('articleTopic'),
							"slug"=>$slug,
							"image"=>$uploaded_file,
							"description"=>$this->input->post('articleDescription'),
							"created_by"=>$this->session->userData('userID'),
							"created_date"=>date('Y-m-d'));
						//echo "<pre>"; print_r($articleData); echo "</pre>"; exit;
				
				$insert_id=$this->article->add_forum_article($articleData);
				if($insert_id)
				{
					$this->session->set_flashdata('edit', 'Article added successfully!');
					echo 100;
				}
				else
				{
					echo 102;
				} }	
				else :
				echo 101;
			endif;
		}
		else
		{
			$this->layout->view('add_new_article',$data);
		}	
	}
	public function comments($id)
	{
		$data['comments'] = $this->article->getAllComments($id);
		$data['replies']  = $this->article->getAllReplies($id);
		$data['name'] = $this->article->getForumArticleByID($id);
		$this->layout->view('view_comments',$data);
	}
	public function getArticles($val)
	{
		$data['articles'] = $this->article->getArticlesByName($this->session->userData('userID'),$val);
		$data['count']=$this->article->getForumArticlesCountByName($this->session->userData('userID'),$val);
		echo $this->load->view("view_ajax_articles",$data);
	}
	public function displayArticles()
	{
		$data = $this->input->post("plan");
		$this->layout->view("view_ajax_articles",$data);
	}
	// return blog details by template id.
	public function getTemplateBlogs($tempID,$bid=0,$page="ALL"){
		$data[]="";
		if($bid!=0)
			$data['cur_blog_id']=$bid;

		$this->load->model('blog');
		$data['blogs']=$this->blog->getBlogsByTemplate($this->session->userData('userID'),$tempID,$page);
		$this->layout->setLayout("layout/main");
		$this->load->view('ajax_blogs_by_template',$data);
	}

	// Delete article by id.
	public function delete($id){
		if($id){
			$this->article->deleteForumArticle($id);
			$this->session->set_flashdata('edit', 'Article deleted successfully!');
			redirect(base_url()."article/dashboard");
		}
		else
		{
			redirect(base_url()."article/dashboard");
		}
	}

	// edit article.
	public function edit($aid){
		$data[]="";
		if($this->input->post())
		{
			if(isset($_FILES["image"])) { 
			$config['upload_path'] = './uploads/forum_article_images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '20000';
			$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload("image"))
				{
					echo $this->upload->display_errors();
					exit;
				}
				else
				{
					$data['image_data'] = array('upload_data' => $this->upload->data());
					$uploaded_file=$data['image_data']['upload_data']['file_name'];
				}
			}	
				$slug = url_title($this->input->post('articleTopic'), 'dash', TRUE);
				$articleData["topic"]=$this->input->post('articleTopic');
				$articleData["slug"]=$slug;
				if(isset($uploaded_file)){
				$articleData["image"]=$uploaded_file; 
				}
				$articleData["description"]=$this->input->post('articleDescription');
				$articleData["updated_by"]=$this->session->userData('userID');
				$articleData["updated_date"]= date('Y-m-d');
				$updated_id=$this->article->updateForumArticle($articleData,$aid);
				echo 100;
						
		}
		else
		{
		
			$data['articles']=$this->article->getForumArticleDetailsByID($aid);
			$this->layout->view('edit_article',$data);
		}
	}

	// view articles by tempaltes and blogs
	public function viewbyblogs($tid=0,$bid=0,$page=1){
		$data[]="";
		if($tid==0 && $bid==0){
			$this->load->model('template');
			$this->load->model('article');
			$data['articles']=$this->article->getArticles($this->session->userData('userID'),$page);
			$data['count']=$this->article->getArticlesCount($this->session->userData('userID'));

			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");

			$this->layout->setLayout("layout/main");
			$this->layout->view('view_by_blogs',$data);
		}
		else
		{
			if($tid)
				$data['templateID']=$tid;
			if($bid)
				$data['blogID']=$bid;

			$this->load->model('article');
			$this->load->model('template');

			$data['articles']=$this->article->getArticles($this->session->userData('userID'),$page,$tid,$bid);
	
			$data['count']=$this->article->getArticlesCount($this->session->userData('userID'),$tid,$bid);

			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");

			$this->layout->setLayout("layout/main");
			$this->layout->view('view_by_blogs',$data);
		}
	}

	public function getArticlesByTemplatesAndBlog($tid=0,$bid,$page=1){
		if($tid && $bid){
			if($tid)
				$data['templateID']=$tid;
			if($bid)
				$data['blogID']=$bid;

			$this->load->model('article');
			$this->load->model('template');

			$data['articles']=$this->article->getArticles($this->session->userData('userID'),$page,$tid,$bid);
	
			$data['count']=$this->article->getArticlesCount($this->session->userData('userID'),$tid,$bid);

			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");

			$this->layout->setLayout("layout/main");
			$this->load->view('ajax_view_by_blogs',$data);
		}
	}
}
?>