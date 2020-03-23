<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
	   $this->load->model("data_model");
	   $this->load->model("api_model");
	   $this->lang->load('basic', $this->config->item('language'));
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('data');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('data');
		}
		
	 }
    
	public function datagroup_list(){
		$logged_in=$this->session->userdata('logged_in');
        $setting_p=explode(',',$logged_in['setting']);
		if(!in_array('All',$setting_p)){
			exit($this->lang->line('permission_denied'));
		}
		// fetching group list
		$data['datagroup_list']=$this->data_model->datagroup_list();
		$data['title']=$this->lang->line('datagroup_list');
		$this->load->view('header',$data);
		$this->load->view('datagroup_list',$data);
		$this->load->view('footer',$data);
	}

	public function add_new_datagroup(){
		$logged_in=$this->session->userdata('logged_in');
		$setting_p=explode(',', $logged_in['setting']);
		if(!in_array('All', $setting_p)){
			exit($this->lang->line('permission_denied'));
		}

		if($this->input->post('datagroup_name')){
			if($this->data_model->insert_datagroup()){
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
			}
			redirect('data/datagroup_list');
		}

		$data['title']=$this->lang->line('add_datagroup');
		$this->load->view('header',$data);
		$this->load->view('add_datagroup',$data);
		$this->load->view('footer',$data);
	}

	public function edit_datagroup($gid){
		$logged_in=$this->session->userdata('logged_in');
        $setting_p=explode(',',$logged_in['setting']);
		if(!in_array('All',$setting_p)){
			exit($this->lang->line('permission_denied'));
		}

		if($this->input->post('datagroup_name')){
			if($this->data_model->update_datagroup($gid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
			}else{
			    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");						
			}
			redirect('data/datagroup_list');
		}
		// fetching group list
		$data['datagroup']=$this->data_model->get_datagroup($gid);
		$data['gid']=$gid;
		$data['title']=$this->lang->line('edit_datagroup');
		$this->load->view('header',$data);
		$this->load->view('edit_datagroup',$data);
		$this->load->view('footer',$data);
	}

	public function remove_datagroup($gid){
		$logged_in=$this->session->userdata('logged_in');
        $acp=explode(',',$logged_in['setting']);
		if(!in_array('All',$acp)){
			exit($this->lang->line('permission_denied'));
		}
			
		if($this->data_model->remove_datagroup($gid)){
            $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
		}else{
		    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
		}
		redirect('data/datagroup_list');
	}

	public function dataitem_list($limit='0'){
		$logged_in=$this->session->userdata('logged_in');
        $setting_p=explode(',',$logged_in['setting']);
		if(!in_array('All',$setting_p)){
			exit($this->lang->line('permission_denied'));
		}
		// fetching group list
		$data['limit']=$limit;
		$data['dataitem_list']=$this->data_model->dataitem_list_all($limit);
		$data['title']=$this->lang->line('dataitem_list');
		$this->load->view('header',$data);
		$this->load->view('dataitem_list',$data);
		$this->load->view('footer',$data);
	}

	public function add_new_dataitem(){
		$logged_in=$this->session->userdata('logged_in');
		$setting_p=explode(',', $logged_in['setting']);
		if(!in_array('All', $setting_p)){
			exit($this->lang->line('permission_denied'));
		}

		if($this->input->post('dataitem_name')){
			if($this->data_model->insert_dataitem()){
				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
			}
			redirect('data/dataitem_list');
		}
		$data['datagroup_list']=$this->data_model->datagroup_list();
		$data['title']=$this->lang->line('add_dataitem');
		$this->load->view('header',$data);
		$this->load->view('add_dataitem',$data);
		$this->load->view('footer',$data);
	}

	public function edit_dataitem($did){
		$logged_in=$this->session->userdata('logged_in');
        $setting_p=explode(',',$logged_in['setting']);
		if(!in_array('All',$setting_p)){
			exit($this->lang->line('permission_denied'));
		}

		if($this->input->post('dataitem_name')){
			if($this->data_model->update_dataitem($did)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
			}else{
			    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");						
			}
			redirect('data/dataitem_list');
		}
		$data['datagroup_list']=$this->data_model->datagroup_list();
		$data['dataitem']=$this->data_model->get_dataitem($did);
		$data['did']=$did;
		$data['title']=$this->lang->line('edit_dataitem');
		$this->load->view('header',$data);
		$this->load->view('edit_dataitem',$data);
		$this->load->view('footer',$data);
	}

	public function remove_dataitem($did){
		$logged_in=$this->session->userdata('logged_in');
        $acp=explode(',',$logged_in['setting']);
		if(!in_array('All',$acp)){
			exit($this->lang->line('permission_denied'));
		}
			
		if($this->data_model->remove_dataitem($did)){
            $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
		}else{
		    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
		}
		redirect('data/dataitem_list');
	}

	public function dataitem_filter($group_id, $level){
		$dataitems = $this->data_model->dataitem_list($group_id, $level);
		header('Content-Type: application/json');
		echo json_encode($dataitems);
	}

}