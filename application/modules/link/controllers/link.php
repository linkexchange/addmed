<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link extends MX_Controller {

	public function index($page=1)
	{
		$this->load->model("url");
		if($this->session->userData('userTypeID')==2)
		{
			$data['urls']=$this->url->getAllAdvertiserUrl($this->session->userData("userID"),$page);
			//$data['count']=$this->url->getAllAdvertiserUrlCount($this->session->userData("userID"));
		}
		else if($this->session->userData('userTypeID')==3)
		{
			$data['urls']=$this->url->getAllPublisherUrl($this->session->userData("userID"),$page);
			//$data['count']=$this->url->getAllPublisherUrlCount($this->session->userData("userID"));
			//exit;
		}
		else if($this->session->userData('userTypeID')==1)
		{
			$data['urls']=$this->url->getAllUrl($page);
		}
		$data['url_count']=$this->url->getUrlCount($this->session->userData('userID'));
		$this->layout->setLayout("layout/main");
		$this->layout->view('view_links',$data);
	}
	public function add()
	{
		if($this->input->post())
		{
			$this->load->model("url");
			$urlData = array("url" => $this->input->post('url'));	
			if($this->url->isExist($urlData))
			{
				echo "0";
			}
			else
			{
				echo $this->input->post('payPerLink'); 
				$urlData= array("url" => $this->input->post('url'),
								"payPerLink" => $this->input->post('payPerLink'),
								"advertiserID" => $this->session->userdata('userID')
								);
				
				echo $this->url->add($urlData);
			}
		}
		else
		{
			$this->layout->setLayout("layout/main");
			$this->layout->view('add_link');
		}
	}
	public function edit()
	{
		$this->load->model("url");
			
		if($this->input->post())
		{
			$urlData= array("url" => $this->input->post('url'),
							"payPerLink" => $this->input->post('payPerLink')
							);
			echo $this->url->updateUrl($urlData,$this->input->post('id'));
			
		}
		else
		{
			$result = $this->url->getUrlById($this->uri->segment(3));
			$data['url']=$result[0];
			$this->layout->setLayout("layout/main");
			$this->layout->view('edit_link',$data);
		}
	}
	public function delete($id)
	{
		$this->load->model("url");
		$this->url->deleteUrl($id);
		redirect(base_url()."link");
	}
	public function acceptLink($linkID)
	{
		$this->load->model("url");
		$urlData= array("publisherID" => $this->session->userdata('userID'));
		$this->url->updateUrl($urlData,$linkID);
		redirect(base_url().$this->session->userdata('userType')."/dashboard");
	}
	public function edit_pub()
	{
		$this->load->model("url");
			
		if($this->input->post())
		{
			$urlData= array("billyUrl" => $this->input->post('billyUrl')
							);
			echo $this->url->updateUrl($urlData,$this->input->post('id'));
			
		}
		else
		{
			$result = $this->url->getUrlById($this->uri->segment(3));
			$data['url']=$result[0];
			$this->layout->setLayout("layout/main");
			$this->layout->view('edit_link_pub',$data);
		}
	}
	public function pubremove($id)
	{
		$this->load->model("url");
		$urlData= array("billyUrl" => '',
						"publisherID"=>'0'	
		);
		$this->url->updateUrl($urlData,$id);
		//$this->url->deleteUrl($id);
		redirect(base_url()."publisher/dashboard");
	}
}