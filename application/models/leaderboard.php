<?php
	class Leaderboard extends CI_Model {
		public function getTopUsers($limit=10){
			$this->db->select('id,userName');
			$this->db->from($this->config->item('table_user'));
			$this->db->where('userTypeID','3');
			//$this->db->limit($limit);
			$result = $this->db->get();
			//echo $this->db->last_query();
			return $result->result_array();
		}

		public function getPublishedLinks($uid){
			$this->db->select('numberOfClicks,publisherPayment');
			$this->db->from($this->config->item('table_clicksdetail'));
			$this->db->join($this->config->item('table_published_url'),$this->config->item('table_clicksdetail').".publishedLinkID = ".$this->config->item('table_published_url').".id");

			$this->db->where($this->config->item('table_published_url').'.publisherID',$uid);

			//$this->db->limit($limit);
			$result = $this->db->get();
			//echo $this->db->last_query();
			return $result->result_array();
		}
                public function getFollowersByUser($uid=0){
                    $this->db->select_sum('smaAccountFollowers');
                    $this->db->from($this->config->item('table_sma_account_details'));
                    $this->db->where($this->config->item('table_sma_account_details').'.publisherID',$uid);
                    $result = $this->db->get();
                    //echo $this->db->last_query(); exit;
                    return $result->result_array();
                }
                public function getPostsByUser($uid=0){
                    $this->db->select_sum('smaAccountPosts');
                    $this->db->from($this->config->item('table_sma_account_details'));
                    $this->db->where($this->config->item('table_sma_account_details').'.publisherID',$uid);
                    $result = $this->db->get();
                    //echo $this->db->last_query(); exit;
                    return $result->result_array();
                }
                
                 public function getLikesByUser($uid=0){
                    $this->db->select_sum('smaAccountLikes');
                    $this->db->from($this->config->item('table_sma_account_details'));
                    $this->db->where($this->config->item('table_sma_account_details').'.publisherID',$uid);
                    $result = $this->db->get();
                    //echo $this->db->last_query();
                    return $result->result_array();
                }
	}
?>