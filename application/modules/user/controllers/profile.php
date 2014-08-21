<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller {

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
		if(!$this->session->userdata("userID"))
		{
			redirect(base_url().'user/login');
		}
		$this->load->model("user");
		$this->load->model("smaaccount");
	}
	
	public function index($page=0)
	{
		//fetch twitter data
		$data['totalTwitterFollowers']=$this->smaaccount->getTotalFollowers($this->session->userData('userID'),'Twitter');
		$data['totalTwitterPosts']=$this->smaaccount->getTotalPosts($this->session->userData('userID'),'Twitter');
		$data['twitterProfiles']=$this->smaaccount->getProfiles($this->session->userData('userID'),'Twitter',$page);
		$data['twitterProfileCount']=$this->smaaccount->getProfileCount($this->session->userData('userID'),'Twitter');
		
		//fetch facebook data
		$data['totalFacebookFollowers']=$this->smaaccount->getTotalFollowers($this->session->userData('userID'),'Facebook');
		$data['totalFacebookPosts']=$this->smaaccount->getTotalPosts($this->session->userData('userID'),'Facebook');
		$data['facebookProfiles']=$this->smaaccount->getProfiles($this->session->userData('userID'),'Facebook',$page);
		$data['facebookProfileCount']=$this->smaaccount->getProfileCount($this->session->userData('userID'),'Facebook');
		
		//fetch tumblr data
		$data['totalTumblrFollowers']=$this->smaaccount->getTotalFollowers($this->session->userData('userID'),'Tumblr');
		$data['totalTumblrPosts']=$this->smaaccount->getTotalPosts($this->session->userData('userID'),'Tumblr');
		$data['tumblrProfiles']=$this->smaaccount->getProfiles($this->session->userData('userID'),'Tumblr',$page);
		$data['tumblrProfileCount']=$this->smaaccount->getProfileCount($this->session->userData('userID'),'Tumblr');
		
		//fetch instagram data
		$data['totalInstagramFollowers']=$this->smaaccount->getTotalFollowers($this->session->userData('userID'),'Instagram');
		$data['totalInstagramPosts']=$this->smaaccount->getTotalPosts($this->session->userData('userID'),'Instagram');
		$data['instagramProfiles']=$this->smaaccount->getProfiles($this->session->userData('userID'),'Instagram',$page);
		$data['instagramProfileCount']=$this->smaaccount->getProfileCount($this->session->userData('userID'),'Instagram');
		$data["privacy"] = $this->smaaccount->getAccountPrivacyDetails($this->session->userData('userID'));
		//fetch users' social media url
		$data["url"] = $this->user->getUserSMAUrls($this->session->userdata("userID"));
		$data["privacy"] = $this->user->getUsersUrlPrivacy($this->session->userdata("userID"));
		$data["privacy_profile"] = $this->user->getUsersPrivacy($this->session->userdata("userID"));
		$data["privacy_account"] = $this->smaaccount->getAccountPrivacyDetails($this->session->userdata("userID"));
		
		$this->layout->view("user_profile",$data);
	}
	
	public function edit()
	{
		if($this->input->post())
		{
			//echo "<prE>"; print_R($this->input->post()); exit;
			$userData = array();
			$userData["phoneNumber"] = $this->input->post("phoneNumber");
			if(isset($_FILES["profile_pic"]))
			{
				$config['upload_path'] = './uploads/user_profile_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '20000';
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload("profile_pic"))
				{
					echo $this->upload->display_errors();
					exit;
				}
				else
				{
					$data['image_data'] = array('upload_data' => $this->upload->data());
					$uploaded_file=$data['image_data']['upload_data']['file_name'];
					$userData["profile_image"] = $uploaded_file; 
					$this->session->set_userdata("userPic",$uploaded_file);
				}
			}
			$userData["companyName"] = $this->input->post("companyName");
			$userData["address"] = $this->input->post("address");
			$userData["city"] = $this->input->post("city");
			$userData["state"] = $this->input->post("state");
			$userData["country"] = $this->input->post("country");
			$userData["zipCode"] = $this->input->post("zipCode");
			$userData['updatedDate'] = date("Y-m-d");
			$userData['updatedBy'] = $this->session->userData('userID');
			if($this->input->post("password")!=NULL){
				$userData=array("password"=>$this->input->post("password"));
			}
			$privacyData = array("userid"=>$this->input->post("id"),
								 "username"=>$this->input->post("privacy_username"),
								 "company_name"=>$this->input->post("privacy_company"),
								 "email"=>$this->input->post("privacy_email"),
								 "phone_no"=>$this->input->post("privacy_mobile"),
								 "address"=>$this->input->post("privacy_company_address"),
								 "city"=>$this->input->post("privacy_city"),
								 "state"=>$this->input->post("privacy_state"),
								 "country"=>$this->input->post("privacy_country"),
								 "zip"=>$this->input->post("privacy_zip"));
			//print_r($userData);
			//echo $this->input->post("id");
			//echo "<PrE>"; print_r($privacyData); exit;
			$userId=$this->user->updateUser($userData,$this->input->post("id"));
			$true = $this->user->existPrivacyofUser($this->input->post("id"));
			if($true==1)
			{
				$this->user->updatePrivacyofUser($this->input->post("id"),$privacyData);
			}
			else
			{
				$this->user->insertPrivacyofUser($privacyData);
			}
			$this->session->set_flashdata("update","User Data updated successfully...!");
			if($this->session->userData('userTypeID')==1){
					echo 1;
			}
			elseif($this->session->userData('userTypeID')==2){
					echo 2;
			}
			elseif($this->session->userData('userTypeID')==3){
					echo 3;
			}
			//redirect(base_url().$this->session->userdata('userType')."/dashboard");	
		}
		else
		{
			if($this->session->userData('userTypeID')!=1 &&		$this->uri->segment(4)!=$this->session->userData('userID')){
				redirect(base_url().$this->session->userdata('userType')."/dashboard");		
			}
			$result=$this->user->getUser($this->uri->segment(4));
			$data['user']=$result[0];
			$data['privacy'] = $this->user->getUsersPrivacy($this->uri->segment(4));
			$this->layout->view('edit_profile',$data);
		}	
	}
	public function delete($id)
	{
		$this->load->model("user");
		$this->user->deleteUser($id);
		redirect(base_url()."admin/dashboard/user");
	}
	public function add(){
		$this->load->model("user");
			
		if($this->input->post())
		{
			if(!$this->user->isExistUser($this->input->post("userName")))
			{
				if(!$this->user->isExistEmail($this->input->post("email")))
				{

					$userData=array("userName"=>$this->input->post("userName"),
									"email"=>$this->input->post("email"),
									"phoneNumber"=>$this->input->post("phoneNumber"),
									"companyName"=>$this->input->post("companyName"),
									"password"=>$this->input->post("password"),
									"userTypeID"=>$this->input->post("userType"),
									'createdDate'=>date("Y-m-d"),
									'createdBy'=>'3',
									);
					$userID = $this->user->createUser($userData);
					if($userID)
					{
						//$this->session->set_userdata('userID', $userID);
						//$this->session->set_userdata('userName', $this->input->post("userName"));
						//$this->session->set_userdata('userTypeID',$this->input->post("userType"));
						//$this->session->set_userdata('userType','admin');
						/*if($this->input->post("userType")==1)
							$this->session->set_userdata('userType','admin');
						else if($this->input->post("userType")==2)
							$this->session->set_userdata('userType','advertiser');
						else if($this->input->post("userType")==3)
							$this->session->set_userdata('userType','publisher');*/
						echo 1;  // isert successfully
						

						$paymentData=array(
							'userID'=>$userID,
							'createdDate'=>date("Y-m-d"),
							'createdBy'=>'3',
						);
						$this->load->model('payments');
						$payId=$this->payments->add($paymentData);
					}
					else
					{
						echo 0; // database error
					}
				}
				else
				{
					echo 103;  //email iss already exist
				}
			}
			else
			{
				echo 102;  // username is already exist
			}
		}
		else
		{
			$data['userType']=$this->user->getUserType();
			$this->layout->view('profile_add',$data);
		}
	}
	public function addSMA()
	{
		if($this->input->post())
		{
			if(array_filter($this->input->post()))
			{
				$userData = array("userid"=>$this->session->userdata("userID"),
								  "facebook_url"=>$this->input->post("facebook_url"),
								  "twitter_url"=>$this->input->post("twitter_url"),
								  "instagram_url"=>$this->input->post("instagram_url"),
								  "pinterest_url"=>$this->input->post("pinterest_url"),
								  "tubmlr_url"=>$this->input->post("tubmlr_url"));
				//print_R($userData); exit;				  
				$privacyData = array("userid"=>$this->session->userdata("userID"),
									 "facebook_url"=>$this->input->post("fb"),
									 "twitter_url"=>$this->input->post("tw"),
									 "instagram_url"=>$this->input->post("in"),
									 "pinterest_url"=>$this->input->post("pin"),
									 "tumblr_url"=>$this->input->post("tum"));
				$num = $this->user->getUserSMAUrlsCount($this->session->userdata("userID"));
				if($num == 1)
				{
					$id  = $this->user->updateSMALinks($this->session->userdata("userID"),$userData);
				}
				else
				{
					$id  = $this->user->addSMALinks($userData);
				}	
				$true = $this->user->existPrivacyofUserUrl($this->session->userdata("userID"));
				if($true==1)
				{
					$this->user->updatePrivacyofUserUrl($this->session->userdata("userID"),$privacyData);
				}
				else
				{
					$this->user->insertPrivacyofUserUrl($privacyData);
				}
				
				if($id)
				{
					echo $this->session->userdata("userTypeID");
				}
				else
				{
					echo 0;
				}
			}
			else
			{
				echo 301;
			}	
		}
		else
		{
			$data["url"] = $this->user->getUserSMAUrls($this->session->userdata("userID"));
			$data["privacy"] = $this->user->getUsersUrlPrivacy($this->session->userdata("userID"));
			$this->layout->view("add_SMA_Links",$data);
		}
	}
}