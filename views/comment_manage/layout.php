<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="container" id="main-comment-manage">
    <section class="row" >
        <aside class="col-md-2">
            <?php $this->load->view('left');?>

        </aside>
        <aside class="col-md-10">

                <div id="menu">
                    <?php
                    $this->load->view('web_menu');
                    ?>
                </div>
                <div class="header">
                    <h1>Quản lý bình luận</h1>
                </div>
                <div class="div-filter row">
                    <div class="col-md-6 col-left">
                        <label class="input-group-text" for="inputStatus">Trạng thái  </label>

                        <select class="custom-select" id="inputSelect">
                            <option value="100" <?php if($status=='100'){
                                echo 'selected';
                            }

                                ?>>Tất cả</option>
                            <option value="99" <?php if($status=='99'){
                                echo 'selected';
                            }

                            ?>>Chưa duyệt</option>
                            <option value="2" <?php if($status=='2'){
                                echo 'selected';
                            }

                            ?>>Được hiển thị</option>
                            <option value="1" <?php if($status=='1'){
                                echo 'selected';
                            }

                            ?>>Không được hiển thị</option>

                        </select>
                    </div>
                    <div class="input-group mb-3 col-md-6 col-right ">
                        <input type="text" name="comment_search" id="comment_search" placeholder="Tìm kiếm theo nội dung hoặc user" size="30">
                    </div>
                </div>
                <div id="result">
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
                                            echo '<i class="fas fa-eye-slash red" title="Không được hiển thị"></i>';
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
                    <div class="pagination">
                        <?php echo $pagination ?>
                    </div>
                </div>


        </aside>

    </section>
</div>
<?php


?>

<script>
    $(document).ready(function(){
        $('#inputSelect').change(function(){
            var status = $('#inputSelect').val();
            switch (status) {
                case '1':
                    var status_url = 'khong-duoc-hien-thi';
                    break;
                case '2':
                    var status_url = 'duoc-hien-thi';
                    break;
                case '99':
                    var status_url = 'cho-duyet';
                    break;
                default:
                    var status_url = 'tat-ca';
                    break;
            }
            // alert(status)
            window.location='<?php echo base_url("index.php/comment_manage") ?>'+'/index/'+status_url;
        });

        $('#comment_search').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                var string = $('#comment_search').val();
                //alert('<?php //echo base_url("index.php/comment_manage/search")?>//');
                $.post('<?php echo base_url("index.php/comment_manage/search")?>',{string:string},function (data) {
                    $('#result').html(data);
                });
            }
        });
    });
</script>



