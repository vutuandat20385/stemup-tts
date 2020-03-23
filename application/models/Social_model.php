<?php

Class Social_model extends CI_Model
{

    function social_group_list($limit)
    {

        $this->db->limit($this->config->item('number_of_rows'), $limit);
        if ($this->input->post('search')) {
            $this->db->like('sg_name', $this->input->post('search'));
        }
        $this->db->order_by('sg_id', 'desc');
        $query = $this->db->get('social_group');
        return $query->result_array();


    }

    function feed($sg_id, $limit)
    {

        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $this->db->where('sg_id', $sg_id);
        $this->db->order_by('feed_id', 'desc');
        $query = $this->db->get('news_feed');
        return $query->result_array();


    }

    function group_member($sg_id)
    {

        $this->db->where('sg_id', $sg_id);
        $this->db->join('savsoft_users', 'savsoft_users.uid=social_group_joined.uid');
        $query = $this->db->get('social_group_joined');
        return $query->result_array();
    }


    function add_group()
    {
        $logged_in = $this->session->userdata('logged_in');
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $charactersLength = strlen($characters);
         $check=true;
         while($check){
             $sg_code = '';
             for ($i = 0; $i < 6; $i++) {
                 $sg_code.= $characters[rand(0, $charactersLength - 1)];
             }
            $this->db->where('sg_code', $sg_code);
            $n = $this->db->get('social_group')->num_rows();
            if($n==0)
            $check=false;
         }
        $uid = $logged_in['uid'];
        $group_info = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
        $userdata1 = array(
            'sg_code' => $sg_code,
            'sg_name' => $group_info['sg_name'],
            'about' => $group_info['sg_des'],
            'lid' =>$group_info['grade'],
            'cid' =>$group_info['categ'],
            'created_by' => $uid);
            $this->db->where('created_by',$logged_in['uid']);
            $this->db->where('sg_name',$group_info['sg_name']);
            $query = $this->db->get('social_group');
            if($query->num_rows() == 0){
            $this->db->insert('social_group', $userdata1);
                $userdata1['status'] = '1';
                $sg_id = $this->db->insert_id();
                $userdata = array(
                    'sg_id' => $sg_id,
                    'uid' => $uid);
            $this->db->insert('social_group_joined', $userdata);
            $this->db->query(" update social_group set no_member=(no_member + 1) where sg_id='$sg_id' ");
            $new_gr_ids = '';
            $this->db->where('uid', $logged_in['uid']);
            $gr_str=$this->db->get('savsoft_users')->result_array()[0]['group_id'];
                if($gr_str!=''){
                    $new_gr_ids.=$gr_str.','.$sg_id;
                }
                else{
                    $new_gr_ids.=$sg_id;
                }
            $this->db->where('uid', $logged_in['uid']);
            $this->db->update('savsoft_users', array('group_id'=> $new_gr_ids));

            }else{
                $userdata1['status'] = '0';
            }
        
        return $userdata1;

    }

    function edit_group($sg_id)
    {
        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];
        $userdata = array(
            'sg_name' => $this->input->post('sg_name'),
            'about' => $this->input->post('about')
        );
        $this->db->where('sg_id', $sg_id);
        $this->db->update('social_group', $userdata);
    }
    function get_name_lid($lid){
        $logged_in = $this->session->userdata('logged_in');
        $sql = "Select level_name from savsoft_level where lid in ($lid) ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_group($sg_id)
    {
        $this->db->where('sg_id', $sg_id);
        $query = $this->db->get('social_group');
        return $query->row_array();
    }
    function num_user_in_group($sg_id,$search=''){

        $this->db->join('savsoft_users','savsoft_users.uid=social_group_joined.uid');
        $this->db->where('savsoft_users.user_status','Active');
        $this->db->where("social_group_joined.sg_id=$sg_id");
        if($search!=''){
            $this->db->like('savsoft_users.email',$search);
        }
        $query = $this->db->get('social_group_joined');
        return $query->num_rows();
    }
    function user_in_group($sg_id,$search='',$page=0){
        $user = $this->session->userdata('logged_in');
        $uid = $user['uid'];
        $this->db->select('savsoft_users.uid,savsoft_users.su,savsoft_users.email,savsoft_users.first_name,savsoft_users.last_name,savsoft_users.contact_no');
        $this->db->join('savsoft_users','savsoft_users.uid=social_group_joined.uid');
        $this->db->join('social_group','social_group.sg_id=social_group_joined.sg_id');
        $this->db->where('savsoft_users.user_status','Active');
        $this->db->where("social_group_joined.sg_id=$sg_id");
        $this->db->where("social_group.sg_id=$sg_id");
        $this->db->where("social_group.created_by !=savsoft_users.uid ");
        if($search!=''){
            $this->db->like('savsoft_users.email',$search);
        }
        $this->db->limit(10);
        $this->db->offset($page*10);
        $query = $this->db->get('social_group_joined');
        $data['member'] = $query->result_array();
        $this->db->select('savsoft_users.uid,savsoft_users.su,savsoft_users.email,savsoft_users.first_name,savsoft_users.last_name,savsoft_users.contact_no');
        $this->db->join('social_group','social_group.created_by=savsoft_users.uid');
        $this->db->where("social_group.sg_id =$sg_id");
        $admin = $this->db->get('savsoft_users');
        $data['admin'] = $admin->result_array();
        $data['all'] =array_merge($data['admin'],$data['member']);
        return $data;
    /*    $offset = $page *10;
        $sql = '';
        $sql.= "
        select savsoft_users.uid,savsoft_users.su,savsoft_users.email,savsoft_users.first_name,savsoft_users.last_name,savsoft_users.contact_no
        from savsoft_users
        inner join social_group on social_group.created_by=savsoft_users.uid
        where social_group.sg_id =$sg_id
        ";
        if($search != ''){
            $sql .= " and where savsoft_users.email like '%$search%' ";
        }
        $sql .= "UNION 
        select savsoft_users.uid,savsoft_users.su,savsoft_users.email,savsoft_users.first_name,savsoft_users.last_name,savsoft_users.contact_no
        from social_group_joined
        inner join savsoft_users on savsoft_users.uid=social_group_joined.uid 
        inner join social_group on social_group.sg_id=social_group_joined.sg_id
        where social_group_joined.sg_id=$sg_id 
        and social_group.sg_id=$sg_id 
        and social_group.created_by !=savsoft_users.uid 
        limit 10
        offset $offset
        ";
   
        $query = $this->db->query($sql);
        return $query->result_array();*/
    }

    function joined($uid)
    {
        $joinarr = array();
        $this->db->where('uid', $uid);
        $query = $this->db->get('social_group_joined');
        $joined = $query->result_array();
        foreach ($joined as $k => $val) {
            $joinarr[] = $val['sg_id'];
        }
        return $joinarr;
    }

    function socialgroup_joined_list($search="",$sortby="",$limit=10,$page=0){
        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];
        $this->db->where('social_group.deleted','0');
        $this->db->join('social_group','social_group.sg_id = social_group_joined.sg_id');
        if($search!=''){
            $this->db->like('sg_name',$search);
        }
        if($uid != 1){
            $this->db->where('social_group_joined.uid',$uid);
        }else{
            $this->db->join('savsoft_users','social_group.created_by =savsoft_users.uid ');
            $this->db->distinct();
            $this->db->select('social_group_joined.sg_id,sg_name,sg_code,social_group.created_by,savsoft_users.first_name,savsoft_users.last_name');
        }
        if($sortby == "created"){
            $this->db->where('social_group.created_by',$uid);
        }else if($sortby=="joined"){
            $this->db->where('social_group.created_by !=',$uid);
        }
        $this->db->order_by('social_group_joined.sg_id','desc');
		$this->db->limit($limit);
		$this->db->offset($limit*$page);
        $results =$this->db->get('social_group_joined')->result_array();
        return $results;
    }
    function num_socialgroup_joined($search="",$sortby="",$limit=10,$page=0){
        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];
        $this->db->where('social_group.deleted','0');
        $this->db->join('social_group','social_group.sg_id = social_group_joined.sg_id');
        if($search!=''){
            $this->db->like('sg_name',$search);
        }
        if($uid != 1){
            $this->db->where('social_group_joined.uid',$uid);
        }else{
            $this->db->distinct();
            $this->db->select('social_group_joined.sg_id,sg_name');
        }
        if($sortby == "created"){
            $this->db->where('social_group.created_by',$uid);
        }else if($sortby=="joined"){
            $this->db->where('social_group.created_by !=',$uid);
        }
        $this->db->order_by('social_group_joined.sg_id','desc');
        $results =$this->db->get('social_group_joined');
        return $results->num_rows();
    }

    function delete_group($id){
        $logged_in = $this->session->userdata('logged_in');
        $data=array('deleted'=>'1');
		$this->db->where('social_group.sg_id', $id);
		$this->db->update('social_group', $data);
    }
    function out_group($sg_id,$uid){
        $this->db->where('sg_id',$sg_id);
        $this->db->where('uid',$uid);
        $this->db->delete('social_group_joined');
        $this->db->where('uid',$uid);
        $gr_ids = $this->db->get('savsoft_users')->row()->group_id;
        $gr_id = explode(',',$gr_ids);
        $new_gr_ids = '';
        for($i=0;$i<sizeof($gr_id);$i++){
            if($gr_id[$i] != $sg_id){
                $new_gr_ids .=  $gr_id[$i].',';
            }
        }

        $this->db->where('uid',$uid);
        $this->db->update('savsoft_users', array('group_id'=> substr_replace($new_gr_ids, "", -1)));
    }
    function add_user($sg_id,$uid){
        $logged_in = $this->session->userdata('logged_in');
        $this->db->where('uid',$logged_in['uid']);
        $user = $this->db->get('savsoft_users')->row_array();
        $name = $user['first_name'].' '.$user['last_name'];
        $this->db->where('sg_id',$sg_id);
        $group = $this->db->get('social_group')->row_array();
        $content = "Đã mời bạn tham gia nhóm".' '.$group['sg_name'];
        $action = "invite join group";
        $url = "accept_join_group(".$group['sg_id'].",$uid)";
        $model = 'group';
        $userdata = array(
            'uid' => $user['uid'],
            'content' => $content,
            'model' => $model,
            'action' => $action,
            'click' =>  $url,
        );
        $this->db->insert('notify',$userdata);
        $insert_idnt = $this->db->insert_id();
        $ud = array(
            'nid' => $insert_idnt,
            'uid' => $uid,
        );
        $this->db->insert('notify_user', $ud);
    }
    function notify_join_group($code,$uid){
        $user = $this->session->userdata('logged_in');
        $uid = $user['uid'];
        $name = $user['first_name'].' '.$user['last_name'];
        $this->db->where('sg_code',$code);
        $this->db->where('deleted',0);
        $group = $this->db->get('social_group');
        $dt = array();
        if($group->num_rows()==0){
            $dt['status'] = '0';
            $dt['mess'] = 'Mã nhóm không tồn tại';
        }else{
            $gr = $group->result_array()[0];
            $gr_id= $gr['sg_id'];
            $sg_name = $gr['sg_name'];
            $this->db->where('uid', $user['uid']);
            $gr_str=$this->db->get('savsoft_users')->result_array()[0]['group_id'];
            $gr_ids= explode(',', $gr_str);
            if(in_array($gr_id, $gr_ids)){
                $dt['status'] = '1';
                $dt['mess'] = 'Bạn đã tham gia nhóm '.$gr['sg_name'].' trước đó ';
            }else{
                $content = " đã gửi yêu cầu tham gia nhóm ".$gr['sg_name'];
				$model = "group";
                $action = "request_join_group";
                $click = "join_group($uid,$gr_id,'$name','$sg_name')";
                $userdatant = array(
                    'uid' => $user['uid'],
                    'content' => $content,
                    'model' => $model,
                    'action' => $action,
                    'click' =>  $click,
                );
                $this->db->insert('notify',$userdatant);
                $insert_idnt = $this->db->insert_id();
                $ud = array(
                    'nid' => $insert_idnt,
                    'uid' => $gr['created_by'],
                );
                $this->db->insert('notify_user', $ud);
                $dt['mess']= 'Yêu cầu tham gia nhóm '.$gr['sg_name'].' đã được gửi đến quản trị viên';
                $dt['status'] = '2';
            }
        }
        return $dt;
    }
/*    function join_group($code,$uid){
        $user = $this->session->userdata('logged_in');
        $this->db->where('sg_code',$code);
        $this->db->where('deleted',0);
        $group = $this->db->get('social_group');
        $dt = array();
        if($group->num_rows()==0){
            $dt['status'] = '0';
            $dt['mess'] = 'Mã nhóm không tồn tại';
        }else{
            $gr = $group->result_array()[0];
            $gr_id= $gr['sg_id'];
            $this->db->where('uid', $user['uid']);
            $gr_str=$this->db->get('savsoft_users')->result_array()[0]['group_id'];
            $gr_ids= explode(',', $gr_str);
            if(in_array($gr_id, $gr_ids)){
                $dt['status'] = '1';
                $dt['mess'] = 'Bạn đã tham gia nhóm '.$gr['sg_name'].' trước đó ';
            }else{
                $new_gr_ids = '';
                if($gr_str!=''){
                    $new_gr_ids.=$gr_str.','.$gr_id;
                }
                else{
                    $new_gr_ids.=$gr_id;
                }
                $this->db->where('uid', $user['uid']);
                $this->db->update('savsoft_users', array('group_id'=> $new_gr_ids));
                $this->db->insert("social_group_joined",array("uid"=>$user['uid'],"sg_id"=>$gr_id));
                $content = 'Gia nhập nhóm '.$gr['sg_name'];
				$model = "group";
				$action = "join group";
                $url = site_url('home_user/manage_group#/group/'.$gr_id);
                $userdatant = array(
                    'uid' => $user['uid'],
                    'content' => $content,
                    'model' => $model,
                    'action' => $action,
                    'click' =>  "window.location.href='".$url."'",
                );
                $this->db->insert('notify',$userdatant);
                $insert_idnt = $this->db->insert_id();
                $this->db->where("sg_id",$gr_id);
                $members = $this->db->get("social_group_joined")->result_array();
                foreach($members as $member){
                    $ud = array(
                        'nid' => $insert_idnt,
                        'uid' => $member['uid'],
                    );
                    $this->db->insert('notify_user', $ud);
                }
                $dt['mess']= 'Gia nhập nhóm '.$gr['sg_name'].' thành công';
                $dt['status'] = '2';
            }
        }
        return $dt;
    }*/
    function check_user_group($uid,$sg_id){
        $logged_in = $this->session->userdata('logged_in');
 
        $this->db->where('uid',$uid);
        $user=$this->db->get('savsoft_users')->row_array();
        $gr_ids= explode(',', $user['group_id']);
        if(in_array($sg_id, $gr_ids)){
            $dt = 1;
        }else{
            $dt = 0;
        }
        return $dt;
    }
    function join_group($uid,$sg_id,$code){
        $logged_in = $this->session->userdata('logged_in');
        $this->db->where('uid',$uid);
        $user= $this->db->get('savsoft_users')->row_array();
        $this->db->where('sg_id',$sg_id);
        $gr= $this->db->get('social_group')->row_array();
        if($user['group_id']!=''){
            $new_gr_ids.=$user['group_id'].','.$sg_id;
        }
        else{
            $new_gr_ids.=$sg_id;
        }
        $this->db->where('uid', $uid);
        $this->db->update('savsoft_users', array('group_id'=> $new_gr_ids));
        $this->db->insert("social_group_joined",array("uid"=>$uid,"sg_id"=>$sg_id));

        if($code==0){
            $model = "group";
            $action = "join_group";
            $content = " đã chấp nhận cho bạn tham gia nhóm ".$gr['sg_name'].' !';
            $url = site_url('home_user/manage_group#/group/'.$sg_id);
            $userdatant = array(
                'uid' => $logged_in['uid'],
                'content' => $content,
                'model' => $model,
                'action' => $action,
                'click' =>  "window.location.href='".$url."'",
                );
        }
        if($code == 1){
            $model = "group";
            $action = "join_group";
            $content = " đã chấp nhận lời mời của bạn tham gia nhóm ".$gr['sg_name'].' !';
            $url = site_url('home_user/manage_group#/group/'.$sg_id);
            $userdatant = array(
                'uid' => $logged_in['uid'],
                'content' => $content,
                'model' => $model,
                'action' => $action,
                'click' =>  "window.location.href='".$url."'",
                );
        }

        $this->db->insert('notify',$userdatant);
        $insert_idnt = $this->db->insert_id();
        if($code ==0){
            $ud = array(
                'nid' => $insert_idnt,
                'uid' => $uid,
            );
        }
        if($code==1){
            $ud = array(
                'nid' => $insert_idnt,
                'uid' => $gr['created_by'],
            );
        }
        $this->db->insert('notify_user', $ud);
    }
    function joined_groups($uid)
    {
        $joinarr = array();
        $this->db->where('uid', $uid);
        $this->db->join('social_group', 'social_group.sg_id=social_group_joined.sg_id');
        $query = $this->db->get('social_group_joined');
        $joined = $query->result_array();
        foreach ($joined as $k => $val) {
            $joinarr[$val['sg_id']] = $val['sg_name'];
        }
        return $joinarr;
    }

    function join($sg_id, $uid)
    {
        $this->db->where('sg_id', $sg_id);
        $this->db->where('uid', $uid);
        $query = $this->db->get('social_group_joined');
        if ($query->num_rows() == 0) {
            $userdata = array(
                'sg_id' => $sg_id,
                'uid' => $uid);
            $this->db->insert('social_group_joined', $userdata);
            $this->db->query(" update social_group set no_member=(no_member + 1) where sg_id='$sg_id' ");

            $this->db->where('uid', $uid);
            $query = $this->db->get('savsoft_users');
            $user = $query->row_array();
            $feed = $user['first_name'] . ' ' . $user['last_name'] . ' ' . $this->lang->line('sg_join_feed');
            $userdata = array(
                'sg_id' => $sg_id,
                'feed' => $feed
            );
            $this->db->insert('news_feed', $userdata);
        }
    }


    function unjoin($sg_id, $uid)
    {
        $this->db->where('sg_id', $sg_id);
        $this->db->where('uid', $uid);
        $this->db->delete('social_group_joined');
        $this->db->query(" update social_group set no_member=(no_member - 1) where sg_id='$sg_id' ");
        $this->db->where('uid', $uid);
        $query = $this->db->get('savsoft_users');
        $user = $query->row_array();
        $feed = $user['first_name'] . ' ' . $user['last_name'] . ' ' . $this->lang->line('sg_unjoin_feed');
        $userdata = array(
            'sg_id' => $sg_id,
            'feed' => $feed
        );
        $this->db->insert('news_feed', $userdata);
    }


    function remove_social_group($sg_id)
    {
        $this->db->where('sg_id', $sg_id);
        $this->db->delete('social_group');
        return true;
    }

    function get_mem($group_id)
    {
        $sql = "SELECT * FROM savsoft_users INNER JOIN social_group_joined on savsoft_users.uid = social_group_joined.uid where sg_id = $group_id";

        $stds = $this->db->query($sql)->result_array();
        if($stds){
            return $stds;
        } else return array();

    }
    function get_mem_rm($group_id)
    {
        $sql = "SELECT * FROM savsoft_users INNER JOIN social_group_joined on savsoft_users.uid = social_group_joined.uid";
        $sql3 = "SELECT * FROM savsoft_users";
        $stds = $this->db->query($sql)->result_array();
        $str_uid = '';
        foreach ($stds as $std) {
            $group_ids = explode(',', $std['sg_id']);
            if (in_array($group_id, $group_ids)) {
                if ($str_uid != '')
                    $str_uid .= ',' . $std['uid'];
                else
                    $str_uid .= $std['uid'];
            }
        }
        
        if ($str_uid != '') {
        	$sql2 = "SELECT * FROM savsoft_users where uid not in ($str_uid)";
        	return $this->db->query($sql2)->result_array();

        } else {
            return $this->db->query($sql3)->result_array();
        }

    }

    function remove_mem($group_id_rm, $mem_id)
    {
    	$sql = "DELETE FROM social_group_joined WHERE uid = $mem_id AND sg_id = $group_id_rm";
        $std = $this->db->query($sql);
    }

    function add_mem($group_id, $mem_id)
    {
        $sql = "INSERT INTO social_group_joined (sg_id, uid) VALUES ($group_id, $mem_id)";
        $std = $this->db->query($sql);
    }
    function load_group($sg_id){
        $user = $this->session->userdata('logged_in');
        $this->db->where('sg_id',$sg_id);
        $this->db->where('uid',$user['uid']);
        $stt = $this->db->get('social_group_joined')->num_rows();
        $this->db->where('sg_id',$sg_id);
        $gr = $this->db->get('social_group')->row()->deleted;
        if($stt == 0 || $gr == 1){
            $data['stt'] = 0;
        }else{
            $data['stt'] = 1;
            $this->db->join('savsoft_users', 'savsoft_users.uid=social_group.created_by');
            $this->db->where('sg_id',$sg_id);
            $query=$this->db->get('social_group');
            $data['group'] = $query->row_array();
        }
        return $data;
    }
    function write_post($sg_id, $parent_id){
        $us = $this->session->userdata('logged_in');
        $this->db->where('sg_id',$sg_id);
        $this->db->where('uid',$us['uid']);
        $nums = $this->db->get('social_group_joined')->num_rows();
        $this->db->join('savsoft_users','savsoft_users.uid=social_group_joined.uid');
        $user = $this->db->get('social_group_joined')->row_array();
        if($nums != 0){
            $data = json_decode($this->input->raw_input_stream,true);
            $post = array('content'=>$data['content'],
            'parent_id'=>$parent_id,
            'wall_id'=>$sg_id,
            'model'=>'social_group',
            'create_by'=>$us['uid']
            );
            $this->db->insert('posts', $post);
            $this->db->where("sg_id",$sg_id);
            $gr = $this->db->get('social_group')->row_array();
            $content = 'Đăng bài viết trên tường nhóm '.$gr['sg_name'];
            $model = "social_group";
            $action = "write post";
            $url = site_url('home_user/manage_group#/group/'.$sg_id);
            $userdatant = array(
                'uid' => $us['uid'],
                'content' => $content,
                'model' => $model,
                'action' => $action,
                'click' =>  "window.location.href='".$url."'",
            );
            $this->db->insert('notify',$userdatant);
            $insert_idnt = $this->db->insert_id();
            $this->db->where("sg_id",$sg_id);
            $members = $this->db->get("social_group_joined")->result_array();
            foreach($members as $member){
                $ud = array(
                    'nid' => $insert_idnt,
                    'uid' => $member['uid'],
                );
                $this->db->insert('notify_user', $ud);
            }
        }
    }
    function load_discussion($sg_id, $pivot=0, $max_post=5){
        $us = $this->session->userdata('logged_in');
        $this->db->where('uid',$us['uid']);
        $this->db->where('sg_id',$sg_id);
        $nums = $this->db->get('social_group_joined')->num_rows();
        $data = array();
        if($nums != 0){
			$this->db->from('posts p');
            $this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
			$this->db->where('p.model','social_group');
			$this->db->where('p.wall_id', $sg_id);
			$this->db->where('p.parent_id', 0);
			if($pivot!=0)
				$this->db->where('p.post_id <', $pivot);
			$this->db->limit($max_post+1);
			$this->db->order_by("p.create_date", "desc");
			$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,su,photo");
			$data['post'] =$this->db->get()->result_array();
			for($i=0; $i<count($data['post']); $i++){
				$this->db->from('posts p');
				$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
				$this->db->where('p.model','social_group');
				$this->db->where('p.parent_id', $data['post'][$i]['post_id']);
				$this->db->limit(3);
				$this->db->order_by("p.create_date", "desc");
				$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,su,photo");
				$data['post'][$i]['reply']=$this->db->get()->result_array();
				$this->db->where('parent_id', $data['post'][$i]['post_id']);
				$data['post'][$i]['nreply']=$this->db->get('posts')->num_rows();
			}
			$data['cuid'] = $us['uid'];
		}
        return $data;
    }
    function load_reply($parent_id, $pivot=0, $max_post=5){
        $us = $this->session->userdata('logged_in');
		$this->db->from('posts p');
		$this->db->join('savsoft_users u', 'u.uid = p.create_by'); 
		$this->db->where('p.model','social_group');
		$this->db->where('p.parent_id', $parent_id);
		if($pivot!=0)
			$this->db->where('p.post_id <', $pivot);
		$this->db->limit($max_post+1);
		$this->db->order_by("p.create_date", "desc");
		$this->db->select("post_id,content,wall_id, model, p.parent_id,create_by,create_date,uid,email,first_name,last_name,su,photo");
		$data['post'] =$this->db->get()->result_array();
		$data['cuid'] = $us['uid'];
		return $data;
    }
    function get_member($sg_id,$search=''){
        $user = $this->session->userdata('logged_in');
        $uid = $user['uid'];
        $class_id = $user['class_id'];
        $group_id = $user['group_id'];
        $sql = "select DISTINCT uid,email,su,birthdate,user_code,first_name, last_name from savsoft_users where uid not in (select uid from social_group_joined where sg_id= $sg_id ) and uid != $uid ";
        if($user['su']==3){      
            if($group_id != ''){
                if($class_id != ''){
                    $sql .=" and
                    (( uid in ( select member_id from class_member where class_id in ($class_id) ) and su=2 ) 
                    or ( uid in ( select uid from social_group_joined where sg_id in ( $group_id ) ) )) ";
                }else{
                    $sql .= " and ( uid in ( select uid from social_group_joined where sg_id in ( $group_id ) )";
                }
            }else{
            //    $sql ="select DISTINCT uid,email,su,birthdate,user_code,first_name, last_name  from savsoft_users join class_member  on savsoft_users.uid = class_member.member_id where ( class_member.class_id in ($class_id) and savsoft_users.su=2 ) ";
                if($class_id != ''){
                    $sql .= " and ( uid in ( select member_id from class_member where class_id in ($class_id) ) and su=2 )";                    
                }
            }
        }else if($user['su']==4){
        //    $sql = "select uid,email,su,birthdate,user_code,first_name, last_name from savsoft_users where parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid' or parent_id='$uid'  ";
            $sql .= " and parent_id like '%,$uid,%' or parent_id like '$uid,%' or parent_id like '%,$uid' or parent_id='$uid'";
        }
        else if($user['su']==2){
        //    $sql = "select uid,email,su,birthdate,user_code,first_name, last_name from savsoft_users where uid in ( select uid from social_group_joined where sg_id in ( $group_id ) and uid != $uid ";
            if($group_id != ''){
                $sql .= " and ( uid in ( select uid from social_group_joined where sg_id in ( $group_id ) ) )";
            }
        }
        $sql .= " and user_status = 'Active'";
        if($search!=""){
            $sql.=" and (first_name like '%".$search."%' or email like '%".$search."%' )"; 
        }
        $data = $this->db->query($sql)->result_array();
        return $data;
    }
}

