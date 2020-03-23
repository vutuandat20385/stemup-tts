<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
	   $this->load->model("library_model");
	   $this->load->model("user_model");
	   $this->load->model("quiz_model");
	   $this->load->model("qbank_model");
	   $this->load->model("post_model");
	   $this->lang->load('basic', $this->config->item('language'));

		
		$logged_in=$this->session->userdata('logged_in');
		if(!$logged_in){
			redirect("home");
		}
	
	 }

	 
	 function video($page=1){
		$user=$this->session->userdata('logged_in');
		if(isset($_GET['txtSearchVideo'])){
			$data['search'] = $_GET['txtSearchVideo'];
		}else{
			$data['search'] = "";
		}
		if(!$user){
			redirect("home");
		}
		else{
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
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(5);
			$data['stcategories']=$this->qbank_model->get_statistic_category();
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			$data['video_list']=$this->library_model->get_data_library("video",$data['search'],5,$page-1);
			$data['numpage'] =ceil($this->library_model->number_data_library("video",$data['search'])/5);
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
			
			if($user['su']==4){
					
				$child_list =$this->user_model->get_child_list();			             
				$data['child_list']= $child_list;
				}
			$this->load->view("library/video", $data);
			$this->load->view("home/footer", $data);
		}
		 
	 }
	 function deleteVideo($id){
		 $user = $this->session->userdata("logged_in");
		 if($user['uid']==1){
			$this->library_model->deleteVideo($id);
			redirect('library/video');
		 }

	 }
	 function videos($permalink){
		$user=$this->session->userdata('logged_in');
		if(!$user){
			redirect("home");
		}
		else{
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
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(5);
			$data['stcategories']=$this->qbank_model->get_statistic_category();
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			$data['level_list']=$this->qbank_model->level_list();
			$data['category_list']=$this->qbank_model->category_list();
			$this->db->where("permalink", $permalink);
			$this->db->where("model","video");
			$pv =$this->db->get("savsoft_permalink")->row_array();
			if($user['su']==4){
					
				$child_list =$this->user_model->get_child_list();			             
				$data['child_list']= $child_list;
				}
			
	 
			if($pv){
				$this->db->where("lib_id", $pv['content_id']);
				$this->db->where("type", "video");
				$data['video']=$this->db->get("savsoft_library")->row_array();
				if($data['video']){
					$this->load->view("library/videos", $data);
				   $this->load->view("home/footer", $data);
				}
				else
					echo "video không tồn tại!";
			}else{
				echo "video không tồn tại!";
			}
		}
		
	 }
	 
	 function simulation($permalink){
		$user=$this->session->userdata('logged_in');
		if(!$user){
			redirect("home");
		}
		else{
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
			$data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
			$data['level_list']=$this->qbank_model->level_list();
			$this->db->where("permalink", $permalink);
			$this->db->where("model","video");
			$pv =$this->db->get("savsoft_permalink")->row_array();
			if($user['su']==4){
					
				$child_list =$this->user_model->get_child_list();			             
				$data['child_list']= $child_list;
				}
			
	 
			if($pv){
				$this->db->where("lib_id", $pv['content_id']);
				$this->db->where("type", "simulation");
				$data['video']=$this->db->get("savsoft_library")->row_array();
				
				if($data['video']){
					$this->load->view("library/videos", $data);
				   $this->load->view("home/footer", $data);
				}
				else
					echo "Mô phỏng không tồn tại!";
			}else{
				echo "Mô phỏng không tồn tại!";
			}
		}
		
	 }
	 
	 function insert_video(){
		$user=$this->session->userdata('logged_in');
		if(!$user){
			redirect("home");
		}
		else{
			if($user['su']==1){
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
				$this->load->view("library/insert_video", $data);
				$this->load->view("home/footer", $data);
			}
		}
		
		 
	 }
	 
	 function add_video(){
		$logged_in=$this->session->userdata('logged_in');
		if(!$logged_in){
			redirect("home");
		}
		else{
			if($logged_in['su']==1){
				$data=$this->library_model->add_video();
				
				header('Content-Type: application/json');
				echo json_encode($data);
			}
		}
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
				$this->load->view("library/edit_video", $data);
				$this->load->view("home/footer", $data);
			}
		}
	 }
	 function get_data_edit_video(){
		$logged_in=$this->session->userdata('logged_in');
		if(!$logged_in){
			redirect("home");
		}
		else{
			if($logged_in['su']==1){
				$data=$this->library_model->edit_video();
				header('Content-Type: application/json');
				echo json_encode($data);
			}
		}
	 }
	 
	 function get_data($type){
		$data=$this->library_model->get_data_library($type);			
		header('Content-Type: application/json');
		echo json_encode($data);	 
	 }

}