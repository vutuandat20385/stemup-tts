
<?php 
class Excel_import_model extends CI_model{
	function select(){
		// $this->db->order_by('pid','desc');
		$this->db->select('url_name,link,content,title,img,category');
		$query = $this->db->get('reading_material_5');
		return $query;		
	}
	function insert($question){
		log_message('error','Noi dung='. $question);

		$sql = "INSERT INTO savsoft_qbank(question)  VALUES ('$question')";// Insert vào DB bằng câu lệnh SQL
		$kq = $this->db->query($sql);
		$data['id_lop'] = $this->db->insert_id();

		$this->db->select('question');
		$query = $this->db->get('savsoft_qbank');
		$data['result'] = $query->result_array();
		return $data;		
	}


	
	function get_data_str1(){
		$sql = "SELECT question1 FROM savsoft_qbank";
		$kq= $this->db->query($sql);
		return($kq->result_array());

	}

	// function insert_n($str){
	// 	log_message('error','Gia tri string: '.$str);
	// 	$sql = "INSERT INTO lop(name) VALUES ('$str')";
	// 	$this->db->query($sql);
	// }

	function get_data_str($str){
		
		$str = trim(mb_strtolower($str));
		$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
		$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
		$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
		$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
		$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
		$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
		$str = preg_replace('/(đ)/', 'd', $str);
		$str = preg_replace('/[^a-z0-9-\s]/', '', $str);
		$str = preg_replace('/([\s]+)/', '-', $str);
		return $str;
		
	}

	function insert_permalink($id_lop,$permalink){
		// log_message('error','Noi dung='. $question);

		$sql = "INSERT INTO savsoft_permalink(model,content_id,permalink)  VALUES ('qbank',$id_lop,'$permalink')";// Insert vào DB bằng câu lệnh SQL
		$kq = $this->db->query($sql);
		
	}


	function insert_anh ($anh,$row){
		// log_message('error','Noi dung='. $question);

		$sql = "UPDATE reading_material_5 SET img  = '$anh' WHERE rdid = ($row+208)";// Insert vào DB bằng câu lệnh SQL
		$kq = $this->db->query($sql);
		// $data['id_lop'] = $this->db->insert_id();

		// $this->db->select('question');
		// $query = $this->db->get('savsoft_qbank');
		// $data['result'] = $query->result_array();
		return $kq;		
	}
}

?>