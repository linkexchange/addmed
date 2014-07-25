<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of dashboard
 *
 * @author comp14
 */
class Dashboard extends MX_Controller{
    //put your code here
    function __construct(){
        parent::__construct();
	parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
	//$CI = & get_instance();
        //$CI->config->load("facebook",TRUE);
        $config = $this->config->item('facebook');
        $this->load->library('Facebook', $config);
    }
    function index(){
        
	// Try to get the user's id on Facebook
	$userId = $this->facebook->getUser();
            
        //$userId = 0;
        // If user is not yet authenticated, the id will be zero
	if($userId == 0){
           $this->session->set_flashdata('error', 'Please try agian to connect your facebook account...!');
           redirect(base_url('/publisher/accounts'));
	} else {
            // Get user's data and print it
            $user = $this->facebook->api('v2.0/me');
            //echo "<pre>"; print_r($user); echo "</pre>";
            //print_r($_SESSION); exit;
            //echo $facebook_id=$user['id'];
            //echo $facebook_email=$user['email'];
            $this->setSessionData($user);
            redirect(base_url('/facebook/dashboard/addFacebookDetails'));
        }
        
    }
     public function setSessionData($userData){
                $this->session->set_userdata('facebook_account_id', $userData['id']);
                $this->session->set_userdata('facebook_account_username', $userData['email']);
                $this->session->set_userdata('facebook_account_img', '');
                $this->session->set_userdata('facebook_account_posts', 0);
                $this->session->set_userdata('facebook_account_followers', 0);        
    }
    public function reset_session(){
        $this->session->unset_userdata('facebook_account_id');
	$this->session->unset_userdata('facebook_account_username');
        $this->session->unset_userdata('facebook_account_img');
        $this->session->unset_userdata('facebook_account_posts');
        $this->session->unset_userdata('facebook_account_followers');
        $this->facebook->destroySession();
        //redirect(base_url('/publisher/accounts'));
    }
    
    public function addFacebookDetails(){
            //echo "<pre>"; print_r($this->session->userdata); echo "</pre>"; exit;
            $userData=array();
            $userData['userID']=$this->session->userdata('userID'); 
            $userData['accountName']=$this->session->userdata('facebook_account_username'); 
            $userData['accountID']=$this->session->userdata('facebook_account_id');
            $userData['accountTypeID']='2';          
            $this->load->model('smaaccount');
            $isExists=$this->smaaccount->isAccountExists($userData); 
            if($isExists) :
                $userData=array();
                $userData['smaAccountID']=$this->session->userdata('facebook_account_id');
                $userData['smaAccountProfileImageUrl']=$this->session->userdata('facebook_account_img');
                $userData['smaAccountName']=$this->session->userdata('facebook_account_username');
                $userData['smaAccountFollowers']=$this->session->userdata('facebook_account_followers');
                $userData['smaAccountPosts']=$this->session->userdata('facebook_account_posts');
                $userData['updatedBy']=$this->session->userdata('userID');
                $userData['updatedDate']=date("Y-m-d");
                $isUpdated=$this->smaaccount->updateRecord($isExists,$userData);
                $this->session->set_flashdata('succ', 'Your facebook account is already connected with your account...!');
                $this->reset_session();
                 redirect(base_url('/publisher/accounts'));
            else :
                $userData=array();
                $userData['smaAccountTypeID']=2;
                $userData['smaAccountID']=$this->session->userdata('facebook_account_id');
                $userData['smaAccountProfileImageUrl']=$this->session->userdata('facebook_account_img');
                $userData['smaAccountName']=$this->session->userdata('facebook_account_username');
                $userData['smaAccountFollowers']=$this->session->userdata('facebook_account_followers');
                $userData['smaAccountPosts']=$this->session->userdata('facebook_account_posts');
                $userData['createdBy']=$this->session->userdata('userID');
                $userData['publisherID']=$this->session->userdata('userID');
                $userData['createdDate']=date("Y-m-d");
                $this->reset_session();
                $isExists=$this->smaaccount->addRecord($userData);
                $this->session->set_flashdata('succ', 'Your facebook account connected successfully....!');
                redirect(base_url('/publisher/accounts'));
            endif;
            
    }
}

?>
