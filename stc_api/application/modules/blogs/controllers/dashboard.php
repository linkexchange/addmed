<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	
	public function __construct()
	{		
		//  Call parent Controller
		parent::__construct();
		$this->load->model('template');
		if($this->session->userdata("userType")=="publisher")
		{
			$this->layout->setLayout("layout/publisher");
		}
		else if($this->session->userdata("userType")=="admin")
		{
			$this->layout->setLayout("layout/admin");
		}
		if(!$this->session->userdata("userType"))
		{
			redirect(base_url().'user/login');
		}
	}

	public function index($templateID=0,$page=1)
	{
		$data[]="";
		$this->load->model('template');
		$this->load->model('blog');
		if($templateID!=0){
			$data['tempID']=$templateID;
			
			$data['blogs']=$this->blog->getBlogs($page,$this->session->userData('userID'),$templateID);

			$data['count']=$this->blog->getBlogsCount($this->session->userData('userID'),$templateID);

			$data['templates']=$this->template->getAllTemplates($this->session->userData('userID'));
			
		}
		else
		{
			$data['blogs']=$this->blog->getBlogs($page,$this->session->userData('userID'));

			$data['count']=$this->blog->getBlogsCount($this->session->userData('userID'));

			$data['templates']=$this->template->getAllTemplates($this->session->userData('userID'));
			
		}
        $this->layout->view('view_by_templates',$data);
    }
    
    public function addPost(){
        if($this->input->post())
		{
			//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
			if($_FILES["image"]) : 
				$config['upload_path'] = './uploads/blog_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '20000';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload("image"))
				{
					echo $this->upload->display_errors();
				}
				else
				{
					$data['image_data'] = array('upload_data' => $this->upload->data());
					$uploaded_file=$data['image_data']['upload_data']['file_name'];
					$slug = url_title($this->input->post('title'), 'dash', TRUE);
					$blogData=array(
						"title"=>$this->input->post('title'),
						"blogSlug"=>$slug,
						"description"=>$this->input->post('description'),
						"image"=>$uploaded_file,
						"templateID"=>$this->input->post('templateID'),
						"createdBy"=>$this->session->userData('userID'),
						"createdDate"=>date('Y-m-d'),
					);
					//echo "<pre>"; print_r($blogData); echo "</pre>";
					$this->load->model('blog');
					$insert_id=$this->blog->add($blogData);
					if($insert_id){
						$this->load->model("template");
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
			else :
				echo 101;
			endif;
			exit;
		}
    }
	public function add(){
		$data[]="";
		
		
			$this->load->model('template');
			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$this->layout->view('add_blog',$data);
		
		
	}
	public function delete($id){
		$this->load->model('blog');
		if($id){
			$this->blog->delete($id);
			$this->session->set_flashdata('message', 'Post deleted successfully!');
			redirect(base_url()."blogs/dashboard");
		}
		else
		{
			redirect(base_url()."blogs/dashboard");
		}
	}

	public function edit($id=0){
		if($this->input->post()){
			$this->load->model("blog");
			 //$id=$_FILES["image"]['name'];
			$blogData=array();
			$err=1;
                        $id=$this->input->post('id');
			if(isset($_FILES["image"]['name'])) : 
				$config['upload_path'] = './uploads/blog_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '100000';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload("image"))
				{
					$err=$this->upload->display_errors();
				}
				else
				{
					$data['image_data'] = array('upload_data' => $this->upload->data());
					$uploaded_file=$data['image_data']['upload_data']['file_name'];
					$blogData['image']=$uploaded_file;
					//echo "<pre>"; print_r($blogData); echo "</pre>";
				}
			endif;
			if($err==1){
				$slug = url_title($this->input->post('title'), 'dash', TRUE);
				$blogData["title"]=$this->input->post('title');
				$blogData["blogSlug"]=$slug;
				$blogData["description"]=$this->input->post('description');
				$blogData["templateID"]=$this->input->post('templateID');
				$blogData["updatedBy"]=$this->session->userData('userID');
				$blogData["updatedDate"]=date('Y-m-d');
				//echo "<pre>"; print_r($blogData); echo "</pre>";
				$this->load->model('blog');
				$updated_id=$this->blog->update($blogData,$id);
				if($updated_id){
					$this->load->model("template");
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
					echo 100;
				}
			}
			else
			{
				echo $err;
			}
			
			
		}
		else
		{	$this->load->model('template');
			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$this->load->model('blog');
			$data['blog']=$this->blog->getBlog($id);
			$this->layout->view('edit_blog',$data);
		}
	}
	
	public function viewbytemplates($templateID=0,$page=1){
		$data[]="";
		$this->load->model('template');
		$this->load->model('blog');
		if($templateID!=0){
			$data['tempID']=$templateID;
			
			$data['blogs']=$this->blog->getBlogs($this->session->userData('userID'),$page);

			$data['count']=$this->blog->getBlogsCount($this->session->userData('userID'));

			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$this->layout->view('view_by_templates',$data);
		}
		else
		{
			$data['blogs']=$this->blog->getBlogs($this->session->userData('userID'),$page);

			$data['count']=$this->blog->getBlogsCount($this->session->userData('userID'));

			$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page="All");
			$this->layout->view('view_by_templates',$data);
		}
		
	}

	public function getTemplateBlogs($tempID,$page=1){
		$data[]="";
        //$page=1;
		$this->load->model('blog');
        $data['blogs']=$this->blog->getBlogsByTemplate($page,$this->session->userData('userID'),$tempID);
		$data['count']=$this->blog->getBlogsCountByTemplate($this->session->userData('userID'),$tempID);
		$data['tempID']=$tempID;
		//echo "<pre>"; print_R($data); exit;
		$this->load->view('ajax_blogs_by_template',$data);
	}
        
       
	

}
?>