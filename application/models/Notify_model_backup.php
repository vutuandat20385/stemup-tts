<?php
Class Notify_model extends CI_Model
{

 	function notify_list(){
 		
	 	$logged_in=$this->session->userdata('logged_in');
	 	$sql = "select u.uid, n.content, n.createdate, concat(z.first_name, ' ') as username, z.photo from notify_user u inner join notify n on n.nid = u.nid inner join savsoft_users z on z.uid = n.uid ";
	 	if($logged_in['su'] != '1'){
	 		$uid=$logged_in['uid'];
	  		$sqls = " where n.uid = ".$uid." and u.uid = ".$uid."";
	 		$sql .= $sqls;
	 	}
	 	$sql .= " group by u.id order by n.createdate desc limit 0,5";
	 	
	 	$query = $this->db->query($sql);

	 	return $query->result_array();
 	}

	function notify_all_list(){	
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$sql = "select u.uid,u.id, u.status, n.action , n.content, n.click,n.createdate, concat(z.first_name, ' ') as username, z.photo from notify_user u inner join notify n on n.nid = u.nid inner join savsoft_users z on z.uid = n.uid ";
		if($logged_in['su'] != '1'){
			 $sqls = " where u.uid = ".$uid." and n.uid != ".$uid."";
			$sql .= $sqls;
		}else{
			$sqls = " where n.uid != ".$uid."";
			$sql .= $sqls;
		}
		$sql .= " group by u.id ";
	    $sql .= " order by n.createdate desc, n.nid desc ";
		$sql .= " limit 20";		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function notify_load_more($id){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$sql = "select u.uid, n.action , u.id , u.status, n.content, n.click,n.createdate, concat(z.first_name, ' ') as username, z.photo from notify_user u inner join notify n on n.nid = u.nid inner join savsoft_users z on z.uid = n.uid ";
		if($logged_in['su'] != '1'){
			 $sqls = " where u.uid = ".$uid." and n.uid != ".$uid." and u.id < ".$id."";
			$sql .= $sqls;
		}else{
			$sqls = " where n.uid != ".$uid." and u.id < ".$id."";
			$sql .= $sqls;
		}
		$sql .= " group by u.id ";
	    $sql .= " order by n.createdate desc, n.nid desc ";
		$sql .= " limit 20";		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
 	function notification_list(){
 		
	 	$logged_in=$this->session->userdata('logged_in');
	 	$uid=$logged_in['uid'];
	 	$sql = "select u.uid, u.status, n.content, n.click,n.createdate, concat(z.first_name, ' ') as username, z.photo from notify_user u inner join notify n on n.nid = u.nid inner join savsoft_users z on z.uid = n.uid ";
	 	if($logged_in['su'] != '1'){
	  		$sqls = " where u.uid = ".$uid." and n.uid != ".$uid."";
	 		$sql .= $sqls;
	 	}else{
	 		$sqls = " where n.uid != ".$uid."";
	 		$sql .= $sqls;
	 	}
	 	$sql .= " group by u.id ";

	 	//if($logged_in['su'] != '1'){
	 	//	$sql .= " order by n.createdate asc ";
	 	//}else{
	        		$sql .= " order by n.createdate desc, n.nid desc ";
	 	//}
	 	$sql .= " limit 10";
	 	
	 	$query = $this->db->query($sql);

	 	return $query->result_array();
 	}

 	function count_unseen(){
 		
	 	$logged_in=$this->session->userdata('logged_in');
	 	$uid=$logged_in['uid'];
	 	$sql = "select count(*) as num from notify_user u inner join notify n on n.nid = u.nid inner join savsoft_users z on z.uid = n.uid ";
	 	if($logged_in['su'] != '1'){
	  		$sqls = " where u.status = 0 and u.uid = ".$uid." and n.uid != ".$uid."";
	 		$sql .= $sqls;
	 	}else{
	 		$sqls = " where u.status = 0 and u.uid = ".$uid." and n.uid != ".$uid."";
	 		$sql .= $sqls;
	 	}
	 	
	 	$query = $this->db->query($sql);

	 	return $query->result_array();
 	}
 
 
 	function insert_notify($uid, $content, $model, $action, $click=''){
		$userdata = array(
 			'uid' => $uid,
 			'content' => $content,
 			'model' => $model,
 			'action' => $action, 
			'click' => $click
 		);

        $this->db->insert('notify',$userdata);
        $insert_id = $this->db->insert_id();

		return  $insert_id;
 		
 	}

 	function insert_notify_user($nid, $uid){
 		$userdata = array(
 			'nid' => $nid,
 			'uid' => $uid,
 		);
 		$this->db->insert('notify_user', $userdata);
 	}

 	function seen_notify_user(){
 		$logged_in=$this->session->userdata('logged_in');
 		$uid=$logged_in['uid'];
 		$data = array('status' => '1');
 		$this->db->where('uid', $uid);
 		$this->db->update('notify_user', $data);
 	}
}
?>
