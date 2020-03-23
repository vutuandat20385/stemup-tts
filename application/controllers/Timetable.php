<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetable extends CI_Controller {

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
    $this->load->model("data_model");
    $this->load->model("profile_model");
    $this->load->model("event_racing_model");
	$this->load->model("timetable_model");
    $this->lang->load('basic', $this->config->item('language'));

    }

    function index(){
        $user = $this->session->userdata('logged_in');
        $data['dataitem_list']=$this->data_model->dataitem_list(1, 1);
        if($user['su'] == 1 ){
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
            $data['category_list']=$this->qbank_model->category_list();
			$data['stcategories']=$this->qbank_model->get_statistic_category();
            $this->load->view('after_login/create_timetable',$data);
            $this->load->view('home/footer',$data);
        }else{
            redirect('home_user');
        }
    }
    function creat_tb(){
        $logged_in = $this->session->userdata('logged_in');
        if($logged_in){
            if(isset($_POST)){
                $id_class = $_POST['lop_id'];
				$this->db->where('id_class', $classid);
		        $this->db->delete('savsoft_schedule');
				
                for($i = 0;$i<10;$i++){
                    for($a=0;$a<7;$a++){
                        if($a!=0){
                            $c = $a+1;
                            $d = $i+1;
                            $tt[$c][$d]= $_POST["t$c"."t$d"];
                            $lesson[$c][$d] = array(
                                'id_lesson' => $d,
                                'id_day' => $c,
                                'id_category' => $_POST["t$c"."t$d"],
                                'id_class' => $id_class,
                            );
                            
                            $this->db->insert('savsoft_schedule',$lesson[$c][$d]);
                            
                        }
                       
                    }
                }
               $this->timetable_model->calculate_schedule($id_class);
            }
            
        }
		redirect('timetable');
    }
}