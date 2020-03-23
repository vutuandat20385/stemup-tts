<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('tags_model');
		$this->load->model('user_model','',TRUE);
		$this->lang->load('basic', $this->config->item('language'));
		$user =$this->session->userdata('logged_in');
		if(!$user){
			redirect("home");
		}
	}
	function get_data_tags(){
			$inp = json_decode($this->input->raw_input_stream,true);
			
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['result']= $this->tags_model->list_tags($inp['search'],$inp['limit'],$inp['page']); 
			$inp['num_result']= $this->tags_model->num_tags($inp['search']); 
			$inp['num_page']=ceil($inp['num_result']/$inp['limit']);
			header('Content-Type: application/json');
			echo json_encode($inp);
	 }
	function edit_tags(){
		$inp = json_decode($this->input->raw_input_stream,true);
		if($this->tags_model->update_tags_0($inp['tag_id'],$inp['tag_name'])){
			header('Content-Type: application/json');
		    echo json_encode(array("status"=>1));
		}
		
		else{
			header('Content-Type: application/json');
		    echo json_encode(array("status"=>0));
		}
	}
	function delete_tags($tag_id){
		$this->tags_model->delete_tags($tag_id);
	}
	function all_tag(){
		$user =$this->session->userdata('logged_in');
		if($user){
			$data['results']= $this->tags_model->list_tags("",10,0);
			$data['num_result']= $this->tags_model->num_tags(); 
			$data['limit']= 10;
			$data['page']=0;
			$data['num_page']=ceil($data['num_result']/$data['limit']);			
			$this->load->view('header');
			$this->load->view('tags/tags',$data);
		}
		else redirect('home');
	}
	function get_data_tagquestion(){
			$inp = json_decode($this->input->raw_input_stream,true);
			
			$inp['search']=htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
			$inp['result']= $this->tags_model->list_question($inp['search'],$inp['limit'],$inp['page'],$inp['tag_id'],$inp['cid'],$inp['lid'],$inp['inserted_by']); 
			$inp['num_result']= $this->tags_model->num_question($inp['search'],$inp['tag_id'],$inp['cid'],$inp['lid'],$inp['inserted_by']); 
			$inp['num_page']=ceil($inp['num_result']/$inp['limit']);
			header('Content-Type: application/json');
			echo json_encode($inp);
	}
	
	function question(){		
		$user = $this->session->userdata('logged_in');
		if($user){
			$data['tag_id']=$this->uri->segment(3);
			$cid=$data['cid'];
			$lid=$data['lid'];
			$inserted_by=$data['inserted_by'];
			$data['list']=$this->tags_model->listper_tag_question($data['tag_id']);
			$data['cat']=$this->tags_model->listcat_tag_question($data['tag_id']);
			$data['lev']=$this->tags_model->listlev_tag_question($data['tag_id']);
			
			$data['results']= $this->tags_model->list_question("",10,0,$data['tag_id'],$data['cid'],$data['lid'],$data['inserted_by']);
			$data['num_result']= $this->tags_model->num_question("",$data['tag_id'],$data['cid'],$data['lid'],$data['inserted_by']);
			
			$data['limit']= 10;
			$data['page']=0;
			$data['num_page']=ceil($data['num_result']/$data['limit']);	
			$this->load->view('header');
			$this->load->view('tags/question_in_tags',$data);
			$this->load->view('footer',$data);
		}
		else redirect('home');
	}
	public function remove_tag_question($qid){
			$data['tag_id']=$this->uri->segment(3);
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['questions']);
			if(!in_array('Remove',$acp)){
			exit($this->lang->line('permission_denied'));
			} 
			
			if($this->qbank_model->remove_tag_question($qid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
						
					}
					redirect('tags/question/'.$data['tag_id']);
                     
			
		}
	
	function get_data_merge(){
		$inp = json_decode($this->input->raw_input_stream,true);
		if($this->tags_model->merge_tags($inp['tags_id'],$inp['tags_name'])){
			header('Content-Type: application/json');
		    echo json_encode(array("status"=>1));
		}
		
		else{
			header('Content-Type: application/json');
		    echo json_encode(array("status"=>0));
		}
	}
	
}