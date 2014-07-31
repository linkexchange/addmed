<?php
	class Page extends CI_Model{
		
		public function getPages($uid=0,$limit=0,$tid=0)
		{
			$numberofrecords=(int)$this->config->item('record_limit');
			if($limit>0)
				$limit=$limit-1;	
			$startRecord=$limit*$numberofrecords;
			
			$this->db->select($this->config->item('table_pages').".*,".$this->config->item('table_templates').".name");
			$this->db->from($this->config->item('table_pages'));
			$this->db->join($this->config->item('table_templates'),$this->config->item('table_pages').".templateID = ".$this->config->item('table_templates').".id");

			if($this->session->userdata('userType')!="admin")
				$this->db->where($this->config->item('table_templates').".userID",$uid);

			
			if($tid){
				$this->db->where($this->config->item('table_pages').".templateID",$tid);
			}

			$this->db->limit($numberofrecords,$startRecord);
			
			$result = $this->db->get();
			//echo $this->db->last_query();
			return $result->result_array();
		}
		public function getpagesCount($uid=0,$tid=0)
		{
			$this->db->select($this->config->item('table_pages').".*,".$this->config->item('table_templates').".name");
			$this->db->from($this->config->item('table_pages'));
			$this->db->join($this->config->item('table_templates'),$this->config->item('table_pages').".templateID = ".$this->config->item('table_templates').".id",'left');

			if($this->session->userdata('userType')!="admin"){
				$this->db->where($this->config->item('table_templates').".userID",$uid);
			}
			if($tid){
				$this->db->where($this->config->item('table_pages').".templateID",$tid);
			}
			//$this->db->limit($numberofrecords,$startRecord);
			$result = $this->db->get();
			return $result->num_rows();
		}
		public function add($pageData)
		{
			$this->db->insert($this->config->item('table_pages'), $pageData);
			return $this->db->insert_id();
		}
		public function getpagesByTemplate($uid=0,$tempID=0,$limit=0)
		{
			if($limit!="ALL")
			{
				$numberofrecords=(int)$this->config->item('record_limit');
				if($limit>0)
					$limit=$limit-1;	
				$startRecord=$limit*$numberofrecords;
				$this->db->limit($numberofrecords,$startRecord);
				
			}
			
			$this->db->select($this->config->item('table_pages').".*,".$this->config->item('table_templates').".name");
			$this->db->from($this->config->item('table_pages'));
			$this->db->join($this->config->item('table_templates'),$this->config->item('table_pages').".templateID = ".$this->config->item('table_templates').".id",'left');

			if($this->session->userdata('userType')!="admin")
				$this->db->where($this->config->item('table_templates').".userID",$uid);

			$this->db->where($this->config->item('table_pages').".templateID",$tempID);
			
			
			$result = $this->db->get();
			//echo $this->db->last_query();
			return $result->result_array();
		}
		public function getpagesCountByTemplate($uid=0,$tempID=0)
		{
			$this->db->select($this->config->item('table_pages').".*,".$this->config->item('table_templates').".name");
			$this->db->from($this->config->item('table_pages'));
			$this->db->join($this->config->item('table_templates'),$this->config->item('table_pages').".templateID = ".$this->config->item('table_templates').".id",'left');

			if($this->session->userdata('userType')!="admin")
				$this->db->where($this->config->item('table_templates').".userID",$uid);

			$this->db->where($this->config->item('table_pages').".templateID",$tempID);
			//$this->db->limit($numberofrecords,$startRecord);
			$result = $this->db->get();
			//echo $this->db->last_query();
			return $result->num_rows();
		}
		function update($pageDate,$id)
		{
			$this->db->where("id",$id);
			$this->db->update($this->config->item('table_pages'), $pageDate);
			return $this->db->affected_rows();	
		}
		public function getPage($id)
		{
			$this->db->select($this->config->item('table_pages').".*,".$this->config->item('table_templates').".name");
			$this->db->from($this->config->item('table_pages'));
			$this->db->join($this->config->item('table_templates'),$this->config->item('table_pages').".templateID = ".$this->config->item('table_templates').".id",'left');
			$this->db->where($this->config->item('table_pages').".id",$id);
			$result = $this->db->get();
			return $result->result_array();
		}
		function delete($id)
		{	
			$this->db->where("id",$id);
			$this->db->delete($this->config->item('table_pages'));
		}
}	