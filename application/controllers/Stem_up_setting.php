<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stem_up_setting extends CI_Controller {

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
    function index(){
        $user= $this->session->userdata('logged_in');
        if($user){
			$data= $user;
            $info = $this->profile_model->getprofile($user['uid']);
			$data['uid']=$user['uid'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
		//    $data['user_name']= $info['last_name'].' '.$info['first_name'];
		if(!$data['photo']){
			$data['photo']= base_url('upload/avatar/default.png');
		}
            $data['first_name'] = $info['first_name'];
            $data['last_name'] = $info['last_name'];
			$data['sub'] = $info['subscribe'];
			$data['email']=$info['email2'];
			$data['phone']=$info['contact_no'];
			$data['su']=$user['su'];
			$data['uid']=$user['uid'];
			$data['user_code']=$user['user_code'];
			$data['birthdate']=$info['birthdate'];
			$data['link_photo']=$info['photo'];
			$data['address']=$info['address'];
			$data['logo']=$info['logo'];
			$data['text_license']=$info['text_license'];
			$data['out_link']=$info['out_link'];
			if($info['tinhthanh_id'])
				$data['tinhthanh_id']=$info['tinhthanh_id'];
			else
				$data['tinhthanh_id']=0;
			
			if($info['quanhuyen_id'])
				$data['quanhuyen_id']=$info['quanhuyen_id'];
			else
				$data['quanhuyen_id']=0;
			
			if($info['xaphuong_id'])
				$data['xaphuong_id']=$info['xaphuong_id'];
			else
				$data['xaphuong_id']=0;
			$data['category']=$info['category'];
			$data['categories'] =array_reverse( $this->qbank_model->category_list());
			$data['categ_ids'] =explode(",",$info['category_id']);
			$data['interest_cat_ids'] =explode(",",$info['interest_cat_ids']);
		    $data['levels'] = $this->qbank_model->level_list();
			$data['interest_level_ids'] =explode(",",$info['interest_level_ids']);
			$data['description'] = $info['description'];
			$data['dataitem_list']=$this->data_model->dataitem_list(1, 1);
		//	$data['grade'] = $this->profile_model->grade_info();
		//	$data['grade_dt'] = $this->profile_model->grade_info_user();
		//	$data['readfun'] = $this->profile_model->lesson_read_fun();
		//	$data['readfun_dt'] = $this->profile_model->lesson_read_fun_user();
		//	$data['readfun_data'] = explode(",",$data['readfun_dt']['read_fun']);
			$data['tinhthanh']=$this->profile_model->data_tinh_thanh();
			$info1=$this->api_model->school_users();
			
			if($info1['tinh_thanh'])
				$data['scl_tinhthanh_id']=$info1['tinh_thanh'];
			else
				$data['scl_tinhthanh_id']=0;
			
			if($info1['quan_huyen'])
				$data['scl_quanhuyen_id']=$info1['quan_huyen'];
			else
				$data['scl_quanhuyen_id']=0;
			if($info1['schoolid'])
				$data['scl_school_id']=$info1['schoolid'];
			else
				$data['scl_school_id']=0;
			
			$data['schools']=$info1['school_name'];
            
			//$data['points']= $this->api_model->user_point();
            //$data['noti']= $this->api_model->count_notification();			
            $this->load->view('stemup/setting',$data);
        } else {
            redirect('home');
        }     
        
    }
}