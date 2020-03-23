<?php
Class Api_model extends CI_Model
{
 
  function quiz_list($user,$limit){
	  $this->db->select("quid,quiz_name,duration,noq,maximum_attempts");
	  $this->db->where('deleted',0);
	   $this->db->where('status',1);
	  $logged_in=$user;
	  
	                  $setting_p=explode(',',$logged_in['quiz']);
			if(in_array('List',$setting_p)){
			$gid=$logged_in['gid'];
			$where="FIND_IN_SET('".$gid."', gids)";  
			 $this->db->where($where);
			}else if(in_array('List_all',$setting_p)){
			
			}
			 
			 
			 
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
		//$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('quid','desc');
		$query=$this->db->get('savsoft_quiz');
		return $query->result_array();
		
	 
 }
 

 function quiz_list_none_login($cid=0, $lid=0, $search="",  $sortby="",$page=0){
	 $sqlq= "select quid, quiz_name, qids from savsoft_quiz where noq>1 and deleted=0 and gids=5 and status=1 ";
	 if($search!=""){
		 $sqlq.= " and quiz_name like '%".$search."%'";
	 }
	 if($cid >0 && $lid>0){
		 $sqlq.= " and cid =".$cid." AND lid=".$lid; 
	 }
	 else{
		if($cid >0){
			$sqlq.= " and cid =".$cid;
		}
		else if($lid>0){
			$sqlq.= " and lid=".$lid;
		}
	 }
	 
	 if(in_array($sortby, array('answered desc','answered asc'))){
		$sqlq='select savsoft_quiz.quid, savsoft_quiz.quiz_name, savsoft_quiz.qids, count(savsoft_quiz.quid) as answered from savsoft_quiz
		INNER JOIN savsoft_result ON  savsoft_quiz.quid=savsoft_result.quid where noq>1 and deleted=0 and gids=5 and savsoft_quiz.status=1 and result_status!="open"';
		 if($cid >0 && $lid>0){
		 $sqlq.= " and cid =".$cid." AND lid=".$lid;  
		 }
		 else{
			if($cid >0){
				$sqlq.= " and cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
		$sqlq.=' GROUP BY savsoft_quiz.quid
		UNION
		select savsoft_quiz.quid, savsoft_quiz.quiz_name, savsoft_quiz.qids,0 as answered from savsoft_quiz 
		where quid NOT IN (select quid from savsoft_result where result_status!="open" ) and noq>1 and deleted=0 and gids=5 ';
		 if($cid >0 && $lid>0){
			$sqlq.= " and cid =".$cid." AND lid=".$lid;  
		 }
		 else{
			if($cid >0){
				$sqlq.= " and cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
	 }
	 if(in_array($sortby, array('assigned desc','assigned asc'))){
		$sqlq='select savsoft_quiz.quid, savsoft_quiz.quiz_name, savsoft_quiz.qids, count(savsoft_quiz.quid) as assigned from savsoft_quiz
		INNER JOIN savsoft_assign ON  savsoft_quiz.quid=savsoft_assign.quid where noq>1 and deleted=0 and gids=5 and status=1 ';
		 if($cid >0 && $lid>0){
			$sqlq.= " and cid =".$cid." AND lid=".$lid;  
		 }
		 else{
			if($cid >0){
				$sqlq.= " and cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
		$sqlq.=' GROUP BY savsoft_quiz.quid
		UNION
		select savsoft_quiz.quid, savsoft_quiz.quiz_name, savsoft_quiz.qids,0 as assigned from savsoft_quiz 
		where quid NOT IN (select quid from savsoft_assign) and noq>1 and deleted=0 and gids=5 ';
		 if($cid >0 && $lid>0){
		  $sqlq.= " and cid =".$cid." AND lid=".$lid;   
		 }
		 else{
			if($cid >0){
				$sqlq.= " and cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
	 }
	 
	  if($sortby!=''){
		  $sqlq1=$sqlq." ORDER BY ".$sortby;
	 }
	 else{
		  $sqlq1=$sqlq." ORDER BY quid desc";
	 }
   	 $sqlq1.=" limit 9 offset ".($page*9);
	 
	
	
	 $data['quiz']= $this->db->query($sqlq1)->result_array();
	 
	 $data['numpage']= ceil($this->db->query($sqlq)->num_rows()/9);
	 for($k=0; $k<count($data['quiz']); $k++){
		 
		 $this->db->where('content_id',$data['quiz'][$k]['quid'] );
		 $this->db->where('model','quiz');
		$data['quiz'][$k]['permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
		 $sql = "select question,cid,lid from savsoft_qbank where deleted =0 and qid in (".$data['quiz'][$k]['qids'].") limit 1 ";
		 $question= $this->db->query($sql)->row_array();
		 $origImageSrc="";
		 $origvidSrc="";
		 preg_match_all('/<img[^>]+>/i',$question['question'], $imgTags); 
		 for ($j = 0; $j < count($imgTags[0]); $j++) {
			preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
			$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
			
		 }
		  if($origImageSrc){
			if(strpos($origImageSrc, "latex.codecogs.com")===false)
				 $data['quiz'][$k]['img']=$origImageSrc;
			  else
			     $data['quiz'][$k]['img']=base_url("upload/default_image_quiz.png");
		  }
		  else
			 $data['quiz'][$k]['img']=base_url("upload/default_image_quiz.png");
		  $data['quiz'][$k]['cid']=$question['cid'];
		 $data['quiz'][$k]['lid']=$question['lid'];
	 }
	 return $data;	
	 
 }
 
 
 function quiz_list_login($cid=0, $lid=0, $search="",  $sortby="",$page=0){
	 $user= $this->session->userdata('logged_in');
	 $sqlq= "select quid,inserted_by, quiz_name, qids from savsoft_quiz where noq>=1 and deleted=0 and gids=5 and status=1 ";
	 if($search!=""){
		 $sqlq.= " and quiz_name like '%".$search."%'";
	 }
	 if($cid >0 && $lid>0){
		 $sqlq.= " and cid =".$cid." AND lid=".$lid; 
	 }
	 else{
		if($cid >0){
			$sqlq.= " and cid =".$cid;
		}
		else if($lid>0){
			$sqlq.= " and lid=".$lid;
		}
	 }
	 
	 if(in_array($sortby, array('answered desc','answered asc'))){
		$sqlq='select savsoft_quiz.quid,savsoft_quiz.inserted_by, savsoft_quiz.quiz_name, savsoft_quiz.qids, count(savsoft_quiz.quid) as answered from savsoft_quiz
		INNER JOIN savsoft_result ON  savsoft_quiz.quid=savsoft_result.quid where noq>1 and savsoft_quiz.deleted=0 and savsoft_quiz.gids=5 and savsoft_quiz.status=1 and result_status!="open"';
		 if($cid >0 && $lid>0){
		 $sqlq.= " and savsoft_quiz.cid =".$cid." AND savsoft_quiz.lid=".$lid;  
		 }
		 else{
			if($cid >0){
				$sqlq.= " and savsoft_quiz.cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and savsoft_quiz.lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
		$sqlq.=' GROUP BY savsoft_quiz.quid
		UNION
		select savsoft_quiz.quid,savsoft_quiz.inserted_by, savsoft_quiz.quiz_name, savsoft_quiz.qids,0 as answered from savsoft_quiz 
		where quid NOT IN (select quid from savsoft_result where result_status!="open" ) and noq>1 and deleted=0 and gids=5 and status=1 ';
		 if($cid >0 && $lid>0){
			$sqlq.= " and cid =".$cid." AND lid=".$lid;  
		 }
		 else{
			if($cid >0){
				$sqlq.= " and cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
	 }
	 if(in_array($sortby, array('assigned desc','assigned asc'))){
		$sqlq='select savsoft_quiz.quid,savsoft_quiz.inserted_by, savsoft_quiz.quiz_name, savsoft_quiz.qids, count(savsoft_quiz.quid) as assigned from savsoft_quiz
		INNER JOIN savsoft_assign ON  savsoft_quiz.quid=savsoft_assign.quid where noq>1 and savsoft_quiz.deleted=0 and savsoft_quiz.gids=5 and savsoft_quiz.status=1 ';
		 if($cid >0 && $lid>0){
			$sqlq.= " and cid =".$cid." AND lid=".$lid;  
		 }
		 else{
			if($cid >0){
				$sqlq.= " and cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
		$sqlq.=' GROUP BY savsoft_quiz.quid
		UNION
		select savsoft_quiz.quid,savsoft_quiz.inserted_by, savsoft_quiz.quiz_name, savsoft_quiz.qids,0 as assigned from savsoft_quiz 
		where quid NOT IN (select quid from savsoft_assign) and noq>1 and deleted=0 and gids=5 ';
		 if($cid >0 && $lid>0){
		  $sqlq.= " and cid =".$cid." AND lid=".$lid;   
		 }
		 else{
			if($cid >0){
				$sqlq.= " and cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
	 }
	 
	 if($sortby=="mine"){
		$sqlq='select savsoft_quiz.quid,savsoft_quiz.inserted_by, savsoft_quiz.quiz_name, savsoft_quiz.qids, count(savsoft_quiz.quid) as assigned from savsoft_quiz
		 where noq>1 and deleted=0 and gids=5 and savsoft_quiz.inserted_by = '.$user['uid'].' ';
		 if($cid >0 && $lid>0){
			$sqlq.= " and cid =".$cid." AND lid=".$lid;  
		 }
		 else{
			if($cid >0){
				$sqlq.= " and cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
		$sqlq.=' GROUP BY savsoft_quiz.quid';
		 if($cid >0 && $lid>0){
		  $sqlq.= " and cid =".$cid." AND lid=".$lid;   
		 }
		 else{
			if($cid >0){
				$sqlq.= " and cid =".$cid;
			}
			else if($lid>0){
				$sqlq.= " and lid=".$lid;
			}
		 }
		 if(trim($search)!=""){
			 $sqlq.= " and quiz_name like '%".$search."%'";
		 }
		 $sqlq1=$sqlq;
	 }

	 else if($sortby!='' ){
		  $sqlq1=$sqlq." ORDER BY ".$sortby;
	 }
	 else{
		  $sqlq1=$sqlq." ORDER BY quid desc";
	 }
   	 $sqlq1.=" limit 12 offset ".($page*12);
	 
	
	
	 $data['quiz']= $this->db->query($sqlq1)->result_array();
	 
	
	 for($i =0; $i<count( $data['quiz']); $i++){
		 
		 $this->db->insert("user_views", array("model"=>"quiz", "content_id"=>$data['quiz'][$i]['quid'], "uid"=>$user["uid"]));
		 $this->db->where('reviewer', $user['uid']);
		 $this->db->where('model', "savsoft_quiz");
		 $this->db->where('reviewid',  $data['quiz'][$i]['quid']);
		 $reid=$this->db->get('savsoft_review')->row_array();
		 if($reid){
			$data['quiz'][$i]['reid']=$reid['id'];
			$data['quiz'][$i]['r_content']=$reid['content'];
			$data['quiz'][$i]['r_value']=$reid['value'];
		 }
		 else{
			 $data['quiz'][$i]['reid']=0;
			$data['quiz'][$i]['content']="";
			$data['quiz'][$i]['r_value']=0;
		 
		 }
		
		 $this->db->where('model', "savsoft_quiz");
		 $this->db->where('reviewid',  $data['quiz'][$i]['quid']);
		 $rated=$this->db->get('savsoft_review');
		 $data['quiz'][$i]['num_rated'] = $rated->num_rows();
         if($rated->num_rows()>0){
			$rt=$rated->result_array();
			$sum=0;
			foreach($rt as $r){
				$sum+= $r['value'];
			}
            
			$data['quiz'][$i]['avg_rated'] = $sum/$data['quiz'][$i]['num_rated'];
		 }
		 else{
			 $data['quiz'][$i]['avg_rated']=0;
		 }
	 }
	 $data['numpage']= ceil($this->db->query($sqlq)->num_rows()/12);
	 for($k=0; $k<count($data['quiz']); $k++){
		 
		 $this->db->where('content_id',$data['quiz'][$k]['quid'] );
		 $this->db->where('model','quiz');
		$data['quiz'][$k]['permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
		 $sql = "select question,cid,lid from savsoft_qbank where deleted =0 and qid in (".$data['quiz'][$k]['qids'].") limit 1 ";
		 $question= $this->db->query($sql)->row_array();
		 $origImageSrc="";
		 $origvidSrc="";
		 preg_match_all('/<img[^>]+>/i',$question['question'], $imgTags); 
		 for ($j = 0; $j < count($imgTags[0]); $j++) {
			preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
			$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
			
		 }
		  if($origImageSrc){
			  if(strpos($origImageSrc, "latex.codecogs.com")===false)
				 $data['quiz'][$k]['img']=$origImageSrc;
			  else
			     $data['quiz'][$k]['img']=base_url("upload/default_image_quiz.png");
		  }
			  
		  else
			 $data['quiz'][$k]['img']=base_url("upload/default_image_quiz.png");
		  $data['quiz'][$k]['cid']=$question['cid'];
		 $data['quiz'][$k]['lid']=$question['lid'];
	 }
	 return $data;	
	 
 }
 
 function question_list_none_login($cid=0, $lid=0, $search="", $sortby="", $page=0){
	 $search = htmlentities($search,ENT_NOQUOTES, 'UTF-8') ;
	 $sql = 'select * from savsoft_qbank';
	 
	 $sql.= ' where deleted=0';
	 if($cid>0){
		 $sql.=' AND cid='.$cid;
	 }
	 if($lid>0){
		 $sql.=' AND lid='.$lid;
	 }
	 if(trim($search)!=""){
		 $sql.=" AND question like '%".$search."%'";
	 }
	 
	 $data['numpage']=ceil($this->db->query($sql)->num_rows()/10);
	 if(in_array($sortby, array('answered desc','answered asc'))){
		$sql='select savsoft_qbank.*, count(savsoft_qbank.qid) as answered from savsoft_qbank 
		INNER JOIN savsoft_answer_mcq ON  savsoft_qbank.qid=savsoft_answer_mcq.qid where savsoft_qbank.deleted=0 '; 
		 if($cid>0){
		 $sql.=' AND cid='.$cid;
		 }
		 if($lid>0){
			 $sql.=' AND lid='.$lid;
		 }
		 if(trim($search)!=""){
			 $sql.=" AND question like '%".$search."%'";
		 }
		$sql.=' GROUP BY savsoft_qbank.qid
		UNION
		select *,0 as answered from savsoft_qbank 
		where qid NOT IN (select qid from savsoft_answer_mcq) and deleted=0 ';
		 if($cid>0){
		 $sql.=' AND cid='.$cid;
		 }
		 if($lid>0){
			 $sql.=' AND lid='.$lid;
		 }
		 if(trim($search)!=""){
			 $sql.=" AND question like '%".$search."%'";
		 }
	 }
	 
	 if(in_array($sortby, array('assigned desc','assigned asc'))){
		$sql='select savsoft_qbank.*, count(savsoft_qbank.qid) as assigned from savsoft_qbank 
		INNER JOIN savsoft_qassign ON  savsoft_qbank.qid=savsoft_qassign.qid where deleted=0 ';
		 if($cid>0){
		 $sql.=' AND cid='.$cid;
		 }
		 if($lid>0){
			 $sql.=' AND lid='.$lid;
		 }
		 if(trim($search)!=""){
			 $sql.=" AND question like '%".$search."%'";
		 }
		$sql.=' GROUP BY savsoft_qbank.qid
		UNION
		select *,0 as assigned from savsoft_qbank 
		where qid NOT IN (select qid from savsoft_qassign) and deleted=0 ';
		if($cid>0){
		 $sql.=' AND cid='.$cid;
		 }
		 if($lid>0){
			 $sql.=' AND lid='.$lid;
		 }
		 if(trim($search)!=""){
			 $sql.=" AND question like '%".$search."%'";
		 }
	 }
	 if(!$sortby==''){
		 
		 $sql.=' order by '.$sortby;
	 }
	 else{
		 $sql.=' order by create_date desc ';
	 }
	 $sql.=' limit 10 offset '.(10*$page);
	 
	 $data['question']= $this->db->query($sql)->result_array();
	 for($i=0; $i<count($data['question']); $i++){
		 $this->db->where("qid",$data['question'][$i]['qid'] );
		 $data['question'][$i]['options']=$this->db->get('savsoft_options')->result_array();
		 $this->db->where("content_id",$data['question'][$i]['qid'] );
		 $this->db->where("model",'qbank' );
		 $data['question'][$i]['permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
		  $this->db->where("cid",$data['question'][$i]['cid'] );
		 $data['question'][$i]['category_name']=$this->db->get('savsoft_category')->row_array()['category_name'];
		 $this->db->where("content_id",$data['question'][$i]['cid'] );
		 $this->db->where("model",'category' );
		 $data['question'][$i]['category_permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
		 if(strpos($data['question'][$i]['question'],'latex.codecogs.com')!==false || strpos($data['question'][$i]['question'],'www.w3.org/1998/Math/MathML')!==false){
			 $origImageSrc="";
			 $origvidSrc="";
			 preg_match_all('/<img[^>]+>/i', $data['question'][$i]['question'], $imgTags); 
			 for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			  if($origImageSrc)
				 $data['question'][$i]['img']=$origImageSrc;
			  else
			$data['question'][$i]['img']="";
		}
		else{
			$data['question'][$i]['img']="";
		}
		 $this->db->where('qid',$data['question'][$i]['qid']);
		$data['question'][$i]['n_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
		$this->db->where('qid',$data['question'][$i]['qid']);
		$this->db->where('istrue',1);
		$data['question'][$i]['n_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
		$this->db->where('model', 'qbank');
		$this->db->where('content_id', $data['question'][$i]['qid']);
		$this->db->where('status', 1);
		$data['question'][$i]['n_like']=$this->db->get('savsoft_like')->num_rows();
		
		$this->db->select("su,logo,text_license,out_link");
		 $this->db->where("uid",  $data['question'][$i]['inserted_by']);
		 $qr=$this->db->get("savsoft_users")->row_array();
		$data['question'][$i]['create_su']=$qr['su'];
		 $data['question'][$i]['logo']=$qr['logo'];
		 $data['question'][$i]['text_license']=$qr['text_license'];
		 $data['question'][$i]['out_link']=$qr['out_link'];
		
	 }
	 
	 return $data;	
	 
 }
function no_quiz($user){
	  $this->db->select("quid,quiz_name,duration,noq,maximum_attempts");
	  $this->db->where('deleted',0);
	  $logged_in=$user;
			if($logged_in['su']=='0'){
			$gid=$logged_in['gid'];
			$where="FIND_IN_SET('".$gid."', gids)";  
			 $this->db->where($where);
			}
			
			
	 
		//$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('quid','desc');
		$query=$this->db->get('savsoft_quiz');
		return $query->num_rows();
		
	 
 }
 

 

function no_attempted($user){
$uid=$user['uid'];
 $query=$this->db->query("select * from savsoft_result where uid='$uid' group by quid");
return $query->num_rows();						

}

function no_pass($user){
$uid=$user['uid'];
 $query=$this->db->query("select * from savsoft_result where uid='$uid' and result_status='Pass' group by quid");
return $query->num_rows();						

}

function no_fail($user){
$uid=$user['uid'];
 $query=$this->db->query("select * from savsoft_result where uid='$uid' and result_status='Fail' group by quid");
return $query->num_rows();						

}




  function result_list($user,$limit,$status='0'){
	$result_open=$this->lang->line('open');
	$logged_in=$user;
	$uid=$logged_in['uid'];
	  
	 
		 $this->db->where('savsoft_result.result_status !=',$result_open);
	  
	 
	    $setting_p=explode(',',$logged_in['result']);
			if(in_array('List_all',$setting_p)){
			 
			
			}else{
			$this->db->where('savsoft_result.uid',$uid);
			}
			 
			 
			 
	 	 
		
	 	if($status !='0'){
			$this->db->where('savsoft_result.result_status',$status);
		}
		
		
		
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('rid','desc');
		$this->db->join('savsoft_users','savsoft_users.uid=savsoft_result.uid');
		$this->db->join('savsoft_quiz','savsoft_quiz.quid=savsoft_result.quid');
		$query=$this->db->get('savsoft_result');
		return $query->result_array();
		
	 
 }


function get_notification($user,$limit){
	$logged_in=$user;
	$uid=$logged_in['uid'];
	  
 $this->db->select('title,message,notification_date');
 	$this->db->or_where('savsoft_notification.uid',$uid);
	$this->db->or_where('savsoft_notification.uid','0');
	 	//$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('nid','desc');
		$query=$this->db->get('savsoft_notification');
		return $query->result_array();

 }
 
 
 
 
 
 
  function submit_result($user,$rid){
	 $logged_in=$user;
	 $email=$logged_in['email'];
	 
	$query=$this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
	$quiz=$query->row_array(); 
	$score_ind=explode(',',$quiz['score_individual']);
	$r_qids=explode(',',$quiz['r_qids']);
	$qids_perf=array();
	$marks=0;
	$correct_score=$quiz['correct_score'];
	$incorrect_score=$quiz['incorrect_score'];
	$total_time=array_sum(explode(',',$quiz['individual_time']));
	$manual_valuation=0;
	foreach($score_ind as $mk => $score){
		$qids_perf[$r_qids[$mk]]=$score;
		
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
	$percentage_obtained=($marks/$quiz['noq'])*100;
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
	

	return true;
 }
 
 
 
  function set_ind_time($rid){
	 	 
	 $userdata=array(
	 'individual_time'=>$_POST['individual_time'],
	 
	 );
	 $this->db->where('rid',$rid);
	 $this->db->update('savsoft_result',$userdata);
	 
	 return true;
 }
 
 function insert_answer($user,$rid){
	 
	$logged_in=$user;
	$uid=$logged_in['uid'];
	
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
 
 
function register($email,$first_name,$last_name,$password,$contact_no,$gid){

		$userdata=array(
		'email'=>urldecode($email),
//'password'=>md5($this->input->post('password')),
		'password'=>urldecode(md5($password)),
		'first_name'=>urldecode($first_name),
		'last_name'=>urldecode($last_name),
		'contact_no'=>urldecode($contact_no),
		'gid'=>$gid,
		'su'=>'2'		
		);
		$veri_code=rand('1111','9999');
		 if($this->config->item('verify_email')){
			$userdata['verify_code']=$veri_code;
		 }
 
		if($this->db->insert('savsoft_users',$userdata)){
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
		
			$toemail=$email;
			 
			$this->email->to($toemail);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			if(!$this->email->send()){
			 //print_r($this->email->print_debugger());
			
			}
			 
				 
			 }
			 
			return true;
		}else{
			
			return false;
		}
	 

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


  	function question_list(){
		$logged_in=$this->session->userdata('logged_in');
	 	
		if($logged_in['uid'] != '1'){
			$uid=$logged_in['uid'];
	 		$this->db->where('savsoft_qbank.inserted_by',$uid);
	 	}
		$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
	 	$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
		$this->db->order_by('savsoft_qbank.qid','desc');
		$this->db->where('savsoft_qbank.deleted',0);
		$query=$this->db->get('savsoft_qbank');
		return $query->result_array(); 
 	}
	
	function question_list3(){
		$logged_in=$this->session->userdata('logged_in');
	 	
		if($logged_in['uid'] != '1'){
			$uid=$logged_in['uid'];
	 		$this->db->where('savsoft_qbank.inserted_by',$uid);
	 	}
		$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
	 	$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
		$this->db->order_by('savsoft_qbank.qid','desc');
		$this->db->where('savsoft_qbank.deleted',0);
		$query=$this->db->get('savsoft_qbank')->result_array();
		for($i=0; $i<count($query); $i++){
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$query[$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
            for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
			 if(count($imgTags[0])>0){
				 $qt='<div class="col-md-3 col-xs-3" ><img class="img-responsive" src="'.$origImageSrc.'" /></div>';
				 $qt.='<div class="col-md-9 col-xs-3" >'.strip_tags($query[$i]['question']).'</div>';
				 $query[$i]['question']=$qt;
			 }
			 $origvidSrc="";
			$vidTags="";
			preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			if(count($vidTags[0])>0){
				 $qt='<div class="col-md-3 col-xs-3" >'.$vidTags[0][0].'</iframe></div>';
				 $qt.='<div class="col-md-9 col-xs-9" >'.strip_tags($query[$i]['question']).'</div>';
				 $query[$i]['question']=$qt;
			} 
		}
		return $query; 
 	}
	function question_list2(){
		$logged_in=$this->session->userdata('logged_in');
	 	$this->db->where('savsoft_qbank.deleted',0);
		if($logged_in['uid'] != '1' && $logged_in['su']!=6){
			$uid=$logged_in['uid'];
	 		$this->db->where('savsoft_qbank.inserted_by',$uid);
	 	}
		$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
	 	$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
		$this->db->order_by('savsoft_qbank.qid','desc');
		$query['question']=$this->db->get('savsoft_qbank')->result_array();
		for($i=0; $i<count($query['question']); $i++){
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$query['question'][$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
            for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			 }
			 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
			 if(count($imgTags[0])>0){
				 $qt='<div class="col-md-3 col-xs-3" ><img class="img-responsive" src="'.$origImageSrc.'" /></div>';
				 $qt.='<div class="col-md-9 col-xs-3" >'.strip_tags($query['question'][$i]['question']).'</div>';
				 $query['question'][$i]['question']=$qt;
			 }
			 $origvidSrc="";
			$vidTags="";
			preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			if(count($vidTags[0])>0){
				 $qt='<div class="col-md-3 col-xs-3" >'.$vidTags[0][0].'</iframe></div>';
				 $qt.='<div class="col-md-9 col-xs-9" >'.strip_tags($query['question'][$i]['question']).'</div>';
				 $query['question'][$i]['question']=$qt;
			} 
			$sql= "select user_code from savsoft_users where uid = ".$query['question'][$i]['inserted_by'];
			$query['question'][$i]['user_code']=$this->db->query($sql)->row_array()['user_code'];
			$q_id=$query['question'][$i]['qid'];
			$sql2 = "select * from savsoft_review where model='savsoft_qbank' and reviewid= $q_id";
			$rate =$this->db->query($sql2);
			if($rate->num_rows()>0){
				$totalrate = 0;
				$arrate=$rate->result_array();
				foreach($arrate as $r){
					$totalrate+=$r['value'];
				}
				$query['question'][$i]['rated']=$totalrate/$rate->num_rows();
				$query['question'][$i]['nrate']=$rate->num_rows();
			}
			else{
				$query['question'][$i]['rated']=0;
				$query['question'][$i]['nrate']=$rate->num_rows();
			}
		}
		$query['category']=$this->db->get('savsoft_category')->result_array();
		$query['level']=$this->db->get('savsoft_level')->result_array();
		$query['su']= $logged_in['su'];
		return $query; 
 	}
	

	
	
 	function get_question($qid){
		
		$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
	 	$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
		$this->db->order_by('savsoft_qbank.qid','desc');
		$this->db->where('qid', $qid);
		$this->db->where('deleted',0);
		$qt=$this->db->get('savsoft_qbank')->result_array()[0];
		
		$origImageSrc="";
		$imgTags="";	
		$htmlContent=$qt['question'];
		$qt['img']="";
		if(strpos($htmlContent,'https://latex.codecogs.com')===false){
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 			
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
			}
				
			 $qt['img']=$origImageSrc;
						
           }				 
		
		$qt['question']=html_entity_decode($qt['question']);
		$qt['description']=html_entity_decode($qt['description']);
		$this->db->where('qid', $qid);
		$ops = $this->db->get('savsoft_options')->result_array();
        $qt['options']=$ops;
		for($i=0; $i<4; $i++){
			 $qt['options'][$i]['q_option']=html_entity_decode($qt['options'][$i]['q_option']);
			 if($qt['options'][$i]['score']>0){
        		$qt['c_option']=$i;
        	}
		}
       
        $tag_str = '';
        $this->db->where('question_id', $qid);
        $tag_ids = $this->db->get('question_tag_rel')->result_array();
        foreach($tag_ids as $k=> $tag_id){
        	$this->db->where('tag_id', $tag_id['tag_id']);
        	$tag_name=$this->db->get('tags')->result_array()[0]['tag_name'];
        	if($k>0)
        	 	$tag_str = $tag_str .','. $tag_name;
        	else
        		$tag_str = $tag_str. $tag_name;
        }
        $qt['tags']=$tag_str;
		return $qt; 
 	}


 	function result_lists(){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
	 	
		$sql = "select * FROM savsoft_result r inner join savsoft_users u on u.uid=r.uid inner join savsoft_quiz q on q.quid=r.quid where 1=1 and r.result_status != 'Open' ";

		$setting_p=explode(',',$logged_in['result']);
		if(!in_array('List_all',$setting_p) and $logged_in['su'] != '1'){
			$sqlone = " and (u.uid = ".$uid." or u.parent_id = ".$uid." or r.uid = ".$uid." ";
			if($logged_in['su'] == '3'){
				$sqltwo = " or u.class_id in(".$class_id.") ";
				$sqlone .= $sqltwo;
			}
			$sqlone .= ") ";
			$sql .= $sqlone;
		}
		$sql .= " order by r.rid desc";
		//log_message('error', $sql);
		$query = $this->db->query($sql);

	 	return $query->result_array();

		/*$setting_p=explode(',',$logged_in['result']);
		if(!in_array('List_all',$setting_p)){
			$this->db->or_where('savsoft_users.uid',$uid);
			$this->db->or_where('savsoft_users.parent_id',$uid);
			$this->db->or_where('savsoft_result.uid',$uid);
			if($logged_in['su'] == '3'){
				$this->db->or_where('savsoft_users.class_id', $class_id);
			}
		}
		
		$this->db->order_by('rid','desc');
		$this->db->join('savsoft_users','savsoft_users.uid=savsoft_result.uid');
		$this->db->join('savsoft_quiz','savsoft_quiz.quid=savsoft_result.quid');
		$query=$this->db->get('savsoft_result');
		return $query->result_array(); */
 	}
    
	 function num_result($search=""){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
	 	
		$sql = "select r.rid FROM savsoft_result r inner join savsoft_users u on u.uid=r.uid inner join savsoft_quiz q on q.quid=r.quid where r.result_status != 'Open' ";
        if($search){
			$sql.= " and (q.quiz_name like '%".$search."%' or u.first_name like '%".$search."%')";
		}
		$setting_p=explode(',',$logged_in['result']);
		if(!in_array('List_all',$setting_p) and $logged_in['su'] != '1'){
			$sqlone = " and (u.uid = ".$uid." or u.parent_id = ".$uid." or r.uid = ".$uid." ";
			if($logged_in['su'] == '3'){
				if($class_id){
					$sqltwo = " or u.class_id in(".$class_id.") ";
					$sqlone .= $sqltwo;
				}
			}
			$sqlone .= ") ";
			$sql .= $sqlone;
		}
		$sql .= " order by r.rid desc";
		$query = $this->db->query($sql);

	 	return $query->num_rows();
 	}
	
	function result_list_1($search="",$limit=10,$page=0){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
	 
		$sql = "select r.rid, u.first_name, u.last_name, q.quiz_name,r.result_status, r.percentage_obtained FROM savsoft_result r inner join savsoft_users u on u.uid=r.uid inner join savsoft_quiz q on q.quid=r.quid where r.result_status != 'Open' ";
        if($search){
			$sql.= " and (q.quiz_name like '%".$search."%' or u.first_name like '%".$search."%')";
		}
		$setting_p=explode(',',$logged_in['result']);
		if(!in_array('List_all',$setting_p) and $logged_in['su'] != '1'){
			$sqlone = " and (u.uid = ".$uid." or u.parent_id = ".$uid." or r.uid = ".$uid." ";
			if($logged_in['su'] == '3'){
				if($class_id){
					$sqltwo = " or u.class_id in(".$class_id.") ";
					$sqlone .= $sqltwo;
				}
			}
			$sqlone .= ") ";
			$sql .= $sqlone;
		}
		$sql .= " order by r.rid desc limit $limit Offset ".($limit*$page);
		$query = $this->db->query($sql);

	 	return $query->result_array();
 	}
	
	
 	function quiz_list_new($user){
 		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$gid=$logged_in['gid'];
		$sql="select q.quid,q.gids, q.quiz_name, q.duration, q.noq, q.maximum_attempts, count(r.id) as rrating, SUM(r.value) as rvalue, GROUP_CONCAT(CONCAT('', r.reviewer , '')) as reviewer, (select x.id from savsoft_review x where x.reviewer = ".$uid." and x.reviewid = q.quid and x.model = 'savsoft_quiz') as reid, (select s.value from savsoft_review s where s.reviewer = ".$uid." and s.reviewid = q.quid and s.model = 'savsoft_quiz') as reviewervalue, (select z.content from savsoft_review z where z.reviewer = ".$uid." and z.reviewid = q.quid and z.model = 'savsoft_quiz') as reviewercontent, (select count(*) from savsoft_review c where c.reviewid = q.quid and c.model = 'savsoft_quiz') as reviewcount from savsoft_quiz q left join savsoft_review r on r.reviewid = q.quid where 1 = 1";

		$setting_p=explode(',',$logged_in['quiz']);
		if(in_array('List',$setting_p) and $logged_in['su'] != '1'){
			$sqlone = " and q.gids in(".$gid.") ";
			$sql .= $sqlone;
		}

		$sql .= "  and q.noq > 0 and q.deleted=0";

		if($logged_in['su'] == '3'){
			$sqltwo = " or q.gids like '%5%'  and q.noq > 0 and q.deleted=0 or inserted_by = ".$uid."  and q.noq > 0  and q.deleted=0";
			$sql .= $sqltwo;
		}

		$sql .= " group by q.quid order by q.quid asc";

		$query = $this->db->query($sql);

	 	return $query->result_array();
 	}

 	function quiz_lists($user){
	  	$this->db->select("savsoft_quiz.quid,savsoft_quiz.quiz_name,savsoft_quiz.duration,savsoft_quiz.noq,savsoft_quiz.maximum_attempts, count(savsoft_review.id) as rrating, sum(savsoft_review.value) as rvalue");
	  	$logged_in=$user;
	  
		$setting_p=explode(',',$logged_in['quiz']);
		if(in_array('List',$setting_p)){
			$gid=$logged_in['gid'];
			$where="FIND_IN_SET('".$gid."', gids)";  
			 $this->db->where($where);
		}else if(in_array('List_all',$setting_p)){
			
		}
			 
			 
			 
		/*if($logged_in['su']=='0'){
			$gid=$logged_in['gid'];
			$where="FIND_IN_SET('".$gid."', gids)";  
			$this->db->where($where);
		}*/

		if($logged_in['su'] == '3'){
			$uid=$logged_in['uid'];
	 		$this->db->where('inserted_by',$uid);
		}

		/*if($logged_in['su']=='2'){
			$uid=$logged_in['uid'];
			$where="FIND_IN_SET('".$uid."', uids)";  
			$this->db->where($where);
		}*/
		$this->db->or_like('gids', '5');
		$this->db->where('noq >',0);
		$this->db->group_by('savsoft_quiz.quid');
		$this->db->order_by('quid','asc');
		//$this->db->where('savsoft_review.model', 'savsoft_quiz');
		$this->db->join('savsoft_review','savsoft_review.reviewid=savsoft_quiz.quid');
		$query=$this->db->get('savsoft_quiz');
		//log_message('error', $query);
		return $query->result_array();
		
	 
    }

    function get_quiz_avatar($quid){
		$sql="select quid, qids, noq,img_video, img_reading from savsoft_quiz where quid=$quid";
		$query=$this->db->query($sql);

		if($query->num_rows()>0){
			$result=$query->row_array();

				if(!$result['img_video'] && !$result['img_reading']){
					$qids=explode(',',$result['qids']);
					foreach ($qids as $key => $value) {
						$sql_qid="select * from savsoft_qbank where qid=$value";
						$query_qid=$this->db->query($sql_qid);
						$question=$query_qid->row_array();

							$start=strpos($question['question'],'<img');
							$end=strpos($question['question'],'" />');

							if($start>0){
								$img=substr($question['question'],$start, $end-$start).'" />';		
								return $img;
								break;
							}else{
								return '<img src="https://do.stem.vn/upload/default_image_quiz.png" />';
									break;
							}	
					}
					

				}else if($result['img_video']){
					return $result['img_video'];

				}else if($result['img_reading']){
					return $result['img_reading'];
				}

		}else return false;
	}


	function quiz_assign_1($page,$uids=0,$cid=1,$arr=0,$search=""){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
		$class_id = $logged_in['class_id'];
		$parent_id = $logged_in ['parent_id'];
		if($class_id=="")
		$class_id=0;
		if($parent_id=="")
		$parent_id=0;
		if($logged_in['su']==2){		
			$sql = "SELECT  A.*, u.first_name, u.last_name,r.percentage_obtained,r.start_time FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid,a.uid ,a.status as sta, a.reward_point FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as A
					INNER JOIN savsoft_users u ON u.uid = A.uid
					LEFT JOIN savsoft_result r ON r.rid = A.rid
					WHERE A.uid=$uid";
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.auid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by A.sta asc, r.start_time desc";
			
			
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/5);	
			$sql.= " limit 5 Offset ".(5*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();
		
			$sql_name="(select u.uid ,u.first_name from savsoft_users u WHERE u.uid IN ($parent_id) and u.su=4)
					UNION
					(select u.uid,u.first_name from savsoft_users u join class_member cm on u.uid = cm.member_id 
					where (cm.class_id in ($class_id) and u.su=3) ) ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();
		
		
		}
		if($logged_in['su']==4){		
			$sql = "SELECT A.quid, A.quiz_name, A.startdate, A.enddate,A.sta as sta, A.rid as rid,A.status, A.first_name,A.last_name,A.reward_point, A.price, A.aname,r.percentage_obtained, n.rid, hp.point_remain,hp.modify_date FROM 
					(SELECT B.* ,u1.first_name as first_name, u1.last_name as last_name FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid, a.uid ,a.status as sta, a.reward_point, a.price FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as B 
					INNER JOIN savsoft_users u1 ON B.uid=u1.uid) as A
					INNER JOIN savsoft_users u ON u.uid = A.auid 
					LEFT JOIN savsoft_result r ON r.rid = A.rid
					LEFT JOIN notify n ON n.rid = r.rid
					LEFT JOIN history_point hp ON hp.nid=n.nid and hp.uid=A.auid
					WHERE A.auid=$uid  ";
					
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.uid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by A.sta desc, hp.modify_date desc ";	
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/5);	
			$sql.= " limit 5 Offset ".(5*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();
			// phụ huynh
			$sql_name="select * from savsoft_users where parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid' or parent_id='$uid' order by uid ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();
		
		
		}
		if($logged_in['su']==1 || $logged_in['su']==3 || $logged_in['su']==6){		
			$sql = "SELECT A.quid, A.quiz_name, A.startdate, A.enddate,A.sta as sta,A.rid as rid, A.first_name,A.last_name, A.reward_point, A.price, A.aname,r.percentage_obtained FROM 
					(SELECT B.* ,u1.first_name as first_name, u1.last_name as last_name FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid, a.uid ,a.status as sta, a.reward_point, a.price FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as B 
					INNER JOIN savsoft_users u1 ON B.uid=u1.uid) as A
					INNER JOIN savsoft_users u ON u.uid = A.auid 
					LEFT JOIN savsoft_result r ON r.rid = A.rid

					WHERE A.auid=$uid";
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.uid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by A.startdate desc ";
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/5);	
			$sql.= " limit 5 Offset ".(5*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();
			// giao viên
			$sql_name="select DISTINCT  u.*  from savsoft_users u join class_member cm 
					on u.uid = cm.member_id where cm.class_id in ($class_id) 
					and u.su=2 ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();
		
		
		}
		return $data;
	}
	function quiz_assign_2($page,$uids=0,$cid=1,$arr=0,$search=""){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
		$class_id = $logged_in['class_id'];
		$parent_id = $logged_in ['parent_id'];
		if($class_id=="")
		$class_id=0;
		if($parent_id=="")
		$parent_id=0;
		if($logged_in['su']==2){		
			$sql = "SELECT  A.*, u.first_name, u.last_name,r.percentage_obtained FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid,a.uid ,a.status as sta, a.reward_point FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as A
					INNER JOIN savsoft_users u ON u.uid = A.uid
					LEFT JOIN savsoft_result r ON r.rid = A.rid
					WHERE A.uid=$uid and A.sta=2";
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.auid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by r.end_time desc ";
			
			
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/5);	
			$sql.= " limit 5 Offset ".(5*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();
		
			$sql_name="(select u.uid ,u.first_name from savsoft_users u WHERE u.uid IN ($parent_id) and u.su=4)
					UNION
					(select u.uid,u.first_name from savsoft_users u join class_member cm on u.uid = cm.member_id 
					where (cm.class_id in ($class_id) and u.su=3) ) ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();
		
		
		}
		if($logged_in['su']==4){		
			$sql = "SELECT A.quid, A.quiz_name, A.startdate, A.enddate,A.sta as sta, A.rid as rid,A.status, A.first_name,A.last_name,A.reward_point, A.price, A.aname,r.percentage_obtained, n.rid, hp.point_remain,hp.modify_date FROM 
					(SELECT B.* ,u1.first_name as first_name, u1.last_name as last_name FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid, a.uid ,a.status as sta, a.reward_point, a.price FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as B 
					INNER JOIN savsoft_users u1 ON B.uid=u1.uid) as A
					INNER JOIN savsoft_users u ON u.uid = A.auid 
					LEFT JOIN savsoft_result r ON r.rid = A.rid
					LEFT JOIN notify n ON n.rid = r.rid
					LEFT JOIN history_point hp ON hp.nid=n.nid and hp.uid=A.auid
					WHERE A.auid=$uid  ";
					
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.uid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by A.sta desc, hp.modify_date desc ";	
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/5);	
			$sql.= " limit 5 Offset ".(5*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();
			// phụ huynh
			$sql_name="select * from savsoft_users where parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid' or parent_id='$uid' order by uid ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();
		
		
		}
		if($logged_in['su']==1 || $logged_in['su']==3 || $logged_in['su']==6){		
			$sql = "SELECT A.quid, A.quiz_name, A.startdate, A.enddate,A.sta as sta,A.rid as rid, A.first_name,A.last_name, A.reward_point, A.price, A.aname,r.percentage_obtained FROM 
					(SELECT B.* ,u1.first_name as first_name, u1.last_name as last_name FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid, a.uid ,a.status as sta, a.reward_point, a.price FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as B 
					INNER JOIN savsoft_users u1 ON B.uid=u1.uid) as A
					INNER JOIN savsoft_users u ON u.uid = A.auid 
					LEFT JOIN savsoft_result r ON r.rid = A.rid

					WHERE A.auid=$uid";
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.uid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by A.startdate desc ";
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/5);	
			$sql.= " limit 5 Offset ".(5*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();
			// giao viên
			$sql_name="select DISTINCT  u.*  from savsoft_users u join class_member cm 
					on u.uid = cm.member_id where cm.class_id in ($class_id) 
					and u.su=2 ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();
		
		
		}
		return $data;
	}
    function quiz_assign_3($page,$uids=0,$cid=1,$arr=0,$search=""){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
		$class_id = $logged_in['class_id'];
		$parent_id = $logged_in ['parent_id'];
		if($class_id=="")
		$class_id=0;
		if($parent_id=="")
		$parent_id=0;
		if($logged_in['su']==2){		
			$sql = "SELECT  A.*, u.first_name, u.last_name,r.percentage_obtained FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid,a.uid ,a.status as sta, a.reward_point FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as A
					INNER JOIN savsoft_users u ON u.uid = A.uid
					LEFT JOIN savsoft_result r ON r.rid = A.rid
					WHERE A.uid=$uid and A.sta=1";
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.auid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by A.startdate desc ";
			
			
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/5);	
			$sql.= " limit 5 Offset ".(5*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();
		
			$sql_name="(select u.uid ,u.first_name from savsoft_users u WHERE u.uid IN ($parent_id) and u.su=4)
					UNION
					(select u.uid,u.first_name from savsoft_users u join class_member cm on u.uid = cm.member_id 
					where (cm.class_id in ($class_id) and u.su=3) ) ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();
		
		
		}
		
		return $data;
	}

    function quiz_assign_4($page,$uids=0,$cid=1,$arr=0,$search=""){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
		$class_id = $logged_in['class_id'];
		$parent_id = $logged_in ['parent_id'];
		if($class_id=="")
		$class_id=0;
		if($parent_id=="")
		$parent_id=0;
		if($logged_in['su']==2){		
			$sql = "SELECT  A.*, u.first_name, u.last_name,r.percentage_obtained,r.start_time, r.end_time FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid,a.uid ,a.status as sta, a.reward_point FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as A
					INNER JOIN savsoft_users u ON u.uid = A.uid
					LEFT JOIN savsoft_result r ON r.rid = A.rid
					WHERE A.uid=$uid";
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.auid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by A.sta asc, r.start_time desc";
			
			
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/8);	
			$sql.= " limit 8 Offset ".(8*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();
		

			for ($i=0; $i < count($data['quiz']); $i++) { 
				//Gioi han chuoi tieu de bai quiz
					$str = $data['quiz'][$i]['quiz_name'];
					$length = 50;
					$minword = 3;
				 	$sub = '';
				    $len = 0;
				    foreach (explode(' ', $str) as $word)
				    {
				        $part = (($sub != '') ? ' ' : '') . $word;
				        $sub .= $part;
				        $len += strlen($part);
				        if (strlen($word) > $minword && strlen($sub) >= $length)
				        {
				          break;
				        }
				     }
				        $quiz_name = $sub . (($len < strlen($str)) ? '...' : '');

				        $data['quiz'][$i]['quiz_name']= $quiz_name;
				//---
				
				$data['quiz'][$i]['end_time']=date('d-m-Y',$data['quiz'][$i]['end_time']);
				$quid=$data['quiz'][$i]['quid'];
				//Lấy ảnh của bài quiz
				$sql="select quid, qids, noq,img_video, img_reading from savsoft_quiz where quid=$quid";
				$query=$this->db->query($sql);

				if($query->num_rows()>0){
					$result=$query->row_array();

						if(!$result['img_video'] && !$result['img_reading']){
							$qids=explode(',',$result['qids']);
							foreach ($qids as $key => $value) {
								$sql_qid="select * from savsoft_qbank where qid=$value";
								$query_qid=$this->db->query($sql_qid);
								$question=$query_qid->row_array();

									$start=strpos($question['question'],'<img');
									$end=strpos($question['question'],'" />');

									if($start>0){
										$img=substr($question['question'],$start, $end-$start).'" />';		
										$data['quiz'][$i]['avatar']= str_replace('<img ', '<img class="assign-item-avatar" ', $img);
										break;
									}else{
										$data['quiz'][$i]['avatar']= '<img class="assign-item-avatar" src="https://do.stem.vn/upload/default_image_quiz.png" />';
											break;
									}	
							}
							

						}else if($result['img_video']){
							$data['quiz'][$i]['avatar']='<img class="assign-item-avatar" src='.$result['img_video'].' />';

						}else if($result['img_reading']){
							$data['quiz'][$i]['avatar']='<img class="assign-item-avatar" src='.$result['img_reading'].' />';
						}

				}else return false;

			}

			$sql_name="(select u.uid ,u.first_name from savsoft_users u WHERE u.uid IN ($parent_id) and u.su=4)
					UNION
					(select u.uid,u.first_name from savsoft_users u join class_member cm on u.uid = cm.member_id 
					where (cm.class_id in ($class_id) and u.su=3) ) ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();
		
		
		}
		
		return $data;
	}
	function quiz_assign_5($page,$uids=0,$cid=1,$arr=0,$search=""){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
		$class_id = $logged_in['class_id'];
		$parent_id = $logged_in ['parent_id'];
		if($class_id=="")
		$class_id=0;
		if($parent_id=="")
		$parent_id=0;
		if($logged_in['su']==2){		
			$sql = "SELECT  A.*, u.first_name, u.last_name,r.percentage_obtained,r.end_time FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid,a.uid ,a.status as sta, a.reward_point FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as A
					INNER JOIN savsoft_users u ON u.uid = A.uid
					LEFT JOIN savsoft_result r ON r.rid = A.rid
					WHERE A.uid=$uid and A.sta=2";
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.auid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by r.end_time desc ";
			
			
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/8);	
			$sql.= " limit 8 Offset ".(8*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();

			for ($i=0; $i < count($data['quiz']); $i++) { 
				//Gioi han chuoi tieu de bai quiz
					$str = $data['quiz'][$i]['quiz_name'];
					$length = 50;
					$minword = 3;
				 	$sub = '';
				    $len = 0;
				    foreach (explode(' ', $str) as $word)
				    {
				        $part = (($sub != '') ? ' ' : '') . $word;
				        $sub .= $part;
				        $len += strlen($part);
				        if (strlen($word) > $minword && strlen($sub) >= $length)
				        {
				          break;
				        }
				     }
				        $quiz_name = $sub . (($len < strlen($str)) ? '...' : '');

				        $data['quiz'][$i]['quiz_name']= $quiz_name;
				//---
				
				$data['quiz'][$i]['end_time']=date('d-m-Y',$data['quiz'][$i]['end_time']);
				$quid=$data['quiz'][$i]['quid'];
				//Lấy ảnh của bài quiz
				$sql="select quid, qids, noq,img_video, img_reading from savsoft_quiz where quid=$quid";
				$query=$this->db->query($sql);

				if($query->num_rows()>0){
					$result=$query->row_array();

						if(!$result['img_video'] && !$result['img_reading']){
							$qids=explode(',',$result['qids']);
							foreach ($qids as $key => $value) {
								$sql_qid="select * from savsoft_qbank where qid=$value";
								$query_qid=$this->db->query($sql_qid);
								$question=$query_qid->row_array();

									$start=strpos($question['question'],'<img');
									$end=strpos($question['question'],'" />');

									if($start>0){
										$img=substr($question['question'],$start, $end-$start).'" />';		
										$data['quiz'][$i]['avatar']= str_replace('<img ', '<img class="assign-item-avatar" ', $img);
										break;
									}else{
										$data['quiz'][$i]['avatar']= '<img class="assign-item-avatar" src="https://do.stem.vn/upload/default_image_quiz.png" />';
											break;
									}	
							}
							

						}else if($result['img_video']){
							$data['quiz'][$i]['avatar']='<img class="assign-item-avatar" src='.$result['img_video'].' />';

						}else if($result['img_reading']){
							$data['quiz'][$i]['avatar']='<img class="assign-item-avatar" src='.$result['img_reading'].' />';
						}

				}else return false;
			}
		
			$sql_name="(select u.uid ,u.first_name from savsoft_users u WHERE u.uid IN ($parent_id) and u.su=4)
					UNION
					(select u.uid,u.first_name from savsoft_users u join class_member cm on u.uid = cm.member_id 
					where (cm.class_id in ($class_id) and u.su=3) ) ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();

		}
		return $data;
	}
	function quiz_assign_6($page,$uids=0,$cid=1,$arr=0,$search=""){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
		$class_id = $logged_in['class_id'];
		$parent_id = $logged_in ['parent_id'];
		if($class_id=="")
		$class_id=0;
		if($parent_id=="")
		$parent_id=0;
		if($logged_in['su']==2){		
			$sql = "SELECT  A.*, u.first_name, u.last_name,r.percentage_obtained,r.end_time FROM 
					(SELECT q.*,a.id,a.startdate,a.enddate,a.aname,a.auid,a.rid,a.uid ,a.status as sta, a.reward_point FROM savsoft_quiz q 
					INNER JOIN savsoft_assign a ON a.quid = q.quid) as A
					INNER JOIN savsoft_users u ON u.uid = A.uid
					LEFT JOIN savsoft_result r ON r.rid = A.rid
					WHERE A.uid=$uid and A.sta=1";
			if($search){
				$sql.= " AND A.quiz_name like '%".$search."%' ";
			}
			if($uids>0){
				$sql.= " AND A.auid=$uids ";
			}
			if($cid!=1){
				$sql.= " AND A.cid=$cid ";
			}
			if($arr==1){
				$sql.=	" AND A.sta=2 ";
			}
			if($arr==2){
				$sql.=	"  AND A.sta=1 ";
			}
			
			$sql.=	" order by A.startdate desc ";
			
			
			//$query = $this->db->query($sql);
			$num_quiz=$this->db->query($sql)->num_rows();
			$num_page = ceil($num_quiz/8);	
			$sql.= " limit 8 Offset ".(8*$page);
			$data['quiz'] = $this->db->query($sql)->result_array();

			for ($i=0; $i < count($data['quiz']); $i++) { 
				//Gioi han chuoi tieu de bai quiz
					$str = $data['quiz'][$i]['quiz_name'];
					$length = 50;
					$minword = 3;
				 	$sub = '';
				    $len = 0;
				    foreach (explode(' ', $str) as $word)
				    {
				        $part = (($sub != '') ? ' ' : '') . $word;
				        $sub .= $part;
				        $len += strlen($part);
				        if (strlen($word) > $minword && strlen($sub) >= $length)
				        {
				          break;
				        }
				     }
				        $quiz_name = $sub . (($len < strlen($str)) ? '...' : '');

				        $data['quiz'][$i]['quiz_name']= $quiz_name;
				//---
				
				$data['quiz'][$i]['end_time']=date('d-m-Y',$data['quiz'][$i]['end_time']);
				$quid=$data['quiz'][$i]['quid'];
				//Lấy ảnh của bài quiz
				$sql="select quid, qids, noq,img_video, img_reading from savsoft_quiz where quid=$quid";
				$query=$this->db->query($sql);

				if($query->num_rows()>0){
					$result=$query->row_array();

						if(!$result['img_video'] && !$result['img_reading']){
							$qids=explode(',',$result['qids']);
							foreach ($qids as $key => $value) {
								$sql_qid="select * from savsoft_qbank where qid=$value";
								$query_qid=$this->db->query($sql_qid);
								$question=$query_qid->row_array();

									$start=strpos($question['question'],'<img');
									$end=strpos($question['question'],'" />');

									if($start>0){
										$img=substr($question['question'],$start, $end-$start).'" />';		
										$data['quiz'][$i]['avatar']= str_replace('<img ', '<img class="assign-item-avatar" ', $img);
										break;
									}else{
										$data['quiz'][$i]['avatar']= '<img class="assign-item-avatar" src="https://do.stem.vn/upload/default_image_quiz.png" />';
											break;
									}	
							}
							

						}else if($result['img_video']){
							$data['quiz'][$i]['avatar']='<img class="assign-item-avatar" src='.$result['img_video'].' />';

						}else if($result['img_reading']){
							$data['quiz'][$i]['avatar']='<img class="assign-item-avatar" src='.$result['img_reading'].' />';
						}

				}else return false;
			}
		
			$sql_name="(select u.uid ,u.first_name from savsoft_users u WHERE u.uid IN ($parent_id) and u.su=4)
					UNION
					(select u.uid,u.first_name from savsoft_users u join class_member cm on u.uid = cm.member_id 
					where (cm.class_id in ($class_id) and u.su=3) ) ";
					
			//$sql .= " order by u.uid";	
			$data['num_quiz']=$num_quiz;
			$data['num_page']=$num_page;		
			$data['student']=$this->db->query($sql_name)->result_array();
		
		
		}
		
		return $data;
	}


	function num_question_assign($search="",$cid=0,$uids=0,$sta=0){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
	 	
		$sql = " Select B.qaid , B.assid, B.uid , B.qid , B.fgiao , B.lgiao , B.answer , B.dfgiao ,B.dlgiao, qb.question , qb.cid
		from
		(Select A.qaid , A.assid, A.uid , A.qid , A.fgiao , A.lgiao , A.answer , u2.first_name as dfgiao,u2.last_name as dlgiao
		from
		(((SELECT q.qaid,q.assid,q.qid,u.first_name as fgiao,u.last_name as lgiao,q.uid,q.answer
		FROM savsoft_qassign q
		INNER JOIN savsoft_users u ";
		if($logged_in['su'] == '1' || $logged_in['su'] == '3' || $logged_in['su'] == '4'){
			$sql.=" ON q.assid=u.uid
			WHERE q.assid=$uid) as A ";
		}
		if($logged_in['su'] == '2'){
			$sql.=" ON q.assid=u.uid
		    WHERE q.uid=$uid) as A ";
		}
		$sql.=" INNER JOIN savsoft_users u2
				ON A.uid=u2.uid))) as B
				INNER JOIN savsoft_qbank qb ON B.qid=qb.qid ";
		if($search){
			$sql.= " WHERE (qb.question like '%".$search."%' or B.dfgiao like '%".$search."%')";
		}
		if($sta==1){
			$sql.=" WHERE B.answer is not null";
		}
		if($sta==2){
			$sql.=" WHERE B.answer is null";
		}
		if($cid!=0){
			$sql.=" AND qb.cid=$cid";
		}
		if($uids!=0){
			if($logged_in['su'] == '3' || $logged_in['su'] == '4'){
			   $sql.=" AND B.uid=$uids";
			}
		    if($logged_in['su'] == '2' ){
			  $sql.=" AND B.assid=$uids";
			}
		}
		
		$setting_p=explode(',',$logged_in['result']);
		
		$sql .= " order by B.qaid desc";
		$query = $this->db->query($sql);

	 	return $query->num_rows();
 	}
	function list_question_assign($search="",$cid=0,$limit=10,$uids=0,$sta=0,$page=0){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
				
		$sql = " Select B.qaid , B.assid, B.uid , B.qid , B.fgiao , B.lgiao , B.answer , B.dfgiao ,B.dlgiao, qb.question , qb.cid
		from
		(Select A.qaid , A.assid, A.uid , A.qid , A.fgiao , A.lgiao , A.answer , u2.first_name as dfgiao,u2.last_name as dlgiao
		from
		(((SELECT q.qaid,q.assid,q.qid,u.first_name as fgiao,u.last_name as lgiao,q.uid,q.answer
		FROM savsoft_qassign q
		INNER JOIN savsoft_users u ";
		if($logged_in['su'] == '1' || $logged_in['su'] == '3' || $logged_in['su'] == '4'){
			$sql.=" ON q.assid=u.uid
			WHERE q.assid=$uid) as A ";
		}
		if($logged_in['su'] == '2'){
			$sql.=" ON q.assid=u.uid
		    WHERE q.uid=$uid) as A ";
		}
		$sql.=" INNER JOIN savsoft_users u2
		ON A.uid=u2.uid))) as B
		INNER JOIN savsoft_qbank qb ON B.qid=qb.qid ";
		if($search){
			$sql.= " WHERE (qb.question like '%".$search."%' or B.dfgiao like '%".$search."%')";
		}
		if($sta==1){
			$sql.=" WHERE B.answer is not null";
		}
		if($sta==2){
			$sql.=" WHERE B.answer is null";
		}
		if($cid!=0){
			$sql.=" AND qb.cid=$cid";
		}
		if($uids!=0){
			if($logged_in['su'] == '3' || $logged_in['su'] == '4'){
				$sql.=" AND B.uid=$uids";
			}
			if($logged_in['su'] == '2' ){
			  $sql.=" AND B.assid=$uids";
			}
		}
		//$sql .= " limit $limit Offset ".($limit*$page);
		$sql .= " order by B.qaid desc limit $limit Offset ".($limit*$page);
		$data = $this->db->query($sql)->result_array();
		for($i=0; $i< count($data); $i++){
			$htmlContent= $data[$i]['question'];
			$origvidSrc="";
			$vidTags="";
			if(strpos($htmlContent, "<iframe") !==false){
				preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
				if(count($vidTags[0])>0){
					 if(strpos($vidTags[0][0], "facebook")!==false){
						$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
					 }
					 else{
						$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
					 }
					 $qt.=strip_tags($htmlContent);
					 $data[$i]['question']=$qt;
				} 
            }
			if(strpos($htmlContent,'https://latex.codecogs.com')===false){
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 			
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if(count($imgTags[0])>0){
					 $qt='<div class="imgqtt"><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					 $qt.=strip_tags( $data[$i]['question']);
					 $data[$i]['question']=$qt;
					 
					 $data[$i]['img']=$origImageSrc;
					
					 
				 }	
             }			
			$this->db->where('model','qbank');
			$this->db->where('content_id',$data[$i]['qid']);
			$per=$this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data[$i]['permalink']=site_url("page/question/".$per);
		}
	 	return $data;
 	}
	function num_question_assign2($search="",$cid=0,$uids=0,$sta){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
	 	
		$sql = " Select B.qaid , B.assid, B.uid , B.qid , B.fgiao , B.lgiao , B.answer , B.dfgiao ,B.dlgiao, qb.question , qb.cid
		from
		(Select A.qaid , A.assid, A.uid , A.qid , A.fgiao , A.lgiao , A.answer , u2.first_name as dfgiao,u2.last_name as dlgiao
		from
		(((SELECT q.qaid,q.assid,q.qid,u.first_name as fgiao,u.last_name as lgiao,q.uid,q.answer
		FROM savsoft_qassign q
		INNER JOIN savsoft_users u ";
		if($logged_in['su'] == '1' || $logged_in['su'] == '3' || $logged_in['su'] == '4'){
			$sql.=" ON q.assid=u.uid
			WHERE q.assid=$uid) as A ";
		}
		if($logged_in['su'] == '2'){
			$sql.=" ON q.assid=u.uid
		    WHERE q.uid=$uid) as A ";
		}
		$sql.=" INNER JOIN savsoft_users u2
			ON A.uid=u2.uid))) as B
			INNER JOIN savsoft_qbank qb ON B.qid=qb.qid ";
		if($search){
			$sql.= " WHERE (qb.question like '%".$search."%' or B.dfgiao like '%".$search."%')";
		}
		if($sta==1){
			$sql.=" WHERE B.answer is not null";
		}
		if($sta==2){
			$sql.=" WHERE B.answer is null";
		}
		if($cid!=0){
			$sql.=" AND qb.cid=$cid";
		}
		if($uids!=0){
			if($logged_in['su'] == '3' || $logged_in['su'] == '4'){
				$sql.=" AND B.uid=$uids";
			}
			if($logged_in['su'] == '2' ){
				$sql.=" AND B.assid=$uids";
			}
		}
		
		$setting_p=explode(',',$logged_in['result']);
		
		$sql .= " order by B.qaid desc";
		$query = $this->db->query($sql);

	 	return $query->num_rows();
 	}
	function list_question_assign2($search="",$cid=0,$limit=10,$uids=0,$sta,$page=0){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
				
		$sql = " Select B.qaid , B.assid, B.uid , B.qid , B.fgiao , B.lgiao , B.answer , B.dfgiao ,B.dlgiao, qb.question , qb.cid
		from
		(Select A.qaid , A.assid, A.uid , A.qid , A.fgiao , A.lgiao , A.answer , u2.first_name as dfgiao,u2.last_name as dlgiao
		from
		(((SELECT q.qaid,q.assid,q.qid,u.first_name as fgiao,u.last_name as lgiao,q.uid,q.answer
		FROM savsoft_qassign q
		INNER JOIN savsoft_users u ";
		if($logged_in['su'] == '1' || $logged_in['su'] == '3' || $logged_in['su'] == '4'){
			$sql.=" ON q.assid=u.uid
			WHERE q.assid=$uid) as A ";
		}
		if($logged_in['su'] == '2'){
			$sql.=" ON q.assid=u.uid
		    WHERE q.uid=$uid) as A ";
		}
		$sql.=" INNER JOIN savsoft_users u2
				ON A.uid=u2.uid))) as B
				INNER JOIN savsoft_qbank qb ON B.qid=qb.qid ";
		if($search){
			$sql.= " WHERE (qb.question like '%".$search."%' or B.dfgiao like '%".$search."%')";
		}
		if($sta==1){
			$sql.=" WHERE B.answer is not null";
		}
		if($sta==2){
			$sql.=" WHERE B.answer is null";
		}
		if($cid!=0){
			$sql.=" AND qb.cid=$cid";
		}
		if($uids!=0){
			if($logged_in['su'] == '3' || $logged_in['su'] == '4'){
				$sql.=" AND B.uid=$uids";
			}
			if($logged_in['su'] == '2' ){
				$sql.=" AND B.assid=$uids";
			}
		}
		
		$sql .= " order by B.qaid desc limit $limit Offset ".($limit*$page);
		$data = $this->db->query($sql)->result_array();
		for($i=0; $i< count($data); $i++){
			$htmlContent= $data[$i]['question'];
			$origvidSrc="";
			$vidTags="";
			if(strpos($htmlContent, "<iframe") !==false){
				preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
				if(count($vidTags[0])>0){
					 if(strpos($vidTags[0][0], "facebook")!==false){
						$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
					 }
					 else{
						$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
					 }
					 $qt.=strip_tags($htmlContent);
					 $data[$i]['question']=$qt;
				} 
            }
			if(strpos($htmlContent,'https://latex.codecogs.com')===false){
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 			
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if(count($imgTags[0])>0){
					 $qt='<div class="imgqtt"><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					 $qt.=strip_tags( $data[$i]['question']);
					 $data[$i]['question']=$qt;
					 
					 $data[$i]['img']=$origImageSrc;
					
					 
				 }	
             }			
			$this->db->where('model','qbank');
			$this->db->where('content_id',$data[$i]['qid']);
			$per=$this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data[$i]['permalink']=site_url("page/question/".$per);
		}
	 	return $data;
 	}

	  function quiz_assign(){
    	$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
	 	 
		$setting_p=explode(',',$logged_in['quiz']);
		if($logged_in['su'] != '1'){
			$this->db->or_where('savsoft_assign.auid',$uid);
			$this->db->or_where('savsoft_assign.uid',$uid);
		}
		if(in_array('Assign',$setting_p)){
			if($logged_in['su'] != '1'){
				$this->db->group_by('savsoft_assign.id');
			}
		}
		$this->db->order_by('savsoft_quiz.quid','desc');
		$this->db->join('savsoft_assign','savsoft_assign.quid=savsoft_quiz.quid');
		$this->db->join('savsoft_users','savsoft_users.uid=savsoft_assign.uid');
		$this->db->limit(9);
		$query=$this->db->get('savsoft_quiz');
		
		return $query->result_array();
    }

	
	
    function quiz_assigns($quid){
    	$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$this->db->where('quid',$quid);
		if($logged_in['su'] != '1'){
			$this->db->where('auid',$uid);
		}
		$query=$this->db->get('savsoft_assign');
		return $query->result_array();
    }

    function close_assign($quid, $auid, $uid){
    	$this->db->where('quid', $quid);
	 	$this->db->where('auid', $auid);
	 	$this->db->where('uid', $uid);
	 	$this->db->delete('savsoft_assign');
	 	return true;
    }

    function student_list(){
    	$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	$class_id = $logged_in['class_id'];
    	//log_message('error', $class_id);
    	if($logged_in['su'] == '4'){
    		$this->db->like('parent_id', $uid);
    	}
    	if($logged_in['su'] == '3'){
    		$listclassids = explode(",",$class_id);
	  		for($i = 0; $i < count($listclassids); $i++){
    			$this->db->or_where('class_id', $listclassids[$i]);
    		}
    	}
    	if($logged_in['su'] != '5'){
    		$this->db->where('savsoft_users.su', '2');
    	}
    	$this->db->order_by('savsoft_users.uid','desc');
    	$query=$this->db->get('savsoft_users');
    	//log_message('error', $uid);
		return $query->result_array();
    }

	
	 function student_list_1(){
    	$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	$class_id = $logged_in['class_id'];
		if($class_id=="")
			$class_id=0;
		$sql="";
		if($logged_in['su']==2){
			$sql.="select DISTINCT u.uid,u.first_name,u.last_name,u.su from savsoft_users u
			INNER JOIN savsoft_qassign q on u.uid=q.uid WHERE q.uid=$uid ";
		}
		// danh sach hoc sinh va phu huynh
		if($logged_in['su']==4){
			$sql.="select * from savsoft_users u where parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid' or parent_id='$uid' and u.su=2 or u.su=4 and u.uid=$uid order by uid ";
		}
		//danh sach hoc sinh cua giao vien
		else if($logged_in['su']==3||$logged_in['su']==6||$logged_in['su']==1 ){
			
			$sql.="select DISTINCT  u.*  from savsoft_users u join class_member cm on u.uid = cm.member_id where cm.class_id in ($class_id) and u.su=2 or u.su=3 and u.uid=$uid order by u.uid ";
		}
		
    	//log_message('error', $class_id);
    	//if($logged_in['su'] == '4'){
    	//	$this->db->like('parent_id', $uid);
    	//}
    	//if($logged_in['su'] == '3'){
    	//	$listclassids = explode(",",$class_id);
	  	//	for($i = 0; $i < count($listclassids); $i++){
    	//		$this->db->or_where('class_id', $listclassids[$i]);
    	//	}
    	//}
    	//if($logged_in['su'] != '5'){
    	//	$this->db->where('savsoft_users.su', '2');
    	//}
    	//$this->db->order_by('savsoft_users.uid','desc');
    	$query=$this->db->query($sql);
    	//log_message('error', $uid);
		return $query->result_array();
	}
	function student_list_3(){
    	$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	$class_id = $logged_in['class_id'];
		if($class_id=="")
			$class_id=0;
		$sql="";
		if($logged_in['su']==2){
			$sql.="select DISTINCT u.uid,u.first_name,u.last_name,u.su from savsoft_users u
			INNER JOIN savsoft_qassign q on u.uid=q.uid WHERE q.uid=$uid ";
		}
		// danh sach con của phu huynh
		if($logged_in['su']==4){
			$sql.="select * from savsoft_users u where parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid' or parent_id='$uid' and u.su=2 order by uid ";
		}
		//danh sach hoc sinh cua giao vien
		else if($logged_in['su']==3||$logged_in['su']==6||$logged_in['su']==1 ){
			
			$sql.="select DISTINCT  u.*  from savsoft_users u join class_member cm on u.uid = cm.member_id where cm.class_id in ($class_id) and u.su=2 order by u.uid ";
		}
    	$query=$this->db->query($sql);
    	//log_message('error', $uid);
		return $query->result_array();
	}
	function class_list_question(){
		$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
		$sql="";
		if($logged_in['su']==3){
			$sql.="select DISTINCT sd.did,sd.dataitem_name  from savsoft_dataitem sd 
					INNER JOIN class_metadata cm ON sd.did = cm.class_id 
					INNER JOIN class_member cl ON cl.class_id=cm.class_id 
					WHERE sd.status = 1 and cm.create_by=$uid and cl.member_id !=$uid ";
		}
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	function ass_list_2(){
		$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	$class_id = $logged_in['class_id'];
		$parent_id = $logged_in ['parent_id'];
		if($class_id=="")
		$class_id=0;
		if($parent_id=="")
		$parent_id=0;
		$sql="";
		if($logged_in['su']==2){
			$sql.=" (select u.uid ,u.first_name from savsoft_users u WHERE u.uid IN ($parent_id) and u.su=4)
					UNION
					(select u.uid,u.first_name from savsoft_users u join class_member cm on u.uid = cm.member_id 
					where (cm.class_id in ($class_id) and u.su=3) ) ";
			$query=$this->db->query($sql)->result_array();
		}
		else 
			$query=array();
		
		
    	//log_message('error', $uid);
		return $query;
	}
	function class_list_2($quid,$search,$page){
		$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	//$class_id = $logged_in['class_id'];
		$data_class_id="SELECT u.class_id FROM savsoft_users u WHERE u.uid=$uid";
		$class_id = $this->db->query($data_class_id)->row_array();
		$class_ids= implode(',', $class_id);
		if($class_id=="")
			$class_id=0;
		if($logged_in['su']==3 || $logged_in['su']==1){
			$select = " 
			SELECT * FROM quiz.savsoft_dataitem where status=1 and did in ( 
				SELECT Distinct class_member.class_id FROM quiz.class_member inner join savsoft_users on class_member.member_id = savsoft_users.uid 
			 where savsoft_users.uid = $uid and 
			";
			if($class_ids!=""){
			$class_id = "  class_member.class_id in ($class_ids) ";
		/*	$class= "
			SELECT * FROM quiz.savsoft_dataitem where status=1 and did in ( 
					SELECT Distinct class_member.class_id FROM quiz.class_member inner join savsoft_users on class_member.member_id = savsoft_users.uid 
				 where class_member.class_id in ($class_ids) and savsoft_users.uid = $uid ) ";*/
		}
		else{
			$class_id = "  class_member.class_id in (0) ";
		/*	$class= "
			SELECT * FROM quiz.savsoft_dataitem where status=1 and did in ( 
					SELECT Distinct class_member.class_id FROM quiz.class_member inner join savsoft_users on class_member.member_id = savsoft_users.uid 
				 where class_member.class_id in (0) and savsoft_users.uid = $uid ) ";*/
		}
		if($search != ''){
			$search = " and dataitem_name like '%$search%' )";
		}else{
			$search = " )";
		}
			$class = $select.$class_id.$search;
			$offset = 5*$page;
			$class .= " limit 5 offset $offset";
			
			$clist = $this->db->query($class);
			$data['clist'] = $clist->result_array();
			for($i=0;$i<count($data['clist']);$i++){
				$sq = "select * from savsoft_assign where quid = $quid and classid = ".$data['clist'][$i]['did']." ";
				$query= $this->db->query($sq);
				if($query->num_rows()!=0){
					$data['clist'][$i]['stt'] = 1;
					$data['clist'][$i]['cmt'] = 'đã giao bài';
				}else{
					$data['clist'][$i]['stt'] = 0;
					$data['clist'][$i]['cmt'] = 'Chưa giao bài';
				}
		}
	}
	return $data;
}
function nb_class_list_2($search){
	$logged_in=$this->session->userdata('logged_in');
	$uid = $logged_in['uid'];
	//$class_id = $logged_in['class_id'];
	$data_class_id="SELECT u.class_id FROM savsoft_users u WHERE u.uid=$uid";
	$class_id = $this->db->query($data_class_id)->row_array();
	$class_ids= implode(',', $class_id);
	if($class_id=="")
		$class_id=0;
	if($logged_in['su']==3){
		$select = " 
		SELECT * FROM quiz.savsoft_dataitem where status=1 and did in ( 
			SELECT Distinct class_member.class_id FROM quiz.class_member inner join savsoft_users on class_member.member_id = savsoft_users.uid 
		 where savsoft_users.uid = $uid and 
		";
		if($class_ids!=""){
		$class_id = "  class_member.class_id in ($class_ids) ";
	}
	else{
		$class_id = "  class_member.class_id in (0) ";
	}
	if($search != ''){
		$search = " and dataitem_name like '%$search%' )";
	}else{
		$search = " )";
	}
		$class = $select.$class_id.$search;
		$clist = $this->db->query($class);
		$query = $clist->num_rows();
}
return $query;
}
	function student_list_2($quid,$search,$page){
    	$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	//$class_id = $logged_in['class_id'];
		$data_class_id="SELECT u.class_id FROM savsoft_users u WHERE u.uid=$uid";
		$class_id = $this->db->query($data_class_id)->row_array();
		$class_ids= implode(',', $class_id);
		if($class_id=="")
			$class_id=0;
		$sql="";
		$class="";
		if($logged_in['su']==4){
			$sql .= "select * from savsoft_users u where parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid' or parent_id='$uid'  ";
		}
		else if($logged_in['su']==3){
			if($class_ids!=""){
				$sql.="select DISTINCT  u.*  from savsoft_users u join class_member cm on u.uid = cm.member_id where cm.class_id in ($class_ids) and u.su=2  ";
			}
			else{
				$sql.="select DISTINCT  u.*  from savsoft_users u join class_member cm on u.uid = cm.member_id where cm.class_id =0 and u.su=2  ";
			}
		}else if($logged_in['su']==1){
			$sql.="select * from savsoft_users u where su=2";
		}
		$sql .= "and u.user_status = 'Active'" ;
		if($search != ''){
			$sql .= " and (u.email like '%$search%' or u.first_name like '%$search%' or u.last_name like'%$search%')";
		}
		$offset = 5*$page;
		$sql .=" order by u.uid limit 5 offset $offset";
    	$query=$this->db->query($sql);
		$data['list']=$query->result_array();
		for($i=0;$i<count($data['list']);$i++){
			$sqll="select * from savsoft_assign where quid = $quid and uid = ".$data['list'][$i]['uid']." ";
		//	$sqll="select * from savsoft_assign where quid = $quid and uid = ".$uid." ";
			$querry = $this->db->query($sqll);
			if($querry->num_rows()!=0){
				$data['list'][$i]['stt'] = 1;
				$data['list'][$i]['cmt'] = 'đã giao bài';
			}else{
				$data['list'][$i]['stt'] = 0;
				$data['list'][$i]['cmt'] = 'Chưa giao bài';
			}
		}
		return $data;
	}
	function nb_student_list_2($search){
    	$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
		$data_class_id="SELECT u.class_id FROM savsoft_users u WHERE u.uid=$uid";
		$class_id = $this->db->query($data_class_id)->row_array();
		$class_ids= implode(',', $class_id);
    	//$class_id = $logged_in['class_id'];
		if($class_id=="")
			$class_id=0;
		$sql="";
		if($logged_in['su']==4){
			$sql .= "select * from savsoft_users u where parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid' or parent_id='$uid' ";
		}
		else if($logged_in['su']==3 || $logged_in['su']==6 ){
			if($class_ids!=""){
				$sql.="select DISTINCT  u.*  from savsoft_users u join class_member cm on u.uid = cm.member_id where cm.class_id in ($class_ids) and u.su=2  ";
			}
			else{
				$sql.="select DISTINCT  u.*  from savsoft_users u join class_member cm on u.uid = cm.member_id where cm.class_id =0 and u.su=2  ";
			}
		}else if($logged_in['su']==1){
			$sql .= "select u.* from savsoft_users u where su=2 ";
		}
		$sql .= "and u.user_status = 'Active'" ;
		if($search != ''){
			$sql .= " and (u.email like '%$search%' or u.first_name like '%$search%' or u.last_name like'%$search%')";
		}
		if($logged_in['su']==2){
			$sql = 0;
			return $sql;
		}
			$query=$this->db->query($sql);
			return $query->num_rows();
	}
	function group_list_2($quid,$search,$page){
		$logged_in = $this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		$offset = 5*$page;
		$sql = "select 
    A.*
FROM
    (SELECT 
        social_group.sg_name, social_group_joined.sg_id
    FROM
        social_group_joined
    JOIN social_group ON social_group.sg_id = social_group_joined.sg_id
    WHERE
        social_group.deleted = '0'
            AND social_group_joined.uid = $uid
            AND social_group.created_by = $uid
    ORDER BY social_group_joined.sg_id DESC
    LIMIT 5 offset $offset) A
        INNER JOIN
    (SELECT 
        sg_id, COUNT(*) AS count
    FROM
        savsoft_users
    INNER JOIN social_group_joined ON social_group_joined.uid = savsoft_users.uid
    WHERE
        savsoft_users.su = 2
    GROUP BY sg_id) B ON (A.sg_id = B.sg_id)";
		$data['glist'] =$this->db->query($sql)->result_array();
		for($i=0;$i<count($data['glist']);$i++){
			$sq = "select * from savsoft_assign where quid = $quid and group_id = ".$data['glist'][$i]['sg_id']." ";
			$query= $this->db->query($sq);
			if($query->num_rows()!=0){
				$data['glist'][$i]['stt'] = 1;
				$data['glist'][$i]['cmt'] = 'đã giao bài';
			}else{
				$data['glist'][$i]['stt'] = 0;
				$data['glist'][$i]['cmt'] = 'Chưa giao bài';
			}
		}
		return $data;
	}

	function nb_group_list_2($search){
		$logged_in = $this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		$sql = "select 
    A.*
FROM
    (SELECT 
        social_group.sg_name, social_group_joined.sg_id
    FROM
        social_group_joined
    JOIN social_group ON social_group.sg_id = social_group_joined.sg_id
    WHERE
        social_group.deleted = '0'
            AND social_group_joined.uid = $uid
            AND social_group.created_by = $uid
    ORDER BY social_group_joined.sg_id DESC) A
        INNER JOIN
    (SELECT 
        sg_id, COUNT(*) AS count
    FROM
        savsoft_users
    INNER JOIN social_group_joined ON social_group_joined.uid = savsoft_users.uid
    WHERE
        savsoft_users.su = 2
    GROUP BY sg_id) B ON (A.sg_id = B.sg_id)";

		$query =$this->db->query($sql);
		return $query->num_rows();
	}

		function assignstatus($quid, $uid, $auid, $startdate, $enddate){
		$logged_in=$this->session->userdata('logged_in');
		$aname = $logged_in['first_name'] ." ". $logged_in['last_name'];
		$this->db->where("quid", $quid);
		$price=$this->db->get("savsoft_quiz")->row_array()['points'];
		$assigndata = array(
			'quid' => $quid, 
			'auid' => $auid,
			'aname' => $aname,
			'uid' => $uid,
			'startdate' => $startdate,
			'enddate' => $enddate,
			'price'=>$price,
		);
		$this->db->insert('savsoft_assign', $assigndata);
		$assid = $this->db->insert_id();
		
		$type="kiểm tra.";
		$this->db->where('quid', $quid);
		$qq= $this->db->get('savsoft_quiz')->row_array();
		if($qq){
			if($qq['level_hard']){
				if($qq['level_hard']>3){
					$type="KNS.";
				}
				else{
					$type="HCC.";
				}
			}
		}	
		
		$assignfrom = array(
			"uid" => $auid,
			"content" => "đã giao một bài ".$type,
			"model" => "quiz",
			"action" => "Assign quiz",
			"click" => "window.location.href = '".site_url()."/quiz/validate_quizs/".$quid."/".$auid."/".$assid."'"
		);
		$this->db->insert('notify',$assignfrom);
		$nid = $this->db->insert_id();

		$assignto1 = array(
		   'nid' => $nid,
		   'uid' => $auid,
	   );
	   $this->db->insert('notify_user', $assignto1);
	   $assignto2 = array(
		   'nid' => $nid,
		   'uid' => $uid,
	   );
	   $this->db->insert('notify_user', $assignto2);

	   $this->load->model('notification_model');
	   $dataArr = array(
		   'message' => 'đã giao một bài kiểm tra.',
		   'title' => "Thông Báo"
	   );
	   $this->notification_model->sendNotification($uid, $dataArr);

	   $this->db->where('savsoft_users.uid',$uid);
		 $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
	  $query=$this->db->get('savsoft_users');
	   $student = $query->row_array();
	   
	  $mailtoassign=$logged_in['email']; 
	   if (filter_var($mailtoassign, FILTER_VALIDATE_EMAIL)) {
		  //$messagetoassign= 'Bạn đã gửi thành công một bài trắc nghiệm cho '.$student['first_name'].'. Đố sẽ gửi thông báo đến bạn sau khi có kết quả làm bài của '.$student['first_name'].' .';
		  $assigned_name=$student['first_name']." ".$student['last_name'];
		  $assign_name=$logged_in['first_name']." ".$logged_in['last_name'];
		  $messagetoassign=file_get_contents('./template_email/assign_teacher.html');
		  $messagetoassign = str_replace("[[type]]","học sinh", $messagetoassign);
		  $messagetoassign = str_replace("[[assigned_name]]",$assigned_name, $messagetoassign);
		  $messagetoassign = str_replace("[[assign_name]]",$assign_name, $messagetoassign);
		  
		  $subject="Thông báo giao bài tập";
		  $this->sendmail($mailtoassign, $messagetoassign, $subject);
	  }
	  
	  $mailtoassigned = $student['email'];
	  if (filter_var($mailtoassign, FILTER_VALIDATE_EMAIL)) {
		  //$messagetoassigned = 'Bạn vừa được phụ huynh/giáo viên '.$logged_in['first_name'].' giao  một bài trắc nghiệm. Hãy click vào đường link dưới đây để trả lời.<br><br><a href="'.site_url().'/quiz/validate_quizs/'.$quid.'/'.$uid.'/'.$assid.'"><img src="http://do.stem.vn/images/button_lam-bai.png" height="40" width="116"></a>';
		  
		  $assigned_name=$student['first_name']." ".$student['last_name'];
		  $assign_name=$logged_in['first_name']." ".$logged_in['last_name'];
		  $messagetoassigned=file_get_contents('./template_email/assigned.html');
		  $messagetoassigned = str_replace("[[type_assign]]","bài trắc nghiệm", $messagetoassigned);
		  $messagetoassigned = str_replace("[[assigned_name]]",$assigned_name, $messagetoassigned);
		  $messagetoassigned = str_replace("[[assign_name]]",$assign_name, $messagetoassigned);
		  $subject="Thông báo giao bài tập";
		  
		  $this->sendmail($mailtoassigned, $messagetoassigned,$subject);
	  }
		return true;
	}
	
	
    function assignQuiz($quid, $ruid, $olduid, $startdate, $enddate){
    	$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	$aname = $logged_in['first_name'] ." ". $logged_in['last_name'];
    	$this->db->where("quid", $quid);
		$price=$this->db->get("savsoft_quiz")->row_array()['points'];
  		$assigndata = array(
  			'quid' => $quid, 
  			'auid' => $uid,
  			'aname' => $aname,
  			'uid' => $ruid,
  			'startdate' => $startdate,
  			'enddate' => $enddate,
			'price'=>$price
  		);
  		$this->db->insert('savsoft_assign', $assigndata);
  		$assid = $this->db->insert_id();

		$userdata['uids']=$olduid.",".$ruid;
 
	  	$this->db->where('quid',$quid);
	  	$this->db->update('savsoft_quiz',$userdata);
        $type="kiểm tra.";
		$this->db->where('quid', $quid);
		$qq= $this->db->get('savsoft_quiz')->row_array();
		if($qq){
			if($qq['level_hard']){
				if($qq['level_hard']>3){
					$type="KNS.";
				}
				else{
					$type="HCC.";
				}
			}
		}	
	  	$assignfrom = array(
	  		"uid" => $uid,
	  		"content" => "đã giao một bài ".$type,
	  		"model" => "quiz",
	  		"action" => "Assign quiz",
	  		"click" => "window.location.href = '".site_url()."/quiz/validate_quizs/".$quid."/".$uid."/".$assid."'"
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
 			'uid' => $ruid,
 		);
 		$this->db->insert('notify_user', $assignto2);

 		$this->load->model('notification_model');
 		$dataArr = array(
 			'message' => 'đã giao một bài kiểm tra.',
 			'title' => "Thông Báo"
 		);
 		$this->notification_model->sendNotification($ruid, $dataArr);

 		$this->db->where('savsoft_users.uid',$ruid);
	   	$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$query=$this->db->get('savsoft_users');
	 	$student = $query->row_array();
         
		$mailtoassign=$logged_in['email']; 
 		if (filter_var($mailtoassign, FILTER_VALIDATE_EMAIL)) {
			//$messagetoassign= 'Bạn đã gửi thành công một bài trắc nghiệm cho '.$student['first_name'].'. Đố sẽ gửi thông báo đến bạn sau khi có kết quả làm bài của '.$student['first_name'].' .';
			$assigned_name=$student['first_name']." ".$student['lasst_name'];
			$assign_name=$logged_in['first_name']." ".$logged_in['lasst_name'];
			$messagetoassign=file_get_contents('./template_email/assign_teacher.html');
			$messagetoassign = str_replace("[[type]]","học sinh", $messagetoassign);
			$messagetoassign = str_replace("[[assigned_name]]",$assigned_name, $messagetoassign);
			$messagetoassign = str_replace("[[assign_name]]",$assign_name, $messagetoassign);
			$subject="Thông báo giao bài tập";
			$this->sendmail($mailtoassign, $messagetoassign, $subject);
		}
		
		$mailtoassigned = $student['email'];
        if (filter_var($mailtoassign, FILTER_VALIDATE_EMAIL)) {
			//$messagetoassigned = 'Bạn vừa được phụ huynh/giáo viên '.$logged_in['first_name'].' giao  một bài trắc nghiệm. Hãy click vào đường link dưới đây để trả lời.<br><br><a href="'.site_url().'/quiz/validate_quizs/'.$quid.'/'.$uid.'/'.$assid.'"><img src="http://do.stem.vn/images/button_lam-bai.png" height="40" width="116"></a>';
			
			$assigned_name=$student['first_name']." ".$student['lasst_name'];
			$assign_name=$logged_in['first_name']." ".$logged_in['lasst_name'];
			$messagetoassign=file_get_contents('./template_email/assigned.html');
			$messagetoassign = str_replace("[[type_assign]]","bài trắc nghiệm", $messagetoassign);
			$messagetoassign = str_replace("[[assigned_name]]",$assigned_name, $messagetoassign);
			$messagetoassign = str_replace("[[assign_name]]",$assign_name, $messagetoassign);
			
			$subject="Thông báo giao bài tập";
			
			$this->sendmail($mailtoassigned, $messagetoassigned,$subject);
	    }
	  	return true;
    }

    function sendmail($toemail, $message,$subject="stemup.app"){
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
		//$subject='stemup.app';
		$this->email->to($toemail);
		$this->email->from($fromemail, $fromname);
		$this->email->subject($subject);
		$this->email->message($message);
		if(!$this->email->send()){
		 //print_r($this->email->print_debugger());
		
		}
    }

    function unassign_quiz($quid, $uid){
    	$logged_in=$this->session->userdata('logged_in');
    	$auid = $logged_in['uid'];
    	$this->db->where('quid', $quid);
    	if($logged_in['su'] != '1'){
    		$this->db->where('auid', $auid);
    	}
    	$this->db->where('uid', $uid);
    	$this->db->delete('savsoft_assign');
    	return true;
		}
		function assign_to_group ($quid, $sg_id, $startdate, $enddate){
			$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
			$aname = $logged_in['first_name'] ." ". $logged_in['last_name'];
			$member = $this->member_list_of_group($sg_id);
			if(count($member) > 0){
    		for($i = 0; $i < count($member); $i++){
    			//log_message('error', $students[$i]['uid']);
    			$assigndata = array(
		  			'quid' => $quid, 
		  			'auid' => $uid,
		  			'aname' => $aname,
		  			'uid' => $member[$i]['uid'],
		  			'group_id' => $sg_id,
		  			'startdate' => $startdate,
		  			'enddate' => $enddate,
		  		);
				$this->db->insert('savsoft_assign', $assigndata);
				$assid = $this->db->insert_id();
    		}
			$type="kiểm tra.";
			$this->db->where('quid', $quid);
			$qq= $this->db->get('savsoft_quiz')->row_array();
			if($qq){
				if($qq['level_hard']){
					if($qq['level_hard']>3){
						$type="KNS.";
					}
					else{
						$type="HCC.";
					}
				}
			}	
    		$assignfrom = array(
		  		"uid" => $uid,
		  		"content" => "đã giao một bài ".$type,
		  		"model" => "quiz",
				"action" => "Assign quiz",
				"click" => "window.location.href = '".site_url()."/quiz/validate_quizs/".$quid."/".$uid."/".$assid."'"
		  	);
		  	$this->db->insert('notify',$assignfrom);
		  	$nid = $this->db->insert_id();
		  	$assignto1 = array(
	 			'nid' => $nid,
	 			'uid' => $uid,
	 		);
	 		$this->db->insert('notify_user', $assignto1);
		  	for($i = 0; $i < count($member); $i++){
		  		$assignto = array(
		 			'nid' => $nid,
		 			'uid' => $member[$i]['uid'],
		 		);
		 		$this->db->insert('notify_user', $assignto);
		  	}
    		return true;
			} else {
				return false;
			}
		}

    function assign_to_class($quid, $classid, $startdate, $enddate){
    	$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
    	$aname = $logged_in['first_name'] ." ". $logged_in['last_name'];
		//$sql = " SELECT cl.member_id as uid FROM class_member cl INNER JOIN savsoft_users u ON cl.member_id = u.uid  WHERE cl.class_id=$classid and u.su=2 "; 
    	$students = $this->student_list_of_class($classid);
		//$students = $this->db->query($sql)->result_array();
    	if(count($students) > 0){
    		for($i = 0; $i < count($students); $i++){
    			//log_message('error', $students[$i]['uid']);
    			$assigndata = array(
		  			'quid' => $quid, 
		  			'auid' => $uid,
		  			'aname' => $aname,
		  			'uid' => $students[$i]['uid'],
		  			'classid' => $classid,
		  			'startdate' => $startdate,
		  			'enddate' => $enddate,
		  		);
				$this->db->insert('savsoft_assign', $assigndata);
				$assid = $this->db->insert_id();
    		}
			$type="kiểm tra.";
			$this->db->where('quid', $quid);
			$qq= $this->db->get('savsoft_quiz')->row_array();
			if($qq){
				if($qq['level_hard']){
					if($qq['level_hard']>3){
						$type="KNS.";
					}
					else{
						$type="HCC.";
					}
				}
			}	
			
    		$assignfrom = array(
		  		"uid" => $uid,
		  		"content" => "đã giao một bài ".$type,
		  		"model" => "quiz",
				"action" => "Assign quiz",
				"click" => "window.location.href = '".site_url()."/quiz/validate_quizs/".$quid."/".$uid."/".$assid."'"
		  	);
		  	$this->db->insert('notify',$assignfrom);
		  	$nid = $this->db->insert_id();
		  	$assignto1 = array(
	 			'nid' => $nid,
	 			'uid' => $uid,
	 		);
	 		$this->db->insert('notify_user', $assignto1);
		  	for($i = 0; $i < count($students); $i++){
		  		$assignto = array(
		 			'nid' => $nid,
		 			'uid' => $students[$i]['uid'],
		 		);
		 		$this->db->insert('notify_user', $assignto);
		  	}
    		return true;
    	}else{
    		return false;
    	}
  		
    }

    function unassign_to_class($quid, $classid){
    	$logged_in=$this->session->userdata('logged_in');
    	$auid = $logged_in['uid'];
    	$this->db->where('quid', $quid);
    	if($logged_in['su'] != '1'){
    		$this->db->where('auid', $auid);
    	}
    	$this->db->where('classid', $classid);
    	$this->db->delete('savsoft_assign');
    	return true;
    }

    function class_list(){
    	$logged_in=$this->session->userdata('logged_in');
    	$class_id = $logged_in['class_id'];
    	if($logged_in['su'] == '3'){
    		$listclassids = explode(",",$class_id);
	  		for($i = 0; $i < count($listclassids); $i++){
    			$this->db->or_where('did', $listclassids[$i]);
    		}
    	}
    	$this->db->where('group_id', '2');
    	$query = $this->db->get('savsoft_dataitem');
    	return $query->result_array();
    }
	
	 function class_list_1(){
    	$logged_in=$this->session->userdata('logged_in');
    	$class_id = $logged_in['class_id'];
		if ($class_id=="")
			$rs= array();
		else{
			$sql="select * from savsoft_dataitem where did in ($class_id)" ;
			$rs= $this->db->query($sql)->result_array(); 
		}
			
    	return $rs;
    }

    function student_list_of_class($class_id){
    	$this->db->like('class_id', $class_id);
    	$this->db->where('savsoft_users.su', '2');
    	$this->db->order_by('savsoft_users.uid','desc');
    	$query=$this->db->get('savsoft_users');
		return $query->result_array();
		}
		function member_list_of_group($sg_id){
			$this->db->join('savsoft_users','savsoft_users.uid=social_group_joined.uid');
			$this->db->where('savsoft_users.user_status','Active');
			$this->db->where("social_group_joined.sg_id=$sg_id");
			$this->db->where('savsoft_users.su', '2');
			$query=$this->db->get('social_group_joined');
			return $query->result_array();
		}


  	function liveclass_list(){
		$logged_in=$this->session->userdata('logged_in');
	 	
		if($logged_in['uid'] != '1'){
			$uid=$logged_in['uid'];
	 		$this->db->where('initiated_by',$uid);
	 	}
		$this->db->order_by('class_id','desc');
		$results =$query=$this->db->get('live_class')->result_array();
		for($k=0; $k < count($results); $k++){
            $this->db->where('class_id',$results[$k]['class_id']);
            $stc=$this->db->get('liveclass_student_rel')->num_rows();
             
		    $results[$k]['student_count']=$stc;
		}
		return $results; 
 	}


 	function get_student_lc($class_id){
	    $this->db->select('*');
	    $this->db->from('liveclass_student_rel a'); 
	    $this->db->join('mcq_student b', 'b.student_id=a.student_id', 'left');
	    $this->db->join('savsoft_users c', 'b.uid=c.uid', 'left');
	    $this->db->where('a.class_id',$class_id);   
	    $query = $this->db->get(); 
	    if($query->num_rows() != 0)
	    {
	        return $query->result_array();
	    }
	    else
	    {
	        return false;
	    }	
      

 	}

 	function get_student_lc_rm($class_id){
 		$this->db->where('class_id', $class_id);
 		$std_ids= $this->db->get('liveclass_student_rel')->result_array();

	    $this->db->select('*');
	    $this->db->from('mcq_student a');
	    $this->db->join('savsoft_users b', 'a.uid=b.uid', 'left');
	    foreach($std_ids as $std_id)
	       $this->db->where('student_id != ', $std_id['student_id']);
	    $query = $this->db->get(); 
	    if($query->num_rows() != 0)
	    {
	        return $query->result_array();
	    }
	    else
	    {
	        return false;
	    }	
    

 	}

 	function socialgroup_list(){
        $logged_in=$this->session->userdata('logged_in');

        if($logged_in['su'] != '1'){
            $uid=$logged_in['uid'];
            $this->db->where('created_by',$uid);
        }
        $this->db->order_by('sg_id','desc');
        $results =$query=$this->db->get('social_group')->result_array();
//        for($k=0; $k < count($results); $k++){
//            $this->db->where('sg_id',$results[$k]['sg_id']);
//            $stc=$this->db->get('social_group_joined')->num_rows();
//
//            //$results[$k]['student_count']=$stc;
//        }
        return $results;
    }
	function api_changepassword($uid){
		$user_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
		$connection_key =$user_info['connection_key'];
		$new_password = $user_info['new_password'];
		$confirm_password = $user_info['confirm_password'];
		if($new_password!= $confirm_password){
			return array("error"=>"Xác nhận mật khẩu không trùng khớp");
		}
		else{
			$this->db->where("uid", $uid);
			$us=$this->db->get('savsoft_users');
			if(!$us){
				return array("error"=>"Người dùng không tồn tại");
			}
			else{
				$user=$us->result_array()[0];
				$c_k=$user['connection_key'];
				if($connection_key!=$c_k){
					return array("error"=>"connection key không trùng khớp");
				}
				else{
					$this->db->where("uid", $uid);
			        $this->db->update('savsoft_users', array('password'=> md5($new_password)));
					
					$this->load->library('Curl');
					$url = 'http://192.168.11.179:8069/api/stem/changepassword';
					$jsonData =array("jsonrpc"=>"2.0", "params"=>array(
						'login' => $user['email'],
						'key'=>'xqTQzzqrXvjfz2lyxa7goz2nVoXwlj3aYo3fKU08LYGNqQQLlT2xdw5588wKqm7oduC32xsoOGLMFUIAwrH6WwzoXVq_zen0T_JXFcC8kqGinvNCUY2fuzrVJwGcuSXtcvvSd6IeuF0KSyDNIVLO_y0kmwd1AqFxnOpa7aZwzfKQ',
						'new_pwd' => $new_password,
					));
					$jsonDataEncoded = json_encode($jsonData);
					$this->curl->create($url);
					$this->curl->option(CURLOPT_HTTPHEADER, array('Content-type: application/json; Charset=UTF-8'));			
					$this->curl->post($jsonDataEncoded);
					$result = $this->curl->execute();	
						
					return array("success"=>"Đổi nật khẩu thành công");
				}
			}
			
		}
		
    }
	function time_ago($timestamp)  {  
	  date_default_timezone_set('Asia/Ho_Chi_Minh');  
      $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      
      
      if($seconds <= 60) {  
		return "Vừa xong";  
	  }  
      else if($minutes <=60){  
		if($minutes==1){  
			return "1 phút";  
		}  
		else {  
			return "$minutes phút";  
		}  
	  }  
      else if($hours <=24){  
		  if($hours==1)  {  
			return "1 giờ";  
		  }  
          else {  
			return "$hours giờ";  
	     }  
      }  
      else if($days <= 7){  
		if($days==1){  
			return "Hôm qua";  
		}  
		else {  
			return "$days ngày";  
		}  
	  }  
      else {
		  $date= new DateTime($timestamp);
	      return $date->format('d-m-Y');
	  }
	}

	function assign_question_st($qid, $uid){
		$logged_in=$this->session->userdata('logged_in');
    	$assid = $logged_in['uid'];

    	/*$this->db->where('qid', $qid);
		$this->db->where('deleted',0);
		$qt=$this->db->get('savsoft_qbank')->result_array()[0];
		$qt['question']=html_entity_decode($qt['question']);
		$qt['description']=html_entity_decode($qt['description']);
		$this->db->where('qid', $qid);
		$ops = $this->db->get('savsoft_options')->result_array();*/
		
		
		$this->db->where('uid', $uid);
		$this->db->where('qid', $qid);
		$this->db->where('assid', $assid );
		$data=$this->db->get('savsoft_qassign')->num_rows();

		$userdata = array(
			'qid' => $qid, 
			'assid' => $assid,
		    'uid' => $uid
		);
		if($data > 0){
			//$res['status']=0;
			//$res['usdt']=$usid;
			return false;
		}
		else{
		$this->db->insert('savsoft_qassign', $userdata);
		
		$assignfrom = array(
	  		"uid" => $assid,
	  		"content" => "đã giao một câu hỏi.",
	  		"model" => "savsoft_qbank",
	  		"action" => "Assign question",
	  		'click' => "question_ass(".$qid.",".$assid.")"
	  	);
	  	$this->db->insert('notify',$assignfrom);
	  	$nid = $this->db->insert_id();

	  	$assignto1 = array(
 			'nid' => $nid,
 			'uid' => $uid,
 		);
 		$this->db->insert('notify_user', $assignto1);

 		$this->load->model('notification_model');
 		$dataArr = array(
 			'message' => 'đã giao một câu hỏi.',
 			'title' => "Thông Báo"
 		);
 		//$this->notification_model->sendNotification($uid, $dataArr);

 		return true;
		}
	}
	function assign_question_cl($qid,$class){
		$logged_in=$this->session->userdata('logged_in');
    	$assid = $logged_in['uid'];
		$this->db->where('did',$class);
		$class_name = $this->db->get('savsoft_dataitem')->row_array()['dataitem_name'];
	    $sql = " SELECT cm.member_id FROM class_member cm WHERE cm.class_id=$class and cm.member_id !=$assid ";
		$students = $this->db->query($sql)->result_array();// mảng 
		$this->db->where('qid', $qid);
		$this->db->where('assid', $assid );
		$this->db->where('class_id', $class );
		$data=$this->db->get('savsoft_qassign')->num_rows();
		if($data > 0){
			return false;
		}
		else{
			if($students=""){
				return 1;
			}
			else{
				foreach($students as $student){
					$userdata = array(
					'qid' => $qid,
					'class_id' => $class,
					'assid' => $assid,
					'uid' => $student['member_id']
					);
					$this->db->insert('savsoft_qassign', $userdata);
				
					$assignfrom = array(
					"uid" => $assid,
					"content" => "đã giao một câu hỏi cho lớp ".$class_name." của bạn!",
					"model" => "savsoft_qbank",
					"action" => "Assign question class",
					'click' => "question_ass_cl(".$qid.",".$assid.",".$class.")"
					);
					$this->db->insert('notify',$assignfrom);
					$nid = $this->db->insert_id();

					$assignto1 = array(
						'nid' => $nid,
						'uid' => $student['member_id'],
					);
					$this->db->insert('notify_user', $assignto1);		
				}		
				return true;
			}
		}
	}
	function anwser_ass($qid, $assid, $answer){
		$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];

		$this->db->where('qid', $qid);
		$this->db->where('assid', $assid);
		$this->db->where('uid', $uid);
		$answerdata = array('answer' => $answer);
		$this->db->update('savsoft_qassign', $answerdata);

		$assignfrom = array(
	  		"uid" => $uid,
	  		"content" => "Đã trả lời một câu hỏi của bạn đố.",
	  		"model" => "savsoft_qbank",
	  		"action" => "Assign question",
	  		'click' => "answer_ass(".$qid.",".$assid.",".$answer.")"
	  	);
	  	$this->db->insert('notify',$assignfrom);
	  	$nid = $this->db->insert_id();

	  	$assignto1 = array(
 			'nid' => $nid,
 			'uid' => $assid,
 		);
 		$this->db->insert('notify_user', $assignto1);

 		$this->load->model('notification_model');
 		$dataArr = array(
 			'message' => 'Đã trả lời một câu hỏi của bạn đố.',
 			'title' => "Thông Báo"
 		);
 		$this->notification_model->sendNotification($assid, $dataArr);

 		$this->db->where('savsoft_users.uid',$assid);
	   	$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$query=$this->db->get('savsoft_users');
	 	$assign = $query->row_array();

 		$messagetoassign= $logged_in['first_name'].' vừa hoàn thành một câu hỏi trắc nghiệm do '.$assign['first_name'].' giao.';
		$mailtoassign=$assign['email'];
		$this->sendmail($mailtoassign, $messagetoassign);

 		return true;
	}
	
	function check_answer($qid,$assid){	
		$logged_in=$this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		$this->db->where('uid', $uid);
		$this->db->where('qid', $qid);
		$this->db->where('assid', $assid);
		$data=$this->db->get('savsoft_qassign')->row_array();
		if(!$data)
			return array();
			
		else return $data;
		//return $ketqua;
	}
	function anwser_ass_cl($qid, $assid, $answer,$class_id){
		$logged_in=$this->session->userdata('logged_in');
    	$uid = $logged_in['uid'];
		$this->db->where('qid', $qid);
		$this->db->where('assid', $assid);
		$this->db->where('uid', $uid);
		$this->db->where('class_id', $class_id);
		$answerdata = array('answer' => $answer);
		$this->db->update('savsoft_qassign', $answerdata);
        $this->db->where('did',$class_id);
		$class_name = $this->db->get('savsoft_dataitem')->row_array()['dataitem_name'];
		$assignfrom = array(
	  		"uid" => $uid,
	  		"content" => "Đã trả lời một câu hỏi của bạn đố cho lớp ".$class_name."!",
	  		"model" => "savsoft_qbank",
	  		"action" => "Assign question",
	  		'click' => "answer_ass_cl(".$qid.",".$assid.",".$answer.",".$class_id.")"
	  	);
	  	$this->db->insert('notify',$assignfrom);
	  	$nid = $this->db->insert_id();

	  	$assignto1 = array(
 			'nid' => $nid,
 			'uid' => $assid,
 		);
 		$this->db->insert('notify_user', $assignto1);
 		return true;
	}
	function check_answer_cl($qid,$assid,$class_id){	
		$logged_in=$this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		$this->db->where('uid', $uid);
		$this->db->where('qid', $qid);
		$this->db->where('assid', $assid);
		$this->db->where('class_id', $class_id);
		$data=$this->db->get('savsoft_qassign')->row_array();
		if(!$data)
			return array();
			
		else return $data;
		//return $ketqua;
	}
	function getusers($user){
    	$uid = $user['uid'];
    	$class_id = $user['class_id'];
    	//log_message('error', $class_id);
    	if($user['su'] == '4'){
    		$this->db->like('parent_id', $uid);
    	}
    	if($user['su'] == '3'){
    		$listclassids = explode(",",$class_id);
	  		for($i = 0; $i < count($listclassids); $i++){
    			$this->db->or_where('class_id', $listclassids[$i]);
    		}
    	}
    	if($user['su'] != '5'){
    		$this->db->where('savsoft_users.su', '2');
    	}
    	$this->db->order_by('savsoft_users.uid','desc');
    	$query=$this->db->get('savsoft_users');
    	//log_message('error', $uid);
		if($user['su'] == '2'){
    		return array();
    	}
		return $query->result_array();
    }

    function assignquestion($user, $qid, $uid){
    	$assid = $user['uid'];

		$userdata = array(
			'qid' => $qid, 
			'assid' => $assid,
			'uid' => $uid
		);

		$this->db->insert('savsoft_qassign', $userdata);

		$assignfrom = array(
	  		"uid" => $assid,
	  		"content" => "đã giao một câu hỏi.",
	  		"model" => "savsoft_qbank",
	  		"action" => "Assign question",
	  		'click' => "question_ass(".$qid.",".$assid.")"
	  	);
	  	$this->db->insert('notify',$assignfrom);
	  	$nid = $this->db->insert_id();

	  	$assignto1 = array(
 			'nid' => $nid,
 			'uid' => $uid,
 		);
 		$this->db->insert('notify_user', $assignto1);

 		$this->load->model('notification_model');
 		$dataArr = array(
 			'message' => 'đã giao một câu hỏi.',
 			'title' => "Thông Báo"
 		);
 		$this->notification_model->sendNotification($uid, $dataArr);

 		$this->db->where('savsoft_users.uid',$uid);
	   	$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$query=$this->db->get('savsoft_users');
	 	$student = $query->row_array();

 		$messagetoassign= 'Bạn đã gửi thành công một câu hỏi trắc nghiệm cho '.$student['first_name'].'. Đố sẽ gửi thông báo đến bạn sau khi có kết quả làm bài của '.$student['first_name'].' .';
		$mailtoassign=$user['email'];
		$this->sendmail($mailtoassign, $messagetoassign);

		$messagetoassigned = 'Bạn vừa được phụ huynh/giáo viên '.$user['first_name'].' giao một câu hỏi trắc nghiệm. Hãy truy cập vào hệ thống để trả lời câu hỏi.';
		$mailtoassigned = $student['email'];
		$this->sendmail($mailtoassigned, $messagetoassigned);

 		return true;
	}
   function like_question($uid, $qid){
	  $this->db->where('model', 'qbank');
	  $this->db->where('content_id', $qid);
	  $this->db->where('uid', $uid);
      $liked =  $this->db->get('savsoft_like');
      if($liked->num_rows()>0){
		  $like_id =$liked->row_array()['like_id'];
		  $like_status=$liked->row_array()['status'];
		  $status =1-$like_status;
		  $upd=array('uid'=>$uid,
					 'model'=>'qbank',
					 'content_id'=>$qid,
					 'status'=>$status,
		  );
		  $this->db->where('like_id',$like_id);
          $this->db->update('savsoft_like', $upd);		  
	  }	 
     else{
		$this->db->where('qid', $qid);
		if($this->db->get('savsoft_qbank')->num_rows()>0) {
			$ins = array('uid'=>$uid,
						 'model'=>'qbank',
						 'content_id'=>$qid,
						 'status'=>1
			); 
			$this->db->insert('savsoft_like', $ins);
		}
	 }
	  if($status==1){
		 $this->db->where("qid", $qid);
		 $qt= $this->db->get('savsoft_qbank')->row_array();
		 $this->load->model('predictio_model');
         $this->predictio_model->push_event("like",$uid,$qid, $qt['cid'], $qt['lid']);
	 }
  } 
  function like_quiz($uid, $quid){
	  $this->db->where('model', 'quiz');
	  $this->db->where('content_id', $quid);
	  $this->db->where('uid', $uid);
      $liked =  $this->db->get('savsoft_like');
      if($liked->num_rows()>0){
		  $like_id =$liked->row_array()['like_id'];
		  $like_status=$liked->row_array()['status'];
		  $status =1-$like_status;
		  $upd=array('uid'=>$uid,
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
			$ins = array('uid'=>$uid,
						 'model'=>'quiz',
						 'content_id'=>$quid,
						 'status'=>1
			); 
			$this->db->insert('savsoft_like', $ins);
		}
	 }
  } 

  function dataforvuidetail($cname){
  	
  	$arrcname = explode('-', $cname);
  	$sql = "SELECT q.qid, q.question, q.background_template, c.category_name, p.permalink FROM savsoft_qbank q INNER JOIN savsoft_category c ON c.cid = q.cid INNER JOIN savsoft_permalink p ON p.content_id = q.qid WHERE p.model = 'qbank' ";
  	$sql_cname = " AND c.category_name LIKE '%$arrcname[1]%' ";
  	
  	for($i=2; $i<count($arrcname); $i++){
  		$sql_cname .= "  OR c.category_name LIKE '%$arrcname[$i]%' ";
  	}
  	$sql .= $sql_cname;
  	$sql .= " ORDER BY RAND() LIMIT 1";

  	$query = $this->db->query($sql);
  	if(count($query->result_array()) > 0){
  		$data = $query->result_array();
  	}else{
  		$sql = str_replace($sql_cname, ' ', $sql);
  		$querys = $this->db->query($sql);
  		$data = $querys->result_array();
  	}
  	
  	for($i=0; $i<count($data); $i++){
		$origImageSrc="";
		$imgTags="";	
		$htmlContent=$data[$i]['question'];
		$this->db->where('qid',$data[$i]['qid']);
		$options = $this->db->get('savsoft_options');
		$data[$i]['options']=$options->result_array();
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
			 if($data[$i]['background_template']!=0){
				 $data[$i]['img']=base_url("upload/background/".$data[$i]['background_template'].".jpg");
			 }
			 else{
				 $data[$i]['img']=base_url("upload/background/".rand(1,20).".jpg");
			 }
				
		 }
		$data[$i]['permalink']=site_url()."/page/question/".$data[$i]['permalink']."/notsolved";
	}

	return $data;
	
  }

  	function assignQuizApi($user, $quid, $ruid, $startdate, $enddate){

    	$uid = $user['uid'];
    	$aname = $user['first_name'];
    	if($enddate==""){
			$enddate= date('Y-m-d', time()+7*24*60*60);
		}
        $this->db->where("quid", $quid);
		$price=$this->db->get("savsoft_quiz")->row_array()['points'];		
  		$assigndata = array(
  			'quid' => $quid, 
  			'auid' => $uid,
  			'aname' => $aname,
  			'uid' => $ruid,
  			'startdate' => $startdate,
  			'enddate' => $enddate,
			'price'=>$price
  		);
  		$this->db->insert('savsoft_assign', $assigndata);
  		$assid = $this->db->insert_id();

		
 
 		$this->db->where('quid',$quid);
		$queryquiz=$this->db->get('savsoft_quiz');
	 	$quiz = $queryquiz->row_array();

	 	$userdata['uids'] = $quiz['uids'].",".$ruid;

	  	$this->db->where('quid',$quid);
	  	$this->db->update('savsoft_quiz',$userdata);
        $type="kiểm tra.";
		$this->db->where('quid', $quid);
		$qq= $this->db->get('savsoft_quiz')->row_array();
		if($qq){
			if($qq['level_hard']){
				if($qq['level_hard']>3){
					$type="KNS.";
				}
				else{
					$type="HCC.";
				}
			}
		}	
	  	$assignfrom = array(
	  		"uid" => $uid,
	  		"content" => "đã giao một bài ".$type,
	  		"model" => "quiz",
	  		"action" => "Assign quiz",
	  		"click" => "window.location.href = '".site_url()."/quiz/validate_quizs/".$quid."/".$uid."/".$assid."'"
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
 			'uid' => $ruid,
 		);
 		$this->db->insert('notify_user', $assignto2);

 		$this->load->model('notification_model');
 		$dataArr = array(
 			'message' => 'đã giao một bài kiểm tra.',
 			'title' => "Thông Báo"
 		);
 		//$this->notification_model->sendNotification($ruid, $dataArr);

 		$this->db->where('savsoft_users.uid',$ruid);
	   	$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$query=$this->db->get('savsoft_users');
	 	$student = $query->row_array();

 		
		/*$messagetoassign= 'Bạn đã gửi thành công một bài trắc nghiệm cho '.$student['first_name'].'. Đố sẽ gửi thông báo đến bạn sau khi có kết quả làm bài của '.$student['first_name'].' .';
		$mailtoassign=$user['email'];
		$this->sendmail($mailtoassign, $messagetoassign);

		$messagetoassigned = 'Bạn vừa được phụ huynh/giáo viên '.$aname.' giao  một bài trắc nghiệm. Hãy click vào đường link dưới đây để trả lời.<br><br><a href="'.site_url().'/quiz/validate_quizs/'.$quid.'/'.$uid.'/'.$assid.'"><img src="http://do.stem.vn/images/button_lam-bai.png" height="40" width="116"></a>';
		$mailtoassigned = $student['email'];
		$this->sendmail($mailtoassigned, $messagetoassigned);*/

	  	return true;
  	}
	
	function assignQuizApi2($user, $quid, $ruid, $startdate, $enddate, $reward){

    	$uid = $user['uid'];
    	$aname = $user['first_name'];
    	if($enddate==""){
			$enddate= date('Y-m-d', time()+7*24*60*60);
		}
		$this->db->where("quid", $quid);
		$price=$this->db->get("savsoft_quiz")->row_array()['points'];		
  		$assigndata = array(
  			'quid' => $quid, 
  			'auid' => $uid,
  			'aname' => $aname,
  			'uid' => $ruid,
  			'startdate' => $startdate,
  			'enddate' => $enddate,
			'reward_point'=>$reward,
			'price'=>$price
  		);
  		$this->db->insert('savsoft_assign', $assigndata);
  		$assid = $this->db->insert_id();

		
 
 		$this->db->where('quid',$quid);
		$queryquiz=$this->db->get('savsoft_quiz');
	 	$quiz = $queryquiz->row_array();

	 	$userdata['uids'] = $quiz['uids'].",".$ruid;

	  	$this->db->where('quid',$quid);
	  	$this->db->update('savsoft_quiz',$userdata);
        
		$type="kiểm tra.";
		
		if($quiz){
			if($quiz['level_hard']){
				if($quiz['level_hard']>3){
					$type="KNS.";
				}
				else{
					$type="HCC.";
				}
			}
		}	
		
	  	$assignfrom = array(
	  		"uid" => $uid,
	  		"content" => "đã giao một bài ".$type,
	  		"model" => "quiz",
	  		"action" => "Assign quiz",
	  		"click" => "window.location.href = '".site_url()."/quiz/validate_quizs/".$quid."/".$uid."/".$assid."'"
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
 			'uid' => $ruid,
 		);
 		$this->db->insert('notify_user', $assignto2);

 		$this->load->model('notification_model');
 		$dataArr = array(
 			'message' => 'đã giao một bài kiểm tra.',
 			'title' => "Thông Báo"
 		);
 		//$this->notification_model->sendNotification($ruid, $dataArr);

 		$this->db->where('savsoft_users.uid',$ruid);
	   	$this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
		$query=$this->db->get('savsoft_users');
	 	$student = $query->row_array();

 		
		/*$messagetoassign= 'Bạn đã gửi thành công một bài trắc nghiệm cho '.$student['first_name'].'. Đố sẽ gửi thông báo đến bạn sau khi có kết quả làm bài của '.$student['first_name'].' .';
		$mailtoassign=$user['email'];
		$this->sendmail($mailtoassign, $messagetoassign);

		$messagetoassigned = 'Bạn vừa được phụ huynh/giáo viên '.$aname.' giao  một bài trắc nghiệm. Hãy click vào đường link dưới đây để trả lời.<br><br><a href="'.site_url().'/quiz/validate_quizs/'.$quid.'/'.$uid.'/'.$assid.'"><img src="http://do.stem.vn/images/button_lam-bai.png" height="40" width="116"></a>';
		$mailtoassigned = $student['email'];
		$this->sendmail($mailtoassigned, $messagetoassigned);*/

	  	return true;
  	}
	
	
		function num_result_2($search="",$cid=1,$uida=0){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
	 	
		$sql = "select r.rid FROM savsoft_result r inner join savsoft_users u on u.uid=r.uid inner join savsoft_quiz q on q.quid=r.quid where r.result_status != 'Open' ";
        if($search){
			$sql.= " and (q.quiz_name like '%".$search."%' or u.first_name like '%".$search."%')";
		}
		if($uida!=0){
			$sql.=" AND u.uid=$uida";
		}
		if($cid!=1){
			$sql.=" AND q.cid=$cid";
		}
		$setting_p=explode(',',$logged_in['result']);
		if(!in_array('List_all',$setting_p) and $logged_in['su'] != '1'){
			if($logged_in['su']==3 || $logged_in['su']==6 ){
				$sql.=" and (u.uid = $uid or r.rid in (SELECT rid FROM savsoft_assign WHERE auid = $uid)) ";
			}
			if($logged_in['su']==4){
				$sql.=" and (r.uid =$uid or r.uid in (select uid FROM savsoft_users where parent_id=$uid or parent_id like '%,$uid' or parent_id like '$uid,%'
				or parent_id LIKE '%,$uid,%')) ";
			}
			if($logged_in['su']==2||$logged_in['su']==5){
				$sql.=" and r.uid =$uid ";
			}
		}
		$sql .= " order by r.rid desc";
		$query = $this->db->query($sql);

	 	return $query->num_rows();
 	}
	
	function result_list_2($search="",$limit=10,$cid=1,$uida=0,$page=0){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
	 
		$sql = "select r.rid, u.first_name, u.last_name, q.quiz_name,r.result_status, r.percentage_obtained,q.cid FROM savsoft_result r inner join savsoft_users u on u.uid=r.uid inner join savsoft_quiz q on q.quid=r.quid where r.result_status != 'Open' ";
        if($search){
			$sql.= " and (q.quiz_name like '%".$search."%' or u.first_name like '%".$search."%')";
		}
		if($uida!=0){
			$sql.=" AND u.uid=$uida";
		}
		if($cid!=1){
			$sql.=" AND q.cid=$cid";
		}
		$setting_p=explode(',',$logged_in['result']);
		if(!in_array('List_all',$setting_p) and $logged_in['su'] != '1'){
			if($logged_in['su']==3 || $logged_in['su']==6 ){
				$sql.=" and (u.uid = $uid or r.rid in (SELECT rid FROM savsoft_assign WHERE auid = $uid)) ";
			}
			if($logged_in['su']==4){
				$sql.=" and (r.uid =$uid or r.uid in (select uid FROM savsoft_users where parent_id=$uid or parent_id like '%,$uid' or parent_id like '$uid,%'
				or parent_id LIKE '%,$uid,%')) ";
			}
			if($logged_in['su']==2||$logged_in['su']==5){
				$sql.=" and r.uid =$uid ";
			}
		}
		$sql .= " order by r.rid desc limit $limit Offset ".($limit*$page);
		$query = $this->db->query($sql);

	 	return $query->result_array();
 	}
	function num_result_3($search="",$uida=0,$cid=0){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
	 	
		$sql = " SELECT a.qid,u.uid,u.first_name,u.last_name,q.question,a.option_choice,a.option_correct
				FROM savsoft_answer_mcq a
				INNER JOIN savsoft_users u
				ON a.uid=u.uid
				INNER JOIN savsoft_qbank q
				ON a.qid=q.qid ";
		if($logged_in['su']==2){
			$sql.=" WHERE u.uid=$uid ";
		}
		if(	$logged_in['su']==4){	
		$sql.=" WHERE (u.parent_id like '%,$uid,%' or u.parent_id like '$uid,%' or u.parent_id like '%,$uid' or u.parent_id='$uid' or u.uid=$uid) ";
		}
		if($logged_in['su']==3 || $logged_in['su']==6 ){
				if($class_id){
				$sql.="	WHERE u.uid in (Select member_id from class_member where class_id in ($class_id)) ";
				}
				else
				$sql.= " WHERE u.uid=$uid";
			}
        if($search){
			$sql.= " and (q.question like '%".$search."%' or u.first_name like '%".$search."%')";
		}
		if($cid!=0){
				$sql.=" AND q.cid = $cid ";
			}
		if($uida!=0){
				$sql.= " AND a.uid=$uida ";
			}
		$setting_p=explode(',',$logged_in['result']);
		
		$sql .= " order by a.qid desc";
		$query = $this->db->query($sql);

	 	return $query->num_rows();
 	}
	function result_list_3($search="",$limit=10,$uida=0,$cid=0,$page=0){
		
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$class_id=$logged_in['class_id'];
				
		$sql = " SELECT a.qid,u.uid,u.first_name,u.last_name,q.question,a.option_choice,a.option_correct
				FROM savsoft_answer_mcq a
				INNER JOIN savsoft_users u
				ON a.uid=u.uid
				INNER JOIN savsoft_qbank q
				ON a.qid=q.qid ";
				
			if($logged_in['su']==2){
				$sql.=" WHERE u.uid=$uid ";
			}
			if(	$logged_in['su']==4){	
				$sql.=" WHERE (u.parent_id like '%,$uid,%' or u.parent_id like '$uid,%' or u.parent_id like '%,$uid' or u.parent_id='$uid' or u.uid=$uid) ";
			}
			if($logged_in['su']==3 || $logged_in['su']==6 ){
				if($class_id){
				$sql.="	WHERE u.uid in (Select member_id from class_member where class_id in ($class_id)) ";
				}
				else
				$sql.= " WHERE u.uid=$uid";
			}
			if($search){
				$sql.= " and (q.question like '%".$search."%' or u.first_name like '%".$search."%')";
			}
			if($cid!=0){
				$sql.=" AND q.cid = $cid ";
			}
			if($uida!=0){
				$sql.= " AND u.uid=$uida ";
			}
		
		$sql .= " order by a.qid desc limit $limit Offset ".($limit*$page);
		$data = $this->db->query($sql)->result_array();
        for($i=0; $i< count($data); $i++){
			$htmlContent= $data[$i]['question'];
			$origvidSrc="";
			$vidTags="";
			if(strpos($htmlContent, "<iframe") !==false){
				preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
				if(count($vidTags[0])>0){
					 if(strpos($vidTags[0][0], "facebook")!==false){
						$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
					 }
					 else{
						$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
					 }
					 $qt.=strip_tags($htmlContent);
					 $data[$i]['question']=$qt;
				} 
            }
			if(strpos($htmlContent,'https://latex.codecogs.com')===false){
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 			
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
				 if(count($imgTags[0])>0){
					 $qt='<div class="imgqtt"><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					 $qt.=strip_tags( $data[$i]['question']);
					 $data[$i]['question']=$qt;
					 
					 $data[$i]['img']=$origImageSrc;
					
					 
				 }	
             }			
			$this->db->where('model','qbank');
			$this->db->where('content_id',$data[$i]['qid']);
			$per=$this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data[$i]['permalink']=site_url("page/question/".$per);
		}
		
	 	return $data;
 	}
	function school_users(){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$sql= "SELECT A.schoolid,A.uid,A.school,A.tinh_thanh,d.dataitem_name,A.quan_huyen,A.school_name FROM
		(SELECT s.schoolid,u.uid,u.school,s.tinh_thanh,s.quan_huyen,s.school_name FROM school s 
		INNER JOIN savsoft_users u ON s.schoolid=u.school) as A
		INNER JOIN savsoft_dataitem d ON A.tinh_thanh=d.did  
				 ";
		if($uid){
			$sql.= "WHERE A.uid=$uid";
		}
		
		
		$data = $this->db->query($sql)->row_array();
		
		//$sql=" SELECT dataitem_name from savsoft_dataitem where did=".$data['quan_huyen'];
		//$data['huyen']=$this->db->query($sql)->row_array()['dataitem_name'];
		return $data;
	}
   // function check_link($link){
//		$file_headers = get_headers($link);
//		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
//		    $exists = false;
//		}
//		else {
//		    $exists = true;
//		}
//
 //       return $exists;
//
//    }
	function user_point(){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$sql="SELECT * FROM savsoft_users su where su.uid=$uid";
		$dt= $this->db->query($sql)->row_array();
		return $dt;
	}
	function count_notification(){
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$sql="select COUNT(u.uid) as so_luong from notify_user u inner join notify n on n.nid = u.nid inner join 		savsoft_users z on z.uid = n.uid where u.status=0 and u.uid = $uid and n.uid != $uid ";
		$dt= $this->db->query($sql)->row_array();
		return $dt;
	}

	function get_list_category(){
		$sql="select cat.cid, cat.category_name , CONCAT('https://stemup.app/upload/symbol/', cat.cid,'.png') as img ,count(a.quid) as count from savsoft_category cat left join  savsoft_quiz a on cat.cid = a.cid group by cat.cid";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
}
?>
