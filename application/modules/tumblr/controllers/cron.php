<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends MX_Controller {
	private $connection;
    public $type="";
	public function __construct()
	{
		parent::__construct();
		// Loading TumblrOauth library. Delete this line if you choose autoload method.
		$this->load->library('tumblroauth');
		// Loading tumblr configuration.
		$this->config->load('tumblr');
		//echo $this->config->item('tumblr_consumer_token'); exit;
		$this->connection = $this->tumblroauth->create($this->config->item('tumblr_consumer_token'), $this->config->item('tumblr_consumer_secret'), "CfCiqaeINwjLdrPB0l9KqAGzQR8Cfs3zu2i7BqkHxI9JcXgbnr",  "sKDZoutHLRRdKf0iKiJnGUUd9TMVzjqlHiucBZV1hpM4rbUdJh");
		$this->load->model("smaaccount");
	}
	
	public function index()
	{
        //$users = $this->smaaccount->getSMA_AccountIDs();
		//foreach($users as $id)
		//{
			$user_Data = $this->connection->get("http://api.tumblr.com/v2/user/info");
			//$apidata = json_decode(file_get_contents("http://api.tumblr.com/v2/user/info?api_key=U4iX6vH9S5wiwREweDaaziDescALXTmuwHJozEitpNzWWakm6q"));
			//echo "<pre>"; print_R($user_Data); exit;
			$userData = array();
			if(isset($user_Data->screen_name))
			{	
				$userData["smaAccountName"] = $user_Data->screen_name;
				$userData["smaAccountProfileImageUrl"] = $user_Data->profile_background_image_url;
				$userData["smaAccountFollowers"] = $user_Data->followers_count;
				$userData["smaAccountPosts"] = $user_Data->statuses_count;
				//echo "<pre>"; print_R($userData); exit;
				$true = $this->smaaccount->updateSMA_Accounts($id['smaAccountID'],$userData);
				if($true)
				{
					echo $id['smaAccountID'].":Account updated.<br/>";
				}
				else
				{
					echo $id['smaAccountID'].":Account not updated.<br/>";
				}
			}	
		//}
	}
	
   
}
?>