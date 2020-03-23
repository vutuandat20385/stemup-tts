<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribe extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	   	$this->load->database();
	   	$this->load->helper('url');
	   	$this->load->model("quiz_model");
	   	$this->lang->load('basic', $this->config->item('language'));

	}

	public function unsubscribed($uid, $usercode){
	   $this->db->where('uid', $uid);
	   $this->db->where('user_code', $usercode);
	   $this->db->update("savsoft_users", array("subscribe"=>0));	   
	   redirect('profile');
	}




}
?>
