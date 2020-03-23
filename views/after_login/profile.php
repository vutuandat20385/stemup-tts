<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin cá nhân</title>
    <!-- Bootstrap -->
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<script src="<?php echo base_url('js/profile.js');?>"></script>
		<script src="<?php echo base_url('js/data.js');?>"></script>
	<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	<link href="https://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" rel="stylesheet">
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
	<style>
	@media screen and (max-width: 767px) {
		.nav-tabs>li {
			float: none;
		}
		 .nav-tabs>li>a>h4{
			font-size:16px;
		}
		
		#catearea{
			height:300px;
		}
		#levelarea{
			height:200px;
		}
    }
	</style>
	<script>

	
	var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
	var su="<?php echo $su;?>";

	</script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
<script src="<?php echo base_url('js/editprofile.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>

	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
	<script src="<?php echo base_url('js/notification.js');?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
  </head>
  <body class="bg-body">
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
			  <a class="navbar-brand navbar-brand1" href="#">
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
  	            <ul class="nav navbar-nav navbar-right">
  	        <li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user'); ?>"><i class="mr-5 fas fa-home"></i><br class="hidden-xs">Trang chủ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user'); ?>#assign_quiz" onclick="quizAssignTo(event);"><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user'); ?>#result" onclick="resultItem(event);" ><i class="mr-5 far fa-chart-bar"></i><br class="hidden-xs">Kết quả</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>"><i class="mr-5 fas fa-cloud"></i><br class="hidden-xs">Thư viện</a>
			</li>
			<!--<li>
				<a class="text-trang hover text-center" href="#"><i class="far fa-envelope"></i><span class="badge badge-sm up bg-pink count">4</span><br>Tin nhắn</a>
			</li>
			<li>
				<a class="text-trang hover text-center" href="#"><i class="far fa-bell"></i><span class="badge badge-sm up bg-pink count">4</span><br>Thông báo</a>
			</li>-->
			<li class="dropdown ndropdown pointer">
				<a class="text-trang hover text-center  text-l" data-toggle="dropdown">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount mr-5"></span>
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
			<?php if($su==6){?>
				   <li>
					<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/moderate_question'); ?>"  ><i class="fas fa-check-circle"></i><span class="badge badge-sm up bg-pink count modcount"></span><br  class="hidden-xs">Kiểm duyệt</a>
				</li>
				 <?php } ?>
  	        <li class="dropdown"><a href="#" class="dropdown-toggle bt-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
  	        	<?php if($link_photo) { ?>
    			    <img id="avt" class=" img-circle MR5" src="<?php echo $link_photo;?> " alt="" width="32" height="32">
    			<?php } else{ ?>   
    			   <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="32">
    			<?php } ?> 
  	        	<span class=" 
caret caret_e 
"></span></a>
  	          <ul class="dropdown-menu dropdown-menu1 ">
  	           <!-- <li><a href="#"><i class="MR10 far fa-file-alt text-primary" aria-hidden="true"></i>Bảng tin</a></li>
  	            <li><a href="#"><i class="MR10 far fa-comments text-danger" aria-hidden="true"></i>Tin nhắn</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-th-large text-success" aria-hidden="true"></i>Khóa học</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-calendar text-danger" aria-hidden="true"></i>Sự kiện</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-users text-info" aria-hidden="true"></i>Nhóm</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-address-book text-warning" aria-hidden="true"></i>Dánh sách bạn bè</a></li> -->
				<?php if($su ==1 || $su==3 || $su==4){?> 
					<li><a data-toggle="modal" data-target="#transferModal" href="#"><i class="MR10 fas fa-exchange-alt text-warning" aria-hidden="true"></i>Chuyển điểm</a></li>
				<?php }?>
  	            <li><a href="<?php echo site_url('profile')?>"><i class="MR10 fas fa-user text-success" aria-hidden="true"></i>Thông tin cá nhân</a></li>
				<li><a data-toggle="modal" data-target="#changepwdModal" href="#"><i class="MR10 fas fa-cog" aria-hidden="true"></i>Đổi mật khẩu</a></li>
  	            <li><a href="<?php echo site_url('user/logout');?>"><i class="MR10 fas fa-sign-out-alt"></i> Đăng xuất</a></li>
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
	<div class="modal fade" id="editlogoModal" role="dialog">
		<div class="modal-dialog">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Chỉnh sửa logo</h4>
				 
				</div>
				<div class="modal-body">
				     <form method="post" action="<?php echo site_url('home_user/upload_logo');?>" enctype="multipart/form-data">
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
   <div class="modal fade" id="editcategModal" role="dialog">
 		<div class="modal-dialog">	 
 			 <div class="modal-content">
 				<div class="modal-header">
 				  <button type="button" class="close" data-dismiss="modal">&times;</button>
 				  <h4 class="modal-title">Các môn dạy</h4>
 				 
 				</div>
				<form method="post" action="<?php echo site_url('profile/change_category')?>">
					<div class="modal-body col-md-12" >
					 <?php foreach($categories as $k=> $cat){ 
						if(in_array($cat['cid'], $categ_ids)){
						 ?>  
							<div class="col-md-3">
								<input value="<?php echo $cat['cid'] ?>" name="category[]" type="checkbox" checked> <?php echo $cat['category_name']?></input>
							</div>
						 <?php } else { ?>				 
							<div class="col-md-3">
								<input value="<?php echo $cat['cid'] ?>" name="category[]" type="checkbox" > <?php echo $cat['category_name']?></input>
							</div>
						 <?php }}?>

						
					</div>
					<div class="modal-footer ">
					  <button type="submit" class="btn btn-success">Xác nhận</button>
					   <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
					</div>
				 </form>
 		 </div>
 			  
 		</div>
 	</div>
	<section class="row">
  	  <aside class="col-md-12" >
	    <div class="box-bor col-md-12 col-xs-12">
			<div id="user-avatar-box" class="col-md-3 hidden-xs" style="position: relative">
			    <?php if($link_photo) { ?>
    			    <img id="avt" class=" MR5" src="<?php echo $link_photo;?> " alt="" width="160" height="160">
    			<?php } else{ ?>   
    			   <img id="avt" class=" MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" height="160">
    			<?php } ?> 
				<div class="file-upload-wrap wrap-camera" style="position: absolute;top: 110px;left: 0;width: 100%;margin: 0;">
					<div class="file-upload-button-wrap" style="display: block;float: none; margin-left:110px ">
						<a href="#" title="Chỉnh sửa ảnh đại diện" data-toggle="modal" data-target="#editavtModal"><img src="//a.edim.co/images_v2/icons/camera_50.png" id="user-avatar-camera-icon" class="ttip"></a>
					</div>
				</div>
			</div>
			<div id="user-avatar-box-1" class="col-xs-4 hidden-lg" style="position: relative">
			    <?php if($link_photo) { ?>
    			    <img id="avt" class=" MR5" src="<?php echo $link_photo;?> " alt="" width="80" height="80">
    			<?php } else{ ?>   
    			   <img id="avt" class=" MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" height="80">
    			<?php } ?> 
				<div class="file-upload-wrap wrap-camera" style="position: absolute;top: 50px;left: 0;width: 100%;margin: 0;">
					<div class="file-upload-button-wrap" style="display: block;float: none; margin-left:50px ">
						<a href="#" title="Chỉnh sửa ảnh đại diện" data-toggle="modal" data-target="#editavtModal"><img src="//a.edim.co/images_v2/icons/camera_50.png" id="user-avatar-camera-icon" class="ttip" width="30px"></a>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-xs-8">
				<p><a href="<?php echo site_url('home_user');?>"><h2 style="margin-top:-5px"><?php echo $user_name ?></h2></a></p>
				<?php if($su==3) { ?>
				 <p>Giáo viên</p>
				<?php	if(!$category){ ?>
				   
					<p><a href="#" data-toggle="modal" data-target="#editcategModal"><h4><i class="far fa-bookmark"></i> Thêm môn dạy</h4></a></p>
				<?php } else{ ?>
				    <p><h4> <i class="far fa-bookmark"></i> Dạy môn <?php echo $category ?><a href="#"  data-toggle="modal" data-target="#editcategModal"> <i class="fas fa-pencil-alt" style="margin-left:20px"></i></a></h4></p>
				<?php }}?>
				<?php if($su==6) { ?>
				<p>Quản trị viên</p>
				<?php } ?>
				<?php if($su==2) { ?>
				<p>Học sinh</p>
				<p>Mã học sinh: <?php echo $user_code ?></p>
				<?php }?>
				<?php if($su==4) { ?>
				<p>Phụ huynh</p>
				<?php }?>
				<?php if($su==1) { ?>
				<p>Admin</p>
				<?php }?>
				<?php if($su==7) { ?>
				<p>Trường</p>
				<?php }?>
				<?php if($su==8) { ?>
				<p>Tổ chức</p>
				<?php }?>
				<!--<p><a href="#"><h4><i class="far fa-clock"></i>  Add Year Started </h4></a></p>-->
				
				<?php if(!$school){?>
					<!--<p><a href="#"><h4><i class="fas fa-map-marker-alt"></i> Add your school</h4></a></p>-->
				<?php } else{?>
				    <p><h4><a href="#"><i class="fas fa-map-marker-alt"></i> Trường <?php echo $school ?> </a> <a href="#"> <i class="fas fa-edit"></i></a></h4></p>
				<?php }?>
				
			</div>
			<div class="col-md-12 col-xs-12" style="margin-top:20px">
				<ul class="nav nav-tabs">
				  <li class="active"><a data-toggle="tab" href="#intro"><h4>Giới thiệu</h4></a></li>
				  <li><a data-toggle="tab" href="#info"><h4>Thông tin cá nhân</h4></a></li>
				  <li><a data-toggle="tab" href="#categ"><h4>Lĩnh vực quan tâm</h4></a></li>
				  <li><a data-toggle="tab" href="#level"><h4>Lớp quan tâm</h4></a></li>
				  <li><a data-toggle="tab" href="#sub"><h4>Theo dõi</h4></a></li>
				  <?php if($su==3) { ?>
					<li><a data-toggle="tab" href="#logorg"><h4>Logo</h4></a></li>
					<?php }?>
					<?php if($su==2 || $su==3 || $su==4){
						?>
							<li><a data-toggle="tab" href="#changePer"><h4>Đổi tài khoản</h4></a></li>
						<?php
					} ?>
				  <!--<li><a data-toggle="tab" href="#stat"><h4>Thống kê</h4></a></li>-->
				  
				</ul>
			</div>
		</div>
        		
  	  </aside>
  	  <!--<aside class="col-md-4" >
	      <div class="box-bor col-md-12" style="height:265px">
		     <p><h2 style="text-align: center; margin-top:-10px">Thống kê</h2></a></p>
			 <div class="steps-container">
				
				<div id="chartContainer" style="height: 200px; width: 100%;"></div>
			</div>
		  </div>
	      
      </aside>-->
     
     

	
    </section>
	<section class="row" style="margin-bottom:20px; margin-top:20px">
  	 <!-- <aside class="col-md-3">
		  <div class="box-bor col-md-12">
		  Connections
		  </div>
		  
  	  </aside>-->
  	  <aside class="col-md-12">
		  <div class="box-bor col-md-12" id="maininfo">
		     <div class="tab-content">
				<div id="intro" class="tab-pane fade in active" style="left:10px;right:10px">
				    <div id="text-desc">
				   		<?php echo $description ?>	  
                   	</div>	
					<?php if($description) {?>
						<textarea id='introarea2' style="display:none;" ></textarea>
						<div id="btn-area" style="margin-top:20px">
							<button class="btn btn-danger"  id="edbtn" onclick="editintro()">Sửa</button>
						</div>
					<?php } else{ ?>
					    <h4>Thêm giới thiệu về bạn</h4>
						<textarea id="introarea" ></textarea>
						<div id="btn-area" style="margin-top:20px">
							<button class="btn btn-danger" onclick="save_description()">Lưu lại</button>
						</div>
					<?php }  ?>
				
					
				</div>
				<div id="info" class="tab-pane fade">
				    <form method="post" action="<?php echo site_url('profile/save_information')?>">
						<h4><table >
							<tbody>
								 <tr>
									<td style="padding:10px">Họ tên:</td>
									<td style="padding:10px">								
										<div id="usname"><?php echo $user_name?></div>
										<input type="text" name="fullname" value="<?php echo $user_name?>" id="usnt" style="display:none">
									</td>
								 </tr>
								 <tr>
									<td style="padding:10px">Ngày sinh:</td>
									<td style="padding:10px">
										<div id="birthdate"><?php echo $birthdate?></div>
										<input type="text" name="birthdate" value="<?php echo $birthdate?>" id="bdt" placeholder="dd-mm-yyyy ví dụ :23-05-2018" style="display:none">
									</td>
								 </tr>
								 <?php if($su==2 || $su==3){ ?>
								 <tr>
									<td style="padding:10px">Lớp:</td>
									<td style="padding:10px">
										<div id="cla"><?php echo $school?></div>
									</td>
								 </tr>
								 <tr>
									<td style="padding:10px">Trường:</td>
									<td style="padding:10px">
										<div id="scl"><?php echo $schools ?></div>
										<div id="scl_change" style="display:none" class="col-md-12 col-xs-12" >
										   <div class="col-md-4 col-xs-12">
											    <select class="form-control" name="scl_tinhthanh_id" id="scl_tinhthanh_id" onchange="changeDataSchool(event);">
													<option selected> ----Chọn tỉnh/ thành phố----</option>
													
													<?php
														foreach ($tinhthanh as $key => $val) {
															if($val['did']){ 
													?>
														
															<option value="<?php echo $val['did'];?>" ><?php echo $val['dataitem_name'];?></option>
													<?php } else{ ?>
															
															<option value="<?php echo $val['did'];?>"><?php echo $val['dataitem_name'];?></option>
													<?php }}?>
												</select>
											</div>
											<div class="col-md-4 col-xs-12">
												<select class="form-control" name="scl_quanhuyen_id" id="scl_quanhuyen_id" onchange="changeDataSchool1(event)"></select>
											</div>
											<div class="col-md-4 col-xs-12">
												<select class="form-control" name="scl_school_id" id="scl_school_id" onchange=""></select>
											</div>
											<!--<div class="col-md-4 col-xs-12">
												<select class="form-control" name="xaphuong_id" id="scl_xaphuong_id" onchange="changeDataSchool(event);"></select>
											</div>-->
										</div>
									</td>
								 </tr>
								 <?php }?>
								 <tr>
									<td style="padding:10px">Địa chỉ:</td>
									<td style="padding:10px">
									   <div id="address"><?php echo $address?></div>
									   <div id="address_change" style="display:none;" class="col-md-12 col-xs-12" >
										   <div class="col-md-4 col-xs-12">
											   <select class="form-control" name="tinhthanh_id" id="tinhthanh_id" onchange="changeDataItem(event);">
													<option> ----Chọn tỉnh/ thành phố----</option>
													<?php
														foreach ($dataitem_list as $key => $val) {
															if($val['did']==$tinhthanh_id){ 
													?>
														
															<option value="<?php echo $val['did'];?>" selected><?php echo $val['dataitem_name'];?></option>
													<?php } else{ ?>
															
															<option value="<?php echo $val['did'];?>"><?php echo $val['dataitem_name'];?></option>
													<?php }}?>
												</select>
											</div>
											 <div class="col-md-4 col-xs-12">
												<select class="form-control" name="quanhuyen_id" id="quanhuyen_id" onchange="changeDataItem(event);"></select>
											</div>
											 <div class="col-md-4 col-xs-12">
												<select class="form-control" name="xaphuong_id" id="xaphuong_id" onchange="changeDataItem(event);"></select>
											</div>
										</div>
									</td>
								 </tr>
								 <tr>
									<td style="padding:10px">Email:</td>
									<td style="padding:10px">								
										<div id="usmail"><?php echo $email?></div>
										<input type="email" name="email" value="<?php echo $email?>" id="usmt" style="display:none">
									</td>       
								</tr>
								<tr>
									<td style="padding:10px">Số điện thoại:</td>				
									<td style="padding:10px">								
										<div id="usphone"><?php echo $phone?></div>
										<input type="number" name="phone" value="<?php echo $phone?>" id="uspn" style="display:none">
									</td>          
								</tr>
							</tbody>
						</table>
						<div id="btn_inf">
							<button class="btn btn-danger" id="btn_edt_inf" onclick="edit_info(<?php echo $tinhthanh_id.','.$quanhuyen_id.','.$xaphuong_id ?>);edit_info1(<?php echo $uid.','.$scl_tinhthanh_id.','.$scl_quanhuyen_id.','.$scl_school_id ?>)">Chỉnh sửa</button>
						</div>
						</h4>
					</form>
				</div>
				<div id="categ" class="tab-pane fade">
					<p>Chọn lĩnh vực quan tâm:</p>
					<form method="post" action="<?php echo site_url("profile/save_interest_category")?>">
						<div id="catearea">
							<div class="col-md-12">
							<!--<input type="checkbox"> Tất cả </input><br/>-->
							 <?php foreach($categories as $k=>$cat){ 
									if(in_array($cat['cid'], $interest_cat_ids)){
								 ?>  
									<div class="col-md-3 col-xs-6">
										<input class="cb_ict" value="<?php echo $cat['cid'] ?>" name="categ[]" type="checkbox" checked> <?php echo $cat['category_name']?></input>
									</div>
								 <?php } else { ?>				 
									<div class="col-md-3 col-xs-6">
										<input class="cb_ict" value="<?php echo $cat['cid'] ?>" name="categ[]" type="checkbox" > <?php echo $cat['category_name']?></input>
									</div>
							<?php }}?>
							</div>
						</div>
					</form>
				</div>
				<div id="level" class="tab-pane fade">
					<p>Chọn lớp quan tâm:</p>
					<!--<input type="checkbox"> Tất cả </input><br/>-->
					<form method="post" action="<?php echo site_url("profile/save_interest_level")?>">
						<div id="levelarea">
							<div class="col-md-12">
							 <?php foreach($levels as $k=>$lev){ 
									if(in_array($lev['lid'], $interest_level_ids)){
								 ?>  
									<div class="col-md-3 col-xs-6">
										<input  class="cb_ilv" value="<?php echo $lev['lid'] ?>" name="lv[]" type="checkbox" checked> <?php echo $lev['level_name']?></input>
									</div>
								 <?php } else { ?>				 
									<div class="col-md-3 col-xs-6">
										<input  class="cb_ilv" value="<?php echo $lev['lid'] ?>" name="lv[]" type="checkbox" > <?php echo $lev['level_name']?></input>
									</div>
							<?php }}?>
							</div>
						</div>
					</form>
				</div>
				<div id="sub" class="tab-pane fade">
					<p style="color:red"><i>
					<?php
					if($sub == 1){
						?>Bạn đang theo dõi<?php
					}else{
						?>
						Hãy ấn theo dõi để nhận thông báo từ chúng tôi!
						<?php
					}
					 ?>
					</i></p>
					<!--<p>Chọn thời gian nhận thông báo:</p>-->
					<!--<input type="checkbox"> Tất cả </input><br/>-->
						<div id="subarea">
							<div class="col-md-12">
							<select id="timegetemail" onchange="timegetemail()" style="display:none">
								<option value="1">1 ngày</option>
								<option value="7">1 tuần</option>
								<option value="30">1 tháng</option>
							</select>
							<br><br>
							</div>
							<div class="col-md-1">
							<button id="btSub" class="btn btn-danger" onclick="Sub('<?php echo $uid ?>')">Theo dõi</button>
							</div>
							<div class="col-md-3">
							<button id="btunSub" class="btn" onclick="unsubb('<?php echo $uid ?>')">Hủy theo dõi</button>
							</div>
						</div>
				</div>
				<div id="logorg" class="tab-pane fade">
					<!--<input type="checkbox"> Tất cả </input><br/>-->
						<h4>
							<table >
								<tbody>
									 <tr>
										<td style="padding:10px">Ảnh đại diện:</td>
										<td style="padding:10px">
											<div id="user-avatar-box" class="col-md-3" style="position: relative">
                                                <?php if($logo){ ?>
													<img id="logoimg" class=" MR5" src="<?php echo $logo;?> " alt="" width="160" height="160">
												<?php } else{ ?>   
												   <img id="logoimg" class=" MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" height="160">
												<?php } ?> 
												<div class="file-upload-wrap wrap-camera" style="position: absolute;top: 110px;left: 0;width: 100%;margin: 0;">
													<div class="file-upload-button-wrap" style="display: block;float: none; margin-left:110px ">
														<a href="#" title="Chỉnh sửa logo" data-toggle="modal" data-target="#editlogoModal"><img src="//a.edim.co/images_v2/icons/camera_50.png" id="user-avatar-camera-icon" class="ttip"></a>
													</div>
												</div>
											</div>
											<input type="text" name="photorg" value="" id="photorg" style="display:none">
										</td>
									 </tr>
									 <tr>
										<td style="padding:10px">Tên công ty, tổ chức:</td>
										<td style="padding:10px" id="divtextorg">
										    <?php if($text_license){ ?>
											        <?php echo $text_license; ?>
													
												<?php } else{ ?>   
												   <input type="text" name="textorg" value="" id="textorg">
												<?php } ?> 
										</td>
										</td>
									 </tr>
									 <tr>
										<td style="padding:10px">Link:</td>
										<td style="padding:10px" id="divlinkorg">
										
										    <?php if($out_link){ ?>
											     <a href="<?php echo $out_link; ?>" target="_blank"><?php echo $out_link; ?></a>
													
												<?php } else{ ?>   
												   <input type="text" name="linkorg" value="<?php  ?>" id="linkorg">
												<?php } ?> 
											
										</td>
									 </tr>
								 </tbody>
							</table>
							<div id="edtlogobtn">
							      <?php if(!$text_license&& !$out_link){ ?>
										<button class="btn btn-danger"   onclick="save_logo()">Lưu lại</button>
								  <?php } else{ ?> 
										<button class="btn btn-danger"   onclick="edit_logo()">Chỉnh sửa</button>
								   <?php }  ?> 
							</div>
						</h4>
					
				</div>
				<div id="changePer" class="tab-pane fade">
					<h4><i>Quyền hiện tại:<?php 
					if($su==2){
						echo "&nbsp;&nbsp;&nbsp;Học Sinh";
					}elseif($su==3){
						echo "&nbsp;&nbsp;&nbsp;Giáo Viên";
					}elseif($su==4){
						echo "&nbsp;&nbsp;&nbsp;Phụ Huynh";
					}
					?></i></h4>
					<br>
					<h4><i>Bạn muốn đổi thành: <select id="changeAccess">
					<option selected="selected" disabled value='0'>Chức năng</option>
						<option value='2' <?php if($su==2){echo "style='display:none'";} ?>> Học sinh </option>
						<option value='3' <?php if($su==3){echo "style='display:none'";} ?>> Giáo viên </option>
						<option value='4' <?php if($su==4){echo "style='display:none'";} ?>> Phụ huynh </option>
					</select></i></h4>
					<br>
					<button onclick="btchange()" class="btn btn-danger">Xác nhận</button>
				</div>
			</div>
		</div>
      </aside>
    </section>
 </main>

<script type="text/javascript">
    function unsubb(id) {
        if (confirm("Bạn có chắc muốn hủy theo dõi?"))
				unSub(<?php echo $uid ?>)
        return true;
		}
		function btchange(){
			var e = document.getElementById("changeAccess");
			var value = e.options[e.selectedIndex].value;
			var text = e.options[e.selectedIndex].text;
			if(value==0){
				alert("Hãy lựa chọn quyền bạn muốn đổi?")
			}else{
				if(confirm("Bạn co chắc muốn đổi sang quyền "+text)){
					window.location.href = site_url+'/profile/changeAccess/'+<?php echo $uid ?>+'/'+<?php echo $su ?>+'/'+value;
				}
			}
		}
</script>
   
  </body>
</html>
