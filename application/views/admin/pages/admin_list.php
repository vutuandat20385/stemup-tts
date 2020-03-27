<script>
	var base_url = "<?php echo base_url(); ?>";
	var site_url = "<?php echo site_url(); ?>";
	var su = "<?php echo $su ?>";
	var id_mcq_fun = "";
	var id_quiz_fun = "";
</script>
<!-- <script src="<?php echo base_url('js/jquery.js')?>"></script> -->
<!-- <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script> -->


<link href="<?php echo base_url('font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">


<script src="<?php echo base_url('js/Chart.bundle.min.js'); ?>"></script>


<link rel="manifest" href="<?php echo base_url('js/manifest.json'); ?>">
<script src="<?php echo base_url('js/admin/manage_user.js'); ?> "></script>
<!-- <script src="<?php echo base_url('js/moderate_question.js'); ?> "></script> -->
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
	<div id="tabContent2" class="tab-content">
		<div role="tabpanel" class="tab-pane fade in active" id="home2a">
			<div class="box-bor MB20">
				<div role="tabpanel" id="tabs">
					<div id="tabContent1" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home1">
							<div class="data_mngq">
								<!-- Thêm tk -->
								<div style="float: right">
									<a class="btn btn-primary" data-toggle="modal" data-target="#add-user" href="" role="button">Thêm</a>
								</div>
								<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="add-userLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">

											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Thêm tài khoản #<span id="qide"><span></h4>
											</div>
											<div class="modal-body">
												<div style="color: red;" id='msg-err'></div>
												<form action="" method="post">
													<div class="form-group">
														<label for="email">Email: </label>
														<input type="email" class="form-control" name="email" id="email" required>
													</div>
													<div class="form-group">
														<label for="password">Password: </label>
														<input type="password" class="form-control" name="password" required id="password" placeholder="Password">
													</div>
													<div class="form-group">
														<label for="first_name">Tên người dùng: </label>
														<input type="text" class="form-control" name="first_name" required id="first_name">
													</div>
													<label>Quyền hạn: </label>
													<div class="form-check form-check-inline">
														<input checked class="form-check-input" name="su" id="su" type="radio" value="10">
														<label class="form-check-label">Cộng tác viên</label>
														<input style="margin-left: 10px;" class="form-check-input" type="radio" name="su" id="su" value="1">
														<label class="form-check-label">Admin</label>
													</div>													
												</form>
											</div>
											<div class="modal-footer">
												<input class="btn btn-success" type="submit" onclick="add_user()" value="Xác nhận" />
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>

										</div>
									</div>
								</div>
								<!-- end modal add user -->
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
												<?php if ($q['su'] == 1) {
													echo 'Admin';
												}
												if ($q['su'] == 10) {
													echo 'Cộng tác viên';
												} ?>
											</td>
											<td class="col-xs-1.5">
												<!-- <a href="" onclick="mdr_preview_user(<?php echo $q['uid'] ?>)"><i class="pointer text-success fa fa-eye" style="margin-left: 15%;" title="Xem trước"></i></a> -->
												<a href="" data-toggle="modal" data-target="#edituserModal_<?php echo $q['uid']; ?>"><i class="pointer text-warning fa fa-pencil" title="Sửa" style="color: #ef00ff;margin-left: 20%;"></i></a>
												<a href=""><i class="pointer fa fa-remove" style="margin-left: 20%;" onclick="delete_user_(<?php echo $q['uid'] ?>)" title="Xóa"></i></a>
											</td>
											<div class="modal fade" id="edituserModal_<?php echo $q['uid']; ?>" role="dialog">
												<div class="modal-dialog" style="width:40%">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Chỉnh sửa tài khoản <?php echo $q['uid']; ?><span id="qide"><span></h4>
														</div>
														<div class="modal-body">
															<form action="" method="post">
																<div class="messedit" id="messedit<?php echo $q['uid']; ?>"></div>
																<div class="form-group">
																	<label>Email: </label>
																	<input type="email" class="form-control" id="email<?php echo $q['uid']; ?>" value="<?php echo $q['email']; ?>" required>
																</div>
																<div class="form-group">
																	<label>Mật khẩu mới: </label>
																	<input type="password" class="form-control" id="password<?php echo $q['uid']; ?>">
																</div>
																<div class="form-group">
																	<label>Tên người dùng: </label>
																	<input type="text" class="form-control" id="first_name<?php echo $q['uid']; ?>" value="<?php echo $q['first_name']; ?>" required>
																</div>
																<div class="form-group">
																	<label>Quyền hạn: </label>
																	<div class="form-check form-check-inline">
																		<input class="form-check-input" type="radio" name="su<?php echo $q['uid']; ?>" id="su" value="1" <?php if ($q['su'] == 1) {
																																												echo "checked";
																																											} ?>>
																		<label class="form-check-label">Admin</label>
																		<input style="margin-left: 10px;" class="form-check-input" name="su<?php echo $q['uid']; ?>" id="su" type="radio" value="10" <?php if ($q['su'] == 10) {
																																																			echo "checked";
																																																		} ?>>
																		<label class="form-check-label">Cộng tác viên</label>
																	</div>
																</div>
															</form>

														</div>
														<div class="modal-footer">
															<input class="btn btn-success" type="submit" onclick="get_inf_edit1(<?php echo $q['uid']; ?>)" value="Xác nhận" />
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
														<!--</form>-->
													</div>

												</div>
											</div>
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
<div class="control-sidebar-bg"></div>
