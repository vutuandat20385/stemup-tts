<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	function __construct()
	{
	   	parent::__construct();
	   	$this->load->database();
	   	$this->load->model("review_model");
	   	$this->lang->load('basic', $this->config->item('language'));
	}


	public function review_item($reviewid, $model, $rvalue, $rcontent){
		$rcontent = $this->input->post('rcontent');
		$data['result'] = "new";
		if($rvalue != ''){
			if($this->review_model->review_item($reviewid, $model, $rvalue, $rcontent)){
				$data['review'] = $this->review_model->get_review($reviewid, $model);
				$data['result'] = "success";
			}else{
				$data['result'] = "error";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function update_review_item($reviewid, $model, $reid, $rvalue, $rcontent){
		$rcontent = $this->input->post('rcontent');
		$data['result'] = "new";
		if($rvalue != ''){
			if($this->review_model->update_review($reid, $rvalue, $rcontent)){
				$data['review'] = $this->review_model->get_review($reviewid, $model);
				$data['result'] = "success";
			}else{
				$data['result'] = "error";
			}
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function get_review($reviewid, $model){
		$data['review'] = $this->review_model->get_review($reviewid, $model);
		$data['user']=$this->session->userdata('logged_in');
		header('Content-Type: application/json');
		echo json_encode($data);
	}

}
?>
