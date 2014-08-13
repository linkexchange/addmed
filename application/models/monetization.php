<?php 
class Monetization extends CI_Model{

	public function addDetails($data)
	{
		$this->db->insert($this->config->item('table_monetization'),$data);
		return $this->db->insert_id();
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
	public function getMonetizedDataCount()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_monetization'));
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->num_rows();
	}
	public function getMonetizedDataByID($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_monetization'));
		$this->db->where("id",$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function delete($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_monetization'));
	}
	public function updateDetails($id,$data)
	{
		$this->db->where("id",$id);
		return $this->db->update($this->config->item('table_monetization'),$data);
	}
}
?>