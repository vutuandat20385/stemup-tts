<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hướng dẫn chung</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
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
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
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
  	         <div class="row" style="float:right; margin-top:10px">
					
		
				 
					<div class="form-group col-md-3 col-xs-6 hidden-xs">	  
						 
					
						<button class="btn btn-sm btn-default btn-primary pull-right mb-5 dropdown-toggle" type="button" data-toggle="dropdown">Đăng nhập</button>
						 <div class="dropdown-menu " style="margin-left:-260px;">
						     <div class="arrow_box arrow-box-top"></div>
							 <div style="padding:10px">
								<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
								     <div id="error" style="color: red;"></div>
								     <div id="ok" style="color: green"></div>
									 <input class="page-signin-form-control form-control" name="email" style="width:350px;margin:10px" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus id="email">
									 <input class="page-signin-form-control form-control" name="password" style="width:270px;margin:10px" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required>
		                           	<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
									 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit" id="btn_subit">Đăng nhập</button>
									 
									 <!--<table>
										 <tr>
											<td style="padding:10px">
												<a class="btn"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
											 </td>
											 <td style="padding:10px">
												<a class="btn btn-danger"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập Itrithuc.vn </a>
											 </td>
										 </tr>
									 </table>-->
									 <a href="#" data-toggle="modal" data-target="#resetpwdModal" style="float:right; padding:10px"> Quên mật khẩu</a>
									 <script type="text/javascript">
									 	$('#btn_subit').on('click',function(){
									 		var username = $("#email").val();
									 		var password = $("#inputPassword").val();
									 		var error = $("#error");
									 		var ok = $("#ok");
							 				// resert 2 thẻ div thông báo trở về rỗng mỗi khi click nút đăng nhập
											error.html("");
											//ok.html("");
 
											// Kiểm tra nếu username rỗng thì báo lỗi
											if (username == "") {
												console.log('wetgw rthwrth5555');
												error.html("Địa chỉ Email không được để trống");
												return false;
											}
											if (password == "") {
												console.log('wetgw rthwrth5555');
												error.html("Password không được để trống");
												return false;
											}
											
											// Kiểm tra nếu password rỗng thì báo lỗi
											/*if (password == "") {
												console.log('mat khau khong de trng');
												error.html("Mật khẩu không được để trống");
												return false;
											}*/

											// Chạy ajax gửi thông tin username và password về server check_dang_nhap.php
											// để kiểm tra thông tin đăng nhập hợp lệ hay chưa
											/*$.ajax({

											  url: "Signup/create_user",
											  method: "POST",
											  data: { email : username, password : password },
											  success : function(response){
											  	if (response == "1") {
											  		ok.html("Đăng nhập thành công!");
											  	console.log('agadfdafgsdfg');
											  	}else{
											  		error.html("Password không được để trống!");
											  		console.log('da33333333333333333');
											  	}
											  }
											});*/
										});
									 </script>
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
    <!--<div class="event-banner" style="margin-bottom:10px">
		<a href="http://vui.stem.vn/chia-se-tri-thuc-stem-de-nhan-mua-phan-thuong/"><img class="img-responsive" src= "<?php echo base_url("images/event_banner.jpg") ?>"></a>
	</div>-->
    
	<section class="row">
  	  <aside class="col-md-2 hidden-xs">
	  
	     <div style="margin-top:-20px;" class="div-leftbar-home">
			<?php if($level_categ_list){?>
		         <div style="margin-top:20px">			   
				    <div class="list-group hidden-xs" >
					  <a href="<?php echo site_url('page/category/'.$category_permalink)?>"> <h3 class="list-group-item active1"><?php echo $category_name;?></h3></a>
					 <?php foreach($level_categ_list as $lv){?>
					    
						 <a href="<?php echo site_url('page/category/'.$category_permalink.'/'.$lv['permalink']);?>"  class="list-group-item <?php if($lv['lid']==$level_id){?> active <?php } ?>">  <?php echo $lv['level_name'];?></a>
					 <?php }?>
					</div>
			<?php } else{?>
			<div style="position:sticky;top:70px">
			<?php }?>
				<div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Trắc nghiệm</h3>
					 <a href="<?php echo site_url("home")?>"  class="list-group-item"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Câu hỏi vui</a>
					
					  <a href="<?php echo site_url('home/quiz_list') ?>"  class="list-group-item"><i class="fas fa-book" style="margin-right:5px"></i> Bài trắc nghiệm</a>
				  
				</div>
				
				<div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Phân loại</h3>
					 <a href="<?php echo site_url("page/categories")?>"  class="list-group-item"> <i class="fas fa-filter" style="margin-right:5px"></i> Chuyên mục</a>
				  
				</div>
				<div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Về chúng tôi</h3>
					 <a href="<?php echo site_url('home/about') ?>"  class="list-group-item"><i class="fas fa-bullseye" style="margin-right:5px"></i> Giới thiệu</a>
					 <a href="<?php echo site_url('home/detail3/user_terms') ?>"  class="list-group-item"><i class="fas fa-object-group" style="margin-right:5px"></i> Điều khoản sử dụng</a>
					 <a href="<?php echo site_url('home/detail1/guidelines') ?>"  class="list-group-item"><i class="fas fa-folder-open" style="margin-right:5px"></i> Hướng dẫn</a>
					 <a href="<?php echo site_url('home/detail2/policy') ?>"  class="list-group-item"><i class="fa fa-window-restore" style="margin-right:5px"></i> Chính sách riêng tư</a>
			  </div>
			</div>
		  
       </div> 
  	  </aside>  
	<aside class="col-md-10">
		  <div role="tabpanel" class="tab-pane fade in active" id="home2a">
			<div class="box-bor MB20">
				<div role="tabpanel">
				  <ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#tabDropDownOne1" tabindex="-1" data-toggle="tab">Hướng dẫn sử dụng</a>
					  <link rel="stylesheet" type="text/css" href=""> 
					</li>
					<li><a href="#tabDropDownOne1a" tabindex="-1" data-toggle="tab">Hướng dẫn cho mobile web</a></li>
					
					 <li><a href="#tabDropDownOne1ab" tabindex="-1" data-toggle="tab">Hướng dẫn cho mobile app</a></li>
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
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
					  
						<!--------------------------------------------------------------------------------------------------------------------------->
					 
					  <!--end Hướng dẫn sử dụng-->
						<!---------------------------------------------------------------------------------------------------------------------------->
					  
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
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
					  

					 <!------------------------------------------------------------------------------------------------------------------------------>
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
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
					  
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
					  
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
