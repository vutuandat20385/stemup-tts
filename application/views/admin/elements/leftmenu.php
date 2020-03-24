<div class="sidebar">
    <ul class="widget widget-menu unstyled">
        <li class="active"><a href="<?php echo base_url('index.php/admin/index');?>"><i class="menu-icon icon-dashboard"></i>Bảng tổng hợp</a></li>
        <li><a href="<?php echo base_url('index.php/admin/news');?>"><i class="menu-icon icon-bullhorn"></i> Thêm tin mới </a></li>
        <li><a href="<?php echo base_url('index.php/admin/manage_homepage_news');?>"><i class="menu-icon icon-inbox"></i> Tin trang chủ </a></li>
        <li><a href="<?php echo base_url('index.php/admin/manage_news');?>"><i class="menu-icon icon-tasks"></i> Danh sách tin <b class="label orange pull-right"><?php echo $num_news; ?></b> </a></li>
    </ul>
    <!--/.widget-nav-->
    <ul class="widget widget-menu unstyled">
        <li><a href="<?php echo site_url('admin/add_question')?>"><i class="menu-icon icon-bold"></i> Thêm câu hỏi </a></li>
        <li><a href="<?php echo site_url('admin/manage_qbank')?>"><i class="menu-icon icon-book"></i> Danh sách câu hỏi </a></li>
        <li><a href="<?php echo site_url("admin/create_quiz") ?>"><i class="menu-icon icon-paste"></i>Thêm bài trắc nghiệm </a></li>
        <li><a href="<?php echo site_url('admin/quiz_list');?>"><i class="menu-icon icon-table"></i>Danh sách bài trắc nghiệm </a></li>
    </ul>
    <ul class="widget widget-menu unstyled">
        <li><a href="<?php echo base_url('index.php/admin/video');?>"><i class="menu-icon icon-book"></i> Danh sách Video </a></li>
        <li><a href="<?php echo base_url('index.php/admin/add_video');?>"><i class="menu-icon icon-book"></i> Thêm mới Video </a></li>
    </ul>

    <ul class="widget widget-menu unstyled">
        <li><a href="<?php echo base_url('index.php/admin/excel');?>"><i class="icon-inbox"></i>Xuất/Nhập file Câu hỏi trắc nghiệm </a></li>
        <li><a href="<?php echo base_url('index.php/admin/thongke');?>"><i class="icon-inbox"></i>Thống kê đã làm </a></li>
    </ul>

    <ul class="widget widget-menu unstyled">
        <li><a href="<?php echo base_url('index.php/admin/thong_ke_user');?>"><i class="icon-inbox"></i>Thống kê đăng ký</a></li>
        <li><a href="<?php echo base_url('index.php/admin/get_feedback'); ?>"><i class="menu-icon icon-bold"></i> Phản hồi của người dùng </a></li>
    </ul>
    <!--/.widget-nav-->
    <ul class="widget widget-menu unstyled">
        <li><a href="<?php echo base_url('index.php/admin/logout'); ?>"><i class="menu-icon icon-signout"></i>Đăng xuất </a></li>
    </ul>
</div>