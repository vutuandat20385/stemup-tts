<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>


	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/minhash.js');?>"></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
    <script src="<?php echo base_url('js/setbackground.js');?>"></script>

	<script src="<?php echo base_url('js/group.js');?>"></script>
	<script>

	
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
    var su="<?php echo $su ?>";
	var id_mcq_fun="<?php echo $id_mcq_fun ?>";
    var id_quiz_fun="<?php echo $id_quiz_fun ?>";
	</script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
<script src="<?php echo base_url('js/editprofile.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>

	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
		<script src="<?php echo base_url('js/leftmenu_mod.js');?>"></script>
	<script src="<?php echo base_url('js/notification.js');?>"></script>
		<script src="<?php echo base_url('js/star-rating.js');?>"></script>
	<script src="<?php echo base_url('js/assign.js');?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
  </head>
  <body class="bg-body">
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  if(document.body.clientWidth<769) return;
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<nav class="navbar navbar-stem navbar-fixed-top">
  <div class="container">
  	    <!-- Brand and toggle get grouped for better mobile display -->
  	     <!-- Brand and toggle get grouped for better mobile display -->
  	    	 <div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand navbar-brand1" href="<?php echo site_url('home_user') ?>">
					<img class="hidden-xs" src="<?php echo base_url('images/hu_logo_home1.png');?>" alt="">
					<img class="visible-xs-block logo-s" src="<?php echo base_url('images/hu_logo_home1.png');?>" height="32" alt="">
			  </a>
			<div class="pull-right text-trang-mobile visible-xs-block">
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>">
					<i class="mr-5 fas fa-cloud"></i>
					<br class="hidden-xs">
				</a>
				<a class="text-trang hover text-center text-l"  href="<?php echo site_url('home_user/notifications') ?>">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount mr-5"></span>
					<!-- <i class="mr10 fa fa-angle-right"></i> -->
				</a>
				<a href="#" class="text-trang hover " data-toggle="collapse" data-target="#search_top" id="icosearch_top">
					<i class="fas fa-search"></i>
				</a>
			     
			</div>
	    </div>
  	     <!-- Collect the nav links, forms, and other content for toggling -->
		<div class="panel-collapse collapse" id="search_top">
			 <form class="navbar-form navbar-left" role="search">
			  <div class="input-group">
			    <input id="inpsearch_top" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
			    <a href="#" class="input-group-addon addon-TK1 searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
		<div class="panel-collapse" id="search_top_dt">
			 <form class="navbar-form navbar-left" role="search">
			  <div class="input-group">
			    <input id="inpsearch_top_dt" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text" onkeyup="search_question(this, event)" >
			    <a href="#" class="input-group-addon addon-TK1 searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
  	    <div class="collapse navbar-collapse" id="defaultNavbar1">
 	        <ul class="nav navbar-nav navbar-right">
  	        <li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user'); ?>"><i class="mr-5 fas fa-home"></i><br class="hidden-xs">Trang chủ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="#assign_quiz" onclick="quizAssignTo(event);"><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/results'); ?>"><i class="mr-5 far fa-chart-bar"></i><br class="hidden-xs">Kết quả</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>"><i class="mr-5 fas fa-cloud"></i><br class="hidden-xs">Thư viện</a>
			</li>
			<!--<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('message'); ?>"><i class="far fa-envelope"></i><span class="badge badge-sm up bg-pink count mcount"></span><br  class="hidden-xs">Tin nhắn</a>
			</li>-->
			<li class="dropdown ndropdown pointer">
				<a class="text-trang hover text-center text-l" data-toggle="dropdown">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount  mr-5"></span>
					<br class="hidden-xs">Thông báo
				</a>
				<div  class="dropdown-menu" id="notifications">
                    <!-- <h3>Notifications</h3> -->
                    <header class="dropdown__header fx-lt">
                    	<div class="dropdown__title fx mr10"> 
	                    	<span translate="">
	                    		<span>Thông báo</span>
	                    	</span> 
                    	</div>
                    	<a class="dropdown__setting">
                    		<i class="udi fas fa-cog"></i>
                    	</a>
                    </header>
                    <div class="notification__list">
                    </div>
                    <div class="dropdown__footer">
                    	<a class="link--dropdown-footer link--see-all" href="<?php echo site_url('home_user/notifications') ?>">
                    		Xem tất cả
                    		<i class="mr10 fa fa-angle-right"></i>
                    	</a>
                    </div>
                </div>
			</li>
			
			 <li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/moderate_question'); ?>"  ><i class="fas fa-check-circle"></i><span class="badge badge-sm up bg-pink count modcount"></span><br  class="hidden-xs">Kiểm duyệt</a>
			</li>
				
  	        <li class="dropdown"><a href="#" class="dropdown-toggle bt-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
  	        	<?php if($link_photo) { ?>
    			    <img id="avt" class=" img-circle MR5" src="<?php echo $link_photo;?> " alt="" width="32" height="32">
    			<?php } else{ ?>   
    			   <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="32">
    			<?php } ?> 
  	        	<span class=" 
caret caret_e 
"></span></a>
  	          <ul class="dropdown-menu dropdown-menu1">
  	           <!-- <li><a href="#"><i class="MR10 far fa-file-alt text-primary" aria-hidden="true"></i>Bảng tin</a></li>
  	            <li><a href="#"><i class="MR10 far fa-comments text-danger" aria-hidden="true"></i>Tin nhắn</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-th-large text-success" aria-hidden="true"></i>Khóa học</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-calendar text-danger" aria-hidden="true"></i>Sự kiện</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-users text-info" aria-hidden="true"></i>Nhóm</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-address-book text-warning" aria-hidden="true"></i>Dánh sách bạn bè</a></li> -->
				<li><a data-toggle="modal" data-target="#transferModal" href="#"><i class="MR10 fas fa-exchange-alt text-warning" aria-hidden="true"></i>Chuyển điểm</a></li>
  	            <li><a href="<?php echo site_url('profile')?>"><i class="MR10 fas fa-user text-success" aria-hidden="true"></i>Thông tin cá nhân</a></li>
				<li><a data-toggle="modal" data-target="#changepwdModal" href="#"><i class="MR10 fas fa-cog" aria-hidden="true"></i>Đổi mật khẩu</a></li>
  	            <li><a href="<?php echo site_url('user/logout');?>"><i class="MR10 fas fa-sign-out-alt"></i> Đăng xuất</a></li>
              </ul>
            </li>
				<!-- <li>
				<a class="text-trang hover text-center text-TV" href="#">Mời thành viên</a>
			</li> -->
          </ul>
        </div>
  	    <!-- /.navbar-collapse -->
  </div>
  	  <!-- /.container-fluid -->
	   <section class="visible-xs-block nav-mobile">
			<ul class="ul-mobile list-unstyled">
				<li class="mbqmn"><a data-toggle="collapse" href="#">Trắc nghiệm</a></li>
				<li class="mbclmn"><a  data-toggle="collapse" href="#">Lớp</a></li>
				<li class="mbgrmn"><a  data-toggle="collapse" href="#">Nhóm</a></li>
				<li><a >Hướng dẫn</a></li>
			</ul>

		<ul id="tnmncl" class="panel-collapse collapse">
              
              <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
			  <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			  <a href="<?php echo site_url('home_user/create_question'); ?>" class="list-group-item createQuestionItem"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
			  <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			  <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
			  <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item"> <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
			  <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			  <a href="#assign_quiz" class="list-group-item" onclick="quizAssignTo(event);"> <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item" > <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
			   <a href="<?php echo site_url('home_user/moderate_question'); ?>" class="list-group-item" > <i class="fas fa-check-circle" style="margin-right:5px"></i> Kiểm duyệt</a>

			  
		</ul>
		<ul id="clmncl" class="panel-collapse collapse">	
                <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>   onclick="manage_class(event);"> <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
			 <a href="#create_class" class="list-group-item" onclick="create_class(event);"> <i class="fab fa-dropbox" style="margin-right:5px"></i> Tạo một lớp</a>
		</ul>
		<ul id="grmncl" class="panel-collapse collapse">	
	          <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
			 <a href="<?php echo site_url('home_user/manage_group') ?>" class="list-group-item""> <i class="fas fa-object-group" style="margin-right:5px"></i> Quản lý nhóm</a>
			  <a href="<?php echo site_url('home_user/create_group') ?>" class="list-group-item"> <i class="fas fa-folder-open" style="margin-right:5px"></i> Tạo một nhóm</a>
		</ul>
			
	  </section>
  </nav><!--end nav-->
<main class="container MT70">
	
	<div class="modal fade" id="transferModal" role="dialog">
		<div class="modal-dialog">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Chuyển điểm</h4>
				 
				</div>
				<div class="modal-body">
				     <form method="post" action="<?php echo site_url('tranfer_point/tranfer_1/');?>">
						<div class="col-md-12">
						   <p class="col-md-4">Chuyển tới:</p>
						   <input  class="col-md-8" type="text" class="form-control" name="user_received" value="" placeholder="Nhập vào email của người bạn muốn cho điểm"  required />
					   </div>
					  <div class="col-md-12">
						   <p class="col-md-4">Số điểm cần chuyển:</p>
						   <input  class="col-md-8"  type="number" class="form-control" name="point_tranfer" value="" placeholder="Nhập số điểm cần chuyển" min=0 required />
					   </div>
					   <div class="col-md-12">
							<p class="col-md-4">Mật khẩu:</p>
							<input class="col-md-8" type="password" class="form-control" name="pwd_tranfer" value="" placeholder="Nhập mật khẩu tài khoản của bạn"  required />
					  </div> 
					  <div class="col-md-12">
							<p class="col-md-4">Nhập lại mật khẩu:</p>
							<input class="col-md-8" type="password" class="form-control" name="cmf_pwd_tranfer" value="" placeholder="Nhập lại mật khẩu tài khoản của bạn"  required />
					  </div> 
					  <div class="col-md-offset-10">
						<button  style="margin-top:30px" class="btn btn-success" type="submit">Xác nhận</button>
					  </div>
				    </form>
				    
				</div>
			
			 </div>
			  
		</div>
	</div>
	<div class="modal fade" id="joinGroupModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Tham gia nhóm</h4>
					</div>
					<div class="modal-body row col-xs-12">
								<div class="col-xs-9">
									<input type="text" class="form-control form-TK1 col-xs-8 " id="group_code" autocomplete="off" name="group_code" onkeyup="checkcodegroup(event,this.value)" placeholder="Nhập Mã nhóm">
								</div>
								<div class="col-xs-3" style="text-align:right">
									<button class="btn btn-primary" id="btjoingroup" onclick="checkcodegroupbt()" style="margin-left:3%" >Xác nhận</button>
								</div>
								<div class="col-xs-9">
								<p id="errorrr" style="color:red"></p>
								</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
  	</div>
	<div class="modal fade" id="infoModal" role="dialog">
		<div class="modal-dialog">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Thông tin cá nhân</h4>
				 
				</div>
				<div class="modal-body">

                    <table class="table table-user-information">
	                    <tbody>
		                    <tr>
		                        <td>Họ tên</td>
		                        <td >
		                        	<?php  echo $user_name?>
		                        </td>
		                        <td>
		                        	<!-- <a onclick="editButton(this)">
		                        		<i class="fa fa-pencil-alt"></i>
		                        		Edit
		                        	</a> -->
		                        </td>
		                    </tr>
                        	<tr>
                        		<td>Email</td>
                        		<td>
                        			<?php  echo $email ?>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
                        	<tr>
                        		<td>Số điện thoại</td>
                        		<td>
                        			<?php  echo $phone?>
                        		</td>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
							<tr>
                        		<td>Trường</td>
                        		<td>
                        			<?php  echo $school?>
                        		</td>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
							<tr>
                        		<td>Môn giảng dạy</td>
                        		<td>
                        			<?php  echo $subject?>
                        		</td>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
							<tr>
                        		<td>Lớp chủ nhiệm</td>
                        		<td>
                        			<?php  echo $homeroom?>
                        		</td>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
							<tr>
                        		<td>Lớp đang dạy</td>
                        		<td>
                        			<?php  echo $teach_class?>
                        		</td>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
                      		<tr>
                        		<td>Ảnh đại diện</td>
                        		<td >
                        			<?php if($link_photo) { ?>
                        			    <img id="avt" class="MR5" src="<?php echo $link_photo;?> " alt="" width="128">
                        			<?php } else{ ?>   
                        			   <img id="avt" class="MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="128">
                        			<?php } ?> 
                        		</td>
                        		<td>
                        			<a onclick="edit_avatar()">
                        				<i class="fa fa-pencil-alt"></i>
                        				Chỉnh sửa
                        			</a>
                        		</td>
                      		</tr>
	                    </tbody>
	                </table>
				    
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			 </div>
			  
		</div>
	</div>
    <div class="modal fade" id="editavtModal" role="dialog">
		<div class="modal-dialog">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Chỉnh sửa ảnh đại diện</h4>
				 
				</div>
				<div class="modal-body">
				     <form method="post" action="<?php echo site_url('home_user/upload_photo');?>" enctype="multipart/form-data">
						<label>Chọn ảnh :(chỉ hỗ trợ  .png và .jpg) </label> <input type="file" name="upload"/>
         	            <input style="margin-top:40px;" class="btn btn-success" type="submit" name="uploadclick" value="Xác nhận"/>
				    </form>
				    
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			 </div>
			  
		</div>
	</div>
	
	<div class="modal fade" id="changepwdModal" role="dialog">
 		<div class="modal-dialog">	 
 			 <div class="modal-content">
 				<div class="modal-header">
 				  <button type="button" class="close" data-dismiss="modal">&times;</button>
 				  <h4 class="modal-title">Đổi mật khẩu</h4>
 				</div>
 				<div class="modal-body">
 				     
 						  <div class="form-group">
 							<p>Mật khẩu hiện tại</p>
 							<input type="password" name="old_pwd" minlength="1" autofocus="autofocus" class="form-control" id="old_pwd" />
 						</div>
 						<div id="error" style="color: red;"></div>
 						<div class="form-group">
 						<p>Nhập mật khẩu mới</p>
 							<input type="password" name="new_pwd" minlength="1" class="form-control" id="new_pwd" />
 						</div>
 						<div id="error1" style="color: red;"></div>
 						<div>
 						</div>
 						 <div class="form-group">
 							<p>Nhập lại mật khẩu mới</p>
 							<input type="password" name="confirm_pwd" minlength="1" class="form-control" id="confirm_pwd" />
 						</div>
 						<div id="error2" style="color: red;"></div>
 						<div id="error3" style="color: green;"></div>
 						<div class="form-group">
 							<button type="submit" class="btn btn-primary oe_form_button" id="submit_cpw" name = "submit">Cập nhật</button>
 						</div>
 						<script type="text/javascript">
 							$('#submit_cpw').on("click",function(){
 								$("#error").empty();
 								$("#error1").empty();
 								$("#error2").empty();
 								$("#error3").empty();
 								var old_pwd =$("#old_pwd").val();
 								var new_pwd =$("#new_pwd").val();
 								var confirm_pwd =$("#confirm_pwd").val();
 								if(old_pwd==''){
 									$("#error").html("(<i>Mời bạn nhập Mật khẩu hiện tại</i>)");
 								}else 
 								if(new_pwd==''){
									$("#error1").html("(<i>Mật khẩu mới không được để trống</i>)");
								}else
								if (confirm_pwd==''){
									$("#error2").html("(<i>Mời bạn nhập vào Mật khẩu mới</i>)");
								}else
								if (confirm_pwd!=new_pwd){
									$("#error2").html("(<i>Mật khẩu xác nhận không trùng khớp</i>)");
								}
								else{
									$.ajax({
							        type: 'POST',
							        data: {old_pwd:old_pwd,new_pwd:new_pwd,confirm_pwd:confirm_pwd},
							        url: "<?php  echo site_url('/user/changepassword') ?>",
							        success: function(data){
							        	// console.log(data);
	                                    if(data==0){
	                                    	 // console.log("Mật khẩu hiện tại không đúng nhé");
	                                    	 $("#error").html("(<i>Mật khẩu hiện tại không đúng</i>)");
	                                    }else
	                                     if(data==2){
	                                    	 // console.log("Mật khẩu xác nhận không trùng khớp với mật khẩu mới");
	                                    	 $("#error2").html("(<i>Mật khẩu xác nhận không trùng khớp với mật khẩu mới</i>)");
	                                    }else
	                                    if(data==3){
	                                    	 // console.log("Thay đổi mật khẩuthành công");
	                                    	 $('#changepwdModal').modal('hide');
	                                    	 alert("Thay đổi mật khẩu thành công!");
	                                    	 sendemail_changepassword();
	                                    }
							        },
							        error: function(data) {
							            // console.log(data);
							        }
								    });
							    }

						    });

 						</script>
 						
	 					<!-- 	if($this->session->flashdata('wrong_password')){ 
					  			$wrong_password=$this->session->flashdata('wrong_password');}
							if($this->session->flashdata('matkhaudetrong')){
								$matkhaudetrong=$this->session->flashdata('matkhaudetrong');}
							if($this->session->flashdata('matkhaumoi')){
								$matkhaumoi= $this->session->flashdata('matkhaumoi');}		
							if($this->session->flashdata('change_sucsess')){
								$change_sucsess=$this->session->flashdata('change_sucsess');}
 					 -->
 						 
 						<!-- <script type="text/javascript">
						$('#submit_cpw').on("click",function(){
								var old_pwd =$("#old_pwd").val();
								var new_pwd =$("#new_pwd").val();
								var confirm_pwd =$("#confirm_pwd").val();
								var error =$("#error");
								error.html("");
								
								if(old_pwd==""){
									console.log('aaaaaaaaaaaa');
									error.html("(<i>Mời bạn nhập Mật khẩu hiện tại</i>)");
									return false;
								}else {
									var wrong_password= '<php echo $wrong_password; ?>';
									var matkhaudetrong= '<php echo $matkhaudetrong; ?>';
									var matkhaumoi= '<php echo $matkhaumoi; ?>';
									var change_sucsess= '<php echo $change_sucsess; ?>';
									if(wrong_password!=''){
										error.html(wrong_password);
									}else if(matkhaudetrong!=''){
										$("#error1").html(matkhaudetrong);
									}else if(matkhaumoi!=''){
										$("#error1").html(matkhaudetrong);
									}else if(change_sucsess!=''){
										$("#error1").html(change_sucsess);
									}
									
									/**/
									console.log('ccccccccccc');
								}
							});
 						</script> -->
 				    
 				    
 				</div> 
 				<div class="modal-footer">
 				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 				</div>
 		 </div>
 		</div>
 	</div>
    <div class="modal fade" id="editquestionModal" role="dialog">
		<div class="modal-dialog" style="width:80%">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Chỉnh sửa câu hỏi</h4>
				 
				</div>
				   <form id="editquestionform" method="post" action="" >
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
									<div class="col-md-3" style="margin-top:20px">Chọn môn học:</div>
									<div class="col-md-9" style="margin-top:20px" ><select class="form-control col-md-9" id="cidedt" name="cid"><?php foreach($category_list as $key => $val){ ?>  <option value="<?php echo $val['cid'];?>" id="cat<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option><?php }?></select></div>
									<div class="col-md-3" style="margin-top:20px" > Chọn lớp:</div>
									<div class="col-md-9" style="margin-top:20px"><select class="form-control" id="lidedt" name="lid"><?php foreach($level_list as $key => $val){?> <option value="<?php echo $val['lid'];?>" id="lv<?php echo $val['lid'];?>"><?php echo $val['level_name'];?></option><?php }?></select></div>
									<div class="col-md-3" style="margin-top:20px">Giải thích:</div>
									<div class="col-md-9" style="margin-top:20px"><textarea  name="description"  class="form-control" id="descredt"></textarea></div>
									<div class="col-md-3" style="margin-top:20px">Từ khóa:</div>
									<div class="col-md-9" style="margin-top:20px"><input type="text" class="form-control" style="margin-bottom:20px" name="tags" value="" id="tagsedt"></div>
									<div class="col-md-3" style="margin-top:20px">Thời gian làm bài:(tính bằng giây)</div>
									<div class="col-md-9" style="margin-top:20px"><input type="number" class="form-control" style="margin-bottom:20px" name="answer_time" value="60" id="answer_timeedt"></div>
									<div class="col-md-3" style="margin-top:20px">Nguồn :</span></div>
								<div class="col-md-9" style="margin-top:20px"><input name="sourcemcq" id="sourcemcq_e" type="text" class="form-control" style="margin-bottom:20px" value=""></div>
								
								</div>
							</div>
							
					    
					    
					</div>
					<div class="modal-footer">
						<input class="btn btn-success" type="submit" onclick="save_edit_qt()" value="Xác nhận"/>
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				
			 </div>
			  
		</div>
	</div>
	<div class="modal fade" id="previewquestionModal" role="dialog">
		<div class="modal-dialog" style="width:40%">	 
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
				  <button type="button" class="close" onclick="reload()" data-dismiss="modal">&times;</button>
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
				  <button type="button" class="btn btn-default" onclick="reload()" data-dismiss="modal">Hủy</button>
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
    <div class="modal fade" id="question_wbg" role="dialog" >
        <div class="modal-dialog" style="width:40%">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" id="clmdprbg" class="close" data-dismiss="modal">&times;</button>
                   
                </div>
                <div class="modal-body">
                	<font id="fclqpr" color="white" >
		                <div contenteditable="true" id="qwbgpr" style="font-size: 33px; text-align:center ;font-weight: 700;padding: 100px 27px;" >

		                 
		                </div>
		          </font>
		     </div>
                <div class="modal-footer">
      				<table>
				    	<tr>
						    <?php for($i=0 ; $i<10; $i++){?>
				    		<td class="tranbtsbg"  style="opacity: 1; transform: translateX(<?php echo 30*$i ?>px);">
				    			<a id="mbgq<?php echo $i+1 ?>">
				    				<img src="<?php echo base_url('upload/background/'.($i+1).'.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>	
							<?php }?>
				    	</tr>	
						
						<tr>
						    <?php for($i=10 ; $i<20; $i++){?>
				    		<td class="tranbtsbg"  style="opacity: 1; transform: translateX(<?php echo 30*($i-10) ?>px);">
				    			<a id="mbgq<?php echo $i+1 ?>">
				    				<img src="<?php echo base_url('upload/background/'.($i+1).'.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>	
							<?php }?>

							  <td style="opacity: 1; transform: translateX(430px);">
								 <button type="button" id="clmdprbg_1" class="btn btn-success"  data-dismiss="modal">Xác nhận</button>
                           </td>	
				    	</tr>	
				    </table>
   
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
	<div class="modal fade" id="proposeratingModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" id= "titleproposeratingModal" >Đề xuất đánh giá</h3>
                </div>
                <div class="modal-body" id= "bodyproposeratingModal">


                </div>
                <div class="modal-footer">
                    <!--  <button type="button" class="btn btn-success" data-dismiss="modal">Cập nhật</button> -->
					<button type="button" id="pprtbutton" class="btn btn-success"  data-dismiss="modal">Gửi đề xuất</button>
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

	<section class="row">
  	  <aside class="col-md-2">
		  		 <div class="box-bor MB20 visible-xs-block">
			  <div class="media-object-default">
				 <div class="media">
				   <div class="media-left">
					   <a href="#">
					    <?php if($link_photo) { ?>
						 <img class="media-object img-thumbnail" src="<?php echo $link_photo;?> " width="80" alt="placeholder image">
    					<?php } else{ ?>   
						 <img class="media-object img-thumbnail" src="<?php echo base_url('upload/avatar/default.png');?>" width="80" alt="placeholder image">
    					<?php } ?> 
					      
					   </a>
				   </div>
				   <div class="media-body">
					 <h4 class="media-heading"><a href="#" class="border-B1"><?php echo $user_name; ?><br><span class="text-small1">Quản trị</span></h4>
					 <div class="box-diem-mobile">
						  <p class="text-diem1"><span class="text-diem"><?php echo $user_point." Sao" ?></span></p>
					 </div>
				   </div>
					

			  </div>
			</div>
		  </div>
		  <div class="box-bor MB20 hidden-xs">
			  <div class="text-center mb-10" style="">
			   <?php if($link_photo) { ?>
					<div style="height: 143px; background: url('<?php echo $link_photo;?>'); background-size: cover; background-position: center;margin-bottom: -8px"></div>
					<?php } else{ ?> 
                    <img class="MR5 img-thumbnail mb-10" src="<?php echo base_url('upload/avatar/default.png');?>" alt="">					
					<?php } ?> 
				 
				  <br>
				  <a href="#" class="border-B1"style="font-size: 16px"><?php echo $user_name; ?></a> <br><span class="text-small">(Quản trị)</span>
			  </div>	  
			
					  <div class="box-diem">
						  <p class="text-diem1"><span class="text-diem"><?php echo $user_point." Sao" ?></span></p>
					  </div>
				  	
				  </div>
			  </div>
		  </div>
		  <div class="list-group hidden-xs" id="top_menu">
			 <div style="display:none;" id="topname">quiz_menu</div>
			 <h3 class="list-group-item active1">Trắc nghiệm</h3>
			 <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			  <a href="<?php echo site_url('home_user/create_question'); ?>" class="list-group-item createQuestionItem"><i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
			  <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			  <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item" ><i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
			  <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item"> <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
			  <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			  <!--<a href="#assign_quiz" class="list-group-item" onclick="quizAssignTo(event);">Bài đã giao</a>-->
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i>  Kết quả</a>
			  <a href="<?php echo site_url('home_user/moderate_question'); ?>" class="list-group-item" > <i class="fas fa-check-circle" style="margin-right:5px"></i> Kiểm duyệt</a>
		  </div>
		 <div class="list-group hidden-xs" id="quiz_menu" style="display:none;">
			 <h3 class="list-group-item active1">Trắc nghiệm</h3>
			 <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			  <a href="<?php echo site_url('home_user/create_question'); ?>" class="list-group-item createQuestionItem"><i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
			  <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			  <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"><i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
			  <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item"> <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
			  <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			  <!--<a href="#assign_quiz" class="list-group-item" onclick="quizAssignTo(event);">Bài đã giao</a>-->
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i>  Kết quả</a>
			   <a href="<?php echo site_url('home_user/moderate_question'); ?>" class="list-group-item" > <i class="fas fa-check-circle" style="margin-right:5px"></i> Kiểm duyệt</a>
		  </div>
		  <div class="list-group hidden-xs" id="class_menu">
			  <h3 class="list-group-item active1">Lớp</h3>
			 <!-- <a href="#" class="list-group-item">Tạo một nhóm nhỏ</a>-->
			  <div id ="classpage_menu"></div>
			  <a href="<?php echo site_url('home_user/manage_class') ?>" class="list-group-item" > <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
			 <a href="#create_class" class="list-group-item" onclick="create_class(event);"> <i class="fab fa-dropbox" style="margin-right:5px"></i> Tạo một lớp</a>
			 <!-- <a href="#" class="list-group-item">Tham gia lớp</a>-->
		  </div>
		  <div class="list-group hidden-xs" id="group_menu">
			  <h3 class="list-group-item active1">Nhóm</h3>
			  <a href="<?php echo site_url('home_user/manage_group') ?>" class="list-group-item""> <i class="fas fa-object-group" style="margin-right:5px"></i> Quản lý nhóm</a>
			  <a href="<?php echo site_url('home_user/create_group') ?>" class="list-group-item"> <i class="fas fa-folder-open" style="margin-right:5px"></i> Tạo một nhóm</a>
			  <a data-toggle="modal" data-target="#joinGroupModal" class="list-group-item"> <i class="far fa-handshake" style="margin-right:5px"></i> Tham gia nhóm</a>
		  </div>
  	  </aside>
  	  <aside id="main_bussiness" class="col-md-7" style="display:none" >
	   <?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
	    if($this->session->flashdata('message2')){
 			echo $this->session->flashdata('message2');	
 		}
		?>	
		  <div class="box-lop" id="bannerpage">
			  <div class="line-L">
				  <h1>Lớp của <?php echo $user_name?></h1>
				  <!--<p>Văn Long Thạch - Lớp 9 - Tiếng Anh </p>-->
				 
		      </div>
		  </div>
		  <div role="tabpanel">
		    <ul class="nav nav-tabs MB20 bg-tab" role="tablist">
		      <li role="presentation" class="active" style="display: none;"><a href="#home2a" data-toggle="tab" role="tab" aria-controls="tab1">Đăng bài</a></li>
		     <!-- <li role="presentation"><a href="#paneTwo2" data-toggle="tab" role="tab" aria-controls="tab2">Thư mục</a></li>
			  <li role="presentation"><a href="#paneTwo3" data-toggle="tab" role="tab" aria-controls="tab2">Thành viên</a></li>
			  <li class="pull-right MR10">
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<i class="fas fa-cog MR10"></i>Cài đặt<span class=" 
caret caret_e 
"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li class="divider"></li>
					<li><a href="#">Separated link</a></li>
				  </ul>
				</div>
			  </li>-->
	        </ul>
		    <div id="tabContent2" class="tab-content">
				  <div role="tabpanel" class="tab-pane fade in active" id="home2a">
					<div class="box-bor MB20">
						<div role="tabpanel" id="tabs">
						  <ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">MCQ Fun</a></li>
							<li role="presentation"><a href="#home2" data-toggle="tab" role="tab" aria-controls="tab2" id="text-tabs2" style="display:none">Ghi chú</a></li>
						<!--	<li role="presentation" class="dropdown"><a href="#" id="tabDropOne1" class="dropdown-toggle" data-toggle="dropdown" role="tab" aria-controls="tab3" aria-haspopup="true" aria-expanded="false">Giao bài<span class=" 
caret caret_e 
"></span></a>
							  <ul class="dropdown-menu" aria-labelledby="tabDropOne1">
								<li><a href="#tabDropDownOne1" tabindex="-1" data-toggle="tab">Dropdown Link 1</a></li>
								<li><a href="#tabDropDownTwo2" tabindex="-1" data-toggle="tab">Dropdown Link 2</a></li>
							  </ul>
							</li>
							-->
						  </ul>
						  <div id="tabContent1" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="home1">
							   
							   <?php foreach($mcq_fun as $fun){ ?>
							      <div style="margin-bottom:120px">
							       <?php if($fun['background_template']!=0) { ?>
								   <div  id="qwbgpr" style="font-size: 33px; text-align:center ;font-weight: 700; width:550px; margin-left:50px; margin-bottom:20px" >
										<font color="white">
											<div style="padding: 120px 27px;text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url('https://stemup.app/upload/background/<?php echo $fun['background_template']?>.jpg'); height:300px"><?php echo $fun['question']?>
		                                    </div>
										</font>
								   </div>
								    <?php foreach($fun['options'] as $opt){?>
										<div class="col-xs-6" style="margin-bottom:10px"> 
											<label class="radio-inline w-100">
												 
													 <input class="MT10" type="radio" name="score" value='0'>
												   <div class="input-group">
													 <span class="input-group-addon">A</span>
													 <input id="optA1" type="text" class="form-control" name="option[]"  value="<?php echo $opt['q_option']?>"  readonly style="color: transparent;text-shadow: 0 0 0 #2196f3;" />
												   </div>
											
											</label>
										</div>
										
										
									<?php } ?>
								
								 <?php } ?>
								 </div>
								 <?php } ?>
								 
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
					<!-- <div class="box-bor MB20">
						  <div class="row">
							  <div class="col-xs-2">
								  Post:
							  </div>
							  <div class="col-xs-10 BL">
								  <a href="">Ghi chú</a>
								  <a href="">Cảnh báo</a>
								  <a href="">Nhiệm vụ</a>
							  </div>
						  </div>
						  <hr>
						  
						  <div class="row">
						      <!--
							  <div class="col-xs-2">
								  <img class="img-responsive img-thumbnail" src="<?php echo base_url('images/hu_mh1.jpg');?> " alt="">
							  </div>
							  <div class="col-xs-10 BL">
							    <div class="media-object-default">
								     <div class="media">
								       <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?> " alt="placeholder image"></a></div>
								       <div class="media-body">
								         <h4 class="media-heading">Media heading 1</h4>
								         This is the content inside the media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively. </div>
						          </div>
								     <div class="media">
								       <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
								       <div class="media-body">
								         <h4 class="media-heading">Media heading 2</h4>
								         This is the content inside the media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively.
								         <div class="media">
								           <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
								           <div class="media-body">
								             <h4 class="media-heading">Nested media heading</h4>
								             This is the content inside the nested media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively. </div>
							             </div>
							           </div>
						          </div>
								     <div class="media">
								       <div class="media-body">
								         <h4 class="media-heading">Media heading 4</h4>
								         This is the content inside the media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively. </div>
								       <div class="media-right"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
						          </div>
								     <div class="media">
								       <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
								       <div class="media-body">
								         <h4 class="media-heading">Media heading 5</h4>
								         This is the content inside the media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively. </div>
								       <div class="media-right"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
						          </div>
						        </div>
                              </div>
						  </div>
						   
					  </div>
				  </div>
		      <div role="tabpanel" class="tab-pane fade" id="paneTwo2">
		        <div class="box-bor MB20">
					<p>Content 2</p>
				  </div>
	          </div>
				<div role="tabpanel" class="tab-pane fade" id="paneTwo3">
				  <div class="box-bor MB20">
					<p>Content 3</p>
				  </div>
				</div>-->
		      
	        </div>
	    </div>
	
      </aside>
	  
	  <aside class="col-md-7" id= "new_main_page">
	       <div id="bannerpage_m" style="display:none;">
	      <div class="box-lop"><div class="line-L"><h1>Trắc nghiệm</h1></div></div>
		  <br/>
		  </div>
		  <div class="box-bor mb-20">
		       <form method="post" action="<?php echo site_url('qbank/new_question_0/4/0')?>">
				  <div class="box-cauhoi">
					  <div class="input-group">
						<?php if($link_photo) { ?>
							<div class="input-group-addon w200"><a href=""><img class="img-responsive img-circle" src="<?php echo $link_photo;?>" alt=""></a></div>
						<?php } else{ ?>   
							<div class="input-group-addon w200"><a href=""><img class="img-responsive img-circle" src="<?php echo base_url('upload/avatar/default.png');?>" alt=""></a></div>
						<?php } ?> 
						
						<textarea name="question" class="form-control bo-none" style=" resize: none;" rows="1" id="create_question_main" placeholder="Tạo câu hỏi trắc nghiệm"></textarea>
						<script type="text/javascript">
							$("#create_question_main").on("click",function(){
								 // var htmlbi="1";
							var htmlxx="";
									if($(window).width()<1100){
										
										if($(window).width()>767){
											htmlxx+=' <table>'+
											'<tr>'+
												'<td>Chọn màu nền  </td>';
										}
										else{
											htmlxx+=' <table>'+
				   						 	'<tr>'+
                         					   '<td>Chọn màu nền  </td>'+
											'</tr>'+
                       						'<tr>';
										}
									}
       								else{
										htmlxx+='<div id="bg_template"class="form-group MT20" style="margin-bottom:50px">';
										htmlxx+=' <table>'+
				   						 	'<tr>'+
                           						'<td>Chọn màu nền  </td>'+
											'</tr>'+
                      						 '<tr>';
									}		
									if($(window).width()<1100){
										for(i=0; i<10; i++){
												htmlxx+=	'<td class="tranbtsbg openbgc"  style="opacity: 1; transform: translateX('+30*i+'px);">'+
													'<a id="bgq'+(i+1)+'">'+
														'<img src="https://stemup.app/upload/background/'+(i+1)+'.jpg" class="imgbgrbt" >'+
													'</a>'+
												   '</td>';
										}	
									   for(i=10; i<20; i++){
												htmlxx+=	'<td class="tranbtsbg openbgc"  style="opacity: 1; transform: translate('+30*(i-10)+'px,40px);">'+
													'<a id="bgq'+(i+1)+'">'+
														'<img src="https://stemup.app/upload/background/'+(i+1)+'.jpg" class="imgbgrbt" >'+
													'</a>'+
												   '</td>';
										}
									}
							        else{
										for(i=0; i<20; i++){
												htmlxx+=	'<td class="tranbtsbg openbgc"  style="opacity: 1; transform: translateX('+30*i+'px);">'+
													'<a id="bgq'+(i+1)+'">'+
														'<img src="https://stemup.app/upload/background/'+(i+1)+'.jpg" class="imgbgrbt" >'+
													'</a>'+
												   '</td>';
										}	
									}		
				
								 $("#background-img").empty();
								 $("#background-img").append(htmlxx);
							});
						</script>
					  </div>
				  </div>
				  <div id="collapse_qt_box" class="collapse">
						<div class="form-group MT20">
							<table style="margin-left:10px; margin-bottom:40px">
								<tr id="background-img">
									
								<tr>	
							</table>
						</div>
						  <input class="form-control" id= "bgqid_main" rows="3" name="bgqid" value="0" style="display:none;">
					  <div class="row MB20">
						<div class="col-xs-6">
							<label class="radio-inline w-100">
									 <input class="MT10" type="radio" name="score" value='0'>
								   <div class="input-group">
									 <span class="input-group-addon">A</span>
									 <input id="opt_crq_0" type="text" class="form-control" name="option[]" placeholder="Điền phương án A">
								   </div>
							</label>
						</div>
						<div class="col-xs-6">
							<label class="radio-inline w-100">
									<input class="MT10" type="radio" name="score" value='1'>
								   <div class="input-group">
									 <span class="input-group-addon">B</span>
									 <input id="opt_crq_1" type="text" class="form-control" name="option[]" placeholder="Điền phương án B">
								   </div>
							</label>
						</div>
					  </div>
					  <div class="row">
						<div class="col-xs-6">
							<label class="radio-inline w-100">
									<input class="MT10" type="radio" name="score" value='2'>
								   <div class="input-group">
									 <span class="input-group-addon">C</span>
									 <input id="opt_crq_2" type="text" class="form-control" name="option[]" placeholder="Điền phương án C">
								   </div>
							</label>
						</div>
						<div class="col-xs-6">
							<label class="radio-inline w-100">
								 <input class="MT10" type="radio" name="score" value='3'>
								   <div class="input-group">
									 <span class="input-group-addon">D</span>
									 <input id="opt_crq_3" type="text" class="form-control" name="option[]" placeholder="Điền phương án D">
								   </div>		
							</label>
						</div>
					  </div>
					   <div id="collapse_opt_box" class="collapse">	
					       <div class="col-md-12">
								<div class="col-md-3" style="margin-top:20px">Dạng câu hỏi: </div>
								<div class="col-md-3" style="margin-top:20px"> <input name="q_type" value="1" type="radio"> Trắc nghiệm</div>
								<div class="col-md-3" style="margin-top:20px"> <input name="q_type" value="2" type="radio"> Video </div>
								<div class="col-md-3" style="margin-top:20px"> <input name="q_type" value="3" type="radio"> Bài đọc </div>
											
						  </div>
						  <div class="col-md-12">
								<div class="col-md-3" style="margin-top:20px">Chọn là MCQ Fun: </div>
								<div class="col-md-9" style="margin-top:20px"> <input  id="mcq_fun_main" name="mcqfun" value="0" type="checkbox"></div>
							</div>	
							<?php if($su==3){?>
							  <div class="col-md-12">
								<div class="col-md-3" style="margin-top:20px">Hiển thị logo: </div>
								<div class="col-md-9" style="margin-top:20px"> <input id="main_logorg" name="logorg" value="1" type="checkbox" checked></div>
                            </div>
							<?php }?>
						   <div class="col-md-12">
								<div class="col-md-3" style="margin-top:20px">Chọn môn học <span style="color:red">(*)</span>:</div>
								  <div class="col-md-9" style="margin-top:20px" ><select name="cid" id="sl_categ_main" class="form-control col-md-9" required><option value="">-------Chọn môn học--------</option><?php foreach($category_list as $key => $val){ ?>  <option value="<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option><?php }?></select></div>
								 <div class="col-md-3" style="margin-top:20px" > Chọn lớp <span style="color:red">(*)</span>:</div>
								 <div class="col-md-9" style="margin-top:20px"><select name="lid" id="sl_level_main" class="form-control" required> <option value="">-------Chọn lớp -------------</option> <?php foreach($level_list as $key => $val){?> <option value="<?php echo $val['lid'];?>"><?php echo $val['level_name'];?></option><?php }?></select></div>
								 <div class="col-md-3" style="margin-top:20px">Giải thích </span>:</div>
								 <div class="col-md-9" style="margin-top:20px"><textarea  id="descr_main" name="description" class="form-control" ></textarea></div>
								 <div class="col-md-3" style="margin-top:20px">Từ khóa <span style="color:red">(*)</span>:</div>
								<div class="col-md-9" style="margin-top:20px"><input name="tags" id="tags_main" type="text" class="form-control" style="margin-bottom:20px" value="" required></div>
								<div class="col-md-3" style="margin-top:20px">Thời gian làm bài:(tính bằng giây) <span style="color:red">(*)</span></div>
								<div class="col-md-9" style="margin-top:20px"><input name="answer_time" id="time_main" type="number" class="form-control" style="margin-bottom:20px" value="60" min="0" required></div>
								<div class="col-md-3" style="margin-top:20px">Nguồn :</span></div>
								<div class="col-md-9" style="margin-top:20px"><input name="sourcemcq" id="sourcemcq_main" type="text" class="form-control" style="margin-bottom:20px" value=""></div>
								<div class="col-md-3" style="margin-top:20px">Tiết :</span></div>
								<div class="col-md-9" style="margin-top:20px"><input name="unitmcq" id="unitmcq_main" type="text" class="form-control" style="margin-bottom:20px" value=""></div>
								<div class="col-md-3" style="margin-top:20px">Bài :</span></div>
								<div class="col-md-9" style="margin-top:20px"><input name="lessonmcq" id="lessonmcq_main" type="text" class="form-control" style="margin-bottom:20px" value=""></div>
						 </div>
						 <div class="col-md-12"><p class="text-center MT10 text-do" id="support">Từ khóa: liên kết các câu hỏi liên quan đến nhau. Một câu hỏi có thể nhiều từ khóa.</p></div>
						<div class="col-md-12"><p class="text-center MT10 text-do" id="support">Lưu ý: các từ khóa cách nhau bởi dấu phẩy (,) </p></div>
						<div class="col-md-12"><p class="text-center MT10 text-do" id="support">(*): Thông tin bắt buộc </p></div>
					</div>
					<p class="text-center MT10 text-do">Tích chọn câu trả lời đúng trước khi lưu</p>
					<div class="text-center">
						<button id="loadopt" type="button" class="btn btn-primary" onclick="load_opt_main(this)" disabled style="display:none;">Lưu</button>
						<button type="button" class="btn btn-default" id="cancel_btn_crmain"> Hủy</button>
					</div>
				 
				</div>
			 </form>  
		</div>
		</div>
	
 		<?php if(count($mcq_fun)==0){?>
		 		  <script>alert("Không tìm thấy câu hỏi phù hợp!");
		  window.location.href =site_url+"/home_user";
		  </script>
		  <?php }?>
		 <?php foreach( $mcq_fun as $mcq) {?>
		 <div class="box-bor1 mb-20 moremcq_<?php echo $mcq['qid']?>">
			  <!--<h4 class="tle1">Bài viết</h4>-->
			  <div>
				  <div class="row1" style="margin-top:20px">
					  <div class=col-xs-10>
						  <div class="w60"><a class="pointer" ><img class="img-responsive img-circle" src="<?php echo base_url('upload/symbol/'.$mcq['cid'].'.png');?>" alt=""></a></div>
						  <h4 class="mb-0"><a class="pointer" href="<?php echo site_url('/page/category/'.$mcq['category_permalink'])?>"><b><?php echo $mcq['category_name']?></b></a> 
						   <span style="margin-left:10px" class="dropdown pointer"><a class="dropdown-toggle"  data-toggle="dropdown">
							<span class="caret caret_e"></span></a>
						  <div class="dropdown-menu dropdown-menu_e"style="overflow-y:scroll; height: 273px;font-size:15px">
						      <?php foreach ($category_list as $ct){?>
							  <li><a href="<?php echo site_url('/page/category/'.$ct['category_permalink'])?>"><b><?php echo $ct['category_name']?></b></a></li>
							  <?php } ?>
							</div>
						  
						  </span>
						  <br></h4>
						  <span class="text-small1"><?php echo $mcq['str_time_ago'] ?></i></span>
					  </div>
					  
					  <!--<div class="col-xs-2 text-right">
						 
						<div class="btn-group">
						  <button type="button" class="btn btn-default dropdown-toggle btn-none" data-toggle="dropdown">
							<span class="f20">...</span>
						  </button>
						  <ul class="dropdown-menu dropdown-menu-right" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						  </ul>
						</div>
					  </div>-->
				  </div>
				  <div class="col-xs-12" style="margin-bottom:10px">
				        <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank" style="color:#fff">
					   <?php if(strpos($mcq['question'],'https://latex.codecogs.com')!==false || (strpos($mcq['question'], '<iframe')===false && strpos($mcq['question'], '<img')===false ) ){?>

					   <div class="bgqtdiv" >
							<font color="white">
								<div style="background-image:url('https://stemup.app/upload/background/<?php if($mcq['background_template']!=0){ echo $mcq['background_template'];} else{ echo rand(1,20);}?>.jpg'); " class="outer bgqt">
									<div class="middle">
										<div class="inner" >
										  
											<?php 
											if(strpos($mcq['question'],'https://latex.codecogs.com')!==false){
												$des=html_entity_decode($mcq['question']) ;
											}
											else{
												$des=html_entity_decode(strip_tags($mcq['question'])) ;
											}
											
											if (strpos($mcq['question'],'https://latex.codecogs.com')===false &&  mb_strlen($des, 'UTF-8')>120){
												$pos=strpos($des," ",110); 
												
												echo substr($des,0,$pos).'... <a  style="text-shadow: -2px 0 white, 0 2px white, 2px 0 white, 0 -1px white;" class="pointer" onclick="show_question('.$mcq['qid'].')">Xem thêm</a><div class="hiddenlqt" style="display:none">'.$des.'</div>';
											}else{
												echo $des;
											}
										
											
											?>
										</div>
									</div>
								 </div>
							</font>
							
					  </div>
					  <?php if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {?>
							<div class="imgwlogo" style="margin-top:-15px">
									<a href="<?php echo $mcq['out_link']?>" target="_blank"> 
										<div class="logobanner">
										
											<div >
											  
												<table style="width:100%">
												  <tr>
												   <td style=" padding: 5px 20px;">
												  <?php if($mcq['logo']){?>
												  <div class="logoimg">
														<img src="<?php echo $mcq['logo'] ?>">
												  </div>
												  <?php }?>
												  </td>
												   <td class="textorg" >
												     <div  class="contentbn">
														<i style="font-weight:200px">Cung cấp bởi</i> <b><a><?php echo $mcq['text_license'] ?></b></a>
													 </div>
												   </td>
												 
												 </tr> 
											   </table>
											   
											</div>
									  
										 </div>
									   </a>
								</div>
							<?php }?>
					   <?php } else{?>
						 <div class="mcq_multimd assqid-<?php echo $mcq['qid']?>" style="display:none">
							<?php echo $mcq['question']?>
						 </div>
						 
						<?php if(strpos($mcq['question'], '<iframe')===false){ ?>
						 <div class="mcq_multimd assqid-<?php echo $mcq['qid']?>">
							<center style="margin-bottom:20px">
							 <?php if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {?>
								<div class="imgwlogo">
									 <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank">
										<img class="img-responsive" style="width:100%" src="<?php echo $mcq['img'] ?>"/>
									</a>
									<a href="<?php echo $mcq['out_link']?>" target="_blank"> 
										<div class="logobanner">
										
											<div >
											  
												<table style="width:100%">
												  <tr>
												   <td style=" padding: 5px 10px;">
												  <?php if($mcq['logo']){?>
												  <div class="logoimg">
														<img src="<?php echo $mcq['logo'] ?>">
												  </div>
												  <?php }?>
												  </td>
												   <td class="textorg" >
												     <div  class="contentbn">
														<i style="font-weight:200px">Cung cấp bởi</i> <b><a><?php echo $mcq['text_license'] ?></b></a>
													 </div>
												   </td>
												 
												 </tr> 
											   </table>
											   
											</div>
									  
										 </div>
									   </a>
								</div>
							 <?php } else{?>
							      <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank">
										<img class="img-responsive" style="width:100%" src="<?php echo $mcq['img'] ?>"/>
								  </a>
							<?php } ?>
							</center>
							 <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank">
							    <?php echo strip_tags($mcq['question'])?>
							</a>
						 </div>
						 <?php } else{?>
							<div style="color:#000; font-weight:700"><?php echo $mcq['question']?></div>
						 <?php }?>
						<?php }?>
					  
					  </a>
				  </div>
				  
				<div class="col-xs-12 div_opt">
					  <div class="row MB20 twopt">
						<div class="col-xs-6 mobile-opt mobmb20"> 
							<label class="radio-inline w-100">
								 
								   <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='0'>
								   <div class="input-group mobile-text-opt" >
		
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optA1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td style="padding-left:0px"><b> A:</b> </td>
										 <td><?php echo html_entity_decode($mcq['options'][0]['q_option'])?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
						<div class="col-xs-6 mobile-opt" > 
							<label class="radio-inline w-100">
								 
								   <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='1'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optB1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td style="padding-left:0px"><b> B:</b> </td>
										 <td><?php echo html_entity_decode($mcq['options'][1]['q_option'])?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
					</div>
					<div class="row" >
						<?php if(!in_array(html_entity_decode($mcq['options'][2]['q_option']),array("", " ","  ", "   ")) ){?>
						<div class="col-xs-6 mobile-opt mobmb20"> 
						
						<?php } else{ ?>
						<div class="col-xs-6 mobile-opt mobmb20" style="display:none"> 
						<?php } ?>
							<label class="radio-inline w-100">
								 
								    <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='2'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optC1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td style="padding-left:0px"><b> C:</b> </td>
										 <td><?php echo html_entity_decode($mcq['options'][2]['q_option'])?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
						<?php if(!in_array(html_entity_decode($mcq['options'][3]['q_option']),array("", " ","  ", "   ")) ){?>
						<div class="col-xs-6 mobile-opt"> 
						
						<?php } else{ ?>
						<div class="col-xs-6 mobile-opt" style="display:none"> 
						<?php } ?>
							<label class="radio-inline w-100">
								 
								 <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='3'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optD1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td style="padding-left:0px"><b> D:</b> </td>
										 <td><?php echo html_entity_decode($mcq['options'][3]['q_option'])?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
					</div>
					  <p class="mt-10 mb-0"><button type="button" class="btn btn-danger" style="display:none">Tag bạn Facebook để trợ giúp</button></p>

						<?php  if($mcq['n_answers']>0){?>
					   <div class="col-xs-12 text-right mgr-20" style="float:right" >
							<p class="f11"><i style="width:20px" class="fas fa-users mr-5 bo-tron bg-danger"></i><strong class="text-danger"><?php  echo number_format(100*$mcq['n_correct_answers']/$mcq['n_answers'],0)?>%</strong> trả lời đúng</p>
					   </div>
					  <?php  }?>
					   
				  </div>
			  </div>
			  <div class="col-xs-12 bo-tb">
				  <div class="row">
					  <div class="col-xs-12" style="margin-bottom:5px">
						  <ul class="list-inline text-bt">
						      <?php if($mcq['liked']==1){?>
							  <li class="col-xs-2"><a class="acti pointer"  onclick="like_question(this , <?php echo $mcq['qid'] ?>)"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>
							  <?php } else{?>
							  <li class="col-xs-2"><a class="pointer"  onclick="like_question(this , <?php echo $mcq['qid'] ?>)"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs"> Thích</span></a></li>
							  <?php }?>
							  <li class="col-xs-3"><a class="pointer" data-toggle="collapse" data-target="#comment_area_main_<?php echo $mcq['qid']?>" ><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs">Bình luận</span></a></li>
							    <li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquestion%2F<?php echo  $mcq['permalink']?>&amp;src=sdkpreparse" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0');count_share(<?php echo $mcq['qid'];?>); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs">Chia sẻ</span></a></li>
							   <li class="col-xs-2">
								<a class="assign-bt pointer" href="<?php echo site_url('page/question/'.$mcq['permalink']); ?>" target="_blank"><i class="fab fa-resolving mr-5"></i><span class="hidden-xs"> Đáp án</span></a>
							</li>
							<li class="col-xs-2">
								<a class="assign-bt pointer" data-qid="<?php echo $mcq['qid'];?>"><i class="fas fa-share-square mr-5"></i><span class="hidden-xs"> Đố </span></a>
							</li>
					  </div>
					   <!-- Single button 
					  <div class="col-xs-2 text-right">
						 
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle btn-none" data-toggle="dropdown">
								
								 <?php if($link_photo) { ?>
									<img class="img-responsive img-circle w20" src="<?php echo $link_photo;?>" alt="">
								<?php } else{ ?>   
								    <img class="img-responsive img-circle w20" src="<?php echo base_url('upload/avatar/default.png');?>" alt="">
								<?php } ?> 
								<span class=" 
caret caret_e 
"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							  </ul>
							</div>
					  </div>-->
				  </div>
			  </div>
			  <div id="like_statistic_<?php echo $mcq['qid']?>">
			  <?php if($mcq['liked']==1|| $mcq['n_like']>0 ){?>
				  <div class="col-xs-12 bo-B" >		 
					 <i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>
					 <a class="f10" href="#">
						 <?php if($mcq['liked']==1){?>
							 
							<?php if($mcq['n_like'] >0) { echo 'Bạn và';} else echo $user_name;?>
						 <?php }?>
						 <?php if($mcq['n_like'] >0) {echo " ".$mcq['n_like'].' người' ;}?> 
					 </a>
				  </div>
			  <?php }?>
			  </div>
			   <?php if($mcq['share_count']>0){ ?>
			   <div class="col-xs-12">
				   <p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i><?php echo $mcq['share_count']?> lượt chia sẻ</p>
			   </div>
			   <?php } ?>
			  <div class="col-xs-12 collapse" id="comment_area_main_<?php echo $mcq['qid']?>">
				  <div class="media-object-default">
					 <div class="media">
					   <div class="media-left">
						   <a href="#">
						    <?php if($link_photo) { ?>
								<img class="media-object img-circle" src="<?php echo $link_photo;?>" width="36" alt="placeholder image">
							<?php } else{ ?>   
								<img class="media-object img-circle" src="<?php echo base_url('upload/avatar/default.png');?>" width="36" alt="placeholder image">
							<?php } ?> 
						   
						   </a>
					   </div>
					   <div class="media-body" >
						 <input type="text" class="form-control bo-input inp_comment" onkeyup="write_comment(this,event,'qbank',<?php echo $mcq['qid']?>)"  placeholder="Bình luận">
					   </div>

				  </div>
				</div>
			  </div>
			  <div class="col-xs-12">
				  <div class="box-commen" style="margin-top:20px;" id="box_comment_<?php echo $mcq['qid']?>">
					  <div class="media-object-default">
							<?php foreach($mcq['comment'] as $cmt){ ?>
							 <div class="media">
							   <div class="media-left">
								   <a href="#">
								   <?php if($cmt['photo']) { ?>
										<img class="media-object img-circle" src="<?php echo $cmt['photo'];?>" width="36" alt="placeholder image">
									<?php } else{ ?>   
										<img class="media-object img-circle" src="<?php echo base_url('upload/avatar/default.png');?>" width="36" alt="placeholder image">
									<?php } ?> 
								   </a>
							   </div>
							  <div class="media-body">
								 <h4 class="media-heading"><a href=""><?php echo $cmt['first_name']." ".$cmt['last_name'];?></a></h4>
								 <?php echo $cmt['content']; ?>
								 <!--  <p class="text-small1">
									  <a class="mr-23" href="">Thích</a>
									  <a class="mr-23" href="">Trả lời</a>
									  - <?php echo $cmt['str_time_ago'];?>
								  </p>-->
							   </div>
								
						  </div>
                          
							<?php } ?>
						</div>
				  </div>
			  </div>
			 
		  </div><!--end baiviet-->
		 <?php } ?>
		 <?php if($quiz_fun){?>
		 <div class="box-bor-quiz mb-20">
			  <h3 class="mt-0">Bài trắc nghiệm: <a href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><?php echo $quiz_fun['quiz_name'] ?></a></h3>
			 <!-- <h4 class="mt-0"><a href=""><?php echo $quiz_fun['description'] ?></a></h4>-->
			 
			  <div class="row hidden-xs">
			      <?php foreach($quiz_fun['question'] as $k=>$qf){?>
						<a class="col-md-3 col-xs-6 mb-10" href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><img class="img-responsive img_quiz" src="<?php echo $qf['img'];?>" alt=""></a>
				  <?php }?>
				 
			  </div>
			  <div class="hidden-lg">
				  <div class="row">
					  <?php foreach($quiz_fun['question'] as $k=>$qf){
							if($k<2){?>
							<a class="col-md-3 col-xs-6 mb-10" href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><img class="img-responsive img_quiz" src="<?php echo $qf['img'];?>" alt=""></a>
							<?php }}?>
					 
				  </div>
				   <div class="row">
					  <?php foreach($quiz_fun['question'] as $k=>$qf){
							if($k>=2){?>
							<a class="col-md-3 col-xs-6 mb-10" href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><img class="img-responsive img_quiz" src="<?php echo $qf['img'];?>" alt=""></a>
							<?php }}?>
					 
				  </div>
			   </div>
			    <div class="col-xs-12 bo-tb">
				 <div class="row">
					  <div class="col-xs-12" style="margin-bottom:5px">
						  <ul class="list-inline text-bt">
						      <?php if($quiz_fun['liked']==1){?>
							  <li class="col-xs-3"><a class="acti pointer" onclick="like_quiz(this,<?php echo $quiz_fun['quid']; ?>)" ><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>
							  <?php } else{?>
							  <li class="col-xs-3"><a class="pointer" onclick="like_quiz(this,<?php echo $quiz_fun['quid']; ?>)"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs"> Thích</span></a></li>
							  <?php }?>
							  <li class="col-xs-3"><a class="pointer" data-toggle="collapse" data-target="#comment_quiz_main_<?php echo $quiz_fun['quid']?>" ><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs">Bình luận</span></a></li>
							    <li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fdev.stemup.app%2Findex.php%2Fpage%2Fquiz%2F<?php echo  $quiz_fun['permalink']?>&amp;src=sdkpreparse" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0');count_share2(<?php echo $quiz_fun['quid'];?>); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs">Chia sẻ</span></a></li>
							  
							</li>
							<li class="col-xs-3">
								<a class="pointer" onclick="assignQuiz(<?php echo $quiz_fun['quid']; ?>, <?php echo $su;?>)"><i class="fas fa-share-square mr-5"></i><span class="hidden-xs"> Đố </span></a>
							</li>
						  </ul>
					  </div>
					   
				  </div>
				 </div>
				  <div id="like_statistic_quiz_<?php echo $quiz_fun['quid']?>">
				  <?php if($quiz_fun['liked']==1|| $quiz_fun['n_like']>0 ){?>
					  <div class="col-xs-12 bo-B" >		 
						 <i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>
						 <a class="f10" href="#">
							 <?php if($quiz_fun['liked']==1){?>
								 
								<?php if($quiz_fun['n_like'] >0) { echo 'Bạn và';} else echo $user_name;?>
							 <?php }?>
							 <?php if($quiz_fun['n_like'] >0) {echo " ".$quiz_fun['n_like'].' người' ;}?> 
						 </a>
					  </div>
				  <?php }?>
				  </div>
				   <?php if($quiz_fun['share_count']>0){ ?>
			   <div class="col-xs-12">
				   <p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i><?php echo $quiz_fun['share_count']?> lượt chia sẻ</p>
			   </div>
			   <?php } ?>
				   <div class="col-xs-12 collapse" id="comment_quiz_main_<?php echo $quiz_fun['quid']?>">
					  <div class="media-object-default">
						 <div class="media">
						   <div class="media-left">
							   <a href="#">
								<?php if($link_photo) { ?>
									<img class="media-object img-circle" src="<?php echo $link_photo;?>" width="36" alt="placeholder image">
								<?php } else{ ?>   
									<img class="media-object img-circle" src="<?php echo base_url('upload/avatar/default.png');?>" width="36" alt="placeholder image">
								<?php } ?> 
							   
							   </a>
						   </div>
						   <div class="media-body" >
							 <input type="text" class="form-control bo-input inp_comment" onkeyup="write_comment(this,event,'quiz',<?php echo $quiz_fun['quid']?>)"   placeholder="Bình luận">
						   </div>

					  </div>
					</div>
			    </div>
				 <div class="col-xs-12">
				  <div class="box-commen" style="margin-top:20px;" id="box_comment_quiz_<?php echo $quiz_fun['quid']?>">
					  <div class="media-object-default">
							<?php foreach($quiz_fun['comment'] as $cmt){ ?>
							 <div class="media">
							   <div class="media-left">
								   <a href="#">
								   <?php if($cmt['photo']) { ?>
										<img class="media-object img-circle" src="<?php echo $cmt['photo'];?>" width="36" alt="placeholder image">
									<?php } else{ ?>   
										<img class="media-object img-circle" src="<?php echo base_url('upload/avatar/default.png');?>" width="36" alt="placeholder image">
									<?php } ?> 
								   </a>
							   </div>
							  <div class="media-body">
								 <h4 class="media-heading"><a href=""><?php echo $cmt['first_name']." ".$cmt['last_name'];?></a></h4>
								 <?php echo $cmt['content']; ?>
								 <!--  <p class="text-small1">
									  <a class="mr-23" href="">Thích</a>
									  <a class="mr-23" href="">Trả lời</a>
									  - <?php echo $cmt['str_time_ago'];?>
								  </p>-->
							   </div>
								
						  </div>
                          
							<?php } ?>
						</div>
				  </div>
			  </div>
		  </div>
		 <?php }?>
	      <div  class="show_more_mcq" style="display:none;">
		
		  </div>
		  <div class="modal fade" id="answered" role="dialog" onclick="dismiss_modal(this)">
			<div class="modal-dialog">
				<div class="modal-content" >
					
					 <div class="box-popup">
					<div class="bg-xanhnhat">
						<div class="icon">
							<img src="<?php echo base_url()?>images/images3.png" alt="">
						</div>
					</div>
					<div class="box-chon">
						<h3 class="text-center mb-20 mt-0">Bạn đã trả lời câu hỏi này! Vui lòng chọn câu hỏi khác.</h3>
						<h3 class="text-center mb-20 mt-0" id="result_answered"></h3>
						<!--<p class="text-left"><strong>Câu hỏi liên quan:</strong><br>
						<a href="">Tên gọi Cà Mau được hình thành do người Khmer gọi tên vùng đất này. 
						Ý nghĩa của chữ "Cà Mau" là gì?</a></p>-->
					</div>

				</div>
					
				</div>

			</div>
		</div>
		 <div class="modal fade" id="complete_answer" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content" >
					
					

						<div class="box-popup">
						<div class="bg-xanhnhat">
							<div class="icon">
								<img src="<?php echo base_url();?>images/images4.png" alt="">
							</div>
						</div>
						<div class="box-chon">
							<h3 class="text-center mb-20">Phương án <span class="opt_choice"> A </span> là câu trả lời cuối cùng của bạn?</h3>
							<button type="button" data-dismiss="modal" id="cancel_answer" class="btn btn-warning btn-lg1">Chọn lại</button>
							<button type="button" data-dismiss="modal" id="confirm_answer" class="btn btn-success btn-lg1">Đồng ý</button>

						</div>
						
				
					</div>
					  
					
				</div>

			</div>
		</div>
		
		
		
          <div class="modal fade" id="result_answer_qt_true" role="dialog" onclick="dismiss_modal(this)">
			<div class="modal-dialog">	 
				 <div class="modal-content">
					<!--<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Đáp án</h4>
					 
					</div>-->
					<!--<div class="modal-body" id="bd_result_answer_qt">
						
						
					</div>-->
					<div class="box-popup">
						<div class="bg-xanhnhat">
							<div class="icon">
								<img src="<?php echo base_url();?>images/images1.png" alt="">
								
							</div>
						</div>
						<div class="box-chon">
							<h3 class="text-center">
							    <div style="margin-bottom:10px">
									Chúc mừng bạn đã trả lời đúng!<br>
									Đáp án chính xác là <span id="correct_ans_tr"> </span>.
								</div>
							   <div>
									<div class="fb-like" 
										data-href="https://www.facebook.com/stemupapp"
										data-layout="button_count" 
										data-action="like" 
										data-show-faces="false"
										data-size="large" >
									  </div>
							    </div>
							</h3>
						</div>

					</div>
				 </div>
				  
			</div>
		</div>
		<div class="modal fade" id="result_answer_qt_false" role="dialog" onclick="dismiss_modal(this)">
			<div class="modal-dialog">	 
				 <div class="modal-content">
						<div class="box-popup">
					<div class="bg-xanhnhat">
						<div class="icon">
							<img src="<?php echo base_url();?>images/images2.png" alt="">
						</div>
					</div>
					<div class="box-chon">
						<h3 class="text-center mt-0">
						    <div style="margin-bottom:10px">
						        Rất tiếc bạn đã trả lời sai!<br>Đáp án chính xác là <span id="correct_ans_fs"> </span>.
							</div>
							<div >
								<div class="fb-like" 
									data-href="https://www.facebook.com/stemupapp"
									data-layout="button_count" 
									data-action="like" 
									data-show-faces="false"
									data-size="large" >
								  </div>
							</div>
						</h3>
					</div>

				</div>

					
				 </div>
				  
			</div>
		</div>
	    <svg height="0" width="0">
		  <filter id="fb-filter">
			<feColorMatrix type="hueRotate" values="100"/>
		  </filter>
		</svg>
		<style>
		  .fb-like, .fb-send, .fb-share-button {
			-webkit-filter: url(#fb-filter); 
			filter: url(#fb-filter);
		  }
		</style>

	
      </aside>
      <aside class="col-md-3 rightbar">
	     <div class="box-bor MB20 pad-0">
			<h3 class="text-xanh1 pad-15"><a href="<?php echo site_url('/event_racing')?>">Bảng xếp hạng <small>(<?php echo $today;?>)</small></a></h3>
      	 	<table class="table table-hover table-striped">
				<thead>
				  <tr class="bg-eee">
					<th class="text-center">#</th>
					<th>Tên</th>
					<th class="text-right">Điểm Đố</th>
				  </tr>
				</thead>
				<tbody>
					<?php foreach($todaay_points as $i=>$dp){?>
					  <tr>
						<td class="text-center <?php if($i<3){ ?> bg-primary <?php } ?>"><?php  echo $i+1 ?></td>
						<td><?php echo $dp['last_name']." ".$dp['first_name'] ?></a></td>
						<td class="text-right"><?php echo $dp['points']; ?></td> 
					  </tr>
					<?php } ?>
				</tbody>
			  </table>
			  <p class="text-center"><a href="<?php echo site_url('/event_racing')?>">Xem thêm</a></p>
			<!--  <p class="text-center"><a href="<?php echo site_url('/event_racing')?>">Câu hỏi cùng chủ đề</a></p> -->
		</div>
		<div style="margin-bottom:20px">
			<div class="fb-page" 
				  data-href="https://www.facebook.com/stemupapp"
				  data-width="380" 
				  data-hide-cover="false"
				  data-show-facepile="true">
		    </div>
		</div>
	    <div class="box-bor MB20">
		   <h3 class="text-xanh1"><a href="<?php echo site_url('home_user/quiz_list'); ?>">BÀI TRẮC NGHIỆM </a></h3>
		  <?php foreach($quiz_fun_rb as $qz){?>
		      <div style="margin-bottom:20px" class="bo-B">
				<div style="margin-bottom:10px"><a href="<?php echo site_url('quiz/validate_quiz/'.$qz['quid']);?>"> <img src="<?php echo $qz['img'];?> " width="100%"></a><br/>
				</div>
		         <a style="font-size:15px;" href="<?php echo site_url('quiz/validate_quiz/'.$qz['quid']);?>"><b><?php echo $qz['quiz_name'];?></a></b>
			 </div>
		  <?php }?>
		  <!--<div id="activities"></div>
		  <div class="media-object-default">
			   <div class="media">
			     <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
			     <div class="media-body">
			       <h4 class="media-heading"><a href="">Thạch Long</a></h4>
			       <span class="text-small">21 giờ trước</span>
		         </div>
	        </div>
	      </div>
		  
			<hr>
			<div class="media-object-default">
			   <div class="media">
			     <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
			     <div class="media-body">
			       <h4 class="media-heading"><a href="">Thạch Long</a></h4>
			       <span class="text-small">Connected to</span>
			       <div class="media">
			         <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
			         <div class="media-body">
			           <h4 class="media-heading text-use"><a href="">Cường nguyễn</a></h4>
					 </div>
					   <span class="text-small1">25-04-2018</span>
		           </div>
		         </div>
	        </div>
	      </div>
			<hr>
			<div class="media-object-default">
			   <div class="media">
			     <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
			     <div class="media-body">
			       <h4 class="media-heading"><a href="">Thạch Long</a></h4>
			       <span class="text-small">21 giờ trước</span>
		         </div>
	        </div>
	      </div>
			<hr>
			-->
        </div>
      </aside>
      <div class="modal fade" id="quizModal" role="dialog">
      		<div class="modal-dialog">
      			<div class="modal-content">
      				<div class="modal-header">
	    				<button type="button" class="close" data-dismiss="modal">&times;</button>
	    				<h4 class="modal-title">Tạo bài kiểm tra</h4>
	    			</div>
	    			<div class="modal-body" id="quizModalbody">
	    				<form id="formAddQuiz">
	    				<div class="form-group">	 
							<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('quiz_name');?></label> 
							<input type="text"  id="inpquizname" name="quiz_name"  class="form-control" placeholder="<?php echo $this->lang->line('quiz_name');?>"  required autofocus>
						</div>
						<div class="form-group">	 
							<label for="inputEmail"  ><?php echo $this->lang->line('description');?></label> 
							<textarea   name="description"  class="form-control tinymce_textarea" ></textarea>
						</div>
						<div class="form-group">	 
							<label><?php echo $this->lang->line('assign_to_group');?></label> <br>
							 <?php 
							foreach($group_list as $key => $val){
								?>
								
								 <input type="radio" name="gids[]" value="<?php echo $val['gid'];?>" <?php if($key==1){ echo 'checked'; } ?> > <?php echo $val['group_name'];?> &nbsp;&nbsp;&nbsp;
								<?php 
							}
							?>
						</div>
						<a href="#" data-toggle="collapse" data-target="#advance_options"><?php echo $this->lang->line('advance_options');?></a>
						<div id="advance_options" class="collapse">
			
							<div class="form-group">	 
								<label for="inputEmail"  ><?php echo $this->lang->line('start_date');?></label> 
								<input type="text" name="start_date"  value="<?php echo date('Y-m-d H:i:s',time());?>" class="form-control" placeholder="<?php echo $this->lang->line('start_date');?>"   required >
							</div>
							<div class="form-group">	 
								<label for="inputEmail"  ><?php echo $this->lang->line('end_date');?></label> 
								<input type="text" name="end_date"  value="<?php echo date('Y-m-d H:i:s',(time()+(60*60*24*365)));?>" class="form-control" placeholder="<?php echo $this->lang->line('end_date');?>"   required >
							</div>
							<div class="form-group">	 
								<label for="inputEmail"  ><?php echo $this->lang->line('duration');?></label> 
								<input type="text" name="duration"  value="10" class="form-control" placeholder="<?php echo $this->lang->line('duration');?>"  required  >
							</div>
							<div class="form-group">	 
								<label for="inputEmail"  ><?php echo $this->lang->line('maximum_attempts');?></label> 
								<input type="text" name="maximum_attempts"  value="10000" class="form-control" placeholder="<?php echo $this->lang->line('maximum_attempts');?>"   required >
							</div>
							<div class="form-group">	 
								<label for="inputEmail"  ><?php echo $this->lang->line('pass_percentage');?></label> 
								<input type="text" name="pass_percentage" value="50" class="form-control" placeholder="<?php echo $this->lang->line('pass_percentage');?>"   required >
							</div>
							<div class="form-group" style="display:none;">	 
								<label for="inputEmail"  ><?php echo $this->lang->line('correct_score');?></label> 
								<input type="text" name="correct_score"  value="1" class="form-control" placeholder="<?php echo $this->lang->line('correct_score');?>"   required >
							</div>
							<div class="form-group" style="display:none;">	 
								<label for="inputEmail"  ><?php echo $this->lang->line('incorrect_score');?></label> 
								<input type="text" name="incorrect_score"  value="0" class="form-control" placeholder="<?php echo $this->lang->line('incorrect_score');?>"  required  >
							</div>
							<div class="form-group">	 
								<label for="inputEmail"  ><?php echo $this->lang->line('ip_address');?></label> 
								<input type="text" name="ip_address"  value="" class="form-control" placeholder="<?php echo $this->lang->line('ip_address');?>"    >
							</div>
							<div class="form-group">	 
								<label for="inputEmail" ><?php echo $this->lang->line('view_answer');?></label> <br>
								<input type="radio" name="view_answer"    value="1" checked > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="view_answer"    value="0"  > <?php echo $this->lang->line('no');?>
							</div>
							<div class="form-group" style="display:none;">	 
								<label for="inputEmail" ><?php echo $this->lang->line('open_quiz');?></label> <br>
								<input type="radio" name="with_login"    value="0"  > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="with_login"    value="1" checked > <?php echo $this->lang->line('no');?>
							</div>
						
							<div class="form-group">	 
								<label for="inputEmail" ><?php echo $this->lang->line('show_rank');?></label> <br>
								<input type="radio" name="show_chart_rank"    value="1" checked > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="show_chart_rank"    value="0"  > <?php echo $this->lang->line('no');?>
							</div>


							<?php 
							if($this->config->item('webcam')==true){
							?>
							<div class="form-group" style="display:none;">	 
								<label for="inputEmail" ><?php echo $this->lang->line('capture_photo');?></label> <br>
								<input type="radio" name="camera_req"    value="1"  > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="camera_req"    value="0"  checked > <?php echo $this->lang->line('no');?>
							</div>
							<?php 
							}else{
							?>
							<input type="hidden" name="camera_req" value="0">
							
							<?php 
							}
							?>

							<div class="form-group" style="display:none;">
			  
								<label   ><?php echo $this->lang->line('assign_to_student');?></label> <br>


								<select class="js-example-basic-multiple form-control" name="uids[]" multiple="multiple">
			   					<?php foreach($user_list as $k => $uval){ ?>
				  					<option value="<?php echo $uval['uid'];?>"><?php echo $uval['first_name'].' '.$uval['last_name'].' ('.$uval['email'].')';?></option>
				  				<?php } ?>
								</select>
								<script type="text/javascript">
									$(".js-example-basic-multiple").select2();
								</script>
							</div>

							<div class="form-group" style="display:none;">	 
								<label   ><?php echo $this->lang->line('quiz_template');?></label> <br>
								<select name="quiz_template">
								<?php 
								foreach($this->config->item('quiz_templates') as $qk=> $val){
								?>
								<option value="<?php echo $val;?>"><?php echo $val;?></option>
								<?php 
								}
								?>
								 
								</select>
							</div>

							<div class="form-group" style="display:none;">	 
								<label for="inputEmail" ><?php echo $this->lang->line('question_selection');?></label> <br>
								<input type="radio" name="question_selection"    value="1"  > <?php echo $this->lang->line('automatically');?><br>
								<input type="radio" name="question_selection"    value="0"  checked > <?php echo $this->lang->line('manually');?>
							</div>
							<div class="form-group" style="display:none;">	 
								<label for="inputEmail" ><?php echo $this->lang->line('generate_certificate');?></label> <br>
								<input type="radio" name="gen_certificate"    value="1"  > <?php echo $this->lang->line('yes');?><br>
								<input type="radio" name="gen_certificate"    value="0"  checked > <?php echo $this->lang->line('no');?>
							</div>
						 
							<div class="form-group" style="display:none;">	 
								<label for="inputEmail"  ><?php echo $this->lang->line('certificate_text');?></label> 
								<textarea   name="certificate_text"  class="form-control" ></textarea><br>
								<?php echo $this->lang->line('tags_use');?> <?php echo htmlentities("<br>  <center></center>  <b></b>  <h1></h1>  <h2></h2>   <h3></h3>    <font></font>");?><br>
								{email}, {first_name}, {last_name}, {quiz_name}, {percentage_obtained}, {score_obtained}, {result}, {generated_date}, {result_id}, {qr_code}
							</div>

			 			</div>
			 			<div class="form-group" id="table-question" >
			 			</div>
			 			</form>
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
	      				<button id="addQuizFirst" type="button" class="btn btn-primary">Tiếp</button>
	      			</div>
      			</div>
      		</div>
      	</div>
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
 								    <li id="tabclass"><a data-toggle="tab" href="#classtab" id="assClass">Lớp</a></li>
 							  	</ul>
 
 							  	<div class="tab-content">
 							    	<div id="studenttab" class="tab-pane fade in active">
 							      		<h3></h3>
 							      		<table id="tblStudentAssign" class="display" style="width:100%"></table>
 							    	</div>
 							    	<div id="classtab" class="tab-pane fade">
 							      		<h3></h3>
 							      		<table id="tblClassAssign" class="display" style="width:100%"></table>
 						    	</div>
 							  	</div>
 							</div>
 	    					<!-- <div class="form-group">
	    						<div class="assStudent" style="float: left;">
									<input type="checkbox" name="uids" value="1">Học sinh&nbsp;&nbsp;&nbsp;
								</div>
								<div class="assClass">
									<input type="checkbox" name="clid" value="0">Lớp
								</div>
							</div>
							<div class="form-group selectUids" style="display: none;">
								<select class="js-invite-basic-multiple form-control" name="uids[]" multiple="multiple"></select>
							</div>
							<div class="form-group classCode"  style="display: none;">
								<input type="text" class="form-control" name="assign_class" placeholder="Nhập mã lớp..."/>
							</div>-->
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
  <!--	<footer class="bg-xanh">
  		<div class="container">
  			<div class="row padTB15">
  				<div class="col-md-2 text-center">
  					<img class="MB20" src="<?php echo base_url('images/hu_logo_home1.png');?>" alt="">
  				</div>
  				<div class="col-md-8 boL1 text-center767">
  					<ul class="list-inline ul-footer">
  						<li><a href="">Trang chủ</a></li>
  						<li><a href="">Giới thiệu</a></li>
  						<li><a href="">Tin tức & sự kiện</a></li>
  						<li><a href="">Hướng dẫn</a></li>
  						<li><a href="">Liên hệ</a></li>
  					</ul>
  					<ul class="list-inline text-xanhnhat">
  						<li><i class="MR5 fa fa-map-marker" aria-hidden="true"></i>6 Nguyễn Hoàng, Hà Nội</li>
  						<li><i class="MR5 fa fa-phone" aria-hidden="true"></i>024 3533 4165</li>
  						<li><i class="MR5 fa fa-fax" aria-hidden="true"></i>024 3533 4165</li>
  						<li><i class="MR5 far fa-envelope" aria-hidden="true"></i>info@stem.vn</li>
  					</ul>
  				</div>
  				<div class="col-md-2 text-center767 text-right">
  					<a class="link-F" href=""><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
					<a class="link-F" href=""><i class="fa fa-phone" aria-hidden="true"></i></a>
					<a class="link-F" href=""><i class="fab fa-twitter" aria-hidden="true"></i></a>
  					<p class="text-xanhnhat">Copyright ©STEM.VN</p>
  				</div>
  			</div>
  		</div>
  	</footer>
-->
  	
   
  </body>
</html>
