<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajaxfunctions
 *
 * @author comp14
 */

class Ajaxfunctions extends MX_Controller {
    //put your code here
    public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("userID"))
		{
			redirect(base_url().'user/login');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->model('community');
		//$this->load->model("url");
		//$this->load->model("payments");
		//$this->load->model("clicksdetail");
                $this->load->model('smaaccount');
		//$this->layout->setLayout('layout/publisher');
	}
        
        public function getAccountRecords($pageNum=0,$type=""){
            $data=  array();
            //$data['totalTwitterFollowers']=$this->smaaccount->getTotalFollowers($this->session->userData('userID'),$type);
            //$data['totalTwitterPosts']=$this->smaaccount->getTotalPosts($this->session->userData('userID'),$type);
            $data['currentPage']=$pageNum;
            $data['type']=$type;
            $data['profiles']=$this->smaaccount->getProfiles($this->session->userData('userID'),$type,$pageNum);
            $data['profileCount']=$this->smaaccount->getProfileCount($this->session->userData('userID'),$type);
            $this->load->view('getAccountRecordsView',$data);
        }
        
        public function removeAccountRecords($id=0){
            ob_start();
            echo $this->smaaccount->removeProfile($id);            
        }
        
        public function getUpdatedFollowers($type){
            $count=$this->smaaccount->getTotalFollowers($this->session->userData('userID'),$type);;
            echo $count[0]['smaAccountFollowers'];
        }
        public function getUpdatedPosts($type){
            $count=$this->smaaccount->getTotalPosts($this->session->userData('userID'),$type);;
            echo $count[0]['smaAccountPosts'];
        }
}
?>
