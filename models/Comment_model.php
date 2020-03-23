<?php
Class Comment_model extends CI_Model{
	function write($model,$wall_id, $parent_id=0){
		$user = $this->session->userdata('logged_in');
		$return_ar= array();
		if($user){
			$data = json_decode($this->input->raw_input_stream,true);
			$post = array('content'=>$data['content'],
						  'parent_id'=>$parent_id,
						  'wall_id'=>$wall_id,
						  'model'=>$model,
						  'create_by'=>$user['uid']
					);
			if($this->db->insert('posts', $post)){
				$return_ar=array("user_name"=>$user['first_name']." ".$user['last_name'],"photo"=>$user['photo']);

                if($model=="qbank"){
					$this->db->where("qid", $wall_id);
		            $qt= $this->db->get('savsoft_qbank')->row_array();
					$this->load->model('predictio_model');
					$this->predictio_model->push_event("comment",$user['uid'],$wall_id, $qt['cid'], $qt['lid']);
	            }
			}
		}
	    return $return_ar;
	}
	
	function get_comment($model,$wall_id, $parent_id=0, $limit=2){
		$this->db->from('posts p');
		$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
		$this->db->where('p.model',$model);
		$this->db->where('p.wall_id',$wall_id);
		$this->db->where('p.parent_id', $parent_id);
		if($limit>0){
			$this->db->limit($limit);
		}
		$this->db->order_by("p.create_date", "desc");
		$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,photo");
		$data =$this->db->get()->result_array();
		return $data;
	}
	function delete_comment_model($post_id){
		$this->db->where('post_id',$post_id);
		return $this->db->update('posts', array("deleted"=>1));
		
	}
	function num_manage_comment($search=""){
		$sql = " select A.*, TRIM(CONCAT(u.first_name,' ' ,u.last_name))as create_name from 
					(((select p.post_id, p.deleted, p.wall_id as wid, p.model, p.create_date, p.content,q.question as name,
					p.create_by
					from posts p
					join savsoft_qbank q on p.wall_id =q.qid and model = 'qbank' ) 
					Union 
					(select p.post_id, p.deleted, p.wall_id as wid, p.model, p.create_date, p.content, qu.quiz_name as name,
					p.create_by
					from posts p
					join savsoft_quiz qu on p.wall_id =qu.quid and model = 'quiz' ) 
					 ) as A

					join savsoft_users u on u.uid = A.create_by
					)WHERE A.deleted = 0 " ;
			if($search){
				$sql.= " AND (A.content like '%".$search."%' or A.name like '%".$search."%')";
			}
			$query = $this->db->query($sql);

			return $query->num_rows();
	}
	function list_manage_comment($search="",$limit=10,$page=0){
		
		$sql = " select A.*, TRIM(CONCAT(u.first_name,' ' ,u.last_name))as create_name from 
					(((select p.post_id, p.deleted, p.wall_id as wid, p.model, p.create_date, p.content,q.question as name,
					p.create_by
					from posts p
					join savsoft_qbank q on p.wall_id =q.qid and model = 'qbank' ) 
					Union 
					(select p.post_id, p.deleted, p.wall_id as wid, p.model, p.create_date, p.content, qu.quiz_name as name,
					p.create_by
					from posts p
					join savsoft_quiz qu on p.wall_id =qu.quid and model = 'quiz' ) 
					 ) as A

					join savsoft_users u on u.uid = A.create_by
					) WHERE A.deleted = 0";
			if($search){
				$sql.= "  and (A.content like '%".$search."%' or A.name like '%".$search."%')";
			}
		//$sql .= " limit $limit Offset ".($limit*$page);
		$sql .= " order by A.post_id desc limit $limit Offset ".($limit*$page);
		$data = $this->db->query($sql)->result_array();
		return $data;
		
	}
	
}