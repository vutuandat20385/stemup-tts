<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendemail extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	   	$this->load->database();
	   	$this->load->helper('url');

	   	$this->lang->load('basic', $this->config->item('language'));
		
		
	}

	public function index(){
		$type= $this->input->post('type');
		$user =$this->session->userdata('logged_in');
		if(!$user){
			redirect("home");
        }
		else{
			$this->load->library('email');
			if($this->config->item('protocol')=="smtp"){
					$config['protocol'] = 'smtp';
					//$config['smtp_host'] = $this->config->item('smtp_hostname');
					$config['smtp_host'] ="ssl://smtp.gmail.com";
					//$config['smtp_user'] = $this->config->item('smtp_username');
					$config['smtp_user'] = "noreply6@dtt.vn";
					//$config['smtp_pass'] = $this->config->item('smtp_password');
					$config['smtp_pass'] = "123456a@";
					$config['smtp_port'] = $this->config->item('smtp_port');
					$config['smtp_timeout'] = $this->config->item('smtp_timeout');
					$config['mailtype'] = $this->config->item('smtp_mailtype');
					$config['starttls']  = $this->config->item('starttls');
					$config['newline']  = $this->config->item('newline');
					
					$this->email->initialize($config);
				}
				
			$fromemail=$this->config->item('fromemail');
			$fromname=$this->config->item('fromname');

			if($type=="assign"){
				
				$uids =$this->input->post('uids');
				$sql= "select first_name,last_name, email2, auth_email  from savsoft_users where uid in ($uids)";
				$std_data = $this->db->query($sql)->result_array();
				$type_assign =$this->input->post('type_assign');
				
				if (filter_var($user['email2'], FILTER_VALIDATE_EMAIL) && $user["auth_email"]==1) {
					if($uids){	
						$subject="Thông báo giao bài tập";
						$assigned_name="";
						foreach($std_data as $i=>$std){
							if($i!=0){
								$assigned_name.=", ";
							}						
							$assigned_name=$std['first_name']." ".$std['last_name'];
						}
						$assign_name=$user['first_name']." ".$user['last_name'];
						
						if($user['su']==3|| $user['su']==1 || $user['su']==6){
							$content=file_get_contents('./template_email/assign_teacher.html');
							$content = str_replace("[[type]]","học sinh", $content);
						}
						else{
							$content=file_get_contents('./template_email/assign_parent.html');
						}
						$content = str_replace("[[assigned_name]]", $assigned_name, $content);
						$content = str_replace("[[assign_name]]", $assign_name, $content);
						$toemail=$user['email'];
					 
						$this->email->to($toemail);
						$this->email->from($fromemail, $fromname);
						$this->email->subject($subject);
						$this->email->message($content);
						if(!$this->email->send()){
						   
						}
					}
				}
				
				foreach($std_data as $std){
					
					if (filter_var($std['email2'], FILTER_VALIDATE_EMAIL) && $std["auth_email"]==1) {
						
						$subject="Thông báo giao bài tập";
						$assigned_name=$std['first_name']." ".$std['last_name'];
						$assign_name=$user['first_name']." ".$user['last_name'];

						$content2=file_get_contents('./template_email/assigned.html');
						$content2 = str_replace("[[type_assign]]",$type_assign, $content2);
					
						$content2 = str_replace("[[assigned_name]]", $assigned_name, $content2);
						$content2= str_replace("[[assign_name]]", $assign_name, $content2);
						$toemail=$std['email2'];
					 
						$this->email->to($toemail);
						$this->email->from($fromemail, $fromname);
						$this->email->subject($subject);
						$this->email->message($content2);
						if(!$this->email->send()){
						   
						}
					}
				}
			}
			
			if($type=="change_password"){
				if (filter_var($user['email2'], FILTER_VALIDATE_EMAIL) && $user["auth_email"]==1) {
					$subject="Mật khẩu của bạn đã được thay đổi";
					$account_name = $user['first_name']." ".$user['last_name'];
					if($user['su']==1||$user['su']==3||$user['su']==6 )
						$content=file_get_contents('./template_email/changepassword_teacher.html');
					else if($user['su']==2 )
						$content=file_get_contents('./template_email/changepassword_student.html');
					else if($user['su']==4 )
						$content=file_get_contents('./template_email/changepassword_parent.html');

					$content = str_replace("[[account_name]]", $account_name, $content);
					$toemail=$user['email'];
				 
					$this->email->to($toemail);
					$this->email->from($fromemail, $fromname);
					$this->email->subject($subject);
					$this->email->message($content);
					if(!$this->email->send()){
					   
					}
				}
			}
			
			if($type=="signup"){
				if (filter_var($user['email2'], FILTER_VALIDATE_EMAIL)) {
					$subject="Chúc mừng bạn trở thành thành viên Stemup.app";
					$signup_name = $user['first_name']." ".$user['last_name'];
					$signup_email = $user['email'];
					if($user['su']==1||$user['su']==3||$user['su']==6 )
						$content=file_get_contents('./template_email/signup_teacher.html');
					else if($user['su']==2 )
						$content=file_get_contents('./template_email/signup_student.html');
					else if($user['su']==4 )
						$content=file_get_contents('./template_email/signup_parent.html');

					$content = str_replace("[[signup_name]]", $account_name, $content);
					$content = str_replace("[[signup_email]]", $account_email, $content);
					$toemail=$user['email'];
				 
					$this->email->to($toemail);
					$this->email->from($fromemail, $fromname);
					$this->email->subject($subject);
					$this->email->message($content);
					if(!$this->email->send()){
					   
					}
				}
			}
			
			
			
		}
		
	}
   

	
}
?>