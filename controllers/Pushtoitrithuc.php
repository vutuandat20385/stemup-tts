<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pushtoitrithuc extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	   	$this->load->database();
	   	$this->load->helper('url');
	   	$this->load->model("quiz_model");
	   	$this->lang->load('basic', $this->config->item('language'));

	}


	public function push($key, $limit=100, $offset=0){
		
	   if($key=='3r4j34yfub2qhd6fdua0edw5hcqzf6w77m9qafkc0ryqjilxkqt72mpq22hlokjlh2fujdlf8l3nwouz'){
		     /* 3 toán      1
              12 tieng anh 2
              5  hoa hoc   3
              4  vat ly    4 
              8  sinh      5
              17 văn       6
              10 ls        7
              6  dl        8
              7  tin       9
              11 cn        10
              21 gdcd      11
              22 tnxh      12
              9  kh        13
 			     ls &dl    14
			     kt        15
			  18 tv        16
			     dd        17
			
			*/
		    $this->load->library('Curl');
            $url = 'http://tracnghiem.itrithuc.vn/api/question/submit?api_key=rnCtS8RVSlAyPHgfmb7xGnzTvRA9ApNT';
			$mapping_category = array("3"=>1,
			                          "12"=>2,
									  "5"=>3,
									  "4"=>4,
									  "8"=>5,
									  "17"=>6,
									  "10"=>7,
									  "6"=>8,
									  "7"=>9,
									  "11"=>10,
									  "21"=>11,
									  "22"=>12,
									  "9" => 13,
									  "18"=>16,
									  
										);
			
			//$qid= "62547";
			//$this->db->where("qid",$qid);
			//fun
			/*$this->db->where("deleted",0);
			$this->db->where("status",1);
			$this->db->where("fun_priory >", 1);
			$this->db->limit($limit);
			$this->db->offset($offset);
			$this->db->order_by("qid desc");
            $qs =$this->db->get("savsoft_qbank")->result_array();*/
			
			//lop 101112
			
			$this->db->where("deleted",0);
			$this->db->where("status",1);
			$this->db->where("fun_priory <", 2);
			$this->db->where("lid", 13);
			$this->db->where("cid", 10);
			$this->db->limit($limit);
			$this->db->offset($offset);
			$this->db->order_by("qid desc");
            $qs =$this->db->get("savsoft_qbank")->result_array();
			
			foreach($qs as $q){
				$this->db->where("qid",$q['qid']);
				$o = $this->db->get("savsoft_options")->result_array();
				
				
				$subject = $mapping_category[$q["cid"]];
				
				if(!$subject)
					$subject=0;
				
				$grade = $q["lid"]-2;
				if(strpos($htmlContent,'latex.codecogs.com')===false){
				    $question = strip_tags($q['question']);
				}
				else
					$question = $q['question'];
				$answer1 = strip_tags($o[0]['q_option']);
				$answer2 = strip_tags($o[1]['q_option']);
				$answer3 = strip_tags($o[2]['q_option']);
				$answer4 = strip_tags($o[3]['q_option']);
				
				
				for($i=0; $i<4; $i++){
					if($o[$i]['score']>0){
						$correct_answer = $i+1;
					}
				}
				
				$question_image="";
				if(strpos($htmlContent,'latex.codecogs.com')===false){
					$origImageSrc="";
					$imgTags="";	
					$htmlContent=$q['question'];
					preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
					for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
						
					 }
					 $origImageSrc=str_replace("..",base_url(),$origImageSrc);
					 if($origImageSrc){
						$question_image=$origImageSrc;
					 }
				}
				
				
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, true);
			   
				
				$datap = array(
					'subject' => $subject,
					'grade' => $grade,
					'chapter_id' => 0,
					'level' => 3,
					'question'=>$question,
					'answer1'=>$answer1,
					'answer2'=>$answer2,
					'answer3'=>$answer3,
					'answer4'=>$answer4,
					'question_image'=>$question_image,
					'correct_answer'=>$correct_answer,
					'explanation'=>""
					
				);

				curl_setopt($ch, CURLOPT_POSTFIELDS, $datap);
				$output = curl_exec($ch);
				$info = curl_getinfo($ch);
				curl_close($ch);
				print_r($output);
				echo $q['qid'].'<br/>';
            }  
					
			  
			
	   }	
	}




}
?>
