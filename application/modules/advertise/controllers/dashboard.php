<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	public function index($page=1,$msg=0){
		$data[]="";
		$this->load->model('advertise');
		$data['ads']=$this->advertise->getAds($this->session->userData('userID'),$page);
		$data['count']=$this->advertise->getAdsCount($this->session->userData('userID'));
		$this->layout->setLayout("layout/main");
		$this->layout->view("dashboard",$data);
	}
	
	// add advertises
	public function add(){
		$data[]="";
		$this->load->model('template');
		$data['templates']=$this->template->getAdvertiseTemplates($this->session->userData('userID'),$page="All");
		if($this->input->post()){
			if($this->input->post("templateID")){
				$advertiseData=array(
					'templateID'=>$this->input->post("templateID"),
					'adUnit1'=>$this->input->post("adUnit1"),
					'adUnit2'=>$this->input->post("adUnit2"),
					'adUnit3'=>$this->input->post("adUnit3"),
					'adUnit4'=>$this->input->post("adUnit4"),
					'adUnit5'=>$this->input->post("adUnit5"),
					'adUnit6'=>$this->input->post("adUnit6"),
					'adMobile1'=>$this->input->post("adMobile1"),
					'adMobile2'=>$this->input->post("adMobile2"),
					'adMobile3'=>$this->input->post("adMobile3"),
					'createdBy'=>$this->session->userData('userID'),
					'createdDate'=>date('Y-m-d'),
				);
				//echo "<pre>"; print_r($advertiseData); echo "</pre>";
				$this->load->model('advertise');
				$insert_id=$this->advertise->add($advertiseData);
				if($insert_id){
					if($this->input->post("templateID")){
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
			else{
				echo 101;
			}
		}
		else
		{
			$this->layout->setLayout("layout/main");
			$this->layout->view("add_advertise",$data);
		}
	}

	public function view($id){
		$this->load->model('advertise');
		$data['ad']=$this->advertise->getAd($id);
		$this->layout->setLayout("layout/main");
		$this->layout->view('view_ad',$data);

	}
	
	public function edit($id){
		$this->load->model('advertise');
		if($this->input->post()){
			$aid=$this->input->post('adID');
			$advertiseData=array(
					'adUnit1'=>$this->input->post("adUnit1"),
					'adUnit2'=>$this->input->post("adUnit2"),
					'adUnit3'=>$this->input->post("adUnit3"),
					'adUnit4'=>$this->input->post("adUnit4"),
					'adUnit5'=>$this->input->post("adUnit5"),
					'adUnit6'=>$this->input->post("adUnit6"),
					'adMobile1'=>$this->input->post("adMobile1"),
					'adMobile2'=>$this->input->post("adMobile2"),
					'adMobile3'=>$this->input->post("adMobile3"),
					'updatedBy'=>$this->session->userData('userID'),
					'updatedDate'=>date('Y-m-d'),
				);
				//echo "<pre>"; print_r($advertiseData); echo "</pre>";
				$this->load->model('advertise');
				$update_id=$this->advertise->update($advertiseData,$aid);
				if($update_id){
					if($this->input->post("templateID")){
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
					echo 100;
				}
		}
		else
		{
			$data['ad']=$this->advertise->getAd($id);
			$this->layout->setLayout("layout/main");
			$this->layout->view('edit_ad',$data);
		}
	}

	public function delete($id){
		$this->load->model('advertise');
		if($id){
			$this->advertise->delete($id);
			$this->session->set_flashdata('message', 'Ad deleted successfully!');
			redirect(base_url()."advertise/dashboard/");
		}
		else
		{
			redirect(base_url()."advertise/dashboard/");
		}
	}


}