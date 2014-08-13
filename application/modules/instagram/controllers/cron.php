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
class Cron extends MX_Controller{
    //put your code here
    public function __construct(){
        parent::__construct();
        // $this->load->library('session');
		$instagramConfig['apiKey'] = $this->config->item('instagram_apiKey'); 
        $instagramConfig['apiSecret'] = $this->config->item('instagram_apiSecret'); 
        $instagramConfig['apiCallback'] = $this->config->item('instagram_apiCallback');
        //print_r($instagramConfig); exit;
        //echo "<pre>"; print_r($this->session->userdata); echo "</pre>"; exit;
        $this->load->library('Instagram', $instagramConfig); 
    }
    
    public function index(){
		$users = $this->smaaccount->getSMA_InstagramIDs();
		//echo "<pre>"; print_R($users); exit;
		foreach($users as $id)
		{
			$user_Data = $this->instagram->getUser($id["smaAccountID"]);
			if(isset($user_Data->data->username))
			{
				$userData['smaAccountProfileImageUrl']=$user_Data->data->profile_picture;
                $userData['smaAccountName']=$user_Data->data->username;
                $userData['smaAccountFollowers']=$user_Data->data->counts->followed_by;
                $userData['smaAccountPosts']=$user_Data->data->counts->media;
                $userData['updatedDate']=date("Y-m-d");
				$true = $this->smaaccount->updateSMA_Accounts($id['id'],$userData);
				if($true)
				{
					echo $id['smaAccountID'].":Account updated.<br/>";
				}
				else
				{
					echo $id['smaAccountID'].":Account not updated.<br/>";
				}
			}
		}
    }
}

?>
