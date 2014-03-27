<?php
class Story extends ActiveRecord\Model {
    static $table_name = 'user';

	function get_all_story()
	{
		$all_users = user::find_by_username('Atindra'); // or User:find('all')
		return 	$all_users;	
	}
}
?>