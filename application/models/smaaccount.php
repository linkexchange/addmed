<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of smaAccount
 *
 * @author comp14
 */
class Smaaccount extends CI_Model {
    //put your code here
    function isAccountExists($userData){
	$this->db->select('*');
	$this->db->from($this->config->item('table_sma_account_details'));
	$this->db->where('publisherID',$userData['userID']);
        if($userData['accountTypeID']==1 || $userData['accountTypeID']==4)
            $this->db->where('smaAccountID',$userData['accountID']);
        elseif ($userData['accountTypeID']==3) 
            $this->db->where('smaAccountName',$userData['accountName']);
        
        $this->db->where('smaAccountTypeID',$userData['accountTypeID']);
        $this->db->where('smaConnected','Yes');
        $this->db->limit(1);
        $result=$this->db->get();
	if($result->num_rows()){
            $record=$result->result_array();
            return $record[0]['id'];
        }else
            return 0;
    }
    public function addRecord($urlData){
		//print_r($urlData); exit;
		$this->db->insert($this->config->item('table_sma_account_details'), $urlData);
		return $this->db->insert_id();
    }
    
    public function getTotalFollowers($uid=0,$type=""){
        $this->db->select_sum('smaAccountFollowers');
        $this->db->from($this->config->item('table_sma_account_details'));
        $this->db->join($this->config->item('table_sma_user_type'),$this->config->item('table_sma_user_type').".sma_user_type_id=".$this->config->item('table_sma_account_details').".smaAccountTypeID");
        $this->db->where($this->config->item('table_sma_user_type').".title =", $type);
        $this->db->where($this->config->item('table_sma_account_details').".publisherID =", $uid);
        //$this->db->limit(1);
        $result=$this->db->get();
        return $result->result_array();
        
    }
    public function getTotalPosts($uid=0,$type=""){
        $this->db->select_sum('smaAccountPosts');
        $this->db->from($this->config->item('table_sma_account_details'));
        $this->db->join($this->config->item('table_sma_user_type'),$this->config->item('table_sma_user_type').".sma_user_type_id=".$this->config->item('table_sma_account_details').".smaAccountTypeID");
        $this->db->where($this->config->item('table_sma_user_type').".title =", $type);
        $this->db->where($this->config->item('table_sma_account_details').".publisherID =", $uid);
        //$this->db->limit(1);
        $result=$this->db->get();
        return $result->result_array();
        
    }
    function updateRecord($id,$urlData){
	$this->db->where("id",$id);
	$this->db->update($this->config->item('table_sma_account_details'), $urlData);
	return $this->db->affected_rows();	
    }
    public function getProfiles($uid=0,$type="",$limit=0){
        $numberofrecords=(int)$this->config->item('record_limit');
        if($limit>0 & $limit!="ALL")
            $limit=$limit-1;	
        $startRecord=$limit*$this->config->item('record_limit');
        $this->db->select('*');
        $this->db->from($this->config->item('table_sma_account_details'));
        $this->db->join($this->config->item('table_sma_user_type'),$this->config->item('table_sma_user_type').".sma_user_type_id=".$this->config->item('table_sma_account_details').".smaAccountTypeID");
        $this->db->where($this->config->item('table_sma_user_type').".title =", $type);
        $this->db->where($this->config->item('table_sma_account_details').".publisherID =", $uid);
        
        $this->db->limit($numberofrecords,$startRecord);
        
        $result=$this->db->get();
        //echo $this->db->last_query(); exit;
        return $result->result_array();
        
    }
    public function getProfileCount($uid=0,$type=""){
        $this->db->select('id');
        $this->db->from($this->config->item('table_sma_account_details'));
        $this->db->join($this->config->item('table_sma_user_type'),$this->config->item('table_sma_user_type').".sma_user_type_id=".$this->config->item('table_sma_account_details').".smaAccountTypeID");
        $this->db->where($this->config->item('table_sma_user_type').".title =", $type);
        $this->db->where($this->config->item('table_sma_account_details').".publisherID =", $uid);
        //$this->db->limit(1);
        //$result=$this->db->get();
        return $this->db->count_all_results();
        
    }
    function removeProfile($id){
        $this->db->where("id",$id);
	$this->db->delete($this->config->item('table_sma_account_details'));
        return $this->db->affected_rows();
    }
    
}

?>
