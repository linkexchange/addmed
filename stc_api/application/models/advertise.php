<?php 
class Advertise extends CI_Model{
    // add advertise
    public function add($advertiseData)
    {
	$this->db->insert($this->config->item('table_advertises'), $advertiseData);
	return $this->db->insert_id();
    }
    public function getAds($uid=0,$limit=0){
	$numberofrecords=(int)$this->config->item('record_limit');
	if($limit>0)
            $limit=$limit-1;	
	$startRecord=$limit*$numberofrecords;
	$this->db->select($this->config->item('table_advertises').".*,".$this->config->item('table_templates').".name");
	$this->db->from($this->config->item('table_advertises'));
	$this->db->join($this->config->item('table_templates'),$this->config->item('table_advertises').".templateID = ".$this->config->item('table_templates').".id",'left');
	
	if($this->session->userdata('userType')!="admin")
            $this->db->where($this->config->item('table_templates').'.userID',$uid);
	$this->db->order_by($this->config->item('table_advertises').".templateID", "ASC"); 
	$this->db->limit($numberofrecords,$startRecord);
	
	$result = $this->db->get();
	//echo $this->db->last_query();
	return $result->result_array();
    }
    public function getAdsCount($uid){
	
		$this->db->select($this->config->item('table_advertises').".*,".$this->config->item('table_templates').".name");
		$this->db->from($this->config->item('table_advertises'));
		$this->db->join($this->config->item('table_templates'),$this->config->item('table_advertises').".templateID = ".$this->config->item('table_templates').".id",'left');

		if($this->session->userdata('userType')!="admin")
			$this->db->where($this->config->item('table_templates').'.userID',$uid);

		//$this->db->order_by($this->config->item('table_advertises').".templateID", "ASC"); 
	
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->num_rows();
	}
	
	public function getAd($id){
		$this->db->select($this->config->item('table_advertises').".*,".$this->config->item('table_templates').".name");
		$this->db->from($this->config->item('table_advertises'));
		$this->db->join($this->config->item('table_templates'),$this->config->item('table_advertises').".templateID = ".$this->config->item('table_templates').".id",'left');
		$this->db->where($this->config->item('table_advertises').'.id',$id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	
	//Update advertise
	function update($advertiseData,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_advertises'), $advertiseData);
		return $this->db->affected_rows();	
		
	}

	function delete($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_advertises'));
		
	}

	public function deleteAdvertiseByTemplateID($tid){
		$this->db->where("templateID",$tid);
		$this->db->delete($this->config->item('table_advertises'));
	}
}
?>