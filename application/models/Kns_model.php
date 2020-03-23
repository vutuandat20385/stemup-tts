<?php
class Kns_model extends CI_Model{
    
    public function lev_list(){
        $lev_list_sql='SELECT * FROM savsoft_level LIMIT 13';
        return $this->db->query($lev_list_sql)->result_array();
    }
    
    // public function get_quiz_list_by_lid($limit, $start,$lid){
    //     $sql="SELECT quid, quiz_name, inserted_by_name,level_hard, img_video from savsoft_quiz WHERE lid=$lid and (level_hard>=4 and level_hard<=6) ORDER BY RAND()";
    //     $query = $this->db->query($sql);
    //     if ($query->num_rows() > 0)
    //     {
    //         foreach ($query->result_array() as $row)
    //         {
    //             $data[] = $row;
    //         }
            
    //         return $data;
    //     }
        
    //     return false;
    // }
    
    public function get_quiz_list($lid){
        $sql= " SELECT * FROM savsoft_qbank sq WHERE sq.cid = 29 and  sq.type=3  ";
		if($lid ){
			$sql.= "and sq.lid = $lid ";
		}
        return $this->db->query($sql)->result_array();
    }
    
    public function get_quiz_list_($limit, $start,$lid){
        $sql="SELECT * FROM savsoft_qbank sq WHERE sq.cid = 29 and  sq.type=3 ";
		if($lid ){
			$sql.= "and sq.lid = $lid ";
		}
        $sql .= " ORDER BY RAND()";
		$sql .= " limit $start, $limit ";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row)
            {
                $data[] = $row;
            }
            
            return $data;
        }
        
        return false;
    }
	function get_qid_kns($qid){
    
		$sql = " SELECT * FROM savsoft_qbank sq WHERE sq.cid = 29 and sq.type = 2 and sq.qid=$qid";
		$query = $this->db->query($sql)->result_array();
        
		return $query;

	}
	function get_qid_key($qid){
		$sql = " SELECT * FROM savsoft_options so WHERE so.qid=$qid ";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	public function num_get_quiz_list_1($lid){
        $sql="SELECT * FROM savsoft_qbank sq WHERE sq.cid = 29 and sq.type = 2 ";
		if($lid ){
			$sql.= "and sq.lid = $lid ";
		}
		
        $query = $this->db->query($sql)->num_rows();
        
        return $query;
    }
	public function get_quiz_list_1($lid, $page=0){
        $sql="SELECT * FROM savsoft_qbank sq WHERE sq.cid = 29 and sq.type = 2 ";
		if($lid ){
			$sql.= "and sq.lid = $lid ";
		}
		$sql .= "  limit 12 offset  ".($page*12);
        $query = $this->db->query($sql)->result_array();
       
        return $query;
		
    }
}