<?php
Class Profile_model extends CI_Model{

	function getprofile($uid){
		$this->db->where('uid',$uid);
		$user = $this->db->get('savsoft_users');
		$result= array();
		if($user){
			$result =$user->result_array()[0];
			$cat_id = $result['category_id'];
			$str_ct='';
			if($cat_id!=""){
				$sql_categ = "Select * from savsoft_category where cid in ($cat_id)";
				$categs = $this->db->query($sql_categ)->result_array();
				foreach($categs as $k=>$categ){
					if($k!=0){
						$str_ct .=', ';
					}
					
					$str_ct .=$categ['category_name'];
					
				}
			}
			$result['category']=$str_ct;
			if($result['school_id']!=''){
				$this->db->where('did',$result['school_id']);
				$school_name =$this->db->get('savsoft_dataitem')->result_array()[0]['dataitem_name'];
			}
			
			$result['school']=$school_name;
			
			$this->db->where('did',$result['tinhthanh_id']);
		    $tinhthanh =$this->db->get("savsoft_dataitem")->row_array()['dataitem_name'];
			$this->db->where('did',$result['quanhuyen_id']);
            $quanhuyen=$this->db->get("savsoft_dataitem")->row_array()['dataitem_name'];
			$this->db->where('did',$result['xaphuong_id']);
			$xaphuong =$this->db->get("savsoft_dataitem")->row_array()['dataitem_name'];
			if($xaphuong == '' && $quanhuyen == '' && $tinhthanh == ''){
				$result['address']='';
			} else {
				$result['address']=$xaphuong.', '.$quanhuyen.', '.$tinhthanh;
			}
            			
		}
        return $result;
	}
	
	function change_category($uid){
		$userdata = array('category_id'=> implode(',', $this->input->post('category')));
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',$userdata);
		redirect('profile');
		
	}
	function save_description($uid){
		$user_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		$description = $user_info['description'];
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',array('description'=>$description));
		
	}
	function sub($id){
		$this->db->where('uid',$id);
		$this->db->update('savsoft_users',array('subscribe'=>'1'));
	}
	function unsub($id){
		$this->db->where('uid',$id);
		$this->db->update('savsoft_users',array('subscribe'=>'0'));
	}
	function save_interest_category($uid){
		$userdata = array('interest_cat_ids'=> implode(',', $this->input->post('categ')));
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',$userdata);
		
		
	}	
	function save_interest_level($uid){
		$userdata = array('interest_level_ids'=> implode(',', $this->input->post('lv')));
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',$userdata);
		redirect('profile');
		
	}
	function save_information1($uid){
		$data = $this->input->post();
	//	$fname = $this->input->post('fname');
	//	$lname = $this->input->post('lname');
		$birthdate = $this->input->post('birthdate');
	//	$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$tinhthanh_id = $this->input->post('tinhthanh_id');
		$quanhuyen_id = $this->input->post('quanhuyen_id');
		$xaphuong_id = $this->input->post('xaphuong_id');
		$scl_school_id=$this->input->post('scl_school_id');
		$userdata = array(//'first_name'=>$fname,
		                  //'last_name'=>$lname,
		                  'birthdate'=>$birthdate,
						  'contact_no'=>$phone,
						  //'email2'=>$email,
						  'tinhthanh_id' =>$tinhthanh_id,
						  'quanhuyen_id' =>$quanhuyen_id,
						  'xaphuong_id' =>$xaphuong_id,
						  'school' =>$scl_school_id
						  );
	//    print_r($userdata);
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',$userdata);
	//	redirect('profile');	
		
	}
	function save_information($uid){
		$name = $this->input->post('fullname');
		$birthdate = $this->input->post('birthdate');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$tinhthanh_id = $this->input->post('tinhthanh_id');
		$quanhuyen_id = $this->input->post('quanhuyen_id');
		$xaphuong_id = $this->input->post('xaphuong_id');
		$scl_school_id=$this->input->post('scl_school_id');
		$userdata = array('first_name'=>$name,
		                  'last_name'=>'',
		                  'birthdate'=>$birthdate,
						  'contact_no'=>$phone,
						  'email2'=>$email,
						  'tinhthanh_id' =>$tinhthanh_id,
						  'quanhuyen_id' =>$quanhuyen_id,
						  'xaphuong_id' =>$xaphuong_id,
						  'school' =>$scl_school_id
						  );
	    print_r($userdata);
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',$userdata);
		redirect('profile');
		
	}
	
	function save_logo($uid){
	    $user_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		$userdata = array('text_license'=>$user_info['textorg'],
		                  'out_link'=>$user_info['linkorg'],
						  );
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',$userdata);
		
	}
   
    function load_stat($uid){
		$this->db->where('inserted_by',10);
		$total= $this->db->get('savsoft_qbank')->num_rows();
		return array(array("label"=>'total','y'=>$total));
	}
	function data_tinh_thanh(){
		$sql = "SELECT d.did,d.group_id,d.dataitem_name,d.dataitem_level,d.parent_id FROM savsoft_dataitem d Where d.dataitem_level=1 and d.group_id=1 ";
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
	function data_tinh_thanh1($tt){
		$sql = "SELECT d.did,d.group_id,d.dataitem_name,d.dataitem_level,d.parent_id FROM savsoft_dataitem d Where d.dataitem_level=1 and d.group_id=1 ";
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
    function data_huyen($parent_id){
		$sql= "SELECT d.did,d.group_id,d.dataitem_name,d.dataitem_level,d.parent_id FROM savsoft_dataitem d
				Where d.dataitem_level=2 and d.group_id=1 ";
		if($parent_id){
			$sql.= "and d.parent_id=$parent_id";
		}
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
	function data_schools($qh_id){
		$sql= "SELECT * FROM school s INNER JOIN savsoft_dataitem d ON s.tinh_thanh=d.did WHERE  ";
		if($qh_id){
			$sql.= "s.quan_huyen=$qh_id";
		}
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
	
	
}