<?php
Class New_stemup_model extends CI_Model
{
    function get_class_new(){
        $data = $this->db->get('savsoft_category_news')->result_array();
        return $data;
    }
    
    function insert_new(){
    //    $inp = json_decode($this->input->raw_input_stream,true);
        $str = $_POST['name'];
        $target_dir = "images/iamge_news/";
        // $basename = basename($_FILES["avatar_news"]["name"]);
        $inputFileName = $target_dir . basename($_FILES["avatar_news"]["name"]);         
        $fileType = strtolower(pathinfo($inputFileName,PATHINFO_EXTENSION));
        if($fileType=="png" | $fileType=="jpg" ){
            // Upload file

            $target_dir = "images/image_news/";
            $basename = basename($_FILES["avatar_news"]["name"]);
            $inputFileName = $target_dir .$_POST['url_name']. '.png';
            move_uploaded_file($_FILES['avatar_news']['tmp_name'], $inputFileName);
         //   echo $basename;
        }
        $data = array(
            'name' => $_POST['name'],
            'avatar' => base_url("images/image_news/".$_POST['url_name'].".png"),
            'url_name' => $_POST['url_name'],
            'homepage'=>$_POST['homepage'],
            'category'  => $_POST['class'],
            'description'  => $_POST['des'],
            'content'  => $_POST['content'],
            'tag'  => $_POST['tag'],
            'status'  => 1,
        );
        $this->db->insert('savsoft_news', $data);
        if($this->db->affected_rows() > 0){
            $nid = $this->db->insert_id();
            $new_url = $_POST['url_name']."-".$nid;
            $this->db->set("url_name", $new_url);
            $this->db->where("id",$nid);
            $this->db->update("savsoft_news");
            $mess = "success";
        } else {
            $mess = "fail";
        }
        return $mess;
    }
    function check_name_exist(){
        $inp = json_decode($this->input->raw_input_stream,true);
        $this->db->where('name',$inp['name']);
        $check = $this->db->get('savsoft_news')->num_rows();
        if($check != 0) {
            $mess = 0;
        } else {
            $mess = 1;
        }
        return $mess;
    }

    function get_list_news(){
        $sql="SELECT * FROM savsoft_news WHERE status=1 ORDER BY id desc";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else return false;
    }

    function get_detail_new($url_name){
        $sql="SELECT * FROM savsoft_news WHERE status=1 and url_name like '%".$url_name."%'";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->row_array();
        }else return false;
    }

    function get_post_homepage(){
        $sql="SELECT * FROM savsoft_news WHERE status=1 and homepage=1 ORDER BY RAND() LIMIT 2";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0){
            return array(
                    'slide'=>$query->result_array()
                    );
        }else return false;

        
    }

    function get_post_rand(){
        $sql1="SELECT * FROM savsoft_news WHERE status=1 and homepage=1 ORDER BY RAND() LIMIT 4";
        $query1=$this->db->query($sql1);
        if($query1->num_rows() > 0){
            return array(
                    'rand'=>$query1->result_array()
                    );
        }else return false;
    }

    function get_other_news($id){
        $sql="SELECT * FROM savsoft_news WHERE id<>$id ORDER BY RAND() LIMIT 3";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }
    function get_other_news_rand(){
        $sql="SELECT * FROM savsoft_news ORDER BY RAND() LIMIT 3";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    // function get_common_news($id){
    //     $sql_common="SELECT * FROM savsoft_news WHERE id=$id";
    //     $query_common=$this->db->query($sql_common);
    //     if($query_common->num_rows() > 0){
    //         $common=$query_common->row_array();
    //         $common_tag=explode(",",$common['tag']);
    //         $array=array();
    //         foreach ($common_tag as $key => $value) {
    //             $sql="SELECT * FROM savsoft_news WHERE id<>$id and tag like '%".$value['tag']."%'";
    //             $query=$this->db->query($query);
    //             if($query->num_rows() > 0){
    //                 array_push($array,$query->result_array());                    
    //             }

    //         }
    //         return array();
    //     }else
    //         return false;      
    // }

    function get_common_news($id){
        $category_sql="SELECT * FROM savsoft_news WHERE id=$id";
        $category=$this->db->query($category_sql)->row_array();
        $cate_id=$category['category'];
        $sql="SELECT * FROM savsoft_news WHERE id<>$id and category=".$cate_id." LIMIT 3";
        $query=$this->db->query($sql);
        if($query->num_rows()>0){
            return $query->result_array();
        }else
            return false;
    }

    function get_common_news_rand(){
        $sql="SELECT * FROM savsoft_news ORDER BY RAND() LIMIT 3";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else
            return false;
    }

    function get_search_n($timkiem){
        $sql="SELECT name,url_name,avatar,description,content,modify_date FROM savsoft_news WHERE (description LIKE '%$timkiem%') OR (name LIKE '%$timkiem%') OR (content LIKE '%$timkiem%') AND status=1 and homepage=1";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0){
            return array(
                'status'=>1,
                'slide'=>$query->result_array()
            );
        }else {
            return array(
                'status'=>0
            );
        }
    }
    

    function get_post_search(){
        $sql1="SELECT * FROM savsoft_news WHERE status=1 and homepage=1 ORDER BY RAND() LIMIT 4";
        $query1=$this->db->query($sql1);
        if($query1->num_rows() > 0){
            return array(
                'rand'=>$query1->result_array()
            );
        }else return false;
    }
}