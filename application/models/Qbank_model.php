<?php
Class Qbank_model extends CI_Model
{


	function load_question_shingles($search){

		$this->db->select("question,qid");

		$ss = explode("-",$search);

		$this->db->like("question", $ss[0])->where('savsoft_qbank.deleted',0);
		$this->db->or_like("question", $ss[1])->where('savsoft_qbank.deleted',0);
	//  $this->db->where('savsoft_qbank.deleted',0);

	 // foreach($ss as $s){
	//	  $this->db->or_like("question", $s);
	 // }
	  //$this->db->like("question", $search);
		$data=$this->db->get("savsoft_qbank")->result_array();
		for($i=0; $i<count($data); $i++){
			$data[$i]['question']= strip_tags($data[$i]['question']);
			$data[$i]['question']= str_replace("?", "",$data[$i]['question']);
			$data[$i]['question']= trim($data[$i]['question']);
		  //$datas[$i]= explode(" ",$data[$i]['question']);

		}
		return $data;
	}

	public function get_mcq_fun($pivot=0, $limit=5, $cid=0, $lid=0, $search=""){
		$user=$this->session->userdata('logged_in');
		$interest_cid=0;
		if($user){
			$this->db->select("qid");
			$this->db->where("uid",$user['uid']);
			$ans_qids= $this->db->get('savsoft_answer_mcq')->result_array();
			$araq=array();
			foreach($ans_qids as $aq){
				array_push($araq, $aq['qid']);
			}
			if($cid==0){
				$this->db->select("interest_cat_ids");
				$this->db->where("uid", $user['uid']);
				$dtus= $this->db->get("savsoft_users")->row_array();
				if($dtus["interest_cat_ids"]){
					$interest_cid=$dtus["interest_cat_ids"];
				}
			}
		}
		if($cid==0 && $lid==0 && $search=="" && $interest_cid==0){
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$lw=strtotime("-7 days");
			$lwstr= date("Y-m-d H:i:s", $lw);
			$this->db->select("qid,cid");
			$this->db->where("savsoft_qbank.fun_priory >", 1);	
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			if($araq){
				$this->db->where_not_in('savsoft_qbank.qid',$araq);
			}
			$this->db->order_by('create_date DESC');
			$dtq=$this->db->get("savsoft_qbank")->result_array();
			$count=2;
			$i=2;
			$idfs = array();
			$idct = array();
			array_push($idfs,$dtq[0]["qid"],$dtq[1]["qid"]);
			array_push($idct,$dtq[0]["cid"],$dtq[1]["cid"]);
			while($count<$limit && $i<count($dtq)){
				if(!in_array($dtq[$i]['cid'],$idct)){
					array_push($idfs,$dtq[$i]["qid"]);
					array_push($idct,$dtq[$i]["cid"]);
					$count++;
				}
				$i++;
			}
			
			$this->db->where_in("savsoft_qbank.qid", $idfs);	
			$this->db->order_by('create_date DESC');

			$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
			$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
			$data= $this->db->get("savsoft_qbank")->result_array();
			
		}
		else{
			if($interest_cid==0){
				if($pivot>0)		
					$this->db->where("savsoft_qbank.qid <", $pivot);
				if($cid>0){
					$this->db->where("savsoft_qbank.cid", $cid);
				}
				if($lid>0)		
					$this->db->where("savsoft_qbank.lid", $lid);
				if($search!=""){
					$this->db->like("savsoft_qbank.question", $search);
				}
				else{
					if($cid==0){
						$this->db->where("savsoft_qbank.fun_priory >", 1);	
					}
					if($araq){
						$this->db->where_not_in('savsoft_qbank.qid',$araq);
					}
				}
				$this->db->where("deleted", 0);
				$this->db->where("status", 1);
				$this->db->limit($limit);	
				
				$this->db->order_by('create_date DESC');

				$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
				$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');

				$data= $this->db->get("savsoft_qbank")->result_array();
			}else{
				
				if($pivot>0)		
					$this->db->where("savsoft_qbank.qid <", $pivot);
				if($cid>0){
					$this->db->where("savsoft_qbank.cid", $cid);
				}
				if($lid>0)		
					$this->db->where("savsoft_qbank.lid", $lid);
				if($search!=""){
					$this->db->like("savsoft_qbank.question", $search);
				}
				else{
					if($cid==0){
						$this->db->where("savsoft_qbank.fun_priory >", 1);	
					}
					if($araq){
						$this->db->where_not_in('savsoft_qbank.qid',$araq);
					}
				}
				$this->db->where_in("savsoft_qbank.cid", explode(",",$interest_cid));
				$this->db->where("deleted", 0);
				$this->db->where("status", 1);
				$this->db->limit($limit);	
				
				$this->db->order_by('create_date DESC');

				$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
				$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');

				$data= $this->db->get("savsoft_qbank")->result_array();
				if(count($data)<$limit){
					if($pivot>0)		
						$this->db->where("savsoft_qbank.qid <", $pivot);
					if($cid>0){
						$this->db->where("savsoft_qbank.cid", $cid);
					}
					if($lid>0)		
						$this->db->where("savsoft_qbank.lid", $lid);
					if($search!=""){
						$this->db->like("savsoft_qbank.question", $search);
					}
					else{
						if($cid==0){
							$this->db->where("savsoft_qbank.fun_priory >", 1);	
						}
						if($araq){
							$this->db->where_not_in('savsoft_qbank.qid',$araq);
						}
					}
					$this->db->where_not_in("savsoft_qbank.cid", explode(",",$interest_cid));
					$this->db->where("deleted", 0);
					$this->db->where("status", 1);
					$this->db->limit($limit-count($data));	
					
					$this->db->order_by('create_date DESC');

					$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
					$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');

					$data1= $this->db->get("savsoft_qbank")->result_array();
					$data=$data+$data1;
				}
				
			}
		}
		$str_qids="";
		for($i=0; $i<count($data); $i++){
			if($i!=0)
				$str_qids.=",";
			$str_qids.=$data[$i]['qid'];
			
		}
		if($str_qids=="") $str_qids=0;
		$sqlo = "select * from savsoft_options where qid in ($str_qids)";
		$ao = $this->db->query($sqlo)->result_array();

		for($i=0; $i<count($data); $i++){
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			if(strpos($htmlContent,'https://latex.codecogs.com')===false){
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 			
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				}
				$origImageSrc=str_replace("..",base_url(),$origImageSrc);
				if(count($imgTags[0])>0){
					$qt='<div class="imgqtt"><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					$qt.=strip_tags( $data[$i]['question']);
					$data[$i]['question']=$qt;

					$data[$i]['img']=$origImageSrc;
					

				}	
			}				 
			$this->db->select("su,logo,text_license,out_link");
			$this->db->where("uid",  $data[$i]['inserted_by']);
			$qr=$this->db->get("savsoft_users")->row_array();
			$data[$i]['create_su']=$qr['su'];
			$data[$i]['logo']=$qr['logo'];
			$data[$i]['text_license']=$qr['text_license'];
			$data[$i]['out_link']=$qr['out_link'];

			$origvidSrc="";
			$vidTags="";
			preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			if(count($vidTags[0])>0){
				if(strpos($vidTags[0][0], "facebook")!==false){
					$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
				}
				else{
					$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
				}
				$qt.=strip_tags($data[$i]['question']);
				$data[$i]['question']=$qt;
			} 
			$arr_op = array();
			for($j=0; $j<count($ao); $j++){
				if($ao[$j]['qid']== $data[$i]['qid']){
					array_push($arr_op, $ao[$j]);
				}
			}
			
			$data[$i]['options']=$arr_op;
			/*$this->db->where('qid',$data[$i]['qid']);
			$options = $this->db->get('savsoft_options');
			$data[$i]['options']=$options->result_array();*/
			/*$this->db->select('tag_name');
			$this->db->where('question_id',$data[$i]['qid']);
			$this->db->join('question_tag_rel', 'question_tag_rel.tag_id=tags.tag_id');
			$data[$i]['tags']=$this->db->get('tags')->result_array();*/
			$this->db->where('qid',$data[$i]['qid']);
			$data[$i]['n_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$data[$i]['qid']);
			$this->db->where('istrue',1);
			$data[$i]['n_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('uid', $user['uid']);
			$this->db->where('status', 1);
			$data[$i]['liked']=$this->db->get('savsoft_like')->num_rows();
			
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('uid !=', $user['uid']);
			$this->db->where('status', 1);
			$data[$i]['n_like']=$this->db->get('savsoft_like')->num_rows();
			$this->db->where('content_id',$data[$i]['qid']);
			$this->db->where('model','qbank');
			$data[$i]['permalink'] = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			$this->db->where('content_id',$data[$i]['cid']);
			$this->db->where('model','category');
			$data[$i]['category_permalink'] = $this->db->get('savsoft_permalink')->row_array()['permalink'];	
		}
		return $data;
	}
	
	public function get_mcq_fun1($pivot=0, $limit=5, $cid=0, $lid=0, $search=""){
		$user=$this->session->userdata('logged_in');
		$interest_cid=0;
		if($user){
			$this->db->select("qid");
			$this->db->where("uid",$user['uid']);
			$ans_qids= $this->db->get('savsoft_answer_mcq')->result_array();
			$araq=array();
			foreach($ans_qids as $aq){
				array_push($araq, $aq['qid']);
			}
			if($cid==0){
				$this->db->select("interest_cat_ids");
				$this->db->where("uid", $user['uid']);
				$dtus= $this->db->get("savsoft_users")->row_array();
				if($dtus["interest_cat_ids"]){
					$interest_cid=$dtus["interest_cat_ids"];
				}
			}
		}
		if($cid==0 && $lid==0 && $search=="" && $interest_cid==0){
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$lw=strtotime("-7 days");
			$lwstr= date("Y-m-d H:i:s", $lw);
			$this->db->select("qid,cid");
			$this->db->where("savsoft_qbank.fun_priory >", 1);	
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			$this->db->order_by('','RANDOM');
			$this->db->limit(3); 
			if($araq){
				$this->db->where_not_in('savsoft_qbank.qid',$araq);
			}
			$this->db->order_by('create_date DESC');
			$dtq=$this->db->get("savsoft_qbank")->result_array();
			$count=2;
			$i=2;
			$idfs = array();
			$idct = array();
			array_push($idfs,$dtq[0]["qid"],$dtq[1]["qid"]);
			array_push($idct,$dtq[0]["cid"],$dtq[1]["cid"]);
			while($count<$limit && $i<count($dtq)){
				if(!in_array($dtq[$i]['cid'],$idct)){
					array_push($idfs,$dtq[$i]["qid"]);
					array_push($idct,$dtq[$i]["cid"]);
					$count++;
				}
				$i++;
			}
			
			$this->db->where_in("savsoft_qbank.qid", $idfs);	
			$this->db->order_by('create_date DESC');

			$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
			$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
			$data= $this->db->get("savsoft_qbank")->result_array();
			
		}
		else{
			if($interest_cid==0){
				if($pivot>0)		
					$this->db->where("savsoft_qbank.qid <", $pivot);
				if($cid>0){
					$this->db->where("savsoft_qbank.cid", $cid);
				}
				if($lid>0)		
					$this->db->where("savsoft_qbank.lid", $lid);
				if($search!=""){
					$this->db->like("savsoft_qbank.question", $search);
				}
				else{
					if($cid==0){
						$this->db->where("savsoft_qbank.fun_priory >", 1);	
					}
					if($araq){
						$this->db->where_not_in('savsoft_qbank.qid',$araq);
					}
				}
				$this->db->where("deleted", 0);
				$this->db->where("status", 1);
				$this->db->order_by('','RANDOM');
				$this->db->limit(3); 
				// $this->db->limit($limit);	
				
				// $this->db->order_by('create_date DESC');

				$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
				$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');

				$data= $this->db->get("savsoft_qbank")->result_array();
			}else{
				
				if($pivot>0)		
					$this->db->where("savsoft_qbank.qid <", $pivot);
				if($cid>0){
					$this->db->where("savsoft_qbank.cid", $cid);
				}
				if($lid>0)		
					$this->db->where("savsoft_qbank.lid", $lid);
				if($search!=""){
					$this->db->like("savsoft_qbank.question", $search);
				}
				else{
					if($cid==0){
						$this->db->where("savsoft_qbank.fun_priory >", 1);	
					}
					if($araq){
						$this->db->where_not_in('savsoft_qbank.qid',$araq);
					}
				}
				$this->db->where_in("savsoft_qbank.cid", explode(",",$interest_cid));
				$this->db->where("deleted", 0);
				$this->db->where("status", 1);
				$this->db->order_by('','RANDOM');
				$this->db->limit(3); 
				// $this->db->limit($limit);	
				
				// $this->db->order_by('create_date DESC');

				$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
				$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');

				$data= $this->db->get("savsoft_qbank")->result_array();
				if(count($data)<$limit){
					if($pivot>0)		
						$this->db->where("savsoft_qbank.qid <", $pivot);
					if($cid>0){
						$this->db->where("savsoft_qbank.cid", $cid);
					}
					if($lid>0)		
						$this->db->where("savsoft_qbank.lid", $lid);
					if($search!=""){
						$this->db->like("savsoft_qbank.question", $search);
					}
					else{
						if($cid==0){
							$this->db->where("savsoft_qbank.fun_priory >", 1);	
						}
						if($araq){
							$this->db->where_not_in('savsoft_qbank.qid',$araq);
						}
					}
					$this->db->where_not_in("savsoft_qbank.cid", explode(",",$interest_cid));
					$this->db->where("deleted", 0);
					$this->db->where("status", 1);
					$this->db->order_by('','RANDOM');
					$this->db->limit(3); 
					// $this->db->limit($limit-count($data));	
					
					// $this->db->order_by('create_date DESC');

					$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
					$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');

					$data1= $this->db->get("savsoft_qbank")->result_array();
					$data=$data+$data1;
				}
				
			}
		}
		$str_qids="";
		for($i=0; $i<count($data); $i++){
			if($i!=0)
				$str_qids.=",";
			$str_qids.=$data[$i]['qid'];
			
		}
		if($str_qids=="") $str_qids=0;
		$sqlo = "select * from savsoft_options where qid in ($str_qids)";
		$ao = $this->db->query($sqlo)->result_array();

		for($i=0; $i<count($data); $i++){
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			if(strpos($htmlContent,'https://latex.codecogs.com')===false){
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 			
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				}
				$origImageSrc=str_replace("..",base_url(),$origImageSrc);
				if(count($imgTags[0])>0){
					$qt='<div class="imgqtt"><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					$qt.=strip_tags( $data[$i]['question']);
					$data[$i]['question']=$qt;

					$data[$i]['img']=$origImageSrc;
					

				}	
			}				 
			$this->db->select("su,logo,text_license,out_link");
			$this->db->where("uid",  $data[$i]['inserted_by']);
			$qr=$this->db->get("savsoft_users")->row_array();
			$data[$i]['create_su']=$qr['su'];
			$data[$i]['logo']=$qr['logo'];
			$data[$i]['text_license']=$qr['text_license'];
			$data[$i]['out_link']=$qr['out_link'];

			$origvidSrc="";
			$vidTags="";
			preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			if(count($vidTags[0])>0){
				if(strpos($vidTags[0][0], "facebook")!==false){
					$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
				}
				else{
					$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
				}
				$qt.=strip_tags($data[$i]['question']);
				$data[$i]['question']=$qt;
			} 
			$arr_op = array();
			for($j=0; $j<count($ao); $j++){
				if($ao[$j]['qid']== $data[$i]['qid']){
					array_push($arr_op, $ao[$j]);
				}
			}
			
			$data[$i]['options']=$arr_op;
			/*$this->db->where('qid',$data[$i]['qid']);
			$options = $this->db->get('savsoft_options');
			$data[$i]['options']=$options->result_array();*/
			/*$this->db->select('tag_name');
			$this->db->where('question_id',$data[$i]['qid']);
			$this->db->join('question_tag_rel', 'question_tag_rel.tag_id=tags.tag_id');
			$data[$i]['tags']=$this->db->get('tags')->result_array();*/
			$this->db->where('qid',$data[$i]['qid']);
			$data[$i]['n_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$data[$i]['qid']);
			$this->db->where('istrue',1);
			$data[$i]['n_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('uid', $user['uid']);
			$this->db->where('status', 1);
			$data[$i]['liked']=$this->db->get('savsoft_like')->num_rows();
			
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $data[$i]['qid']);
			$this->db->where('uid !=', $user['uid']);
			$this->db->where('status', 1);
			$data[$i]['n_like']=$this->db->get('savsoft_like')->num_rows();
			$this->db->where('content_id',$data[$i]['qid']);
			$this->db->where('model','qbank');
			$data[$i]['permalink'] = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			$this->db->where('content_id',$data[$i]['cid']);
			$this->db->where('model','category');
			$data[$i]['category_permalink'] = $this->db->get('savsoft_permalink')->row_array()['permalink'];	
		}
		return $data;
	}
	

	public function get_mcq_fun2($limit=4){
		$this->db->select("qid,question,background_template");
		$this->db->where("savsoft_qbank.fun_priory >", 1);	
		$this->db->where("deleted", 0);
		$this->db->where("status", 1);
		$this->db->limit($limit);	
		
		$this->db->order_by('fun_priory DESC,create_date DESC');

		$data= $this->db->get("savsoft_qbank")->result_array();
		for($i=0; $i<count($data); $i++){
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$data[$i]['question'];
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 	
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				
			}
			$origImageSrc=str_replace("..",base_url(),$origImageSrc);
			if($origImageSrc){
				$data[$i]['img']=$origImageSrc;
			}
			else{
				if($data[$i]['background_template']!=0){
					$data[$i]['img']=base_url("upload/background/".$data[$i]['background_template'].".jpg");
				}
				else{
					$data[$i]['img']=base_url("upload/background/".rand(1,20).".jpg");
				}

			}			 
			$data[$i]['question']=strip_tags($data[$i]['question']);
			$this->db->where('content_id',$data[$i]['qid']);
			$this->db->where('model','qbank');
			$data[$i]['permalink'] = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			$data[$i]['permalink']=site_url()."/page/question/".$data[$i]['permalink']."/notsolved";
			
			
		}

		return $data;
	}
	public function get_id_mcq_fun($cid=0, $lid=0, $search=""){
		$user=$this->session->userdata('logged_in');
		$interest_cid=0;
		if($user){
			$this->db->select("qid");
			$this->db->where("uid",$user['uid']);
			$ans_qids= $this->db->get('savsoft_answer_mcq')->result_array();
			$araq=array();
			foreach($ans_qids as $aq){
				array_push($araq, $aq['qid']);
			}
			if($cid==0){
				$this->db->select("interest_cat_ids");
				$this->db->where("uid", $user['uid']);
				$dtus= $this->db->get("savsoft_users")->row_array();
				if($dtus["interest_cat_ids"]){
					$interest_cid=$dtus["interest_cat_ids"];
				}
			}
		}
		if($cid==0 && $lid==0 && $search=="" && $interest_cid==0){
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$lw=strtotime("-7 days");
			$lwstr= date("Y-m-d H:i:s", $lw);
			$this->db->select("qid,cid");
			$this->db->where("savsoft_qbank.fun_priory >", 1);	
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			if($araq){
				$this->db->where_not_in('savsoft_qbank.qid',$araq);
			}
			$this->db->order_by('create_date DESC');
			$dtq=$this->db->get("savsoft_qbank")->result_array();
			$count=2;
			$i=2;
			$idfs = array();
			$idct = array();
			array_push($idfs,$dtq[0]["qid"],$dtq[1]["qid"]);
			array_push($idct,$dtq[0]["cid"],$dtq[1]["cid"]);
			while($count<$limit && $i<count($dtq)){
				if(!in_array($dtq[$i]['cid'],$idct)){
					array_push($idfs,$dtq[$i]["qid"]);
					array_push($idct,$dtq[$i]["cid"]);
					$count++;
				}
				$i++;
			}
			$this->db->select('qid');
			$this->db->where_in("savsoft_qbank.qid", $idfs);	
			$this->db->order_by('create_date DESC');
			$data1= $this->db->get("savsoft_qbank")->result_array();
			
			$this->db->select("qid");
			$this->db->where("savsoft_qbank.fun_priory >", 1);	
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			$this->db->where("create_date >", $lwstr);
			$this->db->where_not_in("savsoft_qbank.qid", $idfs);	
			if($araq){
				$this->db->where_not_in('savsoft_qbank.qid',$araq);
			}
			$this->db->order_by('rand()');
			$data2=$this->db->get("savsoft_qbank")->result_array();
			
			$this->db->select("qid");
			$this->db->where("savsoft_qbank.fun_priory >", 1);	
			if($araq){
				$this->db->where_not_in('savsoft_qbank.qid',$araq);
			}
			$this->db->where("deleted", 0);
			$this->db->where("status", 1);
			$this->db->where("create_date <=", $lwstr);
			$this->db->where_not_in("savsoft_qbank.qid", $idfs);
			$data3= $this->db->get("savsoft_qbank")->result_array();
			
			$data=$data1+$data2+$data3;
		}
		else{
			if($interest_cid==0){
				$this->db->select('qid');
				$this->db->where("deleted", 0);
				$this->db->where("status", 1);
				if($cid>0){
					$this->db->where("cid", $cid);
				}
				if($lid>0){
					$this->db->where("lid", $lid);
				}
				if($search!=""){
					$this->db->like("savsoft_qbank.question", $search);
				}
				else{
					if($cid==0){
						$this->db->where("savsoft_qbank.fun_priory >", 1);
					}
					if($araq){
						$this->db->where_not_in('savsoft_qbank.qid',$araq);
					}
				}
				//$this->db->limit(75);
				$this->db->order_by('create_date DESC');
				$data= $this->db->get("savsoft_qbank")->result_array();
			}else{
				$this->db->select('qid');
				$this->db->where("deleted", 0);
				$this->db->where("status", 1);
				if($cid>0){
					$this->db->where("cid", $cid);
				}
				if($lid>0){
					$this->db->where("lid", $lid);
				}
				if($search!=""){
					$this->db->like("savsoft_qbank.question", $search);
				}
				else{
					if($cid==0){
						$this->db->where("savsoft_qbank.fun_priory >", 1);
					}
					if($araq){
						$this->db->where_not_in('savsoft_qbank.qid',$araq);
					}
				}
				$this->db->where_in("savsoft_qbank.cid", explode(",",$interest_cid));
				$this->db->limit(5);
				$this->db->order_by('create_date DESC');
				
				$data= $this->db->get("savsoft_qbank")->result_array();		
				if(count($data)<5){
					$this->db->select('qid');
					if($cid>0){
						$this->db->where("cid", $cid);
					}
					if($lid>0)		
						$this->db->where("lid", $lid);
					if($search!=""){
						$this->db->like("question", $search);
					}
					else{
						if($cid==0){
							$this->db->where("fun_priory >", 1);	
						}
						if($araq){
							$this->db->where_not_in('qid',$araq);
						}
					}
					$this->db->where_not_in("cid", explode(",",$interest_cid));
					$this->db->where("deleted", 0);
					$this->db->where("status", 1);
					$this->db->limit(5-count($data));	
					
					$this->db->order_by('create_date DESC');
					$data1= $this->db->get("savsoft_qbank")->result_array();
					$data=$data+$data1;
					
					$idfb=array();
					foreach($data as $d){
						array_push($idfb, $d['qid']);
					}
					
					$this->db->select('qid');
					if($cid>0){
						$this->db->where("cid", $cid);
					}
					if($lid>0)		
						$this->db->where("lid", $lid);
					if($search!=""){
						$this->db->like("question", $search);
					}
					else{
						if($cid==0){
							$this->db->where("fun_priory >", 1);	
						}
						if($araq){
							$this->db->where_not_in('qid',$araq);
						}
					}
					$this->db->where_not_in("cid", explode(",",$interest_cid));
					$this->db->where_not_in("qid", $idfb);
					$this->db->where("deleted", 0);	
					$this->db->where("status", 1);
					
					$this->db->order_by('create_date DESC');
					$data2= $this->db->get("savsoft_qbank")->result_array();
					$data=$data+$data2;
				}
				else{
					$idfb=array();
					foreach($data as $d){
						array_push($idfb, $d['qid']);
					}
					$this->db->select('qid');
					if($cid>0){
						$this->db->where("cid", $cid);
					}
					if($lid>0)		
						$this->db->where("lid", $lid);
					if($search!=""){
						$this->db->like("question", $search);
					}
					else{
						if($cid==0){
							$this->db->where("fun_priory >", 1);	
						}
						if($araq){
							$this->db->where_not_in('qid',$araq);
						}
					}
					$this->db->where_in("cid", explode(",",$interest_cid));
					$this->db->where_not_in("qid", $idfb);
					$this->db->where("deleted", 0);	
					$this->db->where("status", 1);
					
					$this->db->order_by('create_date DESC');
					$data2= $this->db->get("savsoft_qbank")->result_array();
					$data=$data+$data2;
					
					$this->db->select('qid');
					if($cid>0){
						$this->db->where("cid", $cid);
					}
					if($lid>0)		
						$this->db->where("lid", $lid);
					if($search!=""){
						$this->db->like("question", $search);
					}
					else{
						if($cid==0){
							$this->db->where("fun_priory >", 1);
						}	
						if($araq){
							$this->db->where_not_in('qid',$araq);
						}
					}
					$this->db->where_not_in("cid", explode(",",$interest_cid));
					$this->db->where_not_in("qid", $idfb);
					$this->db->where("deleted", 0);	
					$this->db->where("status", 1);
					
					$this->db->order_by('create_date DESC');
					$data3= $this->db->get("savsoft_qbank")->result_array();
					$data=$data+$data3;
				}
				
				
				
				
			}
		}
		$dt="";
		for($i=0; $i<count($data); $i++){
			if($i>0){
				$dt.=",".$data[$i]['qid'];
			}
			else{
				$dt.=$data[$i]['qid'];
			}
		}
		return $dt;
	}
	public function get_question_block_old($qid){
		$user=$this->session->userdata('logged_in');
		$this->db->where('savsoft_qbank.qid',$qid);
		$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
		$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
       // $this->db->join('savsoft_permalink','savsoft_permalink.content_id=savsoft_qbank.qid and savsoft_permalink.model="qbank"');

		$mcq= $this->db->get("savsoft_qbank")->row_array();
		if($mcq){
			if($user){
				$this->db->insert("user_views", array("model"=>"qbank", "content_id"=>$qid, "uid"=>$user["uid"]));
				$this->load->model('predictio_model');
				$this->predictio_model->push_event("view",$user['uid'],$mcq['qid'], $mcq['cid'], $mcq['lid']);
			}
			$this->db->where('content_id',$qid);
			$this->db->where('model','qbank');
			$mcq['permalink']= $this->db->get("savsoft_permalink")->row_array()['permalink'];
			$origImageSrc="";
			$imgTags="";	
			$htmlContent=$mcq['question'];
			if(strpos($htmlContent,'latex.codecogs.com')===false || strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false){
				preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
				for ($j = 0; $j < count($imgTags[0]); $j++) {
					preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
					$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
					
				}
				$origImageSrc=str_replace("..",base_url(),$origImageSrc);
				if(count($imgTags[0])>0){
					$qt='<div class="imgqtt" ><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					$qt.=strip_tags($mcq['question']);
					$mcq['question']=$qt;
				}
				$mcq['img']=$origImageSrc;
			}
			else{
				$mcq['img']="";
			}
			$this->db->select("su,logo,text_license,out_link");
			$this->db->where("uid",  $mcq['inserted_by']);
			$qr=$this->db->get("savsoft_users")->row_array();
			$mcq['create_su']=$qr['su'];
			$mcq['logo']=$qr['logo'];
			$mcq['text_license']=$qr['text_license'];
			$mcq['out_link']=$qr['out_link'];
			$origvidSrc="";
			$vidTags="";
			if(strpos($htmlContent, "<iframe") !==false){
				preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
				if(count($vidTags[0])>0){
					if(strpos($vidTags[0][0], "facebook")!==false){
						$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
					}
					else{
						$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
					}
					$qt.=strip_tags($mcq['question']);
					$mcq['question']=$qt;
				} 
			}
			//category link
			
			$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
			if ( ! $categ = $this->cache->get('cache_categ')) {

				$this->db->order_by('cid','desc');
				$categ=$this->db->get('savsoft_category')->result_array();
				for($i=0; $i<count($categ); $i++){
					$this->db->where('model','category');
					$this->db->where('content_id',$categ[$i]['cid']);
					$categ[$i]['category_permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
				}
				
				$this->cache->save('cache_categ', $categ, 864000);
			}
			
			
			//
			$this->db->where('qid',$qid);
			$options = $this->db->get('savsoft_options');
			$mcq['options']=$options->result_array();
			$this->db->where('qid',$qid);
			$mcq['n_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('qid',$qid);
			$this->db->where('istrue',1);
			$mcq['n_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
			$this->db->where('model', 'qbank');
			$this->db->where('content_id', $qid);
			$this->db->where('uid !=', $user['uid']);
			$this->db->where('status', 1);
			$mcq['n_like']=$this->db->get('savsoft_like')->num_rows();
			
			$this->db->where('content_id',$mcq['cid']);
			$this->db->where('model','category');
			$mcq['category_permalink'] = $this->db->get('savsoft_permalink')->row_array()['permalink'];
			
			$this->db->from('posts p');
			$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
			$this->db->where('p.model','qbank');
			$this->db->where('p.wall_id',$qid);
			$this->db->where('p.parent_id', 0);
			$this->db->limit(2);
			$this->db->order_by("p.create_date", "desc");
			$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,photo");
			$mcq['comment'] =$this->db->get()->result_array();
			
			
			/*date_default_timezone_set('Asia/Ho_Chi_Minh');  
            $time_ago = strtotime($mcq['create_date']);  
			$current_time = time();  
			$time_difference = $current_time - $time_ago;  
			$seconds = $time_difference;  
			$minutes      = round($seconds / 60 );           // value 60 is seconds  
			$hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
			$days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  

			if($seconds <= 60) {  
				$mcq['str_time_ago']= "Vừa xong";  
			  }  
			else if($minutes <=60){  
				if($minutes==1){  
					$mcq['str_time_ago']= "1 phút";  
				}  
				else {  
					$mcq['str_time_ago']="$minutes phút";  
				}  
			}  
			 else if($hours <=24){  
				  if($hours==1)  {  
					$mcq['str_time_ago']= "1 giờ";  
				  }  
				  else {  
					$mcq['str_time_ago']= "$hours giờ";  
				 }  
			  }  
			 else if($days <= 7){  
				if($days==1){  
					$mcq['str_time_ago']= "Hôm qua";  
				}  
				else {  
					$mcq['str_time_ago']= "$days ngày";  
				}  
			  }  
			  else {
				  $date= new DateTime($mcq['create_date']);
				  $mcq['str_time_ago']= $date->format('d-m-Y');
			  }
			
             for($j=0; $j<count($mcq['comment']); $j++){

				$time_ago = strtotime($mcq['comment'][$j]['create_date']);  
				$current_time = time();  
				$time_difference = $current_time - $time_ago;  
				$seconds = $time_difference;  
				$minutes      = round($seconds / 60 );   
				$hours           = round($seconds / 3600);  
				$days          = round($seconds / 86400); 

				if($seconds <= 60) {  
					$mcq['comment'][$j]['str_time_ago']= "Vừa xong";  
				  }  
				else if($minutes <=60){  
					if($minutes==1){  
						$mcq['comment'][$j]['str_time_ago']= "1 phút";  
					}  
					else {  
						$mcq['comment'][$j]['str_time_ago']="$minutes phút";  
					}  
				}  
				 else if($hours <=24){  
					  if($hours==1)  {  
						$mcq['comment'][$j]['str_time_ago']= "1 giờ";  
					  }  
					  else {  
						$mcq['comment'][$j]['str_time_ago']= "$hours giờ";  
					 }  
				  }  
				 else if($days <= 7){  
					if($days==1){  
						$mcq['comment'][$j]['str_time_ago']= "Hôm qua";  
					}  
					else {  
						$mcq['comment'][$j]['str_time_ago']= "$days ngày";  
					}  
				  }  
				  else {
					  $date= new DateTime($mcq['comment'][$j]['create_date']);
					  $mcq['comment'][$j]['str_time_ago']= $date->format('d-m-Y');
				  }
				}*/
				$this->db->select('status');
				$this->db->where('model','qbank');
				$this->db->where('content_id',$qid);
				$this->db->where('uid',$user['uid']);
				$mcq['liked']=$this->db->get('savsoft_like')->row_array()['status'];

				$message='';
				$message.='<div class="moremcq_'.$mcq['qid'].' box-bor1 mb-20">';	  
				$message.='<div>';
				$message.='<div class="row1" style="margin-top:20px">';
				$message.='<div class=col-xs-10>';
				$message.='<div class="w60"><a class="pointer" ><img class="img-responsive img-circle" src="'.base_url("upload/symbol/".$mcq['cid'].".png").'" alt=""></a></div>';
				$message.='<h4 class="mb-0"><a class="pointer" href="'.site_url("/page/category/".$mcq["category_permalink"]).'"><b>'.$mcq["category_name"].'</b></a>  <span style="margin-left:10px" class="dropdown pointer"><a class="dropdown-toggle"  data-toggle="dropdown">';
				$message.='<span class="
				caret caret_e"></span></a>';
				$message.='<ul class="dropdown-menu dropdown-menu_e" style="overflow-y: scroll;height: 273px;font-size:15px">';
				foreach ($categ as $ct){
					$message.='<li><a href="'.site_url('/page/category/'.$ct['category_permalink']).'"><b>'. $ct['category_name'].'</b></a></li>';
				}
				$message.='</ul></span><br></h4>';
				$message.='<span class="text-small1">'. $mcq['str_time_ago'].'</i></span>';
				$message.='</div>';  
				$message.='</div>';
				$message.='<div class="col-xs-12" style="margin-bottom:10px">';
				if(strpos($mcq['question'],'latex.codecogs.com')!==false || strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false || ($mcq['cid']<5  && $mcq['fun_priory']<2)){

					$message.='<div class="mcq_multimd assqid-'.$mcq['qid'].'" style="display:none">';
					$message.=$mcq['question'];
					$message.='</div>';

					$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank" style="color:#000; font-size:22px">';
					$message.=html_entity_decode($mcq['question']) ;					
					$message.='</a>';
				}
				else
					if( strpos($mcq['question'], '<iframe')===false && strpos($mcq['question'], '<img')===false){
						$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank" style="color:#fff">';
						$message.='<div class="bgqtdiv" >';
						$message.='<font color="white">';
						$message.='<div style="background-image:url(\'https://stemup.app/upload/background/';
						if($mcq['background_template']!=0){ 
							$message.= $mcq['background_template'];
						} else{ 
							$message.= rand(1,20);
						}
						$message.='.jpg\');" class="outer bgqt">';
						$message.='<div class="middle">';
						$message.='<div class="inner">';
						if(strpos($mcq['question'],'latex.codecogs.com')!==false){
							$des=html_entity_decode($mcq['question']) ;
						}
						else{
							$des=html_entity_decode(strip_tags($mcq['question'])) ;
						}
						if (strpos($mcq['question'],'latex.codecogs.com')===false &&   mb_strlen($des, 'UTF-8')>120){
							$pos=strpos($des," ",110); 

							$message.=substr($des,0,$pos).'... <a  style="text-shadow: -2px 0 white, 0 2px white, 2px 0 white, 0 -1px white;" class="pointer"'; 
							if($user){
								$message.='onclick="show_question('.$mcq['qid'].')">';
							}else{
								$message.='onclick="show_question_none_login('.$mcq['qid'].')">';
							}
							$message.='Xem thêm</a><div class="hiddenlqt" style="display:none">'.$des.'</div>';
						}else{
							$message.=$des;
						}


						$message.='</div>';				
						$message.='</div>';
						$message.='</div>';
						$message.='</font>';	
						$message.='</div>';
						if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {
							$message.='<div class="imgwlogo" style="margin-top:-15px">';
							$message.='<a href="'.$mcq['out_link'].'" target="_blank">';
							$message.='<div class="logobanner">';			
							$message.='<div>';						  
							$message.='<table style="width:100%">';
							$message.='<tr>';
							$message.='<td style=" padding: 5px 20px;">';
							if($mcq['logo']){
								$message.='<div class="logoimg">';
								$message.='<img src="'.$mcq['logo'].'">';
								$message.='</div>';
							}
							$message.='</td>';
							$message.='<td class="textorg" >';
							$message.='<div  class="contentbn">';
							$message.='<i style="font-weight:200px">Cung cấp bởi</i> <b><a>'.$mcq['text_license'].'</b></a>';
							$message.=' </div>';
							$message.='</td>';							 
							$message.='</tr>';
							$message.='</table>';	   
							$message.='</div>';	  
							$message.='</div>';
							$message.='</a>';
							$message.='</div>';
						}
						$message.='</a>';
					} else{

						$message.='<div class="mcq_multimd assqid-'.$mcq['qid'].'" style="display:none">';
						$message.=$mcq['question'];
						$message.='</div>';
						if(strpos($mcq['question'], '<iframe')===false){ 
							$message.=	'<div class="mcq_multimd assqid-'.$mcq['qid'].'">';
							$message.='<center style="margin-bottom:20px">';
							if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {
								$message.='<div class="imgwlogo">';
								$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank">';
								$message.='<img class="img-responsive" style="width:100%" src="'.$mcq['img'].'"/>';
								$message.='</a>';
								$message.='<a href="'.$mcq['out_link'].'" target="_blank">';
								$message.='<div class="logobanner">';			
								$message.='<div>';						  
								$message.='<table style="width:100%">';
								$message.='<tr>';
								$message.='<td style=" padding: 5px 10px;">';
								if($mcq['logo']){
									$message.='<div class="logoimg">';
									$message.='<img src="'.$mcq['logo'].'">';
									$message.='</div>';
								}
								$message.='</td>';
								$message.='<td class="textorg" >';
								$message.='<div  class="contentbn">';
								$message.='<i style="font-weight:200px">Cung cấp bởi</i> <b><a>'.$mcq['text_license'].'</b></a>';
								$message.=' </div>';
								$message.='</td>';							 
								$message.='</tr>';
								$message.='</table>';	   
								$message.='</div>';	  
								$message.='</div>';		  
								$message.='</a>';			  
								$message.='</div>';
							} else{
								$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank">';	      
								$message.='<img class="img-responsive" style="width:100%" src="'.$mcq['img'].'"/>';
								$message.='</a>';
							} 
							$message.='</center>';
							$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank">';
							$message.=strip_tags($mcq['question']);
							$message.='</a>';
							$message.='</div>';
						} else{
							$message.=$mcq['question'];
						}		 
					}

					$message.='</div>';			 						
					$message.='<div class="col-xs-12 div_opt">';
					$message.=' <div class="row MB20 twopt">';
					if($user){
						$message.='<div class="col-xs-6 mobile-opt mobmb20">';
					}
					else{
						$message.='<div class="col-xs-6 mobile-opt mobmb20" onclick="popup_require_login()">';
					}
					$message.='<label class="radio-inline w-100">';								 
					$message.='<input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_'.$mcq['qid'].'" value="0">';
					$message.='<div class="input-group mobile-text-opt">';
					$message.='<span class="input-group-addon opt-mb2 bo-input-left"></span>';
					$daa= html_entity_decode($mcq['options'][0]['q_option']);
					$daa=str_replace ("<p>","",$daa);
					$daa=str_replace ("</p>","",$daa);
					$message.='<span id="optA1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> <table><tr><td><b> A:</b> </td><td>'.$daa;

					$message.='</td></tr></table></span></div>';					
					$message.='</label>';
					$message.='</div>';
					if($user){
						$message.='<div class="col-xs-6 mobile-opt" >';	
					}
					else{
						$message.='<div class="col-xs-6 mobile-opt" onclick="popup_require_login()">';
					}
					$message.='<label class="radio-inline w-100">';			 
					$message.='<input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_'.$mcq['qid'].'" value="1">';
					$message.='<div class="input-group mobile-text-opt">';
					$message.='<span class="input-group-addon opt-mb2 bo-input-left"></span>';
					$dab= html_entity_decode($mcq['options'][1]['q_option']);
					$dab=str_replace ("<p>","",$dab);
					$dab=str_replace ("</p>","",$dab);
					$message.='<span id="optB1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> <table><tr><td><b> B:</b> </td><td>'.$dab;
					$message.='</td></tr></table></span></div>';		
					$message.='</label>';
					$message.='</div>';
					$message.='</div>';
					$message.='<div class="row" >';
					if(!in_array(html_entity_decode($mcq['options'][2]['q_option']),array("", " ","  ", "   ")) ){
						if($user){
							$message.='<div class="col-xs-6 mobile-opt mobmb20">';
						}
						else{
							$message.='<div class="col-xs-6 mobile-opt mobmb20" onclick="popup_require_login()">';
						}
					}else{
						$message.='<div class="col-xs-6 mobile-opt mobmb20" style="display:none">'; 
					}
					$message.='<label class="radio-inline w-100">';				 
					$message.='<input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_'.$mcq['qid'].'" value="2">';
					$message.='<div class="input-group mobile-text-opt">';
					$message.='<span class="input-group-addon opt-mb2 bo-input-left"></span>';
					$dac= html_entity_decode($mcq['options'][2]['q_option']);
					$dac=str_replace ("<p>","",$dac);
					$dac=str_replace ("</p>","",$dac);
					$message.='<span id="optC1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> <table><tr><td><b> C:</b> </td><td>'.$dac;
					$message.='</td></tr></table></span></div>';	
					$message.='</label>';
					$message.='</div>';
					if(!in_array(html_entity_decode($mcq['options'][3]['q_option']),array("", " ","  ", "   ")) ){
						if($user){
							$message.='<div class="col-xs-6 mobile-opt" >';	
						}
						else{
							$message.='<div class="col-xs-6 mobile-opt" onclick="popup_require_login()">';
						}
					}
					else{
						$message.='<div class="col-xs-6 mobile-opt" style="display:none">'; 
					}
					$message.='<label class="radio-inline w-100">';					 
					$message.='<input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_'.$mcq['qid'].'" value="3">';
					$message.='<div class="input-group mobile-text-opt">';
					$message.='<span class="input-group-addon opt-mb2 bo-input-left"></span>';
					$dad= html_entity_decode($mcq['options'][3]['q_option']);
					$dad=str_replace ("<p>","",$dad);
					$dad=str_replace ("</p>","",$dad);
					$message.='<span id="optD1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:25px;padding-bottom:0px;overflow: hidden;"> <table><tr><td><b> D:</b> </td><td>'.$dad;
					$message.='</td></tr></table></span></div>';						
					$message.='</label>';
					$message.='</div>';	
					$message.='</div>';	
					$message.=' <p class="mt-10 mb-0"><button type="button" class="btn btn-danger" style="display:none">Tag bạn Facebook để trợ giúp</button></p>';
					if($mcq['n_answers']>0){
						$message.='<div class="col-xs-12 text-right mgr-20" style="float:right" >';
						$message.='<p class="f11"><i style="width:20px" class="fas fa-users mr-5 bo-tron bg-danger"></i><strong class="text-danger">'.number_format(100*$mcq['n_correct_answers']/$mcq['n_answers'],0).'%</strong> trả lời đúng</p>';
						$message.='</div>';	
					} 
					$message.='</div>';	
					$message.='</div>';	
					$message.='<div class="col-xs-12 bo-tb">';
					$message.='<div class="row">';
					$message.='<div class="col-xs-12" style="margin-bottom:5px">';
					$message.='<ul class="list-inline text-bt">';
					if($user){
						if($user['su']!=2){
							if($mcq['liked']==1){
								$message.='<li class="col-xs-2"><a class="btnlike acti pointer"  onclick="like_question(this , '.$mcq['qid'].')"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>';
							} else{
								$message.='<li class="col-xs-2"><a class="btnlike pointer"  onclick="like_question(this , '.$mcq['qid'].')"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>';
							}
							$message.='<li class="col-xs-3"><a class="pointer" data-toggle="collapse" data-target="#comment_area_main_'.$mcq['qid'].'" ><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs">Bình luận</span></a></li>';
							$message.='<li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquestion%2F'.$mcq['permalink'].'&amp;src=sdkpreparse" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\');count_share('.$mcq['qid'].'); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs">Chia sẻ</span></a></li>';
							$message.='<li class="col-xs-2">
							<a class="assign-bt pointer" href="'.site_url('page/question/'.$mcq['permalink']).'" target="_blank"><i class="fab fa-resolving mr-5"></i> <span class="hidden-xs"> Đáp án</span></a>
							</li>';

							$message.='<li class="col-xs-2"><a class="assign-bt pointer" data-qid="'.$mcq['qid'].'"><i class="fas fa-share-square"></i><span class="hidden-xs">Đố</span></a></li>';
						}
						else{
							$uid = $user['uid'];

							$sql=" SELECT DISTINCT qid,assid FROM savsoft_qassign WHERE qid=$qid and uid=$uid and answer IS NULL " ;
							$query=$this->db->query($sql)->row_array();

							if($mcq['liked']==1){
								$message.='<li class="col-xs-3"><a class="acti pointer"  onclick="like_question(this , '.$mcq['qid'].')"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs"> Thích</span></a></li>';
							} else{
								$message.='<li class="col-xs-3"><a class="pointer"  onclick="like_question(this , '.$mcq['qid'].')"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs"> Thích</span></a></li>';
							}
							$message.='<li class="col-xs-3"><a class="pointer" data-toggle="collapse" data-target="#comment_area_main_'.$mcq['qid'].'" ><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs"> Bình luận</span></a></li>';
							$message.='<li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquestion%2F'.$mcq['permalink'].'&amp;src=sdkpreparse" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\');count_share('.$mcq['qid'].'); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs"> Chia sẻ</span></a></li>';
							$message.='<li class="col-xs-3">
							<a class="assign-bt pointer" href="'.site_url('page/question/'.$mcq['permalink']).'" target="_blank"><i class="fab fa-resolving mr-5"></i> <span class="hidden-xs"> Đáp án</span></a>
							</li>';
						}
					}
					else{
						$message.=' <li class="col-xs-2"><a class="pointer"  onclick="popup_require_login()"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs"> Thích</span></a></li>';
						$message.='<li class="col-xs-3"><a class="pointer" onclick="popup_require_login()"><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs"> Bình luận</span></a></li>';
						$message.='<li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquestion%2F'.$mcq['permalink'].'&amp;src=sdkpreparse" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\');count_share('.$mcq['qid'].'); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs"> Chia sẻ</span></a></li>';
						if($query){
							$message.='<li class="col-xs-2">
							<a class="assign-bt pointer" onclick = "question_ass('.$qid.','.$query['assid'].')"><i class="fab fa-resolving mr-5"></i><span class="hidden-xs">Đáp án</span></a>
							</li>';
						}
						else{
							$message.='<li class="col-xs-2">
							<a class="assign-bt pointer" href="'.site_url('page/question/'.$mcq['permalink']).'" target="_blank"><i class="fab fa-resolving mr-5"></i> <span class="hidden-xs"> Đáp án</span></a>
							</li>';
						}
						$message.='<li class="col-xs-2">
						<a class="assign-bt pointer" onclick="popup_require_login()"><i class="fas fa-share-square mr-5"></i><span class="hidden-xs">Đố</span></a>
						</li>';
					}

					$message.='</ul>';
					$message.='</div>';		  
					$message.='</div>';
					$message.='</div>';
					$message.='<div id="like_statistic_'.$mcq['qid'].'">';
					if($user){
						if($mcq['liked']==1|| $mcq['n_like']>0 ){
							$message.='<div class="col-xs-12 bo-B" >';		 
							$message.='<i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>';
							$message.='<a class="text_lst" class="f10" href="#">';
							if($mcq['liked']==1){			 
								if($mcq['n_like'] >0) { 
									$message.='Bạn và';
								} else 
								$message.=$user['first_name'].' '.$user['last_name'];;
							}
							if($mcq['n_like'] >0) {
								$message.=" ".$mcq['n_like'].' người' ;
							} 
							$message.='</a>';
							$message.='</div>';
						}
					}
					else{
						if( $mcq['n_like']>0 ){
							$message.='<div class="col-xs-12 bo-B" >';	 
							$message.=' <i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>';
							$message.=' <a class="f10" href="#">';
							$message.=" ".$mcq['n_like'].' người' ;
							$message.=' </a>';
							$message.='</div>';
						}
					}
					$message.='</div>';
					if($mcq['share_count']>0){
						$message.='<div class="col-xs-12">';
						$message.='<p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i>'.$mcq['share_count'].' lượt chia sẻ</p>';
						$message.='</div>';
					}
					$message.='<div class="col-xs-12 collapse" id="comment_area_main_'.$mcq['qid'].'">';
					$message.='<div class="media-object-default">';
					$message.='<div class="media">';
					$message.='<div class="media-left">';
					$message.='<a href="#">';
					$link_photo=$user['photo'];
					if($link_photo) { 
						$message.='<img class="media-object img-circle" src="'.$link_photo.'" width="36" alt="placeholder image">';
					} else{
						$message.='<img class="media-object img-circle" src="'.base_url('upload/avatar/default.png').'" width="36" alt="placeholder image">';
					}

					$message.= '</a>';
					$message.='</div>';
					$message.='<div class="media-body" >';
					$message.='<input type="text" class="form-control bo-input inp_comment" onkeyup="write_comment(this,event,\'qbank\','.$mcq['qid'].')" placeholder="Bình luận">';
					$message.='</div>';
					$message.='</div>';
					$message.='</div>';
					$message.='</div>';
					$message.='<div class="col-xs-12">';
					$message.='<div class="box-commen" style="margin-top:20px;" id="box_comment_'.$mcq['qid'].'">';
					$message.='<div class="media-object-default">';
					foreach($mcq['comment'] as $cmt){
						$message.='<div class="media">';
						$message.='<div class="media-left">';
						$message.='<a href="#">';
						if($cmt['photo']) {
							$message.='<img class="media-object img-circle" src="'.$cmt['photo'].'" width="36" alt="placeholder image">';
						} else{  
							$message.='<img class="media-object img-circle" src="'.base_url('upload/avatar/default.png').'" width="36" alt="placeholder image">';
						}
						$message.='</a>';
						$message.='</div>';
						$message.='<div class="media-body">';
						$message.='<h4 class="media-heading"><a href="">'.$cmt['first_name']." ".$cmt['last_name'].'</a></h4>';
						$message.=$cmt['content'];
				//$message.='<p class="text-small1">';
				//$message.='<a class="mr-23" href="">Thích</a>';
				//$message.='<a class="mr-23" href="">Trả lời</a>';
				//$message.='-'.$cmt['str_time_ago'];
				//$message.='</p>';
						$message.='</div>';				
						$message.='</div>';
					}
					$message.='</div>';
					$message.='</div>';
					$message.='</div>';	 
					$message.='</div>';
					$message.='</div>';
				}
				else{
					$message='';
				}
				$message.='
				<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
				<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>';
				return $message;
			}


			public function get_question_block($qid){
				$user=$this->session->userdata('logged_in');
				$this->db->where('savsoft_qbank.qid',$qid);
				$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
				$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
       // $this->db->join('savsoft_permalink','savsoft_permalink.content_id=savsoft_qbank.qid and savsoft_permalink.model="qbank"');

				$mcq= $this->db->get("savsoft_qbank")->row_array();
				if($mcq){
					if($user){
						$this->db->insert("user_views", array("model"=>"qbank", "content_id"=>$qid, "uid"=>$user["uid"]));
						$this->load->model('predictio_model');
						$this->predictio_model->push_event("view",$user['uid'],$mcq['qid'], $mcq['cid'], $mcq['lid']);
					}
					$this->db->where('content_id',$qid);
					$this->db->where('model','qbank');
					$mcq['permalink']= $this->db->get("savsoft_permalink")->row_array()['permalink'];
					$origImageSrc="";
					$imgTags="";	
					$htmlContent=$mcq['question'];
					if(strpos($htmlContent,'latex.codecogs.com')===false || strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false){
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);

						}
						$origImageSrc=str_replace("..",base_url(),$origImageSrc);
						if(count($imgTags[0])>0){
							$qt='<div class="imgqtt" ><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
							$qt.=strip_tags($mcq['question']);
							$mcq['question']=$qt;
						}
						$mcq['img']=$origImageSrc;
					}
					else{
						$mcq['img']="";
					}
					$this->db->select("su,logo,text_license,out_link");
					$this->db->where("uid",  $mcq['inserted_by']);
					$qr=$this->db->get("savsoft_users")->row_array();
					$mcq['create_su']=$qr['su'];
					$mcq['logo']=$qr['logo'];
					$mcq['text_license']=$qr['text_license'];
					$mcq['out_link']=$qr['out_link'];
					$origvidSrc="";
					$vidTags="";
					if(strpos($htmlContent, "<iframe") !==false){
						preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
						if(count($vidTags[0])>0){
							if(strpos($vidTags[0][0], "facebook")!==false){
								$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
							}
							else{
								$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
							}
							$qt.=strip_tags($mcq['question']);
							$mcq['question']=$qt;
						} 
					}
			//category link

					$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
					if ( ! $categ = $this->cache->get('cache_categ')) {

						$this->db->order_by('cid','desc');
						$categ=$this->db->get('savsoft_category')->result_array();
						for($i=0; $i<count($categ); $i++){
							$this->db->where('model','category');
							$this->db->where('content_id',$categ[$i]['cid']);
							$categ[$i]['category_permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
						}

						$this->cache->save('cache_categ', $categ, 864000);
					}


			//
					$this->db->where('qid',$qid);
					$options = $this->db->get('savsoft_options');
					$mcq['options']=$options->result_array();
					$this->db->where('qid',$qid);
					$mcq['n_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
					$this->db->where('qid',$qid);
					$this->db->where('istrue',1);
					$mcq['n_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
					$this->db->where('model', 'qbank');
					$this->db->where('content_id', $qid);
					$this->db->where('uid !=', $user['uid']);
					$this->db->where('status', 1);
					$mcq['n_like']=$this->db->get('savsoft_like')->num_rows();

					$this->db->where('content_id',$mcq['cid']);
					$this->db->where('model','category');
					$mcq['category_permalink'] = $this->db->get('savsoft_permalink')->row_array()['permalink'];

					$this->db->from('posts p');
					$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
					$this->db->where('p.model','qbank');
					$this->db->where('p.wall_id',$qid);
					$this->db->where('p.parent_id', 0);
					$this->db->limit(2);
					$this->db->order_by("p.create_date", "desc");
					$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,photo");
					$mcq['comment'] =$this->db->get()->result_array();

					$this->db->select('status');
					$this->db->where('model','qbank');
					$this->db->where('content_id',$qid);
					$this->db->where('uid',$user['uid']);
					$mcq['liked']=$this->db->get('savsoft_like')->row_array()['status'];

					$message='';
					$message.='<div class="moremcq_'.$mcq['qid'].' box-bor1 mb-20">';	  
					$message.='<div>';
					$message.='<div class="row1" style="margin-top:20px">';
					$message.='<div class=col-xs-10>';
					$message.='<div class="w60"><a class="pointer" ><img class="img-responsive img-circle" src="'.base_url("upload/symbol/".$mcq['cid'].".png").'" alt=""></a></div>';
					$message.='<h4 class="mb-0"><a class="pointer" href="'.site_url("/page/category/".$mcq["category_permalink"]).'"><b>'.$mcq["category_name"].'</b></a>  <span style="margin-left:10px" class="dropdown pointer"><a class="dropdown-toggle"  data-toggle="dropdown">';
					$message.='<span class="
					caret caret_e"></span></a>';
					$message.='<ul class="dropdown-menu dropdown-menu_e" style="overflow-y: scroll;height: 273px;font-size:15px">';
					foreach ($categ as $ct){
						$message.='<li><a href="'.site_url('/page/category/'.$ct['category_permalink']).'"><b>'. $ct['category_name'].'</b></a></li>';
					}
					$message.='</ul></span><br></h4>';
					$message.='<span class="text-small1">'. $mcq['str_time_ago'].'</i></span>';
					$message.='</div>';  
					$message.='</div>';
					$message.='<div class="col-xs-12" style="margin-bottom:10px">';
					if(strpos($mcq['question'],'latex.codecogs.com')!==false || strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false || ($mcq['cid']<5  && $mcq['fun_priory']<2)){

						$message.='<div class="mcq_multimd assqid-'.$mcq['qid'].'" style="display:none">';
						$message.=$mcq['question'];
						$message.='</div>';

						$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank" style="color:#000; font-size:22px">';
						$message.=html_entity_decode($mcq['question']) ;					
						$message.='</a>';
					}
					else
						if( strpos($mcq['question'], '<iframe')===false && strpos($mcq['question'], '<img')===false){
							$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank" style="color:#fff">';
							$message.='<div class="bgqtdiv" >';
							$message.='<font color="white">';
							$message.='<div style="background-image:url(\'https://stemup.app/upload/background/';
							if($mcq['background_template']!=0){ 
								$message.= $mcq['background_template'];
							} else{ 
								$message.= rand(1,20);
							}
							$message.='.jpg\');" class="outer bgqt">';
							$message.='<div class="middle">';
							$message.='<div class="inner">';
							if(strpos($mcq['question'],'latex.codecogs.com')!==false){
								$des=html_entity_decode($mcq['question']) ;
							}
							else{
								$des=html_entity_decode(strip_tags($mcq['question'])) ;
							}
							if (strpos($mcq['question'],'latex.codecogs.com')===false &&   mb_strlen($des, 'UTF-8')>120){
								$pos=strpos($des," ",110); 

								$message.=substr($des,0,$pos).'... <a  style="text-shadow: -2px 0 white, 0 2px white, 2px 0 white, 0 -1px white;" class="pointer"'; 
								if($user){
									$message.='onclick="show_question('.$mcq['qid'].')">';
								}else{
									$message.='onclick="show_question_none_login('.$mcq['qid'].')">';
								}
								$message.='Xem thêm</a><div class="hiddenlqt" style="display:none">'.$des.'</div>';
							}else{
								$message.=$des;
							}


							$message.='</div>';				
							$message.='</div>';
							$message.='</div>';
							$message.='</font>';	
							$message.='</div>';
							if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {
								$message.='<div class="imgwlogo" style="margin-top:-15px">';
								$message.='<a href="'.$mcq['out_link'].'" target="_blank">';
								$message.='<div class="logobanner">';			
								$message.='<div>';						  
								$message.='<table style="width:100%">';
								$message.='<tr>';
								$message.='<td style=" padding: 5px 20px;">';
								if($mcq['logo']){
									$message.='<div class="logoimg">';
									$message.='<img src="'.$mcq['logo'].'">';
									$message.='</div>';
								}
								$message.='</td>';
								$message.='<td class="textorg" >';
								$message.='<div  class="contentbn">';
								$message.='<i style="font-weight:200px">Cung cấp bởi</i> <b><a>'.$mcq['text_license'].'</b></a>';
								$message.=' </div>';
								$message.='</td>';							 
								$message.='</tr>';
								$message.='</table>';	   
								$message.='</div>';	  
								$message.='</div>';
								$message.='</a>';
								$message.='</div>';
							}
							$message.='</a>';
						} else{

							$message.='<div class="mcq_multimd assqid-'.$mcq['qid'].'" style="display:none">';
							$message.=$mcq['question'];
							$message.='</div>';
							if(strpos($mcq['question'], '<iframe')===false){ 
								$message.=	'<div class="mcq_multimd assqid-'.$mcq['qid'].'">';
								$message.='<center style="margin-bottom:20px">';
								if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {
									$message.='<div class="imgwlogo">';
									$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank">';
									$message.='<img class="img-responsive" style="width:100%" src="'.$mcq['img'].'"/>';
									$message.='</a>';
									$message.='<a href="'.$mcq['out_link'].'" target="_blank">';
									$message.='<div class="logobanner">';			
									$message.='<div>';						  
									$message.='<table style="width:100%">';
									$message.='<tr>';
									$message.='<td style=" padding: 5px 10px;">';
									if($mcq['logo']){
										$message.='<div class="logoimg">';
										$message.='<img src="'.$mcq['logo'].'">';
										$message.='</div>';
									}
									$message.='</td>';
									$message.='<td class="textorg" >';
									$message.='<div  class="contentbn">';
									$message.='<i style="font-weight:200px">Cung cấp bởi</i> <b><a>'.$mcq['text_license'].'</b></a>';
									$message.=' </div>';
									$message.='</td>';							 
									$message.='</tr>';
									$message.='</table>';	   
									$message.='</div>';	  
									$message.='</div>';		  
									$message.='</a>';			  
									$message.='</div>';
								} else{
									$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank">';	      
									$message.='<img class="img-responsive" style="width:100%" src="'.$mcq['img'].'"/>';
									$message.='</a>';
								} 
								$message.='</center>';
								$message.='<a href="'.site_url('page/question/'.$mcq['permalink'].'/notsolved').'" target="_blank">';
								$message.=strip_tags($mcq['question']);
								$message.='</a>';
								$message.='</div>';
							} else{
								$message.=$mcq['question'];
							}		 
						}

						$message.='</div>';			 						
						$message.='<div class="col-xs-12 div_opt">';
						$message.=' <div class="row MB20 twopt">';
						if($user){
							$message.='<div class="col-xs-6 mobile-opt mobmb20">';
						}
						else{
							$message.='<div class="col-xs-6 mobile-opt mobmb20" onclick="popup_require_login()">';
						}
						$message.='<label class="radio-inline w-100">';								 
						$message.='<input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_'.$mcq['qid'].'" value="0">';
						$message.='<div class="input-group mobile-text-opt">';
						$message.='<span class="input-group-addon opt-mb2 bo-input-left"></span>';
						$daa= html_entity_decode($mcq['options'][0]['q_option']);
						$daa=str_replace ("<p>","",$daa);
						$daa=str_replace ("</p>","",$daa);
						$message.='<span id="optA1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> <table><tr><td><b> A:</b> </td><td>'.$daa;

						$message.='</td></tr></table></span></div>';					
						$message.='</label>';
						$message.='</div>';
						if($user){
							$message.='<div class="col-xs-6 mobile-opt" >';	
						}
						else{
							$message.='<div class="col-xs-6 mobile-opt" onclick="popup_require_login()">';
						}
						$message.='<label class="radio-inline w-100">';			 
						$message.='<input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_'.$mcq['qid'].'" value="1">';
						$message.='<div class="input-group mobile-text-opt">';
						$message.='<span class="input-group-addon opt-mb2 bo-input-left"></span>';
						$dab= html_entity_decode($mcq['options'][1]['q_option']);
						$dab=str_replace ("<p>","",$dab);
						$dab=str_replace ("</p>","",$dab);
						$message.='<span id="optB1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> <table><tr><td><b> B:</b> </td><td>'.$dab;
						$message.='</td></tr></table></span></div>';		
						$message.='</label>';
						$message.='</div>';
						$message.='</div>';
						$message.='<div class="row" >';
						if(!in_array(html_entity_decode($mcq['options'][2]['q_option']),array("", " ","  ", "   ")) ){
							if($user){
								$message.='<div class="col-xs-6 mobile-opt mobmb20">';
							}
							else{
								$message.='<div class="col-xs-6 mobile-opt mobmb20" onclick="popup_require_login()">';
							}
						}else{
							$message.='<div class="col-xs-6 mobile-opt mobmb20" style="display:none">'; 
						}
						$message.='<label class="radio-inline w-100">';				 
						$message.='<input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_'.$mcq['qid'].'" value="2">';
						$message.='<div class="input-group mobile-text-opt">';
						$message.='<span class="input-group-addon opt-mb2 bo-input-left"></span>';
						$dac= html_entity_decode($mcq['options'][2]['q_option']);
						$dac=str_replace ("<p>","",$dac);
						$dac=str_replace ("</p>","",$dac);
						$message.='<span id="optC1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> <table><tr><td><b> C:</b> </td><td>'.$dac;
						$message.='</td></tr></table></span></div>';	
						$message.='</label>';
						$message.='</div>';
						if(!in_array(html_entity_decode($mcq['options'][3]['q_option']),array("", " ","  ", "   ")) ){
							if($user){
								$message.='<div class="col-xs-6 mobile-opt" >';	
							}
							else{
								$message.='<div class="col-xs-6 mobile-opt" onclick="popup_require_login()">';
							}
						}
						else{
							$message.='<div class="col-xs-6 mobile-opt" style="display:none">'; 
						}
						$message.='<label class="radio-inline w-100">';					 
						$message.='<input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_'.$mcq['qid'].'" value="3">';
						$message.='<div class="input-group mobile-text-opt">';
						$message.='<span class="input-group-addon opt-mb2 bo-input-left"></span>';
						$dad= html_entity_decode($mcq['options'][3]['q_option']);
						$dad=str_replace ("<p>","",$dad);
						$dad=str_replace ("</p>","",$dad);
						$message.='<span id="optD1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:25px;padding-bottom:0px;overflow: hidden;"> <table><tr><td><b> D:</b> </td><td>'.$dad;
						$message.='</td></tr></table></span></div>';						
						$message.='</label>';
						$message.='</div>';	
						$message.='</div>';	
						if($mcq['n_answers']>0){
							$message.='<div class="col-xs-12 text-right mgr-20" style="float:right" >';
							$message.='<p class="f11"><i style="width:20px" class="fas fa-users mr-5 bo-tron bg-danger"></i><strong class="text-danger">'.number_format(100*$mcq['n_correct_answers']/$mcq['n_answers'],0).'%</strong> trả lời đúng</p>';
							$message.='</div>';	
						} 
						$message.='</div>';	
						$message.='</div>';	
						$message.='<div class="col-xs-12 bo-tb">';
						$message.='<div class="row">';
						$message.='<div class="col-xs-12" style="margin-bottom:5px">';
						$message.='<ul class="list-inline text-bt">';



						$message.='</div>';
						$message.='</div>';




						$message.='</div>';
						$message.='</div>';
					}
					else{
						$message='';
					}
					$message.='
					<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
					<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>';
					return $message;
				}


				public function check_answered($qid){
					$user=$this->session->userdata('logged_in');
					$this->db->where('qid',$qid);
					$this->db->where('uid',$user['uid']);
					$data=$this->db->get('savsoft_answer_mcq')->row_array();
					return $data;
				}
				public function answer_mcq($qid, $ans){
					$this->db->where("deleted", 0);
					$this->db->where('qid',$qid);
					$this->db->limit(1);	
					$data['question']= $this->db->get("savsoft_qbank")->row_array();
					$this->db->where('qid',$qid);
					$data['options']= $this->db->get("savsoft_options")->result_array();
					$data['correct']=0;
					for($i=1; $i<count($data['options']); $i++){
						if($data['options'][$i]['score']==1){
							$data['correct']=$i;
						}
					}
					$user=$this->session->userdata('logged_in');
					$istrue=0;
					if ($ans==$data['correct'])
						$istrue=1;
					$ins = array( 'qid'=>$qid,
						'uid'=>$user['uid'],
						'option_choice'=>$ans,
						'option_correct'=>$data['correct'],
						'istrue'=>$istrue
					);
					$this->db->insert('savsoft_answer_mcq', $ins);
					$this->load->model('predictio_model');
					$this->predictio_model->push_event("do",$user['uid'],$qid, $data['question']['cid'], $data['question']['lid']);
		//$this->load->model('event_racing_model');
        //$this->event_racing_model->update_views($qid, "question");
					return $data;
				}
				function change_fun_priory($qid){
					$user=$this->session->userdata('logged_in');
					if($user['su']==6 || $user['su']==1){
						$this->db->where('qid', $qid);
						$qt=$this->db->get("savsoft_qbank");
						if($qt->num_rows()>0){
							$old_priory=$qt->row_array()['fun_priory'];
							if($old_priory==1){
								$priory=2;
							}
							else if($old_priory==2){
								$priory=3;
							}
							else if($old_priory==3){
								$priory=2;
							}
							$this->db->where('qid', $qid);	  
							if($this->db->update("savsoft_qbank", array("fun_priory"=>$priory))){
								return array("success"=>"Cập nhật thành công");
							}
							else{
								return array("error"=>"Lỗi hệ thống !Vui lòng thử lại");
							}	  
						}
						else{
							return array("error"=>"Câu hỏi không tồn tại");
						}

					}
					else{
						return array("error"=>"Bạn không có quyền thực hiện tác vụ này");
					}
				}

				function like($qid){
					$user=$this->session->userdata('logged_in');
					$status=1;
					$this->db->where('model', 'qbank');
					$this->db->where('content_id', $qid);
					$this->db->where('uid', $user['uid']);
					$liked =  $this->db->get('savsoft_like');
					if($liked->num_rows()>0){
						$like_id =$liked->row_array()['like_id'];
						$like_status=$liked->row_array()['status'];
						$status =1-$like_status;
						$upd=array('uid'=>$user['uid'],
							'model'=>'qbank',
							'content_id'=>$qid,
							'status'=>$status,
						);
						$this->db->where('like_id',$like_id);
						$this->db->update('savsoft_like', $upd);		  
					}	 
					else{
						$this->db->where('qid', $qid);
						if($this->db->get('savsoft_qbank')->num_rows()>0) {
							$ins = array('uid'=>$user['uid'],
								'model'=>'qbank',
								'content_id'=>$qid,
								'status'=>$status
							); 
							$this->db->insert('savsoft_like', $ins);
						}
					}
					if($status==1){
						$this->db->where("qid", $qid);
						$qt= $this->db->get('savsoft_qbank')->row_array();
						$this->load->model('predictio_model');
						$this->predictio_model->push_event("like",$user['uid'],$qid, $qt['cid'], $qt['lid']);
					}
					$this->db->where('model', 'qbank');
					$this->db->where('content_id', $qid);
					$this->db->where('uid !=', $user['uid']);
					$this->db->where('status', 1);
					$data['n_like']=$this->db->get('savsoft_like')->num_rows();
					$data['user_name']=$user['first_name'].' '.$user['last_name'];
					return $data;	     
				} 
				public function check_like($qid){
					$user=$this->session->userdata('logged_in');
					$this->db->select('status');
					$this->db->where('model','qbank');
					$this->db->where('content_id',$qid);
					$this->db->where('uid',$user['uid']);
					$data=$this->db->get('savsoft_like')->row_array();
					return $data['status'];
				}
				function question_list($limit,$cid='0',$lid='0'){
					$logged_in=$this->session->userdata('logged_in');
					$this->db->where('savsoft_qbank.deleted',0);
					if($this->input->post('search')){
						$search=$this->input->post('search');
						$this->db->or_where('savsoft_qbank.qid',$search);
						$this->db->or_like('savsoft_qbank.question',$search);
						$this->db->or_like('savsoft_qbank.description',$search);

					}
					if($cid!='0'){
						$this->db->where('savsoft_qbank.cid',$cid);
					}
					if($lid!='0'){
						$this->db->where('savsoft_qbank.lid',$lid);
					}
					if($logged_in['su'] != '1' && $logged_in['su']!=6){
						$uid=$logged_in['uid'];
						$this->db->where('savsoft_qbank.inserted_by',$uid);
					}
					$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
					$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
					$this->db->limit($this->config->item('number_of_rows'),$limit);
					$this->db->order_by('savsoft_qbank.qid','desc');
					$query=$this->db->get('savsoft_qbank');
					return $query->result_array();
				}


				function question_list2($cid='0',$lid='0',$inserted_by='0',$page="0",$search=''){
					$logged_in=$this->session->userdata('logged_in');
					$this->db->where('savsoft_qbank.deleted',0);
					if($this->input->post('search')){
						$search=$this->input->post('search');
						$this->db->or_where('savsoft_qbank.qid',$search);
						$this->db->or_like('savsoft_qbank.question',$search);
						$this->db->or_like('savsoft_qbank.description',$search);
					}
					if($cid!='0'){
						$this->db->where('savsoft_qbank.cid',$cid);
					}
					if($lid!='0'){
						$this->db->where('savsoft_qbank.lid',$lid);
					}
					if($inserted_by!="0"){
						$this->db->where('savsoft_qbank.inserted_by',$inserted_by);
					}
					if($search != ''){
						$this->db->like('savsoft_qbank.question',$search);
					}
					if($logged_in['su'] != '1' && $logged_in['su']!=6){
						$uid=$logged_in['uid'];
						$this->db->where('savsoft_qbank.inserted_by',$uid);
					}
					$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
					$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
					$this->db->join('savsoft_users','savsoft_users.uid=savsoft_qbank.inserted_by');
					$this->db->limit(20);
					$this->db->offset(20*$page);
					$this->db->order_by('savsoft_qbank.qid','desc');
					$query=$this->db->get('savsoft_qbank');
					return $query->result_array();
				}

				function number_question($cid='0',$lid='0',$inserted_by='0',$s){
					$logged_in=$this->session->userdata('logged_in');
					$this->db->select("qid");
					$this->db->where('savsoft_qbank.deleted',0);
					if($this->input->post('search')){
						$search=$this->input->post('search');
						$this->db->or_where('savsoft_qbank.qid',$search);
						$this->db->or_like('savsoft_qbank.question',$search);
						$this->db->or_like('savsoft_qbank.description',$search);
					}
					if($cid!='0'){
						$this->db->where('savsoft_qbank.cid',$cid);
					}
					if($lid!='0'){
						$this->db->where('savsoft_qbank.lid',$lid);
					}
					if($inserted_by!="0"){
						$this->db->where('savsoft_qbank.inserted_by',$inserted_by);
					}
					if($s!='')
					{
						$this->db->like('savsoft_qbank.question',$s);
					}
					if($logged_in['su'] != '1' && $logged_in['su']!=6){
						$uid=$logged_in['uid'];
						$this->db->where('savsoft_qbank.inserted_by',$uid);
					}
					$this->db->join('savsoft_category','savsoft_category.cid=savsoft_qbank.cid');
					$this->db->join('savsoft_level','savsoft_level.lid=savsoft_qbank.lid');
					$this->db->join('savsoft_users','savsoft_users.uid=savsoft_qbank.inserted_by');
					$this->db->order_by('savsoft_qbank.qid','desc');
					$query=$this->db->get('savsoft_qbank');
					return $query->num_rows();
				}

				function rand_one_question(){
					$this->db->order_by('rand()');
					$this->db->limit(1);
					$query = $this->db->get('savsoft_qbank');

					return $query->result_array()[0];
				}

				function rand_one_question_1(){
					$check=0;
					while($check==0){
						$this->db->order_by('rand()');
						$this->db->limit(1);
						$quiz = $this->db->get('savsoft_quiz')->result_array();
						$qids = $quiz[0]['qids'];
						if($qids!=''){
							$qid_array = explode(",",$qids);
							$rand_question_id= $qid_array[array_rand($qid_array,1)];
							$this->db->where('qid',$rand_question_id);
							$question = $this->db->get('savsoft_qbank')->result_array();
							$question[0]['quiz_name'] = $quiz[0]['quiz_name'];
							$question[0]['quid'] = $quiz[0]['quid'];
							$check=1;
						}
					}

					return $question[0];
				}

				function load_option($qid){
					$this->db->where('qid',$qid);
					$options = $this->db->get('savsoft_options');
					return $options->result_array();
				}

				function load_question($qid){
					$this->db->where('qid',$qid);
					$this->db->where('deleted',0);
					$query=$this->db->get('savsoft_qbank');
					return $query->result_array();
				}

				function num_qbank(){
					$logged_in=$this->session->userdata('logged_in');

					if($logged_in['su'] != '1'){
						$uid=$logged_in['uid'];
						$this->db->where('deleted',0);
						$this->db->where('savsoft_qbank.inserted_by',$uid);
					} 
					$query=$this->db->get('savsoft_qbank');
					return $query->num_rows();
				}



				function get_question($qid){
					$this->db->where('qid',$qid);
					$this->db->where('deleted',0);
					$query=$this->db->get('savsoft_qbank');
					return $query->row_array();


				}
				function get_option($qid){
					$this->db->where('qid',$qid);
					$query=$this->db->get('savsoft_options');
					return $query->result_array();


				}

				function remove_question($qid){

					$this->db->where('qid',$qid);
					if($this->db->update('savsoft_qbank', array('deleted'=>1))){
		  //$this->db->where('qid',$qid);
			//$this->db->delete('savsoft_options');

						
						$qr=$this->db->query("select * from savsoft_quiz where FIND_IN_SET($qid, qids) ");

						foreach($qr->result_array() as $k =>$val){

							$quid=$val['quid'];
							$qids=explode(',',$val['qids']);
							$nqids=array();
							foreach($qids as $qk => $qv){
								if($qv != $qid){
									$nqids[]=$qv;
								}
							}
							$noq=count($nqids);
							$nqids=implode(',',$nqids);
							$this->db->query(" update savsoft_quiz set qids='$nqids', noq='$noq' where quid='$quid' ");
						}

						$this->db->where('question_id', $qid);
						$this->db->delete('question_tag_rel');

						return true;
					}else{

						return false;
					}


				}


				function insert_question_1(){
					$fp=$this->input->post('mcqfun');
					if(!$fp) $fp=0;
					else  $fp=2;
					$logorg=$this->input->post('logorg');
					if(!$logorg) $logorg=0;
					$q =$this->input->post('question');
					$origImageSrc="";
					$sourcemcq=$this->input->post('sourcemcq'); 
					$unitmcq=$this->input->post('unitmcq'); 	  
					$lesson=$this->input->post('lessonmcq'); 
					$imgTags="";	
					$htmlContent=$q;
					if(strpos($q,'www.w3.org/1998/Math/MathML')===false && strpos($q,"<iframe") ===false){
						preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
						for ($j = 0; $j < count($imgTags[0]); $j++) {
							preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
							$origImageSrc = str_ireplace( 'src="', '',  $image[0]);

						}
						if(strpos($origImageSrc, '..')!==false){
							$pos= strpos($origImageSrc, '/upload');
							$origImageSrc=base_url(). substr($origImageSrc,$pos);
						}
						if(count($imgTags[0])<2 ){
							if(strpos($origImageSrc, "latex.codecogs.com")===false){
								if(count($imgTags[0])==1){
									$qt='<div class="imgqtt" ><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
								}
								$qt.=strip_tags($q);
								$q=$qt;
							}
						}
					}
					$q=str_replace("http://latex.codecogs.com","https://latex.codecogs.com",$q) ;
					$userdata=array(
						'paragraph'=>$this->input->post('paragraph'),
						'question'=>$q,
						'description'=>$this->input->post('description'),
						'question_type'=>$this->lang->line('multiple_choice_single_answer'),
						'cid'=>$this->input->post('cid'),
						'lid'=>$this->input->post('lid'),
						'background_template'=>$this->input->post('bgqid'),	
						'fun_priory'=> $fp,
						'show_logo'=> $logorg,
						'source'=> $sourcemcq,
						'unit'=> $unitmcq,	 
						'lesson'=> $lesson,
						'type'=> $this->input->post("q_type")
					);
					$logged_in=$this->session->userdata('logged_in');
					$uid=$logged_in['uid'];
					$fname=$logged_in['first_name'].' '.$logged_in['last_name'];
					$userdata['inserted_by']=$uid;
					$userdata['inserted_by_name']=$fname;
					if($uid==1 || $uid==224 || $uid== 193){
						$userdata['status']=1;
					}

					$lang=$this->config->item('question_lang');
					foreach($lang as $lk => $lv){
						if($lk > 0){
							if($this->input->post('question'.$lk)){
								$userdata['paragraph'.$lk]=$this->input->post('paragraph'.$lk); 
								$userdata['question'.$lk]=$this->input->post('question'.$lk); 
								$userdata['description'.$lk]=$this->input->post('description'.$lk); 
							}	 
						}	
						$userdata['answer_time']= $this->input->post('answer_time');
						if($userdata['answer_time']<0) $userdata['answer_time']=60;

					}

					$this->db->insert('savsoft_qbank',$userdata);
					$qid=$this->db->insert_id();

					if($uid==1 || $uid==224 || $uid== 193){
						$this->load->model('predictio_model');
						$this->predictio_model->push_event_set($qid, $this->input->post('cid'), $this->input->post('lid'));
					}

					$this->session->set_flashdata('qid',$qid);
					foreach($this->input->post('option') as $key => $val){
						if($this->input->post('score')==$key){
							$score=1;
						}else{
							$score=0;
						}
						$val= str_replace("<p>","",$val);
						$val= str_replace("</p>","",$val);
		/*$val= str_replace("<","&lt;",$val);
		 $val= str_replace(">","&gt;",$val);
		 $val= str_replace("\"","&quot;",$val);
		 $val= str_replace("'","&apos;",$val);*/	 
		 $userdata=array(
		 	'q_option'=>$val,
		 	'qid'=>$qid,
		 	'score'=>$score,
		 );
		 $lang=$this->config->item('question_lang');
		 foreach($lang as $lk => $lv){

		 	if($lk > 0){

		 		if(isset($_POST['option'.$lk])){
		 			print_r($this->input->post('option1'));
		 			$eopo=$this->input->post('option'.$lk);
		 			$userdata['q_option'.$lk]=$eopo[$key];  
		 		}	 
		 	}		  
		 }


		 $this->db->insert('savsoft_options',$userdata);	 
		 
		}

		$strtag = $this->input->post('tags');
		$tags= explode(',', $strtag);
		foreach($tags as $tag){
			$tag1 = ltrim($tag);
			$tag1 = rtrim($tag1);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			if($result->num_rows()==0){
				$this->db->insert('tags', array('tag_name'=>$tag1));
			}
		}
		foreach($tags as $tag){
			$tag1 = ltrim($tag);
			$tag1 = rtrim($tag1);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			$tid = $result->result_array()[0]['tag_id'];
			$this->db->insert('question_tag_rel', array('tag_id'=>$tid, 'question_id'=>$qid));
		}

		$unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
		); 
		$qt=$this->input->post('question');		

		$qt =html_entity_decode( strip_tags( $qt ) );

		foreach($unicode as $nonUnicode=>$uni){
			$qt = preg_replace("/($uni)/i", $nonUnicode, $qt);
		}
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			'%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			'%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
		$qt = str_replace(array(' '),'-',$qt);
		$qt =urlencode ($qt);
		$qt = str_replace($comma,'',$qt);
		$qt = str_replace(array('%'),'',$qt);
		if($qt==""){
			$qt=$qid;
		}
		else
			$qt.='-'.$qid;
		while(strpos($qt, '--'))
			$qt = str_replace(array('--'),'-',$qt);
		$this->db->insert('savsoft_permalink', array("model"=>"qbank", "content_id"=>$qid, "permalink"=>$qt));

		$this->db->where('rule_id', 1);
		$pc=$this->db->get('quiz_rule')->result_array();
		$point_change = $pc[0]['point_change'];
		$this->db->where('uid', $uid);
		$us=$this->db->get('savsoft_users')->result_array();

		$point = $us[0]['point']+$point_change;
		$point_array=array('point'=>$point);
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',$point_array);
		$history= array( 'uid'=> $uid, 'activity'=>'Tạo ra 1 câu hỏi', 'point_change'=>$point_change);
		$this->db->insert('history_point_change', $history);
		return true;

	}

	function insert_video_question(){
		$data = json_decode($this->input->raw_input_stream,true);
		$fp=$data['fp'];
		if(!$fp) $fp=0;
		else  $fp=2;
		$q =$data['question'];
		$origImageSrc="";
		$sourcemcq=$data['source']; 
		$sl=$data['sl'];
		$imgTags="";	
		$htmlContent=$q;
		if(strpos($q,'www.w3.org/1998/Math/MathML')===false && strpos($q,"<iframe") ===false){
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);

			}
			if(strpos($origImageSrc, '..')!==false){
				$pos= strpos($origImageSrc, '/upload');
				$origImageSrc=base_url(). substr($origImageSrc,$pos);
			}
			if(count($imgTags[0])<2 ){
				if(strpos($origImageSrc, "http://latex.codecogs.com")===false){
					if(count($imgTags[0])==1){
						$qt='<div class="imgqtt" ><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					}
					$qt.=strip_tags($q);
					$q=$qt;
				}
			}
		}
		$q=str_replace("http://latex.codecogs.com","https://latex.codecogs.com",$q) ;
		$userdata=array(
			'question'=>$q,
			'description'=>$data['description'],
			'question_type'=>$this->lang->line('multiple_choice_single_answer'),
			'cid'=>$data['cid'],
			'lid'=>$data['lid'],
			'background_template'=>$this->input->post('bgqid'),	
			'fun_priory'=> $fp,
			'source'=> $sourcemcq,
			'show_logo'=>$sl,
			'unit'=>$data['unit'],
			'lesson'=>$data['lesson'],
			'type'=>$data['type']
		);
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$fname=$logged_in['first_name'].' '.$logged_in['last_name'];
		$userdata['inserted_by']=$uid;
		$userdata['inserted_by_name']=$fname;
		if($uid==1 || $uid==224 || $uid== 193){
			$userdata['status']=1;
		}


		$userdata['answer_time']= $data['answer_time'];
		if($userdata['answer_time']<0) $userdata['answer_time']=60;

		$this->db->insert('savsoft_qbank',$userdata);
		$qid=$this->db->insert_id();

		if($uid==1 || $uid==224 || $uid== 193){
			$this->load->model('predictio_model');
			$this->predictio_model->push_event_set($qid, $data['cid'],$data['lid']);
		}
		$this->session->set_flashdata('qid',$qid);
		for($i=0; $i<4; $i++){
			if($i==$data['correct_opt']){
				$score=1;
			}else{
				$score=0;
			}
			$userdata=array(
				'q_option'=>$data['opt'.$i],
				'qid'=>$qid,
				'score'=>$score,
			);

			$this->db->insert('savsoft_options',$userdata);	 

		}


		$strtag = $data['tags'];
		$tags= explode(',', $strtag);
		foreach($tags as $tag){
			$tag1 = trim($tag);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			if($result->num_rows()==0){
				$this->db->insert('tags', array('tag_name'=>$tag1));
			}
		}
		foreach($tags as $tag){
			$tag1 = trim($tag);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			$tid = $result->result_array()[0]['tag_id'];
			$this->db->insert('question_tag_rel', array('tag_id'=>$tid, 'question_id'=>$qid));
		}

		$unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
		); 
		$qt=$data['question'];		

		$qt =html_entity_decode( strip_tags( $qt ) );

		foreach($unicode as $nonUnicode=>$uni){
			$qt = preg_replace("/($uni)/i", $nonUnicode, $qt);
		}
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			'%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			'%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
		$qt = str_replace(array(' '),'-',$qt);
		$qt =urlencode ($qt);
		$qt = str_replace($comma,'',$qt);
		$qt = str_replace(array('%'),'',$qt);
		if($qt==""){
			$qt=$qid;
		}
		else
			$qt.='-'.$qid;
		while(strpos($qt, '--'))
			$qt = str_replace(array('--'),'-',$qt);
		$this->db->insert('savsoft_permalink', array("model"=>"qbank", "content_id"=>$qid, "permalink"=>$qt));

		$this->db->where('rule_id', 1);
		$pc=$this->db->get('quiz_rule')->result_array();
		$point_change = $pc[0]['point_change'];
		$this->db->where('uid', $uid);
		$us=$this->db->get('savsoft_users')->result_array();

		$point = $us[0]['point']+$point_change;
		$point_array=array('point'=>$point);
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',$point_array);
		$history= array( 'uid'=> $uid, 'activity'=>'Tạo ra 1 câu hỏi', 'point_change'=>$point_change);
		$this->db->insert('history_point_change', $history);
		return true;

	}


	function insert_question_0(){
		$fp=$this->input->post('mcqfun');
		if(!$fp) $fp=0;
		else  $fp=2;
		$q =$this->input->post('question');
		$origImageSrc="";
		$sourcemcq=$this->input->post('sourcemcq');
		$unitmcq=$this->input->post('unitmcq');       
		$lesson=$this->input->post('lessonmcq'); 	   
		$imgTags="";	
		$htmlContent=$q;
		if(strpos($q,'www.w3.org/1998/Math/MathML')===false && strpos($q,"<iframe") ===false){
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);

			}
			if(strpos($origImageSrc, '..')!==false){
				$pos= strpos($origImageSrc, '/upload');
				$origImageSrc=base_url(). substr($origImageSrc,$pos);
			}
			if(count($imgTags[0])<2 ){
				if(strpos($origImageSrc, "http://latex.codecogs.com")===false){
					if(count($imgTags[0])==1){
						$qt='<div class="imgqtt" ><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					}
					$qt.=strip_tags($q);
					$q=$qt;
				}
			}
		}
		$q=str_replace("http://latex.codecogs.com","https://latex.codecogs.com",$q) ;
		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$q,
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('multiple_choice_single_answer'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid'),
			'background_template'=>$this->input->post('bgqid'),	
			'fun_priory'=> $fp,
			'source'=> $sourcemcq,
			"unit"=>$unitmcq,	  
			"lesson"=>$lesson

		);
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$fname=$logged_in['first_name'].' '.$logged_in['last_name'];
		$userdata['inserted_by']=$uid;
		$userdata['inserted_by_name']=$fname;
		if($uid==1 || $uid==224 || $uid== 193){
			$userdata['status']=1;
		}
		$lang=$this->config->item('question_lang');
		foreach($lang as $lk => $lv){
			if($lk > 0){
				if($this->input->post('question'.$lk)){
					$userdata['paragraph'.$lk]=$this->input->post('paragraph'.$lk); 
					$userdata['question'.$lk]=$this->input->post('question'.$lk); 
					$userdata['description'.$lk]=$this->input->post('description'.$lk); 
				}	 
			}	
			$userdata['answer_time']= $this->input->post('answer_time');
			if($userdata['answer_time']<0) $userdata['answer_time']=60;

		}

		$this->db->insert('savsoft_qbank',$userdata);
		$qid=$this->db->insert_id();
		if($uid==1 || $uid==224 || $uid== 193){
			$this->load->model('predictio_model');
			$this->predictio_model->push_event_set($qid, $this->input->post('cid'), $this->input->post('lid'));
		}
		$this->session->set_flashdata('qid',$qid);
		foreach($this->input->post('option') as $key => $val){
			if($this->input->post('score')==$key){
				$score=1;
			}else{
				$score=0;
			}
			$val= str_replace("<p>","",$val);
			$val= str_replace("</p>","",$val);	 
	 /*$val= str_replace("<","&lt;",$val);
		 $val= str_replace(">","&gt;",$val);
		 $val= str_replace("\"","&quot;",$val);
		 $val= str_replace("'","&apos;",$val);*/
		 $userdata=array(
		 	'q_option'=>$val,
		 	'qid'=>$qid,
		 	'score'=>$score,
		 );
		 $lang=$this->config->item('question_lang');
		 foreach($lang as $lk => $lv){

		 	if($lk > 0){

		 		if(isset($_POST['option'.$lk])){
		 			print_r($this->input->post('option1'));
		 			$eopo=$this->input->post('option'.$lk);
		 			$userdata['q_option'.$lk]=$eopo[$key];  
		 		}	 
		 	}		  
		 }


		 $this->db->insert('savsoft_options',$userdata);	 
		 
		}

		$strtag = $this->input->post('tags');
		$tags= explode(',', $strtag);
		foreach($tags as $tag){
			$tag1 = ltrim($tag);
			$tag1 = rtrim($tag1);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			if($result->num_rows()==0){
				$this->db->insert('tags', array('tag_name'=>$tag1));
			}
		}
		foreach($tags as $tag){
			$tag1 = ltrim($tag);
			$tag1 = rtrim($tag1);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			$tid = $result->result_array()[0]['tag_id'];
			$this->db->insert('question_tag_rel', array('tag_id'=>$tid, 'question_id'=>$qid));
		}

		$unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
		); 
		$qt=$this->input->post('question');		

		$qt =html_entity_decode( strip_tags( $qt ) );

		foreach($unicode as $nonUnicode=>$uni){
			$qt = preg_replace("/($uni)/i", $nonUnicode, $qt);
		}
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			'%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			'%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
		$qt = str_replace(array(' '),'-',$qt);
		$qt =urlencode ($qt);
		$qt = str_replace($comma,'',$qt);
		$qt = str_replace(array('%'),'',$qt);
		if($qt==""){
			$qt=$qid;
		}
		else
			$qt.='-'.$qid;
		while(strpos($qt, '--'))
			$qt = str_replace(array('--'),'-',$qt);
		$this->db->insert('savsoft_permalink', array("model"=>"qbank", "content_id"=>$qid, "permalink"=>$qt));

		$this->db->where('rule_id', 1);
		$pc=$this->db->get('quiz_rule')->result_array();
		$point_change = $pc[0]['point_change'];
		$this->db->where('uid', $uid);
		$us=$this->db->get('savsoft_users')->result_array();

		$point = $us[0]['point']+$point_change;
		$point_array=array('point'=>$point);
		$this->db->where('uid', $uid);
		$this->db->update('savsoft_users',$point_array);
		$history= array( 'uid'=> $uid, 'activity'=>'Tạo ra 1 câu hỏi', 'point_change'=>$point_change);
		$this->db->insert('history_point_change', $history);
		return true;

	}



	function insert_question_2(){


		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$this->input->post('question'),
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('multiple_choice_multiple_answer'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid')	 
		);
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$fname=$logged_in['first_name'].' '.$logged_in['last_name'];
		$userdata['inserted_by']=$uid;
		$userdata['inserted_by_name']=$fname;
		if($uid==1 || $uid==224 || $uid== 193){
			$userdata['status']=1;
		}
		$this->db->insert('savsoft_qbank',$userdata);
		$qid=$this->db->insert_id();
		if($uid==1 || $uid==224 || $uid== 193){
			$this->load->model('predictio_model');
			$this->predictio_model->push_event_set($qid, $this->input->post('cid'), $this->input->post('lid'));
		}
		$this->session->set_flashdata('qid',$qid);
		foreach($this->input->post('option') as $key => $val){
			if(in_array($key,$this->input->post('score'))){
				$score=(1/count($this->input->post('score')));
			}else{
				$score=0;
			}
			$userdata=array(
				'q_option'=>$val,
				'qid'=>$qid,
				'score'=>$score,
			);
			$this->db->insert('savsoft_options',$userdata);	 

		}

		return true;

	}


	function insert_question_3(){


		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$this->input->post('question'),
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('match_the_column'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid')	 
		);
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$fname=$logged_in['first_name'].' '.$logged_in['last_name'];
		$userdata['inserted_by']=$uid;
		$userdata['inserted_by_name']=$fname;
		$this->db->insert('savsoft_qbank',$userdata);
		$qid=$this->db->insert_id();
		$this->session->set_flashdata('qid',$qid);
		foreach($this->input->post('option') as $key => $val){
			$score=(1/count($this->input->post('option')));
			$userdata=array(
				'q_option'=>$val,
				'q_option_match'=>$_POST['option2'][$key],
				'qid'=>$qid,
				'score'=>$score,
			);
			if($uid==1 || $uid==224 || $uid== 193){
				$userdata['status']=1;
			}
			$this->db->insert('savsoft_options',$userdata);	 

		}

		return true;

	}




	function insert_question_4(){


		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$this->input->post('question'),
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('short_answer'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid')	 
		);
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$fname=$logged_in['first_name'].' '.$logged_in['last_name'];
		$userdata['inserted_by']=$uid;
		$userdata['inserted_by_name']=$fname;
		$this->db->insert('savsoft_qbank',$userdata);
		$qid=$this->db->insert_id();
		$this->session->set_flashdata('qid',$qid);
		foreach($this->input->post('option') as $key => $val){
			$score=1;
			$userdata=array(
				'q_option'=>$val,
				'qid'=>$qid,
				'score'=>$score,
			);
			$this->db->insert('savsoft_options',$userdata);	 

		}

		return true;

	}


	function insert_question_5(){


		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$this->input->post('question'),
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('long_answer'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid')	 
		);
		$logged_in=$this->session->userdata('logged_in');
		$uid=$logged_in['uid'];
		$fname=$logged_in['first_name'].' '.$logged_in['last_name'];
		$userdata['inserted_by']=$uid;
		$userdata['inserted_by_name']=$fname;
		$this->db->insert('savsoft_qbank',$userdata);
		$qid=$this->db->insert_id();
		$this->session->set_flashdata('qid',$qid);

		return true;

	}

	function update_question_0(){
		$data = json_decode($this->input->raw_input_stream,true);
		$qid = $data['qid'];
		$fp = $data['fp'];
		$this->db->where("qid",$qid);
		$ofp = $this->db->get("savsoft_qbank")->row_array()['fun_priory'];
		$nfp=0;
		if($fp==0){
			$nfp=0;
		}
		else{
			if($ofp==0){
				$nfp=2;
			}
			else{
				$nfp=$ofp; 
			}
		}
		$sl=$data['sl'];
		$q =$data['question'];
		$origImageSrc="";
		$imgTags="";	
		$htmlContent=$q;
		if(strpos($q,'www.w3.org/1998/Math/MathML')===false && strpos($q,"<iframe") ===false){
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);

			}
			if(strpos($origImageSrc, '..')!==false){
				$pos= strpos($origImageSrc, '/upload');
				$origImageSrc=base_url(). substr($origImageSrc,$pos);
			}
			if(count($imgTags[0])<2 ){
				if(strpos($origImageSrc, "latex.codecogs.com")===false){
					if(count($imgTags[0])==1){
						$qt='<div class="imgqtt" ><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					}
					$qt.=strip_tags($q);
					$q=$qt;
				}
			}
		}
		$q=str_replace("http://latex.codecogs.com","https://latex.codecogs.com",$q) ;
		$userdata=array(
			'question'=>$q,
			'description'=>$data['description'],
			'cid'=>$data['cid'],
			'lid'=>$data['lid'],
			'answer_time'=>$data['answer_time'],
			'fun_priory'=>$nfp,
			'show_logo'=>$sl,
			'source'=>$data['source'],
			'unit'=>$data['unit'],
			'lesson'=>$data['lesson'],
			'type'=>$data['type'],
		);
		$lang=$this->config->item('question_lang');

		$this->db->where('qid',$qid);
		$this->db->update('savsoft_qbank',$userdata);

		$this->db->where('qid',$qid);
		$this->db->delete('savsoft_options');

		for($i=0; $i<4; $i++){


			if($i==$data['correct_opt']){
				$score=1;
			}else{
				$score=0;
			}
			$userdata=array(
				'q_option'=>$data['opt'.$i],
				'qid'=>$qid,
				'score'=>$score,
			);

			$this->db->insert('savsoft_options',$userdata);	 

		}
		$this->db->where('question_id',$qid);
		$this->db->delete('question_tag_rel');
		$strtag = $data['tags'];
		$tags= explode(',', $strtag);
		foreach($tags as $tag){
			$tag1 = ltrim($tag);
			$tag1 = rtrim($tag1);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			if($result->num_rows()==0){
				$this->db->insert('tags', array('tag_name'=>$tag1));
			}
		}
		foreach($tags as $tag){
			$tag1 = ltrim($tag);
			$tag1 = rtrim($tag1);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			$tid = $result->result_array()[0]['tag_id'];
			$this->db->insert('question_tag_rel', array('tag_id'=>$tid, 'question_id'=>$qid));
		}
		$unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
		); 
		$qt=$data['question'];		
		$pos=strrpos($qt, "<iframe");

		$qt =html_entity_decode( strip_tags( $qt ) );

		foreach($unicode as $nonUnicode=>$uni){
			$qt = preg_replace("/($uni)/i", $nonUnicode, $qt);
		}
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			'%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			'%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
		$qt = str_replace(array(' '),'-',$qt);
		$qt =urlencode ($qt);
		$qt = str_replace($comma,'',$qt);
		$qt = str_replace(array('%'),'',$qt);
		if($qt==""){
			$qt=$qid;
		}
		else
			$qt.='-'.$qid;
		while(strpos($qt, '--'))
			$qt = str_replace(array('--'),'-',$qt);
		$this->db->where("content_id",$qid);
		$this->db->update('savsoft_permalink', array("model"=>"qbank", "permalink"=>$qt));



		return true;

	}

	function update_question_1($qid){

		$fp=$this->input->post('mcqfun');
		if(!$fp) $fp=0;
		else  $fp=2;
		$q =$this->input->post('question');
		$origImageSrc="";
		$imgTags="";	
		$htmlContent=$q;
		$sourcemcq=$this->input->post('sourcemcq'); 
		$unitmcq=$this->input->post('unitmcq'); 
		$lesson=$this->input->post('lessonmcq'); 
		if(strpos($q,'www.w3.org/1998/Math/MathML')===false && strpos($q,"<iframe") ===false){
			preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
			for ($j = 0; $j < count($imgTags[0]); $j++) {
				preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);

			}
			if(strpos($origImageSrc, '..')!==false){
				$pos= strpos($origImageSrc, '/upload');
				$origImageSrc=base_url(). substr($origImageSrc,$pos);
			}
			if(count($imgTags[0])<2 ){
				if(strpos($origImageSrc, "latex.codecogs.com")===false){
					if(count($imgTags[0])==1){
						$qt='<div class="imgqtt" ><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';
					}
					$qt.=strip_tags($q);
					$q=$qt;
				}
			}
		}
		$q=str_replace("http://latex.codecogs.com","https://latex.codecogs.com",$q) ;

		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$q,
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('multiple_choice_single_answer'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid'),
			'source'=>	$sourcemcq,	 
			'unit'=>$unitmcq,
			'lesson'=>$lesson,
			'fun_priory'=>$fp,
			'show_logo'=>$this->input->post('logorg'),
			'type'=>$this->input->post('q_type'),
		);
		$lang=$this->config->item('question_lang');
		foreach($lang as $lk => $lv){
			if($lk > 0){
				if($this->input->post('question'.$lk)){
					$userdata['paragraph'.$lk]=$this->input->post('paragraph'.$lk); 
					$userdata['question'.$lk]=$this->input->post('question'.$lk); 
					$userdata['description'.$lk]=$this->input->post('description'.$lk); 
				}	 
			}		  
		}

		$userdata['answer_time']= $this->input->post('answer_time');
		if($userdata['answer_time']<0) $userdata['answer_time']=60;
		$this->db->where('qid',$qid);
		$this->db->update('savsoft_qbank',$userdata);

		$this->db->where('qid',$qid);
		$this->db->delete('savsoft_options');
		foreach($this->input->post('option') as $key => $val){


			if($this->input->post('score')==$key){
				$score=1;
			}else{
				$score=0;
			}
			$userdata=array(
				'q_option'=>$val,
				'qid'=>$qid,
				'score'=>$score,
			);
			$lang=$this->config->item('question_lang');
			foreach($lang as $lk => $lv){

				if($lk > 0){

					if(isset($_POST['option'.$lk])){
						print_r($this->input->post('option1'));
						$eopo=$this->input->post('option'.$lk);
						$userdata['q_option'.$lk]=$eopo[$key];  
					}	 
				}		  
			}
			$this->db->insert('savsoft_options',$userdata);	 

		}
		$this->db->where('question_id',$qid);
		$this->db->delete('question_tag_rel');
		$strtag = $this->input->post('tags');
		$tags= explode(',', $strtag);
		foreach($tags as $tag){
			$tag1 = ltrim($tag);
			$tag1 = rtrim($tag1);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			if($result->num_rows()==0){
				$this->db->insert('tags', array('tag_name'=>$tag1));
			}
		}
		foreach($tags as $tag){
			$tag1 = ltrim($tag);
			$tag1 = rtrim($tag1);
			$this->db->where('tag_name', $tag1);
			$result = $this->db->get('tags');
			$tid = $result->result_array()[0]['tag_id'];
			$this->db->insert('question_tag_rel', array('tag_id'=>$tid, 'question_id'=>$qid));
		}
		$unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
			'd'=>'đ|Đ',		 
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
		); 
		$qt=$this->input->post('question');		
		$pos=strrpos($qt, "<iframe");

		$qt =html_entity_decode( strip_tags( $qt ) );

		foreach($unicode as $nonUnicode=>$uni){
			$qt = preg_replace("/($uni)/i", $nonUnicode, $qt);
		}
		$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
			'%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
			'%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
		$qt = str_replace(array(' '),'-',$qt);
		$qt =urlencode ($qt);
		$qt = str_replace($comma,'',$qt);
		$qt = str_replace(array('%'),'',$qt);
		if($qt==""){
			$qt=$qid;
		}
		else
			$qt.='-'.$qid;
		while(strpos($qt, '--'))
			$qt = str_replace(array('--'),'-',$qt);
		$this->db->where("content_id",$qid);
		$this->db->update('savsoft_permalink', array("model"=>"qbank", "permalink"=>$qt));


		return true;

	}





	function update_question_2($qid){


		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$this->input->post('question'),
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('multiple_choice_multiple_answer'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid')	 
		);
		$this->db->where('qid',$qid);
		$this->db->update('savsoft_qbank',$userdata);
		$this->db->where('qid',$qid);
		$this->db->delete('savsoft_options');
		foreach($this->input->post('option') as $key => $val){
			if(in_array($key,$this->input->post('score'))){
				$score=(1/count($this->input->post('score')));
			}else{
				$score=0;
			}
			$userdata=array(
				'q_option'=>$val,
				'qid'=>$qid,
				'score'=>$score,
			);
			$this->db->insert('savsoft_options',$userdata);	 

		}

		return true;

	}


	function update_question_3($qid){


		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$this->input->post('question'),
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('match_the_column'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid')	 
		);
		$this->db->where('qid',$qid);
		$this->db->update('savsoft_qbank',$userdata);
		$this->db->where('qid',$qid);
		$this->db->delete('savsoft_options');
		foreach($this->input->post('option') as $key => $val){
			$score=(1/count($this->input->post('option')));
			$userdata=array(
				'q_option'=>$val,
				'q_option_match'=>$_POST['option2'][$key],
				'qid'=>$qid,
				'score'=>$score,
			);
			$this->db->insert('savsoft_options',$userdata);	 

		}

		return true;

	}




	function update_question_4($qid){


		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$this->input->post('question'),
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('short_answer'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid')	 
		);
		$this->db->where('qid',$qid);
		$this->db->update('savsoft_qbank',$userdata);
		$this->db->where('qid',$qid);
		$this->db->delete('savsoft_options');
		foreach($this->input->post('option') as $key => $val){
			$score=1;
			$userdata=array(
				'q_option'=>$val,
				'qid'=>$qid,
				'score'=>$score,
			);
			$this->db->insert('savsoft_options',$userdata);	 

		}

		return true;

	}


	function update_question_5($qid){


		$userdata=array(
			'paragraph'=>$this->input->post('paragraph'),
			'question'=>$this->input->post('question'),
			'description'=>$this->input->post('description'),
			'question_type'=>$this->lang->line('long_answer'),
			'cid'=>$this->input->post('cid'),
			'lid'=>$this->input->post('lid')	 
		);
		$this->db->where('qid',$qid);
		$this->db->update('savsoft_qbank',$userdata);
		$this->db->where('qid',$qid);
		$this->db->delete('savsoft_options');


		return true;

	}




 // category function start
	function category_list(){
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		if ( ! $categ = $this->cache->get('cache_categ')) {

			$this->db->order_by('cid','desc');
			$categ=$this->db->get('savsoft_category')->result_array();
			for($i=0; $i<count($categ); $i++){
				$this->db->where('model','category');
				$this->db->where('content_id',$categ[$i]['cid']);
				$categ[$i]['category_permalink']=$this->db->get('savsoft_permalink')->row_array()['permalink'];
			}

			$this->cache->save('cache_categ', $categ, 864000);
		}

		return $categ;

	}




	function update_category($cid){

		$userdata=array(
			'category_name'=>$this->input->post('category_name'),

		);

		$this->db->where('cid',$cid);
		if($this->db->update('savsoft_category',$userdata)){
			
			return true;
		}else{
			
			return false;
		}

	}



	function remove_category($cid){

		$this->db->where('cid',$cid);
		if($this->db->delete('savsoft_category')){
			return true;
		}else{

			return false;
		}


	}



	function insert_category(){

		$userdata=array(
			'category_name'=>$this->input->post('category_name'),
		);
		
		if($this->db->insert('savsoft_category',$userdata)){
			$cid=$this->db->insert_id();
			$unicode = array(
				'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',		 
				'd'=>'đ|Đ',		 
				'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',			 
				'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',		 
				'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',	 
				'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',	 
				'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',	 	 
			); 
			
			$cate=$this->input->post('category_name');
			
			$cate =html_entity_decode( strip_tags( $cate ) );

			foreach($unicode as $nonUnicode=>$uni){
				$cate = preg_replace("/($uni)/i", $nonUnicode, $cate);
			}
			$comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
				'%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
				'%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
			$cate = str_replace(array(' '),'-',$cate);
			$cate =urlencode ($cate);
			$cate = str_replace($comma,'',$cate);
			$cate = str_replace(array('%'),'',$cate);


			while(strpos($cate, '--'))
				$cate = str_replace(array('--'),'-',$cate);
			$this->db->insert('savsoft_permalink', array("model"=>"category", "content_id"=>$cid, "permalink"=>$cate));

			return true;
		}else{

			return false;
		}

	}

 // category function end






// level function start
	function level_list($extends=0){

		if($extends==0){
			$this->db->where('lid <', 16);
		}
		$query=$this->db->get('savsoft_level')->result_array();

		return $query;

	}



  // inserted by start
	function inserted_by(){
		$this->db->select('savsoft_qbank.inserted_by,savsoft_users.first_name,savsoft_users.last_name');
		$this->db->join('savsoft_users','savsoft_qbank.inserted_by = savsoft_users.uid');
		$this->db->group_by('savsoft_qbank.inserted_by');
		$query = $this->db->get('savsoft_qbank');
		return $query->result_array(); 
	}



	function update_level($lid){

		$userdata=array(
			'level_name'=>$this->input->post('level_name'),

		);

		$this->db->where('lid',$lid);
		if($this->db->update('savsoft_level',$userdata)){
			
			return true;
		}else{
			
			return false;
		}

	}



	function remove_level($lid){

		$this->db->where('lid',$lid);
		if($this->db->delete('savsoft_level')){
			return true;
		}else{

			return false;
		}


	}



	function insert_level(){

		$userdata=array(
			'level_name'=>$this->input->post('level_name'),
		);
		
		if($this->db->insert('savsoft_level',$userdata)){
			
			return true;
		}else{
			
			return false;
		}

	}

	function recommend_question($qid, $limit){
		
		return $data=array();
		
		
	}


 // level function end
	function related_question($qid, $limit){
		$this->db->select('cid');
		$this->db->where("qid", $qid);
		$cid =$this->db->get('savsoft_qbank')->row_array()['cid'];
		$this->db->select("qid,question,permalink");
		$this->db->where("qid !=", $qid);
		$this->db->where("cid", $cid);
		$this->db->where("deleted",0);
		$this->db->where("model",'qbank');
		$this->db->where("fun_priory >",1);
		$this->db->order_by('rand()');
	  //$this->db->order_by('create_date desc');

		$this->db->join("savsoft_permalink", "savsoft_permalink.content_id=savsoft_qbank.qid");
		$data=$this->db->get('savsoft_qbank')->result_array();
		$rqt=array();
		$count=0; 
		$index=0;
		while($count<$limit && $index<count($data)){
			if(strip_tags(html_entity_decode($data[$index]['question']))!=""){
				if(strpos($data[$index]['question'],'https://latex.codecogs.com')===false){
					$origImageSrc="";
					$imgTags="";	
					$htmlContent=$data[$index]['question'];
					preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 
					for ($j = 0; $j < count($imgTags[0]); $j++) {
						preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
						$origImageSrc = str_ireplace( 'src="', '',  $image[0]);

					}

					if($origImageSrc!="" ){
						$data[$index]['img']=str_replace("..",base_url(),$origImageSrc);
					}
					else{
						$data[$index]['img']=base_url('upload/default_image_quiz.png');
					}

					$data[$index]['question']=strip_tags(html_entity_decode($data[$index]['question']));

				}
				array_push($rqt, $data[$index]);
				$count ++;
			}
			$index++;
		}

		return $rqt;
	}



	function get_tags($qid){

		$this->db->where('question_id', $qid);
		$results=$this->db->get('question_tag_rel')->result_array();
		$tags='';
		foreach($results as $i=>$result){
			$this->db->where('tag_id', $result['tag_id']);
			$tag=$this->db->get('tags')->result_array();
			if($i==0){
				$tags=$tags.$tag[0]['tag_name'];
			}
			else{
				$tags=$tags.','.$tag[0]['tag_name'];
			}


		}
		return $tags;



	}

	function import_question($question){
//echo "<pre>"; print_r($question);exit;
		$questioncid=$this->input->post('cid');
		$questiondid=$this->input->post('did');
		$prevqid="";
		$prevtype="";
		foreach($question as $key => $singlequestion){
	//$ques_type= 

//echo $ques_type; 

			if($key != 0){
// echo "<pre>";print_r($singlequestion); exit;
				$question= str_replace('"','&#34;',$singlequestion['1']);
				$question= str_replace("`",'&#39;',$question);
				$question= str_replace("‘",'&#39;',$question);
				$question= str_replace("’",'&#39;',$question);
				$question= str_replace("â€œ",'&#34;',$question);
				$question= str_replace("â€˜",'&#39;',$question);



				$question= str_replace("â€™",'&#39;',$question);
				$question= str_replace("â€",'&#34;',$question);
				$question= str_replace("'","&#39;",$question);
				$question= str_replace("\n","<br>",$question);
				$description= str_replace('"','&#34;',$singlequestion['2']);
				$description= str_replace("'","&#39;",$description);
				$description= str_replace("\n","<br>",$description);
				$ques_type= $singlequestion['0'];
				if(trim($ques_type) !=""){
					if($ques_type=="0"){
						$question_type=$this->lang->line('multiple_choice_single_answer');	
					}
					if($ques_type=="1"){
						$question_type=$this->lang->line('multiple_choice_multiple_answer');	
					}
					if($ques_type=="2"){
						$question_type=$this->lang->line('match_the_column');	
					}
					if($ques_type=="3"){
						$question_type=$this->lang->line('short_answer');	
					}
					if($ques_type=="4"){
						$question_type=$this->lang->line('long_answer');	
					}


					$insert_data = array(
						'cid' => $questioncid,
						'lid' => $questiondid,
						'question' =>$question,
						'description' => $description,
						'question_type' => $question_type
					);

					if($this->db->insert('savsoft_qbank',$insert_data)){

						$qid=$this->db->insert_id();
						$prevoid=array();
						$prevqid=$qid;
						$prevtype=$ques_type;

						$optionkeycounter = 4;
						if($ques_type=="0" || $ques_type==""){
							for($i=1;$i<=10;$i++){
								if($singlequestion[$optionkeycounter] != ""){
									if($singlequestion['3'] == $i){ $correctoption ='1'; }
									else{ $correctoption = 0; }
									$insert_options = array(
										"qid" =>$qid,
										"q_option" => $singlequestion[$optionkeycounter],
										"score" => $correctoption
									);
									$this->db->insert("savsoft_options",$insert_options);
									$prevoid[]=$this->db->insert_id();
									$optionkeycounter++;
								}

							}
						}
	//multiple type
						if($ques_type=="1"){
							$correct_options=explode(",",$singlequestion['3']);
							$no_correct=count($correct_options);
							$correctoptionm=array();
							for($i=1;$i<=10;$i++){
								if($singlequestion[$optionkeycounter] != ""){
									foreach($correct_options as $valueop){
										if($valueop == $i){ $correctoptionm[$i-1] =(1/$no_correct);
											break;
										}
										else{ $correctoptionm[$i-1] = 0; }
									}
								}
							}

			//print_r($correctoptionm);

							for($i=1;$i<=10;$i++){

								if($singlequestion[$optionkeycounter] != ""){

									$insert_options = array(
										"qid" =>$qid,
										"q_option" => $singlequestion[$optionkeycounter],
										"score" => $correctoptionm[$i-1]
									);
									$this->db->insert("savsoft_options",$insert_options);
									$prevoid[]=$this->db->insert_id();
									$optionkeycounter++;


								}

							}
						}

	//multiple type end	

 //match Answer
						if($ques_type=="2"){
							$qotion_match=0;
							for($j=1;$j<=10;$j++){

								if($singlequestion[$optionkeycounter] != ""){

									$qotion_match+=1;
									$optionkeycounter++;
								}

							}
			///h
							$optionkeycounter=4;
							for($i=1;$i<=10;$i++){

								if($singlequestion[$optionkeycounter] != ""){
									$explode_match=explode('=',$singlequestion[$optionkeycounter]);
									$correctoption =1/$qotion_match; 
									$insert_options = array(
										"qid" =>$qid,
										"q_option" =>$explode_match[0] ,
										"q_option_match" =>$explode_match[1] ,
										"score" => $correctoption
									);
									$this->db->insert("savsoft_options",$insert_options);
									$prevoid[]=$this->db->insert_id();
									$optionkeycounter++;
								}

							}

						}

	//end match answer

	//short Answer
						if($ques_type=="3"){
							for($i=1;$i<=1;$i++){

								if($singlequestion[$optionkeycounter] != ""){
									if($singlequestion['3'] == $i){ $correctoption ='1'; }
									$insert_options = array(
										"qid" =>$qid,
										"q_option" => $singlequestion[$optionkeycounter],
										"score" => $correctoption
									);
									$this->db->insert("savsoft_options",$insert_options);
									$prevoid[]=$this->db->insert_id();
									$optionkeycounter++;
								}

							}

						}

	//end Short answer



		}//
		
	}else{

		$update_data = array(
			'question1' =>$question,
			'description1' => $description 
		);
		$this->db->where('qid',$prevqid);
		$this->db->update('savsoft_qbank',$update_data);

		
		
		

		
		
		
		
		$optionkeycounter = 4;
		if($prevtype=="0" ){
			for($i=1;$i<=10;$i++){
				if($singlequestion[$optionkeycounter] != ""){
					if($singlequestion['3'] == $i){ $correctoption ='1'; }
					else{ $correctoption = 0; }
					$insert_options = array(
						"q_option1" => $singlequestion[$optionkeycounter],
					);
					$this->db->where('oid',$prevoid[$i-1]);
					$this->db->update("savsoft_options",$insert_options);
					$optionkeycounter++;
				}

			}
		}
	//multiple type
		if($ques_type=="1"){
			$correct_options=explode(",",$singlequestion['3']);
			$no_correct=count($correct_options);
			$correctoptionm=array();
			for($i=1;$i<=10;$i++){
				if($singlequestion[$optionkeycounter] != ""){
					foreach($correct_options as $valueop){
						if($valueop == $i){ $correctoptionm[$i-1] =(1/$no_correct);
							break;
						}
						else{ $correctoptionm[$i-1] = 0; }
					}
				}
			}
			
			//print_r($correctoptionm);
			
			for($i=1;$i<=10;$i++){

				if($singlequestion[$optionkeycounter] != ""){

					$insert_options = array(
						"q_option1" => $singlequestion[$optionkeycounter],
					);
					$this->db->where('oid',$prevoid[$i-1]);
					$this->db->update("savsoft_options",$insert_options);
					$optionkeycounter++;


				}

			}
		}

	//multiple type end	

 //match Answer
		if($ques_type=="2"){
			$qotion_match=0;
			for($j=1;$j<=10;$j++){

				if($singlequestion[$optionkeycounter] != ""){

					$qotion_match+=1;
					$optionkeycounter++;
				}
				
			}
			///h
			$optionkeycounter=4;
			for($i=1;$i<=10;$i++){

				if($singlequestion[$optionkeycounter] != ""){
					$explode_match=explode('=',$singlequestion[$optionkeycounter]);
					$correctoption =1/$qotion_match; 
					$insert_options = array(
						"q_option1" =>$explode_match[0] ,
						"q_option_match1" =>$explode_match[1] ,
					);
					$this->db->where('oid',$prevoid[$i-1]);
					$this->db->update("savsoft_options",$insert_options);
					$optionkeycounter++;
				}
				
			}
			
		}

	//end match answer

	//short Answer
		if($ques_type=="3"){
			for($i=1;$i<=1;$i++){

				if($singlequestion[$optionkeycounter] != ""){
					if($singlequestion['3'] == $i){ $correctoption ='1'; }
					$insert_options = array(
						"q_option1" => $singlequestion[$optionkeycounter],
					);
					$this->db->where('oid',$prevoid[$i-1]);
					$this->db->update("savsoft_options",$insert_options);
					$optionkeycounter++;
				}
				
			}
			
		}

	//end Short answer


		
		
		
		
		
		
		
		
		
		
		
		
	}

}
}


}

public function get_statistic_category(){
	$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));	
	if ( ! $stcategories = $this->cache->get('stcategories')) {
		$sql = "select savsoft_category.*,count(savsoft_qbank.qid) as num_question from savsoft_category inner join savsoft_qbank on    savsoft_qbank.cid=savsoft_category.cid where savsoft_qbank.deleted=0  GROUP BY savsoft_qbank.cid ORDER BY num_question desc";
		$stcategories =$this->db->query($sql)->result_array();
		for($i=0; $i<count($stcategories); $i++){
			$this->db->where("content_id",$stcategories[$i]['cid']);
			$this->db->where("model","category");
			$stcategories[$i]['permalink']=$this->db->get("savsoft_permalink")->row_array()['permalink'];
		}
		$this->cache->save('stcategories', $stcategories, 86400);
	}
	return $stcategories;
}

public function get_statistic_category2(){


	$sql = "select sc.*, sp.permalink, count(sp.pid) as num_question from savsoft_category sc join savsoft_qbank sq on sq.cid=sc.cid join savsoft_permalink sp on sp.content_id=sc.cid and sp.model='category' where sq.deleted=0 and sq.status=1 GROUP BY(pid) ORDER BY num_question desc";
	$stcategories =$this->db->query($sql)->result_array();
	for($i=0; $i<count($stcategories); $i++){
		$sql1= 'select count(*) as num_like from savsoft_like where status=1 and model="qbank" and content_id in (select qid from savsoft_qbank where cid='.$stcategories[$i]['cid'].' and deleted=0 and status=1)';
		$stcategories[$i]["num_like"] =$this->db->query($sql1)->row_array()['num_like'];

		$sql1= 'select count(*) as num_answer from savsoft_answer_mcq where qid in (select qid from savsoft_qbank where cid='.$stcategories[$i]['cid'].' and deleted=0 and status=1)';
		$stcategories[$i]["num_answer"] =$this->db->query($sql1)->row_array()['num_answer'];
	}


	return $stcategories;
}


public function mng_qt_list($cid=0, $lid=0, $search="",$limit=15,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("*");

	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	if($user['su']!=1)
		$this->db->where("savsoft_qbank.inserted_by", $user['uid']);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
		$this->db->or_like("savsoft_qbank.qid", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	$this->db->limit($limit);
	$this->db->offset($limit*$page);
	$data = $this->db->get("savsoft_qbank")->result_array();
	for($i=0; $i< count($data); $i++){
		$htmlContent= $data[$i]['question'];
		$origImageSrc="";
		$imgTags="";	

		preg_match_all('/<img[^>]+>/i',$htmlContent, $imgTags); 			
		for ($j = 0; $j < count($imgTags[0]); $j++) {
			preg_match('/src="([^"]+)/i',$imgTags[0][$j], $image);
			if(strpos($image[0],'https://latex.codecogs.com')===false){
				$origImageSrc = str_ireplace( 'src="', '',  $image[0]);
				$pos = strpos($htmlContent, $image[0]);
				$qt = str_replace($image[0],' class="img-responsive" width="100%" '.$image[0],$htmlContent);
			}
		}
		$origImageSrc=str_replace("..",base_url(),$origImageSrc);
		if($origImageSrc){

			if(strpos($htmlContent,'https://latex.codecogs.com')===false){
				$qt='<div class="imgqtt"><img class="img-responsive" width="100%" src="'.$origImageSrc.'" /></div>';	 
				$qt.=strip_tags( $data[$i]['question']);
			}
			else{


			}
			$data[$i]['question']=$qt;

		}	

		$origvidSrc="";
		$vidTags="";
		if(strpos($htmlContent, "<iframe") !==false){
			preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			if(count($vidTags[0])>0){
				if(strpos($vidTags[0][0], "facebook")!==false){
					$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
				}
				else{
					$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
				}
				$qt.=strip_tags($htmlContent);
				$data[$i]['question']=$qt;
			} 
		}

	}
	return $data;
}
public function num_mng_qt($cid=0, $lid=0, $search="",$limit=15,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("qid");
	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	if($user['su']!=1)
		$this->db->where("savsoft_qbank.inserted_by", $user['uid']);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	return $this->db->get("savsoft_qbank")->num_rows();

}

public function crq_qt_list($cid=0, $lid=0, $search="",$limit=10,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("*");

	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	$this->db->where("status",1);
	if($user['su']!=1)
		$this->db->where("savsoft_qbank.inserted_by", $user['uid']);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	$this->db->limit($limit);
	$this->db->offset($limit*$page);
	$data = $this->db->get("savsoft_qbank")->result_array();
	return $data;
}
public function num_crq_qt($cid=0, $lid=0, $search="",$limit=10,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("qid");
	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	$this->db->where("status",1);
	if($user['su']!=1)
		$this->db->where("savsoft_qbank.inserted_by", $user['uid']);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	return $this->db->get("savsoft_qbank")->num_rows();

}


function get_statistic_mcq($qid){
	$user= $this->session->userdata('logged_in');
	$this->db->where('qid',$qid);
	$data['n_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
	$this->db->where('qid',$qid);
	$this->db->where('istrue',1);
	$data['n_correct_answers']=$this->db->get('savsoft_answer_mcq')->num_rows();
	$this->db->where('model', 'qbank');
	$this->db->where('content_id',$qid);
	$this->db->where('uid !=', $user['uid']);
	$this->db->where('status', 1);
	$data['n_like']=$this->db->get('savsoft_like')->num_rows();

	$this->db->from('posts p');
	$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
	$this->db->where('p.model','qbank');
	$this->db->where('p.wall_id',$qid);
	$this->db->where('p.parent_id', 0);
	$this->db->limit(2);
	$this->db->order_by("p.create_date", "desc");
	$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,photo");
	$data['comment'] =$this->db->get()->result_array();

	$this->db->select('status');
	$this->db->where('model','qbank');
	$this->db->where('content_id',$qid);
	$this->db->where('uid',$user['uid']);
	$data['liked']=$this->db->get('savsoft_like')->row_array()['status'];
	$this->db->where("model", "qbank");
	$this->db->where("content_id", $qid);
	$data['permalink']=$this->db->get("savsoft_permalink")->row_array()['permalink'];

	$data['user_name']=$user['first_name']."".$user['last_name'];
	return $data;
}

function num_mdr_qt($cid=0, $lid=0, $search="",$limit=10,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("qid");
	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	$this->db->where("status",0);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	return $this->db->get("savsoft_qbank")->num_rows();

}


function num_mdr_qt2($cid=0, $lid=0, $search="",$limit=10,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("qid");
	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	$this->db->where("type",3);
	$this->db->where('hard_level IS NULL', null, false);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	return $this->db->get("savsoft_qbank")->num_rows();

}


function num_mdr_qt3($cid=0, $lid=0, $search="",$limit=10,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("qid");
	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	$this->db->where("type",2);
	$this->db->where('hard_level IS NULL', null, false);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	return $this->db->get("savsoft_qbank")->num_rows();

}

function mdr_qt_list($cid=0, $lid=0, $search="",$limit=10,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("*");

	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	$this->db->where("status",0);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	$this->db->limit($limit);
	$this->db->offset($limit*$page);
	$data = $this->db->get("savsoft_qbank")->result_array();
	for($i=0; $i< count($data); $i++){
		$htmlContent= $data[$i]['question'];
		$origvidSrc="";
		$vidTags="";
		if(strpos($htmlContent, "<iframe") !==false){
			preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			if(count($vidTags[0])>0){

				if(strpos($vidTags[0][0], "facebook")!==false){
					$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
				}
				else{
					$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
				}

				$qt.=strip_tags($htmlContent);
				$data[$i]['question']=$qt;
			} 
		}

	}
	return $data;
}

function mdr_qt_list2($cid=0, $lid=0, $search="",$limit=10,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("*");

	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	$this->db->where("type",3);
	$this->db->where('hard_level IS NULL', null, false);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	$this->db->limit($limit);
	$this->db->offset($limit*$page);
	$data = $this->db->get("savsoft_qbank")->result_array();
	for($i=0; $i< count($data); $i++){
		$htmlContent= $data[$i]['question'];
		$origvidSrc="";
		$vidTags="";
		if(strpos($htmlContent, "<iframe") !==false){
			preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			if(count($vidTags[0])>0){

				if(strpos($vidTags[0][0], "facebook")!==false){
					$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
				}
				else{
					$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
				}

				$qt.=strip_tags($htmlContent);
				$data[$i]['question']=$qt;
			} 
		}

	}
	return $data;
}

function mdr_qt_list3($cid=0, $lid=0, $search="",$limit=10,$page=0){
	$user= $this->session->userdata('logged_in');
	$this->db->select("*");

	$this->db->join("savsoft_category","savsoft_qbank.cid=savsoft_category.cid");
	$this->db->join("savsoft_level","savsoft_qbank.lid=savsoft_level.lid");
	$this->db->where("type",2);
	$this->db->where('hard_level IS NULL', null, false);
	if($cid>0){
		$this->db->where("savsoft_qbank.cid", $cid);
	}
	if($lid>0){
		$this->db->where("savsoft_qbank.lid", $lid);
	}
	if($search!=""){
		$this->db->like("savsoft_qbank.question", $search);
	}
	$this->db->where("savsoft_qbank.deleted", 0);
	$this->db->order_by("qid desc");
	$this->db->limit($limit);
	$this->db->offset($limit*$page);
	$data = $this->db->get("savsoft_qbank")->result_array();
	for($i=0; $i< count($data); $i++){
		$htmlContent= $data[$i]['question'];
		$origvidSrc="";
		$vidTags="";
		if(strpos($htmlContent, "<iframe") !==false){
			preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
			if(count($vidTags[0])>0){

				if(strpos($vidTags[0][0], "facebook")!==false){
					$qt='<div class="video-container2">'.$vidTags[0][0].'</iframe></div><br/>';
				}
				else{
					$qt='<div class="video-container">'.$vidTags[0][0].'</iframe></div><br/>';
				}

				$qt.=strip_tags($htmlContent);
				$data[$i]['question']=$qt;
			} 
		}

	}
	return $data;
}


function moderate_question($qid){
	$this->db->where("qid", $qid);
	$this->db->update("savsoft_qbank", array("status"=>1));

	$this->db->where("qid", $qid);
	$data=$this->db->get("savsoft_qbank")->row_array();
	$this->load->model('predictio_model');
	$this->predictio_model->push_event_set($qid, $data['cid'], $data['lid']);


	   /*$this->db->where("qid", $qid);
       $q = $this->db->get("savsoft_qbank")->row_array();
	   $uid = $q['inserted_by'];
	   date_default_timezone_set('Asia/Ho_Chi_Minh');
	   $day = date('d/m/Y', time());
	   $data=  array(
			"model"=>"question",
			"content_id"=>$qid,
			"uid"=>$uid,
			"day"=>$day
	   ); 
	   
	   $this->db->insert("event_statistics", $data);
	   
	   $sunday =date('d/m/Y', strtotime('sunday this week'));
	   $t=date('d/m/Y', strtotime('+1 day'));
	   $dif=1;
	   while($t <=$sunday){
		   $data=  array(
				"model"=>"question",
				"content_id"=>$qid,
				"uid"=>$uid,
				"day"=>$t
	       );
           $this->db->insert("event_statistics", $data);
           $dif++;
           $t= 	date('d/m/Y', strtotime('+'.$dif.' day'));	   
	   }
	   $this->db->where("uid", $uid);
	   $this->db->where("day", $day);
	   $uppd = $this->db->get("event_day_points");
	   if($uppd->num_rows()>0){
		    $this->db->where("uid", $uid);
	        $this->db->where("day", $day);
			$do_points= $uppd->row_array()["do_points"]+1000;// Don't forget: create rule earn point replace 1000
			$total_points= $uppd->row_array()["total_points"]+1000;
		    $this->db->update("event_day_points", array("do_points"=>$do_points, "total_points"=>$total_points));
	   }
	   else{
		    $this->db->insert("event_day_points", array("day"=>$day,"uid"=>$uid,"do_points"=>1000, "total_points"=>1000));
	   }
	   */

	}
	
	function moderate_question2($qid){
		$this->db->where("qid", $qid);
		$this->db->update("savsoft_qbank", array("hard_level"=>99));

		$this->db->where("qid", $qid);
		$data=$this->db->get("savsoft_qbank")->row_array();
		$this->load->model('predictio_model');
		$this->predictio_model->push_event_set($qid, $data['cid'], $data['lid']);


	}
	
	function moderate_question3($qid){
		$this->db->where("qid", $qid);
		$this->db->update("savsoft_qbank", array("hard_level"=>99));

		$this->db->where("qid", $qid);
		$data=$this->db->get("savsoft_qbank")->row_array();
		$this->load->model('predictio_model');
		$this->predictio_model->push_event_set($qid, $data['cid'], $data['lid']);


	}
	
	function question_of_student($qid){
		$logged_in=$this->session->userdata('logged_in');
		$uid = $logged_in['uid'];
		
		$sql=" SELECT DISTINCT qid,assid FROM savsoft_qassign WHERE qid=$qid and uid=$uid and answer IS NULL " ;
		$query=$this->db->query($sql)->row_array();
		
		return $query;
	}	
	
	function statistic_by_lesson($lid=0, $cid=0){
		$sql="select A.*,l.level_name,c.category_name from( 
		(select  lesson,cid,lid,count(qid) as num_question
		from savsoft_qbank
		where status=1 and deleted=0 and lesson is not null and lesson <> ''
		GROUP BY lesson,cid,lid 
		) as A 
		join savsoft_level l on A.lid=l.lid 
		join savsoft_category c on A.cid=c.cid 
	) where 1=1 ";

	if($lid!=0){
		$sql.= " and A.lid=$lid";
	}
	if($cid!=0){
		$sql.= " and A.cid=$cid";
	}	
	$sql.=" Order by A.lid asc,A.cid asc";		
	$data= $this->db->query($sql)->result_array();

	return $data;
}

function statistic_by_level($lid=0){
	$sql="select A.*,l.level_name from( 
	(select  lid,count(qid) as num_question
	from savsoft_qbank
	where `status`=1 and deleted=0 
	GROUP BY lid 
	Order by lid asc) as A 
	join savsoft_level l on A.lid=l.lid 

) where 1=1 ";

if($lid!=0){
	$sql.= " and A.lid=$lid";
}	
$data= $this->db->query($sql)->result_array();

return $data;
}

function statistic_by_categ($cid=0){
	$sql="select A.*,c.category_name from( 
	(select  cid,count(qid) as num_question
	from savsoft_qbank
	where `status`=1 and deleted=0 
	GROUP BY cid 
	Order by cid asc) as A 
	join savsoft_category c on A.cid=c.cid 

) where 1=1 ";

if($cid!=0){
	$sql.= " and A.cid=$cid";
}	
$data= $this->db->query($sql)->result_array();

return $data;
}

function statistic_by_levelcateg($lid=0, $cid=0){
	$sql="select A.*,l.level_name,c.category_name from( 
	(select  cid,lid,count(qid) as num_question
	from savsoft_qbank
	where `status`=1 and deleted=0 
	GROUP BY cid,lid ) as A 
	join savsoft_level l on A.lid=l.lid 
	join savsoft_category c on A.cid=c.cid 
) where 1=1 ";

if($lid!=0){
	$sql.= " and A.lid=$lid";
}
if($cid!=0){
	$sql.= " and A.cid=$cid";
}

$sql.=" Order by A.lid asc,A.cid asc";		
$data= $this->db->query($sql)->result_array();

return $data;
}
function get_size_of_cid(){
	$sql = "select cid FROM savsoft_category ORDER BY cid DESC LIMIT 1";
	$data= $this->db->query($sql)->result_array();
	return $data;
}
function delete_question($qid){

	$this->db->where("qid", $qid);
	$this->db->update("savsoft_qbank", array("deleted"=>1));

}
	function xuat_file_model($start){
		$sql=" SELECT * FROM savsoft_permalink sp WHERE sp.model='qbank' LIMIT 10000 ";
		if($start){
			$sql.=" offset $start";
		}		
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
}

?>
