<?php
Class Api2_model extends CI_Model{
	function add_review_content($uid, $qid, $review_point, $review_content){

		$sql_add_review_content="INSERT INTO review_content(uid, qid, review_point, review_content) VALUES($uid, $qid, $review_point, '$review_content')";
		$query = $this->db->query($sql_add_review_content);
		if($query){
			return array('message'=>'success','status'=>1);
		}else
			return array('message'=>'fail','status'=>0);
	}

	function add_review_content2($uid, $qid, $review_point, $review_content){
		$sql_check="SELECT * FROM review_content WHERE uid=$uid and qid=$qid";
		$query_check=$this->db->query($sql_check);
		if($query_check->num_rows() > 0 ){
			//(uid, qid) đã tồn tại -> cập nhật lại review_content
			$sql_add_review_content="UPDATE review_content SET review_point=$review_point, review_content='".$review_content."' WHERE (uid=$uid and qid=$qid)";
			$query = $this->db->query($sql_add_review_content);
			if($query){
				return array('message'=>'success','status'=>1);
			}else
				return array('message'=>'fail','status'=>0);

		}else{
			//(uid, qid) chưa tồn tại -> insert mới review_content
			$sql_add_review_content="INSERT INTO review_content(uid, qid, review_point, review_content) VALUES($uid, $qid, $review_point, '$review_content')";
			$query = $this->db->query($sql_add_review_content);
			if($query){
				return array('message'=>'success','status'=>1);
			}else
				return array('message'=>'fail','status'=>0);
		}
		
	}
	function get_review_content($uid, $qid){
		$sql_check="SELECT * FROM review_content WHERE uid=$uid and qid=$qid";
		$query = $this->db->query($sql_check);

		if($query->num_rows() > 0 ){
			$result=$query->row_array();
			$result['message']='success';
			return $result;
		}else{
			return array('message'=>'null');
		}
	}

	function get_reward_point($uid, $quid, $rid){
		//Số sao thưởng tối đa
		$sql_reward="SELECT * FROM savsoft_assign  WHERE quid=$quid and uid=$uid";
		$query_reward = $this->db->query($sql_reward);
		$result_reward = $query_reward->row_array();
		//	if($result_reward->num_rows() > 0){
		$reward_point=$result_reward['reward_point'];
		//	}else{
		//		$reward_point=0;
		//	}
		

		//Tổng số câu hỏi của bài quiz
		$sql_all="SELECT * FROM savsoft_quiz WHERE quid=$quid";
		$query_all=$this->db->query($sql_all);
		$quiz = $query_all->row_array();

		$video=count(explode(',', $quiz['video_mcq']));
		$reading=count(explode(',', $quiz['reading_mcq']));
		$mcq=count(explode(',', $quiz['qids']));

		$total = $mcq+$reading+$video;

		//Số câu trả lời đúng
		$sql="SELECT * FROM savsoft_answers WHERE uid=$uid and rid=$rid and score_u=1";
		$query = $this->db->query($sql);
		$count_result = count($query->result_array());

		// $star_points=round(($count_result/$total)*$reward_point);

		return array(
					'correct'=>$count_result,
					'total'=>$total,
					// 'starpoint'=>$star_points
					'reward_point'=>$reward_point
				);
	}

	public function baiduocgiao($auid, $uid, $num){
		$sql="SELECT quid, auid, aname,uid,startdate, rid, date(startdate), count(date(startdate)) as count_by_date FROM savsoft_assign 
			WHERE auid=$auid and uid=$uid
			GROUP BY date(startdate)
			ORDER BY startdate desc
			LIMIT $num";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function baidalam($auid, $uid, $date){
		$sql="SELECT *, date(startdate) FROM savsoft_assign 
			WHERE auid=$auid and uid=$uid and rid is not null and date(startdate)='$date'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else{
			return 0;
		}	
	}

	public function baivuotqua($uid, $date){
		$sql="SELECT uid, result_status, start_time FROM savsoft_result
		WHERE uid=4 and result_status='Vượt qua' and start_time=$date";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->num_rows();
		}else{
			return 0;
		}
	}

	function remove_quiz_assign($distinceday=1){
		$sql="DELETE FROM savsoft_quiz WHERE system_created = 1 AND (quid NOT IN (SELECT quid FROM savsoft_assign)) AND create_date < '".$distinceday."'";
		$query=$this->db->query($sql);
		if($query){
			return true;
		}else
			return false;
	}

}
 