<?php
	class Leaderboard extends CI_Model {
		public function getTopUsers($limit=10){
			$this->db->select('id,userName');
			$this->db->from($this->config->item('table_user'));
			$this->db->where('userTypeID','3');
			$this->db->limit($limit);
			$result = $this->db->get();
			//echo $this->db->last_query();
			return $result->result_array();
		}

		public function getPublishedLinks($uid){
			$this->db->select('numberOfClicks,publisherPayment');
			$this->db->from($this->config->item('table_clicksdetail'));
			$this->db->join($this->config->item('table_publishedlinks'),$this->config->item('table_clicksdetail').".publishedLinkID = ".$this->config->item('table_publishedlinks').".id");

			$this->db->where($this->config->item('table_publishedlinks').'.publisherID',$uid);

			//$this->db->limit($limit);
			$result = $this->db->get();
			//echo $this->db->last_query();
			return $result->result_array();
		}	
	}
?>