<?php
class Recomendation_model extends CI_Model{

    public function get_username($id){
        $query = $this->db->query('select first_name,last_name from savsoft_users where uid=?',array($id));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    public function get_question($uid){
        $query = $this->db->query('select A.qid, A.question,B.create_date as date from savsoft_qbank as A inner join savsoft_answer_mcq as B on A.qid=B.qid  where B.uid=? order by date desc;',array($uid));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    public function group_question_by_cid($id){
        $query = $this->db->query('select A.cid as cid, count(A.cid) as count_cid,C.category_name  from savsoft_qbank as A 
                                        inner join savsoft_answer_mcq as B on A.qid=B.qid  
                                        inner join savsoft_category as C on A.cid=C.cid
                                        where B.uid=?
										group by A.cid
										order by count_cid desc
                                        ;', array($id));
        if ($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    public function get_question_cid($id,$cid){
        $query = $this->db->query('select A.qid, A.question,B.create_date as modify_date, A.cid as cid, C.category_name from savsoft_qbank as A 
                                        inner join savsoft_answer_mcq as B on A.qid=B.qid  
                                        inner join savsoft_category as C on A.cid=C.cid
                                        where B.uid=? and A.cid=? order by cid,modify_date desc
                                        ;',array($id,$cid));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    /*
     * LIKE
     */
    public function get_like_by_user($uid){
        $query = $this->db->query('select A.qid, A.question,B.modify_date as date from savsoft_qbank as A inner join savsoft_like as B on A.qid=B.content_id  where B.uid=? order by date desc;',array($uid));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }
    public function group_like_by_cid($id){
        $query = $this->db->query('select B.cid as cid, count(B.cid) as count_cid, C.category_name as category_name from savsoft_like as A
                                        inner join savsoft_qbank as B on A.content_id=B.qid
                                        inner join savsoft_category as C on C.cid=B.cid
                                        where uid=? and A.model="qbank"
                                        group by cid 
                                        order by count_cid desc
                                        ;', array($id));
        if ($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    public function get_like_cid($id,$cid){
        $query = $this->db->query('select A.content_id, A.modify_date, B.cid as cid, B.question as question,C.category_name as category_name from savsoft_like as A
                                        inner join savsoft_qbank as B on A.content_id=B.qid
                                        inner join savsoft_category as C on C.cid=B.cid
                                        where uid=? and A.model="qbank" and C.cid=?
                                        order by cid,modify_date desc
                                        ;',array($id,$cid));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    /*
     * COMMENT
     */
    public function get_comment_by_user($uid){
        $query = $this->db->query('select A.qid,A.question, B.content,B.modify_date as date from savsoft_qbank as A inner join posts as B on A.qid=B.wall_id  where B.create_by=? order by date desc;',array($uid));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }
//
    public function group_comment_by_cid($id){
        $query = $this->db->query('select A.cid as cid,count(A.cid) as count_cid, C.category_name
                                        from savsoft_qbank as A
                                        inner join posts as B on A.qid=B.wall_id and B.model="qbank"
                                        inner join savsoft_category as C on A.cid=C.cid
                                        where B.create_by=? group by C.cid
                                        order by count_cid desc
                                        ;',array($id));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    public function get_catagory(){
        $query = $this->db->query('select cid, category_name from savsoft_category');
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    public function get_comment_cid($id,$cid){
        $query = $this->db->query('select A.post_id,B.question,B.cid,B.lid,A.content, A.modify_date from posts as A 
                                        inner join savsoft_qbank as B on B.qid=A.wall_id
                                        where create_by=? and B.cid=? and A.model="qbank"',array($id,$cid));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    /*
     * Theo Lop
     */
    //question
    public function group_question_by_lid($id){
        $query = $this->db->query('select B.lid, count(B.lid) as count_lid, C.level_name from savsoft_answer_mcq as A
                                        inner join savsoft_qbank as B on B.qid=A.qid
                                        inner join savsoft_level as C on B.lid=C.lid
                                        where uid=?
                                        group by B.lid
                                        order by count_lid desc
                                        ;',array($id));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    public function get_question_by_lid($id,$lid){
        $query = $this->db->query('select A.qid as qid, B.lid, B.question, C.level_name, A.create_date as modify_date from savsoft_answer_mcq as A
                                        inner join savsoft_qbank as B on B.qid=A.qid
                                        inner join savsoft_level as C on B.lid=C.lid
                                        where uid=? and C.lid=?
										order by lid,modify_date desc
                                        ;',array($id,$lid));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    //like
    public function group_like_by_lid($id){
        $query = $this->db->query('select B.lid as lid,C.level_name, count(B.lid) as count_lid  from savsoft_like as A
									inner join savsoft_qbank as B on B.qid=A.content_id
									inner join savsoft_level as C on C.lid=B.lid
									where uid=? and model="qbank"
									group by B.lid
									order by count_lid desc
                                        ;',array($id));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    public function get_like_by_lid($id,$lid){
        $query = $this->db->query('select A.content_id,B.question, B.lid as lid,C.level_name, A.modify_date from savsoft_like as A
									inner join savsoft_qbank as B on B.qid=A.content_id
									inner join savsoft_level as C on C.lid=B.lid
									where uid=? and B.lid=? and model="qbank"
									order by B.lid,modify_date desc
                                        ;',array($id,$lid));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    //comment
    public function group_comment_by_lid($id){
        $query = $this->db->query('select B.lid,C.level_name, count(B.lid) as count_lid from posts as A
										inner join savsoft_qbank as B on B.qid=A.wall_id
										inner join savsoft_level as C on C.lid=B.lid
										where create_by=? and model="qbank"
										group by B.lid
										order by count_lid desc
                                        ;',array($id));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

    public function get_comment_by_lid($id,$lid){
        $query = $this->db->query('select A.wall_id,B.question,A.content,B.lid,C.level_name,A.modify_date from posts as A
										inner join savsoft_qbank as B on B.qid=A.wall_id
										inner join savsoft_level as C on C.lid=B.lid
										where create_by=? and B.lid=? and model="qbank"
										order by B.lid,modify_date desc
                                        ;',array($id,$lid));
        if($query->num_rows()>0)
            return $query->result_array();
        return false;
    }

}