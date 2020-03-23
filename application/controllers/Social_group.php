<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_group extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->helper('date');   
	   	$this->load->helper('url');
	   	$this->load->model("user_model");
	   	$this->load->model("qbank_model");
		$this->load->model("account_model");
	   	$this->load->model("result_model");
	   	$this->load->model("api_model");
	   	$this->load->model("quiz_model");
	    $this->load->model("classes_model");
		$this->load->model("post_model");
		$this->load->model('notify_model');
		$this->load->model("data_model");
		$this->load->model("review_model");
		$this->load->model("comment_model");
		$this->load->model("profile_model");
		$this->load->model('social_model');
		$this->load->model('event_racing_model');
    }

    public function index($limit = '0')
    {

        // redirect if not loggedin
        if (!$this->session->userdata('logged_in')) {
            redirect('home');

        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('home');
        }


        $logged_in = $this->session->userdata('logged_in');
        $acp = explode(',', $logged_in['social_group']);
        if (!in_array('Join', $acp)) {
            exit($this->lang->line('permission_denied'));
        }


        $data['limit'] = $limit;
        $data['title'] = $this->lang->line('social_group');

        $data['result'] = $this->social_model->social_group_list($limit);
        $data['joined'] = $this->social_model->joined($logged_in['uid']);
        $this->load->view('header', $data);
        $this->load->view('social_group', $data);
        $this->load->view('footer', $data);
        redirect('home_user');
    }


    function reject_invitation($invitation_id)
    {
        $this->db->where('invitation_id', $invitation_id);
        $this->db->update('group_invitation', array('invitation_status' => 'Rejected'));
        $this->session->set_flashdata('message_header', "<div class='alert alert-danger'>" . $this->lang->line('invitation_rejected') . " </div>");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function accept_invitation($invitation_id, $sg_id, $uid)
    {
        $this->db->where('invitation_id', $invitation_id);
        $this->db->update('group_invitation', array('invitation_status' => 'Accepted'));
        $this->Social_model->join($sg_id, $uid);
        $this->session->set_flashdata('message_header', "<div class='alert alert-success'>" . $this->lang->line('invitation_accepted') . " </div>");
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function add_new()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('home');
        }
        $logged_in = $this->session->userdata('logged_in');
        $data=$this->social_model->add_group();
        
        echo json_encode($data);
        header('Content-Type: application/json');
    }

    function delete_group($id){
        $this->social_model->delete_group($id);
		redirect($_SERVER['HTTP_REFERER']);
    }
    function out_group($sg_id,$uid){
        $this->social_model->out_group($sg_id,$uid);
        redirect($_SERVER['HTTP_REFERER']);
    }
    function add_group_member($sg_id,$uid){
        $this->social_model->add_user($sg_id,$uid);
    }
    function delete_users_group($sg_id,$uid){
        $this->social_model->out_group($sg_id,$uid);
        redirect($_SERVER['HTTP_REFERER']);
    }
/*    function get_data_add_user(){
        $user= $this->session->userdata('logged_in');
        if($user){
            $inp = json_decode($this->input->raw_input_stream,true);
            $inp['user'] = $this->social_model->add_user($inp['email'],$inp['sg_id']);
            header('Content-Type: application/json');
			echo json_encode($inp);
        }
    }*/
    function add_user($sg_id)
    {
        $logged_in = $this->session->userdata('logged_in');
        $emails = explode(',', $this->input->post('email'));
        $acp = explode(',', $logged_in['social_group']);
        if (!in_array('Add_other', $acp)) {
            exit($this->lang->line('permission_denied'));
        }
        foreach ($emails as $k => $val) {
            $query = $this->db->query("select * from savsoft_users where email='$val'");
            if ($query->num_rows() == 1) {
                $user = $query->row_array();
                $this->Social_model->join($sg_id, $user['uid']);
            }
        }

        $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('group_addeduser') . " </div>");
        redirect('social_group/view/' . $sg_id);
    }


    function invite($sg_id)
    {
        $logged_in = $this->session->userdata('logged_in');
        $emails = explode(',', $this->input->post('email'));
        $acp = explode(',', $logged_in['social_group']);
        if (!in_array('Invite', $acp)) {
            exit($this->lang->line('permission_denied'));
        }
        foreach ($emails as $k => $val) {
            $query = $this->db->query("select * from savsoft_users where email='$val'");
            if ($query->num_rows() == 1) {
                $user = $query->row_array();
                $userdata = array(
                    'sg_id' => $sg_id,
                    'uid' => $user['uid'],
                    'invited_by' => $logged_in['uid'],
                    'custom_message' => $this->input->post('custom_message')
                );
                $this->db->insert('group_invitation', $userdata);

            }
        }

        $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('invitation_sent') . " </div>");
        redirect('social_group/view/' . $sg_id);
    }


    public function view($sg_id, $ac = '0', $limit = '0')
    {

        // redirect if not loggedin
        if (!$this->session->userdata('logged_in')) {
            redirect('home');

        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('home');
        }


        $logged_in = $this->session->userdata('logged_in');
        $acp = explode(',', $logged_in['social_group']);
        if (!in_array('Join', $acp)) {
            exit($this->lang->line('permission_denied'));
        }


        $data['group'] = $this->social_model->get_group($sg_id);
        $data['joined'] = $this->social_model->joined($logged_in['uid']);
        $data['members'] = $this->social_model->group_member($sg_id);
        $data['feed'] = $this->social_model->feed($sg_id, $limit);
        $data['sg_id'] = $sg_id;

        $data['title'] = $data['group']['sg_name'];
        $data['limit'] = $limit;
        $data['ac'] = $ac;
        $this->load->view('header', $data);
        $this->load->view('view_social_group', $data);
        $this->load->view('footer', $data);
    }


    function join($sg_id)
    {
        $logged_in = $this->session->userdata('logged_in');
        $acp = explode(',', $logged_in['social_group']);
        if (!in_array('Join', $acp)) {
            exit($this->lang->line('permission_denied'));
        }
        $uid = $logged_in['uid'];
        $this->Social_model->join($sg_id, $uid);
        $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('group_joined') . " </div>");
        redirect('social_group');

    }


    function remove_user($sg_id, $uid)
    {
        $logged_in = $this->session->userdata('logged_in');
        $uid = $uid;
        $per = 0;
        $data['group'] = $this->social_model->get_group($sg_id);
        $acp = explode(',', $logged_in['social_group']);
        if (in_array('Remove_all', $acp)) {
            $per = 1;
        } else if (in_array('Remove', $acp)) {
            if ($data['group']['created_by'] != $logged_in['uid']) {
                $per = 1;
            }
        }

        if ($data['group']['created_by'] == $uid) {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->lang->line('group_owner_unjoin_error') . " </div>");
            redirect('social_group/view/' . $sg_id);
        }

        $this->Social_model->unjoin($sg_id, $uid);
        $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('group_unjoined') . " </div>");
        redirect('social_group/view/' . $sg_id);

    }


    function remove_group($sg_id)
    {
        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];
        $acp = explode(',', $logged_in['social_group']);
        if (in_array('Remove_all', $acp)) {

            $this->Social_model->remove_social_group($sg_id);
            $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('group_removed') . " </div>");
            redirect('social_group');

        } else {
            if (!in_array('Remove', $acp)) {
                exit($this->lang->line('permission_denied'));
            } else {
                $data['group'] = $this->social_model->get_group($sg_id);
                if ($data['group']['created_by'] != $uid) {
                    exit($this->lang->line('permission_denied'));
                } else {
                    // remove
                    $this->Social_model->remove_social_group($sg_id);
                    $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('group_removed') . " </div>");
                    redirect('social_group');
                }
            }
        }
        $uid = $logged_in['uid'];
        $this->Social_model->join($sg_id, $uid);
        $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('group_joined') . " </div>");
        redirect('social_group');

    }
    function edit(){
        $inp = json_decode($this->input->raw_input_stream,true);
        $group = array(
            'sg_name' => $inp['social_name'],
            'about' => $inp['description'],
            'sg_status' => $inp['status'],
            'lid' => $inp['grade2'],
            'cid' => $inp['categ_group'],
        );
        $this->db->where('sg_id',$inp['sg_id']);
        $this->db->update('social_group',$group);
        header('Content-Type: application/json');
    	echo json_encode($inp);
       
    }
    function edit_groupp($gid){
		$user = $this->session->userdata('logged_in');
        $data['sg'] = $this->social_model->get_group($gid);
        $data['admin'] = $user['uid'];
        $data['su'] = $user['su'];
        $data['admin_name'] = $user['last_name'].' '. $user['first_name']; 
        $data['admin_email'] = $user['email'];
        $data['admin_contact_no'] = $user['contact_no'];
		$data['create'] = $this->social_model->get_group($gid)['created_by'];
        $data['post_tag']=$this->post_model->post_list($type_tag='post_tag');
        $data['level_list']=$this->qbank_model->level_list();
        $data['stcategories']=$this->qbank_model->get_statistic_category();
        $data['category_list']=$this->qbank_model->category_list();
		$data['quiz_fun_rb']=$this->quiz_model->get_quiz_right_bar(7);
		if($user['su']==1 || $user['uid']==$data['create']){
            $data['string_lid']='';
            $data['lid'] = $this->social_model->get_group($gid)['lid'];
            if(strlen($data['lid'])!=0){
                $data['level'] = explode(',', $data['lid']);
                if(sizeof($data['level'])==1){
                    $data['level2'] = current(array_values($data['level'])) -2;
                }
                $data['last_string_level'] = end(array_values($data['level'])) -2 ;
                $data['first_string_level'] = current(array_values($data['level'])) -2 ;
                $data['range_lid'] =$data['first_string_level'].' - '. $data['last_string_level'];
                $data['name_lid'] = $this->social_model->get_name_lid($data['lid']);
                for($i=0;$i<sizeof($data['name_lid']);$i++){
                    $data['string_lid'] .= $data['name_lid'][$i]['level_name'].',';
                }
                $data['string_lid']=substr( $data['string_lid'], 0, -1);
            }

            $data['users']=$this->social_model->user_in_group($gid,'',0)['all'];
            $data['num']= $this->social_model->num_user_in_group($gid,'');
            $data['num_page']=ceil($data['num']/10);
            $data['gid'] = $gid;
			$data['user_name']= $user['last_name'].' '.$user['first_name'];
			$data['user_point']=$this->user_model->get_user_points($user['uid']);
			$data['email']=$user['email'];
			$data['phone']=$user['contact_no'];
			$data['uid']=$user['uid'];
			$data['user_code']=$user['user_code'];
			$data['birthdate']=$user['birthdate'];
			$data['link_photo']=$user['photo'];
            $data['su']=$user['su'];
			$this->load->view('after_login/edit_group',$data);
        	$this->load->view('home/footer',$data);
		}
    }
    function get_data_edit_group(){
        $inp = json_decode($this->input->raw_input_stream,true);
        $inp['users']=$this->social_model->user_in_group($inp['gid'],$inp['search'],$inp['page'])['all'];
        $inp['num']= $this->social_model->num_user_in_group($inp['gid'],$inp['search']);
        $inp['num_page']=ceil($inp['num']/10);
        header('Content-Type: application/json');
		echo json_encode($inp);
    }

    function load_group($gid){
        $data['user'] = $this->session->userdata('logged_in');
        $data['info'] = $this->social_model->load_group($gid);
        $data['member']=$this->social_model->user_in_group($gid,'',0)['all'];
        $data['num']= $this->social_model->num_user_in_group($gid,'');
        header('Content-Type: application/json');
		echo json_encode($data);
    }

/*    function edit_group($sg_id)
    {
        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];
        $acp = explode(',', $logged_in['social_group']);
        if (in_array('Edit_all', $acp)) {


        } else {
            if (!in_array('Edit', $acp)) {
                exit($this->lang->line('permission_denied'));
            } else {
                $data['group'] = $this->social_model->get_group($sg_id);
                if ($data['group']['created_by'] != $uid) {
                    exit($this->lang->line('permission_denied'));
                }
            }
        }

        if ($this->input->post('sg_name')) {
            $this->Social_model->edit_group($sg_id);
            $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('group_updated') . " </div>");
            redirect('social_group');
        }

        $uid = $logged_in['uid'];
        $data['sg_id'] = $sg_id;
        $data['group'] = $this->social_model->get_group($sg_id);
        $data['title'] = $this->lang->line('edit') . " " . $this->lang->line('social_group');

        $this->load->view('header', $data);
        $this->load->view('edit_social_group', $data);
        $this->load->view('footer', $data);

    }*/
    function write_post($sg_id, $parent_id=0){
        $this->social_model->write_post($sg_id, $parent_id);
    }
    function load_discussion($sg_id, $pivot, $max_post=5){
        $data=$this->social_model->load_discussion($sg_id, $pivot, $max_post);
		header('Content-Type: application/json');
		echo json_encode($data);
    }
    function load_reply($parent_id, $pivot, $max_post=5){
		$data=$this->social_model->load_reply($parent_id, $pivot, $max_post);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
    function unjoin($sg_id)
    {

        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];
        $acp = explode(',', $logged_in['social_group']);
        if (!in_array('Join', $acp)) {
            exit($this->lang->line('permission_denied'));
        }
        $data['group'] = $this->social_model->get_group($sg_id);
        if ($data['group']['created_by'] == $uid) {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->lang->line('group_owner_unjoin_error') . " </div>");
            redirect('social_group');
        }
        $uid = $logged_in['uid'];
        $this->Social_model->unjoin($sg_id, $uid);
        $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('group_unjoined') . " </div>");
        redirect('social_group');

    }

    function manage_group(){
        $data['data'] = $this->api_model->socialgroup_list();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    function get_mem($group_id){
        $data['data'] = $this->social_model->get_mem($group_id);
        header('Content-Type: application/json');

        echo json_encode($data);
    }
    function get_mem_rm($group_id){
        $data['data'] = $this->social_model->get_mem_rm($group_id);
        header('Content-Type: application/json');
        
        echo json_encode($data);
     }

    function remove_mem($group_id_rm, $mem_id){
        $this->social_model->remove_mem($group_id_rm, $mem_id);
     }
     function add_mem($group_id, $mem_id){
        $this->social_model->add_mem($group_id, $mem_id);
     }
     function get_member($sg_id,$search=""){
        $data = $this->social_model->get_member($sg_id,$search);
        header('Content-Type: application/json');
        echo json_encode($data);
     }

}
