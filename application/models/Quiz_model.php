<?php
Class Quiz_model extends CI_Model
{
 
  function quiz_list($limit){
	  $this->db->where('deleted',0);
	  $this->db->where('status',1);
	  $logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']=='0'){
			$gid=$logged_in['gid'];
			$where="FIND_IN_SET('".$gid."', gids)";  
			 $this->db->where($where);
			}
			
			
	 if($this->input->post('search') && $logged_in['su']=='1'){
		 $search=$this->input->post('search');
		 $this->db->or_where('quid',$search);
		 $this->db->or_like('quiz_name',$search);
		 $this->db->or_like('description',$search);

	 }
		 $this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('quid','desc');
		$query=$this->db->get('savsoft_quiz');
		return $query->result_array();
		
	 
 }
 
   function recent_quiz($limit){
		$this->db->limit($limit);
		$this->db->where('deleted',0);
		$this->db->where('status',1);
		$this->db->order_by('quid','desc');
		$query=$this->db->get('savsoft_quiz');
		return $query->result_array();
}
 
	function number_question($cid='0',$lid='0',$inserted_by='0',$s){
		$logged_in = $this->session->userdata('logged_in');
		$this->db->where('savsoft_quiz.deleted',0);
		$this->db->where('savsoft_quiz.status',1);
		if($logged_in['su'] != '1'){
			$uid=$logged_in['uid'];
			 $this->db->where('savsoft_quiz.inserted_by',$uid);
			 $this->db->or_Where('savsoft_quiz.gids',5);
			}
		if($s != ''){
			$this->db->like('savsoft_quiz.quiz_name',$s);
		}
		if($cid!='0'){
			$this->db->where('savsoft_quiz.cid',$cid);
	   }
	   if($lid!='0'){
			$this->db->where('savsoft_quiz.lid',$lid);
	   }
	   if($inserted_by!='0'){
		   $this->db->where('savsoft_quiz.inserted_by',$inserted_by);
	   }
		 $this->db->join('savsoft_category','savsoft_category.cid=savsoft_quiz.cid');
		 $this->db->join('savsoft_level','savsoft_level.lid=savsoft_quiz.lid');
		 $this->db->join('savsoft_users','savsoft_users.uid=savsoft_quiz.inserted_by');
		$query = $this->db->get('savsoft_quiz');
		return $query->num_rows();
	}
	function search_quiz($list_view='',$cid='0',$lid='0',$inserted_by='0',$page="0",$search=''){
		$logged_in = $this->session->userdata('logged_in');
		$this->db->where('savsoft_quiz.deleted',0);
	//	$this->db->where('savsoft_quiz.status',1);
		if($logged_in['su'] != '1'){
			$uid=$logged_in['uid'];
			 $this->db->where('savsoft_quiz.inserted_by',$uid);
			 $this->db->or_Where('savsoft_quiz.gids',5);
			}
		if($search != ''){
			$this->db->like('savsoft_quiz.quiz_name',$search);
		}
		if($cid!='0'){
			$this->db->where('savsoft_quiz.cid',$cid);
	   }
	   if($lid!='0'){
			$this->db->where('savsoft_quiz.lid',$lid);
	   }
	   if($inserted_by!='0'){
		   $this->db->where('savsoft_quiz.inserted_by',$inserted_by);
	   }
		$this->db->join('savsoft_users','savsoft_quiz.inserted_by=savsoft_users.uid');
		$this->db->join('savsoft_level','savsoft_quiz.lid=savsoft_level.lid');
		$this->db->join('savsoft_category','savsoft_quiz.cid=savsoft_category.cid');
		if($list_view == 'grid'){
			$this->db->limit(9);
			$this->db->offset(9*$page);
		}else{
			$this->db->limit(20);
			$this->db->offset(20*$page);
		}
		$this->db->order_by('quid','DESC');
		$query = $this->db->get('savsoft_quiz');
		return $query->result_array();
	}
	function get_array_qids($quid){
		$this->db->where('quid',$quid);
		$query=	$this->db->get('savsoft_quiz');
		return $query->row_array();
	}
	function get_quiz_in($qids='',$cid=0, $lid=0, $search="",$limit=10,$page=0){
		$offset = $limit*$page;
		$Select = "select * from quiz.savsoft_qbank inner join savsoft_category on savsoft_category.cid = savsoft_qbank.cid inner join savsoft_level on savsoft_level.lid = savsoft_qbank.lid where 1=1 ";
		if($cid > 0)
		{
			$Select .= " and savsoft_qbank.cid = $cid";
		}
		if($lid > 0){
			$Select .= " and savsoft_qbank.lid = $lid";
		}
		if($search !="")
		{
			$Select .= " and savsoft_qbank.question like '%".$search."%'";
		}
		if($qids){
			$Select .= " and qid in ($qids)";
		}
		$Select .= " limit $limit offset $offset ";
		$query = $this->db->query($Select);
		if($query !== FALSE && $query->num_rows() > 0 ){
			$data = $query->result_array();
		}else{
			$data =array();
		}
		return $data;
	}
	function num_quiz_in($qids='',$cid=0, $lid=0, $search=""){
		
		$Select = "select qid from quiz.savsoft_qbank inner join savsoft_category on savsoft_category.cid = savsoft_qbank.cid inner join savsoft_level on savsoft_level.lid = savsoft_qbank.lid where 1=1 ";
		if($cid > 0)
		{
			$Select .= " and savsoft_qbank.cid = $cid";
		}
		if($lid > 0){
			$Select .= " and savsoft_qbank.lid = $lid";
		}
		if($search !="")
		{
			$Select .= " and savsoft_qbank.question like '%$search%'";
		}
		if($qids){
			$Select .= " and qid in ($qids)";
		}
		$query = $this->db->query($Select);
		return $query->num_rows();
	}

	function get_quiz_not_in($qids='',$cid=0, $lid=0, $search="",$limit=10,$page=0){
		$user=$this->session->userdata('logged_in');
		$offset = $limit*$page;
		$Select = "select * from quiz.savsoft_qbank inner join savsoft_category on savsoft_category.cid = savsoft_qbank.cid inner join savsoft_level on savsoft_level.lid = savsoft_qbank.lid where savsoft_qbank.status=1 and savsoft_qbank.deleted=0 ";
		if($user['su']!=1){
			$Select.=" and savsoft_qbank.inserted_by=".$user['uid']." ";
		} 
		if($cid > 0)
		{
			$Select .= " and savsoft_qbank.cid = $cid";
		}
		if($lid > 0){
			$Select .= " and savsoft_qbank.lid = $lid";
		}
		if($search !="")
		{
			$Select .= " and savsoft_qbank.question like '%$search%'";
		}
		if($qids !=''){
			$Select .= " and qid not in ($qids)";
		}
		$Select .= " ORDER BY qid desc limit $limit offset $offset ";
		$query = $this->db->query($Select);
		if($query !== FALSE && $query->num_rows() > 0 ){
			$data = $query->result_array();
		}
		return $data;
	}
	function num_quiz_not_in($qids='',$cid=0, $lid=0, $search=""){
		 $user=$this->session->userdata('logged_in');
		 
		$Select = "select qid from quiz.savsoft_qbank inner join savsoft_category on savsoft_category.cid = savsoft_qbank.cid inner join savsoft_level on savsoft_level.lid = savsoft_qbank.lid where savsoft_qbank.status=1 and savsoft_qbank.deleted=0 ";
		if($user['su']!=1){
			$Select.=" and savsoft_qbank.inserted_by=".$user['uid']." ";
		} 
		if($cid > 0)
		{
			$Select .= " and savsoft_qbank.cid = $cid";
		}
		if($lid > 0){
			$Select .= " and savsoft_qbank.lid = $lid";
		}
		if($search !="")
		{
			$Select .= " and savsoft_qbank.question like '%$search%'";
		}
		if($qids !=''){
			$Select .= " and qid not in ($qids)";
		}
		$query = $this->db->query($Select);
		return $query->num_rows();
	}

	function delete_quiz($quid){
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in){
			$data=array('deleted'=>'1');
			$this->db->where('savsoft_quiz.quid', $quid);
			$this->db->update('savsoft_quiz', $data);
		}
	}

   function open_quiz($limit){
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('quid','desc');
	     $this->db->where('deleted',0);
		$query=$this->db->get('savsoft_quiz');
		return $query->result_array();
}
 
 
 function num_quiz(){
	 $this->db->where('deleted',0);
	 $this->db->where('status',1);
	 $query=$this->db->get('savsoft_quiz');
		return $query->num_rows();
 }
 
 function insert_quiz(){
	 
	 $userdata=array(
	 'quiz_name'=>$this->input->post('quiz_name'),
	 'description'=>$this->input->post('description'),
	 'start_date'=>strtotime($this->input->post('start_date')),
	 'end_date'=>strtotime($this->input->post('end_date')),
	 'duration'=>$this->input->post('duration'),
	 'maximum_attempts'=>$this->input->post('maximum_attempts'),
	 'pass_percentage'=>$this->input->post('pass_percentage'),
	 'correct_score'=>$this->input->post('correct_score'),
	 'incorrect_score'=>$this->input->post('incorrect_score'),
	 'ip_address'=>$this->input->post('ip_address'),
	 'view_answer'=>$this->input->post('view_answer'),
	 'camera_req'=>$this->input->post('camera_req'),
	 'quiz_template'=>$this->input->post('quiz_template'),
	 'with_login'=>$this->input->post('with_login'),
	 'gids'=>implode(',',$this->input->post('gids')),
	 'question_selection'=>$this->input->post('question_selection')
	 );
	 	$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
	 
	 if($this->input->post('certificate_text')){
		$userdata['certificate_text']=$this->input->post('certificate_text'); 
	 }
	 
	  if($user['su']==1 || $user['su']==224){
		 $userdata['status']=1;
	 }
	  $this->db->insert('savsoft_quiz',$userdata);
	  $quid=$this->db->insert_id();
	  
	  $unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
			); 
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			 '%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			 '%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
	
	     $q =$this->input->post('quiz_name');
		 $q =html_entity_decode( strip_tags( $q ) );
	  
		 foreach($unicode as $nonUnicode=>$uni){
			 $q = preg_replace("/($uni)/i", $nonUnicode, $q);
		 }
		
		$q = str_replace(array(' '),'-',$q);
		$q =urlencode ($q);
		$q = str_replace($comma,'',$q);
		$q = str_replace(array('%'),'',$q);
		if($q==""){
		 $q=$quid;
		}
		else
		 $q.='-'.$quid;
		while(strpos($q, '--'))
			$q = str_replace(array('--'),'-',$q);
		$this->db->insert('savsoft_permalink', array("model"=>"quiz", "content_id"=>$quid, "permalink"=>$q));
		 
	 
	return $quid;
	 
 }
 function insert_quiz_system($quiz_name,$qids,$noq,$for_uid,$day,$lid,$level_hard,$set,$mpoint, $reading_mcq,$video_mcq,$reading,$reading_title,$img_reading,$video_title,$img_video){
 	log_message('error',$video_title);
	 $qidss= $qids;
	 if($reading_mcq){
		 $qidss.= ",".$reading_mcq;
	 }
	 if($video_mcq){
		 $qidss.= ",".$video_mcq;
	 }
	 if($mpoint==1){
		$sql="select sum(points) as tp from savsoft_qbank where qid in (".$qidss.")";
		$points = $this->db->query($sql)->row_array()['tp'];
	 }
	 else{
		$points=0;
	 }
	 $userdata=array(
	 'quiz_name'=>$quiz_name,
	 //'description'=>$this->input->post('description'),
	 'start_date'=>strtotime("now"),
	 'end_date'=>strtotime("+1 year"),
	 //'duration'=>$this->input->post('duration'),
	 //'maximum_attempts'=>$this->input->post('maximum_attempts'),
	 //'pass_percentage'=>$this->input->post('pass_percentage'),
	  'correct_score'=>'1',
	 'incorrect_score'=>'0',
	 //'ip_address'=>$this->input->post('ip_address'),
	 //'view_answer'=>$this->input->post('view_answer'),
	 //'camera_req'=>$this->input->post('camera_req'),
	 //'quiz_template'=>$this->input->post('quiz_template'),
	 //'with_login'=>$this->input->post('with_login'),
	 'gids'=>'5',
	 'status'=>2,
	 'qids'=>$qids,
	 'noq'=>$noq,
	 'for_uid'=>$for_uid,
	 'day'=>$day,
	 'lid'=>$lid,
	 'cid'=>0,
	 'level_hard'=> $level_hard,
	  'system_created'=> 1,
	  'question_selection'=>0,
	  'reading_mcq'=>$reading_mcq,
	  'video_mcq'=>$video_mcq,
	  'reading'=>$reading,
	  'reading_title'=>$reading_title,
	  'img_reading'=>$img_reading,
	  'video_title'=>$video_title,
	  'img_video'=>$img_video,
	  'set'=>$set,
	  'points'=>$points
	  
	 );
	 //	$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
	 
	 /*if($this->input->post('certificate_text')){
		$userdata['certificate_text']=$this->input->post('certificate_text'); 
	 }*/
	 
	 
	  $this->db->insert('savsoft_quiz',$userdata);
	  $quid=$this->db->insert_id();
	  
	  $unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
			); 
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			 '%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			 '%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
	
	     $q =$quiz_name;
		 $q =html_entity_decode( strip_tags( $q ) );
	  
		 foreach($unicode as $nonUnicode=>$uni){
			 $q = preg_replace("/($uni)/i", $nonUnicode, $q);
		 }
		
		$q = str_replace(array(' '),'-',$q);
		$q =urlencode ($q);
		$q = str_replace($comma,'',$q);
		$q = str_replace(array('%'),'',$q);
		if($q==""){
		 $q=$quid;
		}
		else
		 $q.='-'.$quid;
		while(strpos($q, '--'))
			$q = str_replace(array('--'),'-',$q);
		$this->db->insert('savsoft_permalink', array("model"=>"quiz", "content_id"=>$quid, "permalink"=>$q));
		log_message("error", "xxxxxxxxxxxuuuuuuuuuuuuuuuuuuuxxx".$quid);
	 
	return $quid;
	 
 }
 
 function insert_quiz_user_custom($quiz_name,$qids,$noq,$inserted_by, $inserted_by_name){
	 $sql="select sum(points) as tp from savsoft_qbank where qid in (".$qids.")";
	 $points = $this->db->query($sql)->row_array()['tp'];
	 $userdata=array(
	 'quiz_name'=>$quiz_name,
	 //'description'=>$this->input->post('description'),
	 'start_date'=>strtotime("now"),
	 'end_date'=>strtotime("+1 year"),
	 //'duration'=>$this->input->post('duration'),
	 //'maximum_attempts'=>$this->input->post('maximum_attempts'),
	 //'pass_percentage'=>$this->input->post('pass_percentage'),
	 'inserted_by'=>$inserted_by,
	 'inserted_by_name'=>$inserted_by_name,
	  'correct_score'=>'1',
	 'incorrect_score'=>'0',
	 //'ip_address'=>$this->input->post('ip_address'),
	 //'view_answer'=>$this->input->post('view_answer'),
	 //'camera_req'=>$this->input->post('camera_req'),
	 //'quiz_template'=>$this->input->post('quiz_template'),
	 //'with_login'=>$this->input->post('with_login'),
	 'gids'=>'5',
	 'status'=>2,
	 'qids'=>$qids,
	 'noq'=>$noq,
	 //'for_uid'=>$uid,
	 //'day'=>$day,
	 'lid'=>0,
	 'cid'=>0,
	 //'level_hard'=> $level_hard,
	 // 'system_created'=> 1,
	  'question_selection'=>0,
	  "point"=>$point
	 );
	 //	$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
	 
	 /*if($this->input->post('certificate_text')){
		$userdata['certificate_text']=$this->input->post('certificate_text'); 
	 }*/
	 
	 
	  $this->db->insert('savsoft_quiz',$userdata);
	  $quid=$this->db->insert_id();
	  
	  $unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
			); 
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			 '%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			 '%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
	
	     $q =$quiz_name;
		 $q =html_entity_decode( strip_tags( $q ) );
	  
		 foreach($unicode as $nonUnicode=>$uni){
			 $q = preg_replace("/($uni)/i", $nonUnicode, $q);
		 }
		
		$q = str_replace(array(' '),'-',$q);
		$q =urlencode ($q);
		$q = str_replace($comma,'',$q);
		$q = str_replace(array('%'),'',$q);
		if($q==""){
		 $q=$quid;
		}
		else
		 $q.='-'.$quid;
		while(strpos($q, '--'))
			$q = str_replace(array('--'),'-',$q);
		$this->db->insert('savsoft_permalink', array("model"=>"quiz", "content_id"=>$quid, "permalink"=>$q));
		 
	 
	return $quid;
	 
 }
 
 
 function update_quiz($quid){
	 
	 $userdata=array(
	 'quiz_name'=>$this->input->post('quiz_name'),
	 'description'=>$this->input->post('description'),
	 'start_date'=>strtotime($this->input->post('start_date')),
	 'end_date'=>strtotime($this->input->post('end_date')),
	 'duration'=>$this->input->post('duration'),
	 'maximum_attempts'=>$this->input->post('maximum_attempts'),
	 'pass_percentage'=>$this->input->post('pass_percentage'),
	 'correct_score'=>$this->input->post('correct_score'),
	 'incorrect_score'=>$this->input->post('incorrect_score'),
	 'ip_address'=>$this->input->post('ip_address'),
	 'view_answer'=>$this->input->post('view_answer'),
	 'camera_req'=>$this->input->post('camera_req'),
	  'quiz_template'=>$this->input->post('quiz_template'),
	'with_login'=>$this->input->post('with_login'),
	 'gids'=>implode(',',$this->input->post('gids'))
	 );
	  	 	 
		$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
	  
	 if($this->input->post('certificate_text')){
		$userdata['certificate_text']=$this->input->post('certificate_text'); 
	 }
 
	  $this->db->where('quid',$quid);
	  $this->db->update('savsoft_quiz',$userdata);
	   $unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
			); 
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			 '%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			 '%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
	
	     $q =$this->input->post('quiz_name');
		 $q =html_entity_decode( strip_tags( $q ) );
	  
		 foreach($unicode as $nonUnicode=>$uni){
			 $q = preg_replace("/($uni)/i", $nonUnicode, $q);
		 }
		
		$q = str_replace(array(' '),'-',$q);
		$q =urlencode ($q);
		$q = str_replace($comma,'',$q);
		$q = str_replace(array('%'),'',$q);
		if($q==""){
		 $q=$quid;
		}
		else
		 $q.='-'.$quid;
		while(strpos($q, '--'))
			$q = str_replace(array('--'),'-',$q);
		$this->db->where("content_id",$quid);
		$this->db->update('savsoft_permalink', array("model"=>"quiz", "content_id"=>$quid, "permalink"=>$q));
	  $this->db->where('quid',$quid);
	  $query=$this->db->get('savsoft_quiz',$userdata);
	 $quiz=$query->row_array();
	 if($quiz['question_selection']=='1'){
		 
	  $this->db->where('quid',$quid);
	  $this->db->delete('savsoft_qcl');
                $correct_i=array();
        	 $incorrect_i=array();	 
	 foreach($_POST['cid'] as $ck => $val){
		 if(isset($_POST['noq'][$ck])){
			 if($_POST['noq'][$ck] >= '1'){
		 $userdata=array(
		 'quid'=>$quid,
		 'cid'=>$val,
		 'lid'=>$_POST['lid'][$ck],
		 'i_correct'=>$_POST['i_correct'][$ck],
		 'i_incorrect'=>$_POST['i_incorrect'][$ck],
		 'noq'=>$_POST['noq'][$ck]
		 );
		 $this->db->insert('savsoft_qcl',$userdata);
		  for($i=1; $i<=$_POST['noq'][$ck]; $i++){
$correct_i[]=$_POST['i_correct'][$ck];
$incorrect_i[]=$_POST['i_incorrect'][$ck];
}
		 }
		 }
	 }
		 $userdata=array(
		 'noq'=>array_sum($_POST['noq']),
		 'correct_score'=>implode(',',$correct_i),
		 'incorrect_score'=>implode(',',$incorrect_i)
	);
	 $this->db->where('quid',$quid);
	  $this->db->update('savsoft_quiz',$userdata);
	 }else{
			$correct_i=array();
			 $incorrect_i=array();
 foreach($_POST['i_correct'] as $ck =>$cv){
$correct_i[]=$_POST['i_correct'][$ck];
$incorrect_i[]=$_POST['i_incorrect'][$ck];
}

	 $userdata=array(
		 'correct_score'=>implode(',',$correct_i),
		  'incorrect_score'=>implode(',',$incorrect_i)
		 
			);
	  $this->db->where('quid',$quid);
	  $this->db->update('savsoft_quiz',$userdata);


}
	return $quid;
	 
 }
  function get_questions_1($quid){
	$this->db->where('quid', $quid);
	$quiz=$this->db->get('savsoft_quiz');
	if($quiz->num_rows()>0){
		$qids= $quiz->row_array()['qids'];
		if($qids == ''){
		$qids=0; 
		}
  
	 $query=$this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid join savsoft_level on savsoft_level.lid=savsoft_qbank.lid 
	 where savsoft_qbank.qid in ($qids)  order by FIELD(savsoft_qbank.qid,$qids) 
	 ");
	 return $query->result_array();
	}
	else
		return array();
 }
 function get_questions_10($qids){
	  $user=$this->session->userdata('logged_in');
	 if($qids == ''){
		$qids=0; 
	 }else{
		 $qids=$qids;
	 }
	  
	 $query=$this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid join savsoft_level on savsoft_level.lid=savsoft_qbank.lid 
	 where savsoft_qbank.qid in ($qids) order by FIELD(savsoft_qbank.qid,$qids) 
	 ");
	 $data=$query->result_array();

	 return $data;
	 
	 
 }
 function get_questions($qids){
	  $user=$this->session->userdata('logged_in');
	 if($qids == ''){
		$qids=0; 
	 }else{
		 $qids=$qids;
	 }
	  
	 $query=$this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid join savsoft_level on savsoft_level.lid=savsoft_qbank.lid 
	 where savsoft_qbank.qid in ($qids) order by FIELD(savsoft_qbank.qid,$qids) 
	 ");
	 $data=$query->result_array();

	for($i=0; $i<count($data); $i++){
		    $origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			if(strpos($htmlContent,'https://latex.codecogs.com')===false){
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 
				 if($origImageSrc){
					 $qt='<div class="imgqtt">'.$imgTags[0][0].'</div>';
					 $qt.=strip_tags($data[$i]['question']);
					 $data[$i]['question']=$qt;
					  
				 }
				$data[$i]['img']=$origImageSrc;
			}
			/*$this->db->where('qid',$data[$i]['qid']);
			$options = $this->db->get('savsoft_options');
			$data[$i]['options']=$options->result_array();*/

			$this->db->where('qid',$data[$i]['qid']);
			$data[$i]['n_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$data[$i]['qid']);
			$this->db->where('istrue',1);
			$data[$i]['n_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('uid !=', $user['uid']);
			$this->db->where('status', 1);
			$data[$i]['n_like']=$this->db->get('savsoft_like')->num_rows();
			
			$this->db->from('posts p');
			$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
			$this->db->where('p.model','qbank');
			$this->db->where('p.wall_id',$data[$i]['qid']);
			$this->db->where('p.parent_id', 0);
			$this->db->limit(2);
			$this->db->order_by("p.create_date", "desc");
			$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,photo");
			$data[$i]['comment'] =$this->db->get()->result_array();
			$this->db->select('status');
			$this->db->where('model','qbank');
			$this->db->where('content_id',$data[$i]['qid']);
			$this->db->where('uid',$user['uid']);
			$data[$i]['liked']=$this->db->get('savsoft_like')->row_array()['status'];
		}
	 return $data;
 }
 
 
  function get_questions_rs($qids){
	  $user=$this->session->userdata('logged_in');
	 if($qids == ''){
		$qids=0; 
	 }else{
		 $qids=$qids;
	 }
	  
	 $query=$this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid join savsoft_level on savsoft_level.lid=savsoft_qbank.lid 
	 where savsoft_qbank.qid in ($qids) order by FIELD(savsoft_qbank.qid,$qids) 
	 ");
	 $data=$query->result_array();
     for($i=0; $i<count($data); $i++){
		    $origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			if(strpos($htmlContent,'https://latex.codecogs.com')===false){
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 
				 if($origImageSrc){
					 $qt='<div class="imgqtt">'.$imgTags[0][0].'</div>';
					 $qt.=strip_tags($data[$i]['question']);
					 $data[$i]['question']=$qt;
					  
				 }
				$data[$i]['img']=$origImageSrc;
			}
	 }
	 return $data;
 }
 function get_options($qids){
	 
	 $query=$this->db->query("select * from savsoft_options where qid in ($qids) order by FIELD(savsoft_options.qid,$qids)");
	 return $query->result_array();
	 
 }
 
 
 function get_questions_options($qids){
	
	 if($qids == ''){
		$qids=0; 
	 }else{
		 $qids=$qids;
	 }
/*
	 if($cid!='0'){
		 $this->db->where('savsoft_qbank.cid',$cid);
	 }
	 if($lid!='0'){
		 $this->db->where('savsoft_qbank.lid',$lid);
	 }
*/
	  
	 $qt_list=$this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid join savsoft_level on savsoft_level.lid=savsoft_qbank.lid 
	 where savsoft_qbank.qid in ($qids) order by FIELD(savsoft_qbank.qid,$qids) 
	 ")->result_array();
	 $str_qids="";
	 for($i=0; $i<count($qt_list); $i++){
		if($i!=0)
			$str_qids.=",";
		$str_qids.=$qt_list[$i]['qid'];
		
	 }
	 $sqlo = "select * from savsoft_options where qid in ($str_qids)";
	 $ao = $this->db->query($sqlo)->result_array();
			 
	 
	 for($k=0; $k<count($qt_list); $k++){
		$qt_list[$k]['question'] =str_replace('src="..', 'src="'.base_url(),$qt_list[$k]['question']);
		$this->db->where("qid", $qt_list[$k]['qid']);
		//$qt_list[$k]['options']= $this->db->get("savsoft_options")->result_array();
		 $arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $qt_list[$k]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
		 $qt_list[$k]['options']=$arr_op;
	 }
	 return $qt_list;
	 
	 
 }
 
 function get_questions_options2($qids){
	
	 if($qids == ''){
		$qids=0; 
	 }else{
		 $qids=$qids;
	 }
/*
	 if($cid!='0'){
		 $this->db->where('savsoft_qbank.cid',$cid);
	 }
	 if($lid!='0'){
		 $this->db->where('savsoft_qbank.lid',$lid);
	 }
*/
	  
	 $qt_list=$this->db->query("select qid,question,source from savsoft_qbank 
	 where savsoft_qbank.qid in ($qids) order by FIELD(savsoft_qbank.qid,$qids) 
	 ")->result_array();
	 $str_qids="";
	 for($i=0; $i<count($qt_list); $i++){
		if($i!=0)
			$str_qids.=",";
		$str_qids.=$qt_list[$i]['qid'];
		
	 }
	 $sqlo = "select oid,qid,q_option,score from savsoft_options where qid in ($str_qids)";
	 $ao = $this->db->query($sqlo)->result_array();
			 
	 
	 for($k=0; $k<count($qt_list); $k++){
		$qt_list[$k]['question'] =str_replace('src="..', 'src="'.base_url(),$qt_list[$k]['question']);
		$this->db->where("qid", $qt_list[$k]['qid']);
		//$qt_list[$k]['options']= $this->db->get("savsoft_options")->result_array();
		 $arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $qt_list[$k]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
		 $qt_list[$k]['options']=$arr_op;
	 }
	 return $qt_list;
	 
	 
 }
 
  function get_questions_options3($qids){
	
	 if($qids == ''){
		$qids=0; 
	 }else{
		 $qids=$qids;
	 }  
	 $qt_list=$this->db->query("select qid,question,cid from savsoft_qbank 
	 where savsoft_qbank.qid in ($qids) order by FIELD(savsoft_qbank.qid,$qids) 
	 ")->result_array();
	 $str_qids="";
	 $array_map= array('0'=>"",'3'=>"Toán",'4'=>"Vật lý",'5'=>"Hóa học",'6'=>"Địa lý",'7'=>"Tin học", '8'=>"Sinh học", '9'=>'Khoa học', '10'=>"Lịch sử",'11'=>"Công nghệ",
	                '12'=>'Tiếng Anh','13'=>'Thiên văn - vũ trụ','14'=>'Robot','15'=>'Môi trường','16'=>'Sức khỏe','17'=>'Ngữ văn','18'=>'Tiếng Việt','19'=>'Xã hội','20'=>'Test IQ','21'=>'Giáo dục công dân','22'=>'Tự nhiên và xã hội','23'=>'Lịch sử và địa lý','24'=>'Thể dục','25'=>'Âm nhạc','26'=>'Chào cờ','27'=>'Sinh hoạt','28'=>'Tự học');
	 
	 
	 $cid= array();
	 $cid_ar= array();
	 $res= array();
	 for($i=0; $i<count($qt_list); $i++){
		if($i!=0)
			$str_qids.=",";
		$str_qids.=$qt_list[$i]['qid'];
		
		if(!in_array($qt_list[$i]['cid'],$cid)){
			array_push($cid,$qt_list[$i]['cid']);
			array_push($cid_ar,array());
		}
		
	 }
	 $sqlo = "select oid,qid,q_option,score from savsoft_options where qid in ($str_qids)";
	 $ao = $this->db->query($sqlo)->result_array();
			 
	 
	 for($k=0; $k<count($qt_list); $k++){
        
		$qt_list[$k]['question'] =str_replace('src="..', 'src="'.base_url(),$qt_list[$k]['question']);
		$this->db->where("qid", $qt_list[$k]['qid']);
		 $arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $qt_list[$k]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
		 $qt_list[$k]['options']=$arr_op;
		 
		 
		 $index=array_search($qt_list[$k]['cid'],$cid);
	     array_push($cid_ar[$index], $qt_list[$k]);
	 }
	 
	foreach($cid_ar as $k=>$d){
		array_push($res, array("subject"=>$array_map[$cid[$k]],"question"=>$d)); 
	}
	 $ind=0;
	 foreach($res as $k=>$rs){
		  foreach($rs['question'] as $i=>$q){
			  $res[$k]['question'][$i]['index']=$ind;
			  $ind++;
		  }
	 }
	 
	 return $res;
	 
	 
 }
 function up_question($quid,$qid){
  	$this->db->where('quid',$quid);
 	$query=$this->db->get('savsoft_quiz');
 	$result=$query->row_array();
 	$qids=$result['qids'];
 	if($qids==""){
 	$qids=array();
 	}else{
 	$qids=explode(",",$qids);
 	}
 	$qids_new=array();
 	foreach($qids as $k => $qval){
 	if($qval == $qid){

 	$qids_new[$k-1]=$qval;
	$qids_new[$k]=$qids[$k-1];
	
 	}else{
	$qids_new[$k]=$qval;
 	
	}
 	}
 	
 	$qids=array_filter(array_unique($qids_new));
 	$qids=implode(",",$qids);
 	$userdata=array(
 	'qids'=>$qids
 	);
 		$this->db->where('quid',$quid);
	$this->db->update('savsoft_quiz',$userdata);

}



function down_question($quid,$qid){
  	$this->db->where('quid',$quid);
 	$query=$this->db->get('savsoft_quiz');
 	$result=$query->row_array();
 	$qids=$result['qids'];
 	if($qids==""){
 	$qids=array();
 	}else{
 	$qids=explode(",",$qids);
 	}
 	$qids_new=array();
 	foreach($qids as $k => $qval){
 	if($qval == $qid){

 	$qids_new[$k]=$qids[$k+1];
$kk=$k+1;
	$kv=$qval;
 	}else{
	$qids_new[$k]=$qval;
 	
	}

 	}
 	$qids_new[$kk]=$kv;
	
 	$qids=array_filter(array_unique($qids_new));
 	$qids=implode(",",$qids);
 	$userdata=array(
 	'qids'=>$qids
 	);
 		$this->db->where('quid',$quid);
	$this->db->update('savsoft_quiz',$userdata);

}




function get_qcl($quid){
	
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('savsoft_qcl');
	 return $query->result_array();
	
}

 function remove_qid($quid,$qid){
	 
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('savsoft_quiz');
	 $quiz=$query->row_array();
	 $new_qid=array();
	 foreach(explode(',',$quiz['qids']) as $key => $oqid){
		 
		 if($oqid != $qid){
			$new_qid[]=$oqid; 
			 
		 }
		 
	 }
	 $noq=count($new_qid);
	 if($noq>0){
		 $sql = "Select distinct cid from savsoft_qbank where qid in (". implode(',',$new_qid). ")";
		 $query= $this->db->query($sql);
		if($query->num_rows()>1){
			$cid=0;
		}
		else 
			$cid =$query->row_array()['cid'];
		$sql = "Select distinct lid from savsoft_qbank where qid in (". implode(',',$new_qid). ")";
		$query= $this->db->query($sql);
		if($query->num_rows()>1){
			$lid=0;
		}
		else 
			$lid =$query->row_array()['lid'];
	 }
	 $qids=implode(',',$new_qid);
	 $sql="select sum(points) as tp from savsoft_qbank where qid in (".$qids.")";
	 $points = $this->db->query($sql)->row_array()['tp'];
	 $userdata=array(
	 'qids'=>$qids,
	 'noq'=>$noq,
	 'cid'=>$cid,
	 'lid'=>$lid,
	 "points"=>$points
	 );
	 $this->db->where('quid',$quid);
	 $this->db->update('savsoft_quiz',$userdata);
	 return true;
 }
 
  function add_qid($quid,$qid){
	 
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('savsoft_quiz');
	 $quiz=$query->row_array();
	 $new_qid=array();
	 $new_qid[]=$qid;
	 foreach(explode(',',$quiz['qids']) as $key => $oqid){
		 
		 if($oqid != $qid){
			$new_qid[]=$oqid; 
			 
		 }
		 
	 }
	 $new_qid=array_filter(array_unique($new_qid));
	 $noq=count($new_qid);
	 if($noq>0){
		 $sql = "Select distinct cid from savsoft_qbank where qid in (". implode(',',$new_qid). ")";
		 $query= $this->db->query($sql);
		if($query->num_rows()>1){
			$cid=0;
		}
		else 
			$cid =$query->row_array()['cid'];
		$sql = "Select distinct lid from savsoft_qbank where qid in (". implode(',',$new_qid). ")";
		$query= $this->db->query($sql);
		if($query->num_rows()>1){
			$lid=0;
		}
		else 
			$lid =$query->row_array()['lid'];
	 }
	 $qids=implode(',',$new_qid);
	 $sql="select sum(points) as tp from savsoft_qbank where qid in (".$qids.")";
	 $points = $this->db->query($sql)->row_array()['tp'];
	 $userdata=array(
	 'qids'=>$qids,
	 'noq'=>$noq,
	 'cid'=>$cid,
	 'lid'=>$lid,
	 "points"=>$points
	 );
	 $this->db->where('quid',$quid);
	 $this->db->update('savsoft_quiz',$userdata);
	 return true;
 }
 

 
 function get_quiz($quid){
	 $this->db->where('quid',$quid);
	 $this->db->where('deleted',0);
	 $query=$this->db->get('savsoft_quiz');
	 return $query->row_array();
	 
	 
 } 
  function get_quiz2($quid){
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('savsoft_quiz');
	 return $query->row_array();
	 
	 
 } 
 
 function get_id_fun_quiz(){
	  $now= time()+7*60*60;
	 $sql ='SELECT quid FROM `savsoft_quiz` WHERE noq > 3 AND deleted=0 AND status=1 AND start_date <'.$now.' AND end_date >'.$now.' AND SUBSTRING_INDEX(qids, ",", 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) AND SUBSTRING_INDEX(SUBSTRING_INDEX(qids, ",", 2),",",- 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) AND SUBSTRING_INDEX(SUBSTRING_INDEX(qids, ",", 3),",",- 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) AND SUBSTRING_INDEX(SUBSTRING_INDEX(qids, ",", 4),",",- 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) ORDER BY modify_date DESC LIMIT 25 OFFSET 1';
	 $query=$this->db->query($sql)->result_array();
	 $quids="";
	  for($k=0; $k<count($query); $k++){
		  if($k>0)
			$quids.=','.$query[$k]['quid'];
		  else
			 $quids.=$query[$k]['quid']; 
	  } 
	  
	  return $quids;
 }
 
 

 function get_quiz_block($quid){
    $user=$this->session->userdata('logged_in');
	if($user){
		$this->db->insert("user_views", array("model"=>"quiz", "content_id"=>$quid, "uid"=>$user["uid"]));
	}
	$this->db->where('quid', $quid);
	$quiz_fun = $this->db->get('savsoft_quiz')->row_array();
    
	 $quids_arr = explode(",",$quiz_fun['qids'],5 );
	 $qids=$quids_arr[0];
	 for($i=1; $i<4; $i++){
		 $qids.=','.$quids_arr[$i];
	 }
	 $this->db->where('content_id',$quiz_fun['quid'] );
	$this->db->where('model','quiz');
	$quiz_fun['permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
	 $sql = "select question,background_template from savsoft_qbank where deleted =0 and qid in ($qids)  ";
	 $quiz_fun['question']= $this->db->query($sql)->result_array();
	 
	 $this->db->select('status');
	 $this->db->where('model','quiz');
	 $this->db->where('content_id',$quid);
	 $this->db->where('uid',$user['uid']);
	 $quiz_fun['liked']=$this->db->get('savsoft_like')->row_array()['status'];
	 $this->db->where('model', 'quiz');
	$this->db->where('content_id', $quid);
	$this->db->where('uid !=', $user['uid']);
	$this->db->where('status', 1);
	$quiz_fun['n_like']=$this->db->get('savsoft_like')->num_rows();
	
	$this->db->from('posts p');
	$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
	$this->db->where('p.model','quiz');
	$this->db->where('p.wall_id',$quid);
	$this->db->where('p.parent_id', 0);
	$this->db->limit(2);
	$this->db->order_by("p.create_date", "desc");
	$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,photo");
	$quiz_fun['comment'] =$this->db->get()->result_array();

	
	 for($i=0; $i<count($quiz_fun['question']); $i++){
		 $origImageSrc="";
		 $origvidSrc="";
		 $htmlContent=$quiz_fun['question'][$i]['question'];
		 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
		 for ($j = 0; $j < count($imgTags[0]); $j++) {
			preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
			$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
			
		 }
		 if($origImageSrc)
			$quiz_fun['question'][$i]['img']=$origImageSrc;
		  else
			 $quiz_fun['question'][$i]['img']=base_url("upload/default_image_quiz.png");
		 preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
		 for ($j = 0; $j < count($vidTags[0]); $j++) {
			preg_match('/src="([^"]+)/i',$vidTags[0][$j], $video);
			$origvidSrc = str_ireplace( 'src="', '',  $video[0]);
			
		 }
		 if(count($video)>0)
			$quiz_fun['question'][$i][$i]['video']=$origvidSrc;
		  else
			 $quiz_fun['question'][$i]['video']="";
	 }
	 
	 
	$html= '<div class="box-bor-quiz mb-20">';
	if($user){
		$html.= '<h3 class="mt-0">Hoạt động: <a href="'.site_url('quiz/validate_quiz/'.$quid).'">'.$quiz_fun['quiz_name'].'</a></h3>';
	}
	else{
		$html.= '<h3 class="mt-0">Bài trắc nghiệm: <a class="pointer" href="'.site_url('page/quiz/'.$quiz_fun['permalink']).'">'.$quiz_fun['quiz_name'].'</a></h3>';
	}
	
	$html.= '<div class="row hidden-xs">';
    foreach($quiz_fun['question'] as $k=>$qf){
		if($user){	
			
			$html.='<a class="col-md-3 col-xs-6 mb-10" href="'.site_url('quiz/validate_quiz/'.$quiz_fun['quid']).'"><img class="img-responsive img_quiz" src="'. str_replace('..',base_url(), $qf['img']).'" alt=""></a>';
		}
		else{
			
			$html.='<a class="col-md-3 col-xs-6 mb-10" href="'.site_url('quiz/validate_quiz/'.$quiz_fun['quid']).'"><img class="img-responsive img_quiz" src="'. str_replace('..',base_url(), $qf['img']).'" alt=""></a>';
		}
		
	 }		 
	$html.= '</div>';
	$html.= '<div class="hidden-lg">';
	$html.= '<div class="row">';
    foreach($quiz_fun['question'] as $k=>$qf){
		if($k<2){
			if($user){
				$html.='<a class="col-md-3 col-xs-6 mb-10" href="'.site_url('quiz/validate_quiz/'.$quiz_fun['quid']).'"><img class="img-responsive img_quiz" src="'.str_replace('..',base_url(), $qf['img']).'" alt=""></a>';
			}
			else{
				$html.='<a class="col-md-3 col-xs-6 mb-10" class="pointer"  href="'.site_url('page/quiz/'.$quiz_fun['permalink']).'><img class="img-responsive img_quiz" src="'.str_replace('..',base_url(), $qf['img']).'" alt=""></a>';
			}
			
	     }}		 
	$html.= '</div>';
	$html.= '<div class="row">';
	foreach($quiz_fun['question'] as $k=>$qf){
		if($k>=2){
			if($user){
				$html.='<a class="col-md-3 col-xs-6 mb-10" href="'.site_url('quiz/validate_quiz/'.$quiz_fun['quid']).'"><img class="img-responsive img_quiz" src="'.str_replace('..',base_url(), $qf['img']).'" alt=""></a>';
			}
			else{
				$html.='<a class="col-md-3 col-xs-6 mb-10" class="pointer" href="'.site_url('page/quiz/'.$quiz_fun['permalink']).'"><img class="img-responsive img_quiz" src="'.str_replace('..',base_url(), $qf['img']).'" alt=""></a>';
			}
	     }}	
					 
	$html.= '</div>';
	$html.= '</div>';
	/*if($user){
		$html.='<div class="col-xs-12 bo-tb">';
		$html.='<div class="row">';
		$html.='<div class="col-xs-12" style="margin-bottom:5px">';
		$html.='<ul class="list-inline text-bt">';
		if($quiz_fun['liked']==1){
			$html.=	'<li class="';
			if($user['su']==2 || $user['su']==5){
				$html.='col-xs-4';
			}else{
				$html.='col-xs-3';
			}
			$html.='"><a class="acti pointer" onclick="like_quiz(this,'.$quiz_fun['quid'].')" ><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>';
	    } else{
			$html.=	'<li class="';
			if($user['su']==2 || $user['su']==5){
				$html.='col-xs-4';
			}else{
				$html.='col-xs-3';
			}
			$html.='"><a class="pointer" onclick="like_quiz(this,'.$quiz_fun['quid'].')"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs"> Thích</span></a></li>';
		}
		$html.=	'<li class="';
			if($user['su']==2 || $user['su']==5){
				$html.='col-xs-4';
			}else{
				$html.='col-xs-3';
			}
			$html.='"><a class="pointer" data-toggle="collapse" data-target="#comment_quiz_main_'.$quiz_fun['quid'].'" ><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs">Bình luận</span></a></li>';
		$html.='<li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquiz%2F'.$quiz_fun['permalink'].'&amp;src=sdkpreparse" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\');count_share2('.$quiz_fun['quid'].'); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs">Chia sẻ</span></a></li>';					  
		$html.='</li>';
		if($user['su']!=2 && $user['su']!=5){
			$html.='<li class="col-xs-3">';
			$html.=	'<a class="pointer"  onclick="changeassign('.$quiz_fun['quid'].', '.$user['su'].')"><i class="fas fa-share-square mr-5"></i><span class="hidden-xs"> Đố </span></a>';
			$html.=	'</li>';
		}
		$html.=	'</ul>';
		$html.=	'</div>';					   
		$html.=	'</div>';
		$html.=	'</div>';
		$html.=	'<div id="like_statistic_quiz_'.$quiz_fun['quid'].'">';
		if($quiz_fun['liked']==1|| $quiz_fun['n_like']>0 ){
			$html.=	'<div class="col-xs-12 bo-B" >';		 
			$html.=	'<i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>';
			$html.=	'<a class="f10">';
			if($quiz_fun['liked']==1){				 
				if($quiz_fun['n_like'] >0) {
					$html.=	'Bạn và';
				} else {
					$html.=	$user['first_name'].' '.$user['last_name'];
				}
			}
			if($quiz_fun['n_like'] >0) {
				$html.=	" ".$quiz_fun['n_like'].' người' ;
			}
			$html.=	'</a>';
			$html.=	'</div>';
		}
		$html.='</div>';
		 if($quiz_fun['share_count']>0){
			$html.=	'<div class="col-xs-12">';
			$html.=	'<p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i>'.$quiz_fun['share_count'].' lượt chia sẻ</p>';
			$html.=	'</div>';
		}
		$html.='<div class="col-xs-12 collapse" id="comment_quiz_main_'. $quiz_fun['quid'].'">';
		$html.='<div class="media-object-default">';
		$html.='<div class="media">';
		$html.='<div class="media-left">';
		$html.='<a href="#">';
		if($user['photo']){ 
			$html.='<img class="media-object img-circle" src="'.$user['photo'].'" width="36" alt="placeholder image">';
		} else{    
			$html.='<img class="media-object img-circle" src="'.base_url('upload/avatar/default.png').'" width="36" alt="placeholder image">';
		}					   
		$html.='</a>';
		$html.='</div>';
		$html.='<div class="media-body" >';
		$html.='<input type="text" class="form-control bo-input inp_comment" onkeyup="write_comment(this,event,\'quiz\','.$quiz_fun['quid'].')" placeholder="Bình luận">';
		$html.='</div>';
		$html.='</div>';
		$html.='</div>';
		$html.='</div>';
		$html.='<div class="col-xs-12">';
		$html.='<div class="box-commen" style="margin-top:20px;" id="box_comment_quiz_'.$quiz_fun['quid'].'">';
		$html.='<div class="media-object-default">';
		foreach($quiz_fun['comment'] as $cmt){
			$html.='<div class="media">';
			$html.='<div class="media-left">';
			$html.='<a href="#">';
			if($cmt['photo']) { 
				$html.='<img class="media-object img-circle" src="'.$cmt['photo'].'" width="36" alt="placeholder image">';
            } else{    
				$html.='<img class="media-object img-circle" src="'.base_url('upload/avatar/default.png').'" width="36" alt="placeholder image">';
            }  
			$html.='</a>';
			$html.='</div>';
			$html.='<div class="media-body">';
			$html.='<h4 class="media-heading"><a href="">'.$cmt['first_name']." ".$cmt['last_name'].'</a></h4>';
			$html.=$cmt['content']; 	
			$html.='</div>';					
			$html.='</div>';
        } 
		$html.='</div>';
		$html.='</div>';
		$html.='</div>';
	}
	else{
		$html.='<div class="col-xs-12 bo-tb">';
		$html.='<div class="row">';
		$html.='<div class="col-xs-12" style="margin-bottom:5px">';
		$html.='<ul class="list-inline text-bt">';
		$html.='<li class="col-xs-3"><a class="pointer"  onclick="popup_require_login4('.$quiz_fun['quid'].')"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>';
		$html.='<li class="col-xs-3"><a class="pointer" onclick="popup_require_login4('.$quiz_fun['quid'].')"><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs"> Bình luận </span></a></li>';
		$html.='<li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquiz%2F'.$quiz_fun['permalink'].'&amp;src=sdkpreparse" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\');count_share2('. $quiz_fun['quid'].'); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs">Chia sẻ</span></a></li>';
		$html.='<li class="col-xs-3">';
		$html.='<a class="assign-bt pointer" onclick="popup_require_login4('.$quiz_fun['quid'].')"><i class="fas fa-share-square mr-5"></i><span class="hidden-xs"> Đố </span></a>';
		$html.='</li>';
		$html.='</ul>';
		$html.='</div>';			 
		$html.='</div>';
		$html.='</div>';
		$html.='<div id="like_statistic_quiz'.$quiz_fun['quid'].'">';
        if( $quiz_fun['n_like']>0 ){
			$html.='<div class="col-xs-12 bo-B" >' ;
			$html.='<i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>';
			$html.='<a class="f10" href="#">';
			$html.=" ".$quiz_fun['n_like'].' người';
			$html.='</a>';
			$html.='</div>';
		}
			$html.='</div>';
		if($quiz_fun['share_count']>0){
			$html.='<div class="col-xs-12">';
			$html.='<p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i>'.$quiz_fun['share_count'].' lượt chia sẻ</p>';
			$html.='</div>';
	    } 
	}
    $html.='<div class="col-xs-12">';
	$html.='<div class="box-commen" style="margin-top:20px;" id="box_comment_quiz_'.$quiz_fun['quid'].'">';
	$html.=	'<div class="media-object-default">';
    foreach($quiz_fun['comment'] as $cmt){ 
		$html.=	'<div class="media">';
		$html.=	'<div class="media-left">';
		$html.=	'<a href="#">';
		if($cmt['photo']) { 
			$html.='<img class="media-object img-circle" src="'.$cmt['photo'].'" width="36" alt="placeholder image">';
		} else{   
			$html.='<img class="media-object img-circle" src="'.base_url('upload/avatar/default.png').'" width="36" alt="placeholder image">';
		} 
		$html.='</a>';
		$html.='</div>';
		$html.='<div class="media-body">';
		$html.='<h4 class="media-heading"><a href="">'.$cmt['first_name']." ".$cmt['last_name'].'</a></h4>';
		$html.=$cmt['content'];								
		$html.=	'</div>';								
		$html.=	'</div>';
                          
	}
	$html.=	'</div>';
	$html.=	'</div>';
	$html.=	'</div>';*/
	
	$html.= '</div>';
	return $html;
 }
 function get_quiz_right_bar($limit=10, $cid=0){
	 $user= $this->session->userdata('logged_in');
	$now= time()+7*60*60;
	$sql ='SELECT quid, quiz_name,qids,permalink FROM `savsoft_quiz` join savsoft_permalink on (savsoft_permalink.content_id=savsoft_quiz.quid and savsoft_permalink.model="quiz") WHERE deleted=0 AND status=1 AND start_date <'.$now.' AND end_date >'.$now;
	if($cid>0){
		$sql.=' and cid='.$cid; 
	}
	else{
		$sql.=' AND noq>3 AND SUBSTRING_INDEX(qids, ",", 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) AND SUBSTRING_INDEX(SUBSTRING_INDEX(qids, ",", 2),",",- 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) AND SUBSTRING_INDEX(SUBSTRING_INDEX(qids, ",", 3),",",- 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) AND SUBSTRING_INDEX(SUBSTRING_INDEX(qids, ",", 4),",",- 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0)';
	}
	$sql.=' ORDER BY RAND() DESC';
   if($limit!=0)	{$sql.=' LIMIT '.$limit; }
	$query=$this->db->query($sql)->result_array();
     if($query){
		 for($k=0; $k<count($query); $k++){
			 if($user){
				$this->db->insert("user_views", array("model"=>"quiz", "content_id"=>$query[$k]['quid'], "uid"=>$user["uid"]));
			 }
			 $quids_arr = explode(",",$query[$k]['qids']);
			 $qid=$quids_arr[0];
			
			 $sql = "select question,background_template from savsoft_qbank where deleted =0 and qid = $qid";
			 $qr = $this->db->query($sql);
			 if($qr){
				 $qt= $qr->row_array();
				 $origImageSrc="";
				 $origvidSrc="";
				 $htmlContent=$qt['question'];
				 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 if(count($imgTags[0])>0){
					 if(strpos($origImageSrc, "latex.codecogs.com")===false){
						$query[$k]['img']=str_replace("..",base_url(),$origImageSrc);
					 }
					 else{
						 $query[$k]['img']=base_url("upload/default_image_quiz.png");
					 }
				 }
				  else
					 $query[$k]['img']=base_url("upload/default_image_quiz.png");
			 }
				
			
				
			 
				 
			 }
	 }	
	    
	return $query;
	
 }
 function get_fun_quiz($pivot=0, $limit=1){
	 $user=$this->session->userdata('logged_in');
	 $now= time()+7*60*60;
	 $sql ='SELECT * FROM `savsoft_quiz` WHERE noq > 3 AND deleted=0 and status =1 AND start_date <'.$now.' AND end_date >'.$now.' AND SUBSTRING_INDEX(qids, ",", 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) AND SUBSTRING_INDEX(SUBSTRING_INDEX(qids, ",", 2),",",- 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) AND SUBSTRING_INDEX(SUBSTRING_INDEX(qids, ",", 3),",",- 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) AND SUBSTRING_INDEX(SUBSTRING_INDEX(qids, ",", 4),",",- 1) IN (SELECT qid FROM savsoft_qbank WHERE fun_priory > 1 AND deleted=0) ORDER BY modify_date DESC LIMIT '.$limit;
	 $query=$this->db->query($sql)->result_array();
	 if($query){
		 for($k=0; $k<count($query); $k++){
			 $this->db->where('content_id',$query[$k]['quid'] );
			 $this->db->where('model','quiz');
			 $query[$k]['permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
			 $quids_arr = explode(",",$query[$k]['qids'],5 );
			 $qids=$quids_arr[0];
			 for($i=1; $i<4; $i++){
				 $qids.=','.$quids_arr[$i];
			 }
			 $sql = "select question,background_template from savsoft_qbank where deleted =0 and qid in ($qids) limit 4  ";
			 $query[$k]['question']= $this->db->query($sql)->result_array();
			 for($i=0; $i<count($query[$k]['question']); $i++){
				 $origImageSrc="";
				 $origvidSrc="";
				 $htmlContent=$query[$k]['question'][$i]['question'];
				 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 if($origImageSrc)
					$query[$k]['question'][$i]['img']=$origImageSrc;
				  else
					 $query[$k]['question'][$i]['img']=base_url("upload/default_image_quiz.png");
				 preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
				 for ($j = 0; $j < count($vidTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$vidTags[0][$j], $video);
					$origvidSrc = str_ireplace( 'src="', '',  $video[0]);
					
				 }
				 if(count($video)>0)
					$query[$k]['question'][$i]['video']=$origvidSrc;
				  else
					 $query[$k]['question'][$i]['video']="";
			 }
			  $this->db->select('status');
			 $this->db->where('model','quiz');
			 $this->db->where('content_id',$query[$k]['quid']);
			 $this->db->where('uid',$user['uid']);
			 $query[$k]['liked']=$this->db->get('savsoft_like')->row_array()['status'];
			 $this->db->where('model', 'quiz');
			$this->db->where('content_id', $query[$k]['quid']);
			$this->db->where('uid !=', $user['uid']);
			$this->db->where('status', 1);
			$query[$k]['n_like']=$this->db->get('savsoft_like')->num_rows();
			
			$this->db->from('posts p');
			$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
			$this->db->where('p.model','quiz');
			$this->db->where('p.wall_id',$query[$k]['quid']);
			$this->db->where('p.parent_id', 0);
			$this->db->limit(2);
			$this->db->order_by("p.create_date", "desc");
			$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,photo");
			$query[$k]['comment'] =$this->db->get()->result_array();
			
			$this->db->where('content_id', $query[$k]['quid']);
			$this->db->where('model', 'quiz');
			$query[$k]['permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
		 }
        
			
	     return $query;
	 }
	 else{
		 return array();
	 }
	}
 function remove_quiz($quid){
	 
	 $this->db->where('quid',$quid);
	 if($this->db->update('savsoft_quiz' ,array('deleted'=>1))){
		 
		 return true;
	 }else{
		 
		 return false;
	 }
	 
	 
 }
 
  
 
 function count_result($quid,$uid){
	 
	 $this->db->where('quid',$quid);
	 $this->db->where('uid',$uid);
	$query=$this->db->get('savsoft_result');
	return $query->num_rows();
	 
 }
 
 
 function insert_result($quid,$uid){
	 //Change status assign
 	$dataassign = array('status' => 2,);
 	$this->db->where('quid', $quid);
 	$this->db->where('uid', $uid);
 	$this->db->update('savsoft_assign', $dataassign);


	 // get quiz info
	  $this->db->where('quid',$quid);
	 $query=$this->db->get('savsoft_quiz');
	$quiz=$query->row_array();
	 
	 if($quiz['question_selection']=='0'){
		 
	// get questions	
      $qidsss= $quiz['qids'];
   	if($quiz['reading_mcq']){
		$qidsss.=",".$quiz['reading_mcq'];
	}

   	if($quiz['video_mcq']){
		$qidsss.=",".$quiz['video_mcq'];
	}
	$qids=explode(',',$qidsss);
	$noq=count($qids);
	$categories=array();
	$category_range=array();

	$i=0;
	$wqids=implode(',',$qids);
	$noq=array();
	$query=$this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid where qid in ($wqids) ORDER BY FIELD(qid,$wqids)  ");	
	$questions=$query->result_array();
	foreach($questions as $qk => $question){
	if(!in_array($question['category_name'],$categories)){
		if(count($categories)!=0){
			$i+=1;
		}
	$categories[]=$question['category_name'];
	$noq[$i]+=1;
	}else{
	$noq[$i]+=1;

	}
	}
	
	$categories=array();
	$category_range=array();

	$i=-1;
	foreach($questions as $qk => $question){
		if(!in_array($question['category_name'],$categories)){
		 $categories[]=$question['category_name'];
		$i+=1;	
		$category_range[]=$noq[$i];
		
		} 
	}
 
	
	}else{
	// randomaly select qids
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('savsoft_qcl');
	 $qcl=$query->result_array();
	$qids=array();
	$categories=array();
	$category_range=array();
	
	foreach($qcl as $k => $val){
		$cid=$val['cid'];
		$lid=$val['lid'];
		$noq=$val['noq'];
		
		$i=0;
	$query=$this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid where savsoft_qbank.cid='$cid' and lid='$lid' ORDER BY RAND() limit $noq ");	
	$questions=$query->result_array();
	foreach($questions as $qk => $question){
		$qids[]=$question['qid'];
		if(!in_array($question['category_name'],$categories)){
		$categories[]=$question['category_name'];
		$category_range[]=$i+$noq;
		}
	}
	}
	}
	$zeros=array();
	 foreach($qids as $qidval){
	 $zeros[]=0;
	 }
	 
	 
	 
	 $userdata=array(
	 'quid'=>$quid,
	 'uid'=>$uid,
	 'r_qids'=>implode(',',$qids),
	 'categories'=>implode(',',$categories),
	 'category_range'=>implode(',',$category_range),
	 'start_time'=>time(),
	 'individual_time'=>implode(',',$zeros),
	 'score_individual'=>implode(',',$zeros),
	 'attempted_ip'=>$_SERVER['REMOTE_ADDR'] 
	 );
	 
	 if($this->session->userdata('photoname')){
		 $photoname=$this->session->userdata('photoname');
		 $userdata['photo']=$photoname;
	 }
	 $this->db->insert('savsoft_result',$userdata);
	  $rid=$this->db->insert_id();
	return $rid;
 }
 
 
 
 function open_result($quid,$uid){
	 $result_open=$this->lang->line('open');
		$query=$this->db->query("select * from savsoft_result  where savsoft_result.result_status='$result_open'  and savsoft_result.uid='$uid'  "); 
	if($query->num_rows() >= '1'){
		$result=$query->row_array();
return $result['rid'];		
	}else{
		return '0';
	}
	
	 
 }
 
 function quiz_result($rid){
	 
	 
	$query=$this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
	return $query->row_array(); 
	 
 }
 
function saved_answers($rid){
	 
	 
	$query=$this->db->query("select * from savsoft_answers  where savsoft_answers.rid='$rid' "); 
	return $query->result_array(); 
	 
 }
 
 
 function assign_score($rid,$qno,$score){
	 $qp_score=$score;
	 $query=$this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
	$quiz=$query->row_array(); 
	$score_ind=explode(',',$quiz['score_individual']);
	$score_ind[$qno]=$score;
	$r_qids=explode(',',$quiz['r_qids']);
	$correct_score=$quiz['correct_score'];
	$incorrect_score=$quiz['incorrect_score'];
		$manual_valuation=0;
	foreach($score_ind as $mk => $score){
		
		if($score == 1){
			
			$marks+=$correct_score;
		}
		if($score == 2){
			
			$marks+=$incorrect_score;
		}
		if($score == 3){
			
			$manual_valuation=1;
		}
		
	}
	$percentage_obtained=($marks/count($r_qids))*100;
	if($percentage_obtained >= $quiz['pass_percentage']){
		$qr=$this->lang->line('pass');
	}else{
		$qr=$this->lang->line('fail');
		
	}
	 $userdata=array(
	  'score_individual'=>implode(',',$score_ind),
	  'score_obtained'=>$marks,
	 'percentage_obtained'=>$percentage_obtained,
	 'manual_valuation'=>$manual_valuation
	 );
	 if($manual_valuation == 1){
		 $userdata['result_status']=$this->lang->line('pending');
	}else{
		$userdata['result_status']=$qr;
	}
	 $this->db->where('rid',$rid);
	 $this->db->update('savsoft_result',$userdata);
	 
	 // question performance
	 $qp=$r_qids[$qno];
	 		 $crin="";
		if($$qp_score=='1'){
			$crin=", no_time_corrected=(no_time_corrected +1)"; 	 
		 }else if($$qp_score=='2'){
			$crin=", no_time_incorrected=(no_time_incorrected +1)"; 	 
		 }
		  $query_qp="update savsoft_qbank set  $crin  where qid='$qp'  ";
	 $this->db->query($query_qp);
 }
 
 
 
 function submit_result(){
	 if(!$this->session->userdata('logged_in')){
		$logged_in=$this->session->userdata('logged_in_raw');
	 }else{
	 $logged_in=$this->session->userdata('logged_in');
	 }
	 $email=$logged_in['email'];
	 $rid=$this->session->userdata('rid');
	$query=$this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
	$quiz=$query->row_array(); 
	$qids_str = $query->result_array()[0]['qids'];
    $this->db->query("UPDATE savsoft_qbank SET editable = 0 where qid in ($qids_str)");
	$score_ind=explode(',',$quiz['score_individual']);
	$r_qids=explode(',',$quiz['r_qids']);
	$qids_perf=array();
	$marks=0;
	$tans=0;
	$correct_score=$quiz['correct_score'];
	$incorrect_score=$quiz['incorrect_score'];
	$total_time=array_sum(explode(',',$quiz['individual_time']));
	$manual_valuation=0;
	foreach($score_ind as $mk => $score){
		$qids_perf[$r_qids[$mk]]=$score;
		
		if($score == 1){
			
			$marks+=$correct_score;
			$tans+=1;
		}
		if($score == 2){
			
			$marks+=$incorrect_score;
		}
		if($score == 3){
			
			$manual_valuation=1;
		}
		
	}
	$percentage_obtained=($marks/(count($r_qids)*$correct_score))*100;
	if($percentage_obtained >= $quiz['pass_percentage']){
		$qr=$this->lang->line('pass');
	}else{
		$qr=$this->lang->line('fail');
		
	}
	 $userdata=array(
	  'total_time'=>$total_time,
	   'end_time'=>time(),
	  'score_obtained'=>$marks,
	 'percentage_obtained'=>$percentage_obtained,
	 'manual_valuation'=>$manual_valuation
	 );
	 if($manual_valuation == 1){
		 $userdata['result_status']=$this->lang->line('pending');
	}else{
		$userdata['result_status']=$qr;
	}
	 $this->db->where('rid',$rid);
	 $this->db->update('savsoft_result',$userdata);
	 
	 
	 foreach($qids_perf as $qp => $qpval){
		 $crin="";
		 if($qpval=='0'){
			$crin=", no_time_unattempted=(no_time_unattempted +1) "; 
		 }else if($qpval=='1'){
			$crin=", no_time_corrected=(no_time_corrected +1)"; 	 
		 }else if($qpval=='2'){
			$crin=", no_time_incorrected=(no_time_incorrected +1)"; 	 
		 }
		  $query_qp="update savsoft_qbank set no_time_served=(no_time_served +1)  $crin  where qid='$qp'  ";
	 $this->db->query($query_qp);
	 
	 
	 
		 
	 }
	 
if($this->config->item('allow_result_email')){
	$this->load->library('email');
	$query = $this -> db -> query("select savsoft_result.*,savsoft_users.*,savsoft_quiz.* from savsoft_result, savsoft_users, savsoft_quiz where savsoft_users.uid=savsoft_result.uid and savsoft_quiz.quid=savsoft_result.quid and savsoft_result.rid='$rid'");
	$qrr=$query->row_array();
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
			$toemail=$qrr['email'];
			$fromemail=$this->config->item('fromemail');
			$fromname=$this->config->item('fromname');
			$subject=$this->config->item('result_subject');
			$message=$this->config->item('result_message');
			
			$subject=str_replace('[email]',$qrr['email'],$subject);
			$subject=str_replace('[first_name]',$qrr['first_name'],$subject);
			$subject=str_replace('[last_name]',$qrr['last_name'],$subject);
			$subject=str_replace('[quiz_name]',$qrr['quiz_name'],$subject);
			$subject=str_replace('[score_obtained]',$qrr['score_obtained'],$subject);
			$subject=str_replace('[percentage_obtained]',$qrr['percentage_obtained'],$subject);
			$subject=str_replace('[current_date]',date('Y-m-d H:i:s',time()),$subject);
			$subject=str_replace('[result_status]',$qrr['result_status'],$subject);
			
			$message=str_replace('[email]',$qrr['email'],$message);
			$message=str_replace('[first_name]',$qrr['first_name'],$message);
			$message=str_replace('[last_name]',$qrr['last_name'],$message);
			$message=str_replace('[quiz_name]',$qrr['quiz_name'],$message);
			$message=str_replace('[score_obtained]',$qrr['score_obtained'],$message);
			$message=str_replace('[percentage_obtained]',$qrr['percentage_obtained'],$message);
			$message=str_replace('[current_date]',date('Y-m-d H:i:s',time()),$message);
			$message=str_replace('[result_status]',$qrr['result_status'],$message);
			 
			
			$this->email->to($toemail);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			if(!$this->email->send()){
			 //print_r($this->email->print_debugger());
			
			}
	}

	 $user =$this->session->userdata('logged_in');
	 

    $dataassign = array(
 		'status' => 2,
 		'rid' => $rid,
 	);
 	$uid = $user['uid'];
 	$quidz=$this->session->userdata('quidz');
 	$aid=$this->session->userdata('aid');
 	$auid=$this->session->userdata('auid');
 	log_message('error', $auid);
 	if(!is_null($auid)){
 		$this->db->where('id', $aid);
	 	$this->db->where('quid', $quidz);
	 	$this->db->where('auid', $auid);
	 	$this->db->where('uid', $uid);
	 	$this->db->update('savsoft_assign', $dataassign);
         $this->db->select('percentage_obtained');
		$this->db->where('rid',$rid);
		$quizz= $this->db->get('savsoft_result')->row_array();
		$type="";
		$this->db->where('quid', $quidz);
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
	 	$assignfrom = array(
	  		"uid" => $uid,
	  		"content" => "đã làm xong bài ".$type.". Kết quả: ".number_format($quizz['percentage_obtained'],0)."%",
	  		"model" => "result",
	  		"action" => "Answer assign quiz",
	  		"click" => "window.location.href = '".site_url()."/result/view_result/".$rid."'",
			"rid"=>$rid
	  	);
	  	$this->db->insert('notify',$assignfrom);
	  	$nid = $this->db->insert_id();

	  	$assignto1 = array(
			'nid' => $nid,
			'uid' => $uid,
		);
		$this->db->insert('notify_user', $assignto1);
		$assignto2 = array(
			'nid' => $nid,
			'uid' => $auid,
		);
		$this->db->insert('notify_user', $assignto2);
		
		$this->db->where("rid", $rid);
		$as=$this->db->get("savsoft_assign")->row_array();
		
        $tp= $as['price'];
		$tp2 = ceil($as['reward_point']*$percentage_obtained/100);	
		$this->db->where("uid", $as['auid']);
		$ap= $this->db->get("savsoft_users")->row_array()['point'];
		$this->db->where("uid", $as['auid']);
		$this->db->update("savsoft_users", array("point"=>$ap-$tp-$tp2));
		
		$arr_hp=array("uid"=>$as['auid'],
					  "point_change"=>-$tp-$tp2,
					  "point_remain"=>$ap-$tp-$tp2,
					  "nid"=>$nid,
					  "activity"=>"assign_quiz"

					 );
		
		$this->db->insert("history_point", $arr_hp);
		log_message("error", "********************".$tp2."----------------".$tp);
		
		$this->db->where("uid", $as['uid']);
		$ap2= $this->db->get("savsoft_users")->row_array()['point'];
		$this->db->where("uid", $as['uid']);
		$this->db->update("savsoft_users", array("point"=>$ap2+$tp2));
		
		$arr_hp=array("uid"=>$as['uid'],
					  "point_change"=>$tp2,
					  "point_remain"=>$ap2+$tp2,
					  "nid"=>$nid,
					  "activity"=>"reward_do_assign_quiz"

					 );
		
		$this->db->insert("history_point", $arr_hp); 
		 
		 
		 
		//$this->load->model('api_model');
		//$this->db->where('savsoft_users.uid',$auid);
	   //	$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		//$query=$this->db->get('savsoft_users');
	 	//$assigned = $query->row_array();
		//$toemail = $assigned['email'];
		//$message = $user['first_name'].' vừa hoàn thành một bài trắc nghiệm do giáo viên (hoặc phụ huynh) '.$assigned['first_name'].' giao. Hãy click vào đường link dưới đây nếu muốn xem chi tiết kết quả làm bài của con bạn.<br><br><a href="'.site_url().'/result/view_result/'.$rid.'"><img src="http://do.stem.vn/images/button_xem-ket-qua.png" height="50" width="200"></a>';
		//$this->api_model->sendmail($toemail, $message);

		$this->session->unset_userdata('quidz');
		$this->session->unset_userdata('auid');
		$this->session->unset_userdata('aid');
		
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
 	
    else{
		$uid = $user['uid'];
		 $this->db->where('uid', $uid);
		 $us=$this->db->get('savsoft_users')->result_array();
		 $this->db->where('rule_id', 2);
	     $pc1=$this->db->get('quiz_rule')->result_array();
	     $point_true = $pc1[0]['point_change'];
		 $this->db->where('rule_id', 3);
	     $pc2=$this->db->get('quiz_rule')->result_array();
	     $point_false = $pc2[0]['point_change'];
		 $point_change=$point_true*$tans+$point_false*($quiz['noq']-$tans); 
		 $point = $us[0]['point']+$point_change;
		 $point_array=array('point'=>$point);
		 $this->db->where('uid', $uid);
		 $this->db->update('savsoft_users',$point_array);
		 $history= array( 'uid'=> $uid, 'activity'=>'Trả lời bài trắc nghiệm', 'point_change'=>$point_change);
	     $this->db->insert('history_point_change', $history);
	}
	return true;
 }
 
 
 
 
 
 function insert_answer(){
	 $rid=$_POST['rid'];
	$srid=$this->session->userdata('rid');
	if(!$this->session->userdata('logged_in')){
		$logged_in=$this->session->userdata('logged_in_raw');
	}else{
		$logged_in=$this->session->userdata('logged_in');
	}
	$uid=$logged_in['uid'];
	if($srid != $rid){

	return "Something wrong";
	}
	$query=$this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
	$quiz=$query->row_array(); 
	$correct_score=$quiz['correct_score'];
	$incorrect_score=$quiz['incorrect_score'];
	$qids=explode(',',$quiz['r_qids']);
	$vqids=$quiz['r_qids'];
	$correct_incorrect=explode(',',$quiz['score_individual']);
	
	
	// remove existing answers
	$this->db->where('rid',$rid);
	$this->db->delete('savsoft_answers');
	
	 foreach($_POST['answer'] as $ak => $answer){
		 
		 // multiple choice single answer
		 if($_POST['question_type'][$ak] == '1' || $_POST['question_type'][$ak] == '2'){
			 
			 $qid=$qids[$ak];
			 $query=$this->db->query(" select * from savsoft_options where qid='$qid' ");
			 $options_data=$query->result_array();
			 $options=array();
			 foreach($options_data as $ok => $option){
				 $options[$option['oid']]=$option['score'];
			 }
			 $attempted=0;
			 $marks=0;
				foreach($answer as $sk => $ansval){
					if($options[$ansval] <= 0 ){
					$marks+=-1;	
					}else{
					$marks+=$options[$ansval];
					}
					$userdata=array(
					'rid'=>$rid,
					'qid'=>$qid,
					'uid'=>$uid,
					'q_option'=>$ansval,
					'score_u'=>$options[$ansval]
					);
					$this->db->insert('savsoft_answers',$userdata);
				$attempted=1;	
				}
				if($attempted==1){
					if($marks >= '0.99' ){
					$correct_incorrect[$ak]=1;	
					}else{
					$correct_incorrect[$ak]=2;							
					}
				}else{
					$correct_incorrect[$ak]=0;
				}
		 }
		 // short answer
		 if($_POST['question_type'][$ak] == '3'){
			 
			 $qid=$qids[$ak];
			 $query=$this->db->query(" select * from savsoft_options where qid='$qid' ");
			 $options_data=$query->row_array();
			 $options_data=explode(',',$options_data['q_option']);
			 $noptions=array();
			 foreach($options_data as $op){
				 $noptions[]=strtoupper(trim($op));
			 }
			 
			 $attempted=0;
			 $marks=0;
				foreach($answer as $sk => $ansval){
					if($ansval != ''){
					if(in_array(strtoupper(trim($ansval)),$noptions)){
					$marks=1;	
					}else{
					$marks=0;
					}
					
				$attempted=1;

					$userdata=array(
					'rid'=>$rid,
					'qid'=>$qid,
					'uid'=>$uid,
					'q_option'=>$ansval,
					'score_u'=>$marks
					);
					$this->db->insert('savsoft_answers',$userdata);

				}
				}
				if($attempted==1){
					if($marks==1){
					$correct_incorrect[$ak]=1;	
					}else{
					$correct_incorrect[$ak]=2;							
					}
				}else{
					$correct_incorrect[$ak]=0;
				}
		 }
		 
		 // long answer
		 if($_POST['question_type'][$ak] == '4'){
			  $attempted=0;
			 $marks=0;
			  $qid=$qids[$ak];
					foreach($answer as $sk => $ansval){
					if($ansval != ''){
					$userdata=array(
					'rid'=>$rid,
					'qid'=>$qid,
					'uid'=>$uid,
					'q_option'=>$ansval,
					'score_u'=>0
					);
					$this->db->insert('savsoft_answers',$userdata);
					$attempted=1;
					}
					}
				if($attempted==1){
					
					$correct_incorrect[$ak]=3;							
					
				}else{
					$correct_incorrect[$ak]=0;
				}
		 }
		 
		 // match
			 if($_POST['question_type'][$ak] == '5'){
				 			 $qid=$qids[$ak];
			 $query=$this->db->query(" select * from savsoft_options where qid='$qid' ");
			 $options_data=$query->result_array();
			$noptions=array();
			foreach($options_data as $op => $option){
				$noptions[]=$option['q_option'].'___'.$option['q_option_match'];				
			}
			 $marks=0;
			 $attempted=0;
					foreach($answer as $sk => $ansval){
						if($ansval != '0'){
						$mc=0;
						if(in_array($ansval,$noptions)){
							$marks+=1/count($options_data);
							$mc=1/count($options_data);
						}else{
							$marks+=0;
							$mc=0;
						}
					$userdata=array(
					'rid'=>$rid,
					'qid'=>$qid,
					'uid'=>$uid,
					'q_option'=>$ansval,
					'score_u'=>$mc
					);
					$this->db->insert('savsoft_answers',$userdata);
					$attempted=1;
					}
					}
					if($attempted==1){
					if($marks==1){
					$correct_incorrect[$ak]=1;	
					}else{
					$correct_incorrect[$ak]=2;							
					}
				}else{
					$correct_incorrect[$ak]=0;
				}
		 }
		 
		 
		 
		 
		 
		 
		 
		 
	 }
	 
	 $userdata=array(
	 'score_individual'=>implode(',',$correct_incorrect),
	 'individual_time'=>$_POST['individual_time'],
	 
	 );
	 $this->db->where('rid',$rid);
	 $this->db->update('savsoft_result',$userdata);
	 
	 return true;
	 
 }
 
 
 
 function set_ind_time(){
	 	$rid=$this->session->userdata('rid');

	 $userdata=array(
	 'individual_time'=>$_POST['individual_time'],
	 
	 );
	 $this->db->where('rid',$rid);
	 $this->db->update('savsoft_result',$userdata);
	 
	 return true;
 }


  function insert_results($quid,$uid, $auid, $aid){

	 // get quiz info
	  $this->db->where('quid',$quid);
	 $query=$this->db->get('savsoft_quiz');
	$quiz=$query->row_array();
	 
	 if($quiz['question_selection']=='0'){
	// get questions	
	//$noq=$quiz['noq'];	
	$strq = "";
	if($quiz['video_mcq']){
		$strq=$quiz['video_mcq'];
	}
	if($quiz['reading_mcq']){
		if($strq){
			$strq.=",".$quiz['reading_mcq'];
		}
		else{
			$strq=$quiz['reading_mcq'];
		}
	}
	if($strq){
		$strq.=",".$quiz['qids'];
	}
	else{
		$strq=$quiz['qids'];
	}
	
	$qids=explode(',',$strq);
	$noq=count($qids);
	
	
	$categories=array();
	$category_range=array();

	$i=0;
	$wqids=implode(',',$qids);
	$noq=array();
	$query=$this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid where qid in ($wqids) ORDER BY FIELD(qid,$wqids)  ");	
	$questions=$query->result_array();
	foreach($questions as $qk => $question){
	if(!in_array($question['category_name'],$categories)){
		if(count($categories)!=0){
			$i+=1;
		}
	$categories[]=$question['category_name'];
	$noq[$i]+=1;
	}else{
	$noq[$i]+=1;

	}
	}
	
	$categories=array();
	$category_range=array();

	$i=-1;
	foreach($questions as $qk => $question){
		if(!in_array($question['category_name'],$categories)){
		 $categories[]=$question['category_name'];
		$i+=1;	
		$category_range[]=$noq[$i];
		
		} 
	}
 
	
	}else{
	// randomaly select qids
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('savsoft_qcl');
	 $qcl=$query->result_array();
	$qids=array();
	$categories=array();
	$category_range=array();
	
	foreach($qcl as $k => $val){
		$cid=$val['cid'];
		$lid=$val['lid'];
		$noq=$val['noq'];
		
		$i=0;
	$query=$this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid where savsoft_qbank.cid='$cid' and lid='$lid' ORDER BY RAND() limit $noq ");	
	$questions=$query->result_array();
	foreach($questions as $qk => $question){
		$qids[]=$question['qid'];
		if(!in_array($question['category_name'],$categories)){
		$categories[]=$question['category_name'];
		$category_range[]=$i+$noq;
		}
	}
	}
	}
	$zeros=array();
	 foreach($qids as $qidval){
	 $zeros[]=0;
	 }
	 
	 
	 
	 $userdata=array(
	 'quid'=>$quid,
	 'uid'=>$uid,
	 'r_qids'=>implode(',',$qids),
	 'categories'=>implode(',',$categories),
	 'category_range'=>implode(',',$category_range),
	 'start_time'=>time(),
	 'individual_time'=>implode(',',$zeros),
	 'score_individual'=>implode(',',$zeros),
	 'attempted_ip'=>$_SERVER['REMOTE_ADDR'] 
	 );
	 
	 if($this->session->userdata('photoname')){
		 $photoname=$this->session->userdata('photoname');
		 $userdata['photo']=$photoname;
	 }
	 $this->db->insert('savsoft_result',$userdata);
	  $rid=$this->db->insert_id();

	return $rid;
 }
 


  function submit_results($user, $rid){
	$email=$user['email'];
	log_message('error', $email);
	$query=$this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
	$quiz=$query->row_array(); 
	$qids_str = $query->result_array()[0]['qids'];
    $this->db->query("UPDATE savsoft_qbank SET editable = 0 where qid in ($qids_str)");
	$score_ind=explode(',',$quiz['score_individual']);
	$r_qids=explode(',',$quiz['r_qids']);
	$qids_perf=array();
	$marks=0;
	$tans=0;
	$correct_score=$quiz['correct_score'];
	$incorrect_score=$quiz['incorrect_score'];
	$total_time=array_sum(explode(',',$quiz['individual_time']));
	$manual_valuation=0;
	foreach($score_ind as $mk => $score){
		$qids_perf[$r_qids[$mk]]=$score;
		
		if($score == 1){
			
			$marks+=$correct_score;
			$tans+=1;
		}
		if($score == 2){
			
			$marks+=$incorrect_score;
		}
		if($score == 3){
			
			$manual_valuation=1;
		}
		
	}
	$noq = count(explode(",", $quiz['r_qids']));
	$percentage_obtained=($marks/($noq*$correct_score))*100;
	if($percentage_obtained >= $quiz['pass_percentage']){
		$qr=$this->lang->line('pass');
	}else{
		$qr=$this->lang->line('fail');
		
	}
	 $userdata=array(
	  'total_time'=>$total_time,
	   'end_time'=>time(),
	  'score_obtained'=>$marks,
	 'percentage_obtained'=>$percentage_obtained,
	 'manual_valuation'=>$manual_valuation
	 );
	 if($manual_valuation == 1){
		 $userdata['result_status']=$this->lang->line('pending');
	}else{
		$userdata['result_status']=$qr;
	}
	 $this->db->where('rid',$rid);
	 $this->db->update('savsoft_result',$userdata);
	 
	 
	 foreach($qids_perf as $qp => $qpval){
		 $crin="";
		 if($qpval=='0'){
			$crin=", no_time_unattempted=(no_time_unattempted +1) "; 
		 }else if($qpval=='1'){
			$crin=", no_time_corrected=(no_time_corrected +1)"; 	 
		 }else if($qpval=='2'){
			$crin=", no_time_incorrected=(no_time_incorrected +1)"; 	 
		 }
		  $query_qp="update savsoft_qbank set no_time_served=(no_time_served +1)  $crin  where qid='$qp'  ";
	 $this->db->query($query_qp);
	 
	 
	 
		 
	 }
	 
if($this->config->item('allow_result_email')){
	$this->load->library('email');
	$query = $this -> db -> query("select savsoft_result.*,savsoft_users.*,savsoft_quiz.* from savsoft_result, savsoft_users, savsoft_quiz where savsoft_users.uid=savsoft_result.uid and savsoft_quiz.quid=savsoft_result.quid and savsoft_result.rid='$rid'");
	$qrr=$query->row_array();
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
			$toemail=$qrr['email'];
			$fromemail=$this->config->item('fromemail');
			$fromname=$this->config->item('fromname');
			$subject=$this->config->item('result_subject');
			$message=$this->config->item('result_message');
			
			$subject=str_replace('[email]',$qrr['email'],$subject);
			$subject=str_replace('[first_name]',$qrr['first_name'],$subject);
			$subject=str_replace('[last_name]',$qrr['last_name'],$subject);
			$subject=str_replace('[quiz_name]',$qrr['quiz_name'],$subject);
			$subject=str_replace('[score_obtained]',$qrr['score_obtained'],$subject);
			$subject=str_replace('[percentage_obtained]',$qrr['percentage_obtained'],$subject);
			$subject=str_replace('[current_date]',date('Y-m-d H:i:s',time()),$subject);
			$subject=str_replace('[result_status]',$qrr['result_status'],$subject);
			
			$message=str_replace('[email]',$qrr['email'],$message);
			$message=str_replace('[first_name]',$qrr['first_name'],$message);
			$message=str_replace('[last_name]',$qrr['last_name'],$message);
			$message=str_replace('[quiz_name]',$qrr['quiz_name'],$message);
			$message=str_replace('[score_obtained]',$qrr['score_obtained'],$message);
			$message=str_replace('[percentage_obtained]',$qrr['percentage_obtained'],$message);
			$message=str_replace('[current_date]',date('Y-m-d H:i:s',time()),$message);
			$message=str_replace('[result_status]',$qrr['result_status'],$message);
			 
			
			$this->email->to($toemail);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			if(!$this->email->send()){
			 //print_r($this->email->print_debugger());
			
			}
	}

	 if($user){
		 $uid = $user['uid'];
		 $this->db->where('uid', $uid);
		 $us=$this->db->get('savsoft_users')->result_array();
		 $this->db->where('rule_id', 2);
	     $pc1=$this->db->get('quiz_rule')->result_array();
	     $point_true = $pc1[0]['point_change'];
		 $this->db->where('rule_id', 3);
	     $pc2=$this->db->get('quiz_rule')->result_array();
	     $point_false = $pc2[0]['point_change'];
		 $point_change=$point_true*$tans+$point_false*($quiz['noq']-$tans); 
		 $point = $us[0]['point']+$point_change;
		 $point_array=array('point'=>$point);
		 $this->db->where('uid', $uid);
		 $this->db->update('savsoft_users',$point_array);
		 $history= array( 'uid'=> $uid, 'activity'=>'Trả lời bài trắc nghiệm', 'point_change'=>$point_change);
	     $this->db->insert('history_point_change', $history);
     }
	return true;
 }
 
 
   function submit_results2($user, $rid){
	$email=$user['email'];
	log_message('error', $email);
	$query=$this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
	$quiz=$query->row_array(); 
	$qids_str = $query->result_array()[0]['qids'];
    $this->db->query("UPDATE savsoft_qbank SET editable = 0 where qid in ($qids_str)");
	$score_ind=explode(',',$quiz['score_individual']);
	$r_qids=explode(',',$quiz['r_qids']);
	$qids_perf=array();
	$marks=0;
	$tans=0;
	$correct_score=$quiz['correct_score'];
	$incorrect_score=$quiz['incorrect_score'];
	$total_time=array_sum(explode(',',$quiz['individual_time']));
	$manual_valuation=0;
	foreach($score_ind as $mk => $score){
		$qids_perf[$r_qids[$mk]]=$score;
		
		if($score == 1){
			
			$marks+=$correct_score;
			$tans+=1;
		}
		if($score == 2){
			
			$marks+=$incorrect_score;
		}
		if($score == 3){
			
			$manual_valuation=1;
		}
		
	}
	$noq = count(explode(",", $quiz['r_qids']));
	$percentage_obtained=($marks/($noq*$correct_score))*100;
	if($percentage_obtained >= $quiz['pass_percentage']){
		$qr=$this->lang->line('pass');
	}else{
		$qr=$this->lang->line('fail');
		
	}
	 $userdata=array(
	  'total_time'=>$total_time,
	   'end_time'=>time(),
	  'score_obtained'=>$marks,
	 'percentage_obtained'=>$percentage_obtained,
	 'manual_valuation'=>$manual_valuation
	 );
	 if($manual_valuation == 1){
		 $userdata['result_status']=$this->lang->line('pending');
	}else{
		$userdata['result_status']=$qr;
	}
	 $this->db->where('rid',$rid);
	 $this->db->update('savsoft_result',$userdata);
	 
	 
	 foreach($qids_perf as $qp => $qpval){
		 $crin="";
		 if($qpval=='0'){
			$crin=", no_time_unattempted=(no_time_unattempted +1) "; 
		 }else if($qpval=='1'){
			$crin=", no_time_corrected=(no_time_corrected +1)"; 	 
		 }else if($qpval=='2'){
			$crin=", no_time_incorrected=(no_time_incorrected +1)"; 	 
		 }
		  $query_qp="update savsoft_qbank set no_time_served=(no_time_served +1)  $crin  where qid='$qp'  ";
	 $this->db->query($query_qp);
	 
	 
	 
		 
	 }
	 
if($this->config->item('allow_result_email')){
	$this->load->library('email');
	$query = $this -> db -> query("select savsoft_result.*,savsoft_users.*,savsoft_quiz.* from savsoft_result, savsoft_users, savsoft_quiz where savsoft_users.uid=savsoft_result.uid and savsoft_quiz.quid=savsoft_result.quid and savsoft_result.rid='$rid'");
	$qrr=$query->row_array();
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
			$toemail=$qrr['email'];
			$fromemail=$this->config->item('fromemail');
			$fromname=$this->config->item('fromname');
			$subject=$this->config->item('result_subject');
			$message=$this->config->item('result_message');
			
			$subject=str_replace('[email]',$qrr['email'],$subject);
			$subject=str_replace('[first_name]',$qrr['first_name'],$subject);
			$subject=str_replace('[last_name]',$qrr['last_name'],$subject);
			$subject=str_replace('[quiz_name]',$qrr['quiz_name'],$subject);
			$subject=str_replace('[score_obtained]',$qrr['score_obtained'],$subject);
			$subject=str_replace('[percentage_obtained]',$qrr['percentage_obtained'],$subject);
			$subject=str_replace('[current_date]',date('Y-m-d H:i:s',time()),$subject);
			$subject=str_replace('[result_status]',$qrr['result_status'],$subject);
			
			$message=str_replace('[email]',$qrr['email'],$message);
			$message=str_replace('[first_name]',$qrr['first_name'],$message);
			$message=str_replace('[last_name]',$qrr['last_name'],$message);
			$message=str_replace('[quiz_name]',$qrr['quiz_name'],$message);
			$message=str_replace('[score_obtained]',$qrr['score_obtained'],$message);
			$message=str_replace('[percentage_obtained]',$qrr['percentage_obtained'],$message);
			$message=str_replace('[current_date]',date('Y-m-d H:i:s',time()),$message);
			$message=str_replace('[result_status]',$qrr['result_status'],$message);
			 
			
			$this->email->to($toemail);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			if(!$this->email->send()){
			 //print_r($this->email->print_debugger());
			
			}
	}

	 if($user){
		 /*$uid = $user['uid'];
		 $this->db->where('uid', $uid);
		 $us=$this->db->get('savsoft_users')->result_array();
		 $this->db->where('rule_id', 2);
	     $pc1=$this->db->get('quiz_rule')->result_array();
	     $point_true = $pc1[0]['point_change'];
		 $this->db->where('rule_id', 3);
	     $pc2=$this->db->get('quiz_rule')->result_array();
	     $point_false = $pc2[0]['point_change'];
		 $point_change=$point_true*$tans+$point_false*($quiz['noq']-$tans); 
		 $point = $us[0]['point']+$point_change;
		 $point_array=array('point'=>$point);
		 $this->db->where('uid', $uid);
		 $this->db->update('savsoft_users',$point_array);
		 $history= array( 'uid'=> $uid, 'activity'=>'Trả lời bài trắc nghiệm', 'point_change'=>$point_change);
	     $this->db->insert('history_point_change', $history);*/
     }
	return true;
 }
 
 function like($quid){
	  $user=$this->session->userdata('logged_in');
	  $status=1;
	  $this->db->where('model', 'quiz');
	  $this->db->where('content_id', $quid);
	  $this->db->where('uid', $user['uid']);
      $liked =  $this->db->get('savsoft_like');
      if($liked->num_rows()>0){
		  $like_id =$liked->row_array()['like_id'];
		  $like_status=$liked->row_array()['status'];
		  $status =1-$like_status;
		  $upd=array('uid'=>$user['uid'],
					 'model'=>'quiz',
					 'content_id'=>$quid,
					 'status'=>$status,
		  );
		  $this->db->where('like_id',$like_id);
          $this->db->update('savsoft_like', $upd);		  
	  }	 
     else{
		$this->db->where('quid', $quid);
		if($this->db->get('savsoft_quiz')->num_rows()>0) {
			$ins = array('uid'=>$user['uid'],
						 'model'=>'quiz',
						 'content_id'=>$quid,
						 'status'=>$status
			); 
			$this->db->insert('savsoft_like', $ins);
		}
	 }
    $this->db->where('model', 'quiz');
	$this->db->where('content_id', $quid);
	$this->db->where('uid !=', $user['uid']);
	$this->db->where('status', 1);
	$data['n_like']=$this->db->get('savsoft_like')->num_rows();
	$data['user_name']=$user['first_name'].' '.$user['last_name'];
    return $data;	     
  } 
  
  
  function loadoption($qid, $qk,$count_question){
	   $this->db->where('qid', $qid);
	   $data= $this->db->get('savsoft_options')->result_array();
	  $message="";
	  $message.='<div class="row MB20 twopt">';
	  $message.='<div class="col-xs-6 mobile-opt mobmb20 moq" id="div-'.$data[0]['oid'].'"> ';
	  $message.='<label class="radio-inline w-100">';									 
	  $message.='<input class="MT10 optradio_main mobile-radio-opt" onclick="carousel_next('.$qk.')" name="answer['.$qk.'][]" id="answer_value'.$qk.'-0" value="'. $data[0]['oid'].'" type="radio" style="z-index:10">';
	  $message.='<div class="input-group mobile-text-opt" >';
	  $message.='<span id="sid-'.$data[0]['oid'].'" class="input-group-addon opt-mb2 bo-input-left"></span>';
	  $message.='<span id="oid-'.$data[0]['oid'].'" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;">'; 
	  $message.='<table>';
	  $message.='<tr><td><b> A:</b> </td>';
	 $message.='<td class="option">'.html_entity_decode($data[0]['q_option']).'</td>';
	$message.='</tr></table>';
	$message.='</span>';
	$message.='</div>';					
	$message.='</label>';
	$message.='</div>';
	$message.='<div class="col-xs-6 mobile-opt moq" id="div-'.$data[1]['oid'].'">';
	$message.='<label class="radio-inline w-100">';
	$message.='<input class="MT10 optradio_main mobile-radio-opt" onclick="carousel_next('.$qk.')" name="answer['.$qk.'][]" id="answer_value'.$qk.'-1" value="'.$data[1]['oid'].'" type="radio" style="z-index:10">';
	$message.='<div class="input-group mobile-text-opt">';
	$message.='<span id="sid-'.$data[1]['oid'].'" class="input-group-addon opt-mb2 bo-input-left"></span>';
	$message.='<span id="oid-'.$data[1]['oid'].'" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> ';
	$message.='<table>';
	$message.='<tr><td><b> B:</b> </td>';
	$message.='<td class="option">'.html_entity_decode($data[1]['q_option']).'</td>';
	$message.='</tr></table>';
	$message.='</span>';
	$message.='</div>';									
	$message.='</label>';
	$message.='</div>';
	$message.='</div>';
	$message.='<div class="row dtmt10" >';
	if(!in_array(html_entity_decode($data[2]['q_option']),array("", " ","  ", "   ")) ){
		$message.='<div class="col-xs-6 mobile-opt mobmb20 moq" id="div-'.$data[2]['oid'].'">';
	} else{ 
		$message.='<div class="col-xs-6 mobile-opt mobmb20" id="div-'.$data[2]['oid'].'" style="display:none">;';
	}
	$message.='<label class="radio-inline w-100">';											 
	$message.='<input class="MT10 optradio_main mobile-radio-opt" onclick="carousel_next('.$qk.')" name="answer['.$qk.'][]" id="answer_value'.$qk.'-2" value="'.$data[2]['oid'].'" type="radio" style="z-index:10">';
	$message.='<div class="input-group mobile-text-opt" >';
	$message.='<span id="sid-'.$data[2]['oid'].'" class="input-group-addon opt-mb2 bo-input-left"></span>';
	$message.='<span id="oid-'.$data[2]['oid'].'" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> ';
	$message.='<table>';
	$message.='<tr><td><b> C:</b> </td>';
	$message.=' <td class="option">'.html_entity_decode($data[2]['q_option']).'</td>';
	$message.='</tr></table>';
	$message.='</span>';
	$message.='</div>';							
	$message.='</label>';
	$message.='</div>';
	if(!in_array(html_entity_decode($data[3]['q_option']),array("", " ","  ", "   ")) ){
		$message.='<div class="col-xs-6 mobile-opt moq" id="div-'.$data[3]['oid'].'">';								
   } else{
	$message.='<div class="col-xs-6 mobile-opt" id="div-'.$data[3]['oid'].'" style="display:none"> ';
    }
	$message.='<label class="radio-inline w-100">';											 
	$message.='<input class="MT10 optradio_main mobile-radio-opt" onclick="carousel_next('.$qk.')" name="answer['.$qk.'][]" id="answer_value'.$qk.'-3" value="'.$data[3]['oid'].'" type="radio" style="z-index:10">';
	$message.='<div class="input-group mobile-text-opt" >';
	$message.='<span id="sid-'.$data[3]['oid'].'" class="input-group-addon opt-mb2 bo-input-left"></span>';
	$message.='<span id="oid-'.$data[3]['oid'].'" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> ';
	$message.='<table>';
	$message.='<tr><td><b> D:</b> </td>';
	$message.=' <td class="option">'.html_entity_decode($data[3]['q_option']).'</td>';
	$message.='</tr></table>';
	$message.='</span>';
	$message.='</div>';							
	$message.='</label>';
	$message.='</div>';
	  
	  return $message;

  }

  function loadoption1($qid, $qk,$count_question,$rid){


  		$sql="select so.oid,so.qid,so.q_option,so.score, If (so.oid=sa.q_option,1,0) correct from savsoft_options so
				left join savsoft_answers sa on sa.qid=so.qid and sa.rid=$rid
				where so.qid=$qid";
		$query=$this->db->query($sql);	

		$data= $query->result_array();

		
	   
	  $message="";
	  if($data[0]['correct']+$data[1]['correct']+$data[2]['correct']+$data[3]['correct']==0){
	  	$message.='<div class="cover-div no-answer">';
	  	$message.='<span class="text-no-answer">Bạn không chọn đáp án </span>';
	  }else{
	  	$message.='<div class="cover-div">';
	  }
	  $message.='<div class="row MB20 twopt test">';
	  $message.='<div class="col-xs-6 mobile-opt mobmb20 moq" > ';
	  $message.='<label class="radio-inline w-100">';									 
	  // $message.='<input class="MT10 optradio_main mobile-radio-opt" onclick="carousel_next('.$qk.')" name="answer['.$qk.'][]" id="answer_value'.$qk.'-0" value="'. $data[0]['oid'].'" type="radio" style="z-index:10">';
		$message.='<div class="input-group mobile-text-opt" >';

		if($data[0]['score']==1){
			$color_check='green';
		}else{
			if($data[0]['correct']==1){
				$color_check='red';
			}else{
				$color_check='';
			}
		}


		$message.='<span id="sid-'.$data[0]['oid'].'" class="'.$color_check.' input-group-addon opt-mb2 bo-input-left"></span>';
		$message.='<span id="oid-'.$data[0]['oid'].'" type="text" class="'.$color_check.' form-control optvalmb pointer bo-input-right" name="option[]"   readonly style=" color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;">'; 
		$message.='<table>';
		$message.='<tr><td><b><p> A:</b> </p></td>';
		$message.='<td class="option">'.html_entity_decode($data[0]['q_option']).'</td>';
		$message.='</tr></table>';
		$message.='</span>';  

		$message.='</div>';					
		$message.='</label>';
		$message.='</div>';
		$message.='<div class="col-xs-6 mobile-opt moq" >';
		$message.='<label class="radio-inline w-100">';
	// $message.='<input class="MT10 optradio_main mobile-radio-opt" onclick="carousel_next('.$qk.')" name="answer['.$qk.'][]" id="answer_value'.$qk.'-1" value="'.$data[1]['oid'].'" type="radio" style="z-index:10">';
		$message.='<div class="input-group mobile-text-opt" >';
		if($data[1]['score']==1){
			$color_check='green';
		}else{
			if($data[1]['correct']==1){
				$color_check='red';
			}else{
				$color_check='';
			}
		}


		$message.='<span id="sid-'.$data[1]['oid'].'" class="'.$color_check.' input-group-addon opt-mb2 bo-input-left"></span>';
		$message.='<span id="oid-'.$data[1]['oid'].'" type="text" class="'.$color_check.' form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> ';
		$message.='<table>';
		$message.='<tr><td><b><p> B:</b> </p></td>';
		$message.='<td class="option">'.html_entity_decode($data[1]['q_option']).'</td>';
		$message.='</tr></table>';
		$message.='</span>';

		$message.='</div>';									
		$message.='</label>';
		$message.='</div>';
		$message.='</div>';
		$message.='<div class="row dtmt10" >';
		if(!in_array(html_entity_decode($data[2]['q_option']),array("", " ","  ", "   ")) ){
			$message.='<div class="col-xs-6 mobile-opt mobmb20 moq" >';
		} else{ 
			$message.='<div class="col-xs-6 mobile-opt mobmb20" style="display:none">;';
		}
		$message.='<label class="radio-inline w-100">';											 
	// $message.='<input class="MT10 optradio_main mobile-radio-opt" onclick="carousel_next('.$qk.')" name="answer['.$qk.'][]" id="answer_value'.$qk.'-2" value="'.$data[2]['oid'].'" type="radio" style="z-index:10">';
		$message.='<div class="input-group mobile-text-opt" >';

		if($data[2]['score']==1){
			$color_check='green';
		}else{
			if($data[2]['correct']==1){
				$color_check='red';
			}else{
				$color_check='';
			}
		}

		
		$message.='<span id="sid-'.$data[2]['oid'].'" class="'.$color_check.' input-group-addon opt-mb2 bo-input-left"></span>';
		$message.='<span id="oid-'.$data[2]['oid'].'" type="text" class="'.$color_check.' form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> ';
		$message.='<table>';
		$message.='<tr><td><b><p> C:</b> </p></td>';
		$message.=' <td class="option">'.html_entity_decode($data[2]['q_option']).'</td>';
		$message.='</tr></table>';
		$message.='</span>';

		$message.='</div>';							
		$message.='</label>';
		$message.='</div>';
		if(!in_array(html_entity_decode($data[3]['q_option']),array("", " ","  ", "   ")) ){
			$message.='<div class="col-xs-6 mobile-opt moq" >';								
		} else{
			$message.='<div class="col-xs-6 mobile-opt" style="display:none"> ';
		}
		$message.='<label class="radio-inline w-100">';											 
	// $message.='<input class="MT10 optradio_main mobile-radio-opt" onclick="carousel_next('.$qk.')" name="answer['.$qk.'][]" id="answer_value'.$qk.'-3" value="'.$data[3]['oid'].'" type="radio" style="z-index:10">';
		$message.='<div class="input-group mobile-text-opt" >';

		if($data[3]['score']==1){
			$color_check='green';
		}else{
			if($data[3]['correct']==1){
				$color_check='red';
			}else{
				$color_check='';
			}
		}
		
		$message.='<span id="sid-'.$data[3]['oid'].'"class="'.$color_check.' input-group-addon opt-mb2 bo-input-left"></span>';
		$message.='<span id="oid-'.$data[3]['oid'].'" type="text" class="'.$color_check.' form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> ';
		$message.='<table>';
		$message.='<tr><td><b> <p>D:</b><p> </td>';
		$message.=' <td class="option">'.html_entity_decode($data[3]['q_option']).'</td>';
		$message.='</tr></table>';
		$message.='</span>';


		$message.='</div>';							
		$message.='</label>';
		$message.='</div>';
		$message.='</div>';  
		return $message;

	}


	function mdr_quiz_list($search="", $limit=10, $page=0){
		$this->db->where("deleted",0);
		$this->db->where("noq >",0);
		$this->db->where("status",0);
		if($search)
			$this->db->like("quiz_name", $search);
		$this->db->order_by("quid desc");
		$this->db->limit($limit);
		$this->db->offset($page*$limit);
		$data = $this->db->get("savsoft_quiz")->result_array();
		return $data;
	}

	function num_mdr_quiz($search=""){
		$this->db->select("quid");
		$this->db->where("deleted",0);
		$this->db->where("noq >",0);
		$this->db->where("status",0);
		if($search)
			$this->db->like("quiz_name", $search);
		$this->db->limit($limit);
		$this->db->offset($page*$limit);
		$data = $this->db->get("savsoft_quiz")->num_rows();
		return $data;
	}

	function get_quiz_info($quid, $page=0){
		$this->db->where("quid", $quid);
		$data['quiz'] = $this->db->get("savsoft_quiz")->row_array();
		if($data['quiz']){
			$sql= "select * from savsoft_qbank q join savsoft_category c on q.cid=c.cid join savsoft_level l on q.lid=l.lid where q.qid in (".$data['quiz']['qids'].") limit 5 offset ". (5*$page);
			$data['question_list']=$this->db->query($sql)->result_array();
		}
		return $data;
	}


	function moderate_quiz($quid){
		$this->db->where("quid", $quid);
		$this->db->update("savsoft_quiz", array("status"=>1));

		$this->db->where("quid", $quid);
		$q = $this->db->get("savsoft_quiz")->row_array();
		if($q['noq']>=10){
			$uid = $q['inserted_by'];
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$day = date('d/m/Y', time());
			$data=  array(
				"model"=>"quiz",
				"content_id"=>$quid,
				"uid"=>$uid,
				"day"=>$day
		   ); 
		   
		   $this->db->insert("event_statistics", $data);
		   
		   $sunday =date('d/m/Y', strtotime('sunday this week'));
		   $t=date('d/m/Y', strtotime('+1 day'));
		   $dif=1;
		   while($t <=$sunday){
			   $data=  array(
					"model"=>"quiz",
					"content_id"=>$quid,
					"uid"=>$uid,
					"day"=>$t
			   );
			   $this->db->insert("event_statistics", $data);
			   $dif++;
			   $t= 	date('d/m/Y', strtotime('+'.$dif.' day'));	   
		   }
		   $this->db->where("uid", $uid);
		   $this->db->where("day", $day);
		   $uppd = $this->db->get("event_day_points");
		   if($uppd->num_rows()>0){
				$this->db->where("uid", $uid);
				$this->db->where("day", $day);
				$do_points= $uppd->row_array()["do_points"]+1000;// Don't forget: create rule earn point replace 1000
				$total_points= $uppd->row_array()["total_points"]+1000;
				$this->db->update("event_day_points", array("do_points"=>$do_points, "total_points"=>$total_points));
		   }
		   else{
				$this->db->insert("event_day_points", array("day"=>$day,"uid"=>$uid,"do_points"=>1000, "total_points"=>1000));
		   } 
	   }
   } 
	
	 function get_quiz_data($quid){
		$this->db->select('qids,reading_mcq,video_mcq,reading')
							->where('quid', $quid);
		return $this->db->get('savsoft_quiz')->row_array();
	}
	function Quiz_file_model($start){
		$sql=" SELECT * FROM savsoft_permalink sp where sp.model='quiz' LIMIT 5000 ";
		if($start){
			$sql.="offset $start ";
		}
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
}
?>
