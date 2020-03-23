<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class thong_ke extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Form_validation');
        $this->load->helper(array('Form', 'Cookie', 'String', 'url'));
        $this->load->model('post_model');
        $this->load->model('user_model');
        $this->load->model("qbank_model");
        $this->load->model("account_model");
        $this->load->model("result_model");
        $this->load->model("api_model");
        $this->load->model("quiz_model");
        $this->load->model("classes_model");
        $this->load->model('notify_model');
        $this->load->model("data_model");
        $this->load->model("review_model");
        $this->load->model("comment_model");
        $this->load->model("profile_model");
        $this->load->model("sadmin_model");
        $this->load->model('event_racing_model');
      $this->lang->load('basic', $this->config->item('language'));
    }
    function index(){
        $user= $this->session->userdata('logged_in');
        $uid=$user['uid'];
   
  
 if($this->input->get('thang')!=0){
 $thang=$this->input->get('thang');
 $nam=$this->input->get('nam');
if ($thang==12) {
$tuan =date_create(''.$nam.'-'.$thang.'-1');
 $tuan=date_timestamp_get($tuan);
 $tuan1 =date_create(''.$nam.'-'.$thang.'-30');
 $tuan1=date_timestamp_get($tuan1);
  $tuan2 =date_create(''.$nam.'-'.$thang.'-14');
  $tuan2=date_timestamp_get($tuan2);
   $tuan3 =date_create(''.$nam.'-'.$thang.'-21');
   $tuan3=date_timestamp_get($tuan3);
  $tuan4 =date_create(''.$nam.'-'.$thang.'-30');
   $tuan4=date_timestamp_get($tuan4);
  
}else{
      $thang1=$thang+1;
 $tuan =date_create(''.$nam.'-'.$thang.'-1');
 $tuan=date_timestamp_get($tuan);
 $tuan1 =date_create(''.$nam.'-'.$thang.'-30');
 $tuan1=date_timestamp_get($tuan1);
  $tuan2 =date_create(''.$nam.'-'.$thang.'-14');
  $tuan2=date_timestamp_get($tuan2);
   $tuan3 =date_create(''.$nam.'-'.$thang.'-21');
   $tuan3=date_timestamp_get($tuan3);
  $tuan4 =date_create(''.$nam.'-'.$thang1.'-1');
   $tuan4=date_timestamp_get($tuan4);
}
   $data['month']=$thang;
   $data['year'] = $nam;

 $sql1="SELECT *  FROM quiz.savsoft_result where uid=$uid and start_time>$tuan and start_time<$tuan4";
 $sql="SELECT *  FROM quiz.savsoft_result where uid=$uid and start_time>$tuan and start_time<$tuan4  and result_status='Vượt qua'";

     $total_question_correct = $this->db->query($sql)->num_rows();

     $data['thang']['tuan1']['correct']=$this->sadmin_model->count_quiz_correct($uid,$tuan,$tuan1);
      $data['thang']['tuan1']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$tuan,$tuan1);
      $data['thang']['tuan1']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$tuan,$tuan1);
      if($data['thang']['tuan1']['quiz_done']==0){
 $data['thang']['tuan1']['ty_le']=0;
      }else{
       $data['thang']['tuan1']['ty_le']=  $data['thang']['tuan1']['correct']/$data['thang']['tuan1']['quiz_done']*100;
}

     $data['thang']['tuan2']['correct']=$this->sadmin_model->count_quiz_correct($uid,$tuan1,$tuan2);
      $data['thang']['tuan2']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$tuan1,$tuan2);
      $data['thang']['tuan2']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$tuan1,$tuan2);
       if($data['thang']['tuan2']['quiz_done']==0){
 $data['thang']['tuan2']['ty_le']=0;
      }else{
       $data['thang']['tuan2']['ty_le']=  $data['thang']['tuan1']['correct']/$data['thang']['tuan2']['quiz_done']*100;
}

     $data['thang']['tuan3']['correct']=$this->sadmin_model->count_quiz_correct($uid,$tuan2,$tuan3);
      $data['thang']['tuan3']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$tuan2,$tuan3);
      $data['thang']['tuan3']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$tuan2,$tuan3);
     if($data['thang']['tuan3']['quiz_done']==0){
 $data['thang']['tuan3']['ty_le']=0;
      }else{
       $data['thang']['tuan3']['ty_le']=  $data['thang']['tuan3']['correct']/$data['thang']['tuan3']['quiz_done']*100;
}

     $data['thang']['tuan4']['correct']=$this->sadmin_model->count_quiz_correct($uid,$tuan3,$tuan4);
      $data['thang']['tuan4']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$tuan3,$tuan4);
      $data['thang']['tuan4']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$tuan3,$tuan4);
    if($data['thang']['tuan4']['quiz_done']==0){
 $data['thang']['tuan4']['ty_le']=0;
      }else{
       $data['thang']['tuan4']['ty_le']=  $data['thang']['tuan4']['correct']/$data['thang']['tuan4']['quiz_done']*100;
}




}else {
    if($this->input->get('nam')=='')
    {
       $nam=2019;
    }else {
        $nam=$this->input->get('nam');
    }
 
$data['year'] = $nam;

   $nam1=$nam+1;
  $thang =date_create(''.$nam.'-1-1');
 $thang=date_timestamp_get($thang);
 $thang1 =date_create(''.$nam.'-2-1');
 $thang1=date_timestamp_get($thang1);
  $thang2 =date_create(''.$nam.'-3-1');
  $thang2=date_timestamp_get($thang2);
   $thang3 =date_create(''.$nam.'-4-1');
   $thang3=date_timestamp_get($thang3);
  $thang4 =date_create(''.$nam.'-5-1');
   $thang4=date_timestamp_get($thang4);
 $thang5 =date_create(''.$nam.'-6-1');
 $thang5=date_timestamp_get($thang5);
 $thang6 =date_create(''.$nam.'-7-1');
 $thang6=date_timestamp_get($thang6);
  $thang7 =date_create(''.$nam.'-8-1');
  $thang7=date_timestamp_get($thang7);
   $thang8 =date_create(''.$nam.'-9-1');
   $thang8=date_timestamp_get($thang8);
  $thang9 =date_create(''.$nam.'-10-1');
   $thang9=date_timestamp_get($thang9);
    $thang10 =date_create(''.$nam.'-11-1');
  $thang10=date_timestamp_get($thang10);
   $thang11 =date_create(''.$nam.'-12-1');
   $thang11=date_timestamp_get($thang11); 
     $thang12 =date_create(''.$nam.'-12-30');
   $thang12=date_timestamp_get($thang12);
 

$sql="SELECT *  FROM quiz.savsoft_result where uid=$uid  and start_time>$thang and start_time<$thang11 and result_status='Vượt qua'";

$sql1="SELECT *  FROM quiz.savsoft_result where uid=$uid and start_time>$thang and start_time<$thang11";
     $total_question_correct = $this->db->query($sql)->num_rows();
     
  $data['nam']['thang1']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang,$thang1);
       $data['nam']['thang1']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang,$thang1);
      $data['nam']['thang1']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang,$thang1);
        if($data['nam']['thang1']['quiz_done']==0){
 $data['nam']['thang1']['ty_le']=0;
      }else{
       $data['nam']['thang1']['ty_le']=  $data['nam']['thang1']['correct']/$data['nam']['thang1']['quiz_done']*100;
}

     $data['nam']['thang2']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang1,$thang2);
      $data['nam']['thang2']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang1,$thang2);
      $data['nam']['thang2']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang1,$thang2);
        if($data['nam']['thang2']['quiz_done']==0){
 $data['nam']['thang2']['ty_le']=0;
      }else{
       $data['nam']['thang2']['ty_le']=  $data['nam']['thang2']['correct']/$data['nam']['thang2']['quiz_done']*100;
}
     $data['nam']['thang3']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang2,$thang3);
      $data['nam']['thang3']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang2,$thang3);
      $data['nam']['thang3']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang2,$thang3);
        if($data['nam']['thang3']['quiz_done']==0){
 $data['nam']['thang3']['ty_le']=0;
      }else{
       $data['nam']['thang3']['ty_le']=  $data['nam']['thang3']['correct']/$data['nam']['thang3']['quiz_done']*100;
}

     $data['nam']['thang4']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang3,$thang4);
      $data['nam']['thang4']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang3,$thang4);
      $data['nam']['thang4']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang3,$thang4);
        if($data['nam']['thang4']['quiz_done']==0){
 $data['nam']['thang4']['ty_le']=0;
      }else{
       $data['nam']['thang4']['ty_le']=  $data['nam']['thang4']['correct']/$data['nam']['thang4']['quiz_done']*100;
}

        $data['nam']['thang5']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang4,$thang5);
      $data['nam']['thang5']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang4,$thang5);
      $data['nam']['thang5']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang4,$thang5);
         if($data['nam']['thang5']['quiz_done']==0){
 $data['nam']['thang5']['ty_le']=0;
      }else{
       $data['nam']['thang5']['ty_le']=  $data['nam']['thang5']['correct']/$data['nam']['thang5']['quiz_done']*100;
}

     $data['nam']['thang6']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang5,$thang6);
      $data['nam']['thang6']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang5,$thang6);
      $data['nam']['thang6']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang5,$thang6);
      if($data['nam']['thang6']['quiz_done']==0){
 $data['nam']['thang6']['ty_le']=0;
      }else{
       $data['nam']['thang6']['ty_le']=  $data['nam']['thang6']['correct']/$data['nam']['thang6']['quiz_done']*100;
}

     $data['nam']['thang7']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang6,$thang7);
      $data['nam']['thang7']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang6,$thang7);
      $data['nam']['thang7']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang6,$thang7);
      if($data['nam']['thang7']['quiz_done']==0){
 $data['nam']['thang7']['ty_le']=0;
      }else{
       $data['nam']['thang7']['ty_le']=  $data['nam']['thang7']['correct']/$data['nam']['thang7']['quiz_done']*100;
}

     $data['nam']['thang8']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang7,$thang8);
      $data['nam']['thang8']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang7,$thang8);
      $data['nam']['thang8']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang7,$thang8);
      if($data['nam']['thang8']['quiz_done']==0){
 $data['nam']['thang8']['ty_le']=0;
      }else{
       $data['nam']['thang8']['ty_le']=  $data['nam']['thang8']['correct']/$data['nam']['thang8']['quiz_done']*100;
}
        $data['nam']['thang9']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang8,$thang9);
      $data['nam']['thang9']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang8,$thang9);
      $data['nam']['thang9']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang8,$thang9);
       if($data['nam']['thang9']['quiz_done']==0){
 $data['nam']['thang9']['ty_le']=0;
      }else{
       $data['nam']['thang9']['ty_le']=  $data['nam']['thang9']['correct']/$data['nam']['thang9']['quiz_done']*100;
}

     $data['nam']['thang10']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang9,$thang10);
      $data['nam']['thang10']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang9,$thang10);
      $data['nam']['thang10']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang9,$thang10);
      if($data['nam']['thang10']['quiz_done']==0){
 $data['nam']['thang10']['ty_le']=0;
      }else{
       $data['nam']['thang10']['ty_le']=  $data['nam']['thang10']['correct']/$data['nam']['thang10']['quiz_done']*100;
}

     $data['nam']['thang11']['correct']=$this->sadmin_model->count_quiz_correct($uid,$thang10,$thang11);
      $data['nam']['thang11']['quiz_done']=$this->sadmin_model->count_quiz_done($uid,$thang10,$thang11);
      $data['nam']['thang11']['total_quiz']=$this->sadmin_model->count_total_quiz($uid,$thang10,$thang11);
      if($data['nam']['thang11']['quiz_done']==0){
 $data['nam']['thang11']['ty_le']=0;
      }else{
       $data['nam']['thang11']['ty_le']=  $data['nam']['thang11']['correct']/$data['nam']['thang11']['quiz_done']*100;
}
$data['nam']['thang12']['correct'] = $this->sadmin_model->count_quiz_correct($uid, $thang11, $thang12);
$data['nam']['thang12']['quiz_done'] = $this->sadmin_model->count_quiz_done($uid, $thang11, $thang12);
$data['nam']['thang12']['total_quiz'] = $this->sadmin_model->count_total_quiz($uid, $thang11, $thang12);
if ($data['nam']['thang12']['quiz_done'] == 0) {
    $data['nam']['thang12']['ty_le'] = 0;
} else {
    $data['nam']['thang12']['ty_le'] = $data['nam']['thang12']['correct'] / $data['nam']['thang12']['quiz_done'] * 100;
}





  }




   
     $total_question = $this->db->query($sql1)->num_rows();
        $data['q_corr']=$total_question_correct;
        $data['question']=$total_question;
        $data['q_wrong']=$total_question-$total_question_correct;
        
         $this->load->view('stemup/chart',$data);
    }
}
