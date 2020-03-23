<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Detail</title>
<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
	<!-- Web fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<!-- Bootstrap -->

	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/login.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-home.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/signup.js');?>"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
   <!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
</head>
<body>
<header class="bg-den">
   <?php     
	            if($this->session->flashdata('message_r')){echo $this->session->flashdata('message_r');} 
				if($this->session->flashdata('message')){
					?>
					
					<?php echo str_replace('{resend_url}',site_url('login/resend'),$this->session->flashdata('message'));?>
					
				<?php	
				}
				?>	
	<div class="container">
		 
				<div class="row">
				
			<div class="col-md-7 col-xs-6">
			<button class="btview" data-toggle="collapse" data-target="#relatedsite">Hệ sinh thái STEM</button>
				<!--<button class="btview" data-toggle="collapse" data-target="#demo">View related sites</button>

				<div id="demo" class="collapse">
					<div class="row">
						<ul class="col-md-4">
							<li><a href="">Toán vui cho người thông minh: Thay dấu hỏi bằng số nào? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate quisquam dolor eligendi sint commodi iusto quibusdam nihil id. In sunt dolorem aspernatur. Quis ratione quisquam illum facilis, adipisci in eum.</a></li>
							<li><a href="">Thiết kế Kỹ thuật Sáng tạo</a></li>
							<li><a href="">Trong cơ thể người, cơ quan nào lớn nhất? </a></li>
							<li><a href="">Trên thế giới có bao nhiêu người mắt xanh lá cây? </a></li>
							<li><a href="">Các mô hình giáo dục stem hiện nay? </a></li>
						</ul>
					</div>
				</div> -->
			</div>
				<?php if($clogin == 0) { ?>
			<!--<div class="col-md-2 text-right hidden-xs">
					<a class="color-trang color-F" href=""><i class="fab fa-facebook-square fa-2x"></i></a>
					<a class="color-trang color-T" href=""><i class="fab fa-twitter-square fa-2x"></i></a>
					<a class="color-trang color-G" href=""><i class="fab fa-google-plus-square fa-2x"></i></a>
			</div>-->
			<div class="col-md-5 col-xs-6">
				<div class="row" style="float:right">
					<!-- <div class="col-md-4"> -->
						<!-- <div class="input-group-sm mb-5">
						  <input type="text" class="form-control" placeholder="Username">
						</div> -->
		
				 
					<div class="form-group col-md-3 col-xs-6">	  
						 
						<!--<button class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>-->
						<button class="btn btn-sm btn-default btn-primary pull-right mb-5 dropdown-toggle" type="button" data-toggle="dropdown">Đăng nhập</button>
						 <div class="dropdown-menu" style="margin-left:-260px">
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


					<button type="submit" class="btn btn-sm btn-default btn-success" onclick="signup()">Đăng ký</button>
					
				</div>
			</div>
				<?php }  else {?>
			    <div class="col-md-offset-9">
					<div class="col-xs-2"><a href="<?php echo site_url('home_user/');?>">
					<?php if($link_photo) { ?>
    			    <img id="avt" class=" img-circle MR5" src="<?php echo $link_photo;?> " alt="" width="32" height="32">
    			<?php } else{ ?>   
    			   <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="32">
    			<?php } ?> 
					</a></div>
					<div class="col-xs-9">
						  <a href="<?php echo site_url('home_user/');?>" class="border-B1" style="color:#FFF"><?php echo $user_name; ?></a>
					</div>
			     </div>
			<?php } ?>
		</div>
	</div>

	<div id="relatedsite" class="collapse">
		<div class="row">
			<div class="col-md-4" style="margin-left:100px;">
				<ul>
					<li>
						<i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				       <a class="rellink" href="https://stem.vn" target="_blank">Trang chính thức stem.vn</a>
				   </li>
				   <li>
                        <i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				        <a class="rellink" href="https://vui.stem.vn" target="_blank">Trang Vui</a>
				    </li>
					 <li>
                        <i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				        <a class="rellink" href="https://www.stem.vn/vi_VN/all-courses" target="_blank">Trang Học</a>
				    </li>
					 <li>
                        <i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				        <a class="rellink" href="https://www.stem.vn/vi_VN/forum/stem-forum-2" target="_blank">Trang Hỏi</a>
				    </li>
			    </ul>
			</div>
		</div>
	</div>
</header>
	<!--nav-->
<nav class="container">
  <div class="row padTB10">
		<div class="col-md-3"><a href="<?php echo base_url('');?>"><img class="img-responsive" src="<?php echo base_url('images/logo.png');?>" alt=""></a></div>
		<div class="col-md-3 col-md-offset-6">
			<div class="input-group mt-5">
			  <input type="text" class="form-control">
			  <a class="input-group-addon" href=""><i class="fas fa-search"></i></a>
			</div>
		</div
	</div>
</nav>

             <img class="img-responsive col-md-10 col-md-offset-1" src="<?php echo base_url('images/home_anh15.jpg');?>" alt="">
	
	         <h1 style="text-align:center"class="col-md-8 col-md-offset-2"> <b>stemup.app -  một bộ phận quan trọng của Stem.vn  - mạng xã hội dành cho cộng đồng giáo dục </b></h1>
			 <h4 style="text-align:center" class="col-md-8 col-md-offset-2"> 
			 <b>Về chúng tôi:</b>  stemup.app là một bộ phận quan trọng của Stem.vn  - mạng xã hội dành cho cộng đồng giáo dục, đặc biệt là giáo dục STEM. Chúng tôi cung cấp một nền tảng về luyện tập và kiểm tra kiến thức, giúp cho 4 nhân tố quan trọng nhất của hệ sinh thái này - học sinh, giáo viên, nhà trường và phụ huynh - đều đạt được mục tiêu riêng của mình ở mức cao nhất, một cách dễ dàng, ít tốn thời gian và công sức nhất, trong mối liên kết chặt chẽ với nhau vì một mục tiêu chung: Học sinh đạt kết quả cao nhất trong học tập. Kết quả này thể hiện một cách minh bạch, đáng tin cậy mà mỗi thành viên đều có thể kiểm tra. 
			</h4>
			<h4 style="text-align:center"class="col-md-8 col-md-offset-2">
				stemup.app cũng tổ chức một hội đồng tư vấn gồm các chuyên gia có thẩm quyền trong các lĩnh vực tri thức liên quan. Họ là người tư vấn định hướng nội dung chủ đề, cung cấp, chia sẻ tài liệu về quy trình xây dựng, đánh giá chất lượng, phân loại MCQ, duyệt và đánh giá độ khó MCQ.
			</h4>
			<h4 style="text-align:center"class="col-md-8 col-md-offset-2">
				Chúng tôi kỳ vọng với sự tham gia đóng góp của các thành viên, các chuyên gia, đơn vị đối tác cũng như của cộng đồng, stemup.app sẽ là ngân hàng MCQ (và đề thi dưới dạng MCQ) trực tuyến lớn nhất Việt Nam đối với bậc tiểu học, trung học cơ sở và trung học phổ thông. 
			</h4>
				
	  
	</section>
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
</body>
</html>
