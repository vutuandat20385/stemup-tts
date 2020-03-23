<?php
class Test3 extends CI_Controller{
	 function __construct()
	 {
	   parent::__construct();
		    $this->load->database();
		    $this->lang->load('basic', $this->config->item('language'));
		  $this->load->helper(array('Form', 'Cookie', 'String', 'url'));	
	    	$this->load->model('rulepoint_model');

	 }
	
	
   function process(){
	   
	   include 'Classes/PHPExcel/IOFactory.php';
	   $inputFileName = 'SinhHocs.xlsx';
	   try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {

			 echo 1;
		}
	   
	     $sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
    
		for ($row = 0; $row <= $highestRow; $row++){ 

		    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
		}
		
		echo '<table>';
		for($i=1; $i<=$highestRow; $i++ ){
			
			echo '<tr>';
			for($j=0; $j< ord(strtolower($highestColumn)) - 96; $j++ ){
				echo '<td>|'. $rowData[$i][0][$j].'</td>';
			}
			

			
			
			$array= array("unit_number"=>$rowData[$i][0][1],
			              "unit_name"=>$rowData[$i][0][2],
						  //"chid"=>intval($rowData[$i][0][2])+11,
						  "week"=>$rowData[$i][0][0],
						  "cid"=>8,
						  //"sub_subject"=>"Số học",
						  "lid"=>8);
						  
			$this->db->insert("unit", $array);
			echo '</tr>';
		}
		echo '</table>';
	   
	   
   } 
	
	 function update_unit(){
	   
	   include 'Classes/PHPExcel/IOFactory.php';
	   $inputFileName = 'sh_8u.xlsx';
	   try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {

			 echo 1;
		}
	   
	     $sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
    
		for ($row = 0; $row <= $highestRow; $row++){ 

		    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
		}
		
		echo '<table>';
		for($i=2; $i<$highestRow+1; $i++ ){
			
			echo '<tr>';
			for($j=0; $j< ord(strtolower($highestColumn)) - 96; $j++ ){
				if($j==0||$j==4)
					echo '<td>|'. $rowData[$i][0][$j].'</td>';
			}
			

			
			$array=array("unit"=> $rowData[$i][0][4]);
			$this->db->where("qid", $rowData[$i][0][0]);
			
			$this->db->update("savsoft_qbank", $array);
			echo '</tr>';
		}
		echo '</table>';
	   
	  
   } 
   
   
   function update_tags(){
	   
	   include 'Classes/PHPExcel/IOFactory.php';
	   $inputFileName = 'ls6-12ds6s8.xlsx';
	   try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {

			 echo 1;
		}
	   
	     $sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
    
		for ($row = 0; $row <= $highestRow; $row++){ 

		    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
		}
		
		echo '<table>';
		for($i=2; $i<$highestRow+1; $i++ ){
			
			echo '<tr>';
			for($j=0; $j< ord(strtolower($highestColumn)) - 96; $j++ ){
				if($j==0||$j==10)
					echo '<td>|'. $rowData[$i][0][$j].'</td>';
			}
			
             $this->db->where('question_id',$rowData[$i][0][0]);
			 $this->db->delete('question_tag_rel');
			 $strtag = $rowData[$i][0][10];
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
				$this->db->insert('question_tag_rel', array('tag_id'=>$tid, 'question_id'=>$rowData[$i][0][0]));
			 }
					
			
			echo '</tr>';
		}
		echo '</table>';
	   
	  
   } 
   
       
   
    function insert_tt(){
	   
	   include 'Classes/PHPExcel/IOFactory.php';
	   $inputFileName = 'ThoiKhoaBieu2vv.xlsx';
	   try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {

			 echo 1;
		}
	   
	     $sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
    
		for ($row = 0; $row <= $highestRow; $row++){ 

		    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
		}
		
		echo '<table>';
		for($i=1; $i<$highestRow; $i++ ){
			
			echo '<tr>';
			for($j=0; $j< ord(strtolower($highestColumn)) - 96; $j++ ){
				echo '<td>|'. $rowData[$i][0][$j].'</td>';
			}
			
			$date = new DateTime($rowData[$i][0][2]);
			echo '<td>|'.$date->format('Y-m-d').'</td>';

			$aa= $date->format('Y-m-d');
			$array=array("cid"=>  $rowData[$i][0][1],
			             "lid"=>8,
						 "day"=>$aa);
			//$this->db->where("qid", $rowData[$i][0][0]);
			
			$this->db->insert("timetable", $array);
			echo '</tr>';
		}
		echo '</table>';
	   
	   
   
	}
	
	function test_a(){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		
		/*$base= 
		for($i=0; $i<19;$i++){
			
		}*/
		 $date = new DateTime('2019-1-2');
		//$dayofweek = date('w', strtotime($date));
		//echo $dayofweek;
         echo $date->format('Y-m-d');
		
		
		
		
	}
	
	
	function t_c(){
		$cookie = get_cookie('savsoftquiz');
		 
		echo $cookie;
	}
	
	function t_info(){
		foreach($_SERVER as $key => $value){
			echo '$_SERVER["'.$key.'"] = '.$value."<br />";
		}
        
	}
	
	
	function php_info(){
		phpinfo(32);
	}
	
	function t_a(){
		
	}
	
}