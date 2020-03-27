<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('Form_validation');
		$this->load->library('pagination');
		$this->load->helper(array('Form', 'Cookie', 'String', 'url'));
		$this->load->model('new_stemup_model');
		$this->load->model('qbank_model');
		$this->load->model('user_model');
		$this->lang->load('basic', $this->config->item('language'));
		$this->load->helper('cookie');
	}


	public function index()
	{
		$data['post'] = $this->new_stemup_model->get_post_homepage();
		$this->load->view('stemup/index', $data);
	}
	public function index1()
	{   		          
		if (isset($_SESSION['logged_in'])) {
			$user = $_SESSION['logged_in'];
			if ($user['su'] = 2) {
				redirect("action");
			} else {
				$data['post'] = $this->new_stemup_model->get_post_homepage();
				$this->load->view('stemup/index', $data);
			}
		} else {
		
			if (isset($_COOKIE['savsoftquiz'])) {
				$web_token = $_COOKIE['savsoftquiz'];
				$user = $this->user_model->get_by_cookie2($web_token);
				$this->session->set_userdata('logged_in', $user);
				$data = $user;
				if ($user['su'] = 2) {
					redirect("action");
				} else {
					$data['post'] = $this->new_stemup_model->get_post_homepage();
					$this->load->view('stemup/index', $data);
				}
			}
		}
        //    $user = $_SESSION['logged_in'];
        //  if(isset($user) && $user['su'] = 2){
		// 	redirect("action");
		//  }else{
		// 	$data['post'] = $this->new_stemup_model->get_post_homepage();
		// 	$this->load->view('stemup/index', $data);
		//  }


	}
	function guide()
	{

		$user = $this->session->userdata('logged_in');
		if ($user) {
			if ($user['su'] = 2) {
				redirect("action");
			} else {
				$data['post'] = $this->new_stemup_model->get_post_homepage();
				$this->load->view('stemup/guide', $data);
			}
		} else {
			if (isset($_COOKIE['savsoftquiz'])) {
				$web_token = $_COOKIE['savsoftquiz'];
				$user = $this->user_model->get_by_cookie2($web_token);
				$this->session->set_userdata('logged_in', $user);
				$data = $user;
				if ($user['su'] = 2) {
					redirect("action");
				} else {
					$data['post'] = $this->new_stemup_model->get_post_homepage();
					$this->load->view('stemup/guide', $data);
				}
			}
		}
	}
	function faq()
	{
		$user = $this->session->userdata('logged_in');
		if ($user) {
			if ($user['su'] = 2) {
				redirect("action");
			} else {
				$data['post'] = $this->new_stemup_model->get_post_homepage();
				$this->load->view('stemup/faq', $data);
			}
		} else {
			if (isset($_COOKIE['savsoftquiz'])) {
				$web_token = $_COOKIE['savsoftquiz'];
				$user = $this->user_model->get_by_cookie2($web_token);
				$this->session->set_userdata('logged_in', $user);
				$data = $user;
				if ($user['su'] = 2) {
					redirect("action");
				} else {
					$data['post'] = $this->new_stemup_model->get_post_homepage();
					$this->load->view('stemup/faq', $data);
				}
			}
		}
	}
	function setup()
	{

		$user = $this->session->userdata('logged_in');
		if ($user) {
			if ($user['su'] = 2) {
				redirect("action");
			} else {
				$data['post'] = $this->new_stemup_model->get_post_homepage();
				$this->load->view('stemup/setup', $data);
			}
		} else {
			if (isset($_COOKIE['savsoftquiz'])) {
				$web_token = $_COOKIE['savsoftquiz'];
				$user = $this->user_model->get_by_cookie2($web_token);
				$this->session->set_userdata('logged_in', $user);
				$data = $user;
				if ($user['su'] = 2) {
					redirect("action");
				} else {
					$data['post'] = $this->new_stemup_model->get_post_homepage();
					$this->load->view('stemup/setup', $data);
				}
			}
		}
	}
	function policy()
	{

		$this->load->view('stemup/home/policy');
	}
	function user_terms()
	{

		$this->load->view('stemup/home/user_terms');
	}
	function news()
	{

		$user = $this->session->userdata('logged_in');
		if ($user) {
			if ($user['su'] = 2) {
				redirect("action");
			} else {
				$data['page'] = 0;
				$data['limit'] = 6;
				$data['num_news'] = $this->new_stemup_model->num_list_news();
				$data['news'] = $this->new_stemup_model->get_list_news(6, 0);
				$data['other_news'] = $this->new_stemup_model->get_other_news_rand();
				$data['other_news1'] = $this->new_stemup_model->get_other_news_rand1();
				$data['common_news'] = $this->new_stemup_model->get_common_news_rand();
				$data['num_page'] = ceil($data['num_news'] / 6);
				$data['common_news1'] = $this->new_stemup_model->get_common_news_rand_1();
				$this->load->view('stemup/news', $data);
			}
		} else {
			if (isset($_COOKIE['savsoftquiz'])) {
				$web_token = $_COOKIE['savsoftquiz'];
				$user = $this->user_model->get_by_cookie2($web_token);
				$this->session->set_userdata('logged_in', $user);
				$data = $user;
				if ($user['su'] = 2) {
					redirect("action");
				} else {
					$data['page'] = 0;
					$data['limit'] = 6;
					$data['num_news'] = $this->new_stemup_model->num_list_news();
					$data['news'] = $this->new_stemup_model->get_list_news(6, 0);
					$data['other_news'] = $this->new_stemup_model->get_other_news_rand();
					$data['other_news1'] = $this->new_stemup_model->get_other_news_rand1();
					$data['common_news'] = $this->new_stemup_model->get_common_news_rand();
					$data['num_page'] = ceil($data['num_news'] / 6);
					$data['common_news1'] = $this->new_stemup_model->get_common_news_rand_1();
					$this->load->view('stemup/news', $data);
				}
			}
		}
	}
	function tintuc()
	{
		$url_name = $this->uri->segment(3);


		if (isset($url_name)) {
			$data['new'] = $this->new_stemup_model->get_detail_new($url_name);
			$id = $data['new']['id'];
			$data['other_news'] = $this->new_stemup_model->get_other_news($id);
			$data['common_news'] = $this->new_stemup_model->get_common_news($id);


			$this->load->view('stemup/news/tintuc', $data);
		} else header('location:' . site_url('home/news'));
	}

	function contact()
	{
		$this->load->view('stemup/contact');
	}

	function search_n()
	{

		$data['timkiem'] = $_GET['timkiem'];
		$page_n = $this->uri->segment(3);


		$page = ($page_n) ? ($page_n - 1) : 0;
		$limit = 6;
		$start = $page * $limit;

		$config['base_url'] = base_url() . 'index.php/home/search_n';
		$config['total_rows'] = $this->new_stemup_model->get_total_record($data['timkiem']);
		$config['per_page'] = $limit;
		$config["uri_segment"] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$data['post'] = $this->new_stemup_model->get_search_n($start, $limit, $data['timkiem']);


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


		$data['rand'] = $this->new_stemup_model->get_post_search();
		$this->load->view('stemup/search_n', $data);
	}
	function get_data_news()
	{
		$inp = json_decode($this->input->raw_input_stream, true);
		$data['list'] = $this->new_stemup_model->get_list_news($inp['limit'], $inp['page']);
		$data['num_list'] = $this->new_stemup_model->num_list_news();
		$data['num_page'] = ceil($data['num_list'] / 6);

		foreach ($data['list'] as $val) {
			$str = $val['description'];

			$sub = '';
			$len = 0;
			foreach (explode(' ', $str) as $word) {
				$part = (($sub != '') ? ' ' : '') . $word;
				$sub .= $part;
				$len += strlen($part);
				if (strlen($word) > 3 && strlen($sub) >= 200) {
					break;
				}
			}
			log_message("error", "+++++" . $str);

			$data['description1'] = $sub . (($len < strlen($str)) ? '...' : '');
			log_message("error", "+++++" . $data['description1']);
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	function resetpassword2($token)
	{
		$result = $this->uri->segment(4);
		if ($result == 'success') {
			$data['result'] = $result;
		}

		$us = $this->user_model->resetpassword2($token);
		$data['user'] = $us;
		$data['token'] = $token;
		$this->load->view('stemup/resetpwd', $data);
	}
	function resetpassword3($token)
	{
		$this->user_model->resetpassword3($token);
	}
	
}
