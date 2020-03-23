<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper(array('Form', 'Cookie', 'String', 'url'));
	   $this->load->model("user_model");
	   $this->load->model("data_model");
	   $this->load->model("account_model");
	   $this->load->model("sso_model");
	   $this->load->model("profile_model");
	   $this->lang->load('basic', $this->config->item('language'));
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			delete_cookie("savsoftquiz");
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');	
		delete_cookie("savsoftquiz");		
		redirect('home');
		}
	 }

	public function index($page='0')
	{
		$logged_in=$this->session->userdata('logged_in');
		    $user_p=explode(',',$logged_in['users']);
			if(!in_array('List_all',$user_p)){
			exit($this->lang->line('permission_denied'));
			}
		$txtSearch = $_GET['search'];
		if(!$txtSearch)
		{
			$s = '';
		}
		else{
			$s = $txtSearch;
		}
		$data['url'] = 'index';
		$data['search']= $s;
		$data['page'] = $page;
		$data['number_users']=$this->user_model->number_user($s);
		$data['last_page'] = ceil($data['number_users']/20 -1);
		$data['limit']=$limit;
		$data['title']=$this->lang->line('userlist');
		// fetching user list
		$data['result']=$this->user_model->users_list($page,$s);
		$data['tinhthanh']=$this->profile_model->data_tinh_thanh();
		$this->load->view('header',$data);
		$this->load->view('user_list',$data);
		$this->load->view('footer',$data);
	}
	public function inaction($page=0){
		$logged_in=$this->session->userdata('logged_in');
		$user_p=explode(',',$logged_in['users']);
		if(!in_array('List_all',$user_p)){
		exit($this->lang->line('permission_denied'));
		}
		$txtSearch = $_GET['search'];
		if(!$txtSearch)
		{
			$s = '';
		}
		else{
			$s = $txtSearch;
		}
		$data['search']= $s;
		$data['page'] = $page;
		$data['last_page'] = ceil($data['number_users']/20 -1);
		$data['limit']=$limit;
		$time =  date('Y-m-d H:i:s', strtotime('-1 month'));
		$data['number_users']=$this->user_model->number_inaction($s);
		// fetching user list
		$data['result']=$this->user_model->users_list_inaction($page,$s);
		$this->load->view('header',$data);
		$this->load->view('user_list_inaction',$data);
		$this->load->view('footer',$data);
	//	var_dump($data['result']);
	}
	public function student($page='0'){
		
		$txtSearch = $_GET['search'];
		if(!$txtSearch)
		{
			$s = '';
		}
		else{
			$s = $txtSearch;
		}
		$a = explode( '?', $_SERVER["REQUEST_URI"] );
		$b = explode('/',$a[0]);
		$logged_in=$this->session->userdata('logged_in');
		 
		         $user_p=explode(',',$logged_in['users']);
			if(!in_array('List_all',$user_p)){
			exit($this->lang->line('permission_denied'));
			}
		$data['url'] = $b[4];
		$data['search']= $s;
		$data['page']=$page;
		$data['limit']=$limit;
		$data['title']=$this->lang->line('userlist');
		// fetching user list	
		$data['number_users']=$this->user_model->number_user($s,2);
		$data['last_page'] = ceil($data['number_users']/20 -1);
		$data['result']=$this->user_model->users_list($page,$s,2);
		$data['tinhthanh']=$this->profile_model->data_tinh_thanh();
		//$data['school']=$this->user_model->school_user();
		$this->load->view('header',$data);
		$this->load->view('user_list',$data);
		$this->load->view('footer',$data);
	}
	public function get_showschool($ulist_id){

		$data = $this->user_model->school_user($ulist_id);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	function save_school($ulist_id,$id_school){
		if($ulist_id){
			$this->user_model->save_school($ulist_id,$id_school);	
		}
	}
	public function teacher($page='0'){
		
		$txtSearch = $_GET['search'];
		if(!$txtSearch)
		{
			$s = '';
		}
		else{
			$s = $txtSearch;
		}
		$a = explode( '?', $_SERVER["REQUEST_URI"] );
		$b = explode('/',$a[0]);
		$logged_in=$this->session->userdata('logged_in');
		 
		         $user_p=explode(',',$logged_in['users']);
			if(!in_array('List_all',$user_p)){
			exit($this->lang->line('permission_denied'));
			}
			
			$data['url'] = $b[4];
			$data['search']= $s;
			$data['page']=$page;
			$data['limit']=$limit;
			$data['title']=$this->lang->line('userlist');
		// fetching user list
		$data['tinhthanh']=$this->profile_model->data_tinh_thanh();
		$data['number_users']=$this->user_model->number_user($s,3);
		$data['last_page'] = ceil($data['number_users']/20 -1);
		$data['result']=$this->user_model->users_list($page,$s,3);
		$this->load->view('header',$data);
		$this->load->view('user_list',$data);
		$this->load->view('footer',$data);
	}
	
	public function new_user()
	{
		
		
			$logged_in=$this->session->userdata('logged_in');
			$user_p=explode(',',$logged_in['users']);
			if(!in_array('Add',$user_p)){
			exit($this->lang->line('permission_denied'));
			}
			
			
			
		 $data['title']=$this->lang->line('add_new').' '.$this->lang->line('user');
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$data['account_type']=$this->account_model->account_list(0);
		$data['dataitem_list']=$this->data_model->dataitem_list(1, 1);
		 $this->load->view('header',$data);
		$this->load->view('new_user',$data);
		$this->load->view('footer',$data);
	}
	
		public function insert_user()
	{
	 	
		
			$logged_in=$this->session->userdata('logged_in');
			$user_p=explode(',',$logged_in['users']);
			if(!in_array('Add',$user_p)){
			exit($this->lang->line('permission_denied'));
			}
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[savsoft_users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('user/new_user/');
                }
                else
                {
					if($this->user_model->insert_user()){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
						
					}
					redirect('user/new_user/');
                }       

	}

		public function remove_user($uid){

			$logged_in=$this->session->userdata('logged_in');
			$user_p=explode(',',$logged_in['users']);
			if(!in_array('Remove',$user_p)){
			exit($this->lang->line('permission_denied'));
			}
			if($uid=='1'){
					exit($this->lang->line('permission_denied'));
			}
			
			if($this->user_model->remove_user($uid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
						
					}
					redirect('user');
                     
			
		}

		
		public function edit_user_fill_custom($uid,$rid){
			if($this->input->post('custom')){
				
		foreach($_POST['custom'] as $ck => $cv){
		if($cv != ''){
					$this->db->where('uid',$uid);
                	$this->db->where('field_id',$ck);
                $this->db->delete('savsoft_users_custom');	
				
				
				$savsoft_users_custom=array(
		'field_id'=>$ck,
		'uid'=>$uid,
		'field_values'=>$cv	
		);
		$this->db->insert('savsoft_users_custom',$savsoft_users_custom);
		}
		}
		redirect('result/view_result/'.$rid);
			}
					$data['uid']=$uid;
					$data['rid']=$rid;
		 $data['title']=$this->lang->line('fill_custom_msg');
		// fetching user
		$data['result']=$this->user_model->get_user($uid);
		$data['custom_form_user']=$this->user_model->custom_form_user($uid);
	 
		$data['custom_form']=$this->user_model->custom_form('Result');
	
			$this->load->view('header',$data);
		 $this->load->view('custom_form',$data);
		 
		$this->load->view('footer',$data);	
		}
		
		
		
	public function edit_user($uid)
	{
		
			$logged_in=$this->session->userdata('logged_in');
			$user_p=explode(',',$logged_in['users']);
			 
			if(!in_array('Edit',$user_p)){
			if(in_array('Myaccount',$user_p)){
			 $uid=$logged_in['uid'];
			}else{
			exit($this->lang->line('permission_denied'));
			}
			}
			
			
			
			$data['uid']=$uid;
		 $data['title']=$this->lang->line('edit').' '.$this->lang->line('user');
		// fetching user
		$data['result']=$this->user_model->get_user($uid);
		$data['custom_form_user']=$this->user_model->custom_form_user($uid);
	 	$data['tinhthanh_list']=$this->data_model->dataitem_list(1, 1);
	 	$data['quanhuyen_list']=$this->data_model->dataitem_filter_parent($data['result']['tinhthanh_id']);
	 	$data['xaphuong_list']=$this->data_model->dataitem_filter_parent($data['result']['quanhuyen_id']);
		$data['custom_form']=$this->user_model->custom_form('All');
		$this->load->model("payment_model");
		$data['payment_history']=$this->payment_model->get_payment_history($uid);
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$data['account_type']=$this->account_model->account_list(0); 
		$this->load->view('header',$data);
			if($logged_in['su']=='1'){
		$this->load->view('edit_user',$data);
			}else{
		$this->load->view('myaccount',$data);
				
			}
		$this->load->view('footer',$data);
	}

		public function update_user($uid)
	{
		
		
			$logged_in=$this->session->userdata('logged_in');
						 
			if($logged_in['su']!='1'){
			 $uid=$logged_in['uid'];
			}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');
           if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('user/edit_user/'.$uid);
                }
                else
                {
					if($this->user_model->update_user($uid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
						
					}
					redirect('user/edit_user/'.$uid);
                }       

	}
	
	
	public function group_list(){
		
			$logged_in=$this->session->userdata('logged_in');
                        $setting_p=explode(',',$logged_in['setting']);
			if(!in_array('All',$setting_p)){
			exit($this->lang->line('permission_denied'));
			}
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$data['title']=$this->lang->line('group_list');
		$this->load->view('header',$data);
		$this->load->view('group_list',$data);
		$this->load->view('footer',$data);

		
		
		
	}
	
	public function add_new_group(){
	
			$logged_in=$this->session->userdata('logged_in');
                        $setting_p=explode(',',$logged_in['setting']);
			if(!in_array('All',$setting_p)){
			exit($this->lang->line('permission_denied'));
			}
			
			
			
		if($this->input->post('group_name')){
		if($this->user_model->insert_group()){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
						
					}
					redirect('user/group_list');
		}
		// fetching group list
		$data['title']=$this->lang->line('add_group');
		$this->load->view('header',$data);
		$this->load->view('add_group',$data);
		$this->load->view('footer',$data);

		
		
		
	}



	public function edit_group($gid){
			$logged_in=$this->session->userdata('logged_in');
                        $setting_p=explode(',',$logged_in['setting']);
			if(!in_array('All',$setting_p)){
			exit($this->lang->line('permission_denied'));
			}

		if($this->input->post('group_name')){
		if($this->user_model->update_group($gid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
						
					}
					redirect('user/group_list');
		}
		// fetching group list
		$data['group']=$this->user_model->get_group($gid);
		$data['gid']=$gid;
		$data['title']=$this->lang->line('edit_group');
		$this->load->view('header',$data);
		$this->load->view('edit_group',$data);
		$this->load->view('footer',$data);

		
		
		
	}

        public function upgid($gid){
        $logged_in=$this->session->userdata('logged_in');
			$uid=$logged_in['uid'];
			$group=$this->user_model->get_group($gid);
		if($group['price'] != '0'){
		redirect('payment_gateway_2/subscribe/'.$gid.'/'.$logged_in['uid']);
		 }else{
		$subscription_expired=time()+(365*20*24*60*60);
		}
			$userdata=array(
			'gid'=>$gid,
			'subscription_expired'=>$subscription_expired
			);
			
			$this->db->where('uid',$uid);
			$this->db->update('savsoft_users',$userdata);
			 $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('group_updated_successfully')." </div>");
			redirect('user/edit_user/'.$logged_in['uid']);
        
        
        }
		public function switch_group()
	{
		
		$logged_in=$this->session->userdata('logged_in');
		if(!$this->config->item('allow_switch_group')){
		redirect('user/edit_user/'.$logged_in['uid']);
		}
			$data['title']=$this->lang->line('select_package');
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$this->load->view('header',$data);
		$this->load->view('change_group',$data);
		$this->load->view('footer',$data);
	}
	
	public function pre_remove_group($gid){
		$data['gid']=$gid;
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$data['title']=$this->lang->line('remove_group');
		$this->load->view('header',$data);
		$this->load->view('pre_remove_group',$data);
		$this->load->view('footer',$data);

		
		
		
	}
	
		public function insert_group()
	{
		
		
			$logged_in=$this->session->userdata('logged_in');
                        $setting_p=explode(',',$logged_in['setting']);
			if(!in_array('All',$setting_p)){
			exit($this->lang->line('permission_denied'));
			}
	
				if($this->user_model->insert_group()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
						
				}
				redirect('user/group_list/');
	
	}
	
			public function update_group($gid)
	{
		
		
			$logged_in=$this->session->userdata('logged_in');
                        $setting_p=explode(',',$logged_in['setting']);
			if(!in_array('All',$setting_p)){
			exit($this->lang->line('permission_denied'));
			}
	
				if($this->user_model->update_group($gid)){
                echo "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>";
				}else{
				 echo "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>";
						
				}
				 
	
	}
	
	
	function get_expiry($gid){
		
		echo $this->user_model->get_expiry($gid);
		
	}
	
	
	
	
			public function remove_group($gid){
			
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['setting']);
			if(!in_array('All',$acp)){
			exit($this->lang->line('permission_denied'));
			}
			
                        $mgid=$this->input->post('mgid');
                        $this->db->query(" update savsoft_users set gid='$mgid' where gid='$gid' ");
                        

			
			if($this->user_model->remove_group($gid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
						
					}
					redirect('user/group_list');
                     
			
		}
		
		
		
		
	function remove_custom($field_id){
		        $logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['setting']);
			if(!in_array('All',$acp)){
			exit($this->lang->line('permission_denied'));
			}
			 $this->user_model->remove_custom($field_id);
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('removed_successfully')." </div>");
			 
			 redirect('user/custom_fields');
			}		
		
	function custom_fields(){
		        $logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['setting']);
			if(!in_array('All',$acp)){
			exit($this->lang->line('permission_denied'));
			}
			
			if($this->input->post()){
			 $this->user_model->insert_custom();
			 
			 
			 $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
			 
			 redirect('user/custom_fields');
			 
			}
		
		$data['custom_fields_list']=$this->user_model->custom_fields_list();
		$data['title']=$this->lang->line('custom_forms');
		$this->load->view('header',$data);
		$this->load->view('custom_fields_list',$data);
		$this->load->view('footer',$data);	
		
		
}
		
		
	function edit_custom($field_id){
		        $logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['setting']);
			if(!in_array('All',$acp)){
			exit($this->lang->line('permission_denied'));
			}
			
			if($this->input->post()){
			 $this->user_model->update_custom($field_id);
			 
			 
			 $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
			 
			 redirect('user/custom_fields');
			 
			}
		
		 $data['custom']=$this->user_model->get_custom($field_id);
			  
			 $data['title']=$this->lang->line('custom_forms');
		$this->load->view('header',$data);
		$this->load->view('edit_custom',$data);
		$this->load->view('footer',$data);	
		
		
}
		
		
		

	function logout(){
		delete_cookie('savsoftquiz');
        $this->session->sess_destroy();
		$this->session->unset_userdata('logged_in');		
	    if($this->session->userdata('logged_in_raw')){
			$this->session->unset_userdata('logged_in_raw');	
		}
        $access_token= get_cookie("access_token");
		$refresh_token= get_cookie("refresh_token");
		$res=$this->sso_model->logout($access_token, $refresh_token);
		if($res['error']==0){
			delete_cookie("access_token");
			delete_cookie("refresh_token");
			delete_cookie("code");
		}		
		redirect('home/');
		
	}


	function import_user(){
        $us = $this->session->userdata('logged_in'); 
        if(!$us){
        	redirect('home');
        }
        else{
        	if($us['su']==1){
				$data['group_list']=$this->user_model->group_list();
				$data['account_type']=$this->account_model->account_list_import();
				$data['dataitem_list']=$this->data_model->dataitem_list(1, 1);
				$data['title']="Thêm tài khoản từ file excel";
				$this->load->view('header',$data);
				$this->load->view('import/import_user',$data);

			}
			else{
				redirect('home_user');
			}
		}
				
	}

	function process_excel(){

		if (isset($_POST['uploadclick']))
		{

		    if (isset($_FILES['upload']))
		    {

		        if ($_FILES['upload']['error'] > 0)
		        {
		        	 $this->session->set_flashdata('message','<div class="alert alert-danger">Upload error</div>' ); 
		            
		        }
		        else {
		        	$target_dir = "upload/excel/";
		            $basename = basename($_FILES["upload"]["name"]);
		            $inputFileName = $target_dir . basename($_FILES["upload"]["name"]);              
		        	$fileType = strtolower(pathinfo($inputFileName,PATHINFO_EXTENSION));
		        	if($fileType=="xlsx" | $fileType=="xls" ){
		                // Upload file

		                $target_dir = "upload/excel/";
		                $basename = basename($_FILES["upload"]["name"]);
		                //$inputFileName = $target_dir . basename($_FILES["upload"]["name"]);
		               $inputFileName = $target_dir . 'temp.xlsx';
		                move_uploaded_file($_FILES['upload']['tmp_name'], $inputFileName);
		                //$inputFileName = 'upload/excel/temp.xlsx';				
		            }
		            else {
		        	 	$this->session->set_flashdata('message','<div class="alert alert-danger">Error format</div>' );	
						redirect ('user/import_user');
		            }
		        }
		    }
		    else{
		    	$this->session->set_flashdata('message','<div class="alert alert-danger">Bạn chưa chọn file upload</div>');	
				redirect ('user/import_user');
		        
		    }
		}

		$prid=$this->input->post('tinhthanh_id');
		$dtid=$this->input->post('quanhuyen_id');
		$waid=$this->input->post('xaphuong_id');
        $su = $this->input->post('su');

		$data['file']=$this->user_model->insert_excel($prid,$dtid, $waid, $su,5);
         $us = $this->session->userdata('logged_in'); 
		 if($us['su']==1){
				$data['title']="Tải về file kết quả";
				$this->load->view('header',$data);
				 $this->load->view('import/result_import',$data);

			}
			else{
				redirect('home_user');
			}
		
	}
	
	function test(){
		 
		 $us = $this->session->userdata('logged_in'); 
		 if($us['su']==1){
			    $data['file']= array("1", "2", "3");

				$data['title']="Tải về file kết quả";
				$this->load->view('header',$data);
				 $this->load->view('import/result_import',$data);

			}
			else{
				redirect('home_user');
			}
	}
	
	function change_auth_status($uid){
		 
		 $us = $this->session->userdata('logged_in'); 
		 if($us['su']==1){
			    
             $this->db->where('uid',$uid);
			 $u =$this->db->get("savsoft_users")->row_array();
			 $this->db->where('uid',$uid);
			 
			 if($this->db->update("savsoft_users", array("auth_email"=>1-$u['auth_email']))){
				 echo (1-$u['auth_email']);
			 }
			 else
				 echo "-1";
				 
		 }
		 
	}
	function changepassword(){
		$mes=$this->user_model->changepassword();
		echo $mes;
		
	}
	function getteacher(){
		$this->db->where('su',3);
		$data=$this->db->get('savsoft_users')->result_array();
		for($i=0; $i<count($data); $i++){
			if($data[$i]['category_id']){
				$sql="select category_name from savsoft_category where cid in (". $data[$i]['category_id']. ")";
				$cts=$this->db->query($sql)->result_array();
				$c="";
				foreach($cts as $k=>$ct){
					if($k>0){
						$c.=', ';
					}
					$c.=$ct['category_name'];
				}
				$data[$i]['categories']=$c;
			}
			else{
				$data[$i]['categories']='';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function update_email(){
		 $us = $this->session->userdata('logged_in'); 
		 if($us){
			 $email = $this->input->post("email");
			 $this->db->where("uid", $us['uid']);
			 $this->db->update("savsoft_users", array("email2"=>$email));
			 echo json_encode(array("message"=>"Success"));
		 }
		 else{
			 echo json_encode(array("message"=>"Error: None login"));
		 }
	}
	
	
	function enable_stemup($uid){
		$us = $this->session->userdata('logged_in'); 
		header('Content-Type: application/json');
		if($us){
		  if($us['su']==1){
			  
			  if($this->user_model->enable_stemup($uid))
					echo json_encode(array("status"=>"0"));
			  else
				  echo json_encode(array("status"=>"1"));
		  }	
		  else{
			  echo json_encode(array("status"=>"2"));
		  }
		}
		else{
			 echo json_encode(array("status"=>"3"));
		}
	}
}