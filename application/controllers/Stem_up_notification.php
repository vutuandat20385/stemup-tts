<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stem_up_notification extends CI_Controller {

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
       $this->load->helper('date');
      $this->lang->load('basic', $this->config->item('language'));
    }
    function index() {
		$user= $this->session->userdata('logged_in');
        if($user){
            $data=$user;
            if(!$data['photo']){
                $data['photo']= base_url('upload/avatar/default.png');
            }
            $data['notify'] = $this->notify_model->notify_all_list();
        //    var_dump($data['notify']);
			//$data['points']= $this->api_model->user_point();
			//$data['noti']= $this->api_model->count_notification();
            $this->load->view('stemup/notification',$data);
        } else {
            redirect('home');
        }
    }
}