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
        $sql='SELECT quid, quiz_name, inserted_by_name,level_hard, img_video from savsoft_quiz WHERE lid='.$lid.' and level_hard>=4 and level_hard<=6';
        return $this->db->query($sql)->result_array();
    }
    
    public function get_quiz_list_($limit, $start,$lid){
        $sql="SELECT quid, quiz_name, inserted_by_name,level_hard, img_video from savsoft_quiz WHERE lid=$lid and (level_hard>=4 and level_hard<=6 ) ORDER BY RAND() limit $start, $limit ";

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
    
}