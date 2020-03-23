<?php
class Tranfer_point_model extends CI_Model{
   
    public function get_user($email){
		$this->db->where('email',$email);
		$duser=$this->db->get('savsoft_users');
		return $duser->result_array()[0];
	}
	public function check_pwd($uid, $pwd){
		$this->db->where('uid',$uid);
		$user=$this->db->get('savsoft_users')->result_array();
		if(md5($pwd) == $user[0]['password'])
			return true;
		else return false;
	}
	
	public function get_point($uid){
		$this->db->where('uid',$uid);
		$user=$this->db->get('savsoft_users')->result_array();
		$point = $user[0]['point'];
		return $point;
	}
	
    public function tranfer($suid, $duid , $point_tranfer){
		$this->db->where('uid',$suid);
		$suser=$this->db->get('savsoft_users')->result_array();
		$spoint = $suser[0]['point'];
		$this->db->where('uid',$duid);
		$duser=$this->db->get('savsoft_users')->result_array();
		$dpoint = $duser[0]['point'];
		
		$spoint_array=array('point'=>$spoint-$point_tranfer);
		$this->db->where('uid', $suid);
		$this->db->update('savsoft_users',$spoint_array);
		
		$dpoint_array=array('point'=>$dpoint+$point_tranfer);
		$this->db->where('uid', $duid);
		$this->db->update('savsoft_users',$dpoint_array);
		
		$smes='Chuyển '.$point_tranfer.' điểm  cho '.$duser[0]['last_name'].' '. $duser[0]['first_name'];
		$dmes='Nhận '.$point_tranfer.' điểm từ '.$suser[0]['last_name'].' '. $suser[0]['first_name'];
		$shistory= array( 'uid'=> $suid, 'activity'=>$smes, 'point_change'=>-$point_tranfer);
		$this->db->insert('history_point_change', $shistory);
		$dhistory= array( 'uid'=> $duid, 'activity'=>$dmes, 'point_change'=>$point_tranfer);
		$this->db->insert('history_point_change', $dhistory);
 	}
   
	
}





 



?>
