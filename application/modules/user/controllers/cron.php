<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends MX_Controller {
	private $connection;
    public $type="";
	public function __construct()
	{
		parent::__construct();
		
		//Loading model
		$this->load->model("smaaccount");
		
		//Loading twitter libraries and setting config for twitter 
		$this->load->library('twitteroauth');
		$this->config->load('twitter');
		$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		
		//Loading instagram libraries and setting config for instagram
		$instagramConfig['apiKey'] = $this->config->item('instagram_apiKey'); 
        $instagramConfig['apiSecret'] = $this->config->item('instagram_apiSecret'); 
        $instagramConfig['apiCallback'] = $this->config->item('instagram_apiCallback');
        $this->load->library('Instagram', $instagramConfig); 
		
		// Loading tumblr configuration.
		$this->config->load('tumblr');
		$this->load->library('tumblroauth');
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

	public function tumblr()
	{
		$users = $this->smaaccount->getSMA_tumblrURLs();
		$api_key = $this->config->item("tumblr_consumer_token");
		//echo "<pre>"; print_R($users); exit;
		$k=0; $j=0;
		foreach($users as $user)
		{
			if($user["tumblr_blog_url"]!="")
			{
				$urls    = explode(",",$user["tumblr_blog_url"]);
				$userid[$j]  = $user["id"];
				$nob[$j] = $user["smaAccountBlogs"];
				//echo "<pre>"; print_R($urls); exit;
				foreach($urls as $url)
				{
					$api_Data[$k] = json_decode(file_get_contents("http://api.tumblr.com/v2/blog/".$url."info?api_key=$api_key"));
					//$follow_Data[$k] = json_decode(file_get_contents("http://api.tumblr.com/v2/blog/".$url."followers"));
					$k++;
				}
				$j++;
			}
		}
		//echo count($api_Data);
		//echo "<pre>"; print_R($api_Data);
		//echo "<pre>"; print_R($userid); 
		//echo "<pre>"; print_R($nob); exit;
		//echo $k; exit;
		for($t=0;$t<count($nob);$t++)
		{
			$api_Data = array_chunk($api_Data,$nob[$t]);
		}	
		$api_Data = $api_Data[0]; 
		for($h=0;$h<count($api_Data);$h++)
		{
			$userData = $api_Data[$h];
			$smaAccountPosts = 0;
			$smaAccountLikes = 0;
			//echo "<pre>"; print_R($userData[0]->response->blog->posts); exit;
			for($f=0;$f<count($userData);$f++)
			{
				if(isset($userData[$f]->response->blog->posts))
				{
					$smaAccountPosts = $smaAccountPosts + $userData[$f]->response->blog->posts;
					$user_Data["smaAccountPosts"] = $smaAccountPosts;
				}
				if(isset($userData[$f]->response->blog->likes))
				{
					$smaAccountLikes = $smaAccountLikes + $userData[$f]->response->blog->likes;
					$user_Data["smaAccountLikes"] = $smaAccountLikes;
				}
			}
			//echo "<pre>"; print_R($user_Data); exit;
			
			$true = $this->smaaccount->updateSMA_Accounts($userid[$h],$user_Data);
			if($true)
			{
				echo $userid[$h]." : tumblr Account updated.<br/>";
			}
			else
			{
				echo $userid[$h]." : tumblr Account not updated.<br/>";
			}
		}
	}	
}
?>