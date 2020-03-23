<!-- <!DOCTYPE html>
<html lang="en">
<head> -->
   <?php
    $this->load->view("sadmin/head")
   ?>
<!-- </head>
<body> -->
    <div class="wrapper">
        <?php
            $this->load->view("sadmin/header") 
        ?>
        <!-- left menu -->
        <aside class="main-sidebar">
            <?php $this->load->view('sadmin/leftmenu'); ?>
        </aside>

        <!-- Main content -->
        <div class="content-wrapper">
            <section class="content-header">
                <h2>Feedback sử dụng phần mềm</h2>
            </section>

            <!-- Table content -->
            <section id="table-contents">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr class="first-row-tbl">
                            <td class="header-table header-table-color" align="center">FBID</td>
                            <td class="header-table header-table-color">UID</td>
                            <td class="header-table header-table-color">Nội dung</td>
                            <td class="header-table header-table-color" align="center">Loại phản hồi</td>
                            <td class="header-table header-table-color" align="center">Ngày tạo</td>
                            <td class="header-table header-table-color" align="center">Hành động</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($feedback as $fb) {
                                if ($fb["status"] == 0) {
                                    $status = '<i class="fa fa-eye-slash"></i>';
                                }
                                else {
                                    $status = '<i class="fa fa-check-circle"></i>';
                                }
                        ?>
                        <tr>
                            <td class="header-table" align="center"><?php echo $fb["fbid"] ?></td>
                            <td class="header-table" align="center"><?php echo $fb["uid"] ?></td>
                            <td class="header-table"><?php echo $fb["content"] ?></td>
                            <td class="header-table" align="center"><?php echo $fb["type_name"] ?></td>
                            <td class="header-table" align="center"><?php echo $fb["create_date"] ?></td>
                            <td class="header-table" align="center" onclick="updateFbStatus(<?php echo $fb['fbid']?>,<?php echo $fb['status'] ?>)"><?php echo $status?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                    
                </table>
            </section>
            
        </div>
    </div>
    
</body>
<script>
    var base_url="<?php echo base_url();?>";
    function updateFbStatus(fbid, fbstatus) {
        console.log(fbid);
        console.log(fbstatus);
        $.post('<?php echo base_url("index.php/sadmin/update_feedback_status")?>',
            {
                fbid: fbid,
                fbstatus: fbstatus
            }, 
            function (data) {
                $("#table-contents").html(data);
            }
        );
    }
</script>
<?php
    $this->load->view("sadmin/foot")
?>
</html>