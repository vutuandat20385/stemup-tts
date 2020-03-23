<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Propose extends CI_Controller {

	 function __construct(){
	   	parent::__construct();
	    $this->load->helper('url');
	   	$this->load->model('notify_model');
		$this->load->model('user_model','',TRUE);
		$this->lang->load('basic', $this->config->item('language'));
        $user =$this->session->userdata('logged_in');
		if(!$user){
			redirect("home");
        }
		else if($user['su']!=6){
			redirect("home_user");
		}
	 }
	 

	 function rating_question(){
		    $info_pprt = json_decode($this->input->raw_input_stream,true);
			$user =$this->session->userdata('logged_in');
			$content = 'Đã gửi đề xuất đánh giá câu hỏi #'.$info_pprt['question_id'];
			$model = "qbank";
			$action = "new propose";
			$click= 'propose_question('.$info_pprt['question_id'].')';
			$nid = $this->notify_model->insert_notify($user['uid'], $content, $model, $action, $click);
			$this->notify_model->insert_notify_user($nid, $user['uid']);
			$touids = explode(',', $info_pprt['uid_pprt']);
			foreach($touids as $touid){
				$this->notify_model->insert_notify_user($nid, $touid);
			}
			
		    header('Content-Type: application/json');
		    echo json_encode(array("status"=>"1"));
		
	 }
	 
	 function get_question_author(){

		$this->db->select('inserted_by');
		$this->db->from('savsoft_qbank');
		$this->db->group_by('inserted_by');
		$data= $this->db->get()->result_array();
		$uids='';
		for($i=0; $i<count($data); $i++){
			if($i==0)
				$uids.=$data[$i]['inserted_by'];
			else
				$uids.=','.$data[$i]['inserted_by'];
		}
		$sql = "select uid,first_name,last_name,email2,email,photo,user_code from savsoft_users where uid in ($uids)";
		$author = $this->db->query($sql)->result_array();
		header('Content-Type: application/json');
		echo json_encode($author);
	
	 }
	 
	 function rating_quiz(){
		    $info_pprt = json_decode($this->input->raw_input_stream,true);
			$user =$this->session->userdata('logged_in');
			$content = 'Đã gửi đề xuất đánh giá bài kiểm tra #'.$info_pprt['quiz_id'];
			$model = "quiz";
			$action = "new propose";
			$click= 'propose_quiz('.$info_pprt['quiz_id'].')';
			$nid = $this->notify_model->insert_notify($user['uid'], $content, $model, $action, $click);
			$this->notify_model->insert_notify_user($nid, $user['uid']);
			$touids = explode(',', $info_pprt['uid_pprt']);
			foreach($touids as $touid){
				$this->notify_model->insert_notify_user($nid, $touid);
			}
			
		    header('Content-Type: application/json');
		    echo json_encode(array("status"=>"1"));
		
	 }
   
}

?>


















