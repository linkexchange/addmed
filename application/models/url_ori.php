<?php
class Url extends CI_Model {

	public function add($urlData)
	{
		$this->db->insert($this->config->item('table_url'), $urlData);
		return $this->db->insert_id();
	}
	function updateUrl($urlData,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_url'), $urlData);
		return $this->db->affected_rows();	
		
	}
	function deleteUrl($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_url'));
	}

	public function getUrlById($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_url'));
		$this->db->where('id',$id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();

	}
	public function isExist($urlData)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_url'));
		$this->db->where($urlData); 
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();;

	}
	public function getAllUrl($limit=0)
	{
		$numberofrecords=50;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id",'left');
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getUrlCount($userID=0)
	{
		$this->db->select("id");
		$this->db->from($this->config->item('table_url'));
		if($userID)
		{
			if($this->session->userData('userTypeID')==2)
			{
				$this->db->where("advertiserID",$userID);
			}
			else if($this->session->userData('userTypeID')==3)
			{
				$this->db->where("publisherID",$userID);
			}
		}
		$result=$this->db->get();
		return $result->num_rows();
	}
	public function getAllAdvertiserUrl($advertiserID,$limit=0)
	{
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".publisherID = ".$this->config->item('table_user').".id",'left');
		$this->db->where("advertiserID =", $advertiserID);
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getAllAdvertiserUrlCount($advertiserID)
	{
		
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".publisherID = ".$this->config->item('table_user').".id",'left');
		$this->db->where("advertiserID =", $advertiserID);
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();

	}

	public function getAllPublisherUrl($publisherID,$limit=0)
	{
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;	
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id",'left');
		$this->db->where("publisherID =", $publisherID);
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $rowcount = $result->result_array();
	}

	public function getAllPublisherUrlCount($publisherID)
	{
		
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id",'left');
		$this->db->where("publisherID =", $publisherID);
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $rowcount = $result->num_rows();
	}
	/*
	used to get count of advertiser url which is published by publisher 
	?*/
	public function getPublishedUrls($userID=0,$limit=0)
	{
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".publisherID = ".$this->config->item('table_user').".id");
		$this->db->where("advertiserID", $userID);
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	/*ussed to show all publisshed url by publisher */
	public function getPublishedUrlsCount($userID=0)
	{
		
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".publisherID = ".$this->config->item('table_user').".id");
		$this->db->where("advertiserID", $userID);
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	/*ussed to show all publisshed url Count by publisher */


	public function getPublisherUrls($userID=0,$limit=0)
	{
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id");
		//$this->db->join($this->config->item('table_clicksdetail'),$this->config->item('table_url').".id = ".$this->config->item('table_clicksdetail').".linkID","left");
		$this->db->where("publisherID", $userID);
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	public function getUnPublishedUrls($limit=0,$userID=0)
	{
		
		//echo $limit;
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select("*");
		$this->db->from($this->config->item('table_url'));
		$this->db->where("publisherID", 0);
		if($userID)
		{
			$this->db->where("advertiserID", $userID);
		}
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getUnPublishedUrlsCount($userID=0)
	{
		
		//echo $limit;
		
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
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".publisherID = ".$this->config->item('table_user').".id");
		$this->db->join($this->config->item('table_clicksdetail'),$this->config->item('table_clicksdetail').".linkID = ".$this->config->item('table_url').".id",'left');
		$this->db->join($this->config->item('table_transaction'),$this->config->item('table_transaction').".linkID != ".$this->config->item('table_url').".id");
		$this->db->where("advertiserID", $userID);
		$this->db->where("numberOfClicks"." >", "0");
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTotalLinks($uid=3)
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
				$this->db->where("publisherID",$uid);
			}
		}
		$result=$this->db->get();
		return $result->num_rows();
	}
	public function getTotalPublishedLinks($uid=3){
		$this->db->select("id");
		$this->db->from($this->config->item('table_url'));
		if($uid)
		{
			if($this->session->userData('userTypeID')==2)
			{
				$this->db->where("advertiserID",$uid);
				$this->db->where("publisherID !=","0");
			}
			else if($this->session->userData('userTypeID')==3)
			{
				$this->db->where("publisherID",$uid);
			}
			else
			{
				$this->db->where("publisherID !=","0");
			}
		}
		$result=$this->db->get();
		return $result->num_rows();
	}
	public function getTotalPublishedAdvertiserLinks($uid=3){
		$this->db->select("id");
		$this->db->from($this->config->item('table_url'));
		
		$this->db->where("advertiserID",$uid);
		$this->db->where("publisherID !=","0");
		$result=$this->db->get();
		return $result->num_rows();
	}
	public function getAllBitlyUrllinks(){
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_publisher').".accessToken");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_publisher'),$this->config->item('table_url').".publisherID = ".$this->config->item('table_publisher').".userID",'left');
		$this->db->where("billyUrl !=","");
		$result=$this->db->get();
		return $result->result_array();
	}
}