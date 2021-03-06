<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hướng dẫn sử dụng STEMUP </title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	 <script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/manage_class.js') ?>"></script>
	<script src="<?php echo base_url('js/manage_group.js') ?>"></script>
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
	<script src="<?php echo base_url('js/editprofile.js');?>"></script>
	<script src="<?php echo base_url('js/group.js');?>"></script>
	
   <script>	
	var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
	var id_mcq_fun="<?php echo $id_mcq_fun ?>";
	var id_quiz_fun="<?php echo $id_quiz_fun ?>";
	</script>
	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
	<script src="<?php echo base_url('js/notification.js');?>"></script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
  </head>
  <body class="bg-body">
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
				<!-- <a class="text-trang hover" href="<?php echo site_url('message'); ?>">
					<i class="far fa-envelope"></i>
					<span class="badge badge-sm up bg-pink count mcount"></span>
				</a> -->
				
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
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/assign_quiz'); ?>" ><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
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
  	           <!-- <li><a href="#"><i class="MR10 fa fa-file-alt text-primary" aria-hidden="true"></i>Bảng tin</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-comments text-danger" aria-hidden="true"></i>Tin nhắn</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-th-large text-success" aria-hidden="true"></i>Khóa học</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-calendar text-danger" aria-hidden="true"></i>Sự kiện</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-users text-info" aria-hidden="true"></i>Nhóm</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-address-book text-warning" aria-hidden="true"></i>Dánh sách bạn bè</a></li>-->
  	            <li><a href="<?php echo site_url('profile')?>"><i class="MR10 fas fa-user text-success" aria-hidden="true"></i>Thông tin cá nhân</a></li>
				 <li><a data-toggle="modal" data-target="#changepwdModal" href="#"><i class="MR10 fas fa-cog" aria-hidden="true"></i>Đổi mật khẩu</a></li>
  	            <li><a href="<?php echo site_url('user/logout');?>"><i class="MR10 fa fa-sign-out-alt"></i>Đăng xuất</a></li>
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
			  <!--<a href="#gocthutai" class="list-group-item" onclick="gocthutai(event);"> <i class="fas fa-flag-checkered" style="margin-right:5px"></i> Góc thử tài</a>-->
			  <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			  <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			  <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item"> <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài được giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item" > <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
			  
		</ul>
		<ul id="clmncl" class="panel-collapse collapse">	
                <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>   
			  <a href="<?php echo site_url('home_user/manage_class') ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
			  <a data-toggle="modal" data-target="#joinClassModal" class="list-group-item"> <i class="fas fa-handshake" style="margin-right:5px"></i>  Tham gia lớp</a>
		</ul>
		<ul id="grmncl" class="panel-collapse collapse">	
	          <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
			  <a data-toggle="modal" data-target="#joinGroupModal" class="list-group-item"> <i class="far fa-handshake" style="margin-right:5px"></i> Tham gia nhóm</a>
		</ul>
			
	  </section>
	  
  </nav><!--end nav-->
<main class="container MT70">
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
                        		<td>Mã học sinh</td>
                        		<td>
                        			<?php  echo $user_code ?>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
							<tr>
                        		<td>Ngày Sinh</td>
                        		<td>
                        			<?php  echo $brithdate?>
                        		</td>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
							<tr>
                        		<td>Lớp</td>
                        		<td>
                        			<?php  echo $class?>
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
	 <div class="modal fade" id="joinClassModal" role="dialog">
			<div class="modal-dialog">	 
				 <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Tham gia lớp</h4>
					</div>
					<div class="modal-body">
							 <input type="text" class="form-control form-TK1 col-xs-12"  name="class_code" id="class_code" onkeyup="checklengthtab(event,this.value)" style="width:450px" placeholder="Nhập Mã lớp"/>
					          <button  id="btjoinclass" onclick="checklength()" class="btn btn-primary" style="margin-left:30px">Xác nhận</button>
										<br><br>
										<p id="errorr" style="color:red" ></p>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
					 <h4 class="media-heading"><a href="#" class="border-B1"><?php echo $user_name; ?><br><span class="text-small1">Học sinh</span></h4>
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
				  <a href="#" class="border-B1"style="font-size: 16px"><?php echo $user_name; ?></a> <br><span class="text-small">(Học sinh)</span>
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
			  <!--<a href="#gocthutai" class="list-group-item" onclick="gocthutai(event);"> <i class="fas fa-flag-checkered" style="margin-right:5px"></i> Góc thử tài</a>-->
			   <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			   <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			  <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item" > <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			  <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item"> <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài được giao<?php if($su==2&&$num_qas>0){?>
				<span class="badge badge-sm bg-pink mr-5"><?php echo $num_qas;?></span>
			  <?php }?></a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
		  </div>
		  <div class="list-group hidden-xs" id="quiz_menu" style="display:none;">
			  <h3 class="list-group-item active1">Trắc nghiệm</h3>
			  <!-- <a href="#gocthutai" class="list-group-item" onclick="gocthutai(event);"> <i class="fas fa-flag-checkered" style="margin-right:5px"></i> Góc thử tài</a>-->
			 <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			 <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			  <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item" > <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			  <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item"> <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài được giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
			  <!--<a href="#" class="list-group-item">Tạo câu hỏi</a>-->
			  <!--<a href="#" class="list-group-item">Quản lý câu hỏi</a>--->
			  
		  </div>
		  <div class="list-group hidden-xs" id="class_menu">
			  <h3 class="list-group-item active1">Lớp</h3>
			  <div id ="classpage_menu"></div>
			  <a href="<?php echo site_url('home_user/manage_class') ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
			  <a data-toggle="modal" data-target="#joinClassModal" class="list-group-item"> <i class="fas fa-handshake" style="margin-right:5px"></i>  Tham gia lớp</a>
		  </div>
		  <div class="list-group hidden-xs" id="group_menu">
			  <h3 class="list-group-item active1">Nhóm</h3>
			  <!--<a href="#" class="list-group-item">Quản lý nhóm</a>
			  <a href="#" class="list-group-item">Tạo một nhóm</a>-->
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
		<h2 class="text-center">Hướng dẫn cách chi tiết download và sử dụng app STEMUP Học Sinh</h2>
		<h3>1. Hướng dẫn cài đặt và tạo tài khoản trên app STEMUP Học Sinh.</h3>
		<h4 id="phare_helpmobile">Bước 1: Cài đặt STEMUP Học Sinh bằng smartphone</h4>
		<p id="content_helpmobile">Hiện nay, với sự phổ biến và tiện ích sử dụng mà smartphone đem lại. Do.stem,vn đưa ra một bước tiến mới trong việc kết nối giữa phụ huynh, giáo viên và học sinh thông qua App Mobile. Việc cài đặt phần mềm STEMUP Học Sinh tương tự một ứng dụng tiện ích bất kỳ nào dành cho người dùng trên điện thoại thông minh, dù là hệ điều hành ios hay Android.</p>
		<p><b>+ Với Android:</b></p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile1.png') ?>" alt=""></p>
		<p><b>+ Với ios (iphone, ipad):</b></p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile2.png') ?>" alt=""></p>
		<h4 id="phare_helpmobile">Bước 2: Đăng nhập</h4>
		<p>• Nhập Email và Mật khẩu (đã đăng ký).</p>
		<p>• Click nút Đăng nhập để sử dụng ứng dụng.</p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile3.png') ?>" alt=""></p>
		<p id="content_helpmobile">Trong trường hợp bạn chưa đăng ký thông tin thì cần click <b>Đăng ký</b> để có thể đăng nhập và sử dụng ứng dụng.</p>
		<p id="content_helpmobile">Sau khi click vào <b>Đăng ký</b> giao diện hiển thị form đăng ký thông tin. Bạn cần nhập các thông tin theo yêu cầu và xác nhận đăng ký thành công.</p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile4.png') ?>" alt=""></p>
		<h3>2. Hướng dẫn sử dụng các chức năng trên app STEMUP Học Sinh.</h3>
		<h4><i>Tính năng 1: Xem và cập nhật thay đổi thông tin người dùng </i></h4>
		<p id="content_helpmobile">Nhấn chọn biểu trượng cấu hình để xem thông tin. Tại chức năng này người dùng có thể thay thông tin về tài khoản của mình (hình ảnh đại diện, họ tên, số điện thoại,…) để tăng tính bảo mật.</p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile5.png') ?>" alt=""></p>
		<h4><i>Tính năng 2: Chức năng làm Bài trắc nghiệm được giao và bài tập trắc nghiệm có sẵn.</i></h4>
		<p><b>+ Sử dụng chức năng cho phép làm và xem kết quả bài trắc nghiệm được giao.</b></p>
		<p id="content_helpmobile">Chức năng cho phép con có thể mở bài trắc nghiệm do phụ huynh giao để làm và xem kết quả bài làm. Kết quả trắc nghiệm sau khi con hoàn thành sẽ chuyển đến app STEMUP Phụ huynh. Con cũng có thể xem chi tiết bài làm của mình, hệ thống sẽ cung cấp kết quả từng câu hỏi đến trang Kết quả chi tiết.</p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile6.png') ?>" alt=""></p>
		<p><b>+ Sử dụng chức năng cho phép làm và xem kết quả bài trắc nghiệm có sẵn do hệ thống cập nhật.</b></p>
		<p id="content_helpmobile">Phần mềm cho phép người dùng học sinh làm câu hỏi trắc nghiệm. Mỗi bài trắc nghiệm sẽ được chia ra thành các lĩnh vực khác nhau; giúp dễ dàng trong việc lựa chọn các lĩnh vực mong muốn. Để thực hiện bài kiểm tra học sinh sẽ thực hiện các bước thực hiện như sau:</p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile7.png') ?>" alt=""></p>
		<h4><i>Tính năng 3: Hiển thị kết quả bài trắc nghiệm sau khi hoàn thành.</i></h4>
		<p id="content_helpmobile">Người dùng có thể xem kết quả bài làm thông qua tính năng Kết quả do hệ thống cung cấp. Bên cạnh % kết quả trả lời, đánh giá mức độ hoàn thành bài kiểm tra ( Vượt qua, không vượt qua,…); người dùng cũng có thể xem chi tiết kết quả bài làm.</p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile8.png') ?>" alt=""></p>
		<h4><i>Tính năng 4: Cập nhật các thông báo</i></h4>
		<p id="content_helpmobile">Bên cạnh tính năng thông báo qua notification, hệ thống còn cập nhật thêm tính năng Thông báo. Tính năng này cho phép lưu các thông báo về Bài trắc nghiệm được phụ huynh giao co con, kết quả bài tập vừa hoàn thành.</p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile9.png') ?>" alt=""></p>
		<h4><i>Tính năng 5: Cung cấp chức năng Tự Học.</i></h4>
		<p id="content_helpmobile">Ngoài chức năng làm bài trắc nghiệm, hệ thống còn cung cấp thêm tính năng Tự học. Tính năng này cung cấp các câu hỏi đa dạng phong phú theo từng môn học và khối lớp khác nhau. Giúp người học có thể bổ sung và hoàn thiện kiến thức qua nhưng câu hỏi trắc nghiệm được hiển thị trên trang.</p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile10.png') ?>" alt=""></p>
		<p id="content_helpmobile">Bên cạnh đó người  dùng cũng có thể chia sẻ lên trang facebook cá nhân và bình luận dưới mỗi câu hỏi quan tâm.</p>
		<p><b>+ Chia sẻ câu hỏi lên trang facebook cá nhân.</b></p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile11.png') ?>" alt=""></p>
		<p><b>+ Bình luận</b></p>
		<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/help_mobile12.png') ?>" alt=""></p>
	</aside>	  
	  
	  
      <div class="modal fade" id="ratingModal" role="dialog" >
		<div class="modal-dialog">	 
			 <div class="modal-content" >
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
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
				  <button type="button" class="btn btn-default"  data-dismiss="modal">Hủy</button>
				</div>
			 </div>
			  
		</div>
	</div>
    </section>
  	</main>
  	

  </body>

  </body>
</html>
