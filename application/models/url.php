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
	public function getAllUrl()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_url'));
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
	public function getAllAdvertiserUrl($advertiserID)
	{
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".publisherID = ".$this->config->item('table_user').".id",'left');
		$this->db->where("advertiserID =", $advertiserID);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();

	}
	public function getAllPublisherUrl($publisherID)
	{
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id",'left');
		$this->db->where("publisherID =", $publisherID);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	/*
	used to display advertiser url which is published by publisher 
	?*/
	public function getPublishedUrls($userID=0)
	{
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".publisherID = ".$this->config->item('table_user').".id");
		$this->db->where("advertiserID", $userID);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	/*ussed to show all publisshed url by publisher */

	public function getPublisherUrls($userID=0)
	{
		$this->db->select($this->config->item('table_url').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_url'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_url').".advertiserID = ".$this->config->item('table_user').".id");
		$this->db->where("publisherID", $userID);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	public function getUnPublishedUrls($userID=0)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_url'));
		$this->db->where("publisherID", 0);
		if($userID)
		{
			$this->db->where("advertiserID", $userID);
		}
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
}