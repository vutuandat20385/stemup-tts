<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hướng sử dụng app STEMUP Học Sinh</title>
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
<style >
	marquee {
	display:none;	
}
</style>
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

<nav class="navbar navbar-stem navbar-fixed-top ">
  <div class="container">
  	    <!-- Brand and toggle get grouped for better mobile display
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
	    </div> -->
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
									 
									 <table>
										 <tr>
											<td style="padding:10px">
												<a class="btn"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
											 </td>
											 <td style="padding:10px">
												<a class="btn btn-danger"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn </a>
											 </td>
										 </tr>
									 </table>
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
	<!--<section class="visible-xs-block nav-mobile">
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
	</section>-->
	  
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
		<h2 class="text-center">Hướng dẫn cách chi tiết download và sử dụng app STEMUP Học Sinh</h2>
		<h3>1. Hướng dẫn cài đặt và tạo tài khoản trên app STEMUP Học Sinh.</h3>
		<h4 id="phare_helpmobile">Bước 1: Cài đặt STEMUP Học Sinh bằng smartphone</h4>
		<p id="content_helpmobile">Hiện nay, với sự phổ biến và tiện ích sử dụng mà smartphone đem lại. Do.stem,vn đưa ra một bước tiến mới trong việc kết nối giữa phụ huynh, giáo viên và học sinh thông qua App Mobile. Việc cài đặt phần mềm STEMUP Học Sinh tương tự một ứng dụng tiện ích bất kỳ nào dành cho người dùng trên điện thoại thông minh, dù là hệ điều hành ios hay Android.</p>
		<p><b>+ Với Android:</b></p>
		<p class="vmb-20">
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile1.png') ?>" alt="">
		</div></p>
		<p><b>+ Với ios (iphone, ipad):</b></p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile2.png') ?>" alt="">
		</div></p>
		<h4 id="phare_helpmobile">Bước 2: Đăng nhập</h4>
		<p>• Nhập Email và Mật khẩu (đã đăng ký).</p>
		<p>• Click nút Đăng nhập để sử dụng ứng dụng.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile3.png') ?>" alt="">
		</div></p>
		<p id="content_helpmobile">Trong trường hợp bạn chưa đăng ký thông tin thì cần click <b>Đăng ký</b> để có thể đăng nhập và sử dụng ứng dụng.</p>
		<p id="content_helpmobile">Sau khi click vào <b>Đăng ký</b> giao diện hiển thị form đăng ký thông tin. Bạn cần nhập các thông tin theo yêu cầu và xác nhận đăng ký thành công.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile4.png') ?>" alt="">
		</div></p>
		<h3>2. Hướng dẫn sử dụng các chức năng trên app STEMUP Học Sinh.</h3>
		<h4><i>Tính năng 1: Xem và cập nhật thay đổi thông tin người dùng </i></h4>
		<p id="content_helpmobile">Nhấn chọn biểu trượng cấu hình để xem thông tin. Tại chức năng này người dùng có thể thay thông tin về tài khoản của mình (hình ảnh đại diện, họ tên, số điện thoại,…) để tăng tính bảo mật.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile5.png') ?>" alt="">
		</div></p>
		<h4><i>Tính năng 2: Chức năng làm Bài trắc nghiệm được giao và bài tập trắc nghiệm có sẵn.</i></h4>
		<p><b>+ Sử dụng chức năng cho phép làm và xem kết quả bài trắc nghiệm được giao.</b></p>
		<p id="content_helpmobile">Chức năng cho phép con có thể mở bài trắc nghiệm do phụ huynh giao để làm và xem kết quả bài làm. Kết quả trắc nghiệm sau khi con hoàn thành sẽ chuyển đến app STEMUP Phụ huynh. Con cũng có thể xem chi tiết bài làm của mình, hệ thống sẽ cung cấp kết quả từng câu hỏi đến trang Kết quả chi tiết.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile6.png') ?>" alt="">
		</div></p>
		<p><b>+ Sử dụng chức năng cho phép làm và xem kết quả bài trắc nghiệm có sẵn do hệ thống cập nhật.</b></p>
		<p id="content_helpmobile">Phần mềm cho phép người dùng học sinh làm câu hỏi trắc nghiệm. Mỗi bài trắc nghiệm sẽ được chia ra thành các lĩnh vực khác nhau; giúp dễ dàng trong việc lựa chọn các lĩnh vực mong muốn. Để thực hiện bài kiểm tra học sinh sẽ thực hiện các bước thực hiện như sau:</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile7.png') ?>" alt="">
		</div></p>
		<h4><i>Tính năng 3: Hiển thị kết quả bài trắc nghiệm sau khi hoàn thành.</i></h4>
		<p id="content_helpmobile">Người dùng có thể xem kết quả bài làm thông qua tính năng Kết quả do hệ thống cung cấp. Bên cạnh % kết quả trả lời, đánh giá mức độ hoàn thành bài kiểm tra ( Vượt qua, không vượt qua,…); người dùng cũng có thể xem chi tiết kết quả bài làm.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile8.png') ?>" alt="">
		</div></p>
		<h4><i>Tính năng 4: Cập nhật các thông báo</i></h4>
		<p id="content_helpmobile">Bên cạnh tính năng thông báo qua notification, hệ thống còn cập nhật thêm tính năng Thông báo. Tính năng này cho phép lưu các thông báo về Bài trắc nghiệm được phụ huynh giao co con, kết quả bài tập vừa hoàn thành.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile9.png') ?>" alt="">
		</div></p>
		<h4><i>Tính năng 5: Cung cấp chức năng Tự Học.</i></h4>
		<p id="content_helpmobile">Ngoài chức năng làm bài trắc nghiệm, hệ thống còn cung cấp thêm tính năng Tự học. Tính năng này cung cấp các câu hỏi đa dạng phong phú theo từng môn học và khối lớp khác nhau. Giúp người học có thể bổ sung và hoàn thiện kiến thức qua nhưng câu hỏi trắc nghiệm được hiển thị trên trang.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile10.png') ?>" alt="">
		</div></p>
		<p id="content_helpmobile">Bên cạnh đó người  dùng cũng có thể chia sẻ lên trang facebook cá nhân và bình luận dưới mỗi câu hỏi quan tâm.</p>
		<p><b>+ Chia sẻ câu hỏi lên trang facebook cá nhân.</b></p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile11.png') ?>" alt="">
		</div></p>
		<p><b>+ Bình luận</b></p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/help_mobile12.png') ?>" alt="">
		</div></p>
	</aside>	  
	  
     
    </section>
  	</main>
  	<!-- style="position: fixed;left: 0;bottom: 0;width: 100%;" -->
	<footer class="container-fluid" style="display:none" >
		<div class="row bg-f1">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
					      <div id="thumbnail-preview-indicator" class="carousel slide" data-ride="carousel">
         
							  <div class="carousel-inner">
									<div class="item slides active">
										 <h3 class="tle-f1" >Giới thiệu<br><span class="line-f"></span></h3>
										 <p class="text-trang2 mb-20">Chúng tôi cung cấp cho bạn những tin tức <br>mới nhất và video từ lĩnh vực khoa học kỹ thuật.<br>Hệ thống đang trong giai đoạn thử nghiệm<br/> Open Beta.</p>
										 
										 <div class="row">
											 <div class="col-md-6">
												   <p class="text-trang1">Theo dõi chúng tôi:</p>
												   <a class="text-trang2" href="https://www.facebook.com/stemupapp" target="_blank"><i class="fab fa-facebook fa-2x mr-10"></i></a>
												   <a class="text-trang2" href="https://twitter.com/StemHoc" target="_blank" ><i class="fab fa-twitter-square fa-2x"></i></a>
											 </div>
											 <div class="col-md-6">
												   <p class="text-trang1">Liên hệ chúng tôi:</p>
												   <a class="text-trang2" href="">info@stem.vn</a>
											 </div>
										     
										 </div>
										 
										 
									</div>
									
									<div class="item slides">
					
										 <h3 class="tle-f1" >Điều khoản sử dụng<br><span class="line-f"></span></h3>
										  <p class="text-trang2 ">Bản quy chế này áp dụng cho các thành viên <br> đăng ký sử dụng Hệ thống trắc nghiệm trực tuyến<br> trên website do.stem.vn và app….</p>
										  <h5><a  class="col-md-3 col-md-offset-7 text-trang2 mb-20" href="<?php echo base_url('index.php/home/detail/user_terms')?>">Câu hỏi cùng chủ đề &gt;&gt;</a>
										  </h5>
										  <div class="row">
											   <div class="col-md-6">
													<p class="text-trang1">Tải STEM app:</p>
													<a class="text-trang2" href="https://play.google.com/store/apps/details?id=vn.dtt.stemvn" target="_blank"><i class="fab fa-google-play fa-2x"></i></i></a>
													<a class="text-trang2" href="https://play.google.com/store/apps/details?id=vn.dtt.mcq" target="_blank"><i class="fab fa-android fa-2x mr-10"></i></a>
													<a class="text-trang2" href="https://itunes.apple.com/vn/app/%C4%91%E1%BB%91/id1405372828?mt=8" target="_blank" ><i class="fab fa-apple fa-2x"></i></a>
												</div> 
												<div class="col-md-6">
													<p class="text-trang1">Liên hệ chúng tôi:</p>
													<a class="text-trang2" href="">info@stem.vn</a>
												</div>
												
											</div>
									</div>
								 
							 
								</div>
						 
						
						</div>
					</div>
					<div class="col-md-8 mb-10">
						<div class="row">
						
						    <div class="col-md-3">
								<h3 class="tle-f">Liên kết nhanh<br><span class="line-f"></span></h3>
								<ul class="menu-f">
									<?php 
										foreach($post_tag as $key => $val){
									?>
										<li><a href="<?php echo $val['link'];?>" target="_blank"><i class="mr-10 fa fa-angle-right"></i><?php echo $val['title'];?></a></li>
									<?php 
										}
									?>
								</ul>
							</div>
							 <div class="col-md-9">
								<h3 class="tle-f">Chuyên mục<br><span class="line-f"></span></h3>
								
									
								<div class="col-md-4">
								    
									<ul class="menu-f">

									 <?php for($i=0; $i<ceil(count($stcategories)/3); $i++){?>
									 	<li>
											<a href="<?php echo site_url('page/category/'.$stcategories[$i]['permalink'])?>" target="_blank">
												<i class="mr-10 fa fa-angle-right"></i><?php echo $stcategories[$i]['category_name']; ?>
												<span class="pull-right"><?php echo $stcategories[$i]['num_question']; ?></span>
											</a>
											
										</li>
									 <?php } ?>
									
									</ul>

									
								</div>
								<div class="col-md-4">
									 <ul class="menu-f">
									 <?php for($i=ceil(count($stcategories)/3); $i<ceil(2*count($stcategories)/3); $i++){?>
									 	<li>
											<a href="<?php echo site_url('page/category/'.$stcategories[$i]['permalink'])?>" target="_blank">
												<i class="mr-10 fa fa-angle-right"></i><?php echo $stcategories[$i]['category_name']; ?>
												<span class="pull-right"><?php echo $stcategories[$i]['num_question']; ?></span>
											</a>
											
										</li>
									 <?php } ?>
									</ul>
								</div>
								<div class="col-md-4">
									 <ul class="menu-f">
									<?php for($i=ceil(2*count($stcategories)/3); $i<count($stcategories); $i++){?>
									 	<li>
											<a href="<?php echo site_url('page/category/'.$stcategories[$i]['permalink'])?>" target="_blank">
												<i class="mr-10 fa fa-angle-right"></i><?php echo $stcategories[$i]['category_name']; ?>
												<span class="pull-right"><?php echo $stcategories[$i]['num_question']; ?></span>
											</a>
											
										</li>
									 <?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- The scroll to top feature -->

	<div class="scroll-top-wrapper ">
	  <span class="scroll-top-inner ">
		<i class="fa fa-2x fa-arrow-circle-up"></i>
	  </span>
	</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
 <!--<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?>"></script>-->
	
	<script>
				$( document ).ready(function() {
				$("[rel='tooltip']").tooltip();    

				$('.thumbnail').hover(
					function(){
						$(this).find('.caption').slideDown(250); //.fadeIn(250)
					},
					function(){
						$(this).find('.caption').slideUp(250); //.fadeOut(205)
					}
				); 
			});
		</script>
	<script>
		$(document).ready(function(){

$(function(){
 
    $(document).on( 'scroll', function(){
 
    	if ($(window).scrollTop() > 100) {
			$('.scroll-top-wrapper').addClass('show');
		} else {
			$('.scroll-top-wrapper').removeClass('show');
		}
	});
 
	$('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
	verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $('body');
	offset = element.offset();
	offsetTop = offset.top;
	$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}

});
	</script>
<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 



          <script src="<?php echo base_url('js/bootstrap.js');?>"></script> 
	<link href="<?php echo base_url('css/style-footer.css');?>" rel="stylesheet">
	

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120244244-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120244244-1');
</script>



  </body>

 
</html>
