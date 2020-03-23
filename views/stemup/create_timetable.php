<!DOCTYPE html>
<html lang="en">

<head>

	<title>Tạo thời khóa biểu</title>

	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/data.js');?>"></script>
	<script>
		var base_url = "<?php echo base_url();?>";
		var site_url = "<?php echo site_url();?>";
		var su = "<?php echo $su ?>";
		var id_mcq_fun = "<?php echo $id_mcq_fun ?>";
		var id_quiz_fun = "<?php echo $id_quiz_fun ?>";
	</script>
	<?php $this->load->view('stemup/head');?>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
</head>

<body class="bg-body">
	<?php $this->load->view('stemup/header');?>
	<main class="container MT70">
		<?php $this->load->view('stemup/menu');?>
		<section class="row">

			<aside class="col-md-8">
				<?php 
					if($this->session->flashdata('message')){
						echo $this->session->flashdata('message');	
					}
				    if($this->session->flashdata('message2')){
			 			echo $this->session->flashdata('message2');	
			 		}
				?>
<!-- 				<div class="box-lop" id="bannerpage">
					<div class="line-L">
						<h1>Tạo thời khóa biểu</h1>
					</div>
				</div> -->
				<div role="tabpanel">
					<!-- <ul class="nav nav-tabs MB20 bg-tab" role="tablist">
						<li role="presentation" class="active" style="display: none;"><a href="#home2a" data-toggle="tab" role="tab"
							 aria-controls="tab1">Đăng bài</a></li>
					</ul> -->
					<div id="tabContent2" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home2a">
							<div class="box-bor MB20">
								<div role="tabpanel" id="tabs">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#home1" id="text-tabs" data-toggle="tab" role="tab"
											 aria-controls="tab1">Thời khóa biểu</a></li>
										<li role="presentation"><a href="#home2" data-toggle="tab" role="tab" aria-controls="tab2" id="text-tabs2"
											 style="display:none">Ghi chú</a></li>
									</ul>
									<div id="tabContent1" class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="home1">
											<div class="form-group">
												<input type='text' readonly style='display:none' id='grade2' name='grade2'>
												<div class="col-md-3 col-city col-ttb-select">
													<label><?php echo $this->lang->line('tinhthanh_id'); ?></label>
													<select class="form-control" name="tinhthanh_id" id="tinhthanh_id" onchange="changeDataItem(event);"
												 required>
													<option value="0"> --Chọn tỉnh/ thành phố--</option>
													<?php
														foreach ($dataitem_list as $key => $val) {
													?>

													<option value="<?php echo $val['did'];?>"><?php echo $val['dataitem_name'];?></option>
													<?php
														}
													?>
												</select>
												</div>
												<div class="col-md-2 col-provide col-ttb-select">
													<label><?php echo $this->lang->line('quanhuyen_id'); ?></label>
													<select class="form-control" name="quanhuyen_id" id="quanhuyen_id" onchange="changeDataItem(event);">
												</select>
												</div>
												<div class="col-md-2 col-sub-provide col-ttb-select">
													<label><?php echo $this->lang->line('xaphuong_id'); ?></label>
												<select class="form-control" name="xaphuong_id" id="xaphuong_id" onchange="changeDataItemSchool(event);" ></select>
												</select>
												</div>
												<div class="col-md-3 col-school col-ttb-select">
													<label>Chọn Trường</label>
													<select class="form-control" name="truong_id" id="truong_id" onchange="changeDataItemClass(event);">
													</select>
												</div>
												
												<form method="post" action="<?php echo site_url('timetable/creat_tb');?>">
												<div class="col-md-2 col-class col-ttb-select">
													<label>Chọn Lớp</label>
												<select class="form-control" name="lop_id" id="lop_id" >
												</select>

												</div>	
												
													<table class="table table-bordered" id="tableSchedule">
														<thead style="background-color: rgb(233, 235, 238);">
															<th>Tiết</th>
															<th>Thứ 2</th>
															<th>Thứ 3</th>
															<th>Thứ 4</th>
															<th>Thứ 5</th>
															<th>Thứ 6</th>
															<th>Thứ 7</th>
														</thead>
														<tbody>
															<?php
                                            for($i = 0;$i<10;$i++){
                                        
                                                ?>
															<tr>
																<?php
                                                            for($a=0;$a<7;$a++){
                                                                if($a==0){
                                                                   ?>
																<td>
																	<?php echo $i +1 ?>
																</td>
																<?php
                                                                }else{
                                                                    ?>
																<td><select id="t<?php echo $a +1 ?>t<?php echo $i +1 ?>" name="t<?php echo $a +1 ?>t<?php echo $i +1 ?>">
																		<option value='0'>&nbsp;</option>
																		<?php
                                                                            foreach($category_list as $c){
                                                                                ?>
																		<option value="<?php echo $c['cid'] ?>">
																			<?php echo $c['abbr'] ?>
																		</option>
																		<?php
                                                                            } 
                                                                        ?>
																	</select></td>
																<?php
                                                                }
                                                            } 
                                                        ?>
															</tr>
															<?php
                                            }
                                         ?>
														</tbody>
													</table>
											</div>
											<div class="col-md-offset-10">
												<button style="margin-top:30px" class="btn btn-success" type="submit">Xác nhận</button>
											</div>
											</form>
											<div role="tabpanel" class="tab-pane fade" id="home2" style="min-height: unset;">
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>

			</aside>

		</section>

	</main>



</body>

</html>