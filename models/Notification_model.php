<?php
Class Notification_model extends CI_Model
{
 
  function notification_list($limit){
	  $logged_in=$this->session->userdata('logged_in');
		
	  if($this->input->post('search')){
	 $this->db->or_like('savsoft_notification.nid',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.title',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.message',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.notification_date',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.click_action',$this->input->post('search'));
	 $this->db->or_like('savsoft_notification.notification_to',$this->input->post('search'));
	  }
	  if($logged_in['su'] == '0'){
	  $uid=$logged_in['uid'];
	  $this->db->or_where('savsoft_notification.uid',$uid);
	$this->db->or_where('savsoft_notification.uid','0');
		
	  }
	  $this->db->join('savsoft_users','savsoft_users.uid=savsoft_notification.uid','left');
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('nid','desc');
		$query=$this->db->get('savsoft_notification');
		return $query->result_array();
		
	 
 }
 
 
 function insert_notification($result,$nval){

         $userdata=array(
         'title'=>$this->input->post('title'),
         'message'=>$this->input->post('message'),
         'click_action'=>$this->input->post('click_action'),
         'uid'=>$this->input->post('uid'),
         'notification_to'=>$nval,
         'response'=>$result,
         
         );
         $this->db->insert('savsoft_notification',$userdata);
         
 
 
 }


 	function sendNotification($uid, $dataArr) {
    	/*$fcmApiKey = $this->config->item('firebase_serverkey');
        $url = 'https://fcm.googleapis.com/fcm/send';
 
    	$message = $dataArr['message'];
        $title = $dataArr['title'];

        $msg = array(
        	'id' => 12144, 
        	'title' => $title, 
        	'body' => $message,
            'content_available' => true,
            'uid' => $uid,
            'sound' => 'default'
        );
        $topics = $this->config->item('firebase_topic');
        $fields = array(
        	'data' => $msg,
        	'to' => $topics
        );
        log_message('error', json_encode($fields));
 
        $headers = array(
        	'Content-Type: application/json',
            'Authorization: key='.$fcmApiKey
        );

        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);    
         */
        return $result;
    }
 
 
 
   
 
}
?>
