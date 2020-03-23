<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct()
	 {
	   	parent::__construct();
	   	$this->load->database();
	   	$this->load->model("user_model");
		$this->load->model("quiz_model");
		$this->load->model("data_model");
		$this->load->model("profile_model");
		$this->load->model("api_model");
		$this->load->helper(array('Cookie', 'String', 'url'));
	   	$this->lang->load('basic', $this->config->item('language'));
		if($this->db->database ==''){
		redirect('install');	
		}
		 
		 
		 
		
		
	 }

	public function index()
	{
		
		$this->load->helper('url');
		if($this->session->userdata('logged_in')){
			$logged_in=$this->session->userdata('logged_in');
			redirect('home_user');
			
			
		}
		else{
			redirect('home');
		}
		
		
		
		$data['title']=$this->lang->line('login');
		$data['recent_quiz']=$this->quiz_model->recent_quiz('5');
		
		$this->load->view('header_login',$data);
		$this->load->view('login',$data);
		$this->load->view('footer',$data);
	}
	
	public function resend()
	{
		
		
		 $this->load->helper('url');
		if($this->input->post('email')){
		$status=$this->user_model->resend($this->input->post('email'));
		$this->session->set_flashdata('message', $status);
		redirect('login/resend');
		}
		
		
		$data['title']=$this->lang->line('resend_link');
		 
		$this->load->view('header',$data);
		$this->load->view('resend',$data);
		$this->load->view('footer',$data);
	}
	
	
 
	
	
	
	
	
		public function pre_registration()
	{
	$this->load->helper('url');
		$data['title']=$this->lang->line('select_package');
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$this->load->view('header',$data);
		$this->load->view('pre_register',$data);
		$this->load->view('footer',$data);
	}

	
		public function registration($gid='0')
	{
	$this->load->helper('url');
		$data['gid']=$gid;
		$data['title']=$this->lang->line('register_new_account');
		$data['custom_form']=$this->user_model->custom_form('Registration');
		// fetching group list
		$data['dataitem_list']=$this->data_model->dataitem_list(1, 1);
		$data['group_list']=$this->user_model->group_list();
		$this->load->view('header',$data);
		$this->load->view('register',$data);
		$this->load->view('footer',$data);
	}

	
	public function verifylogin($p1='',$p2=''){
		
		if($p1 == ''){
		$username=$this->input->post('email');
		$password=$this->input->post('password');
		$remember=$this->input->post('remember');
		
		
		}else{
		$username=urldecode($p1);
		$password=urldecode($p2);
		}
		 $status=$this->user_model->login($username,$password);
		log_message('error', implode(" ", $status));
		if($status['status']=='1'){
			$this->load->helper('url');

			// row exist fetch userdata
			$user=$status['user'];
			
			
			// validate if user assigned to paid group
			if($user['price'] > '0'){
				
				// user assigned to paid group now validate expiry date.
				if($user['subscription_expired'] <= time()){
					// eubscription expired, redirect to payment page
					
					redirect('payment_gateway/subscription_expired/'.$user['uid']);
					
				}
				
			}

			if ($remember) {
                $key = random_string('alnum', 64);
                set_cookie('savsoftquiz', $key, 3600*24*30); // set expired 30 hari kedepan
                
                // simpan key di database
                $update_key = array(
                    'web_token' => $key
                );
                $this->user_model->update_web_token($update_key, $user['uid']);
            }

			$user['base_url']=base_url();
			// creating login cookie
			$this->session->set_userdata('logged_in', $user);
			// redirect to dashboard
			if($user['su']=='1'){
			 redirect('home_user');
				 
			}else{
				if($user['su']=='2'){
					$burl=$this->config->item('base_url').'index.php/home_user/assign_quiz';
				}else{
					$burl=$this->config->item('base_url').'index.php/home_user';
				}
				
			 header("location:$burl");
			}
		}else if($status['status']=='0'){
			 
			// invalid login
			// try to auth wp
			if($this->config->item('wp-login')){
			 
		                if($this->authentication($username, $password)){
		               
		                 $this->verifylogin($username, $password);
		                }else{
		                 $this->load->helper('url');
		                 $this->session->set_flashdata('message_r', $status['message']);
			 $burl=$this->config->item('base_url');
			 header("location:$burl");
		                }
		        }else{
		        
		        $this->load->helper('url');
				echo '<script>alert('.$status['message'].'); </script>';
		        $this->session->set_flashdata('message_r', $status['message']);
			redirect('home');
		        }
		        
			
		}else if($status['status']=='2'){
                        $this->load->helper('url');

			 
			// email not verified
			$this->session->set_flashdata('message_r', $status['message']);
			redirect('home');
		}else if($status['status']=='3'){
                        $this->load->helper('url');

			 
			// email not verified
			$this->session->set_flashdata('message_r',$status['message']);
			redirect('home');
		}
		
	}
	function stemupverifylogin_mobile(){
		$emailph=$this->input->post('emailph');
		$namehs= $this->input->post('namehs');
		$username=$namehs."+".$emailph;
		$password=$this->input->post('password');
		$status=$this->user_model->stemuplogin($username,$password);
		if($status['status']=='1'){
			$this->load->helper('url');
			$user=$status['user'];
			// if($user['price'] > '0'){
			// 	// user assigned to paid group now validate expiry date.
			// 	if($user['subscription_expired'] <= time()){
			// 		// eubscription expired, redirect to payment page
			// 		redirect('payment_gateway/subscription_expired/'.$user['uid']);
			// 	}
			// }
			// $user['base_url']=base_url();
			$this->session->set_userdata('logged_in', $user);
			// $status['su'] = $user['su'];

		}
		header('Content-Type: application/json');
		echo json_encode($status);
		// return array($status['status'],$status['message']);
	}
	public function stemupverifylogin(){
		
		$emailph=$this->input->post('emailph');
		$namehs= $this->input->post('namehs');
		$username=$namehs."+".$emailph;
		$password=$this->input->post('password');
		$remember=$this->input->post('remember');
		
		$status=$this->user_model->stemuplogin($username,$password);
		log_message('error', implode(" ", $status));
		if($status['status']=='1'){
			$this->load->helper('url');

			// row exist fetch userdata
			$user=$status['user'];
			
			
			// validate if user assigned to paid group
			if($user['price'] > '0'){
				
				// user assigned to paid group now validate expiry date.
				if($user['subscription_expired'] <= time()){
					// eubscription expired, redirect to payment page
					
					redirect('payment_gateway/subscription_expired/'.$user['uid']);
					
				}
				
			}

			if ($remember) {
                $key = random_string('alnum', 64);
                set_cookie('savsoftquiz', $key, 3600*24*30); // set expired 30 hari kedepan
                
                // simpan key di database
                $update_key = array(
                    'web_token' => $key
                );
                $this->user_model->update_web_token($update_key, $user['uid']);
            }

			$user['base_url']=base_url();
			// creating login cookie
			$this->session->set_userdata('logged_in', $user);
			// redirect to dashboard
			if($user['su']=='1'){
			 redirect('home_user');
				 
			}else{
				if($user['su']=='2'){
					$burl=$this->config->item('base_url').'index.php/action';
				}else{
					$burl=$this->config->item('base_url').'index.php/home_user';
				}
				
			 header("location:$burl");
			}
		}else if($status['status']=='0'){
			 
			// invalid login
			// try to auth wp
			if($this->config->item('wp-login')){
			 
		                if($this->authentication($username, $password)){
		               
		                 $this->verifylogin($username, $password);
		                }else{
		                 $this->load->helper('url');
		                 $this->session->set_flashdata('message_r', $status['message']);
			 $burl=$this->config->item('base_url');
			 header("location:$burl");
		                }
		        }else{
		        
		        $this->load->helper('url');
				echo '<script>alert('.$status['message'].'); </script>';
		        $this->session->set_flashdata('message_r', $status['message']);
			redirect('home');
		        }
		        
			
		}else if($status['status']=='2'){
                        $this->load->helper('url');

			 
			// email not verified
			$this->session->set_flashdata('message_r', $status['message']);
			redirect('home');
		}else if($status['status']=='3'){
                        $this->load->helper('url');

			 
			// email not verified
			$this->session->set_flashdata('message_r',$status['message']);
			redirect('home');
		}
		
		
		
	}
	
	
	public function verifylogin2(){
		
		
		$username=$this->input->post('email');
		$password=$this->input->post('password');
		$remember=$this->input->post('remember');
		$model=$this->input->post('model');
		
		
		$status=$this->user_model->login($username,$password);
		log_message('error', implode(" ", $status));
		if($status['status']=='1'){
			$this->load->helper('url');

			// row exist fetch userdata
			$user=$status['user'];
			
			
			// validate if user assigned to paid group
			if($user['price'] > '0'){
				
				// user assigned to paid group now validate expiry date.
				if($user['subscription_expired'] <= time()){
					// eubscription expired, redirect to payment page
					
					redirect('payment_gateway/subscription_expired/'.$user['uid']);
					
				}
				
			}

			if ($remember) {
                $key = random_string('alnum', 64);
                set_cookie('savsoftquiz', $key, 3600*24*30); // set expired 30 hari kedepan
                
                // simpan key di database
                $update_key = array(
                    'web_token' => $key
                );
                $this->user_model->update_web_token($update_key, $user['uid']);
            }

			$user['base_url']=base_url();
			// creating login cookie
			$this->session->set_userdata('logged_in', $user);
            
			if($model=='quiz'){
			  $quid= $this->input->post('id_login');
			  redirect('quiz/validate_quiz/'.$quid);
			}
			else if($model=='quiz1'){
				$quid= $this->input->post('id_login');
				$this->db->where("content_id",$quid);
			    $this->db->where("model","quiz");
				$permalink=$this->db->get("savsoft_permalink")->row_array()['permalink'];
				 redirect('page/quiz/'.$permalink);
			}	 				
			else if($model=='question'){
				$qid= $this->input->post('id_login');
				$this->db->where("content_id",$qid);
				$this->db->where("model","qbank");
				$permalink=$this->db->get("savsoft_permalink")->row_array()['permalink'];
				$opt_choice= $this->input->post('opt_choice');
				if(!$opt_choice){
					redirect("page/question/".$permalink."/notsolved");
				}	
				else{
					redirect("page/question/".$permalink."/notsolved/".$opt_choice);
				}
				
			    
				
			}
			else{
				redirect("home_user");
			}
			
			
		}else if($status['status']=='0'){
			 
			// invalid login
			// try to auth wp
			if($this->config->item('wp-login')){
			 
		                if($this->authentication($username, $password)){
		               
		                 $this->verifylogin($username, $password);
		                }else{
		                 $this->load->helper('url');
		                 $this->session->set_flashdata('message_r', $status['message']);
			 $burl=$this->config->item('base_url');
			 header("location:$burl");
		                }
		        }else{
		        
		        $this->load->helper('url');
				echo '<script>alert('.$status['message'].'); </script>';
		        $this->session->set_flashdata('message_r', $status['message']);
			redirect('home');
		        }
		        
			
		}else if($status['status']=='2'){
                        $this->load->helper('url');

			 
			// email not verified
			$this->session->set_flashdata('message_r', $status['message']);
			redirect('home');
		}else if($status['status']=='3'){
                        $this->load->helper('url');

			 
			// email not verified
			$this->session->set_flashdata('message_r',$status['message']);
			redirect('home');
		}
		
		
		
	}
	
	
	
		
	function verify($vcode){
		$this->load->helper('url');	 
		 if($this->user_model->verify_code($vcode)){
			 $data['title']=$this->lang->line('email_verified');
		   $this->load->view('header',$data);
			$this->load->view('verify_code',$data);
		  $this->load->view('footer',$data);

			}else{
			 $data['title']=$this->lang->line('invalid_link');
		   $this->load->view('header',$data);
			$this->load->view('verify_code',$data);
		  $this->load->view('footer',$data);

			}
	}
	
	
	
	
	function forgot(){
	$this->load->helper('url');
			if($this->input->post('email')){
			$user_email=$this->input->post('email');
			 if($this->user_model->reset_password($user_email)){
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('password_updated')." </div>");
						
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('email_doesnot_exist')." </div>");
						
			}
			redirect('login/forgot');
			}
			
  
			$data['title']=$this->lang->line('forgot_password');
		   $this->load->view('header',$data);
			$this->load->view('forgot_password',$data);
		  $this->load->view('footer',$data);

	
	}
	
	
		public function insert_user()
	{
		
		
		 $this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[savsoft_users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
          if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('login/registration/');
                }
                else
                {
					if($this->user_model->insert_user_2()){
                        if($this->config->item('verify_email')){
						$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('account_registered_email_sent')." </div>");
						}else{
							$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('account_registered')." </div>");
						}
						}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
						
					}
					redirect('login/registration/');
                }       

	}
	
	
	
	
	function verify_result($rid){
		$this->load->helper('url');
		$this->load->model("result_model");
		
			$data['result']=$this->result_model->get_result($rid);
	if($data['result']['gen_certificate']=='0'){
		exit();
	}
	
	
	$certificate_text=$data['result']['certificate_text'];
	$certificate_text=str_replace('{email}',$data['result']['email'],$certificate_text);
	$certificate_text=str_replace('{first_name}',$data['result']['first_name'],$certificate_text);
	$certificate_text=str_replace('{last_name}',$data['result']['last_name'],$certificate_text);
	$certificate_text=str_replace('{percentage_obtained}',$data['result']['percentage_obtained'],$certificate_text);
	$certificate_text=str_replace('{score_obtained}',$data['result']['score_obtained'],$certificate_text);
	$certificate_text=str_replace('{quiz_name}',$data['result']['quiz_name'],$certificate_text);
	$certificate_text=str_replace('{status}',$data['result']['result_status'],$certificate_text);
	$certificate_text=str_replace('{result_id}',$data['result']['rid'],$certificate_text);
	$certificate_text=str_replace('{generated_date}',date('Y-m-d',$data['result']['end_time']),$certificate_text);
	
	$data['certificate_text']=$certificate_text;
	  $this->load->view('view_certificate_2',$data);
	 

	}
	
	
	
	function authentication ($user, $pass){
                  global $wp, $wp_rewrite, $wp_the_query, $wp_query;

                  if(empty($user) || empty($pass)){
                    return false;
                  }else{
                    require_once($this->config->item('wp-path'));
                    $status = false;
                    $auth = wp_authenticate($user, $pass );
                    if( is_wp_error($auth) ) {      
                      $status = false;
                    } else {
                    
                    // if username already exist in savsoft_users
                    $this->db->where('wp_user',$user);
                    $query=$this->db->get('savsoft_users');
                    if($query->num_rows()==0){
                    $userdata=array(
                    'password'=>md5($pass),
                    'wp_user'=>$user,
                    'su'=>0,
                    'gid'=>$this->config->item('default_group')                  
                    
                    );
                    $this->db->insert('savsoft_users',$userdata);
                    
                    }
                    
                    
                      $status = true;
                    }
                    return $status;
                  } 
        }
        
        
        public function commercial(){
        $this->load->helper('url');
		
       $data['title']=$this->lang->line('files_missing');
		   $this->load->view('header',$data);
			$this->load->view('files_missing',$data);
		  $this->load->view('footer',$data);
        }





		 // super admin code login controller 
	public function superadminlogin(){
	$this->load->helper('url');
			$logged_in=$this->session->userdata('logged_in_super_admin');
			if($logged_in['su']!='3'){
				exit('permission denied');
				
			}
			
		$user=$this->user_model->admin_login();
		$user['base_url']=base_url();
		 $user['super']=3;
		$this->session->set_userdata('logged_in', $user);
		redirect('dashboard');
	}

	public function get_dataitem($parent_id){

		$dataitems = $this->data_model->dataitem_filter_parent($parent_id);
		header('Content-Type: application/json');
		echo json_encode($dataitems);
	}
	public function get_dataitem_school($parent_id){
		$schoolitems = $this->data_model->dataitem_filter_parent_school($parent_id);
		
		header('Content-Type: application/json');
		echo json_encode($schoolitems);
	}
	public function get_dataitem_class($parent_id){
		$classitems = $this->data_model->dataitem_filter_parent_class($parent_id);
		header('Content-Type: application/json');
		echo json_encode($classitems);
	}
	function get_data_tinh1($tt1){
		$dataitems = $this->profile_model->data_tinh_thanh1($tt1);
		header('Content-Type: application/json');
		echo json_encode($dataitems);
	}
	function get_data_huyen($parent_id){
		$dataitems = $this->profile_model->data_huyen($parent_id);
		header('Content-Type: application/json');
		echo json_encode($dataitems);
	}
	function get_data_school($qh_id){
		$dataitems = $this->profile_model->data_schools($qh_id);
		header('Content-Type: application/json');
		echo json_encode($dataitems);
	}
	function get_data_schools($uid){
		$dataitems = $this->api_model->school_users($uid);
		header('Content-Type: application/json');
		echo json_encode($dataitems);
	}
}
