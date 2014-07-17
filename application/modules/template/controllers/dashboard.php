<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller{
	public function __construct()
	{		
		//  Call parent Controller
		parent::__construct();
		$this->load->model('template');
		if($this->session->userdata("userType")=="advertiser")
		{
			$this->layout->setLayout("layout/advertiser");
		}
		else if($this->session->userdata("userType")=="publisher")
		{
			$this->layout->setLayout("layout/publisher");
		}
		else if($this->session->userdata("userType")=="admin")
		{
			$this->layout->setLayout("layout/admin");
		}
	}
	public function index($page=1)
	{
		
		$data['templates']=$this->template->getTemplates($this->session->userData('userID'),$page);
		$data['count']=$this->template->getTemplatesCount($this->session->userData('userID'));
    	$this->layout->view('dashboard',$data);
    }
	public function add(){
		if($this->input->post()){
			$uid=$this->session->userData('userID');
			$this->load->model("template");
			$this->input->post('name');
			$apiKey=$this->getUniqueApiKey();
			$templateData=array(
				"userID"=>$uid,
				"apiKey"=>$apiKey,
				"name"=>$this->input->post('name'),
				"createdBy"=>$uid,
				"CreatedDate"=>date('Y-m-d'),
				"htmlCreated"=>"Create"
			);	
			//print_r($templateData);
			echo $this->template->add($templateData);

		}
		else
		{
			$data[]="";
			$this->layout->view('add_template',$data);
		}
	}

	public function getUniqueApiKey(){
		$mainKey="";
		$this->load->helper('string');
		$apiKey=random_string('alnum', 40);
		if(!$this->template->IsUniqueApiKey($apiKey)){
			$mainKey=$apiKey;
		}
		else
		{
			$mainKey=$this->getUniqueApiKey();
		}
		return $mainKey;
	}

	public function delete($id){
		$this->load->model('template');
		if($id){
			$this->template->delete($id);
			$this->session->set_flashdata('message', 'Website deleted successfully!');
			redirect(base_url()."template/dashboard");
		}
		else
		{
			redirect(base_url()."template/dashboard");
		}
	}

	public function edit($id){
		if($this->input->post()){
			$this->load->model("template");
			$id=$this->input->post('id');
			$templateData=array(
				"name"=>$this->input->post('name'),
				"htmlCreated"=>"Update",
				"updatedBy"=>$id,
				"updatedDate"=>date('Y-m-d'),
			);	
			//print_r($templateData);
			echo $this->template->update($templateData,$id);

		}
		else
		{	$this->load->model('template');
			$data['template']=$this->template->getTemplate($id);
			$this->layout->view('edit_template',$data);
		}
	}

	// Create or update HTML files
	public function createHtml($templateID){
		$this->load->model('template');
		$this->load->model('blog');
		$this->load->model('article');
		$this->load->model('advertise');
		$web_path=WEBSITE_PATH;
		$uid_data=$this->template->getUserID($templateID);
		//print_r($uid_data);
		$website=array();
		if(isset($uid_data[0]['userID'])){
			$uid=$uid_data[0]['userID'];
			$website=$uid_data[0];
		}
		else
		{
			$uid=$this->session->userData('userID');
		}
		//create user folder in websites dir
		$web_path.=$uid."/";
		if (!is_dir($web_path)) {
			mkdir($web_path); 
		}
		//create template folder in user dir
		$web_path.=$templateID."/";
		if (!is_dir($web_path)) {
			mkdir($web_path);
		}
		$web_path.="html/";
		if (!is_dir($web_path)){
			mkdir($web_path);
		}
		$src=WEBSITE_PATH.'html/';
		$result=$this->directory_copy($src,$web_path);
		// Copy all required template files (css/scripts/images)
		if($result){
			echo "Required template files copied successfully.";
		}
		$blogs=array();
		$blogs=$this->blog->getTemplateBlogs($templateID);
		//print_r($blogs);
		$img_path=$web_path.'images/';
		if (!is_dir($img_path)){
			mkdir($img_path);
		}
		$src_blog_img_path=BLOG_IMAGE_PATH;
		$dst_blog_img_path=$img_path.'blogs/';
		if (!is_dir($dst_blog_img_path)){
			mkdir($dst_blog_img_path);
		}
		$src_article_img_path=ARTICLE_IMAGE_PATH;
		$dst_article_img_path=$img_path.'articles/';
		if (!is_dir($dst_article_img_path)){
			mkdir($dst_article_img_path);
		}

		$total_article=array();
		$blogs_new=array();
		foreach($blogs as $item){
			copy($src_blog_img_path.$item['image'],$dst_blog_img_path.$item['image']);
			$articles=array();
			$articles=$this->article->getBlogArticles($item['id']);
			$act=0;
			
			$act=count($articles);
			if($act>1){
				$total_article[$item['id']]=$articles;
				$src_img_path=ARTICLE_IMAGE_PATH;
				foreach($articles as $article){
					copy($src_article_img_path.$article['articleImage'],$dst_article_img_path.$article['articleImage']);
				}
			}
			$item['slug'] = url_title($item['title'], 'dash', TRUE);
			$blogs_new[]=$item;

		}
		print_r($blogs_new);
	}

	
	
	public function directory_copy($srcdir, $dstdir)
    {
		$this->load->helper('directory');
        //preparing the paths
        $srcdir=rtrim($srcdir,'/');
        $dstdir=rtrim($dstdir,'/');

        //creating the destination directory
        if(!is_dir($dstdir))mkdir($dstdir, 0777, true);

        //Mapping the directory
        $dir_map=directory_map($srcdir);

        foreach($dir_map as $object_key=>$object_value)
        {
            if(is_numeric($object_key))
                copy($srcdir.'/'.$object_value,$dstdir.'/'.$object_value);//This is a File not a directory
            else
                $this->directory_copy($srcdir.'/'.$object_key,$dstdir.'/'.$object_key);//this is a directory
        }

		return 1;
    }
}
?>