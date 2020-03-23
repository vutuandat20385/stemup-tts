<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model("result_model");
		$this->load->model("social_model");
		$this->load->model("user_model");
		$this->load->model("post_model");
		$this->load->model("qbank_model"); 
		$this->load->model("comment_model");
		$this->load->model("api_model");
		$this->lang->load('basic', $this->config->item('language'));
		// redirect if not loggedin

	}

	public function index($status='0',$page='0')
	{
		$txtSearch = $_GET['search'];
		if(!$txtSearch){
			$s = '';
		}else{
			$s=$txtSearch;
		}
		if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
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
		$data['search']= $s;
		$data['page']=$page;
		$data['status']=$status;
		$data['title']=$this->lang->line('resultlist');
		$data['number_result']=$this->result_model->number_result($status,$s);
		$data['last_page']=ceil($data['number_result']/20 -1);

		// fetching result list
		$data['result']=$this->result_model->result_list2($status,$page,$s);
		// fetching quiz list
		$data['quiz_list']=$this->result_model->quiz_list();
		// group list
		$this->load->model("user_model");
		$data['group_list']=$this->user_model->group_list();
		
		$this->load->view('header',$data);
		$this->load->view('result_list',$data);
		$this->load->view('footer',$data);
	}
	
	public function remove_result($rid,$open='0'){
		
		if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		
		if($open != 0){
			$this->db->query("delete from savsoft_result where result_status='Open'");
		}
		
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
			$this->session->unset_userdata('logged_in');		
			redirect('home');
		}
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['results']);
		if(!in_array('Remove',$acp)){
			exit($this->lang->line('permission_denied'));
		} 
		
		if($this->result_model->remove_result($rid)){
			$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
		}else{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
			
		}
		redirect('result');
		
		
	}
	

	
	function generate_report(){
		if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
			$this->session->unset_userdata('logged_in');		
			redirect('home');
		}
		
		$logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['results']);
		if(!in_array('List_all',$acp)){
			exit($this->lang->line('permission_denied'));
		} 
		
		$this->load->helper('download');
		
		$quid=$this->input->post('quid');
		$gid=$this->input->post('gid');
		$result=$this->result_model->generate_report($quid,$gid);
		$csvdata=$this->lang->line('result_id').",".$this->lang->line('email').",".$this->lang->line('first_name').",".$this->lang->line('last_name').",".$this->lang->line('group_name').",".$this->lang->line('quiz_name').",".$this->lang->line('score_obtained').",".$this->lang->line('percentage_obtained').",".$this->lang->line('status')."\r\n";
		foreach($result as $rk => $val){
			$csvdata.=$val['rid'].",".$val['email'].",".$val['first_name'].",".$val['last_name'].",".$val['group_name'].",".$val['quiz_name'].",".$val['score_obtained'].",".$val['percentage_obtained'].",".$val['result_status']."\r\n";
		}
		$filename=time().'.csv';
		force_download($filename, $csvdata);

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

		$data=$logged_in;
		$data['su']=$logged_in['su'];
		
		if(!$data['photo']){
			$data['photo']= base_url('upload/avatar/default.png');
		}
		
		
		 // check any custom field pending to fill..
		
		$data['result']=$this->result_model->get_result($rid);
		$data['reward']=$this->result_model->get_rewardpoint($rid);
		
		$data['attempt']=$this->result_model->no_attempt($data['result']['quid'],$data['result']['uid']);
		$data['title']=$this->lang->line('result_id').' '.$data['result']['rid'];
		if($data['result']['view_answer']=='1' || $logged_in['su']=='1'){
			$this->load->model("quiz_model");
			//$data['saved_answers']=$this->quiz_model->saved_answers($rid);
			$data['questions']=$this->quiz_model->get_questions_rs($data['result']['r_qids']);
			
			$data['count_page_qt']=ceil(count($data['questions'])/7);
			$data['options']=$this->quiz_model->get_options($data['result']['r_qids']);

		}
		$uid=$data['result']['uid'];
		$quid=$data['result']['quid'];
		$score=$data['result']['score_obtained'];

		$data['list_score']=explode(",",$data['result']['score_individual']);
		$data['list_question']=explode(",",$data['result']['r_qids']);
		//$data['points']= $this->api_model->user_point();
		//$data['noti']= $this->api_model->count_notification();
		$quiz_list = $this->quiz_model->get_quiz_data($data['quiz']['quid']);
		$data['arr_quiz_qids'] = explode(',', $quiz_list["qids"]);
		$data['arr_quiz_reading'] = explode(',', $quiz_list["reading_mcq"]);
		$data['arr_quiz_video'] = explode(',', $quiz_list["video_mcq"]);
		$data['quiz_reading'] = $quiz_list["reading"];

		
		$this->load->view('stemup/result',$data);
		$this->load->view('stemup/footer');

	}
	function view_result2($rid){

		
		
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

		$data=$logged_in;
		$data['su']=$logged_in['su'];
		
		if(!$data['photo']){
			$data['photo']= base_url('upload/avatar/default.png');
		}
		
		
		 // check any custom field pending to fill..
		
		$data['result']=$this->result_model->get_result($rid);
		
		$data['attempt']=$this->result_model->no_attempt($data['result']['quid'],$data['result']['uid']);
		$data['title']=$this->lang->line('result_id').' '.$data['result']['rid'];
		if($data['result']['view_answer']=='1' || $logged_in['su']=='1'){
			$this->load->model("quiz_model");
			//$data['saved_answers']=$this->quiz_model->saved_answers($rid);
			$data['questions']=$this->quiz_model->get_questions_rs($data['result']['r_qids']);
			

			$data['options']=$this->quiz_model->get_options($data['result']['r_qids']);

		}
		
		
		$uid=$data['result']['uid'];
		$quid=$data['result']['quid'];
		$score=$data['result']['score_obtained'];

		$data['list_score']=explode(",",$data['result']['score_individual']);
		$data['list_question']=explode(",",$data['result']['r_qids']);

		$this->load->view('stemup/result',$data);
		$this->load->view('stemup/footer');

	}

/*	function view_result($rid){
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		//$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		//$data['post_cat']=$this->post_model->post_list($type_cat='category');
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
		$data['link_photo']=$logged_in['photo'];
		$data['su']=$logged_in['su'];
					$setting_p=explode(',',$logged_in['results']);
		
		
		 // check any custom field pending to fill..
			
		$data['result']=$this->result_model->get_result($rid);
		 
		if(!in_array('List_all',$setting_p)){
				if($this->user_model->pending_custom($data['result']['uid']) >= 1 ){
					//redirect('user/edit_user_fill_custom/'.$data['result']['uid'].'/'.$rid);
				}
	    }
		 $data['attempt']=$this->result_model->no_attempt($data['result']['quid'],$data['result']['uid']);
		 $data['title']=$this->lang->line('result_id').' '.$data['result']['rid'];
		 if($data['result']['view_answer']=='1' || $logged_in['su']=='1'){
			$this->load->model("quiz_model");
			//$data['saved_answers']=$this->quiz_model->saved_answers($rid);
			$data['questions']=$this->quiz_model->get_questions_rs($data['result']['r_qids']);
			
			$data['user_name']=$logged_in['first_name'].' '.$logged_in['last_name'];
			/*for($i=0; $i<count($data['questions']); $i++){
				$data['questions'][$i]['liked']=$this->qbank_model->check_like($data['questions'][$i]['qid']);
				$data['questions'][$i]['comment']=$this->comment_model->get_comment('qbank',$data['questions'][$i]['qid']);	
				$this->db->where('qid',$data['questions'][$i]['qid']);
				$mcq['n_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				$this->db->where('qid',$data['questions'][$i]['qid']);
				$this->db->where('istrue',1);
				$mcq['n_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
				
				$this->db->where('model', 'qbank');
				$this->db->where('content_id', $data['questions'][$i]['qid']);
				$this->db->where('uid !=', $logged_in['uid']);
				$this->db->where('status', 1);
				$data['questions'][$i]['n_like']=$this->db->get('savsoft_like')->num_rows();
				
			}*/
			/*$data['options']=$this->quiz_model->get_options($data['result']['r_qids']);

		 }
*/		
/*	  
		$uid=$data['result']['uid'];
		$quid=$data['result']['quid'];
		$score=$data['result']['score_obtained'];

		if($this->session->userdata('logged_in')){
			$this->load->view('view_result',$data);
			//header('Content-Type: application/json');
			//echo json_encode($data);
		}else{
			$this->load->view('view_result_without_login',$data);
			
		}
		$this->load->view('home/footer',$data);	
		
		
	}
*/	
	function get_statistic_mcq($qid){
		$data = $this->qbank_model->get_statistic_mcq($qid);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function getscoresbysg($sg_id,$uid,$quid){
		$data['members']=$this->social_model->group_member($sg_id);
		$uids=array();
		foreach($data['members'] as $k => $user){
			$uids[]=$user['uid'];
		}
		$this->db->order_by('savsoft_result.score_obtained','desc');
		$this->db->where('savsoft_result.quid',$quid);
		$this->db->where_in('savsoft_result.uid',$uids);
		$this->db->join('savsoft_users','savsoft_users.uid=savsoft_result.uid');
		$query=$this->db->get("savsoft_result");
		$data['quiz']=$query->result_array();  
		
		$this->load->view('getscoresbysg',$data);
		
	}
	
	function generate_certificate($rid){
		if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
			$this->session->unset_userdata('logged_in');		
			redirect('home');
		}
		if(!$this->config->item('dompdf')){
			exit('DOMPDF library disabled in config.php file');
			
		}
		$data['result']=$this->result_model->get_result($rid);
		if($data['result']['gen_certificate']=='0'){
			exit();
		}
		// save qr 
		$enu=urlencode(site_url('login/verify_result/'.$rid));

		$qrname="./upload/".time().'.jpg';
		$durl="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=".$enu."&choe=UTF-8";
		copy($durl,$qrname);
		
		
		$certificate_text=$data['result']['certificate_text'];
		$certificate_text=str_replace('{qr_code}',"<img src='".$qrname."'>",$certificate_text);
		$certificate_text=str_replace('{email}',$data['result']['email'],$certificate_text);
		$certificate_text=str_replace('{first_name}',$data['result']['first_name'],$certificate_text);
		$certificate_text=str_replace('{last_name}',$data['result']['last_name'],$certificate_text);
		$certificate_text=str_replace('{percentage_obtained}',$data['result']['percentage_obtained'],$certificate_text);
		$certificate_text=str_replace('{score_obtained}',$data['result']['score_obtained'],$certificate_text);
		$certificate_text=str_replace('{quiz_name}',$data['result']['quiz_name'],$certificate_text);
		$certificate_text=str_replace('{status}',$data['result']['result_status'],$certificate_text);
		$certificate_text=str_replace('{result_id}',$data['result']['rid'],$certificate_text);
		$certificate_text=str_replace('{generated_date}',date('Y-m-d H:i:s',$data['result']['end_time']),$certificate_text);
		
		$data['certificate_text']=$certificate_text;
	// $this->load->view('view_certificate',$data);
		$this->load->library('pdf');
		$this->pdf->load_view('view_certificate',$data);
		$this->pdf->render();
		$filename=date('Y-M-d_H:i:s',time()).".pdf";
		$this->pdf->stream($filename);

		
	}
	
	
	function preview_certificate($quid){
		if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
			$this->session->unset_userdata('logged_in');		
			redirect('home');
		}

		$this->load->model("quiz_model");
		
		$data['result']=$this->quiz_model->get_quiz($quid);
		if($data['result']['gen_certificate']=='0'){
			exit();
		}
		// save qr 
		$enu=urlencode(site_url('login/verify_result/0'));
		$tm=time();
		$qrname="./upload/".$tm.'.jpg';
		$durl="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=".$enu."&choe=UTF-8";
		copy($durl,$qrname);
		$qrname2=base_url('/upload/'.$tm.'.jpg');
		
		
		$certificate_text=$data['result']['certificate_text'];
		$certificate_text=str_replace('{qr_code}',"<img src='".$qrname2."'>",$certificate_text);
		$certificate_text=str_replace('{result_id}','1023',$certificate_text);
		$certificate_text=str_replace('{generated_date}',date('Y-m-d H:i:s',time()),$certificate_text);
		
		$data['certificate_text']=$certificate_text;
		$this->load->view('view_certificate_2',$data);
		
		
	}
	
}
