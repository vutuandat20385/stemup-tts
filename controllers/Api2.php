<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api2 extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');

		$this->load->model("user_model");
		$this->load->model("quiz_model");
		$this->load->model("api2_model");
		$this->load->model("qbank_model");  
		$this->load->model("classes_model"); 
		$this->load->model("comment_model");
		$this->load->model("result_model");
		$this->lang->load('basic', $this->config->item('language'));
	}

	function create_review_content(){

		$uid = $this->input->post('uid');
		$qid = $this->input->post('qid');
		$review_point = $this->input->post('review_point');
		$review_content = $this->input->post('review_content');


		if(isset($uid) && isset($qid) && isset($review_point)){
			$result = $this->api2_model->add_review_content2($uid, $qid, $review_point, $review_content);
		}else
			$result = array('message'=>'error','status'=>-1);


		echo json_encode($result);
	}

	function get_review_content($uid, $qid){
		$result=$this->api2_model->get_review_content($uid, $qid);

		echo json_encode($result);

	}

	function send_answers2(){
		$connection_key=$_POST["connection_key"];
		$uid=$_POST["uid"];
		$quid=$_POST["quid"];
		$id=$_POST["id"];
		$answers=$_POST["answers"];
		
		log_message('error', 'User: '.$uid.'-->Nop bai');
		//Check connection_key
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		} else {
			$open_result=$this->quiz_model->open_result($quid,$uid);
			$data['quiz']=$this->quiz_model->get_quiz($quid);
			$data['rid']=$this->quiz_model->insert_result($quid,$uid);
			$this->session->set_userdata('rid', $data['rid']);
			if($answers != ''){
				$arrans = explode('-', $answers);
				$arridx= array();
				$qidans= array();
				for($i=count($arrans)-1; $i>=0; $i-- ){
					$qida = explode("+",$arrans[$i])[0];
					if(!in_array($qida, $qidans)){
						array_push($qidans, $qida);
						array_push($arridx, $i);
					}
				}
				$individual_time = array();
				$rid = $data['rid'];
				$query=$this->db->query("select * from savsoft_result join savsoft_quiz on  savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
				$quiz=$query->row_array(); 
				$correct_score=$quiz['correct_score'];
				$incorrect_score=$quiz['incorrect_score'];
				$qids=explode(',',$quiz['r_qids']);
				$vqids=$quiz['r_qids'];
				$correct_incorrect=explode(',',$quiz['score_individual']);

				for ($i=0; $i < count($arrans); $i++) {
					if(in_array($i,$arridx)){
						$attempted=1;
						$marks=0;
						if(explode('+', $arrans[$i])[2] <= 0 ){
							$marks+=-1;	
						}else{
							$marks+=explode('+', $arrans[$i])[2];
						}
						//log_message('error', $marks);
						$answerdata = array(
							'qid' => explode('+', $arrans[$i])[0],
							'q_option' => explode('+', $arrans[$i])[1],
							'uid' => $uid,
							'score_u' => explode('+', $arrans[$i])[2],
							'rid' => $data['rid']
						);
						$this->db->insert('savsoft_answers', $answerdata);
						
												
						if($marks >= 1 ){

							$correct_incorrect[$i]=1;	
						}else{
							$correct_incorrect[$i]=2;							
						}
						$individual_time[] = 5;
					}
				}

				$userdata=array(
				 	'score_individual'=>implode(',',$correct_incorrect),
				 	'individual_time'=>implode(',',$individual_time)
				);
				$this->db->where('rid',$data['rid']);
				$this->db->update('savsoft_result',$userdata);
				
				if($this->quiz_model->submit_results2($user, $data['rid'])){
					
					$data['msg'] = 'successfully';
					log_message('error','--> Nop bai thanh cong: ');
					if($user['parent_id']){
						$dataassign = array('status' => 2,'rid'=>$data['rid']);
						$this->db->where('quid', $quid);
						$this->db->where('uid', $uid);
						$this->db->where('id', $id);
						$this->db->update('savsoft_assign', $dataassign);
						
						$this->db->where('rid', $data['rid']);
						
						
						$this->db->where('quid', $quid);
						$this->db->where('uid', $uid);
						$dd= $this->db->get('savsoft_assign')->row_array();
						if($dd){
					
							$notifydt= array("uid"=>$uid,
							                 "content"=>"đã làm xong bài ",
											 "model"=>"result",
											 "action"=>"Answer assign quiz",
											 "click" => "window.location.href = '".site_url()."/result/view_result/".$data['rid']."'",
											 "rid"=>$data['rid']);
							$this->db->insert('notify', $notifydt);
							$nid = $this->db->insert_id();
							$notifyuserdt1= array("nid"=>$nid,"uid"=>$uid, "status"=>1);
							$notifyuserdt2= array("nid"=>$nid,"uid"=>$dd['auid'], "status"=>1);
							$this->db->insert('notify_user', $notifyuserdt1);
							$this->db->insert('notify_user', $notifyuserdt2);
							
							
						}
						
						$this->db->select('percentage_obtained');
						$this->db->where('rid',$data['rid']);
						$quizz= $this->db->get('savsoft_result')->row_array();
						if($dd){
							
							$type="";
							$this->db->where('quid', $quid);
							$qq= $this->db->get('savsoft_quiz')->row_array();
							if($qq){
								if($qq['level_hard']){
									if($qq['level_hard']>3){
										$type="KNS";
									}
									else{
										$type="HCC";
									}
								}
							}	
							$this->db->where("nid", $nid);							
							$this->db->update("notify",array("content"=>"đã làm xong bài ".$type.". Kết quả: ".number_format($quizz['percentage_obtained'],0)."%"));
							if($quiz['r_qids']){

                                $tp= $dd['price'];
								$tp2 = ceil($dd['reward_point']*$quizz['percentage_obtained']/100);
								
								$this->db->where("uid", $dd['auid']);
								$ap= $this->db->get("savsoft_users")->row_array()['point'];
								$this->db->where("uid", $dd['auid']);
								$this->db->update("savsoft_users", array("point"=>$ap-$tp-$tp2));
								
								$arr_hp=array("uid"=>$dd['auid'],
								              "point_change"=>-$tp-$tp2,
											  "point_remain"=>$ap-$tp-$tp2,
											  "nid"=>$nid,
											  "activity"=>"assign_quiz"

								             );
								
								$this->db->insert("history_point", $arr_hp);
								
								// log_message("error", "********************".$tp2."----------------".$tp);
								$this->db->where("uid", $dd['uid']);
								$ap2= $this->db->get("savsoft_users")->row_array()['point'];
								$this->db->where("uid", $dd['uid']);
								$this->db->update("savsoft_users", array("point"=>$ap2+$tp2));
								
								$arr_hp=array("uid"=>$dd['uid'],
								              "point_change"=>$tp2,
											  "point_remain"=>$ap2+$tp2,
											  "nid"=>$nid,
											  "activity"=>"reward_do_assign_quiz"

								             );
								
								$this->db->insert("history_point", $arr_hp);
							}
						}
						$pr_ids=explode(",",$user['parent_id']);
						foreach($pr_ids as $pr_id){
							$this->db->where("uid", $pr_id);
							$this->db->where("app", 'stemup');
							$tk=$this->db->get('user_token_fcm')->result_array();
							// log_message("error", "Làm bài--- ".$pr_id);
							// log_message("error", "Làm bài--- ".$user['uid']);
							//log_message("error", "Làm bài--- ".json_encode($tk));
								
							foreach($tk as $t){
								$to = $t['fcm_token'];
								// log_message("error", "Làm bài ".$to." ".$pr_id." ".$t['divideid']);
								
								$this->load->library('Curl');
								$ch = curl_init();
								$a= array( "content_available"=> true,
										  "notification"=> array(
												 "title"=> $user['first_name'].' '.$user['last_name']."vừa làm bài",
												  "body"=> $user['first_name'].' '.$user['last_name'].'vừa làm xong, kết quả đạt '.number_format($quizz['percentage_obtained'],1).'%',
												  "content_available"=> true,
												   "sound"=> "default"
										 ),
										"data"=> array("id"=>0),
										"to"=> $to);
								$inp= json_encode($a);
								curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $inp);
								curl_setopt($ch, CURLOPT_POST, 1);
								
								curl_setopt($ch, CURLOPT_HTTPHEADER, array(
									 "Authorization: key=AAAAIUedk8M:APA91bHreQ0thOuZzGPA7hNlIDthF2Edog4s638tMJdIFUshMAqFrHfISm7pmMwidWFjSQ9IviMn14rwpKxFk8cu7FcGwfW2S7M0_untpzMf2cCJj7o5QbL-bz-wqlCt4HTqlI9_7vvD",
									"Content-Type: application/json"
									));

								$result = curl_exec($ch);
								if (curl_errno($ch)) {
									echo 'Error:' . curl_error($ch);
								}
								curl_close ($ch);
							}
						}
					}

					$kq=$this->api2_model->get_reward_point($uid, $quid, $rid);	
					// $data['starpoint']=$kq['starpoint'];
					$total_q=$kq['total'];
					$correct_q=$kq['correct'];
					$reward_point_q=$kq['reward_point'];

					$stars=round($reward_point_q*($correct_q/$total_q));
					$data['starpoint']=$stars;
					log_message('error','----> Ket qua lam bai dung: '.$correct_q.'/'.$total_q);

					// log_message('error','\n----> Duoc thuong: '.$data['starpoint'].' sao');
					log_message('error','----> Duoc thuong: '.$stars.' sao');
					log_message('error','----> Toi da: '.$reward_point_q.' sao');
				}else{
					$data['msg'] = 'failure';
					log_message('error','--> Nop bai khong thanh cong: ');
				}
			}
		}

		echo json_encode($data);

	}

	function resend_answers2(){
		$connection_key=$_POST["connection_key"];
		$uid=$_POST["uid"];
		$quid=$_POST["quid"];
		$id=$_POST["id"];
		$answers=$_POST["answers"];
		$old_rid=$_POST["rid"];
		
		log_message('error', '\nUser: '.$uid.'-->Nop bai');
		//Check connection_key
		$this->db->where('uid',$uid);
		$this->db->where('connection_key',$connection_key);
		$auth=$this->db->get('savsoft_users');
		$user=$auth->row_array();
		if($auth->num_rows()==0){
			exit('invalid Connection!');
		} else {
			$open_result=$this->quiz_model->open_result($quid,$uid);
			$data['quiz']=$this->quiz_model->get_quiz($quid);
			$data['rid']=$this->quiz_model->insert_result($quid,$uid);
			$this->session->set_userdata('rid', $data['rid']);
			if($answers != ''){
				$arrans = explode('-', $answers);
				$arridx= array();
				$qidans= array();
				for($i=count($arrans)-1; $i>=0; $i-- ){
					$qida = explode("+",$arrans[$i])[0];
					if(!in_array($qida, $qidans)){
						array_push($qidans, $qida);
						array_push($arridx, $i);
					}
				}
				$individual_time = array();
				$rid = $data['rid'];
				$query=$this->db->query("select * from savsoft_result join savsoft_quiz on  savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' "); 
				$quiz=$query->row_array(); 
				$correct_score=$quiz['correct_score'];
				$incorrect_score=$quiz['incorrect_score'];
				$qids=explode(',',$quiz['r_qids']);
				$vqids=$quiz['r_qids'];
				$correct_incorrect=explode(',',$quiz['score_individual']);
				// log_message('error', '***********1***********');
				// log_message('error', implode(" ", $correct_incorrect));
				// log_message('error', implode("**", $arridx));
				// log_message('error', implode("**", $qidans));
				for ($i=0; $i < count($arrans); $i++) {
					if(in_array($i,$arridx)){
						
				
						$attempted=1;
						$marks=0;
						if(explode('+', $arrans[$i])[2] <= 0 ){
							$marks+=-1;	
						}else{
							$marks+=explode('+', $arrans[$i])[2];
						}
						//log_message('error', $marks);
						$answerdata = array(
							'qid' => explode('+', $arrans[$i])[0],
							'q_option' => explode('+', $arrans[$i])[1],
							'uid' => $uid,
							'score_u' => explode('+', $arrans[$i])[2],
							'rid' => $data['rid']
						);
						$this->db->insert('savsoft_answers', $answerdata);
						
												
						if($marks >= 1 ){
							log_message('error', 'attempted');
							$correct_incorrect[$i]=1;	
						}else{
							$correct_incorrect[$i]=2;							
						}
						$individual_time[] = 5;
					}
				}
				// log_message('error', '**********2************');
				// log_message('error', implode(" ", $correct_incorrect));
				$userdata=array(
				 	'score_individual'=>implode(',',$correct_incorrect),
				 	'individual_time'=>implode(',',$individual_time)
				);
				$this->db->where('rid',$data['rid']);
				$this->db->update('savsoft_result',$userdata);
				
				if($this->quiz_model->submit_results2($user, $data['rid'])){
					
					$data['msg'] = 'successfully';
					log_message('error','\n--> Nop bai thanh cong: ');
					if($user['parent_id']){
						
						
						$this->db->where('rid', $old_rid);
						$this->db->where('quid', $quid);
						$this->db->where('id', $quid);
						$this->db->where('uid', $uid);
						$dd= $this->db->get('savsoft_assign')->row_array();
						if($dd){
					
							$notifydt= array("uid"=>$uid,
							                 "content"=>"Đã làm lại bài ",
											 "model"=>"result",
											 "action"=>"Answer assign quiz",
											 "click" => "window.location.href = '".site_url()."/result/view_result/".$data['rid']."'",
											 "rid"=>$data['rid']);
							$this->db->insert('notify', $notifydt);
							$nid = $this->db->insert_id();
							$notifyuserdt1= array("nid"=>$nid,"uid"=>$uid, "status"=>1);
							$notifyuserdt2= array("nid"=>$nid,"uid"=>$dd['auid'], "status"=>1);
							$this->db->insert('notify_user', $notifyuserdt1);
							$this->db->insert('notify_user', $notifyuserdt2);
							
							
						}
						
						$this->db->select('percentage_obtained');
						$this->db->where('rid',$data['rid']);
						$quizz= $this->db->get('savsoft_result')->row_array();
						if($dd){
							
							$type="";
							$this->db->where('quid', $quid);
							$qq= $this->db->get('savsoft_quiz')->row_array();
							if($qq){
								if($qq['level_hard']){
									if($qq['level_hard']>3){
										$type="KNS ";
									}
									else{
										$type="HCC ";
									}
								}
							}	
							$this->db->where("nid", $nid);							
							$this->db->update("notify",array("content"=>"Đã làm lại bài ".$type.". Kết quả: ".number_format($quizz['percentage_obtained'],0)."%"));
							
						}
						$pr_ids=explode(",",$user['parent_id']);
						foreach($pr_ids as $pr_id){
							$this->db->where("uid", $pr_id);
							$this->db->where("app", 'stemup');
							$tk=$this->db->get('user_token_fcm')->result_array();
							// log_message("error", "Làm bài--- ".$pr_id);
							// log_message("error", "Làm bài--- ".$user['uid']);
							//log_message("error", "Làm bài--- ".json_encode($tk));
								
							foreach($tk as $t){
								$to = $t['fcm_token'];
								// log_message("error", "Làm bài ".$to." ".$pr_id." ".$t['divideid']);
								
								$this->load->library('Curl');
								$ch = curl_init();
								$a= array( "content_available"=> true,
										  "notification"=> array(
												 "title"=> $user['first_name'].' '.$user['last_name']."vừa làm lại bài",
												  "body"=> $user['first_name'].' '.$user['last_name'].'vừa làm lại, kết quả đạt '.number_format($quizz['percentage_obtained'],1).'%',
												  "content_available"=> true,
												   "sound"=> "default"
										 ),
										"data"=> array("id"=>0),
										"to"=> $to);
								$inp= json_encode($a);
								curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $inp);
								curl_setopt($ch, CURLOPT_POST, 1);
								
								curl_setopt($ch, CURLOPT_HTTPHEADER, array(
									 "Authorization: key=AAAAIUedk8M:APA91bHreQ0thOuZzGPA7hNlIDthF2Edog4s638tMJdIFUshMAqFrHfISm7pmMwidWFjSQ9IviMn14rwpKxFk8cu7FcGwfW2S7M0_untpzMf2cCJj7o5QbL-bz-wqlCt4HTqlI9_7vvD",
									"Content-Type: application/json"
									));

								$result = curl_exec($ch);
								if (curl_errno($ch)) {
									echo 'Error:' . curl_error($ch);
								}
								curl_close ($ch);
							}
						}
					}
					$kq=$this->api2_model->get_reward_point($uid, $quid, $rid);	
					$data['starpoint']=0;
					$total_q=$kq['total'];
					$correct_q=$kq['correct'];
					log_message('error','\n----> Ket qua lam bai dung: '.$correct_q.'/'.$total_q);	
					log_message('error','\n----> Duoc thuong: '.$data['starpoint'].' sao');
				}else{
					$data['msg'] = 'failure';
					log_message('error','\n--> Nop bai khong thanh cong: ');
				}
			}
		}
		
		echo json_encode($data);
		//log_message("error",".......".json_encode($data));
	}

	
}