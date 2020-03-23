<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Study extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('qbank_model');
		$this->load->model('quiz_model');
		$this->load->model('api_model');
	    $this->lang->load('basic', $this->config->item('language'));

	}

	public function index(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$data= $user;
			if(!$data['photo']){
				$data['photo']= base_url('upload/avatar/default.png');
			}
			
			$data['id_quiz_fun']=$this->quiz_model->get_id_fun_quiz();
			$data['quiz_fun']=$this->quiz_model->get_fun_quiz(0,1)[0];
			$data['id_mcq_fun']=$this->qbank_model->get_id_mcq_fun(0,0,$s);
			$data['mcq_fun']=$this->qbank_model->get_mcq_fun(0,5,0,0,$s);
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(10);
			$data['category_list']=$this->qbank_model->category_list();
			//$data['points']= $this->api_model->user_point();
			//$data['noti']= $this->api_model->count_notification();
			$this->load->view('stemup/student_study', $data);
		}
		else{
			redirect('home');
		}
	}

	
}
