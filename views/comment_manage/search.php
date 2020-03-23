<table class="table">
    <thead class="thead-dark">
    <tr>
        <td class="td_id col-md-1">ID</td>
        <td  class="td_content col-md-5">Nội dung comment</td>
        <td  class="td_creater col-md-2">Người tạo</td>
        <td  class="td_createdate col-md-2">Ngày tạo</td>
        <td  class="td_status col-md-1">Trạng thái</td>
        <td  class="td_action col-md-1">Thao tác</td>
    </tr>
    </thead>
    <?php
    foreach ($arr_result as $value){
        ?>
        <tr>
            <td class="td_id col-md-1"><?php echo $value['post_id'];?></td>
            <td  class="td_content col-md-5"><?php echo $value['content'];?></td>
            <td  class="td_creater col-md-2"><?php echo $value['create_name'];?></td>
            <td  class="td_createdate col-md-2"><?php echo $value['create_date'];?></td>
            <td  class="td_status col-md-1"><?php
                if($value['deleted']=='2'){
                    echo '<i class="fas fa-eye green" title="Được hiển thị"></i>';
                }else{
                    if($value['deleted']=='1'){
                        echo '<i class="fas fa-eye-slash red"title="Không được hiển thị"></i>';
                    }else{
                        echo '<i class="fas fa-question-circle orange" title="Chưa duyệt"></i>';
                    }

                }
                ?></td>
            <td  class="td_action col-md-1"><?php
                if($value['deleted']=='2'){
                    echo '<a href="'.base_url("index.php/comment_manage/delete").'/'.$value["post_id"].'" title="Không cho phép hiển thị"><i class="fas fa-trash-alt blue"></i></a>';
                }else{
                    if($value['deleted']=='1'){
                        echo '<a href="'.base_url("index.php/comment_manage/display").'/'.$value["post_id"].'" title="Cho phép hiển thị"><i class="fas fa-check-circle green"></i></a>';
                    }else{
                        echo '<a href="'.base_url("index.php/comment_manage/display").'/'.$value["post_id"].'" title="Cho phép hiển thị"><i class="fas fa-check-circle green"></i></a>';
                        echo '<a href="'.base_url("index.php/comment_manage/delete").'/'.$value["post_id"].'" title="Không cho phép hiển thị"><i class="fas fa-trash-alt blue"></i></a>';
                    }

                }
                ?></td>
        </tr>
        <?php
    }
    ?>
</table>
<!--<div class="pagination">-->
<!--    --><?php //echo $pagination ?>
<!--</div>-->