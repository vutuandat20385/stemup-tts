<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thamkhao extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	    $this->lang->load('basic', $this->config->item('language'));
	    $this->load->model('thamkhao_model');
	}

	public function baidoc(){
		$url = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		if($url=='0'){
			$this->load->view('stemup/index');
		}else{
			$data['list']=$this->thamkhao_model->get_list_material();
			$data['content']=$this->thamkhao_model->get_content($url);
			$this->load->view('thamkhao/baidoc',$data);
		}
		
		
	}



	
}
