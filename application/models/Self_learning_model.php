<?php
Class Self_learning_model extends CI_Model{
	function get_list_category($lid){
		$sql="select sc.cid cid, sc.abbr tenmon,count(sq.cid) soluong from savsoft_quiz sq
				inner join savsoft_category sc on sc.cid=sq.cid
				where (sq.level_hard=0 or sq.level_hard is null) and (sq.lid=$lid or sq.lid=15)
				group by sq.cid
				ORDER BY sq.cid asc";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else return false;
	}

	function get_list_category_by_cid($lid,$cid,$start,$limit){
		$sql="SELECT quid, quiz_name,noq, duration from savsoft_quiz where (cid=$cid and (lid=$lid or lid=15)) limit $start,$limit";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else return false;
	}

	function get_total_record_n($lid,$cid){
		$sql="SELECT quid, quiz_name,noq, duration from savsoft_quiz where (cid=$cid and (lid=$lid or lid=15))";
		$query=$this->db->query($sql);
		return $query->num_rows();
	}

	function get_category_name($cid){
		$sql="select * from savsoft_category where cid=$cid";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else return false;
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
							$end=strpos($question['question'],'/>');

							if($start>0){
								$img=substr($question['question'],$start, $end-$start).' class="col-md-12 img-h100"/>';		
								return $img;
								break;
							}else{
								return '<img src="https://do.stem.vn/upload/default_image_quiz.png" class="col-md-12 img-h100" />';
									break;
							}	
					}
					

				}else if($result['img_video']){
					return $result['img_video'];

				}else if($result['img_reading']){
					return $result['img_reading'];
				}


										// if($result['img_video'])
										// 	return $result['img_video'];
										// else 
										// 	if($result['img_reading']){
										// 		return $result['img_reading'];
										// 	}else{
										// 		$qids=explode('',$result['qids']);
										// 		foreach ($qids as $key => $value) {

										// 			$sql_qid="select * from savsoft_qbank where qid=$value";
										// 			$query_qid=$this->db->query($sql_qid);
										// 			if($query_qid->num_rows()>0){
										// 				$question=$query->row_array();
														
										// 				$start=strpos($question['question'],'src="');
										// 				$end=strpos($question['question'],'" width="');
										// 				$img=substr ($question['question'],$start, $end-$start);

										// 				return $img;


										// 			}else return false;
										// 		}
										// 	}
										// }
		}else return false;
	}


}
	