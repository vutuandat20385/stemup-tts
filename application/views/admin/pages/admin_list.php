<script>
	var base_url = "<?php echo base_url(); ?>";
	var site_url = "<?php echo site_url(); ?>";
	var su = "<?php echo $su ?>";
	var id_mcq_fun = "";
	var id_quiz_fun = "";
</script>
<script src="<?php echo base_url('js/jquery.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>


<link href="<?php echo base_url('font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">


<script src="<?php echo base_url('js/Chart.bundle.min.js'); ?>"></script>


<link rel="manifest" href="<?php echo base_url('js/manifest.json'); ?>">
<script src="<?php echo base_url('js/admin/manage_user.js'); ?> "></script>
<script src="<?php echo base_url('js/moderate_question.js'); ?> "></script>
<style>
	.pointer {
		cursor: pointer;
	}

	;

	.nav.nav-tabs.MB20.bg-tab {
		display: none;
	}
</style>
		<aside class="col-md-12">
			<?php
			if ($this->session->flashdata('message')) {
				echo $this->session->flashdata('message');
			}
			if ($this->session->flashdata('message2')) {
				echo $this->session->flashdata('message2');
			} ?>
			<!--<div class="box-lop" id="bannerpage">
					<div class="line-L">
						<h1>Trắc nghiệm</h1>			 
					</div>
				</div>-->


			<div id="tabContent2" class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="home2a">
					<div class="box-bor MB20">
						<div role="tabpanel" id="tabs">
							<div id="tabContent1" class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="home1">
									<div class="data_mngq">
										<table class="table table-bordered" style="background: #fff;">
											<tr style="background-color: rgb(233, 235, 238);">
												<th>
													#
												</th>
												<th style="width: 50%;">
													Email <span>
														<select style="float:right" onchange="drawlimit_mng_user(this)">

															<option value="15" selected>15 mục</option>
															<option value="20">20 mục</option>
															<option value="25">25 mục</option>
														</select>
													</span>
												</th>
												<th>
													Tên người dùng
												</th>
												<th>
													<select style="width:85%" onchange="drawct_mng_user(this)">
														<option>Danh mục</option>
														<option value="0">Tất cả</option>
														<option value="1">Admin</option>
														<option value="10">Cộng tác viên</option>
													</select>
												</th>
												<th>
													<input id="search_mng_user" style="width:65%;margin-left: 15%" onkeyup="drawsearch_mng_user(this,event)">
													<i class="pointer fa fa-search" onclick="drawsearch_mng_user_btn()"></i>
												</th>

											</tr>

											<?php foreach ($user as $q) { ?>
												<tr id="ques_<?php echo $q['uid'] ?>">
													<td>
														<?php echo $q['uid']; ?>
													</td>
													<td>
														<b>
															<a class="pointer" onclick="mng_preview_user(<?php echo $q['uid'] ?>)">
																<?php echo $q['email']; ?>
															</a>
														</b>
													</td>
													<td>
														<?php echo $q['first_name']; ?>
													</td>
													<td>
														<a class="pointer" onclick="drawct_mng_user_link(<?php echo $q['uid'] ?>)">
															<?php if ($q['su'] == 1) {
																echo 'Admin';
															}
															if ($q['su'] == 10) {
																echo 'Cộng tác viên';
															} ?>
														</a>
													</td>
													<td class="col-xs-1.5">
														<a onclick="mdr_preview_user(<?php echo $q['uid'] ?>)"><i class="pointer text-success fa fa-eye" style="margin-left: 15%;" title="Xem trước"></i></a>



														<a onclick="mng_edit_question(<?php echo $q['uid'] ?>)"><i class="pointer text-warning fa fa-pencil" title="Sửa" style="color: #ef00ff;margin-left: 20%;"></i></a>


														<a><i class="pointer fa fa-remove" style="margin-left: 20%;" onclick="delete_question_(<?php echo $q['uid'] ?>)" title="Xóa"></i></a>
													</td>

												</tr>
											<?php } ?>

										</table>
									</div>
									<p style="margin-top: 10px;">Đang xem <span id="beginuser"><?php echo min($limit * $page + 1, $num_user); ?></span>
										đến <span id="enduser"><?php echo min($limit * ($page + 1), $num_user); ?></span>
										trong tổng số <span id="totaluser"><?php echo $num_user; ?></span> nhân viên.<p>
											<!--	  <center> -->
											<div id="pagination" class="row">
												<div id="pagination_page" class="col-md-7">
													<ul class="pagination listpage pageuser">
														<?php if ($num_page > 6) { ?>
															<li class="page-item active" onclick="drawpage_mng_user(0)"><a class="page-link">1</a></li>
															<li class="page-item" onclick="drawpage_mng_user(1)"><a class="page-link">2</a></li>
															<li class="page-item" onclick="drawpage_mng_user(2)"><a class="page-link">3</a></li>
															<li class="page-item" onclick="drawpage_mng_user(3)"><a class="page-link">4</a></li>
															<li class="page-item" onclick="drawpage_mng_user(4)"><a class="page-link">5</a></li>
															<?php if ($num_page > 7) { ?>
																<li class="page-item"><a class="page-link">...</a></li>
															<?php } ?>
															<li class="page-item" onclick="drawpage_mng_user(<?php echo $num_page - 1 ?>)"><a class="page-link"><?php echo $num_page ?></a></li>
														<?php } else { ?>
															<li class="page-item active" onclick="drawpage_mng_user(0)"><a class="page-link">1</a></li>
															<?php for ($i = 1; $i < $num_page; $i++) { ?>
																<li class="page-item" onclick="drawpage_mng_user(<?php echo $i ?>)"><a class="page-link"><?php echo $i + 1 ?></a></li>
															<?php } ?>
														<?php } ?>
													</ul>
												</div>
												<div id="pagination_input" class="col-md-5" style="margin-top:23px">
													<span class="span_gopage">Đi đến trang</span>
													<input type="number" min="1" value="<?php echo $page + 1 ?>" onkeyup="drawgotopage_mng_user(this,event,<?php echo $num_page ?>)" id="go_to_page" class="gopage">
												</div>
											</div>
											<!--  </center> -->
											<div style="display:none">
												<input type="text" id="inf_search" value="">
												<input type="text" id="inf_page" value="0">
												<input type="text" id="inf_limit" value="15">
												<input type="text" id="inf_uid" value="0">
												<input type="text" id="inf_su" value="0">
											</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="home2">
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tabDropDownOne1">
									<p>Dropdown content#1</p>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tabDropDownTwo2">
									<p>Dropdown content#2 </p>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>

		</aside>






<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark" style="display: none;">
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

<!-- ./wrapper -->
<script type="text/javascript">
	$(document).ready(function() {
		$('.manage_qbank').removeClass('manage_qbank').addClass('active');
	});
</script>