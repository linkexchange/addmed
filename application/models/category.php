<?php
class Category extends ActiveRecord\Model {
    static $table_name = 'category';
	function getcategories()
	{
		$all_category = category::find('all'); // or User:find('all')
		return $all_category;	
	}
}
?>