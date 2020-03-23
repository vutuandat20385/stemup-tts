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
      <h1>
        Bảng điều khiển
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Bảng điều khiển</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="">
		<h1>DANH SÁCH TÀI KHOẢN</h1>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tên người dùng</th>
      <th scope="col">Email</th>
      <th scope="col">Số sao</th>
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  		foreach ($list_account as $key => $value) {
  	?>
    <tr>
      <th><?php echo $value['uid'] ?></th>
      <td><?php echo $value['first_name'] ?></td>
      <td><?php echo $value['email'] ?></td>
      <td><?php echo $value['starpoints'] ?></td>
      <td><i class="fas fa-user-edit"></i> <i class="fas fa-user-times"></i></td>
    </tr>
   <?php
     		}
   ?>
  </tbody>
</table>

    </section>
    <!-- /.content -->
  </div>
<?php
  $this->load->view('sadmin/foot');
?>