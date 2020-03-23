<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
	   $this->load->model('user_model');
	   $this->load->model("qbank_model");
	   $this->load->model("quiz_model");
	   $this->load->model("result_model");
	    $this->load->model("dashboard_model");
	   $this->lang->load('basic', $this->config->item('language'));
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
				$this->session->unset_userdata('logged_in');		
			redirect('home');
		}
	 }

	public function index()
	{
		$data['title']=$this->lang->line('dashboard');
		
		$logged_in=$this->session->userdata('logged_in');
        $acp=explode(',',$logged_in['setting']);
			if(in_array('All',$acp)){
				
						
						
				//$data['num_users']=$this->user_model->num_users();
				//$data['num_qbank']=$this->qbank_model->num_qbank();
				//$data['num_quiz']=$this->quiz_model->num_quiz();
				
				$data['num_users']=$this->dashboard_model->num_users();
				$data['num_student']=$this->dashboard_model->num_student();
				$data['num_teacher']=$this->dashboard_model->num_teacher();
		        $data['num_qbank']=$this->dashboard_model->num_qbank();
				 $data['num_quiz']=$this->dashboard_model->num_quiz();
		
		}
			

		
	 
	 
		$this->load->view('header',$data);
		$this->load->view('dashboard/main',$data);
		$this->load->view('footer',$data);
	}
	
	
	
		
		
	
}
