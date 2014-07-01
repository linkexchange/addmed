<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Articles extends MX_Controller{

	// view article dashboard.
	public function index($tid=0,$bid=0,$page=1){
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
	
	// add article.
	public function add(){
		$data[]="";
		$this->load->model("article");
						
		if($this->input->post())
		{
			
			// Check blog id present #start.
			if($this->input->post('blogID')) :
				// Check articleImage present #start.
				if($_FILES["articleImage"]) : 
					$config['upload_path'] = './uploads/article_images/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '100000';
					//$config['max_width']  = '1024';
					//$config['max_height']  = '768';

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload("articleImage"))
					{
						echo $this->upload->display_errors();
					}
					else
					{
						$data['image_data'] = array('upload_data' => $this->upload->data());
						$uploaded_file=$data['image_data']['upload_data']['file_name'];
						$slug = url_title($this->input->post('articleTitle'), 'dash', TRUE);
						$articleData=array(
							"articleTitle"=>$this->input->post('articleTitle'),
							"slug"=>$slug,
							"articleImage"=>$uploaded_file,
							"articleDescription"=>$this->input->post('articleDescription'),
							"blogID"=>$this->input->post('blogID'),
							"createdBy"=>$this->session->userData('userID'),
							"createdDate"=>date('Y-m-d'),
						);
						//echo "<pre>"; print_r($articleData); echo "</pre>";
						$insert_id=$this->article->add($articleData);
						if($insert_id){
							if($this->input->post('templateID')){
								$this->load->model("template");
								$tid=$this->input->post('templateID');
								$templateData=array(
									"htmlCreated"=>"Update",
									"updatedBy"=>$this->session->userData('userID'),
									"updatedDate"=>date('Y-m-d'),
								);	
								$this->template->update($templateData,$tid);
							}
							echo 100;
						}
						else
						{
							echo 102;
						}
					}
				else :
					echo 101;
				endif;
				// Check articleImage present #end.
			else :
				echo 103;
			endif;
			// Check blog id present #end.
		}
		else
		{
			$this->load->model('template');
			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");

			$this->layout->setLayout("layout/main");
			$this->layout->view('add_article',$data);
		}
	}

	// return blog details by template id.
	public function getTemplateBlogs($tempID,$bid=0,$page="ALL"){
		$data[]="";
		if($bid!=0)
			$data['cur_blog_id']=$bid;

		$this->load->model('blog');
		$data['blogs']=$this->blog->getBlogsByTemplate($this->session->userData('userID'),$tempID,$page);
		$this->layout->setLayout("layout/main");
		$this->load->view('ajax_blogs_by_template2',$data);
	}

	// Delete article by id.
	public function delete($id){
		$this->load->model('article');
		if($id){
			$this->article->delete($id);
			$this->session->set_flashdata('message', 'Gallery item deleted successfully!');
			redirect(base_url()."admin/articles");
		}
		else
		{
			redirect(base_url()."admin/articles");
		}
	}

	// edit article.
	public function edit($aid){
		$data[]="";
		if($this->input->post())
		{
			$articleData=array();
			$err=1;
			// Check blog id present #start.
			if($this->input->post('blogID')) :
				if(isset($_FILES["articleImage"]['name'])) : 
					$config['upload_path'] = './uploads/article_images/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '100000';
					//$config['max_width']  = '1024';
					//$config['max_height']  = '768';

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload("articleImage"))
					{
						$err=$this->upload->display_errors();
					}
					else
					{
						$data['image_data'] = array('upload_data' => $this->upload->data());
						$uploaded_file=$data['image_data']['upload_data']['file_name'];
						$articleData['articleImage']=$uploaded_file;
						//echo "<pre>"; print_r($blogData); echo "</pre>";
					}
				endif;
				if($err==1){
					$slug = url_title($this->input->post('articleTitle'), 'dash', TRUE);
					$articleData["articleTitle"]=$this->input->post('articleTitle');
					$articleData["slug"]=$slug;
					$articleData["articleDescription"]=$this->input->post('articleDescription');
					$articleData["blogID"]=$this->input->post('blogID');
					$articleData["updatedBy"]=$this->session->userData('userID');
					$articleData["updatedDate"]=date('Y-m-d');
					//echo "<pre>"; print_r($articleData); echo "</pre>";
					$this->load->model('article');
					$updated_id=$this->article->update($articleData,$aid);

					if($this->input->post('templateID')){
						$this->load->model("template");
						$tid=$this->input->post('templateID');
						$templateData=array(
							"htmlCreated"=>"Update",
							"updatedBy"=>$this->session->userData('userID'),
							"updatedDate"=>date('Y-m-d'),
						);	
						$this->template->update($templateData,$tid);
					}
					echo 100;
				}
				else
				{
					echo $err;
				}
			else :
				echo 103;
			endif;
			// Check blog id present #end.
			
		}
		else
		{
			$this->load->model('article');
			$data['articles']=$this->article->getArticleDetailsByID($this->session->userData('userID'),$aid);

			$this->load->model('template');
			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			
			$this->layout->setLayout("layout/main");
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