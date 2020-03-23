<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->library('Form_validation');
       $this->load->helper(array('Form', 'Cookie', 'String', 'url'));
	   $this->load->model('post_model');
	   $this->load->model('user_model');
	   	$this->load->model("qbank_model");
	   	$this->load->model("account_model");
	   	$this->load->model("result_model");
	   	$this->load->model("api_model");
	   	$this->load->model("quiz_model");
	    $this->load->model("classes_model");
		$this->load->model('notify_model');
		$this->load->model("data_model");
		$this->load->model("review_model");
		$this->load->model("comment_model");
		$this->load->model("profile_model");
		$this->load->model('event_racing_model');
	   $this->lang->load('basic', $this->config->item('language'));
	 }

	public function index(){
		$user = $this->session->userdata('logged_in');
		if(!$user){
			$this->load->view("stemup/login");
		}
		else{
			redirect("action");
		}
	}
	
	
	public function oldindex(){
		$user = $this->session->userdata('logged_in');
		if($user){
			redirect("home_user");
		}
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$data['today'] = date('d/m/Y', time());
		$data['todaay'] = date('Y-m-d',time());
		$data['today'] = "Tuần ".(floor(intval(date('d', strtotime('monday this week')))/7)+1). " tháng ".(int)date('m', strtotime('monday this week'));
		
		//$data['todaay_points'] = $this->event_racing_model->get_do_points_perdays($data['todaay'],"default",5);
		$monday =date('Y-m-d H:i:s', strtotime('monday this week'));
		$sunday =date('Y-m-d H:i:s', strtotime('sunday this week'));
		$data["month"]=date('m', strtotime('monday this week'));
		$data['monday'] = $monday;
		$data['sunday'] = $sunday;
		$data["no_week_of_month"]=floor(intval(date('d', strtotime('monday this week')))/7)+1;
		$data["todaay_points"]=$this->event_racing_model->get_data_perweek($monday,$sunday,0,"default",5);
	//	$data["today_points"]=$this->event_racing_model->get_do_points_perday($data['today']);
		$cookie = get_cookie('savsoftquiz');
		if($user){

			$data['clogin']=1;
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$this->db->where('uid', $user['uid']);
			$data['link_photo']=$this->db->get('savsoft_users')->result_array()[0]['photo'];
			$data['uid']=$user['uid'];
		} else if($cookie <> '') {
            $row = $this->user_model->get_by_cookie($cookie)->row();
			$uss= $this->user_model->get_by_cookie($cookie)->row_array();
            if ($row) {
            	$data['clogin']=1;
            	$data['user_name'] = $row->last_name.' '.$row->first_name;
				$data['link_photo'] = $row->photo;
				$data['uid']=$row->uid;
				$uss['base_url']=base_url();
				$this->session->set_userdata('logged_in', $uss);
				
            } else {
            	$data['clogin']=0;
                $data['email'] = set_value('email');
	            $data['password'] = set_value('password');
	            $data['remember'] = set_value('remember');
	            $data['message'] = $this->session->flashdata('message');   
            }
        } else {
			$data['clogin']=0;
            $data['email'] = set_value('email');
            $data['password'] = set_value('password');
            $data['remember'] = set_value('remember');
           // $data['message'] = $this->session->flashdata('message');          
        }
	/*	if($this->post_model->checkDatePost()){
			if(base_url()!='https://do.stem.vn/'){
				$conn_vui = mysqli_connect('123.31.43.193:53306','root','abc@123','stemblog');
			
			}
			else{
				$conn_vui = mysqli_connect('192.168.11.186:3306','root','abc@123','stemblog');
			}
			if (!$conn_vui) {
			    die('Could not connect: ' .mysqli_connect_error());
			}
			mysqli_query($conn_vui, "SET NAMES 'utf8'");
			$sql = "SELECT 
			            post.ID,
			            post.post_title,
			            post.post_date,
			            CONCAT( 'http://vui.stem.vn/wp-content/uploads','/', thumb.meta_value) as thumbnail,
			            post.post_type,
			            concat('http://vui.stem.vn/', '', post.post_name) as postname
			        FROM (
			            SELECT  p.ID,   
			                  p.post_title, 
			                  p.post_date,
			                  p.post_type,
			                  p.post_name,
			                  MAX(CASE WHEN pm.meta_key = '_thumbnail_id' then pm.meta_value ELSE NULL END) as thumbnail_id
			            FROM stemblog.sb_posts as p 
			            LEFT JOIN stemblog.sb_postmeta as pm ON ( pm.post_id = p.ID)
			            WHERE p.post_type = 'post' AND p.post_status = 'publish'
			            GROUP BY p.ID ORDER BY p.post_modified DESC
			          ) as post
			          LEFT JOIN stemblog.sb_postmeta AS thumb 
			            ON thumb.meta_key = '_wp_attached_file'
			            AND thumb.post_id = post.thumbnail_id
			          LIMIT 0,4";
			$result = mysqli_query($conn_vui, $sql);
			if (!$result) {
			    die('Could not query:'.mysqli_error());
			}
			while ($record = mysqli_fetch_assoc($result)){
				//echo $record['ID'];
				$querysub = "SELECT meta_value FROM stemblog.sb_postmeta where post_id = '".$record['ID'] ."' AND meta_key = 'subtitle'";
				$sub = mysqli_query($conn_vui, $querysub);
				$row = mysqli_fetch_row($sub);

			  	$userdata = array(
				 	'title'=>$record['post_title'],
			 		'subtitle'=> $row[0],
					'link'=>$record['postname'],
					'image'=>$record['thumbnail'],
					'type'=>'vui.stem.vn' 
				);
				$this->post_model->insert_post($userdata);
			}

			$tagquery = "SELECT t.name, concat('http://vui.stem.vn/tag/', t.slug) as link, tt.taxonomy, tt.count FROM stemblog.sb_terms AS t  INNER JOIN stemblog.sb_term_taxonomy AS tt ON (t.term_id = tt.term_id) WHERE tt.taxonomy IN ('post_tag') AND tt.count > 0 ORDER BY tt.count DESC LIMIT 7";
			$tagresult = mysqli_query($conn_vui, $tagquery);
			if (!$tagresult) {
			    die('Could not query:' . mysqli_error());
			}
			while ($tag = mysqli_fetch_assoc ($tagresult)){
				$tagdata = array(
				 	'title'=>$tag['name'],
			 		'subtitle'=> $tag['count'],
					'link'=>$tag['link'],
					'image'=>$tag['thumbnail'],
					'type'=>$tag['taxonomy'] 
				);
				$this->post_model->insert_post($tagdata);
			}

			$catquery = "SELECT t.name, concat('http://vui.stem.vn/chuyen-muc/', t.slug) as link, tt.taxonomy, tt.count FROM stemblog.sb_terms AS t  INNER JOIN stemblog.sb_term_taxonomy AS tt ON (t.term_id = tt.term_id) WHERE tt.taxonomy IN ('category') AND tt.count > 0 ORDER BY tt.count DESC LIMIT 7";
			$catresult = mysqli_query($conn_vui, $catquery);
			if (!$catresult) {
			    die('Could not query:' . mysqli_error());
			}
			while ($cat = mysqli_fetch_assoc ($catresult)){
				$catdata = array(
				 	'title'=>$cat['name'],
			 		'subtitle'=> $cat['count'],
					'link'=>$cat['link'],
					'image'=>$cat['thumbnail'],
					'type'=>$cat['taxonomy'] 
				);
				$this->post_model->insert_post($catdata);
			}


			mysqli_close($conn_vui);
             if(base_url()=='https://do.stem.vn/'){
				$stemconn = pg_connect("host=192.168.11.117 port=5432 dbname=stem user=odoo password=edu@2018!@# options='--client_encoding=UTF8'");}
			 else
				$stemconn = pg_connect("host=123.31.43.193 port=11732 dbname=stem user=odoo password=edu@2018!@# options='--client_encoding=UTF8'");

			$sqlforum = "select id, name, concat('www.stem.vn/vi_VN/forum/stem-forum-2/question/', id) as link from forum_post where active = 'true' and state='active' order by create_date desc limit 1";

			$restem = pg_query($stemconn, $sqlforum);
			if (!$restem) {
			  	echo "An error occurred.\n";
			}
			while ($forum = pg_fetch_assoc($restem)) {
				$forumdata = array(
				 	'title'=>$forum['name'],
			 		'subtitle'=> '',
					'link'=>$forum['link'],
					'image'=>'',
					'type'=>'hoi.stem.vn' 
				);
				$this->post_model->insert_post($forumdata);
			}

			$sqlhoc = "select name, short_description, concat('www.stem.vn/vi_VN/course-detail/', id) as link from op_course where type = 'free' order by create_date desc limit 1";

			$reshoc = pg_query($stemconn, $sqlhoc);
			if (!$reshoc) {
			  	echo "An error occurred.\n";
			}
			while ($hoc = pg_fetch_assoc($reshoc)) {
				$hocdata = array(
				 	'title'=>$hoc['name'],
			 		'subtitle'=> $hoc['short_description'],
					'link'=>$hoc['link'],
					'image'=>'',
					'type'=>'hoc.stem.vn' 
				);
				$this->post_model->insert_post($hocdata);
			}
			pg_close($stemconn);

		}*/
		$data['stcategories']=$this->qbank_model->get_statistic_category();
	//	$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
	//	$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
		//$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
	//	$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$search=$_GET['search'];
			if(!$search)
				$s="";
			else
				$s=htmlentities($search, ENT_COMPAT, 'UTF-8');
		$data['id_mcq_fun']=$this->qbank_model->get_id_mcq_fun(0,$s);
			if(!$search){	
				$data['id_quiz_fun']=$this->quiz_model->get_id_fun_quiz();
				$data['quiz_fun']=$this->quiz_model->get_fun_quiz(0,1)[0];
			}
			else{
				$data['id_quiz_fun']="";
			}
			$data['mcq_fun']=$this->qbank_model->get_mcq_fun(0,5,0,0,$s);
			for($i=0; $i<count($data['mcq_fun']); $i++){
				//$data['mcq_fun'][$i]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['create_date']);
				$data['mcq_fun'][$i]['liked']=$this->qbank_model->check_like($data['mcq_fun'][$i]['qid']);
				$data['mcq_fun'][$i]['comment']=$this->comment_model->get_comment('qbank',$data['mcq_fun'][$i]['qid']);
				//for($j=0; $j<count($data['mcq_fun'][$i]['comment']); $j++){
				//	$data['mcq_fun'][$i]['comment'][$j]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['comment'][$j]['create_date']);
				//}
			}	
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(20);
			$data['category_list']=$this->qbank_model->category_list();
			//$data['level_list']=$this->qbank_model->level_list();
		$this->load->view('after_login/large_question_modal',$data);
		$this->load->view('home/newhomepage',$data);
		$this->load->view('home/embedfbmsg',$data);
		$this->load->view('home/modal');
		$this->load->view('home/footer', $data);
		
	}
    
	
	
	public function about(){
		$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
		$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$this->load->view('home/main', $data);
		$this->load->view('home/vuihochoi', $data);
		$this->load->view('home/modal');
		$this->load->view('home/footer', $data);
	}
	public function about1(){
			$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
			$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
			$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			$data['post_cat']=$this->post_model->post_list($type_cat='category');
			$data['stcategories']=$this->qbank_model->get_statistic_category();
			$data['link_photo']=$user['photo'];
			$user = $this->session->userdata('logged_in');
		if(!$user){
			$this->load->view('main/main_home', $data);
			$this->load->view('home/vuihochoi', $data);
			$this->load->view('home/modal');
			$this->load->view('home/footer', $data);
		}
		else{
			$data['clogin']=1;
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$this->db->where('uid', $user['uid']);
			$data['link_photo']=$this->db->get('savsoft_users')->result_array()[0]['photo'];
			$data['uid']=$user['uid'];
			if($user['su']==2){
				$this->load->view('main/main_student', $data);
				$this->load->view('home/vuihochoi', $data);
				$this->load->view('home/modal');
				$this->load->view('home/footer', $data);
			}
			if($user['su']==1 || $user['su']==3 || $user['su']==6){
				$this->load->view('main/main_teacher', $data);
				$this->load->view('home/vuihochoi', $data);
				$this->load->view('home/modal');
				$this->load->view('home/footer', $data);
			}
			if($user['su']==4){
				$this->load->view('main/main_parent', $data);
				$this->load->view('home/vuihochoi', $data);
				$this->load->view('home/modal');
				$this->load->view('home/footer', $data);
			}
		}
	}		
	public function quiz_list($page=1){
		
		$user = $this->session->userdata('logged_in');
		if(!$user){
			//$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
			$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
			//$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			//$data['post_cat']=$this->post_model->post_list($type_cat='category');
			$search=$_GET['search'];
			if(!$search)
				$s="";
			else
				$s=$search;
			
			$cid=$_GET['cid'];
			if(!intval($cid)){
				$cid=0;
			}
			$lid=$_GET['lid'];
			if(!intval($lid)){
				$lid=0;
			}
			$sortby=$_GET['sortby'];
			$t=$this->api_model->quiz_list_none_login($cid,$lid,$s,$sortby,$page-1);
			$data['quiz_list'] =$t['quiz'];
			$data['numpage'] =$t['numpage'];
			$data['page']=$page;
			if($data['numpage']>10){
				if($page<$data['numpage']-3 && $page>4){
					$data['pstart']=$page-3;
				}
				
				else{
					if($page<5){
						$data['pstart']=2;
					}
					else {
						$data['pstart']=$data['numpage']-7;
					}
				}
				
			}
			$data['stcategories']=$this->qbank_model->get_statistic_category();
			$data['category_list']=$this->qbank_model->category_list();
			$data['level_list']=$this->qbank_model->level_list();
			$data['cid']=$cid;
			$data['lid']=$lid;
			$data['search']=$search;
			$data['sortby']=$sortby;
			$this->load->view('home/quizlist',$data);
			$this->load->view('home/modal');
			$this->load->view('home/footer', $data);
		}
		else{
		 redirect("home_user");
		}
	}	
	/*public function question_list($page=1){
		$user = $this->session->userdata('logged_in');
		if(!$user){
			$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
			$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
			$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			$data['post_cat']=$this->post_model->post_list($type_cat='category');
			$search=$_GET['search'];
			if(!$search)
				$s="";
			else
				$s=$search;
			
			$cid=$_GET['cid'];
			if(!intval($cid)){
				$cid=0;
			}
			$lid=$_GET['lid'];
			if(!intval($lid)){
				$lid=0;
			}
			$sortby=$_GET['sortby'];
			$data['cid']=$cid;
			$data['lid']=$lid;
			$data['search']=$s;
			$data['sortby']=$sortby;
			
			$t=$this->api_model->question_list_none_login($cid,$lid,$s,$sortby,$page-1);
			
			$data['mcqs'] =$t['question'];
			for($i=0; $i<count($data['mcqs']); $i++){
				$data['mcqs'][$i]['str_time_ago']=$this->api_model->time_ago($data['mcqs'][$i]['create_date']);
				$data['mcqs'][$i]['comment']=$this->comment_model->get_comment('qbank',$data['mcqs'][$i]['qid']);
				for($j=0; $j<count($data['mcqs'][$i]['comment']); $j++){
					$data['mcqs'][$i]['comment'][$j]['str_time_ago']=$this->api_model->time_ago($data['mcqs'][$i]['comment'][$j]['create_date']);
				}
			}	
			$data['numpage'] =$t['numpage'];
			$data['page']=$page;
			if($data['numpage']>10){
				if($page<$data['numpage']-3 && $page>4){
					$data['pstart']=$page-3;
				}
				
				else{
					if($page<5){
						$data['pstart']=2;
					}
					else {
						$data['pstart']=$data['numpage']-7;
					}
				}
				
			}
			$data['stcategories']=$this->qbank_model->get_statistic_category();
			$data['category_list']=$this->qbank_model->category_list();
			$data['level_list']=$this->qbank_model->level_list();
			$data['cid']=$cid;
			$data['lid']=$lid;
			$data['search']=$search;
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(20);
			$this->load->view('after_login/large_question_modal',$data);
			$this->load->view('home/questionlist',$data);
			$this->load->view('home/modal');
			$this->load->view('home/footer', $data);
		}
		else{
		 redirect("home_user");
		}
	}	
	*/
	
	public function detail($case='1'){
		
		$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
		$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$user = $this->session->userdata('logged_in');
		if($user){
			
			$data['clogin']=1;
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$this->db->where('uid', $user['uid']);
			$data['link_photo']=$this->db->get('savsoft_users')->result_array()[0]['photo'];
			$data['uid']=$user['uid'];
		}
		else $data['clogin']=0;
		
		if($case=='1'){
			$this->load->view('home/detail_1',$data);
			$this->load->view('home/groupdetail');
			$this->load->view('home/modal');
			$this->load->view('home/footer');
		}
		else if($case=='2'){
			$this->load->view('home/detail_2',$data);
			$this->load->view('home/groupdetail');
		    $this->load->view('home/modal');
			$this->load->view('home/footer');
		}
		else if($case=='student'| $case=='teacher' |$case=='school' | $case=='parent'){
			$this->load->view('home/'.$case, $data);
			$this->load->view('home/groupdetail');
			$this->load->view('home/modal');
			$this->load->view('home/footer');
		}
		
		else if($case=='user_terms'){
			$this->load->view('home/user_terms', $data);
			$this->load->view('home/modal',$data);
			$this->load->view('home/footer',$data);
		}
		else if($case=='guidelines'){
			
			$this->load->view('guideline/guideline_student', $data);
			
			$this->load->view('home/modal',$data);
			$this->load->view('home/footer',$data);
		}
		
		
	}
	
	public function detail1($case='1'){
		
		$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
		$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$user = $this->session->userdata('logged_in');
		if($user){
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();	             
		    }
			$data['clogin']=1;
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$this->db->where('uid', $user['uid']);
			$data['link_photo']=$this->db->get('savsoft_users')->result_array()[0]['photo'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['su']=$user['su'];
			$data['uid']=$user['uid'];
			if($user['su']==1||$user['su']==3||$user['su']==6){
				$this->load->view('guideline/guideline_teacher', $data);
				$this->load->view('home/footer',$data);
			}
			if($user['su']==2){
				$this->load->view('guideline/guideline_student', $data);
				$this->load->view('home/footer',$data);
			}
			if($user['su']==4){
				$this->load->view('guideline/guideline_parent', $data);
				$this->load->view('home/footer',$data);
			}
		}
		else{ $data['clogin']=0;
		
			if($case=='1'){
				$this->load->view('home/detail_1',$data);
				$this->load->view('home/groupdetail');
				$this->load->view('home/modal');
				$this->load->view('home/footer');
			}
			else if($case=='2'){
				$this->load->view('home/detail_2',$data);
				$this->load->view('home/groupdetail');
				$this->load->view('home/modal');
				$this->load->view('home/footer');
			}
			else if($case=='student'| $case=='teacher' |$case=='school' | $case=='parent'){
				$this->load->view('home/'.$case, $data);
				$this->load->view('home/groupdetail');
				$this->load->view('home/modal');
				$this->load->view('home/footer');
			}
			
			else if($case=='user_terms'){
				$this->load->view('home/user_terms', $data);
				$this->load->view('home/modal',$data);
				$this->load->view('home/footer',$data);
			}
			else if($case=='guidelines'){
				
				$this->load->view('guideline/guideline_home', $data);
				$this->load->view('home/modal',$data);
				$this->load->view('home/footer',$data);
			}
		}
		
	}
	public function detail2($case='1'){
		
		$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
		$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$user = $this->session->userdata('logged_in');
		if($user){
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();	             
		    }
			$data['clogin']=1;
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$this->db->where('uid', $user['uid']);
			$data['link_photo']=$this->db->get('savsoft_users')->result_array()[0]['photo'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['su']=$user['su'];
			$data['uid']=$user['uid'];
			if($user['su']==1||$user['su']==3||$user['su']==6){
				$this->load->view('guideline/policy_teacher', $data);
			$this->load->view('home/footer',$data);
			}
			if($user['su']==2){
				$this->load->view('guideline/policy_student', $data);
			$this->load->view('home/footer',$data);
			}
			if($user['su']==4){
				$this->load->view('guideline/policy_parent', $data);
			$this->load->view('home/footer',$data);
			}
		}
		else{ $data['clogin']=0;
			if($case=='policy'){
				
				$this->load->view('guideline/policy', $data);
				$this->load->view('home/modal',$data);
				$this->load->view('home/footer',$data);
			}
		}
		
	}
	public function detail3($case='1'){
		
		$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['hoi_post']=$this->post_model->post_list($type_hoi='hoi.stem.vn');
		$data['hoc_post']=$this->post_model->post_list($type_hoc='hoc.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$user = $this->session->userdata('logged_in');
		if($user){
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();	             
		    }
			$data['clogin']=1;
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$this->db->where('uid', $user['uid']);
			$data['link_photo']=$this->db->get('savsoft_users')->result_array()[0]['photo'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['su']=$user['su'];
			$data['uid']=$user['uid'];
			if($user['su']==1||$user['su']==3||$user['su']==6){
				$this->load->view('termofuse/term_teacher', $data);
			$this->load->view('home/footer',$data);
			}
			if($user['su']==2){
				$this->load->view('termofuse/term_student', $data);
			$this->load->view('home/footer',$data);
			}
			if($user['su']==4){
				$this->load->view('termofuse/term_parent', $data);
			$this->load->view('home/footer',$data);
			}
		}
		else{ $data['clogin']=0;
			if($case=='user_terms'){
				
				$this->load->view('termofuse/term_home', $data);
				$this->load->view('home/modal',$data);
				$this->load->view('home/footer',$data);
			}
		}
		
	}
	
	function resetpassword(){
		
		$this->user_model->resetpassword();
		
	}
	function resetpassword2($token, $status){
		if(!$status){
			$us =$this->user_model->resetpassword2($token);
			//$data['stcategories']=$this->qbank_model->get_statistic_category();
			if($us){
				//$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
			   // $data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
				//$data['post_cat']=$this->post_model->post_list($type_cat='category');
				$data['user']=$us;
				$data['token']=$token;
				$this->load->view('stemup/resetpwd',$data);
				$this->load->view('home/modal');
				//$this->load->view('home/footer');
			}
			else{
				$data['message']="<div class='alert alert-danger'>Liên kết không khả dụng! Bạn đã đổi mật khẩu hoặc liên kết hết hạn!</div>";
				$this->load->view('stemup/message',$data);
			}
		}
		else{
			$data['message']="<div class='alert alert-success'>Bạn đã đổi mật khẩu thành công!</div>";
			$this->load->view('stemup/message',$data);
		}
	    
	}
	function resetpassword3($token){
		$this->user_model->resetpassword3($token);
		
	    
	}


	public function _data_session($row) {
        // 1. Daftarkan Session
        $sess = array(
            'logged' => TRUE,
            'uid' => $row->uid,
            'email' => $row->email,
        );
       $this->session->set_userdata('logged_in', $row);
            
        // 2. Redirect ke home
        redirect('home_user');        
    }

}
