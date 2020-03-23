<?php
Class event_racing_model extends CI_Model{
	function get_data_perday($day, $page=0){
		$this->db->select("savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,event_day_points.* ");
		$this->db->join("savsoft_users", "savsoft_users.uid=event_day_points.uid");
		$this->db->where("day", $day);
		$this->db->order_by("total_points desc");
		$this->db->limit(10);
		$this->db->offset(10*$page);
		$data=$this->db->get("event_day_points")->result_array();
		return $data;
		
	}
	
	function num_user_perday($day){
		$this->db->select("event_day_points.uid ");
		$this->db->join("savsoft_users", "savsoft_users.uid=event_day_points.uid");
		$this->db->where("day", $day);
		$this->db->order_by("total_points desc");
		$data=$this->db->get("event_day_points")->num_rows();
		return $data;
		
	}
	function get_do_points_perday($day){
		$this->db->select("savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,event_day_points.* ");
		$this->db->join("savsoft_users", "savsoft_users.uid=event_day_points.uid");
		$this->db->where("day", $day);
		$this->db->order_by("do_points desc");
		$this->db->limit(10);
		$data=$this->db->get("event_day_points")->result_array();
		return $data;
	}
	function num_do_points_perdays($day,$category){
		$Select = "Select savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid)*10 as points ";
		$from = " from savsoft_answer_mcq ";
		$inner_join = " inner join savsoft_users on savsoft_users.uid=savsoft_answer_mcq.uid ";
		$where = " where istrue = 1 and savsoft_users.su = 2 and create_date like '%$day%' ";
		if($category!="default" && $category!=0){
			$where .= " and savsoft_answer_mcq.qid in (select qid from savsoft_qbank where cid = $category) ";
		}
		$group_by = " group by savsoft_answer_mcq.uid ";
		$order_by = " order by count(savsoft_answer_mcq.uid) desc ";
		$sql = $Select .' '. $from .' '. $inner_join.' '.$where.' '.$group_by.' '. $order_by;
		$data = $this->db->query($sql)->num_rows();
		return $data;
	/*	$this->db->select("savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid) as points ");
		$this->db->join("savsoft_users", "savsoft_users.uid=savsoft_answer_mcq.uid");
		$this->db->where("istrue","1");
		$this->db->like("create_date",$day);
		$this->db->group_by("savsoft_answer_mcq.uid");
		$this->db->order_by("count(savsoft_answer_mcq.uid)","desc");
		$data=$this->db->get("savsoft_answer_mcq")->num_rows();
		return $data;*/
	}
	function get_do_points_perdays($day,$category,$limit=10,$page=0){

		$Select = "Select savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid)*10 as points ";
		$from = " from savsoft_answer_mcq ";
		$inner_join = " inner join savsoft_users on savsoft_users.uid=savsoft_answer_mcq.uid ";
		$where = " where istrue = 1 and savsoft_users.su = 2 and create_date like '%$day%' ";
		if($category!="default" && $category!=0){
			$where .= " and savsoft_answer_mcq.qid in (select qid from savsoft_qbank where cid = $category) ";
		}
		$group_by = " group by savsoft_answer_mcq.uid ";
		$order_by = " order by count(savsoft_answer_mcq.uid) desc ";
		$limit = " limit $limit ";
		$off = $page*$limit;
		$offset = " offset $off ";
		$sql = $Select .' '. $from .' '. $inner_join.' '.$where.' '.$group_by.' '. $order_by.' '. $limit.' '. $offset;
		$data = $this->db->query($sql)->result_array();
		return $data;
			/*	$this->db->select("savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid)*10 as points ");
		$this->db->join("savsoft_users", "savsoft_users.uid=savsoft_answer_mcq.uid");
		$this->db->where("istrue","1");
		$this->db->where("savsoft_users.su","2");
		$this->db->like("create_date",$day);
		$this->db->group_by("savsoft_answer_mcq.uid");
		$this->db->order_by("count(savsoft_answer_mcq.uid)","desc");
		$offset = $page*$limit;
		$this->db->limit($limit,$offset);
		$data=$this->db->get("savsoft_answer_mcq")->result_array();
		return $data;*/
	}

	function get_data_perweek($monday,$sunday, $page=0,$category, $limit=10){
		$Select = "Select savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid)*10 as points ";
		$from = " from savsoft_answer_mcq ";
		$inner_join = " inner join savsoft_users on savsoft_users.uid=savsoft_answer_mcq.uid ";
		$where = " where istrue = 1 and savsoft_users.su = 2 and create_date > '$monday' and create_date < '$sunday' ";
		if($category!="default" && $category!=0){
			$where .= " and savsoft_answer_mcq.qid in (select qid from savsoft_qbank where cid = $category) ";
		}
		$group_by = " group by savsoft_answer_mcq.uid ";
		$order_by = " order by count(savsoft_answer_mcq.uid) desc ";
		$limit = " limit $limit ";
		$off = $page*10;
		$offset = " offset $off ";
		$sql = $Select .' '. $from .' '. $inner_join.' '.$where.' '.$group_by.' '. $order_by.' '. $limit.' '. $offset;
		$data = $this->db->query($sql)->result_array();
		return $data;

	/*	$this->db->select("savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid)*10 as points ");
		$this->db->join("savsoft_users", "savsoft_users.uid=savsoft_answer_mcq.uid");
		$this->db->where("istrue","1");
		$this->db->where("create_date >",$monday);
		$this->db->where("create_date <",$sunday);
		$this->db->group_by("savsoft_answer_mcq.uid");
		$this->db->order_by("count(savsoft_answer_mcq.uid)","desc");
		$offset = $page*10;
		$this->db->limit(10,$offset);
		$data=$this->db->get("savsoft_answer_mcq")->result_array();
		return $data;*/
	}
	
	function num_user_perweek($monday,$sunday,$category){

		$Select = "Select savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid)*10 as points ";
		$from = " from savsoft_answer_mcq ";
		$inner_join = " inner join savsoft_users on savsoft_users.uid=savsoft_answer_mcq.uid ";
		$where = " where istrue = 1 and savsoft_users.su = 2 and create_date > '$monday' and create_date < '$sunday' ";
		if($category!="default" && $category!=0){
			$where .= " and savsoft_answer_mcq.qid in (select qid from savsoft_qbank where cid = $category) ";
		}
		$group_by = " group by savsoft_answer_mcq.uid ";
		$order_by = " order by count(savsoft_answer_mcq.uid) desc ";
		$sql = $Select .' '. $from .' '. $inner_join.' '.$where.' '.$group_by.' '. $order_by;
		$data = $this->db->query($sql)->num_rows();
		return $data;

	/*	$this->db->select("savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue");
		$this->db->join("savsoft_users", "savsoft_users.uid=savsoft_answer_mcq.uid");
		$this->db->where("istrue","1");
		$this->db->where("create_date >",$monday);
		$this->db->where("create_date <",$sunday);
		$this->db->group_by("savsoft_answer_mcq.uid");
		$data=$this->db->get("savsoft_answer_mcq")->num_rows();
		return $data;*/
	}
	
	function get_data_alltime($page=0,$category){
		$Select = "Select savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid)*10 as points ";
		$from = " from savsoft_answer_mcq ";
		$inner_join = " inner join savsoft_users on savsoft_users.uid=savsoft_answer_mcq.uid ";
		$where = " where istrue = 1 and savsoft_users.su = 2 ";
		if($category!="default" && $category!=0){
			$where .= " and savsoft_answer_mcq.qid in (select qid from savsoft_qbank where cid = $category) ";
		}
		$group_by = " group by savsoft_answer_mcq.uid ";
		$order_by = " order by count(savsoft_answer_mcq.uid) desc ";
		$limit = " limit 10 ";
		$off = $page*10;
		$offset = " offset $off ";
		$sql = $Select .' '. $from .' '. $inner_join.' '.$where.' '.$group_by.' '. $order_by.' '. $limit.' '. $offset;
		$data = $this->db->query($sql)->result_array();
		return $data;


	/*	$this->db->select("savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid)*10 as points ");
		$this->db->join("savsoft_users", "savsoft_users.uid=savsoft_answer_mcq.uid");
		$this->db->where("istrue","1");
		$this->db->group_by("savsoft_answer_mcq.uid");
		$this->db->order_by("count(savsoft_answer_mcq.uid)","desc");
		$offset = $page*10;
		$this->db->limit(10,$offset);
		$data=$this->db->get("savsoft_answer_mcq")->result_array();
		return $data;*/
	}
	
	function mum_user_alltime($category){

		$Select = "Select savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue,count(savsoft_answer_mcq.uid)*10 as points ";
		$from = " from savsoft_answer_mcq ";
		$inner_join = " inner join savsoft_users on savsoft_users.uid=savsoft_answer_mcq.uid ";
		$where = " where istrue = 1 and savsoft_users.su = 2 ";
		if($category!="default" && $category!=0){
			$where .= " and savsoft_answer_mcq.qid in (select qid from savsoft_qbank where cid = $category) ";
		}
		$group_by = " group by savsoft_answer_mcq.uid ";
		$order_by = " order by count(savsoft_answer_mcq.uid) desc ";
		$sql = $Select .' '. $from .' '. $inner_join.' '.$where.' '.$group_by.' '. $order_by;
		$data = $this->db->query($sql)->num_rows();
		return $data;

	/*	$this->db->select("savsoft_users.first_name,savsoft_users.last_name,savsoft_users.email,savsoft_answer_mcq.uid,savsoft_answer_mcq.istrue");
		$this->db->join("savsoft_users", "savsoft_users.uid=savsoft_answer_mcq.uid");
		$this->db->where("istrue","1");
		$this->db->group_by("savsoft_answer_mcq.uid");
		$data=$this->db->get("savsoft_answer_mcq")->num_rows();
		return $data;*/
	}
	
	/*-------------*/
	function update_views($id, $model){
		 date_default_timezone_set('Asia/Ho_Chi_Minh');
		 $day = date('d/m/Y', time());

		 $this->db->where("content_id",$id);
		 $this->db->where("model",$model);
		 $this->db->where("day",$day);
		 $dp=$this->db->get("event_statistics");
		
		 if($dp->num_rows()>0){
			// increase views 
			$dpdata = $dp->row_array();
			$views= intval($dpdata["views"])+1;     				
			$this->db->where("content_id", $id);
			$this->db->where("model",$model);
			$this->db->where("day", $day);	         				
			$this->db->update("event_statistics", array("views"=>$views));
			
			//plus day points
			// check create date and plus day point
			$this->db->where("content_id", $id);
			$create_day =$this->db->get("event_statistics")->row_array()['day'];
			if($create_day==$day){
				if($dpdata["plus_day_points"]==0){
					if($views==50){
						$this->db->where("day", $day);	 
						$this->db->where("uid", $dpdata['uid']);
						$inf= $this->db->get("event_day_points")->row_array();
						$do_points = $inf["do_points"]+500;
						$total_points = $inf["total_points"]+500;
						$this->db->where("day", $day);	  
						$this->db->where("uid", $dpdata['uid']);					
						$this->db->update("event_day_points", array("do_points"=>$do_points,"total_points"=>$total_points));
						$this->db->where("day >=", $day);
						$this->db->where("content_id", $id);
						$this->db->where("model",$model);
						$this->db->update("event_statistics", array("plus_day_points"=>1));
													
					}
				}
			}
			// plus week points
			//check plus week points
			if($dpdata["plus_week_points"]==0){
				$sql="select sum(views) as week_views from event_statistics where content_id=".$id;
				$week_views= $this->db->query($sql)->row_array()["week_views"];
			
				if($week_views==200){
					$this->db->where("day", $day);	 
					$this->db->where("uid", $dpdata['uid']);
					$inf= $this->db->get("event_day_points")->row_array();
					$do_points = $inf["do_points"]+500;
					$total_points = $inf["total_points"]+500;
					$this->db->where("day", $day);	  
					$this->db->where("uid", $dpdata['uid']);					
					$this->db->update("event_day_points", array("do_points"=>$do_points,"total_points"=>$total_points));	
					$this->db->where("day>=", $day);
					$this->db->where("content_id", $id);
					$this->db->where("model",$model);
					$this->db->update("event_statistics", array("plus_week_points"=>1));						
				}
				
			}
		 }

	}
	

	function minus_point_day($day){
		$this->db->where("plus_day_points",0);
		$this->db->where("day",$day);
		$data= $this->db->get("event_statistics")->result_array();
		foreach($data as $dt){
			$this->db->where("day", $day);
			$this->db->where("uid", $dt['uid']);
			$udp=$this->db->get("event_day_points");
			if($udp->num_rows()>0){
				
				$do_points=$udp->row_array()["do_points"] -200; // (******)
				$total_points=$udp->row_array()["total_points"] -200; // (******)
				$this->db->where("day", $day);
			    $this->db->where("uid", $dt['uid']);
				$this->db->update("event_day_points", array("do_points"=>$do_points,"total_points"=>$total_points ));
			}
			
			$this->db->where("content_id", $dt['content_id']);
			$this->db->where("model", $dt['model']);
			$this->db->update("event_statistics", array("plus_day_points"=>1));
		}

	}
	function minus_point_week($sunday){
		$this->db->where("plus_week_points",0);
		$this->db->where("day",$sunday);
		$data= $this->db->get("event_statistics")->result_array();
		foreach($data as $dt){
			$this->db->where("day", $sunday);
			$this->db->where("uid", $dt['uid']);
			$udp=$this->db->get("event_day_points");
			if($udp->num_rows()>0){
				
				$do_points=$udp->row_array()["do_points"] -200; // (******)
				$total_points=$udp->row_array()["total_points"] -200; // (******)
				$this->db->where("day", $sunday);
			    $this->db->where("uid", $dt['uid']);
				$this->db->update("event_day_points", array("do_points"=>$do_points,"total_points"=>$total_points ));
			}
			else{
				$dtarray=array("day"=>$sunday,
				               "uid", $dt["uid"],
							   "do_points"=>-200,
							   "total_points"=>-200);
				$this->db->insert("event_day_points", $dtarray);
			}
			
			$this->db->where("content_id", $dt['content_id']);
			$this->db->where("model", $dt['model']);
			$this->db->update("event_statistics", array("plus_week_points"=>1));
		}
	}
	

} 