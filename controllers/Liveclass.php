<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Liveclass extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->helper(array('form', 'url'));
   $this->load->helper('url');
   $this->load->library('form_validation');
   $this->load->model('liveclass_model','',TRUE);
   $this->load->model('api_model');
	$this->load->model('user_model','',TRUE);
		   $this->lang->load('basic', $this->config->item('language'));
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('home');
			
		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');		
		redirect('home');
		}	

 }

	 function index($limit='0')
	 {
	 
	 		$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['quiz']);
			if(in_array('List',$acp) || in_array('List_all',$acp)){
			
			}else{
			exit($this->lang->line('permission_denied'));
			}
			
		  $data['result'] = $this->liveclass_model->active_classroom($limit);
	 
			$data['title']="Active or Upcoming Classes";
		   $this->load->view('header',$data);
		   $this->load->view('active_classes',$data);
		  $this->load->view('footer',$data);
	 }



	 
	 function closed_classes($limit='0')
	 {
		
		        $logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['quiz']);
			if(in_array('List',$acp) || in_array('List_all',$acp)){
			
			}else{
			exit($this->lang->line('permission_denied'));
			}
			  $data['result'] = $this->liveclass_model->closed_classroom($limit);
	 
			$data['title']="Closed Classes";
		   $this->load->view('header',$data);
		   $this->load->view('closed_classes',$data);
		  $this->load->view('footer',$data);
	 }

	 
	 function add_new()
	 {
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['quiz']);
			if(!in_array('Add',$acp)){
			exit($this->lang->line('permission_denied'));
			}			

		    if($this->input->post('submit_class')){
			 $data['result'] = $this->liveclass_model->insert_classroom();
			 //redirect('liveclass/edit_class/'.$data['result']);
			 redirect("home_user");
			}
			$data['groups'] = $this->user_model->group_list();
	
			$data['title']="Initiate new class";
		   $this->load->view('header',$data);
		   $this->load->view('add_class',$data);
		  $this->load->view('footer',$data);
	 }
	 
	 
	 function edit_class($class_id)
	 {
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['quiz']);
			if(!in_array('Edit',$acp)){
			exit($this->lang->line('permission_denied'));
			}			

		    if($this->input->post('submit_class')){
			 $this->liveclass_model->update_classroom($class_id);
			 redirect('liveclass/edit_class/'.$class_id);
			}
			$data['class_id']=$class_id;
			$data['groups'] = $this->user_model->group_list($class_id);
			$data['result'] = $this->liveclass_model->get_class($class_id);
			$data['assigned_gids'] = $this->liveclass_model->assigned_groups($class_id);
			$data['title']="Edit class";
		   $this->load->view('header',$data);
		   $this->load->view('edit_class',$data);
		  $this->load->view('footer',$data);
	 }
	 
	  
	 function remove_class($class_id)
	 {
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['quiz']);
			if(!in_array('Remove',$acp)){
			exit($this->lang->line('permission_denied'));
			}			
	 $this->liveclass_model->remove_classroom($class_id);
	 redirect('liveclass');
	}
	
	
		 function close_class($class_id)
	 {
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['quiz']);
			if(!in_array('Edit',$acp)){
			exit($this->lang->line('permission_denied'));
			}			
	 $this->liveclass_model->close_classroom($class_id);
	 redirect('liveclass');
	}
	
	
	
	 function insert_content($class_id)
	 {
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['quiz']);
			if(!in_array('Add',$acp)){
			exit($this->lang->line('permission_denied'));
			}			
	 $this->liveclass_model->insert_content($class_id);
	
	}
	 
	 
	 function insert_comnt($class_id){
	 $this->liveclass_model->insert_comnt($class_id);
	
	 }
	 
	 
	 
	 function fileupload(){
	 
	
	 
	 $target_dir = "./classfiles/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
	 
	 
	 
	 
	 
	 
	 }
	 
	 function attempt($class_id)
	 {
		   $data['groups'] = $this->user_model->group_list($class_id);
			$data['result'] = $this->liveclass_model->get_class($class_id);
			$data['class_id']=$class_id;
			$data['title']=$data['result']['class_name'];
		   $this->load->view('header',$data);
		$logged_in =$this->session->userdata('logged_in');
		  if($this->liveclass_model->validategid($logged_in['gid'],$class_id)==false){
		  $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('class_not_assigned')." </div>");
		  redirect('liveclass');
		 }
		if(in_array('All',explode(',',$logged_in['setting']))){
 	
		  $this->load->view('attempt_class',$data);
		  }else{
			  
		    $this->load->view('attempt_class_reader',$data);
				  
		  }
		  $this->load->view('footer',$data);
	 }
	 


	 function live_streaming($class_id,$SQLc_session_id=0)
	 {
		   $data['groups'] = $this->user_model->group_list($class_id);
			$data['result'] = $this->liveclass_model->get_class($class_id);
			$data['class_id']=$class_id;
			$data['title']=$data['result']['class_name'];
		   $this->load->view('header',$data);
		$logged_in =$this->session->userdata('logged_in');
		 if($this->liveclass_model->validategid($logged_in['gid'],$class_id)==false){
		  $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('class_not_assigned')." </div>");
		  redirect('liveclass');
		 }
		 $data['SQLc_session_id']=$SQLc_session_id;
		 $this->load->view('live_streaming',$data);
		 
		if(in_array('All',explode(',',$logged_in['setting']))){
  }else{
		}
		  $this->load->view('footer',$data);
	 }
	 

	 function view($class_id)
	 {
		   $data['groups'] = $this->user_model->group_list($class_id);
			$data['result'] = $this->liveclass_model->get_class($class_id);
			$data['comments'] = $this->liveclass_model->get_coment($class_id);
			$data['class_id']=$class_id;
			$data['title']=$data['result']['class_name'];
		   $this->load->view('header',$data);
		$logged_in =$this->session->userdata('logged_in');
		
		    $this->load->view('view_class',$data);
		
		  $this->load->view('footer',$data);
	 }


	function get_class_content($class_id){

$result=$this->liveclass_model->get_class($class_id);
print_r($result['content']);

	}
	 
	 
	 function get_ques_content($class_id){
	 $data['result']=$this->liveclass_model->get_coment($class_id);
	 
	 $this->load->view('comnt_data',$data);
	 
	 }
	 
	 function del_comnt(){
			$logged_in=$this->session->userdata('logged_in');
                        $acp=explode(',',$logged_in['quiz']);
			if(!in_array('Edit',$acp)){
			exit($this->lang->line('permission_denied'));
			}			
	 $this->liveclass_model->del_coment();
	 
	 }
	  function publish_comnt(){
	  $logged_in =$this->session->userdata('logged_in');
		if($logged_in['su']!="1"){
		exit('Permission denied!');
		}		
	 $this->liveclass_model->publish_comnt();
	 
	 }
	 
     

     function manage_liveclass(){
     	$data['data'] = $this->api_model->liveclass_list();
		header('Content-Type: application/json');
		echo json_encode($data);
     }

     function get_student_lc($class_id){
     	$data['data'] = $this->api_model->get_student_lc($class_id);
		header('Content-Type: application/json');
		echo json_encode($data);
     }
     
     function get_student_lc_rm($class_id){
     	$data['data'] = $this->api_model->get_student_lc_rm($class_id);
		header('Content-Type: application/json');
		echo json_encode($data);
     }

     function add_student_lc($class_id, $student_id){
     	 $this->liveclass_model->add_student_lc($class_id, $student_id);

     }

      function remove_student_lc($class_id, $student_id){
     	 $this->liveclass_model->remove_student_lc($class_id, $student_id);

     }


}

?>


















