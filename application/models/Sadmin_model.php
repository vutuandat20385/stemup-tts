<?php
Class Sadmin_model extends CI_Model{

	function login_verify($email, $password){
		$this->db->where('password', MD5($password));
		$this->db->where('email', $email);
		// $this->db->where('su',1);
		$this->db->where('user_status', 'Active');
		$query = $this->db->get('savsoft_users');

		if($query->num_rows() == 1){
			return array('status'=>'1','user'=>$query->row_array());
		}else
		return array('status'=>'0');
	}

	function get_list_account(){
		$this->db->select('uid, email, first_name, point');
		$this->db->where('su',4);
		$this->db->where('user_status','Active');
		$list_user=$this->db->get('savsoft_users')->result_array();

		return $list_user;
	}

	function list_account_search($string){
		$sql = "SELECT uid,email,first_name,point FROM savsoft_users WHERE su=4 AND user_status = 'Active' AND (email LIKE '%$string%' OR first_name LIKE '%$string%')";

		$kq = $this->db->query($sql)->result_array();
		if($kq>0){
			return array('status' => 1,
				'user' => $kq);
		}else 
		return array('status' => 0);

	}

	function get_list_lid(){
		$this->db->limit(13);
		$result = $this->db->get('savsoft_level')->result_array();
		return $result;
	}
	function get_list_cid(){
		$result = $this->db->get('savsoft_category')->result_array();
		return $result;		
	}

	function add_life_account($email){
		// log_message('error','bien1: '.$email);
		if($email==''){
			$sql = "SELECT u.uid, u.email, CONCAT(u.first_name,' ',u.last_name) name, u.point FROM savsoft_users u	WHERE group_account = 1 ";
			$data = $this->db->query($sql)->result_array();
			$arr = array(
				'status'=>2,
				'data'=>$data
			);
			return $arr;
		}else{
			$sqlsu = "SELECT * FROM savsoft_users WHERE email='$email'";
			$test = $this->db->query($sqlsu )->row_array();

			if(count($test) == 0){
				$sql = "SELECT u.uid, u.email, CONCAT(u.first_name,' ',u.last_name) name, u.point FROM savsoft_users u	WHERE group_account = 1";
				$data = $this->db->query($sql)->result_array();
				$arr = array(
					'status'=>-1,
					'data'=>$data
				);
				return $arr;				
			}else{
				if($test['su']==4){
					$sql_add = "UPDATE savsoft_users SET group_account='1' WHERE email='$email'";
					$mt = $this->db->query($sql_add);

					$sql = "SELECT u.uid, u.email, CONCAT(u.first_name,' ',u.last_name) name, u.point FROM savsoft_users u	WHERE group_account = 1 AND user_status ='Active'";
					$data = $this->db->query($sql)->result_array();

					$arr = array(
						'status'=>1,
						'data'=>$data						
					);
					return $arr;
				}else{
					$sql = "SELECT u.uid, u.email, CONCAT(u.first_name,' ',u.last_name) name, u.point FROM savsoft_users u	WHERE group_account = 1";
					$data = $this->db->query($sql)->result_array();
					$arr = array(
						'status'=>0,
						'data'=>$data
					);
					return $arr;
				}

			}

		}
	}
	function life_account(){

		$sql = "SELECT u.uid, u.email, CONCAT(u.first_name,' ',u.last_name) name, u.point from savsoft_users u WHERE su =4 and group_account =1 and user_status ='Active'";
		$data = $this->db->query($sql)->result_array();
		return $data;

	}

	function search_life_account_1($string){
		/*$this->db->where('group_account',1);
		$this->db->like('email',$string,'both');
		$query = $this->db->select('uid','email','first_name','point');*/
		$sql = "SELECT uid, email, first_name, point FROM savsoft_users	WHERE group_account = 1 and (email LIKE '%$string%' or first_name LIKE '%$string%')";
		$query = $this->db->query($sql)->result_array(); 
		// log_message('error','Ban ghi: '.$query);

		if($query > 0){
			return array('status'=>1, 
				'result'=>$query);
		}else{
			return array('status'=>0);
		}
	}

	function count(){
		/*$sql = "SELECT * FROM savsoft_users WHERE group_account=1";
		$query = $this->db->query($sql);*/
		$this->db->where('group_account',1);
		$get_account = $this->db->get("savsoft_users")->result_array();
		$count = count($get_account);
		// $count = count($query->result_array());
		return $count;
	}
	function count_lid_cid($cid,$lid){
		$sql = "
		SELECT L.* from savsoft_level L
		left join savsoft_qbank Q on L.lid = Q.lid 
		where Q.cid = $cid
		and L.lid = $lid
		";
		$data = $this->db->query($sql)->num_rows();
		return $data;
	}
	function get_feedback_search($string){
		
		$sql =  "SELECT fb.fbid,fb.uid,fb.content,su.email,fb.create_date,ft.type_name,fb.`status` FROM feedback fb
		INNER JOIN feedback_type ft ON ft.fbtid = fb.type 
		LEFT JOIN savsoft_users su ON fb.type = su.uid 
		WHERE  (fb.content LIKE '%$string%' or su.email LIKE '%$string%' or ft.type_name LIKE '%$string%')";
		$query = $this->db->query($sql)->result_array(); 
		// log_message('error','Ban ghi: '.$query);

		if($query > 0){
			return array('status'=>1, 
				'result'=>$query);
		}else{
			return array('status'=>0);
		}
	}

	function get_feedback($string){
		/*$this->db->where('group_account',1);
		$this->db->like('email',$string,'both');
		$query = $this->db->select('uid','email','first_name','point');*/
		$sql = "SELECT uid, email, first_name, point FROM savsoft_users	WHERE group_account = 1 and email LIKE '%$string%'";
		$query = $this->db->query($sql)->result_array(); 
		// log_message('error','Ban ghi: '.$query);

		if($query > 0){
			return array('status'=>1, 
				'result'=>$query);
		}else{
			return array('status'=>0);
		}
	}

	function add_count(){
		/*$sql = "SELECT * FROM savsoft_users WHERE group_account=1";
		$query = $this->db->query($sql);*/
		$this->db->where('su',4);
		$get_account = $this->db->get("savsoft_users")->result_array();
		$count = count($get_account);
		// $count = count($query->result_array());
		return $count;

	}
	function get_total_parent(){
		$sql = "SELECT u.uid, u.email, CONCAT(u.first_name,' ',u.last_name) name, u.point from savsoft_users u WHERE su =4 and group_account =1 and user_status ='Active'";
		$query = $this->db->query($sql);
		if($query->num_rows()> 0){
			return count($query->result_array());
		}else return false;
	}
	function get_life_account($start,$limit){
		$sql = "SELECT u.uid, u.email, CONCAT(u.first_name,' ',u.last_name) name, u.point from savsoft_users u WHERE su =4 and group_account =1 and user_status ='Active' limit $start,$limit";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else return false;
	}
	function get_total_parent_list(){
		$sql ="SELECT * FROM savsoft_users where su=4 and user_status = 'Active'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return count($query->result_array());
		}else return false;
	}
	function get_parent_limit_list($start,$limit){
		$sql = "SELECT uid, email,first_name, point from savsoft_users WHERE su =4 and user_status ='Active' limit $start,$limit";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else return false; 
	}
	function get_AllComment_limit($start,$limit){
		$this->db->select('post_id,content,create_date, deleted,first_name')
		->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
		->limit($limit,$start)
		->order_by("post_id", "desc");

		$query = $this->db->get('posts');

		if($query->num_rows()>0){
			return $query->result_array();
		}else
		return false;
	}
	function get_AllComment(){
		$this->db->select('post_id,content,create_date, deleted,first_name')
		->join('savsoft_users', 'savsoft_users.uid = posts.create_by')

		->order_by("post_id", "desc");

		$query = $this->db->get('posts');

		if($query->num_rows()>0){
			return $query->result_array();
		}else
		return false;
	}
	function get_AllComment_byStatus_limit($status,$start,$limit){
		$this->db->select('post_id,content,create_date, deleted,first_name')
		->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
		->where("deleted",$status)
		->limit($limit,$start)
		->order_by("post_id", "desc");

		$query = $this->db->get('posts');

		if($query->num_rows()>0){
			return $query->result_array();
		}else
		return false;
	}
	function get_AllComment_byStatus($status){
		$this->db->select('post_id,content,create_date, deleted,first_name')
		->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
		->where("deleted",$status)
		->order_by("post_id", "desc");

		$query = $this->db->get('posts');

		if($query->num_rows()>0){
			return $query->result_array();
		}else
		return false;
	}
	function search_manage_comment($string){
		/*$this->db->where('group_account',1);
		$this->db->like('email',$string,'both');
		$query = $this->db->select('uid','email','first_name','point');*/
		$sql = "SELECT p.post_id,p.content,p.create_date, p.deleted,u.first_name FROM posts p
		INNER JOIN  savsoft_users u ON u.uid = p.create_by

		WHERE p.content LIKE '%$string%'
		ORDER BY post_id DESC";
		$query = $this->db->query($sql)->result_array(); 
		// log_message('error','Ban ghi: '.$query);

		if($query > 0){
			return array('status'=>1, 
				'result'=>$query);
		}else{
			return array('status'=>0);
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

	// get status from feedback table
	function getFeedBackStatus() {
		$query = "SELECT status FROM feedback WHERE status = 0";
		$feedback = $this->db->query($query);
		if ($feedback->num_rows() > 0) {
			$fbGet = $feedback->result_array();
			return count($fbGet);
		}
		else {
			return 0;
		}
	}

	// change feedback status
	function updateFeedbackStatus($fbid, $fbstatus) {
		// $sql = "UPDATE feedback SET status = $fbstatus WHERE fbid = $fbid ";
		if ($fbstatus == 0) {
			$sql = "UPDATE feedback SET status = 1 WHERE fbid = $fbid ";
			$success = $this->db->query($sql);
			if ($success) {
				return "Phản hồi đã được xử lý";
			}
			else {
				return "Thất bại";
			}
		}
		else if ($fbstatus == 1) {
			$sql = "UPDATE feedback SET status = 0 WHERE fbid = $fbid ";
			$success = $this->db->query($sql);
			if ($success) {
				return "Phản hồi đã được xử lý";
			}
			else {
				return "Thất bại";
			}
		}
	}

	// changed user status
	function updatedUserStatus($uid) {
		$sql = "UPDATE savsoft_users SET user_status = 'inactive' WHERE uid = $uid ";
		$success = $this->db->query($sql);
		if ($success) {
			return "Thành công";
		}
		else {
			return "Thất bại";
		}
	}

	// count records in savsoft_quiz, savsoft_library, savsoft_users (su = 4) and savsoft_qbank
	function getStatisticDashboard() {
		// Declare variables
		$quizCounted = 0;
		$libCounted = 0;
		$parentCounted = 0;
		$questionsCounted = 0;
		$childCounted = 0;
		// get quiz counted
		$sqlQuiz = "SELECT quid FROM savsoft_quiz WHERE deleted = 0";
		$quiz = $this->db->query($sqlQuiz);
		if ($quiz->num_rows() > 0) {
			$quizCtd = $quiz->result_array();
			$quizCounted = count($quizCtd);
		}

		// get video counted
		$sqlLib = "SELECT lib_id FROM savsoft_library WHERE deleted = 0";
		$library = $this->db->query($sqlLib);
		if ($library->num_rows() > 0) {
			$libCtd = $library->result_array();
			$libCounted = count($libCtd);
		}

		// get parent account counted (su = 4)
		$sqlParents = "SELECT uid FROM savsoft_users WHERE su = 4 AND user_status = 'Active' ";
		$parents = $this->db->query($sqlParents);
		if ($parents->num_rows() > 0) {
			$parentCtd = $parents->result_array();
			$parentCounted = count($parentCtd);
		}

		// get children account counted (su = 2)
		$sqlChildrens = "SELECT uid FROM savsoft_users WHERE su = 2 AND user_status = 'Active' ";
		$childrens = $this->db->query($sqlChildrens);
		if ($childrens->num_rows() > 0) {
			$childCtd = $childrens->result_array();
			$childCounted = count($childCtd);
		}

		// get question counted
		$sqlQuestions = "SELECT qid FROM savsoft_qbank WHERE deleted = 0";
		$questions = $this->db->query($sqlQuestions);
		if ($questions->num_rows() > 0) {
			$questionsCtd = $questions->result_array();
			$questionsCounted = count($questionsCtd);
		}
		$dataResult = array("quizCounted" => $quizCounted, "libCounted" => $libCounted, "parentCounted" => $parentCounted, "childCounted" => $childCounted, "questionsCounted" => $questionsCounted);
		return $dataResult;
	}
	function num_news(){
		$sql = " SELECT * FROM savsoft_news ";
		$query = $this->db->query($sql)->num_rows();
		return $query;
	}
	function get_email_parent($string_email){
		$string_email = substr($string_email, 0, -2);
		$sql = " select email from savsoft_users where uid in ( $string_email ) ";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
	// count row savsoft_new
	public function record_count() {
      	return $this->db->count_all("savsoft_news");
    }
    public function record_count_search($text) {
      

    		$query="SELECT count(*) FROM savsoft_news sn 
					LEFT JOIN savsoft_category_news scn ON scn.id=sn.category
					WHERE sn.status=1 and name like '%$text%'";
				$query = $this->db->query($query)->num_rows();
		return $query;	
    }
    public function search_news($text){
    	$query = "SELECT sn.*, scn.category_name FROM savsoft_news sn 
			LEFT JOIN savsoft_category_news scn ON scn.id=sn.category
			WHERE sn.status=1 and name like '%$text%' or category_name like '%$text%'  ORDER BY sn.pos  ";
			$data = $this->db->query($query)->result_array();
			return $data;
    }
    public function fetch_page_news($offset,$limit){
    	$query = "SELECT sn.*, scn.category_name FROM savsoft_news sn 
			LEFT JOIN savsoft_category_news scn ON scn.id=sn.category
			WHERE sn.status=1 ORDER BY sn.pos limit $offset,$limit";
			$data = $this->db->query($query)->result_array();
			return $data;
    }
public function record_count_feedBack() {
      $data=$this->db->count_all("feedback fb");
     
      return $data;

    }
	public function data_feed_back($limit, $id) {
      // $this->db->limit($limit);
      // $this->db->where('id', $id);
		
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
	function list_news($page=0,$limit=5){
		$num=($page-1)*6;
		// $sql = " SELECT sn.*, scn.category_name FROM savsoft_news sn 
		// 			LEFT JOIN savsoft_category_news scn ON scn.id=sn.category
		// 			WHERE sn.status=1 ORDER BY sn.id DESC limit $num,$limit ";
		$sql = " SELECT sn.*, scn.category_name FROM savsoft_news sn 
		LEFT JOIN savsoft_category_news scn ON scn.id=sn.category
		WHERE sn.status=1 ORDER BY sn.id DESC limit $limit ";
					
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	function list_edit_news($page=0,$limit=5,$id_new){
		$sql = " SELECT sn.*, scn.category_name FROM savsoft_news sn 
					LEFT JOIN savsoft_category_news scn ON scn.id=sn.category
					WHERE sn.id not in ($id_new) ORDER BY sn.id DESC limit $limit ";
		$query = $this->db->query($sql)->result_array();
		return $query;

	}
	function list_news_edit($id) {
    $sql = " SELECT sn.*, scn.category_name FROM savsoft_news sn
					LEFT JOIN savsoft_category_news scn ON scn.id=sn.category
					WHERE sn.status=1 and sn.id != $id ORDER BY sn.id limit 12 ";
    $query = $this->db->query($sql)->result_array();
    return $query;

}

	function get_data_news($search,$limit,$page){
		$sql = " SELECT * FROM savsoft_news sn WHERE sn.status=1 ORDER BY sn.id DESC limit $limit ";
		if($search){
			$sql .= " sn.name like '%".$search."%' or sn.description like '%".$search."%' or sn.create_date like '%".$search."%'";
		}
		$sql .=" offset ".($page*$limit);

		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	function email_send(){
		$sql = " SELECT * from email where status = 1 ORDER BY id";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	function all_email_parent(){
		$select = " select uid from savsoft_users where su = 4 and user_status = 'Active' ";
		$result = $this->db->query($select)->result_array();
		return $result;
	}
	function email_parent( $page =0,$search=''){
		$select = " select uid,email,first_name,last_name, concat( first_name , ' ', last_name ) as username  from savsoft_users where su = 4 and user_status = 'Active' ";
		if($search == "") {
			$where = '';
		} else {
			$where = " and ( email like '%$search%' or first_name like '%$search%' or last_name like '%$search%'  ) ";
		}
		$os = 10*$page;
		$limit = " limit 10 ";
		$offset = " offset $os ";
		$sql = $select.' '. $where.' '.$limit .' '.$offset;
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
	function number_email_parent($search =''){
		$select = " select uid,email,first_name,last_name, concat( first_name , ' ', last_name ) as username  from savsoft_users where su = 4 and user_status = 'Active' ";
		if($search == "") {
			$where = '';
		} else {
			$where = " and ( email like '%$search%' or first_name like '%$search%' or last_name like '%$search%'  ) ";
		}
		$sql = $select.' '. $where;
		$result = $this->db->query($sql)->num_rows();
		return $result;
	}

	function get_list_chon($list_id){
		$sql="SELECT * FROM savsoft_news WHERE id in ($list_id)";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else
			return false;
	}
	function get_list_chon_v2($list_id) {
		if(!is_null($list_id)){
			$sql = "SELECT * FROM savsoft_news WHERE id in ($list_id)";
			$query = $this->db->query($sql)->result_array();
			$html = '';
			foreach ($query as $key => $value) {
				$k=$key+1;
				$html .='<p class="dschon item">'.$k.' - '.$value['name'].'</p>';
			}
		}else{
			$html .='<p class="dschon item">Chưa có tin liên quan</p>';
		}
		
		return $html;
	}
	function get_new($id) {
		$sql = "select * from savsoft_news where id = $id";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	function delete_new($id) {
		$sql = "DELETE  from savsoft_news where id = $id";
		$query = $this->db->query($sql);
	}

	function update_pos($id, $pos){
		$sql="UPDATE savsoft_news SET pos=$pos WHERE id=$id";
		$query=$this->db->query($sql);
		if($query){
			return true;
		}else
			return false;
	}
	function count_quiz_correct($uid,$date1,$date2){ 
		$sql="SELECT *  FROM quiz.savsoft_result where uid=$uid and result_status='Vượt qua' and start_time>$date1 and start_time<$date2";

		$count=$this->db->query($sql)->num_rows($sql);
		return $count;
	}

	function count_quiz_done($uid,$date1,$date2){
		$sql="SELECT *  FROM quiz.savsoft_result where uid=$uid and start_time>$date1 and start_time<$date2 and(result_status='Vượt qua' or result_status='Không vượt qua')";
		$count=$this->db->query($sql)->num_rows($sql);
		return $count;
	}

 	function count_total_quiz($uid,$date1,$date2){
		$sql="SELECT *  FROM quiz.savsoft_result where uid=$uid  and start_time>$date1 and start_time<$date2";

		$count=$this->db->query($sql)->num_rows($sql);
		return $count;
	}
	

	function get_all_payment($limit,$id) {
		
		$offset = ($id - 1) * $limit;

		$query = $this->db->query(" SELECT name,email,address,payment_request.create_at,token,code,payment_request.id,type,price,payment_request.status From payment_request  inner join payment_token  on payment_request.id=payment_token.id_req inner join payment_code  on payment_request.id=payment_code.id_req  limit $offset,$limit");
		// $query = $this->db->get("danhmuc");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	
	}
	function get_payment_search($search,$limit, $id) {
		

		$offset = ($id - 1) * $limit;

		$query = $this->db->query(" SELECT name,email,address,payment_request.create_at,token,code,payment_request.id,type,price,payment_request.status From payment_request  inner join payment_token  on payment_request.id=payment_token.id_req inner join payment_code  on payment_request.id=payment_code.id_req WHERE payment_request.email like '%$search%' or payment_request.name like '%$search%'  limit $offset,$limit");

	// $query = $this->db->get("danhmuc");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;

	}

	function count_payment() {
		$data = $this->db->count_all("payment_request");
	return $data;
	}

	function get_category_news(){
		$sql="SELECT * FROM savsoft_category_news";
		$query=$this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else
			return false;
	}
	  public function get_question_qvbank($qid){
            $sql="SELECT * FROM `savsoft_options` where qid=$qid";
            $query=$this->db->query($sql);
            if($query->num_rows() > 0){
                return $query->result_array();
            }else
                return false;
    
        }
}
