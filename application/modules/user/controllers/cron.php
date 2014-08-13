<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends MX_Controller {
	private $connection;
    public $type="";
	public function __construct()
	{
		parent::__construct();
		//Loading twitter libraries and setting config for twitter 
		$this->load->library('twitteroauth');
		$this->config->load('twitter');
		$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		
		//Loading instagram libraries and setting config for instagram
		$instagramConfig['apiKey'] = $this->config->item('instagram_apiKey'); 
        $instagramConfig['apiSecret'] = $this->config->item('instagram_apiSecret'); 
        $instagramConfig['apiCallback'] = $this->config->item('instagram_apiCallback');
        $this->load->library('Instagram', $instagramConfig); 
		
		//Loading model
		$this->load->model("smaaccount");
	}
	
	public function index()
	{
        
	}
	
	public function twitter()
	{	
		$users = $this->smaaccount->getSMA_TwitterIDs();
		foreach($users as $id)
		{
			$user_Data = $this->connection->get("https://api.twitter.com/1.1/users/show.json?user_id=".$id['smaAccountID']);
			$userData = array();
			if(isset($user_Data->screen_name))
			{	
				$userData["smaAccountName"] = $user_Data->screen_name;
				$userData["smaAccountProfileImageUrl"] = $user_Data->profile_background_image_url;
				$userData["smaAccountFollowers"] = $user_Data->followers_count;
				$userData["smaAccountPosts"] = $user_Data->statuses_count;
				//echo "<pre>"; print_R($userData); exit;
				$true = $this->smaaccount->updateSMA_Accounts($id['id'],$userData);
				if($true)
				{
					echo $id['smaAccountID'].":Twitter Account updated.<br/>";
				}
				else
				{
					echo $id['smaAccountID'].":Twitter Account not updated.<br/>";
				}
			}	
		}
	}
	
	public function instagram()
	{
		$users = $this->smaaccount->getSMA_InstagramIDs();
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
					echo $id['smaAccountID'].":Instagram Account updated.<br/>";
				}
				else
				{
					echo $id['smaAccountID'].":Instagram Account not updated.<br/>";
				}
			}
		}
	}	
}
?>