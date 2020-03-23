<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');

		$this->load->model("user_model");
		$this->load->model("quiz_model");
		$this->load->model("api_model");
		$this->load->model("qbank_model");  
		$this->load->model("classes_model"); 
		$this->load->model("comment_model");
		$this->load->model("result_model");
		$this->lang->load('basic', $this->config->item('language'));
	}
	
	public function index($api_key='0'){
		exit('I am fine, No syntex error');
	}

	public function get_group(){
		$query=$this->db->query("select * from savsoft_group ");
		$result=$query->result_array();
		$groups=array();
		foreach($result as $key => $val){
		if($val['price']==0){
			$groups[]=array('gid'=>$val['gid'],'group_name'=>$val['group_name']);
		}else{
			$groups[]=array('gid'=>$val['gid'],'group_name'=>$val['group_name'].' Price:'.$val['price']);
		}
		}
		$group=array('groups'=>$groups);
		print_r(json_encode($group));
	}
	
	public function reset_user(){
		$userdata=array(
			'first_name'=>'User',
			'last_name'=>'user',
			'password'=>md5('12345')
		);
		$this->db->where('uid','5');
		$this->db->update('savsoft_users',$userdata);
	}
		
	public function api_connect($api_key='',$email='',$password=''){
		if($this->config->item('api_key') && $this->config->item('api_key') != ''){
		}
		else{
			exit('API key is not defined in config file or empty!');
		}
		if($api_key == ''){
			exit('API key is missing');
		}
	   
		if($api_key != $this->config->item('api_key')){
			//print_r($api_key); die;
			exit('Invalid API Key');
		}
		$email=urldecode($email);
		$password=(urldecode($password));
		$ur=$this->user_model->login($email,$password);
				 
		if($ur['status']=='1'){
			// row exist fetch userdata
			$user=$this->user_model->login($email,$password);

			// validate if user assigned to paid group
			if($user['user']['price'] > '0'){
			   
				// user assigned to paid group now validate expiry date.
				if($user['user']['subscription_expired'] <= time()){
					// eubscription expired, redirect to payment page   
					echo $user['user']['uid'];
					exit();    
				}
				   
			}
			$user['user']['base_url']=base_url();
			if(!$user['user']['connection_key']){
				$ck=$user['user']['uid'].time();
				$uid=$user['user']['uid'];
				$user['user']['connection_key']=md5($ck);
				// creating login cookie
				$userdata=array(
					'connection_key'=>$user['user']['connection_key'],
				);
				$this->db->where('uid',$uid);
				$this->db->update('savsoft_users',$userdata);
			}
			$uid=$user['user']['uid'];
			$sql = "select uid  from savsoft_users where parent_id= $uid or parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid'";
			$qu = $this->db->query($sql)->row_array();
			if($qu){
				$user['user']['child_id']= $qu['uid'];
			}
			else{
				$user['user']['child_id']=0;
			}
			print_r(json_encode($user));
			//log_message("error",json_encode($user) );
		}
		else{
			$a= array("error"=>1);
			print_r(json_encode($a));
			exit();
		}
    }
	
	public function api_connect2($api_key='savsoft'){
       
		$email=$_POST['email'];
		$password=$_POST['password'];
		//log_message("error",$email.".............".$password);
	    if($this->config->item('api_key') && $this->config->item('api_key') != ''){
		}else{
			exit('API key is not defined in config file or empty!');
		}
   
		if($api_key == ''){
			exit('API key is missing');
		}
   
		if($api_key != $this->config->item('api_key')){
			exit('Invalid API Key');
		}

		$ur=$this->user_model->login($email,$password);             
        if($ur['status']=='1'){     
            // row exist fetch userdata
            $user=$this->user_model->login($email,$password);
            // validate if user assigned to paid group
            if($user['user']['price'] > '0'){
                // user assigned to paid group now validate expiry date.
                if($user['user']['subscription_expired'] <= time()){
                    // eubscription expired, redirect to payment page
                    echo $user['user']['uid'];
					exit();  
                } 
            }
            $user['user']['base_url']=base_url();
			if(!$user['user']['connection_key']){
				$ck=$user['user']['uid'].time();
				$uid=$user['user']['uid'];
				$user['user']['connection_key']=md5($ck);
				// creating login cookie
				$userdata=array(
					'connection_key'=>$user['user']['connection_key'],
				);
				$this->db->where('uid',$uid);
				$this->db->update('savsoft_users',$userdata);
            }
			$uid=$user['user']['uid'];
			$sql = "select uid  from savsoft_users where parent_id= $uid or parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid'";
			$qu = $this->db->query($sql)->row_array();
			if($qu){
				$user['user']['child_id']= $qu['uid'];
			}
		    else{
				$user['user']['child_id']=0;
			}
            print_r(json_encode($user));
			
			//log_message("error",json_encode($user) );
        }else{
            $a= array("error"=>1);
			print_r(json_encode($a));
            exit();
        }
    }

	public function get_user_by_connection_key(){
		$connection_key=$_POST["connection_key"];		
		//check account
		if($connection_key){
			$this->db->where("connection_key",$connection_key);
			$userinf=$this->db->get("savsoft_users")->row_array();
			if($userinf){
				$user = array("status"=>"1","user"=>$userinf);
				if(!$user['user']['connection_key']){
					$ck=$user['user']['uid'].time();
					$uid=$user['user']['uid'];
					$user['user']['connection_key']=md5($ck);
					// creating login cookie
					$userdata=array(
					'connection_key'=>$user['user']['connection_key'],
					);
					$this->db->where('uid',$uid);
					$this->db->update('savsoft_users',$userdata);
				}
				$uid=$user['user']['uid'];
				$sql = "select uid  from savsoft_users where parent_id= $uid or parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid'";
				$qu = $this->db->query($sql)->row_array();
				if($qu){
				  $user['user']['child_id']= $qu['uid'];
				}
				else{
					$user['user']['child_id']=0;
				}
				echo json_encode($user);
				log_message("error",json_encode($user) );	
			}
			else{
				//tạo tk
				$photo= "https://graph.facebook.com/".$id."/picture?width=150&height=150";
				
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$check=true;
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
				$userdata=array(
					 'email'=>$id,
					 'email2'=>"",
					 "user_code"=>$user_code,
					 'password'=>md5(rand(1111,9999)),
					 'first_name'=>$name,
					 'last_name'=>' ',
					 'contact_no'=>'',
					 'photo'=>$photo,
					 'gid'=>'5',
					 'su'=>'5'
					 );
				$this->db->insert("savsoft_users",$userdata);
				$this->db->where("email",$id);
			    $userinf=$this->db->get("savsoft_users")->row_array();
				$user = array("status"=>"1","user"=>$userinf);

				$ck=$user['user']['uid'].time();
				$uid=$user['user']['uid'];
				$user['user']['connection_key']=md5($ck);

				$userdata=array(
					'connection_key'=>$user['user']['connection_key'],
				);
				$this->db->where('uid',$uid);
				$this->db->update('savsoft_users',$userdata);
				
				$user['user']['child_id']=0;
				
				echo json_encode($user);
				log_message("error",json_encode($user) );		

			}
		}
		else{
			echo json_encode(array("status"=>0,"message"=>"connection key error"));
		}
        //echo $inp['id'];
	}

	public function api_connect_fb(){
		$access_token=$_POST["access_token"];
		$a =file_get_contents("https://graph.facebook.com/me?access_token=".$access_token);
		
		$inp= json_decode($a,true);
		$id= $inp['id'];
		//log_message("error","----".$id);
		$name = $inp['name'];
		//check account
		if($id){
			$this->db->where("email",$id);
			$userinf=$this->db->get("savsoft_users")->row_array();
			if($userinf){
				$user = array("status"=>"1","user"=>$userinf);
				if(!$user['user']['connection_key']){
					$ck=$user['user']['uid'].time();
					$uid=$user['user']['uid'];
					$user['user']['connection_key']=md5($ck);
					// creating login cookie
					$userdata=array(
					'connection_key'=>$user['user']['connection_key'],
					);
					$this->db->where('uid',$uid);
					$this->db->update('savsoft_users',$userdata);
				}
				$uid=$user['user']['uid'];
				$sql = "select uid  from savsoft_users where parent_id= $uid or parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid'";
				$qu = $this->db->query($sql)->row_array();
				if($qu){
				  $user['user']['child_id']= $qu['uid'];
				}
				else{
					$user['user']['child_id']=0;
				}
				echo json_encode($user);
				log_message("error",json_encode($user) );	
			}
			else{
				//tạo tk
				$photo= "https://graph.facebook.com/".$id."/picture?width=150&height=150";
				
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$check=true;
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
				$userdata=array(
					 'email'=>$id,
					 'email2'=>"",
					 "user_code"=>$user_code,
					 'password'=>md5(rand(1111,9999)),
					 'first_name'=>$name,
					 'last_name'=>' ',
					 'contact_no'=>'',
					 'photo'=>$photo,
					 'gid'=>'5',
					 'su'=>'5'
					 );
				$this->db->insert("savsoft_users",$userdata);
				$this->db->where("email",$id);
			    $userinf=$this->db->get("savsoft_users")->row_array();
				$user = array("status"=>"1","user"=>$userinf);

				$ck=$user['user']['uid'].time();
				$uid=$user['user']['uid'];
				$user['user']['connection_key']=md5($ck);

				$userdata=array(
					'connection_key'=>$user['user']['connection_key'],
				);
				$this->db->where('uid',$uid);
				$this->db->update('savsoft_users',$userdata);
				
				$user['user']['child_id']=0;
				
				echo json_encode($user);
				log_message("error",json_encode($user) );		

			}
		}
		else{
			echo json_encode(array("status"=>0,"message"=>"Access Token error"));
		}
        //echo $inp['id'];
	}
	
	function quiz_list($connection_key='',$uid='',$limit='0'){	
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$this->db->join('account_type','account_type.account_id=savsoft_users.su');
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		$quiz=array('quiz'=>$this->api_model->quiz_list($user,$limit));
		print_r(json_encode($quiz));
	}
	
	function stats($connection_key='',$uid=''){			
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$this->db->join('account_type','account_type.account_id=savsoft_users.su');
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		
		$quiz=array(
			'no_quiz'=>$this->api_model->no_quiz($user),
			'no_attempted'=>$this->api_model->no_attempted($user),
			'no_pass'=>$this->api_model->no_pass($user),
			'no_fail'=>$this->api_model->no_fail($user)
		);
		print_r(json_encode($quiz));
	}
		
	function result_list($connection_key='',$uid='',$limit='0'){
			
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$this->db->join('account_type','account_type.account_id=savsoft_users.su');
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}		 
 		$result=array('result'=>$this->api_model->result_list($user,$limit));
		print_r(json_encode($result));
	}
	
	function result_list2($connection_key='',$uid='',$limit='0'){			
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$this->db->join('account_type','account_type.account_id=savsoft_users.su');
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		$res=$this->api_model->result_list($user,$limit);	
        foreach($res as $k=>$r){
			$this->db->where('rid',$r['rid']);
			$as= $this->db->get("savsoft_assign")->row_array();
			if($as){
				$rp=$as['reward_point'];
				$res[$k]['reward_point']=ceil($rp*$r['percentage_obtained']/100);
			}
			else{
				$res[$k]['reward_point']=0;
			}
		}		
 		$result=array('result'=>$res);
		print_r(json_encode($result));
	}
	
	function get_notification($connection_key='',$uid='',$limit='0'){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}	 
		$result=array('result'=>$this->api_model->get_notification($user,$limit));
		print_r(json_encode($result));
	}
	
	public function myaccount($connection_key='',$uid,$first_name,$last_name,$password){ 
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		$userdata=array(
			'first_name'=>urldecode($first_name),
			'last_name'=>urldecode($last_name)
		);					
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$this->db->update('savsoft_users',$userdata);
		exit("Information updated successfully");
	}

	public function validate_quiz($connection_key='',$uid,$quid){
	 
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$this->db->join('account_type','account_type.account_id=savsoft_users.su');
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		$logged_in=$user;
		$gid=$logged_in['gid'];
		$uid=$logged_in['uid'];
		 
		$data['quiz']=$this->quiz_model->get_quiz($quid);
		// validate assigned group
		if(!in_array($gid,explode(',',$data['quiz']['gids']))){
			exit('Quiz not assigned to your group');
		}
		// validate start end date/time
		if($data['quiz']['start_date'] > time()){
			exit('Quiz not available');
		}
		// validate start end date/time
		if($data['quiz']['end_date'] < time()){
			exit('Quiz ended');
		 }
		// validate ip address
		if($data['quiz']['ip_address'] !=''){
			$ip_address=explode(",",$data['quiz']['ip_address']);
			$myip=$_SERVER['REMOTE_ADDR'];
			if(!in_array($myip,$ip_address)){
				exit('IP declined!');
			}
		}
		// validate maximum attempts
		$maximum_attempt=$this->quiz_model->count_result($quid,$uid);
		if($data['quiz']['maximum_attempts'] <= $maximum_attempt){
			exit('Reached maximum attempts!');
		}
		// if this quiz already opened by user then resume it
		$open_result=$this->quiz_model->open_result($quid,$uid);
		if($open_result != '0'){
			$this->session->set_userdata('rid', $open_result);
			echo $open_result;
			exit();
		}
		// insert result row and get rid (result id)
		$rid=$this->quiz_model->insert_result($quid,$uid);
		echo $rid;
	}
	
	function attempt($connection_key='',$uid,$rid){
			
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		// get result and quiz info and validate time period
		$data['quiz']=$this->quiz_model->quiz_result($rid);
		$data['saved_answers']=$this->quiz_model->saved_answers($rid);

		// end date/time
		if($data['quiz']['end_date'] < time()){
		$this->api_model->submit_result($user,$rid);
		//$this->session->unset_userdata('rid');
			exit($this->lang->line('quiz_ended'));
		}
		
		// end date/time
		if(($data['quiz']['start_time']+($data['quiz']['duration']*60)) < time()){
			$this->api_model->submit_result($user,$rid);
			//$this->session->unset_userdata('rid');
			exit($this->lang->line('time_over'));
		 }
		// remaining time in seconds 
		$data['seconds']=($data['quiz']['duration']*60) - (time()- $data['quiz']['start_time']);
		// get questions
		$data['questions']=$this->quiz_model->get_questions($data['quiz']['r_qids']);
		// get options
		$data['options']=$this->quiz_model->get_options($data['quiz']['r_qids']);
		$data['title']=$data['quiz']['quiz_name'];
		$data['connection_key']=$connection_key;
		$data['uid']=$uid;
		$data['rid']=$rid;
		$this->load->view('quiz_attempt_android',$data);
			
	}
		
	function submit_quiz($connection_key='',$uid,$rid){
			
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		if($this->api_model->submit_result($user,$rid)){
        }else{
		}
		// $rid=$this->session->unset_userdata('rid');					
		echo "<script>Android.showToast('".$rid."');</script>";
	}	
		
	function save_answer($connection_key='',$uid,$rid){		
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		echo "<pre>";
		print_r($_POST);
		// insert user response and calculate scroe
		echo $this->api_model->insert_answer($user,$rid);	
	}
	
	function set_ind_time($connection_key='',$uid,$rid){
		// update questions time spent
		$this->api_model->set_ind_time($rid);
	}
	
	function view_result($connection_key='',$uid,$rid){
			
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
			
		$logged_in=$user;
		$data['logged_in']=$user;	
		$data['result']=$this->result_model->get_result($rid);
		$data['title']=$this->lang->line('result_id').' '.$data['result']['rid'];
		if($data['result']['view_answer']=='1' || $logged_in['su']=='1'){
			$this->load->model("quiz_model");
			$data['saved_answers']=$this->quiz_model->saved_answers($rid);
			$data['questions']=$this->quiz_model->get_questions($data['result']['r_qids']);
			$data['options']=$this->quiz_model->get_options($data['result']['r_qids']);
		}
		// top 10 results of selected quiz
		$last_ten_result = $this->result_model->last_ten_result($data['result']['quid']);
		$value=array();
		$value[]=array('Quiz Name','Percentage (%)');
		foreach($last_ten_result as $val){
			$value[]=array($val['email'].' ('.$val['first_name']." ".$val['last_name'].')',intval($val['percentage_obtained']));
		}
		 $data['value']=json_encode($value);
	 
		// time spent on individual questions
		$correct_incorrect=explode(',',$data['result']['score_individual']);
		$qtime[]=array($this->lang->line('question_no'),$this->lang->line('time_in_sec'));
		foreach(explode(",",$data['result']['individual_time']) as $key => $val){
			if($val=='0'){
				$val=1;
			}
			if($correct_incorrect[$key]=="1"){
				$qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('correct')." ",intval($val));
			}else if($correct_incorrect[$key]=='2' ){
				$qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('incorrect')."",intval($val));
			}else if($correct_incorrect[$key]=='0' ){
				$qtime[]=array($this->lang->line('q')." ".($key+1).") -".$this->lang->line('unattempted')." ",intval($val));
			}else if($correct_incorrect[$key]=='3' ){
				$qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('pending_evaluation')." ",intval($val));
			}
		}
		$data['qtime']=json_encode($qtime);
		$data['percentile'] = $this->result_model->get_percentile($data['result']['quid'], $data['result']['uid'], $data['result']['score_obtained']);
		$this->load->view('view_result_android',$data);
	}
	
	function register($email,$first_name,$last_name,$password,$contact_no,$gid){
		if(!$this->config->item('user_registration')){
			exit('Registration is closed by administrator');
		}
		$email=urldecode($email);
		$query=$this->db->query("select * from savsoft_users where email='$email' ");
		if($query->num_rows() >= 1){
			exit('Email address already exist');
		}
		if($this->api_model->register($email,$first_name,$last_name,$password,$contact_no,$gid)){
			if($this->config->item('verify_email')){
				exit($this->lang->line('account_registered_email_sent'));
			}else{
				exit($this->lang->line('account_registered'));
			}
		}else{
			exit($this->lang->line('error_to_add_data'));
		}
	}
	
	function forgot($user_email){
		$user_email=urldecode($user_email);
		if($this->api_model->reset_password($user_email)){
			exit($this->lang->line('password_updated'));				
		}else{
			exit($this->lang->line('email_doesnot_exist'));			
		}		
	}
	
	function api_changepassword($uid){
		$result= $this->api_model->api_changepassword($uid);
		print_r(json_encode($result));
	}
	
	function logout($connection_key='',$uid){
		$userdata=array('connection_key'=>'');
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->update('savsoft_users',$userdata);		
		exit("Account logged out successfully!");
	}
	
	function load_quiz($connection_key='', $uid, $quid){
		//Check connection_key
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		//load quiz
		$data['quiz']=$this->quiz_model->get_quiz2($quid);
		$data['questions']=$this->quiz_model->get_questions_options($data['quiz']['qids']);
		print_r(json_encode($data));
	}
	
	function load_quiz2($quid){		
		$data['quiz']=$this->quiz_model->get_quiz2($quid);
		$data['questions']=$this->quiz_model->get_questions_options($data['quiz']['qids']);	
		print_r(json_encode($data));
		
	}
	
	function load_quiz3($quid){	
		$data['quiz']=$this->quiz_model->get_quiz2($quid);
		$data['questions']=$this->quiz_model->get_questions_options2($data['quiz']['qids']);
		if($data['quiz']['reading_mcq']){
			$data['reading']['questions']=$this->quiz_model->get_questions_options2($data['quiz']['reading_mcq']);
			$data['reading']['link']=$data['reading']['questions'][0]['source'];
			$data['reading']['content']=$data['quiz']['reading'];
			$data['reading']['title']=$data['quiz']['reading_title'];
			unset($data['quiz']['reading']);
			unset($data['quiz']['reading_title']);
			unset($data['quiz']['img_video']);
			unset($data['quiz']['img_reading']);
		}
		else
			$data['reading']= array();
		if($data['quiz']['video_mcq']){
			$data['video']['questions']=$this->quiz_model->get_questions_options2($data['quiz']['video_mcq']);
            
			$vidTags="";
			preg_match_all('/<iframe[^>]+>/i',$data['video']['questions'][0]['question'], $vidTags); 
			if(count($vidTags[0])>0){
				preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
				 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
				$data['video']['link']="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
			} 
			else
				$data['video']['link']="";
			
			foreach($data['video']['questions'] as $k=>$d){
				$data['video']['questions'][$k]['question']=strip_tags($d['question']);
			}
			$data['video']['title']=$data['quiz']['video_title'];
			unset($data['quiz']['video_title']);
			
		}
		else
			$data['video']= array();
		print_r(json_encode($data));
		
	}
	
    function load_quiz4($quid){		
		$data['quiz']=$this->quiz_model->get_quiz2($quid);
		$data['questions']=$this->quiz_model->get_questions_options3($data['quiz']['qids']);
		if($data['quiz']['reading_mcq']){
			$data['reading']['questions']=$this->quiz_model->get_questions_options2($data['quiz']['reading_mcq']);
			$data['reading']['link']=$data['reading']['questions'][0]['source'];
			$data['reading']['content']=$data['quiz']['reading'];
			$data['reading']['title']=$data['quiz']['reading_title'];
			unset($data['quiz']['reading']);
			unset($data['quiz']['reading_title']);
			unset($data['quiz']['img_video']);
			unset($data['quiz']['img_reading']);
		}
		else
			$data['reading']= array();
		if($data['quiz']['video_mcq']){
			$data['video']['questions']=$this->quiz_model->get_questions_options2($data['quiz']['video_mcq']);
            
			$vidTags="";
			preg_match_all('/<iframe[^>]+>/i',$data['video']['questions'][0]['question'], $vidTags); 
			if(count($vidTags[0])>0){
				preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
				$vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
				$data['video']['link']="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
				//if($data['quiz']["level_hard"]>3){
					$data['video']['link']="https://www.youtube.com/watch?v=".$vid;
				//}
			} 
			else
				$data['video']['link']="";
			
			foreach($data['video']['questions'] as $k=>$d){
				$data['video']['questions'][$k]['question']=strip_tags($d['question']);
			}
			$data['video']['title']=$data['quiz']['video_title'];
			unset($data['quiz']['video_title']);
			
		}
		else
			$data['video']= array();
		print_r(json_encode($data));
		
	}
	
	function load_quiz_nguoitot($quid){	
		$data['quiz']=$this->quiz_model->get_quiz2($quid);
		if($data['quiz']['level_hard']){
			if($data['quiz']['level_hard']>3){
				$ar=$this->quiz_model->get_questions_options2($data['quiz']['qids']);
				foreach($ar as $k=>$a){
					$ar[$k]['index']=$k;
				}
				$data['questions']=array(array("subject"=>"","question"=>$ar));
			}
			else $data['questions']=$this->quiz_model->get_questions_options3($data['quiz']['qids']);
		}
		else $data['questions']=$this->quiz_model->get_questions_options3($data['quiz']['qids']);
			
		if($data['quiz']['reading_mcq']){
			$data['reading']['questions']=$this->quiz_model->get_questions_options2($data['quiz']['reading_mcq']);
			$data['reading']['link']=$data['reading']['questions'][0]['source'];
			$data['reading']['content']=$data['quiz']['reading'];
			$data['reading']['title']=$data['quiz']['reading_title'];
			unset($data['quiz']['reading']);
			unset($data['quiz']['reading_title']);
			unset($data['quiz']['img_video']);
			unset($data['quiz']['img_reading']);
		}
		else
			$data['reading']= array();
		if($data['quiz']['video_mcq']){
			$data['video']['questions']=$this->quiz_model->get_questions_options2($data['quiz']['video_mcq']);
            
			$vidTags="";
			preg_match_all('/<iframe[^>]+>/i',$data['video']['questions'][0]['question'], $vidTags); 
			if(count($vidTags[0])>0){
				preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
				 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
				 
				//$data['video']['link']="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
				$data['video']['link']="https://www.youtube.com/watch?v=".$vid;
			} 
			else
				$data['video']['link']="";
			
			foreach($data['video']['questions'] as $k=>$d){
				$data['video']['questions'][$k]['question']=strip_tags($d['question']);
			}
			$data['video']['title']=$data['quiz']['video_title'];
			unset($data['quiz']['video_title']);
			
		}
		else
			$data['video']= array();
		print_r(json_encode($data));
		
	}
	
	function load_fun_quiz($parentid,$childid){
        $today=  date("Y-m-d", strtotime("+0 day"));
		$this->db->where("day", $today);
		$this->db->where("uid", $childid);
		$dataset=$this->db->get("recommend_assign")->row_array();
		if($dataset){
			$set=$dataset['set'];
		}
		else{
			$set= rand(0,19);
			$this->db->insert("recommend_assign", array("uid"=>$childid,"set"=>$set,"day"=>$today));
		}
		
		$this->db->where("set", $set);
		$this->db->where("day", $today);
		$this->db->where("level_hard", 4);
		$quid=$this->db->get("savsoft_quiz")->row_array()['quid'];
		   $this->db->where("auid", $parentid);
		$this->db->where("uid", $childid);
		$this->db->where("quid", $quid);
		$n = $this->db->get('savsoft_assign')->row_array();
		$status_dq=0;
		if($n){
			$status= 1;
			if($n['rid']){
				$this->db->select("percentage_obtained");
				$this->db->where('rid', $n['rid']);
				$per=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
				
				if($per || $per==0){
					$per= number_format($per,1);
					
				}
				$status_dq=1;
			}
			
		}
		else
		   $status= 0;
	    $data['status_assign']=$status;
		
		$data['status_doquiz']=$status_dq;
		$data["message_doquiz"]=$per;
		$data['quiz']=$this->quiz_model->get_quiz2($quid);
		$data['questions']=$this->quiz_model->get_questions_options3($data['quiz']['qids']);
		
	 
		print_r(json_encode($data));
		
		
		
		
	}
	
	function load_result($connection_key='', $uid, $rid){
		//Check connection_key
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		}
		//load result
        $this->db->where('rid', $rid);
        $data['result']=$this->db->get("savsoft_result")->row_array();		
		//load quiz
		$data['quiz']=$this->quiz_model->get_quiz($data['result']['quid']);
		$data['questions']=$this->result_model->get_questions_answers($rid);	
	    header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function load_result2($rid){
		//load result
        $this->db->where('rid', $rid);
        $data['result']=$this->db->get("savsoft_result")->row_array();

        $data['result']['result_status']=number_format($data['result']["percentage_obtained"],0)."%";
		//load quiz
		$data['quiz']=$this->quiz_model->get_quiz($data['result']['quid']);
		$ar=$this->result_model->get_questions_answers2($rid);
		$arr=explode(",",$data['quiz']['reading_mcq']);
		$arv=explode(",",$data['quiz']['video_mcq']);

		$data['reading']['questions']=array();
		$data['reading']['content']=$data['quiz']['reading'];
		$data['reading']['title']=$data['quiz']['reading_title'];
		$data['video']['title']=$data['quiz']['video_title'];
		$data['video']['link']="";
		$data['video']['questions']=array();
		
		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",'12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'Giáo dục công dân','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học');
		
		$cid= array();
		$cid_ar= array();
		$res= array();
		 
		foreach($ar as $k=>$a){
				if(!in_array($a['cid'],$cid) && !in_array($a['qid'], $arv) && !in_array($a['qid'], $arr )){
					
					array_push($cid,$a['cid']);
					array_push($cid_ar,array());
				}
		
	     }
		foreach($ar as $a){
			if(in_array($a['qid'], $arv)){
				
				if(!$data['video']['link']){
					$origvidSrc="";
					$vidTags="";
					preg_match_all('/<iframe[^>]+>/i',$a['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
						 // $data['video']['link']="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
						 
							$data['video']['link']="https://www.youtube.com/watch?v=".$vid;
			
					} 
				}
				$a['question']= strip_tags($a['question']);
				array_push($data['video']['questions'],$a);
			}
            else
            if(in_array($a['qid'], $arr)){
				array_push($data['reading']['questions'],$a);
				$data['reading']['link']=$a['source'];
			}

			else{
				$index=array_search($a['cid'],$cid);
	            array_push($cid_ar[$index], $a);
			}			
		}
		
		foreach($cid_ar as $k=>$d){
			array_push($res, array("subject"=>$array_map[$cid[$k]],"question"=>$d)); 
	    }
		$data['questions']= $res;
	    header('Content-Type: application/json');
		echo json_encode($data);
		
	}
	
	function load_discussion($connection_key='', $uid,$model ,$wall_id){
		//Check connection_key
		$this->db->where('uid',$uid);
			$this->db->where('connection_key',$connection_key);
			$auth=$this->db->get('savsoft_users');
			$user=$auth->row_array();
			if($auth->num_rows()==0){
				exit('invalid Connection!');
			}
		//load discussion
		if($model=='class'){
			$data=$this->classes_model->load_discussion($wall_id);
		}
		print_r(json_encode($data));
		
	}
	
	//$connection_key='', $uid, $quid, $answers,
	function send_answers(){
		$connection_key=$_POST["connection_key"];
		$uid=$_POST["uid"];
		$quid=$_POST["quid"];
		$id=$_POST["id"];
		$answers=$_POST["answers"];
		
		log_message('error', $answers);
		//Check connection_key
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		} else {
			$open_result=$this->quiz_model->open_result($quid,$uid);
			$data['quiz']=$this->quiz_model->get_quiz($quid);
			$data['rid']=$this->quiz_model->insert_result($quid,$uid);
			$this->session->set_userdata('rid', $data['rid']);
			if($answers != ''){
				$arrans = explode('-', $answers);
				$arridx= array();
				$qidans= array();
				for($i=count($arrans)-1; $i>=0; $i-- ){
					$qida = explode("+",$arrans[$i])[0];
					if(!in_array($qida, $qidans)){
						array_push($qidans, $qida);
						array_push($arridx, $i);
					}
				}
				$individual_time = array();
				$rid = $data['rid'];
				$query=$this->db->query("select * from savsoft_result join savsoft_quiz on  savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
				$quiz=$query->row_array(); 
				$correct_score=$quiz['correct_score'];
				$incorrect_score=$quiz['incorrect_score'];
				$qids=explode(',',$quiz['r_qids']);
				$vqids=$quiz['r_qids'];
				$correct_incorrect=explode(',',$quiz['score_individual']);
				log_message('error', '***********1***********');
				log_message('error', implode(" ", $correct_incorrect));
				log_message('error', implode("**", $arridx));
				log_message('error', implode("**", $qidans));
				for ($i=0; $i < count($arrans); $i++) {
					if(in_array($i,$arridx)){
						$attempted=1;
						$marks=0;
						if(explode('+', $arrans[$i])[2] <= 0 ){
							$marks+=-1;	
						}else{
							$marks+=explode('+', $arrans[$i])[2];
						}
						//log_message('error', $marks);
						$answerdata = array(
							'qid' => explode('+', $arrans[$i])[0],
							'q_option' => explode('+', $arrans[$i])[1],
							'uid' => $uid,
							'score_u' => explode('+', $arrans[$i])[2],
							'rid' => $data['rid']
						);
						$this->db->insert('savsoft_answers', $answerdata);
						
												
						if($marks >= 1 ){
							log_message('error', 'attempted');
							$correct_incorrect[$i]=1;	
						}else{
							$correct_incorrect[$i]=2;							
						}
						$individual_time[] = 5;
					}
				}
				log_message('error', '**********2************');
				log_message('error', implode(" ", $correct_incorrect));
				$userdata=array(
				 	'score_individual'=>implode(',',$correct_incorrect),
				 	'individual_time'=>implode(',',$individual_time)
				);
				$this->db->where('rid',$data['rid']);
				$this->db->update('savsoft_result',$userdata);
				
				if($this->quiz_model->submit_results2($user, $data['rid'])){
					
					$data['msg'] = 'successfully';
					if($user['parent_id']){
						$dataassign = array('status' => 2,'rid'=>$data['rid']);
						$this->db->where('quid', $quid);
						$this->db->where('uid', $uid);
						$this->db->where('id', $id);
						$this->db->update('savsoft_assign', $dataassign);
						
						$this->db->where('rid', $data['rid']);
						
						
						$this->db->where('quid', $quid);
						$this->db->where('uid', $uid);
						$dd= $this->db->get('savsoft_assign')->row_array();
						if($dd){
					
							$notifydt= array("uid"=>$uid,
							                 "content"=>"đã làm xong bài ",
											 "model"=>"result",
											 "action"=>"Answer assign quiz",
											 "click" => "window.location.href = '".site_url()."/result/view_result/".$data['rid']."'",
											 "rid"=>$data['rid']);
							$this->db->insert('notify', $notifydt);
							$nid = $this->db->insert_id();
							$notifyuserdt1= array("nid"=>$nid,"uid"=>$uid, "status"=>1);
							$notifyuserdt2= array("nid"=>$nid,"uid"=>$dd['auid'], "status"=>1);
							$this->db->insert('notify_user', $notifyuserdt1);
							$this->db->insert('notify_user', $notifyuserdt2);
							
							
						}
						
						$this->db->select('percentage_obtained');
						$this->db->where('rid',$data['rid']);
						$quizz= $this->db->get('savsoft_result')->row_array();
						if($dd){
							
							$type="";
							$this->db->where('quid', $quid);
							$qq= $this->db->get('savsoft_quiz')->row_array();
							if($qq){
								if($qq['level_hard']){
									if($qq['level_hard']>3){
										$type="KNS";
									}
									else{
										$type="HCC";
									}
								}
							}	
							$this->db->where("nid", $nid);							
							$this->db->update("notify",array("content"=>"đã làm xong bài ".$type.". Kết quả: ".number_format($quizz['percentage_obtained'],0)."%"));
							if($quiz['r_qids']){
								//$sqls= "select sum(points)  as tp from savsoft_qbank where qid in (".$quiz['r_qids'].")";
                                $tp= $dd['price'];
								$tp2 = ceil($dd['reward_point']*$quizz['percentage_obtained']/100);
								
								$this->db->where("uid", $dd['auid']);
								$ap= $this->db->get("savsoft_users")->row_array()['point'];
								$this->db->where("uid", $dd['auid']);
								$this->db->update("savsoft_users", array("point"=>$ap-$tp-$tp2));
								
								$arr_hp=array("uid"=>$dd['auid'],
								              "point_change"=>-$tp-$tp2,
											  "point_remain"=>$ap-$tp-$tp2,
											  "nid"=>$nid,
											  "activity"=>"assign_quiz"

								             );
								
								$this->db->insert("history_point", $arr_hp);
								
								log_message("error", "********************".$tp2."----------------".$tp);
								$this->db->where("uid", $dd['uid']);
								$ap2= $this->db->get("savsoft_users")->row_array()['point'];
								$this->db->where("uid", $dd['uid']);
								$this->db->update("savsoft_users", array("point"=>$ap2+$tp2));
								
								$arr_hp=array("uid"=>$dd['uid'],
								              "point_change"=>$tp2,
											  "point_remain"=>$ap2+$tp2,
											  "nid"=>$nid,
											  "activity"=>"reward_do_assign_quiz"

								             );
								
								$this->db->insert("history_point", $arr_hp);
							}
						}
						$pr_ids=explode(",",$user['parent_id']);
						foreach($pr_ids as $pr_id){
							$this->db->where("uid", $pr_id);
							$this->db->where("app", 'stemup');
							$tk=$this->db->get('user_token_fcm')->result_array();
							log_message("error", "Làm bài--- ".$pr_id);
							log_message("error", "Làm bài--- ".$user['uid']);
							//log_message("error", "Làm bài--- ".json_encode($tk));
								
							foreach($tk as $t){
								$to = $t['fcm_token'];
								log_message("error", "Làm bài ".$to." ".$pr_id." ".$t['divideid']);
								
								$this->load->library('Curl');
								$ch = curl_init();
								$a= array( "content_available"=> true,
										  "notification"=> array(
												 "title"=> $user['first_name'].' '.$user['last_name']."vừa làm bài",
												  "body"=> $user['first_name'].' '.$user['last_name'].'vừa làm xong, kết quả đạt '.number_format($quizz['percentage_obtained'],1).'%',
												  "content_available"=> true,
												   "sound"=> "default"
										 ),
										"data"=> array("id"=>0),
										"to"=> $to);
								$inp= json_encode($a);
								curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $inp);
								curl_setopt($ch, CURLOPT_POST, 1);
								
								curl_setopt($ch, CURLOPT_HTTPHEADER, array(
									 "Authorization: key=AAAAIUedk8M:APA91bHreQ0thOuZzGPA7hNlIDthF2Edog4s638tMJdIFUshMAqFrHfISm7pmMwidWFjSQ9IviMn14rwpKxFk8cu7FcGwfW2S7M0_untpzMf2cCJj7o5QbL-bz-wqlCt4HTqlI9_7vvD",
									"Content-Type: application/json"
									));

								$result = curl_exec($ch);
								if (curl_errno($ch)) {
									echo 'Error:' . curl_error($ch);
								}
								curl_close ($ch);
							}
						}
					}		
				}else{
					$data['msg'] = 'failure';
				}
			}
		}
		
		echo json_encode($data);
		//log_message("error",".......".json_encode($data));
	}
	
	function resend_answers(){
		$connection_key=$_POST["connection_key"];
		$uid=$_POST["uid"];
		$quid=$_POST["quid"];
		$id=$_POST["id"];
		$answers=$_POST["answers"];
		$old_rid=$_POST["rid"];
		
		log_message('error', $answers);
		//Check connection_key
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		} else {
			$open_result=$this->quiz_model->open_result($quid,$uid);
			$data['quiz']=$this->quiz_model->get_quiz($quid);
			$data['rid']=$this->quiz_model->insert_result($quid,$uid);
			$this->session->set_userdata('rid', $data['rid']);
			if($answers != ''){
				$arrans = explode('-', $answers);
				$arridx= array();
				$qidans= array();
				for($i=count($arrans)-1; $i>=0; $i-- ){
					$qida = explode("+",$arrans[$i])[0];
					if(!in_array($qida, $qidans)){
						array_push($qidans, $qida);
						array_push($arridx, $i);
					}
				}
				$individual_time = array();
				$rid = $data['rid'];
				$query=$this->db->query("select * from savsoft_result join savsoft_quiz on  savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
				$quiz=$query->row_array(); 
				$correct_score=$quiz['correct_score'];
				$incorrect_score=$quiz['incorrect_score'];
				$qids=explode(',',$quiz['r_qids']);
				$vqids=$quiz['r_qids'];
				$correct_incorrect=explode(',',$quiz['score_individual']);
				log_message('error', '***********1***********');
				log_message('error', implode(" ", $correct_incorrect));
				log_message('error', implode("**", $arridx));
				log_message('error', implode("**", $qidans));
				for ($i=0; $i < count($arrans); $i++) {
					if(in_array($i,$arridx)){
						
				
						$attempted=1;
						$marks=0;
						if(explode('+', $arrans[$i])[2] <= 0 ){
							$marks+=-1;	
						}else{
							$marks+=explode('+', $arrans[$i])[2];
						}
						//log_message('error', $marks);
						$answerdata = array(
							'qid' => explode('+', $arrans[$i])[0],
							'q_option' => explode('+', $arrans[$i])[1],
							'uid' => $uid,
							'score_u' => explode('+', $arrans[$i])[2],
							'rid' => $data['rid']
						);
						$this->db->insert('savsoft_answers', $answerdata);
						
												
						if($marks >= 1 ){
							log_message('error', 'attempted');
							$correct_incorrect[$i]=1;	
						}else{
							$correct_incorrect[$i]=2;							
						}
						$individual_time[] = 5;
					}
				}
				log_message('error', '**********2************');
				log_message('error', implode(" ", $correct_incorrect));
				$userdata=array(
				 	'score_individual'=>implode(',',$correct_incorrect),
				 	'individual_time'=>implode(',',$individual_time)
				);
				$this->db->where('rid',$data['rid']);
				$this->db->update('savsoft_result',$userdata);
				
				if($this->quiz_model->submit_results2($user, $data['rid'])){
					
					$data['msg'] = 'successfully';
					if($user['parent_id']){
						
						
						$this->db->where('rid', $old_rid);
						$this->db->where('quid', $quid);
						$this->db->where('id', $quid);
						$this->db->where('uid', $uid);
						$dd= $this->db->get('savsoft_assign')->row_array();
						if($dd){
					
							$notifydt= array("uid"=>$uid,
							                 "content"=>"Đã làm lại bài ",
											 "model"=>"result",
											 "action"=>"Answer assign quiz",
											 "click" => "window.location.href = '".site_url()."/result/view_result/".$data['rid']."'",
											 "rid"=>$data['rid']);
							$this->db->insert('notify', $notifydt);
							$nid = $this->db->insert_id();
							$notifyuserdt1= array("nid"=>$nid,"uid"=>$uid, "status"=>1);
							$notifyuserdt2= array("nid"=>$nid,"uid"=>$dd['auid'], "status"=>1);
							$this->db->insert('notify_user', $notifyuserdt1);
							$this->db->insert('notify_user', $notifyuserdt2);
							
							
						}
						
						$this->db->select('percentage_obtained');
						$this->db->where('rid',$data['rid']);
						$quizz= $this->db->get('savsoft_result')->row_array();
						if($dd){
							
							$type="";
							$this->db->where('quid', $quid);
							$qq= $this->db->get('savsoft_quiz')->row_array();
							if($qq){
								if($qq['level_hard']){
									if($qq['level_hard']>3){
										$type="KNS ";
									}
									else{
										$type="HCC ";
									}
								}
							}	
							$this->db->where("nid", $nid);							
							$this->db->update("notify",array("content"=>"Đã làm lại bài ".$type.". Kết quả: ".number_format($quizz['percentage_obtained'],0)."%"));
							
						}
						$pr_ids=explode(",",$user['parent_id']);
						foreach($pr_ids as $pr_id){
							$this->db->where("uid", $pr_id);
							$this->db->where("app", 'stemup');
							$tk=$this->db->get('user_token_fcm')->result_array();
							log_message("error", "Làm bài--- ".$pr_id);
							log_message("error", "Làm bài--- ".$user['uid']);
							//log_message("error", "Làm bài--- ".json_encode($tk));
								
							foreach($tk as $t){
								$to = $t['fcm_token'];
								log_message("error", "Làm bài ".$to." ".$pr_id." ".$t['divideid']);
								
								$this->load->library('Curl');
								$ch = curl_init();
								$a= array( "content_available"=> true,
										  "notification"=> array(
												 "title"=> $user['first_name'].' '.$user['last_name']."vừa làm lại bài",
												  "body"=> $user['first_name'].' '.$user['last_name'].'vừa làm lại, kết quả đạt '.number_format($quizz['percentage_obtained'],1).'%',
												  "content_available"=> true,
												   "sound"=> "default"
										 ),
										"data"=> array("id"=>0),
										"to"=> $to);
								$inp= json_encode($a);
								curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $inp);
								curl_setopt($ch, CURLOPT_POST, 1);
								
								curl_setopt($ch, CURLOPT_HTTPHEADER, array(
									 "Authorization: key=AAAAIUedk8M:APA91bHreQ0thOuZzGPA7hNlIDthF2Edog4s638tMJdIFUshMAqFrHfISm7pmMwidWFjSQ9IviMn14rwpKxFk8cu7FcGwfW2S7M0_untpzMf2cCJj7o5QbL-bz-wqlCt4HTqlI9_7vvD",
									"Content-Type: application/json"
									));

								$result = curl_exec($ch);
								if (curl_errno($ch)) {
									echo 'Error:' . curl_error($ch);
								}
								curl_close ($ch);
							}
						}
					}	
					
				}else{
					$data['msg'] = 'failure';
				}
			}
		}
		
		echo json_encode($data);
		//log_message("error",".......".json_encode($data));
	}
 
    function signup(){
		$user_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		$email = $user_info['email'];
		$first_name = $user_info['first_name'];
		$password= $user_info['password'];
		$this->db->where('email', $email);
		$n=$this->db->get('savsoft_users')->num_rows();
		$su=$user_info['su'];
		//log_message('error', "zzzzzzzzzzz@@".json_encode($user_info));
		if($su==4){
			$point=10000;
		}
		else
			$point=0;
		  
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
				 
			$post = array(
				'first_name'=>$first_name,
				'last_name'=>'',
				'email'=>$email,
				'email2'=>$email,
				'password'=>md5($password),
				'gid'=>5,
				'su'=>$su,
				'subscription_expired'=>strtotime('2030-12-31'),
				'user_code'=>$user_code,
				'point'=>$point
			);
						   
			if($this->db->insert('savsoft_users', $post)){
				echo json_encode(array("message"=>"success"));
			}
			else{
				echo json_encode(array("message"=>"error"));
			}
		}
		else{
			echo json_encode(array("message"=>"duplicate"));
		}  
	}
	
	function signup2(){
		$user_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		$email = $user_info['email'];
		$first_name = $user_info['first_name'];
		$password= $user_info['password'];
		$this->db->where('email', $email);
		$n=$this->db->get('savsoft_users')->num_rows();
		$su=$user_info['su'];
		$grade=$user_info['grade'];
		  
		if($su==4){
			$point=10000;
		}
		else
			$point=0;
		  
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
			$post = array(
				'first_name'=>$first_name,
				'last_name'=>'',
				'email'=>$email,
				'email2'=>$email,
				'password'=>md5($password),
				'gid'=>5,
				'su'=>$su,
				'subscription_expired'=>strtotime('2030-12-31'),
				'user_code'=>$user_code,
				'point'=>$point,
				'grade'=>$grade
			);
						   
			if($this->db->insert('savsoft_users', $post)){
				echo json_encode(array("message"=>"success"));
			}
			else{
				echo json_encode(array("message"=>"error"));
			}
		}
		else{
			echo json_encode(array("message"=>"duplicate"));
		}   	 
	}

	function signup3(){
		$user_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		$email = $user_info['email'];
		$first_name = $user_info['first_name'];
		$password= $user_info['password'];
		$this->db->where('email', $email);
		$n=$this->db->get('savsoft_users')->num_rows();
		$su=$user_info['su'];
		//log_message('error', "zzzzzzzzzzz@@".json_encode($user_info));
		if($su==4){
			$point=10000;
		}
		else
			$point=0;
		  
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
				 
			$post = array(
				'first_name'=>$first_name,
				'last_name'=>'',
				'email'=>$email,
				'email2'=>$email,
				'password'=>md5($password),
				'gid'=>5,
				'su'=>$su,
				'subscription_expired'=>strtotime('2030-12-31'),
				'user_code'=>$user_code,
				'point'=>$point
			);
				
				$result_x = $this->db->insert('savsoft_users', $post);		   
			if($result_x){
				echo json_encode(array("message"=>"success"));
			}
			else{
				echo json_encode(array("message"=>"error"));
			}

			if($result_x){

//send email
				$this->load->library('email');
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
					$fromemail=$this->config->item('fromemail');
					$fromname=$this->config->item('fromname');
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$subject="Chúc mừng bạn trở thành thành viên Stemup.app";
						$signup_name = $first_name;
						$signup_email = $email;

						$content=file_get_contents('./template_email/signup_parent.html');
						$content = str_replace("[[signup_name]]", $signup_name, $content);
						$content = str_replace("[[signup_email]]", $signup_email, $content);
						$content = str_replace("[[link_auth_email]]", $link_auth_email, $content);
						$content = str_replace("[[link_auth_email2]]", $link_auth_email, $content);
						$toemail=$email;	

						$this->email->to($toemail);
						$this->email->from($fromemail, $fromname);
						$this->email->subject($subject);
						$this->email->message($content);
						$this->email->send();	
//End send email

					}
			}

		}
		else{
			echo json_encode(array("message"=>"duplicate"));
		}


	}

	public function get_question_block(){
		$inp =  json_decode($this->input->raw_input_stream,true);
		$qids = explode(',',$inp['qids']);
		$quid = $inp['quid'];
		$html='';
		for($i=0; $i<count($qids); $i++)
			$html.= $this->qbank_model->get_question_block($qids[$i]);
		if($quid)
			$html.= $this->quiz_model->get_quiz_block($quid);
		header('Content-Type: application/json');
		echo json_encode(array('html'=>$html));
	}
	
	public function user_list(){
		if(!$this->session->userdata('logged_in')){
			redirect('home');
		}
		$data['users']=$this->api_model->student_list_1();
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function assign_question(){
		$qid = $this->input->post('qid');
		$uids=explode(",", $this->input->post('uids'));
		$data=array("name_success"=>"", "name_fail"=>"");
		foreach($uids as $uid){
			$this->db->where('uid',$uid);
			$first_name=$this->db->get('savsoft_users')->row_array()['first_name'];
			if($this->api_model->assign_question($qid,$uid)){
				if($data['name_success']==""){
					$data['success'].=$uid;
					$data['name_success'].=$first_name;
				}
				else{
					$data['success'].=",".$uid;
					$data['name_success'].=",".$first_name;
				}
			}else{
				if($data['name_fail']==""){
					$data['fail'].=$uid;
					$data['name_fail'].=$first_name;
				}
				else{
					$data['fail'].=",".$uid;
					$data['name_fail'].=",".$first_name;
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	public function check_answer($qid,$assid){
		$this->load->model('api_model');
		$rs=$this->api_model->check_answer($qid,$assid);
		header('Content-Type: application/json');
		echo json_encode($rs);
	}
	
	public function get_question_ass(){
		$qid = $this->input->post('qid');
		$data['qass'] = $this->api_model->get_question($qid);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	public function count_share(){
	    $inp =  json_decode($this->input->raw_input_stream,true);
		$qid = $inp['qid'];
		$this->db->where("qid", $qid);
		$q = $this->db->get('savsoft_qbank')->row_array();
		if($q){
			$sc = $q['share_count'];
			$mq = $q['modify_date'];
			$this->db->where("qid", $qid);
			$this->db->update('savsoft_qbank', array("modify_date"=>$mq, "share_count"=>$sc+1));
		}
	}

	public function count_share2(){
	    $inp =  json_decode($this->input->raw_input_stream,true);
		$quid = $inp['quid'];
		$this->db->where("quid", $quid);
		$q = $this->db->get('savsoft_quiz')->row_array();
		if($q){
			$sc = $q['share_count'];
			$mq = $q['modify_date'];
			$this->db->where("quid", $quid);
			$this->db->update('savsoft_quiz', array("modify_date"=>$mq, "share_count"=>$sc+1));
		}
		
	}

	public function answer_ass(){
		$qid = $this->input->post('qid');
		$assid = $this->input->post('assid');
		$answer = $this->input->post('answer');
		if($this->api_model->anwser_ass($qid, $assid, $answer)){
			$data['result'] = "success";
		}else{
			$data['result'] = "error";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	public function answer_ass1($qid,$uid){
		$this->load->model('api_model');
		$rs=$this->api_model->answer_ass1($qid,$uid);
		header('Content-Type: application/json');
		echo json_encode($rs);
	}
	
	public function data_transform(){
		$data['mcq_fun']=$this->qbank_model->get_mcq_fun2();
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		echo json_encode($data);
	}
	
	public function get_category(){
		$data=$this->db->get('savsoft_category')->result_array();
		for($i=0; $i<count($data); $i++){
			$sql= "select * from savsoft_quiz where noq>1 and deleted=0 and status=1 and gids=5 and cid=".$data[$i]['cid']; 
			 $data[$i]['count']= $this->db->query($sql)->num_rows();
			 $data[$i]['img']=base_url("upload/symbol/".$data[$i]['cid'].".png");
	    }
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	public function category($cid, $uid=0){
		$sql= "select quid,quiz_name,description,noq,duration,inserted_by_name,create_date,modify_date,share_count,cid,lid,qids
		from savsoft_quiz where noq>1 and deleted=0 and gids=5 and cid =".$cid." AND deleted=0 "; 
		$data= array_reverse($this->db->query($sql)->result_array());
        for($k=0; $k<count($data); $k++){
			$quids_arr = explode(",",$data[$k]['qids']);
			$qid=$quids_arr[0];
			$sql = "select question,background_template from savsoft_qbank where deleted =0 and qid = $qid";
			$qt= $this->db->query($sql)->row_array();
			 
			$origImageSrc="";
			$origvidSrc="";
			$htmlContent=$qt['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);	
			}
			if($origImageSrc)
				$data[$k]['img']=str_replace("..",base_url(),$origImageSrc);
			else
				$data[$k]['img']='';
			$this->db->where('quid',$data[$k]['quid']);
			$this->db->where('result_status !=','Open');
			$data[$k]['answers_count']=$this->db->get('savsoft_result')->num_rows();
			 
			if($uid==""){
				$data[$k]['user_liked']=0;
			}
			else{
				$this->db->where("uid", $uid);
				$this->db->where("content_id", $data[$k]['quid']);
				$this->db->where("status",1);
				$this->db->where("model",'quiz');
				$data[$k]['user_liked']=$this->db->get('savsoft_like')->num_rows();
			}
			 
			$this->db->where("content_id", $data[$k]['quid']);
			$this->db->where("status",1);
			$this->db->where("model",'quiz');
			$data[$k]['like_count']=$this->db->get('savsoft_like')->num_rows();
			  
			$this->db->where("wall_id", $data[$k]['quid']);
			$this->db->where("parent_id",0);
			$this->db->where("model",'quiz');
			$data[$k]['comment_count']=$this->db->get('posts')->num_rows();  
			$this->db->where("model", "quiz");
			$this->db->where("content_id",$data[$k]['quid']);
			$data[$k]['link']=site_url('page/quiz/')."/".$this->db->get("savsoft_permalink")->row_array()['permalink'];
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	public function category2($cid, $limit=10,$page=0){
		$sql= "select quid,quiz_name,description,noq,duration,inserted_by_name,create_date,modify_date,share_count,cid,lid,qids,start_date,end_date
		from savsoft_quiz where noq>1 and deleted=0 and gids=5 and cid =".$cid." AND status=1 order by quid desc limit $limit offset ".($limit*$page); 
		$data= array_reverse($this->db->query($sql)->result_array());
        for($k=0; $k<count($data); $k++){
			$quids_arr = explode(",",$data[$k]['qids']);
			$qid=$quids_arr[0];
			$sql = "select question,background_template from savsoft_qbank where deleted =0 and qid = $qid";
			$qt= $this->db->query($sql)->row_array();
			 
			$origImageSrc="";
			$origvidSrc="";
			$htmlContent=$qt['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			}
			if($origImageSrc)
				$data[$k]['img']=str_replace("..",base_url(),$origImageSrc);
			else
				$data[$k]['img']='';
			$this->db->where('quid',$data[$k]['quid']);
			$this->db->where('result_status !=','Open');
			$data[$k]['answers_count']=$this->db->get('savsoft_result')->num_rows();
			 
			if($uid==""){
				$data[$k]['user_liked']=0;
			}
			else{
				$this->db->where("uid", $uid);
				$this->db->where("content_id", $data[$k]['quid']);
				$this->db->where("status",1);
				$this->db->where("model",'quiz');
				$data[$k]['user_liked']=$this->db->get('savsoft_like')->num_rows();
			}
			 
			$this->db->where("content_id", $data[$k]['quid']);
			$this->db->where("status",1);
			$this->db->where("model",'quiz');
			$data[$k]['like_count']=$this->db->get('savsoft_like')->num_rows();
			  
			$this->db->where("wall_id", $data[$k]['quid']);
			$this->db->where("parent_id",0);
			$this->db->where("model",'quiz');
			$data[$k]['comment_count']=$this->db->get('posts')->num_rows();
			  
			$this->db->where("model", "quiz");
			$this->db->where("content_id",$data[$k]['quid']);
			$data[$k]['link']=site_url('page/quiz/')."/".$this->db->get("savsoft_permalink")->row_array()['permalink'];
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
		
	public function get_fun_mcq($offset=0){
		$this->db->where("status", 1);
		$this->db->where("type !=", 3);
		$this->db->where("deleted", 0);
        $this->db->limit(10);	
        $this->db->offset(10*$offset);
		$this->db->order_by('fun_priory DESC,create_date DESC');
		$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
		$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
        $data= $this->db->get("savsoft_qbank")->result_array();
		for($i=0; $i<count($data); $i++){
			$this->db->where('qid',$data[$i]['qid']);
			$options = $this->db->get('savsoft_options');
			$data[$i]['options']=$options->result_array();
			$this->db->where('qid',$data[$i]['qid']);
			$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$data[$i]['qid']);
			$this->db->where('istrue',1);
			$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('model', 'qbank');
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('status', 1);
			$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
			$this->db->where('model','qbank');
			$this->db->where('wall_id',$data[$i]['qid']);
			$this->db->where('parent_id', 0);
		    $data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
            for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
			 if($origImageSrc){
				 $data[$i]['img']=$origImageSrc;
			 }
			else{
				$data[$i]['img']="";
			}		 
			
			$data[$i]['question']=str_replace('src="..', 'src="'.base_url(),$data[$i]['question']);
			$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
			$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);
		}
		$dt['questions']=$data;
		header('Content-Type: application/json');
		echo json_encode($dt);
	}
	
	public function get_fun_mcq1($connection_key="", $uid="",$offset=0){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			$this->db->where("type !=", 3);
			$this->db->limit(10);	
			$this->db->offset(10*$offset);
			$this->db->order_by('fun_priory DESC,create_date DESC');
			$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
			//$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
			
			$data= $this->db->get("savsoft_qbank")->result_array();
			$str_qids="";
			for($i=0; $i<count($data); $i++){
				if($i!=0)
					$str_qids.=",";
				$str_qids.=$data[$i]['qid'];
				
			}
			if($str_qids=="") $str_qids=0;
			 $sqlo = "select * from savsoft_options where qid in ($str_qids)";
			$ao = $this->db->query($sqlo)->result_array();
			for($i=0; $i<count($data); $i++){
				/*$this->db->where('qid',$data[$i]['qid']);
				$options = $this->db->get('savsoft_options');
				$data[$i]['options']=$options->result_array();*/
				
				$arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $data[$i]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
				$data[$i]['options']=$arr_op;
				$this->db->where('qid',$data[$i]['qid']);
				$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('qid',$data[$i]['qid']);
				$this->db->where('istrue',1);
				$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('model', 'qbank');
				$this->db->where('content_id', $data[$i]['qid']);
				$this->db->where('status', 1);
				$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where('model','qbank');
				$this->db->where('wall_id',$data[$i]['qid']);
				$this->db->where('parent_id', 0);
				$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
				$origImageSrc="";
				$imgTags="";	
				$htmlContent=$data[$i]['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				}
				$origImageSrc=str_replace("..",base_url(),$origImageSrc);
				if($origImageSrc){
					$data[$i]['img']=$origImageSrc;
					$data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
				}
				else{
					$data[$i]['img']="";
					$data[$i]['question']=strip_tags($data[$i]['question']);
				}		 
				
				$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
				//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);
				$this->db->where("uid", $uid);
				$this->db->where("model", 'qbank');
				$this->db->where("status", 1);
				$this->db->where("content_id", $data[$i]['qid']);
				$data[$i]['user_liked']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where("content_id", $data[$i]['qid']);
				$this->db->where("model", 'qbank');
				$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
                $data[$i]['link_solved']=site_url('page/question/'.$pl);
				$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
			$dt['questions']=$data;
			header('Content-Type: application/json');
			echo json_encode($dt);
		}
	}
	
	public function get_assign_mcq($connection_key="", $uid=""){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			echo json_encode(array("error"=>1));
		}
		else{
			//$this->db->where("savsoft_qbank.deleted", 0);
			$this->db->where("savsoft_qassign.uid", $uid);
			$this->db->order_by('savsoft_qassign.answer ASC,savsoft_qassign.assign_date DESC');
			$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
			$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
			$this->db->join('savsoft_qassign','savsoft_qassign.qid=savsoft_qbank.qid');
			$data= $this->db->get("savsoft_qbank")->result_array();
			
			for($i=0; $i<count($data); $i++){
				$this->db->where("uid",$data[$i]['assid']);
				$as=$this->db->get('savsoft_users')->row_array();
				$data[$i]['assign_user']=$as['first_name'].' '.$as['last_name'];
				if(!$data[$i]['answer']){
					$data[$i]['answered']=0;
				}
				else
					$data[$i]['answered']=1;
				
				$this->db->where('qid',$data[$i]['qid']);
				$options = $this->db->get('savsoft_options');
				$data[$i]['options']=$options->result_array();
				$this->db->where('qid',$data[$i]['qid']);
				$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('qid',$data[$i]['qid']);
				$this->db->where('istrue',1);
				$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('model', 'qbank');
				$this->db->where('model', 'qbank');
				$this->db->where('content_id', $data[$i]['qid']);
				$this->db->where('status', 1);
				$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where('model','qbank');
				$this->db->where('wall_id',$data[$i]['qid']);
				$this->db->where('parent_id', 0);
				$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
				$origImageSrc="";
				$imgTags="";	
				$htmlContent=$data[$i]['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);	
				}
				$origImageSrc=str_replace("..",base_url(),$origImageSrc);
				if($origImageSrc){
					$data[$i]['img']=$origImageSrc;
					$data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
				}
				else{
					$data[$i]['img']="";
					$data[$i]['question']=strip_tags($data[$i]['question']);
				}		 
				
				$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
				$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);
				$data[$i]['assign_time_ago']=$this->api_model->time_ago($data[$i]['assign_date']);
				$this->db->where("uid", $uid);
				$this->db->where("model", 'qbank');
				$this->db->where("status", 1);
				$this->db->where("content_id", $data[$i]['qid']);
				$data[$i]['user_liked']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where("content_id", $data[$i]['qid']);
				$this->db->where("model", 'qbank');
				$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
                $data[$i]['link_solved']=site_url('page/question/'.$pl);
				$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
			$dt['questions']=$data;
			header('Content-Type: application/json');
			echo json_encode($dt);
		}
	}

	public function answer_assign_mcq($connection_key="", $uid="",$qid){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$data = json_decode($this->input->raw_input_stream,true);
			$post = array('answer'=>$data['oid']);
			$this->db->where('uid',$uid);
			$this->db->where('qid',$qid);
			if($this->db->update('savsoft_qassign',$post)){
				header('Content-Type: application/json');
				echo json_encode(array("success"=>1));
			}
			else{
				header('Content-Type: application/json');
				echo json_encode(array("error"=>1));
			}
		}
	}
	
	function answer_assign_quiz(){
		$connection_key=$_POST["connection_key"];
		$uid=$_POST["uid"];
		$quid=$_POST["quid"];
		$answers=$_POST["answers"];
		$id=$_POST["id"];
		//Check connection_key
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		} else {
			$open_result=$this->quiz_model->open_result($quid,$uid);
			$data['quiz']=$this->quiz_model->get_quiz($quid);
			$data['rid']=$this->quiz_model->insert_result($quid,$uid);
			$this->session->set_userdata('rid', $data['rid']);
			log_message('error', $answers);
			if($answers != ''){
				$arrans = explode('-', $answers);
				$individual_time = array();
				$rid = $data['rid'];
				$query=$this->db->query("select * from savsoft_result join savsoft_quiz on  savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
				$quiz=$query->row_array(); 
				$correct_score=$quiz['correct_score'];
				$incorrect_score=$quiz['incorrect_score'];
				$qids=explode(',',$quiz['r_qids']);
				$vqids=$quiz['r_qids'];
				$correct_incorrect=explode(',',$quiz['score_individual']);
				log_message('error', '***********1***********');
				log_message('error', implode(" ", $correct_incorrect));
				for ($i=0; $i < count($arrans); $i++) {
					
					$attempted=1;
			 		$marks=0;
			 		if(explode('+', $arrans[$i])[2] <= 0 ){
						$marks+=-1;	
					}else{
						$marks+=explode('+', $arrans[$i])[2];
					}
					//log_message('error', $marks);
					$answerdata = array(
						'qid' => explode('+', $arrans[$i])[0],
						'q_option' => explode('+', $arrans[$i])[1],
						'uid' => $uid,
						'score_u' => explode('+', $arrans[$i])[2],
						'rid' => $data['rid']
					);
					$this->db->insert('savsoft_answers', $answerdata);
					
											
					if($marks >= 1 ){
						log_message('error', 'attempted');
						$correct_incorrect[$i]=1;	
					}else{
						$correct_incorrect[$i]=2;							
					}
					$individual_time[] = 5;
				}
				log_message('error', '**********2************');
				log_message('error', implode(" ", $correct_incorrect));
				$userdata=array(
				 	'score_individual'=>implode(',',$correct_incorrect),
				 	'individual_time'=>implode(',',$individual_time)
				);
				$this->db->where('rid',$data['rid']);
				$this->db->update('savsoft_result',$userdata);
				$this->db->where('id',$id);
				$this->db->update('savsoft_assign',array("rid"=>$data['rid'], "status"=>2));
				if($this->quiz_model->submit_results($user, $data['rid'])){
					$data['msg'] = 'successfully';
				}else{
					$data['msg'] = 'failure';
				}
			}
			else{
				$this->db->where('rid',$data['rid']);
				$this->db->update('savsoft_result',$userdata);
				$this->db->where('id',$id);
				$this->db->update('savsoft_assign',array("rid"=>$data['rid'], "status"=>2));
				if($this->quiz_model->submit_results($user, $data['rid'])){
					$data['msg'] = 'successfully';
				}else{
					$data['msg'] = 'failure';
				}
			}
		}
		
		echo json_encode($data);
	}

	public function get_assign_quiz($connection_key="", $uid=""){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->select("savsoft_assign.id,savsoft_quiz.quid,savsoft_quiz.qids,savsoft_quiz.quiz_name,savsoft_assign.status,savsoft_assign.startdate,savsoft_assign.enddate ,savsoft_assign.uid,savsoft_assign.auid,savsoft_assign.aname");
			//$this->db->where("savsoft_quiz.deleted", 0);
			$this->db->where("savsoft_assign.uid", $uid);	
			$this->db->order_by('savsoft_assign.status ASC,savsoft_assign.startdate DESC');
			$this->db->join('savsoft_assign','savsoft_assign.quid=savsoft_quiz.quid');
			$quiz= $this->db->get("savsoft_quiz")->result_array();
			for($i=0; $i<count($quiz); $i++){
				$quiz[$i]['status']=$quiz[$i]['status']-1;
				$quids_arr = explode(",",$quiz[$i]['qids']);
				$qid=$quids_arr[0];
				$sql = "select question,background_template from savsoft_qbank where deleted =0 and qid = $qid";
				$qt= $this->db->query($sql)->row_array();
				 
				$origImageSrc="";
				$origvidSrc="";
				$htmlContent=$qt['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				}
				if($origImageSrc)
					$quiz[$i]['img']=str_replace("..",base_url(),$origImageSrc);
				else
					$quiz[$i]['img']=base_url('upload/default_image_quiz.png');
				$quiz[$i]['type']="";
			}
			$data['type']='assign_quiz';
			$data['num_of_quiz']=count($quiz);
			$data['quizs']=$quiz;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function get_assign_quiz2($connection_key="", $uid="",$limit=10 ,$page=0){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			echo json_encode(array("error"=>1));
		}
		else{
			
			$this->db->select("*");
			//$this->db->where("savsoft_quiz.deleted", 0);
			$this->db->where("savsoft_assign.uid", $uid);	
			$this->db->order_by('savsoft_assign.startdate DESC');
			$this->db->join('savsoft_assign','savsoft_assign.quid=savsoft_quiz.quid');
			$data['num_of_quiz']= $this->db->get("savsoft_quiz")->num_rows();
			
			$this->db->select("savsoft_assign.id,savsoft_quiz.quid,savsoft_quiz.qids,savsoft_quiz.level_hard,savsoft_quiz.quiz_name,savsoft_quiz.img_reading as img,savsoft_assign.status,savsoft_assign.startdate,savsoft_assign.enddate ,savsoft_assign.uid,savsoft_assign.auid,savsoft_assign.aname,savsoft_assign.price, savsoft_assign.reward_point,savsoft_assign.rid");
			//$this->db->where("savsoft_quiz.deleted", 0);
			$this->db->where("savsoft_assign.uid", $uid);	
			$this->db->order_by('savsoft_assign.startdate DESC');
			$this->db->join('savsoft_assign','savsoft_assign.quid=savsoft_quiz.quid');
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$quiz= $this->db->get("savsoft_quiz")->result_array();
			for($i=0; $i<count($quiz); $i++){
				$quiz[$i]['status']=$quiz[$i]['status']-1;
				$quids_arr = explode(",",$quiz[$i]['qids']);
				$qid=$quids_arr[0];
				$sql = "select question,background_template from savsoft_qbank where deleted =0 and qid = $qid";
				$qt= $this->db->query($sql)->row_array();
				 
				$origImageSrc="";
				$origvidSrc="";
				$htmlContent=$qt['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);	
				}
				if($quiz[$i]['level_hard']>0 && $quiz[$i]['img'] ){	
				}
				else{
					 if($origImageSrc)
						$quiz[$i]['img']=str_replace("..",base_url(),$origImageSrc);
					  else
						 $quiz[$i]['img']=base_url('upload/default_image_quiz.png');
					
				}
				if($quiz[$i]['level_hard']>3)
					$quiz[$i]['type']="KNS";
				else 
					if($quiz[$i]['level_hard']>0)
						$quiz[$i]['type']="HCC";
					else
						$quiz[$i]['type']="normal";
				if($quiz[$i]['status']==1){
					$this->db->where("rid",$quiz[$i]['rid'] );
					$quiz[$i]['percent']=number_format($this->db->get("savsoft_result")->row_array()['percentage_obtained'],0);
					$quiz[$i]['reward']=0;
					$quiz[$i]['remain_point']=0;

					$this->db->where("uid",$uid);
					$this->db->where("rid",$quiz[$i]['rid']);
					$ntf= $this->db->get("notify")->row_array();
					if($ntf){
						$nid= $ntf['nid'];
						$this->db->where("uid",$uid);
					    $this->db->where("nid",$nid);
					    $pc= $this->db->get("history_point")->row_array();
						$quiz[$i]['reward']=$pc['point_change'];
					    $quiz[$i]['remain_point']=$pc['point_remain'];		
					}
				}	
				else{
					$quiz[$i]['rid']="";
				}	
			}
			$data['type']='assign_quiz';
			
			$data['quizs']=$quiz;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	
	
	public function get_assign_quiz_cl($connection_key="", $uid="",$limit=10 ,$page=0){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			echo json_encode(array("error"=>1));
		}
		else{
			
			$this->db->select("*");
			//$this->db->where("savsoft_quiz.deleted", 0);
			$this->db->where("savsoft_assign.uid", $uid);
            $this->db->where("savsoft_assign.status", 1);				
			$this->db->order_by('savsoft_assign.startdate DESC');
			$this->db->join('savsoft_assign','savsoft_assign.quid=savsoft_quiz.quid');
			$data['num_of_quiz']= $this->db->get("savsoft_quiz")->num_rows();
			
			$this->db->select("savsoft_assign.id,savsoft_quiz.quid,savsoft_quiz.qids,savsoft_quiz.level_hard,savsoft_quiz.quiz_name,savsoft_quiz.img_reading as img,savsoft_assign.status,savsoft_assign.startdate,savsoft_assign.enddate ,savsoft_assign.uid,savsoft_assign.auid,savsoft_assign.aname,savsoft_assign.price, savsoft_assign.reward_point,savsoft_assign.rid");
			//$this->db->where("savsoft_quiz.deleted", 0);
			$this->db->where("savsoft_assign.uid", $uid);
			$this->db->where("savsoft_assign.status", 1);				
			$this->db->order_by('savsoft_assign.startdate DESC');
			$this->db->join('savsoft_assign','savsoft_assign.quid=savsoft_quiz.quid');
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$quiz= $this->db->get("savsoft_quiz")->result_array();
			for($i=0; $i<count($quiz); $i++){
				$quiz[$i]['status']=$quiz[$i]['status']-1;
				$quids_arr = explode(",",$quiz[$i]['qids']);
				$qid=$quids_arr[0];
				$sql = "select question,background_template from savsoft_qbank where deleted =0 and qid = $qid";
				$qt= $this->db->query($sql)->row_array();
				 
				$origImageSrc="";
				$origvidSrc="";
				$htmlContent=$qt['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);	
				}
				if($quiz[$i]['level_hard']>0 && $quiz[$i]['img'] ){	
				}
				else{
					 if($origImageSrc)
						$quiz[$i]['img']=str_replace("..",base_url(),$origImageSrc);
					  else
						 $quiz[$i]['img']=base_url('upload/default_image_quiz.png');
					
				}
				if($quiz[$i]['level_hard']>3)
					$quiz[$i]['type']="KNS";
				else 
					if($quiz[$i]['level_hard']>0)
						$quiz[$i]['type']="HCC";
					else
						$quiz[$i]['type']="normal";
				if($quiz[$i]['status']==1){
					$this->db->where("rid",$quiz[$i]['rid'] );
					$quiz[$i]['percent']=number_format($this->db->get("savsoft_result")->row_array()['percentage_obtained'],0);
					$quiz[$i]['reward']=0;
					$quiz[$i]['remain_point']=0;

					$this->db->where("uid",$uid);
					$this->db->where("rid",$quiz[$i]['rid']);
					$ntf= $this->db->get("notify")->row_array();
					if($ntf){
						$nid= $ntf['nid'];
						$this->db->where("uid",$uid);
					    $this->db->where("nid",$nid);
					    $pc= $this->db->get("history_point")->row_array();
						$quiz[$i]['reward']=$pc['point_change'];
					    $quiz[$i]['remain_point']=$pc['point_remain'];		
					}
				}	
				else{
					$quiz[$i]['rid']="";
				}	
			}
			$data['type']='assign_quiz';
			
			$data['quizs']=$quiz;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function get_do_assign_quiz($connection_key="", $uid="",$limit=10 ,$page=0){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->select("*");
			//$this->db->where("savsoft_quiz.deleted", 0);
			$this->db->where("savsoft_assign.status", 2);	
			$this->db->where("savsoft_assign.uid", $uid);	
			//$this->db->order_by('savsoft_assign.startdate DESC');
			$this->db->join('savsoft_assign','savsoft_assign.quid=savsoft_quiz.quid');
			$data['num_of_quiz']= $this->db->get("savsoft_quiz")->num_rows();
			
			$this->db->select("savsoft_assign.id,savsoft_quiz.quid,savsoft_quiz.qids,savsoft_quiz.level_hard,savsoft_quiz.quiz_name,savsoft_quiz.img_reading as img,savsoft_assign.status,savsoft_assign.startdate,savsoft_assign.enddate ,savsoft_assign.uid,savsoft_assign.auid,savsoft_assign.aname,savsoft_assign.price, savsoft_assign.reward_point,savsoft_assign.rid");
			//$this->db->where("savsoft_quiz.deleted", 0);
			$this->db->where("savsoft_assign.uid", $uid);	
			$this->db->where("savsoft_assign.status", 2);	
			
			
			$this->db->join('savsoft_assign','savsoft_assign.quid=savsoft_quiz.quid');
			$this->db->join("savsoft_result", "savsoft_assign.rid=savsoft_result.rid ");
			$this->db->order_by('savsoft_result.start_time DESC');
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$quiz= $this->db->get("savsoft_quiz")->result_array();
			for($i=0; $i<count($quiz); $i++){
				$quiz[$i]['status']=$quiz[$i]['status']-1;
				$quids_arr = explode(",",$quiz[$i]['qids']);
				$qid=$quids_arr[0];
				$sql = "select question,background_template from savsoft_qbank where deleted =0 and qid = $qid";
				$qt= $this->db->query($sql)->row_array();
				 
				$origImageSrc="";
				$origvidSrc="";
				$htmlContent=$qt['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				}
				if($quiz[$i]['level_hard']>0 && $quiz[$i]['img'] ){	
				}
				else{
					if($origImageSrc)
						$quiz[$i]['img']=str_replace("..",base_url(),$origImageSrc);
					else
						$quiz[$i]['img']=base_url('upload/default_image_quiz.png');
				}
				if($quiz[$i]['level_hard']>3)
					$quiz[$i]['type']="KNS";
				else 
					if($quiz[$i]['level_hard']>0)
						$quiz[$i]['type']="HCC";
					else
						$quiz[$i]['type']="normal";
				if($quiz[$i]['status']==1){
					$this->db->where("rid",$quiz[$i]['rid'] );
					$quiz[$i]['percent']=number_format($this->db->get("savsoft_result")->row_array()['percentage_obtained'],0);
					$quiz[$i]['reward']=0;
					$quiz[$i]['remain_point']=0;

					$this->db->where("uid",$uid);
					$this->db->where("rid",$quiz[$i]['rid']);
					$ntf= $this->db->get("notify")->row_array();
					if($ntf){
						$nid= $ntf['nid'];
						$this->db->where("uid",$uid);
					    $this->db->where("nid",$nid);
					    $pc= $this->db->get("history_point")->row_array();
						$quiz[$i]['reward']=$pc['point_change'];
					    $quiz[$i]['remain_point']=$pc['point_remain'];
					}
 
				}	
				else{
					 $quiz[$i]['rid']="";
				}
				
			}
			$data['type']='assign_quiz';	
			$data['quizs']=$quiz;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function like_question($connection_key="", $uid="",$qid){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->api_model->like_question($uid,$qid);
			header('Content-Type: application/json');
			echo json_encode(array("success"=>1));
		}
	}
	
	public function like_quiz($connection_key="", $uid="",$quid){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->api_model->like_quiz($uid,$quid);
			header('Content-Type: application/json');
			echo json_encode(array("success"=>1));
		}
	}
	
	public function get_comment($connection_key="", $uid="",$qid){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->select('qid, question, inserted_by');
			$this->db->where('qid',$qid);
			$data = $this->db->get('savsoft_qbank')->row_array();
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			}
			$origImageSrc=str_replace("..",base_url(),$origImageSrc);
			if($origImageSrc){
				$data['img']=$origImageSrc;
			}
			else{
				$data['img']="";
			}		 
			
			$data['question']=str_replace('src="..', 'src="'.base_url(),$data['question']);
			$data['comment']=$this->comment_model->get_comment("qbank",$qid, $parent_id=0, $limit=0);
		    for($i=0;$i<count($data['comment']); $i++){
				$data['comment'][$i]['time_ago']=$this->api_model->time_ago($data['comment'][$i]['create_date']);
			}
			$this->db->where("uid", $uid);
			$this->db->where("model", 'qbank');
			$this->db->where("status", 1);
			$this->db->where("content_id", $qid);
			$data['user_liked']=$this->db->get('savsoft_like')->num_rows();
			$this->db->where("model", 'qbank');
			$this->db->where("status", 1);
			$this->db->where("content_id", $qid);
			$data['like_count']=$this->db->get('savsoft_like')->num_rows();
			$this->db->where("content_id", $qid);
			$this->db->where("model", 'qbank');
			$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data['link_solved']=site_url('page/question/'.$pl);
			$data['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function get_comment_quiz($connection_key="", $uid="",$quid){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->select('*');
			$this->db->where('quid',$quid);
			$data = $this->db->get('savsoft_quiz')->row_array();
			$qids= $data['qids'];
			if($qids!=''){
				$qid = explode(",", $qids)[0];
				$this->db->select('question');
				$this->db->where('qid',$qid);
				$qt = $this->db->get('savsoft_qbank')->row_array();
				$origImageSrc="";
				$imgTags="";	
				$htmlContent=$qt['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if($origImageSrc){
					 $data['img']=$origImageSrc;
				 }
				else{
					$data['img']="";
				 }	 
			}
			else{
				$qid=0;
			}
		
			
			
			$data['comment']=$this->comment_model->get_comment("quiz",$quid, $parent_id=0, $limit=0);
		    for($i=0;$i<count($data['comment']); $i++){
				$data['comment'][$i]['time_ago']=$this->api_model->time_ago($data['comment'][$i]['create_date']);
			}
			$this->db->where("uid", $uid);
			$this->db->where("model", 'quiz');
			$this->db->where("status", 1);
			$this->db->where("content_id", $quid);
			$data['user_liked']=$this->db->get('savsoft_like')->num_rows();
			$this->db->where("model", 'quiz');
			$this->db->where("status", 1);
			$this->db->where("content_id", $quid);
			$data['like_count']=$this->db->get('savsoft_like')->num_rows();
			$this->db->where("content_id", $quid);
			$this->db->where("model", 'quiz');
			$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data['link']=site_url('page/quiz/'.$pl);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

	public function post_comment($connection_key="", $uid="",$qid){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$data = json_decode($this->input->raw_input_stream,true);
			$post = array('content'=>$data['content'],
						  'parent_id'=>0,
						  'wall_id'=>$qid,
						  'model'=>"qbank",
						  'create_by'=>$uid
					);
					
			if($this->db->insert('posts', $post)){
				header('Content-Type: application/json');
				echo json_encode(array("success"=>1));
			}
			else{
				header('Content-Type: application/json');
				echo json_encode(array("error"=>1));
			}
		}
	}
	
	public function post_comment_quiz($connection_key="", $uid="",$quid){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$data = json_decode($this->input->raw_input_stream,true);
			$post = array(
						'content'=>$data['content'],
						'parent_id'=>0,
						'wall_id'=>$quid,
						'model'=>"quiz",
						'create_by'=>$uid
					);	
			if($this->db->insert('posts', $post)){
				header('Content-Type: application/json');
				echo json_encode(array("success"=>1));
			}
			else{
				header('Content-Type: application/json');
				echo json_encode(array("error"=>1));
			}
		}
	}
	
	public function load_notification($connection_key="", $uid=""){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("uid", $uid);
			$this->db->where("status", 0);
			$un_read = $this->db->get("notify_user")->num_rows();
			$data['type']='notification';
			$data['un_read']=$un_read;
			$this->db->where("uid", $uid);
			$this->db->select("nid,status");
			$this->db->order_by("nid desc");
			$data['message'] = $this->db->get("notify_user")->result_array();
			for($i=0; $i<count($data['message']); $i++){
				$this->db->where("nid", $data['message'][$i]['nid']);
				$notify = $this->db->get("notify")->row_array();
				$data['message'][$i]['content']=$notify['content'];
				$data['message'][$i]['model']=$notify['model'];
				$data['message'][$i]['createdate']=$notify['createdate'];
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function load_notification2($connection_key="", $uid="", $page=0, $limit = 10){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("uid", $uid);
			$this->db->where("status", 0);
			$un_read = $this->db->get("notify_user")->num_rows();
			$data['type']='notification';
			$data['un_read']=$un_read;
			$this->db->where("uid", $uid);
			$this->db->select("nid,status");
			$this->db->order_by("nid desc");
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$data['message'] = $this->db->get("notify_user")->result_array();
			for($i=0; $i<count($data['message']); $i++){
				$this->db->where("nid", $data['message'][$i]['nid']);
				$notify = $this->db->get("notify")->row_array();
				//$data['message'][$i]['content']=$notify['content'];
				$this->db->where("uid",$notify['uid'] );
				$usas=$this->db->get("savsoft_users")->row_array();
				$data['message'][$i]['content']= $usas['first_name']." ".$notify['content'] ;
				$data['message'][$i]['type']=0;
				$data['message'][$i]['rid']="";
				$data['message'][$i]['quid']="";
				if(strpos($notify['content'],"đã làm xong bài")!==false){
					$data['message'][$i]['type']=1;
					if($notify['rid']){
						$data['message'][$i]['rid']=$notify['rid'];
					}
				}
				if(strpos($notify['content'],"đã giao một bài")!==false){
					$this->db->where("savsoft_users.uid !=",$notify['uid']);
					$this->db->where("nid",$notify['nid']);
					$this->db->join("savsoft_users","savsoft_users.uid= notify_user.uid" );
					$data['message'][$i]['content'].= $this->db->get("notify_user")->row_array()['first_name'];
					$data['message'][$i]['content'] = str_replace("."," cho ",$data['message'][$i]['content'] );
					$aquid=explode("/",str_replace("window.location.href = '".site_url('quiz/validate_quizs/'),"",$notify['click']))[0];
					$data['message'][$i]['quid']=$aquid;
                }
				$data['message'][$i]['model']=$notify['model'];
				$data['message'][$i]['createdate']=$notify['createdate'];
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function load_notification3($connection_key="", $uid="", $page=0, $limit = 10){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("uid", $uid);
			$this->db->where("status", 0);
			$un_read = $this->db->get("notify_user")->num_rows();
			$data['type']='notification';
			$data['un_read']=$un_read;
			$this->db->where("uid", $uid);
			$this->db->select("nid,status");
			$this->db->order_by("nid desc");
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$data['message'] = $this->db->get("notify_user")->result_array();
			for($i=0; $i<count($data['message']); $i++){
				$this->db->where("nid", $data['message'][$i]['nid']);
				$notify = $this->db->get("notify")->row_array();
				//$data['message'][$i]['content']=$notify['content'];
				$this->db->where("uid",$notify['uid'] );
				$usas=$this->db->get("savsoft_users")->row_array();
				$data['message'][$i]['content']= $usas['first_name']." ".$notify['content'] ;
				
				$data['message'][$i]['type']=0;
				$data['message'][$i]['rid']="";
				$data['message'][$i]['quid']="";
				if(strpos($notify['content'],"đã làm xong bài")!==false){
					$data['message'][$i]['type']=1;
					if($notify['rid']){
						$data['message'][$i]['rid']=$notify['rid'];
						$this->db->where("rid",$notify['rid']);
						$as_rec=$this->db->get("savsoft_assign")->row_array();
						$trp=$as_rec['reward_point'];
						$data['message'][$i]['name']= $usas['first_name'];
						$percent= str_replace("đã làm xong bài. Kết quả: ","",$notify['content']);
						$percent= str_replace("đã làm xong bài KNS. Kết quả: ","",$percent);
						$percent= str_replace("đã làm xong bài HCC. Kết quả: ","",$percent);
						$percent= str_replace("%","",$percent);
						$data['message'][$i]['reward_point']=ceil($trp*$percent/100);
						$data['message'][$i]['minus_point']=$as_rec['price'];
						$this->db->where("uid",$as_rec['auid']);
						$this->db->where("nid",$data['message'][$i]['nid']);
						$this->db->where("activity","assign_quiz");
						$rp=$this->db->get("history_point")->row_array();
						if($rp)
							$data['message'][$i]['remain_point']=$rp['point_remain'];
						else
							$data['message'][$i]['remain_point']=0;
					}
					else{
						$data['message'][$i]['reward_point']=0;
						$data['message'][$i]['minus_point']=0;
						$data['message'][$i]['remain_point']=0;
					}
					
					
					
				}
				if(strpos($notify['content'],"đã giao một bài")!==false){
					$this->db->where("savsoft_users.uid !=",$notify['uid']);
					$this->db->where("nid",$notify['nid']);
					$this->db->join("savsoft_users","savsoft_users.uid= notify_user.uid" );
					$data['message'][$i]['content'].= $this->db->get("notify_user")->row_array()['first_name'];
					$data['message'][$i]['content'] = str_replace("."," cho ",$data['message'][$i]['content'] );
					$ari=explode("/",str_replace("window.location.href = '".site_url('quiz/validate_quizs/'),"",$notify['click']));
					$aquid=$ari[0];
					$aid=$ari[2];

					$data['message'][$i]['quid']=$aquid;
					$this->db->where("id", $aid);
					$data['message'][$i]['max_reward_point']=$this->db->get("savsoft_assign")->row_array()['reward_point'];
					$this->db->where("quid", $aquid);
					$data['message'][$i]['point']=$this->db->get("savsoft_quiz")->row_array()['points'];
					
                }
				$data['message'][$i]['model']=$notify['model'];
				$data['message'][$i]['createdate']=$notify['createdate'];
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	
	public function load_notification4($connection_key="", $uid="", $page=0, $limit = 10){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("uid", $uid);
			$this->db->where("status", 0);
			$un_read = $this->db->get("notify_user")->num_rows();
			$data['type']='notification';
			$data['un_read']=$un_read;
			$this->db->where("uid", $uid);
			$this->db->select("nid,status");
			$this->db->order_by("nid desc");
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$data['message'] = $this->db->get("notify_user")->result_array();
			for($i=0; $i<count($data['message']); $i++){
				$data['message'][$i]['img']=base_url("/upload/default_image_quiz.png");
				$this->db->where("nid", $data['message'][$i]['nid']);
				$notify = $this->db->get("notify")->row_array();
				//$data['message'][$i]['content']=$notify['content'];
				$this->db->where("uid",$notify['uid'] );
				$usas=$this->db->get("savsoft_users")->row_array();
				$data['message'][$i]['content']= $usas['first_name']." ".$notify['content'] ;
				
				$data['message'][$i]['type']=0;
				$data['message'][$i]['rid']="";
				$data['message'][$i]['quid']="";
				
				if($notify['rid']){
					$this->db->where("rid",$notify['rid']);
					$quidz=$this->db->get('savsoft_result')->row_array()['quid'];
					$this->db->where("quid",$quidz);
					$dtquidz=$this->db->get('savsoft_quiz')->row_array();
					if($dtquidz['img_reading']){
						$data['message'][$i]['img']=$dtquidz['img_reading'];
					}
				}
				
				if(strpos($notify['content'],"đã làm xong bài")!==false){
					$data['message'][$i]['type']=1;
					if($notify['rid']){
						$data['message'][$i]['rid']=$notify['rid'];
						$this->db->where("rid",$notify['rid']);
						$as_rec=$this->db->get("savsoft_assign")->row_array();
						$trp=$as_rec['reward_point'];
						
						$data['message'][$i]['name']= $usas['first_name'];
						
						if(strpos($notify['content'],"đã làm xong bài KNS")!==false){
							$notify['model']="result_tt";
						}
						
						$this->db->where("rid",$notify['rid']);
						$percent=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
						
						$data['message'][$i]['reward_point']=ceil($trp*$percent/100);
						$data['message'][$i]['minus_point']=$as_rec['price'];
						$this->db->where("uid",$as_rec['auid']);
						$this->db->where("nid",$data['message'][$i]['nid']);
						$this->db->where("activity","assign_quiz");
						$rp=$this->db->get("history_point")->row_array();
						if($rp)
							$data['message'][$i]['remain_point']=$rp['point_remain'];
						else
							$data['message'][$i]['remain_point']=0;
					}
					else{
						$data['message'][$i]['reward_point']=0;
						$data['message'][$i]['minus_point']=0;
						$data['message'][$i]['remain_point']=0;
					}
					
					
					
				}
				
				
				if(strpos($notify['content'],"Đã làm lại bài")!==false){
					$data['message'][$i]['type']=1;
					$data['message'][$i]['rid']=$notify['rid'];
					$data['message'][$i]['name']= $usas['first_name'];
					
					
				}
				if(strpos($notify['content'],"đã giao một bài")!==false){
					$this->db->where("savsoft_users.uid !=",$notify['uid']);
					$this->db->where("nid",$notify['nid']);
					$this->db->join("savsoft_users","savsoft_users.uid= notify_user.uid" );
					$data['message'][$i]['content'].= $this->db->get("notify_user")->row_array()['first_name'];
					$data['message'][$i]['content'] = str_replace("."," cho ",$data['message'][$i]['content'] );
					$ari=explode("/",str_replace("window.location.href = 'https://stemup.app/index.php/quiz/validate_quizs/","",$notify['click']));
					$aquid=$ari[0];
					$aid=$ari[2];
                    $data['message'][$i]['model']=$notify['model'];
					$data['message'][$i]['quid']=$aquid;
					$this->db->where("id", $aid);
					$data['message'][$i]['max_reward_point']=$this->db->get("savsoft_assign")->row_array()['reward_point'];
					$this->db->where("quid", $aquid);
					$tt=$this->db->get("savsoft_quiz")->row_array();
					
					if($tt){
						if($tt['img_reading'])
							$data['message'][$i]['img']=$tt['img_reading'];
				
						$data['message'][$i]['point']=$tt['points'];
						if($tt['level_hard'])
							if($tt['level_hard']>3){
								$data['message'][$i]['model']="quiz_tt";
							}
					}
                }
				else{
					 $data['message'][$i]['model']=$notify['model'];
				}
				$data['message'][$i]['createdate']=$notify['createdate'];
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
    public function load_notification_assign($uid="", $page=0, $limit = 10){
		$this->db->where('uid',$uid);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("notify_user.uid", $uid);
			$this->db->where("notify_user.status", 0);
			$this->db->where("notify.action", "Assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$un_read = $this->db->get("notify_user")->num_rows();
			$data['type']='notification';
			$data['un_read']=$un_read;
			
			$this->db->where("notify_user.uid", $uid);
			$this->db->select("notify_user.nid,notify_user.status");
			$this->db->where("notify.action", "Assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$this->db->order_by("notify_user.nid desc");
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$data['message'] = $this->db->get("notify_user")->result_array();
			for($i=0; $i<count($data['message']); $i++){
				$this->db->where("nid", $data['message'][$i]['nid']);
				$notify = $this->db->get("notify")->row_array();
				//$data['message'][$i]['content']=$notify['content'];
				$this->db->where("uid",$notify['uid'] );
				$usas=$this->db->get("savsoft_users")->row_array();
				$data['message'][$i]['content']= $usas['first_name']." ".$notify['content'] ;
				$data['message'][$i]['type']=0;
				$data['message'][$i]['rid']="";
				$data['message'][$i]['quid']="";
				
				$this->db->where("savsoft_users.uid !=",$notify['uid']);
				$this->db->where("nid",$notify['nid']);
				$this->db->join("savsoft_users","savsoft_users.uid= notify_user.uid" );
				$data['message'][$i]['content'].= $this->db->get("notify_user")->row_array()['first_name'];
				$data['message'][$i]['content'] = str_replace("."," cho ",$data['message'][$i]['content'] );
				$aquid=explode("/",str_replace("window.location.href = '".site_url('quiz/validate_quizs/'),"",$notify['click']))[0];
				$data['message'][$i]['quid']=$aquid;
				$data['message'][$i]['createdate']=$notify['createdate'];
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function load_notification_assign2($uid="", $page=0, $limit = 10){
		$this->db->where('uid',$uid);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("notify_user.uid", $uid);
			$this->db->where("notify_user.status", 0);
			$this->db->where("notify.action", "Assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$un_read = $this->db->get("notify_user")->num_rows();
			$data['type']='notification';
			$data['un_read']=$un_read;
			
			$this->db->where("notify_user.uid", $uid);
			$this->db->select("notify_user.nid,notify_user.status");
			$this->db->where("notify.action", "Assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$this->db->order_by("notify_user.nid desc");
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$data['message'] = $this->db->get("notify_user")->result_array();
			for($i=0; $i<count($data['message']); $i++){
				$this->db->where("nid", $data['message'][$i]['nid']);
				$notify = $this->db->get("notify")->row_array();
				//$data['message'][$i]['content']=$notify['content'];
				$this->db->where("uid",$notify['uid'] );
				$usas=$this->db->get("savsoft_users")->row_array();
				$data['message'][$i]['content']= $usas['first_name']." ".$notify['content'] ;
				$data['message'][$i]['type']=0;
				$data['message'][$i]['rid']="";
				$data['message'][$i]['quid']="";
				
				$this->db->where("savsoft_users.uid !=",$notify['uid']);
				$this->db->where("nid",$notify['nid']);
				$this->db->join("savsoft_users","savsoft_users.uid= notify_user.uid" );
				$data['message'][$i]['content'].= $this->db->get("notify_user")->row_array()['first_name'];
				$data['message'][$i]['content'] = str_replace("."," cho ",$data['message'][$i]['content'] );
				$ari=explode("/",str_replace("window.location.href = '".site_url('quiz/validate_quizs/'),"",$notify['click']));
				$aquid=$ari[0];
				$aid=$ari[2];

				$data['message'][$i]['quid']=$aquid;
				$this->db->where("id", $aid);
				$data['message'][$i]['max_reward_point']=$this->db->get("savsoft_assign")->row_array()['reward_point'];
				$this->db->where("quid", $aquid);
				$data['message'][$i]['point']=$this->db->get("savsoft_quiz")->row_array()['points'];
                
				$data['message'][$i]['model']=$notify['model'];
				$data['message'][$i]['createdate']=$notify['createdate'];
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function load_notification_assign3($uid="", $page=0, $limit = 10){
		$this->db->where('uid',$uid);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("notify_user.uid", $uid);
			$this->db->where("notify_user.status", 0);
			$this->db->where("notify.action", "Assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$un_read = $this->db->get("notify_user")->num_rows();
			$data['type']='notification';
			$data['un_read']=$un_read;
			
			$this->db->where("notify_user.uid", $uid);
			$this->db->select("notify_user.nid,notify_user.status");
			$this->db->where("notify.action", "Assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$this->db->order_by("notify_user.nid desc");
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$data['message'] = $this->db->get("notify_user")->result_array();
			for($i=0; $i<count($data['message']); $i++){
				$data['message'][$i]['img']=base_url("/upload/default_image_quiz.png");
				$this->db->where("nid", $data['message'][$i]['nid']);
				$notify = $this->db->get("notify")->row_array();
				//$data['message'][$i]['content']=$notify['content'];
				$this->db->where("uid",$notify['uid'] );
				$usas=$this->db->get("savsoft_users")->row_array();
				$data['message'][$i]['content']= $usas['first_name']." ".$notify['content'] ;
				$data['message'][$i]['type']=0;
				$data['message'][$i]['rid']="";
				$data['message'][$i]['quid']="";
				
				$this->db->where("savsoft_users.uid !=",$notify['uid']);
				$this->db->where("nid",$notify['nid']);
				$this->db->join("savsoft_users","savsoft_users.uid= notify_user.uid" );
				$data['message'][$i]['content'].= $this->db->get("notify_user")->row_array()['first_name'];
				$data['message'][$i]['content'] = str_replace("."," cho ",$data['message'][$i]['content'] );
				$ari=explode("/",str_replace("window.location.href = 'https://stemup.app/index.php/quiz/validate_quizs/","",$notify['click']));
				$aquid=$ari[0];
				$aid=$ari[2];

				$data['message'][$i]['quid']=$aquid;
				$this->db->where("id", $aid);
				$data['message'][$i]['max_reward_point']=$this->db->get("savsoft_assign")->row_array()['reward_point'];
				$this->db->where("quid", $aquid);
				$data['message'][$i]['point']=$this->db->get("savsoft_quiz")->row_array()['points'];
                
				$data['message'][$i]['model']=$notify['model'];
				
				$this->db->where("quid", $aquid);
				$tt=$this->db->get("savsoft_quiz")->row_array();
				
				
				if($tt){
					
					if($tt['img_reading'])
						$data['message'][$i]['img']=$tt['img_reading'];
					if($tt['level_hard'])
						if($tt['level_hard']>3){
							$data['message'][$i]['model']="quiz_tt";
						}
				}
				$data['message'][$i]['createdate']=$notify['createdate'];
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function load_notification_do_quiz($uid="", $page=0, $limit = 10){
		$this->db->where('uid',$uid);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("notify_user.uid", $uid);
			$this->db->where("notify_user.status", 0);
			$this->db->where("notify.action", "Answer assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$un_read = $this->db->get("notify_user")->num_rows();
			$data['type']='notification';
			$data['un_read']=$un_read;
			
			$this->db->where("notify_user.uid", $uid);
			$this->db->select("notify_user.nid,notify_user.status");
			$this->db->where("notify.action", "Answer assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$this->db->order_by("notify_user.nid desc");
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$data['message'] = $this->db->get("notify_user")->result_array();
			for($i=0; $i<count($data['message']); $i++){
				$this->db->where("nid", $data['message'][$i]['nid']);
				$notify = $this->db->get("notify")->row_array();
				//$data['message'][$i]['content']=$notify['content'];
				$this->db->where("uid",$notify['uid'] );
				$usas=$this->db->get("savsoft_users")->row_array();
				$data['message'][$i]['content']= $usas['first_name']." ".$notify['content'] ;
				$data['message'][$i]['type']=0;
				$data['message'][$i]['rid']="";
				$data['message'][$i]['quid']="";
				
				
				if($notify['rid']){
					$data['message'][$i]['rid']=$notify['rid'];
				}
                
				$data['message'][$i]['model']=$notify['model'];
				$data['message'][$i]['createdate']=$notify['createdate'];
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	public function load_notification_do_quiz2($uid="", $page=0, $limit = 10){
		$this->db->where('uid',$uid);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where("notify_user.uid", $uid);
			$this->db->where("notify_user.status", 0);
			$this->db->where("notify.action", "Answer assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$un_read = $this->db->get("notify_user")->num_rows();
			$data['type']='notification';
			$data['un_read']=$un_read;
			
			$this->db->where("notify_user.uid", $uid);
			$this->db->select("notify_user.nid,notify_user.status");
			$this->db->where("notify.action", "Answer assign quiz");
			$this->db->join("notify", "notify.nid=notify_user.nid");
			$this->db->order_by("notify_user.nid desc");
			$this->db->limit($limit);
			$this->db->offset($limit*$page);
			$data['message'] = $this->db->get("notify_user")->result_array();
			for($i=0; $i<count($data['message']); $i++){
				$data['message'][$i]['img']=base_url("/upload/default_image_quiz.png");
				$this->db->where("nid", $data['message'][$i]['nid']);
				$notify = $this->db->get("notify")->row_array();
				//$data['message'][$i]['content']=$notify['content'];
				$this->db->where("uid",$notify['uid'] );
				$usas=$this->db->get("savsoft_users")->row_array();
				$data['message'][$i]['content']= $usas['first_name']." ".$notify['content'] ;
				$data['message'][$i]['name']= $usas['first_name'];
				$data['message'][$i]['type']=1;
				$data['message'][$i]['rid']="";
				$data['message'][$i]['quid']="";
				
				$this->db->where("rid",$notify['rid']);
				$quidz=$this->db->get('savsoft_result')->row_array()['quid'];
				$this->db->where("quid",$quidz);
				$dtquidz=$this->db->get('savsoft_quiz')->row_array();
				if($dtquidz['img_reading']){
					$data['message'][$i]['img']=$dtquidz['img_reading'];
				}
				
				if(strpos($notify['content'],"đã làm xong bài KNS")!==false){
					$notify['model']="result_tt";
				}
				if(strpos($notify['content'],"đã làm xong bài")!==false){
					if($notify['rid']){
						$data['message'][$i]['rid']=$notify['rid'];
						$this->db->where("rid",$notify['rid']);
						$as_rec=$this->db->get("savsoft_assign")->row_array();
						$trp=$as_rec['reward_point'];
						
						$this->db->select('percentage_obtained');
						$this->db->where("rid",$notify['rid']);
						$percent=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
					    log_message("error", $percent."%^%^^^^%^%".$notify['rid']);
						
						$data['message'][$i]['reward_point']=ceil($trp*$percent/100);
						$data['message'][$i]['minus_point']=$as_rec['price'];
						$this->db->where("uid",$as_rec['auid']);
						$this->db->where("nid",$data['message'][$i]['nid']);
						$this->db->where("activity","assign_quiz");
						$rp=$this->db->get("history_point")->row_array();
						if($rp)
							$data['message'][$i]['remain_point']=$rp['point_remain'];
						else
							$data['message'][$i]['remain_point']=0;
						
					}
					else{
						$data['message'][$i]['reward_point']=0;
						$data['message'][$i]['minus_point']=0;
						$data['message'][$i]['remain_point']=0;
					}
                }
				else
				    if(strpos($notify['content'],"Đã làm lại bài")!==false){
						$data['message'][$i]['type']=1;
						$data['message'][$i]['rid']=$notify['rid'];
						
					}	
				$data['message'][$i]['model']=$notify['model'];
				$data['message'][$i]['createdate']=$notify['createdate'];
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	
	
	public function read_notification($connection_key="", $uid="", $nid){
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$user=$this->db->get('savsoft_users')->row_array();
		if(!$user){
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
		else{
			$this->db->where('nid',$nid);
			$this->db->where('uid',$uid);
			if($this->db->update('notify_user',array("status"=>1))){
				header('Content-Type: application/json');
			    echo json_encode(array("success"=>1));
			}
			
			else{
				header('Content-Type: application/json');
			    echo json_encode(array("error"=>1));
			}
		}
	}
	public function get_user($uid=0){
		$this->db->select("uid,photo, first_name,last_name,point, su,  email, birthdate, grade, starpoints as stars, group_account");
		$this->db->where("uid", $uid);
		$user=$this->db->get("savsoft_users")->row_array();
		if($user){
			if(!$user['photo']){
				$user['photo']= base_url("upload/avatar/default.png");
			}
			$this->db->where("inserted_by", $uid);
			$user['grade']= $user['grade']-2;
			$user['questions_count']=$this->db->get("savsoft_qbank")->num_rows();
			$this->db->where("uid", $uid);
			$this->db->where("status", 0);
			$user['unread_notification']=$this->db->get("notify_user")->num_rows();
			$user['unread_question']=0;
			$user['unread_quiz']=0;
			if($user['su']==2){
				$this->db->where("uid", $uid);
				$this->db->where("answer !=", null);
				//$this->db->where("deleted", 0);
				$user['unread_question']=$this->db->get("savsoft_qassign")->num_rows();
				$this->db->where("uid", $uid);
				$this->db->where("status", 1);
				//$this->db->where("deleted", 0);
				$user['unread_quiz']=$this->db->get("savsoft_assign")->num_rows();
			}

			header('Content-Type: application/json');
			echo json_encode($user);
		}
		else{
			header('Content-Type: application/json');
			echo json_encode(array("error"=>1));
		}
	}
	
	public function get_users(){
		$connection_key=$_POST["connection_key"];
		$uid=$_POST["uid"];
		//Check connection_key
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		} else {
			$data['users']=$this->api_model->getusers($user);
		}
		echo json_encode($data);
	}
    public function assignquestion(){
		$connection_key=$_POST["connection_key"];
		$assid=$_POST["assid"];
		$qid = $_POST["qid"];
		$uid = $_POST["uid"];
		$this->db->where('uid',$assid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		} else {
			if($this->api_model->assignquestion($user, $qid, $uid)){
				$data['result'] = "success";
			}else{
				$data['result'] = "error";
			}
		}
		

		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function dataforvuidetail(){
		$cname=$_POST["cname"];
		$data['res'] = $this->api_model->dataforvuidetail($cname);
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		echo json_encode($data);
	}

	public function assignquizapi(){
		#assignQuizApi
		$connection_key=$_POST["connection_key"];
		$quid = $_POST["quid"];
		$uid = $_POST["uid"];
		$startdate = $_POST["startdate"];
		$enddate = $_POST["enddate"];
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
			$data['result'] = "Not connected.";
			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			if($this->api_model->assignQuizApi($user, $quid, $uid, $startdate, $enddate)){
				
				$data['result'] = "success";
				$this->load->library('Curl');
				
				$this->db->where("uid", $uid);
				$this->db->where("app", 'do');
				$tk=$this->db->get('user_token_fcm')->result_array();
				foreach($tk as $t){
					$ch = curl_init();
					$to = $t['fcm_token'];
				    log_message("error", "****************************Giao bài ".$to." ".$uid." ".$t['diviceid']);
					$a= array( "content_available"=> true,
							  "notification"=> array(
									 "title"=> "Bài được giao",
									  "body"=> "Bạn vừa được giao một bài, hãy mở ứng dụng STEMUP Học sinh để làm bài!",
									  "content_available"=> true,
									   "sound"=> "default"
							 ),
							"data"=> array("id"=>0),
							"to"=> $to);
					$inp= json_encode($a);
					
					curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $inp);
					curl_setopt($ch, CURLOPT_POST, 1);
					
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						 "Authorization: key=AAAA0dc6mvY:APA91bEzamAftWvYzwTW7sRf7G7RxYsCtNmjrKLjfTXVbtZFNyKME0C4TM1cEoQMSh_ja9dURjs9WecjZCD1yW0nPK0Hhp6t1D20n96ZcVKsdWbNiJBDjEg5QRTYQFGAoNsHvJcQmcs1",
						"Content-Type: application/json"
						));

					$result = curl_exec($ch);
					if (curl_errno($ch)) {
						log_message("error", "****************************Giao bàixxx ".curl_error($ch));
						
					}
					curl_close ($ch);
					
				}
			}else{
				$data['result'] = "Cannot assign for user.";
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	public function assignquizapi2(){
		#assignQuizApi
		$connection_key=$_POST["connection_key"];
		$quid = $_POST["quid"];
		$uid = $_POST["uid"];
		$startdate = $_POST["startdate"];
		$enddate = $_POST["enddate"];
		$reward= $_POST["reward"];
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
			$data['result'] = "Not connected.";
			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			if($this->api_model->assignQuizApi2($user, $quid, $uid, $startdate, $enddate,$reward)){
				$data['result'] = "success";
				$this->load->library('Curl');
				
				$this->db->where("uid", $uid);
				$this->db->where("app", 'do');
				$tk=$this->db->get('user_token_fcm')->result_array();
				foreach($tk as $t){
					$ch = curl_init();
					$to = $t['fcm_token'];
				    log_message("error", "****************************Giao bài ".$to." ".$uid." ".$t['diviceid']);
					$a= array( "content_available"=> true,
							  "notification"=> array(
									 "title"=> "Bài được giao",
									  "body"=> "Bạn vừa được giao một bài, hãy mở ứng dụng STEMUP Học sinh để làm bài!",
									  "content_available"=> true,
									   "sound"=> "default"
							 ),
							"data"=> array("id"=>0),
							"to"=> $to);
					$inp= json_encode($a);
					
					curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $inp);
					curl_setopt($ch, CURLOPT_POST, 1);
					
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						 "Authorization: key=AAAA0dc6mvY:APA91bEzamAftWvYzwTW7sRf7G7RxYsCtNmjrKLjfTXVbtZFNyKME0C4TM1cEoQMSh_ja9dURjs9WecjZCD1yW0nPK0Hhp6t1D20n96ZcVKsdWbNiJBDjEg5QRTYQFGAoNsHvJcQmcs1",
						"Content-Type: application/json"
						));

					$result = curl_exec($ch);
					if (curl_errno($ch)) {
						echo 'Error:' . curl_error($ch);
					}
					curl_close ($ch);
					
				}
			}else{
				$data['result'] = "Cannot assign for user.";
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	public function assignquizapi_19(){
	
		#assignQuizApi
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$connection_key=$_POST["connection_key"];
		$quid = $_POST["quid"];
		$uid = $_POST["uid"];
		$startdate = date('Y-m-d H:i:s', time()) ;
		
		//$enddate =  date('Y-m-d', time()+7*24*60*60) ;
		
		//log_message("error",$enddate);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
			$data['result'] = "Not connected.";
			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			if($this->api_model->assignQuizApi($user, $quid, $uid, $startdate, "")){
				$data['result'] = "success";
               
			}else{
				$data['result'] = "Cannot assign for user.";
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function number_mdr(){
	    $data['num_question']= $this->qbank_model->num_mdr_qt(0,0,"",10,0); 
		$data['num_quiz']= $this->quiz_model->num_mdr_quiz("");	
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function get_category_level($uid){
		$this->db->select("interest_cat_ids,interest_level_ids");
		$this->db->where("uid", $uid);
		$user =  $this->db->get('savsoft_users')->row_array();
		$aric = explode(",",$user['interest_cat_ids']);
		$aril = explode(",",$user['interest_level_ids']);
		$data['category'] = $this->db->get('savsoft_category')->result_array();
		for($i=0; $i<count($data['category']) ; $i++){
			if(in_array($data['category'][$i]['cid'],$aric))
			    $data['category'][$i]['status']=1;
			else
				$data['category'][$i]['status']=0;
		}
		$data['level'] = $this->db->get('savsoft_level')->result_array();
		for($i=0; $i<count($data['level']) ; $i++){
			if(in_array($data['level'][$i]['lid'],$aril))
			    $data['level'][$i]['status']=1;
			else
				$data['level'][$i]['status']=0;
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function set_category_level($uid){
		$inp =  json_decode($this->input->raw_input_stream,true);
		$cati = $inp['category'];
		$levi = $inp['level'];
		$strcati="";
		$strlevi="";
		foreach($cati as $ci){
			if($ci['status']==1){
				if($strcati==""){
					$strcati.=$ci['cid'];
				}
				else{
					$strcati.=",".$ci['cid'];
				}
			}
		}
		foreach($levi as $li){
			if($li['status']==1){
				if($strlevi==""){
					$strlevi.=$li['lid'];
				}
				else{
					$strlevi.=",".$li['lid'];
				}
			}
		}
		$this->db->where("uid", $uid);	
		if($this->db->update("savsoft_users", array("interest_cat_ids"=>$strcati,"interest_level_ids"=>$strlevi))){
		    $result= array("message"=>"success");
		}
		else{
			$result= array("message"=>"error");
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	function set_category_level1($uid){
		$inp =  json_decode($this->input->raw_input_stream,true);
		$this->db->select("interest_cat_ids,interest_level_ids");
		$this->db->where("uid", $uid);
		$user =$this->db->get("savsoft_users")->row_array();
		if($inp['type']=="0"){
			$cat_arr= explode(",",$user['interest_cat_ids']);
			if($inp['status']==0){
				$index= array_search($inp['id'],$cat_arr);
				array_splice($cat_arr,$index,1);
			}
			else{
				array_push($cat_arr, $inp['id']);
			}
			$this->db->where("uid", $uid);
			if($this->db->update("savsoft_users", array("interest_cat_ids"=>implode(",",$cat_arr)))){
				$result= array("message"=>"success");
			}
			else{
				$result= array("message"=>"error");
			}
			
		}
		
		else if($inp['type']=="1"){
			$lev_arr= explode(",",$user['interest_level_ids']);
			if($inp['status']==0){
				$index= array_search($inp['id'],$lev_arr);
				array_splice($lev_arr,$index,1);
			}
			else{
				array_push($lev_arr, $inp['id']);
			}
			$this->db->where("uid", $uid);
			if($this->db->update("savsoft_users", array("interest_level_ids"=>implode(",",$lev_arr)))){
				$result= array("message"=>"success");
			}
			else{
				$result= array("message"=>"error");
			}
		}
		else{
			$result= array("message"=>"error");
		}
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	
	function get_reccommend_question($uid, $num_question=1){
		
		$this->db->where("uid", $uid);
		$user=$this->db->get("savsoft_users")->num_rows();
		
		$sql="select * from savsoft_qbank q join savsoft_category c on c.cid=q.cid join savsoft_level l on l.lid = q.lid
		where q.qid not in (select qid from savsoft_answer_mcq where uid=1) and q.deleted =0 and q.status =1 ";
		if($user['interest_cat_ids']){
			$sql.="and q.cid in (".$user['interest_cat_ids'].") ";
		}
		if($user['interest_level_ids']){
			$sql.="and q.lid in (".$user['interest_level_ids'].") ";
		}

		
		$sql.=" ORDER BY rand() limit ".$num_question;
		$data = $this->db->query($sql)->result_array();
		for($i =0; $i<count($data); $i++){
			 if(strpos($htmlContent,'latex.codecogs.com')===false  && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
				 $origImageSrc="";
				 $htmlContent=$data[$i]['question'];
				 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 
				 if($origImageSrc)
					$data[$i]['img']=str_replace("..",base_url(),$origImageSrc);
				  else
					 $data[$i]['img']='';
			 }
			 else
				 $data[$i]['img']='';
			 $origvidSrc="";
			 $vidTags="";
			 preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			 if(count($vidTags[0])>0){
				 $qt=$vidTags[0][0].'</iframe><br/><br/>';
				 $qt.=strip_tags($data[$i]['question']);
			 	 $data[$i]['question']=$qt;
			 }
             else{	
                if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
					$data[$i]['question'] = strip_tags($data[$i]['question']);
				}
			 }
			 $this->db->where("qid", $data[$i]['qid']);
			$data[$i]['options'] = $this->db->get("savsoft_options")->result_array();
		}
		echo json_encode($data);
	}
	
	function answer_mcq($uid, $qid, $oid){
		$this->db->where("uid", $uid);
		$this->db->where("qid", $qid);
		$data =$this->db->get("savsoft_answer_mcq")->row_array();
		if(!$data){
			$this->db->select("oid, score");
			$this->db->where("qid", $qid);
			$op =$this->db->get("savsoft_options")->result_array();
			for($i=0; $i<count($op); $i++){
				if($oid==$op[$i]['oid']){
					$option_choice=$i;
					if($op[$i]['score']>0){
						$istrue=1;
					}
					else
						$istrue=0;
					
				}
				if($op[$i]['score']>0){
					$option_correct=$i;
				}
				
			}
			$arrins = array("qid"=>$qid,
			                "uid"=>$uid,
							"option_choice"=>$option_choice,
							"option_correct"=>$option_correct,
							"istrue"=>$istrue
			                );
			
			$this->db->insert("savsoft_answer_mcq",$arrins);
			echo json_encode(array("message"=>"1"));
		}
		else{
			echo json_encode(array("message"=>"0"));
		}
	}
	
	function result_list1($uid='',$limit=10){
			
		$sql= "select q.qid as id,'question' as type, a.create_date as date , ";
		$sql.= " q.question as name,  'Đúng' as status, '' as percent ";
		$sql.= " from savsoft_answer_mcq a ";
		$sql.= " join savsoft_qbank q on a.qid = q.qid ";
		$sql.= " where uid=".$uid;
		$sql.= " union ";
		$sql.= " select qu.quid as id, 'quiz' as type, DATE_FORMAT(FROM_UNIXTIME(r.end_time), '%Y-%m-%d %H:%s:%i') AS date, ";
		$sql.= " qu.quiz_name as name, r.result_status as status, r.percentage_obtained as percent ";
		$sql.= " from savsoft_result r ";
		$sql.= " join savsoft_quiz qu on qu.quid = r.quid ";
		$sql.= " where uid=1 ";
		$sql.= " ORDER BY date desc limit ". $limit;
		$result = $this->db->query($sql)->result_array();
		
		for( $i =0; $i < count($result);$i++){
			$result[$i]['name']= strip_tags($result[$i]['name']);
		}
		echo json_encode($result);
		
	 
		
		
	}
	
	
	function get_tags_most_ans($limit=5, $page=0){
		$lastmonth =date('Y-m-d H:i:s', strtotime('-10day'));
		
		/*$sql= "select  B.tag_id, C.tag_name ,SUM(A.count_ans) as count  FROM ";
        $sql.=" ((select qid , count(*) as count_ans from savsoft_answer_mcq where create_date > '".$lastmonth. "' GROUP BY qid ) as A";
        $sql.=" inner join "; 
        $sql.=" (select tag_id,question_id from question_tag_rel) as B";
        $sql.=" on A.qid= B.question_id"; 
        $sql.=" join"; 
        $sql.=" (select tag_name,tag_id,blacklist from tags where blacklist=0) as C";
        $sql.=" on C.tag_id= B.tag_id )";
        $sql.=" GROUP BY B.tag_id ";
        $sql.=" ORDER BY count desc ";
		$sql.=" limit ". $limit ;
		$sql.=" Offset ".($limit*$page) ;
		$data= $this->db->query($sql)->result_array();*/
		
		$sql= "select  B.tag_id ,SUM(A.count_ans) as count  FROM ";
        $sql.=" ((select qid , count(*) as count_ans from savsoft_answer_mcq where create_date > '".$lastmonth. "' GROUP BY qid ) as A";
        $sql.=" inner join "; 
        $sql.=" (select tag_id,question_id from question_tag_rel where tag_id in (select tag_id from tags where blacklist=0 and length(tag_name)<20)) as B";
        $sql.=" on A.qid= B.question_id )"; 
      
        $sql.=" GROUP BY B.tag_id ";
        $sql.=" ORDER BY count desc ";
		$sql.=" limit ". $limit ;
		$sql.=" Offset ".($limit*$page) ;
		$data= $this->db->query($sql)->result_array();	
		
		$str="";
		for($i=0; $i<count($data); $i++){
			if($i!=0)
				$str.=",";
			$str.=$data[$i]['tag_id'];
		}
		if($str!=""){
		   $sql = "select * from tags where tag_id in (".$str.")";
	        $data_tags= $this->db->query($sql)->result_array();	
		}
		
		for($i=0; $i<count($data); $i++){
			for($j=0; $j<count($data_tags); $j++){
				if($data[$i]['tag_id']==$data_tags[$j]['tag_id'])
					$data[$i]['tag_name']=$data_tags[$j]['tag_name'];
			}

			/*$sql ="select question_id as qid from question_tag_rel qtr where qtr.tag_id=".$data[$i]['tag_id'];
			$sql .=" order by rand() ";
			$qid= $this->db->query($sql)->row_array()['qid'];
			$sql ="select question from savsoft_qbank where qid=$qid";
			$question= $this->db->query($sql)->row_array()['question'];
			$htmlContent=$question;
			$data[$i]['img']=base_url("upload/default_image_quiz.png");
			if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
				 $origvidSrc="";
				 
				 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 if($origImageSrc)
					$data[$i]['img']=str_replace("../upload",base_url(),$origImageSrc);
					
				}
		    */
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		
	}
	
	function get_trending_tags(){
		$this->db->where("istrend",1);
		$data=$this->db->get("tags")->result_array();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function get_question_by_tag($tag_id=0, $limit=5, $page=0){
		
		   
			$sql = "select qid,question,description ,c.* from savsoft_qbank q ";
			$sql.= " join savsoft_category c on c.cid =q.cid ";
			//$sql.= " join savsoft_level l on l.lid = q.lid ";
			$sql.= " where q.status=1 and q.deleted =0 and q.type!=3 ";
			$sql.= " and q.qid in ( select question_id from question_tag_rel where tag_id =$tag_id)";
			$sql.= " order by q.qid desc  limit $limit offset ". ($limit*$page);
			$data= $this->db->query($sql)->result_array();
			
		    $str_qids="";
			for($i=0; $i<count($data); $i++){
				if($i!=0)
					$str_qids.=",";
				$str_qids.=$data[$i]['qid'];
				
			}
			if($str_qids=="") $str_qids=0;
			 $sqlo = "select * from savsoft_options where qid in ($str_qids)";
		     $ao = $this->db->query($sqlo)->result_array();
			for($i=0; $i<count($data); $i++){
				/*$this->db->where('qid',$data[$i]['qid']);
				$options = $this->db->get('savsoft_options');
				$data[$i]['options']=$options->result_array();*/
				
				$arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $data[$i]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
				$data[$i]['options']=$arr_op;	
				$this->db->where('qid',$data[$i]['qid']);
				$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('qid',$data[$i]['qid']);
				$this->db->where('istrue',1);
				$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('model', 'qbank');
				$this->db->where('content_id', $data[$i]['qid']);
				$this->db->where('status', 1);
				$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where('model','qbank');
				$this->db->where('wall_id',$data[$i]['qid']);
				$this->db->where('parent_id', 0);
				$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
				if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
					$origImageSrc="";
					$imgTags="";	
					$htmlContent=$data[$i]['question'];
					preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
					for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
						
					 }
					 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
					 if($origImageSrc){
						 $data[$i]['img']=$origImageSrc;
						 $data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
					 }
					else{
						$data[$i]['img']="";
						$data[$i]['question']=strip_tags($data[$i]['question']);
					}		 
				}
				
				else{
					$data[$i]['img']="";
				}
				$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
				//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);
				$this->db->where("uid", $uid);
				$this->db->where("model", 'qbank');
				$this->db->where("status", 1);
				$this->db->where("content_id", $data[$i]['qid']);
				$data[$i]['user_liked']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where("content_id", $data[$i]['qid']);
				$this->db->where("model", 'qbank');
				$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
                $data[$i]['link_solved']=site_url('page/question/'.$pl);
				$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
			$dt['questions']=$data;
			header('Content-Type: application/json');
			echo json_encode($dt);
	}
	
	function get_question_by_tag_device($tag_id=0, $limit=5, $page=0, $device_id){
		
		    
			$sql = "select qid,question,description ,c.* from savsoft_qbank q ";
			$sql.= " join savsoft_category c on c.cid =q.cid ";
			//$sql.= " join savsoft_level l on l.lid = q.lid ";
			$sql.= " where q.status=1 and q.deleted =0 and q.type!=3 ";
			$sql.= " and q.qid in ( select question_id from question_tag_rel where tag_id =$tag_id) ";
			$sql.= " and q.qid not in ( select qid from devide_answer_mcq where devide_id ='$device_id') ";
			$sql.= " order by q.qid desc  limit $limit offset ". ($limit*$page);
			$data= $this->db->query($sql)->result_array();
		    $str_qids="";
			for($i=0; $i<count($data); $i++){
				if($i!=0)
					$str_qids.=",";
				$str_qids.=$data[$i]['qid'];
				
			}
			if($str_qids=="") $str_qids=0;
			 $sqlo = "select * from savsoft_options where qid in ($str_qids)";
		     $ao = $this->db->query($sqlo)->result_array();
			for($i=0; $i<count($data); $i++){
				/*$this->db->where('qid',$data[$i]['qid']);
				$options = $this->db->get('savsoft_options');
				$data[$i]['options']=$options->result_array();*/
				
				$arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $data[$i]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
				$data[$i]['options']=$arr_op;	
				$this->db->where('qid',$data[$i]['qid']);
				$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('qid',$data[$i]['qid']);
				$this->db->where('istrue',1);
				$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('model', 'qbank');
				$this->db->where('content_id', $data[$i]['qid']);
				$this->db->where('status', 1);
				$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where('model','qbank');
				$this->db->where('wall_id',$data[$i]['qid']);
				$this->db->where('parent_id', 0);
				$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
				if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
					$origImageSrc="";
					$imgTags="";	
					$htmlContent=$data[$i]['question'];
					preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
					for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
						
					 }
					 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
					 if($origImageSrc){
						 $data[$i]['img']=$origImageSrc;
						 $data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
					 }
					else{
						$data[$i]['img']="";
						$data[$i]['question']=strip_tags($data[$i]['question']);
					}		 
				}
				
				else{
					$data[$i]['img']="";
				}
				$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
				//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);
				$this->db->where("uid", $uid);
				$this->db->where("model", 'qbank');
				$this->db->where("status", 1);
				$this->db->where("content_id", $data[$i]['qid']);
				$data[$i]['user_liked']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where("content_id", $data[$i]['qid']);
				$this->db->where("model", 'qbank');
				$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
                $data[$i]['link_solved']=site_url('page/question/'.$pl);
				$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
			$dt['questions']=$data;
			header('Content-Type: application/json');
			echo json_encode($dt);
	}
	
	function get_question_by_tag_user($tag_id=0, $limit=5, $page=0, $uid){
		
		   
			$sql = "select qid,question,description ,c.* from savsoft_qbank q ";
			$sql.= " join savsoft_category c on c.cid =q.cid ";
			//$sql.= " join savsoft_level l on l.lid = q.lid ";
			$sql.= " where q.status=1 and q.deleted =0 and q.type!=3 ";
			$sql.= " and q.qid in ( select question_id from question_tag_rel where tag_id =$tag_id)";
			$sql.= " and q.qid not in ( select qid from savsoft_answer_mcq where uid =$uid)";
			$sql.= " order by q.qid desc  limit $limit offset ". ($limit*$page);
			$data= $this->db->query($sql)->result_array();
			
		    $str_qids="";
			for($i=0; $i<count($data); $i++){
				if($i!=0)
					$str_qids.=",";
				$str_qids.=$data[$i]['qid'];
				
			}
			if($str_qids=="") $str_qids=0;
			 $sqlo = "select * from savsoft_options where qid in ($str_qids)";
		     $ao = $this->db->query($sqlo)->result_array();
			for($i=0; $i<count($data); $i++){
				/*$this->db->where('qid',$data[$i]['qid']);
				$options = $this->db->get('savsoft_options');
				$data[$i]['options']=$options->result_array();*/
				
				$arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $data[$i]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
				$data[$i]['options']=$arr_op;	
				$this->db->where('qid',$data[$i]['qid']);
				$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('qid',$data[$i]['qid']);
				$this->db->where('istrue',1);
				$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('model', 'qbank');
				$this->db->where('content_id', $data[$i]['qid']);
				$this->db->where('status', 1);
				$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where('model','qbank');
				$this->db->where('wall_id',$data[$i]['qid']);
				$this->db->where('parent_id', 0);
				$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
				if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
					$origImageSrc="";
					$imgTags="";	
					$htmlContent=$data[$i]['question'];
					preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
					for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
						
					 }
					 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
					 if($origImageSrc){
						 $data[$i]['img']=$origImageSrc;
						 $data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
					 }
					else{
						$data[$i]['img']="";
						$data[$i]['question']=strip_tags($data[$i]['question']);
					}		 
				}
				
				else{
					$data[$i]['img']="";
				}
				$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
				//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);
				$this->db->where("uid", $uid);
				$this->db->where("model", 'qbank');
				$this->db->where("status", 1);
				$this->db->where("content_id", $data[$i]['qid']);
				$data[$i]['user_liked']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where("content_id", $data[$i]['qid']);
				$this->db->where("model", 'qbank');
				$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
                $data[$i]['link_solved']=site_url('page/question/'.$pl);
				$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
			$dt['questions']=$data;
			header('Content-Type: application/json');
			echo json_encode($dt);
	}
	
	
	function get_mcq_by_category_or_level($cid =0, $lid =0, $limit=10, $page=0){
		   
			$sql="SELECT * FROM savsoft_qbank q
				JOIN savsoft_category c ON c.cid=q.cid
				WHERE (q.type is null or q.type=1)
				AND q.deleted =0
				AND q.status = 1 ";

				
			if($cid>0){	
				$sql.=" AND q.cid = $cid ";
			}
			if($lid>0){
				$sql.=" AND q.lid = $lid ";
			}
			
			$sql.=" ORDER BY q.qid desc LIMIT 10";

			$data= $this->db->query($sql)->result_array();
			$str_qids="";
		    for($i=0; $i<count($data); $i++){
				if($i!=0)
					$str_qids.=",";
				$str_qids.=$data[$i]['qid'];
			
		   }
		   if($str_qids=="") $str_qids=0;
         $sqlo = "select * from savsoft_options where qid in ($str_qids)";
		 $ao = $this->db->query($sqlo)->result_array();
		 log_message("error", $str_qids);
			for($i=0; $i<count($data); $i++){
				/*$this->db->where('qid',$data[$i]['qid']);
				$options = $this->db->get('savsoft_options');
				$data[$i]['options']=$options->result_array();*/
				 $arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $data[$i]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
				$data[$i]['options']=$arr_op;	
				$this->db->where('qid',$data[$i]['qid']);
				$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('qid',$data[$i]['qid']);
				$this->db->where('istrue',1);
				$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('model', 'qbank');
				$this->db->where('content_id', $data[$i]['qid']);
				$this->db->where('status', 1);
				$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where('model','qbank');
				$this->db->where('wall_id',$data[$i]['qid']);
				$this->db->where('parent_id', 0);
				$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
				$htmlContent=$data[$i]['question'];
				if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
					$origImageSrc="";
					$imgTags="";	
					
					preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
					for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
						
					 }
					 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
					 if($origImageSrc){
						 $data[$i]['img']=$origImageSrc;
						 $data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
					 }
					else{
						$data[$i]['img']=base_url("upload/default_image_quiz.png");
						$data[$i]['question']=strip_tags($data[$i]['question']);
					}		 
				}
				
				else{
					$data[$i]['img']=base_url("upload/default_image_quiz.png");
				}
				$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
				//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);
				$this->db->where("uid", $uid);
				$this->db->where("model", 'qbank');
				$this->db->where("status", 1);
				$this->db->where("content_id", $data[$i]['qid']);
				$data[$i]['user_liked']=$this->db->get('savsoft_like')->num_rows();
				$this->db->where("content_id", $data[$i]['qid']);
				$this->db->where("model", 'qbank');
				$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
                $data[$i]['link_solved']=site_url('page/question/'.$pl);
				$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
			$dt['questions']=$data;
			header('Content-Type: application/json');
			echo json_encode($dt);
	}
	
	
	public function get_mcq($limit=5,$page=0){
	    $this->db->select("savsoft_qbank.qid,savsoft_qbank.question,savsoft_qbank.description, ,savsoft_category.*");
		$this->db->where("deleted", 0);
		$this->db->where("status", 1);
		$this->db->where("fun_priory >", 1);
		$this->db->where("type !=", 3);
		$this->db->where("type !=", 2);
		$this->db->limit($limit);	
		$this->db->offset($limit*$page);
		$this->db->order_by('fun_priory DESC,create_date DESC');
		$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
		//$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
		$data= $this->db->get("savsoft_qbank")->result_array();
        $str_qids="";
		for($i=0; $i<count($data); $i++){
			if($i!=0)
				$str_qids.=",";
			$str_qids.=$data[$i]['qid'];
			
		}
		if($str_qids=="") $str_qids=0;
         $sqlo = "select * from savsoft_options where qid in ($str_qids)";
		 $ao = $this->db->query($sqlo)->result_array();
		 

		 for($i=0; $i<count($data); $i++){
			$arr_op = array();
			for($j=0; $j<count($ao); $j++){
				if($ao[$j]['qid']== $data[$i]['qid']){
					array_push($arr_op, $ao[$j]);
				}
			}
			
			$data[$i]['options']=$arr_op;
			$this->db->where('qid',$data[$i]['qid']);
			$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$data[$i]['qid']);
			$this->db->where('istrue',1);
			$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('status', 1);
			$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
			
			$this->db->where('model','qbank');
			$this->db->where('wall_id',$data[$i]['qid']);
			$this->db->where('parent_id', 0);
			$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
			
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
			 if($origImageSrc){
				 $data[$i]['img']=$origImageSrc;
				 $data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
			 }
			else{
				$data[$i]['img']="";
				$data[$i]['question']=strip_tags($data[$i]['question']);
			}		 
			
			$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
			//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);

			$this->db->where("content_id", $data[$i]['qid']);
			$this->db->where("model", 'qbank');
			$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data[$i]['link_solved']=site_url('page/question/'.$pl);
			$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
		$dt['questions']=$data;
		header('Content-Type: application/json');
		echo json_encode($dt);
		
	}
	
	
	public function get_mcq_by_user($limit=5,$page=0,$uid){
		$this->db->where("uid", $uid);
		$user= $this->db->get('savsoft_users')->row_array();
		
		if($user){
			
			
			if($user['interest_cat_ids']==""){
				$this->db->select("qid");
				$this->db->where("uid",$user['uid']);
				$ans_qids= $this->db->get('savsoft_answer_mcq')->result_array();
				$araq=array();
				foreach($ans_qids as $aq){
					array_push($araq, $aq['qid']);
				}
				
				
				
				$this->db->select("savsoft_qbank.qid,savsoft_qbank.question,savsoft_qbank.description, savsoft_category.*");
				$this->db->where("type !=", 3);
				$this->db->where("deleted", 0);
				$this->db->where("status", 1);
				if($araq){
					$this->db->where_not_in('savsoft_qbank.qid',$araq);
				}
				$this->db->limit($limit);	
				$this->db->offset($limit*$page);
				$this->db->order_by('qid DESC');
				$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
				//$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
				$data= $this->db->get("savsoft_qbank")->result_array();
			}
			else{
				$sql= "select count(qid) as count from savsoft_qbank
				       where deleted =0 and status =1 and type!=3 and type!=2 and cid in (".$user['interest_cat_ids'].") and 
					   qid not in (select qid  from savsoft_answer_mcq where uid=".$user['uid'].")";
				$count = $this->db->query($sql)->row_array()['count'];
				if(($page+1)*$limit<=$count){
					$sql= "select q.qid,q.question,q.description,c.* from savsoft_qbank q join savsoft_category c on q.cid=c.cid
				       where deleted =0 and status =1 and type!=3 and type!=2 and q.cid in (".$user['interest_cat_ids'].") and 
					   qid not in (select qid  from savsoft_answer_mcq where uid=".$user['uid'].") 
					   order by qid desc limit $limit offset ".($limit*$page);
					   $data = $this->db->query($sql)->result_array();
				}
				else if($page*$limit > $count){
					$offset = ($limit*$page)-$count;
					$sql= "select q.qid,q.question,q.description,c.* from savsoft_qbank q join savsoft_category c on q.cid=c.cid
				       where deleted =0 and status =1 and type!=3 and type!=2 and q.cid not in (".$user['interest_cat_ids'].") and 
					   qid not in (select qid  from savsoft_answer_mcq where uid=".$user['uid'].") 
					   order by qid desc limit $limit offset ".$offset;
					   $data = $this->db->query($sql)->result_array();
					 
				}
				
		     	else {
					$offset1= $count- ($page*$limit);
				    $sql= "select q.qid,q.question,q.description, c.* from savsoft_qbank q join savsoft_category c on q.cid=c.cid
				       where deleted =0 and status =1 and type!=3 and type!=2 and q.cid in (".$user['interest_cat_ids'].") and 
					   qid not in (select qid  from savsoft_answer_mcq where uid=".$user['uid'].") 
					   order by qid desc limit $limit offset ".$offset1;
					$data1 = $this->db->query($sql)->result_array();
				   $limit1= (($page+1)*$limit)-$count-1;
				   $sql= "select q.qid,q.question,q.description, c.* from savsoft_qbank q join savsoft_category c on q.cid=c.cid
				       where deleted =0 and status =1 and type!=3 and type!=2 and q.cid not in (".$user['interest_cat_ids'].") and 
					   qid not in (select qid  from savsoft_answer_mcq where uid=".$user['uid'].") 
					   order by qid desc limit ".$limit1;
					$data2 = $this->db->query($sql)->result_array();
					$data=$data1+$data2; 
			  } 
				
			}
				
			$str_qids="";
			for($i=0; $i<count($data); $i++){
				if($i!=0)
					$str_qids.=",";
				$str_qids.=$data[$i]['qid'];
				
			}
			if($str_qids=="") $str_qids=0;
			 $sqlo = "select * from savsoft_options where qid in ($str_qids)";
			 $ao = $this->db->query($sqlo)->result_array();
			 

			 for($i=0; $i<count($data); $i++){
				$arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $data[$i]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
				$data[$i]['options']=$arr_op;
				$this->db->where('qid',$data[$i]['qid']);
				$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('qid',$data[$i]['qid']);
				$this->db->where('istrue',1);
				$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				
				$this->db->where('model', 'qbank');
				$this->db->where('content_id', $data[$i]['qid']);
				$this->db->where('status', 1);
				$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
				
				$this->db->where('model','qbank');
				$this->db->where('wall_id',$data[$i]['qid']);
				$this->db->where('parent_id', 0);
				$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
				
				$origImageSrc="";
				$imgTags="";	
				$htmlContent=$data[$i]['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if($origImageSrc){
					 $data[$i]['img']=$origImageSrc;
					 $data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
				 }
				else{
					$data[$i]['img']="";
					$data[$i]['question']=strip_tags($data[$i]['question']);
				}		 
				
				$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
				//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);

				$this->db->where("content_id", $data[$i]['qid']);
				$this->db->where("model", 'qbank');
				$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
				$data[$i]['link_solved']=site_url('page/question/'.$pl);
				$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
					
				}
			
			$dt['questions']=$data;
			
			header('Content-Type: application/json');
			echo json_encode($dt);
		}
		else{
			echo json_encode(array("error"=>"Tài khoản không đúng"));
		}
	}
			
	public function devide_answer_mcq($devide_id, $qid, $oid){
		$this->db->where("devide_id",$devide_id );
		$this->db->where("qid",$qid );
		$n =$this->db->get("devide_answer_mcq")->num_rows();
		if($n==0){
			$this->db->insert("devide_answer_mcq", array("devide_id"=>$devide_id, "qid"=>$qid));
			echo json_encode(array("message"=>"1"));
		}
		else{
			echo json_encode(array("message"=>"0"));
		}
	} 

	public function get_mcq_by_devide($limit=5,$page=0, $devide_id=""){
		$this->db->where("devide_id", $devide_id);
		$devide= $this->db->get('savsoft_devide_interest')->row_array();
		
		if($devide){
			
			
			if($devide['interest_cid']==""){
				$this->db->select("qid");
				$this->db->where("devide_id",$devide_id);
				$ans_qids= $this->db->get('devide_answer_mcq')->result_array();
				$araq=array();
				foreach($ans_qids as $aq){
					array_push($araq, $aq['qid']);
				}
				
				
				
				$this->db->select("savsoft_qbank.qid,savsoft_qbank.question,savsoft_qbank.description, savsoft_category.*");
				$this->db->where("deleted", 0);
				$this->db->where("status", 1);
				$this->db->where("type !=", 3);
				if($araq){
					$this->db->where_not_in('savsoft_qbank.qid',$araq);
				}
				$this->db->limit($limit);	
				$this->db->offset($limit*$page);
				$this->db->order_by('qid DESC');
				$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
				//$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
				$data= $this->db->get("savsoft_qbank")->result_array();
			}
			else{
				$sql= "select count(qid) as count from savsoft_qbank 
				       where deleted =0 and status =1 and type!=3 and type!=2 and cid in (".$devide['interest_cid'].") and 
					   qid not in (select qid  from devide_answer_mcq where devide_id='".$devide_id."')";
				$count = $this->db->query($sql)->row_array()['count'];
				if(($page+1)*$limit<=$count){
					$sql= "select q.qid,q.question,q.description,c.* from savsoft_qbank q join savsoft_category c on q.cid=c.cid
				       where deleted =0 and status =1 and type!=3 and type!=2 and q.cid in (".$devide['interest_cid'].") and 
					   qid not in (select qid  from devide_answer_mcq where devide_id='".$devide_id."') 
					   order by qid desc limit $limit offset ".($limit*$page);
					   $data = $this->db->query($sql)->result_array();
				}
				else if($page*$limit > $count){
					$offset = ($limit*$page)-$count;
					$sql= "select q.qid,q.question,q.description,c.* from savsoft_qbank q join savsoft_category c on q.cid=c.cid
				       where deleted =0 and status =1 and type!=3 and type!=2 and q.cid not in (".$devide['interest_cid'].") and 
					   qid not in (select qid  from devide_answer_mcq where devide_id='".$devide_id."') 
					   order by qid desc limit $limit offset ".$offset;
					   $data = $this->db->query($sql)->result_array();
					 
				}
				
		     	else {
					$offset1= $count- ($page*$limit);
				    $sql= "select q.qid,q.question,q.description,c.* from savsoft_qbank q join savsoft_category c on q.cid=c.cid
				       where deleted =0 and status =1 and type!=3 and type!=2  and q.cid in (".$devide['interest_cid'].") and 
					   qid not in (select qid  from devide_answer_mcq where devide_id='".$devide_id."') 
					   order by qid desc limit $limit offset ".$offset1;
					$data1 = $this->db->query($sql)->result_array();
				   $limit1= (($page+1)*$limit)-$count-1;
				   $sql= "select q.qid,q.question,q.description,c.* from savsoft_qbank q join savsoft_category c on q.cid=c.cid
				       where deleted =0 and status =1 and type!=3 and q.cid not in (".$devide['interest_cid'].") and 
					   qid not in (select qid  from devide_answer_mcq where devide_id='".$devide_id."') 
					   order by qid desc limit ".$limit1;
					$data2 = $this->db->query($sql)->result_array();
					$data=$data1+$data2; 
			  } 
				
			}
		}
        else{
		
			$this->db->select("savsoft_qbank.qid,savsoft_qbank.question,savsoft_qbank.description, savsoft_category.*");
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			$this->db->where("type !=", 3);
			$this->db->limit($limit);	
			$this->db->offset($limit*$page);
			$this->db->order_by('qid DESC');
			$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
			//$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
			$data= $this->db->get("savsoft_qbank")->result_array();
		}		
		$str_qids="";
		for($i=0; $i<count($data); $i++){
			if($i!=0)
				$str_qids.=",";
			$str_qids.=$data[$i]['qid'];
			
		}
		if($str_qids=="") $str_qids=0;
		 $sqlo = "select * from savsoft_options where qid in ($str_qids)";
		 $ao = $this->db->query($sqlo)->result_array();
		 

		 for($i=0; $i<count($data); $i++){
			$arr_op = array();
			for($j=0; $j<count($ao); $j++){
				if($ao[$j]['qid']== $data[$i]['qid']){
					array_push($arr_op, $ao[$j]);
				}
			}
			
			$data[$i]['options']=$arr_op;
			$this->db->where('qid',$data[$i]['qid']);
			$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$data[$i]['qid']);
			$this->db->where('istrue',1);
			$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('status', 1);
			$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
			
			$this->db->where('model','qbank');
			$this->db->where('wall_id',$data[$i]['qid']);
			$this->db->where('parent_id', 0);
			$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
			
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
			 if($origImageSrc){
				 $data[$i]['img']=$origImageSrc;
				 $data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
			 }
			else{
				$data[$i]['img']="";
				$data[$i]['question']=strip_tags($data[$i]['question']);
			}		 
			
			$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
			//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);

			$this->db->where("content_id", $data[$i]['qid']);
			$this->db->where("model", 'qbank');
			$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data[$i]['link_solved']=site_url('page/question/'.$pl);
			$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
		
		$dt['questions']=$data;
		
		header('Content-Type: application/json');
		echo json_encode($dt);
		
	}
	
	public function get_rand_mcq_by_devide($limit=5, $devide_id=""){
		$this->db->where("devide_id", $devide_id);
		$devide= $this->db->get('savsoft_devide_interest')->row_array();
		
		if($devide){		

			$this->db->select("qid");
			$this->db->where("devide_id",$devide_id);
			$ans_qids= $this->db->get('devide_answer_mcq')->result_array();
			$araq=array();
			foreach($ans_qids as $aq){
				array_push($araq, $aq['qid']);
			}
			
			
			
			$this->db->select("savsoft_qbank.qid,savsoft_qbank.question,savsoft_qbank.description, savsoft_category.*");
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			$this->db->where("type !=", 3);
			$this->db->where("type !=", 2);
			if($devide['interest_cid']){
				$this->db->where_in('savsoft_qbank.cid',explode(",",$devide['interest_cid']));
			}
			if($araq){
				$this->db->where_not_in('savsoft_qbank.qid',$araq);
			}
			$this->db->limit($limit);	
			$this->db->order_by('rand()');
			$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
			//$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
			$data= $this->db->get("savsoft_qbank")->result_array();
				
			
			
		}
        else{
		
			$this->db->select("savsoft_qbank.qid,savsoft_qbank.question,savsoft_qbank.description, savsoft_category.*");
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			$this->db->limit($limit);	
			$this->db->order_by('rand()');
			$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
			//$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
			$data= $this->db->get("savsoft_qbank")->result_array();
		}		
		
		
		$str_qids="";
		for($i=0; $i<count($data); $i++){
			if($i!=0)
				$str_qids.=",";
			$str_qids.=$data[$i]['qid'];
			
		}
		if($str_qids=="") $str_qids=0;
		 $sqlo = "select * from savsoft_options where qid in ($str_qids)";
		 $ao = $this->db->query($sqlo)->result_array();
		 

		 for($i=0; $i<count($data); $i++){
			$arr_op = array();
			for($j=0; $j<count($ao); $j++){
				if($ao[$j]['qid']== $data[$i]['qid']){
					array_push($arr_op, $ao[$j]);
				}
			}
			
			$data[$i]['options']=$arr_op;
			$this->db->where('qid',$data[$i]['qid']);
			$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$data[$i]['qid']);
			$this->db->where('istrue',1);
			$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('status', 1);
			$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
			
			$this->db->where('model','qbank');
			$this->db->where('wall_id',$data[$i]['qid']);
			$this->db->where('parent_id', 0);
			$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
			
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
			 if($origImageSrc){
				 $data[$i]['img']=$origImageSrc;
				 $data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
			 }
			else{
				$data[$i]['img']="";
				$data[$i]['question']=strip_tags($data[$i]['question']);
			}		 
			
			$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
			//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);

			$this->db->where("content_id", $data[$i]['qid']);
			$this->db->where("model", 'qbank');
			$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data[$i]['link_solved']=site_url('page/question/'.$pl);
			$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
		
		$dt['questions']=$data;
		
		header('Content-Type: application/json');
		echo json_encode($dt);
		
	}
	
	public function get_rand_mcq_by_user($limit=5, $uid){
		$this->db->where("uid", $uid);
		$user= $this->db->get('savsoft_users')->row_array();
		if($user){		

			$this->db->select("qid");
			$this->db->where("uid",$uid);
			$ans_qids= $this->db->get('savsoft_answer_mcq')->result_array();
			$araq=array();
			foreach($ans_qids as $aq){
				array_push($araq, $aq['qid']);
			}
			
			
			
			$this->db->select("savsoft_qbank.qid,savsoft_qbank.question,savsoft_qbank.description, savsoft_category.*");
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			$this->db->where("type !=", 3);
			$this->db->where("type !=", 2);
			if($user['interest_cat_ids']){
				$this->db->where_in('savsoft_qbank.cid',explode(",",$user['interest_cat_ids']));
			}
			if($araq){
				$this->db->where_not_in('savsoft_qbank.qid',$araq);
			}
			$this->db->limit($limit);	
			$this->db->order_by('rand()');
			$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
			//$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
			$data= $this->db->get("savsoft_qbank")->result_array();
				
			
			
		}
        else{
		
			$this->db->select("savsoft_qbank.qid,savsoft_qbank.question,savsoft_qbank.description, savsoft_category.*");
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			$this->db->limit($limit);	
			$this->db->order_by('rand()');
			$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
			//$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
			$data= $this->db->get("savsoft_qbank")->result_array();
		}		
		
		
		$str_qids="";
		for($i=0; $i<count($data); $i++){
			if($i!=0)
				$str_qids.=",";
			$str_qids.=$data[$i]['qid'];
			
		}
		if($str_qids=="") $str_qids=0;
		 $sqlo = "select * from savsoft_options where qid in ($str_qids)";
		 $ao = $this->db->query($sqlo)->result_array();
		 

		 for($i=0; $i<count($data); $i++){
			$arr_op = array();
			for($j=0; $j<count($ao); $j++){
				if($ao[$j]['qid']== $data[$i]['qid']){
					array_push($arr_op, $ao[$j]);
				}
			}
			
			$data[$i]['options']=$arr_op;
			$this->db->where('qid',$data[$i]['qid']);
			$data[$i]['count_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$data[$i]['qid']);
			$this->db->where('istrue',1);
			$data[$i]['count_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('status', 1);
			$data[$i]['like_count']=$this->db->get('savsoft_like')->num_rows();
			
			$this->db->where('model','qbank');
			$this->db->where('wall_id',$data[$i]['qid']);
			$this->db->where('parent_id', 0);
			$data[$i]['comment_count'] =$this->db->get('posts')->num_rows();
			
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
			 if($origImageSrc){
				 $data[$i]['img']=$origImageSrc;
				 $data[$i]['question']=' <img src="'.$origImageSrc.'" >'.strip_tags($data[$i]['question']);
			 }
			else{
				$data[$i]['img']="";
				$data[$i]['question']=strip_tags($data[$i]['question']);
			}		 
			
			$data[$i]['img_category']=base_url("upload/symbol/".$data[$i]['cid'].".png");
			//$data[$i]['time_ago']=$this->api_model->time_ago($data[$i]['create_date']);

			$this->db->where("content_id", $data[$i]['qid']);
			$this->db->where("model", 'qbank');
			$pl = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data[$i]['link_solved']=site_url('page/question/'.$pl);
			$data[$i]['link_notsolved']=site_url('page/question/'.$pl.'/notsolved');
				
			}
		
		$dt['questions']=$data;
		
		header('Content-Type: application/json');
		echo json_encode($dt);
		
	}
	
	
	function get_answered_mcq_by_device($limit=5,$page=0, $device_id=""){
		$sql = "select q.qid, q.question,q.description, d.create_date as time, 1 as status from devide_answer_mcq d join savsoft_qbank q on d.qid= q.qid where devide_id = '$device_id'
		       order by d.create_date desc limit $limit offset ".($page*$limit);
		$data = $this->db->query($sql)->result_array();
		for($i=0; $i<count($data); $i++){
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
			 if($origImageSrc){
				 $data[$i]['img']=$origImageSrc;
				
			 }
			else{
				$data[$i]['img']=base_url("upload/default_image_quiz.png");
				
			}		 
			$data[$i]['question']=strip_tags($data[$i]['question']);
		}
		echo json_encode($data);
			
	}

	function get_answered_mcq_by_user($limit=5,$page=0, $uid){
		$sql = "select q.qid, q.question,q.description, a.create_date as time, a.istrue as status from savsoft_answer_mcq a join savsoft_qbank q on a.qid= q.qid where uid = $uid
		        order by a.create_date desc limit $limit offset ".($page*$limit);
		$data = $this->db->query($sql)->result_array();
		for($i=0; $i<count($data); $i++){
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
			 if($origImageSrc){
				 $data[$i]['img']=$origImageSrc;
				
			 }
			else{
				$data[$i]['img']=base_url("upload/default_image_quiz.png");
				
			}		 
			$data[$i]['question']=strip_tags($data[$i]['question']);
		}
		echo json_encode($data);
			
	}
	
	
	function get_answered_quiz_by_user($limit=5,$page=0, $uid){
		$sql = "select q.quid,q.qids, q.quiz_name, q.description, r.result_status as status, FROM_UNIXTIME(r.end_time, '%Y-%m-%d %H:%i:%s') as time
		       from savsoft_result r join savsoft_quiz q on r.quid= q.quid where r.uid= $uid and r.result_status!='Open'
		       order by r.rid desc limit $limit offset ".($page*$limit);
		$data = $this->db->query($sql)->result_array();
		for($i=0; $i<count($data); $i++){
			$data[$i]['img']=base_url("upload/default_image_quiz.png");
			$sql = "select question from savsoft_qbank where qid in ( ".$data[$i]['qids'].")";
			$q= $this->db->query($sql)->row_array();
			$htmlContent=$q['question'];
			if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
				 $origvidSrc="";
				 
				 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if($origImageSrc)
					$data[$i]['img']=$origImageSrc;
					
				}
		  } 
		echo json_encode($data);
	}
	
	
	function get_quiz($limit=5, $page=0) {
		$this->db->where("deleted", 0);
		$this->db->where("status", 1);
		$this->db->where("noq >", 4);
		$this->db->limit($limit);
		$this->db->offset($limit*$page);
		$this->db->order_by("quid desc");
		$data= $this->db->get("savsoft_quiz")->result_array();

		for($i=0; $i<count($data); $i++){
			$data[$i]['img']=base_url("upload/default_image_quiz.png");
			$sql = "select question from savsoft_qbank where qid in ( ".$data[$i]['qids'].")";
			$q= $this->db->query($sql)->row_array();
			$htmlContent=$q['question'];
			if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
				 $origvidSrc="";
				 
				 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if($origImageSrc)
					$data[$i]['img']=$origImageSrc;
					
				}
		  } 
		echo json_encode($data);
	}
	
	
	
	function get_quiz_by_user($limit=5, $page=0,$uid) {
		$this->db->where("uid", $uid);
		$user= $this->db->get("savsoft_users")->row_array();
		if($user){
			$sql = "select * from savsoft_quiz where deleted=0 and status=1 and noq > 4 ";
            if($user['interest_cat_ids']!="") 
				$sql.=" and ( cid in (".$user['interest_cat_ids'] .") or  cid=0) ";
			$sql.= " order by quid desc limit $limit offset ". ($limt*$offset);
			$data= $this->db->query($sql)->result_array();

			for($i=0; $i<count($data); $i++){
				$data[$i]['img']=base_url("upload/default_image_quiz.png");
				$sql = "select question from savsoft_qbank where qid in ( ".$data[$i]['qids'].")";
				$q= $this->db->query($sql)->row_array();
				$htmlContent=$q['question'];
				if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
					 $origvidSrc="";
					 
					 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
					 for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
						
					 }
					 if($origImageSrc)
						$data[$i]['img']=$origImageSrc;
						
					}
			  } 
		}
		echo json_encode($data);
	}
	
	
	function get_quiz_by_devide($limit=5, $page=0, $devide_id="") {
		$this->db->where("devide_id", $devide_id);
		$devide= $this->db->get("savsoft_devide_interest")->row_array();
		if($devide){
			$sql = "select * from savsoft_quiz where deleted=0 and status=1 and noq > 4 ";
            if($devide['interest_cid']!="") 
				$sql.=" and ( cid in (".$devide['interest_cid'] .") or  cid=0) ";
			$sql.= " order by quid desc limit $limit offset ". ($limt*$offset);
			$data= $this->db->query($sql)->result_array();
        }
		else{
			$sql = "select * from savsoft_quiz where deleted=0 and status=1 and noq > 4 ";
			$sql.= " order by quid desc limit $limit offset ". ($limt*$offset);
			$data= $this->db->query($sql)->result_array();
		}
		for($i=0; $i<count($data); $i++){
			$data[$i]['img']=base_url("upload/default_image_quiz.png");
			$sql = "select question from savsoft_qbank where qid in ( ".$data[$i]['qids'].")";
			$q= $this->db->query($sql)->row_array();
			$htmlContent=$q['question'];
			if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
				 $origvidSrc="";
				 
				 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 if($origImageSrc)
					$data[$i]['img']=$origImageSrc;
					
				}
		  } 
		
		echo json_encode($data);
	}
	 

	function get_library($limit=5, $page=0 ){
		$sql ="select * from savsoft_library where content not like '%facebook%' order by lib_id desc limit  ". $limit." offset ".($offset*$limit);
		$lib = $this->db->query($sql)->result_array();
		for($i=0; $i<count($lib); $i++){
			preg_match('/src="([^"]+)"/', $lib[$i]['content'], $match);
			$lib[$i]['link'] = $match[1];
			if(strpos($lib[$i]['link'],'youtube')!==false && $lib[$i]['cid']==29){
				$vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
				$lib[$i]['link']="https://www.youtube.com/watch?v=".$vid;
					
		    }
			if(strpos($lib[$i]['link'],'facebook')!==false){
				$start = strpos($lib[$i]['link'],"href=");
				$end = strpos($lib[$i]['link'],"&amp;");
				$lib[$i]['link']= substr($lib[$i]['link'],$start+5,$end-$start-5);
				$lib[$i]['link']=str_replace("%3A",":",$lib[$i]['link']);
				$lib[$i]['link']=str_replace("%2F","/",$lib[$i]['link']);
			}
		}
		echo json_encode($lib);
		
	}

	function get_user_interest($uid){
		$this->db->where("uid", $uid);
		$user=$this->db->get("savsoft_users")->row_array();
		if($user){
			if($user['interest_cat_ids']){
				$sql= 'select *, CONCAT("https://stemup.app/upload/symbol/",cid,".png") AS img, 1 as status, 0 as isnew from savsoft_category where cid in ('.$user['interest_cat_ids'].')
					   union
					   select *, CONCAT("https://stemup.app/upload/symbol/",cid,".png") AS img, 0 as status, 0 as isnew  from savsoft_category where cid not in ('.$user['interest_cat_ids'].')
					   ORDER BY cid asc';
			}
			else{
				$sql= ' select *, CONCAT("https://stemup.app/upload/symbol/",cid,".png") AS img, 0 as status, 0 as isnew  from savsoft_category ORDER BY cid asc';
			}
			$data = $this->db->query($sql)->result_array();
		
		}
		else
			$data = array("message"=>"Tài khoản không tồn tại");
		echo json_encode($data);
	}
		
	function set_user_interest($uid){
		$this->db->where("uid", $uid);
		$d=$this->db->get("savsoft_users")->row_array();
		if($d){
			
			$data = json_decode($this->input->raw_input_stream,true);
			
			if($data){
				$strstt="";
				foreach($data as $k=>$dt){
					if($dt=="true"){
						if($strstt!=""){
							$strstt.=",";
						}
						$strstt.=($k+3);
					}
					
					
				}
				
				
				
				$this->db->where("uid", $uid);
				$this->db->update("savsoft_users", array("interest_cat_ids"=>$strstt));
				echo json_encode(array("message"=>"success"));				
				
			}
			else{
				echo json_encode(array("message"=>"error: định dạng json không đúng"));
			}
			/*if($data){
				$strstt="";
				foreach($data as $dt){
					if($dt['status']==1){
						if($strstt!=""){
							$strstt.=",";
						}
						$strstt.=$dt['cid'];
					}
				}
				
				$this->db->where("devide_id", $devide_id);
				$this->db->update("savsoft_devide_interest", array("interest_cid"=>$strstt));
				echo json_encode(array("message"=>"success"));
			}
			else{
				echo json_encode(array("message"=>"error: định dạng json không đúng"));
			}*/
		}
		else{
			echo json_encode(array("message"=>"error:  uid không đúng"));
		}
	}
	
	
	
	function get_devide_interest($devide_id){
		$this->db->where("devide_id", $devide_id);
		$d=$this->db->get("savsoft_devide_interest")->row_array();
		if($d){
			if($d['interest_cid']){
				$sql= 'select *, CONCAT("https://stemup.app/upload/symbol/",cid,".png") AS img, 1 as status, 0 as isnew from savsoft_category where cid in ('.$d['interest_cid'].')
					   union
					   select *, CONCAT("https://stemup.app/upload/symbol/",cid,".png") AS img, 0 as status, 0 as isnew  from savsoft_category where cid not in ('.$d['interest_cid'].')
					   ORDER BY cid asc';
			}
			else{
				$sql= ' select *, CONCAT("https://stemup.app/upload/symbol/",cid,".png") AS img, 0 as status, 0 as isnew  from savsoft_category ORDER BY cid asc';
			}
			
		}
		else{
			$this->db->insert("savsoft_devide_interest", array("devide_id"=>$devide_id));
			$sql= ' select *, CONCAT("https://stemup.app/upload/symbol/",cid,".png") AS img, 0 as status, 0 as isnew  from savsoft_category ORDER BY cid asc';
		}
		$data = $this->db->query($sql)->result_array();
		echo json_encode($data);
	}
	
	
	
	function set_devide_interest($devide_id){
		$this->db->where("devide_id", $devide_id);
		$d=$this->db->get("savsoft_devide_interest")->row_array();
		if($d){
			
			$data = json_decode($this->input->raw_input_stream,true);
			
			if($data){
				$strstt="";
				
				foreach($data as $k=>$dt){
					if($dt=="true"){
						if($strstt!=""){
							$strstt.=",";
						}
						$strstt.=($k+3);
					}
					
					
				}

				
				$this->db->where("devide_id", $devide_id);
				$this->db->update("savsoft_devide_interest", array("interest_cid"=>$strstt));
				echo json_encode(array("message"=>"success"));				
				//log_message('error', json_encode($data));
			}
			else{
				echo json_encode(array("message"=>"error: định dạng json không đúng"));
			}
			/*if($data){
				$strstt="";
				foreach($data as $dt){
					if($dt['status']==1){
						if($strstt!=""){
							$strstt.=",";
						}
						$strstt.=$dt['cid'];
					}
				}
				
				$this->db->where("devide_id", $devide_id);
				$this->db->update("savsoft_devide_interest", array("interest_cid"=>$strstt));
				echo json_encode(array("message"=>"success"));
			}
			else{
				echo json_encode(array("message"=>"error: định dạng json không đúng"));
			}*/
		}
		else{
			echo json_encode(array("message"=>"error: devide id không đúng"));
		}
	}
	
	function get_children($uid){
		$sql = "select uid,email,birthdate, first_name, class_name, photo as avatar, school as schoolid, null as school,null as city,null as county,null as ward, class_name, grade from savsoft_users where parent_id= $uid or parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid'";
		$data= $this->db->query($sql)->result_array();
		foreach($data as $k=>$d){
			
			$data[$k]['grade_name'] ="Lớp ".($d['grade']-2);
			if(!$d['avatar']){
				$data[$k]['avatar']=base_url('/upload/avatar/default.png');
			}
			
	       
			if($d['schoolid']){
				$this->db->where("schoolid", $d['schoolid']);
				$datas=$this->db->get("school")->row_array();
				$data[$k]['school']=$datas['school_name'];
				$this->db->where("did", $datas['tinh_thanh']);
				$data[$k]['city']= $this->db->get("savsoft_dataitem")->row_array()['dataitem_name'];
				$this->db->where("did", $datas['quan_huyen']);
				$data[$k]['county']= $this->db->get("savsoft_dataitem")->row_array()['dataitem_name'];
				$this->db->where("did", $datas['phuong_xa']);
				$data[$k]['ward']= $this->db->get("savsoft_dataitem")->row_array()['dataitem_name'];
			}
			
		}
		echo json_encode($data);
	}
	
	function get_children2($uid){
		$sql = "select uid,email,birthdate, first_name, class_name, photo as avatar, school as schoolid, null as school,null as city,null as county,null as ward, class_name, grade from savsoft_users where user_status='Active' and parent_id=$uid or parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid'";
		$data= $this->db->query($sql)->result_array();
		foreach($data as $k=>$d){
			
			$data[$k]['grade_name'] ="Lớp ".($d['grade']-2);
			if(!$d['avatar']){
				$data[$k]['avatar']=base_url('/upload/avatar/default.png');
			}
			
	       
			if($d['schoolid']){
				$this->db->where("schoolid", $d['schoolid']);
				$datas=$this->db->get("school")->row_array();
				$data[$k]['school']=$datas['school_name'];
				$this->db->where("did", $datas['tinh_thanh']);
				$data[$k]['city']= $this->db->get("savsoft_dataitem")->row_array()['dataitem_name'];
				$this->db->where("did", $datas['quan_huyen']);
				$data[$k]['county']= $this->db->get("savsoft_dataitem")->row_array()['dataitem_name'];
				$this->db->where("did", $datas['phuong_xa']);
				$data[$k]['ward']= $this->db->get("savsoft_dataitem")->row_array()['dataitem_name'];
			}
			
		}
		echo json_encode($data);
	}
	
	
	
	function get_category_list(){
		$sql = "select * from savsoft_category";
		$data= $this->db->query($sql)->result_array();
		foreach($data as $k=>$d){
			$data[$k]['img']=base_url('/upload/symbol/'.$d['cid'].'.png');
			
		}
		echo json_encode($data);
	}
	
	function get_level_list(){
		$sql = "select * from savsoft_level where lid<16";
		$data= $this->db->query($sql)->result_array();
		echo json_encode($data);
	}
	
	function get_grade_list($uid=0){
		if($uid>0){
			$sql = "select grade from savsoft_users where uid=$uid";
			$us=$this->db->query($sql)->row_array();
			if($us){
				$sql = "select lid,level_name as grade  from savsoft_level where lid<15";
				$data= $this->db->query($sql)->result_array();
				foreach($data as $k=> $d){
					$data[$k]['status']=0;
					if($d['lid']==$us['grade']){
						$data[$k]['status']=1;
					}
				}
				echo json_encode($data);
			}
			else{
				echo json_encode(array("message"=>"error: Tài khoản không tồn tại" ));
			}
		}
		else{
			$sql = "select lid,level_name as grade  from savsoft_level where lid<15";
			$data= $this->db->query($sql)->result_array();
			foreach($data as $k=> $d){
				$data[$k]['status']=0;
			}
			echo json_encode($data);
		}
	}
	
	function get_subject_list($uid, $grade){
		
		$sql = "select grade,assign_categories from savsoft_users where uid=$uid";
		$us=$this->db->query($sql)->row_array();
		
		log_message("error", $us['grade'].".................".$grade);
		if($us){
			if($us['grade']==$grade){
				$this->db->where("lid",$us['grade']);
				$cids=$this->db->get("level_category")->row_array()['cids'];
				$sql = "select cid, category_name as subject from demo_savsoft_category where cid in ($cids)";
				$data= $this->db->query($sql)->result_array();
				foreach($data as $k=> $d){
					$data[$k]['status']=0;
					if($us['assign_categories']){
						if(in_array($d['cid'],explode(",",$us['assign_categories']))){
							$data[$k]['status']=1;
						}
					}
				}
			}
			else{
				$this->db->where("lid",$grade);
				$cids=$this->db->get("level_category")->row_array()['cids'];
				$sql = "select cid, category_name as subject from demo_savsoft_category where cid in ($cids)";
				$data= $this->db->query($sql)->result_array();
				foreach($data as $k=> $d){
					$data[$k]['status']=1;
				}
			}
			echo json_encode($data);
		}
		else{
			echo json_encode(array("message"=>"error: Tài khoản không tồn tại" ));
		}
		
		
	}
	
	//tesst
	function get_subject_list2($uid, $grade){
		
		$sql = "select grade,assign_categories,read_fun from savsoft_users where uid=$uid";
		$us=$this->db->query($sql)->row_array();
		
		if($us){
			if($us['grade']==$grade){
				$this->db->where("lid",$us['grade']);
				$cids=$this->db->get("level_category")->row_array()['available_cids'];
				$sql = "select cid, category_name as subject from demo_savsoft_category where cid in ($cids)";
				$data= $this->db->query($sql)->result_array();
				foreach($data as $k=> $d){
					$data[$k]['status']=0;
					if($us['assign_categories']){
						if(in_array($d['cid'],explode(",",$us['assign_categories']))){
							$data[$k]['status']=1;
						}
					}
				}
			}
			else{
				$this->db->where("lid",$grade);
				$cids=$this->db->get("level_category")->row_array()['available_cids'];
				$sql = "select cid, category_name as subject from demo_savsoft_category where cid in ($cids)";
				$data= $this->db->query($sql)->result_array();
				foreach($data as $k=> $d){
					$data[$k]['status']=1;
				}
			}
			$crids= explode(",", $us['read_fun']);
			$sql = "select * from category_reading";
			$data2 =$this->db->query($sql)->result_array();
			foreach($data2 as $k=> $d){
				if(in_array($d['crid'],$crids)){
					$data2[$k]['status']=1;
				}
				else
					$data2[$k]['status']=0;
			}
			
			$result= array("subject"=>$data, "reading"=>$data2);
			echo json_encode($result);
		}
		else{
			echo json_encode(array("message"=>"error: Tài khoản không tồn tại" ));
		}
		
		
	}
	
	
	function set_subject($uid, $grade=8){
		$this->db->where("uid", $uid);
		$user=$this->db->get("savsoft_users")->row_array();
		$this->db->where("lid", $grade);
		$cl = $this->db->get("level_category")->row_array()["cids"];
		$cl_arr= explode(",", $cl);
		if($user){
			$data = json_decode($this->input->raw_input_stream,true);
			/*log_message("error","+++++++++++++++++++" );
			log_message("error",$this->input->raw_input_stream );
			log_message("error","+++++++++++++++++++" );*/
			
			if($data){
				$strstt="";
				foreach($data as $k=>$dt){
					if($dt=="true"){
						if($strstt!=""){
							$strstt.=",";
						}
						$strstt.=$cl_arr[$k];
					}
					
					
				}
				
				if($strstt==""){
					if($user['grade']!=$grade)
						$strstt=$cl;
				    else
						$strstt=$user['assign_categories'];
				}
				
				$this->db->where("uid", $uid);
				$this->db->update("savsoft_users", array("grade"=>$grade,"assign_categories"=>$strstt));
				
				echo json_encode(array("message"=>"success"));				
				
			}
			else{
				echo json_encode(array("message"=>"error: định dạng json không đúng"));
			}
		}
		else{
			
		}
	}
	
	function set_subject2($uid, $grade=8){
		$this->db->where("uid", $uid);
		$user=$this->db->get("savsoft_users")->row_array();
		$this->db->where("lid", $grade);
		$cl = $this->db->get("level_category")->row_array()["available_cids"];
		$cl_arr= explode(",", $cl);
		if($user){
			$data_all = json_decode($this->input->raw_input_stream,true);
			log_message("error","+++++++++++++++++++" );
			log_message("error",$this->input->raw_input_stream );
			log_message("error","+++++++++++++++++++" );
			$data=$data_all['subject'];
			$datard=$data_all['reading'];
			if($data_all){
				$strstt="";
				foreach($data as $k=>$dt){
					if($dt=="true"){
						if($strstt!=""){
							$strstt.=",";
						}
						$strstt.=$cl_arr[$k];
					}
					
					
				}
				
				if($strstt==""){
					$strstt=$cl;
				}
				
				$this->db->where("uid", $uid);
		     	$this->db->update("savsoft_users", array("grade"=>$grade,"assign_categories"=>$strstt));
				
				
				$strstt2="";
				foreach($datard as $k=>$dt){
					if($dt=="true"){
						if($strstt2!=""){
							$strstt2.=",";
						}
						$strstt2.=$k+1;
					}
					
					
				}
				
				if($strstt2==""){
					$strstt2="1,2,3,4,5,6,7";
				}
				
				$this->db->where("uid", $uid);
				$this->db->update("savsoft_users", array("grade"=>$grade,"assign_categories"=>$strstt, "read_fun"=>$strstt2));
				
				echo json_encode(array("message"=>"success"));				
				
			}
			else{
				$this->db->where("uid", $uid);
				$this->db->update("savsoft_users", array("grade"=>$grade, "assign_categories"=>$cl));
				echo json_encode(array("message"=>"success"));		
			}
		}
		else{
			
		}
	}
	
	function get_history_hcc_assign_quiz($parent,$childid,$page=0){
		$limit=1;
		$res= array();
		$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
		$arlv = ["Ngắn","Vừa", "Dài"];
		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",'12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'GDCD','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học');
		
		$sql = "select distinct day from savsoft_assign a join savsoft_quiz q on a.quid=q.quid where a.auid= $parent and a.uid= $childid and level_hard in (1,2,3) order by day desc limit $limit offset ".($page*$limit) ;
		$days=$this->db->query($sql)->result_array();
		
		foreach($days as $i=>$day){
			$sql = "select * from savsoft_assign a join savsoft_quiz q on a.quid=q.quid where a.auid= $parent and a.uid= $childid and level_hard in (1,2,3) and day='".$day['day']."' order by a.id desc";
			$data["date"]=$ardow[date('w',strtotime($day['day']))].", ".date("d / m", strtotime($day['day']));
			$quizs=$this->db->query($sql)->result_array();
			//$data['assignments']= array();
			
			foreach($quizs as $k=>$quiz){
				
				$message_do="";
				if($quiz['rid']){
					$this->db->where("rid",$quiz['rid']);
					$per=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
					$message_do="Đã làm: ".number_format($per,0)."%";
				}
				$data['assignments'][$k]['level']=$arlv[$quiz['level_hard']-1];
				
				$sql = "select question,cid from savsoft_qbank where qid in (".$quiz['qids'].")";
				$questions  = $this->db->query($sql)->result_array();
				$cid_nm= array();
				$cid_ar_nm= array();
				$question_nm= array();
				$img_nm=array();
				foreach($questions as $q){
					if(!in_array($q['cid'],$cid_nm)){
						array_push($cid_nm,$q['cid']);
						array_push($cid_ar_nm,array());
					}
				}
				foreach($questions as $q){
					$origImageSrc="";
					$imgTags="";	
					$htmlContent=$q['question'];
					preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
					for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
						
					 }
					 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
					 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
						$img=$origImageSrc;
					 }
					 else{
						
						$img=base_url("/upload/default_image_quiz.png");
					 }			 
					array_push($img_nm, array("url"=>$img)); 
					$index=array_search($q['cid'],$cid_nm);
					array_push($cid_ar_nm[$index], array("title"=>strip_tags($q['question'])));						
					
				}
				foreach($cid_ar_nm as $j=>$d){
					array_push($question_nm, array("subject"=>$array_map[$cid_nm[$j]],"question"=>$d)); 
				}
				
				$qz= array(
				       "quid"=>$quiz['quid'],
					   "total_points"=>$quiz['price'],
					   'number_question'=>$quiz['noq'],
					   "status"=>1,
					   "message_do"=>$message_do,
					   "rid"=>$quiz['rid'],
					   "question"=>$question_nm,
					   
				     );

				$data['assignments'][$k]['quiz']=$qz;
				
				
				$rquestion= array();
				$link_rd= null;
				if($quiz['reading_mcq']){
					$sql = "select question, source from savsoft_qbank where qid in (".$quiz['reading_mcq'].")";
					$rqdt = $this->db->query($sql)->result_array();
					foreach($rqdt as $q){
						array_push($rquestion, array("title"=>strip_tags($q['question'])));
						$link_rd = $q['source'];
					}
					
				}
				
				$vquestion= array();
				if($quiz['reading_mcq']){
					$sql = "select question from savsoft_qbank where qid in (".$quiz['video_mcq'].")";
					$vqdt = $this->db->query($sql)->result_array();
					foreach($vqdt as $q){
						array_push($vquestion, array("title"=>strip_tags($q['question'])));
					}
				}
				$link_video=null;
				if($quiz['img_video']){
					$vid = str_replace("https://img.youtube.com/vi/","",$quiz['img_video']);
					$vid= str_replace("/mqdefault.jpg","",$vid);
					$link_video = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
				}
				$reading=array( "link"=> $link_rd,
								"question"=> $rquestion,
								"img"=> $quiz['img_reading'],
								"title"=> $quiz['reading_title']
								);
				$data['assignments'][$k]['reading']=$reading;
				
				$video = array( "video"=> $link_video,
								"question"=>$vquestion,
								"img"=> $quiz['img_video'],
								"title"=>$quiz['video_title']);
				$data['assignments'][$k]['video']=$video;
				
			}
			
			array_push($res,$data);
		}
		
	
		echo json_encode($res);

		
	}

	function view_hcc_quiz($type){		
		$inp =  json_decode($_POST["json"],true);

		$questions= $inp['assignments'][$type];
		$today= date("d-m-Y", strtotime("0 day"));
		$arlv = ["Ngắn","Vừa", "Dài"];
		$quiz['quiz_name']="Bài học cùng con ngày ".$today." - ".$arlv[$type];
		$quiz['qids']="";
		$quiz['noq']=$questions['number_question'];
		unset($questions['number_question']);
		
		foreach($questions['quiz'] as $qs){
			foreach($qs['questions'] as $q){
				if($quiz['qids']!=""){
					$quiz['qids'].=",";
				}
				$quiz['qids'].=$q['qid'];
			}
		}
		
		$qidsz = $inp['info'][$type]['qids'];
		$vqidsz="";
		foreach($inp['info'][$type]['video']['question'] as $qq){
			
			if($vqidsz){
				$vqidsz.=",";
			}
			$vqidsz.=$qq["qid"];
			
		}
		$rqidsz="";
		foreach($inp['info'][$type]['reading']['question'] as $qq){
			if($rqidsz){
				$rqidsz.=",";
			}
			$rqidsz.=$qq["qid"];
			
		}
		
		$qidsz.=",".$rqidsz.",".$vqidsz;
		log_message("error","..................".$qidsz);
		
		$sqlo= "Select oid,qid,q_option,score from savsoft_options where qid in(".$qidsz.")";
		$option_arr=$this->db->query($sqlo)->result_array();
		$sqlqt= "Select question,qid from savsoft_qbank where qid in(".$qidsz.")";
		$qts=$this->db->query($sqlqt)->result_array();
		foreach($questions['quiz'] as $i=>$qs){
			foreach($qs['questions'] as $j=>$q){
				$option = array();
				foreach($option_arr as $o){
					if($o['qid']==$q['qid']){
						array_push($option, $o);
					}
				}
				$questions['quiz'][$i]['questions'][$j]['options']=$option;
				foreach($qts as $qt){
					if($qt['qid']==$q['qid']){
						$questions['quiz'][$i]['questions'][$j]['question']=$qt['question'];
					}
				}
			}
			
		}
		$rddt=$inp['assignments'][$type]["reading"];
		
		$sql = "select * from reading_material where link= '".$rddt["link"]."'";
		$rdct =$this->db->query($sql)->row_array();
		
		foreach($rddt['question'] as $k=>$q){
			foreach($qts as $qt){
				if($qt['qid']==$q['qid']){
					$rddt['question'][$k]['question']=$qt['question'];
				}
			 }
			 unset($rddt['question'][$k]['title']);
			$rddt['question'][$k]['options']=array();
			foreach($option_arr as $o){
				if($o['qid']==$q['qid']){
					array_push($rddt['question'][$k]['options'], $o);
				}
			}
		}
		
		$reading= array(
		                "questions"=>$rddt['question'],
		                "link"=>$rddt["link"],
		                "content"=>$rdct['content'],
		                "title"=>$rddt["title"]
					);
						
		
		$vddt=$inp['assignments'][$type]["video"];
		
		foreach($vddt['question'] as $k=>$q){
			$vddt['question'][$k]['question']=$vddt['question'][$k]['title'];
			unset($vddt['question'][$k]['title']);
			$vddt['question'][$k]['options']=array();
			foreach($option_arr as $o){
				if($o['qid']==$q['qid']){
					array_push($vddt['question'][$k]['options'], $o);
				}
			}
		}
		
		$video=array(
					"questions"=>$vddt['question'],
		            "link"=>$vddt['video'],
		            "title"=>$vddt['title']
					);
		            

		
		unset($questions['reading']);
		unset($questions['video']);
		$r = array(
		        "info"=>$inp['info'],
		        "grade"=>$inp['grade'],
				"quiz"=>$quiz,
				"questions"=>$questions,
				"reading"=>$reading,
				"video"=>$video
			 );
		
		echo json_encode($r);
	
		
		
	}
	
	///phai test ki
	function assign_hcc_quiz(){
		
	    $connection_key=$_POST["connection_key"];
		//$quid = $_POST["quid"];
		$uid = $_POST["uid"];
		$startdate = $_POST["startdate"];
		$enddate = $_POST["enddate"];
		$reward= $_POST["reward"];
		$json=$_POST["json"];
		$type=$_POST["type"];
		
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
			$data['result'] = "Not connected.";
			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			
			$sql = "select grade,assign_categories from savsoft_users where uid=$uid";
			$child=$this->db->query($sql)->row_array();
			if($child){
				$today= date("Y-m-d", strtotime("0 day"));
				$today2= date("d-m-Y", strtotime("0 day"));
				$arlv = ["Ngắn","Vừa", "Dài"];
				$quiz_name="Bài học cùng con ngày ".$today2." - ".$arlv[$type];
				
				
				$inp =  json_decode($json,true);
				$inf= $inp['info'][$type];
				$qids=$inf['qids'];
				$noq=count(explode(",",$qids));
				$today2= date("Y-m-d", strtotime("0 day"));
				$lid=$inp['grade'];	
				
				$reading_mcq="";
				foreach($inf['reading']['question'] as $q){
					if($reading_mcq!=""){
						$reading_mcq.=",";
					}
					$reading_mcq.=$q['qid'];
				}
				$video_mcq="";
				foreach($inf['video']['question'] as $q){
					if($video_mcq!=""){
						$video_mcq.=",";
					}
					$video_mcq.=$q['qid'];
				}
				$sql="select content from reading_material where link='".$inf['reading']['link']."'";
				$reading =$this->db->query($sql)->row_array()['content'];
				$reading_title=$inf['reading']['title'];
				$img_reading=$inf['reading']['img'];
				$video_title=$inf['video']['title'];
				$img_video=$inf['video']['img'];
				
				$quid= $this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,0, $today,$lid,$type+1,null,1,$reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
				
				if($this->api_model->assignQuizApi2($user, $quid, $uid, $startdate, $enddate,$reward)){
					$data['result'] = "success";
					$this->load->library('Curl');
					
					$this->db->where("uid", $uid);
					$this->db->where("app", 'do');
					$tk=$this->db->get('user_token_fcm')->result_array();
					foreach($tk as $t){
						$ch = curl_init();
						$to = $t['fcm_token'];
						log_message("error", "****************************Giao bài ".$to." ".$uid." ".$t['diviceid']);
						$a= array( "content_available"=> true,
								  "notification"=> array(
										 "title"=> "Bài được giao",
										  "body"=> "Bạn vừa được giao một bài, hãy mở ứng dụng STEMUP Học sinh để làm bài!",
										  "content_available"=> true,
										   "sound"=> "default"
								 ),
								"data"=> array("id"=>0),
								"to"=> $to);
						$inp= json_encode($a);
						
						curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $inp);
						curl_setopt($ch, CURLOPT_POST, 1);
						
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							 "Authorization: key=AAAA0dc6mvY:APA91bEzamAftWvYzwTW7sRf7G7RxYsCtNmjrKLjfTXVbtZFNyKME0C4TM1cEoQMSh_ja9dURjs9WecjZCD1yW0nPK0Hhp6t1D20n96ZcVKsdWbNiJBDjEg5QRTYQFGAoNsHvJcQmcs1",
							"Content-Type: application/json"
							));

						$result = curl_exec($ch);
						if (curl_errno($ch)) {
							echo 'Error:' . curl_error($ch);
						}
						curl_close ($ch);
						
					}

				}else{
					$data['result'] = "Cannot assign for user.";
				}
		
				
				
				
			}
			/*else{
				$data['result'] = "Childid not exist.";
				header('Content-Type: application/json');
				echo json_encode($data);
			}*/
			
		
		}
		
		header('Content-Type: application/json');
		echo json_encode($data);
		
		
		
		
		
		
	}

    #stored
	function new_hcc_assign_quiz1($parent,$childid){
		$sql = "select grade,assign_categories from savsoft_users where uid=$childid";
		$child=$this->db->query($sql)->row_array();
		if($child){
			$ac= $child['assign_categories'];
			$grade=$child['grade'];
			
			$this->db->where("lid",$grade);
			$grade_name= $this->db->get("savsoft_level")->row_array()['level_name'];
			$sqlc=  "select cid,category_name from savsoft_category where cid in ($ac) ";
			
			
			$sqlce= $sqlc."order by rand() limit 1";
			$sqlcn= $sqlc."order by rand() limit 2";
			$sqlch= $sqlc."order by rand() limit 3";
			
			$cate_es= $this->db->query($sqlce)->result_array();
			$cate_nm= $this->db->query($sqlcn)->result_array();
			$cate_ha= $this->db->query($sqlch)->result_array();
			
			$quiz_es=array();
			$quiz_nm=array();
			$quiz_ha=array();
			$point_es=0;
			$point_nm=0;
			$point_ha=0;
			$qids_es="";
			$qids_nm="";
			$qids_ha="";
			
			
			$number_question_es=0;
			$number_question_nm=0;
			$number_question_ha=0;
			$multigrade=" ";
			if($child['grade']>=6 && $child['grade']<=8){
				$multigrade = " (lid=".$child['grade']." or lid=16) ";
			}
			else if($child['grade']>=9 && $child['grade']<=11){
				$multigrade = " (lid=".$child['grade']." or lid=17) ";
			}
			else if($child['grade']>=12 && $child['grade']<=14){
				$multigrade = " (lid=".$child['grade']." or lid=18) ";
			}
		    else
				$multigrade=" lid=".$child['grade'];
			foreach ($cate_es as $ct){
				
				$sqles= "select qid, question, points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
				$data = $this->db->query($sqles)->result_array();
				foreach($data as $k=> $d){
					if($qids_es!=""){
						$qids_es.=",";
					}
					$qids_es.=$d['qid'];
					$data[$k]["question"]= strip_tags($d['question']);
					$point_es+=$data[$k]['points'];
					unset($data[$k]['points']);
					$number_question_es++;
				}
				
				array_push($quiz_es, array("subject"=>$ct['category_name']." ".$grade_name, "questions"=>$data));
			}
			
			foreach ($cate_nm as $ct){
				$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
				$data = $this->db->query($sqles)->result_array();
				foreach($data as $k=> $d){
					if($qids_nm!=""){
						$qids_nm.=",";
					}
					$qids_nm.=$d['qid'];
					$data[$k]["question"]= strip_tags($d['question']);
					$point_nm+=$data[$k]['points'];
					unset($data[$k]['points']);
					$number_question_nm++;
				}
				array_push($quiz_nm, array("subject"=>$ct['category_name']." ".$grade_name, "questions"=>$data));
			}
			
			foreach ($cate_ha as $ct){
				$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
				$data = $this->db->query($sqles)->result_array();
				foreach($data as $k=> $d){
					if($qids_ha!=""){
						$qids_ha.=",";
					}
					$qids_ha.=$d['qid'];
					$data[$k]["question"]= strip_tags($d['question']);
					$point_ha+=$data[$k]['points'];
					unset($data[$k]['points']);
					$number_question_ha++;
				}
				array_push($quiz_ha, array("subject"=>$ct['category_name']." ".$grade_name, "questions"=>$data));
			}
			$sql = "select qid,question, source from savsoft_qbank where type=3 order by rand()";
			$rdt = $this->db->query($sql)->row_array();
			$sql = "select *  from reading_material where link='".$rdt['source']."'";
			$rmt = $this->db->query($sql)->row_array();
			$rques = array(array("qid"=>$rdt['qid'],
			                     "title"=> strip_tags($rdt['question']) ));
			
			
			$reading=array( "link"=> $rdt['source'],
							"question"=> $rques,
							"img"=> $rmt['img'],
							"title"=> $rmt['title']
							);
			
			
			
			$sql = "select qid,question, source from savsoft_qbank where type=2 and lid=8 and cid!=29 order by rand()";
			$vdt = $this->db->query($sql)->row_array();
			$vques = array(array("qid"=>$vdt['qid'],
			                     "title"=> strip_tags($vdt['question']) ));
			
			
			preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
			if(count($vidTags[0])>0){
				 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
				 if(strpos($match[1],'youtube')!==false){
					 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
					 $sqll= "select title from savsoft_library where content like '%$vid%'";
					 $video_title=$this->db->query($sqll)->row_array()['title'];
					 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
				 }
				 else if(strpos($match[1],'facebook')!==false){
				$start = strpos($match[1],"href=");
					//$end = strpos($match[1],"&amp;");
					$vidlink= substr($match[1],$start+5);
					$vidlink=str_replace("%3A",":",$vidlink);
					$vidlink=str_replace("%2F","/",$vidlink);
					
					
					$posvideo=strpos($match[1],"videos%2F");
					$temp= substr($match[1],$posvideo+9);
					$posid=strpos($temp,"%2F");
					$vid= substr($temp,0,$posid);
					$sqll= "select title from savsoft_library where source_id=$vid";
					$vdtz= $this->db->query($sqll)->row_array();
					$video_title=$vdtz['title'];
					
					$img_video="https://graph.facebook.com/$vid/picture";
				 }
			} 
			
			
			$video = array( "video"=> $vidlink,
							"question"=> $vques,
							"img"=> $img_video,
							"title"=>$video_title);
							
							
			$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
			
			
			
			$info= array(
						array("qids"=>$qids_es, "video"=>$video, 'reading'=>$reading ),
			            array("qids"=>$qids_nm, "video"=>$video, 'reading'=>$reading),
						array("qids"=>$qids_ha, "video"=>$video, 'reading'=>$reading),
			      );
			
			$r = array(
			    "info"=>$info,
				"date"=> $ardow[date('w',strtotime("0 day"))].", ".date("d / m", strtotime("0 day")),
				"grade"=>$grade,
				"assignments"=>array( 
									array("level"=>"Ngắn",
									      "total_points"=>$point_es,
										  "number_question"=>$number_question_es,
									      "quiz"=>$quiz_es,
										  "reading"=>$reading,
										  "video"=>$video),
				                    array("level"=>"Vừa",
										"total_points"=>$point_nm,
										"number_question"=>$number_question_nm,
										  "quiz"=>$quiz_nm,
										  "reading"=>$reading,
										  "video"=>$video),
									array("level"=>"Dài",
										"total_points"=>$point_ha,
										"number_question"=>$number_question_ha,
									      "quiz"=>$quiz_ha,
										  "reading"=>$reading,
										  "video"=>$video)
				               )
			    );
			echo json_encode($r);
			
		}
		else{
			echo json_encode(array("message"=>"error: Tài khoản không tồn tại" ));
		}
	}
	

	function new_hcc_assign_quiz($parent,$childid){
		$sql = "select grade,assign_categories from savsoft_users where uid=$childid";
		$child=$this->db->query($sql)->row_array();
		if($child){
			$ac= $child['assign_categories'];
			$grade=$child['grade'];
			
			$this->db->where("lid",$grade);
			$grade_name= $this->db->get("savsoft_level")->row_array()['level_name'];
			$this->db->where("lid",$grade);
			$av_cids= $this->db->get("level_category")->row_array()['available_cids'];
			
			$sqlc=  "select cid,category_name from savsoft_category where cid in ($ac) and cid in ($av_cids)";
			
			
			$sqlce= $sqlc."order by rand() limit 1";
			$cat= $this->db->query($sqlce)->result_array();
			if(!$cat){
				$sqlc=  "select cid,category_name from savsoft_category where cid in ($av_cids)";
			}
			
			$sqlce= $sqlc."order by rand() limit 1";
			$sqlcn= $sqlc."order by rand() limit 2";
			$sqlch= $sqlc."order by rand() limit 3";
			
			$cate_es= $this->db->query($sqlce)->result_array();
			$cate_nm= $this->db->query($sqlcn)->result_array();
			$cate_ha= $this->db->query($sqlch)->result_array();
			
			$quiz_es=array();
			$quiz_nm=array();
			$quiz_ha=array();
			$point_es=0;
			$point_nm=0;
			$point_ha=0;
			$qids_es="";
			$qids_nm="";
			$qids_ha="";
			
			
			$number_question_es=0;
			$number_question_nm=0;
			$number_question_ha=0;
			if($child['grade']>=6 && $child['grade']<=8){
				$multigrade = " (lid=".$child['grade']." or lid=16) ";
			}
			else if($child['grade']>=9 && $child['grade']<=11){
				$multigrade = " (lid=".$child['grade']." or lid=17) ";
			}
			else if($child['grade']>=12 && $child['grade']<=14){
				$multigrade = " (lid=".$child['grade']." or lid=18) ";
			}
		    else
				$multigrade=" lid=".$child['grade'];
		
			foreach ($cate_es as $ct){
				
				$sqles= "select qid, question, points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
				$data = $this->db->query($sqles)->result_array();
				foreach($data as $k=> $d){
					if($qids_es!=""){
						$qids_es.=",";
					}
					$qids_es.=$d['qid'];
					$data[$k]["question"]= strip_tags($d['question']);
					$point_es+=$data[$k]['points'];
					unset($data[$k]['points']);
					$number_question_es++;
				}
				
				array_push($quiz_es, array("subject"=>$ct['category_name']." ".strtolower($grade_name), "questions"=>$data));
			}
			
			foreach ($cate_nm as $ct){
				$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
				$data = $this->db->query($sqles)->result_array();
				foreach($data as $k=> $d){
					if($qids_nm!=""){
						$qids_nm.=",";
					}
					$qids_nm.=$d['qid'];
					$data[$k]["question"]= strip_tags($d['question']);
					$point_nm+=$data[$k]['points'];
					unset($data[$k]['points']);
					$number_question_nm++;
				}
				array_push($quiz_nm, array("subject"=>$ct['category_name']." ".strtolower($grade_name), "questions"=>$data));
			}
			
			foreach ($cate_ha as $ct){
				$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
				$data = $this->db->query($sqles)->result_array();
				foreach($data as $k=> $d){
					if($qids_ha!=""){
						$qids_ha.=",";
					}
					$qids_ha.=$d['qid'];
					$data[$k]["question"]= strip_tags($d['question']);
					$point_ha+=$data[$k]['points'];
					unset($data[$k]['points']);
					$number_question_ha++;
				}
				array_push($quiz_ha, array("subject"=>$ct['category_name']." ".strtolower($grade_name), "questions"=>$data));
			}
			
			//category reading
			$sql = "select qid,question, source,points from savsoft_qbank where type=3 order by rand() limit 3";
			$rdtar = $this->db->query($sql)->result_array();
			
			
			if(count($rdtar)>0){
				$point_es+=$rdtar[0]['points'];
				$point_nm+=$rdtar[1%count($rdtar)]['points'];
				$point_ha+=$rdtar[2%count($rdtar)]['points'];
				$rdt = $rdtar[0];
				$sql = "select *  from reading_material where link='".$rdt['source']."'";
				$rmt = $this->db->query($sql)->row_array();
				$rques = array(array("qid"=>$rdt['qid'],
									 "title"=> strip_tags($rdt['question']) ));
				
				
				$reading_es=array( "link"=> $rdt['source'],
								"question"=> $rques,
								"img"=> $rmt['img'],
								"title"=> $rmt['title']
								);
				
				
				$rdt = $rdtar[1%count($rdtar)];
				$sql = "select *  from reading_material where link='".$rdt['source']."'";
				$rmt = $this->db->query($sql)->row_array();
				$rques = array(array("qid"=>$rdt['qid'],
									 "title"=> strip_tags($rdt['question']) ));
									 
				$reading_nm=array( "link"=> $rdt['source'],
								"question"=> $rques,
								"img"=> $rmt['img'],
								"title"=> $rmt['title']
								);
								
				$rdt = $rdtar[2%count($rdtar)];
				$sql = "select *  from reading_material where link='".$rdt['source']."'";
				$rmt = $this->db->query($sql)->row_array();
				$rques = array(array("qid"=>$rdt['qid'],
									 "title"=> strip_tags($rdt['question']) ));
				$reading_ha=array( "link"=> $rdt['source'],
								"question"=> $rques,
								"img"=> $rmt['img'],
								"title"=> $rmt['title']
								);
			}
			
			//mutigrade
			//$sql = "select qid,question, source from savsoft_qbank where type=2 and $multigrade and cid!=29 order by rand() limit 3";
			$sql = "select qid,question, source,points from savsoft_qbank where type=2 and lid=8 and cid!=29 order by rand() limit 3";
			$vdtar = $this->db->query($sql)->result_array();
			if(count($vdtar)>0){
				$index_es = 0;
				$index_nm = 1%count($vdtar);
				$index_ha = 2%count($vdtar);
				
				$point_es+=$vdtar[$index_es]['points'];
				$point_nm+=$vdtar[$index_nm]['points'];
				$point_ha+=$vdtar[$index_ha]['points'];
				
				/***/
				$vdt = $vdtar[$index_es];	
				$vidlink="";
				$vques= array();
				$img_video="";
				$video_title="";
				
				$vques = array(array("qid"=>$vdt['qid'],
									 "title"=> strip_tags($vdt['question']) ));
				
				
				preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
				if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					 if(strpos($match[1],'youtube')!==false){
						 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
						 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
						 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
						 $sqll= "select title from savsoft_library where content like '%$vid%'";
						 $video_title=$this->db->query($sqll)->row_array()['title'];
						 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
					 }
					 else if(strpos($match[1],'facebook')!==false){
						$start = strpos($match[1],"href=");
						//$end = strpos($match[1],"&amp;");
						$vidlink= substr($match[1],$start+5);
						$vidlink=str_replace("%3A",":",$vidlink);
						$vidlink=str_replace("%2F","/",$vidlink);
						
						
						$posvideo=strpos($match[1],"videos%2F");
						$temp= substr($match[1],$posvideo+9);
						$posid=strpos($temp,"%2F");
						$vid= substr($temp,0,$posid);
						$sqll= "select title from savsoft_library where source_id=$vid";
						$vdtz= $this->db->query($sqll)->row_array();
						$video_title=$vdtz['title'];
						
						$img_video="https://graph.facebook.com/$vid/picture";
					 }
				} 
				
				
				$video_es = array( "video"=> $vidlink,
								"question"=> $vques,
								"img"=> $img_video,
								"title"=>$video_title,
								);
				
				/***/
				$vdt = $vdtar[$index_nm];	
				$vidlink="";
				$vques= array();
				$img_video="";
				$video_title="";
				
				$vques = array(array("qid"=>$vdt['qid'],
									 "title"=> strip_tags($vdt['question']) ));
				
				
				preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
				if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					 if(strpos($match[1],'youtube')!==false){
						 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
						 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
						 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
						 $sqll= "select title from savsoft_library where content like '%$vid%'";
						 $video_title=$this->db->query($sqll)->row_array()['title'];
						 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
					 }
					 else if(strpos($match[1],'facebook')!==false){
						$start = strpos($match[1],"href=");
						//$end = strpos($match[1],"&amp;");
						$vidlink= substr($match[1],$start+5);
						$vidlink=str_replace("%3A",":",$vidlink);
						$vidlink=str_replace("%2F","/",$vidlink);
						
						
						$posvideo=strpos($match[1],"videos%2F");
						$temp= substr($match[1],$posvideo+9);
						$posid=strpos($temp,"%2F");
						$vid= substr($temp,0,$posid);
						$sqll= "select title from savsoft_library where source_id=$vid";
						$vdtz= $this->db->query($sqll)->row_array();
						$video_title=$vdtz['title'];
						
						$img_video="https://graph.facebook.com/$vid/picture";
					 }
				} 
				
				
				$video_nm = array( "video"=> $vidlink,
								"question"=> $vques,
								"img"=> $img_video,
								"title"=>$video_title);		


				$vdt = $vdtar[$index_ha];	
				$vidlink="";
				$vques= array();
				$img_video="";
				$video_title="";
				
				$vques = array(array("qid"=>$vdt['qid'],
									 "title"=> strip_tags($vdt['question']) ));
				
				
				preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
				if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					 if(strpos($match[1],'youtube')!==false){
						 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
						 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
						 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
						 $sqll= "select title from savsoft_library where content like '%$vid%'";
						 $video_title=$this->db->query($sqll)->row_array()['title'];
						 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
					 }
					 else if(strpos($match[1],'facebook')!==false){
						$start = strpos($match[1],"href=");
						//$end = strpos($match[1],"&amp;");
						$vidlink= substr($match[1],$start+5);
						$vidlink=str_replace("%3A",":",$vidlink);
						$vidlink=str_replace("%2F","/",$vidlink);
						
						
						$posvideo=strpos($match[1],"videos%2F");
						$temp= substr($match[1],$posvideo+9);
						$posid=strpos($temp,"%2F");
						$vid= substr($temp,0,$posid);
						$sqll= "select title from savsoft_library where source_id=$vid";
						$vdtz= $this->db->query($sqll)->row_array();
						$video_title=$vdtz['title'];
						
						$img_video="https://graph.facebook.com/$vid/picture";
					 }
				} 
				
				
				$video_ha = array( "video"=> $vidlink,
								"question"=> $vques,
								"img"=> $img_video,
								"title"=>$video_title
								);							
			}					
			$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
				
				
			
			$info= array(
						array("qids"=>$qids_es, "video"=>$video_es, 'reading'=>$reading_es ),
			            array("qids"=>$qids_nm, "video"=>$video_nm, 'reading'=>$reading_nm),
						array("qids"=>$qids_ha, "video"=>$video_ha, 'reading'=>$reading_ha),
			      );
			
			$r = array(
			    "info"=>$info,
				"date"=> $ardow[date('w',strtotime("0 day"))].", ".date("d / m", strtotime("0 day")),
				"grade"=>$grade,
				"assignments"=>array( 
									array("level"=>"Ngắn",
									      "total_points"=>$point_es,
										  "number_question"=>$number_question_es,
									      "quiz"=>$quiz_es,
										  "reading"=>$reading_es,
										  "video"=>$video_es),
				                    array("level"=>"Vừa",
										"total_points"=>$point_nm,
										"number_question"=>$number_question_nm,
										  "quiz"=>$quiz_nm,
										  "reading"=>$reading_nm,
										  "video"=>$video_nm),
									array("level"=>"Dài",
										"total_points"=>$point_ha,
										"number_question"=>$number_question_ha,
									      "quiz"=>$quiz_ha,
										  "reading"=>$reading_ha,
										  "video"=>$video_ha)
				               )
			    );
				
		    $this->db->where("parentid",$parent);
			$this->db->where('childid',$childid);
			$sthq=$this->db->get('store_hcc_quiz')->row_array();
			$insa= array("parentid"=>$parent,
				             'childid'=>$childid,
							 'json_quiz'=>json_encode($r)
							 );
			if(!$sthq){
				$this->db->insert('store_hcc_quiz',$insa);
			}
			else{
				$this->db->where("parentid",$parent);
				$this->db->where('childid',$childid);
				$this->db->update('store_hcc_quiz',$insa);
			}

			echo json_encode($r);
			
			
		}
		else{
			echo json_encode(array("message"=>"error: Tài khoản không tồn tại" ));
		}
	}
	
	
	function stored_hcc_assign_quiz($parent,$childid){
		$this->db->where("parentid",$parent);
		$this->db->where('childid',$childid);
		$sthq=$this->db->get('store_hcc_quiz')->row_array();
		if(!$sthq){
			$sql = "select grade,assign_categories from savsoft_users where uid=$childid";
			$child=$this->db->query($sql)->row_array();
			if($child){
				$ac= $child['assign_categories'];
				$grade=$child['grade'];
				
				$this->db->where("lid",$grade);
				$grade_name= $this->db->get("savsoft_level")->row_array()['level_name'];
				$this->db->where("lid",$grade);
				$av_cids= $this->db->get("level_category")->row_array()['available_cids'];
				
				$sqlc=  "select cid,category_name from savsoft_category where cid in ($ac) and cid in ($av_cids)";
				
				
				$sqlce= $sqlc."order by rand() limit 1";
				$cat= $this->db->query($sqlce)->result_array();
				if(!$cat){
					$sqlc=  "select cid,category_name from savsoft_category where cid in ($av_cids)";
				}
				
				$sqlce= $sqlc."order by rand() limit 1";
				$sqlcn= $sqlc."order by rand() limit 2";
				$sqlch= $sqlc."order by rand() limit 3";
				
				$cate_es= $this->db->query($sqlce)->result_array();
				$cate_nm= $this->db->query($sqlcn)->result_array();
				$cate_ha= $this->db->query($sqlch)->result_array();
				
				$quiz_es=array();
				$quiz_nm=array();
				$quiz_ha=array();
				$point_es=0;
				$point_nm=0;
				$point_ha=0;
				$qids_es="";
				$qids_nm="";
				$qids_ha="";
				
				
				$number_question_es=0;
				$number_question_nm=0;
				$number_question_ha=0;
				if($child['grade']>=6 && $child['grade']<=8){
					$multigrade = " (lid=".$child['grade']." or lid=16) ";
				}
				else if($child['grade']>=9 && $child['grade']<=11){
					$multigrade = " (lid=".$child['grade']." or lid=17) ";
				}
				else if($child['grade']>=12 && $child['grade']<=14){
					$multigrade = " (lid=".$child['grade']." or lid=18) ";
				}
				else
					$multigrade=" lid=".$child['grade'];
			
				foreach ($cate_es as $ct){
					
					$sqles= "select qid, question, points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
					$data = $this->db->query($sqles)->result_array();
					foreach($data as $k=> $d){
						if($qids_es!=""){
							$qids_es.=",";
						}
						$qids_es.=$d['qid'];
						$data[$k]["question"]= strip_tags($d['question']);
						$point_es+=$data[$k]['points'];
						unset($data[$k]['points']);
						$number_question_es++;
					}
					
					array_push($quiz_es, array("subject"=>$ct['category_name']." ".strtolower($grade_name), "questions"=>$data));
				}
				
				foreach ($cate_nm as $ct){
					$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
					$data = $this->db->query($sqles)->result_array();
					foreach($data as $k=> $d){
						if($qids_nm!=""){
							$qids_nm.=",";
						}
						$qids_nm.=$d['qid'];
						$data[$k]["question"]= strip_tags($d['question']);
						$point_nm+=$data[$k]['points'];
						unset($data[$k]['points']);
						$number_question_nm++;
					}
					array_push($quiz_nm, array("subject"=>$ct['category_name']." ".strtolower($grade_name), "questions"=>$data));
				}
				
				foreach ($cate_ha as $ct){
					$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
					$data = $this->db->query($sqles)->result_array();
					foreach($data as $k=> $d){
						if($qids_ha!=""){
							$qids_ha.=",";
						}
						$qids_ha.=$d['qid'];
						$data[$k]["question"]= strip_tags($d['question']);
						$point_ha+=$data[$k]['points'];
						unset($data[$k]['points']);
						$number_question_ha++;
					}
					array_push($quiz_ha, array("subject"=>$ct['category_name']." ".strtolower($grade_name), "questions"=>$data));
				}
				
				//category reading
				$sql = "select qid,question, source,points from savsoft_qbank where type=3 order by rand() limit 3";
				$rdtar = $this->db->query($sql)->result_array();
				
				
				if(count($rdtar)>0){
					$point_es+=$rdtar[0]['points'];
					$point_nm+=$rdtar[1%count($rdtar)]['points'];
					$point_ha+=$rdtar[2%count($rdtar)]['points'];
					$rdt = $rdtar[0];
					$sql = "select *  from reading_material where link='".$rdt['source']."'";
					$rmt = $this->db->query($sql)->row_array();
					$rques = array(array("qid"=>$rdt['qid'],
										 "title"=> strip_tags($rdt['question']) ));
					
					
					$reading_es=array( "link"=> $rdt['source'],
									"question"=> $rques,
									"img"=> $rmt['img'],
									"title"=> $rmt['title']
									);
					
					
					$rdt = $rdtar[1%count($rdtar)];
					$sql = "select *  from reading_material where link='".$rdt['source']."'";
					$rmt = $this->db->query($sql)->row_array();
					$rques = array(array("qid"=>$rdt['qid'],
										 "title"=> strip_tags($rdt['question']) ));
										 
					$reading_nm=array( "link"=> $rdt['source'],
									"question"=> $rques,
									"img"=> $rmt['img'],
									"title"=> $rmt['title']
									);
									
					$rdt = $rdtar[2%count($rdtar)];
					$sql = "select *  from reading_material where link='".$rdt['source']."'";
					$rmt = $this->db->query($sql)->row_array();
					$rques = array(array("qid"=>$rdt['qid'],
										 "title"=> strip_tags($rdt['question']) ));
					$reading_ha=array( "link"=> $rdt['source'],
									"question"=> $rques,
									"img"=> $rmt['img'],
									"title"=> $rmt['title']
									);
				}
				
				//mutigrade
				//$sql = "select qid,question, source from savsoft_qbank where type=2 and $multigrade and cid!=29 order by rand() limit 3";
				$sql = "select qid,question, source,points from savsoft_qbank where type=2 and lid=8 and cid!=29 order by rand() limit 3";
				$vdtar = $this->db->query($sql)->result_array();
				if(count($vdtar)>0){
					$index_es = 0;
					$index_nm = 1%count($vdtar);
					$index_ha = 2%count($vdtar);
					
					$point_es+=$vdtar[$index_es]['points'];
					$point_nm+=$vdtar[$index_nm]['points'];
					$point_ha+=$vdtar[$index_ha]['points'];
					
					/***/
					$vdt = $vdtar[$index_es];	
					$vidlink="";
					$vques= array();
					$img_video="";
					$video_title="";
					
					$vques = array(array("qid"=>$vdt['qid'],
										 "title"=> strip_tags($vdt['question']) ));
					
					
					preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 if(strpos($match[1],'youtube')!==false){
							 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
							 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
							 $sqll= "select title from savsoft_library where content like '%$vid%'";
							 $video_title=$this->db->query($sqll)->row_array()['title'];
							 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
						 }
						 else if(strpos($match[1],'facebook')!==false){
							$start = strpos($match[1],"href=");
							//$end = strpos($match[1],"&amp;");
							$vidlink= substr($match[1],$start+5);
							$vidlink=str_replace("%3A",":",$vidlink);
							$vidlink=str_replace("%2F","/",$vidlink);
							
							
							$posvideo=strpos($match[1],"videos%2F");
							$temp= substr($match[1],$posvideo+9);
							$posid=strpos($temp,"%2F");
							$vid= substr($temp,0,$posid);
							$sqll= "select title from savsoft_library where source_id=$vid";
							$vdtz= $this->db->query($sqll)->row_array();
							$video_title=$vdtz['title'];
							
							$img_video="https://graph.facebook.com/$vid/picture";
						 }
					} 
					
					
					$video_es = array( "video"=> $vidlink,
									"question"=> $vques,
									"img"=> $img_video,
									"title"=>$video_title,
									);
					
					/***/
					$vdt = $vdtar[$index_nm];	
					$vidlink="";
					$vques= array();
					$img_video="";
					$video_title="";
					
					$vques = array(array("qid"=>$vdt['qid'],
										 "title"=> strip_tags($vdt['question']) ));
					
					
					preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 if(strpos($match[1],'youtube')!==false){
							 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
							 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
							 $sqll= "select title from savsoft_library where content like '%$vid%'";
							 $video_title=$this->db->query($sqll)->row_array()['title'];
							 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
						 }
						 else if(strpos($match[1],'facebook')!==false){
							$start = strpos($match[1],"href=");
							//$end = strpos($match[1],"&amp;");
							$vidlink= substr($match[1],$start+5);
							$vidlink=str_replace("%3A",":",$vidlink);
							$vidlink=str_replace("%2F","/",$vidlink);
							
							
							$posvideo=strpos($match[1],"videos%2F");
							$temp= substr($match[1],$posvideo+9);
							$posid=strpos($temp,"%2F");
							$vid= substr($temp,0,$posid);
							$sqll= "select title from savsoft_library where source_id=$vid";
							$vdtz= $this->db->query($sqll)->row_array();
							$video_title=$vdtz['title'];
							
							$img_video="https://graph.facebook.com/$vid/picture";
						 }
					} 
					
					
					$video_nm = array( "video"=> $vidlink,
									"question"=> $vques,
									"img"=> $img_video,
									"title"=>$video_title);		


					$vdt = $vdtar[$index_ha];	
					$vidlink="";
					$vques= array();
					$img_video="";
					$video_title="";
					
					$vques = array(array("qid"=>$vdt['qid'],
										 "title"=> strip_tags($vdt['question']) ));
					
					
					preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 if(strpos($match[1],'youtube')!==false){
							 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
							 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
							 $sqll= "select title from savsoft_library where content like '%$vid%'";
							 $video_title=$this->db->query($sqll)->row_array()['title'];
							 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
						 }
						 else if(strpos($match[1],'facebook')!==false){
							$start = strpos($match[1],"href=");
							//$end = strpos($match[1],"&amp;");
							$vidlink= substr($match[1],$start+5);
							$vidlink=str_replace("%3A",":",$vidlink);
							$vidlink=str_replace("%2F","/",$vidlink);
							
							
							$posvideo=strpos($match[1],"videos%2F");
							$temp= substr($match[1],$posvideo+9);
							$posid=strpos($temp,"%2F");
							$vid= substr($temp,0,$posid);
							$sqll= "select title from savsoft_library where source_id=$vid";
							$vdtz= $this->db->query($sqll)->row_array();
							$video_title=$vdtz['title'];
							
							$img_video="https://graph.facebook.com/$vid/picture";
						 }
					} 
					
					
					$video_ha = array( "video"=> $vidlink,
									"question"=> $vques,
									"img"=> $img_video,
									"title"=>$video_title
									);							
				}					
				$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
					
					
				
				$info= array(
							array("qids"=>$qids_es, "video"=>$video_es, 'reading'=>$reading_es ),
							array("qids"=>$qids_nm, "video"=>$video_nm, 'reading'=>$reading_nm),
							array("qids"=>$qids_ha, "video"=>$video_ha, 'reading'=>$reading_ha),
					  );
				
				$r = array(
					"info"=>$info,
					"date"=> $ardow[date('w',strtotime("0 day"))].", ".date("d / m", strtotime("0 day")),
					"grade"=>$grade,
					"assignments"=>array( 
										array("level"=>"Ngắn",
											  "total_points"=>$point_es,
											  "number_question"=>$number_question_es,
											  "quiz"=>$quiz_es,
											  "reading"=>$reading_es,
											  "video"=>$video_es),
										array("level"=>"Vừa",
											"total_points"=>$point_nm,
											"number_question"=>$number_question_nm,
											  "quiz"=>$quiz_nm,
											  "reading"=>$reading_nm,
											  "video"=>$video_nm),
										array("level"=>"Dài",
											"total_points"=>$point_ha,
											"number_question"=>$number_question_ha,
											  "quiz"=>$quiz_ha,
											  "reading"=>$reading_ha,
											  "video"=>$video_ha)
								   )
					);
				$insa= array("parentid"=>$parent,
				             'childid'=>$childid,
							 'json_quiz'=>json_encode($r)
							 );
				$this->db->insert('store_hcc_quiz',$insa);
				echo json_encode($r);
			}	
		}
		else{
			echo $sthq['json_quiz'];
		}
		
	}
	
	
	
	function get_statistic_answer($uid){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$lastweek = date("Y-m-d 00:00:00", strtotime("-6 day"));
		$arday = array( date("Y-m-d", strtotime("-6 day")),
		         date("Y-m-d", strtotime("-5 day")),
				 date("Y-m-d", strtotime("-4 day")),
				 date("Y-m-d", strtotime("-3 day")),
				 date("Y-m-d", strtotime("-2 day")),
				 date("Y-m-d", strtotime("-1 day")),
				 date("Y-m-d"));
		$res= array(array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0),
		            array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0));
		$resus= array(array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0),
		            array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0),
					array("total"=>0, "istrue"=>0));	
        $dataweek =array("CN","T2", "T3", "T4", "T5", "T6","T7"); 		
        $dayinweek = date('w',strtotime("-6 day"));
        		
		$sql = "select qid,uid, DATE(create_date) as time,istrue from savsoft_answer_mcq  where create_date>= '$lastweek'";
		$data= $this->db->query($sql)->result_array();
		foreach($data as $d){
			foreach($arday as $k=>$day){
				if($d['time']==$day){
					$res[$k]['total']++;
					if($d['istrue']==1){
						$res[$k]['istrue']++;
					}
					if($d['uid']==$uid){
						$resus[$k]['total']++;
						if($d['istrue']==1){
							$resus[$k]['istrue']++;
						}
					}
				}
			}
		}
		
		$sql = "select  a.score_u as istrue,r.rid ,r.uid,  DATE(FROM_UNIXTIME(end_time)) as time from savsoft_result r join savsoft_answers a on r.rid = a.rid where DATE(FROM_UNIXTIME(end_time)) >= '$lastweek'";
		
		$data= $this->db->query($sql)->result_array();
		foreach($data as $d){
			foreach($arday as $k=>$day){
				if($d['time']==$day){
					$res[$k]['total']++;
					if($d['istrue']==1){
						$res[$k]['istrue']++;
					}
					if($d['uid']==$uid){
						$resus[$k]['total']++;
						if($d['istrue']==1){
							$resus[$k]['istrue']++;
						}
					}
				}
			}
		}
		foreach($res as $k=>$r){
			if($r['total']==0) $res[$k]['percent']=50;
			else 
				$res[$k]['percent']= floor(100*$r['istrue']/$r['total']);
		}
		
		foreach($resus as $k=>$r){
			if($r['total']==0) $resus[$k]['percent']=0;
			else 
				$resus[$k]['percent']= floor(100*$r['istrue']/$r['total']);
		}
		
		//$dataweek[($dayinweek+2)%7]
		$result =array(
                       "avg"=>array( 
							array("x"=>1, "y"=>$res[0]['percent']),
							array("x"=>2, "y"=>$res[1]['percent']),
							array("x"=>3, "y"=>$res[2]['percent']),
							array("x"=>4, "y"=>$res[3]['percent']),
							array("x"=>5, "y"=>$res[4]['percent']),
							array("x"=>6, "y"=>$res[5]['percent']),
							array("x"=>7, "y"=>$res[6]['percent'])
						
		               ) ,
					   
					   "user"=>array(
							array("x"=>1, "y"=>$resus[0]['percent']),
							array("x"=>2, "y"=>$resus[1]['percent']),
							array("x"=>3, "y"=>$resus[2]['percent']),
							array("x"=>4, "y"=>$resus[3]['percent']),
							array("x"=>5, "y"=>$resus[4]['percent']),
							array("x"=>6, "y"=>$resus[5]['percent']),
							array("x"=>7, "y"=>$resus[6]['percent'])
						
		               ) 
					  )
					 ;
				  
		echo json_encode($result);		  
		
	}
	
	function create_quiz_assign($key){
		if($key=='ctv1xnvhk078j5h0c2bjq5wp1pennqoyizswcdbc'){
			
			$today=  date("Y-m-d", strtotime("+1 day"));
			$this->db->distinct();
			$this->db->select("demo_timetable.cid,lid,unit,category_name,sub_subject");
			$this->db->join("savsoft_category", "demo_timetable.cid=savsoft_category.cid");

			$this->db->where("day", $today);	
			$data= $this->db->get('demo_timetable')->result_array();
			for($i=0; $i<20; $i++){
				$ignore="";
				if(count($data)>0){
				$sql="Select qid, question,source from savsoft_qbank where deleted=0 and status=1 and ( ";
				
				foreach($data as $k=>$d){
					$unit = $d['unit'];
					if($unit){
						
						$this->db->where("unit_number",$unit);
						$this->db->where("cid",$d['cid']);
						$this->db->where("lid",$d['lid']);
						$data[$k]['unit_name']= $this->db->get('unit')->row_array()['unit_name'];
						
					}
					else{
						$data[$k]['unit_name']="";
					}
					
					if($k!=0)
						$sql.= " or ";
					else
						$sql.= " ";
					if($d['sub_subject']){
						$sql2=" and (unit='$unit-".$d['sub_subject']."' or unit like '%,$unit,%-".$d['sub_subject']."' or unit like '%,$unit-".$d['sub_subject']."' or unit like '$unit,%-".$d['sub_subject']."') ";
					} else{
						$sql2=" and (unit=$unit or unit like '%,$unit,%' or unit like '%,$unit' or unit like '$unit,%') ";
					}
					$sql.= " ( cid=".$d['cid']." and lid=".$d['lid'].$sql2." ) "  ;
				}
				
				$sql_es=$sql." ) and (type=0 or type is null or type=1) order by rand() limit 3";
				//$sql_nm=$sql." ) and (type=0 or type is null or type=1) order by rand() limit 5";
				//$sql_ha=$sql." ) and (type=0 or type is null or type=1) order by rand() limit 7";
				$sql_reading = $sql." ) and (type=3) order by rand() limit 3";
				$sql_video = $sql." ) and (type=2) order by rand() limit 3";
				$res2['es'] = $this->db->query($sql_es)->result_array();
				
				//$res2['nm'] = $this->db->query($sql_nm)->result_array();
				//$res2['ha'] = $this->db->query($sql_ha)->result_array();
				$var= $this->db->query($sql_video)->result_array();
				$rar= $this->db->query($sql_reading)->result_array();
				$countv = count($var);
				$countr = count($rar);
				$qidss="";
				foreach($res2['es'] as $k=>$a){
					if($k!=0){
						$qidss.=",";
					}
					$qidss.=$a['qid'];
					
				}
				
				$qids="";
				$arrqid = $this->db->query("select qid from savsoft_qbank where qid in ($qidss) order by cid asc")->result_array();
				foreach($arrqid as $k=>$a){
					if($k!=0){
						$qids.=",";
					}
					$qids.=$a['qid'];
					
				}
				$ignore= $qids;
				$sql_nm=$sql." ) and (type=0 or type is null or type=1) and qid not in ($ignore) order by rand() limit 5";
				$res2['nm'] = $this->db->query($sql_nm)->result_array();
				
				$quiz_name="Bài học cùng con ngày ".date("d-m-Y", strtotime("+1 day"))." - Ngắn";

				$noq= 3;
				$uid=0;
				//$day=date("Y-m-d");
				$level_hard= 1;
				//jd change lid
				$lid= 8;
				$reading_mcq= $rar[0]['qid'];
				$video_mcq= $var[0]['qid'];
				$this->db->where("link",$rar[0]['source']);
				$rm=$this->db->get("reading_material")->row_array();
				$reading=$rm['content'];
				$reading_title=$rm['title'];
				$img_reading=$rm['img'];
				preg_match_all('/<iframe[^>]+>/i',$var[0]['question'], $vidTags); 
				if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
					 $sqll= "select title from savsoft_library where content like '%$vid%'";
					 $video_title=$this->db->query($sqll)->row_array()['title'];
				} 
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard,$i,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
				
				
				$qidss="";
				foreach($res2['nm'] as $k=>$a){
					if($k!=0){
						$qidss.=",";
					}
					$qidss.=$a['qid'];
					
				}
				
				$qids="";
				$arrqid = $this->db->query("select qid from savsoft_qbank where qid in ($qidss) order by cid asc")->result_array();
				foreach($arrqid as $k=>$a){
					if($k!=0){
						$qids.=",";
					}
					$qids.=$a['qid'];
					
				}
				$ignore.=",".$qids;
				$sql_ha=$sql." ) and (type=0 or type is null or type=1) and qid not in ($ignore) order by rand() limit 7";
                $res2['ha'] = $this->db->query($sql_ha)->result_array();
				
				$quiz_name="Bài học cùng con ngày ". date("d-m-Y", strtotime("+1 day"))." - Vừa";
				//$qids="100,101";
				$noq= 5;
				$uid=0;
				//$day=date("Y-m-d");
				$level_hard= 2;
				$lid= 8;
				$reading_mcq= $rar[1%$countr]['qid'];
				$video_mcq= $var[1%$countv]['qid'];
				$this->db->where("link",$rar[1%$countr]['source']);
				$rm=$this->db->get("reading_material")->row_array();
				$reading=$rm['content'];
				$reading_title=$rm['title'];
				$img_reading=$rm['img'];
				
				preg_match_all('/<iframe[^>]+>/i',$var[1%$countv]['question'], $vidTags); 
				if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
					 $sqll= "select title from savsoft_library where content like '%$vid%'";
					 $video_title=$this->db->query($sqll)->row_array()['title'];
				} 
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard,$i,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
				$qidss="";
				foreach($res2['ha'] as $k=>$a){
					if($k!=0){
						$qidss.=",";
					}
					$qidss.=$a['qid'];
					
				}
				$qids="";
				$arrqid = $this->db->query("select qid from savsoft_qbank where qid in ($qidss) order by cid asc")->result_array();
				foreach($arrqid as $k=>$a){
					if($k!=0){
						$qids.=",";
					}
					$qids.=$a['qid'];
					
				}
				
				$quiz_name="Bài học cùng con ngày ". date("d-m-Y", strtotime("+1 day"))." - Dài";
				//$qids="100,101";
				$noq= 7;
				$uid=0;
				//$day=date("Y-m-d");
				$level_hard= 3;
				$lid= 8;
				$reading_mcq= $rar[2%$countr]['qid'];
				$video_mcq= $var[2%$countv]['qid'];
				
				$this->db->where("link",$rar[2%$countr]['source']);
				$rm=$this->db->get("reading_material")->row_array();
				$reading=$rm['content'];
				$reading_title=$rm['title'];
				$img_reading=$rm['img'];
				preg_match_all('/<iframe[^>]+>/i',$var[2%$countv]['question'], $vidTags); 
				if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
					 $sqll= "select title from savsoft_library where content like '%$vid%'";
					 $video_title=$this->db->query($sqll)->row_array()['title'];
				} 
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard,$i,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
			}
			
				else{
				$sql="Select qid, question from savsoft_qbank where deleted=0 and status=1 and fun_priory>1 ";
				
				
				$sql_es=$sql." order by rand() limit 3";
				$sql_nm=$sql." order by rand() limit 5";
				$sql_ha=$sql." order by rand() limit 7";
				$res2['es'] = $this->db->query($sql_es)->result_array();
				$res2['nm'] = $this->db->query($sql_nm)->result_array();
				$res2['ha'] = $this->db->query($sql_ha)->result_array();
				
				$qids="";
				foreach($res2['es'] as $k=>$a){
					if($k!=0){
						$qids.=",";
					}
					$qids.=$a['qid'];
					
				}
				$quiz_name="Bài học cùng con ngày ".date("d-m-Y", strtotime("+1 day"))." - Ngắn";

				$noq= 3;
				$uid=0;
				//$day=date("Y-m-d");
				$level_hard= 1;
				//jd change lid
				$lid= 8;
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard, $i,1);
				
				 $qids="";
				foreach($res2['nm'] as $k=>$a){
					if($k!=0){
						$qids.=",";
					}
					$qids.=$a['qid'];
					
				}
				$quiz_name="Bài học cùng con ngày ". date("d-m-Y", strtotime("+1 day"))." - Vừa";
				//$qids="100,101";
				$noq= 5;
				$uid=0;
				//$day=date("Y-m-d");
				$level_hard= 2;
				$lid= 8;
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard, $i,1);

				$qids="";
				foreach($res2['ha'] as $k=>$a){
					if($k!=0){
						$qids.=",";
					}
					$qids.=$a['qid'];
					
				}
				$quiz_name="Bài học cùng con ngày ". date("d-m-Y", strtotime("+1 day"))." - Dài";
				//$qids="100,101";
				$noq= 7;
				$uid=0;
				//$day=date("Y-m-d");
				$level_hard= 3;
				$lid= 8;
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard, $i,1);	
			}
			}
		}

	}
	
	
	function create_quiz_assign2($key, $distinceday=1){
		if($key=='ctv1xnvhk078j5h0c2bjq5wp1pennqoyizswcdbc'){
			$distince_time="+$distinceday day";
			$today=  date("Y-m-d", strtotime($distince_time));
			$today1=  date("d-m", strtotime($distince_time));
			

			$sqls="select * from savsoft_users where su='2'";
			$children= $this->db->query($sqls)->result_array();
			foreach($children as $child){
				if(!$child['assign_categories']){
					$child['assign_categories']= "2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32";
				}
				if($child['grade']==0){
					$child['grade']=8;
				}

				
				log_message('error', $child['uid']."------x");
				$ac= $child['assign_categories'];
				$grade=$child['grade'];
				
				$this->db->where("lid",$grade);
				$grade_name= $this->db->get("savsoft_level")->row_array()['level_name'];
				$this->db->where("lid",$grade);
				$av_cids= $this->db->get("level_category")->row_array()['available_cids'];
				
				$sqlc=  "select cid,category_name from savsoft_category where cid in ($ac) and cid in ($av_cids)";
				
				
				$sqlce= $sqlc."order by rand() limit 1";
				$cat= $this->db->query($sqlce)->result_array();
				if(!$cat){
					$sqlc=  "select cid,category_name from savsoft_category where cid in ($av_cids)";
				}
				
				$sqlce= $sqlc."order by rand() limit 1";
				$sqlcn= $sqlc."order by rand() limit 2";
				$sqlch= $sqlc."order by rand() limit 3";
				
				$cate_es= $this->db->query($sqlce)->result_array();
				$cate_nm= $this->db->query($sqlcn)->result_array();
				$cate_ha= $this->db->query($sqlch)->result_array();

				$qids_es="";
				$qids_nm="";
				$qids_ha="";
				
				
				$number_question_es=0;
				$number_question_nm=0;
				$number_question_ha=0;
				if($child['grade']>=6 && $child['grade']<=8){
					$multigrade = " (lid=".$child['grade']." or lid=16) ";
				}
				else if($child['grade']>=9 && $child['grade']<=11){
					$multigrade = " (lid=".$child['grade']." or lid=17) ";
				}
				else if($child['grade']>=12 && $child['grade']<=14){
					$multigrade = " (lid=".$child['grade']." or lid=18) ";
				}
				else
					$multigrade=" lid=".$child['grade'];
			
				foreach ($cate_es as $ct){
					
					$sqles= "select qid, question, points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
					$data = $this->db->query($sqles)->result_array();
					foreach($data as $k=> $d){
						if($qids_es!=""){
							$qids_es.=",";
						}
						$qids_es.=$d['qid'];
						$data[$k]["question"]= strip_tags($d['question']);
						$number_question_es++;
					}
				}
				
				foreach ($cate_nm as $ct){
					$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
					$data = $this->db->query($sqles)->result_array();
					foreach($data as $k=> $d){
						if($qids_nm!=""){
							$qids_nm.=",";
						}
						$qids_nm.=$d['qid'];
						$data[$k]["question"]= strip_tags($d['question']);
						$number_question_nm++;
					}
				}
				
				foreach ($cate_ha as $ct){
					$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
					$data = $this->db->query($sqles)->result_array();
					foreach($data as $k=> $d){
						if($qids_ha!=""){
							$qids_ha.=",";
						}
						$qids_ha.=$d['qid'];
						$data[$k]["question"]= strip_tags($d['question']);
						$number_question_ha++;
					}
				}
				
				//category reading
				$sql = "select qid,question, source,points from savsoft_qbank where deleted=0 and status=1 and type=3 order by rand() limit 3";
				$rdtar = $this->db->query($sql)->result_array();
				
				
				if(count($rdtar)>0){

					$rdt = $rdtar[0];
					$sql = "select *  from reading_material where link='".$rdt['source']."'";
					$rmt = $this->db->query($sql)->row_array();
				
					$reading_es=array( "content"=>$rmt['content'],
									"question"=> $rdt['qid'],
									"img"=> $rmt['img'],
									"title"=> $rmt['title']
									);
					
					
					$rdt = $rdtar[1%count($rdtar)];
					$sql = "select *  from reading_material where link='".$rdt['source']."'";
					$rmt = $this->db->query($sql)->row_array();
										 
					$reading_nm=array( "content"=>$rmt['content'],
									"question"=> $rdt['qid'],
									"img"=> $rmt['img'],
									"title"=> $rmt['title']
									);
									
					$rdt = $rdtar[2%count($rdtar)];
					$sql = "select *  from reading_material where link='".$rdt['source']."'";
					$rmt = $this->db->query($sql)->row_array();

					$reading_ha=array( "content"=>$rmt['content'],
									"question"=> $rdt['qid'],
									"img"=> $rmt['img'],
									"title"=> $rmt['title']
									);
				}
				
				//mutigrade
				//$sql = "select qid,question, source from savsoft_qbank where type=2 and $multigrade and cid!=29 order by rand() limit 3";
				
				
				if($child['grade']==3 || $child['grade']==4|| $child['grade']==5){
					$mvlid = 'lid=8';
				}
				else{
					$mvlid = $multigrade;
				}
					
				$sql = "select qid,question, source,points from savsoft_qbank where deleted=0 and status=1 and type=2 and ".$mvlid." and cid!=29 and question not like '%facebook%' order by rand() limit 3";
				$vdtar = $this->db->query($sql)->result_array();
				if(count($vdtar)>0){
					$index_es = 0;
					$index_nm = 1%count($vdtar);
					$index_ha = 2%count($vdtar);

					$vdt = $vdtar[$index_es];	
					$vidlink="";
					$vques= array();
					$img_video="";
					$video_title="";		
					preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 if(strpos($match[1],'youtube')!==false){
							 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
							 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
							 $sqll= "select title from savsoft_library where content like '%$vid%'";
							 $video_title=$this->db->query($sqll)->row_array()['title'];
							 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
						 }
						 else if(strpos($match[1],'facebook')!==false){
							$start = strpos($match[1],"href=");
							//$end = strpos($match[1],"&amp;");
							$vidlink= substr($match[1],$start+5);
							$vidlink=str_replace("%3A",":",$vidlink);
							$vidlink=str_replace("%2F","/",$vidlink);
							
							
							$posvideo=strpos($match[1],"videos%2F");
							$temp= substr($match[1],$posvideo+9);
							$posid=strpos($temp,"%2F");
							$vid= substr($temp,0,$posid);
							$sqll= "select title from savsoft_library where source_id=$vid";
							$vdtz= $this->db->query($sqll)->row_array();
							$video_title=$vdtz['title'];
							
							$img_video="https://graph.facebook.com/$vid/picture";
						 }
					} 
					
					
					$video_es = array( "video"=> $vidlink,
									"question"=> $vdt['qid'],
									"img"=> $img_video,
									"title"=>$video_title,
									);
					
					/***/
					$vdt = $vdtar[$index_nm];	
					$vidlink="";
					$vques= array();
					$img_video="";
					$video_title="";
					preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 if(strpos($match[1],'youtube')!==false){
							 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
							 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
							 $sqll= "select title from savsoft_library where content like '%$vid%'";
							 $video_title=$this->db->query($sqll)->row_array()['title'];
							 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
						 }
						 else if(strpos($match[1],'facebook')!==false){
							$start = strpos($match[1],"href=");
							//$end = strpos($match[1],"&amp;");
							$vidlink= substr($match[1],$start+5);
							$vidlink=str_replace("%3A",":",$vidlink);
							$vidlink=str_replace("%2F","/",$vidlink);
							
							
							$posvideo=strpos($match[1],"videos%2F");
							$temp= substr($match[1],$posvideo+9);
							$posid=strpos($temp,"%2F");
							$vid= substr($temp,0,$posid);
							$sqll= "select title from savsoft_library where source_id=$vid";
							$vdtz= $this->db->query($sqll)->row_array();
							$video_title=$vdtz['title'];
							
							$img_video="https://graph.facebook.com/$vid/picture";
						 }
					} 
						
					$video_nm = array( "video"=> $vidlink,
									"question"=> $vdt['qid'],
									"img"=> $img_video,
									"title"=>$video_title);		

					$vdt = $vdtar[$index_ha];	
					$vidlink="";
					$vques= array();
					$img_video="";
					$video_title="";
						
					preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 if(strpos($match[1],'youtube')!==false){
							 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
							 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
							 $sqll= "select title from savsoft_library where content like '%$vid%'";
							 $video_title=$this->db->query($sqll)->row_array()['title'];
							 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
						 }
						 else if(strpos($match[1],'facebook')!==false){
							$start = strpos($match[1],"href=");
							//$end = strpos($match[1],"&amp;");
							$vidlink= substr($match[1],$start+5);
							$vidlink=str_replace("%3A",":",$vidlink);
							$vidlink=str_replace("%2F","/",$vidlink);
							
							
							$posvideo=strpos($match[1],"videos%2F");
							$temp= substr($match[1],$posvideo+9);
							$posid=strpos($temp,"%2F");
							$vid= substr($temp,0,$posid);
							$sqll= "select title from savsoft_library where source_id=$vid";
							$vdtz= $this->db->query($sqll)->row_array();
							$video_title=$vdtz['title'];
							
							$img_video="https://graph.facebook.com/$vid/picture";
						 }
					} 
						
					$video_ha = array( "video"=> $vidlink,
									"question"=> $vdt['qid'],
									"img"=> $img_video,
									"title"=>$video_title
									);							
				}					
				
				$uid = $child['uid'];
				
				$clid= $child['grade'];
				
				$quiz_name="Bài học cùng con ngày ".$today1." - Ngắn";
				$qids=$qids_es;
				$noq=count(explode(",", $qids));
				$level_hard=1;
				$reading_mcq=$reading_es['question'];
				$reading=$reading_es["content"];
				$reading_title=$reading_es["title"];
				$img_reading=$reading_es["img"];
				$video_mcq=$video_es['question'];
				$video_title=$video_es['title'];
				$img_video=$video_es['img'];
				
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$clid,$level_hard,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
				
				$quiz_name="Bài học cùng con ngày ".$today1." - Vừa";
				$qids=$qids_nm;
				$noq=count(explode(",", $qids));
				$level_hard=2;		
				$reading_mcq=$reading_nm['question'];
				$reading=$reading_nm["content"];
				$reading_title=$reading_nm["title"];
				$img_reading=$reading_nm["img"];		
				$video_mcq=$video_nm['question'];
				$video_title=$video_nm['title'];
				$img_video=$video_nm['img'];
					
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$clid,$level_hard,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
				
				$quiz_name="Bài học cùng con ngày ".$today1." - Dài";
				$qids=$qids_ha;
				$noq=count(explode(",", $qids));
				$level_hard=3;
				$reading_mcq=$reading_ha['question'];
				$reading=$reading_ha["content"];
				$reading_title=$reading_ha["title"];
				$img_reading=$reading_ha["img"];		
				$video_mcq=$video_ha['question'];
				$video_title=$video_ha['title'];
				$img_video=$video_ha['img'];
				
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$clid,$level_hard,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
			
			}	

			
		}

	
	}
	
	
	function create_fun_quiz_assign($key, $distinceday=1){
		if($key=='ctv1xnvhk078j5h0c2bjq5wp1pennqoyizswcdbc'){
			$distince_time="+$distinceday day";
			$today=  date("Y-m-d", strtotime($distince_time));
			$today1=  date("d-m", strtotime($distince_time));
			
            log_message("error", "_____________________________".$today);
			for($i=0; $i<40; $i++){
				$ignore="";
				
				$sql="Select qid, question,source from savsoft_qbank where deleted=0 and status=1 ";	
				
				$sql_es=$sql." and cid=21 and (type=0 or type is null or type=1) order by rand() limit 3";

				$sql_reading = $sql." and (type=3) and cid=29 order by rand() limit 3";
				$sql_video = $sql." and (type=2) and cid=29 order by rand() limit 3";
				$res2['es'] = $this->db->query($sql_es)->result_array();
				
				$var= $this->db->query($sql_video)->result_array();
				$rar= $this->db->query($sql_reading)->result_array();
				$countv = count($var);
				$countr = count($rar);
				$qidss="";
				foreach($res2['es'] as $k=>$a){
					if($k!=0){
						$qidss.=",";
					}
					$qidss.=$a['qid'];
					
				}
				
				$qids="";
				$arrqid = $this->db->query("select qid from savsoft_qbank where qid in ($qidss) order by cid asc")->result_array();
				foreach($arrqid as $k=>$a){
					if($k!=0){
						$qids.=",";
					}
					$qids.=$a['qid'];
					
				}
				$ignore= $qids;
				$sql_nm=$sql." and cid=21 and (type=0 or type is null or type=1) and qid not in ($ignore) order by rand() limit 5";
				$res2['nm'] = $this->db->query($sql_nm)->result_array();
				
				$quiz_name="Bài kỹ năng sống ngày ".$today1." - Ngắn";

				$noq= 3;
				$uid=0;
				//$day=date("Y-m-d");
				$level_hard= 4;
				//jd change lid
				$lid= 8;
				$reading_mcq= $rar[0]['qid'];
				$video_mcq= $var[0]['qid'];
				$this->db->where("link",$rar[0]['source']);
				$rm=$this->db->get("reading_material")->row_array();
				$reading=$rm['content'];
				$reading_title=$rm['title'];
				$img_reading=$rm['img'];
				preg_match_all('/<iframe[^>]+>/i',$var[0]['question'], $vidTags); 
				if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
					 $sqll= "select title from savsoft_library where content like '%$vid%'";
					 $video_title=$this->db->query($sqll)->row_array()['title'];
				} 
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard,$i,0, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
				
				
				$qidss="";
				foreach($res2['nm'] as $k=>$a){
					if($k!=0){
						$qidss.=",";
					}
					$qidss.=$a['qid'];
					
				}
				
				$qids="";
				$arrqid = $this->db->query("select qid from savsoft_qbank where qid in ($qidss) order by cid asc")->result_array();
				foreach($arrqid as $k=>$a){
					if($k!=0){
						$qids.=",";
					}
					$qids.=$a['qid'];
					
				}
				$ignore.=",".$qids;
				$sql_ha=$sql." and cid=21 and (type=0 or type is null or type=1) and qid not in ($ignore) order by rand() limit 7";
                $res2['ha'] = $this->db->query($sql_ha)->result_array();
				
				$quiz_name="Bài kỹ năng sống ngày ". $today1." - Vừa";
				//$qids="100,101";
				$noq= 5;
				$uid=0;
				//$day=date("Y-m-d");
				$level_hard= 5;
				$lid= 8;
				$reading_mcq= $rar[1%$countr]['qid'];
				$video_mcq= $var[1%$countv]['qid'];
				$this->db->where("link",$rar[1%$countr]['source']);
				$rm=$this->db->get("reading_material")->row_array();
				$reading=$rm['content'];
				$reading_title=$rm['title'];
				$img_reading=$rm['img'];
				
				preg_match_all('/<iframe[^>]+>/i',$var[1%$countv]['question'], $vidTags); 
				if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
					 $sqll= "select title from savsoft_library where content like '%$vid%'";
					 $video_title=$this->db->query($sqll)->row_array()['title'];
				} 
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard,$i,0, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
				$qidss="";
				foreach($res2['ha'] as $k=>$a){
					if($k!=0){
						$qidss.=",";
					}
					$qidss.=$a['qid'];
					
				}
				$qids="";
				$arrqid = $this->db->query("select qid from savsoft_qbank where qid in ($qidss) order by cid asc")->result_array();
				foreach($arrqid as $k=>$a){
					if($k!=0){
						$qids.=",";
					}
					$qids.=$a['qid'];
					
				}
				
				$quiz_name="Bài kỹ năng sống ngày ". $today1." - Dài";
				//$qids="100,101";
				$noq= 7;
				$uid=0;
				//$day=date("Y-m-d");
				$level_hard= 6;
				$lid= 8;
				$reading_mcq= $rar[2%$countr]['qid'];
				$video_mcq= $var[2%$countv]['qid'];
				
				$this->db->where("link",$rar[2%$countr]['source']);
				$rm=$this->db->get("reading_material")->row_array();
				$reading=$rm['content'];
				$reading_title=$rm['title'];
				$img_reading=$rm['img'];
				preg_match_all('/<iframe[^>]+>/i',$var[2%$countv]['question'], $vidTags); 
				if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
					 $sqll= "select title from savsoft_library where content like '%$vid%'";
					 $video_title=$this->db->query($sqll)->row_array()['title'];
				} 
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard,$i,0, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
			
			}
		}

	}
	function create_fun_quiz_assign2($key, $distinceday=1){
		if($key=='ctv1xnvhk078j5h0c2bjq5wp1pennqoyizswcdbc'){

			for($lid=8; $lid<=14; $lid++ ){
				$distince_time="+$distinceday day";
				$today=  date("Y-m-d", strtotime($distince_time));
				$today1=  date("d-m", strtotime($distince_time));
				
	            log_message("error", "_____________________________".$today."Lớp: ".$lid-2);
	            
				for($i=0; $i<20; $i++){
					$ignore="";
					
					$sql="Select qid, question,source from savsoft_qbank where deleted=0 and status=1 and lid=$lid";	
					
					$sql_es=$sql." and cid=21 and (type=0 or type is null or type=1) order by rand() limit 3";

					$sql_reading = $sql." and (type=3) and cid=29 order by rand() limit 3";
					$sql_video = $sql." and (type=2) and cid=29 order by rand() limit 3";
					$res2['es'] = $this->db->query($sql_es)->result_array();
					
					$var= $this->db->query($sql_video)->result_array();
					$rar= $this->db->query($sql_reading)->result_array();
					$countv = count($var);
					$countr = count($rar);
					$qidss="";
					foreach($res2['es'] as $k=>$a){
						if($k!=0){
							$qidss.=",";
						}
						$qidss.=$a['qid'];
						
					}
					
					$qids="";
					$arrqid = $this->db->query("select qid from savsoft_qbank where qid in ($qidss) order by cid asc")->result_array();
					foreach($arrqid as $k=>$a){
						if($k!=0){
							$qids.=",";
						}
						$qids.=$a['qid'];
						
					}
					$ignore= $qids;
					$sql_nm=$sql." and cid=21 and (type=0 or type is null or type=1) and qid not in ($ignore) order by rand() limit 5";
					$res2['nm'] = $this->db->query($sql_nm)->result_array();
					
					$quiz_name="Bài kỹ năng sống ngày ".$today1." - Ngắn";

					$noq= 3;
					$uid=0;
					//$day=date("Y-m-d");
					$level_hard= 4;
					//jd change lid
					
					if($rar[0]['qid']){
						$reading_mcq= $rar[0]['qid'];
						$this->db->where("link",$rar[0]['source']);
						$rm=$this->db->get("reading_material")->row_array();
						$reading=$rm['content'];
						$reading_title=$rm['title'];
						$img_reading=$rm['img'];
					}else{
						$reading_mcq= null;
						$reading= null;
						$reading_title= null;
						$img_reading=null;
					}
					
					if($var[0]['qid']){
						$video_mcq= $var[0]['qid'];
						preg_match_all('/<iframe[^>]+>/i',$var[0]['question'], $vidTags); 
						if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
						 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
						 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
						 $sqll= "select title from savsoft_library where content like '%$vid%'";
						 $video_title=$this->db->query($sqll)->row_array()['title'];
					} 
					}else{
						$video_mcq= null;
						$video_title= null;
						$img_video= null;
					}

					
					
					
					
					if($qids){
						$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard,$i,0, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
					}else{
						echo 'Lỗi: <br>';
						echo 'Lớp: '.$lid-2;

					}
					
					 
					
					$qidss="";
					foreach($res2['nm'] as $k=>$a){
						if($k!=0){
							$qidss.=",";
						}
						$qidss.=$a['qid'];
					
					}
					
					$qids="";
					$arrqid = $this->db->query("select qid from savsoft_qbank where qid in ($qidss) order by cid asc")->result_array();
					foreach($arrqid as $k=>$a){
						if($k!=0){
							$qids.=",";
						}
						$qids.=$a['qid'];
						 
						
					}
					$ignore.=",".$qids;
					$sql_ha=$sql." and cid=21 and (type=0 or type is null or type=1) and qid not in ($ignore) order by rand() limit 7";
	                $res2['ha'] = $this->db->query($sql_ha)->result_array();
					
					$quiz_name="Bài kỹ năng sống ngày ". $today1." - Vừa";
					//$qids="100,101";
					$noq= 5;
					$uid=0;
					//$day=date("Y-m-d");
					$level_hard= 5;
					if($countr>0){
						if($rar[1%$countr]['qid']){
							$reading_mcq= $rar[1%$countr]['qid'];
							$this->db->where("link",$rar[1%$countr]['source']);
							$rm=$this->db->get("reading_material")->row_array();
							$reading=$rm['content'];
							$reading_title=$rm['title'];
							$img_reading=$rm['img'];
							 
						}else{
							 
							$reading_mcq= null;
							$reading= null;
							$reading_title= null;
							$img_reading=null;
						}
					}else{
							$reading_mcq= null;
							$reading= null;
							$reading_title= null;
							$img_reading=null;
					}
					
					if($countv>0){
						if($var[1%$countv]['qid']){
							$video_mcq= $var[1%$countv]['qid'];
							preg_match_all('/<iframe[^>]+>/i',$var[1%$countv]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
								 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
								 $sqll= "select title from savsoft_library where content like '%$vid%'";
								 $video_title=$this->db->query($sqll)->row_array()['title'];
							} 
						}else{
							$video_mcq= null;
							$video_title= null;
							$img_video= null;
						}
					}else{
							$video_mcq= null;
							$video_title= null;
							$img_video= null;
					}
					
					
					if($qids){
						 
						$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard,$i,0, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
					}else{
						echo 'Lỗi: <br>';
						echo 'Lớp: '.$lid-2;

					}

					
					$qidss="";
					foreach($res2['ha'] as $k=>$a){
						if($k!=0){
							$qidss.=",";
						}
						$qidss.=$a['qid'];
						
					}
					$qids="";
					$arrqid = $this->db->query("select qid from savsoft_qbank where qid in ($qidss) order by cid asc")->result_array();
					foreach($arrqid as $k=>$a){
						if($k!=0){
							$qids.=",";
						}
						$qids.=$a['qid'];
						
					}
					
					$quiz_name="Bài kỹ năng sống ngày ". $today1." - Dài";
					//$qids="100,101";
					$noq= 7;
					$uid=0;
					//$day=date("Y-m-d");
					$level_hard= 6;

					if($countr>0){
						if($rar[2%$countr]['qid']){
							$reading_mcq= $rar[2%$countr]['qid'];
							$this->db->where("link",$rar[2%$countr]['source']);
							$rm=$this->db->get("reading_material")->row_array();
							$reading=$rm['content'];
							$reading_title=$rm['title'];
							$img_reading=$rm['img'];
						}else{
							$reading_mcq= null;
							$reading= null;
							$reading_title= null;
							$img_reading=null;
						}
					}else{

							$reading_mcq= null;
							$reading= null;
							$reading_title= null;
							$img_reading=null;
					}
					
					if($countv>0){
						if($var[2%$countv]['qid']){
							$video_mcq= $var[2%$countv]['qid'];
							preg_match_all('/<iframe[^>]+>/i',$var[2%$countv]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
								 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
								 $sqll= "select title from savsoft_library where content like '%$vid%'";
								 $video_title=$this->db->query($sqll)->row_array()['title'];
							} 
						}else{
							$video_mcq= null;
							$video_title= null;
							$img_video= null;
						}
					}else{
							$video_mcq= null;
							$video_title= null;
							$img_video= null;
					}
					

					
					if($qids){
						$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$lid,$level_hard,$i,0, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
					}else{
						echo 'Lỗi: <br>';
						echo 'Lớp: '.$lid-2;

					}
				
				}
			}
			
		}

	}
	
	
	function get_fun_quiz($parentid,$childid, $page=0){
		$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",'12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'GDCD','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học');
		$res= array();
		for($i=5*$page; $i<5*($page+1);$i++){
			$today= date("Y-m-d", strtotime("-$i day"));
			$set=0;
			if($today>"2019-03-26"){
				$this->db->where("day", $today);
				$this->db->where("uid", $childid);
				$dataset=$this->db->get("recommend_assign")->row_array();
				if($dataset){
					$set=$dataset['set'];
				}
				else{
					$set= rand(0,19);
					$this->db->insert("recommend_assign", array("uid"=>$childid,"set"=>$set,"day"=>$today));
				}
				
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
				$this->db->where('day', $today);
				$this->db->where('level_hard',4);
				$this->db->where('for_uid',0);
				$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_es=$this->db->get('savsoft_quiz')->row_array();
				$img_es= array();
				$question_es= array();
				$rquestion_es=array();
				$rquestion_es_link="";
				$rquestion_es_content="";
				$vquestion_es_video="";
				$vquestion_es_title="";
				$rquestion_es_title="";
                $vquestion_es=array();
				$total_point_es=0;
				if($data_es){
					
					$sql = "select question,cid,points from savsoft_qbank where qid in (".$data_es['qids'].") order by cid asc";
					$q_es = $this->db->query($sql)->result_array();
					$cid_es= array();
					$cid_ar_es= array();
					foreach($q_es as $q){
						if(!in_array($q['cid'],$cid_es)){
							array_push($cid_es,$q['cid']);
							array_push($cid_ar_es,array());
						}
						$total_point_es+= $q['points'];
					}
					foreach($q_es as $q){
						
						
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_es, array("url"=>$img)); 
						
						
						$index=array_search($q['cid'],$cid_es);
						array_push($cid_ar_es[$index], array("title"=>strip_tags($q['question'])));
						
					}
					
					foreach($cid_ar_es as $k=>$d){
						array_push($question_es, array("subject"=>$array_map[$cid_es[$k]],"question"=>$d)); 
					}
					if($data_es['reading_mcq']){
						$rquestion_es_content=$data_es['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['reading_mcq'].")";
						$rq_es = $this->db->query($rsql)->result_array();
						if($rq_es){
							$rquestion_es_link=$rq_es[0]['source'];
						}
						foreach($rq_es as $q){
							array_push($rquestion_es, array("title"=>strip_tags($q['question']))); 
							$total_point_es+= $q['points'];
						    
						}
									
				        $rquestion_es_title=$data_es['reading_title'];
					
					}
					else{
						
					}
				    if($data_es['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['video_mcq'].")";
						$vq_es = $this->db->query($vsql)->result_array();
						if($vq_es){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_es[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_es_video="https://www.youtube.com/v/".$vid."?version=3&loop=1&playlist=".$vid;
								 
							} 
						}
						foreach($vq_es as $q){
							array_push($vquestion_es, array("title"=>strip_tags($q['question']))); 
							$total_point_es+= $q['points'];
						}
						
						$vquestion_es_title=$data_es['video_title'];
					}
					else{
						
					}
					
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_es['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					log_message("error",$data_es['quid']. " **********".$n['rid']);
					if($n){
						$status_es= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_es=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							
							if($per_es || $per_es==0){
								$per_es= "Đã làm: ".number_format($per_es,1)."%";
								$rid_es=$n['rid'];
								
							}
						}
						
					}
					else
					   $status_es= 0;
					
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
				$this->db->where('day', $today);
				$this->db->where('level_hard',5);
				$this->db->where('for_uid',0);
				$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_nm=$this->db->get('savsoft_quiz')->row_array();
				$img_nm= array();
				$question_nm= array();
				$rquestion_nm= array();
				$rquestion_nm_link="";
				$vquestion_nm_video="";
				$rquestion_nm_content="";
				$vquestion_nm_title="";
				$rquestion_nm_title="";
                $vquestion_nm=array();
				$total_point_nm=0;
				if($data_nm){
					
					$sql = "select question,cid,points from savsoft_qbank where qid in (".$data_nm['qids'].") order by cid asc";
					$q_nm = $this->db->query($sql)->result_array();
					
					$cid_nm= array();
					$cid_ar_nm= array();
					foreach($q_nm as $q){
						if(!in_array($q['cid'],$cid_nm)){
							array_push($cid_nm,$q['cid']);
							array_push($cid_ar_nm,array());
						}
						$total_point_nm+= $q['points'];
					}
					foreach($q_nm as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_nm, array("url"=>$img)); 
					    $index=array_search($q['cid'],$cid_nm);
						array_push($cid_ar_nm[$index], array("title"=>strip_tags($q['question'])));						
						
					}
					
					foreach($cid_ar_nm as $k=>$d){
						array_push($question_nm, array("subject"=>$array_map[$cid_nm[$k]],"question"=>$d)); 
					}
					if($data_nm['reading_mcq']){
						$rquestion_nm_content=$data_nm['reading'];
						$rsql = "select question,source,qid,points from savsoft_qbank where qid in (".$data_nm['reading_mcq'].")";
						$rq_nm = $this->db->query($rsql)->result_array();
						if($rq_nm){
							$rquestion_nm_link=$rq_nm[0]['source'];
						}
						foreach($rq_nm as $q){
							array_push($rquestion_nm, array("title"=>strip_tags($q['question'])));
							$total_point_nm+= $q['points'];							
						}
						$rquestion_nm_title=$data_nm['reading_title'];
					}
					if($data_nm['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_nm['video_mcq'].")";
						$vq_nm = $this->db->query($vsql)->result_array();
						if($vq_nm){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_nm[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_nm_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_nm as $q){
							array_push($vquestion_nm, array("title"=>strip_tags($q['question']))); 
							$total_point_nm+= $q['points'];
						}
						$vquestion_nm_title=$data_nm['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_nm['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					if($n){
						$status_nm= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_nm=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_nm || $per_nm==0){
								$per_nm= "Đã làm: ".number_format($per_nm,1)."%";
								$rid_nm=$n['rid'];
							}
					    }
					}
					else
					   $status_nm= 0;
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
				$this->db->where('day', $today);
				$this->db->where('level_hard',6);
				$this->db->where('for_uid',0);
				$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_ha=$this->db->get('savsoft_quiz')->row_array();
				$img_ha= array();
				$question_ha= array();
				$rquestion_ha= array();
				$rquestion_ha_link="";
				$vquestion_ha_video="";
				$rquestion_ha_content="";
				$vquestion_ha_title="";
				$rquestion_ha_title="";
                $vquestion_ha=array();
				$total_point_ha=0;
				if($data_ha){
					$sql = "select question,cid,points from savsoft_qbank where qid in (".$data_ha['qids'].") order by cid asc";
					$q_ha = $this->db->query($sql)->result_array();
					
					$cid_ha= array();
					$cid_ar_ha= array();
					foreach($q_ha as $q){
						if(!in_array($q['cid'],$cid_ha)){
							array_push($cid_ha,$q['cid']);
							array_push($cid_ar_ha,array());
						}
						$total_point_ha+= $q['points'];
					}
					foreach($q_ha as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_ha, array("url"=>$img)); 
						$index=array_search($q['cid'],$cid_ha);
						array_push($cid_ar_ha[$index], array("title"=>strip_tags($q['question'])));
					}
					
					foreach($cid_ar_ha as $k=>$d){
						array_push($question_ha, array("subject"=>$array_map[$cid_ha[$k]],"question"=>$d)); 
					}
					if($data_ha['reading_mcq']){
						$rquestion_ha_content=$data_ha['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['reading_mcq'].")";
						$rq_ha = $this->db->query($rsql)->result_array();
						if($rq_ha){
							$rquestion_ha_link=$rq_ha[0]['source'];
						}
						foreach($rq_ha as $q){
							array_push($rquestion_ha, array("title"=>strip_tags($q['question']))); 
							$total_point_ha+= $q['points'];
							
						}
						
						$rquestion_ha_title=$data_ha['reading_title'];
					}
					if($data_ha['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['video_mcq'].")";
						$vq_ha = $this->db->query($vsql)->result_array();
						if($vq_ha){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_ha[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								   $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_ha_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_ha as $q){
							array_push($vquestion_ha, array("title"=>strip_tags($q['question']))); 
							$total_point_ha+= $q['points'];
						}
						$vquestion_ha_title=$data_ha['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_ha['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					if($n){
						$status_ha= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_ha=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_ha || $per_ha==0){
								$per_ha= "Đã làm: ".number_format($per_ha,1)."%";
								$rid_ha=$n['rid'];
							}
						}
					}
					else
					   $status_ha= 0;
				}
				
				 
				$r = array(
							 "date"=> $ardow[date('w',strtotime("-$i day"))].", ".date("d / m", strtotime("-$i day")),
							"assignments"=>array( array("level"=>"Ngắn (3 câu)",
							                            "quiz"=> array("quid"=>$data_es['quid'],
														                "total_points"=>$total_point_es,
																		"number_question"=>$data_es['noq'],
																	    "status"=>$status_es,
																		"message_do"=> $per_es,
																		"rid"=>$rid_es,
																		"tasks"=>array(),
																		"images"=>$img_es,
																	    "question"=>$question_es,
																			  ),
															  "reading"=>array("link"=>$rquestion_es_link,
															                //   "content"=>$rquestion_es_content,
																			   "question"=>$rquestion_es,
																			   "img"=>$data_es["img_reading"],
																			   "title"=>$rquestion_es_title),
															  "video"=>array("video"=>$vquestion_es_video,
																			   "question"=>$vquestion_es,
																			   "img"=>$data_es["img_video"],
																			   "title"=>$vquestion_es_title)			   
														),
											      array("level"=>"Vừa (5 câu)",
											              "quiz"=>array("quid"=>$data_nm['quid'],
														      "total_points"=>$total_point_nm,
															  "number_question"=>$data_nm['noq'],
															  "status"=>$status_nm,
															  "message_do"=> $per_nm,
															  "rid"=>$rid_nm,
															  "tasks"=>array(),
															  "images"=>$img_nm,
															  "question"=>$question_nm),
												          "reading"=>array("link"=>$rquestion_nm_link,
																		  // "content"=>$rquestion_nm_content,
																		   "question"=>$rquestion_nm,
																		   "img"=>$data_nm["img_reading"],
																		   "title"=>$rquestion_nm_title),
														  "video"=>array("video"=>$vquestion_nm_video,
																		   "question"=>$vquestion_nm,
																		   "img"=>$data_nm["img_video"],
																		   "title"=>$vquestion_nm_title)	
											        ),
												  array("level"=>"Dài (7 câu)",
												       "quiz"=>array("quid"=>$data_ha['quid'],
													                  "total_points"=>$total_point_ha,
																	  "number_question"=>$data_ha['noq'],
																	  "status"=>$status_ha,
																	  "message_do"=> $per_ha,
																	  "rid"=>$rid_ha,
																	  "tasks"=>array(),
																	  "images"=>$img_ha,
																	   "question"=>$question_ha),
													   "reading"=>array("link"=>$rquestion_ha_link,
													                   //"content"=>$rquestion_ha_content,
												                        "question"=>$rquestion_ha,
																		"img"=>$data_ha["img_reading"],
																		"title"=>$rquestion_ha_title),
														"video"=>array("video"=>$vquestion_ha_video,
																	   "question"=>$vquestion_ha,
																	   "img"=>$data_ha["img_video"],
																	   "title"=>$vquestion_ha_title)	
												   )
												),
							 );
				array_push($res, $r);
			}
		}	
	    echo json_encode($res);
	}
	
	
	function get_fun_quiz2($parentid,$childid, $page=0){
		$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",'12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'GDCD','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học');
		$res= array();
		for($i=5*$page; $i<5*($page+1);$i++){
			$today= date("Y-m-d", strtotime("-$i day"));
			$set=0;
			if($today>"2019-03-28"){
				$this->db->where("day", $today);
				$this->db->where("uid", $childid);
				$dataset=$this->db->get("recommend_assign")->row_array();
				if($dataset){
					$set=$dataset['set'];
				}
				else{
					$set= rand(0,19);
					$this->db->insert("recommend_assign", array("uid"=>$childid,"set"=>$set,"day"=>$today));
				}
				
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
				$this->db->where('day', $today);
				$this->db->where('level_hard',4);
				$this->db->where('for_uid',0);
				$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_es=$this->db->get('savsoft_quiz')->row_array();
				$img_es= array();
				$question_es=array();
				$rquestion_es=array();
				$rquestion_es_link="";
				$rquestion_es_content="";
				$vquestion_es_video="";
				$vquestion_es_title="";
				$rquestion_es_title="";
                $vquestion_es=array();
				$total_point_es=0;
				if($data_es){
					
					$sql = "select question from savsoft_qbank where qid in (".$data_es['qids'].") order by cid asc";
					$q_es = $this->db->query($sql)->result_array();
					
					foreach($q_es as $k=>$q){
	
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_es, array("url"=>$img)); 
                        array_push($question_es,array("title"=>strip_tags($htmlContent)));
						
					}
					
					
					if($data_es['reading_mcq']){
						$rquestion_es_content=$data_es['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['reading_mcq'].")";
						$rq_es = $this->db->query($rsql)->result_array();
						if($rq_es){
							$rquestion_es_link=$rq_es[0]['source'];
						}
						foreach($rq_es as $q){
							array_push($rquestion_es, array("title"=>strip_tags($q['question']))); 
							//$total_point_es+= $q['points'];
						    
						}
									
				        $rquestion_es_title=$data_es['reading_title'];
					
					}
					else{
						
					}
				    if($data_es['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['video_mcq'].")";
						$vq_es = $this->db->query($vsql)->result_array();
						if($vq_es){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_es[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
								
								 
							} 
						}
						foreach($vq_es as $q){
							array_push($vquestion_es, array("title"=>strip_tags($q['question']))); 
							//$total_point_es+= $q['points'];
						}
						
						$vquestion_es_title=$data_es['video_title'];
					}
					else{
						
					}
					
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_es['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					log_message("error",$data_es['quid']. " **********".$n['rid']);
					$per_es="";
					if($n){
						$status_es= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_es=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							
							if($per_es || $per_es==0){
								$per_es= "Đã làm: ".number_format($per_es,1)."%";
								$rid_es=$n['rid'];
								
							}
						}
						
					}
					else
					   $status_es= 0;
					
					
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
				$this->db->where('day', $today);
				$this->db->where('level_hard',5);
				$this->db->where('for_uid',0);
				$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_nm=$this->db->get('savsoft_quiz')->row_array();
				$img_nm= array();
				$question_nm= array();
				$rquestion_nm= array();
				$rquestion_nm_link="";
				$vquestion_nm_video="";
				$rquestion_nm_content="";
				$vquestion_nm_title="";
				$rquestion_nm_title="";
                $vquestion_nm=array();
				$total_point_nm=0;
				if($data_nm){
					
					$sql = "select question from savsoft_qbank where qid in (".$data_nm['qids'].") order by cid asc";
					$q_nm = $this->db->query($sql)->result_array();
					
					foreach($q_nm as $k=>$q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_nm, array("url"=>$img)); 
					  	array_push($question_nm,array("title"=>strip_tags($htmlContent)));			
						
					}
					if($data_nm['reading_mcq']){
						$rquestion_nm_content=$data_nm['reading'];
						$rsql = "select question,source,qid,points from savsoft_qbank where qid in (".$data_nm['reading_mcq'].")";
						$rq_nm = $this->db->query($rsql)->result_array();
						if($rq_nm){
							$rquestion_nm_link=$rq_nm[0]['source'];
						}
						foreach($rq_nm as $q){
							array_push($rquestion_nm, array("title"=>strip_tags($q['question'])));
							//$total_point_nm+= $q['points'];							
						}
						$rquestion_nm_title=$data_nm['reading_title'];
					}
					if($data_nm['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_nm['video_mcq'].")";
						$vq_nm = $this->db->query($vsql)->result_array();
						if($vq_nm){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_nm[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_nm_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_nm as $q){
							array_push($vquestion_nm, array("title"=>strip_tags($q['question']))); 
							//$total_point_nm+= $q['points'];
						}
						$vquestion_nm_title=$data_nm['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_nm['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					$per_nm="";
					if($n){
						$status_nm= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_nm=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_nm || $per_nm==0){
								$per_nm= "Đã làm: ".number_format($per_nm,1)."%";
								$rid_nm=$n['rid'];
							}
					    }
					}
					else
					   $status_nm= 0;
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
				$this->db->where('day', $today);
				$this->db->where('level_hard',6);
				$this->db->where('for_uid',0);
				$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_ha=$this->db->get('savsoft_quiz')->row_array();
				$img_ha= array();
				$question_ha= array();
				$rquestion_ha= array();
				$rquestion_ha_link="";
				$vquestion_ha_video="";
				$rquestion_ha_content="";
				$vquestion_ha_title="";
				$rquestion_ha_title="";
                $vquestion_ha=array();
				$total_point_ha=0;
				if($data_ha){
					$sql = "select question from savsoft_qbank where qid in (".$data_ha['qids'].") order by cid asc";
					$q_ha = $this->db->query($sql)->result_array();

					foreach($q_ha as $k=>$q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_ha, array("url"=>$img)); 
						array_push($question_ha,array("title"=>strip_tags($htmlContent)));
					}
					
					if($data_ha['reading_mcq']){
						$rquestion_ha_content=$data_ha['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['reading_mcq'].")";
						$rq_ha = $this->db->query($rsql)->result_array();
						if($rq_ha){
							$rquestion_ha_link=$rq_ha[0]['source'];
						}
						foreach($rq_ha as $q){
							array_push($rquestion_ha, array("title"=>strip_tags($q['question']))); 
							//$total_point_ha+= $q['points'];
							
						}
						
						$rquestion_ha_title=$data_ha['reading_title'];
					}
					if($data_ha['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['video_mcq'].")";
						$vq_ha = $this->db->query($vsql)->result_array();
						if($vq_ha){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_ha[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								   $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_ha_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_ha as $q){
							array_push($vquestion_ha, array("title"=>strip_tags($q['question']))); 
							//$total_point_ha+= $q['points'];
						}
						$vquestion_ha_title=$data_ha['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_ha['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					$per_ha="";
					if($n){
						$status_ha= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_ha=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_ha || $per_ha==0){
								$per_ha= "Đã làm: ".number_format($per_ha,1)."%";
								$rid_ha=$n['rid'];
							}
						}
					}
					else
					   $status_ha= 0;
				}
				
				 
				$r = array(
							 "date"=> $ardow[date('w',strtotime("-$i day"))].", ".date("d / m", strtotime("-$i day")),
							"assignments"=>array( array("level"=>"Ngắn",
							                            "quiz"=> array("quid"=>$data_es['quid'],
														                "total_points"=>$total_point_es,
																		"number_question"=>$data_es['noq'],
																	    "status"=>$status_es,
																		"message_do"=> $per_es,
																		"rid"=>$rid_es,
																		"tasks"=>array(),
																		"images"=>$img_es,
																	    "question"=>array(array("subject"=>"","question"=>$question_es)),
																			  ),
															  "reading"=>array("link"=>$rquestion_es_link,
															                //   "content"=>$rquestion_es_content,
																			   "question"=>$rquestion_es,
																			   "img"=>$data_es["img_reading"],
																			   "title"=>$rquestion_es_title),
															  "video"=>array("video"=>$vquestion_es_video,
																			   "question"=>$vquestion_es,
																			   "img"=>$data_es["img_video"],
																			   "title"=>$vquestion_es_title)			   
														),
											      array("level"=>"Vừa",
											              "quiz"=>array("quid"=>$data_nm['quid'],
														      "total_points"=>$total_point_nm,
															  "number_question"=>$data_nm['noq'],
															  "status"=>$status_nm,
															  "message_do"=> $per_nm,
															  "rid"=>$rid_nm,
															  "tasks"=>array(),
															  "images"=>$img_nm,
															  "question"=>array(array("subject"=>"","question"=>$question_nm))
															  ),
												          "reading"=>array("link"=>$rquestion_nm_link,
																		  // "content"=>$rquestion_nm_content,
																		   "question"=>$rquestion_nm,
																		   "img"=>$data_nm["img_reading"],
																		   "title"=>$rquestion_nm_title),
														  "video"=>array("video"=>$vquestion_nm_video,
																		   "question"=>$vquestion_nm,
																		   "img"=>$data_nm["img_video"],
																		   "title"=>$vquestion_nm_title)	
											        ),
												  array("level"=>"Dài",
												       "quiz"=>array("quid"=>$data_ha['quid'],
													                  "total_points"=>$total_point_ha,
																	  "number_question"=>$data_ha['noq'],
																	  "status"=>$status_ha,
																	  "message_do"=> $per_ha,
																	  "rid"=>$rid_ha,
																	  "tasks"=>array(),
																	  "images"=>$img_ha,
																	   "question"=>array(array("subject"=>"","question"=>$question_ha))
																	   ),
													   "reading"=>array("link"=>$rquestion_ha_link,
													                   //"content"=>$rquestion_ha_content,
												                        "question"=>$rquestion_ha,
																		"img"=>$data_ha["img_reading"],
																		"title"=>$rquestion_ha_title),
														"video"=>array("video"=>$vquestion_ha_video,
																	   "question"=>$vquestion_ha,
																	   "img"=>$data_ha["img_video"],
																	   "title"=>$vquestion_ha_title)	
												   )
												),
							 );
				array_push($res, $r);
			}
		}	
	    echo json_encode($res);
	}
	
	function get_fun_quiz3($parentid,$childid, $page=0){
		$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",'12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'GDCD','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học');
		$res= array();

		$lid_sql="select * from savsoft_users where uid=$childid";
		$lid_ar=$this->db->query($lid_sql)->row_array();
		$lid=$lid_ar['grade'];

		if($lid>=3 && $lid<=7){
				$res=array('message'=>'empty');
		}else{

			for($i=5*$page; $i<5*($page+1);$i++){
			$today= date("Y-m-d", strtotime("-$i day"));
			$set=0;
			
			
					if($today>"2019-03-28"){
						$this->db->where("day", $today);
						$this->db->where("uid", $childid);
						$dataset=$this->db->get("recommend_assign")->row_array();
							if($dataset){
								$set=$dataset['set'];
							}
							else{
								$set= rand(0,19);
								$this->db->insert("recommend_assign", array("uid"=>$childid,"set"=>$set,"day"=>$today));
							}
						
						
						$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
						$this->db->where('day', $today);
						$this->db->where('level_hard',4);
						$this->db->where('for_uid',0);
						$this->db->where('set',$set);
						$this->db->where('lid',$lid);
						$this->db->where('deleted',0);
						$data_es=$this->db->get('savsoft_quiz')->row_array();
						log_message('error',json_encode($data_es));
						$img_es= array();
						$question_es=array();
						$rquestion_es=array();
						$rquestion_es_link="";
						$rquestion_es_content="";
						$vquestion_es_video="";
						$vquestion_es_title="";
						$rquestion_es_title="";
		                $vquestion_es=array();
						$total_point_es=0;
						if($data_es){
							
							$sql = "select question from savsoft_qbank where qid in (".$data_es['qids'].") order by cid asc";
							$q_es = $this->db->query($sql)->result_array();
							
							foreach($q_es as $k=>$q){
			
								$origImageSrc="";
								$imgTags="";	
								$htmlContent=$q['question'];
								preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
									for ($j = 0; $j < count($imgTags[0]); $j++) {
										preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
										$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
										
									 }
								 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
									 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
										$img=$origImageSrc;
									 }
									 else{
										
										$img=base_url("/upload/default_image_quiz.png");
									 }			 
								array_push($img_es, array("url"=>$img)); 
		                        array_push($question_es,array("title"=>strip_tags($htmlContent)));
								
							}
							
							
							if($data_es['reading_mcq']){
								$rquestion_es_content=$data_es['reading'];
								$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['reading_mcq'].")";
								$rq_es = $this->db->query($rsql)->result_array();
								if($rq_es){
									$rquestion_es_link=$rq_es[0]['source'];
								}
								foreach($rq_es as $q){
									array_push($rquestion_es, array("title"=>strip_tags($q['question']))); 
									//$total_point_es+= $q['points'];
								    
								}
											
						        $rquestion_es_title=$data_es['reading_title'];
							
							}
							else{
								
							}
						    if($data_es['video_mcq']){
								$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['video_mcq'].")";
								$vq_es = $this->db->query($vsql)->result_array();
								if($vq_es){
									$origvidSrc="";
									$vidTags="";
									preg_match_all('/<iframe[^>]+>/i',$vq_es[0]['question'], $vidTags); 
									if(count($vidTags[0])>0){
										 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
										  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
										 $vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
										
										 
									} 
								}
								foreach($vq_es as $q){
									array_push($vquestion_es, array("title"=>strip_tags($q['question']))); 
									//$total_point_es+= $q['points'];
								}
								
								$vquestion_es_title=$data_es['video_title'];
							}
							else{
								
							}
							
							$this->db->where("auid", $parentid);
							$this->db->where("uid", $childid);
							$this->db->where("quid", $data_es['quid']);
							$n = $this->db->get('savsoft_assign')->row_array() ;
							log_message("error",$data_es['quid']. " **********".$n['rid']);
							$per_es="";
							if($n){
								$status_es= 1;
								if($n['rid']){
									$this->db->select("percentage_obtained");
									$this->db->where('rid', $n['rid']);
									$per_es=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
									
									if($per_es || $per_es==0){
										$per_es= "Đã làm: ".number_format($per_es,1)."%";
										$rid_es=$n['rid'];
										
									}
								}
								
							}
							else
							   $status_es= 0;
							
							
						}
						
						$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
						$this->db->where('day', $today);
						$this->db->where('level_hard',5);
						$this->db->where('for_uid',0);
						$this->db->where('set',$set);
						$this->db->where('lid',$lid);
						$this->db->where('deleted',0);
						$data_nm=$this->db->get('savsoft_quiz')->row_array();
						$img_nm= array();
						$question_nm= array();
						$rquestion_nm= array();
						$rquestion_nm_link="";
						$vquestion_nm_video="";
						$rquestion_nm_content="";
						$vquestion_nm_title="";
						$rquestion_nm_title="";
		                $vquestion_nm=array();
						$total_point_nm=0;
						if($data_nm){
							
							$sql = "select question from savsoft_qbank where qid in (".$data_nm['qids'].") order by cid asc";
							$q_nm = $this->db->query($sql)->result_array();
							
							foreach($q_nm as $k=>$q){
								$origImageSrc="";
								$imgTags="";	
								$htmlContent=$q['question'];
								preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
								for ($j = 0; $j < count($imgTags[0]); $j++) {
									preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
									$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
									
								 }
								 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
								 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
									$img=$origImageSrc;
								 }
								 else{
									
									$img=base_url("/upload/default_image_quiz.png");
								 }			 
								array_push($img_nm, array("url"=>$img)); 
							  	array_push($question_nm,array("title"=>strip_tags($htmlContent)));			
								
							}
							if($data_nm['reading_mcq']){
								$rquestion_nm_content=$data_nm['reading'];
								$rsql = "select question,source,qid,points from savsoft_qbank where qid in (".$data_nm['reading_mcq'].")";
								$rq_nm = $this->db->query($rsql)->result_array();
								if($rq_nm){
									$rquestion_nm_link=$rq_nm[0]['source'];
								}
								foreach($rq_nm as $q){
									array_push($rquestion_nm, array("title"=>strip_tags($q['question'])));
									//$total_point_nm+= $q['points'];							
								}
								$rquestion_nm_title=$data_nm['reading_title'];
							}
							if($data_nm['video_mcq']){
								$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_nm['video_mcq'].")";
								$vq_nm = $this->db->query($vsql)->result_array();
								if($vq_nm){
									$origvidSrc="";
									$vidTags="";
									preg_match_all('/<iframe[^>]+>/i',$vq_nm[0]['question'], $vidTags); 
									if(count($vidTags[0])>0){
										 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
										  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
										 $vquestion_nm_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
									} 
								}
								foreach($vq_nm as $q){
									array_push($vquestion_nm, array("title"=>strip_tags($q['question']))); 
									//$total_point_nm+= $q['points'];
								}
								$vquestion_nm_title=$data_nm['video_title'];
							}
							$this->db->where("auid", $parentid);
							$this->db->where("uid", $childid);
							$this->db->where("quid", $data_nm['quid']);
							$n = $this->db->get('savsoft_assign')->row_array() ;
							$per_nm="";
							if($n){
								$status_nm= 1;
								if($n['rid']){
									$this->db->select("percentage_obtained");
									$this->db->where('rid', $n['rid']);
									$per_nm=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
									if($per_nm || $per_nm==0){
										$per_nm= "Đã làm: ".number_format($per_nm,1)."%";
										$rid_nm=$n['rid'];
									}
							    }
							}
							else
							   $status_nm= 0;
						}
						
						$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
						$this->db->where('day', $today);
						$this->db->where('level_hard',6);
						$this->db->where('for_uid',0);
						$this->db->where('set',$set);
						$this->db->where('lid',$lid);
						$this->db->where('deleted',0);
						$data_ha=$this->db->get('savsoft_quiz')->row_array();
						$img_ha= array();
						$question_ha= array();
						$rquestion_ha= array();
						$rquestion_ha_link="";
						$vquestion_ha_video="";
						$rquestion_ha_content="";
						$vquestion_ha_title="";
						$rquestion_ha_title="";
		                $vquestion_ha=array();
						$total_point_ha=0;
						if($data_ha){
							$sql = "select question from savsoft_qbank where qid in (".$data_ha['qids'].") order by cid asc";
							$q_ha = $this->db->query($sql)->result_array();

							foreach($q_ha as $k=>$q){
								$origImageSrc="";
								$imgTags="";	
								$htmlContent=$q['question'];
								preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
								for ($j = 0; $j < count($imgTags[0]); $j++) {
									preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
									$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
									
								 }
								 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
								 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
									$img=$origImageSrc;
								 }
								 else{
									
									$img=base_url("/upload/default_image_quiz.png");
								 }			 
								array_push($img_ha, array("url"=>$img)); 
								array_push($question_ha,array("title"=>strip_tags($htmlContent)));
							}
							
							if($data_ha['reading_mcq']){
								$rquestion_ha_content=$data_ha['reading'];
								$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['reading_mcq'].")";
								$rq_ha = $this->db->query($rsql)->result_array();
								if($rq_ha){
									$rquestion_ha_link=$rq_ha[0]['source'];
								}
								foreach($rq_ha as $q){
									array_push($rquestion_ha, array("title"=>strip_tags($q['question']))); 
									//$total_point_ha+= $q['points'];
									
								}
								
								$rquestion_ha_title=$data_ha['reading_title'];
							}
							if($data_ha['video_mcq']){
								$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['video_mcq'].")";
								$vq_ha = $this->db->query($vsql)->result_array();
								if($vq_ha){
									$origvidSrc="";
									$vidTags="";
									preg_match_all('/<iframe[^>]+>/i',$vq_ha[0]['question'], $vidTags); 
									if(count($vidTags[0])>0){
										 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
										   $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
										 $vquestion_ha_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
									} 
								}
								foreach($vq_ha as $q){
									array_push($vquestion_ha, array("title"=>strip_tags($q['question']))); 
									//$total_point_ha+= $q['points'];
								}
								$vquestion_ha_title=$data_ha['video_title'];
							}
							$this->db->where("auid", $parentid);
							$this->db->where("uid", $childid);
							$this->db->where("quid", $data_ha['quid']);
							$n = $this->db->get('savsoft_assign')->row_array() ;
							$per_ha="";
							if($n){
								$status_ha= 1;
								if($n['rid']){
									$this->db->select("percentage_obtained");
									$this->db->where('rid', $n['rid']);
									$per_ha=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
									if($per_ha || $per_ha==0){
										$per_ha= "Đã làm: ".number_format($per_ha,1)."%";
										$rid_ha=$n['rid'];
									}
								}
							}
							else
							   $status_ha= 0;
						}

						 
						$r = array(
									 "date"=> $ardow[date('w',strtotime("-$i day"))].", ".date("d / m", strtotime("-$i day")),
									"assignments"=>array( array("level"=>"Ngắn",
									                            "quiz"=> array("quid"=>$data_es['quid'],
																                "total_points"=>$total_point_es,
																				"number_question"=>$data_es['noq'],
																			    "status"=>$status_es,
																				"message_do"=> $per_es,
																				"rid"=>$rid_es,
																				"tasks"=>array(),
																				"images"=>$img_es,
																			    "question"=>array(array("subject"=>"","question"=>$question_es)),
																					  ),
																	  "reading"=>array("link"=>$rquestion_es_link,
																	                //   "content"=>$rquestion_es_content,
																					   "question"=>$rquestion_es,
																					   "img"=>$data_es["img_reading"],
																					   "title"=>$rquestion_es_title),
																	  "video"=>array("video"=>$vquestion_es_video,
																					   "question"=>$vquestion_es,
																					   "img"=>$data_es["img_video"],
																					   "title"=>$vquestion_es_title)			   
																),
													      array("level"=>"Vừa",
													              "quiz"=>array("quid"=>$data_nm['quid'],
																      "total_points"=>$total_point_nm,
																	  "number_question"=>$data_nm['noq'],
																	  "status"=>$status_nm,
																	  "message_do"=> $per_nm,
																	  "rid"=>$rid_nm,
																	  "tasks"=>array(),
																	  "images"=>$img_nm,
																	  "question"=>array(array("subject"=>"","question"=>$question_nm))
																	  ),
														          "reading"=>array("link"=>$rquestion_nm_link,
																				  // "content"=>$rquestion_nm_content,
																				   "question"=>$rquestion_nm,
																				   "img"=>$data_nm["img_reading"],
																				   "title"=>$rquestion_nm_title),
																  "video"=>array("video"=>$vquestion_nm_video,
																				   "question"=>$vquestion_nm,
																				   "img"=>$data_nm["img_video"],
																				   "title"=>$vquestion_nm_title)	
													        ),
														  array("level"=>"Dài",
														       "quiz"=>array("quid"=>$data_ha['quid'],
															                  "total_points"=>$total_point_ha,
																			  "number_question"=>$data_ha['noq'],
																			  "status"=>$status_ha,
																			  "message_do"=> $per_ha,
																			  "rid"=>$rid_ha,
																			  "tasks"=>array(),
																			  "images"=>$img_ha,
																			   "question"=>array(array("subject"=>"","question"=>$question_ha))
																			   ),
															   "reading"=>array("link"=>$rquestion_ha_link,
															                   //"content"=>$rquestion_ha_content,
														                        "question"=>$rquestion_ha,
																				"img"=>$data_ha["img_reading"],
																				"title"=>$rquestion_ha_title),
																"video"=>array("video"=>$vquestion_ha_video,
																			   "question"=>$vquestion_ha,
																			   "img"=>$data_ha["img_video"],
																			   "title"=>$vquestion_ha_title)	
														   )
														),
									 );
						if($data_es['quid']){
							array_push($res, $r);
						}

					}
				}	
			}
			
			
	    echo json_encode($res);
	}
	
    //real
	function get_system_quiz2($parentid,$childid, $page=0){
		$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
		$res= array();
		for($i=5*$page; $i<5*($page+1);$i++){
			$today= date("Y-m-d", strtotime("-$i day"));
			if($today>"2019-02-12"){
				$this->db->distinct();
				$this->db->select("timetable.cid,lid,unit,category_name");
				$this->db->join("savsoft_category", "timetable.cid=savsoft_category.cid");
				$this->db->where("classid","0");
				$this->db->where("day", $today);	
				$this->db->order_by("timetable.cid asc");
				$data= $this->db->get('timetable')->result_array();
				$summary= array();
				foreach($data as $k=>$d){
					$unit = $d['unit'];
					if($unit){
						
						$this->db->where("unit_number",$unit);
						$this->db->where("cid",$d['cid']);
						$this->db->where("lid",$d['lid']);
						$data[$k]['unit_name']= $this->db->get('unit')->row_array()['unit_name'];
						
					}
					else{
						$data[$k]['unit_name']="";
					}
					array_push($summary, array("subject"=>$d['category_name'],"title"=>$data[$k]['unit_name']) );
				}
				
				 if(count($data)==0){
					if(date('w', strtotime($today))==0) 
						$message="Chủ nhật";
					$this->db->where("day",$today);
					$data= $this->db->get("holiday")->row_array();
					if($data){
						$message=$data['description'];
					}
					array_push($summary, array("subject"=>"Nghỉ","title"=>$message) );
				}
				$this->db->select('quid, quiz_name, for_uid, qids,noq');
				$this->db->where('day', $today);
				$this->db->where('level_hard',1);
				$this->db->where('for_uid',0);
				$this->db->where('deleted',0);
				$data_es=$this->db->get('savsoft_quiz')->row_array();
				$img_es= array();
				$question_es= array();
				if($data_es){
					
					$sql = "select question from savsoft_qbank where qid in (".$data_es['qids'].") order by cid asc";
					$q_es = $this->db->query($sql)->result_array();
					foreach($q_es as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_es, array("url"=>$img)); 
						array_push($question_es, array("title"=>strip_tags($q['question']))); 
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_es['quid']);
					$n = $this->db->get('savsoft_assign')->num_rows() ;
					if($n>0)
					   $status_es= 1;
					else
					   $status_es= 0;
					
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq');
				$this->db->where('day', $today);
				$this->db->where('level_hard',2);
				$this->db->where('for_uid',0);
				$this->db->where('deleted',0);
				$data_nm=$this->db->get('savsoft_quiz')->row_array();
				$img_nm= array();
				$question_nm= array();
				if($data_nm){
					
					$sql = "select question from savsoft_qbank where qid in (".$data_nm['qids'].") order by cid asc";
					$q_nm = $this->db->query($sql)->result_array();
					foreach($q_nm as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_nm, array("url"=>$img)); 
						array_push($question_nm, array("title"=>strip_tags($q['question']))); 
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_nm['quid']);
					$n = $this->db->get('savsoft_assign')->num_rows() ;
					if($n>0)
					   $status_nm= 1;
					else
					   $status_nm= 0;
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq');
				$this->db->where('day', $today);
				$this->db->where('level_hard',3);
				$this->db->where('for_uid',0);
				$this->db->where('deleted',0);
				$data_ha=$this->db->get('savsoft_quiz')->row_array();
				$img_ha= array();
				$question_ha= array();
				if($data_ha){
					$sql = "select question from savsoft_qbank where qid in (".$data_ha['qids'].") order by cid asc";
					$q_ha = $this->db->query($sql)->result_array();
					foreach($q_ha as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_ha, array("url"=>$img)); 
						array_push($question_ha, array("title"=>strip_tags($q['question']))); 
					}
					 $this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_ha['quid']);
					$n = $this->db->get('savsoft_assign')->num_rows() ;
					if($n>0)
					   $status_ha= 1;
					else
					   $status_ha= 0;
				}
				
				
				$r = array(
							 "date"=> $ardow[date('w',strtotime("-$i day"))].", ".date("d / m", strtotime("-$i day")),
							"summary"=> $summary,
							"assignments"=>array( array("level"=>"Ngắn (3 câu)",
												  "quid"=>$data_es['quid'],
												  "number_question"=>$data_es['noq'],
												  "status"=>$status_es,
												  "tasks"=>array(),
												  "images"=>$img_es,
												  "question"=>$question_es),
												  array("level"=>"Vừa (5 câu)",
												  "quid"=>$data_nm['quid'],
												  "number_question"=>$data_nm['noq'],
												  "status"=>$status_nm,
												  "tasks"=>array(),
												  "images"=>$img_nm,
												  "question"=>$question_nm),
												  array("level"=>"Dài (7 câu)",
												  "quid"=>$data_ha['quid'],
												  "number_question"=>$data_ha['noq'],
												  "status"=>$status_ha,
												  "tasks"=>array(),
												  "images"=>$img_ha,
												   "question"=>$question_ha)
												),
							 );
				array_push($res, $r);
			}
		}	
	    echo json_encode($res);
	}

    //demo++
	function get_system_quiz3($parentid,$childid, $page=0){
		$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
		$res= array();
		for($i=5*$page; $i<5*($page+1);$i++){
			$today= date("Y-m-d", strtotime("-$i day"));
			if($today>"2019-02-20"){
				$this->db->distinct();
				$this->db->select("demo_timetable.cid,lid,unit,category_name, upcase_name");
				$this->db->join("demo_savsoft_category", "demo_timetable.cid=demo_savsoft_category.cid");
				$this->db->where("classid","0");
				$this->db->where("day", $today);	
				$this->db->order_by("demo_timetable.cid asc");
				$data= $this->db->get('demo_timetable')->result_array();
				$summary= array();
				
				foreach($data as $k=>$d){
					$unit = $d['unit'];
					if($unit){
						
						$this->db->where("unit_number",$unit);
						$this->db->where("cid",$d['cid']);
						$this->db->where("lid",$d['lid']);
						$data[$k]['unit_name']= $this->db->get('unit')->row_array()['unit_name'];
						
					}
					else{
						$data[$k]['unit_name']="";
					}
					$a = array("subject"=>$d['upcase_name'],"title"=>$data[$k]['unit_name']);
                    if (!in_array($a, $summary))
						array_push($summary,  $a);
				}

					
				if(count($data)==0){
					if(date('w', strtotime($today))==0) 
						$message="Chủ nhật";
					$this->db->where("day",$today);
					$data= $this->db->get("holiday")->row_array();
					if($data){
						$message=$data['description'];
					}
					array_push($summary, array("subject"=>"Nghỉ","title"=>$message) );
				}
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title');
				$this->db->where('day', $today);
				$this->db->where('level_hard',1);
				$this->db->where('for_uid',0);
				$this->db->where('deleted',0);
				$data_es=$this->db->get('savsoft_quiz')->row_array();
				$img_es= array();
				$question_es= array();
				$rquestion_es=array();
				$rquestion_es_link="";
				$rquestion_es_content="";
				$vquestion_es_video="";
				$vquestion_es_title="";
				$rquestion_es_title="";
                $vquestion_es=array();
				if($data_es){
					log_message("error", json_encode($data_es));
					$sql = "select question from savsoft_qbank where qid in (".$data_es['qids'].") order by cid asc";
					$q_es = $this->db->query($sql)->result_array();
					foreach($q_es as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_es, array("url"=>$img)); 
						array_push($question_es, array("title"=>strip_tags($q['question']))); 
					}
					
					if($data_es['reading_mcq']){
						$rquestion_es_content=$data_es['reading'];
						$rsql = "select question,source from savsoft_qbank where qid in (".$data_es['reading_mcq'].")";
						$rq_es = $this->db->query($rsql)->result_array();
						if($rq_es){
							$rquestion_es_link=$rq_es[0]['source'];
						}
						foreach($rq_es as $q){
							array_push($rquestion_es, array("title"=>strip_tags($q['question']))); 
						}
									
				        $rquestion_es_title=$data_es['reading_title'];
					
					}
					else{
						
					}
				    if($data_es['video_mcq']){
						$vsql = "select question,source from savsoft_qbank where qid in (".$data_es['video_mcq'].")";
						$vq_es = $this->db->query($vsql)->result_array();
						if($vq_es){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_es[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								   $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_es as $q){
							array_push($vquestion_es, array("title"=>strip_tags($q['question']))); 
						}
						
						$vquestion_es_title=$data_es['video_title'];
					}
					else{
						
					}
					
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_es['quid']);
					$n = $this->db->get('savsoft_assign')->num_rows() ;
					if($n>0)
					   $status_es= 1;
					else
					   $status_es= 0;
					
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title');
				$this->db->where('day', $today);
				$this->db->where('level_hard',2);
				$this->db->where('for_uid',0);
				$this->db->where('deleted',0);
				$data_nm=$this->db->get('savsoft_quiz')->row_array();
				$img_nm= array();
				$question_nm= array();
				$rquestion_nm= array();
				$rquestion_nm_link="";
				$vquestion_nm_video="";
				$rquestion_nm_content="";
				$vquestion_nm_title="";
				$rquestion_nm_title="";
                $vquestion_nm=array();
				if($data_nm){
					
					$sql = "select question from savsoft_qbank where qid in (".$data_nm['qids'].") order by cid asc";
					$q_nm = $this->db->query($sql)->result_array();
					foreach($q_nm as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_nm, array("url"=>$img)); 
						array_push($question_nm, array("title"=>strip_tags($q['question']))); 
						
						
					}
					if($data_nm['reading_mcq']){
						$rquestion_nm_content=$data_nm['reading'];
						$rsql = "select question,source,qid from savsoft_qbank where qid in (".$data_nm['reading_mcq'].")";
						$rq_nm = $this->db->query($rsql)->result_array();
						if($rq_nm){
							$rquestion_nm_link=$rq_nm[0]['source'];
						}
						foreach($rq_nm as $q){
							array_push($rquestion_nm, array("title"=>strip_tags($q['question']))); 
						}
						$rquestion_nm_title=$data_nm['reading_title'];
					}
					if($data_nm['video_mcq']){
						$vsql = "select question,source from savsoft_qbank where qid in (".$data_nm['video_mcq'].")";
						$vq_nm = $this->db->query($vsql)->result_array();
						if($vq_nm){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_nm[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								   $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_nm_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_nm as $q){
							array_push($vquestion_nm, array("title"=>strip_tags($q['question']))); 
						}
						$vquestion_nm_title=$data_nm['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_nm['quid']);
					$n = $this->db->get('savsoft_assign')->num_rows() ;
					if($n>0)
					   $status_nm= 1;
					else
					   $status_nm= 0;
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title');
				$this->db->where('day', $today);
				$this->db->where('level_hard',3);
				$this->db->where('for_uid',0);
				$this->db->where('deleted',0);
				$data_ha=$this->db->get('savsoft_quiz')->row_array();
				$img_ha= array();
				$question_ha= array();
				$rquestion_ha= array();
				$rquestion_ha_link="";
				$vquestion_ha_video="";
				$rquestion_ha_content="";
				$vquestion_ha_title="";
				$rquestion_ha_title="";
                $vquestion_ha=array();
				if($data_ha){
					$sql = "select question from savsoft_qbank where qid in (".$data_ha['qids'].") order by cid asc";
					$q_ha = $this->db->query($sql)->result_array();
					foreach($q_ha as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_ha, array("url"=>$img)); 
						array_push($question_ha, array("title"=>strip_tags($q['question']))); 
						
					}
					if($data_ha['reading_mcq']){
						$rquestion_ha_content=$data_ha['reading'];
						$rsql = "select question,source from savsoft_qbank where qid in (".$data_ha['reading_mcq'].")";
						$rq_ha = $this->db->query($rsql)->result_array();
						if($rq_ha){
							$rquestion_ha_link=$rq_ha[0]['source'];
						}
						foreach($rq_ha as $q){
							array_push($rquestion_ha, array("title"=>strip_tags($q['question']))); 
						}
						
						$rquestion_ha_title=$data_ha['reading_title'];
					}
					if($data_ha['video_mcq']){
						$vsql = "select question,source from savsoft_qbank where qid in (".$data_ha['video_mcq'].")";
						$vq_ha = $this->db->query($vsql)->result_array();
						if($vq_ha){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_ha[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								   $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_ha_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_ha as $q){
							array_push($vquestion_ha, array("title"=>strip_tags($q['question']))); 
						}
						$vquestion_ha_title=$data_ha['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_ha['quid']);
					$n = $this->db->get('savsoft_assign')->num_rows() ;
					if($n>0)
					   $status_ha= 1;
					else
					   $status_ha= 0;
				}
				
				
				$r = array(
							 "date"=> $ardow[date('w',strtotime("-$i day"))].", ".date("d / m", strtotime("-$i day")),
							"summary"=> $summary,
							"assignments"=>array( array("level"=>"Ngắn (3 câu)",
							                            "quiz"=> array("quid"=>$data_es['quid'],
																			  "number_question"=>$data_es['noq'],
																			  "status"=>$status_es,
																			  "tasks"=>array(),
																			  "images"=>$img_es,
																			  "question"=>$question_es),
															  "reading"=>array("link"=>$rquestion_es_link,
															                   "content"=>$rquestion_es_content,
																			   "question"=>$rquestion_es,
																			   "title"=>$rquestion_es_title),
															  "video"=>array("video"=>$vquestion_es_video,
																			   "question"=>$vquestion_es,
																			   "title"=>$vquestion_es_title)			   
														),
											      array("level"=>"Vừa (5 câu)",
											              "quiz"=>array("quid"=>$data_nm['quid'],
															  "number_question"=>$data_nm['noq'],
															  "status"=>$status_nm,
															  "tasks"=>array(),
															  "images"=>$img_nm,
															  "question"=>$question_nm),
												          "reading"=>array("link"=>$rquestion_nm_link,
																		   "content"=>$rquestion_nm_content,
																		   "question"=>$rquestion_nm,
																		   "title"=>$rquestion_nm_title),
														  "video"=>array("video"=>$vquestion_nm_video,
																		   "question"=>$vquestion_nm,
																		   "title"=>$vquestion_nm_title)	
											        ),
												  array("level"=>"Dài (7 câu)",
												       "quiz"=>array("quid"=>$data_ha['quid'],
																	  "number_question"=>$data_ha['noq'],
																	  "status"=>$status_ha,
																	  "tasks"=>array(),
																	  "images"=>$img_ha,
																	   "question"=>$question_ha),
													   "reading"=>array("link"=>$rquestion_ha_link,
													                   "content"=>$rquestion_ha_content,
												                        "question"=>$rquestion_ha,
																		"title"=>$rquestion_ha_title),
														"video"=>array("video"=>$vquestion_ha_video,
																	   "question"=>$vquestion_ha,
																	   "title"=>$vquestion_ha_title)	
												   )
												),
							 );
				array_push($res, $r);
			}
		}	
	    echo json_encode($res);
	}

	//demo++++
	function get_system_quiz4($parentid,$childid, $page=0){
		$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",'12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'GDCD','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học');
		$res= array();
		for($i=5*$page; $i<5*($page+1);$i++){
			$today= date("Y-m-d", strtotime("-$i day"));
			$set=0;
			if($today>"2019-03-19"){
				$this->db->where("day", $today);
				$this->db->where("uid", $childid);
				$dataset=$this->db->get("recommend_assign")->row_array();
				if($dataset){
					$set=$dataset['set'];
				}
				else{
					$set= rand(0,19);
					$this->db->insert("recommend_assign", array("uid"=>$childid,"set"=>$set,"day"=>$today));
				}
				
			}
			if($today>"2019-02-20"){
				//$this->db->distinct();
				$this->db->select("demo_timetable.cid,lid,unit,category_name, upcase_name");
				$this->db->join("demo_savsoft_category", "demo_timetable.cid=demo_savsoft_category.cid");
				$this->db->where("classid","0");
				$this->db->where("day", $today);	
				
				$data= $this->db->get('demo_timetable')->result_array();
				$summary= array();
				
				foreach($data as $k=>$d){
					$unit = $d['unit'];
					if($unit){
						
						$this->db->where("unit_number",$unit);
						$this->db->where("cid",$d['cid']);
						$this->db->where("lid",$d['lid']);
						$data[$k]['unit_name']= $this->db->get('unit')->row_array()['unit_name'];
						
					}
					else{
						$data[$k]['unit_name']="";
					}
					$a = array("subject"=>$d['upcase_name'],"title"=>$data[$k]['unit_name']);
                    if (!in_array($a, $summary))
						array_push($summary,  $a);
				}

					
				if(count($data)==0){
					if(date('w', strtotime($today))==0) 
						$message="Chủ nhật";
					$this->db->where("day",$today);
					$data= $this->db->get("holiday")->row_array();
					if($data){
						$message=$data['description'];
					}
					array_push($summary, array("subject"=>"Nghỉ","title"=>$message) );
				}
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
				$this->db->where('day', $today);
				$this->db->where('level_hard',1);
				$this->db->where('for_uid',0);
				$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_es=$this->db->get('savsoft_quiz')->row_array();
				$img_es= array();
				$question_es= array();
				$rquestion_es=array();
				$rquestion_es_link="";
				$rquestion_es_content="";
				$vquestion_es_video="";
				$vquestion_es_title="";
				$rquestion_es_title="";
                $vquestion_es=array();
				$total_point_es=0;
				if($data_es){
					
					$sql = "select question,cid,points from savsoft_qbank where qid in (".$data_es['qids'].") order by cid asc";
					$q_es = $this->db->query($sql)->result_array();
					$cid_es= array();
					$cid_ar_es= array();
					foreach($q_es as $q){
						if(!in_array($q['cid'],$cid_es)){
							array_push($cid_es,$q['cid']);
							array_push($cid_ar_es,array());
						}
						$total_point_es+= $q['points'];
					}
					foreach($q_es as $q){
						
						
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_es, array("url"=>$img)); 
						
						
						$index=array_search($q['cid'],$cid_es);
						array_push($cid_ar_es[$index], array("title"=>strip_tags($q['question'])));
						
					}
					
					foreach($cid_ar_es as $k=>$d){
						array_push($question_es, array("subject"=>$array_map[$cid_es[$k]],"question"=>$d)); 
					}
					if($data_es['reading_mcq']){
						$rquestion_es_content=$data_es['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['reading_mcq'].")";
						$rq_es = $this->db->query($rsql)->result_array();
						if($rq_es){
							$rquestion_es_link=$rq_es[0]['source'];
						}
						foreach($rq_es as $q){
							array_push($rquestion_es, array("title"=>strip_tags($q['question']))); 
							$total_point_es+= $q['points'];
						    
						}
									
				        $rquestion_es_title=$data_es['reading_title'];
					
					}
					else{
						
					}
				    if($data_es['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['video_mcq'].")";
						$vq_es = $this->db->query($vsql)->result_array();
						if($vq_es){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_es[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
								 
							} 
						}
						foreach($vq_es as $q){
							array_push($vquestion_es, array("title"=>strip_tags($q['question']))); 
							$total_point_es+= $q['points'];
						}
						
						$vquestion_es_title=$data_es['video_title'];
					}
					else{
						
					}
					
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_es['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					log_message("error",$data_es['quid']. " **********".$n['rid']);
					$per_es="";
					if($n){
						$status_es= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_es=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							
							if($per_es || $per_es==0){
								$per_es= "Đã làm: ".number_format($per_es,1)."%";
								$rid_es=$n['rid'];
								
							}
						}
						
					}
					else
					   $status_es= 0;
					
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
				$this->db->where('day', $today);
				$this->db->where('level_hard',2);
				$this->db->where('for_uid',0);
				$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_nm=$this->db->get('savsoft_quiz')->row_array();
				$img_nm= array();
				$question_nm= array();
				$rquestion_nm= array();
				$rquestion_nm_link="";
				$vquestion_nm_video="";
				$rquestion_nm_content="";
				$vquestion_nm_title="";
				$rquestion_nm_title="";
                $vquestion_nm=array();
				$total_point_nm=0;
				if($data_nm){
					
					$sql = "select question,cid,points from savsoft_qbank where qid in (".$data_nm['qids'].") order by cid asc";
					$q_nm = $this->db->query($sql)->result_array();
					
					$cid_nm= array();
					$cid_ar_nm= array();
					foreach($q_nm as $q){
						if(!in_array($q['cid'],$cid_nm)){
							array_push($cid_nm,$q['cid']);
							array_push($cid_ar_nm,array());
						}
						$total_point_nm+= $q['points'];
					}
					foreach($q_nm as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_nm, array("url"=>$img)); 
					    $index=array_search($q['cid'],$cid_nm);
						array_push($cid_ar_nm[$index], array("title"=>strip_tags($q['question'])));						
						
					}
					
					foreach($cid_ar_nm as $k=>$d){
						array_push($question_nm, array("subject"=>$array_map[$cid_nm[$k]],"question"=>$d)); 
					}
					if($data_nm['reading_mcq']){
						$rquestion_nm_content=$data_nm['reading'];
						$rsql = "select question,source,qid,points from savsoft_qbank where qid in (".$data_nm['reading_mcq'].")";
						$rq_nm = $this->db->query($rsql)->result_array();
						if($rq_nm){
							$rquestion_nm_link=$rq_nm[0]['source'];
						}
						foreach($rq_nm as $q){
							array_push($rquestion_nm, array("title"=>strip_tags($q['question'])));
							$total_point_nm+= $q['points'];							
						}
						$rquestion_nm_title=$data_nm['reading_title'];
					}
					if($data_nm['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_nm['video_mcq'].")";
						$vq_nm = $this->db->query($vsql)->result_array();
						if($vq_nm){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_nm[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_nm_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_nm as $q){
							array_push($vquestion_nm, array("title"=>strip_tags($q['question']))); 
							$total_point_nm+= $q['points'];
						}
						$vquestion_nm_title=$data_nm['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_nm['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					$per_nm="";
					if($n){
						$status_nm= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_nm=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_nm|| $per_nm==0){
								$per_nm= "Đã làm: ".number_format($per_nm,1)."%";
								$rid_nm=$n['rid'];
							}
					    }
					}
					else
					   $status_nm= 0;
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading');
				$this->db->where('day', $today);
				$this->db->where('level_hard',3);
				$this->db->where('for_uid',0);
				$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_ha=$this->db->get('savsoft_quiz')->row_array();
				$img_ha= array();
				$question_ha= array();
				$rquestion_ha= array();
				$rquestion_ha_link="";
				$vquestion_ha_video="";
				$rquestion_ha_content="";
				$vquestion_ha_title="";
				$rquestion_ha_title="";
                $vquestion_ha=array();
				$total_point_ha=0;
				if($data_ha){
					$sql = "select question,cid,points from savsoft_qbank where qid in (".$data_ha['qids'].") order by cid asc";
					$q_ha = $this->db->query($sql)->result_array();
					
					$cid_ha= array();
					$cid_ar_ha= array();
					foreach($q_ha as $q){
						if(!in_array($q['cid'],$cid_ha)){
							array_push($cid_ha,$q['cid']);
							array_push($cid_ar_ha,array());
						}
						$total_point_ha+= $q['points'];
					}
					foreach($q_ha as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_ha, array("url"=>$img)); 
						$index=array_search($q['cid'],$cid_ha);
						array_push($cid_ar_ha[$index], array("title"=>strip_tags($q['question'])));
					}
					
					foreach($cid_ar_ha as $k=>$d){
						array_push($question_ha, array("subject"=>$array_map[$cid_ha[$k]],"question"=>$d)); 
					}
					if($data_ha['reading_mcq']){
						$rquestion_ha_content=$data_ha['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['reading_mcq'].")";
						$rq_ha = $this->db->query($rsql)->result_array();
						if($rq_ha){
							$rquestion_ha_link=$rq_ha[0]['source'];
						}
						foreach($rq_ha as $q){
							array_push($rquestion_ha, array("title"=>strip_tags($q['question']))); 
							$total_point_ha+= $q['points'];
							
						}
						
						$rquestion_ha_title=$data_ha['reading_title'];
					}
					if($data_ha['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['video_mcq'].")";
						$vq_ha = $this->db->query($vsql)->result_array();
						if($vq_ha){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_ha[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_ha_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_ha as $q){
							array_push($vquestion_ha, array("title"=>strip_tags($q['question']))); 
							$total_point_ha+= $q['points'];
						}
						$vquestion_ha_title=$data_ha['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_ha['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					$per_ha="";
					if($n){
						$status_ha= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_ha=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_ha ||$per_ha==0){
								$per_ha= "Đã làm: ".number_format($per_ha,1)."%";
								$rid_ha=$n['rid'];
							}
						}
					}
					else
					   $status_ha= 0;
				}
				
				 
				$r = array(
							 "date"=> $ardow[date('w',strtotime("-$i day"))].", ".date("d / m", strtotime("-$i day")),
							"summary"=> $summary,
							"assignments"=>array( array("level"=>"Ngắn",
							                            "quiz"=> array("quid"=>$data_es['quid'],
														                "total_points"=>$total_point_es,
																		"number_question"=>$data_es['noq'],
																	    "status"=>$status_es,
																		"message_do"=> $per_es,
																		"rid"=>$rid_es,
																		"tasks"=>array(),
																		"images"=>$img_es,
																	    "question"=>$question_es,
																			  ),
															  "reading"=>array("link"=>$rquestion_es_link,
															                //   "content"=>$rquestion_es_content,
																			   "question"=>$rquestion_es,
																			   "img"=>$data_es["img_reading"],
																			   "title"=>$rquestion_es_title),
															  "video"=>array("video"=>$vquestion_es_video,
																			   "question"=>$vquestion_es,
																			   "img"=>$data_es["img_video"],
																			   "title"=>$vquestion_es_title)			   
														),
											      array("level"=>"Vừa",
											              "quiz"=>array("quid"=>$data_nm['quid'],
														      "total_points"=>$total_point_nm,
															  "number_question"=>$data_nm['noq'],
															  "status"=>$status_nm,
															  "message_do"=> $per_nm,
															  "rid"=>$rid_nm,
															  "tasks"=>array(),
															  "images"=>$img_nm,
															  "question"=>$question_nm),
												          "reading"=>array("link"=>$rquestion_nm_link,
																		  // "content"=>$rquestion_nm_content,
																		   "question"=>$rquestion_nm,
																		   "img"=>$data_nm["img_reading"],
																		   "title"=>$rquestion_nm_title),
														  "video"=>array("video"=>$vquestion_nm_video,
																		   "question"=>$vquestion_nm,
																		   "img"=>$data_nm["img_video"],
																		   "title"=>$vquestion_nm_title)	
											        ),
												  array("level"=>"Dài",
												       "quiz"=>array("quid"=>$data_ha['quid'],
													                  "total_points"=>$total_point_ha,
																	  "number_question"=>$data_ha['noq'],
																	  "status"=>$status_ha,
																	  "message_do"=> $per_ha,
																	  "rid"=>$rid_ha,
																	  "tasks"=>array(),
																	  "images"=>$img_ha,
																	   "question"=>$question_ha),
													   "reading"=>array("link"=>$rquestion_ha_link,
													                   //"content"=>$rquestion_ha_content,
												                        "question"=>$rquestion_ha,
																		"img"=>$data_ha["img_reading"],
																		"title"=>$rquestion_ha_title),
														"video"=>array("video"=>$vquestion_ha_video,
																	   "question"=>$vquestion_ha,
																	   "img"=>$data_ha["img_video"],
																	   "title"=>$vquestion_ha_title)	
												   )
												),
							 );
				array_push($res, $r);
			}
		}	
	    echo json_encode($res);
	}
	
	
	function get_system_quiz5($parentid,$childid, $page=0){
		$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",'12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'Giáo Dục Công Dân','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học','31'=>'Đạo Đức','32'=>'Mỹ Thuật','33'=>'Thủ Công','34'=>'Kỹ Thuật');
		$this->db->where("uid",$childid);
		$cuser = $this->db->get('savsoft_users')->row_array();
		$res= array();
		$this->db->where("for_uid",$childid);
		$this->db->where("day", date("Y-m-d", strtotime("0 day")));
		$dt = $this->db->get('savsoft_quiz')->row_array();
		if($dt){
			$for_uid=$childid;	
		}
		else{
			$for_uid=0;	
		}
		for($i=5*$page; $i<5*($page+1);$i++){
			$today= date("Y-m-d", strtotime("-$i day"));
			$set=0;
			if($today>"2019-05-07"){
				$this->db->where("day", $today);
				$this->db->where("uid", $childid);
				$dataset=$this->db->get("recommend_assign")->row_array();
				if($dataset){
					$set=$dataset['set'];
				}
				else{
					$set= rand(0,19);
					$this->db->insert("recommend_assign", array("uid"=>$childid,"set"=>$set,"day"=>$today));
				}
	
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading, lid');
				$this->db->where('day', $today);
				$this->db->where('level_hard',1);
				$this->db->where('for_uid',$for_uid);
				if($for_uid==0)
					$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_es=$this->db->get('savsoft_quiz')->row_array();
					
				$img_es= array();
				$question_es= array();
				$rquestion_es=array();
				$rquestion_es_link="";
				$rquestion_es_content="";
				$vquestion_es_video="";
				$vquestion_es_title="";
				$rquestion_es_title="";
                $vquestion_es=array();
				$total_point_es=0;
				if($data_es){
					$sql = "select question,cid,points,lid from savsoft_qbank where qid in (".$data_es['qids'].") order by cid asc";
					$q_es = $this->db->query($sql)->result_array();
					
					if($data_es['lid']<3){
						$grade=$q_es[0]['lid'];
						$this->db->where('quid',$data_es['quid']);
						$this->db->update('savsoft_quiz',array('lid'=>$grade));
					}
					else{
						$grade=$data_es['lid'];
					}
					
					$cid_es= array();
					$cid_ar_es= array();
					foreach($q_es as $q){
						if(!in_array($q['cid'],$cid_es)){
							array_push($cid_es,$q['cid']);
							array_push($cid_ar_es,array());
						}
						$total_point_es+= $q['points'];
					}
					foreach($q_es as $q){
						
						
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_es, array("url"=>$img)); 
						
						
						$index=array_search($q['cid'],$cid_es);
						array_push($cid_ar_es[$index], array("title"=>strip_tags($q['question'])));
						
					}
					
					foreach($cid_ar_es as $k=>$d){
						array_push($question_es, array("subject"=>$array_map[$cid_es[$k]]." lớp ".($grade-2),"question"=>$d)); 
					}
					if($data_es['reading_mcq']){
						$rquestion_es_content=$data_es['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['reading_mcq'].")";
						$rq_es = $this->db->query($rsql)->result_array();
						if($rq_es){
							$rquestion_es_link=$rq_es[0]['source'];
						}
						foreach($rq_es as $q){
							array_push($rquestion_es, array("title"=>strip_tags($q['question']))); 
							$total_point_es+= $q['points'];
						    
						}
									
				        $rquestion_es_title=$data_es['reading_title'];
					
					}
					else{
						
					}
				    if($data_es['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['video_mcq'].")";
						$vq_es = $this->db->query($vsql)->result_array();
						if($vq_es){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_es[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
								 
							} 
						}
						foreach($vq_es as $q){
							array_push($vquestion_es, array("title"=>strip_tags($q['question']))); 
							$total_point_es+= $q['points'];
						}
						
						$vquestion_es_title=$data_es['video_title'];
					}
					else{
						
					}
					
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_es['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					log_message("error",$data_es['quid']. " **********".$n['rid']);
					$per_es="";
					if($n){
						$status_es= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_es=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							
							if($per_es || $per_es==0){
								$per_es= "Đã làm: ".number_format($per_es,1)."%";
								$rid_es=$n['rid'];
								
							}
						}
						
					}
					else
					   $status_es= 0;
					
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading, lid');
				$this->db->where('day', $today);
				$this->db->where('level_hard',2);
				$this->db->where('for_uid',$for_uid);
				if($for_uid==0)
					$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_nm=$this->db->get('savsoft_quiz')->row_array();
				
				$img_nm= array();
				$question_nm= array();
				$rquestion_nm= array();
				$rquestion_nm_link="";
				$vquestion_nm_video="";
				$rquestion_nm_content="";
				$vquestion_nm_title="";
				$rquestion_nm_title="";
                $vquestion_nm=array();
				$total_point_nm=0;
				if($data_nm){
					
					$sql = "select question,cid,points,lid from savsoft_qbank where qid in (".$data_nm['qids'].") order by cid asc";
					$q_nm = $this->db->query($sql)->result_array();
					
					if($data_nm['lid']<3){
						$grade=$q_nm[0]['lid'];
						$this->db->where('quid',$data_nm['quid']);
						$this->db->update('savsoft_quiz',array('lid'=>$grade));
					}
					else{
						$grade=$data_nm['lid'];
					}
					
					$cid_nm= array();
					$cid_ar_nm= array();
					foreach($q_nm as $q){
						if(!in_array($q['cid'],$cid_nm)){
							array_push($cid_nm,$q['cid']);
							array_push($cid_ar_nm,array());
						}
						$total_point_nm+= $q['points'];
					}
					foreach($q_nm as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_nm, array("url"=>$img)); 
					    $index=array_search($q['cid'],$cid_nm);
						array_push($cid_ar_nm[$index], array("title"=>strip_tags($q['question'])));						
						
					}
					
					foreach($cid_ar_nm as $k=>$d){
						array_push($question_nm, array("subject"=>$array_map[$cid_nm[$k]]." lớp ".($grade-2),"question"=>$d)); 
					}
					if($data_nm['reading_mcq']){
						$rquestion_nm_content=$data_nm['reading'];
						$rsql = "select question,source,qid,points from savsoft_qbank where qid in (".$data_nm['reading_mcq'].")";
						$rq_nm = $this->db->query($rsql)->result_array();
						if($rq_nm){
							$rquestion_nm_link=$rq_nm[0]['source'];
						}
						foreach($rq_nm as $q){
							array_push($rquestion_nm, array("title"=>strip_tags($q['question'])));
							$total_point_nm+= $q['points'];							
						}
						$rquestion_nm_title=$data_nm['reading_title'];
					}
					if($data_nm['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_nm['video_mcq'].")";
						$vq_nm = $this->db->query($vsql)->result_array();
						if($vq_nm){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_nm[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_nm_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_nm as $q){
							array_push($vquestion_nm, array("title"=>strip_tags($q['question']))); 
							$total_point_nm+= $q['points'];
						}
						$vquestion_nm_title=$data_nm['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_nm['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					$per_nm="";
					if($n){
						$status_nm= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_nm=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_nm|| $per_nm==0){
								$per_nm= "Đã làm: ".number_format($per_nm,1)."%";
								$rid_nm=$n['rid'];
							}
					    }
					}
					else
					   $status_nm= 0;
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading,lid');
				$this->db->where('day', $today);
				$this->db->where('level_hard',3);
				$this->db->where('for_uid',$for_uid);
				if($for_uid==0)
					$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$data_ha=$this->db->get('savsoft_quiz')->row_array();
				
				$img_ha= array();
				$question_ha= array();
				$rquestion_ha= array();
				$rquestion_ha_link="";
				$vquestion_ha_video="";
				$rquestion_ha_content="";
				$vquestion_ha_title="";
				$rquestion_ha_title="";
                $vquestion_ha=array();
				$total_point_ha=0;
				if($data_ha){
					$sql = "select question,cid,points,lid from savsoft_qbank where qid in (".$data_ha['qids'].") order by cid asc";
					$q_ha = $this->db->query($sql)->result_array();
					
					if($data_ha['lid']<3 ){
						$grade=$q_ha[0]['lid'];
						$this->db->where('quid',$data_ha['quid']);
						$this->db->update('savsoft_quiz',array('lid'=>$grade));
					}
					else{
						$grade=$data_ha['lid'];
					}
					
					$cid_ha= array();
					$cid_ar_ha= array();
					foreach($q_ha as $q){
						if(!in_array($q['cid'],$cid_ha)){
							array_push($cid_ha,$q['cid']);
							array_push($cid_ar_ha,array());
						}
						$total_point_ha+= $q['points'];
					}
					foreach($q_ha as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_ha, array("url"=>$img)); 
						$index=array_search($q['cid'],$cid_ha);
						array_push($cid_ar_ha[$index], array("title"=>strip_tags($q['question'])));
					}
					
					foreach($cid_ar_ha as $k=>$d){
						array_push($question_ha, array("subject"=>$array_map[$cid_ha[$k]]." lớp ".($grade-2),"question"=>$d)); 
					}
					if($data_ha['reading_mcq']){
						$rquestion_ha_content=$data_ha['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['reading_mcq'].")";
						$rq_ha = $this->db->query($rsql)->result_array();
						if($rq_ha){
							$rquestion_ha_link=$rq_ha[0]['source'];
						}
						foreach($rq_ha as $q){
							array_push($rquestion_ha, array("title"=>strip_tags($q['question']))); 
							$total_point_ha+= $q['points'];
							
						}
						
						$rquestion_ha_title=$data_ha['reading_title'];
					}
					if($data_ha['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['video_mcq'].")";
						$vq_ha = $this->db->query($vsql)->result_array();
						if($vq_ha){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_ha[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_ha_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_ha as $q){
							array_push($vquestion_ha, array("title"=>strip_tags($q['question']))); 
							$total_point_ha+= $q['points'];
						}
						$vquestion_ha_title=$data_ha['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_ha['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					$per_ha="";
					if($n){
						$status_ha= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_ha=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_ha ||$per_ha==0){
								$per_ha= "Đã làm: ".number_format($per_ha,1)."%";
								$rid_ha=$n['rid'];
							}
						}
					}
					else
					   $status_ha= 0;
				}
				
				 
				$r = array(
							 "date"=> $ardow[date('w',strtotime("-$i day"))].", ".date("d / m", strtotime("-$i day")),
							 "grade"=>$cuser['grade'],
							"assignments"=>array( array("level"=>"Ngắn",
							                            "quiz"=> array("quid"=>$data_es['quid'],
														                "total_points"=>$total_point_es,
																		"number_question"=>$data_es['noq'],
																	    "status"=>$status_es,
																		"message_do"=> $per_es,
																		"rid"=>$rid_es,
																		"tasks"=>array(),
																		"images"=>$img_es,
																	    "question"=>$question_es,
																			  ),
															  "reading"=>array("link"=>$rquestion_es_link,
															                //   "content"=>$rquestion_es_content,
																			   "question"=>$rquestion_es,
																			   "img"=>$data_es["img_reading"],
																			   "title"=>$rquestion_es_title),
															  "video"=>array("video"=>$vquestion_es_video,
																			   "question"=>$vquestion_es,
																			   "img"=>$data_es["img_video"],
																			   "title"=>$vquestion_es_title)			   
														),
											      array("level"=>"Vừa",
											              "quiz"=>array("quid"=>$data_nm['quid'],
														      "total_points"=>$total_point_nm,
															  "number_question"=>$data_nm['noq'],
															  "status"=>$status_nm,
															  "message_do"=> $per_nm,
															  "rid"=>$rid_nm,
															  "tasks"=>array(),
															  "images"=>$img_nm,
															  "question"=>$question_nm),
												          "reading"=>array("link"=>$rquestion_nm_link,
																		  // "content"=>$rquestion_nm_content,
																		   "question"=>$rquestion_nm,
																		   "img"=>$data_nm["img_reading"],
																		   "title"=>$rquestion_nm_title),
														  "video"=>array("video"=>$vquestion_nm_video,
																		   "question"=>$vquestion_nm,
																		   "img"=>$data_nm["img_video"],
																		   "title"=>$vquestion_nm_title)	
											        ),
												  array("level"=>"Dài",
												       "quiz"=>array("quid"=>$data_ha['quid'],
													                  "total_points"=>$total_point_ha,
																	  "number_question"=>$data_ha['noq'],
																	  "status"=>$status_ha,
																	  "message_do"=> $per_ha,
																	  "rid"=>$rid_ha,
																	  "tasks"=>array(),
																	  "images"=>$img_ha,
																	   "question"=>$question_ha),
													   "reading"=>array("link"=>$rquestion_ha_link,
													                   //"content"=>$rquestion_ha_content,
												                        "question"=>$rquestion_ha,
																		"img"=>$data_ha["img_reading"],
																		"title"=>$rquestion_ha_title),
														"video"=>array("video"=>$vquestion_ha_video,
																	   "question"=>$vquestion_ha,
																	   "img"=>$data_ha["img_video"],
																	   "title"=>$vquestion_ha_title)	
												   )
												),
							 );
				if($r['assignments'][0]['quiz']['quid'])
					array_push($res, $r);
			}
		}	
	    echo json_encode($res);
	}
	
	function get_system_quiz6($parentid,$childid, $page=0){
		$ardow = ["Chủ nhật","Thứ 2", "Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",'12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'Giáo Dục Công Dân','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học','31'=>'Đạo Đức','32'=>'Mỹ Thuật','33'=>'Thủ Công','34'=>'Kỹ Thuật');
		$this->db->where("uid",$childid);
		$cuser = $this->db->get('savsoft_users')->row_array();
		$res= array();
		$this->db->where("for_uid",$childid);
		$this->db->where("day", date("Y-m-d", strtotime("0 day")));
		$dt = $this->db->get('savsoft_quiz')->row_array();
		if($dt){
			$for_uid=$childid;	
		}
		else{
			$for_uid=0;	
		}
		for($i=5*$page; $i<5*($page+1);$i++){

			$str_date=$ardow[date('w',strtotime("-$i day"))].", ".date("d / m", strtotime("-$i day"));
			$check=false;
			$today= date("Y-m-d", strtotime("-$i day"));

			if($i==0){
				$sql_getLastRecord_foruid="select lid from savsoft_quiz where for_uid=$childid order by quid desc limit 1";
				$lid_arr = $this->db->query($sql_getLastRecord_foruid)->row_array();
				$lid_check = $lid_arr['lid'];
				if($lid_check!=$cuser['grade']){
					$check=true;
				}
			}
			
			if($check){
				$this->make_quiz($childid);
				$r=$this->display_quiz($today,$childid,$parentid,$cuser,$str_date);

					$arq=array(
						'parentid'=>$parentid, 
						'childid'=>$childid,
						'json_quiz'=>json_encode($r),
						'day'=>$today,
						'recent_lid'=>$cuser['grade'] ,
						'recent_cid'=>$cuser['assign_categories']
					);


					$this->db->where('parentid',$parentid);
					$this->db->where('childid',$childid);
					$this->db->where('day',$today);
					$t = $this->db->update('store_hcc_quiz',$arq);

				array_push($res, $r);

			}else{

			
			$set=0;

			if($today>"2019-05-07"){
				$this->db->where("day", $today);
				$this->db->where("uid", $childid);
				$dataset=$this->db->get("recommend_assign")->row_array();
				if($dataset){
					$set=$dataset['set'];
				}
				else{
					$set= rand(0,19);
					$this->db->insert("recommend_assign", array("uid"=>$childid,"set"=>$set,"day"=>$today));
				}
				$sql_select="Select * from store_hcc_quiz where parentid=$parentid and childid=$childid and day='$today'";
				$if_query=$this->db->query($sql_select)->row_array();

				if(!$if_query){
				//----------------------------------------
				
				 $r=$this->display_quiz($today,$childid,$parentid,$cuser,$str_date);
				

				if($r['assignments'][0]['quiz']['quid']){
					array_push($res, $r);
					//$json_encode = ;
					// $sql_insert="INSERT INTO store_hcc_quiz(parentid, childid,json_quiz,day) VALUES ($parentid,$childid,'".$json_encode."','".$today."')";

					$arq=array('parentid'=>$parentid, 
						'childid'=>$childid,
						'json_quiz'=>json_encode($r),
						'day'=>$today,
						'recent_lid'=>$cuser['grade'] ,
						'recent_cid'=>$cuser['assign_categories']
					);
					$this->db->insert('store_hcc_quiz',$arq);
					// $this->db->query($sql_insert);
				}
				}else{
					$r=json_decode($if_query['json_quiz'],true);
					$short_quiz=$r['assignments'][0]['quiz']['quid'];
					$sql_checkshort="select * from savsoft_assign where quid=$short_quiz and auid=$parentid and uid=$childid";
					$result_checkshort=$this->db->query($sql_checkshort)->row_array();
					if($result_checkshort){
						$r['assignments'][0]['quiz']['status']=1;
						if($result_checkshort['rid']){
							$r['assignments'][0]['quiz']['rid']=$result_checkshort['rid'];
							$rid=$result_checkshort['rid'];
							$sql_get_percent="Select percentage_obtained from savsoft_result where rid=$rid";
							$message = $this->db->query($sql_get_percent)->row_array();
							$message_do="Đã làm: ".number_format($message['percentage_obtained'],1)."%";
							$r['assignments'][0]['quiz']['message_do']=$message_do;
						}
					}else{
						$r['assignments'][0]['quiz']['status']=0;
					}

					$medium_quiz=$r['assignments'][1]['quiz']['quid'];
					$sql_checkmedium="select * from savsoft_assign where quid=$medium_quiz and auid=$parentid and uid=$childid";
					$result_checkmedium=$this->db->query($sql_checkmedium)->row_array();
					if($result_checkmedium){
						$r['assignments'][1]['quiz']['status']=1;
						if($result_checkmedium['rid']){
							$r['assignments'][1]['quiz']['rid']=$result_checkmedium['rid'];
							$rid=$result_checkmedium['rid'];
							$sql_get_percent="Select percentage_obtained from savsoft_result where rid=$rid";
							$message = $this->db->query($sql_get_percent)->row_array();
							$message_do="Đã làm: ".number_format($message['percentage_obtained'],1)."%";
							$r['assignments'][1]['quiz']['message_do']=$message_do;
						}
					}else{
						$r['assignments'][1]['quiz']['status']=0;
					}

					$long_quiz=$r['assignments'][2]['quiz']['quid'];
					$sql_checklong="select * from savsoft_assign where quid=$long_quiz and auid=$parentid and uid=$childid";
					$result_checklong=$this->db->query($sql_checklong)->row_array();
					if($result_checklong){
						$r['assignments'][2]['quiz']['status']=1;
						if($result_checklong['rid']){
							$r['assignments'][2]['quiz']['rid']=$result_checklong['rid'];
							$rid=$result_checklong['rid'];
							$sql_get_percent="Select percentage_obtained from savsoft_result where rid=$rid";
							$message = $this->db->query($sql_get_percent)->row_array();
							$message_do="Đã làm: ".number_format($message['percentage_obtained'],1)."%";
							$r['assignments'][2]['quiz']['message_do']=$message_do;
						}
					}else{
						$r['assignments'][2]['quiz']['status']=0;
					}

					$arq=array(
						'parentid'=>$parentid, 
						'childid'=>$childid,
						'json_quiz'=>json_encode($r),
						'day'=>$today,
						
					);


					$this->db->where('stid',$if_query['stid']);
					$t = $this->db->update('store_hcc_quiz',$arq);
					array_push($res, $r);
				}
				
			}
		}
		}	
	    echo json_encode($res);
	}
	
	
	function get_system_quiz_by_day($day){
		$today=  $day;
		$this->db->distinct();
		$this->db->select("timetable.cid,lid,unit,category_name");
		$this->db->join("savsoft_category", "timetable.cid=savsoft_category.cid");
		$this->db->where("day", $today);	
		$data= $this->db->get('timetable')->result_array();
		$summary= array();
		foreach($data as $k=>$d){
			$unit = $d['unit'];
			if($unit){
				
				$this->db->where("unit_number",$unit);
				$this->db->where("cid",$d['cid']);
				$this->db->where("lid",$d['lid']);
				$data[$k]['unit_name']= $this->db->get('unit')->row_array()['unit_name'];
				
			}
			else{
				$data[$k]['unit_name']="";
			}
			array_push($summary, array("subject"=>$d['category_name'],"title"=>$data[$k]['unit_name']) );
		}
		if(count($data)==0){
			if(date('w', strtotime($day))==0) 
				$message="Chủ nhật";
			$this->db->where("day",$day);
			$data= $this->db->get("holiday")->row_array();
			if($data){
				$message=$data['description'];
			}
		    array_push($summary, array("subject"=>"Nghỉ","title"=>$message) );
		}
		$this->db->select('quid, quiz_name, for_uid, qids,noq');
		$this->db->where('day', $today);
		$this->db->where('level_hard',1);
		$data_es=$this->db->get('savsoft_quiz')->row_array();
		$img_es= array();
		$question_es= array();
		if($data_es){
			
			$sql = "select question from savsoft_qbank where qid in (".$data_es['qids'].")";
			$q_es = $this->db->query($sql)->result_array();
			foreach($q_es as $q){
				$origImageSrc="";
				$imgTags="";	
				$htmlContent=$q['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
					$img=$origImageSrc;
				 }
				 else{
					
					$img=base_url("/upload/default_image_quiz.png");
				 }			 
				array_push($img_es, array("url"=>$img)); 
				array_push($question_es, array("title"=>strip_tags($q['question']))); 
			}
			$this->db->where("auid", $parentid);
			$this->db->where("uid", $childid);
			$this->db->where("quid", $data_es['quid']);
			$n = $this->db->get('savsoft_assign')->num_rows() ;
			if($n>0)
			   $status_es= 1;
			else
			   $status_es= 0;
			
		}
		
		$this->db->select('quid, quiz_name, for_uid, qids,noq');
		$this->db->where('day', $today);
		$this->db->where('level_hard',2);
		$data_nm=$this->db->get('savsoft_quiz')->row_array();
		$img_nm= array();
		$question_nm= array();
		if($data_nm){
			
			$sql = "select question from savsoft_qbank where qid in (".$data_nm['qids'].")";
			$q_nm = $this->db->query($sql)->result_array();
			foreach($q_nm as $q){
				$origImageSrc="";
				$imgTags="";	
				$htmlContent=$q['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
					$img=$origImageSrc;
				 }
				 else{
					
					$img=base_url("/upload/default_image_quiz.png");
				 }			 
				array_push($img_nm, array("url"=>$img)); 
				array_push($question_nm, array("title"=>strip_tags($q['question']))); 
			}
			$this->db->where("auid", $parentid);
			$this->db->where("uid", $childid);
			$this->db->where("quid", $data_nm['quid']);
			$n = $this->db->get('savsoft_assign')->num_rows() ;
			if($n>0)
			   $status_nm= 1;
			else
			   $status_nm= 0;
		}
		
		$this->db->select('quid, quiz_name, for_uid, qids,noq');
		$this->db->where('day', $today);
		$this->db->where('level_hard',3);
		$data_ha=$this->db->get('savsoft_quiz')->row_array();
		$img_ha= array();
		$question_ha= array();
		if($data_ha){
			$sql = "select question from savsoft_qbank where qid in (".$data_ha['qids'].")";
			$q_ha = $this->db->query($sql)->result_array();
			foreach($q_ha as $q){
				$origImageSrc="";
				$imgTags="";	
				$htmlContent=$q['question'];
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
					$img=$origImageSrc;
				 }
				 else{
					
					$img=base_url("/upload/default_image_quiz.png");
				 }			 
				array_push($img_ha, array("url"=>$img)); 
				array_push($question_ha, array("title"=>strip_tags($q['question']))); 
			}
			 $this->db->where("auid", $parentid);
			$this->db->where("uid", $childid);
			$this->db->where("quid", $data_ha['quid']);
			$n = $this->db->get('savsoft_assign')->num_rows() ;
			if($n>0)
			   $status_ha= 1;
			else
			   $status_ha= 0;
		}
		$res = array(
		             "date"=> date('w', strtotime(date("d-m-Y"))),
		            "summary"=> $summary,
					"assignments"=>array( array("level"=>"Dễ (5 phút)",
					                      "quid"=>$data_es['quid'],
										  "number_question"=>$data_es['noq'],
										  "status"=>$status_es,
					                      "tasks"=>array(),
										  "images"=>$img_es,
										  "question"=>$question_es),
										  array("level"=>"Trung bình (10 phút)",
										  "quid"=>$data_nm['quid'],
										  "number_question"=>$data_nm['noq'],
										  "status"=>$status_nm,
					                      "tasks"=>array(),
										  "images"=>$img_nm,
										  "question"=>$question_nm),
										  array("level"=>"Khó (15 phút)",
										  "quid"=>$data_ha['quid'],
										  "number_question"=>$data_ha['noq'],
										  "status"=>$status_ha,
					                      "tasks"=>array(),
										  "images"=>$img_ha,
										   "question"=>$question_ha)
										),
					 );
	    echo json_encode($res);
	}



	
	function save_fcm_token(){
		$fcm_token=$_POST["fcm_token"];
		$app = $_POST["app"];
		$uid = $_POST["uid"];
		
		$array_user = array("fcm_token"=>$fcm_token,
		                    "app"=>$app,
							"uid"=>$uid,
		              );
		$this->db->where('uid', $uid);
       	$this->db->where('app', $app);
		if($this->db->get('user_token_fcm')->num_rows()>0){
			$this->db->where('uid', $uid);
          	$this->db->where('app', $app);
			if($this->db->update('user_token_fcm', $array_user))
				$res= array('message'=>"success");
			else
				$res= array('message'=>"error");
		}
		else{
			if($this->db->insert('user_token_fcm', $array_user))
				$res= array('message'=>"success");
			else
				$res= array('message'=>"error");
		}
		log_message('error',$uid);
		log_message('error',$app);
		log_message('error',$fcm_token);
		
		echo json_encode($res);
		
		
	}
	
	function save_fcm_token2(){
		$fcm_token=$_POST["fcm_token"];
		$app = $_POST["app"];
		$uid = $_POST["uid"];
		$deviceid = $_POST["deviceid"];
		$array_user = array("fcm_token"=>$fcm_token,
		                    "app"=>$app,
							"uid"=>$uid,
							"deviceid"=>$deviceid,
		              );
		$this->db->where('uid', $uid);
       	$this->db->where('app', $app);
		$this->db->where('deviceid', $deviceid);
		if($this->db->get('user_token_fcm')->num_rows()>0){
			$this->db->where('uid', $uid);
          	$this->db->where('app', $app);
			$this->db->where('deviceid', $deviceid);
			if($this->db->update('user_token_fcm', $array_user))
				$res= array('message'=>"success");
			else
				$res= array('message'=>"error");
		}
		else{
			if($this->db->insert('user_token_fcm', $array_user))
				$res= array('message'=>"success");
			else
				$res= array('message'=>"error");
		}
		log_message('error',$uid);
		log_message('error',$app);
		log_message('error',$fcm_token);
		log_message('error',$deviceid);
		echo json_encode($res);
		
		
	}
	//real
	function get_question_by_timetable_r($uid) {
		 $today=  date("Y-m-d");		
		$this->db->distinct();
		$this->db->select("timetable.cid,lid,unit,category_name,sub_subject");
		$this->db->join("savsoft_category", "timetable.cid=savsoft_category.cid");
        $this->db->order_by("timetable.cid asc");
		$this->db->where("day", $today);	
		$data= $this->db->get('timetable')->result_array();
		$sql="Select qid, question from savsoft_qbank where deleted=0 and status=1 and ( ";
		
		foreach($data as $k=>$d){
			$unit = $d['unit'];
			if($unit){
				
				$this->db->where("unit_number",$unit);
				$this->db->where("cid",$d['cid']);
				$this->db->where("lid",$d['lid']);
				$data[$k]['unit_name']= $this->db->get('unit')->row_array()['unit_name'];
				
			}
			else{
				$data[$k]['unit_name']="";
			}
			
			if($k!=0)
				$sql.= " or ";
			else
				$sql.= " ";
			if($d['sub_subject']){
				$sql2=" and (unit='$unit-".$d['sub_subject']."' or unit like '%,$unit,%-".$d['sub_subject']."' or unit like '%,$unit-".$d['sub_subject']."' or unit like '$unit,%-".$d['sub_subject']."') ";
			} else{
				$sql2=" and (unit=$unit or unit like '%,$unit,%' or unit like '%,$unit' or unit like '$unit,%') ";
			}
			$sql.= " ( cid=".$d['cid']." and lid=".$d['lid'].$sql2." ) "  ;
		}
		
		$sql_es=$sql." ) and hard_level=1 order by cid asc";
		$sql_nm=$sql." ) and hard_level=2 order by cid asc";
		$sql_ha=$sql." ) and hard_level=3 order by cid asc";
		$res2['easy'] = $this->db->query($sql_es)->result_array();
		$res2['normal'] = $this->db->query($sql_nm)->result_array();
		$res2['hard'] = $this->db->query($sql_ha)->result_array();
		
		echo json_encode($res2);
	}
	
	//demo
	function get_question_by_timetable($uid) {
		 $today=  date("Y-m-d");		
		$this->db->distinct();
		$this->db->select("demo_timetable.cid,lid,unit,category_name,sub_subject");
		$this->db->join("savsoft_category", "demo_timetable.cid=savsoft_category.cid");
        $this->db->order_by("demo_timetable.cid asc");
		$this->db->where("day", $today);	
		$data= $this->db->get('demo_timetable')->result_array();
		$sql="Select qid, question from savsoft_qbank where deleted=0 and status=1 and ( ";
		
		foreach($data as $k=>$d){
			$unit = $d['unit'];
			if($unit){
				
				$this->db->where("unit_number",$unit);
				$this->db->where("cid",$d['cid']);
				$this->db->where("lid",$d['lid']);
				$data[$k]['unit_name']= $this->db->get('unit')->row_array()['unit_name'];
				
			}
			else{
				$data[$k]['unit_name']="";
			}
			
			if($k!=0)
				$sql.= " or ";
			else
				$sql.= " ";
			if($d['sub_subject']){
				$sql2=" and (unit='$unit-".$d['sub_subject']."' or unit like '%,$unit,%-".$d['sub_subject']."' or unit like '%,$unit-".$d['sub_subject']."' or unit like '$unit,%-".$d['sub_subject']."') ";
			} else{
				$sql2=" and (unit=$unit or unit like '%,$unit,%' or unit like '%,$unit' or unit like '$unit,%') ";
			}
			$sql.= " ( cid=".$d['cid']." and lid=".$d['lid'].$sql2." ) "  ;
		}
		
		$sql_es=$sql." ) and hard_level=1 ";
		$sql_nm=$sql." ) and hard_level=2 ";
		$sql_ha=$sql." ) and hard_level=3 ";
		$res2['easy'] = $this->db->query($sql_es)->result_array();
		$res2['normal'] = $this->db->query($sql_nm)->result_array();
		$res2['hard'] = $this->db->query($sql_ha)->result_array();
		
		echo json_encode($res2);
	}

    function create_quiz_assign_custom(){
		
		$uid=$_POST["uid"];
		$childid=$_POST["childid"];
		$quiz_name = $_POST["quiz_name"];
		$qids = $_POST["qids"];

		$this->db->where('uid',$uid);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
	    if($auth->num_rows()>=0){
			//insert quiz 
			 $noq= count(explode(",", $qids));
			 if(!$quiz_name) $quiz_name= "Bài học cùng con ngày ".date('d-m-Y', time())."(Tùy chọn)";
			 $quid = $this->quiz_model->insert_quiz_user_custom($quiz_name,$qids,$noq,$uid, $user['first_name']);
			 //assign
			 date_default_timezone_set('Asia/Ho_Chi_Minh');
			 $startdate = date('Y-m-d H:i:s', time()) ;
			 if($quid!=0){
				 if($this->api_model->assignQuizApi($user, $quid, $childid, $startdate, "")){
					$data['result'] = "success";
					$this->load->library('Curl');
				
					$this->db->where("uid", $uid);
					$this->db->where("app", 'do');
					$tk=$this->db->get('user_token_fcm')->result_array();
					foreach($tk as $t){
						$ch = curl_init();
						$to = $t['fcm_token'];
						 log_message("error", "Giao bài ".$to." ".$uid." ".$t['divideid']);
						$a= array( "content_available"=> true,
								  "notification"=> array(
										 "title"=> "Bài được giao",
										  "body"=> "Bạn vừa được giao một bài, hãy mở ứng dụng STEMUP Học sinh để làm bài!",
										  "content_available"=> true,
										   "sound"=> "default"
								 ),
								"data"=> array("id"=>0),
								"to"=> $to);
						$inp= json_encode($a);
						
						curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $inp);
						curl_setopt($ch, CURLOPT_POST, 1);
						
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(
							 "Authorization: key=AAAA0dc6mvY:APA91bEzamAftWvYzwTW7sRf7G7RxYsCtNmjrKLjfTXVbtZFNyKME0C4TM1cEoQMSh_ja9dURjs9WecjZCD1yW0nPK0Hhp6t1D20n96ZcVKsdWbNiJBDjEg5QRTYQFGAoNsHvJcQmcs1",
							"Content-Type: application/json"
							));

						$result = curl_exec($ch);
						if (curl_errno($ch)) {
							echo 'Error:' . curl_error($ch);
						}
						curl_close ($ch);
					}
				}else{
					$data['result'] = "Cannot assign for user.";
				}
			 }
			 else{
				 $data['result'] = "Cannot create quiz.";
			 }
     	}
		else{
			$data['result'] = "Not connected.";
		}
		
		echo json_encode($data);
	}	
	
	function create_child_account(){
		$uid=$_POST["uid"];
		$password=$_POST["password"];
		$name = $_POST["name"];
		$email = $_POST["email"];
		$data=$this->user_model->insert_user_5($uid,$password, $name,$email);
		echo json_encode($data);
		
	}
	
	
	function create_child_account2(){
		$uidp=$_POST["uid"];
		$password=$_POST["password"];
		$name = $_POST["name"];
		$email = $_POST["email"];
		$grade = $_POST["grade"];
		
		
		$data=$this->user_model->insert_user_6($uidp,$password, $name,$email, $grade);
		echo json_encode($data);
		if($data['message']=="success"){
		    $childidx = $data['childid'];
			for($i=0; $i<3;$i++){
				$distince_time="-$i day";
				$today=  date("Y-m-d", strtotime($distince_time));
				$today1=  date("d-m", strtotime($distince_time));
				$ac='3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34';
				
				
				$this->db->where("lid",$grade);
				$grade_name= $this->db->get("savsoft_level")->row_array()['level_name'];
				$this->db->where("lid",$grade);
				$av_cids= $this->db->get("level_category")->row_array()['available_cids'];
				
				$sqlc=  "select cid,category_name from savsoft_category where cid in ($ac) and cid in ($av_cids)";
				
				
				$sqlce= $sqlc."order by rand() limit 1";
				$cat= $this->db->query($sqlce)->result_array();
				if(!$cat){
					$sqlc=  "select cid,category_name from savsoft_category where cid in ($av_cids)";
				}
				
				$sqlce= $sqlc."order by rand() limit 1";
				$sqlcn= $sqlc."order by rand() limit 2";
				$sqlch= $sqlc."order by rand() limit 3";
				
				$cate_es= $this->db->query($sqlce)->result_array();
				$cate_nm= $this->db->query($sqlcn)->result_array();
				$cate_ha= $this->db->query($sqlch)->result_array();


				$qids_es="";
				$qids_nm="";
				$qids_ha="";
				
				
				$number_question_es=0;
				$number_question_nm=0;
				$number_question_ha=0;

				$multigrade = " (lid=".$grade." or lid=16) ";
				
				foreach ($cate_es as $ct){
					
					$sqles= "select qid, question, points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
					$data = $this->db->query($sqles)->result_array();
					foreach($data as $k=> $d){
						if($qids_es!=""){
							$qids_es.=",";
						}
						$qids_es.=$d['qid'];
						$data[$k]["question"]= strip_tags($d['question']);
						$number_question_es++;
					}
				}
				
				foreach ($cate_nm as $ct){
					$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
					$data = $this->db->query($sqles)->result_array();
					foreach($data as $k=> $d){
						if($qids_nm!=""){
							$qids_nm.=",";
						}
						$qids_nm.=$d['qid'];
						$data[$k]["question"]= strip_tags($d['question']);
						$number_question_nm++;
					}
				}
				
				foreach ($cate_ha as $ct){
					$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
					$data = $this->db->query($sqles)->result_array();
					foreach($data as $k=> $d){
						if($qids_ha!=""){
							$qids_ha.=",";
						}
						$qids_ha.=$d['qid'];
						$data[$k]["question"]= strip_tags($d['question']);
						$number_question_ha++;
					}
				}
				
				//category reading
				$sql = "select qid,question, source,points from savsoft_qbank where type=3 order by rand() limit 3";
				$rdtar = $this->db->query($sql)->result_array();
				
				
				if(count($rdtar)>0){

					$rdt = $rdtar[0];
					$sql = "select *  from reading_material where link='".$rdt['source']."'";
					$rmt = $this->db->query($sql)->row_array();
				
					$reading_es=array( "content"=>$rmt['content'],
									"question"=> $rdt['qid'],
									"img"=> $rmt['img'],
									"title"=> $rmt['title']
									);
					
					
					$rdt = $rdtar[1%count($rdtar)];
					$sql = "select *  from reading_material where link='".$rdt['source']."'";
					$rmt = $this->db->query($sql)->row_array();
										 
					$reading_nm=array( "content"=>$rmt['content'],
									"question"=> $rdt['qid'],
									"img"=> $rmt['img'],
									"title"=> $rmt['title']
									);
									
					$rdt = $rdtar[2%count($rdtar)];
					$sql = "select *  from reading_material where link='".$rdt['source']."'";
					$rmt = $this->db->query($sql)->row_array();

					$reading_ha=array( "content"=>$rmt['content'],
									"question"=> $rdt['qid'],
									"img"=> $rmt['img'],
									"title"=> $rmt['title']
									);
				}
				
				//mutigrade
				//$sql = "select qid,question, source from savsoft_qbank where type=2 and $multigrade and cid!=29 order by rand() limit 3";
				$sql = "select qid,question, source,points from savsoft_qbank where type=2 and lid=8 and cid!=29 order by rand() limit 3";
				$vdtar = $this->db->query($sql)->result_array();
				if(count($vdtar)>0){
					$index_es = 0;
					$index_nm = 1%count($vdtar);
					$index_ha = 2%count($vdtar);

					$vdt = $vdtar[$index_es];	
					$vidlink="";
					$vques= array();
					$img_video="";
					$video_title="";		
					preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 if(strpos($match[1],'youtube')!==false){
							 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
							 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
							 $sqll= "select title from savsoft_library where content like '%$vid%'";
							 $video_title=$this->db->query($sqll)->row_array()['title'];
							 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
						 }
						 else if(strpos($match[1],'facebook')!==false){
							$start = strpos($match[1],"href=");
							//$end = strpos($match[1],"&amp;");
							$vidlink= substr($match[1],$start+5);
							$vidlink=str_replace("%3A",":",$vidlink);
							$vidlink=str_replace("%2F","/",$vidlink);
							
							
							$posvideo=strpos($match[1],"videos%2F");
							$temp= substr($match[1],$posvideo+9);
							$posid=strpos($temp,"%2F");
							$vid= substr($temp,0,$posid);
							$sqll= "select title from savsoft_library where source_id=$vid";
							$vdtz= $this->db->query($sqll)->row_array();
							$video_title=$vdtz['title'];
							
							$img_video="https://graph.facebook.com/$vid/picture";
						 }
					} 
					
					
					$video_es = array( "video"=> $vidlink,
									"question"=> $vdt['qid'],
									"img"=> $img_video,
									"title"=>$video_title,
									);
					
					/***/
					$vdt = $vdtar[$index_nm];	
					$vidlink="";
					$vques= array();
					$img_video="";
					$video_title="";
					preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 if(strpos($match[1],'youtube')!==false){
							 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
							 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
							 $sqll= "select title from savsoft_library where content like '%$vid%'";
							 $video_title=$this->db->query($sqll)->row_array()['title'];
							 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
						 }
						 else if(strpos($match[1],'facebook')!==false){
							$start = strpos($match[1],"href=");
							//$end = strpos($match[1],"&amp;");
							$vidlink= substr($match[1],$start+5);
							$vidlink=str_replace("%3A",":",$vidlink);
							$vidlink=str_replace("%2F","/",$vidlink);
							
							
							$posvideo=strpos($match[1],"videos%2F");
							$temp= substr($match[1],$posvideo+9);
							$posid=strpos($temp,"%2F");
							$vid= substr($temp,0,$posid);
							$sqll= "select title from savsoft_library where source_id=$vid";
							$vdtz= $this->db->query($sqll)->row_array();
							$video_title=$vdtz['title'];
							
							$img_video="https://graph.facebook.com/$vid/picture";
						 }
					} 
						
					$video_nm = array( "video"=> $vidlink,
									"question"=> $vdt['qid'],
									"img"=> $img_video,
									"title"=>$video_title);		

					$vdt = $vdtar[$index_ha];	
					$vidlink="";
					$vques= array();
					$img_video="";
					$video_title="";
						
					preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
					if(count($vidTags[0])>0){
						 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
						 if(strpos($match[1],'youtube')!==false){
							 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
							 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
							 $sqll= "select title from savsoft_library where content like '%$vid%'";
							 $video_title=$this->db->query($sqll)->row_array()['title'];
							 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
						 }
						 else if(strpos($match[1],'facebook')!==false){
							$start = strpos($match[1],"href=");
							//$end = strpos($match[1],"&amp;");
							$vidlink= substr($match[1],$start+5);
							$vidlink=str_replace("%3A",":",$vidlink);
							$vidlink=str_replace("%2F","/",$vidlink);
							
							
							$posvideo=strpos($match[1],"videos%2F");
							$temp= substr($match[1],$posvideo+9);
							$posid=strpos($temp,"%2F");
							$vid= substr($temp,0,$posid);
							$sqll= "select title from savsoft_library where source_id=$vid";
							$vdtz= $this->db->query($sqll)->row_array();
							$video_title=$vdtz['title'];
							
							$img_video="https://graph.facebook.com/$vid/picture";
						 }
					} 
						
					$video_ha = array( "video"=> $vidlink,
									"question"=> $vdt['qid'],
									"img"=> $img_video,
									"title"=>$video_title
									);							
				}					
				
				$uid = $childidx;			

				$quiz_name="Bài học cùng con ngày ".$today1." - Ngắn";
				$qids=$qids_es;
				$noq=count(explode(",", $qids));
				$level_hard=1;		
				$reading_mcq=$reading_es['question'];
				$reading=$reading_es["content"];
				$reading_title=$reading_es["title"];
				$img_reading=$reading_es["img"];		
				$video_mcq=$video_es['question'];
				$video_title=$video_es['title'];
				$img_video=$video_es['img'];
					
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$grade,$level_hard,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
				
				$quiz_name="Bài học cùng con ngày ".$today1." - Vừa";
				$qids=$qids_nm;
				$noq=count(explode(",", $qids));
				$level_hard=2;		
				$reading_mcq=$reading_nm['question'];
				$reading=$reading_nm["content"];
				$reading_title=$reading_nm["title"];
				$img_reading=$reading_nm["img"];		
				$video_mcq=$video_nm['question'];
				$video_title=$video_nm['title'];
				$img_video=$video_nm['img'];
					
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$grade,$level_hard,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
				
				$quiz_name="Bài học cùng con ngày ".$today1." - Dài";
				$qids=$qids_ha;
				$noq=count(explode(",", $qids));
				$level_hard=3;
				$reading_mcq=$reading_ha['question'];
				$reading=$reading_ha["content"];
				$reading_title=$reading_ha["title"];
				$img_reading=$reading_ha["img"];		
				$video_mcq=$video_ha['question'];
				$video_title=$video_ha['title'];
				$img_video=$video_ha['img'];
				
				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$grade,$level_hard,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
			}
		}
   
    }

  //   function create_child_account3(){

		// $uidp=$_POST["uid"];
		// $password=$_POST["password"];
		// $name = $_POST["name"];
		// $email = $_POST["email"];
		// $grade = $_POST["grade"];
		
		
		// $data=$this->user_model->insert_user_6($uidp,$password, $name,$email, $grade);
		// echo json_encode($data);
		// if($data['message']=="success"){
		//     $childidx = $data['childid'];
		// 	for($i=0; $i<3;$i++){
		// 		$distince_time="-$i day";
		// 		$today=  date("Y-m-d", strtotime($distince_time));
		// 		$today1=  date("d-m", strtotime($distince_time));
		// 		$ac='3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34';
				
				
		// 		$this->db->where("lid",$grade);
		// 		$grade_name= $this->db->get("savsoft_level")->row_array()['level_name'];
		// 		$this->db->where("lid",$grade);
		// 		$av_cids= $this->db->get("level_category")->row_array()['available_cids'];
				
		// 		$sqlc=  "select cid,category_name from savsoft_category where cid in ($ac) and cid in ($av_cids)";
				
				
		// 		$sqlce= $sqlc."order by rand() limit 1";
		// 		$cat= $this->db->query($sqlce)->result_array();
		// 		if(!$cat){
		// 			$sqlc=  "select cid,category_name from savsoft_category where cid in ($av_cids)";
		// 		}
				
		// 		$sqlce= $sqlc."order by rand() limit 1";
		// 		$sqlcn= $sqlc."order by rand() limit 2";
		// 		$sqlch= $sqlc."order by rand() limit 3";
				
		// 		$cate_es= $this->db->query($sqlce)->result_array();
		// 		$cate_nm= $this->db->query($sqlcn)->result_array();
		// 		$cate_ha= $this->db->query($sqlch)->result_array();


		// 		$qids_es="";
		// 		$qids_nm="";
		// 		$qids_ha="";
				
				
		// 		$number_question_es=0;
		// 		$number_question_nm=0;
		// 		$number_question_ha=0;

		// 		$multigrade = " (lid=".$grade." or lid=16) ";
				
		// 		foreach ($cate_es as $ct){
					
		// 			$sqles= "select qid, question, points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
		// 			$data = $this->db->query($sqles)->result_array();
		// 			foreach($data as $k=> $d){
		// 				if($qids_es!=""){
		// 					$qids_es.=",";
		// 				}
		// 				$qids_es.=$d['qid'];
		// 				$data[$k]["question"]= strip_tags($d['question']);
		// 				$number_question_es++;
		// 			}
		// 		}
				
		// 		foreach ($cate_nm as $ct){
		// 			$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
		// 			$data = $this->db->query($sqles)->result_array();
		// 			foreach($data as $k=> $d){
		// 				if($qids_nm!=""){
		// 					$qids_nm.=",";
		// 				}
		// 				$qids_nm.=$d['qid'];
		// 				$data[$k]["question"]= strip_tags($d['question']);
		// 				$number_question_nm++;
		// 			}
		// 		}
				
		// 		foreach ($cate_ha as $ct){
		// 			$sqles= "select qid, question,points from savsoft_qbank where deleted=0 and status=1 and (type=1 or type is null) and cid =".$ct['cid']." and $multigrade order by rand() limit 5";
		// 			$data = $this->db->query($sqles)->result_array();
		// 			foreach($data as $k=> $d){
		// 				if($qids_ha!=""){
		// 					$qids_ha.=",";
		// 				}
		// 				$qids_ha.=$d['qid'];
		// 				$data[$k]["question"]= strip_tags($d['question']);
		// 				$number_question_ha++;
		// 			}
		// 		}
				
		// 		//category reading
		// 		$sql = "select qid,question, source,points from savsoft_qbank where type=3 order by rand() limit 3";
		// 		$rdtar = $this->db->query($sql)->result_array();
				
				
		// 		if(count($rdtar)>0){

		// 			$rdt = $rdtar[0];
		// 			$sql = "select *  from reading_material where link='".$rdt['source']."'";
		// 			$rmt = $this->db->query($sql)->row_array();
				
		// 			$reading_es=array( "content"=>$rmt['content'],
		// 							"question"=> $rdt['qid'],
		// 							"img"=> $rmt['img'],
		// 							"title"=> $rmt['title']
		// 							);
					
					
		// 			$rdt = $rdtar[1%count($rdtar)];
		// 			$sql = "select *  from reading_material where link='".$rdt['source']."'";
		// 			$rmt = $this->db->query($sql)->row_array();
										 
		// 			$reading_nm=array( "content"=>$rmt['content'],
		// 							"question"=> $rdt['qid'],
		// 							"img"=> $rmt['img'],
		// 							"title"=> $rmt['title']
		// 							);
									
		// 			$rdt = $rdtar[2%count($rdtar)];
		// 			$sql = "select *  from reading_material where link='".$rdt['source']."'";
		// 			$rmt = $this->db->query($sql)->row_array();

		// 			$reading_ha=array( "content"=>$rmt['content'],
		// 							"question"=> $rdt['qid'],
		// 							"img"=> $rmt['img'],
		// 							"title"=> $rmt['title']
		// 							);
		// 		}
				
		// 		//mutigrade
		// 		//$sql = "select qid,question, source from savsoft_qbank where type=2 and $multigrade and cid!=29 order by rand() limit 3";
		// 		$sql = "select qid,question, source,points from savsoft_qbank where type=2 and lid=8 and cid!=29 order by rand() limit 3";
		// 		$vdtar = $this->db->query($sql)->result_array();
		// 		if(count($vdtar)>0){
		// 			$index_es = 0;
		// 			$index_nm = 1%count($vdtar);
		// 			$index_ha = 2%count($vdtar);

		// 			$vdt = $vdtar[$index_es];	
		// 			$vidlink="";
		// 			$vques= array();
		// 			$img_video="";
		// 			$video_title="";		
		// 			preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
		// 			if(count($vidTags[0])>0){
		// 				 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
		// 				 if(strpos($match[1],'youtube')!==false){
		// 					 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
		// 					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
		// 					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
		// 					 $sqll= "select title from savsoft_library where content like '%$vid%'";
		// 					 $video_title=$this->db->query($sqll)->row_array()['title'];
		// 					 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
		// 				 }
		// 				 else if(strpos($match[1],'facebook')!==false){
		// 					$start = strpos($match[1],"href=");
		// 					//$end = strpos($match[1],"&amp;");
		// 					$vidlink= substr($match[1],$start+5);
		// 					$vidlink=str_replace("%3A",":",$vidlink);
		// 					$vidlink=str_replace("%2F","/",$vidlink);
							
							
		// 					$posvideo=strpos($match[1],"videos%2F");
		// 					$temp= substr($match[1],$posvideo+9);
		// 					$posid=strpos($temp,"%2F");
		// 					$vid= substr($temp,0,$posid);
		// 					$sqll= "select title from savsoft_library where source_id=$vid";
		// 					$vdtz= $this->db->query($sqll)->row_array();
		// 					$video_title=$vdtz['title'];
							
		// 					$img_video="https://graph.facebook.com/$vid/picture";
		// 				 }
		// 			} 
					
					
		// 			$video_es = array( "video"=> $vidlink,
		// 							"question"=> $vdt['qid'],
		// 							"img"=> $img_video,
		// 							"title"=>$video_title,
		// 							);
					
		// 			/***/
		// 			$vdt = $vdtar[$index_nm];	
		// 			$vidlink="";
		// 			$vques= array();
		// 			$img_video="";
		// 			$video_title="";
		// 			preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
		// 			if(count($vidTags[0])>0){
		// 				 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
		// 				 if(strpos($match[1],'youtube')!==false){
		// 					 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
		// 					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
		// 					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
		// 					 $sqll= "select title from savsoft_library where content like '%$vid%'";
		// 					 $video_title=$this->db->query($sqll)->row_array()['title'];
		// 					 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
		// 				 }
		// 				 else if(strpos($match[1],'facebook')!==false){
		// 					$start = strpos($match[1],"href=");
		// 					//$end = strpos($match[1],"&amp;");
		// 					$vidlink= substr($match[1],$start+5);
		// 					$vidlink=str_replace("%3A",":",$vidlink);
		// 					$vidlink=str_replace("%2F","/",$vidlink);
							
							
		// 					$posvideo=strpos($match[1],"videos%2F");
		// 					$temp= substr($match[1],$posvideo+9);
		// 					$posid=strpos($temp,"%2F");
		// 					$vid= substr($temp,0,$posid);
		// 					$sqll= "select title from savsoft_library where source_id=$vid";
		// 					$vdtz= $this->db->query($sqll)->row_array();
		// 					$video_title=$vdtz['title'];
							
		// 					$img_video="https://graph.facebook.com/$vid/picture";
		// 				 }
		// 			} 
						
		// 			$video_nm = array( "video"=> $vidlink,
		// 							"question"=> $vdt['qid'],
		// 							"img"=> $img_video,
		// 							"title"=>$video_title);		

		// 			$vdt = $vdtar[$index_ha];	
		// 			$vidlink="";
		// 			$vques= array();
		// 			$img_video="";
		// 			$video_title="";
						
		// 			preg_match_all('/<iframe[^>]+>/i',$vdt['question'], $vidTags); 
		// 			if(count($vidTags[0])>0){
		// 				 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
		// 				 if(strpos($match[1],'youtube')!==false){
		// 					 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
		// 					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
		// 					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
		// 					 $sqll= "select title from savsoft_library where content like '%$vid%'";
		// 					 $video_title=$this->db->query($sqll)->row_array()['title'];
		// 					 $vidlink = "https://www.youtube.com/embed/$vid?version=3&loop=1&playlist=$vid";
		// 				 }
		// 				 else if(strpos($match[1],'facebook')!==false){
		// 					$start = strpos($match[1],"href=");
		// 					//$end = strpos($match[1],"&amp;");
		// 					$vidlink= substr($match[1],$start+5);
		// 					$vidlink=str_replace("%3A",":",$vidlink);
		// 					$vidlink=str_replace("%2F","/",$vidlink);
							
							
		// 					$posvideo=strpos($match[1],"videos%2F");
		// 					$temp= substr($match[1],$posvideo+9);
		// 					$posid=strpos($temp,"%2F");
		// 					$vid= substr($temp,0,$posid);
		// 					$sqll= "select title from savsoft_library where source_id=$vid";
		// 					$vdtz= $this->db->query($sqll)->row_array();
		// 					$video_title=$vdtz['title'];
							
		// 					$img_video="https://graph.facebook.com/$vid/picture";
		// 				 }
		// 			} 
						
		// 			$video_ha = array( "video"=> $vidlink,
		// 							"question"=> $vdt['qid'],
		// 							"img"=> $img_video,
		// 							"title"=>$video_title
		// 							);							
		// 		}					
				
		// 		$uid = $childidx;		



		// 		$this->create_quiz_assign_by_day($distance_time,$qids_es,$uid,$grade,1, $reading_es['question'],$video_es['question'],$reading_es["content"],$reading_es["title"],$reading_es["img"],$video_es['title'],$video_es['img']);

		// 		// $quiz_name="Bài học cùng con ngày ".$today1." - Ngắn";
		// 		// $qids=$qids_es;
		// 		// $noq=count(explode(",", $qids));
		// 		// $level_hard=1;		
		// 		// $reading_mcq=$reading_es['question'];
		// 		// $reading=$reading_es["content"];
		// 		// $reading_title=$reading_es["title"];
		// 		// $img_reading=$reading_es["img"];		
		// 		// $video_mcq=$video_es['question'];
		// 		// $video_title=$video_es['title'];
		// 		// $img_video=$video_es['img'];
					
		// 		// $this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$grade,$level_hard,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);

		// 		$this->create_quiz_assign_by_day($distance_time,$qids_nm,$uid,$grade,1, $reading_nm['question'],$video_nm['question'],$reading_nm["content"],$reading_nm["title"],$reading_nm["img"],$video_nm['title'],$video_nm['img']);
				
		// 		// $quiz_name="Bài học cùng con ngày ".$today1." - Vừa";
		// 		// $qids=$qids_nm;
		// 		// $noq=count(explode(",", $qids));
		// 		// $level_hard=2;		
		// 		// $reading_mcq=$reading_nm['question'];
		// 		// $reading=$reading_nm["content"];
		// 		// $reading_title=$reading_nm["title"];
		// 		// $img_reading=$reading_nm["img"];		
		// 		// $video_mcq=$video_nm['question'];
		// 		// $video_title=$video_nm['title'];
		// 		// $img_video=$video_nm['img'];
					
		// 		// $this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$grade,$level_hard,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);

		// 		$this->create_quiz_assign_by_day($distance_time,$qids_ha,$uid,$grade,1, $reading_ha['question'],$video_ha['question'],$reading_ha["content"],$reading_ha["title"],$reading_ha["img"],$video_ha['title'],$video_ha['img']);
				
		// 		// $quiz_name="Bài học cùng con ngày ".$today1." - Dài";
		// 		// $qids=$qids_ha;
		// 		// $noq=count(explode(",", $qids));
		// 		// $level_hard=3;
		// 		// $reading_mcq=$reading_ha['question'];
		// 		// $reading=$reading_ha["content"];
		// 		// $reading_title=$reading_ha["title"];
		// 		// $img_reading=$reading_ha["img"];		
		// 		// $video_mcq=$video_ha['question'];
		// 		// $video_title=$video_ha['title'];
		// 		// $img_video=$video_ha['img'];
				
		// 		// $this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$uid, $today,$grade,$level_hard,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
		// 	}
		// }
   
  //   }

	function reset_child_password(){
		$uid=$_POST["uid"];
		$childid=$_POST["childid"];
		$password=$_POST["password"];

		
		$this->db->where("uid", $childid);
		$this->db->where("su", 2);
		$child=$this->db->get("savsoft_users")->row_array();
		if($child){
			if($child['parent_id']){
				if(in_array($uid, explode(",", $child['parent_id']))){
					if(trim($password)){
						$this->db->where("uid", $childid);
						$this->db->update("savsoft_users", array("password"=>MD5($password)));
						$result= array("status"=>"success","message"=>"Đổi mật khẩu thành công");
					}
					else{
						$result= array("status"=>"error","message"=>"Mật khẩu không được để trống");
					}
				}
				else{
					$result= array("status"=>"error","message"=>"Không thể thay đổi mật khẩu");
				}
			}
			else{
				$result= array("status"=>"error","message"=>"Không thể thay đổi mật khẩu");
			}
		}
		else{
			$result= array("status"=>"error","message"=>"Tài khoản của con không tồn tại");
		}
		
		echo json_encode($result);
	}
	
	
	//real
	function get_timetable_r($uid, $date){
		//jd: class//lid//
		$this->db->select("savsoft_category.category_name as subject,unit.unit_name as lesson");
		$this->db->where("day", $date);
		$this->db->join("unit", "unit.unit_number=timetable.unit and unit.cid=timetable.cid and unit.lid=timetable.lid and unit.sub_subject=timetable.sub_subject");
		$this->db->join("savsoft_category", "timetable.cid=savsoft_category.cid");
		$data=$this->db->get("timetable")->result_array();
		echo json_encode($data);
	}
	
	//demo
	function get_timetable($uid, $date){
		//jd: class//lid//
		$this->db->select("demo_savsoft_category.upcase_name as subject,unit.unit_name as lesson");
		$this->db->where("day", $date);
		$this->db->join("unit", "unit.unit_number=demo_timetable.unit and unit.cid=demo_timetable.cid and unit.lid=demo_timetable.lid and unit.sub_subject=demo_timetable.sub_subject");
		$this->db->join("demo_savsoft_category", "demo_timetable.cid=demo_savsoft_category.cid");
		$data=$this->db->get("demo_timetable")->result_array();
		echo json_encode($data);
	}
	
	//real
	function get_time_table_r($uid){
		//jd: class//lid//
		
		$array_1 = array();
		$array_2 = array();
		$array_3 = array();
		$array_4 = array();
		$array_5 = array();

		
		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",
		                '12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'Giáo dục công dân','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý');
		
		$this->db->select("id_day,id_lesson,id_category");
		$this->db->where("id_class",0);
		$this->db->where("lid",8);
		//jd
        $this->db->where("id_lesson <",6);		
		$data = $this->db->get("savsoft_schedule")->result_array();
		
		foreach($data as $k=>$d){
			if($d['id_lesson']==1){
				array_push($array_1,$array_map[$d['id_category']]);
			}
			if($d['id_lesson']==2){
				array_push($array_2,$array_map[$d['id_category']]);
			}
			if($d['id_lesson']==3){
				array_push($array_3,$array_map[$d['id_category']]);
			}
			if($d['id_lesson']==4){
				array_push($array_4,$array_map[$d['id_category']]);
			}
			if($d['id_lesson']==5){
				array_push($array_5,$array_map[$d['id_category']]);
			}
			
			
		}
		
		$result = array($array_1,$array_2,$array_3,$array_4,$array_5);
		echo json_encode($result);
	}
	
	
	//demo
	function get_time_table($uid){
		//jd: class//lid//
		
		$array_1 = array();
		$array_2 = array();
		$array_3 = array();
		$array_4 = array();
		$array_5 = array();

		
		//$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",
		//                '12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'Giáo dục công dân','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học');
		$array_map= array('0'=>"",'3'=>"TOÁN",'4'=>"VẬT LÝ",'5'=>"HÓA HỌC",'6'=>"ĐỊA LÝ",'7'=>"TIN HỌC", '8'=>"SINH HỌC", '9'=>'KHOA HỌC', '10'=>"LỊCH SỬ",'11'=>"CÔNG NGHỆ", '12'=>'TIẾNG ANH','13'=>'THIÊN VĂN - VŨ TRỤ','14'=>'ROBOT','15'=>'MÔI TRƯỜNG','16'=>'SỨC KHỎE','17'=>'NGỮ VĂN','18'=>'TIẾNG VIỆT','19'=>'XÃ HỘI','20'=>'TEST IQ','21'=>'GDCD','22'=>'TỰ NHIÊN VÀ XÃ HỘI','23'=>'LỊCH SỬ VÀ ĐỊA LÝ','24'=>'THỂ DỤC','25'=>'ÂM NHẠC','26'=>'CHÀO CỜ','27'=>'SINH HOẠT','28'=>'TỰ HỌC'); 
		
		$this->db->select("id_day,id_lesson,id_category");
		$this->db->where("id_class",0);
		$this->db->where("lid",8);
		//jd
        $this->db->where("id_lesson <",6);		
		$data = $this->db->get("demo_savsoft_schedule")->result_array();
		
		foreach($data as $k=>$d){
			if($d['id_lesson']==1){
				array_push($array_1,$array_map[$d['id_category']]);
			}
			if($d['id_lesson']==2){
				array_push($array_2,$array_map[$d['id_category']]);
			}
			if($d['id_lesson']==3){
				array_push($array_3,$array_map[$d['id_category']]);
			}
			if($d['id_lesson']==4){
				array_push($array_4,$array_map[$d['id_category']]);
			}
			if($d['id_lesson']==5){
				array_push($array_5,$array_map[$d['id_category']]);
			}
			
			
		}
		
		$result = array($array_1,$array_2,$array_3,$array_4,$array_5);
		echo json_encode($result);
	}
	
	//demo++
	function get_time_table2($uid){
		//jd: class//lid//
		
		$array_1 = array();
		$array_2 = array();
		$array_3 = array();
		$array_4 = array();
		$array_5 = array();

		
		//$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",
		//                '12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'Giáo dục công dân','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học');
		$array_map= array('0'=>"",'3'=>"TOÁN",'4'=>"VẬT LÝ",'5'=>"HÓA HỌC",'6'=>"ĐỊA LÝ",'7'=>"TIN HỌC", '8'=>"SINH HỌC", '9'=>'KHOA HỌC', '10'=>"LỊCH SỬ",'11'=>"CÔNG NGHỆ", '12'=>'TIẾNG ANH','13'=>'THIÊN VĂN - VŨ TRỤ','14'=>'ROBOT','15'=>'MÔI TRƯỜNG','16'=>'SỨC KHỎE','17'=>'NGỮ VĂN','18'=>'TIẾNG VIỆT','19'=>'XÃ HỘI','20'=>'TEST IQ','21'=>'GDCD','22'=>'TỰ NHIÊN VÀ XÃ HỘI','23'=>'LỊCH SỬ VÀ ĐỊA LÝ','24'=>'THỂ DỤC','25'=>'ÂM NHẠC','26'=>'CHÀO CỜ','27'=>'SINH HOẠT','28'=>'TỰ HỌC'); 
		
		$this->db->select("id_day,id_lesson,id_category");
		$this->db->where("id_class",0);
		$this->db->where("lid",8);
		//jd
        $this->db->where("id_lesson <",6);		
		$data = $this->db->get("demo_savsoft_schedule")->result_array();
		
		foreach($data as $k=>$d){
			if($d['id_lesson']==1){
				array_push($array_1,array("id"=>$d['id_category'],"subject"=>$array_map[$d['id_category']]));
			}
			if($d['id_lesson']==2){
				array_push($array_2,array("id"=>$d['id_category'],"subject"=>$array_map[$d['id_category']]));
			}
			if($d['id_lesson']==3){
				array_push($array_3,array("id"=>$d['id_category'],"subject"=>$array_map[$d['id_category']]));
			}
			if($d['id_lesson']==4){
				array_push($array_4,array("id"=>$d['id_category'],"subject"=>$array_map[$d['id_category']]));
			}
			if($d['id_lesson']==5){
				array_push($array_5,array("id"=>$d['id_category'],"subject"=>$array_map[$d['id_category']]));
			}
			
			
		}
		
		$result = array($array_1,$array_2,$array_3,$array_4,$array_5);
		echo json_encode($result);
	}
	
	
	function update_avatar($uid){
		 $inp = json_decode($this->input->raw_input_stream,true);
		 
		$avatar = $inp['data'];
        $data = base64_decode($avatar);
		
		file_put_contents("./upload/avatar/".$uid.".png", $data);
		
		$this->db->where("uid", $uid);
		$this->db->update("savsoft_users", array("photo"=>base_url('upload/avatar/'.$uid.'.png')));
	    echo json_encode(array("status"=>"success", "full_url"=>base_url('upload/avatar/'.$uid.'.png') ));
	}
	
	function update_info(){
		$uid=$_POST["uid"];
		$name=$_POST["name"];
		$password=$_POST["password"];
		$birthdate=$_POST["birthdate"];
		$schoolid=$_POST["schoolid"];
		$class_name=$_POST["class_name"];
		$this->db->where("uid", $uid);
		$user= $this->db->get('savsoft_users')->row_array();
		if($user){
			if(trim($name)!=""){
				if($password!=""){
					$this->db->where("uid", $uid);
					$this->db->update("savsoft_users", array("first_name"=>$name,"last_name"=>"","birthdate"=>$birthdate,"password"=>MD5($password), "school"=>$schoolid,"class_name"=> $class_name));
					echo json_encode(array("status"=>"success", "message"=>"Cập nhật thành công"));
				}
				else{
					echo json_encode(array("status"=>"error", "message"=>"Mật khẩu bị bỏ trống"));
				}
			}
			else{
				echo json_encode(array("status"=>"error", "message"=>"Tên bị bỏ trống"));
			}
		}
		else{
			echo json_encode(array("status"=>"error", "message"=>"Tài khoản không tồn tại"));
		}
		
	}
	
	//real
	function get_child_timetable_r($uid){
		
		//get child
		$sql= "select uid,first_name, last_name, photo from savsoft_users where parent_id=$uid or parent_id like '$uid,%' or  parent_id like '%,$uid' or parent_id like '%,$uid,%'" ;
		$data = $this->db->query($sql)->result_array();
		
		foreach($data as $k=>$d){
			if(!$d['photo']){
				$data[$k]['photo']=base_url('upload/avatar/default.png');
			}
			// jd filter timetable for each child
			$today=  date("Y-m-d");		
			$this->db->distinct();
			$this->db->select("savsoft_category.category_name as subject,unit.unit_name as lesson");
			$this->db->where("day", $today);
			$this->db->join("unit", "unit.unit_number=timetable.unit and unit.cid=timetable.cid and unit.lid=timetable.lid and unit.sub_subject=timetable.sub_subject");
			$this->db->join("savsoft_category", "timetable.cid=savsoft_category.cid");
			$data[$k]['timetable']= $this->db->get('timetable')->result_array();
				
		}
		echo json_encode($data);
		
		
		
	}
	
	

	function get_child_timetable($uid){
		
		//get child
		$sql= "select uid,first_name as name, photo, grade from savsoft_users where parent_id=$uid or parent_id like '$uid,%' or  parent_id like '%,$uid' or parent_id like '%,$uid,%'" ;
		$data = $this->db->query($sql)->result_array();
		
		foreach($data as $k=>$d){
			if(!$d['photo']){
				$data[$k]['photo']=base_url('upload/avatar/default.png');
			}
			
			$data[$k]['first_name']=$data[$k]['name']." - Lớp ". ($d['grade']-2);
			$data[$k]['class_name']=$d['grade']-2;
			
			// jd filter timetable for each child
			$today=  date("Y-m-d");		
			$this->db->distinct();
			$this->db->select("demo_timetable.ttid,demo_savsoft_category.upcase_name as subject,unit.unit_name as lesson");
			$this->db->where("day", $today);
			$this->db->join("unit", "unit.unit_number=demo_timetable.unit and unit.cid=demo_timetable.cid and unit.lid=demo_timetable.lid and unit.sub_subject=demo_timetable.sub_subject");
			$this->db->join("demo_savsoft_category", "demo_timetable.cid=demo_savsoft_category.cid");
			$this->db->order_by("demo_timetable.ttid asc");
			$data[$k]['timetable']= $this->db->get('demo_timetable')->result_array();
			
				
		}
		echo json_encode($data);
		log_message("error", $sql."xxxxx".$uid."xxxxxxx".json_encode($data));
		
		
	}
	

	function get_schedule_by_category($uid,$cid){
		//jd lid
		$this->db->select("unit_name as lesson,day");
		$this->db->where("demo_timetable.cid", $cid);
		$this->db->join("unit", "unit.unit_number=demo_timetable.unit and unit.sub_subject=demo_timetable.sub_subject and unit.lid=demo_timetable.lid and unit.cid=demo_timetable.cid ");
		 $this->db->order_by("day asc");
		$data = $this->db->get("demo_timetable")->result_array();
		foreach($data as $k=>$d){
			$data[$k]['day']=date_format(date_create($d['day']),"d / m");
		}
		echo json_encode($data);
	}
	
	function get_city_list(){
		$this->db->select("did as cityid, dataitem_name as city ");
		$this->db->where("group_id",1);
		$this->db->where("dataitem_level",1);
		$data=$this->db->get("savsoft_dataitem")->result_array();
		echo json_encode($data);
	}
	
	function get_county_list($city_id){
		$this->db->select("did as countyid, dataitem_name as county ");
		$this->db->where("group_id",1);
		$this->db->where("dataitem_level",2);
		$this->db->where("parent_id",$city_id);
		$data=$this->db->get("savsoft_dataitem")->result_array();
		echo json_encode($data);
	}
	function get_ward_list($county_id){
		$this->db->select("did as wardid, dataitem_name as ward ");
		$this->db->where("group_id",1);
		$this->db->where("dataitem_level",3);
		$this->db->where("parent_id",$county_id);
		$data=$this->db->get("savsoft_dataitem")->result_array();
		echo json_encode($data);
	}
	
	function get_school_list($ward_id){
		$this->db->select("schoolid,school_name ");
		$this->db->where("phuong_xa",$ward_id);
		$data=$this->db->get("school")->result_array();
		echo json_encode($data);
	}
	
	function get_school_list2($county_id){
		$this->db->select("schoolid,school_name ");
		$this->db->where("quan_huyen",$county_id);
		$data=$this->db->get("school")->result_array();
		echo json_encode($data);
	}
	
	function set_school($uid,$schoolid){
		$this->db->where("uid", $uid);
		if($this->db->update("savsoft_users", array("school"=> $schoolid))){
			echo json_encode(array("message"=>"success"));
		}
		
		else
			echo json_encode(array("message"=>"error"));
		
	
	}
	
	function change_type_account($uid,$su){
		$this->db->where("uid", $uid);
		$this->db->where("user_status", "Active");
		$olddata=$this->db->get("savsoft_users")->row_array();
		if($olddata && ($su==2||$su==3||$su==4)){
			if($olddata['su']!=$su ){
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
						"su"=>$su,
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
						//"auth_token": null,

				);
				
				
				$olddata['email'].= md5($olddata['email'].rand(1,9999));
				$olddata["user_status"]="Inactive";
				$olddata["subscribe"]=0;
				$this->db->where("uid",$uid);
				$this->db->update("savsoft_users",$olddata);
				$this->db->insert("savsoft_users",$newdata);
				echo json_encode(array("message"=>'success'));
			}
			else{
				echo json_encode(array("message"=>'error'));
			}
		}
		else{
			echo json_encode(array("message"=>'error'));
		}
	}
	
	
	function logoutapp(){
		$deviceid=$_POST["deviceid"];
		$uid=$_POST["uid"];
		$app=$_POST["app"];
		
		$this->db->where("uid", $uid);
		$this->db->where("deviceid", $deviceid);
		$this->db->where("app",$app);
		$this->db->delete("user_token_fcm");
		echo json_encode(array("message"=>"success"));
	}
	
	function get_stemup_enable($uid){
		$this->db->select("stemup_enable");
		$this->db->where("uid", $uid);
		$data=$this->db->get("savsoft_users")->row_array();
		if(!$data)
			$data= array();
		echo json_encode($data);
	}
	
	
	function login_eid(){
		$this->load->library('Curl');
		$curl = curl_init();
        
		$base = "http://eid.itrithuc.vn/auth";
		$realm="eid";
		
		curl_setopt_array($curl, array(
			  CURLOPT_URL => $base."/realms/".$realm."/protocol/openid-connect/token",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "username=tung.ta%40dtt.vn&password=12345&grant_type=password&client_id=dev.stemup.app",
			  CURLOPT_HTTPHEADER => array(
				"Accept: */*",
				"Connection: keep-alive",
				"Content-Type: application/x-www-form-urlencoded",
				"Host: 192.168.1.121:8080",
				"Postman-Token: 9e10f62b-aab1-4af3-8536-79f6bba4a199",
				"User-Agent: PostmanRuntime/7.11.0",
				"accept-encoding: gzip, deflate",
				"cache-control: no-cache",
				"content-length: 85",
				"cookie: AUTH_SESSION_ID=cd83dc79-70c5-4d31-beab-408b37844428.id"
			  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
	}
	function upd(){
		$this->db->where("level_hard >", 3);
		$this->db->order_by("quid desc");
		$this->db->limit(60);
		$this->db->offset(240);
		$data=$this->db->get("savsoft_quiz")->result_array();
		foreach($data as $a){
			$this->db->where("cid",29);
			$this->db->where("status",1);
			$this->db->where("deleted",0);
			$this->db->where("type",3);
			$this->db->order_by("rand()");
			$qt=$this->db->get("savsoft_qbank")->row_array();
			$this->db->where("link",$qt['source']);
			$rd=$this->db->get("reading_material")->row_array();
			
			$this->db->where("cid",29);
			$this->db->where("status",1);
			$this->db->where("deleted",0);
			$this->db->where("type",2);
			$this->db->order_by("rand()");
			$vqt=$this->db->get("savsoft_qbank")->row_array();
			preg_match_all('/<iframe[^>]+>/i',$vqt['question'], $vidTags); 
			if(count($vidTags[0])>0){
					 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
					 $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
					 //$vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
					 $img_video="https://img.youtube.com/vi/".$vid."/mqdefault.jpg";
					 $sqll= "select title from savsoft_library where content like '%$vid%'";
					 $video_title=$this->db->query($sqll)->row_array()['title'];
			} 
			$update=array("reading_mcq"=>$qt['qid'],
						  "reading_title"=>$rd['title'],
						  "reading"=>$rd['content'], 
						  "img_reading"=>$rd['img'],
						  "video_mcq"=>$vqt['qid'],
						  "video_title"=>$video_title,
						  "img_video"=>$img_video
						 );
		   $this->db->where("quid",$a['quid']);	
           $this->db->update("savsoft_quiz",$update);				
		   echo json_encode($update);
		}
		
	}
	
	function forgot_pwd(){
		$email =$this->input->post('email');
		$this->db->where('email2',$email);
		$us =$this->db->get('savsoft_users');
		if($us->num_rows()>0){	
			$user = $us->row_array();
			$name = $user['first_name'].' '.$user['last_name'];
			//generate token
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$check=true;
			while($check){
				$token = '';
				for ($i = 0; $i < 20; $i++) {
					$token.= $characters[rand(0, $charactersLength - 1)];
				}
				$this->db->where('resetpwd_token', $token);
				$n = $this->db->get('savsoft_users')->num_rows();
				if($n==0)
					$check=false;
			}
			$this->db->where('email',$email);
			$this->db->update('savsoft_users', array('resetpwd_token'=>$token));
			$result = array("message"=>"success");
			echo json_encode($result);
			//send email
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
			$subject='Đổi mật khẩu';
			$message=$this->config->item('activation_message');;
							
							
			$message ="<p>Chào bạn ".$name."!</p>";
			$message.= '<p>Bạn đã yêu cầu thay đổi mật khẩu liên kết với email này!</p></p> Bạn có thể thực hiện thay đổi mật khẩu qua liên kết này</p>';
			$message.= '<p><a href="'.site_url('home/resetpassword2/'.$token).'" type="button"> Tạo mật khẩu mới</a></p>';
			$message.= '<p>Nếu không muốn đổi mật khẩu bạn chỉ cần bỏ qua email này.</p>';
			$message.= '<p>Trân trọng,</p>';
			$message.='Gửi bởi '.'<a href="'.base_url().'">stemup.app</a>';
			$this->email->to($email);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
			
		}
		else{
			$result = array("message"=>"error");
			echo json_encode($result);
		}
		
	}
	
	function send_feedback(){
		$title=$_POST['title'];
		$content = $_POST['content'];
		$uid= $_POST['uid'];
		$type= $_POST['type'];
		$inp =array('title'=>$title,
					'content'=> $content,
					'uid'=>$uid,
					'type'=> $type
					);
		if($this->db->insert('feedback', $inp)){
			echo json_encode(array("message"=>"success"));
		}
		else{
			echo json_encode(array("message"=>"error"));
		}
		
		
	}
	
   function update_s(){
		$sql = "select * from reading_material where rdid>=274";
		$data=$this->db->query($sql)->result_array();
		foreach($data as $d){
			$sql2 = "select * from reading_material_3 where link='".$d['link']."'";
			$data2=$this->db->query($sql2)->row_array();
			
			$this->db->where("rdid",$d['rdid']);
			$this->db->update("reading_material", array("title"=>$data2['title']));
			
			$this->db->where("rdid",$data2['rdid']);
			$this->db->update("reading_material_3", array("rdid1"=>$d['rdid']));
		}
	}
	
	
	function verify_email($uid,$token){
		log_message("error", $uid."  ".$token);
		$this->db->where("uid", $uid);
		$user=$this->db->get("savsoft_users")->row_array();
		if($token==$user['auth_token']){
			
			$this->db->where("uid", $uid);
			if($this->db->update("savsoft_users", array("auth_token"=>"", "auth_email"=>1, 'verify_code'=>0))){
				echo "Bạn đã xác nhận thành công!!";
			}
				
		}
	}
	
	
	function update_info2(){
		$grade= $_POST['grade'];
		$schoolid = $_POST['schoolid'];
		$uid= $_POST['uid'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		
		log_message("error", json_encode($_POST));
		
		$data_update = array("grade"=>$grade,"school"=>$schoolid, "first_name"=>$name);
		
		
		$this->db->where("uid", $uid);
		$this->db->where("su", 2);
		$user= $this->db->get('savsoft_users')->row_array();
		if($user){
			if(trim($name)!=""){
				if($password!=""){
					$data_update['password']= MD5($password);
					log_message("error", "&&&&####".json_encode($data_update));
				}
				log_message("error", "&&&&".json_encode($data_update));
				$this->db->where("uid", $uid);
				$this->db->update("savsoft_users" ,$data_update);
				echo json_encode(array("status"=>"success", "message"=>"Cập nhật thành công"));
			}	
			else{
				echo json_encode(array("status"=>"error", "message"=>"Tên bị bỏ trống"));
			}
		}
		else{
			echo json_encode(array("status"=>"error", "message"=>"Tài khoản không tồn tại"));
		}
		
		
		
		
	}

	function make_quiz($childid){

				$today=  date("d-m", strtotime("+0 day"));
				$day=  date("Y-m-d", strtotime("+0 day"));
				
				$sql="select grade, assign_categories from savsoft_users where uid=$childid";
				$lid1= $this->db->query($sql)->row_array();
				$lid = $lid1['grade'];

				$cid1=$lid1['assign_categories'];
				$sql_av_cid1="select available_cids from level_category where lid=$lid";

				$av_cid1_arr= $this->db->query($sql_av_cid1)->row_array();
				$av_cid1=$av_cid1_arr['available_cids'];

				$sqlc=  "select cid,category_name from savsoft_category where cid in ($cid1) and cid in ($av_cid1)";
				
				
				$sqlce= $sqlc."order by rand() limit 1";
				$cat= $this->db->query($sqlce)->result_array();
				if(!$cat){
					$sqlc="select cid,category_name from savsoft_category where cid in ($av_cid1)";
				}
				
				$sqlce= $sqlc."order by rand() limit 1";
				$sqlcn= $sqlc."order by rand() limit 2";
				$sqlch= $sqlc."order by rand() limit 3";
				
				//Bài quiz ngắn
				$cate_es= $this->db->query($sqlce)->result_array();
				$cid=$cate_es[0]['cid'];
				$sql_cate_items="select qid from savsoft_qbank where deleted=0 and status=1 and cid=$cid and lid=$lid order by rand() limit 5";
				$cate_es_result = $this->db->query($sql_cate_items)->result_array();


				// $cate_nm= $this->db->query($sqlcn)->result_array();
				// $cate_ha= $this->db->query($sqlch)->result_array();

				$today=  date("d-m", strtotime("+0 day"));				
				$quiz_name="Bài học cùng con ngày ".$today." - Ngắn";

				$qids='';
				foreach($cate_es_result as $value){
					if($qids==''){
						$qids.=$value['qid'];
					}else{
						$qids.=','.$value['qid'];
					}
				}


				$noq=count(explode(",", $qids));

				$sql_reading="select * from savsoft_qbank sq
								LEFT JOIN reading_material mr on sq.source  = mr.link
								where type=3 and deleted=0 
								order by rand() limit 3";
				$readingz=$this->db->query($sql_reading)->result_array();
				
				$reading_mcq=$readingz[0]['qid'];
				$reading=$readingz[0]["content"];
				$reading_title=$readingz[0]["title"];				
				$img_reading=$readingz[0]["img"];

				$sql_video="select * from savsoft_qbank sq
							where type=2 and deleted=0 and question not like '%facebook%'
							order by rand() limit 3";
				$_video=$this->db->query($sql_video)->result_array();								
				$start=strpos($_video[0]['question'],'embed/');
				$video_mcq=$_video[0]['qid'];
				$video_question=$_video[0]['question'];
				$video_id=substr($video_question,$start+6,11);

				$sql_video_title="select * from savsoft_library where source_id='$video_id'";
				$video_title_arr=$this->db->query($sql_video_title)->row_array();

				$video_title=$video_title_arr['title'];
				$img_video='https://img.youtube.com/vi/'.$video_id.'/mqdefault.jpg';

				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$childid, $day,$lid,1,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);

				//Bài quiz vừa
				$qids='';

				$cate_md= $this->db->query($sqlcn)->result_array();
				$cid0=$cate_md[0]['cid'];
				$sql_cate_items0="select qid from savsoft_qbank where deleted=0 and status=1 and cid=$cid0 and lid=$lid order by rand() limit 5";
				$cate_es_result0 = $this->db->query($sql_cate_items0)->result_array();

				foreach($cate_es_result0 as $value){
					if($qids==''){
						$qids.=$value['qid'];
					}else{
						$qids.=','.$value['qid'];
					}
				}

				if($cate_md[1]){
					$cid1=$cate_md[1]['cid'];
				$sql_cate_items1="select qid from savsoft_qbank where deleted=0 and status=1 and cid=$cid1 and lid=$lid order by rand() limit 5";
				$cate_es_result1 = $this->db->query($sql_cate_items1)->result_array();
				foreach($cate_es_result1 as $value){
					if($qids==''){
						$qids.=$value['qid'];
					}else{
						$qids.=','.$value['qid'];
					}
				}
				}

								
				$quiz_name="Bài học cùng con ngày ".$today." - Vừa";

				$noq=count(explode(",", $qids));

				$sql_reading="select * from savsoft_qbank sq
								LEFT JOIN reading_material mr on sq.source  = mr.link
								where type=3 and deleted=0 
								order by rand() limit 3";
				$readingz=$this->db->query($sql_reading)->result_array();
				
				$reading_mcq=$readingz[1]['qid'];
				$reading=$readingz[1]["content"];
				$reading_title=$readingz[1]["title"];				
				$img_reading=$readingz[1]["img"];

				$sql_video="select * from savsoft_qbank sq
							where type=2 and deleted=0 and question not like '%facebook%'
							order by rand() limit 3";
				$_video=$this->db->query($sql_video)->result_array();								
				$start=strpos($_video[1]['question'],'embed/');
				$video_mcq=$_video[1]['qid'];
				$video_question=$_video[1]['question'];
				$video_id=substr($video_question,$start+6,11);

				$sql_video_title="select * from savsoft_library where source_id='$video_id'";
				$video_title_arr=$this->db->query($sql_video_title)->row_array();

				$video_title=$video_title_arr['title'];
				$img_video='https://img.youtube.com/vi/'.$video_id.'/mqdefault.jpg';

				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$childid, $day,$lid,2,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);

				//Bài quiz khó
				$qids='';

				$cate_hd= $this->db->query($sqlch)->result_array();
				$cid0=$cate_hd[0]['cid'];
				$sql_cate_items0="select qid from savsoft_qbank where deleted=0 and status=1 and cid=$cid0 and lid=$lid order by rand() limit 5";
				$cate_es_result0 = $this->db->query($sql_cate_items0)->result_array();

				foreach($cate_es_result0 as $value){
					if($qids==''){
						$qids.=$value['qid'];
					}else{
						$qids.=','.$value['qid'];
					}
				}

				if($cate_hd[1]){
					$cid1=$cate_md[1]['cid'];
					$sql_cate_items1="select qid from savsoft_qbank where deleted=0 and status=1 and cid=$cid1 and lid=$lid order by rand() limit 5";
					$cate_es_result1 = $this->db->query($sql_cate_items1)->result_array();

				foreach($cate_es_result1 as $value){
					if($qids==''){
						$qids.=$value['qid'];
					}else{
						$qids.=','.$value['qid'];
					}
				}

				}
				
				if($cate_hd[2]){
					$cid2=$cate_hd[2]['cid'];
					$sql_cate_items2="select qid from savsoft_qbank where deleted=0 and status=1 and cid=$cid2 and lid=$lid order by rand() limit 5";
					$cate_es_result2 = $this->db->query($sql_cate_items2)->result_array();

				foreach($cate_es_result2 as $value){
					if($qids==''){
						$qids.=$value['qid'];
					}else{
						$qids.=','.$value['qid'];
					}
				}
				
				}
				
								
				$quiz_name="Bài học cùng con ngày ".$today." - Dài";

				
				

				$noq=count(explode(",", $qids));

				$sql_reading="select * from savsoft_qbank sq
								LEFT JOIN reading_material mr on sq.source  = mr.link
								where type=3 and deleted=0 
								order by rand() limit 3";
				$readingz=$this->db->query($sql_reading)->result_array();
				
				$reading_mcq=$readingz[2]['qid'];
				$reading=$readingz[2]["content"];
				$reading_title=$readingz[2]["title"];				
				$img_reading=$readingz[2]["img"];

				$sql_video="select * from savsoft_qbank sq
							where type=2 and deleted=0 and question not like '%facebook%'
							order by rand() limit 3";
				$_video=$this->db->query($sql_video)->result_array();								
				$start=strpos($_video[2]['question'],'embed/');
				$video_mcq=$_video[2]['qid'];
				$video_question=$_video[2]['question'];
				$video_id=substr($video_question,$start+6,11);

				$sql_video_title="select * from savsoft_library where source_id='$video_id'";
				$video_title_arr=$this->db->query($sql_video_title)->row_array();

				$video_title=$video_title_arr['title'];
				$img_video='https://img.youtube.com/vi/'.$video_id.'/mqdefault.jpg';

				$this->quiz_model->insert_quiz_system($quiz_name,$qids,$noq,$childid, $day,$lid,3,null,1, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video);
	}

	//Hiển thị quiz
	function display_quiz($day,$childid,$parentid,$cuser,$str_date){

		$array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",'12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'Giáo Dục Công Dân','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học','31'=>'Đạo Đức','32'=>'Mỹ Thuật','33'=>'Thủ Công','34'=>'Kỹ Thuật');


		$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading, lid');
				$this->db->where('day', $day);
				$this->db->where('level_hard',1);
				$this->db->where('for_uid',$childid);
				// if($for_uid==0)
				// 	$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$this->db->order_by('quid desc');
				$data_es=$this->db->get('savsoft_quiz')->row_array();
					
				$img_es= array();
				$question_es= array();
				$rquestion_es=array();
				$rquestion_es_link="";
				$rquestion_es_content="";
				$vquestion_es_video="";
				$vquestion_es_title="";
				$rquestion_es_title="";
                $vquestion_es=array();
				$total_point_es=0;
				if($data_es){
					$sql = "select question,cid,points,lid from savsoft_qbank where qid in (".$data_es['qids'].") order by cid asc";
					$q_es = $this->db->query($sql)->result_array();
					
					if($data_es['lid']<3){
						$grade=$q_es[0]['lid'];
						$this->db->where('quid',$data_es['quid']);
						$this->db->update('savsoft_quiz',array('lid'=>$grade));
					}
					else{
						$grade=$data_es['lid'];
					}
					
					$cid_es= array();
					$cid_ar_es= array();
					foreach($q_es as $q){
						if(!in_array($q['cid'],$cid_es)){
							array_push($cid_es,$q['cid']);
							array_push($cid_ar_es,array());
						}
						$total_point_es+= $q['points'];
					}
					foreach($q_es as $q){
						
						
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_es, array("url"=>$img)); 
						
						
						$index=array_search($q['cid'],$cid_es);
						array_push($cid_ar_es[$index], array("title"=>strip_tags($q['question'])));
						
					}
					
					foreach($cid_ar_es as $k=>$d){
						array_push($question_es, array("subject"=>$array_map[$cid_es[$k]]." lớp ".($grade-2),"question"=>$d)); 
					}
					if($data_es['reading_mcq']){
						$rquestion_es_content=$data_es['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['reading_mcq'].")";
						$rq_es = $this->db->query($rsql)->result_array();
						if($rq_es){
							$rquestion_es_link=$rq_es[0]['source'];
						}
						foreach($rq_es as $q){
							array_push($rquestion_es, array("title"=>strip_tags($q['question']))); 
							$total_point_es+= $q['points'];
						    
						}
									
				        $rquestion_es_title=$data_es['reading_title'];
					
					}
					else{
						
					}
				    if($data_es['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_es['video_mcq'].")";
						$vq_es = $this->db->query($vsql)->result_array();
						if($vq_es){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_es[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_es_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
								 
							} 
						}
						foreach($vq_es as $q){
							array_push($vquestion_es, array("title"=>strip_tags($q['question']))); 
							$total_point_es+= $q['points'];
						}
						
						$vquestion_es_title=$data_es['video_title'];
					}
					else{
						
					}
					
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_es['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					//log_message("error",$data_es['quid']. " **********".$n['rid']);
					$per_es="";
					if($n){
						$status_es= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_es=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							
							if($per_es || $per_es==0){
								$per_es= "Đã làm: ".number_format($per_es,1)."%";
								$rid_es=$n['rid'];
								
							}
						}
						
					}
					else
					   $status_es= 0;
					
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading, lid');
				$this->db->where('day', $day);
				$this->db->where('level_hard',2);
				$this->db->where('for_uid',$childid);
				//if($for_uid==0)
					// $this->db->where('set',$set);
				$this->db->where('deleted',0);
				$this->db->order_by('quid','desc');
				$data_nm=$this->db->get('savsoft_quiz')->row_array();
				
				$img_nm= array();
				$question_nm= array();
				$rquestion_nm= array();
				$rquestion_nm_link="";
				$vquestion_nm_video="";
				$rquestion_nm_content="";
				$vquestion_nm_title="";
				$rquestion_nm_title="";
                $vquestion_nm=array();
				$total_point_nm=0;
				if($data_nm){
					
					$sql = "select question,cid,points,lid from savsoft_qbank where qid in (".$data_nm['qids'].") order by cid asc";
					$q_nm = $this->db->query($sql)->result_array();
					
					if($data_nm['lid']<3){
						$grade=$q_nm[0]['lid'];
						$this->db->where('quid',$data_nm['quid']);
						$this->db->update('savsoft_quiz',array('lid'=>$grade));
					}
					else{
						$grade=$data_nm['lid'];
					}
					
					$cid_nm= array();
					$cid_ar_nm= array();
					foreach($q_nm as $q){
						if(!in_array($q['cid'],$cid_nm)){
							array_push($cid_nm,$q['cid']);
							array_push($cid_ar_nm,array());
						}
						$total_point_nm+= $q['points'];
					}
					foreach($q_nm as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_nm, array("url"=>$img)); 
					    $index=array_search($q['cid'],$cid_nm);
						array_push($cid_ar_nm[$index], array("title"=>strip_tags($q['question'])));						
						
					}
					
					foreach($cid_ar_nm as $k=>$d){
						array_push($question_nm, array("subject"=>$array_map[$cid_nm[$k]]." lớp ".($grade-2),"question"=>$d)); 
					}
					if($data_nm['reading_mcq']){
						$rquestion_nm_content=$data_nm['reading'];
						$rsql = "select question,source,qid,points from savsoft_qbank where qid in (".$data_nm['reading_mcq'].")";
						$rq_nm = $this->db->query($rsql)->result_array();
						if($rq_nm){
							$rquestion_nm_link=$rq_nm[0]['source'];
						}
						foreach($rq_nm as $q){
							array_push($rquestion_nm, array("title"=>strip_tags($q['question'])));
							$total_point_nm+= $q['points'];							
						}
						$rquestion_nm_title=$data_nm['reading_title'];
					}
					if($data_nm['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_nm['video_mcq'].")";
						$vq_nm = $this->db->query($vsql)->result_array();
						if($vq_nm){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_nm[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_nm_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_nm as $q){
							array_push($vquestion_nm, array("title"=>strip_tags($q['question']))); 
							$total_point_nm+= $q['points'];
						}
						$vquestion_nm_title=$data_nm['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_nm['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					$per_nm="";
					if($n){
						$status_nm= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_nm=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_nm|| $per_nm==0){
								$per_nm= "Đã làm: ".number_format($per_nm,1)."%";
								$rid_nm=$n['rid'];
							}
					    }
					}
					else
					   $status_nm= 0;
				}
				
				$this->db->select('quid, quiz_name, for_uid, qids,noq,reading_mcq,video_mcq,reading,video_title,reading_title,img_video,img_reading,lid');
				$this->db->where('day', $day);
				$this->db->where('level_hard',3);
				$this->db->where('for_uid',$childid);
				// if($for_uid==0)
				// 	$this->db->where('set',$set);
				$this->db->where('deleted',0);
				$this->db->order_by('quid','desc');
				$data_ha=$this->db->get('savsoft_quiz')->row_array();
				
				$img_ha= array();
				$question_ha= array();
				$rquestion_ha= array();
				$rquestion_ha_link="";
				$vquestion_ha_video="";
				$rquestion_ha_content="";
				$vquestion_ha_title="";
				$rquestion_ha_title="";
                $vquestion_ha=array();
				$total_point_ha=0;
				if($data_ha){
					$sql = "select question,cid,points,lid from savsoft_qbank where qid in (".$data_ha['qids'].") order by cid asc";
					$q_ha = $this->db->query($sql)->result_array();
					
					if($data_ha['lid']<3 ){
						$grade=$q_ha[0]['lid'];
						$this->db->where('quid',$data_ha['quid']);
						$this->db->update('savsoft_quiz',array('lid'=>$grade));
					}
					else{
						$grade=$data_ha['lid'];
					}
					
					$cid_ha= array();
					$cid_ar_ha= array();
					foreach($q_ha as $q){
						if(!in_array($q['cid'],$cid_ha)){
							array_push($cid_ha,$q['cid']);
							array_push($cid_ar_ha,array());
						}
						$total_point_ha+= $q['points'];
					}
					foreach($q_ha as $q){
						$origImageSrc="";
						$imgTags="";	
						$htmlContent=$q['question'];
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
							
						 }
						 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
						 if($origImageSrc && strpos($htmlContent,'latex.codecogs.com')===false ){
							$img=$origImageSrc;
						 }
						 else{
							
							$img=base_url("/upload/default_image_quiz.png");
						 }			 
						array_push($img_ha, array("url"=>$img)); 
						$index=array_search($q['cid'],$cid_ha);
						array_push($cid_ar_ha[$index], array("title"=>strip_tags($q['question'])));
					}
					
					foreach($cid_ar_ha as $k=>$d){
						array_push($question_ha, array("subject"=>$array_map[$cid_ha[$k]]." lớp ".($grade-2),"question"=>$d)); 
					}
					if($data_ha['reading_mcq']){
						$rquestion_ha_content=$data_ha['reading'];
						$rsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['reading_mcq'].")";
						$rq_ha = $this->db->query($rsql)->result_array();
						if($rq_ha){
							$rquestion_ha_link=$rq_ha[0]['source'];
						}
						foreach($rq_ha as $q){
							array_push($rquestion_ha, array("title"=>strip_tags($q['question']))); 
							$total_point_ha+= $q['points'];
							
						}
						
						$rquestion_ha_title=$data_ha['reading_title'];
					}
					if($data_ha['video_mcq']){
						$vsql = "select question,source,points from savsoft_qbank where qid in (".$data_ha['video_mcq'].")";
						$vq_ha = $this->db->query($vsql)->result_array();
						if($vq_ha){
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$vq_ha[0]['question'], $vidTags); 
							if(count($vidTags[0])>0){
								 preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								  $vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
								 $vquestion_ha_video="https://www.youtube.com/embed/".$vid."?version=3&loop=1&playlist=".$vid;
							} 
						}
						foreach($vq_ha as $q){
							array_push($vquestion_ha, array("title"=>strip_tags($q['question']))); 
							$total_point_ha+= $q['points'];
						}
						$vquestion_ha_title=$data_ha['video_title'];
					}
					$this->db->where("auid", $parentid);
					$this->db->where("uid", $childid);
					$this->db->where("quid", $data_ha['quid']);
					$n = $this->db->get('savsoft_assign')->row_array() ;
					$per_ha="";
					if($n){
						$status_ha= 1;
						if($n['rid']){
							$this->db->select("percentage_obtained");
							$this->db->where('rid', $n['rid']);
							$per_ha=$this->db->get("savsoft_result")->row_array()['percentage_obtained'];
							if($per_ha ||$per_ha==0){
								$per_ha= "Đã làm: ".number_format($per_ha,1)."%";
								$rid_ha=$n['rid'];
							}
						}
					}
					else
					   $status_ha= 0;
				}
			$r = array(
							 "date"=> $str_date,
							 "grade"=>$cuser['grade'],
							"assignments"=>array( array("level"=>"Ngắn",
							                            "quiz"=> array("quid"=>$data_es['quid'],
														                "total_points"=>$total_point_es,
																		"number_question"=>$data_es['noq'],
																	    "status"=>$status_es,
																		"message_do"=> $per_es,
																		"rid"=>$rid_es,
																		"tasks"=>array(),
																		"images"=>$img_es,
																	    "question"=>$question_es,
																			  ),
															  "reading"=>array("link"=>$rquestion_es_link,
															                //   "content"=>$rquestion_es_content,
																			   "question"=>$rquestion_es,
																			   "img"=>$data_es["img_reading"],
																			   "title"=>$rquestion_es_title),
															  "video"=>array("video"=>$vquestion_es_video,
																			   "question"=>$vquestion_es,
																			   "img"=>$data_es["img_video"],
																			   "title"=>$vquestion_es_title)			   
														),
											      array("level"=>"Vừa",
											              "quiz"=>array("quid"=>$data_nm['quid'],
														      "total_points"=>$total_point_nm,
															  "number_question"=>$data_nm['noq'],
															  "status"=>$status_nm,
															  "message_do"=> $per_nm,
															  "rid"=>$rid_nm,
															  "tasks"=>array(),
															  "images"=>$img_nm,
															  "question"=>$question_nm),
												          "reading"=>array("link"=>$rquestion_nm_link,
																		  // "content"=>$rquestion_nm_content,
																		   "question"=>$rquestion_nm,
																		   "img"=>$data_nm["img_reading"],
																		   "title"=>$rquestion_nm_title),
														  "video"=>array("video"=>$vquestion_nm_video,
																		   "question"=>$vquestion_nm,
																		   "img"=>$data_nm["img_video"],
																		   "title"=>$vquestion_nm_title)	
											        ),
												  array("level"=>"Dài",
												       "quiz"=>array("quid"=>$data_ha['quid'],
													                  "total_points"=>$total_point_ha,
																	  "number_question"=>$data_ha['noq'],
																	  "status"=>$status_ha,
																	  "message_do"=> $per_ha,
																	  "rid"=>$rid_ha,
																	  "tasks"=>array(),
																	  "images"=>$img_ha,
																	   "question"=>$question_ha),
													   "reading"=>array("link"=>$rquestion_ha_link,
													                   //"content"=>$rquestion_ha_content,
												                        "question"=>$rquestion_ha,
																		"img"=>$data_ha["img_reading"],
																		"title"=>$rquestion_ha_title),
														"video"=>array("video"=>$vquestion_ha_video,
																	   "question"=>$vquestion_ha,
																	   "img"=>$data_ha["img_video"],
																	   "title"=>$vquestion_ha_title)	
												   )
												),
							 );

			return $r;
	}

	function delete_user(){
		$childid=$_POST['uid'];
		$sql="update savsoft_users set user_status='inactive' where uid=$childid";
		$query=$this->db->query($sql);
		if($query){
			echo json_encode(array('message'=>'Success!','status'=>'1'));
		}else{
			echo json_encode(array('message'=>'Fail!','status'=>'0'));
		}
	}

	

	
}
