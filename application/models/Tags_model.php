<?php
Class Tags_model extends CI_Model{
	function num_tags($search=""){
		$sql = "  select * FROM tags as t WHERE t.blacklist = '0' " ;
			if($search){
				$sql.= " AND (t.tag_name like '%".$search."%' )";
			}
			$query = $this->db->query($sql);

			return $query->num_rows();
	}
	function list_tags($search="",$limit=10,$page=0){
		
			$sql = " select * FROM tags as t WHERE t.blacklist = '0'  " ;
			if($search){
				$sql.= " AND (t.tag_name like '%".$search."%' )";
			}
		$sql .= " order by tag_id desc limit $limit Offset ".($limit*$page);
		$data = $this->db->query($sql)->result_array();
		foreach($data as $k=>$d){
			$sss= "select COUNT(*) as count from question_tag_rel qtr 
            join savsoft_qbank q on q.qid= qtr.question_id and q.deleted=0 and q.`status`=1
            where qtr.tag_id=".$d['tag_id'];
			$data[$k]['num_question']=$this->db->query($sss)->row_array()['count'];
		}
		return $data;
		
	}
	function update_tags_0($tag_id,$tag_name){
		
		$data = array("tag_name"=>$tag_name
		        );
		$this->db->where('tag_name',$tag_name);
		$this->db->where('tag_id != ',$tag_id);
		if($this->db->get('tags')->num_rows()>0){
		  return false;
		}
		else{
			$this->db->where('tag_id',$tag_id);	
			$this->db->update('tags',$data);
			return true;
		}
	}
	function delete_tags($tag_id){
		$this->db->where('tag_id',$tag_id);
		return $this->db->update('tags', array("blacklist"=>1));
	}
	function listper_tag_question($tag_id){
		$sql =  " SELECT DISTINCT inserted_by,inserted_by_name FROM question_tag_rel qtr 
				INNER JOIN savsoft_qbank q ON qtr.question_id=q.qid
                WHERE qtr.tag_id=$tag_id ";
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
	function listcat_tag_question($tag_id){
		$sql =  " SELECT A.cid,cta.category_name FROM savsoft_category cta INNER JOIN
				(SELECT DISTINCT cid,tag_id FROM question_tag_rel qtr 
				INNER JOIN savsoft_qbank q ON qtr.question_id=q.qid 	
				WHERE qtr.tag_id=$tag_id) as A ON cta.cid=A.cid  ";
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
	function listlev_tag_question($tag_id){
		$sql =  " SELECT lev.lid,lev.level_name FROM savsoft_level lev INNER JOIN
				(SELECT DISTINCT lid FROM question_tag_rel qtr 
				INNER JOIN savsoft_qbank q ON qtr.question_id=q.qid 	
				WHERE qtr.tag_id=$tag_id) as A ON A.lid=lev.lid  ";
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
	function num_question($search="",$tag_id,$a,$b,$c){
		$sql = "SELECT B.qid,B.question,B.inserted_by,B.inserted_by_name,B.cid,B.category_name,B.lid,B.tag_id,l.level_name FROM
		(SELECT A.qid,A.question,A.inserted_by,A.inserted_by_name,A.cid,c.category_name,A.lid,A.tag_id FROM 
		(SELECT q.qid,q.question,q.inserted_by,q.inserted_by_name,qtr.tag_id,q.cid,q.lid FROM question_tag_rel qtr 
		INNER JOIN savsoft_qbank q ON qtr.question_id=q.qid) as A
		INNER JOIN savsoft_category c ON A.cid=c.cid) as B
		INNER JOIN savsoft_level l ON l.lid=B.lid WHERE ";
		if($tag_id){
			$sql.="	 B.tag_id=$tag_id ";
		}
		if($a){
			$sql.="	and B.cid=$a";
		}
		if($b){
			$sql.="	and B.lid=$b";
		}
		if($c){
			$sql.="	and B.inserted_by=$c";
		}
		if($search){
				$sql.= " AND (B.question like '%".$search."%' )";
		}
		
		$query = $this->db->query($sql);
        //return  $sql;
		return $query->num_rows();
	}
	function list_question($search="",$limit=10,$page=0,$tag_id,$a,$b,$c){
		$sql = "SELECT B.qid,B.question,B.inserted_by,B.inserted_by_name,B.cid,B.category_name,B.lid,B.tag_id,l.level_name FROM
		(SELECT A.qid,A.question,A.inserted_by,A.inserted_by_name,A.cid,c.category_name,A.lid,A.tag_id FROM 
		(SELECT q.qid,q.question,q.inserted_by,q.inserted_by_name,qtr.tag_id,q.cid,q.lid FROM question_tag_rel qtr 
		INNER JOIN savsoft_qbank q ON qtr.question_id=q.qid) as A 
		INNER JOIN savsoft_category c ON A.cid=c.cid) as B
		INNER JOIN savsoft_level l ON l.lid=B.lid WHERE  ";
		if($tag_id){
			$sql.="	B.tag_id=$tag_id";
		}
		if($a){
		$sql.="	and B.cid=$a";
		}
		if($b){
			$sql.="	and B.lid=$b";
		}
		if($c){
			$sql.="	and B.inserted_by=$c";
		}
		if($search){
				$sql.= " AND (B.question like '%".$search."%' )";
		}
		
		$sql .= " order by B.tag_id desc limit $limit Offset ".($limit*$page);
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
	function merge_tags($tags_id,$tags_name){
		//tagid
		$tagid="";
	   $this->db->where("tag_name",$tags_name);
	   $data=$this->db->get("tags")->row_array();
	   if($data){
		   $tagid=$data['tag_id'];
	   }
	   else {
		   $this->db->insert('tags',array("tag_name"=>$tags_name));
		   $tagid= $this->db->insert_id();
	   }
	   $sql =' UPDATE question_tag_rel SET tag_id='.$tagid.' WHERE tag_id in ('.$tags_id.') ';
	   $this->db->query($sql);
	}
}