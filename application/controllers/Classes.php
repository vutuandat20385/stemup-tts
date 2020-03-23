<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classes extends CI_Controller {

	 function __construct(){
	   	parent::__construct();
		$this->load->database();
	     $this->load->helper('url');
	   	$this->load->model('classes_model');
	
	   	$this->load->model('notify_model');
		$this->load->model('user_model','',TRUE);
		$this->lang->load('basic', $this->config->item('language'));
       
	 }
     function t(){
		 $s= '<p><iframe style="border: none; overflow: hidden;" src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fstem.vn%2Fvideos%2F2154350601513221%2F&amp;show_text=0&amp;width=476" width="476" height="476" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe></p>
<p>Lực g&igrave; khiến đinh rơi đ&uacute;ng chai?</p>';
		     $origvidSrc="";
			 preg_match_all('/<iframe[^>]+>/i',$s, $vidTags); 

			 if(count($vidTags)>0){
				echo $vidTags[0][0].'</iframe>';
				echo 1;
				
			}
	 }
	 
	 function ts(){
		 $this->load->view('library/simulation');
	 }
	 
	  function t2(){
		$this->load->view('rule/test');
	 }
	 
	   function t3(){
		$this->load->view('rule/test');
	 }
	 

	 function test(){
		 $handle = fopen($_SERVER['DOCUMENT_ROOT']."/upload/feature_image/test1.jpg", "w+");
		 $str=' <p><iframe style="border: none; overflow: hidden;" src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fstem.vn%2Fposts%2F2143067245974890&amp;width=500" width="500" height="501" frameborder="0" scrolling="no"></iframe></p>
       ';
		    $origvidSrc="";
			 preg_match_all('/<iframe[^>]+>/i',$str, $vidTags); 
			 for ($j = 0; $j < count($vidTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$vidTags[0][$j], $video);
				$origvidSrc = str_ireplace( 'src="', '',  $video[0]);
				
			 }
			 //echo $origvidSrc;
			 $link="";
			 $pos= strpos($origvidSrc,"https://www.youtube.com/embed/");
			 if($pos!==false){
				$link = str_replace('https://www.youtube.com/embed/','https://img.youtube.com/vi/',$origvidSrc);
				$pos2= strpos($link,"?");
				$link=substr($link,0,$pos2)."/hqdefault.jpg";
				//echo $link;
							 
			 }
			 $pos= strpos($origvidSrc,"https://www.facebook.com");
			 if($pos!==false){
				$pos2= strpos($origvidSrc,"videos%2F");
				if($pos2!==false)
					$link=substr($origvidSrc,$pos2+9);
				
			    $pos3 =strpos($link,"%2F");
				$link=substr($link,0,$pos3);
				$link='https://graph.facebook.com/'.$link.'/picture';
				echo $link;
			 }
             //if($link!=''){
			//	  $data= file_get_contents($link);
            //     fwrite($handle, $data);
			// }	 
			 
		
	 }
	 function get_class(){
         $data['data'] = $this->classes_model->get_class();
	     header('Content-Type: application/json');
      	
		 echo json_encode($data);
	 }
     
     function get_student($class_id){
      	$data['data'] = $this->classes_model->get_student($class_id);
	     header('Content-Type: application/json');
      	
		 echo json_encode($data);
     }
     
	 function get_member($class_id){
      	$data['data'] = $this->classes_model->get_member($class_id);
	     header('Content-Type: application/json');
      	
		 echo json_encode($data);
     }
     function get_student_rm($class_id){
      	$data['data'] = $this->classes_model->get_student_rm($class_id);
	     header('Content-Type: application/json');
      	
		 echo json_encode($data);
     }

     function remove_student($class_id_rm, $student_id){
      	$this->classes_model->remove_student($class_id_rm, $student_id);
     }
     function add_student($class_id, $student_id){
      	$this->classes_model->add_student($class_id, $student_id);
     }
     
	 function get_student_1($class_id,$search=""){
		$data = $this->classes_model->get_student_1($class_id,$search);
	     header('Content-Type: application/json');
		 echo json_encode($data);
	}
	function check_user_class(){
		$user = $this->session->userdata('logged_in');
		$inp = json_decode($this->input->raw_input_stream,true);
		$inp['check'] = $this->classes_model->check_user_class($inp['class_id'],$inp['uid']);
		header('Content-Type: application/json');
		echo json_encode($inp);
	}
	function join_class(){
		$user = $this->session->userdata('logged_in');
		$inp = json_decode($this->input->raw_input_stream,true);
		$inp['check'] = $this->classes_model->join_classst($inp['class_id'],$inp['uid']);
		header('Content-Type: application/json');
		echo json_encode($inp);
	}
     function add_new(){
        $user =$this->session->userdata('logged_in');
      	$data=$this->classes_model->insert_class();
		$content = "Đã tạọ một lớp.";
		$model = "class";
		$action = "new class";
		$nid = $this->notify_model->insert_notify($user['uid'], $content, $model, $action);
		$this->notify_model->insert_notify_user($nid, $user['uid']);
      	$this->session->set_flashdata('message', "<div class='alert alert-success'>Thêm lớp thành công </div>");
		
		header('Content-Type: application/json');
		echo json_encode($data);
        
     }
    
	function load_class($class_id){
		$data = $this->classes_model->load_class($class_id);
		header('Content-Type: application/json');
		echo json_encode($data);
		
	}
	
	
	function write_post($class_id, $parent_id=0){
		$this->classes_model->write_post($class_id, $parent_id);

		
	}
	function load_discussion($class_id, $pivot, $max_post=5){
		$data=$this->classes_model->load_discussion($class_id, $pivot, $max_post);
		header('Content-Type: application/json');
		echo json_encode($data);
		
	}
	
	function load_reply($parent_id, $pivot, $max_post=5){
		$data=$this->classes_model->load_reply($parent_id, $pivot, $max_post);
		header('Content-Type: application/json');
		echo json_encode($data);
		
	}
	function deleteclass_ofteacher($classid){
		$data=$this->classes_model->deleteclass_ofteacher($classid);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
    function class_of_teacher($classid){
		$data=$this->classes_model->class_of_teacher($classid);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	function level_class(){
		$data=$this->classes_model->level_class();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	function category_class(){
		$data=$this->classes_model->category_class();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	function determine_class(){
		$inp = json_decode($this->input->raw_input_stream,true);
		$data=$this->classes_model->determine_class($inp['class_id'],$inp['name'],$inp['lid'],$inp['cid']);
		header('Content-Type: application/json');
		echo json_encode($data);
		
		
	}
}

?>


















