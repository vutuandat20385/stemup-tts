<?php
Class Classes_model extends CI_Model
{
 
  	function get_class(){
		$user=$this->session->userdata('logged_in');

        //if($user['su']==3){
        	$this->db->where('uid', $user['uid']);
			$data = $this->db->get('savsoft_users')->result_array()[0];
			$class_id =$data['class_id'];
			$homeroom_class_id= $data['homeroom_class_id'];
			$merge=$class_id;
	        if($class_id=='' ){
				$merge = $homeroom_class_id;
			}
			else {
			    if($homeroom_class_id!='')
	          		 $merge.=','.$homeroom_class_id;
	          
	        }
			if($merge !=''){
		 	   $sql = "SELECT * from savsoft_dataitem where status=1 and did in (".$merge.") order by did desc";	
				$results=$this->db->query($sql)->result_array();
				for($k=0; $k < count($results); $k++){
					if($results[$k]['dataitem_level']==2){
						 $this->db->where('did',  $results[$k]['parent_id']);
						 $school=$this->db->get('savsoft_dataitem')->row_array();

						 $sql = "SELECT uid, class_id FROM savsoft_users where su=2";

						 $stds= $this->db->query($sql)->result_array();
						 $std_count=0;
						foreach($stds as $std){
							$class_ids= explode(',', $std['class_id']);
							if(in_array($results[$k]['did'], $class_ids)){
								$std_count++;
							}
						} 
						$results[$k]['student_count']=$std_count;
						$results[$k]['class_name']=$results[$k]['dataitem_name'];
						$results[$k]['school']=$school['dataitem_name'];
					}
				
				 else{
					   $this->db->where('did',  $results[$k]['parent_id']);
					   $pr_class=$this->db->get('savsoft_dataitem')->row_array();
					   $this->db->where('did',  $pr_class['parent_id']);
					   $school=$this->db->get('savsoft_dataitem')->row_array();
					   $sql = "SELECT uid, class_id FROM savsoft_users where su=2";

						 $stds= $this->db->query($sql)->result_array();
						 $std_count=0;
						foreach($stds as $std){
							$class_ids= explode(',', $std['class_id']);
							if(in_array($results[$k]['did'], $class_ids)){
								$std_count++;
							}
						} 
						$results[$k]['student_count']=$std_count;
						$results[$k]['class_name']=$results[$k]['dataitem_name'].' '.$pr_class['dataitem_name'];
						$results[$k]['school']=$school['dataitem_name'];
				 }
				}
				return $results; 
			}
			else return array();
		//}
		/*else if($user['su']=1){
			 $sql2 = "SELECT * from savsoft_dataitem where group_id=2 and dataitem_level=2 order by did desc";	
			$results=$this->db->query($sql2)->result_array();
			for($k=0; $k < count($results); $k++){
	             $this->db->where('did',  $results[$k]['parent_id']);
	             $school=$this->db->get('savsoft_dataitem')->result_array()[0];

	             $sql = "SELECT uid, class_id FROM savsoft_users where su=2";

                 $stds= $this->db->query($sql)->result_array();
                 $std_count=0;
		        foreach($stds as $std){
		        	$class_ids= explode(',', $std['class_id']);
		        	if(in_array($results[$k]['did'], $class_ids)){
		        		$std_count++;
		        	}
		        } 
			    $results[$k]['student_count']=$std_count;
			    $results[$k]['school']=$school['dataitem_name'];
			}
			return $results; 
		}*/
 	}
	function deleteclass_ofteacher($classid){
		$logged_in=$this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		$data_class_id="SELECT u.class_id FROM savsoft_users u WHERE u.uid=$uid";
		$class_ids = $this->db->query($data_class_id)->result_array();
		$a = explode(",",$class_ids[0]['class_id']); // chuyển chuỗi thành mảng 
		foreach($a as $k => $val){
			if($val == $classid){
				unset($a[$k]);
			}	
		}
		$b = implode(",",$a); // chuyển mảng thành chuỗi
		$this->db->where('uid',$uid);
		$this->db->update('savsoft_users', array("class_id"=>$b));
		$this->db->where('did',$classid);
		$this->db->update('savsoft_dataitem', array("status"=>0));
		//return count($a);
	}

 	function get_student($class_id){
        $sql = "SELECT uid, class_id FROM savsoft_users where su=2";

        $stds= $this->db->query($sql)->result_array();
        $str_uid='';
        foreach($stds as $std){
        	$class_ids= explode(',', $std['class_id']);
        	if(in_array($class_id, $class_ids)){
        		if($str_uid!='')
                 $str_uid.=','.$std['uid'];
               else
                 $str_uid.=$std['uid'];
        	}
        } 
        if($str_uid!=''){
            $sql2 = "SELECT * FROM savsoft_users where  uid in ($str_uid)";

	    
	        return $this->db->query($sql2)->result_array();
        }
        else return array();
      
      

	 }
	 
	function get_member($class_id){
		$sql="select cm.member_id,su.first_name, su.last_name,su.email,su.su, count(sa.quid) Tong, count(sa.rid) DaTL from class_member cm
			LEFT JOIN savsoft_assign sa ON sa.uid=cm.member_id and sa.auid in (select create_by from class_metadata where class_id=$class_id) and sa.classid=$class_id
			INNER JOIN savsoft_users su ON su.uid=cm.member_id

			WHERE cm.class_id=$class_id
			GROUP BY cm.member_id";
//         $sql = "SELECT * FROM savsoft_users  INNER JOIN class_member ON savsoft_users.uid=class_member.member_id 
// where class_member.class_id=$class_id";

        $mb= $this->db->query($sql)->result_array();
        return $mb;
 	}

    function get_student_rm($class_id){
         $sql = "SELECT * FROM savsoft_users where su=2";

        $stds= $this->db->query($sql)->result_array();
        $str_uid='';
        foreach($stds as $std){
        	$class_ids= explode(',', $std['class_id']);
        	if(in_array($class_id, $class_ids)){
        		if($str_uid!='')
                 $str_uid.=','.$std['uid'];
               else
                 $str_uid.=$std['uid'];
        	}
        } 
        if($str_uid!=''){
       	 	$sql2 = "SELECT * FROM savsoft_users where su=2 and uid not in ($str_uid)";
	       return  $this->db->query($sql2)->result_array();
	    }
	   else {
           return $stds;
	   }
       

	 

 	}

    function remove_student($class_id_rm, $student_id){
         $this->db->where('uid', $student_id);
         $std= $this->db->get('savsoft_users')->row_array();
         $class_ids= explode(',', $std['class_id']);
         $new_class_ids='';
         foreach ( $class_ids as $k => $class_id) {
         	if($class_id!=$class_id_rm){
         		if($new_class_ids!='')
         		   $new_class_ids.=','.$class_id;
         		else
         			$new_class_ids.=$class_id;
         	}
         }
         $this->db->where('uid', $student_id);
         $this->db->update('savsoft_users', array('class_id'=> $new_class_ids));
		 
		 $this->db->where("did",$class_id_rm);
		 $cl=$this->db->get("savsoft_dataitem")->row_array();
		 
		 $user = $this->session->userdata('logged_in');
		 $content = 'Loại bỏ thành viên '.$std['first_name'].' '.$std['last_name'].' khỏi lớp '.$cl['dataitem_name'];
		 $model = "class";
		 $action = "remove student";
		 $url = site_url('home_user/list_student_inclass/'.$class_id);
		 $userdatant = array(
			'uid' => $user['uid'],
			'content' => $content,
			'model' => $model,
			'action' => $action,
			'click' => "class_exist('".$class_id."')",
		 );

		$this->db->insert('notify',$userdatant);
		$insert_idnt = $this->db->insert_id();
		$this->db->where("class_id",$class_id_rm);
		$members = $this->db->get("class_member")->result_array();
		foreach($members as $member){
			$ud = array(
				'nid' => $insert_idnt,
				'uid' => $member['member_id'],
			);
			$this->db->insert('notify_user', $ud);
		}
	    $this->db->where("member_id",$student_id); 
		return $this->db->delete('class_member');
    }	
// ban dau khi chua co thong bao chap nhan lop
    function add_student1($class_id, $student_id){
         $this->db->where('uid', $student_id);
         $std= $this->db->get('savsoft_users')->row_array();
         if($std['class_id']!='')
             $new_class_ids =$std['class_id'].','.$class_id;
         else
            $new_class_ids =$class_id;
         $this->db->where('uid', $student_id);
         $this->db->update('savsoft_users', array('class_id'=> $new_class_ids));
		 $this->db->insert("class_member",array("member_id"=>$student_id,"class_id"=>$class_id,"deleted"=>0));
    }	


    function insert_class(){
         $user =$this->session->userdata('logged_in');
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
         


		 $uid= $user['uid'];
		 $class_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		 $userdata=array(   'dataitem_name'=>$class_info['class_name'],
							'dataitem_code'=>$class_code,
							'group_id'=>2,
							'dataitem_level'=>2,
							'parent_id'=>0,
							'status' =>1
							);
		  
		  $this->db->insert('savsoft_dataitem',$userdata);
		  $class_id =  $this->db->insert_id();
		  $class_metadata = array('class_id'=>$class_id,
							'grade'=>$class_info['grade'],
							'category'=>$class_info['categ'],
							'create_by'=>$user['uid'],
							);
		  
		  $this->db->insert('class_metadata',$class_metadata);				
		  $this->db->where('uid', $uid);
          $tc= $this->db->get('savsoft_users')->result_array()[0];
          if($tc['class_id']!='')
             $new_class_ids =$tc['class_id'].','.$class_id;
           else
            $new_class_ids =$class_id;
          $this->db->where('uid',$uid);
          $this->db->update('savsoft_users', array('class_id'=> $new_class_ids));
		 $this->db->insert("class_member",array("member_id"=>$uid,"class_id"=>$class_id,"deleted"=>0));
          return array('class_code'=>$class_code,
                       'class_id'=>$class_id
                       );



    }	

    function join_class($code){
		$user = $this->session->userdata('logged_in');
		if($user['su']==2){
		//	$code = $this->input->post('class_code');
			$this->db->where('dataitem_code',$code);
			$this->db->where('group_id',2);
			$this->db->where('dataitem_level',2);
			$class =$this->db->get('savsoft_dataitem');
			$data= array();
            if($class->num_rows()==0){
				$data['mess'] = "Mã lớp không tồn tại";
				$data['status'] = 0;
			}
            else{
				$cl = $class->result_array()[0];
				$class_id= $cl['did'];
				$sql = "select cm.create_by FROM class_metadata cm WHERE cm.class_id=$class_id ";
				$teacher = $this->db->query($sql)->row_array();
				$this->db->where('uid', $user['uid']);
				$cl_str=$this->db->get('savsoft_users')->result_array()[0]['class_id'];
				$class_ids= explode(',', $cl_str);
				if(in_array($class_id, $class_ids)){
					$data['mess']='Bạn đã tham gia lớp '. $cl['dataitem_name'] .' rồi'; 
					$data['status'] = 2;
				}
				else{
					/*$new_class_ids='';
					if($cl_str!=''){
						$new_class_ids.=$cl_str.','.$class_id;
					}
					else{
						$new_class_ids.=$class_id;
					}
					$this->db->where('uid', $user['uid']);
					$this->db->update('savsoft_users', array('class_id'=> $new_class_ids));
					$this->db->insert("class_member",array("member_id"=>$user['uid'],"class_id"=>$class_id));
					$content = 'Gia nhập lớp '.$cl['dataitem_name'];
					$model = "class";
					$action = "join class";
					$url = site_url('home_user/manage_class#/class/'.$class_id);
					$userdatant = array(
						'uid' => $user['uid'],
						'content' => $content,
						'model' => $model,
						'action' => $action,
						'click' =>  "window.location.href='".$url."'",
					);

					$this->db->insert('notify',$userdatant);
					$insert_idnt = $this->db->insert_id();
					$this->db->where("class_id",$class_id);
					$members = $this->db->get("class_member")->result_array();
					foreach($members as $member){
						$ud = array(
							'nid' => $insert_idnt,
							'uid' => $member['member_id'],
						);
						$this->db->insert('notify_user', $ud);
					}
					$data['mess']= 'Gia nhập lớp '.$cl['dataitem_name'].' thành công';*/
					$content = 'Đã gửi yêu cầu tham gia lớp'.' '.$cl['dataitem_name'];
					$model = "class";
					$action = "join class";
					$url = "accept_join_studentclass('".$class_id."','".$user['uid']."')";
					$userdatant = array(
						'uid' => $user['uid'],
						'content' => $content,
						'model' => $model,
						'action' => $action,
						'click' => $url,
					);

					$this->db->insert('notify',$userdatant);
					$insert_idnt = $this->db->insert_id();
					$ud = array(
						'nid' => $insert_idnt,
						'uid' => $teacher['create_by'],
					);
					$this->db->insert('notify_user', $ud);
					$data['mess']='Bạn đã gửi yêu cầu tham gia lớp'.' '.$cl['dataitem_name'].' '. 'thành công!'; 
					$data['status'] = 2;
				}	
			}
			return $data;
		}
	}
	function join_studentclassst($class_id,$uid){
	$logged_in = $this->session->userdata('logged_in');
    $this->db->where('uid',$uid);
    $user= $this->db->get('savsoft_users')->row_array();
    $this->db->where('did',$class_id);
        $cl= $this->db->get('savsoft_dataitem')->row_array();
        if($user['class_id']!=''){
            $new_cl_ids.=$user['class_id'].','.$class_id;
        }
        else{
            $new_cl_ids.=$class_id;
        }
        $this->db->where('uid', $uid);
        $this->db->update('savsoft_users', array('class_id'=> $new_cl_ids));
        $this->db->insert("class_member",array("class_id"=>$class_id,"member_id"=>$uid,"deleted"=>0));
        $content = " đã chấp nhận cho bạn tham gia lớp ".$cl['dataitem_name'].' !';
        $model = "class";
        $action = "join_class";
        $url = "load_in_class('".$class_id."')";
        $userdatant = array(
            'uid' => $logged_in['uid'],
            'content' => $content,
            'model' => $model,
            'action' => $action,
            'click' =>  $url,
            );
        $this->db->insert('notify',$userdatant);
        $insert_idnt = $this->db->insert_id();
        $ud = array(
            'nid' => $insert_idnt,
            'uid' => $uid,
        );
        $this->db->insert('notify_user', $ud);
    }	
	public function load_class($class_id){
		$us = $this->session->userdata('logged_in');
		$this->db->where('uid',$us['uid']);
		$user=$this->db->get('savsoft_users')->row_array();
		$user_class= explode(",", $user["class_id"]);
		if(!in_array($class_id, $user_class)){
			$status=0;
		}
		else{
			$status=1;
			$this->db->where('did',$class_id);
			$class= $this->db->get('savsoft_dataitem')->row_array();
			$this->db->where("class_id",$class_id);
			$class_metadata= $this->db->get('class_metadata')->row_array();
			$uid_create_by = $class_metadata['create_by'];
			$this->db->where('uid',$uid_create_by);
			$cr =$this->db->get('savsoft_users')->row_array();
			$class['name_create_by']=$cr['first_name'].' '.$cr['last_name'];
			$level = $class_metadata['grade'];
			if($level !=''){
				$arrlv = explode(',',$level);
				$count =count($arrlv);
				if($count==1){
					$this->db->where('lid',$level);
                    $strlv = $this->db->get('savsoft_level')->row_array()["level_name"];					
				}
				else{
					if($arrlv[0]==3 && $arrlv[$count-1]==14){
						$strlv ="Tất cả cấp độ";
					}
					else{
						$this->db->where('lid',$arrlv[0]);
						$stlv =$this->db->get('savsoft_level')->row_array()["level_name"];
						$this->db->where('lid',$arrlv[$count-1]);
						$endlv =$this->db->get('savsoft_level')->row_array()["level_name"];
						$strlv = "Từ ".$stlv." đến ".$endlv;
					}
				}
				$class['level'] =$strlv;
			}
			
			$category = $class_metadata['category'];
			if($category !=''){
				$arrct = explode(',',$category);
				if(count($arrct)>1){
					$strct ="Tất cả môn học";
				}
				else{
					$this->db->where('cid',$category);
					$strct =$this->db->get('savsoft_category')->row_array()["category_name"];
				}
				$class['category'] =$strct;
			}
		}
		$result = array("status"=>$status,
		                "user"=> $user,
		                "class"=>$class,
		               );
					   
		return $result;
	}
 	
	function class_of_teacher($class_id){
		$sql = "SELECT d.did,d.dataitem_name,clm.class_id,clm.grade,sl.level_name,clm.category,sc.category_name FROM savsoft_dataitem d 
		INNER JOIN class_metadata clm
		ON d.did=clm.class_id 
		INNER JOIN savsoft_level sl ON clm.grade = sl.lid
		INNER JOIN savsoft_category sc ON clm.category = sc.cid ";
		if($class_id){
			$sql.= " WHERE d.did=$class_id ";
		}
		$data= $this->db->query($sql)->result_array();
        return $data;
	}
	function determine_class($class_id,$name,$lid,$cid){
		if($name!="undefined" || $name=""){
			$this->db->where('did',$class_id);
			$data['a']=$this->db->update('savsoft_dataitem', array("dataitem_name" => $name));
		}
			$this->db->where('class_id',$class_id);
			$data['b']=$this->db->update('class_metadata', array( "grade"    =>$lid,
			                                                      "category" =>$cid
															   ));
	return $data;
        	
	}
	function level_class(){
		$sql = " SELECT * FROM savsoft_level ";
		$data= $this->db->query($sql)->result_array();
        return $data;
	}
	function category_class(){
		$sql = " SELECT * FROM savsoft_category ";
		$data= $this->db->query($sql)->result_array();
        return $data;
	}
	function load_discussion($class_id, $pivot=0, $max_post=5){
		$us = $this->session->userdata('logged_in');
		$this->db->where('uid',$us['uid']);
		$user=$this->db->get('savsoft_users')->row_array();
		$user_class= explode(",", $user["class_id"]);
		$data = array();
		if(in_array($class_id, $user_class)){
			
			$this->db->from('posts p');
            $this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
			$this->db->where('p.model','class');
			$this->db->where('p.wall_id', $class_id);
			$this->db->where('p.parent_id', 0);
			if($pivot!=0)
				$this->db->where('p.post_id <', $pivot);
			$this->db->limit($max_post+1);
			$this->db->order_by("p.create_date", "desc");
			$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,su,photo");
			$data['post'] =$this->db->get()->result_array();
			for($i=0; $i<count($data['post']); $i++){
				$this->db->from('posts p');
				$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
				$this->db->where('p.model','class');
				$this->db->where('p.parent_id', $data['post'][$i]['post_id']);
				$this->db->limit(3);
				$this->db->order_by("p.create_date", "desc");
				$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,su,photo");
				$data['post'] [$i]['reply']=$this->db->get()->result_array();
				$this->db->where('parent_id', $data['post'][$i]['post_id']);
				$data['post'] [$i]['nreply']=$this->db->get('posts')->num_rows();
				
			}
			$data['cuid'] = $us['uid'];
			
		}
		return $data;
	}
	
	function load_reply($parent_id, $pivot=0, $max_post=5){
        $us = $this->session->userdata('logged_in');
		$this->db->from('posts p');
		$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
		$this->db->where('p.model','class');
		$this->db->where('p.parent_id', $parent_id);
		if($pivot!=0)
			$this->db->where('p.post_id <', $pivot);
		$this->db->limit($max_post+1);
		$this->db->order_by("p.create_date", "desc");
		$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,su,photo");
		$data['post'] =$this->db->get()->result_array();
		$data['cuid'] = $us['uid'];
			
		
		return $data;
	}
	
	function write_post($class_id, $parent_id=0){
		$us = $this->session->userdata('logged_in');
		$this->db->where('uid',$us['uid']);
		$user=$this->db->get('savsoft_users')->row_array();
		$user_class= explode(",", $user["class_id"]);
		if(in_array($class_id, $user_class)){
			$data = json_decode($this->input->raw_input_stream,true);
			if($data['content']!= ""){ 
				$post = array('content'=>$data['content'],
							  'parent_id'=>$parent_id,
							  'wall_id'=>$class_id,
							  'model'=>'class',
							  'create_by'=>$user['uid']
						);
				
				$this->db->insert('posts', $post);
				$this->db->where("did",$class_id);
				$cl= $this->db->get("savsoft_dataitem")->row_array();
				$content = 'Đăng bài viết trên tường lớp '.$cl['dataitem_name'];
				$model = "class";
				$action = "write post";
				$url = site_url('home_user/list_student_inclass/'.$class_id);
				$userdatant = array(
					'uid' => $user['uid'],
					'content' => $content,
					'model' => $model,
					'action' => $action,
					'click' =>  "class_exist('".$class_id."')",
				);

				$this->db->insert('notify',$userdatant);
				$insert_idnt = $this->db->insert_id();
				$this->db->where("class_id",$class_id);
				$members = $this->db->get("class_member")->result_array();
				foreach($members as $member){
					$ud = array(
						'nid' => $insert_idnt,
						'uid' => $member['member_id'],
					);
					$this->db->insert('notify_user', $ud);
				}
			}
		}
	}
	
	
	
	function get_student_1($class_id,$search=""){
		$sql = "select uid,email,su,birthdate,user_code,first_name, last_name from savsoft_users where su=2 and uid not in (select member_id from class_member where class_id=".$class_id." )";
		if($search!=""){
			$sql.=" and (first_name like '%".$search."%' or email like '%".$search."%' )"; 
		}
		
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
	function add_student($class_id,$uid){
		
        $logged_in = $this->session->userdata('logged_in');
		if($logged_in['su'] == '3'){
			$this->db->where('uid',$uid);
			$user= $this->db->get('savsoft_users')->row_array();
			$sql= "SELECT cm.create_by FROM class_metadata cm WHERE cm.class_id=$class_id ";
			$teacher = $this->db->query($sql)->row_array();
			$this->db->where('did',$class_id);
			$cl= $this->db->get('savsoft_dataitem')->row_array();
			if($user['class_id']!=''){
				$new_cl_ids.=$user['class_id'].','.$class_id;
			}
			else{
				$new_cl_ids.=$class_id;
			}
			$this->db->where('uid', $uid);
			$this->db->update('savsoft_users', array('class_id'=> $new_cl_ids));

			$this->db->insert("class_member",array("class_id"=>$class_id,"member_id"=>$uid,"deleted"=>0));

			$uid_insert = $this->db->insert_id();
			$content = " đã thêm bạn vào lớp ".$cl['dataitem_name'].' !';
			$model = "class";
			$action = "join_class";
			$url = site_url('home_user/list_student_inclass/'.$class_id);
			$userdatant = array(
				'uid' => $logged_in['uid'],
				'content' => $content,
				'model' => $model,
				'action' => $action,
				'click' =>  "class_exist('".$class_id."')",
				);
			$this->db->insert('notify',$userdatant);
			$insert_idnt = $this->db->insert_id();
			$ud = array(
				'nid' => $insert_idnt,
				'uid' => $uid,
			);
			$this->db->insert('notify_user', $ud);

			$array_quid_sql = "SELECT quid FROM savsoft_assign WHERE auid IN (SELECT create_by from class_metadata where class_id=$class_id) AND classid=$class_id GROUP BY quid";
			$array_quid = $this->db->query($array_quid_sql)->result_array();

			$auid_sql="SELECT cm.create_by from class_metadata cm where cm.class_id=$class_id";
			$aname_sql = "SELECT * FROM savsoft_users su
			LEFT JOIN savsoft_assign sa ON sa.auid= su.uid 
			WHERE sa.classid = $class_id AND sa.auid IN (SELECT create_by from class_metadata where class_id=$class_id)
			";

			// var_dump($array_quid);
			$count = count($array_quid);
			$auid = $this->db->query($auid_sql)->row();
			$aname = $this->db->query($aname_sql)->row();
			$startdate = date('Y-m-d 00:00:00');

			$date=date_create("$startdate");
			$date1 = date_modify($date, "+1 days");
			$enddate= date_format($date1, "Y-m-d");
			$memberid_sql = "select member_id FROM class_member WHERE id=$uid_insert";
			$member_id = $this->db->query($memberid_sql)->row();
			foreach ($array_quid as $row){
				$array = array(
					'quid' => $row['quid'],
					'auid' =>$auid->create_by,
					'aname' =>$aname->first_name,
					'uid' => $member_id->member_id,
					'classid'=>$class_id,
					'startdate' =>$startdate,
					'enddate' =>$enddate,
					'status'=>1
				);
				$this->db->insert('savsoft_assign',$array);
			}
			// $this->db->update('savsoft_assign',$array);
			/*for($i=0;$i<$count;$i++) {
				$array = array( 
					'quid' => $array_quid[i][0],
					'auid' =>$this->db->query($auid_sql)->result(),
					'aname' =>$this->db->query($aname_sql)->result(),
					'uid' => $uid_insert,
					'startdate' =>'',
					'enddate' =>'',
					'status'=>1
				);*/
				
			// }
		}
			
		
		if($logged_in['su'] == '2'){
			//thông báo học sinh
			$this->db->where('uid',$logged_in['uid']);
			$user = $this->db->get('savsoft_users')->row_array();
			$name = $user['first_name'].' '.$user['last_name'];
			$this->db->where('did',$class_id);
			$class = $this->db->get('savsoft_dataitem')->row_array();
			$content = "Đã mời bạn tham gia lớp".' '.$class['dataitem_name']." đang chờ giáo viên phê duyệt";
			$action = "invite join class";
			$url = "wait_determine('".$class_id."')";
			$model = 'class';
			$userdata = array(
				'uid' => $user['uid'],
				'content' => $content,
				'model' => $model,
				'action' => $action,
				'click' =>  $url,
			);
			$this->db->insert('notify',$userdata);
			$insert_idnt = $this->db->insert_id();
			$ud = array(
				'nid' => $insert_idnt,
				'uid' => $uid,
			);
			$this->db->insert('notify_user', $ud);
			
			
			// thông báo giáo viên
			$teacher = "SELECT cm.create_by FROM class_metadata cm WHERE cm.class_id=$class_id";
			$name1= "SELECT su.first_name,su.last_name FROM savsoft_users su WHERE su.uid=$uid";
			$data = $this->db->query($teacher)->row_array();
			$data1 = $this->db->query($name1)->row_array();
			$url1 = "accept_join_friendclass('".$class['did']."','".$logged_in['uid']."','$uid')";
			$content1 = $name." đã mời".' '.$data1['first_name'].' '.$data1['last_name']." tham gia lớp".' '.$class['dataitem_name']." đang chờ bạn phê duyệt";
			$userdata1 = array(
				'uid' => $user['uid'],
				'content' => $content1,
				'model' => $model,
				'action' => $action,
				'click' =>  $url1,
			);
			$this->db->insert('notify',$userdata1);
			$insert_idnt1 = $this->db->insert_id();
			$ud1 = array(
				'nid' => $insert_idnt1,
				'uid' => $data['create_by'],
			);
			$this->db->insert('notify_user', $ud1);
		}
    }
	function check_user_class($class_id,$uid){
        $logged_in = $this->session->userdata('logged_in');
 
        $this->db->where('uid',$uid);
        $user=$this->db->get('savsoft_users')->row_array();
        $cl_ids= explode(',', $user['class_id']);
        if(in_array($class_id, $cl_ids)){
            $dt = 1;
        }else{
            $dt = 0;
        }
        return $dt;
    }
	function check_friend_class($class_id,$f_id){
		$logged_in = $this->session->userdata('logged_in');
 
        $this->db->where('uid',$f_id);
        $user=$this->db->get('savsoft_users')->row_array();
        $cl_ids= explode(',', $user['class_id']);
        if(in_array($class_id, $cl_ids)){
            $dt = 1;
        }else{
            $dt = 0;
        }
        return $dt;
	}
	function check_friend1_class($class_id){
		$logged_in = $this->session->userdata('logged_in');
        $this->db->where('uid',$logged_in['uid']);
        $user=$this->db->get('savsoft_users')->row_array();
        $cl_ids= explode(',', $user['class_id']);
        if(in_array($class_id, $cl_ids)){
            $dt = 1;
        }else{
            $dt = 0;
        }
        return $dt;
	}
	
	/*function join_classst($class_id,$uid){ 
        $logged_in = $this->session->userdata('logged_in');
        $this->db->where('uid',$uid);
        $user= $this->db->get('savsoft_users')->row_array();
		$sql= "SELECT cm.create_by FROM class_metadata cm WHERE cm.class_id=$class_id ";
		$teacher = $this->db->query($sql)->row_array();
        $this->db->where('did',$class_id);
        $cl= $this->db->get('savsoft_dataitem')->row_array();
        if($user['class_id']!=''){
            $new_cl_ids.=$user['class_id'].','.$class_id;
        }
        else{
            $new_cl_ids.=$class_id;
        }
        $this->db->where('uid', $uid);
        $this->db->update('savsoft_users', array('class_id'=> $new_cl_ids));
        $this->db->insert("class_member",array("class_id"=>$class_id,"member_id"=>$uid,"deleted"=>0));
        $content = " đã chấp nhận tham gia lớp ".$cl['dataitem_name'].' !';
        $model = "class";
        $action = "join_class";
        $url = site_url('home_user/list_student_inclass/'.$class_id);
        $userdatant = array(
            'uid' => $logged_in['uid'],
            'content' => $content,
            'model' => $model,
            'action' => $action,
            'click' =>  "window.location.href='".$url."'",
            );
        $this->db->insert('notify',$userdatant);
        $insert_idnt = $this->db->insert_id();
        $ud = array(
            'nid' => $insert_idnt,
            'uid' => $teacher['create_by'],
        );
        $this->db->insert('notify_user', $ud);
    }*/
	function join_friendclassst($class_id,$uid,$f_id){
		$logged_in = $this->session->userdata('logged_in');
		$t=$logged_in['uid'];
		$dt = " SELECT su.first_name,su.last_name FROM savsoft_users su WHERE su.uid=$t";
		$teacher = $this->db->query($dt)->row_array();
		$dt1 = " SELECT su.first_name,su.last_name FROM savsoft_users su WHERE su.uid=$f_id";
		$friend = $this->db->query($dt1)->row_array();
        $this->db->where('uid',$f_id);
        $user= $this->db->get('savsoft_users')->row_array();
        $this->db->where('did',$class_id);
        $cl= $this->db->get('savsoft_dataitem')->row_array();
        if($user['class_id']!=''){
            $new_cl_ids.=$user['class_id'].','.$class_id;
        }
        else{
            $new_cl_ids.=$class_id;
        }
        $this->db->where('uid', $f_id);
        $this->db->update('savsoft_users', array('class_id'=> $new_cl_ids));
        $this->db->insert("class_member",array("class_id"=>$class_id,"member_id"=>$f_id,"deleted"=>0));
		
		
		//thông báo cho học sinh
		$content = "đã phê duyệt " .$friend ['first_name'].' '.$friend ['last_name']. " tham gia lớp ".$cl['dataitem_name'].' !';
		$model = "class";
        $action = "join_class";
        $url = site_url('home_user/list_student_inclass/'.$class_id);
        $userdatant = array(
            'uid' => $t,
            'content' => $content,
            'model' => $model,
            'action' => $action,
            'click' =>  "class_exist('".$class_id."')",
            );
        $this->db->insert('notify',$userdatant);
        $insert_idnt = $this->db->insert_id();
        $ud = array(
            'nid' => $insert_idnt,
            'uid' => $uid,
        );
        $this->db->insert('notify_user', $ud);
		
		
		//thông báo cho bạn của học sinh
		
		$content1 = "đã phê duyệt cho bạn tham gia lớp ".$cl['dataitem_name'].' !';
		$userdatant1 = array(
            'uid' => $t,
            'content' => $content1,
            'model' => $model,
            'action' => $action,
            'click' =>  "class_exist('".$class_id."')",
            );
        $this->db->insert('notify',$userdatant1);
        $insert_idnt1 = $this->db->insert_id();
        $ud1 = array(
            'nid' => $insert_idnt1,
            'uid' => $f_id,
        );
        $this->db->insert('notify_user', $ud1);
	}
    function getDate($class_id, $start, $finish){
    	// $diemdau1 = strtotime($diemdau);
    	// $diemcuoi1 = strtotime($diemcuoi);

    	$sql="SELECT cm.member_id,su.first_name,su.last_name,su.email,su.su,COUNT(cm.member_id) sum,COUNT(sa.rid) DaTL
			FROM
				class_member cm
				INNER JOIN savsoft_users su ON cm.member_id = su.uid
				LEFT JOIN savsoft_assign sa ON cm.member_id=sa.uid
				 
			WHERE
				cm.class_id = $class_id 
				AND sa.startdate >='$start'
				AND sa.startdate <=' $finish'
				AND sa.auid IN (SELECT create_by FROM class_metadata where class_id=$class_id)
			GROUP BY cm.member_id	

		";
//         $sql = "SELECT * FROM savsoft_users  INNER JOIN class_member ON savsoft_users.uid=class_member.member_id 
// where class_member.class_id=$class_id";

        $mb= $this->db->query($sql)->result_array();
        return $mb;
    }

    function class_exist($class_id){
		$sql = " SELECT sd.status FROM savsoft_dataitem sd WHERE sd.did=$class_id ";
		$data = $this->db->query($sql) -> row_array();
		return $data;
	}
    
}
?>
