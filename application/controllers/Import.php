<?php
class Import extends CI_Controller{

 function __construct()
	 {
	   parent::__construct();
		    $this->load->database();
		    $this->lang->load('basic', $this->config->item('language'));
		    $this->load->helper('url');
	    	$this->load->model('rulepoint_model');
            $user= $this->session->userdata('logged_in');
			if($user['su']!=1){
				redirect("/home");
			}
	 }



 public function text_question(){
	 $this->load->view('header',$data);
	 $this->load->view("import/import_text_question");


 }
 
  public function video_question(){
	 $this->load->view('header',$data);
	 $this->load->view("import/import_video_question");


 }
 
  public function library(){
	 $this->load->view('header',$data);
	 $this->load->view("import/import_library");


 }

function process_excel($type){
          /******************upload_excel*********************/
		$t=time();
		if (isset($_POST['uploadclick']))
		{

		    if (isset($_FILES['upload']))
		    {

		        if ($_FILES['upload']['error'] > 0)
		        {
		        	 $this->session->set_flashdata('message','<div class="alert alert-danger">Upload error</div>' ); 
		            
		        }
		        else {
					
		        	
					$target_dir = "upload/excel2/".$type."/";
		            $basename = basename($_FILES["upload"]["name"]);
					$namewe = substr($basename, 0, strrpos($basename, "."));
		            $inputFileName = $target_dir . basename($_FILES["upload"]["name"]);              
		        	$fileType = strtolower(pathinfo($inputFileName,PATHINFO_EXTENSION));
		        	if($fileType=="xlsx" | $fileType=="xls" ){
		                // Upload file

		                
		                $basename = basename($_FILES["upload"]["name"]);
		              
		               $inputFileName = $target_dir . 'temp-'.$t.'.xlsx';
		                move_uploaded_file($_FILES['upload']['tmp_name'], $inputFileName);
		               				
		            }
		            else {
		        	 	$this->session->set_flashdata('message','<div class="alert alert-danger">Error format</div>' );	
						redirect ('import/'.$type);
		            }
		        }
		    }
		    else{
		    	$this->session->set_flashdata('message','<div class="alert alert-danger">Bạn chưa chọn file upload</div>');	
				redirect ('import/'.$type);
		        
		    }
		}

       

		
		/************************process_excel*****************************/
		include 'Classes/PHPExcel/IOFactory.php';
		$inputFileName = 'upload/excel2/'.$type.'/temp-'.$t.'.xlsx';

		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {

			 redirect('import/'.$type);
		}
        $sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
    
		for ($row = 0; $row <= $highestRow; $row++){ 

		    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
		}
		
        
		if($type=="library"){
			$error_format=array();
			$error_line=array();
			$obj_upd="";
			$format_file=array(	'Tên video (mô phỏng)',
								'Embed + Sapo (giải thích ngắn)',
								'Lớp',
								'Môn',
								'Tiết',
								'Giải thích',
								'Từ khóa',
								'Nguồn');
			for($j=0; $j<8; $j++){
				if($rowData[1][0][$j]!=$format_file[$j]){
					array_push($error_format, array("column"=>$j));
				}
			}
			if(count($error_format)==0){
				for($i=2; $i<=$highestRow; $i++ ){				
					$data= $rowData[$i][0];
					$check=true;
					if($data[0]){
						for($j=0; $j<4; $j++){
							if(!$data[$j]){
								array_push($error_line, array("error_code"=>1,"row"=>$i,"column"=>$j));
								$check=false;
								break;
							}
						}
						if($check){
							$htmlContent = $data[1];
							$origvidSrc="";
							$vidTags="";
							preg_match_all('/<iframe[^>]+>/i',$htmlContent, $vidTags); 
					  
							$content=$vidTags[0][0].'</iframe>';
							$description=strip_tags($htmlContent);
							if(count($vidTags[0])>0){
								
								preg_match('/src="([^"]+)"/', $vidTags[0][0], $match);
								if(strpos($match[1],"youtube")!==false){
									$vid= substr(str_replace("https://www.youtube.com/embed/","",$match[1]),0,11);
									$source_type="youtube";
								}
								if(strpos($match[1],"facebook")!==false){
									$posvideo=strpos($match[1],"videos%2F");
									$temp= substr($match[1],$posvideo+9);
									$posid=strpos($temp,"%2F");
									$vid= substr($temp,0,$posid);
									$source_type="facebook";
								}
								
							} 
							//multi 
							$lid_arr = explode(",",$data[2]);
							if(count($lid_arr)==1){
								
								$lid=$lid_arr[0]+2;
							}
							else{
								if($lid_arr[0]==4){
									$lid=16;
								}
								if($lid_arr[0]==7){
									$lid=17;
								}
								if($lid_arr[0]==10){
									$lid=18;
								}
							}
						
							//multi cids
							$cname_arr= explode(",",$data[3]);
							$cids="";
							foreach($cname_arr as $k=>$cname){
								$this->db->where("category_name", trim($cname));
								$r =$this->db->get("savsoft_category")->row_array();
								if($r){
									if($k==0){
										$cid=$r['cid'];
										$cids.=$r['cid'];
									}
									else{
										$cids.=",".$r['cid'];
									}
								}
							}
						
							//							
							
							if($data[5]){
								$description.="<br>".$data[5];
							}
							$e= array("name"=>$data[0],
									  "content"=>$content,
									  "title"=>$data[0],
									  "description"=>$description,
									  "cid"=>$cid,
									  "cids"=>$cids,
									  "lid"=>$lid,
									  "unit"=> $data[4],
									  "source"=>$data[7],
									  "source_type"=>$source_type,
									  "source_id"=>$vid,
									  "type"=>"video"
									  );
							
							$this->db->where("source_type", $source_type);
							$this->db->where("source_id",$vid);
							$liba=$this->db->get("savsoft_library")->row_array();
							if(!$liba){
								$this->db->insert("savsoft_library", $e);
								$lib_id=$this->db->insert_id();
								if($obj_upd=="")
									$obj_upd=$lib_id;
								else
									$obj_upd.=",".$lib_id;
								$strtag = trim($data[6]);
								
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
									$tid = $result->row_array()['tag_id'];
									$this->db->insert('library_tags_rel', array('tag_id'=>$tid, 'lib_id'=>$lib_id));
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
								 
								 $link=$data[0];		 
								 foreach($unicode as $nonUnicode=>$uni){
									$link = preg_replace("/($uni)/i", $nonUnicode, $link);
								 }
								 $comma=array ('.','%21','%22','%23','%24','%25','%26','%27','%28','%29','%2A','%2B','%2C','%2E','%2F','%3A','%3B','%3C','%3D','%3E','%3F',
										 '%40','%5B','%5C','%5D','%5E','%5F','%60','%7B','%7C','%7D','%7E','%A1','%A2','%A3','%A4','%A5','%A6','%A7','%A8', '%A9','%AA',
										 '%AB','%AC','%AD','%AE','%AF','%B0','%B1','%B2','%B3','%B4','%B5','%B6','%B7','%B8', '%B9','%BA','%BB','%BC','%BD','%BE','%BF');
								 $link = str_replace(array(' '),'-',$link);
								 $link =urlencode ($link);
								 $link = str_replace($comma,'',$link);
								 $link = str_replace(array('%'),'',$link);
								 if($link==""){
									 $link=$lib_id;
								 }
								 else
									 $link.='-'.$lib_id;
								 while(strpos($link, '--'))
									$link = str_replace(array('--'),'-',$link);
								 $this->db->insert('savsoft_permalink', array("model"=>"video", "content_id"=>$lib_id, "permalink"=>$link));
							}
							else{
								array_push($error_line, array("error_code"=>0,"row"=>$i,"column"=>0));
							}
						}
						$this->session->set_flashdata('message','<div class="alert alert-success">Thêm thành công</div>');	
					}
					
				}
			}
			
			
		}
		
		
		//
		if($type=="video_question"){
			$error_format=array();
			$error_line=array();
			$obj_upd="";
			$format_file=array(	'Tên video (mô phỏng)',
								'Embed + Sapo (giải thích ngắn)',
								'Câu hỏi',
								'Đáp án A',
								'Đáp án B',
								'Đáp án C',
								'Đáp án D',
								'Đáp án đúng',
								'Lớp',
								'Môn',
								'Tiết',
								'Giải thích',
								'Từ khóa',
								'Nguồn (tên sách)');
			for($j=0; $j<14; $j++){
				if($rowData[1][0][$j]!=$format_file[$j]){
					array_push($error_format, array("column"=>$j));
				}
			}
			if(count($error_format)==0){
				for($i=2; $i<=$highestRow; $i++ ){		
					$data= $rowData[$i][0];
					$check=true;
					if($data[0]){
						
						for($j=0; $j<10; $j++){
							if($j!=5 && $j!=6){
								if(!$data[$j]){
									array_push($error_line, array("error_code"=>1,"row"=>$i,"column"=>$j));
									$check=false;
									break;
								}
							}
						}
						if($check){
							$name_video = $data[0];
							$video_content=$data[1];
							$question = $data[1]."<br>".$data[2];
							$op0="";
							$op1="";
							$op2="";
							$op3="";	
							if($data[3])
								$op0= $data[3];	
							if($data[4])
								$op1= $data[4];
							if($data[5])
								$op2= $data[5];
							if($data[6])
								$op3= $data[6];	
							$co = $data[7];
						
							//multi 
							$lid_arr = explode(",",$data[8]);
							if(count($lid_arr)==1){
								
								$lid=$lid_arr[0]+2;
							}
							else{
								if($lid_arr[0]==4){
									$lid=16;
								}
								else if($lid_arr[0]==7){
									$lid=17;
								}
								else if($lid_arr[0]==10){
									$lid=18;
								}
								else {
									array_push($error_line, array("error_code"=>2,"row"=>$i,"column"=>8));
									$check= false;
								}
							}
						
							//multi cids
							$cname_arr= explode(",",$data[9]);
							$cids="";
							foreach($cname_arr as $k=>$cname){
								$this->db->where("category_name", trim($cname));
								$r =$this->db->get("savsoft_category")->row_array();
								if($r){
									if($k==0){
										$cid=$r['cid'];
										$cids.=$r['cid'];
									}
									else{
										$cids.=",".$r['cid'];
									}
								}
								else{
									array_push($error_line, array("error_code"=>3,"row"=>$i,"column"=>9));
									$check= false;
									break;
								}
							}
						
							//
							$unit=$data[10];
							$des=$data[11];
							$strtag= $data[12];
							$source =$data[13];
						
							//
							$score0=0;
							$score1=0;
							$score2=0;
							$score3=0;
							if($co==$op0) $score0=1;		
							else if($co==$op1) $score1=1;	
							else if($co==$op2) $score2=1;	
							else if($co==$op3) $score3=1;		
							else {
								array_push($error_line, array("error_code"=>4,"row"=>$i,"column"=>7));
								$check =false;
							}
								
							
							
							if($check){
								$ins_arr = array( "question"=> $question,
											  "description"=>$des,
											  "cid"=>$cid,
											  "cids"=>$cids,
											  "lid"=>$lid,
											  "inserted_by"=>1,
											  "inserted_by_name"=>"Admin",
											  "source"=>$source,
											  "status"=>1,
											  "unit"=>$unit,
											  "type"=>2								  
									   );
								$this->db->insert('savsoft_qbank',$ins_arr);
								$qid=$this->db->insert_id();
								if($obj_upd=="")
									$obj_upd=$qid;
								else
									$obj_upd.=",".$qid;	   
							
												
								$ins_op0=array(
									'q_option'=>$op0,
									'qid'=>$qid,
									'score'=>$score0
								 );					
								 $ins_op1=array(
									'q_option'=>$op1,
									'qid'=>$qid,
									'score'=>$score1
								 );
								$ins_op2=array(
									'q_option'=>$op2,
									'qid'=>$qid,
									'score'=>$score2
								 );
								$ins_op3=array(
									'q_option'=>$op3,
									'qid'=>$qid,
									'score'=>$score3
								 );
							
								$this->db->insert('savsoft_options',$ins_op0);
								$this->db->insert('savsoft_options',$ins_op1);
								$this->db->insert('savsoft_options',$ins_op2);
								$this->db->insert('savsoft_options',$ins_op3);
								
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
							  
								 $qt =html_entity_decode(trim(strip_tags( $question )));
								  
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
							}

						}
						
		  
					}
					
					
				}
			}
			
		}
		
		/*-------ending process : excel-> array----------*/
		$new_name='upload/excel2/'.$type."/".$namewe.'-'.$t.'.xlsx';
		$error_json=array("format"=>$error_format,
			                  "line"=>$error_line);
		$u= array('type'=>$type,
		         'file_name'=>$new_name,
				 'object_upd'=>$obj_upd,
				 "error_json"=>json_encode($error_json)
				 );
		$this->db->insert("upload_history",$u );
		
		$message_display = '<div class="alert alert-success">Thực hiện thành công</div>';
		
		$error_message="";
		if(count($error_format)==0 && count($error_line)==0){
			$error_message.="Không có lỗi";
		}
		else{
			if(count($error_format)!=0){
				$error_message.="Định dạng sai";
			}
			else{
				foreach($error_line as $el){
					if($el['error_code']==1){
						$el_text="Có trường bắt buộc bị bỏ trống!";
					}
					if($el['error_code']==2){
						$el_text="Sai lớp";
					}
					if($el['error_code']==3){
						$el_text="Sai môn học";
					}
					if($el['error_code']==4){
						$el_text="Không có đáp án đúng";
					}
					$error_message.="Dòng ".$el['row'].":".$el_text."<br>";
				}
			}
		}
		$message_display .=  '<div class="alert alert-danger">Lỗi:<br>'.$error_message.'</div>';
		
		$this->session->set_flashdata('message',$message_display);	
		rename($inputFileName, $new_name);
		/*-------ending process : rename----------*/
		/************************return_result*****************************/
          
		  
		redirect ('import/'.$type);
		
	}
	
	
function process_excel2(){
	$t=time();
	$total = count($_FILES['upload']['name']);
	$excel_file="";
	for( $i=0 ; $i < $total ; $i++ ) {


	  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
       
     
	  if ($tmpFilePath != ""){
		 
		$target_dir = "upload/excel2/text_question/";
		$basename = basename($_FILES["upload"]["name"][$i]);              
	    $inputFileName = $target_dir.$t."-". $basename;
		move_uploaded_file($tmpFilePath, $inputFileName);
		$fileType = strtolower(pathinfo($inputFileName,PATHINFO_EXTENSION));
		if($fileType=="xlsx" || $fileType=="xls" ){
			$excel_file= $inputFileName;
		}
		
	  }
	}
	
	/**************sc**********/
	
	include 'Classes/PHPExcel/IOFactory.php';
	$inputFileName = $excel_file;
    
	try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	} catch(Exception $e) {

		 redirect('import/'.$type);
	}
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); 
	$highestColumn = $sheet->getHighestColumn();
	$obj_upd="";
	$error_format=array();
	$error_line=array();
	
	$format_file=array(	'Câu hỏi (text)',
						'Câu hỏi (ảnh)',
						'Đáp án A',
						'Đáp án B',
						'Đáp án C',
						'Đáp án D',
						'Đáp án đúng',
						'Lớp',
						'Môn',
						'Tiết',
						'Giải thích',
						'Từ khóa',
						'Nguồn (tên sách)'
						);
	
	for ($row = 0; $row <= $highestRow; $row++){ 

		$rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
	}
	
	for($j=0; $j<13; $j++){
		if($rowData[1][0][$j]!=$format_file[$j]){
			array_push($error_format, array("column"=>$j));
		}
	}
	if(count($error_format)==0){
	
		for($i=2; $i<=$highestRow; $i++ ){
			$check=true;		
			$data= $rowData[$i][0];
			if($data[0]){
				for($j=2; $j<9; $j++){
					if($j!=4 && $j!=5){
						if(!$data[$j]){
							array_push($error_line, array("error_code"=>1,"row"=>$i,"column"=>$j));
							$check=false;
							break;
							
						}
					}
				}
				if($check){
					$q_text = $data[0];
					$q_img = $data[1];
					$op0="";
					$op1="";
					$op2="";
					$op3="";
					if($data[2])
						$op0= $data[2];	
					if($data[3])
						$op1= $data[3];
					if($data[4])
						$op2= $data[4];	
					if($data[5])
						$op3= $data[5];
					$co = $data[6];
					//
					$lid_arr = explode(",",$data[7]);
					if(count($lid_arr)==1){
						
						$lid=$lid_arr[0]+2;
					}
					else{
						if($lid_arr[0]==4){
							$lid=16;
						}
						else if($lid_arr[0]==7){
							$lid=17;
						}
						else if($lid_arr[0]==10){
							$lid=18;
						}
						else{
							array_push($error_line, array("error_code"=>2,"row"=>$i,"column"=>7));
							$check= false;
						}
					}
					$cname_arr= explode(",",$data[8]);
					$cids="";
					foreach($cname_arr as $k=>$cname){
						$this->db->where("category_name", trim($cname));
						$r =$this->db->get("savsoft_category")->row_array();
						if($r){
							if($k==0){
								$cid=$r['cid'];
								$cids.=$r['cid'];
							}
							else{
								$cids.=",".$r['cid'];
							}
						}
						else{
							array_push($error_line, array("error_code"=>3,"row"=>$i,"column"=>8));
							$check= false;
							break;
						}
					}
					//
					$unit=$data[9];
					$des=$data[10];
					$strtag= $data[11];
					$source =$data[12];
						
					if(strpos($q_text,"http://")===false && strpos($q_text, "https://")=== false){
						$type=1;
					}
					else{
						$type=3;
						$poshttp= strpos($q_text,"http");
						$source =trim(substr($q_text,$poshttp));
						$q_text=substr($q_text,0,$poshttp);
						
						$this->db->where("link",$source);
						$rm =$this->db->get('reading_material')->row_array();
						if(!$rm){
							if(strpos($source,"vui.stem.vn")!==false){
								$this->db->where("link", trim($source));
								$dtrm3= $this->db->get('reading_material_3')->row_array();
								if($dtrm3){
									$content3 = '<b>'.$dtrm3['title'].'</b>'.$dtrm3['content'];
									$img3=$dtrm3['img'];
									$categories3=$dtrm3['category'];
									$array_rm =array("link"=>trim($source),
									                 "content"=>$content3,
													 "img"=>$img3,
													 "title"=>$dtrm3['title'],
													 "categories"=>$categories3,
													 );
								}
								else{
									$array_rm =array("link"=>trim($source));
								}
							}
							else{
								$array_rm =array("link"=>trim($source));
							}
								
							$this->db->insert('reading_material',$array_rm);
						}
					}
					$question="";
					if($q_img){		
						if(strpos($q_img,"http://")===false && strpos($q_img, "https://")=== false){
							$question = '<div class="imgqtt" ><img class="img-responsive" style="width:100%" src="'.base_url('upload/excel2/text_question/')."/".$t.'-'.$q_img.'"></div>';
						}
						else{
							$question ='<div class="imgqtt" ><img class="img-responsive" style="width:100%" src="'.$q_img.'"></div>';
						}
					}
					$question.=$q_text;
				
				    
					$score0=0;
					$score1=0;
					$score2=0;
					$score3=0;
					if($co==$op0) $score0=1;		
					else if($co==$op1) $score1=1;	
					else if($co==$op2) $score2=1;	
					else if($co==$op3) $score3=1;
                    else {
						array_push($error_line, array("error_code"=>4,"row"=>$i,"column"=>6));
						$check= false;
					}
					
					if($check){
						$ins_arr = array( "question"=> $question,
									  "description"=>$des,
									  "cid"=>$cid,
									  "cids"=>$cids,
									  "lid"=>$lid,
									  "inserted_by"=>1,
									  "inserted_by_name"=>"Admin",
									  "source"=>$source,
									  "status"=>1,
									  "unit"=>$unit,
									  "type"=>$type						  
							   );
							   
						
					
						$this->db->insert('savsoft_qbank',$ins_arr);
						$qid=$this->db->insert_id();
						if($obj_upd=="")
							$obj_upd=$qid;
						else
							$obj_upd.=",".$qid;	   
						
										
						$ins_op0=array(
							'q_option'=>$op0,
							'qid'=>$qid,//
							'score'=>$score0
						 );					
						 $ins_op1=array(
							'q_option'=>$op1,
							'qid'=>$qid,//
							'score'=>$score1
						 );
						$ins_op2=array(
							'q_option'=>$op2,
							'qid'=>$qid,//
							'score'=>$score2
						 );
						$ins_op3=array(
							'q_option'=>$op3,
							'qid'=>$qid,//
							'score'=>$score3
						 );
						
						$this->db->insert('savsoft_options',$ins_op0);
						$this->db->insert('savsoft_options',$ins_op1);
						$this->db->insert('savsoft_options',$ins_op2);
						$this->db->insert('savsoft_options',$ins_op3);
					
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
						  
						 $qt =html_entity_decode(trim(strip_tags( $question )));
						  
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
					}
				} 
			
			}
		
		
		}
	}
	
	
	$error_json=array("format"=>$error_format,
			          "line"=>$error_line);
	$u= array('type'=>"normal question",
		         'file_name'=>$inputFileName,
				 'object_upd'=>$obj_upd,
                  "error_json"=>json_encode($error_json)
				 );
	$this->db->insert("upload_history",$u );
	
	$message_display = '<div class="alert alert-success">Thực hiện thành công</div>';
	
	$error_message="";
	if(count($error_format)==0 && count($error_line)==0){
		$error_message.="Không có lỗi";
	}
	else{
		if(count($error_format)!=0){
			$error_message.="Định dạng sai";
		}
		else{
			foreach($error_line as $el){
				if($el['error_code']==1){
					$el_text="Có trường bắt buộc bị bỏ trống!";
				}
				if($el['error_code']==2){
					$el_text="Sai lớp";
				}
				if($el['error_code']==3){
					$el_text="Sai môn học";
				}
				if($el['error_code']==4){
					$el_text="Không có đáp án đúng";
				}
				$error_message.="Dòng ".$el['row'].":".$el_text."<br>";
			}
		}
	}
	$message_display .=  '<div class="alert alert-danger">Lỗi:<br>'.$error_message.'</div>';
	
	$this->session->set_flashdata('message',$message_display);	
	redirect('import/text_question');	
     
} 
 
} 

