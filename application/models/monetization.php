<?php 
class Monetization extends CI_Model{

	public function addContents($data)
	{
		$this->db->insert($this->config->item('table_contents'),$data);
		return $this->db->insert_id();
	}
	public function addDetails($data)
	{
		$this->db->insert($this->config->item('table_monetization'),$data);
		return $this->db->insert_id();
	}
	public function addPayoutDetails($data)
	{
		$this->db->insert($this->config->item('table_payouts'),$data);
		return $this->db->insert_id();
	}
	public function addEaseOfUseDetails($data)
	{
		$this->db->insert($this->config->item('table_ease_of_use'),$data);
		return $this->db->insert_id();
	}
	public function getContentsByID($id)
	{
		$this->db->select($this->config->item('table_contents').".*,".$this->config->item('table_f_articles').".topic");
		$this->db->from($this->config->item('table_contents'));
		$this->db->join($this->config->item('table_f_articles'),$this->config->item('table_contents').".articleid=".$this->config->item('table_f_articles').".id");
		$this->db->where($this->config->item('table_contents').".id",$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getContentsData($limit=0)
	{
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_contents').".*,".$this->config->item('table_f_articles').".topic");
		$this->db->from($this->config->item('table_contents'));
		$this->db->join($this->config->item('table_f_articles'),$this->config->item('table_contents').'.articleid ='.$this->config->item('table_f_articles').'.id');
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getContentsDataCount()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_contents'));
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->num_rows();
	}
	public function getMonetizedData($limit=0)
	{
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_monetization').".*,".$this->config->item('table_f_articles').".topic,ratings");
		$this->db->from($this->config->item('table_monetization'));
		$this->db->join($this->config->item('table_f_articles'),$this->config->item('table_monetization').'.articleid ='.$this->config->item('table_f_articles').'.id');
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getMonetizedData2()
	{
		$this->db->select($this->config->item('table_monetization').".*,".$this->config->item('table_f_articles').".topic,ratings");
		$this->db->from($this->config->item('table_monetization'));
		$this->db->join($this->config->item('table_f_articles'),$this->config->item('table_monetization').'.articleid ='.$this->config->item('table_f_articles').'.id');
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getEaseOfUseData($limit=0)
	{
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_ease_of_use').".*,".$this->config->item('table_f_articles').".topic,ratings");
		$this->db->from($this->config->item('table_ease_of_use'));
		$this->db->join($this->config->item('table_f_articles'),$this->config->item('table_ease_of_use').'.articleid ='.$this->config->item('table_f_articles').'.id');
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getpayoutsData($limit=0)
	{
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_payouts').".*,".$this->config->item('table_f_articles').".topic");
		$this->db->from($this->config->item('table_payouts'));
		$this->db->join($this->config->item('table_f_articles'),$this->config->item('table_payouts').'.articleid ='.$this->config->item('table_f_articles').'.id');
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getpayoutsDataCount()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_payouts'));
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->num_rows();
	}
	public function getMonetizedDataCount()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_monetization'));
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->num_rows();
	}
	public function getEaseOfUseDataCount()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_ease_of_use'));
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->num_rows();
	}
	public function getPayoutsDataByID($id)
	{
		$this->db->select($this->config->item('table_payouts').".*,".$this->config->item('table_f_articles').".topic");
		$this->db->from($this->config->item('table_payouts'));
		$this->db->join($this->config->item('table_f_articles'),$this->config->item('table_payouts').".articleid=".$this->config->item('table_f_articles').".id");
		$this->db->where($this->config->item('table_payouts').".id",$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getEaseOfUseDataByID($id)
	{
		$this->db->select($this->config->item('table_ease_of_use').".*,".$this->config->item('table_f_articles').".topic");
		$this->db->from($this->config->item('table_ease_of_use'));
		$this->db->join($this->config->item('table_f_articles'),$this->config->item('table_ease_of_use').".articleid=".$this->config->item('table_f_articles').".id");
		$this->db->where($this->config->item('table_ease_of_use').".id",$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function delete($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_monetization'));
	}
	public function deleteContents($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_contents'));
	}
	public function deleteEaseOfUse($id)
	{
		$this->db->where("id",$id);
		return $this->db->delete($this->config->item('table_ease_of_use'));
	}
	public function deletePayouts($id)
	{
		$this->db->where("id",$id);
		return $this->db->delete($this->config->item('table_payouts'));
	}
	public function updateDetails($id,$data)
	{
		$this->db->where("id",$id);
		return $this->db->update($this->config->item('table_monetization'),$data);
	}
	public function updateEaseofUseDetails($id,$data)
	{
		$this->db->where("id",$id);
		return $this->db->update($this->config->item('table_ease_of_use'),$data);
	}
	public function updateContents($id,$data)
	{
		$this->db->where("id",$id);
		return $this->db->update($this->config->item('table_contents'),$data);
	}
	public function updatePayoutDetails($id,$data)
	{
		$this->db->where("id",$id);
		return $this->db->update($this->config->item('table_payouts'),$data);
	}
}
?>