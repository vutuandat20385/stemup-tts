<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tesst extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	   	$this->load->database();
	   	$this->load->helper('url');
	   	$this->load->model("msg_messages_model");
	   	$this->load->model("notify_model");
	   	$this->load->model("post_model");
		$this->load->model("qbank_model");
		$this->load->model("quiz_model");
		$this->load->model("api_model");
	   	$this->lang->load('basic', $this->config->item('language'));

	}
	
	function test_studentquiz(){
		$user= $this->session->userdata('logged_in');
		$data= $user;
		$data['results']= $this->api_model->list_question_assign("",0,10,0,0);
			$data['results1']= $this->api_model->list_question_assign2("",0,10,0,0);
			$data['num_result']= $this->api_model->num_question_assign();
			$data['num_result1']= $this->api_model->num_question_assign2(); 			
			$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);
			$data['limit']= 10;
			$data['page']=0;
			$data['cid']=0;
			$data['uid']=0;
			$data['num_page']=ceil($data['num_result']/$data['limit']);	
			$data['num_page1']=ceil($data['num_result1']/$data['limit']);
		$this->load->view("stemup/assign_quiz_student",$data);
		
	}
	function xt(){
		
		$user= $this->session->userdata('logged_in');
		
		if(!$user){
			$this->load->view("stemup/header");
			$this->load->view("stemup/login");
			$this->load->view("stemup/footer");
		}
		else{
			redirect('tesst/xt2');
		}
	}
	
	function xt2(){
		
		$user= $this->session->userdata('logged_in');
		//if($user){
			$data= $user;
			if(!$data['photo']){
				$data['photo']= base_url('upload/avatar/default.png');
			}
		//	$this->load->view("stemup/header", $data);
			
			$this->load->view("stemup/main", $data);
			//$this->load->view("stemup/footer", $data);
		//}
		//else{
		//	redirect('tesst/xt');
		//}
	}
	
	function input_timetable(){
		$data['categs']=$this->db->get('savsoft_category')->result_array();
		$this->load->view('tesst', $data);
		
		
	}
	
	
	function get_q2($limit,$offset){
	 $this->db->select("qid");
	  $this->db->where("lid",8);
	  $this->db->where("cid",8);
	  $this->db->where("deleted",0);
	  $this->db->where("status",1);
	  $this->db->order_by("qid asc");
	   //$this->db->not_like("question","iframe");
	  $this->db->limit($limit);
	  $this->db->offset($offset);
	  $data=$this->db->get("savsoft_qbank")->result_array();
	  for($i=0; $i<count($data); $i++){
		  $this->db->select('tag_name');
		  $this->db->where('question_id',$data[$i]['qid']);
		  $this->db->join('question_tag_rel', 'question_tag_rel.tag_id=tags.tag_id');
		   $d=$this->db->get('tags')->result_array();
		   $strt="";
		   for($j=0; $j<count($d); $j++){
			   if($j!=0)
					$strt.=",";
			   $strt.=$d[$j]['tag_name'];
			   $data[$i]['key_words']= $strt;
		   }
	  }
	  echo json_encode($data);
 }
 
 function get_q($limit,$offset){
	  $this->db->select("qid");
	  
	  $this->db->where("lid",8);
	  $this->db->where("cid",8);
	  $this->db->where("deleted",0);
	  $this->db->where("status",1);
	   $this->db->order_by("qid asc");
	 // $this->db->not_like("question","iframe");
	  $this->db->limit($limit);
	  $this->db->offset($offset);
	  $data=$this->db->get("savsoft_qbank")->result_array();
	  for($i=0; $i<count($data); $i++){
		  $this->db->where("qid", $data[$i]['qid']);
		  $d=$this->db->get("savsoft_options")->result_array();
		  for($j=0; $j<count($d);$j++){
			  $data[$i]['option_'.$j]=$d[$j]['q_option'];
			  if($d[$j]['score']>0){
				  $data[$i]['correct']=$j;
			  }
		  }
	  }
	  echo json_encode($data);
 }
 
 function x($domain){
	 include 'Classes/simple_html_dom.php';
	 if($domain=="truyencotich.top"){
		 $html = file_get_html('https://truyencotich.top/doc-truyen/su-tich-bong-hoa-cuc');
		 //img
		 foreach($html->find('img') as $element) {
		  // echo $element->src;
		 }
		 
		 //noi dung
		 foreach($html->find('.article-post') as $element) {
		   //echo $element->plaintext;
		  // echo $element->innertext;
		 }
		 foreach($html->find('.posttitle') as $element) {
		   //echo $element->plaintext;
		   echo $element->innertext;
		 }
	 }
	 
	 if($domain=="truyenchocon.com"){
		 $html = file_get_html('https://truyenchocon.com/doc-truyen/ban-than.html');
		 //img
		 foreach($html->find('img') as $element) {
		     //echo $element->src;
		 }
		 
		 //noi dung
		 foreach($html->find('root') as $element) {
		   //echo $element->plaintext;
			//echo $element->innertext;
		 }
		 foreach($html->find('.ebook_title') as $element) {
		   //echo $element->plaintext;
		   //echo $element->innertext;
		 }
	 }
	 
	 if($domain="x"){
		 $html = file_get_html("https://truyencotich.top/sitemap.xml");
		 foreach($html->find('loc') as $element) {
		     echo "https://truyencotich.top/".$element->innertext.'<br>';
		 }
	 }
	
	 
 }
 
 function crawl($limit=10, $offset=0){
	 include 'Classes/simple_html_dom.php';
	 $this->db->limit($limit);
	 $this->db->offset($offset);
	 $data=$this->db->get("reading_material_2")->result_array();
	 foreach($data as $a){
		 
		 if($a['domain']=="https://truyencotich.top/"){
			 $html = file_get_html($a['link']);
			 $img="";
			 foreach($html->find('img') as $element) {
			   
			   $img=$element->src;
			 }
			 foreach($html->find('.article-post') as $element) {
				$content= $element->innertext;
			 }
			 foreach($html->find('.posttitle') as $element) {
			   $title = $element->innertext;
			 }
	     }
		 
		 if($a['domain']=="https://truyenchocon.com/"){
			 $html = file_get_html($a['link']);
			 //foreach($html->find('img') as $element) {
			   //$img=$element->src;
			 //}
			 foreach($html->find('root') as $element) {
				$content= $element->innertext;
			 }
			  foreach($html->find('.ebook_title') as $element) {
			   $title = $element->innertext;
			 }
	     }
		 
		 $f= array("content"=>$content,
		           "title"=>$title,
				   "img"=>$img,
			);
			
		$this->db->where("rdid",$a['rdid']);	
	    $this->db->update("reading_material_2", $f);
	 }
	 echo "success";
 }
 
 function check(){
	 $data=$this->db->get("reading_material")->result_array();
	 foreach($data as $a){
		 
		$this->db->where("link",$a['link']);	
	    $this->db->update("reading_material_2", array("status"=>1));
	 }
	 echo 1;
 }
 
 function f(){
	 
   
	$this->db->where('sid >',24867);
	$this->db->where('content IS NULL');
	$this->db->limit(60);
	$this->db->order_by("sid asc");
	$dt= $this->db->get("reading_material_3")->result_array();
	foreach($dt as $k=>$data){
		$sid=$data['sid'];
		$json = file_get_contents("http://192.168.11.186:8080/wp-json/wp/v2/posts/".$sid);
		if($json){ 
			$data2 =json_decode( $json, true);
			$content= $data2['content']['rendered'];
			$this->db->where('sid', $sid);
			$this->db->update("reading_material_3", array("content"=>$content));
		}
		echo $sid.'<br>';
	}
	
 }
 
 function ft(){
	$this->db->like('img',"|");
	$this->db->limit(600);
	$this->db->order_by("sid asc");
	$dt= $this->db->get("reading_material_3")->result_array();
	foreach($dt as $k=>$data){
		$sid=$data['sid'];
		
			
		$imgs= explode("|",$data['img']);
		$this->db->where('sid', $sid);
		$this->db->update("reading_material_3", array("img"=>$imgs[0]));
		
		echo $sid.'<br>';
	}
	
 }
	
}