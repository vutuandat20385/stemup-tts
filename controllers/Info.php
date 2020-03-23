<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Info extends CI_Controller {
    function __construct()
    {
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
		$this->load->view('info/info_mobile');	
    }
    public function info_desktop(){
        $data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
		$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
        $user = $this->session->userdata('logged_in');
        if($user){
			
		} else {
            
            $this->load->view('info/info_desktop',$data);
            $this->load->view('home/modal',$data);
            $this->load->view('home/footer',$data);
        }
    }
    
}