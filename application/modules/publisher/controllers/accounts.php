<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends MX_Controller {
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("userID"))
		{
			redirect(base_url().'user/login');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('community');
		$this->load->model("url");
		$this->load->model("payments");
		$this->load->model("clicksdetail");
                $this->load->model('smaaccount');
		$this->layout->setLayout('layout/publisher');
                $config = $this->config->item('facebook'); 
                $this->load->library('Facebook', $config);  
                $instagramConfig['apiKey'] = $this->config->item('instagram_apiKey'); 
                $instagramConfig['apiSecret'] = $this->config->item('instagram_apiSecret'); 
                $instagramConfig['apiCallback'] = $this->config->item('instagram_apiCallback');
                //print_r($instagramConfig); exit;
                $this->load->library('Instagram', $instagramConfig);  
	}
	/*public function index($page=1)
	{
		$data['url_count']=$this->url->getUrlCount($this->session->userData('userID'));
		$data['publishedUrls']=$this->url->getPublisherUrls($this->session->userData('userID'));
		$data['unPublishedUrls']=$this->url->getUnPublishedUrls();
		$data['unpublished_url_count']=$this->url->getUnPublishedUrlsCount($this->session->userData('userID'));
		$data['totalPaidPayment']=$this->payments->getTotalPaidByAdvertiser($this->session->userData('userID'));
		$paymentDetails=$this->payments->getTotalPaymentRemainingByAdvertiser($this->session->userData('userID'));
		foreach($paymentDetails as $item)
		{
			if($item['billableAmount']>=$item['paidAmount']){
				$data['TotalRamainingPayment']=$item['billableAmount']-$item['paidAmount'];
			}
			else
			{
				$data['TotalRamainingPayment']=0;
			}
		}
		$data['totalHits']=$this->clicksdetail->getTotalHits($this->session->userData('userID'));
		$data["communities"] = $this->community->getAllCommunities();
		$this->layout->view('publisher',$data);
    }*/
	public function index($page=0)
	{
            $data="";
           
            //$this->facebook->destroySession();
            $data['facebookUrl']=$this->facebook->getLoginUrl(array('scope'=>'email'));
            $data['instagramUrl']=$this->instagram->getLoginUrl();
            
            $data['totalTwitterFollowers']=$this->smaaccount->getTotalFollowers($this->session->userData('userID'),'Twitter');
            $data['totalTwitterPosts']=$this->smaaccount->getTotalPosts($this->session->userData('userID'),'Twitter');
            $data['twitterProfiles']=$this->smaaccount->getProfiles($this->session->userData('userID'),'Twitter',$page);
            $data['twitterProfileCount']=$this->smaaccount->getProfileCount($this->session->userData('userID'),'Twitter');
            
            $data['totalTumblrFollowers']=$this->smaaccount->getTotalFollowers($this->session->userData('userID'),'Tumblr');
            $data['totalTumblrPosts']=$this->smaaccount->getTotalPosts($this->session->userData('userID'),'Tumblr');
            $data['tumblrProfiles']=$this->smaaccount->getProfiles($this->session->userData('userID'),'Tumblr',$page);
            $data['tumblrProfileCount']=$this->smaaccount->getProfileCount($this->session->userData('userID'),'Tumblr');
            
            $this->layout->view('accounts_new',$data);
	}
	public function add()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('title', 'Community title', 'required');
			$this->form_validation->set_rules('description', 'Community Description', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->layout->view('add_community');
			}
			else
			{
				$config['upload_path'] = './uploads/community_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '10000';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload("image"))
				{
					$data['uploadmsg'] = $this->upload->display_errors();
					$this->layout->view('add_community',$data);
				}
				else
				{	
					$data['image_data'] = array('upload_data' => $this->upload->data());
					$uploaded_file=$data['image_data']['upload_data']['file_name'];
					$communityData = array("community_title"=>$this->input->post("title"),
										   "image"=>$uploaded_file,
									       "community_description"=>$this->input->post("description"),
									       "created_by"=>$this->session->userdata("userID"),
									       "created_date"=>date("Y-m-d"));
					$insert_id = $this->community->addCommunity($communityData);
					if($insert_id)
					{
						$this->session->set_flashdata("community","Community added successfully");
						redirect(base_url()."publisher/frontend");
					}
					else
					{
						$data["error"] = "Please try again";
						$this->layout->view('add_community',$data);
					}
				}					   
			}
		}
		else
		{
			$this->layout->view('add_community');
		}
	}
	public function description($id)
	{
		if($this->input->post("comment"))
		{
			$commentData = array("comment_description"=>$this->input->post("comment"),
								 "community_id"=>$id,
								 "created_by"=>$this->session->userdata("userID"),
								 "created_date"=>date("Y-m-d"));
			$insert_id = $this->community->addComment($commentData);
			if($insert_id)
			{
				$this->community->addNoOfPosts($id);
				echo 100;
			}
			else
			{
				echo "Please try again";
			}	
		}
		else if($this->input->post("reply"))
		{
			$replyData =   array("parent_id"=>$this->input->post("commentid"),
								 "comment_description"=>$this->input->post("reply"),
								 "community_id"=>$id,
								 "created_by"=>$this->session->userdata("userID"),
								 "created_date"=>date("Y-m-d"));
			$insert_id = $this->community->addComment($replyData);
			if($insert_id)
			{
				redirect(base_url()."publisher/frontend/description/".$id);
			}
			else
			{
				echo "Please try again";
			}	
		}
		else
		{	
			$data["comments"] = $this->community->getAllComments($id);
			$data["replies"] = $this->community->getAllReplies();
			$data["community"] = $this->community->getCommunityByID($id);
			$data["popular_communities"] = $this->community->getPopularPosts();
			$this->layout->view('description',$data);
		}	
	}
        public function facebookConnect(){
            echo "0"; exit;
            // Try to get the user's id on Facebook
            $userId = $this->facebook->getUser();
           // $user = $this->facebook->api('/me');
            //print_r($_SESSION);
            //echo "<pre>"; print_r($user); echo "</pre>";

            //$userId = 0;
            // If user is not yet authenticated, the id will be zero
            if($userId == 0){
                // Generate a login url
                //$data['url'] = $this->facebook->getLoginUrl(array('scope'=>'email,picture,likes')); 
                //$this->load->view('facebook_connect', $data);
                //redirect(base_url('/publisher/accounts'));
            } else {
                // Get user's data and print it
                $user = $this->facebook->api('/me');
                print_r($_SESSION);
                echo "<pre>"; print_r($user); echo "</pre>";
            }
            
            //$this->facebook->destroySession();
    }
    public function resetFacebook(){
        $this->facebook->destroySession();
        redirect(base_url('/publisher/accounts'));
    }
}
?>