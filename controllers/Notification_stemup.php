<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_stemup extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
	   $this->load->model("notification_model");
	   $this->load->model("notify_model");
	     $this->lang->load('basic', $this->config->item('language'));

	 }
	 
    function reminder_assign($key){
		if($key=="15oej88k72c55m9bxbsckehvk78phfli8laza4j7fts0636r5qi2wcrqqgem"){
			$this->load->library('Curl');
			$ch = curl_init();
			$a= array( "content_available"=> true,
					  "notification"=> array(
							 "title"=> "Đến giờ giao bài",
							  "body"=> "Mời bạn vào app STEMUP để giao bài hàng ngày cho con.",
							  "content_available"=> true,
							   "sound"=> "default"
					 ),
					"data"=> array("id"=>0),
					"to"=> "/topics/stemup.stem.vn");
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