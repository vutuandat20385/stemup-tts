<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {

	function __construct(){
	   parent::__construct();
	   $this->load->database();
	   $this->load->library('Form_validation');
       $this->load->helper(array('Form', 'Cookie', 'String', 'url'));
	   $this->load->model('post_model');
	   $this->load->model('user_model');
	   	$this->load->model("qbank_model");
	   	$this->load->model("account_model");
	   	$this->load->model("result_model");
	   	$this->load->model("api_model");
	   	$this->load->model("quiz_model");
	    $this->load->model("classes_model");
		$this->load->model('notify_model');
		$this->load->model("data_model");
		$this->load->model("review_model");
		$this->load->model("comment_model");
		$this->load->model("profile_model");
		$this->load->model('event_racing_model');
	   $this->lang->load('basic', $this->config->item('language'));
	}
	public function index(){

		$this->load->view('help/app_mobile', $data);
		
	
	}
	
	public function hocsinh(){
		$this->load->view('help/hocsinh', $data);
	}
}