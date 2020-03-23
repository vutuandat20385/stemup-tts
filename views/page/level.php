<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $level?></title>
		<meta name="Description" content="<?php echo $level?>" />
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<script src="<?php echo base_url('js/manage_class.js') ?>"></script>
	<script src="<?php echo base_url('js/minhash.js');?>"></script>
		<script src="<?php echo base_url('js/setbackground.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
	<script>

	
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
     var id_mcq_fun="<?php echo $id_mcq_fun ?>";
	    var id_quiz_fun ="";
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
			  <a class="navbar-brand navbar-brand1" href="<?php echo site_url('home') ?>">
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
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user');?>#assign_quiz" onclick="quizAssignTo(event);"><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/results'); ?>"><i class="mr-5 far fa-chart-bar"></i><br class="hidden-xs">Kết quả</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>"><i class="mr-5 fas fa-cloud"></i><br class="hidden-xs">Thư viện</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('message'); ?>"><i class="far fa-envelope"></i><span class="badge badge-sm up bg-pink count mcount"></span><br  class="hidden-xs">Tin nhắn</a>
			</li>
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
  	          <ul class="dropdown-menu dropdown-menu1">
  	           <!-- <li><a href="#"><i class="MR10 far fa-file-alt text-primary" aria-hidden="true"></i>Bảng tin</a></li>
  	            <li><a href="#"><i class="MR10 far fa-comments text-danger" aria-hidden="true"></i>Tin nhắn</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-th-large text-success" aria-hidden="true"></i>Khóa học</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-calendar text-danger" aria-hidden="true"></i>Sự kiện</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-users text-info" aria-hidden="true"></i>Nhóm</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-address-book text-warning" aria-hidden="true"></i>Dánh sách bạn bè</a></li> -->
				<?php if($su!=2){?>
				<li><a data-toggle="modal" data-target="#transferModal" href="#"><i class="MR10 fas fa-exchange-alt text-warning" aria-hidden="true"></i>Chuyển điểm</a></li>
				<?php } ?>
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
				<?php if($su!=4){?>
				<li class="mbclmn"><a  data-toggle="collapse" href="#">Lớp</a></li>
				<li class="mbgrmn"><a  data-toggle="collapse" href="#">Nhóm</a></li>
				 <?php } else{?>
					<li class="mbgrmn"><a  data-toggle="collapse" href="#">Con</a></li>
				<?php }?>
				<li><a >Hướng dẫn</a></li>
			  
			</ul>

		<ul id="tnmncl" class="panel-collapse collapse">
              
              <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
			  <?php if($su==1||$su==3||$su==6){?>
				  <a href="<?php echo site_url('home_user/create_question'); ?>" class="list-group-item createQuestionItem"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
				  <a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
				   <?php if($su!=6){?>
						<a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
					<?php } else {?>
						<a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
					<?php } ?>
				  <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item"> <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
			  <?php }?>
			  <?php if($su==2){?>
			   <a href="<?php echo site_url('home_user');?>#gocthutai" class="list-group-item" onclick="gocthutai(event);"> <i class="fas fa-flag-checkered" style="margin-right:5px"></i> Góc thử tài</a>
			   <?php }?>

				<a href="<?php echo site_url('home_user/quiz_list');?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>

			  <a href="<?php echo site_url('home_user/assign_quiz');?>" class="list-group-item" onclick="quizAssignTo(event);"> <i class="fas fa-bullhorn" style="margin-right:5px"></i> <?php if($su!=2) echo 'Bài đã giao'; else echo 'Bài được giao'; ?></a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>

			 <?php if($su==1) {?>
					<a href="<?php echo site_url('library/insert_video'); ?>" class="list-group-item"> <i class="fas fa-video" style="margin-right:5px"></i> Thêm video</a>
			   <?php } ?> 
		</ul>
		 
			<ul id="clmncl" class="panel-collapse collapse">	
				  <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>  
					<?php if($su==1||$su==3||$su==6){?>			
					  <a href="<?php echo site_url('home_user/manage_class'); ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
					 <a href="<?php echo site_url('home_user');?>#create_class" class="list-group-item" onclick="create_class(event);"> <i class="fab fa-dropbox" style="margin-right:5px"></i> Tạo một lớp</a>
				  <?php }?>
				  <?php if($su==2){?>
				    <a href="<?php echo site_url('home_user/manage_class'); ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
					<a data-toggle="modal" data-target="#joinClassModal" class="list-group-item"> <i class="fas fa-handshake" style="margin-right:5px"></i>  Tham gia lớp</a>
				  <?php }?>				  
			</ul>
	
		<ul id="grmncl" class="panel-collapse collapse">			      
	          <a href="#" class="list-group-item close_menu_mb" style="float:right; z-index:100" > x</a>
			  <?php if($su==1||$su==3||$su==6){?>
			 <a href="<?php echo site_url('home_user/manage_group') ?>" class="list-group-item"> <i class="fas fa-object-group" style="margin-right:5px"></i> Quản lý nhóm</a>
			  <a href="<?php echo site_url('home_user/create_group'); ?>" class="list-group-item"> <i class="fas fa-folder-open" style="margin-right:5px"></i> Tạo một nhóm</a>
			  <?php }?>
              <?php if($su==4){?>
				  <?php foreach($child_list as $k=>$child) { ?>
				  <!--<a href="<?php echo site_url('home_user/child_activities/'.$child['uid']); ?>" class="list-group-item">-->
				  <a href="#" class="list-group-item">
				  <?php echo $child['first_name'].' '.$child['last_name'] ; ?>
				  </a>
				  <?php } ?>

				  <a data-toggle="modal" data-target="#addstudentModal" class="list-group-item"><i class="far fa-plus-square" style="margin-right:5px"></i>  Thêm con</a>
				  <a data-toggle="modal" data-target="#createchildModal" class="list-group-item"><i class="far fa-plus-square" style="margin-right:5px"></i> Tạo tài khoản cho con</a>
			  <?php }?>	
			  <?php if($su!=4){?>
				<a href="#" class="list-group-item"> <i class="far fa-handshake" style="margin-right:5px"></i> Tham gia nhóm</a>
               <?php }?>			  
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
	
    <?php if($su==3){?>
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
	<?php }?>
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
		<?php if($su==4){?>
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
		<?php } ?>
	<?php if($su==2){?>
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
     <?php }?>
    <?php if($su==3|| $su==6 || $su==1){?>
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
      				<table >
				    	<tr>
				    		
				    		<td class="tranbtsbg openbgc"  style="opacity: 1; transform: translateX(0px);">
				    			<a id="mbgq1">
				    				<img src="<?php echo base_url('upload/background/1.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>	
				    		<td class="tranbtsbg" style="opacity: 1; transform: translateX(30px);">
				    			<a id="mbgq2">
				    				<img src="<?php echo base_url('upload/background/2.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td  >	
				    		<td class="tranbtsbg" style="opacity: 1; transform: translateX(60px);">
				    			<a id="mbgq3">
				    				<img src="<?php echo base_url('upload/background/3.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td >	
				    		<td class="tranbtsbg" style="opacity: 1; transform: translateX(90px);">
				    			<a id="mbgq4">
				    				<img src="<?php echo base_url('upload/background/4.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td >	
				    		<td class="tranbtsbg" style="opacity: 1; transform: translateX(120px);">
				    			<a id="mbgq5">
				    				<img src="<?php echo base_url('upload/background/5.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>
				    		<td class="tranbtsbg" style="opacity: 1; transform: translateX(150px);">
				    			<a id="mbgq6">
				    				<img src="<?php echo base_url('upload/background/6.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>	
				    		<td class="tranbtsbg" style="opacity: 1; transform: translateX(180px);">
				    			<a id="mbgq7">
				    				<img src="<?php echo base_url('upload/background/7.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>	
				    		<td class="tranbtsbg" style="opacity: 1; transform: translateX(210px);">
				    			<a id="mbgq8">
				    				<img src="<?php echo base_url('upload/background/8.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>	
				    		<td class="tranbtsbg" style="opacity: 1; transform: translateX(240px);">
				    			<a id="mbgq9">
				    				<img src="<?php echo base_url('upload/background/9.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>	
				    		<td class="tranbtsbg" style="opacity: 1; transform: translateX(270px);">
				    			<a id="mbgq10">
				    				<img src="<?php echo base_url('upload/background/10.jpg')?>" class="imgbgrbt" >
				    			</a>
				    		</td>	
                           <td style="opacity: 1; transform: translateX(400px);">
								 <button type="button" class="btn btn-success"  id="clmdprbg_1" data-dismiss="modal">Xác nhận</button>
                           </td>						   
				    	<tr>	
				    </table>
                  
                </div>
            </div>
        </div>
    </div>
    <?php }?>
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
					 <h4 class="media-heading"><a href="#" class="border-B1"><?php echo $user_name; ?><br><span class="text-small1"><?php echo $su_text ?></span></h4>
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
				  <a href="#" class="border-B1"style="font-size: 16px"><?php echo $user_name; ?></a> <br><span class="text-small">(<?php echo $su_text ?>)</span>
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
			   <?php if($su==1|| $su==3 || $su==6){?>
					<a href="<?php echo site_url('home_user/create_question'); ?>" class="list-group-item createQuestionItem"><i class="fas fa-question-circle" style="margin-right:5px"></i> Tạo câu hỏi</a>
					<a href="<?php echo site_url('home_user/recommend_question');?>" class="list-group-item createQuestionItem"><i class="far fa-question-circle" style="margin-right:5px"></i> Câu hỏi cho bạn</a>
				  <?php if($su!=6){?>
						<a href=<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item"> <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
				  <?php } else{ ?>
						<a href="<?php echo site_url('home_user/manage_qbank');?>" class="list-group-item" > <i class="fas fa-book" style="margin-right:5px"></i> Quản lý câu hỏi</a>
				  <?php } ?>
				  <a href="<?php echo site_url('home_user/create_quiz'); ?>" class="list-group-item"> <i class="fas fa-plus-circle" style="margin-right:5px"></i> Tạo bài kiểm tra</a>
			  <?php } ?>
			   
			   
			    <?php if($su==2){?>
					<a href="<?php echo site_url('home_user');?>#gocthutai" class="list-group-item" onclick="gocthutai(event);"> <i class="fas fa-flag-checkered" style="margin-right:5px"></i> Góc thử tài</a>
			   <?php }?>

				<a href="<?php echo site_url('home_user/quiz_list');?>" class="list-group-item"> <i class="fas fa-briefcase" style="margin-right:5px"></i> Kiểm tra</a>

			  <a href="<?php echo site_url('home_user/assign_quiz');?>" class="list-group-item" onclick="quizAssignTo(event);"> <i class="fas fa-bullhorn" style="margin-right:5px"></i> Bài đã giao</a>
			  <a href="<?php echo site_url('home_user/results'); ?>" class="list-group-item"> <i class="fas fa-bullseye" style="margin-right:5px"></i> Kết quả</a>
			   <?php if($su==1) {?>
					<a href="<?php echo site_url('library/insert_video'); ?>" class="list-group-item"> <i class="fas fa-video" style="margin-right:5px"></i> Thêm video</a>
			   <?php } ?>
              
		  </div>
		  <?php if($su==1|| $su==3||$su==2||$su==6){?>
		  <div class="list-group hidden-xs" id="class_menu">
			  <h3 class="list-group-item active1">Lớp</h3>
			 <!-- <a href="#" class="list-group-item">Tạo một nhóm nhỏ</a>-->
			  <div id ="classpage_menu"></div>
			   <?php if($su==1|| $su==3||$su==6){?>
			  <a href="<?php echo site_url('home_user/manage_class'); ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
			 <a href="<?php echo site_url('home_user');?>#create_class" class="list-group-item" onclick="create_class(event);"> <i class="fab fa-dropbox" style="margin-right:5px"></i> Tạo một lớp</a>
			   <?php }?>
			   <?php if($su==2){?>
			   <a href="<?php echo site_url('home_user/manage_class'); ?>" class="list-group-item"> <i class="fa fa-box" style="margin-right:5px"></i> Danh sách lớp</a>
			   <a data-toggle="modal" href="<?php echo site_url('home_user');?>" data-target="#joinClassModal" class="list-group-item"> <i class="fas fa-handshake" style="margin-right:5px"></i>  Tham gia lớp</a>
			   <?php }?>
			 <!-- <a href="#" class="list-group-item">Tham gia lớp</a>-->
		  </div>
		
		  <div class="list-group hidden-xs" id="group_menu">
			  <h3 class="list-group-item active1">Nhóm</h3>
			   <?php if($su==1|| $su==3 || $su==6){?>
			  <a href="<?php echo site_url('home_user/manage_group') ?>" class="list-group-item"> <i class="fas fa-object-group" style="margin-right:5px"></i> Quản lý nhóm</a>
			  
			  <a href="<?php echo site_url('home_user/create_group') ?>" class="list-group-item"> <i class="fas fa-folder-open" style="margin-right:5px"></i> Tạo một nhóm</a>
			  <?php }?>
			  <a href="<?php echo site_url('home_user');?>#" class="list-group-item"> <i class="far fa-handshake" style="margin-right:5px"></i> Tham gia nhóm</a>
		  </div>
		  <?php }?>
		  <?php if($su==4){?>
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
		  <?php }?>
		  
  	  </aside>
  	
	  
	  <aside class="col-md-7">
	      <?php if($su==3|| $su==6 || $su==1){?>
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
									
								
									<td class="tranbtsbg openbgc"  style="opacity: 1; transform: translateX(0px);">
										<a id="bgq1_main">
											<img src="<?php echo base_url('upload/background/1.jpg')?>" class="imgbgrbt" >
										</a>
									</td>	
									<td class="tranbtsbg" style="opacity: 1; transform: translateX(30px);">
										<a id="bgq2_main">
											<img src="<?php echo base_url('upload/background/2.jpg')?>" class="imgbgrbt" >
										</a>
									</td  >	
									<td class="tranbtsbg" style="opacity: 1; transform: translateX(60px);">
										<a id="bgq3_main">
											<img src="<?php echo base_url('upload/background/3.jpg')?>" class="imgbgrbt" >
										</a>
									</td >	
									<td class="tranbtsbg" style="opacity: 1; transform: translateX(90px);">
										<a id="bgq4_main">
											<img src="<?php echo base_url('upload/background/4.jpg')?>" class="imgbgrbt" >
										</a>
									</td >	
									<td class="tranbtsbg" style="opacity: 1; transform: translateX(120px);">
										<a id="bgq5_main">
											<img src="<?php echo base_url('upload/background/5.jpg')?>" class="imgbgrbt" >
										</a>
									</td>
									<td class="tranbtsbg" style="opacity: 1; transform: translateX(150px);">
										<a id="bgq6_main">
											<img src="<?php echo base_url('upload/background/6.jpg')?>" class="imgbgrbt" >
										</a>
									</td>	
									<td class="tranbtsbg" style="opacity: 1; transform: translateX(180px);">
										<a id="bgq7_main">
											<img src="<?php echo base_url('upload/background/7.jpg')?>" class="imgbgrbt" >
										</a>
									</td>	
									<td class="tranbtsbg" style="opacity: 1; transform: translateX(210px);">
										<a id="bgq8_main">
											<img src="<?php echo base_url('upload/background/8.jpg')?>" class="imgbgrbt" >
										</a>
									</td>	
									<td class="tranbtsbg" style="opacity: 1; transform: translateX(240px);">
										<a id="bgq9_main">
											<img src="<?php echo base_url('upload/background/9.jpg')?>" class="imgbgrbt" >
										</a>
									</td>	
									<td class="tranbtsbg" style="opacity: 1; transform: translateX(270px);">
										<a id="bgq10_main">
											<img src="<?php echo base_url('upload/background/10.jpg')?>" class="imgbgrbt" >
										</a>
									</td>			
									
								</tr>	
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
						  <div>
								<div class="col-md-3" style="margin-top:20px">Chọn là MCQ Fun</div>
								<div class="col-md-9" style="margin-top:20px"> <input  id="mcq_fun_main" name="mcqfun" value="0" type="checkbox"></div>
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
						 </div>
						 <div><p class="text-center MT10 text-do" id="support">Từ khóa: liên kết các câu hỏi liên quan đến nhau. Một câu hỏi có thể nhiều từ khóa.</p></div>
						<div><p class="text-center MT10 text-do" id="support">Lưu ý: các từ khóa cách nhau bởi dấu phẩy (,) </p></div>
						<div><p class="text-center MT10 text-do" id="support">(*): Thông tin bắt buộc </p></div>
					</div>
					<p class="text-center MT10 text-do">Tích chọn câu trả lời đúng trước khi lưu</p>
					<div class="text-center">
						<button id="loadopt" type="button" class="btn btn-primary" onclick="load_opt_main(this)" disabled style="display:none;">Lưu</button>
						<button type="button" class="btn btn-default" id="cancel_btn_crmain"> Hủy</button>
					</div>
				 
				</div>
			 </form>  
		</div>
		
		<?php } else{?>
			<div class="box-bor mb-20">
		      <div class="box-cauhoi">
					  <div class="input-group">
						
						<textarea name="search_question" class="form-control bo-none" style=" resize: none;" rows="1" id="search_question_main" placeholder="Tìm kiếm câu hỏi"></textarea>
					  </div>
				  </div>  
		</div>
		<?php } ?>
		<div class="box-bor1 mb-20" style="display:none">
			  <h4 class="tle1">Ảnh</h4>
			  <div class="border-B1"><img class="img-responsive" src="images/mh1.jpg" alt=""></div>
			  <div class="row">
				  <div class="col-xs-6 pad-R0"><img class="img-responsive" src="images/mh1.jpg" alt=""></div>
				  <div class="col-xs-6 pad-L0"><img class="img-responsive" src="images/mh1.jpg" alt=""></div>
			  </div>
			  <p class="text-center mt10"><a href="">Xem tất cả</a></p>
		  </div><!--end ảnh-->
		  <div class="box-bor1 mb-20"  style="display:none">
			  <h4 class="tle1">Video</h4>
			  <div class="border-B1">
				 <div class="embed-responsive embed-responsive-16by9">
				   <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/3cn-foKjoYc"></iframe>
			    </div>
		    </div>
			  <div class="row">
				  <div class="col-xs-6 pad-R0">
					  <div class="embed-responsive embed-responsive-16by9">
						   <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/3cn-foKjoYc"></iframe>
						</div>
				  </div>
				  <div class="col-xs-6 pad-L0">
					  <div class="embed-responsive embed-responsive-16by9">
						   <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/3cn-foKjoYc"></iframe>
						</div>
				  </div>
			  </div>
			  <p class="text-center mt10"><a href="">Xem tất cả</a></p>
		  </div><!--end video-->
		 <?php foreach( $mcq_fun as $mcq) {?>
		 <div class="box-bor1 mb-20 moremcq_<?php echo $mcq['qid']?>"" >
			  <!--<h4 class="tle1">Bài viết</h4>-->
			  <div>
				  <div class="row1" style="margin-top:20px">
					  <div class=col-xs-10>
						  <div class="w60"><a class="pointer"><img class="img-responsive img-circle" src="<?php echo base_url('upload/symbol/'.$mcq['cid'].'.png');?>" alt=""></a></div>
						  <h4 class="mb-0"><a class="pointer"><b><?php echo $mcq['category_name']?></b></a>
						   <span style="margin-left:10px" class="dropdown pointer"><a class="dropdown-toggle"  data-toggle="dropdown">
							<span class=" 
caret caret_e 
"></span></a>
						  <ul  class="dropdown-menu dropdown-menu_e"style="overflow-y: scroll;height: 273px;font-size:15px">
						      <?php foreach ($category_list as $ct){?>
							  <li><a href="<?php echo site_url('/page/category/'.$ct['category_permalink'])?>"><b><?php echo $ct['category_name']?></b></a></li>
							  <?php } ?>
							</ul>
						  
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
				    <?php if(strpos($mcq['question'],'latex.codecogs.com')!==false || strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false){?>
						  <div class="mcq_multimd assqid-<?php echo $mcq['qid']?>" style="display:none">
							<?php echo $mcq['question']?>
						 </div>
							<a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank" style="color:#000; font-size:30px">
						  
								<?php echo $mcq['question']?>
							 
						  
						  </a>
						<?php } else{?>
				      <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank" style="color:#fff">
					   <?php if(strpos($mcq['question'], '<iframe')===false && strpos($mcq['question'], '<img')===false){?>
					   <div class="bgqtdiv" >
							<font color="white">
								<div style="background-image:url('https://stemup.app/upload/background/<?php if($mcq['background_template']!=0){ echo $mcq['background_template'];} else{ echo rand(1,20);}?>.jpg');" class="outer bgqt">
									<div class="middle">
										<div class="inner">
											<?php 
											
											$des=html_entity_decode(strip_tags($mcq['question'])) ;
											if (mb_strlen($des, 'UTF-8')>120){
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
							<div class="imgwlogo">
									<a href="<?php echo $mcq['out_link']?>" target="_blank"> 
										<div class="logobanner">
										
											<div class="contentbn pb520">
											  
												<table>
												  <tr>
												   <td class="textorg">
												     <i>Cung cấp bởi</i> <b><?php echo $mcq['text_license'] ?></b>
												   </td>
												  <td style=" padding-left: 10px;">
												  <?php if($mcq['logo']){?>
												  <div class="logoimg">
														<img src="<?php echo $mcq['logo'] ?>">
												  </div>
												  <?php }?>
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
										
											<div class="contentbn">
											  
												<table>
												  <tr>
												   <td class="textorg">
												     <i>Cung cấp bởi</i> <b><?php echo $mcq['text_license'] ?></b>
												   </td>
												  <td style=" padding: 5px;">
												  <?php if($mcq['logo']){?>
												  <div class="logoimg">
														<img src="<?php echo $mcq['logo'] ?>">
												  </div>
												  <?php }?>
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
							<?php echo $mcq['question']?>
						 <?php }?>
						<?php }?>
					   <!--				  
					  <p>
						<?php foreach($mcq['tags'] as $k=>$tag){?>
							<?php if($k>0){?> 
							 ,
							<?php }?>
							<a href="">#<?php echo $tag['tag_name'] ?></a>
						<?php } ?>
					  </p>-->
					  </a>
					  <?php }?>
				  </div>
				  
				<div class="col-xs-12 div_opt">
					  <div class="row MB20 twopt">
						<div class="col-xs-6 mobile-opt mobmb20"> 
							<label class="radio-inline w-100">
								 
								   <input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='0'>
								   <div class="input-group mobile-text-opt" >
		
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optA1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> A:</b> </td>
										 <td><?php echo html_entity_decode($mcq['options'][0]['q_option'])?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
						<div class="col-xs-6 mobile-opt" > 
							<label class="radio-inline w-100">
								 
								   <input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='1'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optB1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> B:</b> </td>
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
								 
								    <input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='2'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optC1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> C:</b> </td>
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
								 
								 <input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='3'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optD1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> D:</b> </td>
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
						  <?php if($su==2 || $su==5){?>
						  <ul class="list-inline text-bt">
						      <?php if($mcq['liked']==1){?>
							  <li class="col-xs-3"><a class="acti pointer"  onclick="like_question(this , <?php echo $mcq['qid'] ?>)"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>
							  <?php } else{?>
							  <li class="col-xs-3"><a class="pointer"  onclick="like_question(this , <?php echo $mcq['qid'] ?>)"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs"> Thích</span></a></li>
							  <?php }?>
							  <li class="col-xs-3"><a class="pointer" data-toggle="collapse" data-target="#comment_area_main_<?php echo $mcq['qid']?>" ><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs">Bình luận</span></a></li>
							    <li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquestion%2F<?php echo  $mcq['permalink']?>&amp;src=sdkpreparse" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0');count_share(<?php echo $mcq['qid'];?>); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs">Chia sẻ</span></a></li>
							   <li class="col-xs-3">
								<?php if($mcq['ass']) {?>
									<a class="assign-bt pointer" onclick = "question_ass(<?php echo $mcq['qid']?>,<?php echo $mcq['ass']['assid']?>)"><i class="fab fa-resolving mr-5"></i><span class="hidden-xs">Đáp án</span></a>
								<?php }else{?>
									<a class="assign-bt pointer" href="<?php echo site_url('page/question/'.$mcq['permalink']); ?>" target="_blank" ><i class="fab fa-resolving mr-5"></i><span class="hidden-xs"> Đáp án</span></a>
								<?php } ?>
							</li>
							
						  </ul>
						  <?php } else{?> 
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
								<a class="assign-bt pointer" onclick="popup_require_login2(<?php echo $mcq['qid'] ?>)"><i class="fas fa-share-square mr-5"></i><span class="hidden-xs"> Đố </span></a>
							</li>
						  </ul>
						  
						   <?php }?>
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
			  <div class="col-xs-12 collapse" style="margin-top:20px;" id="comment_area_main_<?php echo $mcq['qid']?>">
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
								  <!-- <p class="text-small1">
									  <a class="mr-23" href="">Thích</a>
									  <a class="mr-23" href="">Trả lời</a>
									  - <?php echo $cmt['str_time_ago'];?>-->
								  </p>
							   </div>
								
						  </div>
                          
							<?php } ?>
						</div>
				  </div>
			  </div>
			 
		  </div><!--end baiviet-->
		 <?php } ?>
		 
	     
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
							<h3 class="text-center mb-20">
								Chúc mừng bạn đã trả lời đúng!<br>
								Đáp án chính xác là <span id="correct_ans_tr"> </span>.
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
						<h3 class="text-center mb-20 mt-0">Rất tiếc bạn đã trả lời sai!<br>Đáp án chính xác là <span id="correct_ans_fs"> </span>.</h3>
					</div>

				</div>

					
				 </div>
				  
			</div>
		</div>
	

	
      </aside>
      
      <aside class="col-md-3 rightbar">
	 
	   <div class="box-bor MB20">
		  <h3 class="text-xanh1"><a href="">BÀI TRẮC NGHIỆM </a></h3>
		  <?php foreach($quiz_fun_rb as $qz){?>
		      <div style="margin-bottom:20px" class="bo-B">
				<a href="<?php echo site_url('quiz/validate_quiz/'.$qz['quid']);?>"> <img src="<?php echo $qz['img'];?> " width="100%"></a><br/>
		         <a style="font-size:15px" href="<?php echo site_url('quiz/validate_quiz/'.$qz['quid']);?>"><b><?php echo $qz['quiz_name'];?></a></b>
			 </div>
		  <?php }?>
		 <!-- <div id="activities"></div>-->
		 
        </div>
      </aside>


    </section>
	
  	</main>
  	
   
  </body>
      
  </html>
