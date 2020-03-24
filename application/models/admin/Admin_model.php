<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model {

    function login_verify($email, $password){
		$this->db->where('password', md5($password));
		$this->db->where('email', $email);
		$this->db->where('user_status', 'Active');
		$query = $this->db->get('savsoft_users');

		if($query->num_rows() > 0){
			return array('status'=>'1','user'=>$query->row_array());
		}else
		    return array('status'=>'0');
    }

    
    function get_question_list(){
        $this->db->select('qid, question, cid');
        $query = $this->db->get('savsoft_qbank');
        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    function list_news(){
        $this->db->select('savsoft_news.*, savsoft_category_news.category_name');
        $this->db->where('savsoft_news.status',1);
        $this->db->from('savsoft_news');
        $this->db->order_by('savsoft_news.id','DESC');
        $this->db->join('savsoft_category_news', 'savsoft_category_news.id = savsoft_news.category');
        $query = $this->db->get();
		if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    
    // count row savsoft_new
	public function record_count() {
        return $this->db->count_all('savsoft_news');
    }

    public function data_feed_back($limit, $id) {
          
        $offset = ($id-1)*$limit;
        
        $query = $this->db->query( " SELECT fb.fbid,fb.uid,fb.content,su.email,fb.create_date,ft.type_name,fb.`status` FROM feedback fb
          INNER JOIN feedback_type ft ON ft.fbtid = fb.type 
          LEFT JOIN savsoft_users su ON fb.type = su.uid limit $offset,$limit" );
        // $query = $this->db->get("danhmuc");
  
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
            $data[] = $row;
          }
          return $data;
        }
        return false;
    }

    public function record_count_feedBack() {
        $data=$this->db->count_all("feedback fb");
    
        return $data;
    }
    // change feedback status
    function updateFeedbackStatus($fbid, $fbstatus = 0)
	{

		$this->db->where('fbid', $fbid);
		$data = $this->db->get('feedback')->result_array();
		$fbstatus = $data[0]['status'];
		if ($fbstatus == 0) {
			$sql = "UPDATE feedback SET status = 1 WHERE fbid = $fbid ";
			$success = $this->db->query($sql);
			if ($success) {
				return 1;
			}
			else {
				return " Thấtbại";
			}
		}
		else if ($fbstatus == 1) {
			$sql = "UPDATE feedback SET status = 0 WHERE fbid = $fbid ";
			$success = $this->db->query($sql);
			if ($success) {
				return 0;
			}
			else {
				return "Thất bại";
			}
		}
	}
    // get feedback from database
	function getFeedBack() {
		$query = "SELECT fb.fbid,fb.uid,fb.content,su.email,fb.create_date,ft.type_name,fb.`status` FROM feedback fb
		INNER JOIN feedback_type ft ON ft.fbtid = fb.type 
		LEFT JOIN savsoft_users su ON fb.type = su.uid";
		$feedback = $this->db->query($query);
		$fbGet = $feedback->result_array();
		return $fbGet;
    }

    function get_class_new(){
        $data = $this->db->get('savsoft_category_news')->result_array();
        return $data;
    }

    function get_post_homepage(){
        $sql="SELECT sn.*, scn.category_name FROM savsoft_news sn
            LEFT JOIN savsoft_category_news scn ON sn.category=scn.id
            WHERE status=1 ORDER BY sn.pos LIMIT 6";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else 
            return false;
    }

    function num_news(){
		$sql = " SELECT * FROM savsoft_news ";
		$query = $this->db->query($sql)->num_rows();
		return $query;
    }
    
    function list_news_manage($page=0,$limit=6){
		$start=$page*$limit;
		$sql = " SELECT sn.*, scn.category_name FROM savsoft_news sn 
		LEFT JOIN savsoft_category_news scn ON scn.id=sn.category
		WHERE sn.status=1 ORDER BY sn.id DESC limit $start,$limit ";	
		$query = $this->db->query($sql)->result_array();
		return $query;
    }
    
    function get_list_chon($list_id){
		$sql="SELECT * FROM savsoft_news WHERE id in ($list_id)";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else
			return false;
    }
    
    function insert_new(){
        //    $inp = json_decode($this->input->raw_input_stream,true);
            $str = $_POST['name'];
            $target_dir = "images/image_news/";
            // $basename = basename($_FILES["avatar_news"]["name"]);
            $inputFileName = $target_dir . basename($_FILES["avatar_news"]["name"]);         
            $fileType = strtolower(pathinfo($inputFileName,PATHINFO_EXTENSION));
            if($fileType=="png" | $fileType=="jpg" ){
                // Upload file
    
                $target_dir = "images/image_news/";
                $basename = basename($_FILES["avatar_news"]["name"]);
                $inputFileName = $target_dir .$_POST['url_name']. '.png';
                move_uploaded_file($_FILES['avatar_news']['tmp_name'], $inputFileName);
             //   echo $basename;
            }
            if(!is_null($_POST['public_date'])){
                $public_date=date_format(date_create($_POST['public_date']),"Y-m-d");
            }else{
                $public_date=date("Y-m-d");
            }
            
            $data = array(
                'name' => $_POST['name'],
                'avatar' => base_url("images/image_news/".$_POST['url_name'].".png"),
                'url_name' => $_POST['url_name'],
                'featured' => $_POST['featured'],
                'category'  => $_POST['class'],
                'description'  => $_POST['des'],
                'content'  => $_POST['content'],
                'tag'  => $_POST['tag'],
                'public_date'  => $public_date,
                'status'  => 1,
                'pos'=> $_POST['pos'],
                'related_news'=> trim(' ',$_POST['related_news']),
                'source'=>$_POST['source']
            );
            $this->db->insert('savsoft_news', $data);
            if($this->db->affected_rows() > 0){
                $nid = $this->db->insert_id();
                $new_url = $_POST['url_name']."-".$nid;
                $this->db->set("url_name", $new_url);
                $this->db->where("id",$nid);
                $this->db->update("savsoft_news");
                $mess = "success";
            } else {
                $mess = "fail";
            }
            return $mess;
        }

        function check_name_exist(){
            $inp = json_decode($this->input->raw_input_stream,true);
            $this->db->where('name',$inp['name']);
            $check = $this->db->get('savsoft_news')->num_rows();
            if($check != 0) {
                $mess = 0;
            } else {
                $mess = 1;
            }
            return $mess;
        }

        function delete_new($id) {
            $sql = "DELETE  from savsoft_news where id = $id";
            $query = $this->db->query($sql);
        }

        function check_qid($qid){
            $this->db->select('lid,cid');
            $this->db->where('qid',$qid);
            return $this->db->get('savsoft_qbank')->row_array();
        }
    
        function count_lid_cid($lid,$cid,$arr){
            $dem = 0;
            foreach($arr as $k => $v){
                if($arr[$k]['lid']==$lid && $arr[$k]['cid']==$cid){
                    $dem +=1;
                }
            }
    
            return $dem;
        }

        function count_total_lid_cid($lid,$cid){
            $this->db->where('lid',$lid);
            $this->db->where('cid',$cid);
            return $this->db->get('savsoft_qbank')->num_rows();
        }
    
        function get_category_name($cid){
            $this->db->select('abbr');
            $this->db->where('cid',$cid);
            return $this->db->get('savsoft_category')->row_array();
        }

        function get_level_name($lid){
            $this->db->select('level_name');
            $this->db->where('lid',$lid);
            return $this->db->get('savsoft_level')->row_array();
        }
        public function insert($data) {
            $i=1;
                    foreach($data as $val){
          $i++;
          if($i>5){
            
              if($val['qid']==null)
          break;
          $qid=$val['qid'];
         $oid1=$val['id_op1'];
         $quetion=$val['question'];
         $oid2=$val['id_op2'];
         $oid3=$val['id_op3'];
         $oid4=$val['id_op4'];
         $op1=$val['op1'];
         $op2=$val['op2'];
         $op3=$val['op3'];
         $op4=$val['op4'];
         $da1=$val['dapan1'];
         $da2=$val['dapan2'];
         $da3=$val['dapan3'];
         $da4=$val['dapan4'];
          $sql="UPDATE `savsoft_options` SET  `qid` = $qid, `q_option` = '$op1', `score` = '$da1' WHERE `savsoft_options`.`oid` =$oid1";
          $sql1="UPDATE `savsoft_options` SET  `qid` = $qid, `q_option` = '$op2', `score` = '$da2' WHERE `savsoft_options`.`oid` =$oid2";
          $sql2="UPDATE `savsoft_options` SET  `qid` = $qid, `q_option` = '$op3', `score` = '$da3' WHERE `savsoft_options`.`oid` =$oid3";
          $sql3="UPDATE `savsoft_options` SET  `qid` = $qid, `q_option` = '$op4', `score` = '$da4' WHERE `savsoft_options`.`oid` =$oid4";
          $sql4="UPDATE `savsoft_qbank` SET `question` = '$quetion' WHERE `savsoft_qbank`.`qid` = $qid";
          $this->db->query($sql);
          $this->db->query($sql1);
          $this->db->query($sql2);
          $this->db->query($sql3);
          $this->db->query($sql4);
          }
          
                     
        }
                   
        if($i>6)
        return true;
        else return false;
    }

    function get_level_list(){
        return $this->db->get('savsoft_level')->result_array();
    }

    function get_category_list(){
        return $this->db->get('savsoft_category')->result_array();
    }

    function get_user(){
		$sql = "SELECT t.Date, t.totalNewUsers, x.totalNewParents, (t.totalNewUsers - x.totalNewParents) totalNewStudents 
		FROM ( SELECT DATE(registered_date) Date, COUNT(DISTINCT uid) totalNewUsers 
		FROM quiz.savsoft_users GROUP BY DATE(registered_date) ) AS t LEFT JOIN 
		( SELECT DATE(registered_date) Date, COUNT(DISTINCT uid) totalNewParents 
		FROM quiz.savsoft_users where su ='4' GROUP BY DATE(registered_date) ) AS x USING(Date) LIMIT 30";
		$query=$this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else
			return false;
	}

}