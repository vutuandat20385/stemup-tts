<?php
Class Timetable_model extends CI_Model{
	function calculate_schedule($classid){
		//jd level
		
		//base 
		//2019-01-02 // 12
			//            0  1  2   3   4  5 6  7   8  9 // filter foreach level
		$unit 	  = array(0 ,0 ,0  ,71 ,19,0,19,37 ,37,0,
						  19,37,58 ,0  ,0 ,0,0 ,73 ,0 ,0,
						  0 ,19,0  ,0  ,0 ,0,0 ,0  ,0 ,0);		
	   $unit_max =  array(0 ,0 ,0  ,140,35,0,35,70 ,70,0,
						  35,70,105,0  ,0 ,0,0 ,140,0 ,0,
						  0 ,35,0  ,0  ,0 ,0,0 ,0  ,0 ,0);
      
		//get subject
		
		$ar = array();
		$this->db->where("class_id",$classid);
        $lid = $this->db->get("class")->row_array()['lid'];   
		$this->db->where('classid', $classid);
		$this->db->delete('timetable_copy');
		for($i=0; $i<150;$i++){
			
			//jd start time
			$day = date("Y-m-d", mktime(0, 0, 0, 1, 2+$i, 2019));
			//holiday check
			$this->db->where("day", $day);
			$ch=$this->db->get("holiday")->row_array();
			if($ch==0){
				$dayofweek =   date('w', strtotime($day))+1;
				if($dayofweek>1){
					$this->db->select('id_category AS cid');
					$this->db->where('id_day', $dayofweek);
					$this->db->where('id_category !=',0);
					$this->db->where('id_class',$classid);
					$data = $this->db->get("savsoft_schedule")->result_array();
					$ce = 0;
                    foreach($data as $k=>$d){
						if($d['cid']==12)
							$ce++;
					}
					$cce=0;
					foreach($data as $k=>$d){
						 if($unit[$d['cid']]<=$unit_max[$d['cid']]){
							if($d['cid']==12)
								if($ce!=2)
									$data[$k]['u']=$unit[$d['cid']]++;
								else{
									
									$data[$k]['u']=$unit[$d['cid']];
									if($cce!=0){
										$unit[$d['cid']]++;
										
									}
									$cce=1;
								}
                            else
								$data[$k]['u']=$unit[$d['cid']]++;
                            $ssbj=0; 
							$un = $data[$k]['u'];
							$this->db->where("cid", $d['cid']);
							$this->db->where("lid", $lid);
							$this->db->where("unit", $un);
							$m= $this->db->get("map_unit")->row_array();
							if($m){
								 $ssbj=$m['sub_subject'];
								 $un=$m['unit_ss'];
							}
							$array = array("classid"=>$classid, "cid"=>$d['cid'],"sub_subject"=>$ssbj, "lid"=>$lid, "unit"=>$un, "day"=>$day);
							$this->db->insert('timetable_copy',$array);
						 }
					}
					
				}
			}
		}
       
			
		
	
		
		
	}
	
	
	
}