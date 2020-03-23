<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
	   $this->load->model("user_model");
	   $this->lang->load('basic', $this->config->item('language'));
	   if($this->session->userdata('logged_in')){
          redirect('home_user');
	   }
		
	 }
	 public function get_newhomepage(){
    	$email = $this->input->post('email'); // lấy email được nhập từ client
    	$this->db->where('email',$email); //đưa điều kiện vào so sánh giá trị vừa nhập và trường trong DB
    	$query=$this->db->get('savsoft_users'); // lấy ra các giá trị của trường thỏa mãn điều kiện nhập ở trên
    	//$result=$query->result(); // trả về kết quả và gán cho biến $result
    	//echo json_encode($result); // trả về kết quả $result trên dưới dạng json
    	$nu=$query->num_rows();
    	echo $nu;
		//echo $number_of_rows;
    }
	

    
    public function create_user(){
        $api_url     = 'https://www.google.com/recaptcha/api/siteverify';
		$site_key    = '6LfzlKMUAAAAAMv6fJ1q3p57pOxeKpSRRw8cHyxt';
		$secret_key  = '6LfzlKMUAAAAAGZpagsm2lXPHGCmU6uMAb3KA8yq';

		
		//lấy dữ liệu được post lên
		$site_key_post    = $this->input->post('g-recaptcha-response');
		  
		//lấy IP của khach
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$remoteip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$remoteip = $_SERVER['REMOTE_ADDR'];
		}
		 
		/*//tạo link kết nối
		$api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
		//lấy kết quả trả về từ google
		$response = file_get_contents($api_url);
		//dữ liệu trả về dạng json
		$response = json_decode($response);
		if(!isset($response->success))
		{
			$this->session->set_flashdata('message_r','<div class="alert alert-danger">Captcha không đúng</div>' );
			redirect('home');
		}
		if($response->success == true)
		{
*/			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[savsoft_users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			 if ($this->form_validation->run() == FALSE)
			{
				 /*$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
				redirect('home');*/
			}
			else
			{
				$su = $this->input->post('su'); 
				$password=$this->input->post('password');
				$passwordcfm=$this->input->post('passwordcfm');
				if($password!=$passwordcfm){
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>Mật khẩu xác nhận không trùng khớp!!!! </div>");
					redirect('home');
				}
				else if($this->user_model->insert_user_3($su)){
					echo "1";
					$username=$this->input->post('email');
				  /*  if($this->config->item('verify_email')){
						$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('account_registered_email_sent')." </div>");
						
					}else{
						$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('account_registered')." </div>");
					}*/
					 $status=$this->user_model->login($username,$password);
				if($status['status']=='1'){
					$this->load->helper('url');
					// row exist fetch userdata
					$user=$status['user'];
					$this->load->library('email');
					if($this->config->item('protocol')=="smtp"){
						$config['protocol'] = 'smtp';
						$config['smtp_host'] = $this->config->item('smtp_hostname');
						$config['smtp_user'] = $this->config->item('smtp_username');
						$config['smtp_pass'] = $this->config->item('smtp_password');
						$config['smtp_port'] = $this->config->item('smtp_port');
						$config['smtp_timeout'] = $this->config->item('smtp_timeout');
						$config['mailtype'] = $this->config->item('smtp_mailtype');
						$config['starttls']  = $this->config->item('starttls');
						$config['newline']  = $this->config->item('newline');
						
						$this->email->initialize($config);
					}
						
					$fromemail=$this->config->item('fromemail');
					$fromname=$this->config->item('fromname');
					if (filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
						$subject="Chúc mừng bạn trở thành thành viên Stemup.app";
						$signup_name = $user['first_name']." ".$user['last_name'];
						$signup_email = $user['email'];
						if($user['su']==1||$user['su']==3||$user['su']==6 )
							$content=file_get_contents('./template_email/signup_teacher.html');
						else if($user['su']==2 )
							$content=file_get_contents('./template_email/signup_student.html');
						else if($user['su']==4 )
							$content=file_get_contents('./template_email/signup_parent.html');
                        $link_auth_email=site_url("api/verify_email/".$user['uid']."/".$user['auth_token']);
						$content = str_replace("[[signup_name]]", $signup_name, $content);
						$content = str_replace("[[signup_email]]", $signup_email, $content);
						$content = str_replace("[[link_auth_email]]", $link_auth_email, $content);
						$content = str_replace("[[link_auth_email2]]", $link_auth_email, $content);
						$toemail=$user['email'];
					 
						$this->email->to($toemail);
						$this->email->from($fromemail, $fromname);
						$this->email->subject($subject);
						$this->email->message($content);
						$this->email->send();
						     
							
						
					}
					// validate if user assigned to paid group
					if($user['price'] > '0'){
						
						// user assigned to paid group now validate expiry date.
						if($user['subscription_expired'] <= time()){
							// eubscription expired, redirect to payment page
							
							redirect('payment_gateway/subscription_expired/'.$user['uid']);
							
						}
						
					}
					$user['base_url']=base_url();
					// creating login cookie
					$this->session->set_userdata('logged_in', $user);
				    $this->load->library('Curl');
				  
				   
	
				   
				    // redirect after login 
					$model=$this->input->post('model_sn');
					if($model=='quiz'){
					    $quid= $this->input->post('id_sn');
					    // redirect('quiz/validate_quiz/'.$quid);
					}
                    else if($model=='quiz1'){
						$quid= $this->input->post('id_sn');
						$this->db->where("content_id",$quid);
						$this->db->where("model","quiz");
						$permalink=$this->db->get("savsoft_permalink")->row_array()['permalink'];
					    // redirect('page/quiz/'.$permalink);
			        }	 					
					else if($model=='question'){
						$qid= $this->input->post('id_sn');
						$this->db->where("content_id",$qid);
						$this->db->where("model","qbank");
						$permalink=$this->db->get("savsoft_permalink")->row_array()['permalink'];
						$opt_choice= $this->input->post('opt_choice_sn');
						if(!$opt_choice){
							// redirect("page/question/".$permalink."/notsolved");
						}	
						else{
							// redirect("page/question/".$permalink."/notsolved/".$opt_choice);u
						}
					}else{
						// redirect("home_user");
					}
				}else if($status['status']=='0'){
					 
					// invalid login
					// try to auth wp
					if($this->config->item('wp-login')){
						if($this->authentication($username, $password)){
							$this->verifylogin($username, $password);
						}else{
							$this->load->helper('url');
							$this->session->set_flashdata('message', $status['message']);
							$burl=$this->config->item('base_url');
							header("location:$burl");
						}
					}else{
						$this->load->helper('url');
						$this->session->set_flashdata('message', $status['message']);
						// redirect('home');
						}
				}else if($status['status']=='2'){
					$this->load->helper('url');
					// email not verified
					$this->session->set_flashdata('message', $status['message']);
					// redirect('home');
				}else if($status['status']=='3'){
					$this->load->helper('url');
					// email not verified
					$this->session->set_flashdata('message', $status['message']);
					// redirect('home');
				}

				}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
					// redirect('home');
				}
			}       
		/*}else{
			$this->session->set_flashdata('message_r','<div class="alert alert-danger">Captcha không đúng</div>' );
			// redirect('home');
		}*/
		// echo "ádfasdfasdfasdfasdf";
	}
		
}