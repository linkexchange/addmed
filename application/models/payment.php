<?php 
class Payments extends CI_Model{
	public function getPaymentDetails($userID=0){
		$this->db->select("*");
		$this->db->where('userID',$userID);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getPublishers($limit=0){
		
	}
}