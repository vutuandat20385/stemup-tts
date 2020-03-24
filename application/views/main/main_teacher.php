<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giới thiệu</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/main.css');?>" rel="stylesheet">
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
			  <a href="<?php echo site_url('home_user/manage_class') ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Quản lý lớp</a>
			 <a href="<?php echo site_url('home_user#create_class') ?>" class="list-group-item" onclick="create_class(event);"> <i class="fab fa-dropbox" style="margin-right:5px"></i> Tạo một lớp</a>
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
    <nav class="container">
  <div class="row padTB10">
		<div class="col-md-3"><a href=""><img class="img-responsive" src="<?php echo base_url('images/logo.png');?>" alt=""></a></div>
		<div class="col-md-3 col-md-offset-6">
			<div class="input-group mt-5">
			  
			</div>
		</div>
	</div>
</nav>
	<!--slide-->
<div id="thumbnail-preview-indicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
			<li data-target="#carousel1" data-slide-to="0" class="active"></li>
			<li data-target="#carousel1" data-slide-to="1"></li>
			<!--<li data-target="#carousel1" data-slide-to="2"></li>-->
		  </ol>
          <div class="carousel-inner">
            <div class="item slides active">
              <div class="slide-1"></div>
              <div class="container">
                <div class="carousel-caption carousel-caption1">
                  <h1>Kho bài tập dưới hình thức trắc nghiệm trực tuyến với hàng chục nghìn câu hỏi</h1>
                  <p><a class="btn btn5 btn-lg" href="<?php echo base_url('index.php/home/detail/1');?>" role="button">Chi tiết<i class="ML10 fas fa-angle-double-right"></i></a></p>
                </div>
              </div>
            </div>
            <div class="item slides">
              <div class="slide-2"></div>
              <div class="container">
                <div class="carousel-caption carousel-caption1">
                  <h1>stemup.app -  một bộ phận quan trọng của Stem.vn  - mạng xã hội dành cho cộng đồng giáo dục</h1>
                  <p><a class="btn btn5 btn-lg" href="<?php echo base_url('index.php/home/detail/2');?>" role="button">Chi tiết<i class="ML10 fas fa-angle-double-right"></i></a></p>
                </div>
              </div>
            </div>
           <!-- <div class="item slides">
              <div class="slide-3" ></div>
              <div class="container">
                <div class="carousel-caption carousel-caption1">
                  <h1>For every learner, every step of the way</h1>
                  <p><a class="btn btn5 btn-lg" href="#" role="button">Chi tiết<i class="ML10 fas fa-angle-double-right"></i></a></p>
                </div>
              </div>
            </div>
			-->
  </div>
          <a class="left carousel-control" href="#thumbnail-preview-indicators" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
          <a class="right carousel-control" href="#thumbnail-preview-indicators" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div> <!--end slide-->
	
	<!--Gioi thiệu-->
	<h1 class="container text-center text-slogan">Chúng tôi giúp việc học tập, kiểm tra, ra bài tập… trở nên đơn giản và gây hứng thú nhiều hơn cho học sinh và giáo viên</h1>
	<section class="container">
		<div class="row mb-50">
			<div class="col-md-3">
			  <p class="text-justify">
				<a href="<?php echo base_url('index.php/home/detail/student');?>">
					<span class="tle-CM1">Học sinh<br></span>
					Việc làm bài cũng như luyện tập giờ đây trở nên đơn giản và gây hứng thú hơn nhiều bởi các em sẽ không mất bao nhiêu thời gian, công sức để trình bày những điều đã học. Với việc chọn câu trả lời theo hình thức trắc nghiệm, chỉ cần một cái click chuột, các em đã “nhặt” được một “hạt”  tri thức. 
				</a>
			  </p>
			</div>
			<div class="col-md-3">
			  <p class="text-justify">
				<a href="<?php echo base_url('index.php/home/detail/teacher');?>">
					<span class="tle-CM2">Giáo viên<br></span>
					 Ra bài tập, bài kiểm tra rồi vùi đầu đọc và chấm bài là cơn ác mộng của nhiều giáo viên, vốn đã quá “nghèo” thời gian vì phải phụ trách nhiều lớp, hoặc phải làm công tác chủ nhiệm. Hệ thống MCQ của stemup.app sẽ giúp bạn đơn giản hóa công việc này.
				</a>
			  </p>
			</div>
			<div class="col-md-3">
			  <p class="text-justify">
				<a href="<?php echo base_url('index.php/home/detail/school');?>">
					<span class="tle-CM3">Nhà trường, xã hội<br></span>
					 stemup.app góp phần tối ưu và minh bạch hóa một trong các khâu quan trọng và chiếm thời lượng khá lớn của giáo viên: Ra bài tập, bài kiểm tra, bài thi, chấm điểm và đánh giá kết quả. Điều này giúp việc số hóa dạy và học trở nên thiết thực và hiệu quả hơn.
				</a>
			  </p>
			</div>
			<div class="col-md-3">
			  <p class="text-justify">
				<a href="<?php echo base_url('index.php/home/detail/parent');?>">
					<span class="tle-CM4">Phụ huynh<br></span>
					Chỉ cần đăng nhập tài khoản “đi theo” con mình, bạn đã có đủ kết quả từng bài tập, bài thi, biết con làm sai những câu nào, yếu những mảng nào.
				</a>
			  </p>
			</div>
		</div>
		
	  
	</section>

	<!--phong thần-->
	<!-- <section class="bg-dk">
		<div class="container text-center">
			<div class="box-tle">
			  <div class="arrow-left pull-left"></div>
			  <h2 class="tle2 pull-left">Bảng phong thần</h2>
			  <div class="arrow-right1 pull-left"></div>
		  </div>
			<div>
		  <p class="text-center col-md-offset-1 col-md-10 text-trang1">
				Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
			</p></div>
			  <div id="carousel2" class="carousel slide mb-50" data-ride="carousel">
				  <div class="carousel-inner" role="listbox">
				    <div class="item active">
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh1.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh1.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh1.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh1.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh1.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh1.jpg" alt=""></a>
			        </div>
				    <div class="item">
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh2.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh2.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh2.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh2.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh2.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh2.jpg" alt=""></a>
			        </div>
				    <div class="item">
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh3.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh3.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh3.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh3.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh3.jpg" alt=""></a>
							<a class="col-md-2" href=""><img class="img-responsive img-circle" src="images/mh3.jpg" alt=""></a>
			        </div>
			    </div>
				  <a class="left1 left carousel-control top132" href="#carousel2" role="button" data-slide="prev">
					  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					  <span class="sr-only">Previous</span>
				  </a>
				  <a class="right1 right carousel-control top132" href="#carousel2" role="button" data-slide="next">
					  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					  <span class="sr-only">Next</span>
				  </a>
            </div>
			<p class="text-center">
				<a class="btn4" href="">Xem danh sách chi tiết</a>
			</p>
		</div>
	</section> -->
		
	<!--Giới thiệu-->
	<!-- <section class="container mb-50">
		<h1 class="container text-center text-slogan">We help people learn English and prove <br>their skills to the world</h1>
		<p class="col-md-8 col-md-offset-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae sed tempore dolorum fugiat suscipit fugit eaque quo ab optio, pariatur, obcaecati aspernatur, consectetur, reprehenderit repellat nostrum facere? Omnis itaque, ex.</p>
	</section> -->
	<!--footer-->
  	  
	  
	  
      
      
      
      	
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