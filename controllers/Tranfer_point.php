<?php
class Tranfer_point extends CI_Controller{

	function __construct(){
	   parent::__construct();
		    $this->load->database();
		    $this->lang->load('basic', $this->config->item('language'));
		    $this->load->helper('url');
	    	$this->load->model('tranfer_point_model');
	    	$this->load->model("notify_model");
	 }
	 
	public function index(){
		$user=$this->session->userdata('logged_in');
		$data['title']="Chuyển điểm";
        if($user){
			if($user['su']==2)
				redirect('home_user');
			else{
				
				$this->load->view('header', $data);
				$this->load->view('tranfer/main');
			}
		}
	    else redirect('home');
	}
	
	
	public function tranfer(){
		$user=$this->session->userdata('logged_in');
        if($user){
			if($user['su']==2){
				$msg= "<div class='alert alert-danger'> Bạn không có quyền cho điểm</div>";
				$this->session->set_flashdata('message', $msg);
				redirect('home_user');
			}
			else{
				$demail = $this->input->post('user_received');
				$point_tranfer= $this->input->post('point_tranfer');
				$pwd = $this->input->post('pwd_tranfer');
				$rpwd = $this->input->post('cmf_pwd_tranfer');
				$duser = $this->tranfer_point_model->get_user($demail);
				$check_pwd = $this->tranfer_point_model->check_pwd($user['uid'],$pwd);
				$point=$this->tranfer_point_model->get_point($user['uid']);
				if(!$duser){
					$msg= "<div class='alert alert-danger'> Email người nhận sai!</div>";
				}
				else if($user['uid']== $duser['uid']){
					$msg= "<div class='alert alert-danger'> Bạn không thể chuyển điểm cho chính mình</div>";
				}
				else if($pwd!=$rpwd){
					$msg= "<div class='alert alert-danger'> Mật khẩu xác nhận không trùng khớp</div>";
				}
				else if($point_tranfer>$point){
					$msg ='<div class="alert alert-danger">Số điểm chuyển phải nhỏ hơn số điểm bạn có là '.$point.' điểm</div>';
					
				}	
				else if(!$check_pwd){
					$msg="<div class='alert alert-danger'> Sai mật khẩu</div>";
				}
				else{
					$this->tranfer_point_model->tranfer($user['uid'],$duser['uid'],$point_tranfer);
					$uid = $user['uid'];
					$content = "Chuyển ".$point_tranfer." điểm tới tài khoản ".$duser['email'];
					$model = "user";
					$action = "Tranfer_point";
					$nid = $this->notify_model->insert_notify($uid, $content, $model, $action);
					$this->notify_model->insert_notify_user($nid, $uid);
					$this->notify_model->insert_notify_user($nid, $duser['uid']);
					$msg= "<div class='alert alert-success'> Chuyển điểm thành công</div>";
				}
				$this->session->set_flashdata('message', $msg);
				redirect('tranfer_point');
			}
		}
	    else redirect('home');
	}
	
	public function tranfer_1(){
		$user=$this->session->userdata('logged_in');
        if($user){
			if($user['su']==2){
				$msg= "<div class='alert alert-danger'> Bạn không có quyền cho điểm</div>";
				$this->session->set_flashdata('message', $msg);
				redirect('home_user');
			}
			else{
				$demail = $this->input->post('user_received');
				$point_tranfer= $this->input->post('point_tranfer');
				$pwd = $this->input->post('pwd_tranfer');
				$rpwd = $this->input->post('cmf_pwd_tranfer');
				$duser = $this->tranfer_point_model->get_user($demail);
				$check_pwd = $this->tranfer_point_model->check_pwd($user['uid'],$pwd);
				$point=$this->tranfer_point_model->get_point($user['uid']);
				if(!$duser){
					$msg= "<div class='alert alert-danger'>Email người nhận sai!</div>";
				}
				else if($user['uid']== $duser['uid']){
					$msg= "<div class='alert alert-danger'> Bạn không thể chuyển điểm cho chính mình</div>";
				}
				else if($pwd!=$rpwd){
					$msg= "<div class='alert alert-danger'> Mật khẩu xác nhận không trùng khớp</div>";
				}
				else if($point_tranfer>$point){
					$msg ='<div class="alert alert-danger">Số điểm chuyển phải nhỏ hơn số điểm bạn có là '.$point.' điểm</div>';
					
				}	
				else if(!$check_pwd){
					$msg="<div class='alert alert-danger'> Sai mật khẩu</div>";
				}
				else{
					$this->tranfer_point_model->tranfer($user['uid'],$duser['uid'],$point_tranfer);
					$uid = $user['uid'];
					$content = "Chuyển ".$point_tranfer." điểm tới tài khoản ".$duser['email'];
					$model = "user";
					$action = "Tranfer_point";
					$nid = $this->notify_model->insert_notify($uid, $content, $model, $action);
					$this->notify_model->insert_notify_user($nid, $uid);
					$this->notify_model->insert_notify_user($nid, $duser['uid']);
					$msg= "<div class='alert alert-success'> Chuyển điểm thành công</div>";
				}
				$this->session->set_flashdata('message', $msg);
				redirect('home_user');
			}
		}
	    else redirect('home');
	}
	
}