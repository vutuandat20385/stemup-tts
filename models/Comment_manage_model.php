<?php
class Comment_manage_model extends CI_Model{

    function getAllComment(){
        $this->db->select('post_id,content,create_date, deleted,CONCAT(first_name,\' \',last_name) as create_name')
            ->join('savsoft_users', 'savsoft_users.uid = posts.create_by')

            ->order_by("post_id", "desc");

        $query = $this->db->get('posts');

        if($query->num_rows()>0){
            return $query->result_array();
        }else
            return false;
    }
    function getAllComment_limit($start,$limit){
        $this->db->select('post_id,content,create_date, deleted,CONCAT(first_name,\' \',last_name) as create_name')
            ->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
            ->limit($limit,$start)
            ->order_by("post_id", "desc");

        $query = $this->db->get('posts');

        if($query->num_rows()>0){
            return $query->result_array();
        }else
            return false;
    }
    function getAllComment_byStatus($status){
        $this->db->select('post_id,content,create_date, deleted,CONCAT(first_name,\' \',last_name) as create_name')
            ->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
            ->where("deleted",$status)
            ->order_by("post_id", "desc");

        $query = $this->db->get('posts');

        if($query->num_rows()>0){
            return $query->result_array();
        }else
            return false;
    }
    function getAllComment_byStatus_limit($status,$start,$limit){
        $this->db->select('post_id,content,create_date, deleted,CONCAT(first_name,\' \',last_name) as create_name')
            ->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
            ->where("deleted",$status)
            ->limit($limit,$start)
            ->order_by("post_id", "desc");

        $query = $this->db->get('posts');

        if($query->num_rows()>0){
            return $query->result_array();
        }else
            return false;
    }
    function delete($id){
        $data = array(
            'deleted' => 1,

        );
        $this->db->where('post_id', $id);
        $this->db->update('posts', $data);
    }
    function display($id){
        $data = array(
            'deleted' => 2,

        );
        $this->db->where('post_id', $id);
        $this->db->update('posts', $data);
    }

    function search($string){
        $this->db->select('post_id,content,create_date, deleted,CONCAT(first_name,\' \',last_name) as create_name')
            ->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
            ->like('first_name', $string)
            ->or_like('last_name', $string)
            ->or_like('content', $string)
        ;
        $query = $this->db->get('posts');
        if($query->num_rows()>0){
            return $query->result_array();
        }else
            return false;
    }


}