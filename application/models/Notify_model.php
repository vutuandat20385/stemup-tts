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
		$sql.=" group by u.id order by u.status,u.id desc";
	 	//$sql .= " group by u.id order by n.createdate desc limit 0,5";
	 	
	 	$query = $this->db->query($sql);

	 	return $query->result_array();
 	}

	function notify_all_list(){	
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
			$sql = "select u.uid,u.id, u.status, n.action , n.content, n.click,n.createdate, z.first_name  username, z.photo from notify_user u 
				inner join notify n on n.nid = u.nid 
				inner join savsoft_users z on z.uid = n.uid";
		if($logged_in['su'] != '1'){
			 $sqls = " where u.uid = ".$uid." and n.uid != ".$uid."";
			$sql .= $sqls;
		}else{
			$sqls = " where n.uid != ".$uid."";
			$sql .= $sqls;
		}
		$sql.=" group by u.id order by u.status,u.id desc";
		//$sql .= " group by u.id ";
	    //$sql .= " order by n.createdate desc, n.nid desc ";
		$sql .= " limit 20";		
		$query = $this->db->query($sql);		
		$result=$query->result_array();		
		foreach($result as $k=>$rs){
			$result[$k]['createdate']= date('H:i:s d-m-Y',strtotime($rs['createdate']));
			if(!$rs['photo'])
				$result[$k]['photo']= base_url('upload/avatar/default.png');
			//log_message("error",$rs['click']);
			$str=$rs['click'];
			$str_find='s/';
			$start=strpos($str,$str_find);			
			//log_message("error",$start);
			$str1=substr($str,$start+2);
			//log_message("error",$str1);
			$str_find1='/';
			$end=strpos($str1,$str_find1);
			//log_message("error",$end);
			$quid=substr($str1,0,$end);

			$sqlq="select * FROM savsoft_quiz sq WHERE sq.quid=".$quid."";
			$queryq = $this->db->query($sqlq)->row_array();
			$result[$k]['quiz_name']=$queryq['quiz_name'];
		}
		
		return $result;
	}
	function notify_load_more($id){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$sql = "select u.uid,u.id, u.status, n.action , n.content, n.click,n.createdate, z.first_name  username, z.photo from notify_user u 
				inner join notify n on n.nid = u.nid 
				inner join savsoft_users z on z.uid = n.uid ";
		if($logged_in['su'] != '1'){
			 $sqls = " where u.uid = ".$uid." and n.uid != ".$uid." and u.id < ".$id."";
			$sql .= $sqls;
		}else{
			$sqls = " where n.uid != ".$uid." and u.id < ".$id."";
			$sql .= $sqls;
		}
		//$sql .= " group by u.id ";
	    //$sql .= " order by n.createdate desc, n.nid desc ";
		$sql.=" group by u.id order by u.status,u.id desc";
		$sql .= " limit 20";		
		$query = $this->db->query($sql);		
		$result=$query->result_array();		
		foreach($result as $k=>$rs){
			$result[$k]['createdate']= date('H:i:s d-m-Y',strtotime($rs['createdate']));
			if(!$rs['photo'])
				$result[$k]['photo']= base_url('upload/avatar/default.png');
			$str=$rs['click'];
			$str_find='s/';
			$start=strpos($str,$str_find);			
			//log_message("error",$start);
			$str1=substr($str,$start+2);
			//log_message("error",$str1);
			$str_find1='/';
			$end=strpos($str1,$str_find1);
			//log_message("error",$end);
			$quid=substr($str1,0,$end);

			$sqlq="select * FROM savsoft_quiz sq WHERE sq.quid=".$quid."";
			$queryq = $this->db->query($sqlq)->row_array();
			$result[$k]['quiz_name']=$queryq['quiz_name'];
		}
		
		return $result;
	}
 	function notification_list(){
 		
	 	$logged_in=$this->session->userdata('logged_in');
	 	$uid=$logged_in['uid'];
		if($uid){
			$sql = "select u.id, u.uid, u.status, n.content, n.click,n.createdate, concat(z.first_name, ' ') as username, z.photo from notify_user u inner join notify n on n.nid = u.nid inner join savsoft_users z on z.uid = n.uid ";
			if($logged_in['su'] != '1'){
				$sqls = " where u.uid = ".$uid." and n.uid != ".$uid."";
				$sql .= $sqls;
			}else{
				$sqls = " where n.uid != ".$uid."";
				$sql .= $sqls;
			}
			
			$sql.=" group by u.id order by u.status,u.id desc";
			//$sql .= " group by u.id ";

			//if($logged_in['su'] != '1'){
			//	$sql .= " order by n.createdate asc ";
			//}else{
						$sql .= ",n.createdate desc, n.nid desc ";
			//}
			$sql .= " limit 10";
			
			$query = $this->db->query($sql);
        
	 	   $result=$query->result_array();
		
			foreach($result as $k=>$rs){
				$result[$k]['createdate']= date('H:i:s d-m-Y',strtotime($rs['createdate']));
				if(!$rs['photo'])
					$result[$k]['photo']= base_url('upload/avatar/default.png');
			}
			
			return $result;
		}
		else
			return array();
 	}

 	function count_unseen(){
 		
	 	$logged_in=$this->session->userdata('logged_in');
	 	$uid=$logged_in['uid'];

	 	$sql = "select count(*) as num from notify_user u inner join notify n on n.nid = u.nid inner join savsoft_users z on z.uid = n.uid ";
	 	$sql .= " where u.status = 0 and u.uid = $uid and n.uid != $uid";
	 	// if($logged_in['su'] != '1'){
	  // 		$sqls = " where u.status = 0 and u.uid = ".$uid." and n.uid != ".$uid."";
	 	// 	$sql .= $sqls;
	 	// }else{
	 	// 	$sqls = " where u.status = 0 and u.uid = ".$uid." and n.uid != ".$uid."";
	 	// 	$sql .= $sqls;
	 	// }
	 	
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
	function see_notify($id){
 		$logged_in=$this->session->userdata('logged_in');
 		$uid=$logged_in['uid'];
 		$data = array('status' => '1');
 		$this->db->where('id', $id);
 		$this->db->update('notify_user', $data);

 		$sql = "select u.uid,u.id, u.status, n.action , n.content, n.click,n.createdate, z.first_name  username, z.photo from notify_user u 
			inner join notify n on n.nid = u.nid 
			inner join savsoft_users z on z.uid = n.uid 
			where u.uid = $uid and n.uid != $uid and u.id=$id group by u.id order by u.status,u.id desc";
			
		$query = $this->db->query($sql);
	 	return $query->result_array();
 	}
	function do_homework($quid,$auid){
		//log_message('error',"+++++++".$quid);
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$sql="SELECT * FROM notify n where n.model='quiz'";
		$click = $this->db->query($sql)->result_array();
		//log_message('error',"+++++++".$click[0]['click']);
		//log_message('error',"+++++++".$click.length);
		foreach($click as $k=>$cl){
			$str=$cl['click'];
			$str_find='s/';
			$start=strpos($str,$str_find);			
			//log_message("error",$start);
			$str1=substr($str,$start+2);
			//log_message("error",$str1);
			$str_find1='/';
			$end=strpos($str1,$str_find1);
			//log_message("error",$end);
			$quid_quiz=substr($str1,0,$end);
			//log_message("error","---------".$quid_quiz);
			
			if($quid==$quid_quiz){
				//log_message("error","---------".$quid_quiz);
				$quid_="s/".$quid;
				$sql1=" SELECT * FROM notify n WHERE n.uid=$auid and n.click like( '%$quid_%') ";
				$nid = $this->db->query($sql1)->row_array()['nid'];
				//log_message("error","---------".$nid);
				$data = array('status' => '1');
				$this->db->where('nid', $nid);
				$this->db->where('uid', $uid);
				$this->db->update('notify_user', $data);
			}
		}
	}
}
?>
