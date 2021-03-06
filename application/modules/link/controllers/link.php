<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link extends MX_Controller {

	public function __construct()
	{		
		//  Call parent Controller
		parent::__construct();
		$this->load->model( 'url' );
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
		if(!$this->session->userdata("userID"))
		{
			redirect(base_url().'user/login');
		}
	}		
	public function index($cat="",$page=1)
	{
		
		$this->load->model("url");
		$data['cur_cat_ID']=$cat;
		$data['categories']=$this->url->getAllCategories("ALL");
		if($this->session->userData('userTypeID')==2)
		{
			$data['urls'] = $this->url->getAllAdvertiserUrl($this->session->userData("userID"),$cat,$page);
			//$data['count']=$this->url->getAllAdvertiserUrlCount($this->session->userData("userID"));
		}
		else if($this->session->userData('userTypeID')==3)
		{
			$data['urls']=$this->url->getAllPublisherUrl($this->session->userData("userID"),$cat,$page);
			//$data['count']=$this->url->getAllPublisherUrlCount($this->session->userData("userID"));
			//exit;
		}
		else if($this->session->userData('userTypeID')==1)
		{
			$data['urls']=$this->url->getAllUrl($cat,$page);
		}
		$data['url_count']=$this->url->getUrlCount($this->session->userData('userID'),$cat);
		
		//echo "<pre>"; print_R($data); exit;
		/*if($cat){
			$this->load->view('view_links_by_cat',$data);
		}
		else{
			//$this->layout->setLayout("layout/main");
			$this->layout->view('view_links',$data);
		}*/
                $this->layout->view('view_links',$data);
	}
	public function add()
	{
		if($this->input->post())
		{
			$urlData = array("url" => $this->input->post('url'));
			if($this->url->isExist($urlData))
			{
				echo "0";
			}
			else
			{
				echo $this->input->post('payPerLink'); 
				$urlData= array("url" => $this->input->post('url'),
								"title"=> $this->input->post('title'),
								"payPerLink" => $this->input->post('payPerLink'),
								"advertiserID" => $this->session->userdata('userID'),
								"categoryID" => $this->input->post('category'),
								"percentage" =>"10",
								'createdBy'=>$this->session->userData('userID'),
								'createdDate'=>date('Y-m-d'),
								);
				//print_r($urlData); exit;
				echo $this->url->add($urlData);
			}
		}
		else
		{
			$data['categories'] = $this->url->get_all_categories();
			//$this->layout->setLayout("layout/main");
			$this->layout->view('add_link',$data);
		}
	}
	public function adLinkCategory()
	{
		$this->layout->view('add_link_category');
	}
	public function edit()
	{
		$this->load->model("url");
			
		if($this->input->post())
		{
			$urlData= array("url" => $this->input->post('url'),
							"title" => $this->input->post('title'),
							"payPerLink" => $this->input->post('payPerLink'),
							"categoryID" => $this->input->post('category'),
							"updatedBy"=>$this->session->userData('userID'),
							"updatedDate"=>date('Y-m-d'));
			if($this->session->userdata("userTypeID")==1 && $this->input->post('percentage')){
				if(is_numeric($this->input->post('percentage')))
					$urlData['percentage']=$this->input->post('percentage');
				else
					$urlData['percentage']=10;
			}
			echo $this->url->updateUrl($urlData,$this->input->post('id'));
			
		}
		else
		{
			$result = $this->url->getUrlByIdForAdv($this->uri->segment(3));
			$data['url']=$result[0];
			$data['categories'] = $this->url->get_all_categories();
			//echo "<pre>"; print_r($data); exit;
			//$this->layout->setLayout("layout/main");
			$this->layout->view('edit_link',$data);
		}
	}
	public function editCategory()
	{
		$this->load->model("url");
		if($this->input->post())
		{
			$data = array('category_name'=>$this->input->post('category'),
						  'updated_date' =>date('Y-m-d'),
						  'updated_by'   =>$this->session->userData('userID'));
			$this->url->updateCategory($data,$this->input->post('id'));
			$data['msg'] = "Category updated successfully";
			$data['cats']=$this->url->displayAllCategories($page=1);
			$data['cats_count']=$this->url->getCatCount();
			$this->layout->view('view_categories',$data);
		}	
		else
		{
			$result = $this->url->getCatById($this->uri->segment(3));
			$data['cats']=$result[0];
			$this->layout->view('edit_category',$data);
		}
	}
	public function delete($id)
	{
		$this->load->model("url");
		$this->url->deleteUrl($id);
		$this->session->set_flashdata('message', 'Link deleted successfully!');
		redirect(base_url()."link");
	}
	public function deleteCategory($id)
	{
		$this->load->model("url");
		$this->url->deleteCategory($id);
		$this->session->set_flashdata('message', 'Category deleted successfully!');
		redirect(base_url()."link/viewCategories");
	}
	public function acceptLink($linkID)
	{
		$this->load->model("url");
		$urlData= array("publisherID" => $this->session->userdata('userID'),
						"linkID" => $linkID);
	
		$this->url->acceptLink($urlData,$linkID);
		redirect(base_url().$this->session->userdata('userType')."/dashboard");
	}
	public function addCategory()
	{
		$this->load->model("url");
		$data = array('category_name'=>$this->input->post('category'),
					  'created_date' =>date('Y-m-d'),
					  'created_by'   =>$this->session->userData('userID'));
			//print_r($cat_Data); exit;
		if($this->url->isExistCategory($data))
		{
			$data['msg'] = "Category name already exists.";
			$this->layout->view('add_link_category',$data);	
		}
		else
		{
			$this->url->add_Category($data);
			$data['msg'] = "Category added successfully";
			$data['cats']=$this->url->displayAllCategories($page=1);
			$data['cats_count']=$this->url->getCatCount();
			$this->layout->view('view_categories',$data);
		}
	}
	public function edit_pub()
	{
		$this->load->model("url");
			
		if($this->input->post())
		{
			$urlData= array("bitlyURL" => $this->input->post('billyUrl')
							);
			echo $this->url->setBitlyLink($urlData,$this->input->post('id'));
			
		}
		else
		{
			$result = $this->url->getUrlByIdForPub($this->uri->segment(3));
			$data['url']=$result[0];
			$this->layout->view('edit_link_pub',$data);
		}
	}
	public function pubremove($id)
	{
		$this->load->model("url");
		$urlData= array("billyUrl" => '',
						"publisherID"=>'0');
		$this->url->removePublishedUrl($id);
		//$this->url->deleteUrl($id);
		redirect(base_url()."publisher/dashboard");
	}
	public function viewCategories($page=1)
	{
		$this->load->model("url");
		$data['cats']=$this->url->displayAllCategories($page);
		$data['cats_count']=$this->url->getCatCount();
		$this->layout->view('view_categories',$data);
	}
	public function setCPC()
	{
		$data['categories'] = $this->url->get_all_categories();
		$this->layout->view('set_cpc',$data);	
	}
	public function setCPCValue()
	{
		$this->load->model("url");
		$result=0;
		$data = array('cost_per_click' =>$this->input->post('cpc'),
						'updated_date'=>date('Y-m-d'),
						'updated_by'=>$this->session->userData('userID')
				);
		$catid = $this->input->post('category');
		$result=$this->url->addCPC($catid,$data);
		if($result){
			$urldata = array('payPerLink' =>$this->input->post('cpc'),
						'updatedDate'=>date('Y-m-d'),
						'updatedBy'=>$this->session->userData('userID')
				);

			if($this->url->updateUrlPPCByCategory($catid,$urldata)){
				$data['msg'] = "CPC added successfully";
			}
			else
			{

			}

		}
		
		$data['cats']=$this->url->displayAllCategories($page=1);
		$data['cats_count']=$this->url->getCatCount();
		$this->layout->view('view_categories',$data);
	}

	public function getCategoryCPC($catID=""){
		$this->load->model("url");
		if($catID){
			$data['cats']=$this->url->getCategoryCPCByID($catID);
			//print_r($data['cats']);
			if(isset($data['cats'][0]['cost_per_click']))
				echo $data['cats'][0]['cost_per_click'];
		}
		else{
		}
			
	}
	
}