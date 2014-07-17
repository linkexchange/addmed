<?php
/**
 * Twitter OAuth library.
 * Sample controller.
 * Requirements: enabled Session library, enabled URL helper
 * Please note that this sample controller is just an example of how you can use the library.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Twitter extends CI_Controller
{
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
        public $type="";
	
	/**
	 * Controller constructor
	 */
	function __construct()
	{
		parent::__construct();
		// Loading TwitterOauth library. Delete this line if you choose autoload method.
		$this->load->library('twitteroauth');
		// Loading twitter configuration.
		$this->config->load('twitter');
		
		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			// If user already logged in
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
		}
		elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
		{
			// If user in process of authentication
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
		}
		else
		{
			// Unknown user
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		}
	}
	
	/**
	 * Here comes authentication process begin.
	 * @access	public
	 * @return	void
	 */
	public function auth()
	{
		if(isset($_GET['link'])){
			$backurl=$_GET['link'];
			$this->session->set_userdata('backurl', $backurl);
		}

		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			$this->reset_session();
			redirect(base_url('/user/login'));
			// User is already authenticated. Add your user notification code here.
			//redirect(base_url('/'));
		}
		else
		{
			// Making a request for request_token
			$request_token = $this->connection->getRequestToken(base_url('/twitter/callback'));
			
			$this->session->set_userdata('request_token', $request_token['oauth_token']);
			$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
			
			if($this->connection->http_code == 200)
			{
				$url = $this->connection->getAuthorizeURL($request_token);
				
				redirect($url);
			}
			else
			{
				$this->reset_session();
				redirect(base_url('/user/login'));
				// An error occured. Make sure to put your error notification code here.
				//redirect(base_url('/'));
			}
		}
	}
	
	/**
	 * Callback function, landing page for twitter.
	 * @access	public
	 * @return	void
	 */
	public function callback()
	{
		if($this->input->get('denied')){
			$this->reset_session();
			redirect(base_url('/user/login'));
		}
			if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
			{
				$this->reset_session();
				redirect(base_url('/twitter/auth'));
			}
			else
			{
				$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));
			
				if ($this->connection->http_code == 200)
				{
					$this->session->set_userdata('access_token', $access_token['oauth_token']);
					$this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
					$this->session->set_userdata('twitter_user_id', $access_token['user_id']);
					$this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);
					$user_Data = $this->connection->get("https://api.twitter.com/1.1/users/show.json?screen_name=".$access_token['screen_name']);
					$this->session->set_userdata('twitter_name', $user_Data->name);
					//print_r($this->session->userdata); exit;
					$this->session->unset_userdata('request_token');
					$this->session->unset_userdata('request_token_secret');
					
					redirect(base_url('/user/login/twitteremail'));
				}
				else
				{
					//echo "Error";// An error occured. Add your notification code here.
					$this->reset_session();
					redirect(base_url('/user/login'));
				}
			}
		
	}
        public function connectTwitter()
	{
		if(isset($_GET['link'])){
			$backurl=$_GET['link'];
			$this->session->set_userdata('backurl', $backurl);
		}
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
			$request_token = $this->connection->getRequestToken(base_url('/twitter/callback1'));
			
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
	public function callback1()
	{
		if($this->input->get('denied')){
                        $this->session->set_flashdata('error', 'Access denied....!');
			$this->reset_session();
			redirect(base_url('/publisher/accounts'));
		}
			if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
			{
				$this->reset_session();
				redirect(base_url('/twitter/connectTwitter'));
			}
			else
			{
				$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));
			
				if ($this->connection->http_code == 200)
				{
					$this->session->set_userdata('access_token', $access_token['oauth_token']);
					$this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
					$this->session->set_userdata('twitter_user_id', $access_token['user_id']);
					$this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);
					$user_Data = $this->connection->get("https://api.twitter.com/1.1/users/show.json?screen_name=".$access_token['screen_name']);
                                        //echo "<pre>"; print_r($user_Data); echo "</pre>"; exit;
                                        
					$this->session->set_userdata('twitter_name', $user_Data->name);
                                        $this->session->set_userdata('twitter_followers', $user_Data->followers_count);
                                        $this->session->set_userdata('twitter_posts', $user_Data->statuses_count);
                                        $this->session->set_userdata('twitter_profile_image_url', $user_Data->profile_image_url);
                                        
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
	public function post($in_reply_to)
	{
		$message = $this->input->post('message');
		if(!$message || mb_strlen($message) > 140 || mb_strlen($message) < 1)
		{
			// Restrictions error. Notification here.
			redirect(base_url('/'));
		}
		else
		{
			if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
			{
				$content = $this->connection->get('account/verify_credentials');
				if(isset($content->errors))
				{
					// Most probably, authentication problems. Begin authentication process again.
					$this->reset_session();
					redirect(base_url('/twitter/auth'));
				}
				else
				{
					$data = array(
						'status' => $message,
						'in_reply_to_status_id' => $in_reply_to
					);
					$result = $this->connection->post('statuses/update', $data);

					if(!isset($result->errors))
					{
						// Everything is OK
						redirect(base_url('/'));
					}
					else
					{
						// Error, message hasn't been published
						redirect(base_url('/'));
					}
				}
			}
			else
			{
				// User is not authenticated.
				redirect(base_url('/twitter/auth'));
			}
		}
	}
	
	/**
	 * Reset session data
	 * @access	private
	 * @return	void
	 */
	public function reset_session()
	{
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('access_token_secret');
		$this->session->unset_userdata('request_token');
		$this->session->unset_userdata('request_token_secret');
		$this->session->unset_userdata('twitter_user_id');
		$this->session->unset_userdata('twitter_screen_name');
                $this->session->unset_userdata('twitter_profile_image_url');
	}
        
        public function addTwitterDetails(){
           
            $userData['userID']=$this->session->userdata('userID');
            $userData['accountID']=$this->session->userdata('twitter_user_id');
            $userData['accountTypeID']='1';
            $this->load->model('smaaccount');
            $isExists=$this->smaaccount->isAccountExists($userData);
            if($isExists) :
                $userData=array();
                $userData['smaAccountProfileImageUrl']=$this->session->userdata('twitter_profile_image_url');
                $userData['smaAccountName']=$this->session->userdata('twitter_screen_name');
                $userData['smaAccountFollowers']=$this->session->userdata('twitter_followers');
                $userData['smaAccountPosts']=$this->session->userdata('twitter_posts');
                $userData['updatedBy']=$this->session->userdata('userID');
                $userData['updatedDate']=date("Y-m-d");
                $isUpdated=$this->smaaccount->updateRecord($isExists,$userData);
                $this->session->set_flashdata('succ', 'Account is already connected with your account...!');
                $this->reset_session();
                redirect(base_url().'publisher/accounts');
                
            else :
                $userData=array();
                $userData['smaAccountFollowers']=$this->session->userdata('twitter_followers');
                $userData['smaAccountPosts']=$this->session->userdata('twitter_posts');
                $userData['smaAccountID']=$this->session->userdata('twitter_user_id');
                $userData['smaAccountTypeID']=1;
                $userData['smaAccountName']=$this->session->userdata('twitter_screen_name');
                $userData['smaAccountProfileImageUrl']=$this->session->userdata('twitter_profile_image_url');
                $userData['createdBy']=$this->session->userdata('userID');
                $userData['createdDate']=date("Y-m-d");
                $userData['publisherID']=$this->session->userdata('userID');
                $this->reset_session();
                $isExists=$this->smaaccount->addRecord($userData);
                $this->session->set_flashdata('succ', 'Twitter account connected successfully....!');
                redirect(base_url().'publisher/accounts');
                //print_r($this->session->userdata); 
            endif;
          
        }
}

/* End of file twitter.php */
/* Location: ./application/controllers/twitter.php */