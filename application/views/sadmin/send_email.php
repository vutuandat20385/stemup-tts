<?php
  	$this->load->view('sadmin/head');
	  $this->load->model("sadmin_model");
?>

<style>
  table thead tr {
    background-color: #f8f8f8;
    border-bottom: 2px solid #d1d1d1;
  }

  table tbody tr {
    /* background-color: #f8f8f8; */
    border-bottom: 2px solid #d1d1d1;
  }
</style>
<script>
  var site_url = "<?php echo site_url() ?>";
  var base_url = "<?php echo base_url() ?>";
</script>
<link rel="stylesheet" href="<?php base_url(); ?>style/format.css">
<!-- Left side column. contains the logo and sidebar -->

<div class="wrapper">

  <aside class="main-sidebar">
    <?php $this->load->view('sadmin/leftmenu'); ?>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gửi Email
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Gửi Email</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Gửi Email</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail">Email gửi</label>
                <!--	<input type="text" id="inpquizname" name="quiz_name"  class="form-control" placeholder="<?php echo $this->lang->line('quiz_name');?>"  required autofocus> -->
                <select class="form-control" id="email_send">
                  <?php foreach($email_send as $es){
                    ?> <option value="<?php echo $es['id'] ?>"> <?php echo $es['email'] ?> </option> <?php
                  } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputEmail">Tiêu đề</label>
                	<input type="text" id="txtsubject" name="txtsubject"  class="form-control"  required> 
              </div>
              <div class="form-group">
                <label for="inputEmail">Nội dung email</label>
                <div class="form-group MT20">
                  <textarea name="ckeditor" class="ckeditor form-control" placeholder="Tạo câu hỏi trắc nghiệm"
                    id="editor1" rows="10" cols="80">
                  </textarea>
                </div>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" style="width:30%;float:right" placeholder="Tìm kiếm"
                  onkeyup="search_parent(this,event)" name=" txt_search_parent" id="txt_search_parent">
                <!-- <div id="error_n" style="color: red;"></div> -->
                <div class="input-group-btn">
                  <button class="btn btn-default" id="btn_search_parent" onclick="search_parent_btn()">
                    <i class="glyphicon glyphicon-search" id="glyphicon"></i>
                  </button>
                </div>
              </div>
              <br>
              <div class="form-group">
                <div class="panel panel-default" id="table_email">
                  <!-- Default panel contents -->
                  <!-- Table -->
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tên</th>
                        <th scope="col"><input type="checkbox" name="sample" class="selectall" value=""></th>
                      </tr>
                    </thead>
                    <tbody id="tbody_email">
                      <?php $i = 0;
                    foreach($email_parent as $ep){
                      ?>
                      <tr>
                        <th scope="row"><?php echo ++$i ?></th>
                        <td><?php echo $ep['email'] ?></td>
                        <td><?php echo $ep['username'] ?></td>
                        <td><input type="checkbox" name="sample[]" class="checkbox_email" id="email_<?php echo $ep['uid'] ?>" onclick="add_string(<?php echo $ep['uid'] ?>)" value="<?php echo $ep['uid'] ?>"></td>
                      </tr>
                      <?php
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
                <div id="footer_email">
                <p style="padding-top:5px">Đang xem <span id="beginqt">
                      <?php echo min($limit*$page+1,$number_email_parent);?></span>
                    đến <span id="endqt">
                      <?php echo min($limit*($page+1),$number_email_parent);?></span>
                    trong tổng số <span id="totalqt">
                      <?php echo $number_email_parent;?></span> câu hỏi</p>
                <center>
                  <ul class="pagination listpage pageqt">
                    <?php if($num_page>6){?>
                    <li class="page-item active" onclick="drawpage_send_email(0)"><a class="page-link">1</a></li>
                    <li class="page-item" onclick="drawpage_send_email(1)"><a class="page-link">2</a></li>
                    <li class="page-item" onclick="drawpage_send_email(2)"><a class="page-link">3</a></li>
                    <li class="page-item" onclick="drawpage_send_email(3)"><a class="page-link">4</a></li>
                    <li class="page-item" onclick="drawpage_send_email(4)"><a class="page-link">5</a></li>
                    <?php if($num_page>7){ ?>
                    <li class="page-item"><a class="page-link">...</a></li>
                    <?php } ?>
                    <li class="page-item" onclick="drawpage_send_email(<?php  echo $num_page-1 ?>)"><a
                        class="page-link">
                        <?php echo $num_page ?></a></li>
                    <?php }else{?>
                    <li class="page-item active" onclick="drawpage_send_email(0)"><a class="page-link">1</a></li>
                    <?php for($i=1; $i<$num_page; $i++){?>
                    <li class="page-item" onclick="drawpage_send_email(<?php  echo $i ?>)"><a class="page-link">
                        <?php  echo $i+1 ?></a></li>
                    <?php }?>
                    <?php }?>
                  </ul>
                </center>
                </div>
              </div>
              <div style="display:none">
                <!-- <input type="text" id="limit_parent" value="10"> -->
                <input type="text" id="search_parent" disabled value="">
                <input type="text" id="page_parent" disabled value="0">
                <input type="text" id="string_send" disabled value="">
              </div>
              <button class="btn btn-success" onclick="accept_send()" >Xác nhận</button>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php
  $this->load->view('sadmin/foot');
?>