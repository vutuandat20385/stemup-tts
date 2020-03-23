<?php
class Recomendation extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('pagination');
        $this->load->model("library_model");
        $this->load->model("user_model");
        $this->load->model("quiz_model");
        $this->load->model("qbank_model");
        $this->load->model("post_model");
        $this->lang->load('basic', $this->config->item('language'));
        $this->load->model('recomendation_model');
    }

    public function list_activity($id){
        $user=$this->session->userdata('logged_in');

        $user_by_id = $this->recomendation_model->get_username($id);
        $data['username'] = $user_by_id[0]['first_name'].' '.$user_by_id[0]['last_name'];

            switch ($this->uri->segment(4)){
                case 'question':{
                    $data['activity'] = $this->recomendation_model->get_question($id);
                    $data['action'] = 'trả lời';

                    $catagory_by_id = $this->recomendation_model->group_question_by_cid($id);
                    $data['catagory_by_id'] = $catagory_by_id;

                    $data['data_']=array();
                    foreach ($catagory_by_id as $value){
                        array_push($data['data_'],$this->recomendation_model->get_question_cid($id,$value['cid']));
                    }

                }
                    break;
                case 'like':{
                    $data['activity'] = $this->recomendation_model->get_like_by_user($id);
                    $data['action'] = 'like';

                    $catagory_by_id = $this->recomendation_model->group_like_by_cid($id);
                    $data['catagory_by_id'] = $catagory_by_id;

                    $data['data_']=array();
                    foreach ($catagory_by_id as $value){
                        array_push($data['data_'],$this->recomendation_model->get_like_cid($id,$value['cid']));
                    }

                }
                    break;
                case 'comment':{
                    $data['activity'] = $this->recomendation_model->get_comment_by_user($id);
                    $data['action'] = 'comment';

                    $catagory_by_id = $this->recomendation_model->group_comment_by_cid($id);
                    $data['catagory_by_id'] = $catagory_by_id;

                    $data['data_']=array();
                        foreach ($catagory_by_id as $value){
                            array_push($data['data_'],$this->recomendation_model->get_comment_cid($id,$value['cid']));
                        }
                 }
                    break;
            }

        $data['category_list']=$this->qbank_model->category_list();
        $data['stcategories']=$this->qbank_model->get_statistic_category();
        $data['link_photo']=$user['photo'];
        $data['user_name']= $user['last_name'].' '.$user['first_name'];
        $data['user_point']=$this->user_model->get_user_points($user['uid']);
        $data['email']=$user['email'];
        $data['phone']=$user['contact_no'];
        $data['uid']=$user['uid'];
        $data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
        $data['level_list']=$this->qbank_model->level_list();

        $this->load->view('recomendation/list_activity',$data);
        $this->load->view('home/footer',$data);

    }
    public function list_activity_class($id){
        $user=$this->session->userdata('logged_in');

        $user_by_id = $this->recomendation_model->get_username($id);
        $data['username'] = $user_by_id[0]['first_name'].' '.$user_by_id[0]['last_name'];

        switch ($this->uri->segment(4)){
            case 'question':{
                $data['activity'] = $this->recomendation_model->get_question($id);
                $data['action'] = 'trả lời';

                $catagory_by_id = $this->recomendation_model->group_question_by_lid($id);
                $data['catagory_by_id'] = $catagory_by_id;

                $data['data_']=array();
                foreach ($catagory_by_id as $value){

                    array_push($data['data_'],$this->recomendation_model->get_question_by_lid($id,$value['lid']));
                }

            }
                break;
            case 'like':{
                $data['activity'] = $this->recomendation_model->get_like_by_user($id);
                $data['action'] = 'like';

                $catagory_by_id = $this->recomendation_model->group_like_by_lid($id);
                $data['catagory_by_id'] = $catagory_by_id;

                $data['data_']=array();
                foreach ($catagory_by_id as $value){
                    array_push($data['data_'],$this->recomendation_model->get_like_by_lid($id,$value['lid']));
                }

            }
                break;
            case 'comment':{
                $data['activity'] = $this->recomendation_model->get_comment_by_user($id);
                $data['action'] = 'comment';

                $catagory_by_id = $this->recomendation_model->group_comment_by_lid($id);
                $data['catagory_by_id'] = $catagory_by_id;

                $data['data_']=array();
                foreach ($catagory_by_id as $value){
                    array_push($data['data_'],$this->recomendation_model->get_comment_by_lid($id,$value['lid']));
                }
            }
                break;
        }

        $data['category_list']=$this->qbank_model->category_list();
        $data['stcategories']=$this->qbank_model->get_statistic_category();
        $data['link_photo']=$user['photo'];
        $data['user_name']= $user['last_name'].' '.$user['first_name'];
        $data['user_point']=$this->user_model->get_user_points($user['uid']);
        $data['email']=$user['email'];
        $data['phone']=$user['contact_no'];
        $data['uid']=$user['uid'];
        $data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
        $data['level_list']=$this->qbank_model->level_list();

        $this->load->view('recomendation/list_activity_class',$data);
        $this->load->view('home/footer',$data);

    }

}