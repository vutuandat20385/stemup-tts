<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Câu hỏi</title>
	<meta name="Description" content="<?php if($mcqs){ echo strip_tags(html_entity_decode($mcqs[0]['question'])); } else {echo "Danh sách các câu hỏi";} ?>"/>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	 <script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/newpage.js');?>"></script>
		<script src="<?php echo base_url('js/signup.js');?>"></script>
   <script>	
	var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
	var id_mcq_fun="<?php echo $id_mcq_fun ?>";
	var id_quiz_fun="<?php echo $id_quiz_fun ?>";
	</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
  </head>
  <body class="bg-body">
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbmBMl=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php     
	            if($this->session->flashdata('message_r')){echo '<script>$(document).ready(function(){$("#error_login").modal();});</script>';} 
				
				?>	

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
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/notifications') ?>">
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
  	         <div class="row" style="float:right; margin-top:10px">
					<!-- <div class="col-md-4"> -->
						<!-- <div class="input-group-sm mb-5">
						  <input type="text" class="form-control" placeholder="Username">
						</div> -->
		
				 
					<div class="form-group col-md-3 col-xs-6 hidden-xs">	  
						 
						<!--<button class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>-->
						<button class="btn btn-sm btn-default btn-primary pull-right mb-5 dropdown-toggle" type="button" data-toggle="dropdown">Đăng nhập</button>
						 <div class="dropdown-menu " style="margin-left:-260px;">
						     <div class="arrow_box arrow-box-top"></div>
							 <div style="padding:10px">
								<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
								     
									 <input class="page-signin-form-control form-control" name="email" style="width:350px;margin:10px" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
									 <input class="page-signin-form-control form-control" name="password" style="width:270px;margin:10px" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
		                           	<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
									 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
									 
									<!-- <table>
										 <tr>
											<td style="padding:10px">
												<a class="btn"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
											 </td>
											 <td style="padding:10px">
												<a class="btn btn-danger"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn </a>
											 </td>
										 </tr>
									 </table>-->
									 <a href="#" data-toggle="modal" data-target="#resetpwdModal" style="float:right; padding:10px"> Quên mật khẩu</a>
								 </form>
							 </div>
							 
						 </div>
					</div>

                    <button class="btn btn-sm btn-default btn-primary mb-5 hidden-dt" type="button" onclick="login()">Đăng nhập</button>
					<button type="submit" class="btn btn-sm btn-default btn-success" onclick="signup()">Đăng ký</button>
 	        
          
        </div>
  	    <!-- /.navbar-collapse -->
  </div>
  	  <!-- /.container-fluid -->
	<section class="visible-xs-block nav-mobile">
			<ul class="ul-mobile list-unstyled">
				<li><a href="<?php echo site_url("home")?>">Câu hỏi vui</a></li>
				<li><a  href="<?php echo site_url("home/quiz_list")?>">Trắc nghiệm</a></li>
				<li><a  href="<?php echo site_url("home/about")?>">Giới thiệu</a></li>
				<li><a  class="pointer" data-toggle="collapse" data-target="#more_menu">...</a></li>
			</ul>  
		<ul id="more_menu" class="panel-collapse collapse ul-mobile list-unstyled">	
	         <li><a  href="<?php echo site_url("home/about")?>">Hướng dẫn</a></li>
			 <li><a href="<?php echo site_url("home/about")?>">Điều khoản sử dụng</a></li>
		</ul>
	</section>
	  
  </nav><!--end nav-->
<main class="container MT70">

    
	<section class="row">
  	  <aside class="col-md-2 hidden-xs">
	      <div style="margin-top:-20px;" class="div-leftbar-home">
		    <div style="position:sticky;top:70px">
				
				<div class="list-group hidden-xs" >
				 <h3 class="list-group-item active1">Trắc nghiệm</h3>
				 <a href="<?php echo site_url("home")?>"  class="list-group-item"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Câu hỏi vui</a>
				 <!-- <a href="<?php echo site_url("home/question_list")?>"  class="list-group-item"> <i class="fas fa-university" style="margin-right:5px"></i> Ngân hàng câu hỏi</a>-->
				  <a href="<?php echo site_url('home/quiz_list') ?>"  class="list-group-item"><i class="fas fa-book" style="margin-right:5px"></i> Bài kiểm tra</a>
				  
			  </div>
			  <div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Phân loại</h3>
					 <a href="<?php echo site_url("page/categories")?>"  class="list-group-item"> <i class="fas fa-filter" style="margin-right:5px"></i> Chuyên mục</a>
				  
				</div>
			  <div class="list-group hidden-xs" >
				 <h3 class="list-group-item active1">Về chúng tôi</h3>
				 <a href="<?php echo site_url('home/about') ?>"  class="list-group-item"><i class="fas fa-bullseye" style="margin-right:5px"></i> Giới thiệu</a>
				 <a href="<?php echo site_url('home/detail/user_terms') ?>"  class="list-group-item"><i class="fas fa-object-group" style="margin-right:5px"></i> Điều khoản sử dụng</a>
				 <a href="<?php echo site_url('home/detail/guidelines') ?>"  class="list-group-item"><i class="fas fa-folder-open" style="margin-right:5px"></i> Hướng dẫn</a>
				  
			  </div>
             
		 </div>  
       </div>  
  	  </aside>  
  	  <aside class="col-md-10">
		  <div role="tabpanel" class="tab-pane fade in active" id="home2a">
			<div class="box-bor MB20">
				<div role="tabpanel">
				  <ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="dropdown active"><a href="#" id="tabDropOne1" class="dropdown-toggle" data-toggle="dropdown" role="tab" aria-controls="tab3" aria-haspopup="true" aria-expanded="false">Hướng dẫn sử dụng<span class=" 
caret caret_e 
"></span></a>
					  <ul class="dropdown-menu" aria-labelledby="tabDropOne1">
						<link rel="stylesheet" type="text/css" href=""> 
						<li><a href="#tabDropDownOne1" tabindex="-1" data-toggle="tab">Hướng dẫn chung</a></li>
						<li><a href="#tabDropDownTwo2" tabindex="-1" data-toggle="tab">Người dùng là học sinh</a></li>
						<li><a href="#tabDropDownTwo3" tabindex="-1" data-toggle="tab">Người dùng là giáo viên</a></li>
						<li><a href="#tabDropDownTwo4" tabindex="-1" data-toggle="tab">Người dùng là phụ huynh</a></li>
					  </ul>
					</li>
					<li role="presentation" class="dropdown"><a href="#" id="tabDropOne1" class="dropdown-toggle" data-toggle="dropdown" role="tab" aria-controls="tab3" aria-haspopup="true" aria-expanded="false">Hướng dẫn cho mobile web<span class=" 
caret caret_e 
"></span></a>
					  <ul class="dropdown-menu" aria-labelledby="tabDropOne1">
						<li><a href="#tabDropDownOne1a" tabindex="-1" data-toggle="tab">Hướng dẫn chung</a></li>
						<li><a href="#tabDropDownTwo2a" tabindex="-1" data-toggle="tab">Người dùng là học sinh</a></li>
						<li><a href="#tabDropDownTwo3a" tabindex="-1" data-toggle="tab">Người dùng là giáo viên</a></li>
						<li><a href="#tabDropDownTwo4a" tabindex="-1" data-toggle="tab">Người dùng là phụ huynh</a></li>
					  </ul>
					</li>
					  <li role="presentation" class="dropdown"><a href="#" id="tabDropOne1" class="dropdown-toggle" data-toggle="dropdown" role="tab" aria-controls="tab3" aria-haspopup="true" aria-expanded="false">Hướng dẫn cho mobile app<span class=" 
caret caret_e 
"></span></a>
					  <ul class="dropdown-menu" aria-labelledby="tabDropOne1">
						<li><a href="#tabDropDownOne1ab" tabindex="-1" data-toggle="tab">Hướng dẫn chung</a></li>
						<li><a href="#tabDropDownTwo2ab" tabindex="-1" data-toggle="tab">Người dùng là học sinh</a></li>
						<li><a href="#tabDropDownTwo3ab" tabindex="-1" data-toggle="tab">Người dùng là giáo viên</a></li>
						<li><a href="#tabDropDownTwo4ab" tabindex="-1" data-toggle="tab">Người dùng là phụ huynh</a></li>
					  </ul>
					</li>
				  </ul>
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
				  <div id="tabContent1" class="tab-content">
					  <div role="tabpanel" class="tab-pane fade in active pad" id="tabDropDownOne1">
						<h2 class="text-wc">Chào các bạn!</h2>
						  <p class="text-center">
							Bài viết này chúng tôi sẽ hướng dẫn cho các khách hàng đang sử dụng website stemup.app <br>Các bước để dễ dàng trong việc thực hiện các thao tác và tối ưu hóa các chức năng mà website stemup.app cung cấp cho người sử dụng.
						  </p>
						<h3 class="text-center">Hướng dẫn chung</h3>
					   	  <h4>1. Truy cập stemup.app</h4>
						  <p><b>a. Đăng ký tài khoản người sử dụng </b></p>
						  <p>B1: Trên màn hình trình duyệt của hệ thống gõ link: https://stemup.app => Ấn Enter. Màn hình hệ thống hiển thị.<br>
							B2: Click vào nút <b>Đăng ký</b> góc trên bên phải màn hình<br>
							B3: Hộp thoại Đăng ký người dùng xuất hiện/ chọn dạng đăng ký<br>
								<div class="row vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD01.jpg') ?>" alt=""></div>
							B5: Chọn nút <b>Xác nhận</b>  đế lưu thông tin người dùng<br><p></p>
								<div class="row vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD02.jpg') ?>" alt=""></div>
						  </p>
						  <p><strong>b. Đăng nhập stemup.app</strong></p>
						  <p>
							B1: Trên màn hình trình duyệt của hệ thống gõ link: https://stemup.app => Ấn Enter. Màn hình hệ thống hiển thị. Click vào nút <b>Đăng nhập</b> góc trên bên phải màn hình<br>
							B2: Nhập thông tin urename và password đã được đăng ký<br>
							B3:  Chọn “ Tự động đăng nhập” trong trường hợp muốn lưu thông tin đăng nhập sau khi tắt trình duyệt.<br>
							B4: Chọn nút <b>Đăng nhập</b> để tiến hành truy cập vào tài khoản sử dụng<br>
							<i><strong>Chú ý:</strong> Người dùng cũng có thế đăng nhập trực tiếp bằng tài khoản facebook hoặc Google+ nếu có.</i>
						   </p>
						  <!--<p class="mb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD03.jpg') ?>" alt=""></p>-->
						 		<div class="row vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD03.jpg') ?>" alt=""></div>
						  <p><b>c. Quên mật khẩu</b></p>
						  <p>
							Khi bạn muốn đăng nhập vào hệ thống nhưng lại quên mất mật khẩu. Bạn có thể sử dụng chức năng <b>Quên mật khẩu</b> ở trên màn hình đăng nhập bằng cách:<br>
							B1: Nhấn chọn <b>Đăng nhập</b>.<br>
							B2: Nhấp chuột vào <b>Quên mật khẩu</b> trên màn hình đăng nhập tài khoản.<br>
								<div class="row vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD04.jpg') ?>" alt=""></div>
							B3: Hộp thoại Quên mật khẩu xuất hiện nhập các thông tin tài khoản đăng nhập. Chọn xác nhận CAPCHA.<br>
							B4: Nhấn chọn nút <b>Xác nhận</b> để hoàn tất thao tác/ nút <b>Close</b> để đóng trong trường hợp không muốn sử dụng chức năng Quên mật khẩu.<br><p></p>
								<div class="row vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD05.jpg') ?>" alt=""></div>
							B5: Bạn đã đăng nhập vào hệ thống và thông tin được gửi về email đăng ký <p></p>
								<div class="row vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD06.jpg') ?>" alt=""></div>
						  </p>
						  <h4>2. Chọn lĩnh vực:</h4>
						  <p>B1: Click vào biểu tượng tam giác cạnh tên lĩnh vực được hiển thị ở giao diện trang chủ sau đăng nhập<br>
							B2: Click vào lĩnh vực bạn muốn trong danh sách hiện ra</p>
 						    	<div class="row vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD07.jpg') ?>" alt=""></div>
						  <h4>3. Chia sẻ MCQ/quiz trên Facebook:</h4>
						  <p>
							B1: Click vào chữ <b>Chia sẻ</b> ở dưới mỗi MCQ/quiz<br>
							B2: Gõ thông điệp bạn muốn chia sẻ.<br>
							B3: Nhấn <b>Đăng lên Facebook</b>
						  </p>
								<div class="row vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD08.jpg') ?>" alt=""></div>
						  <h4>4. Bình luận về MCQ/quiz:</h4>
						  <p>
							B1: Click vào chữ <b>Bình luận</b> phía dưới mỗi MCQ/quiz<br>
							B2: Gõ bình luận và enter.
						  </p>
								<div class="row vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD09.jpg') ?>" alt=""></div>
					  </div><!--end Hướng dẫn chung-->
					  <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownTwo2">
						<h3 class="text-center">Hướng dẫn cho học sinh</h3>
						<h4>1. Làm bài trắc nghiệm</h4>
								<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD010.jpg') ?>" alt=""></p>
							<p>
							B1: Vào <b>Kiểm tra</b><br>
							B2: Chọn bài trắc nghiệm, nhấn <b>Kiểm tra</b> <br>
							B3: Click vào đáp án bạn chọn, nhấn <b>Trả lời</b><br>
								<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD11.jpg') ?>" alt=""></p>
							B4: Trả lời các câu hỏi tiếp theo, sau khi trả lời câu cuối, nhấn <b>Nộp bài</b> và chờ vài giây để xem kết quả.<p></p>
								<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD12.jpg') ?>" alt=""></p>
							</p>
						<h4>2. Làm bài tập được giao</h4>
						    <p>
							B1: Vào Bài được giao. Nhấn <b>Làm bài</b>.<br>
							B2: Với những bài đã làm, có thể nhấn <b>Xem kết quả</b> để biết kết quả.
							</p>
						<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD13.jpg') ?>" alt=""></p>
						<h4>3. Xem kết quả các bài trắc nghiệm đã làm</h4>
						    <p>
							B1: Vào <b>Kết quả</b><br>
							B2: Để xem kết quả chi tiết từng bài, nhấn vào chữ <b>Chi tiết</b> của bài đó
						    </p>
						   	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD14.jpg') ?>" alt=""></p>
						<h4>4. Tham gia lớp</h4>
						    <p>
							B1: Vào <b>Tham gia lớp</b><br>
						    <p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD15.jpg') ?>" alt=""></p>
							B2: Nhập mã lớp, nhấn <b>Xác nhận</b><p></p>
						    <p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD16.jpg') ?>" alt=""></p>
						    </p>
						<h4>5. Trao đổi trong lớp</h4>
						    <p>B1: Vào <b>Danh sách lớp</b><br>
							B2: Chọn lớp
						    <p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD17.jpg') ?>" alt=""></p>
							</p>
						    <p>B3: Để đăng bài, đăng ý kiến, gõ vào phần <b>Viết bài</b> và nhấn <b>Đăng bài.</b></p>
						    <p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD18.jpg') ?>" alt=""></p>
						    <p>B4: Để trao đổi về một topic đã được đăng tải trên tường của lớp, bạn gõ <b>bình luận</b> vào dưới bài.</p>
						    <p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD19.jpg') ?>" alt=""></p>
						    <p>B5: Để trao đổi trực tiếp với một thành viên trong lớp, nhấn <b>Thành viên</b>, chọn bạn để trao đổi.</p>
						    <p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD20.jpg') ?>" alt=""></p>
						<h4>6. Tham gia nhóm</h4>
						    <p>Vào <b>Tham gia nhóm</b> Nhập mã nhóm, nhấn <b>Xác nhận</b></p>
						    <p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD21.jpg') ?>" alt=""></p>
					  </div><!--end Người dùng là học sinh-->
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
					  <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownTwo3">
					  <h3 class="text-center">Hướng dẫn cho giáo viên</h3>
						<h4>1. Tạo câu hỏi trắc nghiệm</h4>
						    <p>B1: Vào <b>Quản lý câu hỏi</b>, sau đó nhấn <b>Tạo câu hỏi</b><br>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD22.jpg') ?>" alt=""></p>
							B2: Nhập câu hỏi (upload ảnh và video nếu câu hỏi bao gồm cả ảnh và video)<br>
							Nhập các phương án trả lời<br>
							Chọn đáp án đúng (click vào ô tròn trước đáp án<br>
							Chọn môn học<br>
							Chọn lớp<br>
							Nhập nội dung phần Giải thích (nếu có)<br>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD23.jpg') ?>" alt=""></p>
	            			B3: Nhấn <b>Lưu / Hủy</b>
							</p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD24.jpg') ?>" alt=""></p>
						<h4>2. Quản lý câu hỏi đã tạo</h4>
						    <p>B1: Vào <b>Quản lý câu hỏi</b><br>
							B2: Chọn câu hỏi muốn can thiệp ( nhấn Xem – biểu tượng hình con mắt; Sửa – biểu tượng cây bút; hoặc Xóa – biểu tượng thùng rác)
						    </p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD25.jpg') ?>" alt=""></p>
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
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD28.jpg') ?>" alt=""></p>
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
						<!--------------------------------------------------------------------------------------------------------------------------->
					  <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownTwo4">
					  <h3 class="text-center">Hướng dẫn cho phụ huynh</h3>
						<h4>1. Giao bài cho con:</h4>
							<strong>Cách 1:</strong>
							<p>B1: Vào <b>Kiểm tra</b><br>
							B2: Chọn bài kiểm tra thích hợp, nhấn <b>Giao bài kiểm tra</b><br>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD36.jpg') ?>" alt=""></p>
							B3: Chọn ngày bắt đầu và ngày kết thúc (hạn cuối nộp bài làm)<br>
							B4: Click vào <b>Đóng </b>khi hoàn thanh các thao tác
							</p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD37.jpg') ?>" alt=""></p>
						    <strong>Cách 2:</strong>
						    <p>Nếu bạn đang xem một MCQ/quiz và muốn giao bài đó cho con<br>
						    B1: Nhấn <b>Đố</b> (phía dưới MCQ/quiz)<br>
						    B2: Chọn giao bài cho cá nhân, nhập tên con rồi nhấn Gửi.
					        </p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD38.jpg') ?>" alt=""></p>
						<h4>2. Xem các bài đã giao: ( chưa thực hiện chức năng)</h4>
							<p>Vào Bài đã giao, trên giao diện sẽ hiện ra các bài đã giao cho con. Nếu sắp đến hạn mà con chưa hoàn thành, có thể nhấn Nhắc nhở. Nếu muốn hủy bài kiểm tra, nhấn nút Hủy.</p>
						<h4>3. Xem kết quả làm bài kiểm tra của con do giáo viên giao:</h4>
						    <p>B1: Vào <b>Kết quả</b><br>
							B2: Xem kết quả thông tin bài làm của con</p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD39.jpg') ?>" alt=""></p>
						<h4>4. Tạo tài khoản cho con:</h4>
						    <p>Vào Tạo tài khoản cho con, nhập các trường thông tin, nhấn <b>Xác nhận</b>.</p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD40.jpg') ?>" alt=""></p>
						    <p>Nếu con đã có tài khoản, để quản lý con trên stemup.app, bạn vào <b>Thêm con</b>, nhập mã học sinh của con</p>
						    	<p class="vmb-20"><img class="img-responsive" src="<?php echo base_url('images/HDSD41.jpg') ?>" alt=""></p>
					  </div><!--end Người dùng là phụ huynh-->
					  <!--end Hướng dẫn sử dụng-->
						<!---------------------------------------------------------------------------------------------------------------------------->
					  <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownOne1a">
						  <h2 class="text-wc">Chào các bạn!</h2>
						  <p class="text-center">
Ngày nay, việc sử dụng smartphone để truy cập internet không còn là điều mới mẻ, nó mang lại nhiều tiện ích cho người sử dụng. Nắm bắt được nhu cầu thực tế của người sử dụng, stemup.app hỗ trợ truy cập cho người dùng trên smartphone. <br>Giúp cho người sử dụng có những trải nghiệm thú vị và tiện ích nhất.</p><p class="text-center">
Đầu tiên, từ công cụ tìm kiếm google gõ link truy cập: https://stemup.app để tiến hành truy cập vào trang thông tin của stemup.app và thực hiện các tháo tác đăng nhập và truy cập vào tài khoản người dùng đã đăng ký để sử dụng các chức năng mong muốn.</p>
						<h4>1. Truy cập stemup.app</h4>
						  <strong>a. Đăng nhập stemup.app</strong><p>
•	Click vào biểu tượng   phía trên bên phải màn hình/ chọn <b>Đăng nhập</b><br>
•	Nhập thông tin username và password đã được đăng ký. Chọn <b>“Tự động đăng nhập”</b> trong trường hợp muốn lưu thông tin đăng nhập sau khi tắt trình duyệt.<br>
•	Chọn nút <b>Đăng nhập</b> để tiến hành truy cập vào tài khoản sử dụng</p><p>
<strong>Chú ý:</strong> Người dùng cũng có thế đăng nhập trực tiếp bằng tài khoản facebook hoặc Google+ nếu có.</p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD68.jpg') ?>" alt="" ></p>
						  <strong>b. Đăng ký tài khoản người sử dụng</strong><p>

Trong trường hợp người dùng chưa có tài khoản để đăng nhập thì tiến hành click <b>Đăng ký</b> để tạo tài khoản cho nười dùng.</p><p>
•	Hộp thoại Đăng ký người dùng xuất hiện/ chọn dạng đăng ký<br>
•	Nhập đầy đủ các thông tin người dùng vào các trường thông tin như:  Họ tên, Email, Mật khẩu và Xác nhận mật khẩu<br>
•	Sau đó click vào <b>CAPCHA</b> để xác nhận lại thông tin/ Chọn  <b>Xác nhận </b>đế lưu thông tin  người dùng</p>
						  <div class="row">
							<div class="col-md-6"><img class="img-responsive" src="<?php echo base_url('images/HDSD69.jpg') ?>" alt=""></div>
							<div class="col-md-6"><img class="img-responsive" src="<?php echo base_url('images/HDSD70.jpg') ?>" alt=""></div>
						  </div>
						  <strong>c. Quên mật khẩu</strong><p>
Khi bạn muốn đăng nhập vào hệ thống nhưng lại quên mất mật khẩu. Bạn có thể sử dụng chức năng Quên mật khẩu ở trên màn hình đăng nhập bằng cách:</p><p>
•	Nhấn chọn Đăng nhập/ Click Quên mật khẩu trên màn hình đăng nhập tài khoản.<br>
•	Hộp thoại Quên mật khẩu xuất hiện nhập các thông tin tài khoản đăng nhập. Chọn xác nhận CAPCHA.<br>
•	Nhấn chọn nút Xác nhận để hoàn tất thao tác/ nút Close để đóng trong trường hợp không muốn sử dụng chức năng Quên mật khẩu
•	Bạn đã đăng nhập vào hệ thống và thông tin được gửi về email đăng ký</p>
<div class="row v1mb-20">
							<div class="col-md-6"><img class="img-responsive" src="<?php echo base_url('images/HDSD71.jpg') ?>" alt=""></div>
							<div class="col-md-6"><img class="img-responsive" src="<?php echo base_url('images/HDSD72.jpg') ?>" alt=""></div>
	<div class="col-md-4"><img class="img-responsive" src="images/HDSD06.jpg" alt=""></div>
						</div>
						<strong>2. Chọn lĩnh vực:</strong><p>
•	Click vào biểu tượng tam giác cạnh tên lĩnh vực được hiển thị ở giao diện trang chủ sau đăng nhập<br>
•	Click vào lĩnh vực bạn muốn trong danh sách hiện ra</p>
<p><img class="img-responsive" src="images/HDSD73.jpg" alt=""></p>
						  <b>3. Chia sẻ MCQ/quiz trên Facebook:</b><p>
•	Click vào biểu trượng chia sẻ ở dưới mỗi MCQ/quiz. Gõ thông điệp bạn muốn chia sẻ.<br>
•	Nhấn Đăng lên Facebook</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD74.jpg') ?>" alt=""></p>
						  <b>4. Bình luận về MCQ/quiz:</b><p>
•	Click vào biểu tượng Bình luận phía dưới mỗi MCQ/quiz<br>
•	Gõ bình luận và enter</p><p><img class="img-responsive" src="<?php echo base_url('images/HDSD075.jpg') ?>" alt=""></p>
					  </div><!--end Hướng dẫn chung-->
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
					  <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownTwo2a">
						<h3 class="text-center">Hướng dẫn cho học sinh</h3>
						  <h4>1.	Làm bài trắc nghiệm</h4>
						  <p>•	Để làm bài kiểm tra bạn có thể chọn một trong hai lựa chọn Kiểm tra trên màn hình để thực hiện kiểm tra<br>
•	Chọn bài trắc nghiệm, nhấn Kiểm tra<br>
<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD76.jpg') ?>" alt=""></p>
•	 Click vào đáp án bạn chọn, nhấn Trả lời<br>
•	Trả lời các câu hỏi tiếp theo, sau khi trả lời câu cuối, nhấn Nộp bài và chờ vài giây để xem kết quả.
</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD77.jpg') ?>" alt=""></p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD78.jpg') ?>" alt=""></p>
						  <h4>2. Làm bài tập được giao</h4><p>
•	Nhấn chọn Trắc nghiệm/ chọn Bài được giao. Nhấn Làm bài.<br>
•	Với những bài đã làm, có thể nhấn Xem kết quả để biết kết quả.</p>
<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD79.jpg') ?>" alt=""></p>
						  <h4>3. Xem kết quả các bài trắc nghiệm đã làm</h4><p>
Vào Trắc nghiệm ở góc bên trái cuối màn hình/ chọn Kết quả để ẽm kết quả bài đã làm.</p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD80.jpg') ?>" alt=""></p>
						  <h4>4. Tham gia lớp</h4><p>
Nhấn chọn Lớp/ click Tham gia lớp<br>
Nhập mã lớp, nhấn Xác nhận</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD81.jpg') ?>" alt=""></p>
						 <h4> 5. Trao đổi trong lớp</h4><p>
•	Nhấn chọn Lớp/ click Danh sách lớp<br>
•	Chọn Tên lớp tham gia<br>
•	Để đăng bài, đăng ý kiến, gõ vào phần Viết bài và nhấn Đăng bài.</p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD082.jpg') ?>" alt=""></p>
						  <h4>6. Tham gia nhóm</h4><p>
•	Vào Tham gia nhóm<br>
•	Nhập mã nhóm, nhấn Xác nhận</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD83.jpg') ?>" alt=""></p>
					  </div><!--end Người dùng là học sinh-->
					  <!-------------------------------------------------------------------------------------------------------------------------->
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
					  <!---------------------------------------------------------------------------------------------------------------------------->
					  <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownTwo4a">
						  <h3 class="text-center">Hướng dẫn cho phụ huynh</h3>
						  <h4>1. Giao bài cho con:</h4>
						<strong>Cách 1:</strong><p>
B1: vào Trắc nghiệm/ chọn Kiểm tra<br>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD95.jpg') ?>" alt=""></p>
B2: Chọn bài kiểm tra thích hợp, nhấn Giao bài kiểm tra<br>
B3: Chọn ngày bắt đầu và ngày kết thúc (hạn cuối nộp bài làm)<br>
B4: Click vào Đóng khi hoàn thanh các thao tác</p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD96.jpg') ?>" alt=""></p>
						  <strong>Cách 2:</strong><p>
Nếu bạn đang xem một MCQ/quiz và muốn giao bài đó cho con<br>
Nhấn Đố (phía dưới MCQ/quiz)<br>
Chọn giao bài cho cá nhân, nhập tên con rồi nhấn Gửi.</p>
 <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD97.jpg') ?>" alt=""></p>
						  <h4>2. Xem các bài đã giao: ( chưa thực hiện chức năng)</h4><p>
Vào Bài đã giao, trên giao diện sẽ hiện ra các bài đã giao cho con. Nếu sắp đến hạn mà con chưa hoàn thành, có thể nhấn Nhắc nhở. Nếu muốn hủy bài kiểm tra, nhấn nút Hủy.</p>
<h4>3. Xem kết quả làm bài kiểm tra của con do giáo viên giao:</h4><p>
B1: Vào Kết quả<br>
B2: Xem kết quả thông tin bài làm của con</p>
<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD98.jpg') ?>" alt=""></p>
						  <h4>4. Tạo tài khoản cho con:</h4><p>
Vào Tạo tài khoản cho con, nhập các trường thông tin, nhấn Xác nhận.</p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD99.jpg') ?>" alt=""></p>
						  <p>Nếu con đã có tài khoản, để quản lý con trên stemup.app, bạn vào Thêm con, nhập mã học sinh của con</p>
						  <p><img class="img-responsive" src="<?php echo base_url('images/HDSD100.jpg') ?>.jpg" alt=""></p>
					  </div><!--end Người dùng là phụ huynh-->
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
					<!--end Hướng dẫn cho mobile web-->
					  
					   <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownOne1ab">
						  <h3 class="text-center">Hướng dẫn cách chi tiết download và sử dụng stemup.app</h3>
						<h4>Bước 1: Download stemup.app bằng smartphone</h4>
						<p>Hiện nay, với sự phổ biến và tiện ích sử dụng mà smartphone đem lại. Do.stem,vn đưa ra một bước tiến mới trong việc kết nối giữa phụ huynh, giáo viên và học sinh thông qua App Mobile. Việc cài đặt phần mềm Đố tương tự một ứng dụng tiện ích bất kỳ nào dành cho người dùng trên điện thoại thông minh, dù là hệ điều hành IOS hay Androi.</p>
						<strong>Với Androi:</strong>
						<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD42.jpg') ?>" alt=""></p>
						<strong>Với IOS (Iphone, Ipad):</strong>
						<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD43.jpg') ?>" alt=""></p>
						<h4>Bước 2: Đăng nhập</h4>
						<p>Nhập Email và Mật khẩu (đã đăng ký).<br>
						Click nút Đăng nhập để sử dụng ứng dụng.
							</p>
						<p>Trong trường hợp bạn chưa đănng ký thông tin thì cần click Đăng ký để có thể đăng nhập và sử dụng ứng dụng.
Sau khi click vào Đăng ký giao diện hiển thị form đăng ký thông tin. </p><p>Bạn cần nhập các thông tin theo yêu cầu và xác nhận đăng ký thành công.
</p>
						<div class="row">
							<div class="col-md-6"><img class="img-responsive" src="<?php echo base_url('images/HDSD44.jpg') ?>" alt=""></div>
							<div class="col-md-6"><img class="img-responsive" src="<?php echo base_url('images/HDSD45.jpg') ?>" alt=""></div>
						</div>
						<h4>Bước 3: Xem thông tin tài khoản</h4>
<p>Nhấn chọn biểu trượng cấu hình để xem thông tin. Sau khi click hệ thống sẽ hiển thị ra form thông tin người dùng. Người dùng có thể thay đổi mật khẩu tài khoản của mình để tăng tính bảo mật. Đồng thời, cập nhật thông tin về tài khoản (hình ảnh đại diện, họ tên, số điện thoại,…)</p>
						<div class="row">
							<div class="col-md-6"><img class="img-responsive" src="<?php echo base_url('images/HDSD46.jpg') ?>" alt=""></div>
							<div class="col-md-6"><img class="img-responsive" src="<?php echo base_url('images/HDSD047.jpg') ?>" alt=""></div>
						</div>
						<h4>Bước 4: Sử dụng các tính năng với các chức năng tương ứng với người dùng là học sinh, phụ huynh, giáo viên.</h4>
						<strong>1.	Chia sẻ MCQ/quiz trên Facebook</strong>
						<p>Tính năng chia sẻ cho phép người dùng có thể chia sẻ các câu hỏi hay lên facebook cá nhân của mình để mọi người có thể xem và thảo luận.<br>
Để chia sẻ tiến hành nhấn vào biểu trượng chia sẻ trên màn hình.
</p>
								<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD48.jpg') ?>" alt=""></p>
						<h4>2.	Bình luận về MCQ/quiz  </h4>
<p>Tính năng chia sẻ cho phép người dùng có thể chia sẻ các câu hỏi hay lên facebook cá nhân của mình để mọi người có thể xem và thảo luận.<br>
Để chia sẻ tiến hành nhấn vào biểu trượng chia sẻ trên màn hình.</p>
				<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD49.jpg') ?>" alt=""></p>
						<h4>3.	Chức năng Đố MCQ/quiz  </h4><p>
Ngoài ra, trên giao diện trang chủ của người dùng và phụ huynh tích hợp thêm tính năng Đố ở dưới mỗi câu hỏi hiển thị. Tính năng này giúp cho giáo viên và phụ huynh có thể đố học sinh làm những câu hỏi hay. Giúp con em mình có thêm những kiếm thức sâu rộng ở mọi lĩnh vực.</p>
<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD50.jpg') ?>" alt=""></p>
					<h4>4.	Chức năng thông báo</h4>
<p>Chức năng này cho phép hiển thị các thông báo hoạt động của người dùng khi chọn biểu tượng:</p><p>
-	Học sinh: Nhận thông báo bài trắc nghiệm được giao, thông tin lớp đã tham gia, các câu hỏi đố, thông báo nhắc nhở làm bài<br>
-	Giáo viên: Nhận thông báo kết quả bài kiểm tra của học sinh, thông báo học sinh tham gia lớp,…<br>
-	Phụ huynh: Nhận thông báo kết quả làm bài trắc nghiệm của con, kết quả câu hỏi được đố.</p>
				<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD51.jpg') ?>" alt=""></p>
					  </div><!--end Hướng dẫn chung-->
					 <!------------------------------------------------------------------------------------------------------------------------------>
					  <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownTwo2ab">
						<h3 class="text-center">Hướng dẫn cho học sinh</h3>
						<h4>1.	Làm bài trắc nghiệm</h4><p>
Phần mềm cho phép người dùng học sinh làm câu hỏi trắc nghiệm. Mỗi bài trắc nghiệm sẽ được chia ra thành các lĩnh vực khác nhau; giúp dễ dàng trong việc lựa chọn các lĩnh vực mong muốn. Để thực hiện bài kiểm tra học sinh sẽ thực hiện các bước thực hiện như sau:</p>
						  <p>
							  Bước 1: chọn biểu tượng<img class="" src="<?php echo base_url('images/HDSD52.jpg') ?>" alt="">   hiển thị dưới chân trang/ hiển thị thông tin lĩnh vực lựa chọn<br>
								Bước 2: Chọn lĩnh vực kiêm tra<br>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD54.jpg') ?>" alt=""></p>
								Bước 3: Chọn bài trắc nghiệm để kiểm tra<br>
								Bước 4: Chọn trả lời đáp án và chọn vào biểu tượng<img class="" src="<?php echo base_url('images/HDSD53.jpg') ?>" alt="">    phía trên bên trái màn hình để nộp bài.<br>

						  </p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD55.jpg') ?>" alt=""></p>
						  <h4>2.	Làm bài tập được giao</h4>
						  <p><img class="img-responsive" src="<?php echo base_url('images/HDSD56.jpg') ?>" alt=""></p>
						  <p>Khi biểu tượng trắc nghiệm phí dưới chân trang xuất hiện dấu chấm than hoặc tại biểu tượng thông báo có thông báo bài được giao hoặc câu hỏi được đố </p><p>
Để làm bài được giao nhấn vào biểu tượng trắc nghiệm/ chọn mục bài được giao/ chọn bài trắc nghiệm được giao và tiến hành thực hiện bài làm trắc nghiệm.
</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD57.jpg') ?>" alt=""></p>
						  <p>Để làm câu hỏi được giao nhấn vào biểu tượng trắc nghiệm/ chọn mục câu hỏi/ chọn câu hỏi được giao và tiến hành thực hiện trả lời câu hỏi.</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD58.jpg') ?>" alt=""></p>
						  <h4>3.	Xem xác kết quả các bài trắc nghiệm đã làm</h4><p>
Để xem kết quả bài làm của mình sau khi thực hiện xong. Học sinh nhấn chọn vào biểu tượng<img class="" src="<?php echo base_url('images/HDSD59.jpg') ?>" alt="">   phía dưới màn hình để xem kết quả bài làm.</p><p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD60.jpg') ?>" alt=""></p>
					  </div><!--end Người dùng là học sinh-->
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
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
					  <div role="tabpanel" class="tab-pane fade pad" id="tabDropDownTwo4ab">
						  <h3 class="text-center">Người dùng là phụ huynh</h3>
						<h4>1. Giao bài cho con:</h4>
						<p>Chức năng này cho phép người dùng là phụ huynh có thể dễ dàng giao bài tập cho con. Giúp con có thể củng cố các kiếm thực với các lĩnh vực phù hợp. Để thực hiện giao bài cho con, phụ huynh sẽ thực hiện các bước như sau:
						</p>
						  <p>
							  Bước 1: Chọn biểu tượng trắc nghiệm ở dưới cuối trang<br>
Bước 2: Vào mục trắc nghiệm vui, chọn lĩnh vực  mong muốn<br>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD65.jpg') ?>" alt=""></p>
Bước 3: Nhấn chọn vào biểu tượng đố để giao bài cho học sinh<br>
Bước 4: nhấn chọn thông tin nhóm và tên người dùng cần giao và nhấp chọn nút Gửi để tiến hành hoàn tất giao bài cho học sinh.
						  </p>
						  <p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD66.jpg') ?>" alt=""></p>
						  <h4>2.	Xem kết quả làm bài của con </h4><p>
Tính năng này cho phép phụ huynh có thể xem kết quả bài kiểm tra đã hoàn thành của học sinh. Ngoài ra, giáo viên cũng có thể xem kết quả bài làm trắc nghiệm, những câu hỏi đố mà phụ huynh thực hiện.</p><p>
Để xem kết quả bài làm của con, phụ huynh nhấn chọn vào biểu tượng<img class="" src="<?php echo base_url('images/HDSD59.jpg') ?>" alt="">   phía dưới màn hình để xem kết quả bài làm.</p>
<p class="v1mb-20" align="center"><img class="img-responsive" src="<?php echo base_url('images/HDSD67.jpg') ?>" alt=""></p>
					  </div><!--end Người dùng là phụ huynh-->
					<!--end Hướng dẫn cho mobile app-->
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
				  </div>
				</div>
			</div>
		  </div><!--CMQ-->
      </aside>
    </section>
  	</main>
  </body>
</html>