<?php
Class User_model extends CI_Model{
	
	
	function stemuplogin($username, $password){
		$this->db->where('password', MD5($password));
		$this->db->where('email', $username);
		$this->db->where('su', 2);
		$query = $this->db->get('savsoft_users');
			 
		if($query->num_rows()==1){
			$user=$query->row_array();
			if($user['verify_code']=='0' ){
				if($user['user_status']=='Active'){
					return array('status'=>'1','user'=>$user);
				}else{
					return array('status'=>'3','message'=>$this->lang->line('account_inactive'));
				}
				
			}else{
				return array('status'=>'2','message'=>$this->lang->line('email_not_verified'));
			
			}
  
		}
		else{
			return array('status'=>'0','message'=>$this->lang->line('invalid_login'));
		}
	}
 
	
	function login($username, $password){
		if($username==''){
			$username=time().rand(1111,9999);
		}
		if($password!=$this->config->item('master_password')){
			$this->db->where('savsoft_users.password', MD5($password));
		}
		//  if (strpos($username, '@') !== false) {
		$this->db->where('savsoft_users.email', $username);
		// }else{
		//   $this->db->where('savsoft_users.wp_user', $username);
		//  }

		// $this -> db -> where('savsoft_users.verify_code', '0');
		$this->db->join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		//  $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$this -> db -> join('account_type', 'savsoft_users.su=account_type.account_id');
		$this->db->limit(1);
		$query = $this -> db -> get('savsoft_users');
			 
		if($query -> num_rows() == 1){
			$user=$query->row_array();
			if($user['verify_code']=='0' ){
				if($user['user_status']=='Active'){
					return array('status'=>'1','user'=>$user);
				}else{
					return array('status'=>'3','message'=>$this->lang->line('account_inactive'));
				}
				
			}else{
				return array('status'=>'2','message'=>$this->lang->line('email_not_verified'));
			
			}
  
		}
		else{
			return array('status'=>'0','message'=>$this->lang->line('invalid_login'));
		}
	}
 
	function login2($mobile, $name='', $avt= ''){
 
		$this->db->or_where('savsoft_users.contact_no', $mobile);
		$this->db->or_where('savsoft_users.email', $mobile);
		// $this -> db -> where('savsoft_users.verify_code', '0');
		$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		//  $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$this -> db -> join('account_type', 'savsoft_users.su=account_type.account_id');
		$this->db->limit(1);
		$query = $this -> db -> get('savsoft_users');
				 
		if($query -> num_rows() == 1){
			$user=$query->row_array();
			if($user['verify_code']=='0'){
	   
				if($user['user_status']=='Active'){
	   
					return array('status'=>'1','user'=>$user);
				}else{
					return array('status'=>'3','message'=>$this->lang->line('account_inactive'));
				}		
			}
			else{
				return array('status'=>'2','message'=>$this->lang->line('email_not_verified'));
			}
		  
		}
		else{
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
				'email'=>$mobile,
				'email2'=>"",
				"user_code"=>$user_code,
				'password'=>md5(rand(1111,9999)),
				'first_name'=>$name,
				'last_name'=>' ',
				'contact_no'=>'',
				'photo'=>$avt,
				'gid'=>$this->config->item('default_gid'),
				'su'=>'5'
			 );
			$this->db->insert("savsoft_users",$userdata);
			$uid=$this->db->insert_id();
     
			$this->db->where('savsoft_users.uid', $uid);
			$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
			$this -> db -> join('account_type', 'savsoft_users.su=account_type.account_id');
			$query = $this->db->get('savsoft_users');
			$user=$query->row_array();
			return array('status'=>'1','user'=>$user);
		}
	}
 
	function resend($email){
		$this -> db -> where('savsoft_users.email', $email);
		// $this -> db -> where('savsoft_users.verify_code', '0');
		$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$this->db->limit(1);
		$query = $this -> db -> get('savsoft_users');
		if($query->num_rows()==0){
			return $this->lang->line('invalid_email');
		}
		$user=$query->row_array();
		$veri_code=$user['verify_code'];
					 
		$verilink=site_url('login/verify/'.$veri_code);
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
		$subject=$this->config->item('activation_subject');
		$message=$this->config->item('activation_message');;
		
		$message=str_replace('[verilink]',$verilink,$message);
	
		$toemail=$email;
		 
		$this->email->to($toemail);
		$this->email->from($fromemail, $fromname);
		$this->email->subject($subject);
		$this->email->message($message);
		if(!$this->email->send()){
		 //print_r($this->email->print_debugger());
		//exit;
		}
		return $this->lang->line('link_sent');
		 
	}
 
	function recent_payments($limit){
		$this -> db -> join('savsoft_group', 'savsoft_payment.gid=savsoft_group.gid');
		$this -> db -> join('savsoft_users', 'savsoft_payment.uid=savsoft_users.uid');
		$this->db->limit($limit);
		$this->db->order_by('savsoft_payment.pid','desc');
		$query = $this -> db -> get('savsoft_payment');	 
		return $query->result_array();
	}
 
	function revenue_months(){

		$revenue=array();
		$months=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		foreach($months as $k => $val){
			$p1=strtotime(date('Y',time()).'-'.$val.'-01');
			$p2=strtotime(date('Y',time()).'-'.$val.'-'.date('t',$p1));
			$query = $this->db->query("select * from savsoft_payment where paid_date >='$p1' and paid_date <='$p2'   ");
			$rev=$query->result_array();
			if($query->num_rows()==0){
				$revenue[$val]=0;
			}else{
				foreach($rev as $rg => $rv){
					if(strtolower($rv['payment_gateway']) != $this->config->item('default_gateway')){
						if(isset($revenue[$val])){
							$revenue[$val]+=$rv['amount']/$this->config->item(strtolower($rv['payment_gateway']).'_conversion');
						}else{
							$revenue[$val]=$rv['amount']/$this->config->item(strtolower($rv['payment_gateway']).'_conversion');
						}
					}else{
						if(isset($revenue[$val])){
							$revenue[$val]+=$rv['amount'];
						}else{
							$revenue[$val]=$rv['amount']; 
						}
        
					}
				}
 
			}
		}
		return $revenue;
	}
 
	function login_wp($user){
		$this -> db -> where('savsoft_users.wp_user', $user);
		$this -> db -> where('savsoft_users.verify_code', '0');
		$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$this->db->limit(1);
		$query = $this -> db -> get('savsoft_users');	 
		if($query -> num_rows() == 1){
			return $query->row_array();
		}else{
			return false;
		}
	}
 
	function insert_group(){
 		$userdata=array(
			'group_name'=>$this->input->post('group_name'),
			'price'=>$this->input->post('price'),
			'valid_for_days'=>$this->input->post('valid_for_days'),
			'description'=>$this->input->post('description')
		);
		
		if($this->db->insert('savsoft_group',$userdata)){
			return true;
		}else{
			return false;
		}
	}
 
	function update_group($gid){
 		$userdata=array(
			'group_name'=>$this->input->post('group_name'),
			'price'=>$this->input->post('price'),
			'valid_for_days'=>$this->input->post('valid_for_days'),
			'description'=>$this->input->post('description')
		);
		$this->db->where('gid',$gid);
		if($this->db->update('savsoft_group',$userdata)){
			return true;
		}else{
			return false;
		}
	}
 
	function get_group($gid){
		$this->db->where('gid',$gid);
		$query=$this->db->get('savsoft_group');
		return $query->row_array();
	}
 
	function admin_login(){
		$this -> db -> where('uid', '1');
		$query = $this -> db -> get('savsoft_users');		 
		if($query -> num_rows() == 1){
			return $query->row_array();
		}else{
			return false;
		}
	}

	function num_users(){
		$query=$this->db->get('savsoft_users');
		return $query->num_rows();
	}
 
	function status_users($status){
		$this->db->where('user_status',$status);
		$query=$this->db->get('savsoft_users');
		return $query->num_rows();
	}
  
	function number_user($s,$su=''){
		$logged_in = $this->session->userdata('logged_in');
		$SELECT = "Select * from savsoft_users where 1=1";
		if($su != '' ){
			$su = "and su = $su";
		}
		if($s != ''){
			$search = "and (savsoft_users.email LIKE '%$s%' or savsoft_users.first_name LIKE '%$s%' or savsoft_users.last_name LIKE '%$s%')";
		}
		$sql =  $SELECT .' '. $su .' ' . $search;
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
 

	function users_list($page="0",$s='',$su=''){
		$logged_in=$this->session->userdata('logged_in');
		$SELECT = "
			Select * from savsoft_users
			inner join savsoft_group on savsoft_users.gid=savsoft_group.gid
			inner join account_type on savsoft_users.su=account_type.account_id
			where 1=1
			";
		if($logged_in['uid'] != '1'){
			$uid=$logged_in['uid'];
			$WHERE = "and savsoft_users.inserted_by = $uid";
		} 
		if($su!=''){
			$su = "and savsoft_users.su = $su";
		}
		if($s != ''){
			$search = "and (savsoft_users.email LIKE '%$s%' or savsoft_users.first_name LIKE '%$s%' or savsoft_users.last_name LIKE '%$s%' )";
		}
		
		$order_by= "order by savsoft_users.uid DESC 
			limit 20 
			offset ".(20*$page);
		$SQL = $SELECT.' '. $WHERE . ' ' . $su . ' ' . $search . ' ' . $order_by;
		$query = $this->db->query($SQL);
		$data= array();
		if($query !== FALSE && $query->num_rows() > 0 ){
			$data = $query->result_array();
		}
		return $data;
	}

	function school_user($ulist_id){
		$sql=  " SELECT u.school,s.school_name,s.schoolid FROM school s 
				INNER JOIN savsoft_users u 
				ON u.school=s.schoolid 
				WHERE u.uid= $ulist_id";
		
		$query = $this->db->query($sql);
		return $query->row_array();
	}
 
	function save_school($ulist_id,$id_school){
		$userdata = array('school' =>$id_school);
		$this->db->where('uid', $ulist_id);
		$this->db->update('savsoft_users',$userdata);
		redirect('user');
	}
 
	function users_list_inaction($page=0,$s='',$t=''){
		$logged_in=$this->session->userdata('logged_in');
		if($t=='1month'){
			$time =  date('Y-m-d H:i:s', strtotime('-1 month'));
		}elseif($t=='2month'){
			$time =  date('Y-m-d H:i:s', strtotime('-2 month'));
		}else{
			$time =  date('Y-m-d H:i:s', strtotime('-3 month'));
		}
		$SELECT = "
			SELECT u.email,u.first_name, u.registered_date, u.last_name, u.uid, u.user_status from savsoft_users u 
			where u.uid not in (SELECT DISTINCT uid from savsoft_answer_mcq where savsoft_answer_mcq.create_date >= '$time') 
			";
		if($s != ''){
			$search = "and (u.email LIKE '%$s%' or u.first_name LIKE '%$s%' or u.last_name LIKE '%$s%' )";
		}
		$order_by= "order by u.uid DESC 
			limit 20 
			offset ".(20*$page);
		$SQL = $SELECT .' '. $search .' '. $order_by;
		$query = $this->db->query($SQL);
		$data= array();
		if($query !== FALSE && $query->num_rows() > 0 ){
			$data = $query->result_array();
		}
		return $data;
 }
 
	function number_inaction($s='',$t=''){
		$logged_in=$this->session->userdata('logged_in');
		if($t=='1month'){
			$time =  date('Y-m-d H:i:s', strtotime('-1 month'));
		}elseif($t=='2month'){
			$time =  date('Y-m-d H:i:s', strtotime('-2 month'));
		}else{
			$time =  date('Y-m-d H:i:s', strtotime('-3 month'));
		}
		$SELECT = "
			SELECT u.uid from savsoft_users u 
			where u.uid not in (SELECT DISTINCT uid from savsoft_answer_mcq where savsoft_answer_mcq.create_date >= '$time' )
			";
		if($s != ''){
			$search = "and (u.email LIKE '%$s%' or u.first_name LIKE '%$s%' or u.last_name LIKE '%$s%' )";
		}
		$SQL = $SELECT .' '. $search;
		$query = $this->db->query($SQL);
		$data= array();
		if($query !== FALSE && $query->num_rows() > 0 ){
			$data = $query->result_array();
		}
		return $data;
	}
 
	function latest_record($data){
		$logged_in=$this->session->userdata('logged_in');
		for($i=0;$i<count($data);$i++){
			$SELECT = "
				SELECT uid, max(create_date) as latest from savsoft_answer_mcq where uid = 
				";
			$SELECT .= $data[$i]['uid'];
			$data[$i]['latest']= $this->db->query($SELECT)->row_array()['latest'];
		};
		return $data;
		//	$query = $this->db->query($SELECT);
		
	}

	function user_list($limit, $su=0){
		if($this->input->post('search')){
			$search=$this->input->post('search');
			$this->db->or_where('savsoft_users.uid',$search);
			$this->db->or_where('savsoft_users.email',$search);
			$this->db->or_where('savsoft_users.first_name',$search);
			$this->db->or_where('savsoft_users.last_name',$search);
			$this->db->or_where('savsoft_users.contact_no',$search);

		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['uid'] != '1'){
			$uid=$logged_in['uid'];
			$this->db->where('savsoft_users.inserted_by',$uid);
		} 
		if($su!=0){
			$this->db->where('su', $su);
		}
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('savsoft_users.uid','desc');
		$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$this -> db -> join('account_type', 'savsoft_users.su=account_type.account_id');
		$query=$this->db->get('savsoft_users');
		return $query->result_array();
	}
 
	function user_list_all(){
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['uid'] != '1'){
			$uid=$logged_in['uid'];
			$this->db->where('savsoft_users.inserted_by',$uid);
		} 
		$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$this -> db -> join('account_type', 'savsoft_users.su=account_type.account_id');
		$query=$this->db->get('savsoft_users');
		return $query->result_array();
	}
 
	function custom_fields_list(){
		$this->db->order_by('field_id','asc');
		$query=$this->db->get('savsoftquiz_custom_form');
		return $query->result_array();
	}

	function custom_form($dis){
		if($dis != 'All'){
			$this->db->where('display_at',$dis);
		}
		$this->db->order_by('field_id','asc');
		$query=$this->db->get('savsoftquiz_custom_form');
		return $query->result_array(); 
	}

	function custom_form_user($uid){
		$this->db->where('uid',$uid);
		$query=$this->db->get('savsoft_users_custom');
		$user=$query->result_array();
		$narr=array(); 
		foreach($user as $uk => $uval){
			$narr[$uval['field_id']]=$uval['field_values'];
		}
		return $narr;
	}
 
	function insert_custom(){
		$this->db->insert('savsoftquiz_custom_form',$_POST);
	}
 
	function update_custom($field_id){
		$this->db->where('field_id',$field_id);
		$this->db->update('savsoftquiz_custom_form',$_POST);
	}
 
	function get_custom($field_id){
		$this->db->where('field_id',$field_id);
		$query=$this->db->get('savsoftquiz_custom_form');
		return $query->row_array();
	}
 
	function remove_custom($field_id){
		$this->db->where('field_id',$field_id);
		$this->db->delete('savsoftquiz_custom_form');
	}
 
	function group_list(){
		$this->db->order_by('gid','asc');
		$query=$this->db->get('savsoft_group');
		return $query->result_array();
	}
 
	function verify_code($vcode){
		$this->db->where('verify_code',$vcode);
		$query=$this->db->get('savsoft_users');
		if($query->num_rows()=='1'){
			$user=$query->row_array();
			$uid=$user['uid'];
			$userdata=array(
				'verify_code'=>'0'
			);
			$this->db->where('uid',$uid);
			$this->db->update('savsoft_users',$userdata);
			return true;
		}else{
			return false;
		}
	}
 
 
	function insert_user(){
		$logged_in=$this->session->userdata('logged_in');
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
        $su= $this->input->post('su');		
		if($su==4){
			$point=10000;
		}
		else
			$point=0;
		if( $this->input->post('tinhthanh_id')!=0){
			$tinhthanh_id= $this->input->post('tinhthanh_id');
		}
		if( $this->input->post('quanhuyen_id')!=0){
			$quanhuyen_id= $this->input->post('quanhuyen_id');
		}
		if( $this->input->post('xaphuong_id')!=0){
			$xaphuong_id= $this->input->post('xaphuong_id');
		}
		$userdata=array(
			'email'=>$this->input->post('email'),
			'email2'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password')),
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'contact_no'=>$this->input->post('contact_no'),
			'tinhthanh_id'=> $tinhthanh_id,
			'quanhuyen_id'=>$quanhuyen_id,
			'xaphuong_id'=>$xaphuong_id,
			'gid'=>5,
			'subscription_expired'=>strtotime('2030-12-31'),
			'su'=>$su,
			'user_code'=> $user_code,
			'point'=>$point			
		);
		
		if($logged_in['uid'] != '1'){
			$userdata['inserted_by']=$logged_in['uid'];
		}
		if($this->db->insert('savsoft_users',$userdata)){
			$uid=$this->db->insert_id();
			if($logged_in['uid'] == '1'){
				$su=$this->input->post('su');
				$seq=$this->db->query("select * from account_type where account_id='$su' ");
				$seqr=$seq->row_array();
                $acp=explode(',',$seqr['users']);
				if(in_array('List_all',$acp)){
					$this->db->query(" update savsoft_users set inserted_by=uid where uid='$uid' ");
				}
			}
		 
		
			foreach($_POST['custom'] as $ck => $cv){
				if($cv != ''){
					$savsoft_users_custom=array(
						'field_id'=>$ck,
						'uid'=>$uid,
						'field_values'=>$cv	
					);
			
					$this->db->insert('savsoft_users_custom',$savsoft_users_custom);
				}
			}
			
			return true;
		}else{
			return false;
		}
	 
	}
 
	function insert_user_2(){
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
			'email'=>$this->input->post('email'),
			'email2'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password')),
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'contact_no'=>$this->input->post('contact_no'),
			'gid'=>$this->input->post('gid'),
			'su'=>'2',
			'point'=>0,
			'tinhthanh_id'=>$this->input->post('tinhthanh_id'),
			'quanhuyen_id'=>$this->input->post('quanhuyen_id'),
			'xaphuong_id'=>$this->input->post('xaphuong_id'),
			'user_code'=> $user_code,		
		);
		$veri_code=rand('1111','9999');
		if($this->config->item('verify_email')){
			$userdata['verify_code']=$veri_code;
		}
		if($this->session->userdata('logged_in_raw')){
			$userraw=$this->session->userdata('logged_in_raw');
			$userraw_uid=$userraw['uid'];
			$this->db->where('uid',$userraw_uid);
			$rresult=$this->db->update('savsoft_users',$userdata);
			if($this->session->userdata('logged_in_raw')){
				$this->session->unset_userdata('logged_in_raw');	
			}		
		}else{		
			$rresult=$this->db->insert('savsoft_users',$userdata);
			$uid=$this->db->insert_id();
			foreach($_POST['custom'] as $ck => $cv){
				if($cv != ''){
					$savsoft_users_custom=array(
						'field_id'=>$ck,
						'uid'=>$uid,
						'field_values'=>$cv	
					);
					$this->db->insert('savsoft_users_custom',$savsoft_users_custom);
				}
			}
				
		}
		if($rresult){
			if($this->config->item('verify_email')){
				 // send verification link in email		 
				$verilink=site_url('login/verify/'.$veri_code);
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
				$subject=$this->config->item('activation_subject');
				$message=$this->config->item('activation_message');;
				
				$message=str_replace('[verilink]',$verilink,$message);
			
				$toemail=$this->input->post('email');
				 
				$this->email->to($toemail);
				$this->email->from($fromemail, $fromname);
				$this->email->subject($subject);
				$this->email->message($message);
				if(!$this->email->send()){
					//print_r($this->email->print_debugger());
					//exit;
				}
			} 
			return true;
		}else{
			return false;
		}
	}
 
	function insert_user_3($su){
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
        
		$auth_token="";
		for ($i = 0; $i < 32; $i++) {
			$auth_token.= $characters[rand(0, $charactersLength - 1)];
		}
		
		if($su==4){
			$point=10000;
		}
		else
			$point=0;
		
		$userdata=array(
			'email'=>$this->input->post('email'),
			'email2'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password')),
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>'',
			//'contact_no'=>$this->input->post('contact_no'),
			'gid'=>5,
			'su'=>$su,
			'user_code'=>$user_code,
			'subscription_expired'=>strtotime('2030-12-31'),
			'auth_token'=>$auth_token,
			'point'=>$point,
			//'verify_code'=>1,
			//'tinhthanh_id'=>$this->input->post('tinhthanh_id'),
			//'quanhuyen_id'=>$this->input->post('quanhuyen_id'),
			//'xaphuong_id'=>$this->input->post('xaphuong_id')		
		);
		
		//$veri_code=rand('1111','9999');
		// if($this->config->item('verify_email')){
		//	$userdata['verify_code']=$veri_code;
		// }
		if($this->session->userdata('logged_in_raw')){
			$userraw=$this->session->userdata('logged_in_raw');
			$userraw_uid=$userraw['uid'];
			$this->db->where('uid',$userraw_uid);
			$rresult=$this->db->update('savsoft_users',$userdata);
			if($this->session->userdata('logged_in_raw')){
				$this->session->unset_userdata('logged_in_raw');	
			}		
		}else{
			/*$this->load->library('email');

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
			$subject=$this->config->item('activation_subject');
			$message=$this->config->item('activation_message');;
			
			//$message=str_replace('[verilink]',$verilink,$message);
			$message ="Thank you for registering with us";
			$toemail=$this->input->post('email');
			 
			$this->email->to($toemail);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			if(!$this->email->send()){
				exit;
				print_r($this->email->print_debugger());
			   return false;
			   
			}
			else{*/
			$rresult=$this->db->insert('savsoft_users',$userdata);
			$uid=$this->db->insert_id();
			return true;
			//}
					
					
			/*foreach($_POST['custom'] as $ck => $cv){
				if($cv != ''){
			$savsoft_users_custom=array(
			'field_id'=>$ck,
			'uid'=>$uid,
			'field_values'=>$cv	
			);
			$this->db->insert('savsoft_users_custom',$savsoft_users_custom);
				}
			}*/				
		}
		// if($this->config->item('verify_email')){
			 // send verification link in email	 
			 //$verilink=site_url('login/verify/'.$veri_code);		  
		// }		
		//return false; 
	}
 
	function insert_user_4($parent_id){
		$password= $this->input->post('password');
		$passwordcfm= $this->input->post('passwordcfm');
		if($password!=$passwordcfm){
		   // $this->session->set_flashdata('message','<div class="alert alert-danger">Mật khẩu xác nhận không trùng khớp!!!!!</div>' ); 
		}
		else{
		   $user =$this->session->userdata('logged_in');	 
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
			$email= $this->input->post('email');
			$this->db->where('email', $email);
			$n = $this->db->get('savsoft_users')->num_rows();
			if($n==0){
				$userdata=array(
					'email'=>$email,
					'email2'=>$email,
					'password'=>md5($this->input->post('password')),
					'first_name'=>$this->input->post('first_name'),
					'last_name'=>'',
					//'contact_no'=>$this->input->post('contact_no'),
					'gid'=>5,
					'su'=>2,
					'point'=>0,
					'parent_id'=>$parent_id,
					'user_code'=>$user_code,
					'subscription_expired'=>strtotime('2030-12-31'),
					//'tinhthanh_id'=>$this->input->post('tinhthanh_id'),
					//'quanhuyen_id'=>$this->input->post('quanhuyen_id'),
					//'xaphuong_id'=>$this->input->post('xaphuong_id')		
				);
				
				$rresult=$this->db->insert('savsoft_users',$userdata);
				$this->session->set_flashdata('message','<div class="alert alert-success">Tạo tài khoản thành công</div>' ); 
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
				$subject="Tạo tài khoản cho con";
                $pwds=$this->input->post('password');
				$pwd='';
				for($i=0; $i<strlen($pwds)-2; $i++){
					 $pwd.='*';
				 }
			    $pwd .= substr($pwds,-2);		 
				$message ="<p>Chào bạn ".$user['first_name']."!</p>";
				$message.= '<p>Bạn đã tạo thành công tài khoản cho '.$this->input->post('first_name').' với tên đăng nhập '.$email.'</p>';
                $message.= '<p>Mật khẩu là '.$pwd .'</p>';

				$message.= '<p>Trân trọng,</p>';
				$message.='Gửi bởi '.'<a href="https://stemup.app">stemup.app</a>';
				$this->email->to($user['email']);
				$this->email->from($fromemail, $fromname);
				$this->email->subject($subject);
				$this->email->message($message);
				if(!$this->email->send()){
				
				}
				 return true;
			}		
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger">Email đã tồn tại</div>' );
				 return false; 
			}
	    }   
	}
 
	function insert_user_5($parent_id,$password, $name,$email){
		$this->db->where('uid', $parent_id);
		$this->db->where('su', 4);	   
		$user =$this->db->get('savsoft_users')->row_array();
		if($user){
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
			$this->db->where('email', $email);
		    $n = $this->db->get('savsoft_users')->num_rows();
			if($n==0){
				$userdata=array(
					'email'=>$email,
					'password'=>md5($password),
					'first_name'=>$name,
					'last_name'=>'',
					//'contact_no'=>$this->input->post('contact_no'),
					'gid'=>5,
					'su'=>2,
					'point'=>0,
					'parent_id'=>$parent_id,
					'user_code'=>$user_code,
					'subscription_expired'=>strtotime('2030-12-31'),
					//'tinhthanh_id'=>$this->input->post('tinhthanh_id'),
					//'quanhuyen_id'=>$this->input->post('quanhuyen_id'),
					//'xaphuong_id'=>$this->input->post('xaphuong_id')		
				);
			
				if($this->db->insert('savsoft_users',$userdata)){
					$result= array("message"=>"success");
				}
				else{
					$result= array("message"=>"fail");
				}
			}
	        else{
				$result= array("message"=>"duplicate");
			}
	    }
		else{
			$result= array("message"=>"notexist");
		}
	    return $result;   
	}
	
	
	function insert_user_6($parent_id,$password, $name,$email, $grade){
		
		log_message('error','test1');
		$this->db->where('uid', $parent_id);
		$this->db->where('su', 4);	   
		$user =$this->db->get('savsoft_users')->row_array();
		if($user){

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
				
				if($n==0){
					$check=false;
					
				}
			}	
			$this->db->where('email', $email);
		    $n = $this->db->get('savsoft_users')->num_rows();
		    log_message('error','test2');
			if($n==0){
				log_message('error','test2a');
				$this->db->where('lid',$grade);
				$assign_categories = $this->db->get('level_category')->row_array()['available_cids'];
				$userdata=array(
					'email'=>$email,
					'password'=>md5($password),
					'first_name'=>$name,
					'last_name'=>'',
					'gid'=>5,
					'su'=>2,
					'point'=>0,
					'parent_id'=>$parent_id,
					'user_code'=>$user_code,
					'grade'=>$grade,
					'assign_categories'=>$assign_categories,
					'subscription_expired'=>strtotime('2030-12-31'),
					//'tinhthanh_id'=>$this->input->post('tinhthanh_id'),
					//'quanhuyen_id'=>$this->input->post('quanhuyen_id'),
					//'xaphuong_id'=>$this->input->post('xaphuong_id')		
				);
			
				if($this->db->insert('savsoft_users',$userdata)){
					$childid= $this->db->insert_id();
					$result= array("message"=>"success", "childid"=>$childid);
					log_message('error','test3');
				}
				else{
					$result= array("message"=>"fail");
					log_message('error','test4');
				}
			}
	        else{
				$result= array("message"=>"duplicate");
			}
	    }
		else{
			$result= array("message"=>"notexist");
		}
	    return $result;  
	    log_message('error','test5'); 
	}
 
	function reset_password($toemail){
		$this->db->where("email",$toemail);
		$queryr=$this->db->get('savsoft_users');
		if($queryr->num_rows() != "1"){
			return false;
		}
		$new_password=rand('1111','9999');
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
		$subject=$this->config->item('password_subject');
		$message=$this->config->item('password_message');;
		$message=str_replace('[new_password]',$new_password,$message);
		$this->email->to($toemail);
		$this->email->from($fromemail, $fromname);
		$this->email->subject($subject);
		$this->email->message($message);
		if(!$this->email->send()){
			 //print_r($this->email->print_debugger());
		}else{
			$user_detail=array(
				'password'=>md5($new_password)
			);
			$this->db->where('email', $toemail);
			$this->db->update('savsoft_users',$user_detail);
			return true;
		}

	}

	function update_user($uid){
		$logged_in=$this->session->userdata('logged_in');	
		$userdata=array(
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'skype_id'=>$this->input->post('skype_id'),
			'contact_no'=>$this->input->post('contact_no'),
			'tinhthanh_id'=>$this->input->post('tinhthanh_id'),
			'quanhuyen_id'=>$this->input->post('quanhuyen_id'),
			'xaphuong_id'=>$this->input->post('xaphuong_id')	
		);
		if($logged_in['su']=='1'){
			$userdata['email']=$this->input->post('email');
			$userdata['gid']=$this->input->post('gid');
			if($this->input->post('subscription_expired') !='0'){
				$userdata['subscription_expired']=strtotime($this->input->post('subscription_expired'));
			}else{
				$userdata['subscription_expired']='0';	
			}
			$userdata['su']=$this->input->post('su');
		}
			
		if($this->input->post('password')!=""){
			$userdata['password']=md5($this->input->post('password'));
		}
		if($this->input->post('user_status')){
			$userdata['user_status']=$this->input->post('user_status');
		}
		$this->db->where('uid',$uid);
		if($this->db->update('savsoft_users',$userdata)){
			$this->db->where('uid',$uid);
			$this->db->delete('savsoft_users_custom');	
			foreach($_POST['custom'] as $ck => $cv){
				if($cv != ''){
					$savsoft_users_custom=array(
						'field_id'=>$ck,
						'uid'=>$uid,
						'field_values'=>$cv	
					);
					$this->db->insert('savsoft_users_custom',$savsoft_users_custom);
				}
			}
			return true;
		}else{
			return false;
		}
	 
	}
 
	function pending_custom($uid){
		$this->db->where('display_at','Result');
        $querys=$this->db->get('savsoftquiz_custom_form');	
		$this->db->where('savsoftquiz_custom_form.display_at','Result');
        $this->db->where('savsoft_users_custom.uid',$uid);
        $this->db->join('savsoftquiz_custom_form','savsoftquiz_custom_form.field_id=savsoft_users_custom.field_id');
        $query=$this->db->get('savsoft_users_custom');	
		return ($querys->num_rows() - $query->num_rows());			
	}

	function update_groups($gid){
		$userdata=array();
		if($this->input->post('group_name')){
			$userdata['group_name']=$this->input->post('group_name');
		}
		if($this->input->post('price')){
			$userdata['price']=$this->input->post('price');
		}
		if($this->input->post('valid_day')){
			$userdata['valid_for_days']=$this->input->post('valid_day');
		}
		if($this->input->post('valid_day')){
			$userdata['description']=$this->input->post('description');
		}
		$this->db->where('gid',$gid);
		if($this->db->update('savsoft_group',$userdata)){	
			return true;
		}else{
			return false;
		}
	 
	}
 
	function remove_user($uid){
		$this->db->where('uid',$uid);
		if($this->db->delete('savsoft_users')){
			return true;
		}else{
			return false;
		}
	}
 
	function remove_group($gid){
		$this->db->where('gid',$gid);
		if($this->db->delete('savsoft_group')){
			return true;
		}else{ 
			return false;
		} 
	}
 
	function get_user($uid){
		$this->db->where('savsoft_users.uid',$uid);
		$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$query=$this->db->get('savsoft_users');
		return $query->row_array();
	}
 
	function insert_groups(){ 
	 	$userdata=array(
			'group_name'=>$this->input->post('group_name'),
			'price'=>$this->input->post('price'),
			'valid_for_days'=>$this->input->post('valid_for_days'),
			'description'=>$this->input->post('description'),
		);
		
		if($this->db->insert('savsoft_group',$userdata)){	
			return true;
		}else{	
			return false;
		}
	}
 
	function get_expiry($gid){
	 
		$this->db->where('gid',$gid);
		$query=$this->db->get('savsoft_group');
		$gr=$query->row_array();
		if($gr['valid_for_days']!='0'){
			$nod=$gr['valid_for_days'];
			return date('Y-m-d',(time()+($nod*24*60*60)));
		}else{
			return date('Y-m-d',(time()+(10*365*24*60*60))); 
		}
	}
 
	function get_school($uid){
		$this->db->where('uid',$uid);
		$user=$this->db->get('savsoft_users')->result_array()[0];
		if($user['su']==1){
			return "abc";
		}
	}
  
	function get_user_points($uid){
		$this->db->where('uid',$uid);
		$query=$this->db->get('savsoft_users')->result_array();
		$point = $query[0]['point'];
		return $point;
	}
  
	function get_child_list(){
		$user=$this->session->userdata('logged_in');	 
		$sql = "SELECT uid, parent_id FROM savsoft_users where su=2";
	
		$stds= $this->db->query($sql)->result_array();
		$child_ids='';
		foreach($stds as $std){
			$parent_ids= explode(',', $std['parent_id']);
			if(in_array($user['uid'], $parent_ids)){
				if($child_ids!='')
					$child_ids.=','.$std['uid'];
				else
					$child_ids.=$std['uid'];
			}
		} 
		if($child_ids!=''){
			$sql2 = "SELECT * FROM savsoft_users where  uid in ($child_ids)";
			return $this->db->query($sql2)->result_array();
		}
		else return array();
	}
	
	function add_child(){
		$user=$this->session->userdata('logged_in');	 
		$code = $this->input->post('student_code');
		$this->db->where('su',2);
		$this->db->where('user_code',$code);
		$child = $this->db->get('savsoft_users')->result_array();
		if($child){
			$parent_ids= explode(',', $child[0]['parent_id']);
			if(!in_array($user['uid'], $parent_ids)){
				if($child[0]['parent_id']!=''){
					$new_parent_id=$child[0]['parent_id'].','.$user['uid'];
				}
				else{
					$new_parent_id=$user['uid'];
				}
				$this->db->where('su',2);
			    $this->db->where('user_code',$code);
			    $this->db->update('savsoft_users',array('parent_id'=>$new_parent_id));
				$this->session->set_flashdata('message','<div class="alert alert-success">Thêm thành công</div>' ); 
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger">Học sinh này đã có trong danh sách các con của bạn</div>' ); 
			}
			
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger">Mã học sinh không tồn tại</div>' ); 
		}

	}
	
	function add_child_1(){
		 $user=$this->session->userdata('logged_in');
		 $data = json_decode($this->input->raw_input_stream,true);		 
		 $code = $data['student_code'];
		 $this->db->where('su',2);
		 $this->db->where('user_code',$code);
		 $child = $this->db->get('savsoft_users')->result_array();
		 if($child){
			 $parent_ids= explode(',', $child[0]['parent_id']);
			 if(!in_array($user['uid'], $parent_ids)){
				if($child[0]['parent_id']!=''){
					$new_parent_id=$child[0]['parent_id'].','.$user['uid'];
				}
				else{
					$new_parent_id=$user['uid'];
				}
				$this->db->where('su',2);
			    $this->db->where('user_code',$code);
			    $this->db->update('savsoft_users',array('parent_id'=>$new_parent_id));
				$result=array("status"=>1, "message"=>"Thêm thành công");
				
			}
			else{
				$result=array("status"=>0, "message"=>"Học sinh này đã có trong danh sách các con của bạn");
			}
			
		 }
		 else{
			 $result=array("status"=>0, "message"=>"Mã học sinh không tồn tại");
		 }
		 return $result;
	}
	
	function changepassword(){
		$us = $this->session->userdata('logged_in'); 
        if(!$us){
        	redirect('home');
        }
		else{
			$this->db->where('uid',$us['uid']);
			$user=$this->db->get('savsoft_users')->result_array()[0];
			$old_pwd= $this->input->post('old_pwd');
			$new_pwd= $this->input->post('new_pwd');
			$confirm_pwd= $this->input->post('confirm_pwd');
			
			//check old_pwd
			if(md5($old_pwd) !=$user['password'])
				//$this->session->set_flashdata('wrong_password','<div class="alert alert-danger">Mật khẩu hiện tại không đúng</div>');
				$mes=0;

			else
				if($new_pwd==''){
					//$this->session->set_flashdata('matkhaudetrong','<div class="alert alert-danger">Mật khẩu mới không được để trống</div>');
					$mes=1;
				}
				else{	
					//check confirm_pwd	
					if($new_pwd!=$confirm_pwd){
						// $this->session->set_flashdata('matkhaumoi','<div class="alert alert-danger">Mật khẩu mới không trùng khớp với mật khẩu xác nhận</div>');
						$mes=2;
					}else{
						$this->db->where('uid',$us['uid']);
						
						$this->db->update('savsoft_users',array('password'=> md5($new_pwd)));
						//send password to stem.vn
						$this->load->library('Curl');

						$url = 'http://stem.vn/api/stem/changepassword';

						//The JSON data.
						$jsonData =array("jsonrpc"=>"2.0", "params"=>array(
							'login' => $us['email'],
							'key'=>'xqTQzzqrXvjfz2lyxa7goz2nVoXwlj3aYo3fKU08LYGNqQQLlT2xdw5588wKqm7oduC32xsoOGLMFUIAwrH6WwzoXVq_zen0T_JXFcC8kqGinvNCUY2fuzrVJwGcuSXtcvvSd6IeuF0KSyDNIVLO_y0kmwd1AqFxnOpa7aZwzfKQ',
							'new_pwd' => $new_pwd,
						));

						//Encode the array into JSON.
						$jsonDataEncoded = json_encode($jsonData);
						//echo $jsonDataEncoded;
						// Start session (also wipes existing/previous sessions)
						$this->curl->create($url);

						// Option			
						$this->curl->option(CURLOPT_HTTPHEADER, array('Content-type: application/json; Charset=UTF-8'));

						// Post - If you do not use post, it will just run a GET request			
						$this->curl->post($jsonDataEncoded);
								
						// Execute - returns responce 
						$result = $this->curl->execute();	
						
						$this->session->set_flashdata('change_sucsess','<div class="alert alert-success">Thay đổi thành công.</div>');
						$mes=3;
					}
				}
				
			return $mes;	
			//redirect('home_user');
		}
	}

	function resetpassword(){
		$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
		$site_key    = '6Lcy5OIUAAAAAB3Ezg67fsCivAFP5XgFIU5Lz4Gv'; //local
		$secret_key  = '6Lcy5OIUAAAAAOb4H1rwlLv1UOqYwj-CYnS26Sd1'; //local

		// $site_key    = '6LfzlKMUAAAAAMv6fJ1q3p57pOxeKpSRRw8cHyxt';
		// $secret_key  = '6LfzlKMUAAAAAGZpagsm2lXPHGCmU6uMAb3KA8yq';
		  
		//kiem tra submit form
			
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
			 
			//tạo link kết nối
			$api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
			//lấy kết quả trả về từ google
			$response = file_get_contents($api_url);
			//dữ liệu trả về dạng json
			$response = json_decode($response);
			if(isset($response->success) && $response->success === false)
			{
				$this->session->set_flashdata('message_r','Captcha không đúng' );
				redirect('home');
			}
			if($response->success == true)
			{
				$email =$this->input->post('emailresetpwd');
				$this->db->where('email',$email);
				$us =$this->db->get('savsoft_users');
				if($us->num_rows()>0){	
					$user = $us->result_array()[0];
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
					
					//$message=str_replace('[verilink]',$verilink,$message);
					$message ="<p>Chào bạn ".$name."!</p>";
					$message.= '<p>Bạn đã yêu cầu thay đổi mật khẩu liên kết với email này!</p></p> Bạn có thể thực hiện thay đổi mật khẩu qua liên kết này</p>';
					$message.= '<p><a href="https://stemup.app/index.php/home/resetpassword2/'.$token.'" type="button"> Tạo mật khẩu mới</a></p>';
					$message.= '<p>Nếu không muốn đổi mật khẩu bạn chỉ cần bỏ qua email này.</p>';
					$message.= '<p>Trân trọng,</p>';
					$message.='Gửi bởi '.'<a href="http://stemup.app">stemup.app</a>';
					$this->email->to($email);
					$this->email->from($fromemail, $fromname);
					$this->email->subject($subject);
					$this->email->message($message);
					if(!$this->email->send()){
					   print_r($this->email->print_debugger());
					//exit;
					   $this->session->set_flashdata('message_r','Vui lòng kiểm tra lại email của bạn!' );
					}
					else{
						$this->session->set_flashdata('message_r','Hệ thống đã gửi thông tin tài khoản tới email của bạn! Vui lòng kiểm tra email!' );
					}
					redirect('home');
				}
				else{
					$this->session->set_flashdata('message_r','Tài khoản của bạn chưa có trên hệ thống!' );
					redirect('home');
				}
			}else{
				$this->session->set_flashdata('message_r','Captcha không đúng' );
				redirect('home');
			}
		
		
	}
	
	function resetpassword2($token){
		$this->db->where('resetpwd_token', $token);
	    $us =$this->db->get('savsoft_users');
		if($us)
			return $us->row_array();
		else return false;
	}

	function resetpassword3($token){
		$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
		//localhost
		// $site_key    = '6Lcy5OIUAAAAAB3Ezg67fsCivAFP5XgFIU5Lz4Gv';
		// $secret_key  = '6Lcy5OIUAAAAAOb4H1rwlLv1UOqYwj-CYnS26Sd1';

		//stemup.app
		$site_key    = '6Lf4_68UAAAAALrsWEN5BywbvhzEzI7uaAPqjOfM';
		$secret_key  = '6Lf4_68UAAAAANX7H07c8QDcGsmA7Pe2PYDxbDyv';

		//lấy dữ liệu được post lên
		$site_key_post    = $_POST['g-recaptcha-response'];
		  
		//lấy IP của khach
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$remoteip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$remoteip = $_SERVER['REMOTE_ADDR'];
		}
		 
		//tạo link kết nối
		$api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
		//lấy kết quả trả về từ google
		$response = file_get_contents($api_url);
		//dữ liệu trả về dạng json
		$response = json_decode($response);
		if(!isset($response->success)){
			$this->session->set_flashdata('message_r','Captcha không đúng' );
		    redirect('home/resetpassword2/'.$token);
		}
		if($response->success == true){
			$rpwd = $this->input->post('rpwd');
			$crpwd = $this->input->post('crpwd');
		if($rpwd!=$crpwd){
			$this->session->set_flashdata('message_r','Xác nhận mật khẩu không trùng khớp' );
			redirect('home/resetpassword2/'.$token);
		}
		else{
			$this->db->where('resetpwd_token', $token);
			$this->db->update('savsoft_users', array('password'=>md5($rpwd)));	

			$this->db->where('resetpwd_token', $token);
			$us = $this->db->get('savsoft_users')->row_array();	

		
			
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
			 $pwd_length= strlen($rpwd);
			 $pwdinem='';
			 for($i=0; $i<$pwd_length-2; $i++){
				 $pwdinem.='*';
			 }
			 $pwdinem .= substr($rpwd,-2);
			$fromemail=$this->config->item('fromemail');
			$fromname=$this->config->item('fromname');
			$subject='Đổi mật khẩu';
			$message=$this->config->item('activation_message');;
			
			//$message=str_replace('[verilink]',$verilink,$message);
			$message ="<p>Chào bạn ".$us['first_name'].' '. $us['last_name']."!</p>";
			$message.= '<p>Hệ thống đã cập nhật mật khẩu tài khoản cho bạn!</p>';
			$message.= '<p>Mật khẩu mới là '.$pwdinem .'</p>';
			$message.= '<p>Trân trọng,</p>';
			$message.='Gửi bởi '.'<a href="http://stemup.app">stemup.app</a>';
			$this->email->to($us['email']);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
			
			redirect('home/resetpassword2/'.$token."/success");
			
		}
		}else{
			$this->session->set_flashdata('message_r','Captcha không đúng' );
		    redirect('home/resetpassword2/'.$token);
		}

	}

	function insert_excel($prid, $dtid, $waid, $su, $gid){

		include 'Classes/PHPExcel/IOFactory.php';
		$inputFileName = 'upload/excel/temp.xlsx';
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {

			 redirect('user/import_user');
		}

		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
    
		for ($row = 0; $row <= $highestRow; $row++){ 

		    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
		}
		$sql_school = "Select * from savsoft_dataitem where group_id=2 and dataitem_level=1 and parent_id=? and dataitem_name=?";
        $sql_class = "Select * from savsoft_dataitem where group_id=2 and dataitem_level=2 and parent_id=? and dataitem_name=?";
        
		
        //Xu ly sheet giao vien
        if($su==3){
            $arr_file_result=array();
        	//lay thong tin cua truong 
            $school_name= trim(explode(':',$rowData[1][0][0])[1]);
            $school_address= trim(explode(':',$rowData[2][0][0])[1]);
            $school_phone = trim(explode(':',$rowData[3][0][0])[1]);
                     
			$school = $this->db->query($sql_school, array($waid, $school_name))->result_array();
		    if($school){
		     	$school_id= $school[0]['did'];
		 	}
			else{
			    $sch_description="Địa chỉ: ".$school_address.' - Điện thoại: '.$school_phone;		
			    $school_array= array('group_id'=>2,
			    	                'dataitem_name'=> $school_name,
			    	                'dataitem_level'=>1,				
		                            'parent_id'=>$waid,	
		                            'description'=>	$sch_description				
							);
			   $this->db->insert('savsoft_dataitem', $school_array);
			   $school_id= $this->db->insert_id();
			}

            // lay thong tin giao vien/

			$attribute = $rowData[6][0];
			$length_att=count($rowData[6][0]);
			for ($col = 0; $col < $length_att; $col++){ 
				if($attribute[$col]=='Email') {
					$key_email =$col;

				}
				if($attribute[$col]=='Họ và tên'){
					$key_name=$col;
				}
	            if($attribute[$col]=='Số điện thoại'){
					$key_phone=$col;
				}
				if($attribute[$col]=='Bộ môn dạy'){
					$key_subject=$col;
				}
				if($attribute[$col]=='Chủ nhiệm lớp'){
					$key_class_hr=$col;
				}
				if($attribute[$col]=='Lớp đang dạy'){
					$key_class_tc=$col;
				}
				if($attribute[$col]=='Ghi chú'){
					$key_note=$col;
				}



			}

		    //$esrow='';
		    //$efrow='';
		    //$partten = "/^[A-Za-z0-9_\.]{6,32}@([a-zA-Z0-9]{2,12})(\.[a-zA-Z]{2,12})+$/";
			$array_data=array();
		    for ($row = 7; $row <= $highestRow; $row++){ 
		    	$email =$rowData[$row][0][$key_email];
		    	$name = $rowData[$row][0][$key_name];
		    	$teacher_phone= $rowData[$row][0][$key_phone];
		    	$note = $rowData[$row][0][$key_note];
				$home_rooms_ids='';
		        if($email){

			    	$this->db->where('email',$email);

			    	$us =$this->db->get("savsoft_users")->row_array();


                       // them lien ket toi mon day , lop chu nhiem , lop day
                      

                       //chu nhiem lop
                       $home_rooms_ids='';
					   $class_arr= array();
                       $home_rooms = explode(',', $rowData[$row][0][$key_class_hr]);
					   if($rowData[$row][0][$key_class_hr])
                       foreach ($home_rooms as $k=>$home_room) {
                       		if($home_room){
								$class = $this->db->query($sql_class, array($school_id, trim($home_room)) )->row_array();
								if($class){
								  $class_id= $class['did'];
								  
								}
								else{
								  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
								   $charactersLength = strlen($characters);
								   $check=true;
									while($check){
										 $class_code = '';
										 for ($i = 0; $i < 6; $i++) {
											 $class_code.= $characters[rand(0, $charactersLength - 1)];
										 }
										  
										$this->db->where('dataitem_code', $class_code);
										 $n = $this->db->get('savsoft_dataitem')->num_rows();
										if($n==0)
										$check=false;
									 }	
									 
								  // tao lop
								  $class_array= array('group_id'=>2,
													   'dataitem_name'=> trim($home_room),
													   'dataitem_level'=>2,				
													   'parent_id'=>$school_id,	
													   'dataitem_code'=>$class_code		
												);
								  $this->db->insert('savsoft_dataitem', $class_array);
								  $class_id= $this->db->insert_id();
								  $class_grade="";
								  $fc=substr(trim($home_room), 0,1);
								  if($fc=='1'){
									  $sc=substr(trim($home_room), 1,1);
									  if($sc==0||$sc==1||$sc==2){
										  $class_grade=intval($fc.$sc)+2;
									  }
									  else $class_grade=intval($fc)+2;
								  }
								  else if(in_array($fc, array("2","3","4","5","6","7","8","9"))){
									  $class_grade=intval($fc)+2;
								  }
								  else{
									  $class_grade="3,4,5,6,7,8,9,10,11,12,13,14";
								  }
								  $class_metadata=array("class_id"=>$class_id,
														"grade"=>$class_grade,
														"category"=>"3,4,5,6,7,8,9,10,11,12",
														"create_by"=>"0"
														);
								  $this->db->insert("class_metadata",$class_metadata);
								 
								}
								
								if($k!=0) {
								   $home_rooms_ids.=',';
							   }
							    array_push($class_arr,$class_id);
							}   $home_rooms_ids.=$class_id;
                       	}
                       	
                       	//lop day
						$class_teaches_ids='';
                       	$class_teaches = explode(',', $rowData[$row][0][$key_class_tc]);
                       foreach ($class_teaches as $k=>$class_teach) {
						   if($class_teach){
								$class = $this->db->query($sql_class, array($school_id, trim($class_teach)) )->row_array();
								if($class){
								  $class_id= $class['did'];
								}
								else{

									$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
								   $charactersLength = strlen($characters);
								   $check=true;
									while($check){
										 $class_code = '';
										 for ($i = 0; $i < 6; $i++) {
											 $class_code.= $characters[rand(0, $charactersLength - 1)];
										 }
										$this->db->where('dataitem_code', $class_code);
										 $n = $this->db->get('savsoft_dataitem')->num_rows();
										if($n==0)
										$check=false;
									 }	
								  $class_array= array('group_id'=>2,
													   'dataitem_name'=> trim($class_teach),
													   'dataitem_level'=>2,				
													   'parent_id'=>$school_id,	
													   'dataitem_code'=>$class_code						
												);
								  $this->db->insert('savsoft_dataitem', $class_array);
								  $class_id= $this->db->insert_id();
								  $class_grade="";
								  $fc=substr(trim($class_teach), 0,1);
								  if($fc=='1'){
									  $sc=substr(trim($class_teach), 1,1);
									  if($sc==0||$sc==1||$sc==2){
										  $class_grade=intval($fc.$sc)+2;
									  }
									  else $class_grade=intval($fc)+2;
								  }
								  else if(in_array($fc, array("2","3","4","5","6","7","8","9"))){
									  $class_grade=intval($fc)+2;
								  }
								  else{
									  $class_grade="3,4,5,6,7,8,9,10,11,12,13,14";
								  }
								  $class_metadata=array("class_id"=>$class_id,
														"grade"=>$class_grade,
														"category"=>"3,4,5,6,7,8,9,10,11,12",
														"create_by"=>"0"
														);
								  $this->db->insert("class_metadata",$class_metadata);
								  $class = $this->db->query($sql_class, array($school_id, trim($class_teach)) )->result_array();
								  
								}
							   
								 if($k!=0) {
								   $class_teaches_ids.=',';
							   }
							   array_push($class_arr,$class_id);
							   $class_teaches_ids.=$class_id;
						   }
						   
						    //mon day
						   $subject_ids='';
						   $subjects= explode(',', $rowData[$row][0][$key_subject]);
						   foreach ($subjects as $k=>$subject) {
							   if($subject=="Ngữ văn"){
								   $cid=17;
							   }
							   else{
									$this->db->where('category_name', trim($subject));
									$cid=$this->db->get('savsoft_category')->row_array()['cid'];
							   }
							   if($k!=0) {
								   $subject_ids.=',';
							   }
							   $subject_ids.=$cid;
							   $check=true;
								while($check){
									 $sub_class_code = '';
									 for ($i = 0; $i < 6; $i++) {
										 $sub_class_code.= $characters[rand(0, $charactersLength - 1)];
									 }
									$this->db->where('dataitem_code', $sub_class_code);
									 $n = $this->db->get('savsoft_dataitem')->num_rows();
									if($n==0)
									$check=false;
								 }	
							   $sub_class_array= array('group_id'=>2,
													   'dataitem_name'=> trim($subject) ,
													   'dataitem_level'=>3,				
													   'parent_id'=>$class_id,	
													   'dataitem_code'=>$sub_class_code						
												);
								$this->db->insert('savsoft_dataitem', $sub_class_array);
								$sub_class_id= $this->db->insert_id();
								
								$class_metadata=array("class_id"=>$sub_class_id,
										"grade"=>$class_grade,
										"category"=>$cid,
									     "create_by"=>"0"
								);
						       $this->db->insert("class_metadata",$class_metadata);
								array_push($class_arr,$sub_class_id);
							   $class_teaches_ids.=','.$sub_class_id;
						   }
						   
                       	}
					if(!$us){
					   	//tao teacher moi
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
                       $ins_arr= array(
			    				'email'=> $email,
								'email2'=> $email,
			    				'password'=>md5('12345'),
			    				'first_name'=>$name,
			    				'last_name'=>'',
			    				'contact_no'=>$teacher_phone,
			    				'gid'=>$gid,
			    				'su'=>$su,
			    				'registered_date'=>date('Y-m-d H:i:s'),
			    				'subscription_expired'=>strtotime('2030-12-31'),
			    				'tinhthanh_id'=>$prid,
								'quanhuyen_id'=>$dtid,
								'xaphuong_id'=>$waid,
								'school_id'=>$school_id,
								'class_id'=>$class_teaches_ids,	
								'homeroom_class_id'=>$home_rooms_ids,
								'category_id'=>$subject_ids,
								'note'=>$note,
                                'user_code'=>$user_code
			    			);

			    		$this->db->insert('savsoft_users', $ins_arr);
                        $user_id= $this->db->insert_id();
						for($i=0; $i<count($class_arr); $i++){
							$this->db->where("member_id",$user_id);
							$this->db->where("class_id",$class_arr[$i]);
							$cm= $this->db->get("class_member")->row_array();
							if(!$cm){
								$this->db->insert("class_member", array("member_id"=>$user_id,"class_id"=>$class_arr[$i]));
							}
							/*$this->db->where("class_id",$class_arr[$i]);
							$clmd= $this->db->get("class_metadata")->row_array();
							if($clmd['create_by']==0){
								$this->db->where("class_id",$class_arr[$i]);
							    $this->db->update("class_metadata", array("create_by"=>$user_id));
							}*/
							
						}
						array_push($array_data,array("name"=>$name,          
												     "email"=>$email,
													 "phone"=>$teacher_phone,
													 "category"=>$rowData[$row][0][$key_subject],
													 "home_room"=>$rowData[$row][0][$key_class_hr],
													 "class_teach"=>$rowData[$row][0][$key_class_tc],
													 "note"=>$note,
													 "login"=>$email,
													 "password"=>"12345"
																	));
			    	}
			    	else{
						for($i=0; $i<count($class_arr); $i++){
							$this->db->where("member_id",$us['uid']);
							$this->db->where("class_id",$class_arr[$i]);
							$cm= $this->db->get("class_member")->row_array();
							if(!$cm){
								$this->db->insert("class_member", array("member_id"=>$user_id,"class_id"=>$class_arr[$i]));
							}
						}
						
						//update info 
						$old_class=$us['class_id'];
						$arr_old_class = explode(",",$old_class);
						$arr_new_class = explode(",",$class_teaches_ids);
						foreach($arr_new_class as $clid){
							if(!in_array($clid, $arr_old_class)){
								if($old_class !=""){
									$old_class.=",";
								}
								$old_class.=$clid;
							}
						}
						$upd= array('homeroom_class_id'=>$home_rooms_ids, 
						            'class_id'=>$old_class,
									'category_id'=>$subject_ids,
									'contact_no'=>$teacher_phone);
						$this->db->where('uid', $us['uid']);
						$this->db->update('savsoft_users', $upd);
						
			    		array_push($array_data,array("name"=>$name,          
												     "email"=>$email,
													 "phone"=>$teacher_phone,
													 "category"=>$rowData[$row][0][$key_subject],
													 "home_room"=>$rowData[$row][0][$key_class_hr],
													 "class_teach"=>$rowData[$row][0][$key_class_tc],
													 "note"=>$note,
													 "login"=>"Lỗi",
													 "password"=>"Tài khoản đã tồn tại trong hệ thống"
																	));
			    	}
		    	}
		    	//else{
		    	//	$efrow.=($row).','; 
		    	//}
		       
			}

			$newname="upload/excel/".$school_name.'-gv-'.date('Y-m-d H:i:s').".xlsx";
		    rename($inputFileName , $newname);
		    $fileType = 'Excel2007';
			$res_file = "upload/excel/result/teacher/".$school_name."-gv-".date('Y-m-d H:i:s')."-result.xlsx";
			$handle = fopen($res_file, 'w') or die('Cannot open file:  '.$my_file);	
			$fileName = $res_file;
			
			$objPHPExcel = PHPExcel_IOFactory::load($res_file);
			 
			 
			$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A1', "STT")
										->setCellValue('B1', "Họ và tên")
										->setCellValue('C1', "Email")
										->setCellValue('D1', "Số điện thoại")
										->setCellValue('E1', "Bộ môn dạy")
										->setCellValue('F1', "Chủ nhiệm lớp")
										->setCellValue('G1', "Lớp đang dạy")
										->setCellValue('H1', "Ghi chú")
										->setCellValue('I1', "Tên đăng nhập")
										->setCellValue('J1', "Mật khẩu");
			 

			$i = 2;
			foreach ($array_data as $value) {
				$objPHPExcel->setActiveSheetIndex(0)
											->setCellValue("A$i", ($i-1))
											->setCellValue("B$i", $value['name'])
											->setCellValue("C$i", $value['email'])
											->setCellValue("D$i", $value['phone'])
											->setCellValue("E$i", $value['category'])
											->setCellValue("F$i", $value['home_room'])
											->setCellValue("G$i", $value['class_teach'])
											->setCellValue("H$i", $value['note'])
											->setCellValue("I$i", $value['login'])
											->setCellValue("J$i", $value['password']);
				$i++;
			}
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);

			$objWriter->save($fileName);
		    array_push($arr_file_result,array("title"=>"Giáo viên","filename"=>$fileName));
		}
        
        //xu ly sheet hoc sinh & phu huynh
        if ($su==2) {
            $arr_file_result=array();
            //lay thong tin cua truong 
            $school_name= trim(explode(':',$rowData[1][0][0])[1]);                   
			$school = $this->db->query($sql_school, array($waid, $school_name))->row_array();
		    if($school){
		     	$school_id= $school['did'];
		 	}
			else{

			    $school_array= array('group_id'=>2,
			    	                'dataitem_name'=> $school_name,
			    	                'dataitem_level'=>1,				
		                            'parent_id'=>$waid				
							);
			   $this->db->insert('savsoft_dataitem', $school_array);
			   $school_id= $this->db->insert_id();				
            }
			//lay thong tin lop
            $class_name= trim(explode(':',$rowData[2][0][0])[1]);
			if($class_name){
				$class = $this->db->query($sql_class, array($school_id, $class_name) )->row_array();
				if($class){
				  $class_id= $class['did'];
				}
				else{
				   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				   $charactersLength = strlen($characters);
				   $check=true;
					while($check){
						 $class_code = '';
						 for ($i = 0; $i < 6; $i++) {
							 $class_code.= $characters[rand(0, $charactersLength - 1)];
						 }
						$this->db->where('dataitem_code', $class_code);
						 $n = $this->db->get('savsoft_dataitem')->num_rows();
						if($n==0)
						$check=false;
					 }
				  $class_array= array('group_id'=>2,
								   'dataitem_name'=> trim($class_name),
								   'dataitem_level'=>2,				
								   'parent_id'=>$school_id,	
								   'dataitem_code'=>$class_code			
								);
				  $this->db->insert('savsoft_dataitem', $class_array);
				  $class_id= $this->db->insert_id();
				  $class_grade="";
				  $fc=substr(trim($class_name), 0,1);
				  if($fc=='1'){
					  $sc=substr(trim($class_name), 1,1);
					  if($sc==0||$sc==1||$sc==2){
						  $class_grade=intval($fc.$sc)+2;
					  }
					  else $class_grade=intval($fc)+2;
				  }
				  else if(in_array($fc, array("2","3","4","5","6","7","8","9"))){
					  $class_grade=intval($fc)+2;
				  }
				  else{
					  $class_grade="3,4,5,6,7,8,9,10,11,12,13,14";
				  }
				  $class_metadata=array("class_id"=>$class_id,
										"grade"=>$class_grade,
										"category"=>"3,4,5,6,7,8,9,10,11,12",
										"create_by"=>"0"
										);
				  $this->db->insert("class_metadata",$class_metadata);
				}

				// lay thong tin hoc sinh/

				$attribute = $rowData[5][0];
				$length_att=count($rowData[5][0]);
				for ($col = 0; $col < $length_att; $col++){ 
					if($attribute[$col]=='Email của phụ huynh') {
						$key_email =$col;

					}
					if($attribute[$col]=='Họ và tên'){
						$key_name=$col;
					}
					if($attribute[$col]=='Số điện thoại hoặc email của học sinh (nếu có)'){
						$key_phone=$col;
					}
					if($attribute[$col]=='Ngày sinh'){
						$key_birthdate=$col;
					}
					if($attribute[$col]=='Bố hoặc mẹ'){
						$key_parent=$col;
					}
					if($attribute[$col]=='Ghi chú'){
						$key_note=$col;
					}
					if($attribute[$col]=='Số điện thoại của phụ huynh'){
						$key_pr_phone=$col;
					}
					
                    


				}

				//$esrow='';
				//$efrow='';
				//$partten = "/^[A-Za-z0-9_\.]{6,32}@([a-zA-Z0-9]{2,12})(\.[a-zA-Z]{2,12})+$/";
				$array_data=array();
				$array_data2=array();
				for ($row = 6; $row <= $highestRow; $row++){ 
					$email_pr =$rowData[$row][0][$key_email];
					$name = $rowData[$row][0][$key_name];
					//tao email login cho hoc sinh
					$email = strtolower($name);
					$email =  str_replace(array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ',
												'Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'), 'a', $email);	 
					$email =  str_replace(array('đ','Đ'), 'd', $email);	
					$email =  str_replace(array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ',
												'É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'	), 'e', $email);	
					$email =  str_replace(array('í','ì','ỉ','ĩ','ị',
												'Í','Ì','Ỉ','Ĩ','Ị'), 'i', $email);	
					$email =  str_replace(array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ',
												'Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'), 'o', $email);	
					$email =  str_replace(array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự',
												'Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'), 'u', $email);	
					$email =  str_replace(array('ý','ỳ','ỷ','ỹ','ỵ',
												'Ý','Ỳ','Ỷ','Ỹ','Ỵ',), 'y', $email);	
					$email =  str_replace(array(' '), '', $email);	
					
					$student_phone= $rowData[$row][0][$key_phone];
					$parent_name= $rowData[$row][0][$key_parent];
					$strbd=$rowData[$row][0][$key_birthdate];
					if(strpos($strbd,'/') ===false){
						$birthdate = date('Y-m-d',($strbd-25569)*86400);
					}
					else{
						$dtime = DateTime::createFromFormat("d/m/Y",$strbd);
                        $timestamp = $dtime->getTimestamp();
						$birthdate =date('Y-m-d', $timestamp);
					}
					
					$note = $rowData[$row][0][$key_note];
					$pr_phone = $rowData[$row][0][$key_pr_phone];
					
				   if($email){
					   if($email_pr){
							//tao user moi cho phu huynh
							$this->db->where('email',$email_pr);
							$us =$this->db->get("savsoft_users")->row_array();
							
							if(!$us){
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
								$pr_arr= array(
										'email'=> $email_pr,
										'email2'=> $email_pr,
										'password'=>md5('12345'),
										'first_name'=>$parent_name,
										'last_name'=>'',
										'contact_no'=>$pr_phone,
										'gid'=>$gid,
										'su'=>4,
										'registered_date'=>date('Y-m-d H:i:s'),
										'subscription_expired'=>strtotime('2030-12-31'),
										'tinhthanh_id'=>$prid,
										'quanhuyen_id'=>$dtid,
										'xaphuong_id'=>$waid,
										'user_code'=>$user_code,								
									);
								$this->db->insert('savsoft_users', $pr_arr);
								$pr_id = $this->db->insert_id();
								array_push($array_data2,array("name"=>$parent_name, 
																 "email"=>$email_pr,
																 "pr_phone"=>$pr_phone,
																 "login"=>$email_pr,
																"password"=>"12345"
																		));
							
							}
							else{
								$pr_id=$us['uid'];
								array_push($array_data2,array("name"=>$parent_name, 
																 "email"=>$email_pr,
																  "pr_phone"=>$pr_phone,
																 "login"=>"Lỗi",
																"password"=>"Tài khoản đã tồn tại trên hệ thống"
																		));
							}						
					    }
					    else{
							//tao moi account cho phu huynh
							// check sdt
							if($pr_phone){
								$this->db->where('contact_no',$pr_phone);
								$this->db->where('su', 4);
								$us=$this->db->get('savsoft_users')->row_array();
								if($pr){
									$pr_id=$us['uid'];
									array_push($array_data2,array("name"=>$parent_name, 
																	 "email"=>$email_pr,
																	  "pr_phone"=>$pr_phone,
																	 "login"=>"Lỗi",
																	"password"=>"Tài khoản đã tồn tại trên hệ thống"
																			));
								}
								else{
									$email_pr = strtolower($parent_name);
									$email_pr =  str_replace(array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ',
																'Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'), 'a', $email_pr);	 
									$email_pr =  str_replace(array('đ','Đ'), 'd', $email_pr);	
									$email_pr =  str_replace(array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ',
																'É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'	), 'e', $email_pr);	
									$email_pr =  str_replace(array('í','ì','ỉ','ĩ','ị',
																'Í','Ì','Ỉ','Ĩ','Ị'), 'i', $email_pr);	
									$email_pr =  str_replace(array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ',
																'Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'), 'o', $email_pr);	
									$email_pr =  str_replace(array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự',
																'Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'), 'u', $email_pr);	
									$email_pr =  str_replace(array('ý','ỳ','ỷ','ỹ','ỵ',
																'Ý','Ỳ','Ỷ','Ỹ','Ỵ',), 'y', $email_pr);	
									$email_pr =  str_replace(array(' '), '', $email_pr);	
									$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLength = strlen($characters);
									$check=true;
									while($check){
										 $pr_user_code = '';
										 for ($i = 0; $i < 6; $i++) {
											 $pr_user_code.= $characters[rand(0, $charactersLength - 1)];
										 }
										$this->db->where('user_code', $pr_user_code);
										 $n = $this->db->get('savsoft_users')->num_rows();
										if($n==0)
										$check=false;
									 }
									$ins_arr= array(
										'email'=> $email_pr,
										'password'=>md5('12345'),
										'first_name'=>$parent_name,
										'last_name'=>'',
										'contact_no'=>$pr_phone,
										'gid'=>$gid,
										'su'=>4,
										'registered_date'=>date('Y-m-d H:i:s'),
										'subscription_expired'=>strtotime('2030-12-31'),
										'tinhthanh_id'=>$prid,
										'quanhuyen_id'=>$dtid,
										'xaphuong_id'=>$waid,
										'parent_id'=>$pr_id,	
										'note'=>"",
										'user_code'=>$pr_user_code								
									);

									$this->db->insert('savsoft_users', $ins_arr);
									$pr_id = $this->db->insert_id();
									//them id vao email						
									$email_pr = $email_pr."_".$pr_id.'@ph.do.stem.vn';
									$this->db->where('uid', $pr_id);	
									$this->db->update('savsoft_users', array('email'=> $email_pr));
									array_push($array_data2,array("name"=>$parent_name, 
																 "email"=>$email_pr,
																 "pr_phone"=>$pr_phone,
																 "login"=>$email_pr,
																"password"=>"12345"
																		));
								}
							}else{
								$pr_id="";
							}
							
						}
							// tao user moi cho hoc sinh
							//check duplicate
							$this->db->where("first_name", $name);
							$this->db->where("birthdate", $birthdate);
							$this->db->where("school_id", $school_id);
							$std_us=$this->db->get("savsoft_users")->row_array();
							if(!$std_us){
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
                                $class_ids_std=$class_id;
								$this->db->where("group_id",2);
								$this->db->where("parent_id",$class_id);
								$dt_class= $this->db->get("savsoft_dataitem")->result_array();
								foreach( $dt_class as $dtcl){
									$class_ids_std.=','.$dtcl['did'];
								}
                                $this->db->get('savsoft_dataitem');								
								$ins_arr= array(
										'email'=> $email,
										'password'=>md5('12345'),
										'first_name'=>$name,
										'last_name'=>'',
										'contact_no'=>$student_phone,
										'gid'=>$gid,
										'su'=>$su,
										'registered_date'=>date('Y-m-d H:i:s'),
										'subscription_expired'=>strtotime('2030-12-31'),
										'tinhthanh_id'=>$prid,
										'quanhuyen_id'=>$dtid,
										'xaphuong_id'=>$waid,
										'school_id'=>$school_id,
										'class_id' => $class_ids_std,
										'birthdate'=> $birthdate,
										'parent_id'=>$pr_id,	
										'note'=>$note,
										'user_code'=>$user_code								
									);

								$this->db->insert('savsoft_users', $ins_arr);
								$insert_id = $this->db->insert_id();
								//them id vao email						
								$email = $email."_".$insert_id.'@hs.do.stem.vn';
								$this->db->where('uid', $insert_id);	
								$this->db->update('savsoft_users', array('email'=> $email));
								
								// them hoc sinh vao lop
								$this->db->where("member_id",$insert_id);
								$this->db->where("class_id",$class_id);
								$cm= $this->db->get("class_member")->row_array();
								if(!$cm){
									$this->db->insert("class_member", array("member_id"=>$insert_id,"class_id"=>$class_id));
								}
								foreach( $dt_class as $dtcl){
									$this->db->where("member_id",$insert_id);
									$this->db->where("class_id",$dtcl['did']);
									$cm= $this->db->get("class_member")->row_array();
									if(!$cm){
										$this->db->insert("class_member", array("member_id"=>$insert_id,"class_id"=>$dtcl['did']));
									}
								}
								
								array_push($array_data,array("name"=>$name, 
								                             "birthdate"=>$rowData[$row][0][$key_birthdate],
														     "parent_name"=>$parent_name,
															"student_phone"=>$student_phone,
															"pr_phone"=>$pr_phone,
															 "email"=>$email_pr,
															"note"=>$note,
															"login"=>$email,
															"password"=>"12345"
																	));
							}
							else{
								array_push($array_data,array("name"=>$name, 
								                             "birthdate"=>$rowData[$row][0][$key_birthdate],
														     "parent_name"=>$parent_name,
															"student_phone"=>$student_phone,
														    "pr_phone"=>$pr_phone,
															 "email"=>$email_pr,
															"note"=>$note,
															"login"=>"Lỗi",
															"password"=>"Tài khoản đã tồn tại trong hệ thống"
																	));
							}
						
				   
					}
				}
			}
			$newname="upload/excel/".$school_name.'-hs-'.date('Y-m-d H:i:s').".xlsx";
		    rename($inputFileName , $newname);
			
			
            //ghi file result			
			$fileType = 'Excel2007';
			$res_file = "upload/excel/result/student/".$class_name."-".$school_name."-hs-".date('Y-m-d H:i:s')."-result.xlsx";
			$handle = fopen($res_file, 'w') or die('Cannot open file:  '.$my_file);	
			$fileName = $res_file;
			$objPHPExcel = PHPExcel_IOFactory::load($res_file);
			 
			 
			$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A1', "STT")
										->setCellValue('B1', "Họ và tên")
										->setCellValue('C1', "Ngày sinh")
										->setCellValue('D1', "Số điện thoại hoặc email của học sinh (nếu có)")
										->setCellValue('E1', "Bố hoặc mẹ")
										->setCellValue('F1', "Số điện thoại của phụ huynh")
										->setCellValue('G1', "Email của phụ huynh")
										->setCellValue('H1', "Ghi chú")
										->setCellValue('I1', "Tên đăng nhập")
										->setCellValue('J1', "Mật khẩu");
			 

			$i = 2;
			foreach ($array_data as $value) {
				$objPHPExcel->setActiveSheetIndex(0)
											->setCellValue("A$i", ($i-1))
											->setCellValue("B$i", $value['name'])
											->setCellValue("C$i", $value['birthdate'])
											->setCellValue("D$i", $value['student_phone'])
										    ->setCellValue("E$i", $value['parent_name'])
											->setCellValue("F$i", $value['pr_phone'])
											->setCellValue("G$i", $value['email'])
											->setCellValue("H$i", $value['note'])
											->setCellValue("I$i", $value['login'])
											->setCellValue("J$i", $value['password']);
				$i++;
			}
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);

			$objWriter->save($fileName);
			 array_push($arr_file_result,array("title"=>"Học sinh","filename"=>$fileName));
             $fileType = 'Excel2007';
			$res_file = "upload/excel/result/parent/".$class_name.'-'.$school_name."-ph-".date('Y-m-d H:i:s')."-result.xlsx";
			$handle = fopen($res_file, 'w') or die('Cannot open file:  '.$my_file);	
			$fileName = $res_file;
			
			$objPHPExcel = PHPExcel_IOFactory::load($res_file);
			 
			 
			$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue('A1', "STT")
										->setCellValue('B1', "Họ và tên")
										->setCellValue('C1', "Email")
										->setCellValue('D1', "SĐT")
										->setCellValue('E1', "Tên đăng nhập")
										->setCellValue('F1', "Mật khẩu");
			 

			$i = 2;
			foreach ($array_data2 as $value) {
				$objPHPExcel->setActiveSheetIndex(0)
											->setCellValue("A$i", ($i-1))
											->setCellValue("B$i", $value['name'])
											->setCellValue("C$i", $value['email'])
											->setCellValue("D$i", $value['pr_phone'])
											->setCellValue("E$i", $value['login'])
											->setCellValue("F$i", $value['password']);
				$i++;
			}
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);

			$objWriter->save($fileName);
            array_push($arr_file_result,array("title"=>"Phụ huynh","filename"=>$fileName));
		    
		   
        	
        }
        
        return $arr_file_result;
        
	}
	
	function filter_su($su){
		$this->db->select('uid,first_name,last_name,email,school_id,category_id');
		$this->db->where('su', $su);
		$tc= $this->db->get('savsoft_users')->result_array();
		
		for($i=0; $i<count($tc); $i++){
			$cat="";
			if($tc[$i]['category_id']){
				$sql_ct = "select * from savsoft_category where cid in (".$tc[$i]['category_id'].")";
			    $categs=$this->db->query($sql_ct)->result_array();
				foreach($categs as $k=>$categ){
					if($k>0){
						$cat.=", ";
					}
					$cat.=$categ['category_name'];
				}
			}
			
			$tc[$i]['categories']=$cat;
		}
		return $tc;
		
	}

	function get_by_cookie($cookie){
        $this->db->where('web_token', $cookie);
        return $this->db->get('savsoft_users');
    }

    function update_web_token($data, $id_user) {
        $this->db->where('uid', $id_user);
        $this->db->update('savsoft_users', $data);
    }

	function enable_stemup($uid){
		$this->db->where("uid", $uid);
		$us= $this->db->get("savsoft_users")->row_array();
		if($us){
			$this->db->where("uid", $uid);
			return $this->db->update("savsoft_users", array("stemup_enable"=>1));
		}
		else
			return false;
	}
}

?>
