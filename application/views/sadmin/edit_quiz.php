<?php
  $this->load->view('sadmin/head');
?>


<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/group.js');?>"></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
	<script src="<?php echo base_url('js/edit_quiz.js');?>" ></script>
	<script>


		var base_url = "<?php echo base_url();?>";
		var site_url = "<?php echo site_url();?>";
		var su = "<?php echo $su ?>";
		var id_mcq_fun = "";
		var id_quiz_fun = "";
		var arr_qt = [];
	</script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>

	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
	<script src="<?php echo base_url('js/notification.js');?>"></script>
	<script src="<?php echo base_url('js/star-rating.js');?>"></script>
	<script src="<?php echo base_url('js/paginate.js');?>"></script>
	<script src="<?php echo base_url('js/assign.js');?>"></script>
<style>
.pointer {cursor: pointer;};

</style>	
<div class="wrapper">
<?php $this->load->view('sadmin/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <?php $this->load->view('sadmin/leftmenu'); ?>
    </aside>

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper " >
		
	<main class="container MT70" style="margin-top:0px;">

		
			<aside class="col-md-12">
				<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
	    if($this->session->flashdata('message2')){
 			echo $this->session->flashdata('message2');	
 		}
		?>
				
				<div role="tabpanel">
					<ul class="nav nav-tabs MB20 bg-tab" role="tablist" style="padding-top:0px;">
						<li role="presentation" class="active" style="display: none;"><a href="#home2a" data-toggle="tab" role="tab"
							 aria-controls="tab1">Đăng bài</a></li>

					</ul>
					<div id="tabContent2" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home2a">
							<div class="box-bor MB20">
								<div role="tabpanel" id="tabs">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#home1" id="text-tabs" data-toggle="tab" role="tab"
											 aria-controls="tab1">Tên bài kiểm tra</a></li>
										<li role="presentation"><a href="#home2" data-toggle="tab" role="tab" aria-controls="tab2" id="text-tabs2"
											 style="display:none">Ghi chú</a></li>
									</ul>
									<div id="tabContent1" class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="home1">
											<form id="formEditQuiz">
												<div class="form-group">
													<label for="inputEmail" class="sr-only">
														<?php echo $this->lang->line('quiz_name');?></label>
													<input type="text" id="inpquizname" name="quiz_name" class="form-control" placeholder="<?php echo $this->lang->line('quiz_name');?>"
													 value="<?php echo $quiz['quiz_name'] ?>" required>
												</div>
												<div class="form-group">
													<label for="inputEmail">
														<?php echo $this->lang->line('description');?></label>
													<textarea name="description" class="form-control tinymce_textarea"><?php echo $quiz['description'] ?></textarea>
												</div>
												<div class="form-group">
													<label>
														<?php echo $this->lang->line('assign_to_group');?></label> <br>
													<?php 
							foreach($group_list as $key => $val){
								?>

													<input type="radio" name="gids[]" value="<?php echo $val['gid'];?>" <?php if($key==1){ echo 'checked' ; }
													 ?> >
													<?php echo $val['group_name'];?> &nbsp;&nbsp;&nbsp;
													<?php 
							}
							?>
												</div>
												<a href="#" data-toggle="collapse" data-target="#advance_options">
													<?php echo $this->lang->line('advance_options');?></a>
												<div id="advance_options" class="collapse">
													<div class="form-group">
														<label for="inputEmail">
															<?php echo $this->lang->line('start_date');?></label>
														<input type="text" name="start_date" value="<?php echo date('Y-m-d H:i:s',$quiz['start_date']) ?>" class="form-control"
														 placeholder="<?php echo $this->lang->line('start_date');?>" required>
													</div>
													<div class="form-group">
														<label for="inputEmail">
															<?php echo $this->lang->line('end_date');?></label>
														<input type="text" name="end_date" value="<?php echo date('Y-m-d H:i:s', $quiz['end_date']);?>"
														 class="form-control" placeholder="<?php echo $this->lang->line('end_date');?>" required>
													</div>
													<div class="form-group">
														<label for="inputEmail">
															<?php echo $this->lang->line('duration');?></label>
														<input type="text" name="duration" value="<?php echo $quiz['duration'] ?>" class="form-control" placeholder="<?php echo $this->lang->line('duration');?>"
														 required>
													</div>
													<div class="form-group">
														<label for="inputEmail">
															<?php echo $this->lang->line('maximum_attempts');?></label>
														<input type="text" name="maximum_attempts" value="<?php echo $quiz['maximum_attempts'] ?>" class="form-control" placeholder="<?php echo $this->lang->line('maximum_attempts');?>"
														 required>
													</div>
													<div class="form-group">
														<label for="inputEmail">
															<?php echo $this->lang->line('pass_percentage');?></label>
														<input type="text" name="pass_percentage" value="<?php echo $quiz['pass_percentage'] ?>" class="form-control" placeholder="<?php echo $this->lang->line('pass_percentage');?>"
														 required>
													</div>
													<div class="form-group" style="display:none;">
														<label for="inputEmail">
															<?php echo $this->lang->line('correct_score');?></label>
														<input type="text" name="correct_score" value="<?php echo $quiz['correct_score'] ?>" class="form-control" placeholder="<?php echo $this->lang->line('correct_score');?>"
														 required>
													</div>
													<div class="form-group" style="display:none;">
														<label for="inputEmail">
															<?php echo $this->lang->line('incorrect_score');?></label>
														<input type="text" name="incorrect_score" value="<?php echo $quiz['incorrect_score'] ?>" class="form-control" placeholder="<?php echo $this->lang->line('incorrect_score');?>"
														 required>
													</div>
													<div class="form-group">
														<label for="inputEmail">
															<?php echo $this->lang->line('ip_address');?></label>
														<input type="text" name="ip_address" value="<?php echo $quiz['ip_address'] ?>" class="form-control" placeholder="<?php echo $this->lang->line('ip_address');?>">
													</div>
													<div class="form-group">
														<label for="inputEmail">
															<?php echo $this->lang->line('view_answer');?></label> <br>
														<input type="radio" name="view_answer" value="1" checked>
														<?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
														<input type="radio" name="view_answer" value="0">
														<?php echo $this->lang->line('no');?>
													</div>
													<div class="form-group" style="display:none;">
														<label for="inputEmail">
															<?php echo $this->lang->line('open_quiz');?></label> <br>
														<input type="radio" name="with_login" value="0">
														<?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
														<input type="radio" name="with_login" value="1" checked>
														<?php echo $this->lang->line('no');?>
													</div>

													<div class="form-group">
														<label for="inputEmail">
															<?php echo $this->lang->line('show_rank');?></label> <br>
														<input type="radio" name="show_chart_rank" value="1" checked>
														<?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
														<input type="radio" name="show_chart_rank" value="0">
														<?php echo $this->lang->line('no');?>
													</div>


													<?php 
							if($this->config->item('webcam')==true){
							?>
													<div class="form-group" style="display:none;">
														<label for="inputEmail">
															<?php echo $this->lang->line('capture_photo');?></label> <br>
														<input type="radio" name="camera_req" value="1">
														<?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
														<input type="radio" name="camera_req" value="0" checked>
														<?php echo $this->lang->line('no');?>
													</div>
													<?php 
							}else{
							?>
													<input type="hidden" name="camera_req" value="0">

													<?php 
							}
							?>
													<div class="form-group" style="display:none;">
														<label>
															<?php echo $this->lang->line('quiz_template');?></label> <br>
														<select name="quiz_template">
															<?php 
								foreach($this->config->item('quiz_templates') as $qk=> $val){
								?>
															<option value="<?php echo $val;?>">
																<?php echo $val;?>
															</option>
															<?php 
								}
								?>

														</select>
													</div>
													<div class="form-group" style="display:none;">
														<label for="inputEmail">
															<?php echo $this->lang->line('question_selection');?></label> <br>
														<input type="radio" name="question_selection" value="1">
														<?php echo $this->lang->line('automatically');?><br>
														<input type="radio" name="question_selection" value="0" checked>
														<?php echo $this->lang->line('manually');?>
													</div>
													<div class="form-group" style="display:none;">
														<label for="inputEmail">
															<?php echo $this->lang->line('generate_certificate');?></label> <br>
														<input type="radio" name="gen_certificate" value="1">
														<?php echo $this->lang->line('yes');?><br>
														<input type="radio" name="gen_certificate" value="0" checked>
														<?php echo $this->lang->line('no');?>
													</div>

													<div class="form-group" style="display:none;">
														<label for="inputEmail">
															<?php echo $this->lang->line('certificate_text');?></label>
														<textarea name="certificate_text" class="form-control"></textarea><br>
														<?php echo $this->lang->line('tags_use');?>
														<?php echo htmlentities("<br>  <center></center>  <b></b>  <h1></h1>  <h2></h2>   <h3></h3>    <font></font>");?><br>
														{email}, {first_name}, {last_name}, {quiz_name}, {percentage_obtained}, {score_obtained}, {result},
														{generated_date}, {result_id}, {qr_code}
													</div>
												</div>
												<hr>
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="active">
														<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
														 aria-selected="true" onclick="redraws_qbank_in(0,0,'',10,0)" >Sửa câu hỏi</a>
													</li>
													<li class="">
														<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
														 aria-selected="false" onclick="redraws_qbank_not_in(0,0,'',10,0)">Thêm câu hỏi</a>
													</li>
												</ul>
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
													<div class="qbank_in">
													<span style="float:right; margin-bottom:10px;">
																<input id="search_qbank_in" style="min-width:250px;margin-top:5%" placeholder="Tìm kiếm câu hỏi" onkeyup="drawsearch_qbank_in(this,event)"
																 value="">
																<i class="pointer fa fa-search" onclick="drawsearch_qbank_btn_in()"></i></span>
															
																<table class="table table-bordered">
																	<thead>
																		<tr style="background-color: rgb(233, 235, 238);">
																			<th></th>
																			<th style="width: 400px;">Câu hỏi<span>
																					<select style="float:right" onchange="drawlimit_qbank_in(this)">
																					<option value="5">5 mục</option>
																					<option value="10" selected>10 mục</option>
																					<option value="15">15 mục</option>
																					<option value="20">20 mục</option>
																					<option value="25">25 mục</option>
																					</select></span></th>
																			<th>
																				<select style="width:95px" onchange="drawct_qbank_in(this)">
																					<option disabled selected value='-1'>Danh mục</option>
																					<option value="0">Tất cả</option>
																					<?php foreach($category_list as $c){
																		?>
																					<option value="<?php echo $c['cid'] ?>">
																						<?php echo $c['category_name'] ?>
																					</option>
																					<?php
																	} ?>
																				</select>
																			</th>
																			<th>
																				<select style="width:95px" onchange="drawlv_qbank_in(this)">
																					<option disabled selected value='-1'>Cấp độ</option>
																					<option value="0">Tất cả</option>
																					<?php
																	foreach($level_list as $l) {
																		?>
																		<option value="<?php echo $l['lid'] ?>"><?php echo $l['level_name'] ?></option>
																		<?php
																	}
																	?>
																				</select>
																			</th>
																			<th>
																			</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																foreach($qbank as $q){
																	?>
																		<tr class="shown">
																			<td onclick="change_stt_qt(this,<?php echo $quiz['quid'] ?>,<?php echo $q['qid'] ?>)" class="details-control" style="width:30px"></td>
																			<td>
																				<?php echo $q['question'] ?>
																			</td>
																			<td>
																				<?php echo $q['category_name'] ?>
																			</td>
																			<td>
																				<?php echo $q['level_name'] ?>
																			</td>
																			<td><a class="pointer" onclick="mng_preview_qt(<?php echo $q['qid'] ?>)">
																					<i class="pointer text-success fa fa-eye" title="Xem trước"></i></a></td>
																		</tr>
																		<?php
																}
																?>
																	</tbody>
																</table>
																<p>Đang xem <span id="beginqt">
																		<?php echo min($limit*$page+1,$number_qbank);?></span>
																	đến <span id="endqt">
																		<?php echo min($limit*($page+1),$number_qbank);?></span>
																	trong tổng số <span id="totalqt">
																		<?php echo $number_qbank;?></span> câu hỏi<p>
																		<center>
															<ul class="pagination listpage pageqt">
																<?php if($num_page>6){?>
																<li class="page-item active" onclick="drawpage_qbank_in(0)"><a class="page-link">1</a></li>
																<li class="page-item" onclick="drawpage_qbank_in(1)"><a class="page-link">2</a></li>
																<li class="page-item" onclick="drawpage_qbank_in(2)"><a class="page-link">3</a></li>
																<li class="page-item" onclick="drawpage_qbank_in(3)"><a class="page-link">4</a></li>
																<li class="page-item" onclick="drawpage_qbank_in(4)"><a class="page-link">5</a></li>
																<?php if($num_page>7){ ?>
																<li class="page-item"><a class="page-link">...</a></li>
																<?php } ?>
																<li class="page-item" onclick="drawpage_qbank_in(<?php  echo $num_page-1 ?>)"><a class="page-link">
																		<?php echo $num_page ?></a></li>
																<?php }else{?>
																<li class="page-item active" onclick="drawpage_qbank_in(0)"><a class="page-link">1</a></li>
																<?php for($i=1; $i<$num_page; $i++){?>
																<li class="page-item" onclick="drawpage_qbank_in(<?php  echo $i ?>)"><a class="page-link">
																		<?php  echo $i+1 ?></a></li>
																<?php }?>
																<?php }?>

															</ul>
														</center>
															</div>
														
														
														<div style="display:none">
															<input type="text" id="inf_search_in" value="">
															<input type="text" id="inf_page_in" value="0">
															<input type="text" id="inf_limit_in" value="10">
															<input type="text" id="inf_cid_in" value="0">
															<input type="text" id="inf_lid_in" value="0">
														</div>
												</div>
												<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
												<div class="qbank_not_in">
												<span style="float:right; margin-bottom:10px;">
																<input id="search_qbank_not_in" style="min-width:250px;margin-top:5%" placeholder="Tìm kiếm câu hỏi" onkeyup="drawsearch_qbank_not_in(this,event)"
																 value="">
																<i class="pointer fas fa-search" onclick="drawsearch_qbank_btn_not_in()"></i></span>
															
																<table class="table table-bordered">
																	<thead>
																		<tr style="background-color: rgb(233, 235, 238);">
																			<th></th>
																			<th style="width: 400px;">Câu hỏi<span>
																					<select style="float:right" onchange="drawlimit_qbank_not_in(this)">
																					<option value="5">5 mục</option>
																					<option value="10" selected>10 mục</option>
																					<option value="15">15 mục</option>
																					<option value="20">20 mục</option>
																					<option value="25">25 mục</option>
																					</select></span></th>
																			<th>
																				<select style="width:95px" onchange="drawct_qbank_not_in(this)">
																					<option disabled selected>Danh mục</option>
																					<option value="0">Tất cả</option>
																					<?php foreach($category_list as $c){
																		?>
																					<option value="<?php echo $c['cid'] ?>">
																						<?php echo $c['category_name'] ?>
																					</option>
																					<?php
																	} ?>
																				</select>
																			</th>
																			<th>
																				<select style="width:95px" onchange="drawlv_qbank_not_in(this)">
																					<option disabled selected>Cấp độ</option>
																					<option value="0">Tất cả</option>
																					<?php
																	foreach($level_list as $l){
																		?>
																		 <option value="<?php echo $l['lid'] ?>">
																						<?php echo $l['level_name'] ?>
																					</option>
																		<?php
																	}
																	?>
																				</select>
																			</th>
																			<th>
																			</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																foreach($qbank_not as $qn){
																	?>
																		<tr class="">
																			<td onclick="change_stt_qt(this,<?php echo $quiz['quid'] ?>,<?php echo $qn['qid'] ?>)" class="details-control" style="width:30px"></td>
																			<td>
																				<?php echo $qn['question'] ?>
																			</td>
																			<td>
																				<?php echo $qn['category_name'] ?>
																			</td>
																			<td>
																				<?php echo $qn['level_name'] ?>
																			</td>
																			<td><a class="pointer" onclick="mng_preview_qt(<?php echo $qn['qid'] ?>)">
																					<svg class="svg-inline--fa fa-eye fa-w-18 pointer text-success" title="Xem trước" aria-labelledby="svg-inline--fa-title-10"
																					 data-prefix="fas" data-icon="eye" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
																					 data-fa-i2svg="">
																						<title id="svg-inline--fa-title-10">Xem trước</title>
																						<path fill="currentColor" d="M569.354 231.631C512.969 135.949 407.81 72 288 72 168.14 72 63.004 135.994 6.646 231.631a47.999 47.999 0 0 0 0 48.739C63.031 376.051 168.19 440 288 440c119.86 0 224.996-63.994 281.354-159.631a47.997 47.997 0 0 0 0-48.738zM288 392c-75.162 0-136-60.827-136-136 0-75.162 60.826-136 136-136 75.162 0 136 60.826 136 136 0 75.162-60.826 136-136 136zm104-136c0 57.438-46.562 104-104 104s-104-46.562-104-104c0-17.708 4.431-34.379 12.236-48.973l-.001.032c0 23.651 19.173 42.823 42.824 42.823s42.824-19.173 42.824-42.823c0-23.651-19.173-42.824-42.824-42.824l-.032.001C253.621 156.431 270.292 152 288 152c57.438 0 104 46.562 104 104z"></path>
																					</svg></a></td>
																		</tr>
																		<?php
																}
																?>
																	</tbody>
																</table>
																<p>Đang xem <span id="beginqt">
																		<?php echo min($limit*$page+1,$number_qbank_not);?></span>
																	đến <span id="endqt">
																		<?php echo min($limit*($page+1),$number_qbank_not);?></span>
																	trong tổng số <span id="totalqt">
																		<?php echo $number_qbank_not;?></span> câu hỏi<p>
																		<center>
															<ul class="pagination listpage pageqt">
																<?php if($num_page_not>6){?>
																<li class="page-item active" onclick="drawpage_qbank_not_in(0)"><a class="page-link">1</a></li>
																<li class="page-item" onclick="drawpage_qbank_not_in(1)"><a class="page-link">2</a></li>
																<li class="page-item" onclick="drawpage_qbank_not_in(2)"><a class="page-link">3</a></li>
																<li class="page-item" onclick="drawpage_qbank_not_in(3)"><a class="page-link">4</a></li>
																<li class="page-item" onclick="drawpage_qbank_not_in(4)"><a class="page-link">5</a></li>
																<?php if($num_page_not>7){ ?>
																<li class="page-item"><a class="page-link">...</a></li>
																<?php } ?>
																<li class="page-item" onclick="drawpage_qbank_not_in(<?php  echo $num_page_not-1 ?>)"><a class="page-link">
																		<?php echo $num_page_not ?></a></li>
																<?php }else{?>
																<li class="page-item active" onclick="drawpage_qbank_not_in(0)"><a class="page-link">1</a></li>
																<?php for($i=1; $i<$num_page_not; $i++){?>
																<li class="page-item" onclick="drawpage_qbank_not_in(<?php  echo $i ?>)"><a class="page-link">
																		<?php  echo $i+1 ?></a></li>
																<?php }?>
																<?php }?>

															</ul>
														</center>
															</div>
														
														<div style="display:none">
															<input type="text" id="inf_search_not_in" value="">
															<input type="text" id="inf_page_not_in" value="0">
															<input type="text" id="inf_limit_not_in" value="10">
															<input type="text" id="inf_cid_not_in" value="0">
															<input type="text" id="inf_lid_not_in" value="0">
														</div>
												</div>
											</div>
											</form>
										</div>
										<button id="btnCapnhat_quiz" type="button" class="btn btn-success" data-dismiss="modal">Cập nhật</button>
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
						<p>
							<h5><b>Đáp án</b></h5>
						</p>
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


		<div class="modal fade" id="ratingModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" onclick="manageQuestionItem(event);" data-dismiss="modal">&times;</button>
						<h3 class="modal-title ratingtitle">Đánh giá</h3>
					</div>
					<div class="modal-body" id="bodyratingmodal">
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
								<textarea name="rcontent" class="form-control tinymce_textarea"></textarea>
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
	</main>
		
		
		
		

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
<script type="text/javascript">
        function del(id) {
            if (confirm("Delete?"))
            window.location.href = '<?php echo site_url('quiz/delete_quiz')?>/'+id;
            return true;
        }
</script> 
<?php
  $this->load->view('sadmin/foot');
?>

