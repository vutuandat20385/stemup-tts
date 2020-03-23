<?php
$this->load->model("user_model");
$user= $this->session->userdata('logged_in');
$this->load->model('sadmin_model');
$add_count = $this->sadmin_model->add_count();
$count = $this->sadmin_model->count(); 
?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo $user['photo'] ;?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo $user['first_name']; ?></p>
    </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU CHÍNH</li>
    <li class="active treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Bảng điều khiển</span>
      </a>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-files-o"></i>
        <span>Tài khoản
          <span class="pull-right-container">
            <small class="label pull-right bg-yellow">
              <?php echo $add_count;?>
            </small>
            
            <small class="label pull-right bg-green">
              <?php echo $count;?>
            </small>
          </span>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo site_url('sadmin/list_account');?>"><i class="fa fa-circle-o"></i>Danh sách tài khoản
          <span class="pull-right-container">
            <span class="label pull-right bg-yellow">
             <?php echo $add_count; ?>
            </span>
          </span>
        </a></li>
        <li><a href="<?php echo site_url('sadmin/life_account');?>"><i class="fa fa-circle-o"></i>Tài khoản trọn đời
          <span class="pull-right-container">
            <span class="label pull-right bg-green">
              <?php echo $count; ?>
            </span>
          </span>
        </a></li>
      </ul>
    </li>
    <li>
      <a href="video">
        <i class="fa fa-th"></i> <span>Thư viện Video</span>
      </a>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Quản lý câu hỏi</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo site_url('sadmin/statistic');?>"><i class="fa fa-circle-o"></i>Thống kê câu hỏi</a></li>
        <li><a href="manage_qbank"><i class="fa fa-circle-o"></i>Danh sách câu hỏi</a></li>
        <li><a href="<?php echo site_url('sadmin/add_question')?>"><i class="fa fa-circle-o"></i>Tạo câu hỏi</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>Bài kiểm tra</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="quiz_list"><i class="fa fa-circle-o"></i>Danh sách bài kiểm tra</a></li>
        <li><a href="<?php echo site_url("sadmin/create_quiz") ?>"><i class="fa fa-circle-o"></i>Tạo bài kiểm tra</a></li>
      </ul>
    </li>
     <li class="treeview">
      <a href="#">
        <i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Quản lý Tin tức</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo site_url('sadmin/news');?>"><i class="fa fa-circle-o"></i>Thêm tin mới</a></li>
        <!-- <li><a href="<?php //echo site_url('sadmin')?>"><i class="fa fa-circle-o"></i>Danh sách tin tức</a></li> -->
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-edit"></i> <span>Quản lý Feedback</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <!-- <li><a href="<?php //echo site_url('sadmin/manage_comment');?>"><i class="fa fa-circle-o"></i>Đánh giá câu hỏi</a></li> -->
        <li><a href="<?php echo site_url('sadmin/get_feedback')?>"><i class="fa fa-circle-o"></i>Feedback sử dụng phần mềm</a></li>
      </ul>
    </li>
<!--     <li class="treeview">
      <a href="#">
        <i class="fa fa-table"></i> <span>Import dữ liệu Excel</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-circle-o"></i> Import</a></li>
        <li><a href="#"><i class="fa fa-circle-o"></i> Cấu hình</a></li>
      </ul>
    </li> -->
    
<!--     <li>
      <a href="#">
        <i class="fa fa-envelope treeview-menu"></i> <span>Gửi Email</span>
      </a>
        <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Email 1</a></li>
        <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Email 2</a></li>
        <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Email 3</a></li>
    </li> -->
    
 
  </ul>
</section>
    <!-- /.sidebar -->