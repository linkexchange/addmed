<?php
class Clicksdetail extends CI_Model {
	public function getClicksdetailsById($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_clicksdetail'));
		$this->db->where('id',$id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();

	}
	public function getPublisherTotalAmount($uid){
		$this->db->select_sum('publisherPayment');
		$this->db->from($this->config->item('table_clicksdetail'));
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".id = ".$this->config->item('table_clicksdetail').".publishedLinkID");
		$this->db->where("publisherID =", $uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	public function getTotalHits($uid=0){
		$this->db->select_sum('numberOfClicks');
		$this->db->from($this->config->item('table_clicksdetail'));
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".id = ".$this->config->item('table_clicksdetail').".publishedLinkID");
		$this->db->where("publisherID =", $uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}

	public function getTotalHitsOfAdvertiserLinks($uid=0){
		$this->db->select_sum('numberOfClicks');
		$this->db->from($this->config->item('table_clicksdetail'));
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".id = ".$this->config->item('table_clicksdetail').".publishedLinkID");
		$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id=".$this->config->item('table_published_url').".linkID");
		$this->db->where($this->config->item('table_url').".advertiserID =", $uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getClickRecords($uid=0,$StartDate=0,$endDate=0,$limit=0){
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_clicksdetail').".numberOfClicks,".$this->config->item('table_clicksdetail').".publisherPayment,".$this->config->item('table_clicksdetail').".advertiserPaynment,".$this->config->item('table_clicksdetail').".commission,".$this->config->item('table_clicksdetail').".createdDate,".$this->config->item('table_url').".url,".$this->config->item('table_url').".payPerLink,".$this->config->item('table_published_url').".bitlyURL,".$this->config->item('table_url').".percentage,".$this->config->item('table_url').".advertiserID,".$this->config->item('table_published_url').".publisherID,".$this->config->item('table_user').".userName");

		$this->db->from($this->config->item('table_clicksdetail'));

		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".id = ".$this->config->item('table_clicksdetail').".publishedLinkID");
		
		$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id=".$this->config->item('table_published_url').".linkID");
		
		if($this->session->userData('userTypeID')==3){
			$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_url').".advertiserID");
			$this->db->where($this->config->item('table_published_url').'.publisherID',$uid);
		}
		elseif($this->session->userData('userTypeID')==2){
			$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_published_url').".publisherID");
			$this->db->where($this->config->item('table_url').'.advertiserID',$uid);
		}
		else{
			$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_url').".advertiserID");
			
			//$this->db->where($this->config->item('table_url').'.publisherID',$uid);

		}
		
		if($StartDate && !$endDate){
			$this->db->where($this->config->item('table_clicksdetail').'.createdDate >=',$StartDate);
		}
		elseif(!$StartDate && $endDate){
			$this->db->where($this->config->item('table_clicksdetail').'.createdDate <=',$endDate);
		}
		elseif($StartDate && $endDate){
			$this->db->where($this->config->item('table_clicksdetail').'.createdDate >=',$StartDate);
			$this->db->where($this->config->item('table_clicksdetail').'.createdDate <=',$endDate);
		}
		else
		{

		}
		$this->db->order_by($this->config->item('table_clicksdetail').'.createdDate',"ASC");
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getClickRecordsCount($uid=0,$StartDate=0,$endDate=0){
	
		$this->db->select($this->config->item('table_clicksdetail').".numberOfClicks,".$this->config->item('table_clicksdetail').".publisherPayment,".$this->config->item('table_clicksdetail').".advertiserPaynment,".$this->config->item('table_clicksdetail').".commission,".$this->config->item('table_clicksdetail').".createdDate,".$this->config->item('table_url').".url,".$this->config->item('table_url').".payPerLink,".$this->config->item('table_published_url').".bitlyURL,".$this->config->item('table_url').".percentage,".$this->config->item('table_url').".advertiserID,".$this->config->item('table_published_url').".publisherID,".$this->config->item('table_user').".userName");

		$this->db->from($this->config->item('table_clicksdetail'));

		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".id = ".$this->config->item('table_clicksdetail').".publishedLinkID");
		
		$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id=".$this->config->item('table_published_url').".linkID");
		
		if($this->session->userData('userTypeID')==3){
			$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_url').".advertiserID");
			$this->db->where($this->config->item('table_published_url').'.publisherID',$uid);
		}
		elseif($this->session->userData('userTypeID')==2){
			$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_published_url').".publisherID");
			$this->db->where($this->config->item('table_url').'.advertiserID',$uid);
		}
		else{
			$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_url').".advertiserID");
			
			//$this->db->where($this->config->item('table_url').'.publisherID',$uid);

		}
		
		if($StartDate && !$endDate){
			$this->db->where($this->config->item('table_clicksdetail').'.createdDate >=',$StartDate);
		}
		elseif(!$StartDate && $endDate){
			$this->db->where($this->config->item('table_clicksdetail').'.createdDate <=',$endDate);
		}
		elseif($StartDate && $endDate){
			$this->db->where($this->config->item('table_clicksdetail').'.createdDate >=',$StartDate);
			$this->db->where($this->config->item('table_clicksdetail').'.createdDate <=',$endDate);
		}
		else
		{

		}

		$this->db->order_by($this->config->item('table_clicksdetail').'.createdDate',"ASC");
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}

	public function getTotalHitsByLinkId($id){
		$this->db->select_sum('numberOfClicks');
		$this->db->from($this->config->item('table_clicksdetail'));
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".id = ".$this->config->item('table_clicksdetail').".publishedLinkID");
		$this->db->where($this->config->item('table_published_url').".linkID =", $id);
		if($this->session->userdata('userTypeID')==3)
			$this->db->where($this->config->item('table_published_url').".publisherID =", $this->session->userdata('userID'));

		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTotalPublisherPaymentForLinkId($id){
		$this->db->select_sum('publisherPayment');
		$this->db->from($this->config->item('table_clicksdetail'));
		//$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id = ".$this->config->item('table_clicksdetail').".linkID");
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".id = ".$this->config->item('table_clicksdetail').".publishedLinkID");
		$this->db->where($this->config->item('table_published_url').".linkID =", $id);

		if($this->session->userdata('userTypeID')==3)
			$this->db->where($this->config->item('table_published_url').".publisherID =", $this->session->userdata('userID'));

		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTotalAdvertiserPaymentForLinkId($id){
		$this->db->select_sum('advertiserPaynment');
		$this->db->from($this->config->item('table_clicksdetail'));
		//$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id = ".$this->config->item('table_clicksdetail').".publishedLinkID");
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".id = ".$this->config->item('table_clicksdetail').".publishedLinkID");
		//$this->db->where("publishedLinkID =", $id);
		$this->db->where($this->config->item('table_published_url').".linkID =", $id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTotalHitsByLinkIdNew($id){
		$this->db->select_sum('numberOfClicks');
		$this->db->from($this->config->item('table_clicksdetail'));
		//$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id = ".$this->config->item('table_clicksdetail').".linkID");
		$this->db->where("publishedLinkID =", $id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		$clicks=$result->result_array();
		if(isset($clicks[0]['numberOfClicks']))
			$totalclicks=$clicks[0]['numberOfClicks'];
		else
			$totalclicks=0;
		return $totalclicks;
	}
	public function isExists($linkID=0,$date="0000-00-00"){
		$this->db->select("id");
		$this->db->from($this->config->item('table_clicksdetail'));
		$this->db->where('publishedLinkID',$linkID);
		$this->db->where('createdDate',$date);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	public function add($clicksData)
	{
		$this->db->insert($this->config->item('table_clicksdetail'), $clicksData);
		return $this->db->insert_id();
	}
	function updateClickRecord($clicksData,$linkID,$createdDate="0000-00-00")
	{
		$this->db->where("publishedLinkID",$linkID);
		$this->db->where("createdDate",$createdDate);
		$this->db->update($this->config->item('table_clicksdetail'), $clicksData);
		return $this->db->affected_rows();	
	}
	public function getClickedLinksByUserID($uid=0,$adv=0){
		$this->db->select_sum("publisherPayment");
		$this->db->select_sum("advertiserPaynment");
		$this->db->select_sum("commission");
		$this->db->from($this->config->item('table_clicksdetail'));
		
		$this->db->join($this->config->item('table_published_url'),$this->config->item('table_published_url').".id=".$this->config->item('table_clicksdetail').".publishedLinkID");
		
		$this->db->join($this->config->item('table_url'),$this->config->item('table_url').".id = ".$this->config->item('table_published_url').".linkID");
	
		if($adv==0)
			$this->db->where($this->config->item('table_published_url').'.publisherID',$uid);
		elseif($adv==1)
			$this->db->where($this->config->item('table_url').'.advertiserID',$uid);
			
		//$this->db->where('createdDate',$date);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
}
?>