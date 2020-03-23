

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản lý bình luận</title>
    <link href="<?php echo base_url('css/cm_manage.css');?>" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.3.0/js/all.js"></script>
    <script>
        var base_url="<?php echo base_url();?>";
        var site_url="<?php echo site_url();?>";
        var su="<?php echo $su ?>";
    </script>

    <?php
    $this->load->view('sadmin/head');

    ?>

    <div class="wrapper">
        <?php $this->load->view('sadmin/header'); ?>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <?php $this->load->view('sadmin/leftmenu') ?>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Quản lý bình luận
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                    <li class="active">Quản lý bình luận</li>
                </ol>
            </section>
            <section class="row" >
                <aside  class="col-md-12" >
                    <div class="div-filter col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group col-md-6 col-left">
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
                        <div class="input-group col-md-6 col-right ">
                            <input type="text" name="comment_search" id="comment_search" placeholder="Tìm kiếm theo nội dung" size="30">
                        </div>
                    </div>
                    <div id="result">
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
                            foreach ($arr_result as $value){
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
                        <div class="pagination" style="margin-left: 5%;margin-top: -1%;">
                            <?php echo $pagination ?>
                        </div>
                    </div>
                </aside>

            </section>
        </div>
        <!-- ---------------- -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
    </aside>
    <?php $this->load->view('sadmin/foot') ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#inputSelect').change(function(){
                // alert('123');
                console.log('123');
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
                //alert(status)
                window.location='<?php echo site_url("sadmin/manage_comment") ?>'+'/'+status_url;
            });
            let input = document.querySelector('#comment_search');
            // let log = document.getElementById('log');

            input.oninput = handleInput;

            function handleInput(e) {
                string = input.value;
                    // console.log(string);
                    $.post('<?php echo base_url("index.php/sadmin/search_manage_comment")?>',{string:string},function (data) {
                        $('#result').html(data);
                    });
                }

            });
        </script>
    </main>
</body>

</html>




