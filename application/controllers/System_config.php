<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_config extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
		$this->lang->load('basic', $this->config->item('language'));
        $us = $this->session->userdata('logged_in');
		if(!$us){
			redirect('home');
		}
		else{
			if($us['su']!=1){
				redirect('home_user');
			}
		}
			
			
	 }
	 function index(){
		 $data['host_name']=$this->config->item('smtp_hostname');
		 $data['port']=$this->config->item('smtp_port');
		 $data['user_name']=$this->config->item('smtp_username');
		 $data['password']=$this->config->item('smtp_password');
		 $data['firebase_serverkey']=$this->config->item('firebase_serverkey');
		 $data['firebase_topic']=$this->config->item('firebase_topic');
		 $this->load->view('header');
		 $this->load->view('system_config/system_config', $data);
		
	 }
	 function update_ms_config(){
	    $info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		$file="./application/config/ms_config.php";
		
		$content="<?php 
		$"."ms_hostname='".$info['host_name']."';
		$"."ms_port='".$info['port']."';
		$"."ms_username='".$info['user_name']."';
		$"."ms_password='".$info['password']."';
		?>";
		if(file_put_contents($file,$content)){
			echo "Update Success";
		}
		else{
			echo "Update Fail";
		}
	 }

	 function update_firebase_config(){
	 	$info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		$file="./application/config/firebase.php";
		
		$content="<?php 
		$"."firebase_serverkey='".$info['firebase_serverkey']."';
		$"."firebase_topic='".$info['firebase_topic']."';
		?>";
		log_message('error', $content);
		if(file_put_contents($file,$content)){
			echo "Update Success";
		}
		else{
			echo "Update Fail";
		}
	 }
	 
	 function test_connect_ms(){
		$info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		$this->load->library('email');

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = $info['host_name'];
		$config['smtp_user'] = $info['user_name'];
		$config['smtp_pass'] = $info['password'];
		$config['smtp_port'] = $info['port'];
		$config['smtp_timeout'] = $this->config->item('smtp_timeout');
		$config['mailtype'] = $this->config->item('smtp_mailtype');
		$config['starttls']  = $this->config->item('starttls');
		$config['newline']  = $this->config->item('newline');
		
		$this->email->initialize($config);
		$toemail = $info['user_name'];
		$fromemail =  $info['user_name'];
		$fromname = $this->config->item('fromname');
		$subject="test";
		$message="test";
		$this->email->to($toemail);
	    $this->email->from($fromemail, $fromname);
		$this->email->subject($subject);
		$this->email->message($message);
		if(!$this->email->send()){
			echo "Connect Fail";
		}
		else{
			echo "Connect Success";
		}
	 }
}