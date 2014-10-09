<?php

class Analytics extends CI_Model
{    
      public function addDetails($data)
	{
		$this->db->insert($this->config->item('table_website'),$data);
		return $this->db->insert_id();
	}
        
        public function getWebsiteData($limit=0)
	{
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select("*");
		$this->db->from($this->config->item('table_website'));
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
        public function getWebsiteDataCount()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_website'));
		$this->db->order_by("id","desc");
		$result = $this->db->get();
		return $result->num_rows();
	}
        
        public function delete($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_website'));
	}
        
        function updateWebsiteDetails($articleData,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_website'), $articleData);
		return $this->db->affected_rows();	
	}
        
        public function getWesitesDetailsByID($aid){

		$this->db->select("*");
		$this->db->from($this->config->item('table_website'));
		$this->db->where("id",$aid);
		$result = $this->db->get();
		return $result->result_array();
	}
}

?>
