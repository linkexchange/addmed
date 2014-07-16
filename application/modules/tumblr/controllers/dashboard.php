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
class Dashboard extends CI_Controller{
    //put your code here
    /**
	 * TumblrOauth class instance.
	 */
	private $connection;
        public $type="";
	
	/**
	 * Controller constructor
	 */
	function __construct()
	{
		parent::__construct();
		// Loading TumblrOauth library. Delete this line if you choose autoload method.
		$this->load->library('tumblroauth');
		// Loading tumblr configuration.
		$this->config->load('tumblr');
		//echo $this->config->item('tumblr_consumer_token'); exit;
		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			// If user already logged in
			$this->connection = $this->tumblroauth->create($this->config->item('tumblr_consumer_token'), $this->config->item('tumblr_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
		}
		elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
		{
			// If user in process of authentication
			$this->connection = $this->tumblroauth->create($this->config->item('tumblr_consumer_token'), $this->config->item('tumblr_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
		}
		else
		{
			// Unknown user
			$this->connection = $this->tumblroauth->create($this->config->item('tumblr_consumer_token'), $this->config->item('tumblr_consumer_secret'));
		}
	}
        public function connect()
	{
		
                if(isset($_GET['type'])){
			$this->type=$_GET['type'];
                        //echo $this->type;
                }

		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
                    $this->reset_session();
                    redirect(base_url('/publisher/accounts'));
		}
		else
		{
			// Making a request for request_token
			$request_token = $this->connection->getRequestToken(base_url('tumblr/dashboard/callback'));
			
			$this->session->set_userdata('request_token', $request_token['oauth_token']);
			$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
			
			if($this->connection->http_code == 200)
			{
				$url = $this->connection->getAuthorizeURL($request_token);
				
				redirect($url);
			}
			else
			{
                            redirect(base_url('/publisher/accounts'));
			}
		}
	}
        public function callback()
	{
		if($this->input->get('denied')){
                        $this->session->set_flashdata('error', 'Access denied....!');
			$this->reset_session();
			redirect(base_url('/publisher/accounts'));
		}
			if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
			{
				$this->reset_session();
				redirect(base_url('publisher/dashboard/connect'));
			}
			else
			{
				$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));
			
				if ($this->connection->http_code == 200)
				{
					$this->session->set_userdata('access_token', $access_token['oauth_token']);
					$this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
					//$this->session->set_userdata('twitter_user_id', $access_token['user_id']);
					//$this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);
					$user_Data = $this->connection->get("http://api.tumblr.com/v2/user/info");
                                        $this->session->set_userdata('tumblr_user_name', $user_Data->response->user->name);
                                        $posts=0; $followers=0; $totalBlog=0;
                                        foreach ($user_Data->response->user->blogs as $blog){
                                            //print_r($blog);
                                            $posts=$posts+$blog->posts;
                                            $followers=$followers+$blog->followers;
                                            $totalBlog++;
                                        }
                                        $this->session->set_userdata('tumblr_posts', $posts);
                                        $this->session->set_userdata('tumblr_followers', $followers);
                                        $this->session->set_userdata('tumblr_blogs', $totalBlog);
                                        $this->session->set_userdata('tumblr_likes', $user_Data->response->user->likes);
                                        echo "<pre>"; print_r( $this->session->userdata); echo "</pre>";
                                        echo "<pre>"; print_r($user_Data); echo "</pre>"; exit;
                                        
					//print_r($this->session->userdata); exit;
					$this->session->unset_userdata('request_token');
					$this->session->unset_userdata('request_token_secret');
					redirect(base_url('/twitter/addTwitterDetails'));
                                }
				else
				{
					//echo "Error";// An error occured. Add your notification code here.
					$this->reset_session();
					redirect(base_url('/publisher/accounts'));
				}
			}
		
	}
        public function reset_session()
	{
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('access_token_secret');
		$this->session->unset_userdata('request_token');
		$this->session->unset_userdata('request_token_secret');
		$this->session->unset_userdata('tumblr_user_name');
                $this->session->unset_userdata('tumblr_posts');
                $this->session->unset_userdata('tumblr_followers');
                $this->session->unset_userdata('tumblr_blogs');
                $this->session->unset_userdata('tumblr_likes');
		//$this->session->unset_userdata('twitter_screen_name');
                //$this->session->unset_userdata('twitter_profile_image_url');
	}
        
}

?>
