<aside class="col-md-7">
    <div id="tabContent2" class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home2a">
            <div class="box-bor MB20">
                <div role="tabpanel" id="tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home1" id="text-tabs" data-toggle="tab"
                                role="tab" aria-controls="tab1">
                                Thông tin</a></li>


                        <li role="presentation"><a href="#home4" id="text-tabs4" data-toggle="tab" role="tab"
                                aria-controls="tab4">Tài khoản</a></li>
                        <li role="presentation"><a href="#home5" onclick="myFuntion(0)" id="text-tabs5"
                                data-toggle="tab" role="tab" aria-controls="tab5">Thống kê</a></li>
                    </ul>


                    <div id="tabContent1" class="tab-content mobile_ch">
                        <div role="tabpanel" class="tab-pane fade in " id="home5" style="margin-top: 40px;">

                        </div>

                        <script type="text/javascript">
                        function myFuntion(id) {
                            if (id == 0) {
                                $.get("<?php echo base_url() ?>index.php/thong_ke", function(data) {
                                    $("#home5").html(data);
                                });
                            } else if(id==2)  {
                              
                               
                                $( "#nam") .change(function () { 
                                      var nam = $('#nam').val();
                                var thang = $('#thang').val();  
                                       $.get("<?php echo base_url() ?>index.php/thong_ke", {
                                    thang: thang,
                                    nam: nam
                                }, function(data) {
                                    $("#home5").html(data);

                                }); 

                            });

                             
                            }else{
                                
                                $( "#thang") .change(function () { 
                                      var nam = $('#nam').val();
                                var thang = $('#thang').val();  
                                       $.get("<?php echo base_url() ?>index.php/thong_ke", {
                                    thang: thang,
                                    nam: nam
                                }, function(data) {
                                    $("#home5").html(data);

                                }); 

                            });
                                
                            }

                        }
                        </script>




                        <div role="tabpanel" class="tab-pane fade in active" id="home1" style="margin-top: 40px;">

                            <div class="box-bor MB20 padding10px fz17" style="cursor:pointer"
                                onclick="window.location= '<?php echo base_url() ?>index.php/help' ">
                                <img class="img-setting" src="<?php echo base_url('images/1.jpg'); ?>">
                                &nbsp;&nbsp;&nbsp;Hướng dẫn sử dụng

                            </div>

                            <div class="box-bor MB20 padding10px fz17" style="cursor:pointer"
                                onclick="window.location= '<?php echo base_url() ?>index.php/info' ">
                                <img class="img-setting" src="<?php echo base_url('images/2.png'); ?>">
                                &nbsp;&nbsp;&nbsp;Giới thiệu STEMUP
                            </div>
                        </div>


                        <div role="tabpanel" class="tab-pane fade in" id="home4" style="margin-top: 40px;">

                            <form id="user_infomation">
                                <input type="text" name="uid" value="<?php echo $uid ?>" style="display:none">
                                <table class="table table-striped tbl-acc">
                                    <tbody>
                                        <tr>
                                            <td class="fw600 col-md-3 col-xs-4">Tên:</td>
                                            <td> <?php echo $first_name . ' ' . $last_name ?> </td>
                                        </tr>

                                        <tr>
                                            <td class="fw600">Ngày sinh:</td>
                                            <td id="dtbirthdate"> <?php echo $birthdate ?> </td>
                                            <td>
                                                <input type="text" name="birthdate" value="<?php echo $birthdate ?>"
                                                    id="bdt" placeholder="dd-mm-yyyy ví dụ :23-05-2018"
                                                    style="display:none">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="fw600">Lớp:</td>
                                            <td> <?php echo $grade - 2 ?> </td>
                                        </tr>

                                        <tr>
                                            <td class="fw600">Trường:</td>
                                            <td id="txtschool"> <?php echo $schools ?></td>
                                            <td>
                                                <div id="scl_change" style="display:none" class="col-md-12 col-xs-12">
                                                    <div class="col-md-4 col-xs-12">
                                                        <select class="form-control" name="scl_tinhthanh_id"
                                                            id="scl_tinhthanh_id" onchange="changeDataSchool(event);">
                                                            <option selected> ----Chọn tỉnh/ thành phố----</option>

                                                            <?php
foreach ($tinhthanh as $key => $val) {
    if ($val['did']) {
        ?>

                                                            <option value="<?php echo $val['did']; ?>">
                                                                <?php echo $val['dataitem_name']; ?></option>
                                                            <?php } else {?>

                                                            <option value="<?php echo $val['did']; ?>">
                                                                <?php echo $val['dataitem_name']; ?></option>
                                                            <?php }}?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-xs-12">
                                                        <select class="form-control" name="scl_quanhuyen_id"
                                                            id="scl_quanhuyen_id"
                                                            onchange="changeDataSchool1(event)"></select>
                                                    </div>
                                                    <div class="col-md-4 col-xs-12">
                                                        <select class="form-control" name="scl_school_id"
                                                            id="scl_school_id" onchange=""></select>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="fw600">Địa chỉ:</td>
                                            <td id="txtaddress"> <?php echo $address ?> </td>
                                            <td>
                                                <div id="address_change" style="display:none;"
                                                    class="col-md-12 col-xs-12">
                                                    <div class="col-md-4 col-xs-12">
                                                        <select class="form-control" name="tinhthanh_id"
                                                            id="tinhthanh_id" onchange="changeDataItem(event);">
                                                            <option> ----Chọn tỉnh/ thành phố----</option>
                                                            <?php
foreach ($dataitem_list as $key => $val) {
    if ($val['did'] == $tinhthanh_id) {
        ?>

                                                            <option value="<?php echo $val['did']; ?>" selected>
                                                                <?php echo $val['dataitem_name']; ?></option>
                                                            <?php } else {?>

                                                            <option value="<?php echo $val['did']; ?>">
                                                                <?php echo $val['dataitem_name']; ?></option>
                                                            <?php }}?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-xs-12">
                                                        <select class="form-control" name="quanhuyen_id"
                                                            id="quanhuyen_id"
                                                            onchange="changeDataItem(event);"></select>
                                                    </div>
                                                    <div class="col-md-4 col-xs-12">
                                                        <select class="form-control" name="xaphuong_id" id="xaphuong_id"
                                                            onchange="changeDataItem(event);"></select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="fw600">Email phụ huynh:</td>
                                            <td> <?php echo $email ?> </td>
                                        </tr>

                                        <tr>
                                            <td class="fw600">SĐT Phụ huynh:</td>
                                            <td id="nbphone"> <?php echo $phone ?> </td>
                                            <td>
                                                <input type="number" name="phone" value="<?php echo $phone ?>" id="uspn"
                                                    style="display:none"> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>

                            <div id="btn_inf">
                                <button class="btn btn-danger" id="btn_edt_inf"
                                    onclick="edit_info_stemup(<?php echo $tinhthanh_id . ',' . $quanhuyen_id . ',' . $xaphuong_id . ',' . $uid . ',' . $scl_tinhthanh_id . ',' . $scl_quanhuyen_id . ',' . $scl_school_id ?>)">Chỉnh
                                    sửa</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</aside>
<aside class="col-md-3 rightbar">

</aside>