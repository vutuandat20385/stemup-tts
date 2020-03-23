  <?php
    $this->load->model("user_model");
    $this->load->model('sadmin_model');
    $user= $this->session->userdata('logged_in');
    $status = $this->sadmin_model->getFeedBackStatus();
  ?>

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('sadmin/admin_home') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>STEMUP</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    
    
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="status-bell">
            <span class="num">
              <a href="<?php echo site_url('sadmin/get_feedback')?>" class="notif">
                <span class="num"><?php echo $status?></span>
              </a>
            </span>
          </li>
          <li class="dropdown user user-menu">
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $user['photo'] ;?>" class="user-image img-circle" alt="User Image">
              <span class="hidden-xs"><?php echo $user['first_name']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $user['photo']?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user['email']?><br>
                  <small><?php echo $user['first_name']?></small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
<!--                 <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="<?php echo base_url()?>index.php/sadmin/logout" class="btn btn-default btn-flat">Logout</a>
                  
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
          </li>
        </ul>
      </div>
    </nav>
  </header>