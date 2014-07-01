<?php 
class Article extends CI_Model{

	// return article details by user ID.
	public function getArticles($uid=0,$limit=0,$tid=0,$bid=0){
		$numberofrecords=10;
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_articles').".*,".$this->config->item('table_blogs').".title,".$this->config->item('table_blogs').".templateID,".$this->config->item('table_templates').".userID,".$this->config->item('table_templates').".name");
		
		$this->db->from($this->config->item('table_articles'));

		$this->db->join($this->config->item('table_blogs'),$this->config->item('table_blogs').".id = ".$this->config->item('table_articles').".blogID",'INNER');

		$this->db->join($this->config->item('table_templates'),$this->config->item('table_templates').".id = ".$this->config->item('table_blogs').".templateID");

		if($this->session->userdata('userType')!="admin")
			$this->db->where($this->config->item('table_templates').".userID",$uid);
		

		if($tid && $bid){
			$this->db->where($this->config->item('table_articles').".blogID",$bid);
			$this->db->where($this->config->item('table_blogs').".templateID",$tid);
		}

		$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();

	}

	// return article count by user ID.
	public function getArticlesCount($uid=0,$tid=0,$bid=0){
		$this->db->select($this->config->item('table_articles').".*,".$this->config->item('table_blogs').".title,".$this->config->item('table_blogs').".templateID,".$this->config->item('table_templates').".userID,".$this->config->item('table_templates').".name");
		
		$this->db->from($this->config->item('table_articles'));

		$this->db->join($this->config->item('table_blogs'),$this->config->item('table_blogs').".id = ".$this->config->item('table_articles').".blogID",'INNER');

		$this->db->join($this->config->item('table_templates'),$this->config->item('table_templates').".id = ".$this->config->item('table_blogs').".templateID");

		if($this->session->userdata('userType')!="admin")
			$this->db->where($this->config->item('table_templates').".userID",$uid);

		if($tid && $bid){
			$this->db->where($this->config->item('table_articles').".blogID",$bid);
			$this->db->where($this->config->item('table_blogs').".templateID",$tid);
		}

		//$this->db->limit($numberofrecords,$startRecord);
		$result = $this->db->get();
		return $result->num_rows();

	}

	// add article
	public function add($articleData)
	{
		$this->db->insert($this->config->item('table_articles'), $articleData);
		return $this->db->insert_id();
	}
	
	// delete article by id.
	function delete($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_articles'));
	
	}

	public function deleteArticleByBlog($bid){
		$this->db->where("blogID",$bid);
		$this->db->delete($this->config->item('table_articles'));
	}

	//return all article details by it ID.
	public function getArticleDetailsByID($uid=1,$aid=0){

		$this->db->select($this->config->item('table_articles').".*,".$this->config->item('table_blogs').".title,".$this->config->item('table_blogs').".templateID,".$this->config->item('table_templates').".userID,".$this->config->item('table_templates').".name");
		
		$this->db->from($this->config->item('table_articles'));

		$this->db->join($this->config->item('table_blogs'),$this->config->item('table_blogs').".id = ".$this->config->item('table_articles').".blogID",'INNER');

		$this->db->join($this->config->item('table_templates'),$this->config->item('table_templates').".id = ".$this->config->item('table_blogs').".templateID");

		if($this->session->userdata('userType')!="admin")
			$this->db->where($this->config->item('table_templates').".userID",$uid);

		$this->db->where($this->config->item('table_articles').".id",$aid);

		$result = $this->db->get();
		return $result->result_array();
	}

	//Update article
	function update($articleDate,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_articles'), $articleDate);
		return $this->db->affected_rows();	
		
	}

	// return article count
	public function getArticleCountByBlog($bid){
		$this->db->select('id');
		$this->db->from($this->config->item('table_articles'));
		$this->db->where("blogID =", $bid);
		$result = $this->db->get();
		return $result->num_rows();
	}

	public function getBlogArticles($bid){
		$this->db->select(
				$this->config->item('table_articles').".id,".
				$this->config->item('table_articles').".articleTitle,".
				$this->config->item('table_articles').".slug,".
				$this->config->item('table_articles').".articleImage,".
				$this->config->item('table_articles').".articleDescription"
		);
		$this->db->from($this->config->item('table_articles'));
		$this->db->where("blogID",$bid);
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>