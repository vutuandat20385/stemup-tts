<?php
  $this->load->view('sadmin/head');
?>
<script>
		var base_url="<?php echo base_url();?>";
		var site_url="<?php echo site_url();?>";
		var su="<?php echo $su ?>";   
		var id_mcq_fun="";
		var id_quiz_fun="";
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>

 <!-- fontawesome css -->
 <link href="<?php echo base_url('font-awesome/css/font-awesome.css');?>" rel="stylesheet">

 <!-- chartjs -->
 <script src="<?php echo base_url('js/Chart.bundle.min.js');?>"></script>

 <!-- firebase messaging menifest.json -->
 <link rel="manifest" href="<?php echo base_url('js/manifest.json');?>">
	<script src="<?php echo base_url('js/manage_qbank.js');?> "></script>
	<script src="<?php echo base_url('js/moderate_question.js');?> "></script>
<style>
.pointer {cursor: pointer;};
.nav.nav-tabs.MB20.bg-tab {
    display: none;
}

</style>	
<div class="wrapper">
<?php $this->load->view('sadmin/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <?php $this->load->view('sadmin/leftmenu'); ?>
    </aside>
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper " >
		
		<main class="container MT70" style="margin-top: 0px;">
		
		

		
		<div class="modal fade" id="editquestionModal" role="dialog">
			<div class="modal-dialog" style="width:80%">	 
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Chỉnh sửa câu hỏi #<span id="qide"><span></h4>
							
						</div>
						<!-- <form id="editquestionform" method="post" action="" >-->
							<div class="modal-body">
								<div class="form-group MT20">
									<textarea class="form-control" rows="3" name="question" id="questione" placeholder="Tạo câu hỏi trắc nghiệm" ></textarea>
								</div>
								<div class="row MB20" id="answer-area-1">
									<div class="col-xs-6">
										<label class="radio-inline w-100">
											
											<input class="MT10" type="radio" name="score" value='0' id="r0">
											<div class="input-group">
												<span class="input-group-addon">A</span>
												<input id="optA" type="text" class="form-control" name="option[]"  value="" placeholder="Điền phương án A" required />
											</div>
											
										</label>
									</div>
									<div class="col-xs-6">
										<label class="radio-inline w-100">
											
											<input class="MT10" type="radio" name="score" value='1'  id="r1">
											<div class="input-group">
												<span class="input-group-addon">B</span>
												<input id="optB" type="text" class="form-control" name="option[]" value="" placeholder="Điền phương án B" required />
											</div>
											
										</label>
									</div>
								</div>
								<div class="row" id="answer-area-2">
									<div class="col-xs-6">
										<label class="radio-inline w-100">
											
											<input class="MT10" type="radio" name="score" value='2' id="r2">
											<div class="input-group">
												<span class="input-group-addon">C</span>
												<input id="optC" type="text" class="form-control" name="option[]" value="" placeholder="Điền phương án C" required />
											</div>
											
										</label>
									</div>
									<div class="col-xs-6">
										<label class="radio-inline w-100">
											
											<input class="MT10" type="radio" name="score" value='3' id="r3">
											<div class="input-group">
												<span class="input-group-addon">D</span>
												<input id="optD" type="text" class="form-control" name="option[]"value="" placeholder="Điền phương án D" required />
											</div>
											
										</label>
									</div>
									<div id="optionarea">
										<div class="col-md-12">
											<div class="col-md-3" style="margin-top:20px">Dạng câu hỏi: </div>
											<div class="col-md-3" style="margin-top:20px"> <input id="q_type_1" name="q_type" value="1" type="radio"> Trắc nghiệm</div>
											<div class="col-md-3" style="margin-top:20px"> <input id="q_type_2" name="q_type" value="2" type="radio"> Video </div>
											<div class="col-md-3" style="margin-top:20px"> <input id="q_type_3" name="q_type" value="3" type="radio"> Bài đọc </div>
											
										</div>
										
										
										<div class="col-md-12">
											<div class="col-md-3" style="margin-top:20px">Chọn là MCQ Fun: </div>
											<div class="col-md-9" style="margin-top:20px"> <input  id="mcq_fun_e" name="mcqfun" value="0" type="checkbox"></div>
										</div>
										<div class="col-md-12">
											<div class="col-md-3" style="margin-top:20px">Hiển thị logo: </div>
											<div class="col-md-9" style="margin-top:20px"> <input  id="logo_org_e" name="logoorg" value="0" type="checkbox"></div>
										</div>
										<div class="col-md-12">
											<div class="col-md-3" style="margin-top:20px">Chọn môn học:</div>
											<div class="col-md-9" style="margin-top:20px" ><select class="form-control col-md-9" name="cid" id="cide"><?php foreach($category_list as $key => $val){ ?>  <option value="<?php echo $val['cid'];?>" id="cat<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option><?php }?></select></div>
											<div class="col-md-3" style="margin-top:20px" > Chọn lớp:</div>
											<div class="col-md-9" style="margin-top:20px"><select class="form-control" name="lid" id="lide"><?php foreach($level_list as $key => $val){?> <option value="<?php echo $val['lid'];?>" id="lv<?php echo $val['lid'];?>"><?php echo $val['level_name'];?></option><?php }?></select></div>
											<div class="col-md-3" style="margin-top:20px">Giải thích:</div>
											<div class="col-md-9" style="margin-top:20px"><textarea  name="description"  class="form-control" id="descr"></textarea></div>
											<div class="col-md-3" style="margin-top:20px">Từ khóa:</div>
											<div class="col-md-9" style="margin-top:20px"><input type="text" class="form-control" style="margin-bottom:20px" name="tags" value="" id="tags"></div>
											<div class="col-md-3" style="margin-top:20px">Thời gian làm bài:(tính bằng giây)</div>
											<div class="col-md-9" style="margin-top:20px"><input type="text" class="form-control" style="margin-bottom:20px" name="answer_time" value="60" id="answer_timeedt"></div>
											<div class="col-md-3" style="margin-top:20px">Tiết: </div>
											<div class="col-md-9" style="margin-top:20px"><input type="text" class="form-control" style="margin-bottom:20px" name="unitmcqedt" id="unitmcqedt"></div>
											<div class="col-md-3" style="margin-top:20px">Bài: </div>
											<div class="col-md-9" style="margin-top:20px"><input type="text" class="form-control" style="margin-bottom:20px" name="lessonmcqedt" id="lessonmcqedt"></div>
											<div class="col-md-3" style="margin-top:20px">Nguồn :</span></div>
											<div class="col-md-9" style="margin-top:20px"><input name="sourcemcq" id="sourcemcq_e" type="text" class="form-control" style="margin-bottom:20px" value=""></div>
										</div>
									</div>
								</div>
								
								
								
							</div>
							<div class="modal-footer">
								<input class="btn btn-success" type="submit" onclick="get_inf_edit1()" value="Xác nhận"/>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							<!--</form>-->
						</div>
						
					</div>
				</div>
				<div class="modal fade" id="previewquestionModal" role="dialog">
					<div class="modal-dialog" style="width:60%">	 
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" id="prqt"></h4>
							</div>
							<div class="modal-body">
								<div class="form-group MT20">
									<div id="questionp"></div>
								</div>
								<p><h5><b>Đáp án</b></h5></p>
								<div id="answer-areap">
								</div>
								<div id="optionareap">
								</div>	
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							
						</div>
						
					</div>
				</div>
				<div class="modal fade" id="previewquizModal" role="dialog">
					<div class="modal-dialog" style="width:50%">	 
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" id="quiztitlepr"></h4>
							</div>
							<div class="modal-body" id="quizbodypr">
								
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							
						</div>
						
					</div>
				</div>
				
				
				<div class="modal fade" id="ratingModal" role="dialog" >
					<div class="modal-dialog">	 
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close" onclick="manageQuestionItem(event);" data-dismiss="modal">&times;</button>
								<h3 class="modal-title ratingtitle" >Đánh giá</h3>
							</div>
							<div class="modal-body"  id= "bodyratingmodal">
								<p id="msgRating" style="display: none;" class="text-danger"></p>
								<form method="post" id="ratingform">
									<div class="form-group">
										<div class="rating-vl">
											<input id="value-vl" name="value-vl" class="rating-loading" data-min="0" data-max="5" data-step="1" data-size="cs">
											<a class="seeAllReviews"></a>
										</div>
										<div>
											<ul class="ratings_chart_vl">
											</ul>
										</div>
									</div>
									<div class="form-group rxs">
										<label for="rvalue" class="control-label"></label>
										<input id="rvalue" name="rvalue" class="rating" data-min="0" data-max="5" data-step="1" data-size="xs">
									</div>
									<div class="form-group">
										<textarea  name="rcontent" class="form-control tinymce_textarea"></textarea>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" id="ratingBtn" class="btn btn-success">Đánh giá</button>
								<button type="button" class="btn btn-default" onclick="manageQuestionItem(event);" data-dismiss="modal">Hủy</button>
							</div>
						</div>
						
					</div>
				</div>
				<div class="modal fade" id="classModal" role="dialog" >
					<div class="modal-dialog" style="width:70%">	 
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close" onclick="manage_class(event);" data-dismiss="modal">&times;</button>
								<div id="titleclassmodal"></div>
								
							</div>
							<div class="modal-body"  id= "bodyclassmodal">
								
								
							</div>
							<div class="modal-footer">
								<!-- <button type="button" class="btn btn-success" data-dismiss="modal">Cập nhật</button> -->
								<button type="button" class="btn btn-default" onclick="manage_class(event);" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="modal fade" id="classaddstdModal" role="dialog">
					<div class="modal-dialog" style="width:70%">	 
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close"  onclick="manage_class_modal_rl();"  data-dismiss="modal">&times;</button>
								<h3 class="modal-title" > Thêm học sinh</h3>
								
							</div>
							<div class="modal-body"  id= "bodyclassaddstdmodal">
								
								
							</div>
							<div class="modal-footer">
								<!--  <button type="button" class="btn btn-success" data-dismiss="modal">Cập nhật</button> -->
								<button type="button" class="btn btn-default" onclick="manage_class_modal_rl();" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>

				<div class="modal fade" id="groupModal" role="dialog" >
					<div class="modal-dialog" style="width:70%">
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close" onclick="manageGroup(event);" data-dismiss="modal">&times;</button>
								<div id="titlegroupmodal"></div>

							</div>
							<div class="modal-body"  id= "bodygroupmodal">


							</div>
							<div class="modal-footer">
								<!-- <button type="button" class="btn btn-success" data-dismiss="modal">Cập nhật</button> -->
								<button type="button" class="btn btn-default" onclick="manageGroup(event);" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="groupaddstdModal" role="dialog">
					<div class="modal-dialog" style="width:70%">
						<div class="modal-content" >
							<div class="modal-header">
								<button type="button" class="close" onclick="manage_group_modal_rl();" data-dismiss="modal">&times;</button>
								<h3 class="modal-title" >Thêm thành viên</h3>
							</div>
							<div class="modal-body" id= "bodygroupaddstdmodal">


							</div>
							<div class="modal-footer">
								<!--  <button type="button" class="btn btn-success" data-dismiss="modal">Cập nhật</button> -->
								<button type="button" class="btn btn-default" onclick="manage_group_modal_rl();" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>

	<section class="row">
		
		<aside class="col-md-12"  >
			<?php 
				if($this->session->flashdata('message')){
					echo $this->session->flashdata('message');	
					}
					if($this->session->flashdata('message2')){
						echo $this->session->flashdata('message2');	
					}?>	
				<!--<div class="box-lop" id="bannerpage">
					<div class="line-L">
						<h1>Trắc nghiệm</h1>			 
					</div>
				</div>-->
				
					
		<div id="tabContent2" class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="home2a">
				<div class="box-bor MB20">
					<div role="tabpanel" id="tabs">
						<!-- <ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">Quản lý câu hỏi</a></li>
							<li role="presentation"><a href="#home2" data-toggle="tab" role="tab" aria-controls="tab2" id="text-tabs2" style="display:none">Ghi chú</a></li>
						
						</ul> -->
					<div id="tabContent1" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home1">
							<div class="data_mngq">
								<table class="table table-bordered">
									<tr style="background-color: rgb(233, 235, 238);">
										<th>
											#
										</th>
										<th style="width: 50%;">
											Câu hỏi <span>
												<select  style="float:right" onchange="drawlimit_mng_qt(this)">
																										
													<option value="15" selected>15 mục</option>
													<option value="20">20 mục</option>
													<option value="25">25 mục</option>
												</select>
											</span>
										</th>
										<th>
											<select style="width:85%" onchange="drawct_mng_qt(this)">
												<option>Danh mục</option>
												<option value="0">Tất cả</option>
												<?php foreach($category_list as $ctg){ ?>
													<option value="<?php echo $ctg['cid']?>"> <?php echo $ctg['category_name']?></option>
												<?php } ?>
											</select>
										</th>
										<th>
											<select style="width:60%" onchange="drawlv_mng_qt(this)">
												<option>Cấp độ</option>
												<option value="0">Tất cả</option>
												<?php foreach($level_list as $lv){ ?>
													<option value="<?php echo $lv['lid']?>"> <?php echo $lv['level_name']?></option>
												<?php } ?>
											</select>
										</th>
										<th>
											<input id="search_mng_qt" style="width:65%;margin-left: 15%" onkeyup="drawsearch_mng_qt(this,event)"> 
											<i class="pointer fa fa-search" onclick="drawsearch_mng_qt_btn()"></i>
										</th>
										
									</tr>
									
									<?php foreach($questions as $q){ ?>
										<tr id="ques_<?php echo $q['qid']?>">
											<td>
												<?php echo $q['qid'];?>
											</td>
											<td>
												
													<a class="pointer" onclick="mng_preview_qt(<?php echo $q['qid']?>)">
														<?php echo $q['question'];?>
													</a>
													
											</td>
											<td>
												<a class="pointer" onclick="drawct_mng_qt_link(<?php echo $q['cid']?>)">
													<?php echo $q['category_name'];?>
												</a>
											</td>
											<td >
												<a class="pointer" onclick="drawlv_mng_qt_link(<?php echo $q['lid']?>)">
													<?php echo $q['level_name'];?>
												</a>
											</td >
											<td class="col-xs-1.5">
												<a onclick="mdr_preview_qt(<?php echo $q['qid']?>)"><i class="pointer text-success fa fa-eye" style="margin-left: 15%;" title="Xem trước"></i></a>
										
											
										
												<a onclick="mng_edit_question(<?php echo $q['qid'] ?>)"><i class="pointer text-warning fa fa-pencil" title="Sửa" style="color: #ef00ff;margin-left: 20%;"></i></a>
											
											
												<a><i class="pointer fa fa-remove" style="margin-left: 20%;" onclick="delete_question_(<?php echo $q['qid']?>)" title="Xóa"></i></a>
											</td>
											
										</tr>
									<?php } ?>  
									
								</table>
							</div>
							<p>Đang xem <span id="beginqt"><?php echo min($limit*$page+1,$num_question);?></span> 
								đến <span id="endqt"><?php echo min($limit*($page+1),$num_question);?></span> 
								trong tổng số <span id="totalqt"><?php echo $num_question;?></span> câu hỏi<p>
									<!--	  <center> -->
										<div id="pagination" class="row">
											<div id="pagination_page" class="col-md-7">
												<ul class="pagination listpage pageqt">
													<?php if($num_page>6){?>
														<li class="page-item active" onclick="drawpage_mng_qt(0)"><a class="page-link">1</a></li>
														<li class="page-item" onclick="drawpage_mng_qt(1)"><a class="page-link">2</a></li>
														<li class="page-item" onclick="drawpage_mng_qt(2)"><a class="page-link">3</a></li>
														<li class="page-item" onclick="drawpage_mng_qt(3)"><a class="page-link">4</a></li>
														<li class="page-item" onclick="drawpage_mng_qt(4)"><a class="page-link">5</a></li>
														<?php if($num_page>7){ ?>
															<li class="page-item"><a class="page-link">...</a></li>
														<?php } ?>
														<li class="page-item" onclick="drawpage_mng_qt(<?php  echo $num_page-1 ?>)"><a class="page-link"><?php echo $num_page ?></a></li>
													<?php }else{?>
														<li class="page-item active" onclick="drawpage_mng_qt(0)"><a class="page-link">1</a></li>
														<?php for($i=1; $i<$num_page; $i++){?>
															<li class="page-item" onclick="drawpage_mng_qt(<?php  echo $i ?>)"><a class="page-link"><?php  echo $i+1 ?></a></li>
														<?php }?>
													<?php }?>
												</ul>
											</div>
											<div id="pagination_input" class="col-md-5" style="margin-top:23px">
												<span class="span_gopage">Đi đến trang</span>
												<input type="number" min="1" value="<?php echo $page+1 ?>" onkeyup="drawgotopage_mng_qt(this,event,<?php echo $num_page ?>)" id="go_to_page" class="gopage" >
											</div>
										</div>
										<!--  </center> -->
										<div style="display:none">
											<input type="text" id="inf_search" value="">
											<input type="text" id="inf_page" value="0">
											<input type="text" id="inf_limit" value="15">
											<input type="text" id="inf_cid" value="0">
											<input type="text" id="inf_lid" value="0">
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
			
			
			
		
	</section>
	
</main>
	<!-- /.content-wrapper -->
	  <footer class="main-footer" style="margin:auto !important;">
		<div class="pull-right hidden-xs">
		  <b>Version</b> 2.4.0
		</div>
		 <strong>Copyright &copy; 2019 <a href="http://dtt.vn">Công ty cổ phần công nghệ DTT</a>.</strong> 
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
<script type="text/javascript">
	$(document).ready(function() {
        $('.manage_qbank').removeClass('manage_qbank').addClass('active');
    });
</script>
<?php
  $this->load->view('sadmin/foot');
?>

