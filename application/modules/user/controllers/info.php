<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{		
		//  Call parent Controller
		parent::__construct();
		//$this->load->model('advertise');
		if($this->session->userdata("userType")=="advertiser")
		{
			$this->layout->setLayout("layout/advertiser");
		}
		else if($this->session->userdata("userType")=="publisher")
		{
			$this->layout->setLayout("layout/publisher");
		}
		else if($this->session->userdata("userType")=="admin")
		{
			$this->layout->setLayout("layout/admin");
		}
		else 
		{
			$this->layout->setLayout("layout/normal");
		}
		$this->load->model("user");
		$this->load->model("smaaccount");
	}
	
	public function index($id)
	{
		$page=0;
		//fetch twitter data
		$data['totalTwitterFollowers']=$this->smaaccount->getTotalFollowers2($id,'Twitter');
		$data['totalTwitterPosts']=$this->smaaccount->getTotalPosts2($id,'Twitter');
		$data['twitterProfiles']=$this->smaaccount->getProfiles2($id,'Twitter',$page);
		$data['twitterProfileCount']=$this->smaaccount->getProfileCount2($id,'Twitter');
		
		//fetch facebook data
		$data['totalFacebookFollowers']=$this->smaaccount->getTotalFollowers2($id,'Facebook');
		$data['totalFacebookPosts']=$this->smaaccount->getTotalPosts2($id,'Facebook');
		$data['facebookProfiles']=$this->smaaccount->getProfiles2($id,'Facebook',$page);
		$data['facebookProfileCount']=$this->smaaccount->getProfileCount2($id,'Facebook');
		
		//fetch tumblr data
		$data['totalTumblrFollowers']=$this->smaaccount->getTotalFollowers2($id,'Tumblr');
		$data['totalTumblrPosts']=$this->smaaccount->getTotalPosts2($id,'Tumblr');
		$data['tumblrProfiles']=$this->smaaccount->getProfiles2($id,'Tumblr',$page);
		$data['tumblrProfileCount']=$this->smaaccount->getProfileCount2($id,'Tumblr');
		
		//fetch instagram data
		$data['totalInstagramFollowers']=$this->smaaccount->getTotalFollowers2($id,'Instagram');
		$data['totalInstagramPosts']=$this->smaaccount->getTotalPosts2($id,'Instagram');
		$data['instagramProfiles']=$this->smaaccount->getProfiles2($id,'Instagram',$page);
		$data['instagramProfileCount']=$this->smaaccount->getProfileCount2($id,'Instagram');
		$data["privacy"] = $this->smaaccount->getAccountPrivacyDetails($id);
		//fetch users' social media url
		$data["url"] = $this->user->getUserSMAUrls($id);
		$data["privacy"] = $this->user->getUsersUrlPrivacy($id);
		$data["privacy_profile"] = $this->user->getUsersPrivacy($id);
		$data["privacy_account"] = $this->smaaccount->getAccountPrivacyDetails($id);
		//fetch user details
		$data["user"] = $this->user->getUser($id);
		$this->layout->view("user_profile",$data);
	}
}