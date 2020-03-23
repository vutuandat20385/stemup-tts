<?php
Class Data_model extends CI_Model
{

	function insert_datagroup(){
	 
	 	$userdata=array(
			'datagroup_name'=>$this->input->post('datagroup_name'),
			'datagroup_code'=>$this->input->post('datagroup_code'),
			'description'=>$this->input->post('description'),
		);
		
		if($this->db->insert('savsoft_datagroup',$userdata)){			
			return true;
		}else{			
			return false;
		}	 
 	}

	function get_datagroup($gid){
		$this->db->where('gid', $gid);
		$query=$this->db->get('savsoft_datagroup');
		return $query->row_array();
	}

	function update_datagroup($gid){
 
 		$userdata=array(
			'datagroup_name'=>$this->input->post('datagroup_name'),
			'datagroup_code'=>$this->input->post('datagroup_code'),
			'description'=>$this->input->post('description'),
		);

		$this->db->where('gid',$gid);
		if($this->db->update('savsoft_datagroup',$userdata)){			
			return true;
		}else{			
			return false;
		}
 	}

	function remove_datagroup($gid){
	 
		$this->db->where('gid',$gid);
		if($this->db->delete('savsoft_datagroup')){
			return true;
		}else{ 
			return false;
		}	 
 	}

 	function get_dataitem($did){
	 	$this->db->where('did', $did);
	 	$query=$this->db->get('savsoft_dataitem');
	 	return $query->row_array();
 	}

 	function insert_dataitem(){
	 	$userdata=array(
	 		'group_id'=>$this->input->post('group_id'),
			'dataitem_name'=>$this->input->post('dataitem_name'),
			'dataitem_code'=>$this->input->post('dataitem_code'),
			'dataitem_level'=>$this->input->post('dataitem_level'),
			'parent_id'=>$this->input->post('parent_id'),
			'description'=>$this->input->post('description'),
		);
		
		if($this->db->insert('savsoft_dataitem',$userdata)){			
			return true;
		}else{			
			return false;
		}
 	}

 	function update_dataitem($did){
		$userdata=array(
	 		'group_id'=>$this->input->post('group_id'),
			'dataitem_name'=>$this->input->post('dataitem_name'),
			'dataitem_code'=>$this->input->post('dataitem_code'),
			'dataitem_level'=>$this->input->post('dataitem_level'),
			'parent_id'=>$this->input->post('parent_id'),
			'description'=>$this->input->post('description'),
		);

		$this->db->where('did',$did);
		if($this->db->update('savsoft_dataitem',$userdata)){			
			return true;
		}else{			
			return false;
		}
 	}

	function remove_dataitem($did){

		$this->db->where('did',$did);
		if($this->db->delete('savsoft_dataitem')){
			return true;
		}else{ 
			return false;
		}
	}



 	function datagroup_list(){
	 	$this->db->order_by('gid', 'asc');
	 	$query=$this->db->get('savsoft_datagroup');
	 	return $query->result_array();
 	}

 	function dataitem_list_all($limit){
 		$this->db->select('savsoft_datagroup.datagroup_name, savsoft_dataitem.did, savsoft_dataitem.dataitem_name, savsoft_dataitem.dataitem_code, savsoft_dataitem.dataitem_level, savsoft_dataitem.parent_id');
		$this->db->from('savsoft_dataitem');
		$this->db->join('savsoft_datagroup','savsoft_dataitem.group_id=savsoft_datagroup.gid','inner');
	 	if($this->input->post('search')){
			 $search=$this->input->post('search');
			 $this->db->or_like('savsoft_dataitem.dataitem_name',$search);
			 $this->db->or_like('savsoft_dataitem.dataitem_code',$search);
			 $this->db->or_where('savsoft_dataitem.dataitem_level',$search);
		}
		$this->db->limit($this->config->item('number_of_rows'),$limit);
	 	$this->db->order_by('dataitem_level', 'asc');
	 	$query=$this->db->get();
	 	return $query->result_array();
 	}

	function dataitem_list($group_id, $level){
		if(!empty($group_id)){
			$this->db->where('group_id', $group_id);	
		}
		if(!empty($level)){
			$this->db->where('dataitem_level', $level);
		}
	 	
	 	$query=$this->db->get('savsoft_dataitem');
	 	return $query->result_array();
	}

	function dataitem_filter_parent($parent_id){
		if(!empty($parent_id)){
			$this->db->where('parent_id', $parent_id);
		}
	 	
	 	$query=$this->db->get('savsoft_dataitem');
	 	return $query->result_array();
	}
	function dataitem_filter_parent_school($parent_id){
		if(!empty($parent_id)){
			$this->db->where('phuong_xa', $parent_id);
		}
		$query=$this->db->get('school');
	 	return $query->result_array();
	}
	function dataitem_filter_parent_class($parent_id){
		if(!empty($parent_id)){
			$this->db->where('school_id', $parent_id);
		}
		$query=$this->db->get('class');
	 	return $query->result_array();
	}

	function get_by_code($code){
		$this->db->where('dataitem_code', $code);
		$query=$this->db->get('savsoft_dataitem');
	 	return $query->row_array();
	}
	function get_data_schools($scl1){
		$dataitems = $this->api_model->data_schools($qh_id);
		header('Content-Type: application/json');
		echo json_encode($dataitems);
	}
}
?>