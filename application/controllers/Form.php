<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	function __construct()
	{
	   	parent::__construct();
	   
	}

    function hocvienstem(){
		$this->load->view("form/hocvienstem");
	}
	

}
?>
