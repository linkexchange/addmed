<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link extends MX_Controller {

	public function index()
	{
		$this->load->model("url");
		if($this->session->userData('userTypeID')==2)
		{
			$data['urls']=$this->url->getAllAdvertiserUrl($this->session->userData("userID"));
		}
		else if($this->session->userData('userTypeID')==3)
		{
			$data['urls']=$this->url->getAllPublisherUrl($this->session->userData("userID"));
		}
		else if($this->session->userData('userTypeID')==1)
		{
			$data['urls']=$this->url->getAllUrl();
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
		echo $this->url->updateUrl($urlData,$linkID);
		redirect(base_url().$this->session->userdata('userType')."/dashboard");
	}
}