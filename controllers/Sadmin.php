<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sadmin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->library('pagination');
		$this->load->model("user_model");
		$this->load->model("sadmin_model");
		$this->load->model("post_model");
		$this->load->model("qbank_model");
		$this->load->model("api_model");
		$this->load->model("notify_model");
		$this->load->model("quiz_model");
		$this->load->model("library_model");
		$this->load->model("new_stemup_model");
		$this->lang->load('basic', $this->config->item('language'));

		$user= $this->session->userdata('logged_in');

	}
	public function login(){
		
		if($user){

			if($user['su']==1){
				redirect('sadmin/admin_home');
				
			}else if($user['su']==2){
				redirect('action');
			}else{
				redirect('home_user');
			}
		}
		else{
			$this->load->view("sadmin/login",$data);
		}
		
	}
	public function verifylogin(){	
		
		$username=$this->input->post('email');
		$password=$this->input->post('password');
		
		$status=$this->sadmin_model->login_verify($username,$password);

		if($status['status']=='1'){
			$this->load->helper('url');

			// row exist fetch userdata
			$user=$status['user'];
			
			$user['base_url']=base_url();
			// creating login cookie
			$this->session->set_userdata('logged_in', $user);
			if($user['su']=='1'){
				redirect('sadmin/admin_home'); 
			}else if($user['su']=='4'){
				redirect('home_user'); 
			// }else if($user['su']=='8'){
			// 	redirect('payment');
			}else   redirect('action'); 

		}else{
			//redirect('home');	
			$this->load->view("sadmin/login",$data);		
		}
	}
	function admin_home(){
		$user= $this->session->userdata('logged_in');
		$data['user']=$user;
		$data["statistic"] = $this->sadmin_model->getStatisticDashboard();
		$data["quizes"] = $data["statistic"]["quizCounted"];
		$data["libs"] = $data["statistic"]["libCounted"];
		$data["parents"] = $data["statistic"]["parentCounted"];
		$data["childs"] = $data["statistic"]["childCounted"];
		$data["questions"] = $data["statistic"]["questionsCounted"];

		$this->load->view('sadmin/sadmin_home',$data);
	}

	function list_account(){
		$user= $this->session->userdata('logged_in');
		$data['user']=$user;
		$data['list_account']=$this->sadmin_model->get_list_account();

		$page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
		$limit = 20;
		$start = $page*$limit;

		$config['base_url'] = base_url() . 'index.php/sadmin/list_account';
		$config['total_rows'] = $this->sadmin_model->get_total_parent_list();
		$config['per_page'] = $limit;
		$config["uri_segment"] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$data['get_parent_limit']=$this->sadmin_model->get_parent_limit_list($start,$limit);

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fa"></i><<';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';


		$config['next_link'] = '>> <i class="fa"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$this->pagination->initialize($config);

            // build paging links
		$data['links'] = $this->pagination->create_links();

		$this->load->view('sadmin/list_account',$data);
	}

	function list_account_search(){
		$string = $this->input->post('string');
		
		$data['list_account']=$this->sadmin_model->list_account_search($string);

		$this->load->view('sadmin/list_account_search',$data);
	}


	function life_account(){
		$user= $this->session->userdata('logged_in');
		$data['su']=$user['su'];
		$data['arr_result'] =  $this->sadmin_model->life_account();

		$page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
		$limit = 18;
		$start = $page*$limit;

		$config['base_url'] = base_url() . 'index.php/sadmin/life_account';
		$config['total_rows'] = $this->sadmin_model->get_total_parent();
		$config['per_page'] = $limit;
		$config["uri_segment"] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$data['get_life_account']=$this->sadmin_model->get_life_account($start,$limit);

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fa"></i><<';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';


		$config['next_link'] = '>> <i class="fa"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);

            // build paging links
		$data['links'] = $this->pagination->create_links();
		
		$this->load->view('sadmin/life_account',$data);
		
	}
	function add_life_account(){

		$data=array();

		$email = $this->input->post('account_signin');
		// echo $email;
		$data['arr_result'] = $this->sadmin_model->add_life_account($email);
		// echo "<pre>";
		// print_r($data['arr_result']);
		// echo "</pre>";
		$this->load->view('sadmin/add_life_account',$data);
	}


	function search_life_account_1(){
		$string = $this->input->post('string');
		// echo $string;
		$data['search_result'] = $this->sadmin_model->search_life_account_1($string);
		// echo "<pre>";
		// print_r($search_result);
		// echo "</pre>";
		$this->load->view('sadmin/search_life_account',$data);
	}

	function manage_qbank(){
		$data['category_list']=$this->qbank_model->category_list();
		$data['level_list']=$this->qbank_model->level_list(1);
		$data['questions']= $this->qbank_model->mng_qt_list(0,0,"",15,0); 
		$data['num_question']= $this->qbank_model->num_mng_qt(0,0,"",15,0); 
		$data['limit']= 15;
		$data['page']=0;
		$data['cid']=0;
		$data['lid']=0;	
		$data['num_page']=ceil($data['num_question']/$data['limit']);		
		$this->load->view('sadmin/manage_qbank', $data);
	}
	function statistic(){
		$user= $this->session->userdata('logged_in');
		$data['user']=$user;
		$data['level_list'] = $this->sadmin_model->get_list_lid(); 
		$data['cid_list'] = $this->sadmin_model->get_list_cid();
		foreach($data['level_list'] as $lid){
			$data['lid_'.$lid['lid']] = $this->qbank_model->statistic_by_levelcateg($lid['lid']);
		}
	//	var_dump($data);
		$this->load->view('statistic/qbank_statistic',$data);
	}
	
	public function Logout()
	{
		$this->session->sess_destroy();
		redirect(site_url('sadmin/login'));
	}
	function quiz_list($page=1){
		$user= $this->session->userdata('logged_in');
		//$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		//$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		if($user){
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['email']=$user['email'];
			$data['phone']=$user['contact_no'];
			$data['uid']=$user['uid'];
			$data['user_code']=$user['user_code'];
			$data['birthdate']=$user['birthdate'];
			$data['link_photo']=$user['photo'];
			$data['su']=$user['su'];
		}
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
		
		$t=$this->api_model->quiz_list_login($cid,$lid,$s,$sortby,$page-1);
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
		

		$data['nb_class'] = $this->api_model->nb_class_list_2('');
		$data['np_cl'] = ceil($data['nb_class']/5);
		$data['nb_students'] = $this->api_model->nb_student_list_2('');
		$data['np_std'] = ceil($data['nb_students']/5);
		$data['cid']=$cid;
		$data['lid']=$lid;
		$data['search']=$search;
		$data['sortby']=$sortby;
		$data['category_list']=$this->qbank_model->category_list();
		$data['level_list']=$this->qbank_model->level_list();
		$this->load->view('sadmin/quiz_list',$data);

	}
	function edit_quiz($qid){
		$user =$this->session->userdata('logged_in');
		$data['quiz']=$this->quiz_model->get_array_qids($qid);
		$data['created']=$this->quiz_model->get_array_qids($qid)['inserted_by'];
		$data['limit']=10;
		$data['page']=0;
		$data['cid']=0;
		$data['lid']=0;	
		$data['category_list']=$this->qbank_model->category_list();
		$data['level_list']=$this->qbank_model->level_list();
		$data['qids']= $this->quiz_model->get_array_qids($qid)['qids'];
		$data['number_qbank'] = $this->quiz_model->num_quiz_in($data['qids'],0,0,'');
		$data['num_page']=ceil($data['number_qbank']/$data['limit']);
		$data['qbank']=$this->quiz_model->get_quiz_in($data['qids'],0,0,'',10,0);
		$data['number_qbank_not'] = $this->quiz_model->num_quiz_not_in($data['qids'],0,0,'');
		$data['num_page_not'] = ceil($data['number_qbank_not']/$data['limit']);
		$data['qbank_not'] = $this->quiz_model->get_quiz_not_in($data['qids'],0,0,'',10,0);
		$this->load->view('sadmin/edit_quiz',$data);

	}
	function video($page=1){
		$user =$this->session->userdata('logged_in');
		if(isset($_GET['txtSearchVideo'])){
			$data['search'] = $_GET['txtSearchVideo'];
		}else{
			$data['search'] = "";
		}
		$data['user_name']= $user['last_name'].' '.$user['first_name'];
		$data['user_point']=$this->user_model->get_user_points($user['uid']);
		$data['email']=$user['email'];
		$data['phone']=$user['contact_no'];
		$data['uid']=$user['uid'];
		$data['user_code']=$user['user_code'];
		$data['birthdate']=$user['birthdate'];
		$data['link_photo']=$user['photo'];
		$data['su']=$user['su'];
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['video_list']=$this->library_model->get_data_library("video",$data['search'],8,$page-1);
		$data['numpage'] =ceil($this->library_model->number_data_library("video",$data['search'])/8);
		$data['page']=$page;
		$data['category_list']=$this->qbank_model->category_list();
		$data['level_list']=$this->qbank_model->level_list();
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
		$this->load->view('sadmin/video',$data);
	}
	function add_video(){
		$user =$this->session->userdata('logged_in');

		if(!$user){
			redirect("home");
		}
		else{
			if($user['su']==1){
				$data['category_list']=array_reverse($this->qbank_model->category_list());
				$data['level_list']=$this->qbank_model->level_list();
				$data['user_name']= $user['last_name'].' '.$user['first_name'];
				$data['user_point']=$this->user_model->get_user_points($user['uid']);
				$data['email']=$user['email'];
				$data['phone']=$user['contact_no'];
				$data['uid']=$user['uid'];
				$data['user_code']=$user['user_code'];
				$data['birthdate']=$user['birthdate'];
				$data['link_photo']=$user['photo'];
				$data['su']=$user['su'];
				$data['stcategories']=$this->qbank_model->get_statistic_category();
				$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
				$this->load->view('sadmin/add_video',$data);
			}
		}
		
	}
	
	function deleteVideo($id){
		
		$data=$this->library_model->deleteVideo($id);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	function edit_video($lib_id){
		$user=$this->session->userdata('logged_in');
		if(!$user || $user['su']!=1){
			redirect("home");
		}
		else{
			if($user['su']==1){
				$data['info_video'] = $this->library_model->get_info_video($lib_id)['info'];
				$data['tags'] = $this->library_model->get_info_video($lib_id)['tags_result'];
				$data['category_list']=array_reverse($this->qbank_model->category_list());
				$data['user_name']= $user['last_name'].' '.$user['first_name'];
				$data['user_point']=$this->user_model->get_user_points($user['uid']);
				$data['email']=$user['email'];
				$data['phone']=$user['contact_no'];
				$data['uid']=$user['uid'];
				$data['user_code']=$user['user_code'];
				$data['birthdate']=$user['birthdate'];
				$data['link_photo']=$user['photo'];
				$data['su']=$user['su'];
				$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(5);
				$data['stcategories']=$this->qbank_model->get_statistic_category();
				$data['level_list']=$this->qbank_model->level_list();
				$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
				$this->load->view("sadmin/edit_video", $data);
				$this->load->view("home/footer", $data);
			}
		}
	}
	public function add_question($nop='4',$para='0'){

		if($this->input->post('question')){

			if($this->qbank_model->insert_question_1()){
				$uid = $logged_in['uid'];
				$content = "Đã tạo một câu hỏi.";
				$model = "qbank";
				$action = "new question";
				$nid = $this->notify_model->insert_notify($uid, $content, $model, $action);
				$this->notify_model->insert_notify_user($nid, $uid);

				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				$check=0;
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

			}
			if($this->input->post('parag')==1){
				//redirect('qbank/new_question_1/'.$nop.'/'.$para);
				
			}else{
				//redirect('qbank/pre_new_question/');
			}



		}
		if($this->session->flashdata('qid')){
			$data['qp']=$this->qbank_model->get_question($this->session->flashdata('qid'));

		}			
		$data['para']=$para;	
		$data['nop']=$nop;
		$data['title']=$this->lang->line('add_new');
		// fetching category list
		$data['category_list']=$this->qbank_model->category_list();
		// fetching level list
		$data['level_list']=$this->qbank_model->level_list(1);

		$this->load->view('sadmin/add_question',$data);

		
	}
	function manage_comment(){
		$data = array();

		$status_url = ($this->uri->segment(3)) ? ($this->uri->segment(3) ) : 100;

		switch ($status_url){
			case 'duoc-hien-thi':
			$status = '2';
			break;
			case 'khong-duoc-hien-thi':
			$status = '1';
			break;
			case 'cho-duyet':
			$status = '99';
			break;
			default:
			$status = '100';
			break;
		}

		$data['status'] = $status;
		log_message('error','status: '.$status);

		$data['page'] = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 1;
		$limit = 10;
		$start = ($data['page']-1)*$limit;


		if($status =='100'){
			$data['arr_result'] =  $this->sadmin_model->get_AllComment_limit($start,$limit);
			$total_rows = count($this->sadmin_model->get_AllComment());
			// log_message('error','Total: '.$total_rows);
		}else{
			$data['arr_result'] =  $this->sadmin_model->get_AllComment_byStatus_limit($status,$start,$limit);
			$total_rows = count($this->sadmin_model->get_AllComment_byStatus($status));
		}
		$config['base_url'] = base_url().('index.php/sadmin/manage_comment').'/'.$status_url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] =  $limit;
		$config['uri_segment'] = 4;

		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;

		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<span class="firstlink link">';
		$config['first_tag_close'] = '</span>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<span class="lastlink link">';
		$config['last_tag_close'] = '</span>';

		$config['next_link'] = '>>';
		$config['next_tag_open'] = '<span class="nextlink link">';
		$config['next_tag_close'] = '</span>';

		$config['prev_link'] = '<<';
		$config['prev_tag_open'] = '<span class="prevlink link">';
		$config['prev_tag_close'] = '</span>';

		$config['cur_tag_open'] = '<span class="curlink link">';
		$config['cur_tag_close'] = '</span>';

		$config['num_tag_open'] = '<span class="numlink link">';
		$config['num_tag_close'] = '</span>';

		$this->pagination->initialize($config);



		$data['pagination'] = $this->pagination->create_links();

		$user=$this->session->userdata('logged_in');
		// if(!$user){
		// 	redirect("home");
		// }
		// else {
		// $data['user_name'] = $user['last_name'] . ' ' . $user['first_name'];
		// $data['user_point'] = $this->user_model->get_user_points($user['uid']);
		// $data['email'] = $user['email'];
		// $data['phone'] = $user['contact_no'];
		// $data['uid'] = $user['uid'];
		// $data['birthdate'] = $user['birthdate'];
		// $data['link_photo'] = $user['photo'];
		// $data['stcategories'] = $this->qbank_model->get_statistic_category();
		// $data['post_tag'] = $this->post_model->post_list($type_tag = 'post_tag');
		// $data['category_list'] = $this->qbank_model->category_list();

		// }
		$this->load->view('sadmin/manage_comment',$data);
	}
	function search_manage_comment(){
		$string = $this->input->post('string');
		// echo $string;
		$data['search_result'] = $this->sadmin_model->search_manage_comment($string);
		// echo "<pre>";
		// print_r($data['search_result']);
		// echo "</pre>";
		$this->load->view('sadmin/search_manage_comment',$data);
	}
	function create_quiz(){
		$user = $this->session->userdata('logged_in');
		if($user['su']==1){
			$data['su'] == $user['su'];
		//	var_dump($user['su']);
			$data['limit'] = 10;
			$data['category_list']=$this->qbank_model->category_list();
			$data['level_list']=$this->qbank_model->level_list();
			$data['questions']= $this->qbank_model->crq_qt_list(0,0,'',10,0); 
			$data['num_question']= $this->qbank_model->num_crq_qt(0,0,'',10,0); 
			$data['categories']=$this->qbank_model->category_list();
			$data['levels']=$this->qbank_model->level_list();
			$data['num_page']=ceil($data['num_question']/10);
			$data['group_list']=$this->user_model->group_list();
		//	var_dump($data['questions']);
			$this->load->view('sadmin/create_quiz',$data);
		}
	}
	function get_data_qbank(){
		$user=$this->session->userdata('logged_in');
		if($user['su']==1){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['user']=$user;
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['questions']= $this->qbank_model->crq_qt_list($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['num_question']= $this->qbank_model->num_crq_qt($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['categories']=$this->qbank_model->category_list();
			$inp['levels']=$this->qbank_model->level_list();
			$inp['num_page']=ceil($inp['num_question']/$inp['limit']);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}
	function add_quiz(){
		$logged_in = $this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		if($uid == 1){
		//	$data['name'] = $_POST['quiz_name'];
			$userdata=array(
				'quiz_name'=>$this->input->post('quiz_name'),
				'description'=>$this->input->post('description'),
				'start_date'=>strtotime($this->input->post('start_date')),
				'end_date'=>strtotime($this->input->post('end_date')),
				'duration'=>$this->input->post('duration'),
				'maximum_attempts'=>$this->input->post('maximum_attempts'),
				'pass_percentage'=>$this->input->post('pass_percentage'),
				'correct_score'=>$this->input->post('correct_score'),
				'incorrect_score'=>$this->input->post('incorrect_score'),
				'ip_address'=>$this->input->post('ip_address'),
				'view_answer'=>$this->input->post('view_answer'),
				'camera_req'=>$this->input->post('camera_req'),
				'quiz_template'=>$this->input->post('quiz_template'),
				'with_login'=>$this->input->post('with_login'),
				'gids'=>implode(',',$this->input->post('gids')),
				'question_selection'=>$this->input->post('question_selection'),
				'qids' =>$this->input->post('string_qids'),
			);
			$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
			$userdata['inserted_by'] = $uid;
			$userdata['inserted_by_name'] = $logged_in['first_name'] ." ". $logged_in['last_name'];

			if($uid==1 || $uid==224){
				$userdata['status']=1;
			}
			if($this->input->post('certificate_text')){
				$userdata['certificate_text']=$this->input->post('certificate_text'); 
			}
			$this->db->insert('savsoft_quiz',$userdata);
			$quid=$this->db->insert_id();
			// $data['quid'] = $quid;
		//	 $data['mess'] = 'success';
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	function get_feedback() {
		// $data["feedback"] = $this->sadmin_model->getFeedBack();
		   $config = array();
		$config["base_url"] = base_url() . "index.php/sadmin/get_feedback";
		$total_row = $this->sadmin_model->record_count_feedBack();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 8;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		$this->pagination->initialize($config);
		if($this->uri->segment(3)){
		$page = ($this->uri->segment(3)) ;
		}
		else{
		$page = 1;
		}
		$data["list_news"] = $this->sadmin_model->data_feed_back($config["per_page"], $page);
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );

		$this->load->view("sadmin/feedback_software", $data);
	}

	function get_feedback_search() {

		$string = $this->input->post('string');
		// echo $string;
		$data['feedback_search'] = $this->sadmin_model->get_feedback_search($string);
		// echo "<pre>";
		// print_r($data['feedback_search']);
		// echo "</pre>";
		$this->load->view('sadmin/get_feedback_search',$data);
	}

	// updated feedback status
	// when admin click pending button in Feedback software screen
	function update_feedback_status() {
		$fid = $this->input->post('fbid');
		$fstt = $this->input->post('fbstatus');
		$data["updated"] = $this->sadmin_model->updateFeedbackStatus($fid, $fstt);
		$data["feedback"] = $this->sadmin_model->getFeedBack();
		$this->load->view("sadmin/feedback_software_processed", $data);
	}

	// change user_status to inactive
	// Soft delete user 
	function delete_user() {
		// updated user status process
		$uid = $this->input->post('uid');
		$data["updated"] = $this->sadmin_model->updatedUserStatus($uid);

		// paginate
		$user= $this->session->userdata('logged_in');
		$data['user']=$user;
		$data['list_account']=$this->sadmin_model->get_list_account();

		$page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
		$limit = 20;
		$start = $page*$limit;

		$config['base_url'] = base_url() . 'index.php/sadmin/list_account';
		$config['total_rows'] = $this->sadmin_model->get_total_parent_list();
		$config['per_page'] = $limit;
		$config["uri_segment"] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$data['get_parent_limit']=$this->sadmin_model->get_parent_limit_list($start,$limit);

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fa"></i><<';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['next_link'] = '>> <i class="fa"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$this->pagination->initialize($config);

		// build paging links
		$data['links'] = $this->pagination->create_links();

		$this->load->view("sadmin/list_account_processed", $data);
	}

	// get statistical for cards in Dashboard
	// count records in savsoft_quiz, savsoft_library, savsoft_users (su = 4) and savsoft_qbank
	function get_statistic_dashboard() {
		$data["statistic"] = $this->sadmin_model->getStatisticDashboard();
		$data["quizes"] = $data["statistic"]["quizCounted"];
		$data["libs"] = $data["statistic"]["libCounted"];
		$data["parents"] = $data["statistic"]["parentCounted"];
		$data["questions"] = $data["statistic"]["questionsCounted"];
		echo $data["quizes"];
		$this->load->view("sadmin/sadmin_home", $data);
	}

	function news(){
		$user = $this->session->userdata("logged_in");
      //  var_dump($user['id'])
		if($user['uid'] == 1){
			$data['class'] = $this->new_stemup_model->get_class_new();

            //Phân trang cho danh sách tin

			$data['list_news'] = $this->sadmin_model->list_news(0,10);
			$total_rows=$this->sadmin_model->record_count();
			$total_page=ceil($total_rows/10);
			$data['trang']=$total_page;

			$this->load->view('sadmin/news',$data);

  //           $config = array();
		// $config["base_url"] = base_url() . "index.php/sadmin/news";
		// $total_row = $this->sadmin_model->record_count();
		// $config["total_rows"] = $total_row;
		// $config["per_page"] = 6;
		// $config['use_page_numbers'] = TRUE;
		// $config['num_links'] = $total_row;
		// $config['cur_tag_open'] = '&nbsp;<a class="current">';
		// $config['cur_tag_close'] = '</a>';
		// $config['next_link'] = 'Next';
		// $config['prev_link'] = 'Previous';

		// $this->pagination->initialize($config);
		// if($this->uri->segment(3)){
		// $page = ($this->uri->segment(3)) ;
		// }
		// else{
		// $page = 1;
		// }
		// $data["list_news"] = $this->sadmin_model->fetch_data($config["per_page"], $page);
		// $str_links = $this->pagination->create_links();
		// $data["links"] = explode('&nbsp;',$str_links );

		// // View data according to array.
		//  $this->load->view("sadmin/news", $data);



		}
	}

	public function get_items()
	{
		$text=$this->input->get('search');
		if(!empty($text)){
			$limit=10;
			$total_rows=$this->sadmin_model->record_count_search($text);
			$so_trang=ceil($total_rows/$limit);
			$data["data"] = $this->sadmin_model->search_news($text);
		}else{
			$trang=$this->input->get('trang');
			$limit=10;
			$offset = ($trang-1)*$limit;
			$total_rows=$this->sadmin_model->record_count();
			$so_trang=ceil($total_rows/$limit);
			$data["data"] = $this->sadmin_model->fetch_page_news($offset,$limit);

		}
		$this->load->view("sadmin/news_phantrang",$data);

	}


	function create_new(){
		$user = $this->session->userdata("logged_in");
		if($user['uid'] == 1){
			$data['mess'] = $this->new_stemup_model->insert_new();

			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	function check_name_exist(){
		$user = $this->session->userdata("logged_in");
		if($user['uid'] == 1){
			$data['check'] = $this->new_stemup_model->check_name_exist();
			header('Content-Type: application/json');
			echo json_encode($data);
		}        
	}
	function manage_news(){
		$user = $this->session->userdata("logged_in");
		$data['page']=0;
		$data['limit']=6;
		$data['num_news'] = $this->sadmin_model->num_news();
		$data['list_news'] = $this->sadmin_model->list_news($data['page'],$data['limit']);
		$data['num_page']=ceil($data['num_news']/$data['limit']);
		$this->load->view('sadmin/manage_news', $data);
	}
	function get_data_news(){
		$inp =  json_decode($this->input->raw_input_stream,true);
		$data['list_news'] = $this->sadmin_model->get_data_news($inp['search'],$inp['limit'],$inp['page']);
		$data['num_list'] = $this->sadmin_model->num_news();
		$data['num_page'] = $data['num_list']/5;
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	// delete news 
	 function delete_news(){
	 	$id=$this->input->get('id');
	 	$data=$this->sadmin_model->delete_new($id);
	 	
	 }
	function edit_news($id){
		$user = $this->session->userdata("logged_in");
		if($user['uid'] == 1){
			$data['class'] = $this->new_stemup_model->get_class_new();
			$data['new'] = $this->sadmin_model->get_new($id);
		
			$check=substr($data['new']['related_news'],0,1);
			 if($check==''||$check==' '||$check=='  '){
				$data['related_news'] = '';
			
				$check=-1;
				
			} 
			 else {
				 $id_new=$data['new']['related_news'];
				$data['related_news'] = $this->sadmin_model->get_list_chon_v2($data['new']['related_news']);
			
			}
			 $data['array_related'] = explode(",",$data['new']['related_news']);

			//Phân trang cho danh sách tin
			$data['list_news'] = $this->sadmin_model->list_edit_news(0,10, $id_new);
			$total_rows = $this->sadmin_model->record_count();
			$total_page = ceil($total_rows / 10);
			$data['trang'] = $total_page;

			// $data['list_news'] = $this->sadmin_model->list_news_edit($id);

			$this->load->view('sadmin/edit_news',$data);
		}
	function edit_up_news(){
		$inp =  json_decode($this->input->raw_input_stream,true);
		$data = $this->sadmin_model->edit_up_news($inp['id'],$inp['name']);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	function edit_newtest($id){
		$user = $this->session->userdata("logged_in");
		$name = $this->input->post('txtnamenews');
		$image = $this->input->post('image_avatar');
		$display_h = $this->input->post('cbshow');
		$display_f = $this->input->post('cbfeatured');
		$description = $this->input->post('txtdesnews');
		$tag = $this->input->post('txttagnews');
		$type = $this->input->post('sltype');
		$content = $this->input->post('ckeditor');
		log_message("error","+++++".$type);
		if($user['uid'] == 1){
			$data['mess'] = $this->new_stemup_model->edit_newtest($id,$image,$name,$type,$description,$tag,$content,$display_h,$display_f);
		}
	}
	function send_email(){
		$user = $this->session->userdata("logged_in");
		if($user['su'] ==1 ){
			$data['limit'] = 10;
			$data['email_send'] = $this->sadmin_model->email_send();
			$data['email_parent'] = $this->sadmin_model->email_parent();
			$data['number_email_parent'] = $this->sadmin_model->number_email_parent();
			$data['num_page']=ceil($data['number_email_parent']/$data['limit']);	
			$this->load->view('sadmin/send_email',$data);
		}
	}
	function send_email_Process(){
		$user = $this->session->userdata("logged_in");
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
		$fromemail=$this->config->item('fromemail');
		$fromname=$this->config->item('fromname');
		if($user['su'] == 1){
			$inp = json_decode($this->input->raw_input_stream,true);
			$data['email'] = $inp['email'];
			$data['email_send'] = $inp['email_send'];
			$data['content'] = $inp['content'];
			$data['subject'] = $inp['subject'];
			$data['parent'] = $this->sadmin_model->get_email_parent($inp['email_send']);
			for($i = 0; $i < sizeof($data['parent']) ; $i++){
				$this->email->to($data['parent'][$i]['email']);
				$this->email->from($fromemail, $fromname);
				$this->email->subject($data['subject']);
				$this->email->message($data['content']);
				$this->email->send();
			}
			$data['mess'] = 1;
		} else {
			$data['waring'] = "Bạn không có quyền truy cập !!!";
			$data['mess'] = 0;
		}
		header('Content-type: application/json');
		echo json_encode($data);
	}
	function get_all_email_parent(){
		$user = $this->session->userdata("logged_in");
		if($user['su'] == 1){
			$data['email_parent'] = $this->sadmin_model->all_email_parent();
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
	function get_send_email(){
		$user = $this->session->userdata("logged_in");
		$inp = json_decode($this->input->raw_input_stream,true);
		if($user['su'] == 1){
			$data['email_parent'] = $this->sadmin_model->email_parent($inp['page'],$inp['search']);
			$data['number_email_parent'] = $this->sadmin_model->number_email_parent($inp['search']);
			$data['num_page']=ceil($data['number_email_parent']/10);
			header('Content-Type: application/json');
			echo json_encode($data);
		}
		
	}

	function show_danhsach_chon(){
		$chon = $this->input->post('chon');
		$list_id=implode(',', $chon);
		// echo $list_id;
		$data['chon'] = $this->sadmin_model->get_list_chon($list_id);
		$this->load->view('sadmin/show_danhsach_chon',$data);
	}

	function manage_homepage_news(){

		$data['ds_homepage_news'] = $this->new_stemup_model->get_post_homepage();
		$this->load->view('sadmin/manage_homepage_news',$data);
	}

	function update_pos(){
		$id=$_POST['id'];
		$pos=$_POST['pos'];
		$data['result'] = $this->sadmin_model->update_pos($id, $pos);
		header("Location:".site_url('sadmin/manage_homepage_news'));
		exit;
		//$this->load->view('sadmin/update_pos',$data);
	}

	function check_fb_video(){

		$this->load->view('sadmin/check_fb_video');
	}
	
	function check(){
		$data['frame'] = $this->input->post('frame');
		$str_pos_start=strpos( $data['frame'], '%2Fvideos%2F', 0);
		$str_sub=substr($data['frame'], $str_pos_start+12, 15);
	 	//$data['img']=str_replace(,,$data['frame']);
		$data['link']='https://graph.facebook.com/'.$str_sub.'/picture';

		$this->load->view('sadmin/check_fb_video1',$data);
	}

	function test_php_platform(){

		$this->load->view('sadmin/test');
	}
	function update_new(){
        $user = $this->session->userdata("logged_in");
        if($user['uid'] == 1){
            $data['mess'] = $this->new_stemup_model->update_new();
            header('Content-Type: application/json');
			echo json_encode($data);
		

        }
	}
	function check_name_exist_update(){
		$user = $this->session->userdata("logged_in");
        if($user['uid'] == 1){
            $data['check'] = $this->new_stemup_model->check_name_exist_update();
            header('Content-Type: application/json');
			echo json_encode($data);
			
        }   
	}
	
	function all_payment(){
$config = array();
$config["base_url"] = base_url() . "index.php/sadmin/all_payment";
$total_row = $this->sadmin_model->count_payment();
$config["total_rows"] = $total_row;
$config["per_page"] = 4;
$config['use_page_numbers'] = true;
$config['num_links'] = $total_row;
$config['cur_tag_open'] = '&nbsp;<a class="current">';
$config['cur_tag_close'] = '</a>';
$config['next_link'] = 'Next';
$config['prev_link'] = 'Previous';

$this->pagination->initialize($config);
if ($this->uri->segment(3)) {
    $page = ($this->uri->segment(3));
} else {
    $page = 1;
}
$search=$this->input->get("search");
if ($search != '') {
    $data["list_news"] = $this->sadmin_model->get_payment_search($search, $config["per_page"], $page);
    var_dump($search);
} else {
    $data["list_news"] = $this->sadmin_model->get_all_payment($config["per_page"], $page);
}

$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;', $str_links);

		$this->load->view('sadmin/all_payment',$data);
	}



	function manager_request_payment()
	{
	$config = array();
$config["base_url"] = base_url() . "index.php/sadmin/all_payment";
$total_row = $this->sadmin_model->count_payment();
$config["total_rows"] = $total_row;
$config["per_page"] = 4;
$config['use_page_numbers'] = true;
$config['num_links'] = $total_row;
$config['cur_tag_open'] = '&nbsp;<a class="current">';
$config['cur_tag_close'] = '</a>';
$config['next_link'] = 'Next';
$config['prev_link'] = 'Previous';

$this->pagination->initialize($config);
if ($this->uri->segment(3)) {
    $page = ($this->uri->segment(3));
} else {
    $page = 1;
}
$search=$this->input->get('search');
if($search !=''){
$data["list_news"] = $this->sadmin_model->get_all_payment_search($search,$config["per_page"], $page);
 var_dump($search);
}else{
	$data["list_news"] = $this->sadmin_model->get_all_payment($config["per_page"], $page);
}

$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;', $str_links);


		$this->load->view('sadmin/request_payment',$data);
	}
	function thong_ke_payment()
	{

		$this->load->view('sadmin/thong_ke_request');
	}

}
