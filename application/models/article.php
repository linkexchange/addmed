<?php 
class Article extends CI_Model{

	// return article details by user ID.
	public function getArticles($uid=0,$limit=0,$tid=0,$bid=0){
		$numberofrecords=(int)$this->config->item('record_limit');
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
	public function getAllForumArticles2(){
		$this->db->select("*");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getNotEaseOfUseArticles(){
		$this->db->select($this->config->item('table_f_articles').".*");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->join($this->config->item('table_ease_of_use'),$this->config->item('table_f_articles').".id = ".$this->config->item('table_ease_of_use').".articleid",'left');
		$this->db->where($this->config->item('table_ease_of_use').'.articleid IS NULL');
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getNotMonetizedForumArticles(){
		$this->db->select($this->config->item('table_f_articles').".*");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->join($this->config->item('table_monetization'),$this->config->item('table_f_articles').".id = ".$this->config->item('table_monetization').".articleid",'left');
		$this->db->where($this->config->item('table_monetization').'.articleid IS NULL');
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getNotContentsArticles(){
		$this->db->select($this->config->item('table_f_articles').".*");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->join($this->config->item('table_contents'),$this->config->item('table_f_articles').".id = ".$this->config->item('table_contents').".articleid",'left');
		$this->db->where($this->config->item('table_contents').'.articleid IS NULL');
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getNotPayoutsForumArticles(){
		$this->db->select($this->config->item('table_f_articles').".*");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->join($this->config->item('table_payouts'),$this->config->item('table_f_articles').".id = ".$this->config->item('table_payouts').".articleid",'left');
		$this->db->where($this->config->item('table_payouts').'.articleid IS NULL');
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getNotSupportForumArticles(){
		$this->db->select($this->config->item('table_f_articles').".*");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->join($this->config->item('table_support'),$this->config->item('table_f_articles').".id = ".$this->config->item('table_support').".articleid",'left');
		$this->db->where($this->config->item('table_support').'.articleid IS NULL');
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getForumArticlesByName($val){
		$this->db->select($this->config->item('table_f_articles').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_f_articles').".created_by =".$this->config->item('table_user').".id");
		$this->db->like('topic', urldecode($val));
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllForumArticlesCountByName($val){
		$this->db->select("*");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->like('topic', urldecode($val));
		return $this->db->count_all_results();
	}
	public function getForumArticles($uid,$limit=0){
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select("*");
		$this->db->from($this->config->item('table_f_articles'));
		if($this->session->userData('userTypeID')!=1)
		{
		$this->db->where("created_by",$uid);
		}
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
	}
	public function getAllForumArticles($limit=0){
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select($this->config->item('table_f_articles').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_f_articles').".created_by","INNER");
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllForumArticlesCount(){
		$this->db->select("*");
		$this->db->from($this->config->item('table_f_articles'));
		return $this->db->count_all_results();
	}
	public function getForumArticlesCount($uid){
		$this->db->select("*");
		$this->db->from($this->config->item('table_f_articles'));
		if($this->session->userData('userTypeID')!=1)
		{
		$this->db->where("created_by",$uid);
		}
		return $this->db->count_all_results();
	}
	public function getArticlesByName($id,$val){
		$this->db->select("*");
		$this->db->from($this->config->item('table_f_articles'));
		if($this->session->userData('userTypeID')!=1)
		{
		$this->db->where("created_by",$id);
		}		
		$this->db->like('topic', urldecode($val));
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getForumArticlesCountByName($uid,$val){
		$this->db->select("*");
		$this->db->from($this->config->item('table_f_articles'));
		if($this->session->userData('userTypeID')!=1)
		{
		$this->db->where("created_by",$uid);
		}
		$this->db->like('topic', urldecode($val));
		return $this->db->count_all_results();
	}
	public function getForumArticleByID($id){
		$this->db->select($this->config->item('table_f_articles').".*,".$this->config->item('table_user').".userName");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->join($this->config->item('table_user'),$this->config->item('table_user').".id = ".$this->config->item('table_f_articles').".created_by","INNER");
		$this->db->where($this->config->item('table_f_articles').'.id',$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllComments($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_comments'));
		$this->db->where('articleid',$id);
		$this->db->where('status','1');
		$this->db->where('parent_id',0);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function update_Comment($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('comments',$data);
	}
	public function getBookmarksByID($id){
		$this->db->select("*");
		$this->db->from($this->config->item('table_bookmarks'));
		$this->db->where('articleid',$id);
		$this->db->where('created_by',$this->session->userdata('userID'));
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllReplies($id)
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_comments'));
		$this->db->where('articleid',$id);
		$this->db->where('status','1');
		$this->db->where('parent_id >',0);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getForumArticleDetailsByID($aid){

		$this->db->select("*");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->where("id",$aid);
		$result = $this->db->get();
		return $result->result_array();
	}
	function updateForumArticle($articleData,$id)
	{
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_f_articles'), $articleData);
		return $this->db->affected_rows();	
	}
	function deleteForumArticle($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_f_articles'));
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
	public function add_Bookmark($data)
	{
		$this->db->insert($this->config->item('table_bookmarks'),$data);
		return $this->db->insert_id();
	}
	public function removeBookmark($id)
	{
		$this->db->where("id",$id);
		$this->db->delete($this->config->item('table_bookmarks'));
	}
	
	public function getBookmarkByID($id){
		$this->db->select("*");
		$this->db->from($this->config->item('table_bookmarks'));
		$this->db->where('id',$id);
		$result = $this->db->get();
		return $result->result_array();
	}
	public function updateBookmark($id,$bookmarkdata) {
		$this->db->where("id",$id);
		$this->db->update($this->config->item('table_bookmarks'), $bookmarkdata);
		return $this->db->affected_rows();
	}
	public function getAllBookmarks($limit=0)
	{
		$numberofrecords=(int)$this->config->item('record_limit');
		if($limit>0)
			$limit=$limit-1;	
		$startRecord=$limit*$numberofrecords;
		$this->db->select("*");
		$this->db->from($this->config->item('table_bookmarks'));
		$this->db->where("created_by",$this->session->userdata("userID"));
		$this->db->limit($numberofrecords,$startRecord);
		$this->db->order_by('id','desc');
		$result = $this->db->get();
		return $result->result_array();
	}
	public function getAllBookmarksCount()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_bookmarks'));
		$this->db->where("created_by",$this->session->userdata("userID"));
		return $this->db->count_all_results();
	}
	// add article
	public function add($articleData)
	{
		$this->db->insert($this->config->item('table_articles'), $articleData);
		return $this->db->insert_id();
	}
	public function add_forum_article($articleData)
	{
		$this->db->insert($this->config->item('table_f_articles'), $articleData);
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
	public function add_Comment($data)
	{
		$this->db->insert($this->config->item('table_comments'),$data);
		return $this->db->insert_id();
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
	public function getPopularArticles()
	{
		$this->db->select("*");
		$this->db->from($this->config->item('table_f_articles'));
		$this->db->order_by("no_of_replies","desc");
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>