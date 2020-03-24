<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Action extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('api_model');
		$this->load->model('quiz_model');
		$this->lang->load('basic', $this->config->item('language'));
	}
	public function index()
	{
		$user = $this->session->userdata('logged_in');
		if ($user) {
			$data = $user;
			if (!$data['photo']) {
				$data['photo'] = base_url('upload/avatar/default.png');
			}
			//$data['points']= $this->api_model->user_point();
			$data['limit'] = 10;
			$data['page'] = 0;
			$data['cid'] = 0;
			$data['uid'] = 0; 
			
			$data['head'] = $this->load->view('action/layout/head', $data, true);
			$data['leftmenu'] = $this->load->view('action/layout/leftmenu', $data, true);
			$data['foot'] = $this->load->view('action/layout/footer', $data, true);
			$data['content'] = $this->load->view("action/pages/assign_quiz_student", $data,true);
			$this->load->view("action/layout/main", $data);
		} else {
			redirect('home');
		}
	}
}
