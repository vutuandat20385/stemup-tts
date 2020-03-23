<div class="box-bor MB20 visible-xs-block">
    <div class="media-object-default">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <?php if($link_photo) { ?>
                        <img class="media-object img-thumbnail" src="<?php echo $link_photo;?> " width="80" alt="placeholder image">
                    <?php } else{ ?>
                        <img class="media-object img-thumbnail" src="<?php echo base_url('upload/avatar/default.png');?>" width="80" alt="placeholder image">
                    <?php } ?>

                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><a href="#" class="border-B1"><?php echo $user_name; ?><br><span class="text-small1">
					   <?php if($su==3){?> Giáo viên <?php }?>
                            <?php if($su==1){?> Admin  <?php }?>
                            <?php if($su==8){?> Tổ chức  <?php }?>
					 </span></h4>
                <div class="box-diem-mobile">
                    <p class="text-diem1"><span class="text-diem"><?php echo $user_point." Sao" ?></span></p>
                </div>
            </div>


        </div>
    </div>
</div>
<div class="box-bor MB20 hidden-xs">
    <div class="text-center mb-10">
        <?php if($link_photo) { ?>
            <img class="MR5 img-thumbnail mb-10" src="<?php echo $link_photo;?>" alt="">
        <?php } else{ ?>
            <img class="MR5 img-thumbnail mb-10" src="<?php echo base_url('upload/avatar/default.png');?>" alt="">
        <?php } ?>

        <br>
        <a href="#" class="border-B1" style="font-size: 16px"><?php echo $user_name; ?> <br></a> <span class="text-small">(<?php if($su==3){?>Giáo viên<?php }?><?php if($su==1){?>Admin<?php }?><?php if($su==8){?>Tổ chức<?php }?>)</span>
    </div>

    <div class="box-diem">
        <p class="text-diem1"><span class="text-diem"><?php echo $user_point." Sao" ?></span></p>
    </div>

</div>


<div class="list-group hidden-xs" id="top_menu">
    <div style="display:none;" id="topname">quiz_menu</div>
    <h3 class="list-group-item active1">Trắc nghiệm</h3>
    <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
    <a href="<?php echo site_url('home_user/create_question');?>" class="list-group-item createQuestionItem"><i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
    <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
    <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>

    <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item" > <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
    <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
    <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item"> <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
    <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
    <?php if($su==1) {?>
        <a href="<?php echo site_url('library/insert_video'); ?>" class="list-group-item"> <i class="fas fa-video" style="margin-right:5px"></i> Thêm video</a>
    <?php } ?>
</div>
<div class="list-group hidden-xs" id="quiz_menu" style="display:none;">
    <h3 class="list-group-item active1">Trắc nghiệm</h3>
    <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
    <a href="<?php echo site_url('home_user/create_question');?>" class="list-group-item createQuestionItem"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
    <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
    <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
    <!-- <a href="<?php echo site_url('comment_manage');?>" class="list-group-item"><i class="fas fa-comments" style="margin-right:5px"></i> Quản lý comment</a> -->
    <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item" > <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
    <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
    <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item" > <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
    <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
    <?php if($su==1) {?>
        <a href="<?php echo site_url('library/insert_video'); ?>" class="list-group-item"> <i class="fas fa-video" style="margin-right:5px"></i> Thêm video</a>
    <?php } ?>
</div>
<div class="list-group hidden-xs" id="class_menu">
    <h3 class="list-group-item active1">Lớp</h3>
    <!-- <a href="#" class="list-group-item">Tạo một nhóm nhỏ</a>-->
    <div id ="classpage_menu"></div>
    <a href="<?php echo site_url('home_user/manage_class') ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Quản lý lớp</a>
    <a href="#create_class" class="list-group-item" onclick="create_class(event);"> <i class="fab fa-dropbox" style="margin-right:5px"></i> Tạo một lớp</a>
    <!-- <a href="#" class="list-group-item">Tham gia lớp</a>-->
</div>
<div class="list-group hidden-xs" id="group_menu">
    <h3 class="list-group-item active1">Nhóm</h3>
    <a href="<?php echo site_url('home_user/manage_group') ?>" class="list-group-item"> <i class="fas fa-object-group" style="margin-right:5px"></i> Quản lý nhóm</a>
    <a href="<?php echo site_url('home_user/create_group') ?>" class="list-group-item"> <i class="fas fa-folder-open" style="margin-right:5px"></i> Tạo một nhóm</a>
    <a data-toggle="modal" data-target="#joinGroupModal"  class="list-group-item"> <i class="far fa-handshake" style="margin-right:5px"></i> Tham gia nhóm</a>
</div>
<div class="list-group hidden-xs" >
    <h3 class="list-group-item active1">Về chúng tôi</h3>
    <a href="<?php echo site_url('home/about1') ?>"  class="list-group-item"><i class="fas fa-bullseye" style="margin-right:5px"></i> Giới thiệu</a>
    <a href="<?php echo site_url('home/detail3') ?>"  class="list-group-item"><i class="fas fa-object-group" style="margin-right:5px"></i> Điều khoản sử dụng</a>
    <a href="<?php echo site_url('home/detail1') ?>"  class="list-group-item"><i class="fas fa-folder-open" style="margin-right:5px"></i> Hướng dẫn</a>
    <a href="<?php echo site_url('home/detail2/policy') ?>"  class="list-group-item"><i class="fa fa-window-restore" style="margin-right:5px"></i> Chính sách riêng tư</a>
</div>

<aside id="main_bussiness" class="" style="display:none" >
    <?php
    if($this->session->flashdata('message')){
        echo $this->session->flashdata('message');
    }
    if($this->session->flashdata('message2')){
        echo $this->session->flashdata('message2');
    }
    ?>
    <div class="box-lop" id="bannerpage">
        <div class="line-L">
            <h1>Lớp của <?php echo $user_name?></h1>
            <!--<p>Văn Long Thạch - Lớp 9 - Tiếng Anh </p>-->

        </div>
    </div>
    <div role="tabpanel">
        <ul class="nav nav-tabs MB20 bg-tab" role="tablist">
            <li role="presentation" class="active" style="display: none;"><a href="#home2a" data-toggle="tab" role="tab" aria-controls="tab1">Đăng bài</a></li>

        </ul>
        <div id="tabContent2" class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home2a">
                <div class="box-bor MB20">
                    <div role="tabpanel" id="tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">Tạo câu hỏi</a></li>
                            <li role="presentation"><a href="#home2" data-toggle="tab" role="tab" aria-controls="tab2" id="text-tabs2" style="display:none">Ghi chú</a></li>

                        </ul>
                        <div id="tabContent1" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home1">
                                <form method="post" action="<?php echo site_url('qbank/new_question_1/4/0')?>">
                                    <div class="form-group MT20">
                                        <textarea class="form-control"   id= "question" rows="3" name="question" placeholder="Tạo câu hỏi trắc nghiệm" ></textarea>
                                    </div>

                                    <div class="form-group MT20">
                                        <input class="form-control" id= "bgqid" rows="3" name="bgqid" value="0" style="display:none;">
                                    </div>
                                    <div id="bg_template"class="form-group MT20" style="margin-bottom:20px">
                                        <table>
                                            <tr>
                                                <td>Chọn màu nền  </td>
                                                <?php for($i=0 ; $i<20; $i++){?>
                                                    <td class="tranbtsbg"  style="opacity: 1; transform: translateX(<?php echo 30*$i ?>px);">
                                                        <a id="bgq<?php echo $i+1 ?>">
                                                            <img src="<?php echo base_url('upload/background/'.($i+1).'.jpg')?>" class="imgbgrbt" >
                                                        </a>
                                                    </td>
                                                <?php }?>

                                            <tr>
                                        </table>
                                    </div>
                                    <div class="row MB20" id="answer-area-1">
                                        <div class="col-xs-6">
                                            <label class="radio-inline w-100">

                                                <input class="MT10" type="radio" name="score" value='0'>
                                                <div class="input-group">
                                                    <span class="input-group-addon">A</span>
                                                    <input id="optA1" type="text" class="form-control" name="option[]"  value="" placeholder="Điền phương án A" required />
                                                </div>

                                            </label>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="radio-inline w-100">

                                                <input class="MT10" type="radio" name="score" value='1' >
                                                <div class="input-group">
                                                    <span class="input-group-addon">B</span>
                                                    <input id="optB1" type="text" class="form-control" name="option[]" value="" placeholder="Điền phương án B" required />
                                                </div>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="row" id="answer-area-2">
                                        <div class="col-xs-6">
                                            <label class="radio-inline w-100">

                                                <input class="MT10" type="radio" name="score" value='2'>
                                                <div class="input-group">
                                                    <span class="input-group-addon">C</span>
                                                    <input id="optC1" type="text" class="form-control" name="option[]" value="" placeholder="Điền phương án C" required />
                                                </div>

                                            </label>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="radio-inline w-100">

                                                <input class="MT10" type="radio" name="score" value='3'>
                                                <div class="input-group">
                                                    <span class="input-group-addon">D</span>
                                                    <input id="optD1" type="text" class="form-control" name="option[]"value="" placeholder="Điền phương án D" required />
                                                </div>

                                            </label>
                                        </div>
                                    </div>
                                    <div><p class="text-center MT10 text-do" id="support">Chọn câu trả lời đúng trước khi lưu</p></div>
                                    <div class="text-center" id="btarea">
                                        <button id="savebt" type="button" class="btn btn-primary" disabled style="display:none;">Lưu</button>
                                        <button id="cancelbt" type="button" class="btn btn-default" onclick='cancel_question()'>Hủy</button>
                                    </div>

                                    <script>

                                        var checksim=true;
                                        var similar=false;
                                        $("#optA1,#optB1,#optC1,#optD1").on('click',function(e){

                                            content =tinyMCE.get('question').getContent().trim();
                                            while(content.indexOf("<p>")>-1)
                                                content =content.replace("<p>"," ").replace("</p>"," ");
                                            while(content.indexOf("<strong>")>-1)
                                                content =content.replace("<strong>"," ").replace("</strong>"," ");
                                            while(content.indexOf("<em>")>-1)
                                                content =content.replace("<em>"," ").replace("</em>"," ");
                                            while(content.indexOf("<br/>")>-1)
                                                content =content.replace("<br/>"," ");
                                            while(content.indexOf("<br />")>-1)
                                                content =content.replace("<br />"," ");
                                            while(content.indexOf("?")>-1)
                                                content =content.replace("?"," ");
                                            while(content.indexOf(".")>-1)
                                                content =content.replace("."," ");
                                            while(content.indexOf(":")>-1)
                                                content =content.replace(":"," ");
                                            while(content.indexOf("&nbsp;")>-1)
                                                content =content.replace("&nbsp;"," ");
                                            while(content.indexOf("\t")>-1)
                                                content =content.replace("\t"," ");
                                            while(content.indexOf("\r")>-1)
                                                content =content.replace("\r"," ");
                                            while(content.indexOf("  ")>-1)
                                                content =content.replace("  "," ");
                                            console.log(content);
                                            sim(content.trim(),200);

                                        });
                                        $("[name=score]").on('change',function(e){

                                            content =tinyMCE.get('question').getContent();
                                            while(content.indexOf("<p>")>-1)
                                                content =content.replace("<p>"," ").replace("</p>"," ");
                                            while(content.indexOf("<strong>")>-1)
                                                content =content.replace("<strong>"," ").replace("</strong>"," ");
                                            while(content.indexOf("<em>")>-1)
                                                content =content.replace("<em>"," ").replace("</em>"," ");
                                            while(content.indexOf("<br/>")>-1)
                                                content =content.replace("<br/>"," ");
                                            while(content.indexOf("<br />")>-1)
                                                content =content.replace("<br />"," ");
                                            while(content.indexOf("?")>-1)
                                                content =content.replace("?"," ");
                                            while(content.indexOf(".")>-1)
                                                content =content.replace("."," ");
                                            while(content.indexOf(":")>-1)
                                                content =content.replace(":"," ");
                                            while(content.indexOf("&nbsp;")>-1)
                                                content =content.replace("&nbsp;"," ");
                                            while(content.indexOf("\t")>-1)
                                                content =content.replace("\t"," ");
                                            while(content.indexOf("\r")>-1)
                                                content =content.replace("\r"," ");
                                            while(content.indexOf("  ")>-1)
                                                content =content.replace("  "," ");
                                            $("#savebt").prop('disabled', false);
                                            sim(content.trim(),200);

                                        });


                                        var html = '<div id="optionarea" style="margin-top:20px">';
                                        html+='<div class="col-md-3" style="margin-top:20px">Chọn là MCQ Fun</div>';
                                        html+='<div class="col-md-9" style="margin-top:20px"> <input id="mcqfun" name="mcqfun" value="0" type="checkbox"></div>';
                                        html+='<div class="col-md-3" style="margin-top:20px">Chọn môn học <span style="color:red">(*)</span>:</div>';
                                        html+='<div class="col-md-9" style="margin-top:20px" ><select class="form-control col-md-9" name="cid" required><option value="">-------Chọn môn học--------</option><?php foreach($category_list as $key => $val){ ?>  <option value="<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option><?php }?></select></div>';
                                        html+='<div class="col-md-3" style="margin-top:20px" > Chọn lớp <span style="color:red">(*)</span>:</div>';
                                        html+='<div class="col-md-9" style="margin-top:20px"><select class="form-control" name="lid" required> <option value="">-------Chọn lớp -------------</option> <?php foreach($level_list as $key => $val){?> <option value="<?php echo $val['lid'];?>"><?php echo $val['level_name'];?></option><?php }?></select></div>';
                                        html+='<div class="col-md-3" style="margin-top:20px">Giải thích </span>:</div>';
                                        html+='<div class="col-md-9" style="margin-top:20px"><textarea  id="descr1" name="description"  class="form-control" ></textarea></div>';
                                        html+='<div class="col-md-3" style="margin-top:20px">Từ khóa <span style="color:red">(*)</span>:</div>';
                                        html+='<div class="col-md-9" style="margin-top:20px"><input type="text" class="form-control" style="margin-bottom:20px" name="tags" value="" required></div>';
                                        html+='<div class="col-md-3" style="margin-top:20px">Thời gian làm bài:(tính bằng giây) <span style="color:red">(*)</span></div>';
                                        html+='<div class="col-md-9" style="margin-top:20px"><input type="number" class="form-control" style="margin-bottom:20px" name="answer_time" value="60" min="0" required></div>';
                                        html+='</div>';
                                        html+='<div><p class="text-center MT10 text-do" id="support">Từ khóa: liên kết các câu hỏi liên quan đến nhau. Một câu hỏi có thể nhiều từ khóa.</p></div>';
                                        html+='<div><p class="text-center MT10 text-do" id="support">Lưu ý: các từ khóa cách nhau bởi dấu phẩy (,) </p></div>';
                                        html+='<div><p class="text-center MT10 text-do" id="support">(*): Thông tin bắt buộc </p></div>';

                                        document.getElementById("savebt").onclick = function () {


                                            $("#btarea").prev().prepend(html);
                                            $("#mcqfun").on('change', function(){
                                                mfp=parseInt($(this).val());
                                                $(this).val(1-mfp);
                                                console.log($(this).val());

                                            })
                                            $('#savebt').remove();
                                            $('#cancelbt').parent().prepend('<button type="submit" class="btn btn-primary">Lưu</button>');

                                        }
                                    </script>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="home2">
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tabDropDownOne1">
                                <p>Dropdown content#1</p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tabDropDownTwo2">
                                <p>Dropdown content#2 </p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</aside>