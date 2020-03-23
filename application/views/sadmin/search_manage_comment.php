<?php if($search_result['status']==1){

?>


<table class="table">
    <thead class="thead-light">
        <tr>
            <td class="td_id col-md-1" align="center"><b>ID</b></td>
            <td  class="td_content col-md-5" align="center"><b>Nội dung comment</b></td>
            <td  class="td_creater col-md-2" align="center"><b>Người tạo</b></td>
            <td  class="td_createdate col-md-2" align="center"><b>Ngày tạo</b></td>
            <td  class="td_status col-md-1" align="center"><b>Trạng thái</b></td>
            <td  class="td_action col-md-1" align="center"><b>Thao tác</b></td>
        </tr>
    </thead>
    <?php
    foreach ($search_result['result'] as $value){
        ?>
        <tr>
            <td class="td_id col-md-1" align="center"><?php echo $value['post_id'];?></td>
            <td  class="td_content col-md-5"><?php echo $value['content'];?></td>
            <td  class="td_creater col-md-2"><?php echo $value['first_name'];?></td>
            <td  class="td_createdate col-md-2"><?php echo $value['create_date'];?></td>
            <td  class="td_status col-md-1" align="center"><?php
            if($value['deleted']=='2'){
                echo '<i class="far fa-eye " style="color: #f100ff" title="Được hiển thị"></i>';
            }else{
                if($value['deleted']=='1'){
                    echo '<i class="fas fa-eye-slash red" title="Không được hiển thị"></i>';
                }else{
                    echo '<i class="fas fa-question-circle orange" title="Chưa duyệt"></i>';
                }

            }
            ?></td>
            <td  class="td_action col-md-1" align="center"><?php
            if($value['deleted']=='2'){
                echo '<a href="'.base_url("index.php/comment_manage/delete").'/'.$value["post_id"].'" title="Không cho phép hiển thị"><i class="fas fa-trash-alt blue"></i></a>';
            }else{
                if($value['deleted']=='1'){
                    echo '<a href="'.base_url("index.php/comment_manage/display").'/'.$value["post_id"].'" title="Cho phép hiển thị"><i class="fas fa-check-circle green"></i></a>';
                }else{
                    echo '<a href="'.base_url("index.php/comment_manage/display").'/'.$value["post_id"].'" title="Cho phép hiển thị"><i class="fas fa-check-circle green"></i></a>';
                    echo '&nbsp &nbsp ';
                    echo '<a href="'.base_url("index.php/comment_manage/delete").'/'.$value["post_id"].'" title="Không cho phép hiển thị"><i class="fas fa-trash-alt blue"></i></a>';
                }

            }
            ?></td>
        </tr>
        <?php
    }
    ?>
</table>

<?php }else{
    echo "Không tìm thấy kết quả";
} ?>
