<?php 
class Payments extends CI_Model{
	public function getPaymentDetails($userID=0){
		$this->db->select("*");
		$this->db->from($this->config->item('table_payments'));
		$this->db->where('userID',$userID);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function add($payData)
	{
		$this->db->insert($this->config->item('table_payments'), $payData);
		return $this->db->insert_id();
	}
	public function getBillableAmount($uid){
		$this->db->select($this->config->item('table_payments').".billableAmount");
		$this->db->from($this->config->item('table_payments'));
		$this->db->where('id',$uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getBalanceAmount($uid=0){
		$this->db->select($this->config->item('table_payments').".balanceAmount");
		$this->db->from($this->config->item('table_payments'));
		$this->db->where('userID',$uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	function updateBalance($urlData,$id)
	{
		$this->db->where("userID",$id);
		$this->db->update($this->config->item('table_payments'), $urlData);
		return $this->db->affected_rows();	
		
	}
	public function getPublisherPaidAmount($uid=0){
		$this->db->select("paidAmount");
		$this->db->from($this->config->item('table_payments'));
		$this->db->where('userID',$uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTotalPaidPayment(){
		$this->db->select_sum('paidAmount');
		$this->db->from($this->config->item('table_payments'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_payments').".userID");
		$this->db->where($this->config->item('table_user').".userTypeID =", "3");
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTotalPayingPayment(){
		$this->db->select_sum('balanceAmount');
		$this->db->from($this->config->item('table_payments'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_payments').".userID");
		$this->db->where($this->config->item('table_user').".userTypeID =", "3");
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTotalPaidByAdvertiser($uid=0){
		$this->db->select('paidAmount');
		$this->db->from($this->config->item('table_payments'));
		$this->db->where("userID",$uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getTotalPaymentRemainingByAdvertiser($uid=0){
		$this->db->select('*');
		$this->db->from($this->config->item('table_payments'));
		$this->db->where("userID",$uid);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getPublishers($limit=0){
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select('*');
		$this->db->from($this->config->item('table_payments'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_payments').".userID");
		$this->db->where($this->config->item('table_user').".userTypeID =", "3");
		//$this->db->where("userID",$uid);
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
		public function getPublishersCount($limit=0){
		
		$this->db->select('*');
		$this->db->from($this->config->item('table_payments'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_payments').".userID");
		$this->db->where($this->config->item('table_user').".userTypeID =", "3");
		//$this->db->where("userID",$uid);
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	public function getAdvertiser($limit=0){
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select('*');
		$this->db->from($this->config->item('table_payments'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_payments').".userID");
		$this->db->where($this->config->item('table_user').".userTypeID =", "2");
		//$this->db->where("userID",$uid);
		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getAdvertiserCount($limit=0){
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select('*');
		$this->db->from($this->config->item('table_payments'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_payments').".userID");
		$this->db->where($this->config->item('table_user').".userTypeID =", "2");
		//$this->db->where("userID",$uid);
		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	
}