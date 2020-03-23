<?php
Class Post_model extends CI_Model
{
	function checkDatePost(){
		$today = new DateTime();
		$compare = $today->format('Y-m-d');
		$this->db->where('date >', $compare);
		$query=$this->db->get('savsoft_posts');
		$result = $query->row_array();
		$count = $result['COUNT(*)'];
		if($count > 0){
			return false;
		}else{
			$this->db->truncate('savsoft_posts'); 
			return true;
		}
	}

	function post_list($type){
		$this->db->where('type', $type);
		$this->db->order_by('savsoft_posts.pid','desc');
		$query=$this->db->get('savsoft_posts');
		return $query->result_array();
	}

	function insert_post($userdata){
		$this->db->insert('savsoft_posts',$userdata);
		return true;
	}
}
?>