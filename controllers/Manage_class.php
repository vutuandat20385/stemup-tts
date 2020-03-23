<?php
class Manage_class extends CI_Controller{

    public function __construct(){
            parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model("library_model");
        $this->load->model("user_model");
        $this->load->model("quiz_model");
        $this->load->model("qbank_model");
        $this->load->model("post_model");
        $this->load->model("manage_class_model");
        $this->lang->load('basic', $this->config->item('language'));
     }

     public function wall_class()
     {
         $id = $this->uri->segment(3);

         $user = $this->session->userdata('logged_in');
         if (!$user) {
             redirect("home");
         } else {
             $data['user_name'] = $user['last_name'] . ' ' . $user['first_name'];
             $data['user_point'] = $this->user_model->get_user_points($user['uid']);
             $data['email'] = $user['email'];
             $data['phone'] = $user['contact_no'];
             $data['uid'] = $user['uid'];
             $data['user_code'] = $user['user_code'];
             $data['birthdate'] = $user['birthdate'];
             $data['link_photo'] = $user['photo'];
             $data['stcategories'] = $this->qbank_model->get_statistic_category();
             $data['post_tag'] = $this->post_model->post_list($type_tag = 'post_tag');
             $data['category_list'] = $this->qbank_model->category_list();

             $data['form_add_discussion'] = array(
                    'name'          => 'content-discussion',
                    'id'            => 'content-discussion',
                    'placeholder'   => 'Nội dung bài thảo luận',
                    'style'         => 'width:100%',
             );
             $getClass = $this->manage_class_model->getClass($id);
//             echo '<pre>';
//             print_r($getClass);
//             echo '</pre>';
             $data['class_name']=$getClass[0]['dataitem_name'];
             $data['class_description']=$getClass[0]['description'];
             $allDiscussion = $this->manage_class_model->getAllDiscussion($id);

        $data['discussion_array'] = array();
        foreach ($allDiscussion as $value){
            array_push($data['discussion_array'],array(
                'wall_id'   =>      $id,
                'id'        =>      $value['post_id'],
                'photo'     =>      $value['photo'],
                'user'      =>      $value['create_name'],
                'time'      =>      $value['create_date'],
                'content'   =>      $value['content'],
                'comment'   =>      $this->manage_class_model->getComment($value['post_id'],$id)
            ));

        }
            $data['wall'] = $id;
             $this->load->view("web_head");
             $this->load->view("manage_class/wall_class", $data);
             $this->load->view("home/footer", $data);
         }
     }
     function addcomment(){
         $user = $this->session->userdata('logged_in');
         if (!$user) {
             redirect("home");
         } else {
             $value = isset($_POST['value']) ? $_POST['value'] : false;
             $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : false;
             $wall_id = isset($_POST['wall_id']) ? $_POST['wall_id'] : false;
             $data = array();
             if ($value) {
                 $data['uid'] = $user['uid'];
                 $data['value'] = $value;
                 $data['user_name'] = $user['last_name'] . ' ' . $user['first_name'];
                 $data['link_photo'] = $user['photo'];

             }
             $dt = new DateTime();
             $obj = array(
                 'content'       =>  $value,
                 'wall_id'       =>  $wall_id,
                 'create_by'     =>  $user['uid'],
                 'create_date'   =>  $dt->format('Y-m-d H:i:s'),
                 'modify_date'   =>  $dt->format('Y-m-d H:i:s'),
                 'deleted'       =>  '99'
             );
             $this->manage_class_model->addComment($obj,'class',$post_id);

             $this->load->view('manage_class/addcomment', $data);
         }
     }

     function addDiscussion(){

         $user = $this->session->userdata('logged_in');

         if (!$user) {
             redirect("home");
         } else {

             $value = isset($_POST['value']) ? $_POST['value'] : false;
             $wall_id = isset($_POST['wall']) ? $_POST['wall'] : false;

             $data = array();
             if ($value) {
                 $data['value'] = $value;
                 $data['user_name'] = $user['last_name'] . ' ' . $user['first_name'];
                 $data['link_photo'] = $user['photo'];

             }
             $dt = new DateTime();
             $obj = array(
                 'content' => $value,
                 'wall_id' => $wall_id,
                 'create_by' => $user['uid'],
                 'create_date' => $dt->format('Y-m-d H:i:s'),
                 'modify_date' => $dt->format('Y-m-d H:i:s'),
                 'deleted' => '99'
             );
             $this->manage_class_model->addComment($obj, 'class', '0');
             $this->load->view('manage_class/addDiscussion',$data);
         }
     }
}