<?php
Class Dashboard_model extends CI_Model{
	 function num_users(){
		 $us = $this->session->userdata('logged_in'); 
		 if($us["su"]==1){
			$query=$this->db->get('savsoft_users');
		 }
		return $query->num_rows();
	 }
	 
	 function num_student(){
		 $us = $this->session->userdata('logged_in'); 
		 if($us["su"]==1){
			 $this->db->where("su", 2);
			$query=$this->db->get('savsoft_users');
		 }
		return $query->num_rows();
	 }
	 
	 function num_teacher(){
		 $us = $this->session->userdata('logged_in'); 
		 if($us["su"]==1){
			 $this->db->where("su", 3);
			$query=$this->db->get('savsoft_users');
		 }
		return $query->num_rows();
	 }
	 function num_qbank(){
		 $us = $this->session->userdata('logged_in'); 
		 if($us["su"]==1){
			$this->db->where("deleted", 0);
			$query=$this->db->get('savsoft_qbank');
		 }
		return $query->num_rows();
	 }
	 function num_quiz(){
		 $us = $this->session->userdata('logged_in'); 
		 if($us["su"]==1){
			 $this->db->where("deleted", 0);
			  $this->db->where("noq >", 0);
			$query=$this->db->get('savsoft_quiz');
		 }
		return $query->num_rows();
	 }
	 
	 
	
}	