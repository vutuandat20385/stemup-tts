<?php
Class Library_model extends CI_Model{
	function add_video(){
		$inp= json_decode($this->input->raw_input_stream,true);
		$ins_data = array("content"=>$inp['video_if'],
		                  "type"=>"video",
						  "name"=>$inp['name_video'],
						  "title"=>$inp['title_video'],
		                  "description"=>$inp['descr_video'],
						  "cid"=>$inp['cid_video'],
						   "lid"=>$inp['lid_video'],
						   "source"=>$inp['source_video'],
						   "unit"=> $inp['unit_video']);
		$this->db->insert("savsoft_library", $ins_data);
		$lib_id=$this->db->insert_id();
		$strtag = $inp['tags_video'];
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
		 
         $link= $inp['name_video'];		 
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
			
		return $inp;
	}
	function edit_video(){
		$inp= json_decode($this->input->raw_input_stream,true);
		$ins_data = array(
		"type"=>"video",
		"name"=>$inp['name_video'],
		"title"=>$inp['title_video'],
		"description"=>$inp['descr_video'],
		"cid"=>$inp['cid_video'],
		 "lid"=>$inp['lid_video'],
		 "source"=>$inp['source_video'],
		 "unit"=> $inp['unit_video']);
		 $this->db->where('lib_id',$inp['lib_id']);
		 $this->db->update('savsoft_library',$ins_data);
		 $strtag = $inp['tags_video'];
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
			$this->db->where('lib_id',$inp['lib_id']);
			$this->db->where('tag_id',$tid);
			$num = $this->db->get('library_tags_rel')->num_rows();
			if($num != 0){
				$this->db->insert('library_tags_rel', array('tag_id'=>$tid, 'lib_id'=>$inp['lib_id']));
			}
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
			$link= $inp['name_video'];		 
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
			 $link=$inp['lib_id'];
		 }
		 else
			 $link.='-'.$inp['lib_id'];
			 while(strpos($link, '--'))
			$link = str_replace(array('--'),'-',$link);
			$dataaa = array(
				'permalink' => $link,
		);
			$this->db->where("model","video");
			$this->db->where('content_id',$inp['lib_id']);
			$this->db->update('savsoft_permalink',$dataaa);
		// $this->db->insert('savsoft_permalink', array("model"=>"video", "content_id"=>$lib_id, "permalink"=>$link));	
		return $inp;
	}

	function deleteVideo($id){
		$user= $this->session->userdata("logged_in");
		if($user['uid'] ==1 ){
			$this->db->set('deleted','1');
			$this->db->where("lib_id",$id);
			$this->db->update("savsoft_library");
		}
	}
	
	function get_data_library($type,$search,$limit=5, $page=0){
		$this->db->select("savsoft_library.*,savsoft_permalink.permalink ");
		$this->db->where("deleted",0);
		$this->db->where("type", $type);
		$likesearch = " ( savsoft_library.name like '%$search%' or savsoft_library.title like '%$search%' ) ";
		$this->db->where($likesearch);
		$this->db->join("savsoft_permalink", "savsoft_permalink.content_id = savsoft_library.lib_id and savsoft_permalink.model ='video'");
		$this->db->limit($limit);
		$this->db->offset($limit*$page);
		$this->db->order_by("lib_id desc");
		$data=$this->db->get("savsoft_library")->result_array();
		return $data;
	}
	
	function number_data_library($type,$search){
		$this->db->select("lib_id");
		$this->db->where("type", $type);
		$likesearch = " ( savsoft_library.name like '%$search%' or savsoft_library.title like '%$search%' ) ";
		$this->db->where($likesearch);
		$data=$this->db->get("savsoft_library")->num_rows();
		return $data;
	}
	function get_data_search_library($search,$limit=5, $page=0){
		$this->db->select("savsoft_library.*,savsoft_permalink.permalink ");
		$likesearch = " ( savsoft_library.name like '%$search%' or savsoft_library.title like '%$search%' ) ";
		$this->db->where($likesearch);
		$this->db->join("savsoft_permalink", "savsoft_permalink.content_id = savsoft_library.lib_id and savsoft_permalink.model ='video'");
		$this->db->limit($limit);
		$this->db->offset($limit*$page);
		$this->db->order_by("lib_id desc");
		$data=$this->db->get("savsoft_library")->result_array();
		return $data;
	}
	function number_data_search_library($search){
		$this->db->select("lib_id");
		$likesearch = " ( savsoft_library.name like '%$search%' or savsoft_library.title like '%$search%' ) ";
		$this->db->where($likesearch);
		$data=$this->db->get("savsoft_library")->num_rows();
		return $data;
	}
	function get_info_video($lib_id){
		$this->db->where('lib_id',$lib_id);
		$data['info'] = $this->db->get('savsoft_library')->row_array();
		$this->db->where('lib_id',$lib_id);
		$tag_records = $this->db->get('library_tags_rel')->result_array();
		$tag_string = '';
		for($i=0;$i<sizeof($tag_records);$i++){
			$tag_string .= $tag_records[$i]['tag_id'].',';
		}
		$tag_string =  substr($tag_string, 0, -1);
		$tags=$this->db->query('select tag_name from tags where tag_id in ('. $tag_string .')')->result_array();
		$data['tags_result'] = '';
		for($i=0;$i<sizeof($tags);$i++){
			$data['tags_result'] .= $tags[$i]['tag_name'].',';
		}
		return $data;
	}
	
}