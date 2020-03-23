<nav class="navbar navbar-stem navbar-fixed-top">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand navbar-brand1" href="<?php echo site_url('home_user') ?>">
                <img class="hidden-xs" src="<?php echo base_url('images/hu_logo_home1.png');?>" alt="">
                <img class="visible-xs-block logo-s" src="<?php echo base_url('images/hu_logo_home1.png');?>" height="32" alt="">
            </a>
            <div class="pull-right text-trang-mobile visible-xs-block">
                <!--<a class="text-trang hover" href="<?php echo site_url('message'); ?>">
					<i class="far fa-envelope"></i>
					<span class="badge badge-sm up bg-pink count mcount"></span>
				</a>-->

                <a class="text-trang hover" data-toggle="dropdown">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-sm up bg-pink count ncount"></span>
                </a>
                <a href="#" class="text-trang hover " data-toggle="collapse" data-target="#search_top" id="icosearch_top">
                    <i class="fas fa-search"></i>
                </a>

            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="panel-collapse collapse" id="search_top">
            <form class="navbar-form navbar-left" role="search">
                <div class="input-group">
                    <input id="inpsearch_top"  class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
                    <a  class="input-group-addon addon-TK1  searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
                </div>
            </form>
        </div>
        <div class="panel-collapse" id="search_top_dt">
            <form class="navbar-form navbar-left" role="search">
                <div class="input-group">
                    <input id="inpsearch_top_dt"  onkeyup="search_question(this, event)" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
                    <a  class="input-group-addon addon-TK1 pointer searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
                </div>
            </form>
        </div>
        <div class="collapse navbar-collapse" id="defaultNavbar1">

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user'); ?>"><i class="mr-5 fas fa-home"></i><br class="hidden-xs">Trang chủ</a>
                </li>
                <li>
                    <a class="text-trang hover text-center text-l" href="<?php  echo site_url('home_user/assign_quiz')?>"><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
                </li>
                <li>
                    <a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/results'); ?>" ><i class="mr-5 far fa-chart-bar"></i><br class="hidden-xs">Kết quả</a>
                </li>
                <li>
                    <a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>"><i class="mr-5 fas fa-cloud"></i><br class="hidden-xs">Thư viện</a>
                </li>
                <!--<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('message'); ?>"><i class="far fa-envelope"></i><span class="badge badge-sm up bg-pink count mcount"></span><br  class="hidden-xs">Tin nhắn</a>
			</li>-->
                <li class="dropdown ndropdown pointer">
                    <a class="text-trang hover text-center text-l" data-toggle="dropdown">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-sm up bg-pink count ncount mr-5"></span>
                        <br  class="hidden-xs">Thông báo
                    </a>
                    <div  class="dropdown-menu" id="notifications">
                        <!-- <h3>Notifications</h3> -->
                        <header class="dropdown__header fx-lt">
                            <div class="dropdown__title fx mr10">
	                    	<span translate="">
	                    		<span>Thông báo</span>
	                    	</span>
                            </div>
                            <a class="dropdown__setting">
                                <i class="udi fas fa-cog"></i>
                            </a>
                        </header>
                        <div class="notification__list">
                        </div>
                        <div class="dropdown__footer">
                            <a class="link--dropdown-footer link--see-all" href="<?php echo site_url('home_user/notifications') ?>">
                                Xem tất cả
                                <i class="mr10 fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <?php if($su==6){?>
                    <li>
                        <a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/moderate_question'); ?>"  ><i class="fas fa-check-circle"></i><span class="badge badge-sm up bg-pink count modcount"></span><br  class="hidden-xs">Kiểm duyệt</a>
                    </li>
                <?php } ?>
                <li class="dropdown"><a href="#" class="dropdown-toggle bt-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php if($link_photo) { ?>
                            <img id="avt" class=" img-circle MR5" src="<?php echo $link_photo;?> " alt="" width="32">
                        <?php } else{ ?>
                            <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="32">
                        <?php } ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu1">
                        <!-- <li><a href="#"><i class="MR10 far fa-file-alt text-primary" aria-hidden="true"></i>Bảng tin</a></li>
                         <li><a href="#"><i class="MR10 far fa-comments text-danger" aria-hidden="true"></i>Tin nhắn</a></li>
                         <li><a href="#"><i class="MR10 fas fa-th-large text-success" aria-hidden="true"></i>Khóa học</a></li>
                         <li><a href="#"><i class="MR10 fas fa-calendar text-danger" aria-hidden="true"></i>Sự kiện</a></li>
                         <li><a href="#"><i class="MR10 fas fa-users text-info" aria-hidden="true"></i>Nhóm</a></li>
                         <li><a href="#"><i class="MR10 fa fa-address-book text-warning" aria-hidden="true"></i>Dánh sách bạn bè</a></li> -->
                        <li><a data-toggle="modal" data-target="#transferModal" href="#"><i class="MR10 fas fa-exchange-alt text-warning" aria-hidden="true"></i>Chuyển điểm</a></li>
                        <li><a href="<?php echo site_url('profile')?>"><i class="MR10 fas fa-user text-success" aria-hidden="true"></i>Thông tin cá nhân</a></li>
                        <li><a data-toggle="modal" data-target="#changepwdModal" href="#"><i class="MR10 fas fa-cog" aria-hidden="true"></i>Đổi mật khẩu</a></li>
                        <li><a href="<?php echo site_url('user/logout');?>"><i class="MR10 fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                    </ul>
                </li>
                <!-- <li>
                <a class="text-trang hover text-center text-TV" href="#">Mời thành viên</a>
            </li> -->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
    <section class="visible-xs-block nav-mobile">
        <ul class="ul-mobile list-unstyled">
            <li class="mbqmn"><a data-toggle="collapse" href="#">Trắc nghiệm</a></li>
            <?php if($su!=4){?>
                <li class="mbclmn"><a  data-toggle="collapse" href="#">Lớp</a></li>
                <li class="mbgrmn"><a  data-toggle="collapse" href="#">Nhóm</a></li>
            <?php } else{?>
                <li class="mbgrmn"><a  data-toggle="collapse" href="#">Con</a></li>
            <?php }?>
            <li><a >Hướng dẫn</a></li>

        </ul>

        <ul id="tnmncl" class="panel-collapse collapse">

            <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
            <?php if($su==1||$su==3||$su==6){?>
                <a href="<?php echo site_url('home_user/create_question'); ?>" class="list-group-item createQuestionItem"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
                <?php if($su!=6){?>
                    <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
                <?php } else {?>
                    <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
                <?php } ?>
                <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item"> <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
            <?php }?>
            <?php if($su==2){?>
                <!--<a href="<?php echo site_url('home_user');?>#gocthutai" class="list-group-item" onclick="gocthutai(event);"> <i class="fas fa-flag-checkered" style="margin-right:5px"></i> Góc thử tài</a>-->
            <?php }?>

            <a href="<?php echo site_url('home_user/quiz_list');?>" class="list-group-item" > <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>

            <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item" > <i class="fas fa-bullhorn" style="margin-right:5px"></i> <?php if($su!=2) echo 'Bài đã giao'; else echo 'Bài được giao'; ?></a>
            <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
            <?php if($su==6){?>
                <a href="<?php echo site_url('home_user/moderate_question'); ?>" class="list-group-item"> <i class="fas fa-check-circle" style="margin-right:5px"></i> Kiểm duyệt</a>
            <?php } ?>
            <?php if($su==1) {?>
                <a href="<?php echo site_url('library/insert_video'); ?>" class="list-group-item"> <i class="fas fa-video" style="margin-right:5px"></i> Thêm video</a>
            <?php } ?>
        </ul>

        <ul id="clmncl" class="panel-collapse collapse">
            <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
            <?php if($su==1||$su==3||$su==6){?>
                <a href="<?php echo site_url('home_user/manage_class'); ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Quản lý lớp</a>
                <a href="<?php echo site_url('home_user');?>#create_class" class="list-group-item" onclick="create_class(event);"> <i class="fab fa-dropbox" style="margin-right:5px"></i> Tạo một lớp</a>
            <?php }?>
            <?php if($su==2){?>
                <a href="<?php echo site_url('home_user/manage_class'); ?>" class="list-group-item" > <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
                <a data-toggle="modal" data-target="#joinClassModal" class="list-group-item"> <i class="fas fa-handshake" style="margin-right:5px"></i>  Tham gia lớp</a>
            <?php }?>
        </ul>

        <ul id="grmncl" class="panel-collapse collapse">
            <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>

            <a href="<?php echo site_url('home_user/manage_group') ?>" class="list-group-item"> <i class="fas fa-object-group" style="margin-right:5px"></i> Quản lý nhóm</a>
            <a href="<?php echo site_url('home_user/create_group') ?>" class="list-group-item"> <i class="fas fa-folder-open" style="margin-right:5px"></i> Tạo một nhóm</a>
            <a data-toggle="modal" data-target="#joinGroupModal"  class="list-group-item"> <i class="far fa-handshake" style="margin-right:5px"></i> Tham gia nhóm</a>


            <?php if($su==4){?>
                <?php foreach($child_list as $k=>$child) { ?>
                    <!--<a href="<?php echo site_url('home_user/child_activities/'.$child['uid']); ?>" class="list-group-item">-->
                    <a href="#" class="list-group-item">
                        <?php echo $child['first_name'].' '.$child['last_name'] ; ?>
                    </a>
                <?php } ?>

                <a data-toggle="modal" data-target="#addstudentModal" class="list-group-item"><i class="far fa-plus-square" style="margin-right:5px"></i>  Thêm con</a>
                <a data-toggle="modal" data-target="#createchildModal" class="list-group-item"><i class="far fa-plus-square" style="margin-right:5px"></i> Tạo tài khoản cho con</a>
            <?php }?>
            <?php if($su!=4){?>
                <a href="#" class="list-group-item"> <i class="far fa-handshake" style="margin-right:5px"></i> Tham gia nhóm</a>
            <?php }?>
        </ul>

    </section>
</nav><!--end nav-->