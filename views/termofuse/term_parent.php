<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Điều khoản sử dụng</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
	<script src="<?php echo base_url('js/editprofile.js');?>"></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
   <script>	
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
    var su="<?php echo $su ?>";
	var id_mcq_fun="<?php echo $id_mcq_fun ?>";
	var id_quiz_fun="<?php echo $id_quiz_fun ?>";
	</script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
	<script src="<?php echo base_url('js/notification.js');?>"></script>
	<script src="<?php echo base_url('js/star-rating.js');?>"></script>
	<script src="<?php echo base_url('js/paginate.js');?>"></script>
	<script src="<?php echo base_url('js/assign.js');?>"></script>
	<script src="<?php echo base_url('js/manage_group.js');?>"></script>
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
			<!-- <li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('message'); ?>"><i class="far fa-envelope"></i><span class="badge badge-sm up bg-pink count mcount"></span><br  class="hidden-xs">Tin nhắn</a>
			</li> -->
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
  	        	<span class="caret"></span></a>
  	          <ul class="dropdown-menu dropdown-menu1">
  	          <!--  <li><a href="#"><i class="MR10 far fa-file-alt text-primary" aria-hidden="true"></i>Bảng tin</a></li>
  	            <li><a href="#"><i class="MR10 far fa-comments text-danger text-danger" aria-hidden="true"></i>Tin nhắn</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-th-large text-success" aria-hidden="true"></i>Khóa học</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-calendar text-danger" aria-hidden="true"></i>Sự kiện</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-users text-info" aria-hidden="true"></i>Nhóm</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-address-book text-warning" aria-hidden="true"></i>Dánh sách bạn bè</a></li>
				<li><a href="<?php echo site_url('home_user/child_list'); ?>"><i class="MR10 fa fa-users text-success" aria-hidden="true"></i>Dánh sách các con</a></li>-->
				<li><a data-toggle="modal" data-target="#transferModal" href="#"><i class="MR10 fas fa-exchange-alt text-warning" aria-hidden="true"></i>Chuyển điểm</a></li>
				  <li><a href="<?php echo site_url('profile')?>"><i class="MR10 fas fa-user text-success" aria-hidden="true"></i>Thông tin cá nhân</a></li>
				<li><a href="<?php echo site_url('profile')?>"><i class="MR10 fas fa-cog" aria-hidden="true"></i>Đổi mật khẩu</a></li>
  	            <li><a href="<?php echo site_url('user/logout');?>"><i class="MR10 fa fa-sign-out-alt"></i>Đăng Xuất</a></li>
              </ul>
            </li>
				<!--<li>
				<a class="text-trang hover text-center text-TV" href="#">Mời thành viên</a>
			</li>-->
          </ul>
        </div>
  	    <!-- /.navbar-collapse -->
  </div>
  	  <!-- /.container-fluid -->
	   <section class="visible-xs-block nav-mobile">
			<ul class="ul-mobile list-unstyled">
				<li class="mbqmn"><a data-toggle="collapse" href="#">Trắc nghiệm</a></li>
				
				<li class="mbgrmn"><a  data-toggle="collapse" href="#">Con</a></li>
				<li><a >Hướng dẫn</a></li>
			</ul>

		<ul id="tnmncl" class="panel-collapse collapse">
              
              <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
			  <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			   <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item" > <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			   <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item" > <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item" > <i class="fas fa-bullseye" style="margin-right:5px" ></i> Kết quả</a>

			  
		</ul>
		
		<ul id="grmncl" class="panel-collapse collapse">	
		     <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>   
	         <?php foreach($child_list as $k=>$child) { ?>
			  <!--<a href="<?php echo site_url('home_user/child_activities/'.$child['uid']); ?>" class="list-group-item">-->
			  <a href="#" class="list-group-item">
			  <?php echo $child['first_name'].' '.$child['last_name'] ; ?>
			  </a>
			  <?php } ?>

			  <a data-toggle="modal" data-target="#addstudentModal" class="list-group-item"><i class="far fa-plus-square" style="margin-right:5px"></i>  Thêm con</a>
			  <a data-toggle="modal" data-target="#createchildModal" class="list-group-item"><i class="far fa-plus-square" style="margin-right:5px"></i> Tạo tài khoản cho con</a>
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
					 <h4 class="media-heading"><a href="#" class="border-B1"><?php echo $user_name; ?><br><span class="text-small1">Phụ huynh</span></h4>
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
				  <a href="#" class="border-B1"style="font-size: 16px"><?php echo $user_name; ?></a> <br><span class="text-small">(Phụ huynh)</span>
			  </div>	  
			
					  <div class="box-diem">
						  <p class="text-diem1">Sao<br><span class="text-diem"><?php echo $user_point;?></span></p>
					  </div>
				  	
				  </div>
			  </div>
		  </div>
		  
		  <div class="list-group hidden-xs" id="top_menu">
			 <div style="display:none;" id="topname">quiz_menu</div>
			<h3 class="list-group-item active1">Trắc nghiệm</h3>
				<a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
				<a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			   <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			   <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item" > <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item" > <i class="fas fa-bullseye" style="margin-right:5px" ></i> Kết quả</a>
		  </div>
		  
		  <div class="list-group hidden-xs" id="quiz_menu" style="display:none;">

			  <h3 class="list-group-item active1">Trắc nghiệm</h3>
			  <a href="#fun_question" class="list-group-item" onclick="fun_question(event);"> <i class="fas fa-question" style="margin-right:5px"></i> Câu hỏi vui</a>
			  <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
			   <a href="<?php echo site_url('home_user/quiz_list'); ?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>
			   <a href="<?php echo site_url('home_user/assign_quiz'); ?>" class="list-group-item" > <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
			  <!--<a href="#" class="list-group-item">Tạo câu hỏi</a>-->
			  <!--<a href="#" class="list-group-item">Quản lý câu hỏi</a>--->
			  
		  </div>
		  
		  <div class="list-group hidden-xs" id="child_menu">
			  <h4 class="list-group-item active1">Hoạt động của con</h4>
			  <?php foreach($child_list as $k=>$child) { ?>
			  <!--<a href="<?php echo site_url('home_user/child_activities/'.$child['uid']); ?>" class="list-group-item">-->
			  <a href="#" class="list-group-item">
			  <?php echo $child['first_name'].' '.$child['last_name'] ; ?>
			  </a>
			  <?php } ?>

			  <a data-toggle="modal" data-target="#addstudentModal" class="list-group-item"><i class="far fa-plus-square" style="margin-right:5px"></i>  Thêm con</a>
			  <a data-toggle="modal" data-target="#createchildModal" class="list-group-item"><i class="far fa-plus-square" style="margin-right:5px"></i> Tạo tài khoản cho con</a>
			  
		  </div>
		  <div class="list-group hidden-xs" id="group_menu">
			  <h3 class="list-group-item active1">Nhóm</h3>
			  <a href="<?php echo site_url('home_user/manage_group') ?>" class="list-group-item"> <i class="fas fa-object-group" style="margin-right:5px"></i> Quản lý nhóm</a>
			  <a href="<?php echo site_url('home_user/create_group') ?>" class="list-group-item"> <i class="fas fa-folder-open" style="margin-right:5px"></i> Tạo một nhóm</a>
			  <a data-toggle="modal" data-target="#joinGroupModal"  class="list-group-item"> <i class="far fa-handshake" style="margin-right:5px"></i> Tham gia nhóm</a>
		  </div>
		  <div class="list-group hidden-xs" >
				 <h3 class="list-group-item active1">Về chúng tôi</h3>
				 <a href="<?php echo site_url('home/about') ?>"  class="list-group-item"><i class="fas fa-bullseye" style="margin-right:5px"></i> Giới thiệu</a>
				 <a href="<?php echo site_url('home/detail3') ?>"  class="list-group-item"><i class="fas fa-object-group" style="margin-right:5px"></i> Điều khoản sử dụng</a>
				 <a href="<?php echo site_url('home/detail1') ?>"  class="list-group-item"><i class="fas fa-folder-open" style="margin-right:5px"></i> Hướng dẫn</a>
				 <a href="<?php echo site_url('home/detail2') ?>"  class="list-group-item"><i class="fa fa-window-restore" style="margin-right:5px"></i> Chính sách riêng tư</a> 
			</div>
			
		  <div class="modal fade" id="addstudentModal" role="dialog">
			<div class="modal-dialog">	 
				 <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Thêm con</h4>
					 
					</div>
					<div class="modal-body">
		
						   <input type="text" class="form-control form-TK1 col-xs-12" id="student_code" name="student_code" style="width:450px" placeholder="Mã học sinh"/>
							<button type="submit" class="btn btn-primary" id="btn_sm_addchild"  style="margin-left:30px" onclick="add_child()">Xác nhận</button>
				
						
						 
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				 </div>
				  
			</div>
		</div>
		<div class="modal fade" id="createchildModal" role="dialog">
			<div class="modal-dialog">	 
				 <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Tạo tài khoản cho con</h4>
					 
					</div>
					<div class="modal-body">

						   <div class="form-group">	
							  Họ tên của con: <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Họ tên" required>
							  <div id="error_child" style="color: red;"></div>
							</div>
							<div class="form-group">	
							  Email của con: <input type="text" id="email" name="email" class="form-control" placeholder="email" required>
							  <div id="error1_child" style="color: red;"></div>
							</div>
							<div class="form-group">	
							Mật khẩu: <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mật khẩu" required >
							<div id="error2_child" style="color: red;"></div>
						   </div>
						   <div class="form-group">	
							Xác nhận mật khẩu: <input type="password" id="inputcfmPassword" name="passwordcfm" class="form-control" placeholder="Xác nhận lại mật khẩu" required >
							<div id="error3_child" style="color: red;"></div>
						   </div>
					       <button type="submit" class="btn btn-primary" id="btn_pr" >Xác nhận</button>
					  <script type="text/javascript">
					  		$('#btn_pr').on("click",function(){
					  			first_name=$('#first_name').val();
					  			email=$('#email').val();
					  			password=$('#inputPassword').val();
					  			passwordcfm=$('#inputcfmPassword').val();
					  			console.log(first_name);
					  			console.log(email);
					  			console.log(password);
					  			console.log(passwordcfm);
					  			$('#error_child').empty();
					  			$('#error1_child').empty();
					  			$('#error2_child').empty();
					  			$('#error3_child').empty();
					  			if(first_name==''){
					  				$('#error_child').html('<i>Họ tên của con không được để trống</i>');
					  				// console.log(first_name+"aaa");
					  			}else if(email==''){
					  				$('#error1_child').html('<i>Email của con không được để trống</i>');
					  			}else {
								    var email = document.getElementById('email').value;
								    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
								    if (!filter.test(email)) {
								    // alert('Địa chỉ Email không hợp lệ! \nVui lòng nhập lại Email');
								    $('#error1_child').html('<i>Địa chỉ Email không hợp lệ, vui lòng nhập lại Email</i>');
								    email.focus;
								    return false;
									}
					  				if(password==''){
					  					$('#error2_child').html('<i>Mật khẩu không được để trống</i>');
					  				}else if(passwordcfm==''){
					  					$('#error3_child').html('<i>Mật khẩu xác nhận không được để trống</i>');
					  				}else if(password!=passwordcfm){
					  					$('#error3_child').html('<i>Mật khẩu xác nhận không trùng khớp</i>');
					  				}else{
					  					$.ajax({
					  						type: 'POST',
					  						data: {first_name:first_name,email:email,password:password,passwordcfm:passwordcfm},
					  						url:"<?php echo site_url('/home_user/create_child') ?>",
					  						success: function(data){
					  							console.log(data);
					  							if(data==true){
					  								$('#createchildModal').modal('hide');
					  								alert('Bạn đã đăng ký thành công!');
					  							}else{
					  								alert('Email này đã được đăng ký \nVui lòng đăng ký bằng Email khác');
					  							}
					  						},
					  						error: function(data){
					  						}
					  					});
					  				}
					  			}
					  		});
					  </script>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				 </div>
				  
			</div>
		</div>
  	  </aside>
	<aside class="col-md-10">
        
  	
    
		<img class="img-responsive col-md-12" src="<?php echo base_url('images/home_anh15.jpg');?>" alt="">	
		<h1  style="text-align:center"> <b>Điều khoản sử dụng: </b></h1>
		 
			<h4> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bản quy chế này áp dụng cho các thành viên đăng ký sử dụng Mạng xã hội Stem.vn. Thành viên tham gia là cá nhân phải đăng ký và được Stem.vn công nhận, cho phép sử dụng dịch vụ. Người sử dụng phải đảm bảo các thông tin cá nhân cung cấp cho chúng tôi là trung thực, mới nhất và chính xác. Các thông tin thành viên chỉ được dùng để: Cung cấp tài khoản, bao gồm dịch vụ, tiện ích và sự hỗ trợ, chăm sóc… nhằm nâng cao chất lượng ngân hàng MCQ; giải quyết các vấn đề hay tranh chấp phát sinh khi thành viên sử dụng các MCQ. 
			</h4>
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Các thông tin đăng ký không được tiết lộ, chuyển nhượng, cho thuê hoặc bán cho bên thứ ba khi chưa được sự đồng ý của các bên liên quan, trừ trường hợp có yêu cầu cơ quan chức năng. Stem.vn có trách nhiệm hỗ trợ cơ quan quản lý nhà nước điều tra các hành vi kinh doanh vi phạm pháp luật; cung cấp các tài liệu như thông tin đăng ký, lịch sử dữ liệu giao dịch… của đối tượng có hành vi vi phạm pháp luật trên hệ thống.
			</h4>
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Người sử dụng có trách nhiệm tự bảo vệ mật khẩu của mình trên Stem.vn. Chúng tôi khuyến khích bạn nên dùng mật khẩu mang tính bảo mật cao (bao gồm chữ thường, chữ hoa, chữ số và ký hiệu cho phép). Chủ tài khoản phải hoàn toàn chịu trách nhiệm cho mọi hoạt động được thực hiện dưới tên tài khoản và mật khẩu đã đăng kí.
			</h4>	 
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Người sử dụng không tái bản, sao chụp, bán, bán lại hoặc lợi dụng bất kỳ phần nào của Stem.vn cho mục đích thương mại, nếu không được chúng tôi  cho phép bằng văn bản. 
			</h4>
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stem.vn có quyền cập nhật, chỉnh sửa nội dung các điều khoản mà không cần báo trước. Và khi bạn tiếp tục sử dụng mạng xã hội Stem.vn  sau khi các thay đổi về điều khoản và điều kiện được đăng tải, có nghĩa là bạn chấp nhận những thay đổi đó.
			</h4>				
			
			<h4>
			<b>Về việc trao đổi, chia sẻ, cung cấp thông tin trên Stem.vn</b>
			</h4>	  
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Người sử dụng hiểu rằng các nội dung được đăng tải trên Stem.vn, dù là công khai hoặc được truyền đưa riêng, hoàn toàn thuộc vể trách nhiệm của người tạo ra nội dung đó. Điều này có nghĩa là bạn phải hoàn toàn chịu trách nhiệm với:  Toàn bộ nội dung mà bạn tải lên, đăng, gửi, truyền đưa hoặc tạo sẵn;  việc bạn tiếp xúc, sử dụng những nội dung của người khác trên Stem.vn hoặc với bất cứ tổn thất nào phát sinh từ việc bạn tiếp xúc, sử dụng chúng.
			</h4>
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Người sử dụng hoàn toàn chịu trách nhiệm trước pháp luật về các nội dung do bạn đưa lên mạng xã hội Stem.vn. 
			</h4>
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Người sử dụng cam kết không đăng tải, trao đổi, chia sẻ trên mạng xã hội Stem.vn các nội dung bị cấm theo khoản 1, điều 5, Nghị định 72/2013/NĐ-CP về quản lý, cung cấp sử dụng dịch vụ Internet và thông tin trên mạng; đồng thời cam kết tuân thủ mọi quy định của pháp luật về chia sẻ, trao đổi thông tin, quảng cáo, khuyến mại, bảo vệ quyền sở hữu trí tuệ, bảo vệ quyền lợi người tiêu dùng và các quy định của pháp luật có liên quan khác khi sử dụng mạng xã hội Stem.vn.
			</h4>
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stem.vn được sử dụng, tái sản xuất, xuất bản, cung  cấp, dịch và tạo ra các phiên bản phái sinh từ các nội dung được người dùng đăng tải lên Stem.vn. Các nội dung này có thể tiếp tục thuộc giao diện nội dung trên Stem.vn ngay cả khi tài khoản của người sử dụng đã bị xóa vì bất kỳ lý do gì. Chúng tôi cũng có quyền từ chối xuất bản, loại bỏ bất kỳ nội dung nào mà người sử dụng đã cung cấp trên Stem.vn hoặc  xử lý các thông tin đăng tải cho phù hợp với thuần phong mỹ tục, các quy tắc đạo đức và các quy tắc đảm bảo an ninh quốc gia. Chúng tôi có toàn quyền cho phép hoặc không cho phép bài viết của người sử dụng xuất hiện hay tồn tại trên Stem.vn.
			</h4>
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stem.vn được sử dụng, tái sản xuất, xuất bản, cung  cấp, dịch và tạo ra các phiên bản phái sinh từ các nội dung được người dùng đăng tải lên Stem.vn. Các nội dung này có thể tiếp tục thuộc giao diện nội dung trên Stem.vn ngay cả khi tài khoản của người sử dụng đã bị xóa vì bất kỳ lý do gì. Chúng tôi cũng có quyền từ chối xuất bản, loại bỏ bất kỳ nội dung nào mà người sử dụng đã cung cấp trên Stem.vn hoặc  xử lý các thông tin đăng tải cho phù hợp với thuần phong mỹ tục, các quy tắc đạo đức và các quy tắc đảm bảo an ninh quốc gia. Chúng tôi có toàn quyền cho phép hoặc không cho phép bài viết của người sử dụng xuất hiện hay tồn tại trên Stem.vn.
			</h4>
			<h4>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Để đảm bảo hoạt động lành mạnh và thông suốt của mạng xã hội Stem.vn, Ban quản trị diễn đàn có quyền xoá các nội dung bạn đăng tải, hủy tư cách thành viên, tạm dừng hoặc hủy cung cấp dịch vụ cho của bạn mà không cần báo trước nếu chúng tôi tin rằng bạn có hành động vi phạm các điều khoản trên. 
			</h4>
		<h3><p class="text-right" style="padding-right:30px"><b>Stem.vn</b></p></h3>
	</aside>
	  
      
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
 								    <li class="active"><a data-toggle="tab" href="#studenttab">Học sinh</a></li>
 								    <!-- <li><a data-toggle="tab" href="#classtab" id="assClass">Lớp</a></li> -->
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
	    					<!--	<div class="assStudent" style="float: left;">
									<input type="checkbox" name="uids" value="1">Học sinh&nbsp;&nbsp;&nbsp;
								</div>
								<div class="assClass">
									<input type="checkbox" name="clid" value="0">Lớp
								</div>
							</div>
							<div class="form-group selectUids">
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
  	
  
  </body>
</html>