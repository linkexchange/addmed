<?php 
class Transaction extends CI_Model{
	public function add($tranData)
	{
		$this->db->insert($this->config->item('table_transaction'), $tranData);
		return $this->db->insert_id();
		
	}
	public function isExist($tranData)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_transaction'));
		$this->db->where($tranData); 
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();;

	}
	public function getTransactions($userID=0,$limit=0)
	{
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;
		$startRecord=$limit*$numberofrecords;
		$this->db->select("*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_transaction'));
		if($this->session->userData('userTypeID')==3) :
			$this->db->join($this->config->item('table_user'),$this->config->item('table_transaction').".payerID = ".$this->config->item('table_user').".id",'left');
			$this->db->where('payeeID',$userID);
		elseif($this->session->userData('userTypeID')==2) :
			$this->db->join($this->config->item('table_user'),$this->config->item('table_transaction').".payeeID = ".$this->config->item('table_user').".id",'left');
			$this->db->where('payerID',$userID);
		else :
			$this->db->join($this->config->item('table_user'),$this->config->item('table_transaction').".payeeID = ".$this->config->item('table_user').".id",'left');
			$this->db->where('payerID',$userID);
		endif;
		//$this->db->where('payeeID',"0");
		$this->db->order_by($this->config->item('table_transaction').'.createdDate',"DESC");
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTransactionsCount($userID=0)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_transaction'));
		if($this->session->userData('userTypeID')==3) :
			$this->db->join($this->config->item('table_user'),$this->config->item('table_transaction').".payerID = ".$this->config->item('table_user').".id",'left');
			$this->db->where('payeeID',$userID);
		elseif($this->session->userData('userTypeID')==2) :
			$this->db->join($this->config->item('table_user'),$this->config->item('table_transaction').".payeeID = ".$this->config->item('table_user').".id",'left');
			$this->db->where('payerID',$userID);
		else :
			$this->db->join($this->config->item('table_user'),$this->config->item('table_transaction').".payerID = ".$this->config->item('table_user').".id",'left');
			$this->db->where('payeeID',$userID);
		endif;
		//$this->db->where('payeeID',"0");
		$result = $this->db->get();
		return $result->num_rows();
	}
	public function getTransactionsAdvertiser($userID=0,$limit=0)
	{
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;
		$startRecord=$limit*$numberofrecords;
		$this->db->select("*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_transaction'));
		//$this->db->where('payerID',$userID);
		$this->db->join($this->config->item('table_user'),$this->config->item('table_transaction').".payerID = ".$this->config->item('table_user').".id",'left');
		$this->db->where('payeeID',"3");
		$this->db->order_by($this->config->item('table_transaction').'.createdDate',"DESC");
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTransactionsAdvertiserCount($userID=0)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_transaction'));
		//$this->db->where('payerID',$userID);
		$this->db->where('payeeID',"3");
		$result = $this->db->get();
		return $result->num_rows();
	}
}
?>