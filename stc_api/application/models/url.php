<?php
class Url extends CI_Model {

	public function add($urlData)
	{
		//print_r($urlData); exit;
		$this->db->insert($this->config->item('table_url'), $urlData);
		return $this->db->insert_id();
	}
	function updateUrl($urlData,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_url'), $urlData);
		return $this->db->affected_rows();	
	}


	function acceptLink($urlData)
	{
		$this->db->insert($this->config->item('table_published_url'), $urlData);
		return $this->db->insert_id();
	}
	function setBitlyLink($urlData,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_published_url'), $urlData);
		return $this->db->affected_rows();	
	}

	function updateCategory($data,$id)
	{
		$this->db->where("id",$id);
		$this->db->update('categories', $data);
		return $this->db->affected_rows();	
	}
	function deleteUrl($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_url'));
	}
	function removePublishedUrl($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_published_url'));
	}
	function deleteCategory($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('categories');
	}
	public function getUrlByIdForPub($id)
	{
		$this->db->select($this->config->item('table_published_url').".*,".$this->config->item('table_url').".url");
		$this->db->from($this->config->item('table_published_url'));
		$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id=".$this->config->item('table_published_url').".linkID");
		$this->db->where($this->config->item('table_published_url').'.id',$id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();

	}
	public function getUrlByIdForAdv($id)
	{
		$this->db->select($this->config->item('table_url').".*");
		$this->db->from($this->config->item('table_url'));
		$this->db->where($this->config->item('table_url').'.id',$id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();

	}
	
	public function getCatById($id)
	{
		$this->db->select("*");
		$this->db->from('categories');
		$this->db->where('id',$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function isExist($urlData)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_url'));
		$this->db->where($urlData); 
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();

	}
	public function isExistCategory($data)
	{
		$this->db->select("*");
		$this->db->from('categories');
		$this->db->where($data); 
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();;
	}
	public function add_Category($data)
	{
		//print_R($data); exit;
		$this->db->insert('categories', $data); 
	}
	public function getAllUrl($cat="",$limit=0)
	{
		
		$numberofrecords=50;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName,".$this->config->item('table_published_url').".publisherID,".$this->config->item('table_published_url').".bitlyURL,".$this->config->item('table_published_url').".id as publishedID");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id",'left');

		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_url').".id = ".$this->config->item('table_published_url').".linkID",'left');

		if($cat)
			$this->db->where("categoryID =", $cat);

		$this->db->group_by($this->config->item('table_url').".id");
		$this->db->order_by('payPerLink','desc');
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getAllCategories($limit=0)
	{
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select("*");
		$this->db->from("categories");
		if($limit!="ALL")
			$this->db->limit($numberofrecords,$startRecord);

		$result = $this->db->get();
		//echo $this->db->last_query(); 
		return $result->result_array();
	}
	public function getAllUrls()
	{
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id",'left');
		$result = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $result->result_array();
	}
	public function get_all_categories()
	{
		$this->db->select('*');
		$this->db->from('categories');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getCatCount()
	{
		$this->db->select("id");
		$this->db->from('categories');
		$result=$this->db->get();
		return $result->num_rows();
	}
	public function getCategoryCPCByID($catID){
		$this->db->select("cost_per_click");
		$this->db->from('categories');
		$this->db->where("id =", $catID);
		$result=$this->db->get();
		return $result->result_array();
	}
	public function getUrlCount($userID=0,$cat="")
	{
		$this->db->select($this->config->item('table_url').".id");
		$this->db->from($this->config->item('table_url'));
		if($userID)
		{
			if($this->session->userData('userTypeID')==2)
			{
				$this->db->where("advertiserID",$userID);
			}
			else if($this->session->userData('userTypeID')==3)
			{
				$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".linkID=".$this->config->item('table_url').".id");
				$this->db->where("publisherID",$userID);
			}
		}
		if($cat)
			$this->db->where("categoryID =", $cat);
		$result=$this->db->get();
		return $result->num_rows();
	}
	public function getAllAdvertiserUrl($advertiserID,$cat="",$limit=0)
	{
		$numberofrecords=50;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));

		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id",'left');

		$this->db->where("advertiserID =", $advertiserID);
		if($cat)
			$this->db->where("categoryID =", $cat);

		$this->db->order_by('categoryID',$cat);
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getAllAdvertiserUrlCount($advertiserID)
	{
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".linkID=".$this->config->item('table_url').".id");

		$this->db->where("advertiserID =", $advertiserID);
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}

	public function getAllPublisherUrl($publisherID,$cat="",$limit=0)
	{
		$numberofrecords=50;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;	
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName,".$this->config->item('table_published_url').".bitlyURL");
		$this->db->from($this->config->item('table_url'));
		
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id",'left');
		
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".linkID=".$this->config->item('table_url').".id");

		$this->db->where("publisherID =", $publisherID);
		if($cat)
			$this->db->where("categoryID =", $cat);

		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by('payPerLink','desc');
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $rowcount = $result->result_array();
	}

	public function getAllPublisherUrlCount($publisherID)
	{
		
		$this->db->select("id");
		$this->db->from($this->config->item('table_published_url'));
		$this->db->where("publisherID =", $publisherID);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $rowcount = $result->num_rows();
	}
	public function getcategoryNameById($id)
	{
		$this->db->select('category_name');
		$this->db->from('categories');
		$this->db->where('id',$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	/*
	used to get count of advertiser url which is published by publisher 
	?*/
	public function getPublishedUrls($userID=0,$limit=0)
	{
		$numberofrecords=50;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName,".$this->config->item('table_published_url').".id as publishedID");
		$this->db->from($this->config->item('table_url'));
		
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".linkID=".$this->config->item('table_url').".id");


		$this->db->join($this->config->item('table_user'),$this->config->item('table_published_url').".publisherID = ".$this->config->item('table_user').".id");

		$this->db->where("advertiserID", $userID);
		
		$this->db->group_by($this->config->item('table_url').".id");

		$this->db->limit($numberofrecords,$startRecord);


		$this->db->order_by("payPerLink", "desc");
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	/*ussed to show all publisshed url by publisher */
	public function getPublishedUrlsCount($userID=0)
	{
		
		$this->db->select("distinct(".$this->config->item('table_url').".id)");
		$this->db->from($this->config->item('table_url'));

		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".linkID=".$this->config->item('table_url').".id");

		$this->db->join($this->config->item('table_user'),$this->config->item('table_published_url').".publisherID = ".$this->config->item('table_user').".id");
		$this->db->where("advertiserID", $userID);
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	/*ussed to show all publisshed url Count by publisher */


	public function getPublisherUrls($userID=0,$limit=0)
	{
		$numberofrecords=50;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_published_url').".bitlyURL,".$this->config->item('table_user').".userName,".$this->config->item('table_published_url').".id as publishedID");
		$this->db->from($this->config->item('table_url'));

		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id");
		
		//$this->db->join($this->config->item('table_clicksdetail'),$this->config->item('table_url').".id = ".$this->config->item('table_clicksdetail').".linkID","left");
		
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".linkID=".$this->config->item('table_url').".id");

		
		$this->db->where("publisherID", $userID);
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by('payPerLink','desc');
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	public function getUnPublishedUrls($limit=0,$userID=0)
	{
		
		//echo $limit;
		$numberofrecords=50;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_url').".*");
		
		$this->db->from($this->config->item('table_url'));

		
		
		$this->db->join($this->config->item('table_categories'),$this->config->item('table_url').".categoryID = ".$this->config->item('table_categories').".id",'left');
		
		$query = 'select linkID from '.$this->config->item("table_published_url");
		
		if($this->session->userData('userTypeID')==3)
		{
			$query .=" where publisherID = ".$this->session->userData('userID');
		}

		$this->db->where($this->config->item('table_url').".id NOT IN (".$query.")");


		if($userID)
		{
			$this->db->where("advertiserID", $userID);
		}
		$this->db->order_by("payPerLink", "desc");
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		
		return $result->result_array();
	}
	public function getUnPublishedUrlsCount($userID=0)
	{
		
		//echo $limit;
		
		$this->db->select("distinct(".$this->config->item('table_url').".id)");
		$this->db->from($this->config->item('table_url'));
		if($this->session->userData('userTypeID')==3 && $userID){
				$query = 'select linkID from '.$this->config->item("table_published_url").' where publisherID='.$userID;
		}
		else
		{
			$query = 'select linkID from '.$this->config->item("table_published_url");
		}
		//echo $userID;
		//echo $query;
		//exit;
		$this->db->where($this->config->item('table_url').".id NOT IN (".$query.")");
		if($userID && $this->session->userData('userTypeID')!=3)
		{	

			$this->db->where("advertiserID", $userID);
		}
		
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	/*public function getUnPublishedUrlsCount($userID=0)
	{
		
		$this->db->select("*");
		$this->db->from($this->config->item('table_url'));
		$this->db->where("publisherID", 0);
		if($userID)
		{
			$this->db->where("advertiserID", $userID);
		}
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	
	}*/
	
	// Get ID of published urls for add payemt
	public function getPublishedAdvertiserUrls($userID=0)
	{
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".linkID=".$this->config->item('table_url').".id");

		$this->db->join($this->config->item('table_user'),$this->config->item('table_published_url').".publisherID = ".$this->config->item('table_user').".id");
		
		$this->db->join($this->config->item('table_clicksdetail'),$this->config->item('table_clicksdetail').".linkID = ".$this->config->item('table_url').".id",'left');
		$this->db->join($this->config->item('table_transaction'),$this->config->item('table_transaction').".linkID != ".$this->config->item('table_url').".id");
		$this->db->where("advertiserID", $userID);
		$this->db->where("numberOfClicks"." >", "0");
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTotalLinks($uid=0)
	{
		$this->db->select("id");
		$this->db->from($this->config->item('table_url'));
		if($uid)
		{
			if($this->session->userData('userTypeID')==2)
			{
				$this->db->where("advertiserID",$uid);
			}
			else if($this->session->userData('userTypeID')==3)
			{
				$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".publisherID =".$uid);
			}
		}
		$result=$this->db->get();
		return $result->num_rows();
	}
	public function getTotalPublishedLinks($uid=0){
		$this->db->select("linkID");
		$this->db->from($this->config->item('table_published_url'));
		if($uid)
		{
			if($this->session->userData('userTypeID')==2)
			{
				$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id=".$this->config->item('table_published_url').".linkID");
				$this->db->where($this->config->item('table_url').".advertiserID",$uid);
			}
			else if($this->session->userData('userTypeID')==3)
			{
				$this->db->where("publisherID",$uid);
			}
		}
		$this->db->group_by("linkID");
		$result=$this->db->get();
		return $result->num_rows();
	}
	public function getTotalPublishedAdvertiserLinks($uid=0){
		$this->db->select("distinct(".$this->config->item('table_url').".id)");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".linkID=".$this->config->item('table_url').".id");
		$this->db->where("advertiserID",$uid);
		$result=$this->db->get();
		return $result->num_rows();
	}
	public function getAllBitlyUrllinks(){
		$this->db->select($this->config->item('table_published_url').".*,".$this->config->item('table_url').".payPerLink,".$this->config->item('table_url').".percentage,".$this->config->item('table_publisher').".accessToken");
		$this->db->from($this->config->item('table_published_url'));
		$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id=".$this->config->item('table_published_url').".linkID");
		$this->db->join($this->config->item('table_publisher'),$this->config->item('table_published_url').".publisherID = ".$this->config->item('table_publisher').".userID",'left');
		$this->db->where("bitlyURL !=","");
		$result=$this->db->get();
		return $result->result_array();
	}

	public function addCPC($id,$data)
    {
         $this->db->where('id',$id);
         $this->db->update($this->config->item('table_categories'),$data);
		 return $this->db->affected_rows();	
    }

	public function updateUrlPPCByCategory($cat_id,$urlData){
		$this->db->where("categoryID",$cat_id);
		$this->db->update($this->config->item('table_url'), $urlData);
		return $this->db->affected_rows();	
	}
}