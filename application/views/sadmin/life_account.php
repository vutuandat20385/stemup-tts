
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<title>Tài khoản trọn đời</title>
	<script>
		var base_url="<?php echo base_url();?>";
		var site_url="<?php echo site_url();?>";
		var su="<?php echo $su ?>";
	</script>
	<?php
	$this->load->view('sadmin/head');
	?>
	<div class="wrapper">
		<?php $this->load->view('sadmin/header'); ?>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<?php $this->load->view('sadmin/leftmenu') ?>
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Tài khoản trọn đời
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
					<li class="active">Tài khoản</li>
					<li class="active">Tài khoản trọn đời</li>
					

				</ol>
			</section>
			<!-- Main content -->
			<section class="row">

				<aside  class="col-md-12" >
				<!-- <div class="header line-L">
					<h1>Tài khoản trọn đời</h1>
				</div> -->
				<div class="div-filter col-md-12 col-sm-12 col-xs-12">
					<div class="input-group col-md-6 col-account-left ">
						<input type="text" name="account_signin" id="account_signin" placeholder="Nhập email đăng ký tài khoản" size="30" style="">						
						<button class="" id="add_life_account" style="">Thêm tài khoản</button>
					</div>
					<div class="input-group col-md-6 col-account-right ">
						<input type="text" name="life_account_search" id="life_account_search" placeholder="Tìm kiếm" size="30" style="">	
						<!-- <p id="log">456r76t87y</p>					 -->
					</div>
				</div>
				<div id="result">
					<table class="table">
						<thead class="thead-light">
							<tr>
								<td class="td_id col-md-1" align="center"><b>ID</b></td>
								<td class="td_content col-md-5"><b>Email</b></td>
								<td class="td_creater col-md-4"><b>Tên phụ huynh</b></td>
								<td class="td_createdate col-md-2" align="center"><b>Số sao</b></td>
							</tr>
						</thead>
						<?php
						foreach ($get_life_account as $value){
							?>
							<tr>
								<td class="td_id col-md-1" align="center"><?php echo $value['uid'];?></td>
								<td  class="td_content col-md-4"><?php echo $value['email'];?></td>
								<td  class="td_creater col-md-4"><?php echo $value['name'];?></td>
								<td  class="td_createdate col-md-3" align="center"><?php echo $value['point'];?></td>
							</tr>
							<?php
						}
						?>
					</table>
					<ul class="pagination" style="margin-left: 34%;margin-top: -1%;">
						<?php echo $links ?>
					</ul>
				</div>
			</aside>
		</section>
		<!-- /.content -->

	</div>


	<!-- /.content-wrapper -->
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Version</b> 2.4.0
		</div>
		<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
		reserved.
	</footer>


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
  <script>
  	$(document).ready(function(){
		// alert(1);
		$('#add_life_account').click(function(){
			var account_signin = document.getElementById("account_signin").value;
			// alert(account_signin);
			$.ajax({
				type: "POST",
				data: {account_signin:account_signin},
				url: base_url + "index.php/sadmin/add_life_account",
				success: function(results){
					$('#result').html(results);
					// $('#notify_n').html('q3aw4eyrfut');
					// console.log(arr_result['status']);
				}
			});

		});
	});
</script>


<script>
	$(document).ready(function(){

		let input = document.querySelector('#life_account_search');
    		// let log = document.getElementById('log');

    		input.oninput = handleInput;

    		function handleInput(e) {
    			string = input.value;
     			// console.log(string);
     			$.post('<?php echo base_url("index.php/sadmin/search_life_account_1")?>',{string:string},function (data) {
     				$('#result').html(data);
     			});
     		}

     	});
     </script>
 </main>
</body>
</html>
