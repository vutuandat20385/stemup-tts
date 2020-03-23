<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_user extends CI_Controller {

	 function __construct()
	 {
	   	parent::__construct();
		$this->load->database();
		$this->load->helper('date');   
	   	$this->load->helper('url');
	   	$this->load->model("user_model");
	   	$this->load->model("qbank_model");
		$this->load->model("account_model");
	   	$this->load->model("result_model");
	   	$this->load->model("api_model");
	   	$this->load->model("api2_model");
	   	$this->load->model("quiz_model");
	    $this->load->model("classes_model");
		$this->load->model("post_model");
		$this->load->model('notify_model');
		$this->load->model("data_model");
		$this->load->model("review_model");
		$this->load->model("comment_model");
		$this->load->model("profile_model");
		$this->load->model('social_model');
		$this->load->model('event_racing_model');
	   	$this->lang->load('basic', $this->config->item('language'));

	   	if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		
		
	 }
 
	public function index(){
 
		$user= $this->session->userdata('logged_in');
		
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
		//$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		//$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
        if($user){
			$search=$_GET['search'];
			if(!$search)
				$s="";
			else
				$s=htmlentities($search, ENT_COMPAT, 'UTF-8');
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['email']=$user['email'];
			$data['phone']=$user['contact_no'];
			$data['uid']=$user['uid'];
			$data['user_code']=$user['user_code'];
			$data['birthdate']=$user['birthdate'];
			$data['link_photo']=$user['photo'];
			$data['su']=$user['su'];
			$this->db->where("uid", $user['uid']);
			$user=$this->db->get("savsoft_users")->row_array();
			$fl=$user['first_login'];
		    
			if(strpos($user['email2'], "@")===false){
				$this->load->view('after_login/update_email', $data);
			}
			if($fl==1){
				$this->load->view('after_login/welcome', $data);
				$this->db->where("uid", $user['uid']);
			    $this->db->update("savsoft_users", array('first_login'=>0));
			}
			
			$info = $this->profile_model->getprofile($user['uid']);
			$data['categories'] = array_reverse($this->qbank_model->category_list());
			$data['categ_ids'] =explode(",",$info['category_id']);		
			$data['interest_cat_ids'] =explode(",",$info['interest_cat_ids']);
			if(!$info['interest_cat_ids'] && $info['su']!=5 ){
				$this->load->view('after_login/interest_category', $data);
			}
			
			$data['id_mcq_fun']=$this->qbank_model->get_id_mcq_fun(0,0,$s);
			
			if(!$search){	
				$data['id_quiz_fun']=$this->quiz_model->get_id_fun_quiz();
				$data['quiz_fun']=$this->quiz_model->get_fun_quiz(0,1)[0];
				$this->db->insert("user_views", array("model"=>"quiz", "content_id"=>$data['quiz_fun']['quid'], "uid"=>$user["uid"]));
			}
			else{
				$data['id_quiz_fun']="";
			}
			$data['mcq_fun']=$this->qbank_model->get_mcq_fun(0,5,0,0,$s);
			for($i=0; $i<count($data['mcq_fun']); $i++){
				//$this->db->insert("user_views", array("model"=>"qbank", "content_id"=>$data['mcq_fun'][$i]['qid'], "uid"=>$user["uid"]));
				
				//$this->load->model('predictio_model');
                //$this->predictio_model->push_event("view",$user['uid'],$data['mcq_fun'][$i]['qid'], $data['mcq_fun'][$i]['cid'], $data['mcq_fun'][$i]['lid']);
				//$data['mcq_fun'][$i]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['modify_date']);
				$data['mcq_fun'][$i]['comment']=$this->comment_model->get_comment('qbank',$data['mcq_fun'][$i]['qid']);
				if($user['su']==2){
				$data['mcq_fun'][$i]['ass']=$this->qbank_model->question_of_student($data['mcq_fun'][$i]['qid']);
				}
				//print_r($data['mcq_fun'][$i]['qid']);
				//for($j=0; $j<count($data['mcq_fun'][$i]['comment']); $j++){
				//	$data['mcq_fun'][$i]['comment'][$j]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['comment'][$j]['create_date']);
				//}
			}
			//print_r ($data);
			
			
			
			$this->load->view('after_login/large_question_modal',$data);
			if($user['su']==1 || $user['su']==3){
				$data['user_name']= $user['last_name'].' '.$user['first_name'];
				$data['group_list']=$this->user_model->group_list();
				$data['nb_class'] = $this->api_model->nb_class_list_2('');
				$data['np_cl'] = ceil($data['nb_class']/5);
				$data['nb_students'] = $this->api_model->nb_student_list_2('');
				$data['np_std'] = ceil($data['nb_students']/5);
				$data['level_list']=$this->qbank_model->level_list();
				$this->load->view('after_login/home_user',$data);
				$this->load->view('after_login/modaladdclass');
				$this->load->view('after_login/modaladdgroup');
				
			}    
			else if($user['su']==2){
				
				$data['user_name']= $user['last_name'].' '.$user['first_name'];
				
				//$data['qt'] = $this->qbank_model->rand_one_question_1();			
				//$options = $this->qbank_model->load_option($data['qt']['qid']);
				
				//foreach($options as $k=>$option){
				//	$data['option_'.$k]=$option['q_option'];
					
				//}
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();
				$this->load->view('after_login/home_student', $data);
			}
			else if($user['su']==4){
				if($this->session->userdata('logged_in')){
					$data['user_name']= $user['last_name'].' '.$user['first_name'];
					$child_list =$this->user_model->get_child_list();			             
					$data['child_list']= $child_list;
					$this->load->view('after_login/home_parent',$data);
				}
		    }
			
			else if($user['su']==5){
				if($this->session->userdata('logged_in')){
					$this->load->view('after_login/home_public',$data);
				}
		    }
			
			else if($user['su']==6){
					$data['group_list']=$this->user_model->group_list();
					//$data['user_list']=$this->user_model->user_list_all();
					$data['category_list']=$this->qbank_model->category_list();
					$data['level_list']=$this->qbank_model->level_list();
					$this->load->view('after_login/home_moderator',$data);
					$this->load->view('after_login/modaladdclass');
					$this->load->view('after_login/modaladdgroup');
				}
			 $this->load->view('after_login/modal_loading',$data);
			 $this->load->view('home/embedfbmsg',$data);
			 $this->load->view('home/footer',$data);
		}
		else redirect('home');

	}

	public function welcome(){
		$data['su']=$logged_in['su'];
		$this->load->view('after_login/welcome', $data);
	}
	 public function student_answers($quid,$qid){
		
		if($this->session->userdata('logged_in')){
		  $question = $this->qbank_model->load_question($qid);
		  $options = $this->qbank_model->load_option($qid);
		  $option_choice =$this->input->post('optradio');
		  $labelA='A';
		  $labelB='B';
		  $labelC='C';
		  $labelD='D';
		  foreach($options as $k=>$option){
			if($option['score']>0) $correct_option=$k;
					
		  }
		  if($correct_option==0)  $labelA='<i style="color:green" class="fas fa-check-circle"></i>  '.$labelA;
		  else if($correct_option==1)  $labelB='<i style="color:green" class="fas fa-check-circle"></i>  '.$labelB;
		  else if($correct_option==2)  $labelC='<i style="color:green" class="fas fa-check-circle"></i>  '.$labelC;
		  else  $labelD='<i style="color:green" class="fas fa-check-circle"></i>  '.$labelD;
		  if($option_choice!=$correct_option){
			  if($option_choice==0)  $labelA='<i style="color:red" class="fas fa-times-circle"></i>  '.$labelA;
			  else if($option_choice==1)  $labelB='<i style="color:red" class="fas fa-times-circle"></i>  '.$labelB;
			  else if($option_choice==2)  $labelC='<i style="color:red" class="fas fa-times-circle"></i>  '.$labelC;
			  else  $labelD='<i style="color:red" class="fas  fa-times-circle"></i>  '.$labelD;
		  }
				
		  $op_view='<div class="row MB20">
						<div class="col-xs-6">					
							<label class="radio-inline w-100">
								   <div class="input-group">
									 <span class="input-group-addon">'.$labelA.'</span>
									 <p style="margin-left:10px;">'.$options[0]['q_option'].'</p> 
								   </div>
							</label>
						</div>
						<div class="col-xs-6">
							<label class="radio-inline w-100">
								   <div class="input-group">
									 <span class="input-group-addon">'.$labelB.'</span>
									<p style="margin-left:10px;">'.$options[1]['q_option'].'</p>
								   </div>
								
							</label>
						</div>
					</div>
					<div class="row MB20">
						<div class="col-xs-6">					
							<label class="radio-inline w-100">
								   <div class="input-group">
									 <span class="input-group-addon">'.$labelC.'</span>
									 <p style="margin-left:10px;">'.$options[2]['q_option'].'</p> 
								   </div>
							</label>
						</div>
						<div class="col-xs-6">
							<label class="radio-inline w-100">
								   <div class="input-group">
									 <span class="input-group-addon">'.$labelD.'</span>
									<p style="margin-left:10px;">'.$options[3]['q_option'].'</p>
								   </div>
								
							</label>
						</div>
						
					</div>';
		  
		  $result='';
		  $link = site_url('quiz/validate_quiz/'.$quid);
		  $quiz_name= $this->quiz_model->get_quiz($quid)['quiz_name'];
		  if($correct_option== $option_choice){
			  $result='<div class="alert alert-success"><p>Bạn đã trả lời câu hỏi: '.$question[0]['question'].'</p>';
			  $result.='<p> Các đáp án:</p>';
			  $result.=$op_view;
			  $result.='<p>Bạn trả lời đúng</p> <a href="'.$link.'"> Nhấn vào đây để làm bài trắc nghiệm '.$quiz_name.'<a></div>';
		  }
		  else {
			  $result='<div class="alert alert-danger"><p>Bạn đã trả lời câu hỏi: '.$question[0]['question'].'</p>';
			  $result.='</p>Các đáp án:</p>';
			  $result.=$op_view;
			  $result.='<p>Bạn trả lời sai</p><a href="'.$link.'"> Nhấn vào đây để làm bài trắc nghiệm '.$quiz_name.'<a></div>';
		  }
		   $result.= '<p> <b>Câu hỏi khác:</b></p> ';
		   $data['result']=$result;
		   $this->session->set_flashdata('message', $result);
		
		   echo '<script> 
					      window.location.href = "/index.php/home_user";
					</script>';
		   //$this->load->view('after_login/home_student',$data);
		}
		else redirect('');
	}

	public function goc_thu_tai(){
		if(!$this->session->userdata('logged_in')){
			redirect('home');
		}
		$data['qt'] = $this->qbank_model->rand_one_question_1();			
		$options = $this->qbank_model->load_option($data['qt']['qid']);
		
		foreach($options as $k=>$option){
			$data['opt']['option_'.$k]=$option['q_option'];
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}	
	
	public function child_activities($sid){
		$user =$this->session->userdata('logged_in');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		if($user['su']==4){
			$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			$data['post_cat']=$this->post_model->post_list($type_cat='category');
		    $data['user_name']= $user['last_name'].' '.$user['first_name'];
			$child_list =array();
					              
			$data['child_list']= $child_list;
			$data['child_id']= $child_list[$sid]['sid'];
			$data['child_name']= $child_list[$sid]['sname'];
			$data['user_point']=500;
			$this->load->view('after_login/child_activity',$data);
			$this->load->view('home/footer',$data);
		}
		else redirect('');
	}	
	
	public function child_list(){
		$user =$this->session->userdata('logged_in');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		if($user['su']==4){
			$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			$data['post_cat']=$this->post_model->post_list($type_cat='category');
		    $data['user_name']= $user['last_name'].' '.$user['first_name'];
			$child_list =$this->user_model->get_child_list();
			$data['child_list']= $child_list;
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$this->load->view('after_login/child_list',$data);
			$this->load->view('home/footer',$data);
		}
		else redirect('');
	}	
	
	public function create_child(){
		$user =$this->session->userdata('logged_in');
		
		if($user['su']=4){
			echo $this->user_model->insert_user_4($user['uid']);
		}
	}	
	
	public function add_child(){
		$this->user_model->add_child();
		redirect('home_user');
	}
    public function add_child_1(){
		$data=$this->user_model->add_child_1();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
    
	public function join_class(){
		$inp = json_decode($this->input->raw_input_stream,true);
		$data = $this->classes_model->join_class($inp['code']);
		header('Content-Type: application/json');
		echo json_encode($data);
	}

    
	public function manage_question(){
		$data['data'] = $this->api_model->question_list2();
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function get_question($qid){
		$model = 'savsoft_qbank';
		$data['review'] = $this->review_model->get_review($qid, $model);
		$data['user']=$this->session->userdata('logged_in');
		$data['data'] = $this->api_model->get_question($qid);
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function manage_result()
	{
		$data['data']=$this->api_model->result_lists();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
    
	public function manage_quiz($user=''){
		$logged_in=$this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		$this->db->where('uid',$uid);
		$this->db->join('account_type','account_type.account_id=savsoft_users.su');
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		$data['assign']=$this->api_model->quiz_assign();
		$data['data']=$this->api_model->quiz_list_new($user);
		$data['user']=$this->session->userdata('logged_in');
		$data['questions']=$this->api_model->question_list3();
		$data['categories']=$this->db->get('savsoft_category')->result_array();
		$data['levels']=$this->db->get('savsoft_level')->result_array();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	public function create_quiz_data(){
	    $user=$this->session->userdata('logged_in');
		if($user){
			
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
    public function manage_quiz_mod(){
		$logged_in=$this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
        $this->db->where('noq >',0);
	    $this->db->where('deleted',0);
        $data['data']=$this->db->get('savsoft_quiz')->result_array();
		for($i=0; $i<count($data['data']); $i++){
			$this->db->where('model', 'savsoft_quiz');		
			$this->db->where('reviewid', $data['data'][$i]['quid']);
			$rt =$this->db->get('savsoft_review');
			$userrate=0;
			$usercomment='';
			$data['data'][$i]['nrate']=$rt->num_rows();
			$total=0;
			foreach($rt->result_array() as $r){
				if($r['reviewer']==$uid){
					$userrate=$r['value'];
					$usercomment=$r['content'];
				}
				$total+=$r['value'];
			}
			if($rt->num_rows()>0)
				$data['data'][$i]['rated']=$total/$rt->num_rows();
			else
				$data['data'][$i]['rated']=0;
			$data['data'][$i]['userrate']=$userrate;
			$data['data'][$i]['usercomment']=$usercomment;
			
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	 public function get_quiz($quid){
		$logged_in=$this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
        $this->db->where('noq >',0);
	    $this->db->where('deleted',0);
		$this->db->where('quid', $quid);
        $data['data']=$this->db->get('savsoft_quiz')->row_array();

		$this->db->where('model', 'savsoft_quiz');		
		$this->db->where('reviewid', $data['data']['quid']);
		$rt =$this->db->get('savsoft_review');
		$userrate=0;
		$usercomment='';
		$data['data']['nrate']=$rt->num_rows();
		$total=0;
		foreach($rt->result_array() as $r){
			if($r['reviewer']==$uid){
				$userrate=$r['value'];
				$usercomment=$r['content'];
			}
			$total+=$r['value'];
		}
		if($rt->num_rows()>0)
			$data['data']['rated']=$total/$rt->num_rows();
		else
			$data['data']['rated']=0;
		$data['data']['userrate']=$userrate;
		$data['data']['usercomment']=$usercomment;
			
		
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function quiz_assign(){
		$data['assign']=$this->api_model->quiz_assign();
		$data['user']=$this->session->userdata('logged_in');
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function quiz_assign_1($page,$uid,$cid,$arr){
		//$inp = json_decode($this->input->raw_input_stream,true);
		//$data['search']=htmlentities($data['search'],ENT_COMPAT,'UTF-8');
		$search=$this->input->post('search');
		$data['assign']=$this->api_model->quiz_assign_1($page,$uid,$cid,$arr,$search);
		$data['user']=$this->session->userdata('logged_in');
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function quiz_assign_2($page,$uid,$cid,$arr){
		//$inp = json_decode($this->input->raw_input_stream,true);
		//$data['search']=htmlentities($data['search'],ENT_COMPAT,'UTF-8');
		$search=$this->input->post('search');
		$data['assign']=$this->api_model->quiz_assign_2($page,$uid,$cid,$arr,$search);
		$data['user']=$this->session->userdata('logged_in');
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function quiz_assign_3($page,$uid,$cid,$arr){
		//$inp = json_decode($this->input->raw_input_stream,true);
		//$data['search']=htmlentities($data['search'],ENT_COMPAT,'UTF-8');
		$search=$this->input->post('search');
		$data['assign']=$this->api_model->quiz_assign_3($page,$uid,$cid,$arr,$search);
		$data['user']=$this->session->userdata('logged_in');
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function quiz_assign_4($page,$uid,$cid,$arr){
		//$inp = json_decode($this->input->raw_input_stream,true);
		//$data['search']=htmlentities($data['search'],ENT_COMPAT,'UTF-8');
		$search=$this->input->post('search');
		$data['assign']=$this->api_model->quiz_assign_4($page,$uid,$cid,$arr,$search);
		$data['user']=$this->session->userdata('logged_in');
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function quiz_assign_5($page,$uid,$cid,$arr){
		//$inp = json_decode($this->input->raw_input_stream,true);
		//$data['search']=htmlentities($data['search'],ENT_COMPAT,'UTF-8');
		$search=$this->input->post('search');
		$data['assign']=$this->api_model->quiz_assign_5($page,$uid,$cid,$arr,$search);
		$data['user']=$this->session->userdata('logged_in');
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function quiz_assign_6($page,$uid,$cid,$arr){
		//$inp = json_decode($this->input->raw_input_stream,true);
		//$data['search']=htmlentities($data['search'],ENT_COMPAT,'UTF-8');
		$search=$this->input->post('search');
		$data['assign']=$this->api_model->quiz_assign_6($page,$uid,$cid,$arr,$search);
		$data['user']=$this->session->userdata('logged_in');
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function close_assign($quid, $auid, $uid){
		
		$data['assign']=$this->api_model->quiz_assign();
		$data['user']=$this->session->userdata('logged_in');
		if($this->api_model->close_assign($quid, $auid, $uid)){
			$data['result'] = "success";
		}else{
			$data['result'] = "error";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function assign_to_class($quid, $classid, $startdate, $enddate){
		$data['assign']=$this->api_model->quiz_assign();
		$data['user']=$this->session->userdata('logged_in');
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		if($this->api_model->assign_to_class($quid, $classid, $startdate, $enddate)){
			$data['result'] = "success";
		}else{
			$data['result'] = "error";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function assign_to_group($quid, $sg_id, $startdate, $enddate){
		$data['assign']=$this->api_model->quiz_assign();
		$data['user']=$this->session->userdata('logged_in');
	//	$data['member']=$this->api_model->member_list_of_group($sg_id);
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		if($this->api_model->assign_to_group($quid, $sg_id, $startdate, $enddate)){
			$data['result'] = "success";
		}else{
			$data['result'] = "error";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function unassign_to_class($quid, $classid){
		if($this->api_model->unassign_to_class($quid, $classid)){
			$data['result'] = "success";
		}else{
			$data['result'] = "error";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function student_list($quid){
		$logged_in=$this->session->userdata('logged_in');
		$data['uid'] = $logged_in['uid'];
		$data['su'] = $logged_in['su'];
		$data['limit'] = 3;
		$data['qassign']=$this->api_model->quiz_assigns($quid);
		$data['quiz']=$this->quiz_model->get_quiz($quid);
		$data['nb_group'] = $this->api_model->nb_group_list_2('');
		$data['np_gl'] = ceil($data['nb_group']/5);
		$data['nb_class'] = $this->api_model->nb_class_list_2('');
		$data['np_cl'] = ceil($data['nb_class']/5);
		$data['nb_students'] = $this->api_model->nb_student_list_2('');
		$data['np_std'] = ceil($data['nb_students']/5);
		$data['students']=$this->api_model->student_list_2($quid,'',0);
		$data['class'] = $this->api_model->class_list_2($quid,'',0);
		$data['group'] = $this->api_model->group_list_2($quid,'',0);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function get_data_std($quid){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp['uid'] = $user['uid'];
			$inp['search'] = $this->input->post('search');
			$inp['search']=htmlentities($inp['search'],ENT_COMPAT,'UTF-8');
			$inp['page'] = $this->input->post('page');
			$inp['students']=$this->api_model->student_list_2($quid,$inp['search'],$inp['page']);
			$inp['nb_students'] = $this->api_model->nb_student_list_2($inp['search']);
			$inp['quid'] = $this->input->post('quid');
			$inp['np_std'] = ceil($inp['nb_students']/5);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}
	public function get_data_class($quid){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp['search'] = $this->input->post('search');
			$inp['quid'] = $this->input->post('quid');
			$inp['search']=htmlentities($inp['search'],ENT_COMPAT,'UTF-8');
			$inp['page'] = $this->input->post('page');
			$inp['class'] = $this->api_model->class_list_2($quid,$inp['search'],$inp['page']);
			$inp['nb_class'] = $this->api_model->nb_class_list_2($inp['search']);
			$inp['np_cl'] = ceil($inp['nb_class']/5);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}
	public function get_data_group($quid){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp['search'] = $this->input->post('search');
			$inp['quid'] = $this->input->post('quid');
			$inp['search']=htmlentities($inp['search'],ENT_COMPAT,'UTF-8');
			$inp['page'] = $this->input->post('page');
			$inp['group'] = $this->api_model->group_list_2($quid,$inp['search'],$inp['page']);
			$inp['nb_group'] = $this->api_model->nb_group_list_2($inp['search']);
			$inp['np_gl'] = ceil($inp['nb_group']/5);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}
	public function assignQuiz($quid, $uid, $olduid, $startdate, $enddate){
		$olduid = str_replace('+', ',', $olduid);
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		if($this->api_model->assignQuiz($quid, $uid, $olduid, $startdate, $enddate)){
			$data['result'] = "success";
		}else{
			$data['result'] = "error";
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	function assignstatus($quid,$uid,$auid,$startdate,$enddate){
		$logged_in=$this->session->userdata('logged_in');
		$data['auid'] = $logged_in['uid'];
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		if($this->api_model->assignstatus($quid, $uid, $auid, $startdate, $enddate)){
			$data['result'] = "success";
		}else{
			$data['result'] = "error";
		}
		$data['quiz']=$this->quiz_model->get_quiz($quid);
		$data['students']=$this->api_model->student_list_2($quid);
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function unassign_quiz($quid, $uid){
		$user=$this->session->userdata('logged_in');
		$data['uid'] = $user['uid'];
		if($this->api_model->unassign_quiz($quid, $uid)){
			$data['result'] = "success";
		}else{
			$data['result'] = "error";
		}

		$data['quiz']=$this->quiz_model->get_quiz($quid);
		$data['students']=$this->api_model->student_list_2($quid);
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function class_list($quid){
		$data['qassign']=$this->api_model->quiz_assigns($quid);
		$data['quiz']=$this->quiz_model->get_quiz($quid);
		$data['clist']=$this->api_model->class_list_1();
		header('Content-Type: application/json');
 		echo json_encode($data);
	}

	public function student_of_class($class_id){
		$data['students']=$this->api_model->student_list_of_class($class_id);
		header('Content-Type: application/json');
 		echo json_encode($data);
	}

	public function activities(){
 		$data['notify']=$this->notify_model->notify_list();
 		header('Content-Type: application/json');
 		echo json_encode($data);
 	}
 
	public function add_quiz(){
		$logged_in=$this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('quiz_name', 'quiz_name', 'required');
       	if ($this->form_validation->run() == FALSE)
        {
            $data['error']=validation_errors();
            header('Content-Type: application/json');
			echo json_encode($data);
        }else{
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
			 	'question_selection'=>$this->input->post('question_selection')
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
             $unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
			); 
			$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
				 '%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
				 '%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
		
			 $q =$this->input->post('quiz_name');
			 $q =html_entity_decode( strip_tags( $q ) );
		  
			 foreach($unicode as $nonUnicode=>$uni){
				 $q = preg_replace("/($uni)/i", $nonUnicode, $q);
			 }
			
			$q = str_replace(array(' '),'-',$q);
			$q =urlencode ($q);
			$q = str_replace($comma,'',$q);
			$q = str_replace(array('%'),'',$q);
			if($q==""){
			 $q=$quid;
			}
			else
			 $q.='-'.$quid;
			while(strpos($q, '--'))
				$q = str_replace(array('--'),'-',$q);
			$this->db->insert('savsoft_permalink', array("model"=>"quiz", "content_id"=>$quid, "permalink"=>$q));
			$content = "Đã tạo một bài kiểm tra.";
			$model = "quiz";
			$action = "new quiz";
			$nid = $this->notify_model->insert_notify($uid, $content, $model, $action);
			$this->notify_model->insert_notify_user($nid, $uid);
            $data['quid']=$quid;
			/*$this->load->model('notification_model');
	 		$dataArr = array(
	 			'message' => 'Đã tạo một bài kiểm tra.',
	 			'title' => "Thông Báo"
	 		);
	 		$data['notification']=$this->notification_model->sendNotification($uid, $dataArr);*/
			
			
            header('Content-Type: application/json');
			echo json_encode($data);
			
        } 
	}
    
	
	public function update_quiz_1($quid){
		$logged_in=$this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('quiz_name', 'quiz_name', 'required');
       	if ($this->form_validation->run() == FALSE)
        {
            $data['error']=validation_errors();
            header('Content-Type: application/json');
			echo json_encode($data);
        }else{
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
			 	'question_selection'=>$this->input->post('question_selection')
			);
		 	$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
			$userdata['inserted_by'] = $uid;
			$userdata['inserted_by_name'] = $logged_in['first_name'] ." ". $logged_in['last_name'];
		 	if($this->input->post('certificate_text')){
				$userdata['certificate_text']=$this->input->post('certificate_text'); 
			}
			$this->db->where('quid',$quid);
		  	$this->db->update('savsoft_quiz',$userdata);
             $unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
			); 
			$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
				 '%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
				 '%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
		
			 $q =$this->input->post('quiz_name');
			 $q =html_entity_decode( strip_tags( $q ) );
		  
			 foreach($unicode as $nonUnicode=>$uni){
				 $q = preg_replace("/($uni)/i", $nonUnicode, $q);
			 }
			
			$q = str_replace(array(' '),'-',$q);
			$q =urlencode ($q);
			$q = str_replace($comma,'',$q);
			$q = str_replace(array('%'),'',$q);
			if($q==""){
			 $q=$quid;
			}
			else
			 $q.='-'.$quid;
			while(strpos($q, '--'))
				$q = str_replace(array('--'),'-',$q);
			$this->db->where('content_id', $quid);
			$this->db->where('model', "quiz");
			$this->db->update('savsoft_permalink', array("permalink"=>$q));
        } 
	}
	function remove_qid($quid,$qid){
		
		if($this->quiz_model->remove_qid($quid,$qid)){
            $data['msg']='success';
            header('Content-Type: application/json');
			echo json_encode($data);
		}else{
			$data['msg']='error';
            header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

	public function update_quiz($quid){
	 
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
		 	'gids'=>implode(',',$this->input->post('gids'))
	 	);
	  	 	 
		$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
	  
	 	if($this->input->post('certificate_text')){
			$userdata['certificate_text']=$this->input->post('certificate_text'); 
	 	}
 
	  	$this->db->where('quid',$quid);
	  	$this->db->update('savsoft_quiz',$userdata);
		 $unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
			); 
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			 '%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			 '%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
	
	     $q =$this->input->post('quiz_name');
		 $q =html_entity_decode( strip_tags( $q ) );
	  
		 foreach($unicode as $nonUnicode=>$uni){
			 $q = preg_replace("/($uni)/i", $nonUnicode, $q);
		 }
		
		$q = str_replace(array(' '),'-',$q);
		$q =urlencode ($q);
		$q = str_replace($comma,'',$q);
		$q = str_replace(array('%'),'',$q);
		if($q==""){
		 $q=$quid;
		}
		else
		 $q.='-'.$quid;
		while(strpos($q, '--'))
			$q = str_replace(array('--'),'-',$q);
		$this->db->where("content_id",$quid);
		$this->db->update('savsoft_permalink', array("model"=>"quiz", "content_id"=>$quid, "permalink"=>$q));
	  
	  	/*$this->db->where('quid',$quid);
	  	$query=$this->db->get('savsoft_quiz',$userdata);
	 	$quiz=$query->row_array();
	 	if($quiz['question_selection']=='1'){
		 
	  		$this->db->where('quid',$quid);
	  		$this->db->delete('savsoft_qcl');
            $correct_i=array();
    	 	$incorrect_i=array();	 
	 		foreach($_POST['cid'] as $ck => $val){
		 		if(isset($_POST['noq'][$ck])){
			 		if($_POST['noq'][$ck] >= '1'){
		 				$userdata=array(
		 					'quid'=>$quid,
		 					'cid'=>$val,
		 					'lid'=>$_POST['lid'][$ck],
		 					'i_correct'=>$_POST['i_correct'][$ck],
		 					'i_incorrect'=>$_POST['i_incorrect'][$ck],
		 					'noq'=>$_POST['noq'][$ck]
	 					);
		 				$this->db->insert('savsoft_qcl',$userdata);
		  				for($i=1; $i<=$_POST['noq'][$ck]; $i++){
							$correct_i[]=$_POST['i_correct'][$ck];
							$incorrect_i[]=$_POST['i_incorrect'][$ck];
						}
		 			}
		 		}
	 		}
		 	$userdata=array(
		 		'noq'=>array_sum($_POST['noq']),
		 		'correct_score'=>implode(',',$correct_i),
		 		'incorrect_score'=>implode(',',$incorrect_i)
			);
	 		$this->db->where('quid',$quid);
	  		$this->db->update('savsoft_quiz',$userdata);
	 	}else{
			$correct_i=array();
		 	$incorrect_i=array();
 			foreach($_POST['i_correct'] as $ck =>$cv){
				$correct_i[]=$_POST['i_correct'][$ck];
				$incorrect_i[]=$_POST['i_incorrect'][$ck];
			}

	 		$userdata=array(
		 		'correct_score'=>implode(',',$correct_i),
		  		'incorrect_score'=>implode(',',$incorrect_i)
			);
	  		$this->db->where('quid',$quid);
	  		$this->db->update('savsoft_quiz',$userdata);
		}*/
		$data['quid'] = $quid;
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	function view_result($rid){
		
		if(!$this->session->userdata('logged_in')){
			if(!$this->session->userdata('logged_in_raw')){
				redirect('home');
			}	
		}
		if(!$this->session->userdata('logged_in')){
			$logged_in=$this->session->userdata('logged_in_raw');	
		}else{
			$logged_in=$this->session->userdata('logged_in');
		}
		if($logged_in['base_url'] != base_url()){
			$this->session->unset_userdata('logged_in');		
			redirect('home');
		}
		$logged_in=$this->session->userdata('logged_in');
        $setting_p=explode(',',$logged_in['results']);
		if(in_array('List',$setting_p) || in_array('List_all',$setting_p)){
			
		}else{
			exit($this->lang->line('permission_denied'));
		}		
		
	 	// check any custom field pending to fill..
			
		$data['result']=$this->result_model->get_result($rid);
		 
		if(!in_array('List_all',$setting_p)){
			if($this->user_model->pending_custom($data['result']['uid']) >= 1 ){
				redirect('user/edit_user_fill_custom/'.$data['result']['uid'].'/'.$rid);
			}
		}
		$data['attempt']=$this->result_model->no_attempt($data['result']['quid'],$data['result']['uid']);
		$data['title']=$this->lang->line('result_id').' '.$data['result']['rid'];
		if($data['result']['view_answer']=='1' || $logged_in['su']=='1'){
		 	$this->load->model("quiz_model");
			$data['saved_answers']=$this->quiz_model->saved_answers($rid);
			$data['questions']=$this->quiz_model->get_questions($data['result']['r_qids']);
			$data['options']=$this->quiz_model->get_options($data['result']['r_qids']);

		}
		// top 10 results of selected quiz
		$last_ten_result = $this->result_model->last_ten_result($data['result']['quid']);
		$value=array();
     	$value[]=array('Quiz Name','Percentage (%)');
     	foreach($last_ten_result as $val){
     		$value[]=array($val['email'].' ('.$val['first_name']." ".$val['last_name'].')',intval($val['percentage_obtained']));
     	}
     	$data['value']=json_encode($value);
	 
		// time spent on individual questions
		$correct_incorrect=explode(',',$data['result']['score_individual']);
	 	$qtime[]=array($this->lang->line('question_no'),$this->lang->line('time_in_sec'));
    	foreach(explode(",",$data['result']['individual_time']) as $key => $val){
			if($val=='0'){
				$val=1;
			}
		 	if($correct_incorrect[$key]=="1"){
		 		$qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('correct')." ",intval($val));
		 	}else if($correct_incorrect[$key]=='2' ){
		  		$qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('incorrect')."",intval($val));
		 	}else if($correct_incorrect[$key]=='0' ){
		  		$qtime[]=array($this->lang->line('q')." ".($key+1).") -".$this->lang->line('unattempted')." ",intval($val));
		 	}else if($correct_incorrect[$key]=='3' ){
		  		$qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('pending_evaluation')." ",intval($val));
		 	}
		}
	 	$data['qtime']=json_encode($qtime);
	 	$data['percentile'] = $this->result_model->get_percentile($data['result']['quid'], $data['result']['uid'], $data['result']['score_obtained']);

	  
	  	$uid=$data['result']['uid'];
	  	$quid=$data['result']['quid'];
	  	$score=$data['result']['score_obtained'];
	  	$query=$this->db->query(" select * from savsoft_result where score_obtained > '$score' and quid ='$quid' group by score_obtained ");
	  	$data['rank']=$query->num_rows() + 1;
	  	$query=$this->db->query(" select * from savsoft_result where quid ='$quid'  group by score_obtained  ");
	  	$data['last_rank']=$query->num_rows();
	  	$query=$this->db->query(" select * from savsoft_result where quid ='$quid'  group by score_obtained  order by score_obtained desc limit 3 ");
	  	$data['toppers']=$query->result_array();
	  	$query=$this->db->query(" select * from savsoft_result where quid ='$quid'  group by score_obtained  order by score_obtained asc limit 1 ");
	  	$data['looser']=$query->row_array();
	
		// getting joined groups 
	 	$data['joined_groups']=$this->social_model->joined_groups($data['result']['uid']);
	 
		$this->load->view('header',$data);
		if($this->session->userdata('logged_in')){
			$this->load->view('view_result',$data);
		}else{
			$this->load->view('view_result_without_login',$data);	
		}
		$this->load->view('footer',$data);	
	
	}
	
	function upload_photo(){
        $user =$this->session->userdata('logged_in');
        $uid = $user['uid'];


		if (isset($_POST['uploadclick']))
		{
            echo 1;
		    if (isset($_FILES['upload']))
		    {
                 echo 2;
		        if ($_FILES['upload']['error'] > 0)
		        {
		        	 $this->session->set_flashdata('message','<div class="alert alert-danger">Upload error</div>' ); 
		            
		        }
		        else {
		        	$target_dir = "upload/avatar/";
		            $basename = basename($_FILES["upload"]["name"]);
		            $inputFileName = $target_dir . basename($_FILES["upload"]["name"]);              
		        	$fileType = strtolower(pathinfo($inputFileName,PATHINFO_EXTENSION));
		        	if($fileType=="png" | $fileType=="jpg" ){
		                // Upload file

		                $target_dir = "upload/avatar/";
		                $basename = basename($_FILES["upload"]["name"]);
		                $inputFileName = $target_dir .$uid. '.png';
		                move_uploaded_file($_FILES['upload']['tmp_name'], $inputFileName);
				        echo $basename;
						$this->db->where("uid", $uid);
						$this->db->update("savsoft_users", array("photo"=>base_url("upload/avatar/".$uid.".png")));
						$user['photo']=base_url("upload/avatar/".$uid.".png");
						$newdata = array('logged_in'=> $user);
				        $this->session->set_userdata($newdata);
		            }
		            else {
		        	 	$this->session->set_flashdata('message','<div class="alert alert-danger">Error format</div>' );	
		            }
		        }
		    }
		    else{
		    	$this->session->set_flashdata('message','<div class="alert alert-danger">Bạn chưa chọn file upload</div>');	
		        
		    }
		}
        redirect('profile');
		
	}
    function upload_logo(){
        $user =$this->session->userdata('logged_in');
        $uid = $user['uid'];


		if (isset($_POST['uploadclick']))
		{
            
		    if (isset($_FILES['upload']))
		    {
                 
		        if ($_FILES['upload']['error'] > 0)
		        {
		        	 $this->session->set_flashdata('message','<div class="alert alert-danger">Upload error</div>' ); 
		            
		        }
		        else {
		        	$target_dir = "upload/logo/";
		            $basename = basename($_FILES["upload"]["name"]);
		            $inputFileName = $target_dir . basename($_FILES["upload"]["name"]);              
		        	$fileType = strtolower(pathinfo($inputFileName,PATHINFO_EXTENSION));
		        	if($fileType=="png" | $fileType=="jpg" ){
		                // Upload file

		                $target_dir = "upload/logo/";
		                $basename = basename($_FILES["upload"]["name"]);
		                $inputFileName = $target_dir .$uid. '.png';
		                move_uploaded_file($_FILES['upload']['tmp_name'], $inputFileName);
				        echo $basename;
						$this->db->where("uid", $uid);
						$this->db->update("savsoft_users", array("logo"=>base_url("upload/logo/".$uid.".png")));
						$user['logo']=base_url("upload/logo/".$uid.".png");
						$newdata = array('logged_in'=> $user);
				        $this->session->set_userdata($newdata);
		            }
		            else {
		        	 	$this->session->set_flashdata('message','<div class="alert alert-danger">Error format</div>' );	
		            }
		        }
		    }
		    else{
		    	$this->session->set_flashdata('message','<div class="alert alert-danger">Bạn chưa chọn file upload</div>');	
		        
		    }
		}
        redirect('profile#logo');
		
	}
	function manage_group(){
		$user = $this->session->userdata('logged_in');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		if($user){
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();	             
		    }
			if($user['su']==4){
				$data['child_list'] =$this->user_model->get_child_list();			             
		    }
			$data['user_name']= $user['first_name'].' '.$user['last_name'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['email']=$user['email'];
			$data['phone']=$user['contact_no'];
			$data['uid']=$user['uid'];
			$data['user_code']=$user['user_code'];
			$data['birthdate']=$user['birthdate'];
			$data['link_photo']=$user['photo'];
			$data['su']=$user['su'];
		}
		$data['sortby']=$_GET['sortby'];
		$data['limit'] = 10;
		$data['page'] = 0;
		$data['num_group'] = $this->social_model->num_socialgroup_joined("",$data['sortby'],10,0);
		$data['data'] = $this->social_model->socialgroup_joined_list("",$data['sortby'],10,0);
		$data['num_page']=ceil($data['num_group']/$data['limit']);
	    $data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);
		$this->load->view('after_login/manage_group',$data);
		$this->load->view('home/footer',$data);
	}
	function join_group(){
		$user = $this->session->userdata('logged_in');
		$inp = json_decode($this->input->raw_input_stream,true);
		$inp['check'] = $this->social_model->join_group($inp['uid'],$inp['sg_id'],$inp['code']);
		header('Content-Type: application/json');
		echo json_encode($inp);
	}
	function check_user_group(){
		$user = $this->session->userdata('logged_in');
		$inp = json_decode($this->input->raw_input_stream,true);
		$inp['check'] = $this->social_model->check_user_group($inp['uid'],$inp['sg_id']);
		header('Content-Type: application/json');
		echo json_encode($inp);
	}
	function notify_join_group(){
		$user = $this->session->userdata('logged_in');
		$inp = json_decode($this->input->raw_input_stream,true);
		$inp['uid'] = $user['uid'];
		$inp['check'] = $this->social_model->notify_join_group($inp['code'],$user['uid']);
		header('Content-Type: application/json');
		echo json_encode($inp);
	}
	function create_group(){
		$user = $this->session->userdata('logged_in');
		if($user){
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();	             
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
		}
		$child_list =$this->user_model->get_child_list();			             
		$data['child_list']= $child_list;
		$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(10);
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$data['category_list']=$this->qbank_model->category_list();
		$data['level_list']=$this->qbank_model->level_list();
		$this->load->view('after_login/create_group',$data);
		$this->load->view('home/footer',$data);
	}
	function get_data_manage_group($sortby){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['sortby']=$sortby;
			$inp['uid'] = $user['uid'];
			$inp['su'] = $user['su'];
 			$inp['search']=htmlentities($inp['search'],ENT_COMPAT,'UTF-8');
			$inp['group']=$this->social_model->socialgroup_joined_list($inp['search'],$inp['sortby'],$inp['limit'],$inp['page']);
			$inp['num_group']=$this->social_model->num_socialgroup_joined($inp['search'],$inp['sortby'],$inp['limit'],$inp['page']);
			$inp['num_page']=ceil($inp['num_group']/$inp['limit']);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}
	
    function manage_qbank(){
		$user= $this->session->userdata('logged_in');
		$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
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
		$data['category_list']=$this->qbank_model->category_list();
		$data['level_list']=$this->qbank_model->level_list(1);
		$data['questions']= $this->qbank_model->mng_qt_list(0,0,"",10,0); 
		$data['num_question']= $this->qbank_model->num_mng_qt(0,0,"",10,0); 
		$data['limit']= 10;
        $data['page']=0;
		$data['cid']=0;
		$data['lid']=0;	
        $data['num_page']=ceil($data['num_question']/$data['limit']);		
		$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(4);
	    $this->load->view('after_login/manage_qbank', $data);
		$this->load->view('home/footer', $data);
	}
	
	 function get_data_manage_qbank(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['questions']= $this->qbank_model->mng_qt_list($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['num_question']= $this->qbank_model->num_mng_qt($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['category_list']=$this->qbank_model->category_list();
			$inp['level_list']=$this->qbank_model->level_list(1);
			$inp['num_page']=ceil($inp['num_question']/$inp['limit']);
			header('Content-Type: application/json');
				
			echo json_encode($inp);
		}
	}
	function get_data_qbank_not_in($qid){
		$user=$this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['quiz']=$this->quiz_model->get_array_qids($qid)['quid'];
			$inp['qids']= $this->quiz_model->get_array_qids($qid)['qids'];
			$inp['category_list']=$this->qbank_model->category_list();
			$inp['level_list']=$this->qbank_model->level_list();
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['qbank']=$this->quiz_model->get_quiz_not_in($inp['qids'],$inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']);
			$inp['num_qbank']=$this->quiz_model->num_quiz_not_in($inp['qids'],$inp['cid'],$inp['lid'],$inp['search']);
			$inp['num_page']=ceil($inp['num_qbank']/$inp['limit']);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}
	function get_data_qbank_in($qid){
				$user=$this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['quiz']=$this->quiz_model->get_array_qids($qid)['quid'];
			$inp['qids']= $this->quiz_model->get_array_qids($qid)['qids'];
			$inp['category_list']=$this->qbank_model->category_list();
			$inp['level_list']=$this->qbank_model->level_list();
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['qbank']=$this->quiz_model->get_quiz_in($inp['qids'],$inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']);
			$inp['num_qbank']=$this->quiz_model->num_quiz_in($inp['qids'],$inp['cid'],$inp['lid'],$inp['search']);
			$inp['num_page']=ceil($inp['num_qbank']/$inp['limit']);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
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
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();
			}
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
		if($user['su']==4){
			$data['child_list'] =$this->user_model->get_child_list();			             
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
	    $this->load->view('after_login/quiz_list', $data);
		$this->load->view('home/footer', $data);
	}
	
	function create_quiz(){
		
		$user =$this->session->userdata('logged_in');
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
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
            $data['stcategories']=$this->qbank_model->get_statistic_category();
            $data['group_list']=$this->user_model->group_list();
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);
			if($user['su']==4){
				$data['child_list'] =$this->user_model->get_child_list();			             
		    }
			
			$this->load->view('after_login/create_quiz',$data);
			$this->load->view('home/footer',$data);
		}
		else redirect('home');
	}
	function edit_quiz($qid){
		$user =$this->session->userdata('logged_in');
		$data['quiz']=$this->quiz_model->get_array_qids($qid);
		$data['created']=$this->quiz_model->get_array_qids($qid)['inserted_by'];

		if($user['su']==1 || $user['su']==6 || $data['created'] == $user['uid']){
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['email']=$user['email'];
			$data['phone']=$user['contact_no'];
			$data['uid']=$user['uid'];
			$data['user_code']=$user['user_code'];
			$data['birthdate']=$user['birthdate'];
			$data['link_photo']=$user['photo'];
			$data['su']=$user['su'];
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
            $data['stcategories']=$this->qbank_model->get_statistic_category();
            $data['group_list']=$this->user_model->group_list();
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);
			if($user['su']==4){
				$data['child_list'] =$this->user_model->get_child_list();			             
			}
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

			$this->load->view('after_login/edit_quiz',$data);
			$this->load->view('home/footer',$data);
		}
		else redirect('home_user/quiz_list');
	}
	
	function assign_quiz(){
		$user =$this->session->userdata('logged_in');
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
			$data['users']=$this->api_model->student_list_1();
			$data['users2']=$this->api_model->ass_list_2();
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
            $data['stcategories']=$this->qbank_model->get_statistic_category();
			$data['mapping_category'] = array("3"=>"Toán",
									"4"=>"Vật Lý",
									"5"=>"Hóa học",
									"6"=>"Địa lý",
									"7"=>"Tin Học",
									"8"=>"Sinh học",
									"9"	=>"Khoa học",
									"10"=>"Lịch sử",
									"11"=>"Công nghệ",
									"12"=>"Tiếng Anh",
									"13"=>"Thiên văn - vũ trụ",
									"14"=>"Robot",
									"15"=>"Môi trường",
									"16"=>"Sức khỏe",
									"17"=>"Ngữ Văn",
									"18"=>"Tiếng Việt",
									"19"=>"Xã hội",
									"20"=>"Test IQ",
									"21"=>"Giáo dục công dân",
									"22"=>"Tự nhiên và xã hội"

									);
								
			$data['results']= $this->api_model->list_question_assign("",0,10,0,0);
			$data['results1']= $this->api_model->list_question_assign2("",0,10,0,0);
			$data['num_result']= $this->api_model->num_question_assign();
			$data['num_result1']= $this->api_model->num_question_assign2(); 			
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);
			$data['limit']= 10;
			$data['page']=0;
			$data['cid']=0;
			$data['uid']=0;
			$data['num_page']=ceil($data['num_result']/$data['limit']);	
			$data['num_page1']=ceil($data['num_result1']/$data['limit']);
			if($user['su']==4){
				$data['child_list'] =$this->user_model->get_child_list();			             
			}
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();
				$this->load->view('after_login/assign_quiz_student',$data);
				$this->load->view('home/footer',$data);
			}
			else{
				$this->load->view('after_login/assign_quiz',$data);
				$this->load->view('home/footer',$data);
			}
		}
		else redirect('home');
	}
	
	
	function results(){
		$user =$this->session->userdata('logged_in');
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
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
            $data['stcategories']=$this->qbank_model->get_statistic_category();
            $data['users']=$this->api_model->student_list_1();
			$data['mapping_category'] = array(
									"3"=>"Toán",
									"4"=>"Vật Lý",
									"5"=>"Hóa học",
									"6"=>"Địa lý",
									"7"=>"Tin Học",
									"8"=>"Sinh học",
									"9"	=>"Khoa học",
									"10"=>"Lịch sử",
									"11"=>"Công nghệ",
									"12"=>"Tiếng Anh",
									"13"=>"Thiên văn - vũ trụ",
									"14"=>"Robot",
									"15"=>"Môi trường",
									"16"=>"Sức khỏe",
									"17"=>"Ngữ Văn",
									"18"=>"Tiếng Việt",
									"19"=>"Xã hội",
									"20"=>"Test IQ",
									"21"=>"Giáo dục công dân",
									"22"=>"Tự nhiên và xã hội"

									);
			$data['mapping_category1'] = array("0"=>"Tổ hợp",
									"3"=>"Toán",
									"4"=>"Vật Lý",
									"5"=>"Hóa học",
									"6"=>"Địa lý",
									"7"=>"Tin Học",
									"8"=>"Sinh học",
									"9"	=>"Khoa học",
									"10"=>"Lịch sử",
									"11"=>"Công nghệ",
									"12"=>"Tiếng Anh",
									"13"=>"Thiên văn - vũ trụ",
									"14"=>"Robot",
									"15"=>"Môi trường",
									"16"=>"Sức khỏe",
									"17"=>"Ngữ Văn",
									"18"=>"Tiếng Việt",
									"19"=>"Xã hội",
									"20"=>"Test IQ",
									"21"=>"Giáo dục công dân",
									"22"=>"Tự nhiên và xã hội"

									);						

			$data['results']= $this->api_model->result_list_2("",10,1,0,0);
			$data['num_result']= $this->api_model->num_result_2(); 
			$data['results1']= $this->api_model->result_list_3("",10,0,0);
			$data['num_result1']= $this->api_model->num_result_3();
			$data['limit']= 10;
			$data['page']=0;
			$data['cid']=0;
			$data['uid']=0;
			$data['num_page']=ceil($data['num_result']/$data['limit']);	
			$data['num_page1']=ceil($data['num_result1']/$data['limit']);			
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);
			
			if($user['su']==4){
				$data['child_list'] =$this->user_model->get_child_list();			             
		    }
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();		             
		    }
			
			$this->load->view('after_login/results',$data);
			$this->load->view('home/footer',$data);
		}
		else redirect('home');
	}
	
	function get_data_result(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['result']= $this->api_model->result_list_2($inp['search'],$inp['limit'],$inp['cid'],$inp['uid'],$inp['page']); 
			$inp['num_result']= $this->api_model->num_result_2($inp['search'],$inp['cid'],$inp['uid']); 
			$inp['num_page']=ceil($inp['num_result']/$inp['limit']);
			$inp['users']=$this->api_model->student_list_1($inp['cid'],$inp['uid']);
			header('Content-Type: application/json');
				
			echo json_encode($inp);
		}
	}
	function get_data_result1(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['result']= $this->api_model->result_list_3($inp['search'],$inp['limit'],$inp['uid'],$inp['cid'],$inp['page']); 
			$inp['num_result1']= $this->api_model->num_result_3($inp['search'],$inp['uid'],$inp['cid']); 
			$inp['num_page1']=ceil($inp['num_result1']/$inp['limit']);
			$inp['users']=$this->api_model->student_list_1($inp['uid'],$inp['cid']);
			header('Content-Type: application/json');	
			echo json_encode($inp);
		}
	}
	function get_data_result2(){
		$user= $this->session->userdata('logged_in');
		if($user){
			
			$inp = json_decode($this->input->raw_input_stream,true);
			
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['result']= $this->api_model->list_question_assign($inp['search'],$inp['cid'],$inp['limit'],$inp['uid'],$inp['sta'],$inp['page']); 
			$inp['num_result']= $this->api_model->num_question_assign($inp['search'],$inp['cid'],$inp['uid'],$inp['sta']); 
			$inp['num_page']=ceil($inp['num_result']/$inp['limit']);
			$inp['users']=$this->api_model->student_list_1($inp['cid'],$inp['uid']);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}
	function get_data_result3(){
		$user= $this->session->userdata('logged_in');
		if($user){
			
			$inp = json_decode($this->input->raw_input_stream,true);
			
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['result1']= $this->api_model->list_question_assign2($inp['search'],$inp['cid'],$inp['limit'],$inp['uid'],$inp['sta'],$inp['page']); 
			$inp['num_result1']= $this->api_model->num_question_assign2($inp['search'],$inp['cid'],$inp['uid'],$inp['sta']); 
			$inp['num_page1']=ceil($inp['num_result1']/$inp['limit']);
			$inp['users2']=$this->api_model->ass_list_2($inp['cid'],$inp['uid']);
			header('Content-Type: application/json');
			echo json_encode($inp);
		}
	}
	
	function moderate_question(){
		$user= $this->session->userdata('logged_in');
		if($user){
			if($user['su']==6){
				$data['user_name']= $user['last_name'].' '.$user['first_name'];
				$data['user_point']=$this->user_model->get_user_points($user['uid']);
				$data['email']=$user['email'];
				$data['phone']=$user['contact_no'];
				$data['uid']=$user['uid'];
				$data['user_code']=$user['user_code'];
				$data['birthdate']=$user['birthdate'];
				$data['link_photo']=$user['photo'];
				$data['su']=$user['su'];
				$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
				$data['stcategories']=$this->qbank_model->get_statistic_category();
				
				$data['category_list']=$this->qbank_model->category_list();
				$data['level_list']=$this->qbank_model->level_list();
				$data['questions']= $this->qbank_model->mdr_qt_list(0,0,"",10,0); 
				$data['num_question']= $this->qbank_model->num_mdr_qt(0,0,"",10,0); 
				$data['limit']= 10;
				$data['page']=0;
				$data['cid']=0;
				$data['lid']=0;	
				$data['num_page']=ceil($data['num_question']/$data['limit']);
                
				
				$data['quiz']= $this->quiz_model->mdr_quiz_list("",10,0); 
				$data['num_quiz']= $this->quiz_model->num_mdr_quiz(""); 
				$data['quiz_limit']= 10;
				$data['quiz_page']=0;
				$data['quiz_num_page']=ceil($data['num_quiz']/$data['quiz_limit']);
               				
				$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(4);
				$this->load->view('after_login/moderate_question',$data);
			    $this->load->view('home/footer',$data);
			}
			else{
				redirect("home_user");
			}
		}
		else redirect("home");
	}
	
	
	function moderate_question2(){
		$user= $this->session->userdata('logged_in');
		if($user){
			if($user['su']==6){
				$data['user_name']= $user['last_name'].' '.$user['first_name'];
				$data['user_point']=$this->user_model->get_user_points($user['uid']);
				$data['email']=$user['email'];
				$data['phone']=$user['contact_no'];
				$data['uid']=$user['uid'];
				$data['user_code']=$user['user_code'];
				$data['birthdate']=$user['birthdate'];
				$data['link_photo']=$user['photo'];
				$data['su']=$user['su'];
				$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
				$data['stcategories']=$this->qbank_model->get_statistic_category();
				
				$data['category_list']=$this->qbank_model->category_list();
				$data['level_list']=$this->qbank_model->level_list();
				$data['questions']= $this->qbank_model->mdr_qt_list2(0,0,"",10,0); 
				$data['num_question']= $this->qbank_model->num_mdr_qt2(0,0,"",10,0); 
				$data['limit']= 10;
				$data['page']=0;
				$data['cid']=0;
				$data['lid']=0;	
				$data['num_page']=ceil($data['num_question']/$data['limit']);
                
				
				//$data['quiz']= $this->quiz_model->mdr_quiz_list("",10,0); 
				//$data['num_quiz']= $this->quiz_model->num_mdr_quiz(""); 
				//$data['quiz_limit']= 10;
				//$data['quiz_page']=0;
				//$data['quiz_num_page']=ceil($data['num_quiz']/$data['quiz_limit']);
               				
				//$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(4);
				$this->load->view('after_login/moderate_question2',$data);
			    $this->load->view('home/footer',$data);
			}
			else{
				redirect("home_user");
			}
		}
		else redirect("home");
	}
	
	function moderate_question3(){
		$user= $this->session->userdata('logged_in');
		if($user){
			if($user['su']==6){
				$data['user_name']= $user['last_name'].' '.$user['first_name'];
				$data['user_point']=$this->user_model->get_user_points($user['uid']);
				$data['email']=$user['email'];
				$data['phone']=$user['contact_no'];
				$data['uid']=$user['uid'];
				$data['user_code']=$user['user_code'];
				$data['birthdate']=$user['birthdate'];
				$data['link_photo']=$user['photo'];
				$data['su']=$user['su'];
				$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
				$data['stcategories']=$this->qbank_model->get_statistic_category();
				
				$data['category_list']=$this->qbank_model->category_list();
				$data['level_list']=$this->qbank_model->level_list();
				$data['questions']= $this->qbank_model->mdr_qt_list3(0,0,"",10,0); 
				$data['num_question']= $this->qbank_model->num_mdr_qt3(0,0,"",10,0); 
				$data['limit']= 10;
				$data['page']=0;
				$data['cid']=0;
				$data['lid']=0;	
				$data['num_page']=ceil($data['num_question']/$data['limit']);
                
				
				//$data['quiz']= $this->quiz_model->mdr_quiz_list("",10,0); 
				//$data['num_quiz']= $this->quiz_model->num_mdr_quiz(""); 
				//$data['quiz_limit']= 10;
				//$data['quiz_page']=0;
				//$data['quiz_num_page']=ceil($data['num_quiz']/$data['quiz_limit']);
               				
				//$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(4);
				$this->load->view('after_login/moderate_question3',$data);
			    $this->load->view('home/footer',$data);
			}
			else{
				redirect("home_user");
			}
		}
		else redirect("home");
	}
	function get_data_moderate_qbank(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['questions']= $this->qbank_model->mdr_qt_list($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['num_question']= $this->qbank_model->num_mdr_qt($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['category_list']=$this->qbank_model->category_list();
			$inp['level_list']=$this->qbank_model->level_list();
			$inp['num_page']=ceil($inp['num_question']/$inp['limit']);
			header('Content-Type: application/json');
				
			echo json_encode($inp);
		}
	}
	
	function get_data_moderate_qbank2(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['questions']= $this->qbank_model->mdr_qt_list2($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['num_question']= $this->qbank_model->num_mdr_qt2($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['category_list']=$this->qbank_model->category_list();
			$inp['level_list']=$this->qbank_model->level_list();
			$inp['num_page']=ceil($inp['num_question']/$inp['limit']);
			header('Content-Type: application/json');
				
			echo json_encode($inp);
		}
	}
	
	function get_data_moderate_qbank3(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['questions']= $this->qbank_model->mdr_qt_list3($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['num_question']= $this->qbank_model->num_mdr_qt3($inp['cid'],$inp['lid'],$inp['search'],$inp['limit'],$inp['page']); 
			$inp['category_list']=$this->qbank_model->category_list();
			$inp['level_list']=$this->qbank_model->level_list();
			$inp['num_page']=ceil($inp['num_question']/$inp['limit']);
			header('Content-Type: application/json');
				
			echo json_encode($inp);
		}
	}
	
	function get_data_moderate_quiz(){
		$user= $this->session->userdata('logged_in');
		if($user){
			$inp = json_decode($this->input->raw_input_stream,true);
			$inp['quiz']= $this->quiz_model->mdr_quiz_list($inp['search'],$inp['limit'],$inp['page']); 
			$inp['num_quiz']= $this->quiz_model->num_mdr_quiz($inp['search']); 
			$inp['num_page']=ceil($inp['num_quiz']/$inp['limit']);
			header('Content-Type: application/json');
				
			echo json_encode($inp);
		}
	}
	
	function manage_class(){
		$user =$this->session->userdata('logged_in');
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
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
        
            $data['stcategories']=$this->qbank_model->get_statistic_category();
            $data['category_list']=$this->qbank_model->category_list();
			$data['level_list']=$this->qbank_model->level_list();
			
			
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);

			if($user['su']==4){
				$data['child_list'] =$this->user_model->get_child_list();			             
		    }
			
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();	             
		    }
			
			$this->load->view('after_login/manage_class',$data);
		    $this->load->view('after_login/modaladdclass');
			$this->load->view('after_login/modaladdgroup');
			$this->load->view('home/footer',$data);
		}
		else redirect('home');
	}
	
	function notifications(){
		$user = $this->session->userdata('logged_in');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
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
				if($user['su']==4){
					$data['child_list'] =$this->user_model->get_child_list();			             
				}
		}
		
		$data['notify'] = $this->notify_model->notify_all_list();
		$this->load->view('after_login/notifications',$data);
		$this->load->view('home/footer',$data);
	}

	function get_notify_block($id=0){
		$user = $this->session->userdata('logged_in');
		if($user){
			if($id==0){
				$html = $this->notify_model->notify_all_list();
			}
			if($id!=0){
				$html = $this->notify_model->notify_load_more($id);
			}
			header('Content-Type: application/json');
			echo json_encode($html);
		//	echo $html;
		}

	}

	
	
	function create_question2(){
		$user =$this->session->userdata('logged_in');
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
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
        
            $data['stcategories']=$this->qbank_model->get_statistic_category();
            $data['category_list']=$this->qbank_model->category_list();
			$data['level_list']=$this->qbank_model->level_list();
			
			
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);

			if($user['su']==4){
				$data['child_list'] =$this->user_model->get_child_list();			             
		    }
			
			$this->load->view('after_login/create_question2',$data);
			$this->load->view('after_login/modaladdclass');
			$this->load->view('after_login/modaladdgroup');
			$this->load->view('after_login/modaltemplate');
			$this->load->view('home/footer',$data);
		}
		else redirect('home');
	}
	
	
	
	function create_question(){
		$user =$this->session->userdata('logged_in');
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
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
        
            $data['stcategories']=$this->qbank_model->get_statistic_category();
            $data['category_list']=$this->qbank_model->category_list();
			$data['level_list']=$this->qbank_model->level_list();
			
			
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);

			if($user['su']==4){
				$data['child_list'] =$this->user_model->get_child_list();			             
		    }
			
			$this->load->view('after_login/create_question',$data);
			$this->load->view('after_login/modaladdclass');
			$this->load->view('after_login/modaladdgroup');
			$this->load->view('home/footer',$data);
		}
		else redirect('home');
	}
	
	function recommend_question(){
		 redirect("/home_user");
		  $user =$this->session->userdata('logged_in');
		  if($user){
			  $uid= $user['uid'];
			  $this->db->where("uid", $uid);
			  $u= $this->db->get("savsoft_users")->row_array();
			  $array_cat= array();
			  $sql= "select A.cid as cid, count(A.cid) as count_cid
				from savsoft_qbank as A
				join savsoft_answer_mcq as B on A.qid=B.qid
				join savsoft_category as C on A.cid=C.cid
				where B.uid=$uid group by A.cid ORDER BY count_cid desc limit 5";
			  $cat= $this->db->query($sql)->result_array();
              foreach ($cat as $c){
				  array_push($array_cat, $c['cid']);
			  }			  
			  $a= array(
				"num"=>intval("50"),
				"userBias"=>1.02,
				"user" => "$uid",
				"fields" => array(
					   array(
						"name"=> "categories",
						//"values"=> explode(",", $u['interest_cat_ids']),
						"values"=> $array_cat,
						"bias"=>20
						),
					   /*array(
						"name"=> "class",
						"values"=> explode(",", $u['interest_level_ids']),
						"bias"=>-1
						)*/
				)
				);
			$inp = json_encode($a);
			log_message("error", $inp);
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, 'http://192.168.1.227:8000/queries.json');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $inp);
			curl_setopt($ch, CURLOPT_POST, 1);

			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			$mess="success";
			if (curl_errno($ch)) {
				$mess= 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			//echo $inp;
			//print_r($result);

			$data= json_decode($result, true);


			$ara = array();
			$ara1 = array();
			if($mess=="success"){
			
				
				foreach($data['itemScores'] as $i=>$d){
					if($i<5){
						array_push($ara, $d['item']);
					}
					array_push($ara1, $d['item']);
				}
			
				//print_r($ara);
			
				$this->db->where_in("qid",$ara);
				$this->db->join("savsoft_category","savsoft_category.cid =savsoft_qbank.cid ");
				$data['mcq_fun']=$this->db->get("savsoft_qbank")->result_array();
				
				
				$this->db->where_in("qid",$ara);
				$ao = $this->db->get("savsoft_options")->result_array();
	
			}
			else{
				$data['mcq_fun']=array();
				$ao=array();
			}
			$data['id_mcq_fun']= implode(",",$ara1);
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['email']=$user['email'];
			$data['phone']=$user['contact_no'];
			$data['uid']=$user['uid'];
			$data['user_code']=$user['user_code'];
			$data['birthdate']=$user['birthdate'];
			$data['link_photo']=$user['photo'];
			$data['su']=$user['su'];
			if($data['su']==1){
				$data['su_text']="Admin";
			}
			else if($data['su']==2){
				
				$data['su_text']="Học sinh";
			}
			else if($data['su']==3){
				$data['su_text']="Giáo viên";
			}
			else if($data['su']==4){
				$data['su_text']="Phụ huynh";
				$data['child_list'] =$this->user_model->get_child_list();			             
			}
			else if($data['su']==5){
				$data['su_text']="";
				redirect('home_user');
			}
			else if($data['su']==6){
				$data['su_text']="Quản trị";
			}
			else if($data['su']==7){
				$data['su_text']="Trường";
			}
			else if($data['su']==8){
				$data['su_text']="Tổ chức";
			}
		    $data['category_list']=$this->qbank_model->category_list();
		    $data['level_list']=$this->qbank_model->level_list();
			$data['stcategories']=$this->qbank_model->get_statistic_category();
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(10,0);
			
			for($i=0; $i<count($data['mcq_fun']); $i++){
				//$this->db->insert("user_views", array("model"=>"qbank", "content_id"=>$data['mcq_fun'][$i]['qid'], "uid"=>$user["uid"]));
				//$this->load->model('predictio_model');
              //  $this->predictio_model->push_event("view",$user['uid'],$data['mcq_fun'][$i]['qid'], $data['mcq_fun'][$i]['cid'], $data['mcq_fun'][$i]['lid']);
				$origImageSrc="";
				$imgTags="";	
				$htmlContent=$data['mcq_fun'][$i]['question'];
				if(strpos($htmlContent,'https://latex.codecogs.com')===false){
					preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 			
					for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
						
					 }
					 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
					 if(count($imgTags[0])>0){
						 $qt='<div class="imgqtt"><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
						 $qt.=strip_tags( $data['mcq_fun'][$i]['question']);
						 $data['mcq_fun'][$i]['question']=$qt;
						 
						 $data['mcq_fun'][$i]['img']=$origImageSrc;
						
						 
					 }	
				 }				 
				 $this->db->select("su,logo,text_license,out_link");
				 $this->db->where("uid",  $data['mcq_fun'][$i]['inserted_by']);
				 $qr=$this->db->get("savsoft_users")->row_array();
				 $data['mcq_fun'][$i]['create_su']=$qr['su'];
				 $data['mcq_fun'][$i]['logo']=$qr['logo'];
				 $data['mcq_fun'][$i]['text_license']=$qr['text_license'];
				 $data['mcq_fun'][$i]['out_link']=$qr['out_link'];
					 
				$origvidSrc="";
				$vidTags="";
				preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
				if(count($vidTags[0])>0){
					 if(strpos($vidTags[0][0], "facebook")!==false){
						$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
					 }
					 else{
						$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
					 }
					 $qt.=strip_tags($data['mcq_fun'][$i]['question']);
					 $data['mcq_fun'][$i]['question']=$qt;
				} 
				$arr_op = array();
				for($j=0; $j<count($ao); $j++){
					if($ao[$j]['qid']== $data['mcq_fun'][$i]['qid']){
						array_push($arr_op, $ao[$j]);
					}
				}
				
				$data['mcq_fun'][$i]['options']=$arr_op;
				
				//$data['mcq_fun'][$i]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['create_date']);
				
                $this->db->where('content_id',$data['mcq_fun'][$i]['qid']);
			    $this->db->where('model','qbank');
			    $data['mcq_fun'][$i]['permalink'] = $this->db->get('savsoft_permalink')->row_array()['permalink'];
				$data['mcq_fun'][$i]['liked']=$this->qbank_model->check_like($data['mcq_fun'][$i]['qid']);
				
				$data['mcq_fun'][$i]['comment']=$this->comment_model->get_comment('qbank',$data['mcq_fun'][$i]['qid']);
				
				if($user['su']==2){
					$data['mcq_fun'][$i]['ass']=$this->qbank_model->question_of_student($data['mcq_fun'][$i]['qid']);
				}
				//for($j=0; $j<count($data['mcq_fun'][$i]['comment']); $j++){
				//	$data['mcq_fun'][$i]['comment'][$j]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['comment'][$j]['create_date']);
				//}
			}
			$this->load->view('after_login/recommend_question',$data);
			$this->load->view('home/footer',$data);
	   }	
	   else{
		   redirect("home");
	   }	
	}
	function list_student_inclass(){
		$user =$this->session->userdata('logged_in');
		if($user){
			$id = $this->uri->segment(3);
			$data['id']=$id;
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['email']=$user['email'];
			$data['phone']=$user['contact_no'];
			$data['uid']=$user['uid'];
			$data['user_code']=$user['user_code'];
			$data['birthdate']=$user['birthdate'];
			$data['link_photo']=$user['photo'];
			$data['su']=$user['su'];
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
            
            $data['stcategories']=$this->qbank_model->get_statistic_category();
            $data['category_list']=$this->qbank_model->category_list();
			$data['level_list']=$this->qbank_model->level_list();
			
			
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);

			if($user['su']==4){
				$data['child_list'] =$this->user_model->get_child_list();			             
		    }
			
			if($user['su']==2){
				$today=date('Y-m-d', time());
				$data['num_qas']=$this->db->query("SELECT * FROM savsoft_assign WHERE uid = ".$user['uid']." AND rid IS NULL and enddate>= '".$today."'")->num_rows();	             
		    }
			
			$this->load->view('after_login/list_student_inclass',$data);
		    $this->load->view('after_login/modaladdclass');
			$this->load->view('after_login/modaladdgroup');
			$this->load->view('home/footer',$data);
		}
		else redirect('home'); 
	}
	function see_notify($id){
		$dt=$this->notify_model->see_notify($id);
		header('Content-Type: application/json');
		echo json_encode($dt);
	}
	function see_notify1(){
		$dt=$this->api_model->count_notification();
		header('Content-Type: application/json');
		echo json_encode($dt);
	}
	function do_homework($quid,$auid){
		$this->notify_model->do_homework($quid,$auid);
	}


}