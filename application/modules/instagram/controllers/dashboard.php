<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author comp14
 */
class Dashboard extends MX_Controller{
    //put your code here
    public function __construct(){
        parent::__construct();
        // $this->load->library('session');
	$this->layout->setLayout('layout/publisher');
        $instagramConfig['apiKey'] = $this->config->item('instagram_apiKey'); 
        $instagramConfig['apiSecret'] = $this->config->item('instagram_apiSecret'); 
        $instagramConfig['apiCallback'] = $this->config->item('instagram_apiCallback');
        //print_r($instagramConfig); exit;
        //echo "<pre>"; print_r($this->session->userdata); echo "</pre>"; exit;
        $this->load->model('smaaccount');
        $this->load->library('Instagram', $instagramConfig); 
    }
    
    public function index(){
        //echo "<pre>"; print_r($this->session->all_userdata()); echo "</pre>"; exit;
        //$code = $_GET['code'];
        //print_r($_GET['code']); exit;
        
       // echo "<pre>"; print_r($this->session->all_userdata()); echo "</pre>"; 
       // $this->session->set_userdata('instagram_account_name', '5'); exit;
        //redirect(base_url('/publisher/accounts'));
        if(isset($_GET['code'])){
            $code = $_GET['code'];
            // Receive OAuth token object
            $data = $this->instagram->getOAuthToken($code);
            $instagramData = $this->instagram->getUser($data->user->id);
            if($instagramData->meta->code==200){
               
                $this->setSessionData($instagramData);
                //echo "<pre>"; print_r($this->session->userdata); echo "</pre>"; exit;
                //echo "<pre>"; print_r($instagramData); echo "</pre>"; exit;
                redirect(base_url('/instagram/dashboard/addInstagramDetails'));
                
            }
            else
            {
                 $this->session->set_flashdata('error', 'Error connectimg Instagram account, please try again .....!');
                 redirect(base_url('/publisher/accounts'));
            }
           
        }
        else {
            $this->session->set_flashdata('error', 'Access token is invalid, please try again .....!');
            redirect(base_url('/publisher/accounts'));
        }
    }
   
    
    
    public function setSessionData($userData){
                $this->session->set_userdata('instagram_account_id', $userData->data->id);
                $this->session->set_userdata('instagram_account_username', $userData->data->username);
                $this->session->set_userdata('instagram_account_img', $userData->data->profile_picture);
                $this->session->set_userdata('instagram_account_posts', $userData->data->counts->media);
                $this->session->set_userdata('instagram_account_followers', $userData->data->counts->followed_by);        
    }
    public function reset_session(){
		$this->session->unset_userdata('instagram_account_id');
		$this->session->unset_userdata('instagram_account_username');
		$this->session->unset_userdata('instagram_account_img');
		$this->session->unset_userdata('instagram_account_posts');
		$this->session->unset_userdata('instagram_account_followers');
                //echo "<pre>"; print_r($this->session->userdata); echo "</pre>"; exit;
	}
    public function addInstagramDetails(){
            //echo "<pre>"; print_r($this->session->userdata); echo "</pre>"; exit;
            $userData=array();
            $userData['userID']=$this->session->userdata('userID'); 
            $userData['accountName']=$this->session->userdata('instagram_account_username'); 
            $userData['accountID']=$this->session->userdata('instagram_account_id');
            $userData['accountTypeID']='4';          
            $this->load->model('smaaccount');
            $isExists=$this->smaaccount->isAccountExists($userData);
            if($isExists) :
                $userData=array();
                $userData['smaAccountID']=$this->session->userdata('instagram_account_id');
                $userData['smaAccountProfileImageUrl']=$this->session->userdata('instagram_account_img');
                $userData['smaAccountName']=$this->session->userdata('instagram_account_username');
                $userData['smaAccountFollowers']=$this->session->userdata('instagram_account_followers');
                $userData['smaAccountPosts']=$this->session->userdata('instagram_account_posts');
                $userData['updatedBy']=$this->session->userdata('userID');
                $userData['updatedDate']=date("Y-m-d");
                $isUpdated=$this->smaaccount->updateRecord($isExists,$userData);
                $this->session->set_flashdata('succ', 'Account is already connected with your account...!');
                $this->reset_session();
                 redirect(base_url('/publisher/accounts'));
            else :
                $userData=array();
                $userData['smaAccountTypeID']=4;
                $userData['smaAccountID']=$this->session->userdata('instagram_account_id');
                $userData['smaAccountProfileImageUrl']=$this->session->userdata('instagram_account_img');
                $userData['smaAccountName']=$this->session->userdata('instagram_account_username');
                $userData['smaAccountFollowers']=$this->session->userdata('instagram_account_followers');
                $userData['smaAccountPosts']=$this->session->userdata('instagram_account_posts');
                $userData['createdBy']=$this->session->userdata('userID');
                $userData['publisherID']=$this->session->userdata('userID');
                $userData['createdDate']=date("Y-m-d");
                $this->reset_session();
                $isExists=$this->smaaccount->addRecord($userData);
                $this->session->set_flashdata('succ', 'Tumblr account connected successfully....!');
                redirect(base_url('/publisher/accounts'));
            endif;
            
    }
}

?>
