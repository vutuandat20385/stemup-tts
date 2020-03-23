<?php
class Kynangsong extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->lang->load('basic', $this->config->item('language'));

        $this->load->model('kns_model');
        $this->load->model("user_model");
        $this->load->library('pagination');
    }
    public function index(){
            $user= $this->session->userdata('logged_in');

            $data['user_name']= $user['last_name'].' '.$user['first_name'];
            $data['user_point']=$this->user_model->get_user_points($user['uid']);
            $data['email']=$user['email'];
            $data['phone']=$user['contact_no'];
            $data['uid']=$user['uid'];
            $data['user_code']=$user['user_code'];
            $data['birthdate']=$user['birthdate'];
            $data['link_photo']=$user['photo'];
            $data['su']=$user['su'];


            $data['level_list'] = $this->kns_model->lev_list();
//          $data['quiz_list'] = $this->kns_model->get_quiz_list();
            
            //Phan trang
            $limit_per_page = 20;
            $page= ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) : 0;
            $total_records = count($this->kns_model->get_quiz_list(8));
            
            $conf['base_url'] = base_url('index.php/kynangsong/index/');
            $conf['total_rows'] = $total_records;
            $conf['per_page'] =  $limit_per_page;
            $conf["uri_segment"] = 3;
            
            // custom paging configuration
            $conf['num_links'] = 2;
            $conf['use_page_numbers'] = TRUE;
            $conf['reuse_query_string'] = TRUE;
            
            $conf['full_tag_open'] = '<div class="pagination">';
            $conf['full_tag_close'] = '</div>';
            
            $conf['first_link'] = 'Trang đầu';
            $conf['first_tag_open'] = '<span class="firstlink">';
            $conf['first_tag_close'] = '</span>';
            
            $conf['last_link'] = 'Trang cuối';
            $conf['last_tag_open'] = '<span class="lastlink">';
            $conf['last_tag_close'] = '</span>';
            
            $conf['next_link'] = 'Tiếp';
            $conf['next_tag_open'] = '<span class="nextlink">';
            $conf['next_tag_close'] = '</span>';
            
            $conf['prev_link'] = 'Trước';
            $conf['prev_tag_open'] = '<span class="prevlink">';
            $conf['prev_tag_close'] = '</span>';
            
            $conf['cur_tag_open'] = '<span class="curlink">';
            $conf['cur_tag_close'] = '</span>';
            
            $conf['num_tag_open'] = '<span class="numlink">';
            $conf['num_tag_close'] = '</span>';
            
            
            $this->pagination->initialize($conf);
            
            $data['pagnation_link'] = $this->pagination->create_links();
            
            $data['quiz_list']=$this->kns_model->get_quiz_list_($limit_per_page, $page*$limit_per_page,8);

        // $this->load->view('web_head',$data);
            $this->load->view('kns/head');
        
        
        $this->load->view('kns/kynangsong',$data);
        $this->load->view('home/modal_kns', $data);
        // $this->load->view("home/footer", $data);
    }

    function show_quiz_list($lid){
        $lid=$this->input->post('lid');

        //Phan trang
            $limit_per_page = 20;
            $page= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $total_records = count($this->kns_model->get_quiz_list($lid));
            
            $conf['base_url'] = base_url('index.php/kynangsong/show_quiz_list/');
            $conf['total_rows'] = $total_records;
            $conf['per_page'] =  $limit_per_page;
            $conf['uri_segment'] = 3;
            
            // custom paging configuration
            $conf['num_links'] = 2;
            $conf['use_page_numbers'] = TRUE;
            $conf['reuse_query_string'] = TRUE;
            
            $conf['full_tag_open'] = '<div class="pagination">';
            $conf['full_tag_close'] = '</div>';
            
            $conf['first_link'] = 'Trang đầu';
            $conf['first_tag_open'] = '<span class="firstlink">';
            $conf['first_tag_close'] = '</span>';
            
            $conf['last_link'] = 'Trang cuối';
            $conf['last_tag_open'] = '<span class="lastlink">';
            $conf['last_tag_close'] = '</span>';
            
            $conf['next_link'] = 'Tiếp';
            $conf['next_tag_open'] = '<span class="nextlink">';
            $conf['next_tag_close'] = '</span>';
            
            $conf['prev_link'] = 'Trước';
            $conf['prev_tag_open'] = '<span class="prevlink">';
            $conf['prev_tag_close'] = '</span>';
            
            $conf['cur_tag_open'] = '<span class="curlink">';
            $conf['cur_tag_close'] = '</span>';
            
            $conf['num_tag_open'] = '<span class="numlink">';
            $conf['num_tag_close'] = '</span>';
            
            
            $this->pagination->initialize($conf);
            
            $data['pagnation_link'] = $this->pagination->create_links();
            
            $data['quiz_list']=$this->kns_model->get_quiz_list_($limit_per_page, $page*$limit_per_page,$lid);
        $this->load->view('home/modal_kns', $data);    
        $this->load->view('kns/show_quiz_list',$data);
    }   
}