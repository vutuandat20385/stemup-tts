<script>
    var base_url = "<?php echo base_url(); ?>";
    var site_url = "<?php echo site_url(); ?>";
</script>
<style>
    .pointer {
        cursor: pointer;
    }

    ;

    .nav.nav-tabs.MB20.bg-tab {
        display: none;
    }
</style>
<aside class="col-md-12">
    <form id="time" style="margin: 10px 0;" action="<?php echo base_url(); ?>index.php/admin/thongke_point" method="post">
        Thống kê theo <select name="time" id="time" class="btn btn-info" onchange="frm_submit_action('time', '<?php echo base_url(); ?>index.php/admin/thongke_point')">
            <option value="1" <?php echo $selected1;?>>Ngày</option>
            <option value="2" <?php echo $selected2;?>>Tuần</option>
            <option value="3" <?php echo $selected3;?>>Tháng</option>
        </select> hiện tại
    </form>
    <div id="tabContent2" class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home2a">
            <div class="box-bor MB20">
                <div role="tabpanel" id="tabs">
                    <div id="tabContent1" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home1">
                            <div class="data_mngq">
                                <table class="table table-bordered" style="background: #fff;">
                                    <tr style="background-color: rgb(233, 235, 238);">
                                        <th>
                                            STT
                                        </th>
                                        <th>
                                            Tên người dùng
                                        </th>
                                        <th style="width: 50%;">
                                            Email
                                        </th>
                                        <th>
                                            Điểm
                                        </th>
                                    </tr>
                                    <?php foreach ($point as $row) {
                                        $stt++; ?>
                                        <tr>
                                            <td><?php echo $stt; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['point']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
<script>
    function frm_submit_action(fsm, action) {
        $("#" + fsm).attr("action", action);
        $("#" + fsm).submit();
    }
</script>