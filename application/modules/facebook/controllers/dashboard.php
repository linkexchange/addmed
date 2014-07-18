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
       // $user = $this->facebook->api('/me');
        //print_r($_SESSION);
        //echo "<pre>"; print_r($user); echo "</pre>";
        
        //$userId = 0;
        // If user is not yet authenticated, the id will be zero
	if($userId == 0){
            // Generate a login url
            $data['url'] = $this->facebook->getLoginUrl(array('scope'=>'email,picture,likes')); 
            $this->load->view('main_index', $data);
	} else {
            // Get user's data and print it
            $user = $this->facebook->api('/me');
            print_r($_SESSION);
            echo "<pre>"; print_r($user); echo "</pre>";
	}
        //$this->facebook->destroySession();
    }
}

?>
