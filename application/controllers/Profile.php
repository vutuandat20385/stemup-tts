<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	 function __construct() {
	   	parent::__construct();
	   	$this->load->database();
	   	$this->load->helper('url');
	   	$this->load->model("user_model");
	   	$this->load->model("qbank_model");
	   	$this->load->model("result_model");
	   	$this->load->model("api_model");
	   	$this->load->model("quiz_model");
	    $this->load->model("classes_model");
		$this->load->model("post_model");
		$this->load->model('notify_model');
		$this->load->model("data_model");
		$this->load->model("profile_model");
	   	$this->lang->load('basic', $this->config->item('language'));

	   	if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
			$this->session->unset_userdata('logged_in');		
			redirect('home');
		}
	 }
	 
	 function index(){
		$user =$this->session->userdata('logged_in');
		if($user){
			
			$info = $this->profile_model->getprofile($user['uid']);
			$data['uid']=$user['uid'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['user_name']= $info['last_name'].' '.$info['first_name'];
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
			
		}
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$this->load->view('after_login/profile',$data);
        $this->load->view('home/footer',$data);
		
	}
	function changeAccess($uid,$su,$newsu){
		$user =$this->session->userdata('logged_in');
		if($user){
			$this->session->sess_destroy();
			$this->db->where('uid',$uid);
			$this->db->where("user_status", "Active");
			$olddata = $this->db->get('savsoft_users')->row_array();
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				 $charactersLength = strlen($characters);
				 $check=true;
				 $user_code="";
				  while($check){
					   $user_code = '';
					   for ($i = 0; $i < 6; $i++) {
						   $user_code.= $characters[rand(0, $charactersLength - 1)];
					   }
					  $this->db->where('user_code', $user_code);
					   $n = $this->db->get('savsoft_users')->num_rows();
					  if($n==0)
					  $check=false;
				  }	
			  $newdata= array(
					  "password"=>$olddata['password'],
					  "email"=>$olddata['email'],
					  "first_name"=>$olddata['first_name'],
					  "last_name"=>$olddata['last_name'],
					  "contact_no"=>$olddata['contact_no'],
					  "gid"=>$olddata['gid'],
					  "su"=>$newsu,
					  "inserted_by"=>"1",
					  "subscription_expired"=>$olddata['subscription_expired'],
					  "photo"=>$olddata['photo'],
					  "user_status"=> "Active",
					  "time_zone"=>"Asia/Ho_Chi_Minh",
					  "tinhthanh_id"=> $olddata['tinhthanh_id'],
					  "quanhuyen_id"=> $olddata['quanhuyen_id'],
					  "xaphuong_id"=> $olddata['xaphuong_id'],
					  "point"=> $olddata['point'],
					  "birthdate"=> $olddata['birthdate'],
					  "user_code"=> $user_code,
					  "description"=>$olddata['point'],
					  "interest_cat_ids"=>$olddata['interest_cat_ids'],
					  "interest_level_ids"=>$olddata['interest_level_ids'],
					  "email2"=>$olddata['email2'],
					  "first_login"=> $olddata['first_login'],
					  "logo"=> $olddata['logo'],
					  "text_license"=> $olddata['text_license'],
					  "out_link"=> $olddata['out_link'],
					  "subscribe"=> $olddata['subscribe'],
					  "time_email_next"=> $olddata['time_email_next'],
					  "auth_email"=> $olddata['auth_email'],
			  );
			  $this->db->insert("savsoft_users",$newdata);
			  $olddata['email'].= md5($olddata['email'].rand(1,9999));
			  $olddata["user_status"]="Inactive";
			  $olddata["subscribe"]=0;
			  $dataolddata = array(
				'email' => $olddata['email'],
				'user_status' => $olddata["user_status"],
				'subscribe' => $olddata["subscribe"]
		);
			  $this->db->where("uid",$uid);
			  $this->db->update("savsoft_users",$dataolddata);
				$update_class = " update savsoft_dataitem join class_metadata on savsoft_dataitem.did = class_metadata.class_id set status = 1 where where class_metadata.create_by = $uid";
				$update_group = "update social_group set deleted = 1 where created_by = $uid";
				$this->db->query($update_group);
				$this->db->query($update_class);
			  redirect('home/about1','refresh');
	  }
	}
	function changetime(){
		
	}
	function sub(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['status'] = $this->profile_model->sub($inp['id']);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}
	function unsub(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['status'] = $this->profile_model->unsub($inp['id']);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}

	function change_category(){
		$user=$this->session->userdata('logged_in');
		if($user){
			$this->profile_model->change_category($user['uid']);
			
		}
	}
	
	function save_description(){
		$user=$this->session->userdata('logged_in');
		if($user){
			$this->profile_model->save_description($user['uid']);	
		}
	}
	
	function save_interest_category(){
		$user=$this->session->userdata('logged_in');
		if($user){
			$this->profile_model->save_interest_category($user['uid']);	
			redirect('profile');
		}
	}
	function save_interest_category1(){
		$user=$this->session->userdata('logged_in');
		if($user){
			$this->profile_model->save_interest_category($user['uid']);	
			redirect('home_user');
		}
	}
	function save_interest_level(){
		$user=$this->session->userdata('logged_in');
		if($user){
			$this->profile_model->save_interest_level($user['uid']);	
		}
	}
	function save_information(){
		$user=$this->session->userdata('logged_in');
		if($user){
			if($user['uid'] == $_POST['uid']){
				$data = $this->profile_model->save_information1($user['uid']);
				header('Content-Type: application/json');
				echo json_encode($data);
			}
		//	var_dump($_POST['uid']);
		//	$data = $this->input->post();
			
		}
	}
	function save_logo(){
		$user=$this->session->userdata('logged_in');
		if($user){
			$this->profile_model->save_logo($user['uid']);	
		}
	}
	
}



















		