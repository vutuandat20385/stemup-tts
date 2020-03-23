<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Self_learning extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model("quiz_model");
		$this->load->model("qbank_model");
		$this->load->model("user_model");
		$this->load->model("api_model");
		$this->load->model("self_learning_model");

		$user= $this->session->userdata('logged_in');
		if(!$user){
			redirect('home');
		}

	}
	function index(){
		$user= $this->session->userdata('logged_in');
        if($user){
			$data= $user;
			$data['uid']=$user['uid'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);

		if(!$data['photo']){
			$data['photo']= base_url('upload/avatar/default.png');

			
			$data['id_quiz_fun']=$this->quiz_model->get_id_fun_quiz();
			$data['quiz_fun']=$this->quiz_model->get_fun_quiz(0,1)[0];
			$data['id_mcq_fun']=$this->qbank_model->get_id_mcq_fun(0,0,$s);
			$data['mcq_fun']=$this->qbank_model->get_mcq_fun1(0,5,0,0,$s);
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(10);
			$data['category_list1']=$this->qbank_model->category_list();
		}

			$data['list_category']=$this->self_learning_model->get_list_category($user['grade']);
			// echo "<pre>";
			// print_r($data['mcq_fun']);
			// echo "</pre>";
			$data['points']= $this->api_model->user_point();			
		    $this->load->view('stemup/self_learning',$data);

        } else {
            redirect('home');
        }  


    }
    function category(){
    	$user= $this->session->userdata('logged_in');
    	if($user){
    		$data= $user;
			$data['uid']=$user['uid'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);

		if(!$data['photo']){
			$data['photo']= base_url('upload/avatar/default.png');
		}

    		$data['lid']=$user['grade']-2;
    		$data['cid']=$this->uri->segment(3);
    		$data['tenmon']=$this->self_learning_model->get_category_name($data['cid']);
    		$data['result']=$this->self_learning_model->get_list_category_by_cid($data['lid'],$data['cid']);

    		

    		$this->load->view('stemup/category_learning',$data);
    	}
    }
  
}