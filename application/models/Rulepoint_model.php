<?php
class Rulepoint_model extends CI_Model{
 
    public function rule_list(){
		$query=$this->db->get('quiz_rule');
		return $query->result_array();
 	}
   
    public function insert_rule(){
         $userdata=array(
			'rule_name'=>$this->input->post('rule_name'),
            'point_change'=>$this->input->post('point_change')
		 );
		
		if($this->db->insert('quiz_rule',$userdata)){
			return true;
		}else{
			
			return false;
		}

    }

    public function delete_rule($id){

		$this->db->where('rule_id',$id);
	    if($this->db->delete('quiz_rule')){
			return true;
		}else{
			 
		    return false;
     	}

    }

    public function save_rule($id){
		$userdata=array(
			'rule_name'=>$this->input->post('rule_names'),
            'point_change'=>$this->input->post('point_changes')
		 );
		$this->db->where('rule_id',$id);
	    if($this->db->update('quiz_rule',$userdata)){
			return true;
		}else{
			 
		    return false;
     	}

    }
 
 

}		






 



?>
