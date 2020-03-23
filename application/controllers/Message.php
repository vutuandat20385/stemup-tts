<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	   	$this->load->database();
	   	$this->load->helper('url');
	   	$this->load->model("msg_messages_model");
	   	$this->load->model("notify_model");
	   	$this->load->model("post_model");
	   	$this->lang->load('basic', $this->config->item('language'));

	}

	public function index(){
		$user= $this->session->userdata('logged_in');
		$data['link_photo']=$user['photo'];
		$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$this->load->view('after_login/message',$data);
		//$this->load->view('home/footer',$data);
	}

	public function send_reminders($aid){
		//if($this->msg_messages_model->get_assign_reminde($aid)){
			$message = "Bạn có một bài kiểm tra cần phải hoàn thành.";
			$this->msg_messages_model->add_message_system($aid, $message);
			$data['result'] = "success";
		//}else{
		//	$data['result'] = "error";
		//}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function message_for_user($view=''){
		if($view != ''){
			$this->msg_messages_model->seen_message();
		}
		$data['nuser'] = $this->msg_messages_model->get_message_of_user();
		$data['ncount'] = $this->msg_messages_model->count_unseen_message();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
}
?>