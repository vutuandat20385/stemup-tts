<?php
class Rulepoint extends CI_Controller{

 function __construct()
	 {
	   parent::__construct();
		    $this->load->database();
		    $this->lang->load('basic', $this->config->item('language'));
		    $this->load->helper('url');
	    	$this->load->model('rulepoint_model');

	 }



 public function index(){
	$login=$this->session->userdata('logged_in');
    $role=$login['su'];
 	$data['rule_list']=$this->rulepoint_model->rule_list();
 	$data['title']=$this->lang->line('rule_point_change');
 	$data['role']=$role;
    $this->load->view('header', $data);
	$this->load->view('rule/rulepoint', $data);


 }


  public function insert_rule(){
    $login=$this->session->userdata('logged_in');
    $role=$login['su'];
    if($role==1){
    
	  	if($this->rulepoint_model->insert_rule()){
	   		 $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
		}else{
		 	$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
				
		}

    }
    redirect('/rulepoint');
 }


 public function delete_rule($id){
    $login=$this->session->userdata('logged_in');
    $role=$login['su'];
    if($role==1){
    	$this->rulepoint_model->delete_rule($id);
    }
    redirect('/rulepoint');


 }


public function edit_rule($id){
    $login=$this->session->userdata('logged_in');
    $role=$login['su'];
	if($role==1){
		$data['rule_list']=$this->rulepoint_model->rule_list();
	 	$data['title']=$this->lang->line('edit_rule_point_change');
	    $data['id']=$id;
	    $this->load->view('header', $data);
		$this->load->view('rule/edit_rule',$data);
    }
    else{
    	redirect('/rulepoint');
    }
	

}

public function save_rule($id){
    $login=$this->session->userdata('logged_in');
    $role=$login['su'];
    if($role==1){
    	$this->rulepoint_model->save_rule($id);
    }
    redirect('/rulepoint');

	

} 
public function test(){
	$this->db->select("question,qid");
    $ts=$this->db->get("savsoft_qbank")->result_array();
	$s2= "<p>T&igrave;m x biết: 8462 - x = 76</p>";
	$check="";
	foreach($ts as $t){
		$sim = similar_text($t['question'], $s2, $perc);
		if($perc>90){
		    echo $perc;
			$check.=$t['qid'];
			echo "<br/>".$t['question'];
			//break;
		}
			
	}
    

}

}
