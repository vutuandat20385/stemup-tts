<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendrecommend extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	   	$this->load->database();
	   	$this->load->helper('url');
	   	$this->load->model("quiz_model");
	   	$this->lang->load('basic', $this->config->item('language'));

	}

	public function index($key){
		 // config email
	   if($key=='58wpmpq3lp6nrh4seqsmqw99f2lprglpl7ynl3my3ak4qdegti0je3yu8iodtvaa'){
			$this->load->library('email');
			
			
			 //data
			 
             $this->db->distinct();
			 $this->db->select("email2,uid");
			 $this->db->like("email2","@");
			 $this->db->where("auth_email","1");
			 $this->db->where("subscribe >","0");
			// $this->db->limit(1500);
			// $this->db->offset(200);
			 $users= $this->db->get("savsoft_users")->result_array();

			 
			 $limit =30;
			$this->db->where("deleted",0);
			$this->db->where("status",1);
			$this->db->where("fun_priory >",1);
			$this->db->like("question","<img");
			$this->db->limit($limit);
			$this->db->order_by("rand()");
			$this->db->join("savsoft_permalink", "savsoft_permalink.content_id=savsoft_qbank.qid and savsoft_permalink.model='qbank' ");
			$data=$this->db->get("savsoft_qbank")->result_array();
			
			for($i=0; $i<count($data); $i++){
				preg_match_all('/<img[^>]+>/i',$data[$i]['question'], $imgTags); 
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
					
				 }
				 if(strpos($origImageSrc, '..')!==false){
					 $pos= strpos($origImageSrc, '/upload');
					 $origImageSrc=base_url(). substr($origImageSrc,$pos);
				 }
				 
				 $data[$i]['img']=$origImageSrc;
			 
			 
				$this->db->where("qid",$data[$i]['qid']);
				$data[$i]['option']=$this->db->get("savsoft_options")->result_array();
			 }
			 $limit_quiz=20;
			 $quiz=$this->quiz_model->get_quiz_right_bar($limit_quiz);
          
			 if($this->config->item('protocol')=="smtp"){
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = $this->config->item('smtp_hostname');
				$config['smtp_user'] = $this->config->item('smtp_username');
				$config['smtp_pass'] = $this->config->item('smtp_password');
				$config['smtp_port'] = $this->config->item('smtp_port');
				$config['smtp_timeout'] = $this->config->item('smtp_timeout');
				$config['mailtype'] = $this->config->item('smtp_mailtype');
				$config['starttls']  = $this->config->item('starttls');
				$config['newline']  = $this->config->item('newline');
				
				$this->email->initialize($config);
			}
					
			$fromemail=$this->config->item('fromemail');
			$fromname=$this->config->item('fromname');
			//create email

			for($k=0; $k<count($users); $k++){
				
				
				$j = rand(0,$limit-1);
				$qr = rand(0,$limit_quiz-1);
				$qr1=($qr+1)%$limit_quiz;
				
				$toemail=$users[$k]['email2'];
				//$toemail="tao.tran@dtt.vn";
				//$toemail="tuan.le@dtt.vn";
				$subject= "Câu hỏi hàng ngày từ hệ sinh thái stem.vn";
				$content=file_get_contents('./template_email/send_recommend.html');
				
				$content=str_replace("[[question]]", strip_tags($data[$j]['question']), $content);
				$content=str_replace("[[link_img_qt]]", $data[$j]['img'], $content);
				$content=str_replace("[[link_question]]", site_url()."/page/question/".$data[$j]['permalink']."/notsolved", $content);
				
				$content=str_replace("[[answer_A]]", strip_tags($data[$j]['option'][0]['q_option']), $content);
				$content=str_replace("[[answer_B]]", strip_tags($data[$j]['option'][1]['q_option']), $content);
				if(trim(strip_tags($data[$j]['option'][2]['q_option']))!=""){
					$content=str_replace("[[answer_C]]", strip_tags($data[$j]['option'][2]['q_option']), $content);
				}
				else{
					
					$content=str_replace("[[style_ansC]]", "display:none", $content);
				}
				if(trim(strip_tags($data[$j]['option'][3]['q_option']))!=""){
					$content=str_replace("[[answer_D]]", strip_tags($data[$j]['option'][3]['q_option']), $content);

				}
				else{
					$content=str_replace("[[style_ansD]]", "display:none", $content);
					
				}
				
				$content=str_replace("[[quiz_1]]", $quiz[$qr]['quiz_name'], $content);
				$content=str_replace("[[link_quiz_1]]", site_url()."/page/quiz/".$quiz[$qr]['permalink'], $content);
				$content=str_replace("[[link_img_quiz_1]]", $quiz[$qr]['img'], $content);
				
				$content=str_replace("[[quiz_2]]", $quiz[$qr1]['quiz_name'], $content);
				$content=str_replace("[[link_quiz_2]]", site_url()."/page/quiz/".$quiz[$qr1]['permalink'], $content);
				$content=str_replace("[[link_img_quiz_2]]", $quiz[$qr1]['img'], $content);
				
				$content=str_replace("[[uid]]", $users[$k]['uid'], $content);
				$content=str_replace("[[usercode]]", $users[$k]['user_code'], $content);
				
				$this->email->to($toemail);
				$this->email->from($fromemail, $fromname);
				$this->email->subject($subject);
				$this->email->message($content);
				if(!$this->email->send()){
			   
				}
			}	
				
	   }		
				
		echo "success";	
	}




}
?>
