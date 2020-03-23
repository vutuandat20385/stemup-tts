<?php
class manage_class_model extends CI_Model{
    function getClass($id){
        $this->db->select('post_id,content,wall_id,dataitem_name,savsoft_dataitem.description,posts.parent_id,create_by,photo,create_date, deleted,CONCAT(first_name,\' \',last_name) as create_name')
            ->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
            ->join('savsoft_dataitem', 'savsoft_dataitem.did = posts.wall_id')
            ->where('wall_id',$id)
            ->where('model','class');
        $query = $this->db->get('posts');
        if($query->num_rows()>0){
            return $query->result_array();
        }else
            return false;
    }

    function getAllDiscussion($wall_id){
        $this->db->select('post_id,content,posts.parent_id,create_by,photo,posts.create_date,deleted,CONCAT(first_name,\' \',last_name) as create_name')
            ->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
            ->where('posts.model','class')
            ->where('posts.wall_id',$wall_id)
            ->where('posts.deleted <',99)
            ->where('posts.parent_id','0')
            ->order_by('posts.create_date', 'DESC');
        $query = $this->db->get('posts');
        if($query->num_rows()>0){
            return $query->result_array();
        }else
            return false;
    }

    function getComment($parent_id,$wall_id){
        $this->db->select('post_id,content,wall_id,posts.parent_id,create_by,photo,posts.create_date,deleted,CONCAT(first_name,\' \',last_name) as create_name')
            ->join('savsoft_users', 'savsoft_users.uid = posts.create_by')
            ->where('model','class')
            ->where('wall_id',$wall_id)
            ->where('posts.deleted <',99)
            ->where('posts.parent_id',$parent_id)
            ->order_by('posts.create_date', 'DESC');
        $query = $this->db->get('posts');
        if($query->num_rows()>0){
            return $query->result_array();
        }else
            return false;
    }

    function addComment($obj,$model,$parent_id){
        $data = array(
            'content'       =>  $obj['content'],
            'wall_id'       =>  $obj['wall_id'],
            'parent_id'     =>  $parent_id,
            'create_by'     =>  $obj['create_by'],
            'create_date'   =>  $obj['create_date'],
            'modify_date'   =>  $obj['modify_date'],
            'model'         =>  $model,
            'deleted'       =>  '99'
        );
        $this->db->insert('posts', $data);
    }


}