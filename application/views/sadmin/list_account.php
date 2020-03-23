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
    <section class="row">
      <aside  class="col-md-12" >
        <div class="div-filter col-md-12 col-sm-12 col-xs-12">
          <div class="input-group col-md-9 col-account-left ">
            <h2>DANH SÁCH TÀI KHOẢN</h2>
          </div>
          <div class="input-group col-md-3 col-account-right " style=" margin-top: 15px;">
            <input type="text" name="life_account_search" id="life_account_search" placeholder="Tìm kiếm theo email hoặc tên" size="30" style="width: 86%">    
            <!-- <p id="log">456r76t87y</p>                  -->
          </div>
        </div>
        <!-- Main content -->
        <div id="table-contents" class="">

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
      </div>
    </aside>
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

<script>
    $(document).ready(function(){

        let input = document.querySelector('#life_account_search');
        // let log = document.getElementById('log');
        input.oninput = handleInput;
        function handleInput(e) {
            string = input.value;
            // console.log(string);
            $.post('<?php echo base_url("index.php/sadmin/list_account_search")?>',{string:string},function (data) {
                $('#table-contents').html(data);
            });
        }

    });
</script>