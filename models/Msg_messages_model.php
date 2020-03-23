<?php
Class Msg_messages_model extends CI_Model
{
	function add_message_system($aid, $message){
		$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
		$msgData = array(
			'coversation_id' => 0,
			'sender_id' => 1,
			'message_type' => 'system',
			'message' => $message,
			'attachment_thumb_url' => '',
			'attachment_url' => '',
			'created_at' => date('Y-m-d H:i:s',time()),
			'guid' => $uid,
		);
		$this->db->insert('msg_messages',$msgData);

		$assData['reminde']= 1;
	  	$this->db->where('id',$aid);
	  	$this->db->update('savsoft_assign',$assData);

	  	$this->db->where('id',$aid);
	  	$query = $this->db->get('savsoft_assign');
	  	$assign = $query->row_array();

	  	$assignfrom = array(
	  		"uid" => $uid,
	  		"content" => "Bạn có một bài kiểm tra cần phải hoàn thành.",
	  		"model" => "savsoft_quiz",
	  		"action" => "Reminder",
	  		"click" => "window.location.href = '".site_url()."/quiz/validate_quizs/".$assign['quid']."/".$assign['auid']."/".$assign['id']."'"
	  	);
	  	$this->db->insert('notify',$assignfrom);
	  	$nid = $this->db->insert_id();

	  	$assignto1 = array(
 			'nid' => $nid,
 			'uid' => $assign['uid'],
 		);
 		$this->db->insert('notify_user', $assignto1);

	  	$message = "Bạn có một bài kiểm tra cần phải hoàn thành.";
		$this->load->model('notification_model');
 		$dataArr = array(
 			'message' => $message,
 			'title' => "Thông Báo"
 		);
 		$this->notification_model->sendNotification($assign['uid'], $dataArr);
		
		$this->load->model('api_model');
		$this->db->where('savsoft_users.uid',$assign['uid']);
	   	$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$query=$this->db->get('savsoft_users');
	 	$assigned = $query->row_array();
		$toemail = $assigned['email'];
		$message = 'Bạn có một bài kiểm tra cần phải hoàn thành. Hãy click vào đường link dưới đây để trả lời.<br><br><a href="'.site_url().'/quiz/validate_quizs/'.$assign['quid'].'/'.$assign['auid'].'/'.$assign['id'].'"><img src="http://do.stem.vn/images/button_lam-bai.png" height="40" width="116"></a>';
		$this->api_model->sendmail($toemail, $message);
	}

	function get_assign_reminde($aid){
		$this->db->where('id', $aid);
		$query=$this->db->get('savsoft_assign');
		$assign = $query->row_array();
		if(is_null($assign['reminde']) || $assign['reminde'] == 0){
			//log_message('error', "null");
			return true;
		}else{
			return false;
		}
	}


	function get_message_of_user(){
		$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	$sql = "select m.*, s.* from msg_messages m inner join savsoft_users s on s.uid = m.sender_id where m.guid =".$uid."  order by m.created_at desc limit 0,10";
    	$query = $this->db->query($sql);
		return $query->result_array();
	}

	function count_unseen_message(){
		$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	$sql = "select count(*) as num from msg_messages where guid = ".$uid." and seen = 0";
    	$query = $this->db->query($sql);
		return $query->result_array();
	}

	function seen_message(){
		$logged_in=$this->session->userdata('logged_in');
 		$uid=$logged_in['uid'];
 		$data = array('seen' => '1');
 		$this->db->where('guid', $uid);
 		$this->db->where('message_type', 'system');
 		$this->db->update('msg_messages', $data);
	}
}
?>