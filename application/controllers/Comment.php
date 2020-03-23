<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {

	 function __construct(){
	   	parent::__construct();
		$this->load->database();
	     $this->load->helper('url');
	   	$this->load->model('comment_model');
		$this->load->model('user_model','',TRUE);
		$this->lang->load('basic', $this->config->item('language'));
        $user =$this->session->userdata('logged_in');
		if(!$user){
			redirect("home");
        }
	 }
	 
	 function write($model,$wall_id, $parent_id=0){
		 $data=$this->comment_model->write($model,$wall_id, $parent_id);
		header('Content-Type: application/json');
		echo json_encode($data);
	 }
	 function get_comment($model,$wall_id, $parent_id=0, $limit=2){
		 $data=$this->comment_model->get_comment($model,$wall_id, $parent_id=0);
		header('Content-Type: application/json');
		echo json_encode($data);
	 }
	 function get_data_comment(){
			$inp = json_decode($this->input->raw_input_stream,true);
			
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['result']= $this->comment_model->list_manage_comment($inp['search'],$inp['limit'],$inp['page']); 
			$inp['num_result']= $this->comment_model->num_manage_comment($inp['search']); 
			$inp['num_page']=ceil($inp['num_result']/$inp['limit']);
			header('Content-Type: application/json');
			echo json_encode($inp);
	 }
	 function delete_comment($post_id){
		 $this->comment_model->delete_comment_model($post_id);
		 redirect('comment/manage_comment');
	 }
	 function manage_comment(){
		$user =$this->session->userdata('logged_in');
		if($user){
			$data['results']= $this->comment_model->list_manage_comment("",10,0);
			$data['num_result']= $this->comment_model->num_manage_comment(); 
			$data['limit']= 10;
			$data['page']=0;
			$data['num_page']=ceil($data['num_result']/$data['limit']);			
			//if($user['su']==4){
				//$data['child_list'] =$this->user_model->get_child_list();			             
		    //}
			$this->load->view('header');
			$this->load->view('comment/manage_comment',$data);
		}
		else redirect('home');
		
	 }
	 
	 
}
