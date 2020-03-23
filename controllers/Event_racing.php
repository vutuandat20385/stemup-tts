<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_racing extends CI_Controller {

	 function __construct()
	 {
	   	parent::__construct();
		$this->load->database();
		$this->load->helper('date');   
	   	$this->load->helper('url');
	    $this->load->model("qbank_model");
		$this->load->model("quiz_model");
		$this->load->model("user_model");
		$this->load->model("post_model");
	    $this->load->model("profile_model");
        $this->load->model("event_racing_model");
	   	$this->lang->load('basic', $this->config->item('language'));

	 }
 
	public function index(){
        $user= $this->session->userdata('logged_in');
		$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$data['today'] = date('d/m/Y', time());
		$data['todaay'] = date('Y-m-d',time());
		$data['todaay_points'] = $this->event_racing_model->get_do_points_perdays($data['todaay'],"default",10);
		$data['todaay_num'] = $this->event_racing_model->num_do_points_perdays($data['todaay'],0);
		$data['num_page_day']=ceil($data['todaay_num']/10);
		$monday =date('Y-m-d H:i:s', strtotime('monday this week'));
		$sunday =date('Y-m-d H:i:s', strtotime('sunday this week'));
		$data["month"]=date('m', strtotime('monday this week'));
		$data['monday'] = $monday;
		$data['sunday'] = $sunday;
		$data["no_week_of_month"]=floor(intval(date('d', strtotime('monday this week')))/7)+1;
		$data["week_points"]=$this->event_racing_model->get_data_perweek($monday,$sunday,0,"default");
		$data["week_num"]=$this->event_racing_model->num_user_perweek($monday,$sunday,"default");
		$data['num_page_week']=ceil($data['week_num']/10);
		$data["alltime_points"]=$this->event_racing_model->get_data_alltime();
		$data["all_num"]=$this->event_racing_model->mum_user_alltime();
		$data['num_page_all']=ceil($data['all_num']/10);
		$data['stcategories']=$this->qbank_model->get_statistic_category();
		$data['category_list']=$this->qbank_model->category_list();
        if($user){
			if($user['su']==4){
				$child_list =$this->user_model->get_child_list();			             
				$data['child_list']= $child_list;
			}
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(10);
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['email']=$user['email'];
			$data['phone']=$user['contact_no'];
			$data['uid']=$user['uid'];
			$data['user_code']=$user['user_code'];
			$data['birthdate']=$user['birthdate'];
			$data['link_photo']=$user['photo'];
			$data['su']=$user['su'];	
			$info = $this->profile_model->getprofile($user['uid']);
			$this->load->view('after_login/rank',$data);
			$this->load->view('home/footer',$data);
		}
		else {
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(3);
			$this->load->view('home/rank',$data);
			$this->load->view('home/footer',$data);
		}
	}
	function get_data_rank_day(){
		$inp =  json_decode($this->input->raw_input_stream,true);
		$data['todaay_points'] = $this->event_racing_model->get_do_points_perdays($inp['day'],$inp['category'],$inp['limit'],$inp['page']);
		$data['todaay_num'] = $this->event_racing_model->num_do_points_perdays($inp['day'],$inp['category']);
		$data['num_page_day']=ceil($data['todaay_num']/$inp['limit']);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	function get_data_by_day(){
		$inp =  json_decode($this->input->raw_input_stream,true);
		$day= $inp['day'];
		$page= $inp['page'];
		$data["day_points"]=$this->event_racing_model->get_data_perday($day, $page);
		$data["num_user"]=$this->event_racing_model->num_user_perday($day);
		$data["num_page"]=ceil($data["num_user"]/10);
	    header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function get_data_by_week(){
		$inp =  json_decode($this->input->raw_input_stream,true);
		$monday= $inp['monday'];
		$sunday= $inp['sunday'];
		$page= $inp['page'];
		$data["week_points"]=$this->event_racing_model->get_data_perweek($monday,$sunday,$page,$inp['category']);
		$data["num_user"]=$this->event_racing_model->num_user_perweek($monday,$sunday,$inp['category']);
		$data["num_page_week"]=ceil($data["num_user"]/10);
	    header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function get_data_by_alltime(){
		$inp =  json_decode($this->input->raw_input_stream,true);
		$page= $inp['page'];
		$data["alltime_points"]=$this->event_racing_model->get_data_alltime($page,$inp['category']);
		$data["num_user"]=$this->event_racing_model->mum_user_alltime($inp['category']);
		$data["num_page"]=ceil($data["num_user"]/10);
	    header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	
	function summary(){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$yesterday = date('d/m/Y', strtotime("-1 days"));
		$rfile = fopen($_SERVER['DOCUMENT_ROOT']."/application/cache/date_summary.txt", "r");
		if($rfile){
			$yd = fgets($rfile);
			if($yesterday==$yd){
				
				$wfile = fopen($_SERVER['DOCUMENT_ROOT']."/application/cache/date_summary.txt", "w+");
				if($wfile){
					$this->event_racing_model->minus_point_day($yesterday);
					$sunday =date('d/m/Y', strtotime('last Sunday'));
					if($yd==$sunday){
						$this->event_racing_model->minus_point_week($sunday);
					}
					fwrite($wfile,date('d/m/Y', time()));
					fclose($wfile); 
					
				}
			}
			fclose($rfile); 
		}
		
		
	}
	
}