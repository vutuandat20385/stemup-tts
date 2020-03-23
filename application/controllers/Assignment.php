<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
	   $this->load->model("Assignment_model");
	     $this->lang->load('basic', $this->config->item('language'));
$this->load->helper('form');
	 }

	public function index($limit='0')
	{
		
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('home');
		}
		
	 					$logged_in=$this->session->userdata('logged_in');
	 					
                        $acp=explode(',',$logged_in['assignment']);
			if(!in_array('List',$acp)){
			exit($this->lang->line('permission_denied'));
			}
			
		
		 	 
			
			
	        $data['limit']=$limit;
		$data['title']=$this->lang->line('assignment');
		
		$data['result']=$this->Assignment_model->assignment_list($limit);
		$this->load->view('header',$data);
		$this->load->view('assignment_list',$data);
		$this->load->view('footer',$data);
	}
	
	function add_new(){
	if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('home');
		}
		
	 		$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['assignment']);
			if(!in_array('Add',$acp)){
			exit($this->lang->line('permission_denied'));
			}
			
	$data['title']=$this->lang->line('assignment');
		
		$data['categories']=$this->Assignment_model->getcategory_list();
		$data['groups']=$this->Assignment_model->getgroup_list();
		$this->load->view('header',$data);
		$this->load->view('add_assignment',$data);
		$this->load->view('footer',$data);
	
	
	}
	
	function add_new_assignment(){
	
	//echo "<pre>";print_r($_POST);die;
	$logged_in=$this->session->userdata('logged_in');
			$user_p=explode(',',$logged_in['assignment']);
			if(!in_array('Add',$user_p)){
			exit($this->lang->line('permission_denied'));
			}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('assignment_title', 'Title', 'required|is_unique[savsoft_assignment.assignment_title]');
        $this->form_validation->set_rules('cid', 'Category', 'required');
          if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('assignment/add_new/');
                }
                else
                {
                
                
                
				$result=$this->Assignment_model->insert_assignment();
					if($result=='true'){
					
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
					}else{ 
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
						
					}
					redirect('assignment/add_new/');
                }       

	
	}
	
	
	
	function upload_report($assignment_id){
	
	
                
				$result=$this->Assignment_model->upload_report($assignment_id);
					if($result=='true'){
					
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
					}else{ 
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
						
					}
					redirect('assignment/view_assignment/'.$assignment_id);
	
	}
	
		function view_assignment($assignment_id){
	if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('home');
		}
		
	 		$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['assignment']);
			if(!in_array('View',$acp)){
			exit($this->lang->line('permission_denied'));
			}
			
	$data['title']=$this->lang->line('assignment');
		
		$data['result']=$this->Assignment_model->getassignment_view($assignment_id);
		$data['groups']=$this->Assignment_model->getgroup_list();
		$data['uploaded_reports']=$this->Assignment_model->uploaded_reports($assignment_id);
		 
		$this->load->view('header',$data);
		$this->load->view('view_assignment',$data);
		$this->load->view('footer',$data);
	
	
	}
	
	
	function insert_score($assignment_id,$report_id){
	        $logged_in=$this->session->userdata('logged_in');
		$acp=explode(',',$logged_in['assignment']);
		         if(in_array('Add',$acp) || in_array('Edit',$acp)){
		         $result=$this->Assignment_model->update_score($report_id);
					if($result=='true'){
					
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
					}else{ 
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
						
					}
					redirect('assignment/view_assignment/'.$assignment_id);
	
	}
	}
	
		
	function csv($assignment_id){
		if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('home');
		}
		
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['assignment']);
			if(!in_array('List_all',$acp)){
			exit($this->lang->line('permission_denied'));
			} 
			
		$this->load->helper('download');
		
		$data['uploaded_reports']=$this->Assignment_model->uploaded_reports($assignment_id);
		
		$csvdata=$this->lang->line('id').",".$this->lang->line('email').",".$this->lang->line('first_name').",".$this->lang->line('last_name').",". $this->lang->line('score').",".$this->lang->line('status').",".$this->lang->line('submitted_on')."\r\n";
		foreach($data['uploaded_reports'] as $rk => $val){
		$csvdata.=$val['report_id'].",".$val['email'].",".$val['first_name'].",".$val['last_name'].",".$val['score'].",".$val['evaluated'].",".$val['reported_date']."\r\n";
		}
		$filename=time().'.csv';
		force_download($filename, $csvdata);

	}
	
	
	
	
	public function remove_assignment($assignment_id){

			$logged_in=$this->session->userdata('logged_in');
			$user_p=explode(',',$logged_in['assignment']);
			if(!in_array('Remove',$user_p)){
			exit($this->lang->line('permission_denied'));
			}
			if($uid=='1'){
					exit($this->lang->line('permission_denied'));
			}
			$result=$this->Assignment_model->remove_assignment($assignment_id);
			if($result=='true'){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
					}else{
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
					}
					redirect('assignment/');
                     
			
		}
	
	function edit_assignment($assignment_id){
	
	if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('home');
		}
		
	 					$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['assignment']);
			if(!in_array('Edit',$acp)){
			exit($this->lang->line('permission_denied'));
			}
			
	        $data['title']=$this->lang->line('assignment');
		$data['result']=$this->Assignment_model->getassignment_edit($assignment_id);
		$data['categories']=$this->Assignment_model->getcategory_list();
		$data['groups']=$this->Assignment_model->getgroup_list();
		$this->load->view('header',$data);
		$this->load->view('edit_assignment',$data);
		$this->load->view('footer',$data);
	
	}
	
	
	
	function update_assignment($assignment_id){
	$logged_in=$this->session->userdata('logged_in');
			$user_p=explode(',',$logged_in['assignment']);
			if(!in_array('Edit',$user_p)){
			exit($this->lang->line('permission_denied'));
			}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('assignment_title', 'Title', 'required');
        $this->form_validation->set_rules('cid', 'Category', 'required');
          if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('assignment/edit_assignment/'.$assignment_id);
                }
                else
                {
				$result=$this->Assignment_model->update_assignment($assignment_id);
					if($result=='true'){
					
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
					}else{ 
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
						
					}
					redirect('assignment/edit_assignment/'.$assignment_id);
                }       

	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
/// end	
}
