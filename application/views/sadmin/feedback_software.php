<!-- <!DOCTYPE html>
<html lang="en">
<head> -->

   <?php
   $this->load->view("sadmin/head")
   ?>
   <div class="wrapper">
    <?php
    $this->load->view("sadmin/header") 
    ?>
    <style type="text/css">
        .table {
    width: 97% !important;
    margin: 11px;
}
    </style>
    <!-- left menu -->
    <aside class="main-sidebar">
        <?php $this->load->view('sadmin/leftmenu'); ?>
    </aside>

    <!-- Main content -->

    <div class="content-wrapper">
        <section class="row">
            <aside  class="col-md-12" >
                <div class="div-filter col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group col-md-9 col-account-left ">
                        <h2>Feedback sử dụng phần mềm</h2>
                    </div>
                    <div class="input-group col-md-3 col-account-right " style=" margin-top: 15px;">
                        <input type="text" name="life_account_search" id="life_account_search" placeholder="Tìm kiếm theo nội dung" size="30" style="width: 86%">    
                        <!-- <p id="log">456r76t87y</p>                  -->
                    </div>
                </div>

                <!-- </section> -->
                <!-- Table content -->
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
                                }
                                else {
                                   $status = '<i class="fa fa-check-circle"></i>';
                               }
                               ?>
                               <tr>
                                <td class="header-table" align="center"><?php echo $data->fbid ?></td>
                                <td class="header-table" align="center"><?php echo $data->uid ?></td>
                                <td class="header-table"><?php echo $data->content?></td>

                                <td class="header-table" align="center"><?php echo $data->email ?></td>
                                <td class="header-table" align="center"><?php echo $data->type_name ?></td>
                                <td class="header-table" align="center"><?php
                                $date=date_create( $data->create_date);
                                echo date_format($date,"d/m/Y");
                                ?></td>
                                <td class="header-table" align="center" onclick="updateFbStatus(<?php echo $data->fbid?>,<?php echo $data->status ?>)"><?php echo $status?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>
           

</aside>
 <div class="col-md-12">
                <center>
                 <ul class="pagination">

                  <?php foreach ($links as $link) { ?>


                     <li class="page-item page-link "><?php echo  $link ?>
                 </li>

             <?php }?>  


         </ul>

     </center>
 </div>
</section>
</div> <?php $this->load->view('sadmin/footer');?>

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
<script>
    $(document).ready(function(){

        let input = document.querySelector('#life_account_search');
        // let log = document.getElementById('log');
        input.oninput = handleInput;
        function handleInput(e) {
            string = input.value;
            // console.log(string);
            $.post('<?php echo base_url("index.php/sadmin/get_feedback_search")?>',{string:string},function (data) {
                $('#table-contents').html(data);
            });
        }

    });
</script>