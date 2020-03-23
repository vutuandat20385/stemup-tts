<?php
class Comment_manage extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library("pagination");
        $this->load->model("qbank_model");
        $this->load->model("quiz_model");
        $this->load->model("notify_model");
        $this->load->model("user_model");
        $this->load->model("post_model");
        $this->load->model("comment_manage_model");
    }
   public function index(){
       $data = array();

       $status_url = ($this->uri->segment(3)) ? ($this->uri->segment(3) ) : 100;

       switch ($status_url){
           case 'duoc-hien-thi':
               $status = '2';
               break;
           case 'khong-duoc-hien-thi':
               $status = '1';
               break;
           case 'cho-duyet':
               $status = '99';
               break;
           default:
               $status = '100';
               break;
       }

       $data['status'] = $status;

       $data['page'] = ($this->uri->segment(4)) ? ($this->uri->segment(4) ) : 1;
       $limit = 10;
       $start = ($data['page']-1)*$limit;

       if($status =='100'){
           $data['arr_result'] =  $this->comment_manage_model->getAllComment_limit($start,$limit);
           $total_rows = count($this->comment_manage_model->getAllComment());
       }else{
           $data['arr_result'] =  $this->comment_manage_model->getAllComment_byStatus_limit($status,$start,$limit);
           $total_rows = count($this->comment_manage_model->getAllComment_byStatus($status));
       }

       $config['base_url'] = base_url('index.php/comment_manage/index/').'/'.$status_url;
       $config['total_rows'] = $total_rows;
       $config['per_page'] =  10;
       $config['uri_segment'] = 4;

       $config['num_links'] = 2;
       $config['use_page_numbers'] = TRUE;
       $config['reuse_query_string'] = TRUE;

       $config['full_tag_open'] = '<div class="pagination">';
       $config['full_tag_close'] = '</div>';

       $config['first_link'] = '<<';
       $config['first_tag_open'] = '<span class="firstlink link">';
       $config['first_tag_close'] = '</span>';

       $config['last_link'] = '>>';
       $config['last_tag_open'] = '<span class="lastlink link">';
       $config['last_tag_close'] = '</span>';

       $config['next_link'] = '>';
       $config['next_tag_open'] = '<span class="nextlink link">';
       $config['next_tag_close'] = '</span>';

       $config['prev_link'] = '<';
       $config['prev_tag_open'] = '<span class="prevlink link">';
       $config['prev_tag_close'] = '</span>';

       $config['cur_tag_open'] = '<span class="curlink link">';
       $config['cur_tag_close'] = '</span>';

       $config['num_tag_open'] = '<span class="numlink link">';
       $config['num_tag_close'] = '</span>';

       $this->pagination->initialize($config);



        $data['pagination'] = $this->pagination->create_links();

        $user=$this->session->userdata('logged_in');
		if(!$user){
			redirect("home");
		}
		else {
            $data['user_name'] = $user['last_name'] . ' ' . $user['first_name'];
            $data['user_point'] = $this->user_model->get_user_points($user['uid']);
            $data['email'] = $user['email'];
            $data['phone'] = $user['contact_no'];
            $data['uid'] = $user['uid'];
            $data['birthdate'] = $user['birthdate'];
            $data['link_photo'] = $user['photo'];
            $data['stcategories'] = $this->qbank_model->get_statistic_category();
            $data['post_tag'] = $this->post_model->post_list($type_tag = 'post_tag');
            $data['category_list'] = $this->qbank_model->category_list();

        }
        $this->load->view('web_head',$data);
        $this->load->view('comment_manage/layout',$data);
       $this->load->view("home/footer", $data);
   }

   public function delete(){
       $id = $this->uri->segment(3);
       $this->comment_manage_model->delete($id);
       header('Location:'.base_url('index.php/comment_manage/index/'));
   }
    public function display(){
        $id = $this->uri->segment(3);
        $this->comment_manage_model->display($id);
        header('Location:'.base_url('index.php/comment_manage/index/'));
    }
    public function delete_all($arr_id){

    }
    public function display_all($arr_id){

    }

    public function search(){
        $string =  $this->input->post('string');

        $data['arr_result']  = $this->comment_manage_model->search($string);
//        $total_rows = count($this->comment_manage_model->search($string));
//        $data['table'] = $this->draw_table($result,100,$total_rows,10000);

        $this->load->view('comment_manage/search',$data);
    }

}
?>
