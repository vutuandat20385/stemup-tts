<?php
$this->load->view('sadmin/head');
?>
<div class="wrapper">

  <?php $this->load->view('sadmin/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php $this->load->view('sadmin/leftmenu'); ?>
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>DANH SÁCH TÀI KHOẢN</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Bảng điều khiển</li>
        <li class="active">Danh sách tài khoản</li>
      </ol>
    </section>
    <!-- Main content -->
    <section id="table-contents" class="">

      <table class="table">
        <thead class="thead-light">
          <tr>
            <td scope="col" align="center"><b>#</b></td>
            <td scope="col"><b>Email</b></td>
            <td scope="col"><b>Tên người dùng</b></td>
            <td scope="col" align="center"><b>Số sao</b></td>
            <td scope="col" align="center"><b>Thao tác</b></td>
          </tr>
        </thead>
        <tbody>
         <?php 
         foreach ($get_parent_limit as $key => $value) {
           ?>
           <tr>
            <td align="center"><?php echo $value['uid'] ?></td>
            <td><?php echo $value['email'] ?></td>
            <td><?php echo $value['first_name'] ?></td>
            <td align="center"><?php echo $value['point'] ?></td>
            <td align="center" onclick="deleteUser(<?php echo $value['uid'] ?>)">
              <i class="fa fa-user-edit"></i>
              <i class="fa fa-user-times"></i>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <ul class="pagination" style="margin-left: 34%;margin-top: -1%;">
      <?php echo $links ?>
    </ul>
  </section>
</div>
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>

<script>
  function deleteUser(uid) {
    $.post('<?php echo base_url("index.php/sadmin/delete_user")?>',
        {
            uid: uid,
        }, 
        function (data) {
            $("#table-contents").html(data);
        }
    );
  }
</script>

<?php
$this->load->view('sadmin/foot');
?>