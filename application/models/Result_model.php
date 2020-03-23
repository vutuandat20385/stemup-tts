<?php
Class Result_model extends CI_Model
{
	
 
 function result_list($limit,$status='0'){
	$result_open=$this->lang->line('open');
	$logged_in=$this->session->userdata('logged_in');
	$uid=$logged_in['uid'];
	  
		
	if($this->input->post('search')){
		 $search=$this->input->post('search');
		 $this->db->or_where('savsoft_users.email',$search);
		 $this->db->or_where('savsoft_users.first_name',$search);
		 $this->db->or_where('savsoft_users.last_name',$search);
		 $this->db->or_where('savsoft_users.contact_no',$search);
		 $this->db->or_where('savsoft_result.rid',$search);
		 $this->db->or_where('savsoft_quiz.quiz_name',$search);
 
	 }else{
		 $this->db->where('savsoft_result.result_status !=',$result_open);
	 }
	 	 
		if(!in_array('List_all',explode(',',$logged_in['results']))){
		$this->db->where('savsoft_result.uid',$uid);
		}else{
		$logged_in=$this->session->userdata('logged_in');
	
		 if($logged_in['uid'] != '1'){
	 $uid=$logged_in['uid'];
	 $this->db->where('savsoft_quiz.inserted_by',$uid);
	 } 
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
 
 function result_list2($status='0',$page='0',$s){
	$result_open=$this->lang->line('open');
	$logged_in=$this->session->userdata('logged_in');
	$SELECT = "Select * from savsoft_result
		inner join savsoft_users on savsoft_users.uid=savsoft_result.uid
		inner join savsoft_quiz on savsoft_quiz.quid=savsoft_result.quid
		where 1=1";
	$uid=$logged_in['uid'];
		if(!in_array('List_all',explode(',',$logged_in['results']))){
		$WHERE = "and savsoft_result.uid = $uid ";
		}else{
		$logged_in=$this->session->userdata('logged_in');
		 if($logged_in['uid'] != '1'){
	 $uid=$logged_in['uid'];
		$WHERE = "and savsoft_quiz.inserted_by = $uid";
	 } 
		}
	 	if($status =='1'){
			$STATUS = "and savsoft_result.result_status = 'Vượt qua' ";
		}
		elseif($status =='2'){
			$STATUS = "and savsoft_result.result_status = 'Không vượt qua' ";
		}
		elseif($status=='3'){
			$STATUS = "and savsoft_result.result_status = 'Open' ";
		}
		if($s!=''){
	    $SEARCH = "and ( savsoft_quiz.quiz_name like '%$s%' or savsoft_users.first_name LIKE '%$s%' or savsoft_users.last_name LIKE '%$s%')";
		}
		$ORDERBY = " Order by rid DESC
		limit 20 
		offset ".(20*$page);
		$SQL = $SELECT. ' '. $WHERE . ' ' . $STATUS . ' ' . $SEARCH . ' ' . $ORDERBY;
		$query = $this->db->query($SQL);
		$data= array();
		if($query !== FALSE && $query->num_rows() > 0 ){
			$data = $query->result_array();
		}
		return $data;
}

 function quiz_list(){
	 $this->db->order_by('quid','desc');
$query=$this->db->get('savsoft_quiz');	
return $query->result_array();	 
 }
 
 function number_result($status='0',$s=''){
	$logged_in=$this->session->userdata('logged_in');
	$SELECT = " SELECT * FROM savsoft_result 
	inner join savsoft_quiz on savsoft_quiz.quid = savsoft_result.quid 
	inner join savsoft_users on savsoft_users.uid = savsoft_result.uid";
	if($s != ''){
		$WHERE = "where (savsoft_users.email LIKE '%$s%'or savsoft_users.first_name LIKE '%$s%' or savsoft_users.last_name LIKE '%$s%' or savsoft_quiz.quiz_name LIKE '%$s%')";
		if($status =='1'){
			$WHERE .= "and savsoft_result.result_status = 'Vượt qua' ";
		}
		elseif($status =='2'){
			$WHERE .= "and savsoft_result.result_status = 'Không vượt qua' ";
		}
		elseif($status=='3'){
			$WHERE .= "and savsoft_result.result_status = 'Open' ";
		}
	}
	else{
		if($status =='1'){
			$WHERE = "where savsoft_result.result_status = 'Vượt qua' ";
		}
		elseif($status =='2'){
			$WHERE = "where savsoft_result.result_status = 'Không vượt qua' ";
		}
		elseif($status=='3'){
			$WHERE = "where savsoft_result.result_status = 'Open' ";
		}
	}
	$ORDER_BY = "order by savsoft_result.rid DESC";
	$sql = $SELECT ." ". $WHERE ." ". $ORDER_BY;
	$query=$this->db->query($sql);
	return $query->num_rows();
 }



 function no_attempt($quid,$uid){
	 
	$query=$this->db->query(" select * from savsoft_result where uid='$uid' and quid='$quid' ");
		return $query->num_rows(); 
 }
 
 
 function remove_result($rid){
	 
	 $this->db->where('savsoft_result.rid',$rid);
	 if($this->db->delete('savsoft_result')){
		  $this->db->where('rid',$rid);
		  $this->db->delete('savsoft_answers');
		 return true;
	 }else{
		 
		 return false; 
	 }
	 
	 
	 
 }
 function get_questions_answers($rid){
	 $this->db->where('rid', $rid);
	 $rs = $this->db->get('savsoft_result')->row_array();
	 if($rs){
		 $qids=$rs['r_qids'];
		 if($qids == ''){
			$qids=0; 
		 }else{
			 $qids=$qids;
		 }
		  
		 $qt_list=$this->db->query("select qid,question from savsoft_qbank where savsoft_qbank.qid in ($qids) order by FIELD(savsoft_qbank.qid,$qids)")->result_array();
		 for($k=0; $k<count($qt_list); $k++){
			$qt_list[$k]['question'] =str_replace('src="..', 'src="'.base_url(),$qt_list[$k]['question']);
			$this->db->where("qid", $qt_list[$k]['qid']);
			$this->db->select("oid,q_option,score");
			$qt_list[$k]['options']= $this->db->get("savsoft_options")->result_array();
			$qt_list[$k]['answered']=0;
			for($j=0; $j<count($qt_list[$k]['options']); $j++){
				$this->db->where('rid', $rid);
				$this->db->where("q_option",$qt_list[$k]['options'][$j]['oid'] );
				$ans= $this->db->get('savsoft_answers')->row_array();
				if($ans){
					$qt_list[$k]['answered']=1;
					if($ans['score_u']==0){
						$qt_list[$k]['options'][$j]['score']=2;
					}
				}
				
			}
		 }
		 return $qt_list;
	 }
     else return array();	 
	 
 }
 
  function get_questions_answers2($rid){
	 $this->db->where('rid', $rid);
	 $rs = $this->db->get('savsoft_result')->row_array();
	 if($rs){
		 $qids=$rs['r_qids'];
		 if($qids == ''){
			$qids=0; 
		 }else{
			 $qids=$qids;
		 }
		 
					
         $cid= array();
		 $cid_ar= array();
		 $res= array();
		 $qt_list=$this->db->query("select qid,question,cid,source from savsoft_qbank where savsoft_qbank.qid in ($qids) order by FIELD(savsoft_qbank.qid,$qids)")->result_array();
		 $sqlo = "select oid,qid,q_option,score from savsoft_options where qid in ($qids)";
	     $ao = $this->db->query($sqlo)->result_array();
	
		 for($k=0; $k<count($qt_list); $k++){
			 
			 $arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $qt_list[$k]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
		      $qt_list[$k]['options']=$arr_op;
			$qt_list[$k]['question'] =str_replace('src="..', 'src="'.base_url(),$qt_list[$k]['question']);
			
			
			$qt_list[$k]['answered']=0;
			for($j=0; $j<count($qt_list[$k]['options']); $j++){
				$this->db->where('rid', $rid);
				$this->db->where("q_option",$qt_list[$k]['options'][$j]['oid'] );
				$ans= $this->db->get('savsoft_answers')->row_array();
				if($ans){
					$qt_list[$k]['answered']=1;
					if($ans['score_u']==0){
						$qt_list[$k]['options'][$j]['score']=2;
						$qt_list[$k]["iscorrect"]=0;
					}
					else
						$qt_list[$k]["iscorrect"]=1;
				}
				
			}
			

		 }
		 
			 
			 
		return $qt_list;
	 }
     else return array();	 
	 
 }
 
 
 function generate_report($quid,$gid){
	$logged_in=$this->session->userdata('logged_in');
	$uid=$logged_in['uid'];
	$date1=$this->input->post('date1');
	 $date2=$this->input->post('date2');
		
		if($quid != '0'){
			$this->db->where('savsoft_result.quid',$quid);
		}
		if($gid != '0'){
			$this->db->where('savsoft_users.gid',$gid);
		}
		if($date1 != ''){
			$this->db->where('savsoft_result.start_time >=',strtotime($date1));
		}
		if($date2 != ''){
			$this->db->where('savsoft_result.start_time <=',strtotime($date2));
		}

	 	$this->db->order_by('rid','desc');
		$this->db->join('savsoft_users','savsoft_users.uid=savsoft_result.uid');
		$this->db->join('savsoft_group','savsoft_group.gid=savsoft_users.gid');
		$this->db->join('savsoft_quiz','savsoft_quiz.quid=savsoft_result.quid');
		$query=$this->db->get('savsoft_result');
		return $query->result_array();
 }
 
 
 
 
 
 function get_result($rid){
	$logged_in=$this->session->userdata('logged_in');
	$uid=$logged_in['uid'];
		if($logged_in['su']=='0'){
			$this->db->where('savsoft_result.uid',$uid);
		}
		$this->db->where('savsoft_result.rid',$rid);
	 	$this->db->join('savsoft_users','savsoft_users.uid=savsoft_result.uid');
		$this->db->join('savsoft_group','savsoft_group.gid=savsoft_users.gid');
		$this->db->join('savsoft_quiz','savsoft_quiz.quid=savsoft_result.quid');
		$query=$this->db->get('savsoft_result');
		return $query->row_array();
	 
	 
 }
 function get_rewardpoint($rid){
	$logged_in=$this->session->userdata('logged_in');
	$uid=$logged_in['uid'];
	$sql = " SELECT * FROM savsoft_assign sa INNER JOIN savsoft_result sr ON sa.rid=sr.rid WHERE sa.rid=$rid";
	$query=$this->db->query($sql)->row_array();	
	return $query;	
	 
	 
 }
 
 function last_ten_result($quid){
		$this->db->order_by('percentage_obtained','desc');
		$this->db->limit(10);		
	 	$this->db->where('savsoft_result.quid',$quid);
	 	$this->db->join('savsoft_users','savsoft_users.uid=savsoft_result.uid'); 
		$this->db->join('savsoft_quiz','savsoft_quiz.quid=savsoft_result.quid');
		$query=$this->db->get('savsoft_result');
		return $query->result_array();
 }
 
 
 
   function get_percentile($quid,$uid,$score){
  $logged_in =$this->session->userdata('logged_in');
$gid= $logged_in['gid'];
$res=array();
	$this->db->where("savsoft_result.quid",$quid);
	 $this->db->group_by("savsoft_result.uid");
	 $this->db->order_by("savsoft_result.score_obtained",'DESC');
	$query = $this -> db -> get('savsoft_result');
	$res[0]=$query -> num_rows();

	
	$this->db->where("savsoft_result.quid",$quid);
	$this->db->where("savsoft_result.uid !=",$uid);
	$this->db->where("savsoft_result.score_obtained <=",$score);
	$this->db->group_by("savsoft_result.uid");
	 $this->db->order_by("savsoft_result.score_obtained",'DESC');
	$querys = $this -> db -> get('savsoft_result');
	$res[1]=$querys -> num_rows();
		
   return $res;
  
  
 }
 
 
 
 
 
 
 
 
 
 
 
 
 

}












?>
