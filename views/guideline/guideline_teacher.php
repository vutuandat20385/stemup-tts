<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hướng dẫn cho giáo viên</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
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
	<script src="<?php echo base_url('js/manage_group.js');?>"></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<script src="<?php echo base_url('js/minhash.js');?>"></script>
		<script src="<?php echo base_url('js/setbackground.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
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
	<script src="<?php echo base_url('js/notification.js');?>"></script>
	<script src="<?php echo base_url('js/star-rating.js');?>"></script>
	<script src="<?php echo base_url('js/paginate.js');?>"></script>
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
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<nav class="navbar navbar-stem navbar-fixed-top">
  <div class="container">
       
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
				<!--<a class="text-trang hover" href="<?php echo site_url('message'); ?>">
					<i class="far fa-envelope"></i>
					<span class="badge badge-sm up bg-pink count mcount"></span>
				</a>-->
				
				<a class="text-trang hover" data-toggle="dropdown">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount"></span>
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
			    <input id="inpsearch_top"  class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
			    <a  class="input-group-addon addon-TK1  searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
		<div class="panel-collapse" id="search_top_dt">
			 <form class="navbar-form navbar-left" role="search">
			  <div class="input-group">
			    <input id="inpsearch_top_dt"  onkeyup="search_question(this, event)" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
			    <a  class="input-group-addon addon-TK1 pointer searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
  	    <div class="collapse navbar-collapse" id="defaultNavbar1">
  	       
 	        <ul class="nav navbar-nav navbar-right">
  	        <li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user'); ?>"><i class="mr-5 fas fa-home"></i><br class="hidden-xs">Trang chủ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php  echo site_url('home_user/assign_quiz')?>"><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/results'); ?>" ><i class="mr-5 far fa-chart-bar"></i><br class="hidden-xs">Kết quả</a>
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
					<span class="badge badge-sm up bg-pink count ncount mr-5"></span>
					<br  class="hidden-xs">Thông báo
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
	   <section class="visible-xs-block nav-mobile" >
			<ul class="ul-mobile list-unstyled">
				<li class="mbqmn"><a data-toggle="collapse" href="#">Trắc nghiệm</a></li>
				<li class="mbclmn"><a  data-toggle="collapse" href="#">Lớp</a></li>
				<li class="mbgrmn"><a  data-toggle="collapse" href="#">Nhóm</a></li>
				<li><a >Hướng dẫn</a></li>
			</ul>

		<ul id="tnmncl" class="panel-collapse collapse">
              
              <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
			  <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			  <a href="<?php echo site_url('home_user/create_question');?>" class="list-group-item createQuestionItem"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
			  <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			  <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"><i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
			  <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item"> <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
			  <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			  <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item"> <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
			   <?php if($su==1) {?>
					<a href="<?php echo site_url('library/insert_video'); ?>" class="list-group-item"> <i class="fas fa-video" style="margin-right:5px"></i> Thêm video</a>
			   <?php } ?>
		</ul>
		<ul id="clmncl" class="panel-collapse collapse">	
                <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>   
			  <a href="<?php echo site_url('home_user/manage_class') ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
			 <a href="<?php echo site_url('home_user'); ?>#create_class" class="list-group-item" onclick="create_class(event);"> <i class="fab fa-dropbox" style="margin-right:5px"></i> Tạo một lớp</a>
		</ul>
		<ul id="grmncl" class="panel-collapse collapse">	
	          <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
			 <a href="<?php echo site_url('home_user/manage_group') ?>" class="list-group-item"> <i class="fas fa-object-group" style="margin-right:5px"></i> Quản lý nhóm</a>
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
									<div class="col-md-9" style="margin-top:20px"><input type="number" class="form-control" style="margin-bottom:20px" name="answer_time" value="60" id="answer_timeedt"></div>
									<div class="col-md-3" style="margin-top:20px">Nguồn :</span></div>
									<div class="col-md-9" style="margin-top:20px"><input name="sourcemcq" id="sourcemcq_e" type="text" class="form-control" style="margin-bottom:20px" value=""></div>
									</div>
								</div>
							</div>
							
					    
					    
					</div>
					<div class="modal-footer">
						<input class="btn btn-success" type="submit" onclick="get_inf_edit()" value="Xác nhận"/>
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				<!--</form>-->
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
				  <button type="button" class="close"  onclick="reload()" data-dismiss="modal">&times;</button>
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
                <div class="modal-footer" style="min-height:100px">
      				<table >
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
				    		<td class="tranbtsbg"  style="opacity: 1; transform: translate(<?php echo 30*($i-10) ?>px, 40px);">
				    			<a id="mbgq<?php echo $i+1 ?>">
				    				<img src="<?php echo base_url('upload/background/'.($i+1).'.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>	
							<?php }?>

							 
				    	</tr>	
						 <button type="button" id="clmdprbg_1" class="btn btn-success hidden-xs" style="float:right;margin-top:30px;"  data-dismiss="modal">Xác nhận</button>
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
					 <h4 class="media-heading"><a href="#" class="border-B1"><?php echo $user_name; ?><br><span class="text-small1">
					   <?php if($su==3){?> Giáo viên <?php }?>
						 <?php if($su==1){?> Admin  <?php }?>
						 <?php if($su==8){?> Tổ chức  <?php }?>
					 </span></h4>
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
				  <a href="#" class="border-B1"style="font-size: 16px"><?php echo $user_name; ?></a> <br><span class="text-small">(<?php if($su==3){?>Giáo viên<?php }?><?php if($su==1){?>Admin<?php }?><?php if($su==8){?>Tổ chức<?php }?>)</span>
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
			  <a href="<?php echo site_url('home_user/create_question');?>" class="list-group-item createQuestionItem"><i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
			  <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			  <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
			  <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item" > <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
			  <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			  <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item"> <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
			  <?php if($su==1) {?>
					<a href="<?php echo site_url('library/insert_video'); ?>" class="list-group-item"> <i class="fas fa-video" style="margin-right:5px"></i> Thêm video</a>
			   <?php } ?>
		  </div>
		 <div class="list-group hidden-xs" id="quiz_menu" style="display:none;">
			  <h3 class="list-group-item active1">Trắc nghiệm</h3>
			  <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			  <a href="<?php echo site_url('home_user/create_question');?>" class="list-group-item createQuestionItem"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
			  <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			  <a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
			  <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item" > <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
			  <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			  <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item" > <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
			  <?php if($su==1) {?>
					<a href="<?php echo site_url('library/insert_video'); ?>" class="list-group-item"> <i class="fas fa-video" style="margin-right:5px"></i> Thêm video</a>
			   <?php } ?>
		  </div>
		  <div class="list-group hidden-xs" id="class_menu">
			  <h3 class="list-group-item active1">Lớp</h3>
			 <!-- <a href="#" class="list-group-item">Tạo một nhóm nhỏ</a>-->
			  <div id ="classpage_menu"></div>
			  <a href="<?php echo site_url('home_user/manage_class') ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
			 <a href="<?php echo site_url('home_user'); ?>#create_class" class="list-group-item" onclick="create_class(event);"> <i class="fab fa-dropbox" style="margin-right:5px"></i> Tạo một lớp</a>
			 <!-- <a href="#" class="list-group-item">Tham gia lớp</a>-->
		  </div>
		  <div class="list-group hidden-xs" id="group_menu">
			  <h3 class="list-group-item active1">Nhóm</h3>
			  <a href="<?php echo site_url('home_user/manage_group') ?>" class="list-group-item"> <i class="fas fa-object-group" style="margin-right:5px"></i> Quản lý nhóm</a>
			  <a href="<?php echo site_url('home_user/create_group') ?>" class="list-group-item"> <i class="fas fa-folder-open" style="margin-right:5px"></i> Tạo một nhóm</a>
			  <a data-toggle="modal" data-target="#joinGroupModal"  class="list-group-item"> <i class="far fa-handshake" style="margin-right:5px"></i> Tham gia nhóm</a>
		  </div>
		  <div class="list-group hidden-xs" >
				 <h3 class="list-group-item active1">Về chúng tôi</h3>
				 <a href="<?php echo site_url('home/about1') ?>"  class="list-group-item"><i class="fas fa-bullseye" style="margin-right:5px"></i> Giới thiệu</a>
				 <a href="<?php echo site_url('home/detail3') ?>"  class="list-group-item"><i class="fas fa-object-group" style="margin-right:5px"></i> Điều khoản sử dụng</a>
				 <a href="<?php echo site_url('home/detail1') ?>"  class="list-group-item"><i class="fas fa-folder-open" style="margin-right:5px"></i> Hướng dẫn</a>
				 <a href="<?php echo site_url('home/detail2/policy') ?>"  class="list-group-item"><i class="fa fa-window-restore" style="margin-right:5px"></i> Chính sách riêng tư</a> 
			</div>
  	  </aside>
  	  <aside class="col-md-10">
		  <div role="tabpanel" class="tab-pane fade in active" id="home2a">
			<div class="box-bor MB20">
				<div role="tabpanel">
				  <ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#tabDropDownTwo3" tabindex="-1" data-toggle="tab">Hướng dẫn sử dụng</a>
					  <link rel="stylesheet" type="text/css" href=""> 
					</li>
					<li><a href="#tabDropDownTwo3a" tabindex="-1" data-toggle="tab">Hướng dẫn cho mobile web</a></li>
					
					 <li><a href="#tabDropDownTwo3ab" tabindex="-1" data-toggle="tab">Hướng dẫn cho mobile app</a></li>
				  </ul>
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
<div id="tabContent1" class="tab-content">				  
	<div role="tabpanel" class="tab-pane fade pad in active" id="tabDropDownTwo3">
		<h3 class="text-center">Hướng dẫn cho giáo viên</h3>
			<h4>1. Tạo câu hỏi trắc nghiệm</h4>
				<h4><b>Trường hợp 1</b>: Với câu hỏi không chứa video</h4>
					<p>B1: Vào <b>Tạo câu hỏi</b><br>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/t1.png') ?>" alt=""></p>
						B2: Nhập câu hỏi (upload ảnh và video nếu câu hỏi bao gồm cả ảnh và video)<br>
							&nbsp;&nbsp;&nbsp;&nbsp;Nhập các phương án trả lời. Người tạo phải chọn đáp án đúng (click vào ô tròn trước đáp án) trước khi thực hiện các yêu cầu khác/ chọn nút <b>Lưu</b> để tiếp tục các thao tác khác.<br>
							<b>Dạng câu hỏi</b>: ( Không bắt buộc) Click chọn vào các mục nếu click vào video thì câu hỏi tạo có chứa video. Có thể bỏ qua mục này.<br>
							<b>Chọn là MCQ Fun</b>: Click chọn nếu muốn hiển thị câu hỏi sau khi tạo lên trang chủ người dùng quản lý. Và bỏ chọn nếu không muốn câu hỏi này hiển thị trực tiếp lên trang.<br>
							<b>Chọn Hiển thị logo</b>: Click chọn để gắn thêm logo tổ chức vào các câu hỏi được tạo nếu muốn.<br>
							<b>Chọn môn học</b> (bắt buộc): Để biết câu hỏi thuộc môn học hoặc lĩnh vực nào.<br>
							<b>Chọn lớp</b>: Để phân loại câu hỏi phù hợp với khối lớp nào.<br>
							<b>Nhập nội dung phần Giải thích </b>(nếu có): bao gồm tất cả các nội dung giải thích thêm cho phần đáp án trả lời đúng.<br>
							<b>Từ khóa</b> (bắt buộc):<br> 
							<b> * Hướng dẫn nhập từ khóa</b>:<br>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>Cho mọi câu hỏi trắc nghiệm là bài tập</b>: Bài tập trắc nghiệm, trắc nghiệm kiến thức, trắc nghiệm kiến thức + tên môn học (ví dụ: trắc nghiệm kiến thức Vật lý lớp 7), tên môn học + lớp (ví dụ: Vật lý lớp 7), bài tập + tên môn học + lớp (ví dụ: Bài tập Vật lý lớp 7).<br>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>Cho mọi MCQ, quiz không phải là bài tập</b>: Trắc nghiệm, trắc nghiệm kiến thức, trắc nghiệm online, câu hỏi trắc nghiệm, trắc nghiệm về + tên lĩnh vực tri thức (chẳng hạn trắc nghiệm về môi trường).<br>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>Thời gian làm bài</b>: là số thời gian quy định để hoàn thành chọn đáp án cho câu hỏi.<br>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>Tiết</b>: (Không bắt buộc) Điền số tiết giảng dạy của môn dựa theo phân phối chương trình giảng dạy của bộ giáo dục.<br>
							Ví dụ: Môn lịch sử lớp 6, từ khóa liên quan đến bài “Sơ lược về môn lịch sử” thuộc tiết 1 theo phân phối chương trình giảng dạy môn lịch sử lớp 6 của bộ giáo dục thì điền  số “1”. ( trong trường hợp có hai hoặc 3 tiết thì các số cách nhau bằng dấu phẩy. Với môn toán thì tiết 1 hình học điền “1-HH”, tiết 1 đại số “1-ĐS”. Đối với cấp 3 chia theo ban Tiết 1 nâng cao là  “1-NC” và cơ bản là “1-CB”) <br>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>Bài</b>: Là tên bài học trong môn học giảng dạy dựa trên từ khóa. Ví dụ: Trong trường từ khóa câu hỏi có liên quan đến bài xã hội nguyên thủy , lịch sử lớp 6 thì điền vào bài là Xã hội nguyên thủy).<br>
							&nbsp;&nbsp;&nbsp;&nbsp;<b>Nguồn</b> (không bắt buộc): để thêm các thông tin về tên tài liệu trích dẫn câu hỏi đó<br>

						    <p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/t2.png') ?>" alt=""></p>
	            			B3: Nhấn <b>Lưu / Hủy</b>
					</p>
					<p class="vmb-20"><img class="img-responsive" width="600px" height="400px" src="<?php echo base_url('images/t3.png') ?>" alt=""></p>
					<div id="no_video" style="width: 750px;margin: auto;">
						<video width="100%" height="400px" controls>
							<source src="http://localhost:68/quiz/upload_media/no_video.mp4" type="video/mp4">
						</video>
					</div>
					<p class="text-center">Video hướng dẫn tạo câu hỏi không có video</p>			
				<h4><b>Trường hợp 2</b>: Với câu hỏi chứa video</h4><br>
						B1: Nhấn vào biểu tượng <b>Thư viện</b> góc bên phải màn hình<br>
						<p class="vmb-20"><img class="img-responsive" width="600px" height="400px" src="<?php echo base_url('images/t4.png') ?>" alt=""></p>
						B2: Vào <b>Tạo câu hỏi</b><br>
						B3: Nhập câu hỏi (upload ảnh và video nếu câu hỏi bao gồm cả ảnh và video)<br>
						&nbsp;&nbsp;&nbsp;&nbsp;Nhập các phương án trả lời. Người tạo phải chọn đáp án đúng (click vào ô tròn trước đáp án) trước khi thực hiện các yêu cầu khác/ chọn nút <b>Lưu</b> để tiếp tục các thao tác khác.<br>
						<b>Dạng câu hỏi</b>: ( Không bắt buộc) Click chọn vào các mục nếu click vào video thì câu hỏi tạo có chứa video. Có thể bỏ qua mục này.<br>
						<b>Chọn là MCQ Fun</b>: Click chọn nếu muốn hiển thị câu hỏi sau khi tạo lên trang chủ người dùng quản lý. Và bỏ chọn nếu không muốn câu hỏi này hiển thị trực tiếp lên trang.<br>
						<b>Chọn Hiển thị logo</b>: Click chọn để gắn thêm logo tổ chức vào các câu hỏi được tạo nếu muốn.<br>
						<b>Chọn môn học</b> (bắt buộc): Để biết câu hỏi thuộc môn học hoặc lĩnh vực nào.<br>
						<b>Chọn lớp</b>: Để phân loại câu hỏi phù hợp với khối lớp nào.<br>
						<b>Nhập nội dung phần Giải thích</b> (nếu có): bao gồm tất cả các nội dung giải thích thêm cho phần đáp án trả lời đúng.<br>
						<b>Từ khóa</b> (bắt buộc):<br> 
						<b>* Hướng dẫn nhập từ khóa</b><br>
						&nbsp;&nbsp;&nbsp;&nbsp;<b>Cho mọi câu hỏi trắc nghiệm là bài tập</b>: Bài tập trắc nghiệm, trắc nghiệm kiến thức, trắc nghiệm kiến thức + tên môn học (ví dụ: trắc nghiệm kiến thức Vật lý lớp 7), tên môn học + lớp (ví dụ: Vật lý lớp 7), bài tập + tên môn học + lớp (ví dụ: Bài tập Vật lý lớp 7).<br>
						&nbsp;&nbsp;&nbsp;&nbsp;<b>Cho mọi MCQ, quiz không phải là bài tập</b>: Trắc nghiệm, trắc nghiệm kiến thức, trắc nghiệm online, câu hỏi trắc nghiệm, trắc nghiệm về + tên lĩnh vực tri thức (chẳng hạn trắc nghiệm về môi trường).<br>
						&nbsp;&nbsp;&nbsp;&nbsp;<b>Thời gian làm bài</b>: là số thời gian quy định để hoàn thành chọn đáp án cho câu hỏi.<br>
						&nbsp;&nbsp;&nbsp;&nbsp;<b>Tiết</b>: (Không bắt buộc) Điền số tiết giảng dạy của môn dựa theo phân phối chương trình giảng dạy của bộ giáo dục.<br>
						Ví dụ: Môn lịch sử lớp 6, từ khóa liên quan đến bài “Sơ lược về môn lịch sử” thuộc tiết 1 theo phân phối chương trình giảng dạy môn lịch sử lớp 6 của bộ giáo dục thì điền  số “1”. ( trong trường hợp có hai hoặc 3 tiết thì các số cách nhau bằng dấu phẩy. Với môn toán thì tiết 1 hình học điền “1-HH”, tiết 1 đại số “1-ĐS”. Đối với cấp 3 chia theo ban Tiết 1 nâng cao là  “1-NC” và cơ bản là “1-CB”)<br> 
						&nbsp;&nbsp;&nbsp;&nbsp;<b>Bài</b>: Là tên bài học trong môn học giảng dạy dựa trên từ khóa. Ví dụ: Trong trường từ khóa câu hỏi có liên quan đến bài xã hội nguyên thủy , lịch sử lớp 6 thì điền vào bài là Xã hội nguyên thủy).<br>
						&nbsp;&nbsp;&nbsp;&nbsp;<b>Nguồn </b>(không bắt buộc): để thêm các thông tin về tên tài liệu trích dẫn câu hỏi đó<br>
						<p class="vmb-20"><img class="img-responsive" width="600px" height="400px" src="<?php echo base_url('images/t5.png') ?>" alt=""></p>
						B4: Nhấn <b>Lưu / Hủy</b>.<br>
						<div id="have_video" style="width: 750px;margin: auto;">
							<video width="100%" height="400px" controls>
								<source src="http://localhost:68/quiz/upload_media/have_video.mp4" type="video/mp4">
							</video>
						</div>	
						<p class="text-center">Video hướng dẫn tạo câu hỏi có video</p>
						<h4>2. Quản lý câu hỏi đã tạo</h4>
						    <p>B1: Vào <b>Quản lý câu hỏi</b><br>
							B2: Chọn câu hỏi muốn can thiệp ( nhấn Xem – biểu tượng hình con mắt; Sửa – biểu tượng cây bút; hoặc Xóa – biểu tượng thùng rác)
						    </p>
						    <p class="vmb-20"><img class="img-responsive" width="600px" height="400px" src="<?php echo base_url('images/t6.png') ?>" alt=""></p>
							<div id="quanli_video" style="width: 750px;margin: auto;">
								<video width="750px" height="400px" controls>
								<source src="http://localhost:68/quiz/upload_media/quanlicauhoi.mp4" type="video/mp4">
								</video>
							</div>
						<p class="text-center">Video hướng dẫn quản lí câu hỏi</p>
					    <h4>3.Tạo bài kiểm tra gồm nhiều câu hỏi trắc nghiệm</h4>
						    <p>B1: Vào <b>Tạo bài kiểm tra</b><br>
							B2: Gõ tên bài kiểm tra<br>
							Phần Mô tả: Các thông tin về bài kiểm tra (không bắt buộc).<br>
							Chọn Công khai (để tất cả mọi người đều có thể tiếp cận) hoặc Không công khai (chỉ những nhóm, lớp hay cá nhân mà bạn lựa chọn được tiếp cận).<br>
							Vào Tùy chọn nâng cao để chọn một số yếu tố khác (như thời gian làm bài, ngày giao bài, ngày kết thúc, tỷ lệ câu hỏi cần trả lời đúng…). Nếu bạn không chọn, những yếu tố này sẽ được cài mặc định.
						    </p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD26.jpg') ?>" alt=""></p>
						    <p>
							B3: Nhấn Tiếp; click vào dấu cộng màu xanh ở đầu mỗi câu hỏi trắc nghiệm để đưa nó vào bài kiểm tra.<br>
							B4: Sau khi đã chọn đủ câu hỏi, nhấn <b>Cập nhật</b>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD27.jpg') ?>" alt=""></p>
						    </p>
						<h4>4. Giao bài kiểm tra</h4>
						    <strong>Cách 1:</strong>
						    <p>
							B1: Vào <b>Kiểm tra</b><br>
							B2: Chọn bài kiểm tra thích hợp, nhấn <b>Giao bài kiểm tra</b>, hộp thoại xuất hiện<br>
						    	<p class="vmb-20"><img class="img-responsive"  src="<?php echo base_url('images/HDSD28.jpg') ?>" alt=""></p>
							Chọn ngày bắt đầu và ngày kết thúc (hạn cuối nộp bài làm)<br>
							Chọn học sinh hoặc lớp cần làm bài kiểm tra này bằng cách click nào nút xanh ở trước tên học sinh/lớp<br>
						    </p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD29.jpg') ?>" alt=""></p>
						    <p>B3: Click vào <b>Đóng</b> khi hoàn thanh các thao tác</p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD30.jpg') ?>" alt=""></p>
						    <strong>Cách 2:</strong>
						    <p>
							B1:Nếu bạn đang xem (MCQ/quiz) Chọn <b>Đố</b><br>
							B2: Hộp thoại xuất hiện/Chọn đối tượng giao bài (cá nhân, nhóm, lớp), nhập tên cá nhân/nhóm/lớp rxem một MCQ/quiz và muốn giao bài đó cho học sinh của mình, nhấn <b>Đố</b> (nhấn Gửi).
						    </p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD31.jpg') ?>" alt=""></p>
						<h4>5. Trao đổi với các thành viên trong lớp</h4>
						    <p>B1: Vào <b>Danh sách lớp</b><br>
							B2: Chọn lớp và gõ các thông điệp cần trao đổi<br>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD32.jpg') ?>" alt=""></p>
							B3: Click Đăng bài/ Hủy bỏ
						     	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD33.jpg') ?>" alt=""></p>
							</p>
						<h4>6. Tạo lớp mới</h4>
						    <p>B1: Vào <b>Tạo một lớp</b><br>
							B2: Nhập tên lớp, cấp độ (Ví dụ: lớp 5), môn học<br>
							B3: Nhấn <b>Xác nhận</b>
							</p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD34.jpg') ?>" alt=""></p>
						<h4>7. Tạo nhóm</h4>
						    <p>Vào <b>Tạo một nhóm</b>, nhập Tên nhóm và Mô tả, nhấn <b>Xác nhận</b></p>
								<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD35.jpg') ?>" alt=""></p>
						<h4>8. Trao đổi với các thành viên trong nhóm ( chưa thiết kế xong )</h4>
						    <p>Vào Quản lý nhóm<br>
							Chọn nhóm và gõ các thông điệp cần trao đổi
							</p>
					  </div><!--end Người dùng là giáo viên-->
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
					  
						<!--------------------------------------------------------------------------------------------------------------------------->
					 
					  <!--end Hướng dẫn sử dụng-->
						<!---------------------------------------------------------------------------------------------------------------------------->
					  
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
						<div role="tabpanel" class="tab-pane fade pad" id="tabDropDownTwo3a">
						  <h3 class="text-center">Hướng dẫn cho giáo viên</h3>
						<h4>1. Tạo câu hỏi trắc nghiệm</h4>
						  <p >B1: Nhấn chọn Trắc nghiệm/ chọn Tạo câu hỏi (hoặc cũng có thể trực tếp vào trường tạo câu hỏi trên trang chủ)<br>
						  	<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD84.jpg') ?>" alt=""></p>
B2: Nhập câu hỏi (upload ảnh và video nếu câu hỏi bao gồm cả ảnh và video)<br>
Nhập các trường thông tin theo yêu cầu<br>
B3: Nhấn Lưu / Hủy để lưu hoặc thay đổi thông tin
</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD85.jpg') ?>" alt=""></p>
						  <h4>2. Quản lý câu hỏi đã tạo</h4><p>
•	Nhần chọn Trắc nghiệm phí cuối bên trái màn hình/ chọn Quản lý câu hỏi<br>
•	Chọn câu hỏi muốn can thiệp ( nhấn Xem – biểu tượng hình con mắt; Sửa – biểu tượng cây bút; hoặc Xóa – biểu tượng thùng rác)</p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD86.jpg') ?>" alt=""></p>
						  <h4>3.Tạo bài kiểm tra gồm nhiều câu hỏi trắc nghiệm</h4><p>
B1: Vào Trắc nghiệm/ chọn Tạo bài kiểm tra<br>
B2: Gõ tên bài kiểm tra<br>
Phần Mô tả: Các thông tin về bài kiểm tra (không bắt buộc).<br>
Chọn Công khai (để tất cả mọi người đều có thể tiếp cận) hoặc Không công khai (chỉ những nhóm, lớp hay cá nhân mà bạn lựa chọn được tiếp cận).<br>
Vào Tùy chọn nâng cao để chọn một số yếu tố khác (như thời gian làm bài, ngày giao bài, ngày kết thúc, tỷ lệ câu hỏi cần trả lời đúng…). Nếu bạn không chọn, những yếu tố này sẽ được cài mặc định.<br>
B3: Nhấn Tiếp; click vào dấu cộng màu xanh ở đầu mỗi câu hỏi trắc nghiệm để đưa nó vào bài kiểm tra.<br>
B4: Sau khi đã chọn đủ câu hỏi, nhấn Cập nhật</p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD87.jpg') ?>" alt=""></p>
						  <h4>4. Giao bài kiểm tra</h4>
<strong>Cách 1:</strong><p>
B1: Vào Kiểm tra<br>
B2: Chọn bài kiểm tra thích hợp, nhấn Giao bài kiểm tra, hộp thoại xuất hiện<br>
Chọn ngày bắt đầu và ngày kết thúc (hạn cuối nộp bài làm)<br>
Chọn học sinh hoặc lớp cần làm bài kiểm tra này bằng cách click nào nút xanh ở trước tên học sinh/lớp<br>
<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD88.jpg') ?>" alt=""></p>
B3: Click vào Đóng khi hoàn thanh các thao tác</p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD89.jpg') ?>" alt=""></p>
						  <strong>Cách 2:</strong><p>
Nếu bạn đang xem (MCQ/quiz) Chọn Đố<br>
Hộp thoại xuất hiện/Chọn đối tượng giao bài (cá nhân, nhóm, lớp), nhập tên cá nhân/nhóm/lớp rxem một MCQ/quiz và muốn giao bài đó cho học sinh của mình, nhấn Đố (nhấn Gửi).
</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD90.jpg') ?>" alt=""></p>
						  <h4>5. Trao đổi với các thành viên trong lớp</h4><p>
Vào Lớp/ chọn Danh sách lớp<br>
Chọn lớp và gõ các thông điệp cần trao đổi<br>
Click Đăng bài/ Hủy bỏ</p>
<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD91.jpg') ?>" alt=""></p><p><img class="img-responsive" src="images/HDSD92.jpg" alt=""></p>
						  <h4>6. Tạo lớp mới</h4><p>
B1: Vào Lớp/ chọn Tạo một lớp<br>
B2: Nhập tên lớp, cấp độ (Ví dụ: lớp 5), môn học<br>
B3: Nhấn Xác nhận</p><p><img class="img-responsive" src="<?php echo base_url('images/HDSD093.jpg') ?>" alt=""></p>
						  <h4>7. Tạo nhóm</h4><p>
Vào Nhóm/ chọn Tạo một nhóm, nhập Tên nhóm và Mô tả, nhấn Xác nhận</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD94.jpg') ?>" alt=""></p>
						  <h4>8. Trao đổi với các thành viên trong nhóm (chưa thiết kế xong )</h4><p>
Vào Quản lý nhóm<br>
Chọn nhóm và gõ các thông điệp cần trao đổi</p>
					  </div><!--end Người dùng là giáo viên-->
					  <!-------------------------------------------------------------------------------------------------------------------------->
					  
					  <!---------------------------------------------------------------------------------------------------------------------------->
					  
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
					<!--end Hướng dẫn cho mobile web-->
					  

					 <!------------------------------------------------------------------------------------------------------------------------------>
					 <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownTwo3ab">
						  <h3 class="text-center">Người dùng là giáo viên</h3>
						<h4>1.	Giao bài kiểm tra</h4>
						<p>Chức năng này cho phép người dùng là giáo viên có thể dễ dàng giao bài tập cho các các học sinh, lớp chủ nhiệm. giúp học sinh có thể củng cố các kiếm thực với các lĩnh vực phù hợp. Để thực hiện giao bài cho học sinh giáo viên sẽ thực hiện các bước như sau:</p>
						  <p>Bước 1: Chọn biểu tượng trắc nghiệm ở dưới cuối trang<br>
Bước 2: Vào mục trắc nghiệm vui, chọn lĩnh vực  mong muốn<br>
						  		<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD61.jpg') ?>" alt=""></p>
Bước 3: Nhấn chọn vào biểu tượng đố để giao bài cho học sinh<br>
Bước 4: nhấn chọn thông tin nhóm và tên người dùng cần giao và nhấp chọn nút Gửi để tiến hành hoàn tất giao bài cho học sinh.
</p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD62.jpg') ?>" alt=""></p>
						  <h4>2.	Xem kết quả</h4><p>
Tính năng này cho phép giáo viên có thể xem kết quả bài kiểm tra đã hoàn thành của học sinh. Giúp dễ dàng đánh giá được khả năng của học sinh qua từng kết quả bài làm trắc nghiệm thuộc các lĩnh vực khác nhau. Ngoài ra, giáo viên cũng có thể xem kết quả bài làm trắc nghiệm, những câu hỏi đố mà giáo viên thực hiện</p>
<p>Để xem kết quả giáo viên nhấn chọn vào biểu tượng<img class="" src="<?php echo base_url('images/HDSD63.jpg') ?>" alt="">   phía dưới màn hình để xem kết quả bài làm.</p>
<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD64.jpg') ?>" alt=""></p>
					  </div><!--end Người dùng là giáo viên-->
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
					  
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
					  
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
				  </div>
				</div>
			</div>
		  </div><!--CMQ-->
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
							<input type="text" id="inpquizname" name="quiz_name"  class="form-control" placeholder="<?php echo $this->lang->line('quiz_name');?>"  required autofocus>
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
	<div class="modal fade" id="joinGroupModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Tham gia nhóm</h4>
					</div>
					<div class="modal-body">
								<input type="text" class="form-control form-TK1 col-xs-12" id="group_code" autocomplete="off" name="group_code" style="width:75%" onkeyup="checkcodegroup(event,this.value)" placeholder="Nhập Mã nhóm">
								<button class="btn btn-primary" id="btjoingroup" onclick="checkcodegroupbt()" style="margin-left:3%" >Xác nhận</button>
								<p id="errorrr" style="color:red"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
