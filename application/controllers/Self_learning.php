<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Self_learning extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("quiz_model");
		$this->load->model("qbank_model");
		$this->load->model("user_model");
		$this->load->model("api_model");
		$this->load->model("self_learning_model");
		$this->load->library('Form_validation');
		$this->load->library('pagination');
		$this->load->helper(array('Form', 'Cookie', 'String', 'url'));

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
			// echo "<pre>";
			// print_r($data['cid']);
			// echo "</pre>";

			$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
			$limit = 12;
			$start = $page*$limit;

			$config['base_url'] = base_url() . 'index.php/self_learning/category'.'/'.$data['cid'];
			$config['total_rows'] = $this->self_learning_model->get_total_record_n($data['lid'],$data['cid']);
			$config['per_page'] = $limit;
			$config["uri_segment"] = 4;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$data['result']=$this->self_learning_model->get_list_category_by_cid($data['lid'],$data['cid'],$start,$limit);


			$config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] = '</ul>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['prev_link'] = '<i class="fa"></i><<';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';


			$config['next_link'] = '>> <i class="fa"></i>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';

			$this->pagination->initialize($config);

            // build paging links
			$data['links'] = $this->pagination->create_links();
			

			// echo "<pre>";
			// print_r($data['result']);
			// echo "</pre>";
			// die();

			$this->load->view('stemup/category_learning',$data);
		}
	}

}