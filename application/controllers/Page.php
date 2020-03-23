<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class page extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
	   $this->load->model("user_model");
	   	$this->load->model("qbank_model");
	   	$this->load->model("account_model");
	   	$this->load->model("result_model");
	   	$this->load->model("api_model");
	   	$this->load->model("quiz_model");
	    $this->load->model("classes_model");
		$this->load->model("post_model");
		$this->load->model('notify_model');
		$this->load->model("data_model");
		$this->load->model("review_model");
		$this->load->model("comment_model");
		$this->load->model('event_racing_model');
	   $this->lang->load('basic', $this->config->item('language'));
		
		
	 }

	public function index(){
		
	}
	
////////////////////////////////////////////////////////
	public function question($permalink, $solved="", $opt_choice=""){
		//redirect('action');
		$user= $this->session->userdata('logged_in');
		//$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		//$data['post_cat']=$this->post_model->post_list($type_cat='category');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$this->db->where('permalink',$permalink);
		$this->db->where('model','qbank');
		$data= $user;
		if(!$data['photo']){
			$data['photo']= base_url('upload/avatar/default.png');
		}
		$pm=$this->db->get('savsoft_permalink')->row_array();
		if($pm){
			
			//$this->event_racing_model->update_views($pm['content_id'],"question");
			
			$this->db->where('deleted',0);
			$this->db->where('status',1);
			$this->db->where('qid', $pm['content_id']);
			$qt=$this->db->get('savsoft_qbank')->row_array();
			$data['recommend_question']= $this->qbank_model->recommend_question($qt['qid'],18);
			if($user){
				$this->db->insert("user_views", array("model"=>"qbank", "content_id"=>$pm['content_id'], "uid"=>$user["uid"]));
				$this->load->model('predictio_model');
                $this->predictio_model->push_event("view",$user['uid'],$qt['qid'], $qt['cid'], $qt['lid']);
			}
			$qt['question']= str_replace('src="..','src="'.base_url(), $qt['question']);
			$qt['question']= str_replace('src','class="img-responsive" src', $qt['question']);
			$this->db->where('qid',$qt['qid']);
			$options = $this->db->get('savsoft_options');
			$qt['options']=$options->result_array();
			foreach($qt['options'] as $op){
				if($op['score']>0){
					$qt['correct_option']=$op['q_option'];
				}
			}
			/*$this->db->select('tag_name');
			$this->db->where('question_id',$qt['qid']);
			$this->db->join('question_tag_rel', 'question_tag_rel.tag_id=tags.tag_id');
			$qt['tags']=$this->db->get('tags')->result_array();*/
		    $this->db->where('model','category');
			$this->db->where('content_id',$qt['cid']);
			$qt['cat_permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
			$this->db->where('cid',$qt['cid']);
			$qt['category_name']=$this->db->get('savsoft_category')->row_array()['category_name'];
			
			$qt['str_time_ago']=$this->api_model->time_ago($qt['create_date']);
			$qt['permalink']=$permalink;
			
			$this->db->select("su,logo,text_license,out_link");
			$this->db->where("uid", $qt['inserted_by']);
			$data['created_user']=$this->db->get("savsoft_users")->row_array();
			if($user){
				$qt['liked']=$this->qbank_model->check_like($qt['qid']);
				$data['user_name']= $user['last_name'].' '.$user['first_name'];
				$data['link_photo']=$user['photo'];
				$data['login']=1;
			}
			
			$this->db->where('qid',$qt['qid']);
			$qt['n_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$qt['qid']);
			$this->db->where('istrue',1);
			$qt['n_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $qt['qid']);
			if($user){
				$this->db->where('uid !=', $user['uid']);
			}
			$this->db->where('status', 1);
			$qt['n_like']=$this->db->get('savsoft_like')->num_rows();
			$qt['comment']=$this->comment_model->get_comment('qbank',$qt['qid']);
				for($j=0; $j<count($qt['comment']); $j++){
					$qt['comment'][$j]['str_time_ago']=$this->api_model->time_ago($qt['comment'][$j]['create_date']);
				}
			/*$this->load->library('Curl');
			$url = "https://graph.facebook.com/?id=http://do.stem.vn/index.php/page/question/".$qt['permalink'];
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$url);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
			$query = curl_exec($curl_handle);
			curl_close($curl_handle);
			if($sc['share']['share_count']){
				$this->db->where('qid',$qt['qid']);
				$this->db->update('savsoft_qbank',array('modify_date'=>$qt['modify_date'],'share_count'=>$sc['share']['share_count']));
				$qt['share_count']=$sc['share']['share_count'];
			}*/
			$origImageSrc="";
				
			$htmlContent=$qt['question'];
			if(strpos($htmlContent,'https://latex.codecogs.com')===false){
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 
				 $origvidSrc="";
				 preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
				 for ($j = 0; $j < count($vidTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$vidTags[0][$j], $video);
					$origvidSrc = str_ireplace( 'src="', '',  $video[0]);
					
				 }
				if(count($image)>0){
					$qt['img']=$origImageSrc;
				}
				 else
					 $qt['img']=base_url("upload/logostem.jpg");
			}
			else{
				$qt['img']=base_url("upload/logostem.jpg");
			}
			
			$origvidSrc="";
			$vidTags="";
			preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			if(count($vidTags[0])>0){
				 if(strpos($vidTags[0][0], "facebook")!==false){
					$qta='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
				 }
				 else{
					$qta='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
				 }
					 
				 $qta.=strip_tags($qt['question']);
				 $qt['question']=$qta;
			} 
			$data['mcq']=$qt;
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(5);
			
			if($solved=="notsolved"){
				$data['related_question']=$this->qbank_model->related_question($qt['qid'],9);
				if($user){
					$data['$login']=1;
					if($opt_choice){
						$data['opt_choice']=$opt_choice;
					}
					$data['su'] = $user['su'];
					$data['user_name']= $user['last_name'].' '.$user['first_name'];
					$data['user_point']=$this->user_model->get_user_points($user['uid']);
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
					
					$this->load->view('page/question2',$data);
					
				}
				else{
					$data['$login']=0;
					
					$this->load->view('page/question3',$data);
					$this->load->view('home/modal', $data);
				}
				
			}
			else{
				$data['related_question']=$this->qbank_model->related_question($qt['qid'],6);
				$this->load->view('page/question',$data);
				
			}
						
            $this->load->view('after_login/large_question_modal',$data);
			//$this->load->view('home/footer', $data);
		}
		else
			echo 'Câu hỏi không tồn tại';
	}
	
	public function quiz($permalink){
		$user= $this->session->userdata('logged_in');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$this->db->where('permalink', $permalink);
		$this->db->where('model', 'quiz');
		$dt=$this->db->get('savsoft_permalink')->row_array();
		$data= $user;
		if(!$data['photo']){
			$data['photo']= base_url('upload/avatar/default.png');
		}
		if(!$user){
			
			if($dt){
				//$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
				$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
				//$data['post_cat']=$this->post_model->post_list($type_cat='category');
				$this->event_racing_model->update_views($dt['content_id'],"quiz");
				$data['quiz']=$this->db->query("select * from savsoft_quiz where quid=".$dt['content_id'])->row_array();
                $data['permalink']=$permalink;			
				$data['title']=$data['quiz']['quiz_name'];
				$data['questions']=$this->quiz_model->get_questions($data['quiz']['qids']);
				if(count($data['questions']>0)){
					if( $data['questions'][0]['img']!="")
						$data['img'] = str_replace('../',base_url(),$data['questions'][0]['img']);
					else
						$data['img'] = base_url('upload/default_image_quiz.png');
					
				}
				$data['count_page_qt']=ceil(count($data['questions'])/7);
				$this->load->view('page/quiz', $data);
				$this->load->view('home/modal', $data);
				$this->load->view('home/footer', $data);
			}
			else{
				redirect("home");
			}
			
		}
		else{
			if($dt){
				$this->db->insert("user_views", array("model"=>"quiz", "content_id"=>$pm['content_id'], "uid"=>$user["uid"]));
			
				//$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
				$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
				//$data['post_cat']=$this->post_model->post_list($type_cat='category');
				$data['user_name']= $user['last_name'].' '.$user['first_name'];
				$data['user_point']=$this->user_model->get_user_points($user['uid']);
				$data['email']=$user['email'];
				$data['phone']=$user['contact_no'];
				$data['uid']=$user['uid'];
				$data['user_code']=$user['user_code'];
				$data['birthdate']=$user['birthdate'];
				$data['link_photo']=$user['photo'];
				$data['su']=$user['su'];
				$this->event_racing_model->update_views($dt['content_id'],"quiz");
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
				$quid=$dt['content_id'];
				$this->db->where('quid', $quid);
				$quiz_fun = $this->db->get('savsoft_quiz')->row_array();
				
				 $quids_arr = explode(",",$quiz_fun['qids'],5 );
				 $qids=$quids_arr[0];
				 for($i=1; $i<4; $i++){
					 $qids.=','.$quids_arr[$i];
				 }
				 $this->db->where('content_id',$quiz_fun['quid'] );
				$this->db->where('model','quiz');
				$quiz_fun['permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
				 $sql = "select question,background_template from savsoft_qbank where deleted =0 and qid in ($qids)  ";
				 $quiz_fun['question']= $this->db->query($sql)->result_array();
				 
				 $this->db->select('status');
				 $this->db->where('model','quiz');
				 $this->db->where('content_id',$quid);
				 $this->db->where('uid',$user['uid']);
				 $quiz_fun['liked']=$this->db->get('savsoft_like')->row_array()['status'];
				 $this->db->where('model', 'quiz');
				$this->db->where('content_id', $quid);
				$this->db->where('uid !=', $user['uid']);
				$this->db->where('status', 1);
				$quiz_fun['n_like']=$this->db->get('savsoft_like')->num_rows();
				
				$this->db->from('posts p');
				$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
				$this->db->where('p.model','quiz');
				$this->db->where('p.wall_id',$quid);
				$this->db->where('p.parent_id', 0);
				$this->db->limit(2);
				$this->db->order_by("p.create_date", "desc");
				$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,photo");
				$quiz_fun['comment'] =$this->db->get()->result_array();
				for($i=0; $i<count($quiz_fun['question']); $i++){
					 $origImageSrc="";
					 $origvidSrc="";
					 $htmlContent=$quiz_fun['question'][$i]['question'];
					 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
					 for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
						
					 }
					 if($origImageSrc)
						$quiz_fun['question'][$i]['img']=str_replace("../",base_url(),$origImageSrc);
					  else
						 $quiz_fun['question'][$i]['img']=base_url("upload/default_image_quiz.png");
					 preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
					 for ($j = 0; $j < count($vidTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$vidTags[0][$j], $video);
						$origvidSrc = str_ireplace( 'src="', '',  $video[0]);
						
					 }
					 if(count($video)>0)
						$quiz_fun['question'][$i][$i]['video']=$origvidSrc;
					  else
						 $quiz_fun['question'][$i]['video']="";
				 }
				
				
				$data['quiz_fun']=$quiz_fun;
				$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(10);
				$this->load->view('page/quiz2', $data);
				//$this->load->view('home/footer', $data);
			}
			else{
				redirect("home_user");
			}
		}
	} 
	public function categories(){
		
		$user= $this->session->userdata('logged_in');
		if(!$user){
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			$data['stcategories']=$this->qbank_model->get_statistic_category();
			$data['stcategories2']=$this->qbank_model->get_statistic_category2();
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(5);
			$this->load->view('page/categories',$data);
			$this->load->view('home/footer',$data);
		}
	}
	public function category($permalink_ct, $permalink_lv=""){
		$user= $this->session->userdata('logged_in');
		$data=$user;
		if(!$data['photo']){
			$data['photo']= base_url('upload/avatar/default.png');
		}
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		
		//$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		//$data['post_cat']=$this->post_model->post_list($type_cat='category');
		if($user){
			
	
			//$this->db->insert("user_views", array("model"=>"category", "content_id"=>$pm['content_id'], "uid"=>$user["uid"]));
			
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
		}
		$data['category_list']=$this->qbank_model->category_list();
		$data['level_list']=$this->qbank_model->level_list();
		$this->db->where('permalink',$permalink_ct);
		$this->db->where('model','category');
		$pmct=$this->db->get('savsoft_permalink')->row_array();
		if($pmct){
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(10,$pmct['content_id']);
			if($permalink_lv!=""){
				$this->db->where('permalink',$permalink_lv);
				$this->db->where('model','level');
				$pmlv=$this->db->get('savsoft_permalink')->row_array();
				if($pmlv){
					$data['level_id']=$pmlv['content_id'];
					$data['mcq_fun']=$this->qbank_model->get_mcq_fun(0,5,$pmct['content_id'],$pmlv['content_id']);
					$data['id_mcq_fun']=$this->qbank_model->get_id_mcq_fun($pmct['content_id'],$pmlv['content_id']);
					$this->db->where('cid',$pmct['content_id']);
					$data['category']=	$this->db->get('savsoft_category')->row_array()['category_name'];			
					for($i=0; $i<count($data['mcq_fun']); $i++){
						$data['mcq_fun'][$i]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['create_date']);
						
						if($user){
							$data['mcq_fun'][$i]['liked']=$this->qbank_model->check_like($data['mcq_fun'][$i]['qid']);
						}
						$data['mcq_fun'][$i]['comment']=$this->comment_model->get_comment('qbank',$data['mcq_fun'][$i]['qid']);
						
						if($user['su']==2){
							$data['mcq_fun'][$i]['ass']=$this->qbank_model->question_of_student($data['mcq_fun'][$i]['qid']);
						}
						for($j=0; $j<count($data['mcq_fun'][$i]['comment']); $j++){
							$data['mcq_fun'][$i]['comment'][$j]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['comment'][$j]['create_date']);
						}
					}
				}
				else{
					echo 'Trang không tồn tại';
				}
			}
			else{
				$data['mcq_fun']=$this->qbank_model->get_mcq_fun(0,5,$pmct['content_id'],0);
				
				$data['id_mcq_fun']=$this->qbank_model->get_id_mcq_fun($pmct['content_id']);
				$this->db->where('cid',$pmct['content_id']);
				$data['category']=	$this->db->get('savsoft_category')->row_array()['category_name'];			
				for($i=0; $i<count($data['mcq_fun']); $i++){
					$data['mcq_fun'][$i]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['create_date']);
					if($user){
						$data['mcq_fun'][$i]['liked']=$this->qbank_model->check_like($data['mcq_fun'][$i]['qid']);
					}
					$data['mcq_fun'][$i]['comment']=$this->comment_model->get_comment('qbank',$data['mcq_fun'][$i]['qid']);
					if($user['su']==2){
						$data['mcq_fun'][$i]['ass']=$this->qbank_model->question_of_student($data['mcq_fun'][$i]['qid']);
					}
					for($j=0; $j<count($data['mcq_fun'][$i]['comment']); $j++){
						$data['mcq_fun'][$i]['comment'][$j]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['comment'][$j]['create_date']);
					}
				}
				
				
				
			}
			$this->db->where("cid",$pmct['content_id'] );
			$data['category_name']=$this->db->get('savsoft_category')->row_array()['category_name'];
			$data['category_permalink']=$pmct['permalink'];
			$sql="Select * from savsoft_level join savsoft_permalink on (savsoft_permalink.content_id=savsoft_level.lid and savsoft_permalink.model='level') where lid in (Select distinct lid from savsoft_qbank where deleted=0 and status=1 and cid=".$pmct['content_id'].") ";
			$data['level_categ_list']=$this->db->query($sql)->result_array();
			$this->load->view('after_login/large_question_modal',$data);
			if($user){
				$this->load->view('page/category',$data);
			}
			else{
				date_default_timezone_set('Asia/Ho_Chi_Minh');
				$data['today'] = date('d/m/Y', time());
				$data["today_points"]=$this->event_racing_model->get_do_points_perday($data['today']);
				$this->load->view('home/newhomepage',$data);
				$this->load->view('home/modal');
			}
			
			 //$this->load->view('home/footer',$data);
		}
		else{
			echo 'Trang không tồn tại';
		}
		
			
	} 
	public function level($permalink){
		$user= $this->session->userdata('logged_in');
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		$data['post_cat']=$this->post_model->post_list($type_cat='category');
		if($user){
			$this->db->insert("user_views", array("model"=>"level", "content_id"=>$pm['content_id'], "uid"=>$user["uid"]));
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
		}
		$data['category_list']=$this->qbank_model->category_list();
		$data['level_list']=$this->qbank_model->level_list();
		
		$this->db->where('permalink',$permalink);
		$this->db->where('model','level');
		$pm=$this->db->get('savsoft_permalink')->row_array();
		if($pm){
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(10);
			
			$data['mcq_fun']=$this->qbank_model->get_mcq_fun(0,5,0,$pm['content_id']);
			$data['id_mcq_fun']=$this->qbank_model->get_id_mcq_fun(0,$pm['content_id']);
			$this->db->where('lid',$pm['content_id']);
			$data['level']=$this->db->get('savsoft_level')->row_array()['level_name'];			
			for($i=0; $i<count($data['mcq_fun']); $i++){
				$data['mcq_fun'][$i]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['create_date']);
				if($user){
					$data['mcq_fun'][$i]['liked']=$this->qbank_model->check_like($data['mcq_fun'][$i]['qid']);
				}
				$data['mcq_fun'][$i]['comment']=$this->comment_model->get_comment('qbank',$data['mcq_fun'][$i]['qid']);
				if($user['su']==2){
					$data['mcq_fun'][$i]['ass']=$this->qbank_model->question_of_student($data['mcq_fun'][$i]['qid']);
				}
				for($j=0; $j<count($data['mcq_fun'][$i]['comment']); $j++){
					$data['mcq_fun'][$i]['comment'][$j]['str_time_ago']=$this->api_model->time_ago($data['mcq_fun'][$i]['comment'][$j]['create_date']);
				}
			}
			$this->load->view('after_login/large_question_modal',$data);
			if($user){
				$this->load->view('page/level',$data);
			}
			else{
				$this->load->view('home/newhomepage',$data);
				$this->load->view('home/modal');
			}
			 $this->load->view('home/footer',$data);
		}
		else{
			echo 'Trang không tồn tại';
		}
	} 

}