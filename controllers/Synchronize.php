<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Synchronize extends CI_Controller {

	 function __construct(){
	   parent::__construct();
	   $this->load->database();
	   $this->lang->load('basic', $this->config->item('language')); 
	   $this->load->helper('url');
	 }
	 
	 
	public function index(){
	  $user_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
      $email = $user_info['email'];
	  $first_name = $user_info['first_name'];
	  $password= $user_info['password'];
	  $this->db->where('email', $email);
	  $n=$this->db->get('savsoft_users')->num_rows();
	  
	  if($n==0){

		   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		   $charactersLength = strlen($characters);
		   $check=true;
			while($check){
				 $user_code = '';
				 for ($i = 0; $i < 6; $i++) {
					 $user_code.= $characters[rand(0, $charactersLength - 1)];
				 }
				$this->db->where('user_code', $user_code);
				 $m = $this->db->get('savsoft_users')->num_rows();
				if($m==0)
				$check=false;
			 }	
		  $post = array('first_name'=>$first_name,
						'last_name'=>'',
						'email'=>$email,
						'password'=>md5($password),
						'gid'=>5,
						'su'=>5,
						'subscription_expired'=>strtotime('2030-12-31'),
						'user_code'=>$user_code
					   );
					   
		  $this->db->insert('savsoft_users', $post);
	  }
      
	  
	  print_r(array("message"=>"success"));
	 
    }	 
	
	public function changepassword(){
	  $user_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
      $email = $user_info['email'];
	  $key= $user_info['key'];
	  $new_password= $user_info['new_password'];	  
	  $this->db->where('email', $email);
	  $us = $this->db->get('savsoft_users');
	  if($us){
		if($key=='xqTQzzqrXvjfz2lyxa7goz2nVoXwlj3aYo3fKU08LYGNqQQLlT2xdw5588wKqm7oduC32xsoOGLMFUIAwrH6WwzoXVq_zen0T_JXFcC8kqGinvNCUY2fuzrVJwGcuSXtcvvSd6IeuF0KSyDNIVLO_y0kmwd1AqFxnOpa7aZwzfKQ'){
			$this->db->where('email', $email);
			$this->db->update('savsoft_users', array('password'=>md5($new_password)));
		}
	  }
	   print_r(array("message"=>"success"));
	  
    }	
	
	public function change_role(){
	    $role =$this->input->post('rradio');
		$user = $this->session->userdata('logged_in');
		if($user){
			if($user['su']==5){
				$this->db->where('uid',$user['uid']);
				$this->db->update('savsoft_users', array('su'=>$role));
				$user['su']=$role;
				$newdata = array('logged_in'=> $user);
				$this->session->set_userdata($newdata);
			}
		}
		redirect('home_user');
    }

}