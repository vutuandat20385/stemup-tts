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

<!-- Bootstrap -->
	
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/quiz_list.css');?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
     <script src="<?php echo base_url('js/quiz_list.js');?> "></script>
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/group.js');?>"></script>
	<script src="<?php echo base_url('js/manage_group.js') ?>"></script>
	<script src="<?php echo base_url('js/manage_class.js') ?>"></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
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
		<main class="container MT70" style="margin-top: 0px;">
	<section class="row">
  	  <aside class="col-md-12"  >
	   <?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
	    if($this->session->flashdata('message2')){
 			echo $this->session->flashdata('message2');	
 		}
		?>	
		
		  <div role="tabpanel">
		    <ul class="nav nav-tabs MB20 bg-tab" role="tablist" style="display: none;">
		      <li role="presentation" class="active" style="display: none;"><a href="#home2a" data-toggle="tab" role="tab" aria-controls="tab1">Đăng bài</a></li>
		     
	        </ul>
		    <div id="tabContent2" class="tab-content">
				  <div role="tabpanel" class="tab-pane fade in active" id="home2a">
					<div class="box-bor MB20">
						<div role="tabpanel" id="tabs">
						  <ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">Kiểm tra</a></li>
							<li role="presentation"><a href="#home2" data-toggle="tab" role="tab" aria-controls="tab2" id="text-tabs2" style="display:none">Ghi chú</a></li>
						
						  </ul>
						  <div id="tabContent1" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="home1">
							    <div class="col-md-12 box-filter">
									<div class="col-md-3" > 
									   <select id="cteg-quiz" style="padding:3px; width:100%; margin-bottom:10px" onchange="filter_quiz_categ_al(this)">
										<option selected disabled>
												<b>Chủ đề</b>
											</option>
											<option value="0">
												  Tất cả
											</option>
									   <?php foreach(array_reverse($category_list) as $ct){?>
											<?php if($ct['cid']==$cid){?>
												<option value="<?php echo $ct['cid'] ?>" selected>
											<?php } else{?>
												<option value="<?php echo $ct['cid'] ?>" >
											<?php }?>
												  <?php echo $ct['category_name'] ?>
											</option>
									   <?php }?>
									   </select>
									</div>
									<div class="col-md-3" style="margin-bottom: 5px;;"> 
									<select id="level-quiz" style="padding:3px; width:100%; margin-bottom:5px" onchange="filter_quiz_level_al(this)">
									 <option selected disabled>
												<b>Lớp</b>
											</option>
											<option value="0">
												  Tất cả 
											</option>
									 <?php foreach($level_list as $lv){?>
											<?php if($lv['lid']==$lid){?>
												<option value="<?php echo $lv['lid'] ?>" selected>
											<?php } else{?>
												<option value="<?php echo $lv['lid'] ?>" >
											<?php }?>
												  <?php echo $lv['level_name'] ?>
											</option>
									   <?php }?>
									   </select>
									</div>
								
									  <div class="col-md-3">
										<select style="padding:3px ;width:100%; margin-bottom:10px" id="sort-question" onchange="sort_quiz_al(this)">
											<option selected disabled>
											  <b>	Sắp xếp</b>
											</option>
											<?php if($su==1 || $su==3 || $su==6){ ?>
											<option value="mine" <?php if($sortby=='mine'){echo 'selected';} ?> >
												Bài của tôi
											</option>
											<?php } ?>
											<option value="create_date+desc" <?php if($sortby=='create_date desc'){echo 'selected';  } ?> >
											Mới nhất
											</option>
											<option value="create_date+asc" <?php if($sortby=='create_date asc'){echo 'selected';  } ?>>
											Cũ nhất
											</option>
											<option value="answered+desc" <?php if($sortby=='answered desc'){echo 'selected';  } ?>>
											Nhiều lượt trả lời
											</option>
											<option value="assigned+desc" <?php if($sortby=='assigned desc'){echo 'selected';  } ?>>
											Nhiều lượt giao bài 
											</option>
											
										</select>
									 </div>
									 <div class="col-md-3 " style="margin-bottom:5px" style="float:left"> 
									  <table style="width:100%;"><tr><td><input type="text" style="width:93%" value="<?php echo $search?>" onchange="filter_quiz_search_al(this)"/></td>
										<td><i class="fa fa-search"></i></td></tr></table>
									</div>
								</div>
								
							   <div class="box-bor1" style="border:none">
							    <?php foreach($quiz_list as $quiz){?> 
								<div class="col-md-4 div_quizz div_cteg_<?php echo $quiz['cid'] ?> div_level_<?php echo $quiz['lid'] ?>" >
								   <div class="box-quiz-home" style="height:360px ;background-color:<?php
										$a=array("Azure","pink" ,"LemonChiffon","WhiteSmoke","SeaShell","LightYellow","Violet");
										echo $a[array_rand($a)];
										?>" >
									   <div class="box-img-home">
											
											<center>
												<a class="pointer" href="<?php echo site_url('page/quiz/'.$quiz['permalink']);?>">
												<img class="img-responsive" style="height:200px" src="<?php echo str_replace("..",base_url(),$quiz['img'] )?>">
												</a>
											</center>
									   </div> 

									   <!-- Cắt chuỗi -->
									   <?php
										if( mb_strlen($quiz['quiz_name'],'UTF-8') > 100)
										{
											$pos = strpos($quiz['quiz_name'],' ',100);
											$quiz_name = substr($quiz['quiz_name'],0,$pos).'...';
										}
										else {
											$quiz_name = $quiz['quiz_name'];
										}
									   ?>
									   <!-- Cắt chuỗi -->
									   
									   <div class="box-title-home"> 
											<center>
												<a class="pointer" title="<?php echo $quiz['quiz_name'] ?>"  href="<?php echo site_url('quiz/validate_quiz/'.$quiz['quid'])?>"><b style="margin:3px" class="quiz_name"> <?php echo $quiz_name?></b></a>
											 </center>
										</div>
										<div class="col-md-12" style="margin-bottom:10px">
											<center>
											 <a class="btn btn-info" href="<?php echo site_url('quiz/validate_quiz/'.$quiz['quid'])?>"> Kiểm tra</a>	
                                              <?php if($su!=2 && $su!=5){?>											 
											 <a class="btn btn-success" onclick=" changeassign(<?php echo $quiz['quid']?>,<?php echo $su?>)"> Giao bài
											 </a> 
											  <?php }?>
												<?php if($su==1 || $uid==$quiz['inserted_by']){
													?>
													 <a class="btn btn-warning" title="Sửa bài kiểm tra" href="<?php echo site_url("sadmin/edit_quiz").'/'.$quiz['quid'] ?>"><i class="fa fa-pencil"></i> 
											 </a>
											 <a class="btn btn-danger" title="Xóa bài kiểm tra" onclick="del(<?php echo $quiz['quid'] ?>)"><i class="fa fa-trash"></i>
											 </a> 
													<?php
												}
												 ?>			
											</center>					 
										</div>
										
										<div class="col-md-12">
											<center>
											<a href="javascript:void(0);" onmouseup="rating_item(<?php echo $quiz['quid']?>,'savsoft_quiz',<?php echo $quiz['reid']?>,<?php echo $quiz['r_value'] ?>, '<?php echo $quiz['r_content'] ?>');" title="<?php echo $quiz['num_rated']?> người đánh giá"><input id="result-rating<?php echo $quiz['quid']?>" class="rating rating-loading result-rating" value="<?php echo $quiz['avg_rated']?>" data-min="0" data-max="5"  data-size="cs"/></a>
											<center>
										</div>
									
									   </div>
								</div>
							 <?php } ?>
							<div class="col-md-12">
								<center>
								<?php
								if(sizeof($quiz_list)!=0){
									?>
									 <ul class="pagination listpage pagequiz">
										
									 <?php if($numpage<11){ ?>
									 <?php for($k=0; $k<$numpage; $k++){?> 
									 
									<li class="page-item <?php if($k+1==$page){?> active <?php } ?>"><a class="page-link" href="<?php
									$href=site_url('sadmin/quiz_list/'.($k+1).'?cid='.$cid.'&lid='.$lid.'&sortby='.$sortby.'&search='.$search);
									echo $href;
									?>"><?php echo  $k+1 ?></a></li>
									 <?php }?> 
								  <?php }else{?>
								  
									
										 <li class="page-item <?php if($page==1){?> active <?php } ?>"><a class="page-link" href="<?php 
											$href=site_url('sadmin/quiz_list/1')."?";
											if($cid!=0){
											  $href.="cid=".$cid;  
											}
											if($lid!=0){
											  $href.="&lid=".$lid;  
											}
											if($sortby!=0){
											  $href.="&sortby=".$sortby;  
											}
											if($search!=0){
											  $href.="&search=".$search; 
											}
											echo $href;
										 ?>">1</a></li>
										  <?php if($pstart>2){ ?> 
											  <li class="page-item"><a class="page-link"> ... </a></li>
										  <?php } ?>
										<?php for($k=$pstart; $k<$pstart+7; $k++){?> 
										   <li class="page-item <?php if($k==$page){?> active <?php } ?> "><a class="page-link" href="<?php 
										   $href=site_url('sadmin/quiz_list/'.$k)."?";
											if($cid!=0){
											  $href.="cid=".$cid;  
											}
											if($lid!=0){
											  $href.="&lid=".$lid;  
											}
											if($sortby!=0){
											  $href.="&sortby=".$sortby;  
											}
											if($search!=0){
											  $href.="&search=".$search; 
											}
											echo $href;
										   ?>"><?php echo  $k ?></a></li>
										<?php }?> 
										<?php if($pstart+7<$numpage){ ?> 
											  <li class="page-item"><a class="page-link"> ... </a></li>
										  <?php } ?>
										 <li class="page-item <?php if($page==$numpage){?> active <?php } ?>"><a class="page-link" href="<?php 
											$href=site_url('sadmin/quiz_list/'.$numpage)."?";
											if($cid!=0){
											  $href.="cid=".$cid;  
											}
											if($lid!=0){
											  $href.="&lid=".$lid;  
											}
											if($sortby!=0){
											  $href.="&sortby=".$sortby;  
											}
											if($search!=0){
											  $href.="&search=".$search; 
											}
											echo $href;
										 ?>"><?php echo  $numpage ?></a></li>
									 <?php }?>
										  
										
									  </ul>
									<?php
								}else{
									?> 
									<h3><b>Không có dữ liệu</b></h3>
									<?php
								}
								?>
									
								</center>
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
	  

      	<div class="modal fade" id="inviteModal" role="dialog">
      		<div class="modal-dialog">
      			<div class="modal-content">
      				<div class="modal-header">
	    				<button type="button" class="close" data-dismiss="modal">&times;</button>
	    				<h4 class="modal-title">Giao bài kiểm tra</h4>
	    			</div>
	    			<div class="modal-body">
	    				<form id="inviteModalForm">
	    					<p id="inviteMsg" style="display: none;" class=" text-danger"></p>
	    					<input type="hidden" name="quid" id="quid"/>
	    					<div class="form-group">
    						<label>Ngày bắt đầu</label>
 	    						<input class="form-control" value="<?php echo date("Y-m-d"); ?>" type="date" name="startdate" id="startdate" />
 	    						<label>Ngày kết thúc</label>
 	    						<input class="form-control" value="<?php echo (new DateTime(date("Y-m-d")))->add(new DateInterval("P1D"))->format('Y-m-d'); ?>" type="date" name="enddate" id="enddate" />
 	    					</div>
 	    					<div class="assign-tab">
 	    						<ul class="nav nav-tabs">
 								    <li class="active" id="tabstudent"><a data-toggle="tab" href="#studenttab">Học sinh</a></li>
									<?php
									if($su != 4){
										?>
 								    <li id="tabclass"><a data-toggle="tab" href="#classtab" id="assClass">Lớp</a></li>
										<?php
									} 
									?>
 							  	</ul>
 
 							  	<div class="tab-content">
 							    	<div id="studenttab" class="tab-pane fade in active">
 							      		<table id="tblStudentAssign" class="display" style="width:100%">
												 </table>
												 <center>
															<ul class="pagination listpage pageqt">
																<?php if($np_std>6){?>
																<li class="page-item active" onclick="page_std(0)"><a class="page-link">1</a></li>
																<li class="page-item" onclick="page_std(1)"><a class="page-link">2</a></li>
																<li class="page-item" onclick="page_std(2)"><a class="page-link">3</a></li>
																<li class="page-item" onclick="page_std(3)"><a class="page-link">4</a></li>
																<li class="page-item" onclick="page_std(4)"><a class="page-link">5</a></li>
																<?php if($np_std>7){ ?>
																<li class="page-item"><a class="page-link">...</a></li>
																<?php } ?>
																<li class="page-item" onclick="page_std(<?php  echo $np_std-1 ?>)"><a class="page-link">
																		<?php echo $np_std ?></a></li>
																<?php }else{?>
																<li class="page-item active" onclick="page_std(0)"><a class="page-link">1</a></li>
																<?php for($i=1; $i<$np_std; $i++){?>
																<li class="page-item" onclick="page_std(<?php  echo $i ?>)"><a class="page-link">
																		<?php  echo $i+1 ?></a></li>
																<?php }?>
																<?php }?>
															</ul>
														</center>
 							    	</div>
										 <div style="display:none">
															<input type="text" id="search_std" value="">
															<input type="text" id="page_std" value="0">
															<input type="text" id="quidd" value="">
											</div>
 							    	<div id="classtab" class="tab-pane fade">
 							      		<table id="tblClassAssign" class="display" style="width:100%"></table>

 						    	</div>
									 <div style="display:none">
															<input type="text" id="search_cl" value="">
															<input type="text" id="page_cl" value="0">
											</div>
 							  	</div>
 							</div>
	    				</form>
	    			</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
	      				<!--<button id="btnInvite" type="button" class="btn btn-primary">Lưu</button>-->
	      			</div>
      			</div>
      		</div>
      	</div>
    </section>
	
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

