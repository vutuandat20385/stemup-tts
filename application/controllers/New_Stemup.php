<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class New_stemup extends CI_Controller { 
    function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
        $this->load->library('pagination');
        $this->load->library('upload');
		$this->load->model("new_stemup_model");
	
		$this->lang->load('basic', $this->config->item('language'));
    }
    function index(){
        $user = $this->session->userdata("logged_in");
      //  var_dump($user['id'])
        if($user['uid'] == 1){
            $data['class'] = $this->new_stemup_model->get_class_new();
            $this->load->view('sadmin/news',$data);
        }
    }
    function create_new(){
        $user = $this->session->userdata("logged_in");
        if($user['uid'] == 1){
            $data['mess'] = $this->new_stemup_model->insert_new();
            
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
    function check_name_exist(){
        $user = $this->session->userdata("logged_in");
        if($user['uid'] == 1){
            $data['check'] = $this->new_stemup_model->check_name_exist();
            header('Content-Type: application/json');
            echo json_encode($data);
        }        
    }
}