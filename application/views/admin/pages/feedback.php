<div id="table-contents">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr class="first-row-tbl">
                <td class="header-table header-table-color" align="center">Fbid</td>
                <td class="header-table header-table-color">Uid</td>
                <td class="header-table header-table-color">Nội dung</td>
                <td class="header-table header-table-color">Email</td>
                <td class="header-table header-table-color" align="center">Loại phản hồi</td>
                <td class="header-table header-table-color" align="center">Ngày tạo</td>
                <td class="header-table header-table-color" align="center">Hành động</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($list_news as $data) {
                if ($data->status == 0) {
                    $status = '<i class="fa fa-eye-slash"></i>';
                } else {
                    $status = '<i class="fa fa-check-circle"></i>';
                }
            ?>
                <tr>
                    <td class="header-table" align="center"><?php echo $data->fbid ?></td>
                    <td class="header-table" align="center"><?php echo $data->uid ?></td>
                    <td class="header-table"><?php echo $data->content ?></td>

                    <td class="header-table" align="center"><?php echo $data->email ?></td>
                    <td class="header-table" align="center"><?php echo $data->type_name ?></td>
                    <td class="header-table" align="center"><?php
                                                            $date = date_create($data->create_date);
                                                            echo date_format($date, "d/m/Y");
                                                            ?></td>
                    <!-- <td class="header-table" align="center" onclick="updateFbStatus(<?php echo $data->fbid ?>,<?php echo $data->status ?>)"><?php echo $status ?></td> -->
                    <td class="header-table" align="center" onclick="updateFbStatus(<?php echo $data->fbid ?>)">
                        <div class="ese<?php echo $data->fbid ?>"><?php echo $status ?></div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>

    </table>
    <div class="col-md-12">
        <center>
            <ul class="pagination">
                <?php foreach ($links as $link) { ?>
                    <li class="page-item page-link "><?php echo  $link ?> </li>
                <?php } ?>
            </ul>
        </center>
    </div>
</div>

<script>
    var base_url = "<?php echo base_url(); ?>";

    // function updateFbStatus(fbid, fbstatus) {
    //     $.post('<?php echo base_url("index.php/admin/update_feedback_status") ?>', {
    //             fbid: fbid,
    //             fbstatus: fbstatus
    //         },
    //         function(data) {
    //             $("#table-contents").html(data);
    //         }
    //     );
    // }
    function updateFbStatus(fbid) {
        
        $.post('<?php echo base_url("index.php/admin/update_feedback_status")?>',
        {
            fbid : fbid,
        },
        function(data){
            if(data == 1){
                var update = '<i class="fa fa-check-circle"></i>';
            }else{
                var update = '<i class="fa fa-eye-slash"></i>';
            }
            console.log(update);
            $(".ese"+fbid).html(update);
            // console.log(fbid);
            // $('#table-contents').html(data)
        }
        );
    }
</script>