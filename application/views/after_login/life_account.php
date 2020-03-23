
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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

				<aside  class="col-md-10" >
				<!-- <div class="header line-L">
					<h1>Tài khoản trọn đời</h1>
				</div> -->
				<div class="div-filter row">
					<div class="input-group mb-3 col-md-5 col-left ">

						<input type="text" name="account_signin" id="account_signin" placeholder="Nhập email đăng ký tài khoản" size="30" style="margin-left: 8%">
						
						<button class="btn btn-primary" id="add_life_account" style="margin-left: 5%;margin-bottom: 1%;">Thêm tài khoản</button>
					</div>
					<div class="input-group mb-3 col-md-12 col-right " style="left: 94%;margin-bottom: 1%;margin-top: -3%;">

						<input type="text" name="life_account_search" id="life_account_search" placeholder="Tìm kiếm theo email" size="30" style="margin-top: -30px">
						
					</div>
				</div>
				<div id="result" style="width: 121%">
					<table class="table">
						<thead class="thead-dark" style="background: #76bd7f">
							<tr>
								<td class="td_id col-md-1" align="center"><b>ID</b></td>
								<td class="td_content col-md-5"><b>Email</b></td>
								<td class="td_creater col-md-4"><b>Tên phụ huynh</b></td>
								<td class="td_createdate col-md-2" align="center"><b>Số sao</b></td>
							</tr>
						</thead>
						<?php
						foreach ($arr_result as $value){
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
							console.log(arr_result['status']);
						}
					});
					
				});
			});

		</script>

		<script>
			$(document).ready(function(){
				$('#life_account_search').keypress(function(event){
					// alert(1);
					var keycode = (event.keyCode ? event.keyCode : event.which);
					if (keycode == '13') {
						var string = $('#life_account_search').val();
						// alert(string);
                		//alert('<?php //echo base_url("index.php/comment_manage/search")?>//');
                		$.post('<?php echo base_url("index.php/sadmin/search_life_account")?>',{string:string},function (data) {
                			$('#result').html(data);
                		});
                	}
                });
			});
		</script>
	</main>
</body>

</html>
