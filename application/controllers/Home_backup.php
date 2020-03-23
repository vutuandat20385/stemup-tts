<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('Form_validation');
		$this->load->helper(array('Form', 'Cookie', 'String', 'url'));
		$this->load->model('new_stemup_model');
		$this->lang->load('basic', $this->config->item('language'));
	}

	public function index(){

		$data['post']=$this->new_stemup_model->get_post_homepage();
		$data['rand']=$this->new_stemup_model->get_post_rand();
	// echo '<pre>';
	// print_r ($data['post']);
	// echo '</pre>';
		$this->load->view('stemup/index',$data);

	}

	function guide(){

		$this->load->view('stemup/guide', $data);
	}
	function faq(){

		$this->load->view('stemup/faq');
	}
	function setup(){

		$this->load->view('stemup/setup');
	}
	function news(){
		$data['news']=$this->new_stemup_model->get_list_news();
		$this->load->view('stemup/news',$data);
	}
	
	function tintuc(){
		$url_name=$this->uri->segment(3);
		if(isset($url_name)){
			$data['new']=$this->new_stemup_model->get_detail_new($url_name);
			$this->load->view('stemup/news/tintuc',$data);
		}else header('location:'.site_url('home/news'));
	}

	function contact(){
		$this->load->view('stemup/contact');
	}

	function search_n(){

		$data['timkiem'] = $this->input->post('timkiem');
		
		// echo $data['timkiem'];
		// $data['timkiem1'] = $_POST['timkiemm1'];
		// echo $data['timkiem1'];

		// if($data['timkiem']=''){
		// 	log_message('error','giatri');
		// 	header('location:'.site_url('home'));
		// 	// $this->load->view('stemup/index');
		// }else{
			log_message('error','giatri11');
			$data['post']=$this->new_stemup_model->get_search_n($data['timkiem']);
			// echo "<pre>";
			// print_r($data['post']);
			// echo "</pre>";
			$data['rand']=$this->new_stemup_model->get_post_search();
			$this->load->view('stemup/search_n',$data);
		// }
	}
}
