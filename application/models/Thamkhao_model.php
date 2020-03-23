<?php
Class Thamkhao_model extends CI_Model{
	function get_content($url){
		$sql="SELECT * FROM reading_material_4 WHERE url_name='".$url."'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else
			return false;
	}

	function get_list_material(){
		$sql="SELECT * FROM reading_material_4 ORDER BY rand() LIMIT 10 ";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array(); 
		}else
			return false;
	}
}