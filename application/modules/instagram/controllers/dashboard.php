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
	
        $this->layout->setLayout('layout/publisher');
        $instagramConfig['apiKey'] = $this->config->item('instagram_apiKey'); 
        $instagramConfig['apiSecret'] = $this->config->item('instagram_apiSecret'); 
        $instagramConfig['apiCallback'] = $this->config->item('instagram_apiCallback');
        //print_r($instagramConfig); exit;
        $this->load->library('Instagram', $instagramConfig); 
    }
    
    public function index(){
      //$code = $_GET['code'];
      //print_r($_GET['code']); exit;
        if(isset($_GET['code'])){
            $code = $_GET['code'];
            // Receive OAuth token object
            //$data = $this->instagram->getOAuthToken($code);
            //$data1 = $this->instagram->getUser($data->user->id);
            //echo "<pre>"; print_r($data1); echo "</pre>";exit;
            
        }
        else {
            echo "Else";
        }
    }
     
}

?>
