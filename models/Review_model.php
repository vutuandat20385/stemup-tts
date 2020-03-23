<?php
Class Review_model extends CI_Model
{

	function get_review($reviewid, $model){
		$this->db->where('reviewid', $reviewid);
		$this->db->where('model', $model);

		$query = $this->db->get('savsoft_review');
		return $query->result_array();
	}

	function review_item($reviewid, $model, $value, $content){
		$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
		$dataReview = array(
			'reviewer' => $uid,
			'reviewid' => $reviewid,
			'model' => $model,
			'value' => $value,
			'content' => $content
		);

		if($this->db->insert('savsoft_review', $dataReview)){
			return true;
		}else{
			return false;
		}
	}

	function update_review($reid, $value, $content){
		$dataReview = array(
			'value' => $value,
			'content' => $content
		);
		$this->db->where("id", $reid);
		if($this->db->update('savsoft_review', $dataReview)){
			return true;
		}else{
			return false;
		}
	}

}
?>