<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trending_tags extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	   	$this->load->database();
	   	$this->load->helper('url');
	   	$this->load->model("msg_messages_model");
	   	$this->load->model("notify_model");
	   	$this->load->model("post_model");
	   	$this->lang->load('basic', $this->config->item('language'));

	}
    function calculate($page=0){
		$lastmonth =date('Y-m-d H:i:s', strtotime('-30day'));
		$limit=10;
		$maxlength=10;
	    $sql= "select  B.tag_id ,SUM(A.count_ans) as count  FROM ";
        $sql.=" ((select qid , count(*) as count_ans from savsoft_answer_mcq where create_date > '".$lastmonth. "' GROUP BY qid ) as A";
        $sql.=" inner join "; 
        $sql.=" (select tag_id,question_id from question_tag_rel where tag_id in (select tag_id from tags where blacklist=0 and length(tag_name)<=$maxlength)) as B";
        $sql.=" on A.qid= B.question_id )"; 
      
        $sql.=" GROUP BY B.tag_id ";
        $sql.=" ORDER BY count desc ";
		$sql.=" limit ". $limit ;
		$sql.=" Offset ".($limit*$page) ;
		$data= $this->db->query($sql)->result_array();	
		
		$str="";
		for($i=0; $i<count($data); $i++){
			if($i!=0)
				$str.=",";
			$str.=$data[$i]['tag_id'];
		}
		if($str!=""){
		   $sql = "select * from tags where tag_id in (".$str.")";
	        $data_tags= $this->db->query($sql)->result_array();	
		}
		
		for($i=0; $i<count($data); $i++){
			for($j=0; $j<count($data_tags); $j++){
				if($data[$i]['tag_id']==$data_tags[$j]['tag_id'])
					$data[$i]['tag_name']=$data_tags[$j]['tag_name'];
			}
        }
		for($i=0; $i<count($data); $i++){
			$sql ="select question_id as qid from question_tag_rel qtr where qtr.tag_id=".$data[$i]['tag_id'];
			$sql .=" order by rand() ";

			$qid= $this->db->query($sql)->row_array()['qid'];
			
			$sql ="select question from savsoft_qbank where qid=$qid";

			$question= $this->db->query($sql)->row_array()['question'];
			$htmlContent=$question;

			$data[$i]['img']=base_url("upload/default_image_quiz.png");
			$origImageSrc="";
			if(strpos($htmlContent,'latex.codecogs.com')===false && strpos($htmlContent,'www.w3.org/1998/Math/MathML')===false ){
				 $origvidSrc="";
				 
				 preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				 for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				 }
				 if($origImageSrc)
					$data[$i]['img']=str_replace("../upload",base_url(),$origImageSrc);
					
				}
		    
		}
		$this->db->update("tags", array("istrend"=>0));
		for($i=0; $i<count($data); $i++){
			$this->db->where("tag_id", $data[$i]['tag_id']);
			$image=$this->db->get("tags")->row_array()['image'];
			if($image==base_url("upload/default_image_quiz.png") || !$image){
				$image= $data[$i]['img'];
			}
			if($image !=base_url("upload/default_image_quiz.png") && $data[$i]['img'] != base_url("upload/default_image_quiz.png")){
				$image= $data[$i]['img'];
			}
			if(strpos($image,"&")!==false){
				$image= base_url("upload/default_image_quiz.png");
			}
			
			$this->db->where("tag_id", $data[$i]['tag_id']);
			$this->db->update("tags", array("istrend"=>1, "image"=>$image));
		}
	    header('Content-Type: application/json');
		echo json_encode($data);
    }
}
?>