
<script>
		var base_url="<?php echo base_url();?>";
		var site_url="<?php echo site_url();?>";
		var su="<?php echo $su ?>";   
		var id_mcq_fun="";
		var id_quiz_fun="";
</script>

<!-- Bootstrap -->
	
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
    <script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
<script src="<?php echo base_url('js/editprofile.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>


	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
	<script src="<?php echo base_url('js/notification.js');?>"></script>
	<script src="<?php echo base_url('js/star-rating.js');?>"></script>
	<script src="<?php echo base_url('js/paginate.js');?>"></script>
	<script src="<?php echo base_url('js/assign.js');?>"></script>
	<script src="<?php echo base_url('js/video.js');?>"></script>
	<script src="<?php echo base_url('js/insert_video.js');?>"></script>

<style>
.pointer {cursor: pointer;};

.bg-tab{
	display:none;
}
.MT70 {
    margin-top: 0px;
}
.bg-tab {
    background: #fff;
    padding-top: 0px;
}
.col-md-6.box-bor {
    margin: 15px;
        
    width: 300px;
    height: 500px;
}
.box-bor1 {
    margin-bottom: 15px;
}
.mota{
	text-align: justify;
}
.taocauhoi {
    position: absolute;
    bottom: 10px;
    left: 95px;
}
</style>


  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper " >
    	
    <main class="container MT70">
    	<div class="modal fade" id="crt_mcq_vid" role="dialog">
		<div class="modal-dialog" style="width:93%">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Tạo câu hỏi<span id="qide"><span></h4>
				 
				</div>
				  <!-- <form id="editquestionform" method="post" action="" >-->
					    <div class="modal-body" style="width:100%">
							 <div class="form-group MT20">
								<div id="content" data-toggle="tooltip" data-placement="bottom">
								<textarea class="form-control" rows="3" name="question" id="questione" placeholder="Tạo câu hỏi trắc nghiệm" ></textarea>
								</div>
							 </div>
							 <div id="selectAnswer" data-toggle="tooltip" data-placement="bottom">
							<div class="row MBD20" id="answer-area-1">
								<div class="col-md-6">
									<label class="radio-inline w-100">
									<input class="MT10" type="radio" name="score" value='0' id="r0">
								    <div class="input-group">
									 <span class="input-group-addon">A</span>
									 <input id="optA" type="text" class="form-control" name="option[]"  value="" placeholder="Điền phương án A" required />
								   </div>
									
									</label>
								</div>
								<div class="col-md-6">
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
								<div class="col-md-6">
									<label class="radio-inline w-100">
										 <input class="MT10" type="radio" name="score" value='2' id="r2">
									     <div class="input-group">
										 <span class="input-group-addon">C</span>
										 <input id="optC" type="text" class="form-control" name="option[]" value="" placeholder="Điền phương án C" required />
									     </div>
									</label>
								</div>
								<div class="col-md-6">
									<label class="radio-inline w-100">
										 <input class="MT10" type="radio" name="score" value='3' id="r3">
									     <div class="input-group">
										 <span class="input-group-addon">D</span>
										 <input id="optD" type="text" class="form-control" name="option[]"value="" placeholder="Điền phương án D" required />
									     </div>
									</label>
								</div>
						</div>
						</div>
									<div id="optionarea">
									  <div class="col-md-12">
								<div class="col-md-3" style="margin-top:20px">Dạng câu hỏi: </div>
								<div class="col-md-3" style="margin-top:20px"> <input name="q_type" value="1" type="radio"> Trắc nghiệm</div>
								<div class="col-md-3" style="margin-top:20px"> <input name="q_type" value="2" type="radio"> Video </div>
								<div class="col-md-3" style="margin-top:20px"> <input name="q_type" value="3" type="radio"> Bài đọc </div>
											
							</div>
									<div class="col-md-12 col-xs-12">
									<div class="col-md-3 col-xs-5" style="margin-top:20px">Chọn là MCQ Fun: </div>
								   <div class="col-md-9 col-xs-7" style="margin-top:20px"> <input  id="mcq_fun_e" name="mcqfun" value="0" type="checkbox"></div>
								  </div>
								  <div class="col-md-12 col-xs-12">
									<div class="col-md-3 col-xs-5" style="margin-top:20px">Hiển thị logo: </div>
									<div class="col-md-9 col-xs-7" style="margin-top:20px"> <input  id="logo_org_e" name="logoorg" value="0" type="checkbox"></div>
								   </div>
								   <div class="col-md-12">
									<div class="col-md-3" style="margin-top:20px">Chọn môn học:</div>
									<div class="col-md-9" style="margin-top:20px" ><select class="form-control col-md-9" name="cid" id="cide"><?php foreach($category_list as $key => $val){ ?>  <option value="<?php echo $val['cid'];?>" id="cat<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option><?php }?></select></div>
									<div class="col-md-3" style="margin-top:20px" > Chọn lớp:</div>
									<div class="col-md-9" style="margin-top:20px"><select class="form-control" name="lid" id="lide"><?php foreach($level_list as $key => $val){?> <option value="<?php echo $val['lid'];?>" id="lv<?php echo $val['lid'];?>"><?php echo $val['level_name'];?></option><?php }?></select></div>
									<div class="col-md-3" style="margin-top:20px">Giải thích:</div>
									<div class="col-md-9" style="margin-top:20px"><textarea  name="description"  class="form-control" id="descr"></textarea></div>
									<div class="col-md-3" style="margin-top:20px">Từ khóa:</div>
									<div class="col-md-9" style="margin-top:20px" ><input type="text" class="form-control" data-toggle="tooltip" data-placement="bottom" style="margin-bottom:20px;" name="tags" value="" id="tags"></div>
									<div class="col-md-3" style="margin-top:20px">Thời gian làm bài:(tính bằng giây)</div>
									<div class="col-md-9" style="margin-top:20px"><input type="number" class="form-control" style="margin-bottom:20px" name="answer_time" value="60" id="answer_timeedt"></div>
									<div class="col-md-3" style="margin-top:20px">Tiết :</span></div>
									<div class="col-md-9" style="margin-top:20px"><input name="unitmcq" id="unitmcq" type="text" class="form-control" style="margin-bottom:20px" value=""></div>
									<div class="col-md-3" style="margin-top:20px">Bài :</span></div>
									<div class="col-md-9" style="margin-top:20px"><input name="lessonmcq" id="lessonmcq" type="text" class="form-control" style="margin-bottom:20px" value=""></div>									
									<div class="col-md-3" style="margin-top:20px">Nguồn :</span></div>
									<div class="col-md-9" style="margin-top:20px"><input name="sourcemcq" id="sourcemcq_e" type="text" class="form-control" style="margin-bottom:20px" value=""></div>
									</div>
								</div>
							</div>
							<div class="modal-footer" style="background-color:white">
						<input class="btn btn-success" type="submit" onclick="get_inf_qt()" value="Xác nhận"/>
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					    
					    
					</div>
					
				<!--</form>-->
			 </div>
			  
		</div>
	<section class="row">
 
  	  <aside class="col-md-12 >
	  <div class="box-lop" id="bannerpage">
			  <!--<div class="line-L">
				  <h1>Thư viện</h1>
		      </div>-->
		 
		  <div role="tabpanel">
		    <ul class="nav nav-tabs MB20 bg-tab" role="tablist">
		      <li role="presentation" class="active" style="display: none;"><a href="#home2a" data-toggle="tab" role="tab" aria-controls="tab1">Đăng bài</a></li>
	        </ul>
		    <div id="tabContent2" class="tab-content">
				  <div role="tabpanel" class="tab-pane fade in active" id="home2a">
					<div class="box-bor MB20" style="margin-bottom:10px;height:1275px;">
						<div role="tabpanel" id="tabs">
						  <ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">Video</a></li>
							<li role="presentation"><a href="#home2" data-toggle="tab" role="tab" aria-controls="tab2" id="text-tabs2" style="display:none">Ghi chú</a></li>
						
							</ul>
							
						  <div id="tabContent1" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="home1">
										 <div class="col-md-12 box-bor1" style="border:none;">
                                         <div role="tabpanel" class="tab-pane fade in active" id="home1" >
								
								<div class="form-group MT20">
									<textarea class="form-control"   id= "video_if" rows="3" name="video_if"  ></textarea>
								</div>
								
								Mô phỏng : <span><input  id="issim" name="issim" value="0" type="checkbox"></span><br/><br/>
								<div class="col-md-6">
								Tên: <input name="name_video" id="name_video" type="text" class="form-control " style="margin-bottom:20px; " value="" required>
							</div>
							<div class="col-md-6">
								Title:<input name="title_video" id="title_video" type="text" class="form-control" style="margin-bottom:20px">
							</div>
							<div class="col-md-12">
								Mô tả
								<textarea name="descr_video" id="descr_video" type="text" class="form-control" style="margin-bottom:20px" value=""></textarea>
							</div>
							<div class="col-md-6">
								Từ khóa:
								<input name="tags_video" id="tags_video" type="text" class="form-control" style="margin-bottom:20px" value="">
							</div>
							<div class="col-md-6">
								Môn học:
								<select class="form-control" name="cid" id="cide" style="margin-bottom:20px"><?php foreach($category_list as $key => $val){ ?>  <option value="<?php echo $val['cid'];?>" id="cat<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option><?php }?></select>
								</div>
								<div class="col-md-6">
								Lớp:
								<select class="form-control" name="lid" id="lide" style="margin-bottom:20px"><?php foreach($level_list as $key => $val){ ?>  <option value="<?php echo $val['lid'];?>" 
									<?php if($val['lid']==15){echo ' selected '; } ?>
									id="cat<?php echo $val['lid'];?>"><?php echo $val['level_name'];?></option><?php }?></select>
								</div>
								<div class="col-md-6">
									Tiết : 
									<input name="unit_video" id="unit_video" type="number" class="form-control" style="margin-bottom:20px" value="">
								</div>
								<div class="col-md-12">
									Nguồn : 
									<input name="source_video" id="source_video" type="text" class="form-control" style="margin-bottom:20px" value="">
								</div>
									<input type="button" class="btn btn-primary" value="Thêm dữ liệu" onclick="insert_video()">
									
								</div>
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
		
