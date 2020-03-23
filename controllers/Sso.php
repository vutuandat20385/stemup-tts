<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sso extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('sso_model');
		$this->load->helper(array('url','Cookie'));
		$this->lang->load('basic', $this->config->item('language'));

	 }
	
	
	function change_pwd(){
		
	}
	
	function login(){
		$base = "https://eid.itrithuc.vn/auth";
		$realm="eid";
		$redirect_uri="https%3A%2F%2Fdo.stem.vn%2Findex.php%2Fsso%2Fendpointlogin";
		$linkred = $base."/realms/".$realm."/protocol/openid-connect/auth?client_id=account&redirect_uri=".$redirect_uri."&response_type=code&scope=openid";
		redirect($linkred);
		
	}
	function endpointlogin(){
		$code= $_GET['code'];
		$data_access_token= $this->sso_model->get_token($code);
		echo json_encode($data_access_token);
		
		if($data_access_token['error']==0){

		    $data= $this->sso_model->get_info($data_access_token['token']['access_token']);
			echo json_encode( $data);
			//$data['info']['access_token']=$data_access_token['token']['access_token'];
			//$data['info']['refresh_token']=$data_access_token['token']['refresh_token'];
			//$data['info']['code']=$code;
			$cookie_expires_in=3600*24*30;
			set_cookie("access_token",$data_access_token['token']['access_token'],$cookie_expires_in);
			set_cookie("refresh_token",$data_access_token['token']['refresh_token'],$cookie_expires_in);
				set_cookie("code",$code,$cookie_expires_in);
			
			//login
			if( $data['info']['email'] ){
				$user=$this->sso_model->login($data['info']);
				$user['base_url']=base_url();
				$this->session->set_userdata('logged_in', $user);
				//echo json_encode($data);
				redirect("home_user");
			}
			
			
		}
		
	}
	function logout(){
		$access_token= get_cookie("access_token");
		$refresh_token= get_cookie("refresh_token");
		$res=$this->sso_model->logout($access_token, $refresh_token);
		if($res['error']==0){
			delete_cookie("access_token");
			delete_cookie("refresh_token");
			delete_cookie("code");
		}
		
		echo $refresh_token;
		echo $access_token;
	}
	
	function change_password(){
		$id= $_POST['id'];
		$newpassword=$_POST['password'];
		$token=$this->sso_model->get_admin_token();
		$stt = $this->sso_model->change_password($token,$id,$newpassword);
	}
	
	
	function create_user(){
		$username= $_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$token=$this->sso_model->get_admin_token();
		$stt = $this->sso_model->create_user($token,$username,$email,$password);
	}
	
	
}