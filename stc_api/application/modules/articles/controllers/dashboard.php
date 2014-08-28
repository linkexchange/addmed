<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('template');
		$this->load->model('article');
		if($this->session->userdata("userType")=="admin")
		{
			$this->layout->setLayout("layout/admin");
		}
		else if($this->session->userdata("userType")=="publisher")
		{
			$this->layout->setLayout("layout/publisher");
		}
		if(!$this->session->userdata("userType"))
		{
			redirect(base_url().'user/login');
		}
	}
	// view article dashboard.
	public function index($tid=0,$bid=0,$page=1){
		$data[]="";
		if($tid==0 && $bid==0){
			$data['articles']=$this->article->getArticles($this->session->userData('userID'),$page);
			$data['count']=$this->article->getArticlesCount($this->session->userData('userID'));

			$data['templates']=$this->template->getAllTemplates($this->session->userData('userID'));

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

			$data['templates']=$this->template->getAllTemplates($this->session->userData('userID'));

			$this->layout->view('view_by_blogs',$data);
		}
	}
	

 
        // add multiple gallery items
        public function addMultipleItems($tid=0,$bid=0,$page="ALL"){
            $msg="";
            if($this->input->post())
            {
		$gitems=$this->input->post('galleryItems');// exit;
                $galleryItemIds=explode(',',$gitems);
                //echo "<pre>"; print_r($galleryItemIds); echo "</pre>";
		foreach($galleryItemIds as $item){
                    $articleData=array();
                    // Check blog id present #start.
                    if($this->input->post('blogID')) :
                        // Check articleImage present #start.
                        $slug = url_title($this->input->post('articleTitle_'.$item), 'dash', TRUE);
			$articleData['articleTitle']=$this->input->post('articleTitle_'.$item);
			$articleData['slug']=$slug;
			$articleDescription = $this->input->post('articleDescription_'.$item);
			if(strpos($articleDescription,"’"))
			{                              
                            $articleDescription = str_replace("’","'",$articleDescription);
			}
			if(strpos($articleDescription,"‘"))
			{                              
                            $articleDescription = str_replace("‘","'",$articleDescription);
			}
			if(strpos($articleDescription,'“'))
			{                              
                            $articleDescription = str_replace('“','"',$articleDescription);
			}
			if(strpos($articleDescription,'”'))
			{                              
                            $articleDescription = str_replace('”','"',$articleDescription);
			}
                        $description="";
                        $description = $this->str_get_html($articleDescription);
                        $articleData["articleDescription"]=$description;
                        error_reporting(E_ALL);
                        //$articleData['articleDescription']=$this->input->post('articleDescription_'.$item);
			$articleData['blogID']=$this->input->post('blogID');
			$articleData['createdBy']=$this->session->userData('userID');
			$articleData['createdDate']=date('Y-m-d');
			//echo "<pre>"; print_r($articleData); echo "</pre>"; exit;
			$this->load->model('article');
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
                            $msg.="Gallery Item $item : ".$this->input->post('articleTitle_'.$item)." added successfully.<br/>";
			}
			else
			{
                            $msg.="Gallery Item $item : ".$this->input->post('articleTitle_'.$item)." Not added. Please try again.<br/>";
			}
                    else :
			$msg.="Gallery Item $item : ".$this->input->post('articleTitle_'.$item)." Not added. Please select Post.<br/>";
                    endif;
                    // Check blog id present #end.
		}
                //echo "br:".$item; echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
		echo $msg;
            }
        }
         // get html dom from string
        function str_get_html($html)
        {
            error_reporting(0);
            $this->load->library('simpleimage');
            $doc = DOMDocument::loadHTML($html);
            $c =0;
            foreach($doc->getElementsByTagName('img') as $image){
               if($image->hasAttribute('src')){
                    $url="";
                    //$str_contains="192.168.1.80/addmed/stc_api";
                    //$str_contains="api.socialtrafficcenter.com";
                     //$str_contains="demo.socialtrafficcenter.com/api_demo";
                    
                    $url = $image->getAttribute('src');
                    if (strpos($url,$str_contains) === false) {
                                              
                        if($url){
                        $file = fopen($url,"rb");
                        if($file){
                        $directory = "./uploads/article_images/"; // Directory to upload files to.
                        $valid_exts = array("jpg","jpeg","gif","png"); // default image only extensions
                        $ext = end(explode(".",strtolower(basename($url))));
                        if(in_array($ext,$valid_exts)){
                        $rand = rand(1000,9999);
                        $filename = $rand . basename($url);
                        $newfile = fopen($directory . $filename, "wb"); // creating new file on local server
                        if($newfile){
                        while(!feof($file)){
                        // Write the url file to the directory.
                        fwrite($newfile,fread($file,1024 * 8),1024 * 8); // write the file to the new directory at a rate of 8kb/sec. until we reach the end.
                        }
                        
                         $uploaded_file_url=  base_url()."uploads/article_images/$filename";
                         $image->setAttribute('src','');
                         $image->setAttribute('src',$uploaded_file_url);
                               
                        
                        } else { echo 'Could not establish new file ('.$directory.$filename.') on local server. Be sure to CHMOD your directory to 777.'; }
                        } else { echo 'Invalid file type. Please try another file.'; }
                        } else { echo 'Could not locate the file: '.$url.''; }
                        
                      }                       
                        
                    }
                    $temp_url="";
                    $temp_url=$image->getAttribute('src');
                    $size=getimagesize($temp_url);
                    $width=$size[0];
                    if($width>700){
                        $rand = rand(1000,9999);
                        $filename = basename($temp_url);
                        $target_filename = $rand.'_'.basename($temp_url);
                        $file_location = 'uploads/article_images/'; # Image folder Path
                        $this->simpleimage->load($file_location.$filename);
                        $this->simpleimage->resizeToWidth(700);
                        $this->simpleimage->save($file_location.$target_filename);
                        $uploaded_url=$file_location.$target_filename;
                        $imageUrl=base_url(). $uploaded_url;
                        $image->setAttribute('src','');
                        $image->setAttribute('src',$imageUrl);
                    }
                 }
                $c = $c+1;
            }
            // save html
            $html=$doc->saveHTML();
            return $html;
        }
        /**
        * Image resize
        * @param int $width
        * @param int $height
        */
       function resize($width, $height,$filename){
         /* Get original image x y*/

         $imageinfo=getimagesize($filename);
         $w=$imageinfo['0'];
         $h=$imageinfo['1'];
         $type=$imageinfo['mime'];
         //list($w, $h, $type_num, $widthHeight, $bits, $type ) = getimagesize($filename);
         //print_r($h);  exit;
         /* calculate new image size with ratio */
         $ratio = max($width/$w, $height/$h);
         $h = ceil($height / $ratio);
         $x = ($w - $width / $ratio) / 2;
         $w = ceil($width / $ratio);
         $rand = rand(1000,9999);
         $new_filename = $rand.'_'.basename($filename);
         /* new file name */
         $path = 'uploads/article_images/'.$new_filename;
         /* read binary data from image file */
         $imgString = file_get_contents($filename);
         /* create image from string */
         $image = imagecreatefromstring($imgString);
         $tmp = imagecreatetruecolor($width, $height);
         imagecopyresampled($tmp, $image,
           0, 0,
           $x, 0,
           $width, $height,
           $w, $h);
         /* Save image */
         switch ($type) {
           case 'image/jpeg':
             imagejpeg($tmp, $path, 100);
             break;
           case 'image/png':
             imagepng($tmp, $path, 0);
             break;
           case 'image/gif':
             imagegif($tmp, $path);
             break;
           default:
             exit;
             break;
         }
         return $path;
         /* cleanup memory */
         imagedestroy($image);
         imagedestroy($tmp);
       }
       
	public function addmultiple($tid=0,$bid=0,$page="ALL"){
		$data[]="";
		$msg="";
		
		$this->load->model('template');
			$this->load->model('blog');
			$data['templates']=$this->template->getAllTemplates($this->session->userData('userID'));
			if($tid and $bid){
				$data['currentTemplateID']=$tid;
				$data['currentBlogID']=$bid;
				$data['blogs']=$this->blog->getAllBlogsByTemplate($this->session->userData('userID'),$tid);
			}
			$this->layout->view('add_multiple_article',$data);
		
	}

	public function getGalleryItemBlocks($hint="0"){
		if($hint){
			$data['hint']=$hint;
			$this->load->view('gallery_items',$data);
		}
	}
	// return blog details by template id.
	public function getTemplateBlogs($tempID,$bid=0,$page="ALL"){
		$data[]="";
		if($bid!=0)
			$data['cur_blog_id']=$bid;

		$this->load->model('blog');
		$data['blogs']=$this->blog->getAllBlogsByTemplate($this->session->userData('userID'),$tempID);
		$this->load->view('ajax_blogs_by_template',$data);
	}
	public function getTemplateBlogs2($tempID,$bid=0,$page="ALL"){
		$data[]="";
		if($bid!=0)
			$data['cur_blog_id']=$bid;

		$this->load->model('blog');
		$data['blogs']=$this->blog->getAllBlogsByTemplate($this->session->userData('userID'),$tempID);
		$this->load->view('add_article_ajax_post',$data);
	}
	// Delete article by id.
	public function delete($id){
		$this->load->model('article');
		if($id){
			$this->article->delete($id);
			$this->session->set_flashdata('message', 'Gallery item deleted successfully!');
			redirect(base_url()."articles/dashboard");
		}
		else
		{
			redirect(base_url()."articles/dashboard");
		}
	}

	// edit article.
	public function edit($aid=0){
               
		$data[]="";
		if($this->input->post())
		{
                     $aid=$this->input->post('id');
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
                    $articleData["articleVideo"]=$this->input->post('articleVideo');
					$articleDescription = $this->input->post("articleDescription");
					if(strpos($articleDescription,"’"))
					{                              
						$articleDescription = str_replace("’","'",$articleDescription);
					}
					if(strpos($articleDescription,"‘"))
					{                              
						$articleDescription = str_replace("‘","'",$articleDescription);
					}
					if(strpos($articleDescription,'“'))
					{                              
						$articleDescription = str_replace('“','"',$articleDescription);
					}
					if(strpos($articleDescription,'”'))
					{                              
						$articleDescription = str_replace('”','"',$articleDescription);
					}
                                        $description="";
                                        $description = $this->str_get_html($articleDescription);
                                        $articleData["articleDescription"]=$description;
                                        error_reporting(E_ALL);
					//$articleData["articleDescription"]=$articleDescription;
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
			$data['templates']=$this->template->getAllTemplates($this->session->userData('userID'));
			
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

			$data['templates']=$this->template->getAllTemplates($this->session->userData('userID'));

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

			$data['templates']=$this->template->getAllTemplates($this->session->userData('userID'));

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

			$data['templates']=$this->template->getAllTemplates($this->session->userData('userID'));

			$this->load->view('ajax_view_by_blogs',$data);
		}
	}
         public function setSortOreder($articleID=0,$sort_order=0){
            $articleData=array();
            $articleData['sortOrder']=$sort_order;
            $this->load->model('article');
            $updated_id=$this->article->update($articleData,$articleID);
            if($updated_id){
                echo 1;
            }
            else {
                echo 0;
            }
            exit;
        }
        
        public function updateDescription(){
            $this->load->model('article');
            $articles=$this->article->getAllAticles();
            foreach($articles as $item){
                $articleData=array();
                $msg="";
                $newmsg="";
                $newmsg=strip_tags($item['articleDescription'], '<p>');
                if($item['articleImage']){
                    $msg.='<img src="'.  base_url().'uploads/article_images/'.$item['articleImage'].'" /> <br/>';
                }
                if($item['articleVideo']){
                    $msg.=$item['articleVideo']."<br/>";
                }
                /*if($item['articleDescription']){
                    $msg.=$item['articleDescription'];
                }*/
                if($msg!="")
                    $articleData['articleDescription']=$msg.$newmsg;
                else
                    $articleData['articleDescription']=$newmsg;
                
                echo $updated_id=$this->article->update($articleData,$item['id']);
            }
        }
        public function removeDescription(){
             $this->load->model('article');
            $articles=$this->article->getAllAticles();
            foreach($articles as $item){
                 $articleData=array();
                 $msg=strip_tags($item['articleDescription'], '<p>');
                 //strip_tags($item['articleDescription'], '<p>');
            }
        }
}
?>